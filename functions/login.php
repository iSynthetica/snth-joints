<?php
// Calling your own login css so you can style it
function joints_login_css() {
	// wp_enqueue_style( 'joints_login_css', get_template_directory_uri() . '/assets/css/login.css', false );
	if ( $custom_logo_id = get_theme_mod( 'custom_logo' ) ) {
		$custom_logo_img = wp_get_attachment_image_src( $custom_logo_id, 'medium' );
		$custom_logo_src = $custom_logo_img[0];
	} else {
		$custom_logo_src = 'wp-admin/images/wordpress-logo.svg?ver=20131107';
	}
	?>
	<style type="text/css">
		.login #login h1 a {
			background-image: url('<?php echo $custom_logo_src; ?>');
			background-size: contain;
			background-position: 50% 50%;
			width: auto;
			height: 120px;
		}

		body.login {
			background-color: #f1f1f1;
		<?php if ($bg_image = get_background_image()) {?> background-image: url('<?php echo $bg_image; ?>') !important;
		<?php } ?> background-repeat: repeat;
			background-position: center center;
		}
	</style>
	<?php
}

// changing the logo link from wordpress.org to your site
function joints_login_url() {  return home_url(); }

// changing the alt text on the logo to show your site name
function joints_login_title() { return get_option('blogname'); }

// calling it only on the login page
add_action( 'login_enqueue_scripts', 'joints_login_css', 10 );
add_filter('login_headerurl', 'joints_login_url');
add_filter('login_headertitle', 'joints_login_title');