<?php
/**
 * Woocommerce Functions
 */

/**
 * Output WooCommerce content.
 *
 * This function is only used in the optional 'woocommerce.php' template.
 * which people can add to their themes to add basic woocommerce support.
 * without hooks or modifying core templates.
 */
function joints_woo_content() {
	if ( is_singular( 'product' ) ) {
		woocommerce_content();
	} else {
		wc_get_template_part( 'archive', 'products' );
	}
}