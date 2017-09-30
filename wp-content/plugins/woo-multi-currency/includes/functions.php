<?php
if ( ! function_exists( 'wmc_check_vpro' ) ) {
	/**
	 * Check pro version
	 * @return bool
	 */
	function wmc_check_vpro() {
		if ( is_plugin_active( 'woo-multi-currency-pro/woo-multi-currency-pro.php' ) ) {
			return true;
		}

		return false;
	}
}
if ( ! function_exists( 'wmc_get_price' ) ) {
	function wmc_get_price( $price ) {
		if ( is_admin() ) {
			return $price;
		}
		$allow_multi_pay = get_option( 'wmc_allow_multi', 'no' );

		if ( $allow_multi_pay == 'yes' ) {

		} else {

			if ( is_checkout() ) {
				return $price;
			}

		}

		if ( get_option( 'woocommerce_currency' ) != '' ) {
			$main_currency    = get_option( 'woocommerce_currency' );
			$current_currency = $main_currency;
		} else {
			return $price;
		}

		/*Check currency*/
		$selected_currencies = get_option( 'wmc_selected_currencies', array() );
		if ( isset( $_GET['wmc_current_currency'] ) && array_key_exists( $_GET['wmc_current_currency'], $selected_currencies ) ) {
			$current_currency = $_GET['wmc_current_currency'];
		} elseif ( isset( $_COOKIE['wmc_current_currency'] ) && array_key_exists( $_COOKIE['wmc_current_currency'], $selected_currencies ) ) {
			$current_currency = $_COOKIE['wmc_current_currency'];
		} else {
			return $price;
		}

		if ( $price ) {
			$price = $price * $selected_currencies[$current_currency]['rate'];
		}

		return $price;
	}
}