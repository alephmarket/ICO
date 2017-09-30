<?php
/**
 * Currency Switcher Plugin - Core Class
 *
 * @version 2.5.0
 * @since   1.0.0
 * @author  Tom Anbinder
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_Currency_Switcher_Main' ) ) :

class Alg_WC_Currency_Switcher_Main {

	/**
	 * Constructor.
	 *
	 * @version 2.5.0
	 * @since   1.0.0
	 * @todo    replace sessions with `WC()->session` (or maybe something other)
	 * @todo    move "JS Repositioning", "Switcher" (and maybe something else) to `! is_admin()` section (as "Flags")
	 */
	function __construct() {

		if ( 'yes' === get_option( 'alg_wc_currency_switcher_enabled', 'yes' ) ) {
			if ( ! session_id() ) {
				session_start();
			}
			if ( isset( $_REQUEST['alg_currency'] ) ) {
				$_SESSION['alg_currency'] = $_REQUEST['alg_currency'];
			}
			if ( 'yes' === get_option( 'alg_wc_currency_switcher_currency_locales_enabled', 'no' ) ) {
				if ( 'yes' === get_option( 'alg_wc_currency_switcher_currency_locales_use_always_enabled', 'yes' ) ) {
					$this->set_currency_by_locale();
				} elseif ( ! isset( $_SESSION['alg_currency'] ) ) {
					$this->set_currency_by_locale();
				}
			}
			if ( 'yes' === get_option( 'alg_currency_switcher_fix_mini_cart', 'no' ) ) {
				add_action( 'wp_loaded', array( $this, 'fix_mini_cart' ), PHP_INT_MAX );
			}
			if ( ! is_admin() || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
				// Disable on URI
				$disable_on_uri = get_option( 'alg_currency_switcher_disable_uri', '' );
				if ( ! empty( $disable_on_uri ) ) {
					$disable_on_uri = array_map( 'trim', explode( PHP_EOL, $disable_on_uri ) );
					foreach ( $disable_on_uri as $uri ) {
						if ( false !== strpos( $_SERVER['REQUEST_URI'], $uri ) ) {
							return;
						}
					}
				}
				// Product Price
				alg_currency_switcher_product_price_filters( $this, 'add_filter' );
				// Currency
				add_filter( 'woocommerce_currency',                       array( $this, 'change_currency_code' ),   PHP_INT_MAX, 1 );
				// Price formats
				if ( 'yes' === get_option( 'alg_wc_currency_switcher_price_formats_enabled', 'no' ) ) {
					add_filter( 'wc_price_args',                          array( $this, 'price_format' ), PHP_INT_MAX );
					add_filter( 'woocommerce_currency_symbol',            array( $this, 'change_currency_symbol' ), PHP_INT_MAX, 2 );
				}
				// Coupons
				if ( 'yes' === get_option( 'alg_currency_switcher_fixed_amount_coupons_enabled', 'yes' ) ) {
					add_filter( 'woocommerce_coupon_get_discount_amount', array( $this, 'change_coupon_price_by_currency' ), PHP_INT_MAX, 5 );
				}
				// Shipping
				add_filter( 'woocommerce_package_rates',                  array( $this, 'change_shipping_price_by_currency' ), PHP_INT_MAX, 2 );
				if ( 'yes' === get_option( 'alg_currency_switcher_free_shipping_min_amount_enabled', 'yes' ) ) {
					add_action( 'woocommerce_load_shipping_methods',      array( $this, 'change_free_shipping_min_amount_by_currency' ), PHP_INT_MAX );
				}
				// Variations hash
				add_filter( 'woocommerce_get_variation_prices_hash',      array( $this, 'get_variation_prices_hash' ), PHP_INT_MAX, 3 );
				// Switcher
				$placements = get_option( 'alg_currency_switcher_placement', '' );
				if ( ! empty( $placements ) ) {
					foreach ( $placements as $placement ) {
						switch ( $placement ) {
							case 'single_page_after_price_radio':
								add_action( 'woocommerce_single_product_summary', array( $this, 'output_switcher_radio' ), 15 );
								break;
							case 'single_page_after_price_select':
								add_action( 'woocommerce_single_product_summary', array( $this, 'output_switcher_select' ), 15 );
								break;
							case 'single_page_after_price_links':
								add_action( 'woocommerce_single_product_summary', array( $this, 'output_switcher_links' ), 15 );
								break;
						}
					}
				}
				// JS Repositioning
				if ( 'yes' === get_option( 'alg_currency_switcher_js_reposition_enabled', 'no' ) ) {
					add_action( 'wp_head', array( $this, 'currency_switcher_js_reposition' ) );
				}
				if ( ! is_admin() ) {
					// Flags
					if ( 'yes' === apply_filters( 'alg_wc_currency_switcher_plugin_option', 'no', 'value_flags' ) ) {
						add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_wselect_scripts' ) );
					}
				}
			}
		}
		if ( is_admin() ) {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_wselect_scripts' ) ); // for Flags Settings
		}
	}

	/**
	 * change_currency_symbol.
	 *
	 * @version 2.5.0
	 * @since   2.5.0
	 */
	function change_currency_symbol( $currency_symbol, $currency ) {
		return get_option( 'alg_wc_currency_switcher_price_formats_currency_code_' . $currency, $currency_symbol );
	}

	/**
	 * set_currency_by_locale.
	 *
	 * @version 2.5.0
	 * @since   2.5.0
	 */
	function set_currency_by_locale() {
		$locale = get_locale();
		foreach ( alg_get_enabled_currencies( false ) as $currency ) {
			if ( '' != $currency ) {
				$locales = get_option( 'alg_wc_currency_switcher_currency_locales_' . $currency, '' );
				if ( ! empty( $locales ) ) {
					if ( ! is_array( $locales ) ) {
						$locales = array_map( 'trim', explode( ',', $locales ) );
					}
					if ( in_array( $locale, $locales ) ) {
						$_SESSION['alg_currency'] = $currency;
						break;
					}
				}
			}
		}
	}

	/**
	 * enqueue_wselect_scripts.
	 *
	 * @version 2.4.4
	 * @since   2.4.4
	 */
	function enqueue_wselect_scripts() {
		$plugin_url     = alg_wc_currency_switcher_plugin()->plugin_url();
		$plugin_version = alg_wc_currency_switcher_plugin()->version;
		wp_enqueue_style(  'alg-wselect-style', $plugin_url . '/includes/lib/wSelect/wSelect.css',    array(),           $plugin_version );
		wp_enqueue_script( 'alg-wselect-lib',   $plugin_url . '/includes/lib/wSelect/wSelect.min.js', array( 'jquery' ), $plugin_version, true );
		wp_enqueue_script( 'alg-wselect',       $plugin_url . '/includes/js/alg-wSelect.js',          array( 'jquery' ), $plugin_version, true );
	}

	/**
	 * price_format.
	 *
	 * @version 2.4.3
	 * @since   2.4.0
	 */
	function price_format( $args ) {
		$currency = get_woocommerce_currency();
		if ( $currency == get_option( 'woocommerce_currency' ) ) {
			$args['price_format'] = $this->get_woocommerce_price_format_currency_code( get_option( 'alg_wc_currency_switcher_price_formats_currency_code_pos_' . $currency, 'none' ), $currency, $args['price_format'] );
			return $args;
		}
		$args['price_format']       = $this->get_woocommerce_price_format( get_option( 'alg_wc_currency_switcher_price_formats_currency_position_' . $currency ) );
		$args['price_format']       = $this->get_woocommerce_price_format_currency_code( get_option( 'alg_wc_currency_switcher_price_formats_currency_code_pos_' . $currency, 'none' ), $currency, $args['price_format'] );
		$args['decimal_separator']  = get_option( 'alg_wc_currency_switcher_price_formats_decimal_separator_'  . $currency );
		$args['thousand_separator'] = get_option( 'alg_wc_currency_switcher_price_formats_thousand_separator_' . $currency );
		$args['decimals']           = absint( get_option( 'alg_wc_currency_switcher_price_formats_number_of_decimals_' . $currency ) );
		return $args;
	}

	/**
	 * get_woocommerce_price_format_currency_code.
	 *
	 * @version 2.4.0
	 * @since   2.4.0
	 */
	function get_woocommerce_price_format_currency_code( $currency_code_pos, $currency, $price_format ) {
		switch ( $currency_code_pos ) {
			case 'left' :
				return $currency . $price_format;
			case 'right' :
				return $price_format . $currency;
			case 'left_space' :
				return $currency . '&nbsp;' . $price_format;
			case 'right_space' :
				return $price_format . '&nbsp;' . $currency;
			default: // 'none'
				return $price_format;
		}
	}

	/**
	 * get_woocommerce_price_format.
	 *
	 * @version 2.4.0
	 * @since   2.4.0
	 */
	function get_woocommerce_price_format( $currency_pos ) {
		$format = '%1$s%2$s';

		switch ( $currency_pos ) {
			case 'left' :
				$format = '%1$s%2$s';
			break;
			case 'right' :
				$format = '%2$s%1$s';
			break;
			case 'left_space' :
				$format = '%1$s&nbsp;%2$s';
			break;
			case 'right_space' :
				$format = '%2$s&nbsp;%1$s';
			break;
		}

		return apply_filters( 'woocommerce_price_format', $format, $currency_pos );
	}

	/**
	 * currency_switcher_js_reposition.
	 *
	 * @version 2.2.3
	 * @since   2.2.3
	 */
	function currency_switcher_js_reposition() {
		if ( isset( $_REQUEST['alg_currency'] ) ) {
			echo '<script type="text/javascript"> window.onload = function() { location.href = \'#alg_currency_selector\'; }; </script>';
		}
	}

	/**
	 * change_free_shipping_min_amount_by_currency.
	 *
	 * @version 2.2.4
	 * @since   2.2.1
	 */
	function change_free_shipping_min_amount_by_currency() {
		// Check if shipping methods exist
		if ( ! function_exists( 'WC' ) || ! isset( WC()->shipping()->shipping_methods ) || empty( WC()->shipping()->shipping_methods ) ) {
			return;
		}
		// Get free shipping methods (with non-zero min amount) instance ids
		$free_shipping_methods_instance_ids = array();
		foreach ( WC()->shipping()->shipping_methods as $shipping_method_instance_id => $shipping_method ) {
			if ( 'WC_Shipping_Free_Shipping' === get_class( $shipping_method ) && isset( $shipping_method->min_amount ) && 0 != $shipping_method->min_amount ) {
				$free_shipping_methods_instance_ids[] = $shipping_method_instance_id;
			}
		}
		if ( empty( $free_shipping_methods_instance_ids ) ) {
			return;
		}
		// Convert min amount to selected currency
		$currency_exchange_rate = alg_get_currency_exchange_rate( alg_get_current_currency_code() );
		foreach ( $free_shipping_methods_instance_ids as $free_shipping_methods_instance_id ) {
			WC()->shipping()->shipping_methods[ $free_shipping_methods_instance_id ]->min_amount *= $currency_exchange_rate;
		}
	}

	/**
	 * fix_mini_cart.
	 *
	 * @version 2.1.1
	 * @since   2.1.1
	 */
	function fix_mini_cart() {
		if ( ! is_admin() || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
			if ( null !== ( $wc = WC() ) ) {
				if ( isset( $wc->cart ) ) {
					$wc->cart->calculate_totals();
				}
			}
		}
	}

	/**
	 * output_switcher_radio.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function output_switcher_radio() {
		echo alg_currency_select_radio_list();
	}

	/**
	 * output_switcher_select.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function output_switcher_select() {
		echo alg_currency_select_drop_down_list();
	}

	/**
	 * output_switcher_links.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function output_switcher_links() {
		echo alg_currency_select_link_list();
	}

	/**
	 * change_price_by_currency_grouped.
	 *
	 * @version 2.3.0
	 * @since   1.0.0
	 */
	function change_price_by_currency_grouped( $price, $qty, $_product ) {
		if ( $_product->is_type( 'grouped' ) ) {
			if ( 'yes' === get_option( 'alg_currency_switcher_per_product_enabled' , 'yes' ) ) {
				foreach ( $_product->get_children() as $child_id ) {
					$_price = get_post_meta( $child_id, '_price', true );
					$_child = wc_get_product( $child_id );
					$_price = alg_get_product_display_price( $_child, $_price, 1 );
					if ( $_price == $price ) {
						return $this->change_price_by_currency( $price, $_child );
					}
				}
			} else {
				return $this->change_price_by_currency( $price, null );
			}
		}
		return $price;
	}

	/**
	 * get_variation_prices_hash.
	 *
	 * @version 2.4.3
	 * @since   1.0.0
	 */
	function get_variation_prices_hash( $price_hash, $_product, $display ) {
		$currency_code          = alg_get_current_currency_code();
		$currency_exchange_rate = alg_get_currency_exchange_rate( $currency_code );
		$price_hash['alg_currency_switcher_data'] = array(
			$currency_code,
			$currency_exchange_rate,
			get_option( 'alg_currency_switcher_per_product_enabled', 'yes' ),
			get_option( 'alg_currency_switcher_rounding', 'no_round' ),
			get_option( 'alg_currency_switcher_rounding_precision', absint( get_option( 'woocommerce_price_num_decimals', 2 ) ) ),
			get_option( 'alg_currency_switcher_make_pretty_price', 'no' ),
			get_option( 'alg_currency_switcher_default_currency_enabled', 'no' ),
		);
		return $price_hash;
	}

	/**
	 * do_revert.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function do_revert() {
		return ( 'yes' === get_option( 'alg_currency_switcher_revert', 'no' ) && is_checkout() );
	}

	/**
	 * change_shipping_price_by_currency.
	 *
	 * @version 2.2.4
	 * @since   1.0.0
	 */
	function change_shipping_price_by_currency( $package_rates, $package ) {
		if ( $this->do_revert() ) {
			return $package_rates;
		}
		$currency_exchange_rate = alg_get_currency_exchange_rate( alg_get_current_currency_code() );
		$modified_package_rates = array();
		foreach ( $package_rates as $id => $package_rate ) {
			if ( 1 != $currency_exchange_rate && isset( $package_rate->cost ) ) {
				$package_rate->cost = $package_rate->cost * $currency_exchange_rate;
				if ( isset( $package_rate->taxes ) && ! empty( $package_rate->taxes ) ) {
					foreach ( $package_rate->taxes as $tax_id => $tax ) {
						$package_rate->taxes[ $tax_id ] = $package_rate->taxes[ $tax_id ] * $currency_exchange_rate;
					}
				}
			}
			$modified_package_rates[ $id ] = $package_rate;
		}
		return $modified_package_rates;
	}

	/**
	 * change_coupon_price_by_currency.
	 *
	 * @version 2.3.1
	 * @since   2.3.1
	 */
	function change_coupon_price_by_currency( $discount, $discounting_amount, $cart_item, $single, $_coupon ) {
		return ( in_array( $_coupon->get_discount_type(), array( 'fixed_cart', 'fixed_product' ) ) ? $this->change_price_by_currency( $discount ) : $discount );
	}

	/**
	 * change_price_by_currency.
	 *
	 * @version 2.2.4
	 * @since   1.0.0
	 */
	function change_price_by_currency( $price, $_product = null ) {
		if ( $this->do_revert() ) {
			return $price;
		}
		return alg_get_product_price_by_currency( $price, alg_get_current_currency_code(), $_product );
	}

	/**
	 * change_currency_code.
	 *
	 * @version 2.0.0
	 * @since   1.0.0
	 */
	function change_currency_code( $currency ) {
		return ( $this->do_revert() ) ? $currency : alg_get_current_currency_code( $currency );
	}

}

endif;

return new Alg_WC_Currency_Switcher_Main();
