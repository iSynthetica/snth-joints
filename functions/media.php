<?php
/**
 * Media files functions
 */

/**
 * Theme setup for custom post types
 */
function joints_add_image_size()
{
	add_image_size('post-archive', 460, 280, true);
	add_image_size('post-single', 810, 630, true);
}
//add_action( 'after_setup_theme', 'joints_add_image_size' );

/**
 * Display custom sizes in media select
 *
 * @param $sizes
 * @return array
 */
function joints_add_image_size_choose( $sizes )
{
	return array_merge( $sizes, array(
		'gallery-landscape' => __('Gallery landscape', 'jointswp'),
	) );
}
// add_filter( 'image_size_names_choose', 'joints_add_image_size_choose' );

/**
 * Change output for WP Gallery using LightGalleryPlugin
 *
 * @param $output
 * @param $attr
 *
 * @return string
 */
function joints_post_lightGallery($output, $attr)
{
	global $post, $wp_locale;

	static $instance = 0;
	$instance++;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => 'dl',
		'icontag'    => 'dt',
		'captiontag' => 'dd',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => ''
	), $attr));

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$include = preg_replace( '/[^0-9,]+/', '', $include );
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}

	$columns = intval($columns);
	$float = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$image_class = "module-1__column";

	$output = apply_filters('gallery_style', "
        <!-- see gallery_shortcode() in wp-includes/media.php -->
        <div id='$selector' class='gallery galleryid-{$id} lightgallery grid-layout-gallery__row gallery-columns-{$columns}'>
        ");

	$i = 1;
	$num = count($attachments);

	foreach ( $attachments as $id => $attachment ) {
		$props = get_attachment_props($id);

		if ( ! $props['url'] ) {
			continue;
		}

		if($i === $num) {
			$image_class = "module-1__column column-block end";
		}

		$link = sprintf(
			'<a href="%s" class="%s" title="%s" data-sub-html="%s">%s</a>',
			esc_url( $props['url'] ),
			esc_attr( $image_class ),
			esc_attr( $props['caption'] ),
			esc_attr( $props['caption'] ),
			wp_get_attachment_image( $id, $size, 0, $props )
		);

		$output .= $link;

		$i++;
	}

	$output .= "</div>\n";
	$output .= "<br style='clear: both;' />";

	return $output;
}
//add_filter( 'post_gallery', 'joints_post_lightGallery', 10, 2 );

/**
 * @param $attachment_id
 * @return array
 */
function joints_get_attachment_props($attachment_id, $post = false)
{
	$props = array(
		'title'   => '',
		'caption' => '',
		'url'     => '',
		'alt'     => '',
	);
	if ( $attachment_id ) {
		$attachment       = get_post( $attachment_id );
		$props['title']   = trim( strip_tags( $attachment->post_title ) );
		$props['caption'] = trim( strip_tags( $attachment->post_excerpt ) );
		$props['url']     = wp_get_attachment_url( $attachment_id );
		$props['alt']     = trim( strip_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) );

		// Alt text fallbacks
		$props['alt']     = empty( $props['alt'] ) ? $props['caption'] : $props['alt'];
		$props['alt']     = empty( $props['alt'] ) ? trim( strip_tags( $attachment->post_title ) ) : $props['alt'];
		$props['alt']     = empty( $props['alt'] ) && $post ? trim( strip_tags( get_the_title( $post->ID ) ) ) : $props['alt'];
	}

	return $props;
}

function joints_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
//add_filter('upload_mimes', 'joints_mime_types');

/** ========================================================================
 *   Add your code here
 *  ======================================================================== */