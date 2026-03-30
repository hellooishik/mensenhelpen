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
);

foreach ( $mensenhelpen_includes as $file ) {
	$filepath = MENSENHELPEN_DIR . $file;
	if ( file_exists( $filepath ) ) {
		require_once $filepath;
	}
}
