<?php
/**
 * Enqueueing styles and script
 */

/**
 * Enqueue script & styles
 */
function joints_site_scripts() {
	global $wp_styles; // Call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

	// Adding scripts file in the footer
	wp_enqueue_script( 'site-js', get_template_directory_uri() . '/assets/scripts/scripts.js', array( 'jquery' ), JOINTS_VERSION, true );

	// Register main stylesheet
	wp_enqueue_style( 'site-css', get_template_directory_uri() . '/assets/styles/style.css', array(), JOINTS_VERSION, 'all' );

	// Comment reply script for threaded comments
	if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_localize_script( 'site-js', 'jointsJsObj', array(
		'ajaxurl'       => admin_url( 'admin-ajax.php' ),
		'nonce'         => wp_create_nonce( 'joints_nonce' ),
	) );
}
add_action('wp_enqueue_scripts', 'joints_site_scripts', 999);