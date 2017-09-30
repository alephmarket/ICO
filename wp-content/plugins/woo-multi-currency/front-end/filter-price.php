<?php

/**
 * Process mini cart
 * Class WMC_Frontend_Filter_Price
 */
class WMC_Frontend_Filter_Price {
	function __construct() {
		//add_filter( 'woocommerce_price_filter_results', array( $this, 'woocommerce_price_filter_results' ), 10, 3 );

		add_filter( 'woocommerce_product_query_meta_query', array( $this, 'woocommerce_product_query_meta_query' ) );

	}

	public function woocommerce_product_query_meta_query( $query ) {
		$main_currency    = get_option( 'woocommerce_currency' );
		$current_currency = $this->get_current_currency();

		if ( $main_currency != $current_currency ) {
			$selected_currencies = get_option( 'wmc_selected_currencies' );

			if ( isset( $query['price_filter'] ) ) {
				if ( isset( $query['price_filter']['value'][0] ) ) {
					$query['price_filter']['value'][0] = intval( $query['price_filter']['value'][0] / $selected_currencies[$current_currency]['rate'] );
				}
				if ( isset( $query['price_filter']['value'][1] ) ) {
					$query['price_filter']['value'][1] = intval( $query['price_filter']['value'][1] / $selected_currencies[$current_currency]['rate'] );
				}
			}

		}

		return $query;
	}

	/**
	 * Override filter price
	 *
	 * @param $data_query
	 * @param $min_class
	 * @param $max_class
	 *
	 * @return array|null|object
	 */
	public function woocommerce_price_filter_results( $data_query, $min_class, $max_class ) {
		global $wpdb;
		$fix_value        = 0;
		$options          = get_option( 'wmc_selected_currencies' );
		$current_currency = isset( $_COOKIE['wmc_current_currency'] ) ? $_COOKIE['wmc_current_currency'] : get_option( 'woocommerce_currency' );;
		if ( isset( $options[$current_currency]['rate'] ) ) {
			if ( $options[$current_currency]['rate'] != 1 ) {
				$fix_value = 1;
			}
		}
		if ( $options[$current_currency]['rate'] ) {
			$min_class = $min_class / $options[$current_currency]['rate'] - $fix_value;
			$max_class = $max_class / $options[$current_currency]['rate'] + $fix_value;
		} else {
			$min_class = 0;
			$max_class = 0;
		}


		if ( wc_tax_enabled() && 'incl' === get_option( 'woocommerce_tax_display_shop' ) && ! wc_prices_include_tax() ) {
			$data_query = $wpdb->get_results(
				$wpdb->prepare(
					"SELECT DISTINCT ID, post_parent, post_type FROM {$wpdb->posts}
						INNER JOIN {$wpdb->postmeta} pm1 ON ID = pm1.post_id
						INNER JOIN {$wpdb->postmeta} pm2 ON ID = pm2.post_id
						WHERE post_type IN ( 'product', 'product_variation' )
						AND post_status = 'publish'
						AND pm1.meta_key IN ('" . implode( "','", array_map( 'esc_sql', apply_filters( 'woocommerce_price_filter_meta_keys', array( '_price' ) ) ) ) . "')
						AND pm1.meta_value BETWEEN %f AND %f
						AND pm2.meta_key = '_tax_class'
						AND pm2.meta_value = %s
					", $min_class, $max_class, sanitize_title( $tax_class )
				), OBJECT_K
			);
		} else {
			$data_query = $wpdb->get_results(
				$wpdb->prepare(
					"SELECT DISTINCT ID, post_parent, post_type FROM {$wpdb->posts}
					INNER JOIN {$wpdb->postmeta} pm1 ON ID = pm1.post_id
					WHERE post_type IN ( 'product', 'product_variation' )
					AND post_status = 'publish'
					AND pm1.meta_key IN ('" . implode( "','", array_map( 'esc_sql', apply_filters( 'woocommerce_price_filter_meta_keys', array( '_price' ) ) ) ) . "')
					AND pm1.meta_value BETWEEN %d AND %d
				", $min_class, $max_class
				), OBJECT_K
			);
		}

		return $data_query;
	}

	/**
	 * @return mixed
	 * Get currency
	 */
	protected function get_current_currency() {
		$current_currency = 'GBP';
		if ( get_option( 'woocommerce_currency' ) != '' ) {
			$main_currency    = get_option( 'woocommerce_currency' );
			$current_currency = $main_currency;
		}
		if ( ! is_admin() ) {
			$selected_currencies = get_option( 'wmc_selected_currencies' );
			$main_currency       = get_option( 'woocommerce_currency' );
			if ( isset( $_GET['wmc_current_currency'] ) && array_key_exists( $_GET['wmc_current_currency'], $selected_currencies ) ) {
				$current_currency = $_GET['wmc_current_currency'];
			} elseif ( isset( $_COOKIE['wmc_current_currency'] ) && array_key_exists( $_COOKIE['wmc_current_currency'], $selected_currencies ) ) {
				$current_currency = $_COOKIE['wmc_current_currency'];
			} else {
				$current_currency = $main_currency;
			}

			if ( get_option( 'wmc_allow_multi' ) == 'no' ) {
				if ( isset( $_GET['wc-ajax'] ) AND $_GET['wc-ajax'] == 'update_order_review' ) {
					$current_currency = $main_currency;
				}
			}
		}

		return $current_currency;
	}
}

new WMC_Frontend_Filter_Price();