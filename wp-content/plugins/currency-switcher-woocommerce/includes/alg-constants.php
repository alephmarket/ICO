<?php
/**
 * WooCommerce Currency Switcher Constants
 *
 * The WooCommerce Currency Switcher Constants.
 *
 * @version 2.3.0
 * @since   2.3.0
 * @author  Tom Anbinder
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// WooCommerce version constants
if ( ! defined( 'ALG_WC_VERSION' ) ) {
	define( 'ALG_WC_VERSION', get_option( 'woocommerce_version', null ) );
}

if ( ! defined( 'ALG_IS_WC_VERSION_BELOW_3' ) ) {
	define( 'ALG_IS_WC_VERSION_BELOW_3', version_compare( ALG_WC_VERSION, '3.0.0', '<' ) );
}

// WooCommerce price filters constants
if ( ! defined( 'ALG_PRODUCT_GET_PRICE_FILTER' ) ) {
	$filter = ( ALG_IS_WC_VERSION_BELOW_3 ) ? 'woocommerce_get_price'         : 'woocommerce_product_get_price';
	define( 'ALG_PRODUCT_GET_PRICE_FILTER', $filter );
}

if ( ! defined( 'ALG_PRODUCT_GET_SALE_PRICE_FILTER' ) ) {
	$filter = ( ALG_IS_WC_VERSION_BELOW_3 ) ? 'woocommerce_get_sale_price'    : 'woocommerce_product_get_sale_price';
	define( 'ALG_PRODUCT_GET_SALE_PRICE_FILTER', $filter );
}

if ( ! defined( 'ALG_PRODUCT_GET_REGULAR_PRICE_FILTER' ) ) {
	$filter = ( ALG_IS_WC_VERSION_BELOW_3 ) ? 'woocommerce_get_regular_price' : 'woocommerce_product_get_regular_price';
	define( 'ALG_PRODUCT_GET_REGULAR_PRICE_FILTER', $filter );
}