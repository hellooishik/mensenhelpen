<?php
/**
 * AJAX Handlers
 */

/**
 * Handle Frontend User Registration
 */
function mensenhelpen_ajax_register_user() {
	check_ajax_referer( 'mensenhelpen_nonce', 'nonce' );

	$name       = sanitize_text_field( $_POST['mensenhelpen_name'] );
	$email      = sanitize_email( $_POST['mensenhelpen_email'] );
	$password   = $_POST['mensenhelpen_password']; // Will be hashed by wp_insert_user
	$address    = sanitize_textarea_field( $_POST['mensenhelpen_address'] );
	$age        = sanitize_text_field( $_POST['mensenhelpen_age_range'] );
	$categories = isset( $_POST['mensenhelpen_categories'] ) ? array_map( 'absint', $_POST['mensenhelpen_categories'] ) : array();

	if ( empty( $name ) || empty( $email ) || empty( $password ) ) {
		wp_send_json_error( array( 'message' => __( 'Please fill in all required fields.', 'mensenhelpen' ) ) );
	}

	if ( email_exists( $email ) ) {
		wp_send_json_error( array( 'message' => __( 'Email address is already registered.', 'mensenhelpen' ) ) );
	}

	$userdata = array(
		'user_login' => $email,
		'user_email' => $email,
		'user_pass'  => $password,
		'first_name' => $name,
		'role'       => 'subscriber',
	);

	$user_id = wp_insert_user( $userdata );

	if ( ! is_wp_error( $user_id ) ) {
		// Save additional meta
		update_user_meta( $user_id, 'mensenhelpen_address', $address );
		update_user_meta( $user_id, 'mensenhelpen_age_range', $age );
		update_user_meta( $user_id, 'mensenhelpen_preferences', $categories );

		// Auto-login after registration
		wp_set_current_user( $user_id, $userdata['user_login'] );
		wp_set_auth_cookie( $user_id );
		do_action( 'wp_login', $userdata['user_login'], get_user_by( 'id', $user_id ) );

		wp_send_json_success( array( 'message' => __( 'Registration successful! Redirecting...', 'mensenhelpen' ) ) );
	} else {
		wp_send_json_error( array( 'message' => $user_id->get_error_message() ) );
	}
}
add_action( 'wp_ajax_nopriv_mensenhelpen_register', 'mensenhelpen_ajax_register_user' );

/**
 * Handle Brand Inquiry Submission
 */
function mensenhelpen_ajax_brand_inquiry() {
	check_ajax_referer( 'mensenhelpen_nonce', 'nonce' );

	$company = sanitize_text_field( $_POST['brand_company'] );
	$name    = sanitize_text_field( $_POST['brand_name'] );
	$email   = sanitize_email( $_POST['brand_email'] );
	$message = sanitize_textarea_field( $_POST['brand_message'] );

	if ( empty( $company ) || empty( $name ) || empty( $email ) ) {
		wp_send_json_error( array( 'message' => __( 'Please fill in all required fields.', 'mensenhelpen' ) ) );
	}

	// Send Email to Admin
	$to      = get_option( 'admin_email' );
	$subject = sprintf( __( 'New Brand Inquiry from %s', 'mensenhelpen' ), $company );
	$body    = "Company: $company\nName: $name\nEmail: $email\n\nMessage:\n$message";
	$headers = array( 'Content-Type: text/plain; charset=UTF-8' );

	$sent = wp_mail( $to, $subject, $body, $headers );

	if ( $sent ) {
		wp_send_json_success( array( 'message' => __( 'Thank you! We have received your inquiry and will contact you shortly.', 'mensenhelpen' ) ) );
	} else {
		wp_send_json_error( array( 'message' => __( 'There was a problem sending your inquiry. Please try again.', 'mensenhelpen' ) ) );
	}
}
add_action( 'wp_ajax_mensenhelpen_brand_inquiry', 'mensenhelpen_ajax_brand_inquiry' );
add_action( 'wp_ajax_nopriv_mensenhelpen_brand_inquiry', 'mensenhelpen_ajax_brand_inquiry' );

/**
 * AJAX Product Filtering
 */
