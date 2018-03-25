<?php
/**
 * Content functions
 *
 * @package WordPress
 * @subpackage SnthJointsWP
 * @since 0.0.1
 * @version 0.0.1
 */

/**
 * Show templates passing attributes and including the file.
 *
 * @param string $template_name
 * @param array $args
 * @param string $template_path
 */
function joints_show_template($template_name, $args = array(), $template_path = 'parts')
{
	if (!empty($args) && is_array($args)) {
		extract($args);
	}

	$located = joints_locate_template($template_name, $template_path);

	if (!file_exists($located)) {
		return;
	}

	include($located);
}

/**
 * Like show, but returns the HTML instead of outputting.
 *
 * @param $template_name
 * @param array $args
 * @param string $template_path
 * @param string $default_path
 * @return string
 */
function joints_get_template($template_name, $args = array(), $template_path = 'parts')
{
	ob_start();
	joints_show_template($template_name, $args, $template_path);
	return ob_get_clean();
}

/**
 * Locate a template and return the path for inclusion.
 *
 * @param $template_name
 * @param string $template_path
 * @return string
 */
function joints_locate_template($template_name, $template_path = 'parts')
{
	if (!$template_path) {
		$template_path = 'parts';
	}

	$template = locate_template(
		array(
			trailingslashit($template_path) . $template_name,
			$template_name
		)
	);

	return $template;
}