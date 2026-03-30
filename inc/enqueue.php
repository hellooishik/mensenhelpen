<?php
/**
 * Enqueue scripts and styles.
 */

function mensenhelpen_scripts() {
	// Core CSS
	wp_enqueue_style( 'mensenhelpen-style', MENSENHELPEN_URI . 'assets/css/main.css', array(), MENSENHELPEN_VERSION );
	
	// Default theme style
	wp_enqueue_style( 'mensenhelpen-core-style', get_stylesheet_uri(), array(), MENSENHELPEN_VERSION );

	// Core JS
	wp_enqueue_script( 'mensenhelpen-script', MENSENHELPEN_URI . 'assets/js/main.js', array( 'jquery' ), MENSENHELPEN_VERSION, true );

	// Localize script for AJAX
	wp_localize_script( 'mensenhelpen-script', 'mensenhelpenAjax', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'nonce'   => wp_create_nonce( 'mensenhelpen_nonce' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'mensenhelpen_scripts' );
