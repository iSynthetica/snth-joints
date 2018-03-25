<?php
/**
 * Helper functions
 *
 * @package WordPress
 * @subpackage SnthJointsWP
 * @since 0.0.1
 * @version 0.0.1
 */

/**
 * Get current request type
 *
 * @param $type
 *
 * @return bool
 */
function joints_is_request( $type )
{
	switch ( $type ) {
		case 'admin' :
			return is_admin();
		case 'ajax' :
			return defined( 'DOING_AJAX' );
		case 'cron' :
			return defined( 'DOING_CRON' );
		case 'frontend' :
			return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
	}
}

/**
 * Checks if a plugin is activated
 *
 * @link https://codex.wordpress.org/Function_Reference/is_plugin_active
 *
 * @param $plugin
 *
 * @return mixed
 */
function joints_is_plugin_active( $plugin )
{
	if ( joints_is_request( 'frontend' ) ) {
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	}

	return is_plugin_active( $plugin );
}

/**
 * Checks if a woocommerce is activated
 *
 * @link https://codex.wordpress.org/Function_Reference/is_plugin_active
 *
 * @return mixed
 */
function joints_is_woocommerce_active()
{
	return joints_is_plugin_active ( 'woocommerce/woocommerce.php' );
}