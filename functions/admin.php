<?php
// This file handles the admin area and functions - You can use this file to make changes to the dashboard.

/************* DASHBOARD WIDGETS *****************/
// Disable default dashboard widgets
function disable_default_dashboard_widgets() {
	// Remove_meta_box('dashboard_right_now', 'dashboard', 'core');    // Right Now Widget
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core'); // Comments Widget
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');  // Incoming Links Widget
	remove_meta_box('dashboard_plugins', 'dashboard', 'core');         // Plugins Widget

	// Remove_meta_box('dashboard_quick_press', 'dashboard', 'core');  // Quick Press Widget
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');   // Recent Drafts Widget
	remove_meta_box('dashboard_primary', 'dashboard', 'core');         //
	remove_meta_box('dashboard_secondary', 'dashboard', 'core');       //

	// Removing plugin dashboard boxes
	remove_meta_box('yoast_db_widget', 'dashboard', 'normal');         // Yoast's SEO Plugin Widget

}

/*
For more information on creating Dashboard Widgets, view:
http://digwp.com/2010/10/customize-wordpress-dashboard/
*/

// RSS Dashboard Widget
function joints_rss_dashboard_widget() {
	if(function_exists('fetch_feed')) {
		include_once(ABSPATH . WPINC . '/feed.php');               // include the required file
		$feed = fetch_feed('http://jointswp.com/feed/rss/');        // specify the source feed
		$limit = $feed->get_item_quantity(5);                      // specify number of items
		$items = $feed->get_items(0, $limit);                      // create an array of items
	}
	if ($limit == 0) echo '<div>' . __( 'The RSS Feed is either empty or unavailable.', 'jointswp' ) . '</div>';   // fallback message
	else foreach ($items as $item) { ?>

	<h4 style="margin-bottom: 0;">
		<a href="<?php echo $item->get_permalink(); ?>" title="<?php echo mysql2date(__('j F Y @ g:i a', 'jointswp'), $item->get_date('Y-m-d H:i:s')); ?>" target="_blank">
			<?php echo $item->get_title(); ?>
		</a>
	</h4>
	<p style="margin-top: 0.5em;">
		<?php echo substr($item->get_description(), 0, 200); ?>
	</p>
	<?php }
}

// Calling all custom dashboard widgets
function joints_custom_dashboard_widgets() {
	wp_add_dashboard_widget('joints_rss_dashboard_widget', __('Custom RSS Feed (Customize in admin.php)', 'jointswp'), 'joints_rss_dashboard_widget');
	/*
	Be sure to drop any other created Dashboard Widgets
	in this function and they will all load.
	*/
}
// removing the dashboard widgets
add_action('admin_menu', 'disable_default_dashboard_widgets');
// adding any custom widgets
add_action('wp_dashboard_setup', 'joints_custom_dashboard_widgets');

/************* CUSTOMIZE ADMIN *******************/
// Custom Backend Footer
function joints_custom_admin_footer() {
	_e('<span id="footer-thankyou">Developed by <a href="#" target="_blank">Your Site Name</a></span>.', 'jointswp');
}

// adding it to the admin area
add_filter('admin_footer_text', 'joints_custom_admin_footer');

/**
 * Add admin area style
 */
function joints_admin_style() {
	?>
    <style>

    </style>
	<?php
}
add_action('admin_head', 'joints_admin_style');


/**
 * Hide admin menues items
 */
function joints_hide_admin_menues()
{
	remove_menu_page('tools.php');
	remove_menu_page('edit-comments.php');
	remove_menu_page('link-manager.php');
	//remove_menu_page('plugins.php');
	remove_menu_page('options-general.php');
	//remove_menu_page('themes.php');
	remove_menu_page('users.php');
	//remove_menu_page('wpcf7');
	remove_menu_page('cptui_main_menu');
	remove_menu_page('sb-instagram-feed');
	remove_menu_page('jetpack' );
	remove_menu_page('tinvwl' );
}

/**
 * Hide admin ACF menu item
 *
 * @param $show
 *
 * @return bool
 */
function joints_hide_admin_menu_acf( $show ) {

	return false;

}

$current_user = wp_get_current_user();
$current_user_email = $current_user->user_email;

if( 'syntheticafreon@gmail.com' !== $current_user_email ) {
	//add_action('admin_menu', 'joints_hide_admin_menues', 999);
	//add_filter('acf/settings/show_admin', 'joints_hide_admin_menu_acf');
}