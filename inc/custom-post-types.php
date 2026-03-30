<?php
/**
 * Register Custom Post Types
 */

function mensenhelpen_register_cpts() {

	// 1. Products CPT
	$labels_product = array(
		'name'                  => _x( 'Products', 'Post type general name', 'mensenhelpen' ),
		'singular_name'         => _x( 'Product', 'Post type singular name', 'mensenhelpen' ),
		'menu_name'             => _x( 'Products', 'Admin Menu text', 'mensenhelpen' ),
		'name_admin_bar'        => _x( 'Product', 'Add New on Toolbar', 'mensenhelpen' ),
		'add_new'               => __( 'Add New', 'mensenhelpen' ),
		'add_new_item'          => __( 'Add New Product', 'mensenhelpen' ),
		'new_item'              => __( 'New Product', 'mensenhelpen' ),
		'edit_item'             => __( 'Edit Product', 'mensenhelpen' ),
		'view_item'             => __( 'View Product', 'mensenhelpen' ),
		'all_items'             => __( 'All Products', 'mensenhelpen' ),
		'search_items'          => __( 'Search Products', 'mensenhelpen' ),
	);

	$args_product = array(
		'labels'             => $labels_product,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'product' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-cart',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'show_in_rest'       => true,
	);
	register_post_type( 'product', $args_product );

	// 2. Reviews CPT
	$labels_review = array(
		'name'                  => _x( 'Reviews', 'Post type general name', 'mensenhelpen' ),
		'singular_name'         => _x( 'Review', 'Post type singular name', 'mensenhelpen' ),
		'menu_name'             => _x( 'Reviews', 'Admin Menu text', 'mensenhelpen' ),
		'name_admin_bar'        => _x( 'Review', 'Add New on Toolbar', 'mensenhelpen' ),
		'add_new'               => __( 'Add New', 'mensenhelpen' ),
		'add_new_item'          => __( 'Add New Review', 'mensenhelpen' ),
		'new_item'              => __( 'New Review', 'mensenhelpen' ),
		'edit_item'             => __( 'Edit Review', 'mensenhelpen' ),
		'view_item'             => __( 'View Review', 'mensenhelpen' ),
		'all_items'             => __( 'All Reviews', 'mensenhelpen' ),
	);

	$args_review = array(
		'labels'             => $labels_review,
		'public'             => false, // We probably won't have single review pages
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => false,
		'rewrite'            => false,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 6,
		'menu_icon'          => 'dashicons-star-filled',
		// Supports 'author' to tie it to a user. Metadata will hold product ID, rating, pros, cons.
		'supports'           => array( 'title', 'editor', 'author' ),
	);
	register_post_type( 'review', $args_review );

	// 3. Testimonials CPT
	$labels_testimonial = array(
		'name'                  => _x( 'Testimonials', 'Post type general name', 'mensenhelpen' ),
		'singular_name'         => _x( 'Testimonial', 'Post type singular name', 'mensenhelpen' ),
		'menu_name'             => _x( 'Testimonials', 'Admin Menu text', 'mensenhelpen' ),
		'add_new'               => __( 'Add New', 'mensenhelpen' ),
		'add_new_item'          => __( 'Add New Testimonial', 'mensenhelpen' ),
	);

	$args_testimonial = array(
		'labels'             => $labels_testimonial,
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => false,
		'rewrite'            => false,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 7,
		'menu_icon'          => 'dashicons-format-quote',
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
	);
	register_post_type( 'testimonial', $args_testimonial );

}
add_action( 'init', 'mensenhelpen_register_cpts' );

/**
 * Register Meta Boxes for Reviews (to link to products, store ratings, etc.)
 */
