<?php

/**
 * Process mini cart
 * Class WMC_Frontend_Mini_Cart
 */
class WMC_Frontend_Shipping {
	function __construct() {
		if ( ! is_admin()  ) {
			global $wpdb;

			$raw_methods_sql = "SELECT method_id, method_order, instance_id, is_enabled FROM {$wpdb->prefix}woocommerce_shipping_zone_methods WHERE is_enabled = 1 order by instance_id ASC;";
			$raw_methods     = $wpdb->get_results( $raw_methods_sql );
			if ( count( $raw_methods ) ) {
				foreach ( $raw_methods as $method ) {
					if ( $method->method_id == 'free_shipping' ) {
						add_filter( 'option_woocommerce_' . trim( $method->method_id ) . '_' . intval( $method->instance_id ) . '_settings', array( $this, 'free_cost' ) );
					}
				}
			}
			add_filter( 'woocommerce_package_rates', array( $this, 'woocommerce_package_rates' ) );
		}
	}

	/**
	 * Shipping cost
	 *
	 * @param $methods
	 *
	 * @return mixed
	 */
	public function woocommerce_package_rates( $methods ) {
		//		print_r($data);
		if ( count( array_filter( $methods ) ) ) {
			foreach ( $methods as $k => $method ) {
				$method->cost = wmc_get_price( $method->cost );
				if ( count( $method->taxes ) ) {
					foreach ( $method->taxes as $k => $tax ) {
						$method->taxes[$k] = wmc_get_price( $tax );
					}
				}
			}
		}

		return $methods;
	}

	/**
	 * Tax on free ship
	 *
	 * @param $data
	 *
	 * @return mixed
	 */
	public function free_cost( $data ) {
		if ( ! get_option( 'woocommerce_currency' ) != '' ) {
			return $data;
		}

		if ( isset( $data['min_amount'] ) ) {
			$data['min_amount'] = wmc_get_price( $data['min_amount'] );
		}

		return $data;
	}
}

new WMC_Frontend_Shipping();