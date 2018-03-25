<?php
/**
 * Woocommerce Core
 */

/**
 * Add Woocommerce support to theme
 */
function woocommerce_support()
{
	add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'woocommerce_support' );

/**
 * Switched off Woocommerce styling
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
//add_filter( 'woocommerce_enqueue_styles', 'joints_woo_dequeue_styles' );

function joints_woo_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
	unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
	unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
	return $enqueue_styles;
}

require_once(get_template_directory().'/functions/woo-hooks.php');
require_once(get_template_directory().'/functions/woo-functions.php');