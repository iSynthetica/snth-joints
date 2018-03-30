<?php
/**
 * functions.php
 *
 * For more info: https://developer.wordpress.org/themes/basics/theme-functions/
 */

$the_theme = wp_get_theme();
$theme_version = $the_theme->get( 'Version' );

define ('JOINTS_VERSION', $theme_version);

define('JOINTS_DIR', get_template_directory());
define('JOINTS_URL', get_template_directory_uri());

define ('JOINTS_ASSETS', JOINTS_DIR.'/assets');
define ('JOINTS_ASSETS_URL', JOINTS_URL.'/assets');

define ('JOINTS_STYLES', JOINTS_ASSETS.'/styles');
define ('JOINTS_STYLES_URL', JOINTS_ASSETS_URL.'/styles');
define ('JOINTS_SCRIPTS', JOINTS_ASSETS.'/scripts');
define ('JOINTS_SCRIPTS_URL', JOINTS_ASSETS_URL.'/scripts');
define ('JOINTS_IMAGES', JOINTS_ASSETS.'/images');
define ('JOINTS_IMAGES_URL', JOINTS_ASSETS_URL.'/images');
define ('JOINTS_FONTS', JOINTS_ASSETS.'/fonts');
define ('JOINTS_FONTS_URL', JOINTS_ASSETS_URL.'/fonts');

define ('JOINTS_INCLUDES', JOINTS_DIR.'/includes');
define ('JOINTS_INCLUDES_URL', JOINTS_URL.'/includes');

//Helpers functions
require_once(JOINTS_DIR.'/functions/helpers.php');

// Theme support options
require_once(JOINTS_DIR.'/functions/theme-support.php');

// Media files
require_once(JOINTS_DIR.'/functions/media.php');

// WP Head and other cleanup functions
require_once(JOINTS_DIR.'/functions/cleanup.php');

// Register scripts and stylesheets
require_once(JOINTS_DIR.'/functions/enqueue-scripts.php');

// Register custom menus and menu walkers
require_once(JOINTS_DIR.'/functions/menu.php');

// Register sidebars/widget areas
require_once(JOINTS_DIR.'/functions/sidebar.php');

// Makes WordPress comments suck less
require_once(JOINTS_DIR.'/functions/comments.php');

// Replace 'older/newer' post links with numbered navigation
require_once(JOINTS_DIR.'/functions/page-navi.php');

// Adds support for multiple languages
require_once(JOINTS_DIR.'/functions/translation/translation.php');

if ( joints_is_woocommerce_active() ) {
	require_once(JOINTS_DIR.'/functions/woo.php');
}

// Adds site styles to the WordPress editor
// require_once(JOINTS_DIR.'/functions/editor-styles.php');

// Remove Emoji Support
require_once(JOINTS_DIR.'/functions/disable-emoji.php');

// Related post function - no need to rely on plugins
// require_once(JOINTS_DIR.'/functions/related-posts.php');

// Use this as a template for custom post types
// require_once(JOINTS_DIR.'/functions/custom-post-type.php');

// Customize the WordPress login menu
require_once(JOINTS_DIR.'/functions/login.php');

// Customize the WordPress admin
require_once(JOINTS_DIR.'/functions/admin.php');