function mensenhelpen_add_review_meta_boxes() {
	add_meta_box(
		'mensenhelpen_review_details',
		'Review Details',
		'mensenhelpen_review_meta_box_callback',
		'review',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'mensenhelpen_add_review_meta_boxes' );

function mensenhelpen_review_meta_box_callback( $post ) {
	wp_nonce_field( 'mensenhelpen_save_review_data', 'mensenhelpen_review_meta_nonce' );

	$product_id = get_post_meta( $post->ID, '_review_product_id', true );
	$rating     = get_post_meta( $post->ID, '_review_rating', true );
	$pros       = get_post_meta( $post->ID, '_review_pros', true );
	$cons       = get_post_meta( $post->ID, '_review_cons', true );

	$products = get_posts( array(
		'post_type'      => 'product',
		'posts_per_page' => -1,
		'post_status'    => 'publish',
	) );
	?>
	<table class="form-table">
		<tr>
			<th><label for="review_product_id">Linked Product:</label></th>
			<td>
				<select name="review_product_id" id="review_product_id" class="regular-text">
					<option value="">-- Select Product --</option>
					<?php foreach ( $products as $prod ) : ?>
						<option value="<?php echo esc_attr( $prod->ID ); ?>" <?php selected( $product_id, $prod->ID ); ?>><?php echo esc_html( $prod->post_title ); ?></option>
					<?php endforeach; ?>
				</select>
			</td>
		</tr>
		<tr>
			<th><label for="review_rating">Rating (1-5):</label></th>
			<td><input type="number" id="review_rating" name="review_rating" value="<?php echo esc_attr( $rating ); ?>" min="1" max="5" class="small-text" /></td>
		</tr>
		<tr>
			<th><label for="review_pros">Pros:</label></th>
			<td><textarea id="review_pros" name="review_pros" class="large-text" rows="3"><?php echo esc_textarea( $pros ); ?></textarea></td>
		</tr>
		<tr>
			<th><label for="review_cons">Cons:</label></th>
			<td><textarea id="review_cons" name="review_cons" class="large-text" rows="3"><?php echo esc_textarea( $cons ); ?></textarea></td>
		</tr>
	</table>
	<?php
}

function mensenhelpen_save_review_meta_data( $post_id ) {
	if ( ! isset( $_POST['mensenhelpen_review_meta_nonce'] ) || ! wp_verify_nonce( $_POST['mensenhelpen_review_meta_nonce'], 'mensenhelpen_save_review_data' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['review_product_id'] ) ) {
		update_post_meta( $post_id, '_review_product_id', absint( $_POST['review_product_id'] ) );
	}
	if ( isset( $_POST['review_rating'] ) ) {
		update_post_meta( $post_id, '_review_rating', absint( $_POST['review_rating'] ) );
		
		// Update parent product average rating when a review is updated manually through admin
		$product_id = absint( $_POST['review_product_id'] );
		if ( $product_id ) {
			mensenhelpen_update_product_average_rating( $product_id );
		}
	}
	if ( isset( $_POST['review_pros'] ) ) {
		update_post_meta( $post_id, '_review_pros', sanitize_textarea_field( $_POST['review_pros'] ) );
	}
	if ( isset( $_POST['review_cons'] ) ) {
		update_post_meta( $post_id, '_review_cons', sanitize_textarea_field( $_POST['review_cons'] ) );
	}
}
add_action( 'save_post_review', 'mensenhelpen_save_review_meta_data' );

/**
 * Helper to update product average rating
 */
function mensenhelpen_update_product_average_rating( $product_id ) {
	$reviews = get_posts( array(
		'post_type'  => 'review',
		'meta_query' => array(
			array(
				'key'     => '_review_product_id',
				'value'   => $product_id,
				'compare' => '='
			)
		),
		'posts_per_page' => -1,
		'fields' => 'ids'
	) );

	if ( empty( $reviews ) ) {
		update_post_meta( $product_id, '_average_rating', 0 );
		update_post_meta( $product_id, '_review_count', 0 );
		return;
	}

	$total_rating = 0;
	$count = 0;
	foreach ( $reviews as $rev_id ) {
		$rating = (int) get_post_meta( $rev_id, '_review_rating', true );
		if ( $rating > 0 ) {
			$total_rating += $rating;
			$count++;
		}
	}

	$average = $count > 0 ? ( $total_rating / $count ) : 0;
	update_post_meta( $product_id, '_average_rating', round( $average, 1 ) );
	update_post_meta( $product_id, '_review_count', $count );
}
