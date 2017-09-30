<?php

/**
 * Process Coupon code
 * Class WMC_Frontend_Coupon
 */
class WMC_Frontend_Coupon {
	public function __construct() {
		add_filter( 'woocommerce_coupon_validate_minimum_amount', array( $this, 'woocommerce_coupon_validate_minimum_amount' ), 10, 2 );
		add_filter( 'woocommerce_coupon_validate_maximum_amount', array( $this, 'woocommerce_coupon_validate_maximum_amount' ), 10, 2 );
	}

	public function woocommerce_coupon_validate_minimum_amount( $data, $obj ) {

		if ( wc_format_decimal( wmc_get_price( $obj->minimum_amount ) ) < WC()->cart->get_displayed_subtotal() ) {
			return false;
		}

		return $data;
	}

	public function woocommerce_coupon_validate_maximum_amount( $data, $obj ) {

		if ( wc_format_decimal( wmc_get_price( $obj->maximum_amount ) ) > WC()->cart->get_displayed_subtotal() ) {
			return false;
		}

		return $data;
	}

	public function woocommerce_coupon_get_discount_amount( $data ) {
		//		print_r($data);
		return wmc_get_price( $data );
	}
}

new WMC_Frontend_Coupon();