<?php
/**
 * MensenHelpen Theme Functions
 */

if ( ! defined( 'MENSENHELPEN_VERSION' ) ) {
	define( 'MENSENHELPEN_VERSION', '1.00.001' );
}

define( 'MENSENHELPEN_DIR', trailingslashit( get_template_directory() ) );
define( 'MENSENHELPEN_URI', trailingslashit( get_template_directory_uri() ) );

/**
 * Theme Setup
 */
function mensenhelpen_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Register Navigation Menus
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'mensenhelpen' ),
		'footer'  => esc_html__( 'Footer Menu', 'mensenhelpen' ),
	) );

	// Switch default core markup to HTML5
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	) );

	// Custom Logo
	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 250,
		'flex-width'  => true,
		'flex-height' => true,
	) );
}
add_action( 'after_setup_theme', 'mensenhelpen_setup' );

/**
 * Required Files
 */
$mensenhelpen_includes = array(
	'inc/enqueue.php',           // Enqueue scripts and styles
	'inc/custom-post-types.php', // Register CPTs
	'inc/taxonomies.php',        // Register Taxonomies
	'inc/user-roles-meta.php',   // User roles and meta management
	'inc/ajax.php',              // AJAX handling
	'inc/sample-data.php',       // Sample data generation
);

foreach ( $mensenhelpen_includes as $file ) {
	$filepath = MENSENHELPEN_DIR . $file;
	if ( file_exists( $filepath ) ) {
		require_once $filepath;
	}
}

/**
 * Get high-quality image for a category
 */
function mensenhelpen_get_category_image( $category_name ) {
	$images = array(
		'Skincare'      => 'https://images.unsplash.com/photo-1556228720-195a672e8a03?auto=format&fit=crop&w=800&q=80',
		'Haircare'      => 'https://images.unsplash.com/photo-1522337660859-026c2438590d?auto=format&fit=crop&w=800&q=80',
		'Wellness'      => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?auto=format&fit=crop&w=800&q=80',
		'Beauty Tools'  => 'https://images.unsplash.com/photo-1522338242992-e1a54906a8da?auto=format&fit=crop&w=800&q=80',
		'Supplements'   => 'https://images.unsplash.com/photo-1584017945516-24ba7e44040a?auto=format&fit=crop&w=800&q=80',
		'Body Care'     => 'https://images.unsplash.com/photo-1552046122-03184de85e08?auto=format&fit=crop&w=800&q=80',
	);

	return isset( $images[ $category_name ] ) ? $images[ $category_name ] : 'https://images.unsplash.com/photo-1556228720-195a672e8a03?auto=format&fit=crop&w=800&q=80';
}