function mensenhelpen_ajax_filter_products() {
	check_ajax_referer( 'mensenhelpen_nonce', 'nonce' );

	$category = isset( $_POST['category'] ) ? absint( $_POST['category'] ) : 0;
	$brand    = isset( $_POST['brand'] ) ? absint( $_POST['brand'] ) : 0;
	$sort     = isset( $_POST['sort'] ) ? sanitize_text_field( $_POST['sort'] ) : 'latest';

	$args = array(
		'post_type'      => 'product',
		'posts_per_page' => 12,
		'post_status'    => 'publish',
	);

	if ( $category || $brand ) {
		$args['tax_query'] = array();

		if ( $category ) {
			$args['tax_query'][] = array(
				'taxonomy' => 'product_cat',
				'field'    => 'term_id',
				'terms'    => $category,
			);
		}

		if ( $brand ) {
			$args['tax_query'][] = array(
				'taxonomy' => 'brand',
				'field'    => 'term_id',
				'terms'    => $brand,
			);
		}
	}

	if ( 'rating' === $sort ) {
		$args['meta_key'] = '_average_rating';
		$args['orderby']  = 'meta_value_num';
		$args['order']    = 'DESC';
	} else {
		$args['orderby'] = 'date';
		$args['order']   = 'DESC';
	}

	$query = new WP_Query( $args );

	ob_start();

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			get_template_part( 'template-parts/content', 'product' );
		}
		wp_reset_postdata();
	} else {
		echo '<p class="no-products-found">' . esc_html__( 'No products found matching your criteria.', 'mensenhelpen' ) . '</p>';
	}

	$html = ob_get_clean();

	wp_send_json_success( array( 'html' => $html ) );
}
add_action( 'wp_ajax_mensenhelpen_filter_products', 'mensenhelpen_ajax_filter_products' );
add_action( 'wp_ajax_nopriv_mensenhelpen_filter_products', 'mensenhelpen_ajax_filter_products' );

/**
 * Handle Frontend Review Submission
 */
function mensenhelpen_ajax_submit_review() {
	check_ajax_referer( 'mensenhelpen_nonce', 'nonce' );

	if ( ! is_user_logged_in() ) {
		wp_send_json_error( array( 'message' => __( 'You must be logged in to leave a review.', 'mensenhelpen' ) ) );
	}

	$product_id = absint( $_POST['product_id'] );
	$rating     = absint( $_POST['rating'] );
	$title      = sanitize_text_field( $_POST['review_title'] );
	$text       = sanitize_textarea_field( $_POST['review_text'] );
	$pros       = sanitize_textarea_field( $_POST['review_pros'] );
	$cons       = sanitize_textarea_field( $_POST['review_cons'] );
	$user_id    = get_current_user_id();

	if ( ! $product_id || ! $rating ) {
		wp_send_json_error( array( 'message' => __( 'Rating and target product are required.', 'mensenhelpen' ) ) );
	}

	// Create Review Post
	$review_data = array(
		'post_title'   => $title ? $title : sprintf( __( 'Review by %s', 'mensenhelpen' ), wp_get_current_user()->display_name ),
		'post_content' => $text,
		'post_status'  => 'publish', // Or 'pending' if you want moderation
		'post_type'    => 'review',
		'post_author'  => $user_id,
	);

	$review_id = wp_insert_post( $review_data );

	if ( ! is_wp_error( $review_id ) ) {
		update_post_meta( $review_id, '_review_product_id', $product_id );
		update_post_meta( $review_id, '_review_rating', $rating );
		update_post_meta( $review_id, '_review_pros', $pros );
		update_post_meta( $review_id, '_review_cons', $cons );

		// Re-calculate average rating
		mensenhelpen_update_product_average_rating( $product_id );

		wp_send_json_success( array( 'message' => __( 'Review submitted successfully!', 'mensenhelpen' ) ) );
	} else {
		wp_send_json_error( array( 'message' => __( 'Error submitting review.', 'mensenhelpen' ) ) );
	}
}
add_action( 'wp_ajax_mensenhelpen_submit_review', 'mensenhelpen_ajax_submit_review' );
