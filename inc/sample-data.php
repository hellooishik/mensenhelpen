<?php
/**
 * Sample Data Generation for MensenHelpen
 * Runs once to populate the site with realistic content.
 */

function mensenhelpen_populate_sample_data() {
	// Only run once
	if ( get_option( 'mensenhelpen_data_populated' ) ) {
		return;
	}

	// 1. Create Categories
	$categories = array( 'Skincare', 'Haircare', 'Wellness', 'Beauty Tools', 'Supplements' );
	$cat_ids = array();
	foreach ( $categories as $cat ) {
		$term = wp_insert_term( $cat, 'product_cat' );
		if ( ! is_wp_error( $term ) ) {
			$cat_ids[ $cat ] = $term['term_id'];
		}
	}

	// 2. Create Brands
	$brands = array( 'Aura', 'NatureLift', 'PureGlow' );
	$brand_ids = array();
	foreach ( $brands as $brand ) {
		$term = wp_insert_term( $brand, 'brand' );
		if ( ! is_wp_error( $term ) ) {
			$brand_ids[ $brand ] = $term['term_id'];
		}
	}

	// 3. Create Products
	$products_data = array(
		array(
			'title'    => 'Vitamin C Glow Serum',
			'content'  => 'A powerful antioxidant serum that brightens and firms the skin. Perfect for all skin types.',
			'category' => 'Skincare',
			'brand'    => 'PureGlow',
		),
		array(
			'title'    => 'Organic Argan Hair Oil',
			'content'  => 'Deeply nourish your hair with our 100% pure organic argan oil. Reduces frizz and adds shine.',
			'category' => 'Haircare',
			'brand'    => 'NatureLift',
		),
		array(
			'title'    => 'Daily Wellness Multivitamin',
			'content'  => 'Formulated with essential vitamins and minerals to support your overall health and energy.',
			'category' => 'Wellness',
			'brand'    => 'Aura',
		),
		array(
			'title'    => 'Facial Jade Roller',
			'content'  => 'Promotes lymphatic drainage and reduces puffiness. Use daily for a refreshed look.',
			'category' => 'Beauty Tools',
			'brand'    => 'PureGlow',
		)
	);

	foreach ( $products_data as $p ) {
		$post_id = wp_insert_post( array(
			'post_title'   => $p['title'],
			'post_content' => $p['content'],
			'post_status'  => 'publish',
			'post_type'    => 'product',
		) );

		if ( $post_id ) {
			// Set Category & Brand
			wp_set_object_terms( $post_id, array( $cat_ids[ $p['category'] ] ), 'product_cat' );
			wp_set_object_terms( $post_id, array( $brand_ids[ $p['brand'] ] ), 'brand' );

			// Create 2 Sample Reviews per product
			mensenhelpen_add_sample_reviews( $post_id );
		}
	}

	// 4. Create Testimonials
	$testimonials = array(
		array( 'title' => 'Sarah J.', 'content' => 'MensenHelpen is amazing! I tried an incredible night cream for free and found my new favorite brand.' ),
		array( 'title' => 'David L.', 'content' => 'A great way to discover high-quality supplements. Honest reviews from real people are so helpful.' )
	);

	foreach ( $testimonials as $t ) {
		wp_insert_post( array(
			'post_title'   => $t['title'],
			'post_content' => $t['content'],
			'post_status'  => 'publish',
			'post_type'    => 'testimonial',
		) );
	}

	update_option( 'mensenhelpen_data_populated', true );
}

function mensenhelpen_add_sample_reviews( $product_id ) {
	$review_authors = array( 'Jessica M.', 'Michael R.' );
	$pros_cons = array(
		array( 'pros' => 'Lightweight, not greasy', 'cons' => 'Small bottle', 'rating' => 5, 'text' => 'Absolutely love how this feels on my skin!' ),
		array( 'pros' => 'Effective, good scent', 'cons' => 'A bit pricey', 'rating' => 4, 'text' => 'Great product, but definitely on the expensive side if I were to buy it.' )
	);

	foreach ( $pros_cons as $index => $data ) {
		$review_id = wp_insert_post( array(
			'post_title'   => 'Great Product!',
			'post_content' => $data['text'],
			'post_status'  => 'publish',
			'post_type'    => 'review',
		) );

		if ( $review_id ) {
			update_post_meta( $review_id, '_review_product_id', $product_id );
			update_post_meta( $review_id, '_review_rating', $data['rating'] );
			update_post_meta( $review_id, '_review_pros', $data['pros'] );
			update_post_meta( $review_id, '_review_cons', $data['cons'] );
			
			// We can set the author name in the title or content if we don't have a real user
			wp_update_post( array( 'ID' => $review_id, 'post_author' => 1 ) ); // Default to admin
		}
	}
	
	// Recalculate average rating for product
	if ( function_exists( 'mensenhelpen_update_product_average_rating' ) ) {
		mensenhelpen_update_product_average_rating( $product_id );
	}
}

add_action( 'admin_init', 'mensenhelpen_populate_sample_data' );
