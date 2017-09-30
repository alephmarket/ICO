<?php

/**
 * Process mini cart
 * Class WMC_Frontend_Mini_Cart
 */
class WMC_Frontend_Mini_Cart {
	function __construct() {
		add_action( 'woocommerce_cart_loaded_from_session', array( $this, 'woocommerce_before_mini_cart' ), 99);
	}

	/**
	 * Recalculator for mini cart
	 */
	public function woocommerce_before_mini_cart() {

		WC()->cart->calculate_totals();
	}
}

new WMC_Frontend_Mini_Cart();