<?php
/**
 * Register Taxonomies
 */

function mensenhelpen_register_taxonomies() {

	// 1. Product Categories (Hierarchical)
	$labels_cat = array(
		'name'                       => _x( 'Categories', 'Taxonomy General Name', 'mensenhelpen' ),
		'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'mensenhelpen' ),
		'menu_name'                  => __( 'Categories', 'mensenhelpen' ),
		'all_items'                  => __( 'All Categories', 'mensenhelpen' ),
		'parent_item'                => __( 'Parent Category', 'mensenhelpen' ),
		'parent_item_colon'          => __( 'Parent Category:', 'mensenhelpen' ),
		'new_item_name'              => __( 'New Category Name', 'mensenhelpen' ),
		'add_new_item'               => __( 'Add New Category', 'mensenhelpen' ),
		'edit_item'                  => __( 'Edit Category', 'mensenhelpen' ),
		'update_item'                => __( 'Update Category', 'mensenhelpen' ),
		'view_item'                  => __( 'View Category', 'mensenhelpen' ),
		'separate_items_with_commas' => __( 'Separate categories with commas', 'mensenhelpen' ),
		'add_or_remove_items'        => __( 'Add or remove categories', 'mensenhelpen' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'mensenhelpen' ),
		'popular_items'              => __( 'Popular Categories', 'mensenhelpen' ),
		'search_items'               => __( 'Search Categories', 'mensenhelpen' ),
		'not_found'                  => __( 'Not Found', 'mensenhelpen' ),
		'no_terms'                   => __( 'No categories', 'mensenhelpen' ),
		'items_list'                 => __( 'Categories list', 'mensenhelpen' ),
		'items_list_navigation'      => __( 'Categories list navigation', 'mensenhelpen' ),
	);
	$args_cat = array(
		'labels'                     => $labels_cat,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => array( 'slug' => 'product-category' ),
		'show_in_rest'               => true,
	);
	register_taxonomy( 'product_cat', array( 'product' ), $args_cat );

	// 2. Brands (Non-Hierarchical, like tags but specific to products)
	$labels_brand = array(
		'name'                       => _x( 'Brands', 'Taxonomy General Name', 'mensenhelpen' ),
		'singular_name'              => _x( 'Brand', 'Taxonomy Singular Name', 'mensenhelpen' ),
		'menu_name'                  => __( 'Brands', 'mensenhelpen' ),
		'all_items'                  => __( 'All Brands', 'mensenhelpen' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'new_item_name'              => __( 'New Brand Name', 'mensenhelpen' ),
		'add_new_item'               => __( 'Add New Brand', 'mensenhelpen' ),
		'edit_item'                  => __( 'Edit Brand', 'mensenhelpen' ),
		'update_item'                => __( 'Update Brand', 'mensenhelpen' ),
		'view_item'                  => __( 'View Brand', 'mensenhelpen' ),
		'separate_items_with_commas' => __( 'Separate brands with commas', 'mensenhelpen' ),
		'add_or_remove_items'        => __( 'Add or remove brands', 'mensenhelpen' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'mensenhelpen' ),
		'popular_items'              => __( 'Popular Brands', 'mensenhelpen' ),
		'search_items'               => __( 'Search Brands', 'mensenhelpen' ),
		'not_found'                  => __( 'Not Found', 'mensenhelpen' ),
		'no_terms'                   => __( 'No brands', 'mensenhelpen' ),
		'items_list'                 => __( 'Brands list', 'mensenhelpen' ),
		'items_list_navigation'      => __( 'Brands list navigation', 'mensenhelpen' ),
	);
	$args_brand = array(
		'labels'                     => $labels_brand,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => array( 'slug' => 'brand' ),
		'show_in_rest'               => true,
	);
	register_taxonomy( 'brand', array( 'product' ), $args_brand );

}
add_action( 'init', 'mensenhelpen_register_taxonomies' );
