<?php
/**
 * WooCommerce All Currencies - Core
 *
 * @version 2.1.1
 * @since   2.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_All_Currencies_Core' ) ) :

class Alg_WC_All_Currencies_Core {

	/**
	 * Constructor.
	 *
	 * @version 2.1.1
	 * @todo    custom currencies
	 * @todo    (maybe) virtual currencies
	 * @todo    (maybe) remove country currencies (as it is already included in current WC version)
	 * @todo    (maybe) rename plugin to "Currencies for WooCommerce"
	 */
	function __construct() {
		if ( 'yes' === get_option( 'alg_wc_all_currencies_enabled', 'yes' ) ) {
			add_filter( 'woocommerce_currencies',      array( $this, 'add_all_currencies'),     PHP_INT_MAX );
			add_filter( 'woocommerce_currency_symbol', array( $this, 'change_currency_symbol'), PHP_INT_MAX, 2 );
			$this->symbols = alg_wcac_get_all_currencies_symbols();
		}
	}

	/**
	 * get_default_currency_symbol.
	 *
	 * @version 2.1.1
	 * @since   2.1.1
	 */
	function get_default_currency_symbol( $code = '', $default_symbol = '' ) {
		if ( '' != ( $woocommerce_default_symbol = $this->get_original_woocommerce_currency_symbol( $code ) ) ) {
			return $woocommerce_default_symbol;
		} else {
			if ( '' == $default_symbol ) {
				if ( '' == $code ) {
					$code = get_woocommerce_currency();
				}
				if ( isset( $this->symbols[ $code ] ) ) {
					return $this->symbols[ $code ];
				}
			}
			return $default_symbol;
		}
	}

	/**
	 * get_original_woocommerce_currency_symbol.
	 *
	 * @version 2.1.1
	 * @since   2.1.1
	 */
	function get_original_woocommerce_currency_symbol( $code = '' ) {
		remove_filter( 'woocommerce_currency_symbol', array( $this, 'change_currency_symbol'), PHP_INT_MAX, 2 );
		$symbol = get_woocommerce_currency_symbol( $code );
		add_filter(    'woocommerce_currency_symbol', array( $this, 'change_currency_symbol'), PHP_INT_MAX, 2 );
		return $symbol;
	}

	/**
	 * add_all_currencies.
	 *
	 * @version 2.1.0
	 */
	function add_all_currencies( $default_currencies ) {
		$currencies = alg_wcac_get_all_currencies_names();
		foreach( $currencies as $code => $name ) {
			$default_currencies[ $code ] = $name;
		}
		asort( $default_currencies );
		return $default_currencies;
	}

	/**
	 * change_currency_symbol.
	 *
	 * @version 2.1.1
	 */
	function change_currency_symbol( $currency_symbol, $currency ) {
		// Hide symbol
		if ( 'yes' === get_option( 'alg_wc_all_currencies_hide_symbol', 'no' ) ) {
			if ( ( defined( 'DOING_AJAX' ) && DOING_AJAX ) || ! is_admin() ) {
				// if frontend, then return empty symbol
				return '';
			}
		}
		// Code as symbol
		if ( 'yes' === get_option( 'alg_wc_all_currencies_use_code_as_symbol', 'no' ) ) {
			return $currency;
		}
		// Default symbol
		if ( '' == $currency_symbol ) {
			if ( isset( $this->symbols[ $currency ] ) ) {
				$currency_symbol = $this->symbols[ $currency ];
			}
		}
		// Final result
		return apply_filters( 'alg_wc_all_currencies_filter', $currency_symbol, 'value_symbol', array( 'currency_code' => $currency ) );
	}
}

endif;

return new Alg_WC_All_Currencies_Core();
