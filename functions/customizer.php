<?php

/**
 * Create Mobile Logo Setting and Upload Control
 */
function joints_small_logo_customizer_settings( $wp_customize ) {
	// add a setting for the site logo
	$wp_customize->add_setting('custom_small_logo');
	// Add a control to upload the logo
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'custom_small_logo',
		array(
			'label' => __('Small Header Logo', 'jointswp'),
			'section' => 'title_tagline',
			'settings' => 'custom_small_logo',
		) ) );
}
//add_action('customize_register', 'joints_small_logo_customizer_settings');

/**
 * Create Mobile Logo Setting and Upload Control
 */
function joints_mobile_logo_customizer_settings( $wp_customize ) {
	// add a setting for the site logo
	$wp_customize->add_setting('custom_mobile_logo');
	// Add a control to upload the logo
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'custom_mobile_logo',
		array(
			'label' => 'Mobile Logo',
			'section' => 'title_tagline',
			'settings' => 'custom_mobile_logo',
		) ) );
}
//add_action('customize_register', 'joints_mobile_logo_customizer_settings');

/**
 * Create Sticky Logo Setting and Upload Control
 */
function joints_sticky_logo_customizer_settings( $wp_customize ) {
	// add a setting for the site logo
	$wp_customize->add_setting('custom_sticky_logo');
	// Add a control to upload the logo
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'custom_sticky_logo',
		array(
			'label' => 'Sticky Menu Logo',
			'section' => 'title_tagline',
			'settings' => 'custom_sticky_logo',
		) ) );
}
//add_action('customize_register', 'joints_sticky_logo_customizer_settings');

/**
 * Create Footer Logo Setting and Upload Control
 */
function joints_footer_logo_customizer_settings( $wp_customize ) {
	// add a setting for the site logo
	$wp_customize->add_setting('custom_footer_logo');
	// Add a control to upload the logo
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'custom_footer_logo',
		array(
			'label' => 'Footer Logo',
			'section' => 'title_tagline',
			'settings' => 'custom_footer_logo',
		) ) );
}
//add_action('customize_register', 'joints_footer_logo_customizer_settings');