<?php
/**
 * Mass Product Seeding for MensenHelpen
 * Adds 100 products across 4 categories.
 */

function mensenhelpen_mass_seed_products() {
    // Check if we've already run this to prevent duplicate 100 products
    if ( get_option( 'mensenhelpen_mass_seeding_complete' ) ) {
        return;
    }

    $categories = array( 'Skincare', 'Haircare', 'Wellness', 'Beauty Tools' );
    $brands = array( 'Aura', 'NatureLift', 'PureGlow', 'Ethereal', 'Vitality' );

    // Ensure categories and brands exist
    $cat_ids = array();
    foreach ( $categories as $cat ) {
        $term = term_exists( $cat, 'product_cat' );
        if ( ! $term ) {
            $term = wp_insert_term( $cat, 'product_cat' );
        }
        $cat_ids[ $cat ] = is_array( $term ) ? $term['term_id'] : $term;
    }

    $brand_ids = array();
    foreach ( $brands as $brand ) {
        $term = term_exists( $brand, 'brand' );
        if ( ! $term ) {
            $term = wp_insert_term( $brand, 'brand' );
        }
        $brand_ids[ $brand ] = is_array( $term ) ? $term['term_id'] : $term;
    }

    // Helper data for generating names
    $adjectives = array( 'Organic', 'Natural', 'Pure', 'Advanced', 'Ultra', 'Premium', 'Essential', 'Radiant', 'Soothing', 'Revitalizing', 'Deep', 'Clinical', 'Daily', 'Night', 'Pro-Grade' );
    
    $data_map = array(
        'Skincare' => array(
            'nouns' => array( 'Serum', 'Moisturizer', 'Cleanser', 'Facial Oil', 'Night Cream', 'Eye Balm', 'Toner', 'Exfoliant', 'Mask', 'Sunscreen' ),
            'image_query' => 'https://images.unsplash.com/photo-1556228720-195a672e8a03?auto=format&fit=crop&w=800&q=80'
        ),
        'Haircare' => array(
            'nouns' => array( 'Shampoo', 'Conditioner', 'Hair Mask', 'Leave-in Treatment', 'Growth Serum', 'Scalp Scrub', 'Smoothing Cream', 'Volume Spray' ),
            'image_query' => 'https://images.unsplash.com/photo-1522337660859-026c2438590d?auto=format&fit=crop&w=800&q=80'
        ),
        'Wellness' => array(
            'nouns' => array( 'Supplement', 'Multivitamin', 'Sleep Aid', 'Digestive Enzyme', 'Protein Powder', 'Infusion', 'Energy Drops' ),
            'image_query' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?auto=format&fit=crop&w=800&q=80'
        ),
        'Beauty Tools' => array(
            'nouns' => array( 'Jade Roller', 'Gua Sha', 'Facial Steamer', 'Micro-needle Roller', 'Silicone Brush', 'LED Mask', 'Curling Wand' ),
            'image_query' => 'https://images.unsplash.com/photo-1522338242992-e1a54906a8da?auto=format&fit=crop&w=800&q=80'
        )
    );

    // Track products created per category
    $count_per_cat = 25;
    
    require_once(ABSPATH . 'wp-admin/includes/media.php');
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/image.php');

    foreach ( $categories as $cat ) {
        for ( $i = 1; $i <= $count_per_cat; $i++ ) {
            $adj = $adjectives[ array_rand( $adjectives ) ];
            $noun = $data_map[ $cat ]['nouns'][ array_rand( $data_map[ $cat ]['nouns'] ) ];
            $brand_name = $brands[ array_rand( $brands ) ];
            
            $title = "$adj $noun";
            $content = "Experience the best in $cat with our $title. Formulated by $brand_name experts, this product combines high-quality ingredients with modern science to deliver visible results. Perfect for your daily routine.";
            
            $post_id = wp_insert_post( array(
                'post_title'   => $title,
                'post_content' => $content,
                'post_status'  => 'publish',
                'post_type'    => 'product',
            ) );

            if ( $post_id && ! is_wp_error( $post_id ) ) {
                // Set Category & Brand
                wp_set_object_terms( $post_id, array( (int) $cat_ids[ $cat ] ), 'product_cat' );
                wp_set_object_terms( $post_id, array( (int) $brand_ids[ $brand_name ] ), 'brand' );

                // Add 2 reviews using existing logic if available
                if ( function_exists( 'mensenhelpen_add_sample_reviews' ) ) {
                    mensenhelpen_add_sample_reviews( $post_id );
                }

                // Sideload Image (We use specific category images but could randomize)
                $img_url = $data_map[ $cat ]['image_query'] . "&sig=" . $post_id;
                $attachment_id = media_sideload_image( $img_url, $post_id, $title, 'id' );
                
                if ( ! is_wp_error( $attachment_id ) ) {
                    set_post_thumbnail( $post_id, $attachment_id );
                }
            }
        }
    }

    update_option( 'mensenhelpen_mass_seeding_complete', true );
}

add_action( 'admin_init', 'mensenhelpen_mass_seed_products' );
