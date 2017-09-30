<?php
/**
 * Currency Switcher Functions
 *
 * @version 2.5.0
 * @since   1.0.0
 * @author  Tom Anbinder
 */

if ( ! function_exists( 'alg_maybe_update_option_value_type' ) ) {
	/**
	 * alg_maybe_update_option_value_type.
	 *
	 * @version 2.5.0
	 * @since   2.5.0
	 */
	function alg_maybe_update_option_value_type( $option_id, $as_text ) {
		$option_value = get_option( $option_id, '' );
		if ( $as_text && is_array( $option_value ) ) {
			update_option( $option_id, implode( ',', $option_value ) );
		} elseif ( ! $as_text && ! is_array( $option_value ) ) {
			update_option( $option_id, array_map( 'trim', explode( ',', $option_value ) ) );
		}
	}
}

if ( ! function_exists( 'alg_get_enabled_currencies' ) ) {
	/**
	 * alg_get_enabled_currencies.
	 *
	 * @version 2.0.0
	 * @since   1.0.0
	 */
	function alg_get_enabled_currencies( $with_default = true ) {
		$additional_currencies = array();
		$default_currency = get_option( 'woocommerce_currency' );
		if ( $with_default ) {
			$additional_currencies[] = $default_currency;
		}
		$total_number = min( get_option( 'alg_currency_switcher_total_number', 2 ), apply_filters( 'alg_wc_currency_switcher_plugin_option', 2 ) );
		for ( $i = 1; $i <= $total_number; $i++ ) {
			if ( 'yes' === get_option( 'alg_currency_switcher_currency_enabled_' . $i, 'yes' ) ) {
				$additional_currencies[] = get_option( 'alg_currency_switcher_currency_' . $i, $default_currency );
			}
		}
		return array_unique( $additional_currencies );
	}
}

if ( ! function_exists( 'alg_get_current_currency_code' ) ) {
	/**
	 * alg_get_current_currency_code.
	 *
	 * @version 2.5.0
	 * @since   2.0.0
	 */
	function alg_get_current_currency_code( $default_currency = '' ) {
		if ( isset( $_SESSION['alg_currency'] ) ) {
			return $_SESSION['alg_currency'];
		} elseif ( 'yes' === get_option( 'alg_wc_currency_switcher_currency_countries_enabled', 'no' ) ) {
			if ( null != ( $customer_country = alg_get_customer_country_by_ip() ) ) {
				foreach ( alg_get_enabled_currencies( false ) as $currency_to ) {
					if ( '' != $currency_to ) {
						$countries = get_option( 'alg_currency_switcher_currency_countries_' . $currency_to, '' );
						if ( ! empty( $countries ) ) {
							if ( ! is_array( $countries ) ) {
								$countries = array_map( 'trim', explode( ',', $countries ) );
							}
							if ( in_array( $customer_country, $countries ) ) {
								$_SESSION['alg_currency'] = $currency_to;
								return $currency_to;
							}
						}
					}
				}
			}
		}
		if ( '' == $default_currency ) {
			$default_currency = get_option( 'woocommerce_currency' );
		}
		$_SESSION['alg_currency'] = $default_currency;
		return $default_currency;
	}
}

if ( ! function_exists( 'alg_get_customer_country_by_ip' ) ) {
	/**
	 * alg_get_customer_country_by_ip.
	 *
	 * @version 2.0.0
	 * @since   2.0.0
	 */
	function alg_get_customer_country_by_ip() {
		if ( class_exists( 'WC_Geolocation' ) ) {
			// Get the country by IP
			$location = WC_Geolocation::geolocate_ip();
			// Base fallback
			if ( empty( $location['country'] ) ) {
				$location = wc_format_country_state_string( apply_filters( 'woocommerce_customer_default_location', get_option( 'woocommerce_default_country' ) ) );
			}
			return ( isset( $location['country'] ) ) ? $location['country'] : null;
		} else {
			return null;
		}
	}
}

if ( ! function_exists( 'alg_get_exchange_rate_yahoo' ) ) {
	/*
	 * alg_get_exchange_rate_yahoo.
	 *
	 * @version 2.3.0
	 * @since   2.2.0
	 */
	function alg_get_exchange_rate_yahoo( $currency_from, $currency_to ) {
		$url = "http://query.yahooapis.com/v1/public/yql" .
			"?q=select%20rate%2Cname%20from%20csv%20where%20url%3D'http%3A%2F%2Fdownload.finance.yahoo.com%2Fd%2Fquotes%3Fs%3D" .
			$currency_from . $currency_to . "%253DX%26f%3Dl1n'%20and%20columns%3D'rate%2Cname'&format=json";
		ob_start();
		$max_execution_time = ini_get( 'max_execution_time' );
		set_time_limit( 10 );
		$response = '';
		if ( function_exists( 'curl_version' ) ) {
			$curl = curl_init( $url );
			curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
			$response = curl_exec( $curl );
			curl_close( $curl );
		} elseif ( ini_get( 'allow_url_fopen' ) ) {
			$response = file_get_contents( $url );
		}
		$exchange_rate = json_decode( $response );
		set_time_limit( $max_execution_time );
		ob_end_clean();
		return ( isset( $exchange_rate->query->results->row->rate ) ) ? floatval( $exchange_rate->query->results->row->rate ) : 0;
	}
}

if ( ! function_exists( 'alg_get_exchange_rate_ecb' ) ) {
	/*
	 * alg_get_exchange_rate_ecb.
	 *
	 * @version 2.2.0
	 * @since   2.2.0
	 */
	function alg_get_exchange_rate_ecb( $currency_from, $currency_to ) {
		$final_rate = 0;
		if ( function_exists( 'simplexml_load_file' ) ) {
			$xml = simplexml_load_file( 'http://www.ecb.int/stats/eurofxref/eurofxref-daily.xml' );
			if ( isset( $xml->Cube->Cube->Cube ) ) {
				if ( 'EUR' === $currency_from ) {
					$EUR_currency_from_rate = 1;
				}
				if ( 'EUR' === $currency_to ) {
					$EUR_currency_to_rate = 1;
				}
				foreach ( $xml->Cube->Cube->Cube as $currency_rate ) {
					$currency_rate = $currency_rate->attributes();
					if ( ! isset( $EUR_currency_from_rate ) && $currency_from == $currency_rate->currency ) {
						$EUR_currency_from_rate = (float) $currency_rate->rate;
					}
					if ( ! isset( $EUR_currency_to_rate ) && $currency_to == $currency_rate->currency ) {
						$EUR_currency_to_rate = (float) $currency_rate->rate;
					}
				}
				if ( isset( $EUR_currency_from_rate ) && isset( $EUR_currency_to_rate ) && 0 != $EUR_currency_from_rate ) {
					$final_rate = round( $EUR_currency_to_rate / $EUR_currency_from_rate, 6 );
				} else {
					$final_rate = 0;
				}
			}
		}
		return $final_rate;
	}
}

if ( ! function_exists( 'alg_get_exchange_rate' ) ) {
	/*
	 * alg_get_exchange_rate.
	 *
	 * @version 2.2.0
	 * @since   2.0.0
	 * @return  float rate on success, else 0
	 */
	function alg_get_exchange_rate( $currency_from, $currency_to ) {
		if ( 'ecb' === get_option( 'alg_currency_switcher_exchange_rate_server', 'yahoo' ) ) {
			return alg_get_exchange_rate_ecb( $currency_from, $currency_to );
		} else { // Yahoo
			return alg_get_exchange_rate_yahoo( $currency_from, $currency_to );
		}
	}
}

if ( ! function_exists( 'alg_update_the_exchange_rates' ) ) {
	/**
	 * alg_update_the_exchange_rates.
	 *
	 * @version 2.0.0
	 * @since   2.0.0
	 * @todo    add price filter widget and sorting by price support
	 */
	function alg_update_the_exchange_rates() {
		$currency_from = get_option( 'woocommerce_currency' );
		foreach ( alg_get_enabled_currencies() as $currency ) {
			if ( $currency_from != $currency ) {
				$the_rate = alg_get_exchange_rate( $currency_from, $currency );
				if ( 0 != $the_rate ) {
					update_option( 'alg_currency_switcher_exchange_rate_' . $currency_from . '_' . $currency, $the_rate );
				}
			}
		}
		/*
		if ( 'yes' === get_option( 'alg_price_by_country_price_filter_widget_support_enabled', 'no' ) ) {
			alg_update_products_price_by_country();
		}
		*/
	}
}

if ( ! function_exists( 'alg_get_product_price_by_currency_per_product' ) ) {
	/**
	 * alg_get_product_price_by_currency_per_product.
	 *
	 * @version 2.4.3
	 * @since   2.4.3
	 */
	function alg_get_product_price_by_currency_per_product( $price, $currency_code, $_product, $direct_call ) {
		if ( 'yes' === get_option( 'alg_currency_switcher_per_product_enabled' , 'yes' ) && null != $_product && $currency_code != get_option( 'woocommerce_currency' ) ) {
//			if ( 'yes' === get_post_meta( $_main_product_id, '_' . 'alg_currency_switcher_per_product_settings_enabled', true ) ) {
				$_product_id = ( ALG_IS_WC_VERSION_BELOW_3 ?
					( isset( $_product->variation_id ) ? $_product->variation_id : $_product->id ) :
					$_product->get_id()
				);
				if ( '' != ( $regular_price_per_product = get_post_meta( $_product_id, '_' . 'alg_currency_switcher_per_product_regular_price_' . $currency_code, true ) ) ) {
					$_current_filter = current_filter();

					if ( in_array( $_current_filter,
						array( 'woocommerce_get_price_including_tax', 'woocommerce_get_price_excluding_tax' )
					) ) {
						return alg_get_product_display_price( $_product );

					} elseif ( $direct_call || in_array( $_current_filter,
						array( ALG_PRODUCT_GET_PRICE_FILTER, 'woocommerce_variation_prices_price', 'woocommerce_product_variation_get_price' )
					) ) {
						$sale_price_per_product = get_post_meta( $_product_id, '_' . 'alg_currency_switcher_per_product_sale_price_' . $currency_code, true );
						return ( '' != $sale_price_per_product && $sale_price_per_product < $regular_price_per_product ) ? $sale_price_per_product : $regular_price_per_product;

					} elseif ( in_array( $_current_filter,
						array( ALG_PRODUCT_GET_REGULAR_PRICE_FILTER, 'woocommerce_variation_prices_regular_price', 'woocommerce_product_variation_get_regular_price' )
					) ) {
						return $regular_price_per_product;

					} elseif ( in_array( $_current_filter,
						array( ALG_PRODUCT_GET_SALE_PRICE_FILTER, 'woocommerce_variation_prices_sale_price', 'woocommerce_product_variation_get_sale_price' )
					) ) {
						$sale_price_per_product = get_post_meta( $_product_id, '_' . 'alg_currency_switcher_per_product_sale_price_' . $currency_code, true );
						return ( '' != $sale_price_per_product ) ? $sale_price_per_product : $price;
					}
				}
//			}
		}
		return false;
	}
}

if ( ! function_exists( 'alg_get_product_price_by_currency_global' ) ) {
	/**
	 * alg_get_product_price_by_currency_global.
	 *
	 * @version 2.4.3
	 * @since   2.4.3
	 */
	function alg_get_product_price_by_currency_global( $price, $currency_code ) {
		// Exchange rates
		$currency_exchange_rate = alg_get_currency_exchange_rate( $currency_code );
		$price                  = $price * $currency_exchange_rate;
		// Rounding
		$shop_precision     = absint( get_option( 'woocommerce_price_num_decimals', 2 ) );
		$rounding_precision = get_option( 'alg_currency_switcher_rounding_precision', $shop_precision );
		switch ( get_option( 'alg_currency_switcher_rounding', 'no_round' ) ) {
			case 'round':
				$price = round( $price, $rounding_precision );
				break;
			case 'round_up':
				$price = ceil( $price );
				break;
			case 'round_down':
				$price = floor( $price );
				break;
		}
		// Pretty Price
		if ( 'yes' === get_option( 'alg_currency_switcher_make_pretty_price', 'no' ) && $price >= 0.5 ) {
			if ( 'yes' === get_option( 'alg_wc_currency_switcher_price_formats_enabled', 'no' ) ) {
				$shop_precision = get_option( 'alg_wc_currency_switcher_price_formats_number_of_decimals_' . $currency_code, $shop_precision );
			}
			if ( $shop_precision > 0 ) {
				$price = round( $price ) - ( 1 / pow( 10, $shop_precision ) );
			}
		}
		// The end
		return $price;
	}
}

if ( ! function_exists( 'alg_get_product_price_by_currency' ) ) {
	/**
	 * alg_get_product_price_by_currency.
	 *
	 * @version 2.4.3
	 * @since   2.2.4
	 */
	function alg_get_product_price_by_currency( $price, $currency_code, $_product = null, $direct_call = false ) {

		// Check if empty price
		if ( '' === $price ) {
			return $price;
		}

		// Check if shop's default currency
		if ( $currency_code == get_option( 'woocommerce_currency' ) && 'no' === get_option( 'alg_currency_switcher_default_currency_enabled', 'no' ) ) {
			return $price;
		}

		// Per product
		if ( false !== ( $price_per_product = alg_get_product_price_by_currency_per_product( $price, $currency_code, $_product, $direct_call ) ) ) {
			return $price_per_product;
		}

		// Global
		return alg_get_product_price_by_currency_global( $price, $currency_code );

	}
}

if ( ! function_exists( 'alg_get_currency_exchange_rate' ) ) {
	/**
	 * alg_get_currency_exchange_rate.
	 *
	 * @version 2.2.4
	 * @since   2.2.4
	 */
	function alg_get_currency_exchange_rate( $currency_code ) {
		$currency_from = get_option( 'woocommerce_currency' );
		return ( $currency_from == $currency_code ) ? 1 : get_option( 'alg_currency_switcher_exchange_rate_' . $currency_from . '_' . $currency_code, 1 );
	}
}

if ( ! function_exists( 'alg_currency_switcher_product_price_filters' ) ) {
	/**
	 * alg_currency_switcher_product_price_filters.
	 *
	 * @version 2.5.0
	 * @since   2.3.0
	 */
	function alg_currency_switcher_product_price_filters( $_object, $action = 'add_filter' ) {
		// Additional Price Filters
		$additional_price_filters = get_option( 'alg_currency_switcher_additional_price_filters', '' );
		if ( ! empty( $additional_price_filters ) ) {
			$additional_price_filters = array_map( 'trim', explode( PHP_EOL, $additional_price_filters ) );
			foreach ( $additional_price_filters as $additional_price_filter ) {
				$action( $additional_price_filter, array( $_object, 'change_price_by_currency' ), PHP_INT_MAX, 2 );
			}
		}
		// Prices
		$action( ALG_PRODUCT_GET_PRICE_FILTER,                 array( $_object, 'change_price_by_currency' ), PHP_INT_MAX, 2 );
		$action( ALG_PRODUCT_GET_SALE_PRICE_FILTER,            array( $_object, 'change_price_by_currency' ), PHP_INT_MAX, 2 );
		$action( ALG_PRODUCT_GET_REGULAR_PRICE_FILTER,         array( $_object, 'change_price_by_currency' ), PHP_INT_MAX, 2 );
		// Variations
		$action( 'woocommerce_variation_prices_price',         array( $_object, 'change_price_by_currency' ), PHP_INT_MAX, 2 );
		$action( 'woocommerce_variation_prices_regular_price', array( $_object, 'change_price_by_currency' ), PHP_INT_MAX, 2 );
		$action( 'woocommerce_variation_prices_sale_price',    array( $_object, 'change_price_by_currency' ), PHP_INT_MAX, 2 );
		if ( ! ALG_IS_WC_VERSION_BELOW_3 ) {
			$action( 'woocommerce_product_variation_get_price',         array( $_object, 'change_price_by_currency' ), PHP_INT_MAX, 2 );
			$action( 'woocommerce_product_variation_get_regular_price', array( $_object, 'change_price_by_currency' ), PHP_INT_MAX, 2 );
			$action( 'woocommerce_product_variation_get_sale_price',    array( $_object, 'change_price_by_currency' ), PHP_INT_MAX, 2 );
		}
		// Grouped products
		$action( 'woocommerce_get_price_including_tax',        array( $_object, 'change_price_by_currency_grouped' ), PHP_INT_MAX, 3 );
		$action( 'woocommerce_get_price_excluding_tax',        array( $_object, 'change_price_by_currency_grouped' ), PHP_INT_MAX, 3 );
	}
}

if ( ! function_exists( 'alg_get_product_display_price' ) ) {
	/**
	 * alg_get_product_display_price.
	 *
	 * @version 2.3.0
	 * @since   2.3.0
	 */
	function alg_get_product_display_price( $_product, $price = '', $qty = 1 ) {
		return ( ALG_IS_WC_VERSION_BELOW_3 ) ? $_product->get_display_price( $price, $qty ) : wc_get_price_to_display( $_product, array( 'price' => $price, 'qty' => $qty ) );
	}
}

if ( ! function_exists( 'alg_get_product_price_html_by_currency' ) ) {
	/**
	 * alg_get_product_price_html_by_currency.
	 *
	 * @version 2.3.0
	 * @since   2.2.4
	 */
	function alg_get_product_price_html_by_currency( $_product, $currency_code ) {
		$price_html = '';
		alg_currency_switcher_product_price_filters( alg_wc_currency_switcher_plugin()->core, 'remove_filter' );
		if ( $_product->is_type( 'variable' ) || $_product->is_type( 'grouped' ) ) {
			$child_prices = array();
			foreach ( $_product->get_children() as $child_id ) {
				$child = wc_get_product( $child_id );
				if ( '' !== $child->get_price() ) {
					$child_prices[] = alg_get_product_price_by_currency( $child->get_price(), $currency_code, $child, true );
				}
			}
			if ( ! empty( $child_prices ) ) {
				$price_min = min( $child_prices );
				$price_max = max( $child_prices );
				$price_min = alg_get_product_display_price( $_product, $price_min, 1 );
				$price_max = alg_get_product_display_price( $_product, $price_max, 1 );
				if ( $price_min == $price_max ) {
					$price_html = wc_price( $price_min, array( 'currency' => $currency_code ) );
				} else {
					$price_html = wc_price( $price_min, array( 'currency' => $currency_code ) ) . '-' . wc_price( $price_max, array( 'currency' => $currency_code ) );
				}
			}
		} else {
			$price = $_product->get_price();
			$price = alg_get_product_price_by_currency( $price, $currency_code, $_product, true );
			$price = alg_get_product_display_price( $_product, $price, 1 );
			$price_html = wc_price( $price, array( 'currency' => $currency_code ) );
		}
		alg_currency_switcher_product_price_filters( alg_wc_currency_switcher_plugin()->core, 'add_filter' );
		return $price_html;
	}
}

if ( ! function_exists( 'alg_currencies_product_price_table' ) ) {
	/**
	 * alg_currencies_product_price_table.
	 *
	 * @version 2.2.4
	 * @since   2.2.4
	 */
	function alg_currencies_product_price_table( $atts ) {
		if ( ! is_product() ) {
			return '';
		}
		$_product = wc_get_product();
		if ( ! $_product ) {
			return '';
		}
		$function_currencies = alg_get_enabled_currencies();
		$table_data = array();
		foreach ( $function_currencies as $currency_code ) {
			$table_data[] = array(
				$currency_code,
				alg_get_product_price_html_by_currency( $_product, $currency_code ),
			);
		}
		return alg_get_table_html( $table_data, array( 'table_heading_type' => 'vertical' ) );
	}
}
add_shortcode( 'woocommerce_currency_switcher_product_price_table', 'alg_currencies_product_price_table' );

if ( ! function_exists( 'alg_get_table_html' ) ) {
	/**
	 * alg_get_table_html.
	 *
	 * @version 2.2.4
	 * @since   2.2.4
	 */
	function alg_get_table_html( $data, $args = array() ) {
		$defaults = array(
			'table_class'        => '',
			'table_style'        => '',
			'row_styles'         => '',
			'table_heading_type' => 'horizontal',
			'columns_classes'    => array(),
			'columns_styles'     => array(),
		);
		$args = array_merge( $defaults, $args );
		extract( $args );
		$table_class = ( '' == $table_class ) ? '' : ' class="' . $table_class . '"';
		$table_style = ( '' == $table_style ) ? '' : ' style="' . $table_style . '"';
		$row_styles  = ( '' == $row_styles )  ? '' : ' style="' . $row_styles  . '"';
		$html = '';
		$html .= '<table' . $table_class . $table_style . '>';
		$html .= '<tbody>';
		foreach( $data as $row_number => $row ) {
			$html .= '<tr' . $row_styles . '>';
			foreach( $row as $column_number => $value ) {
				$th_or_td = ( ( 0 === $row_number && 'horizontal' === $table_heading_type ) || ( 0 === $column_number && 'vertical' === $table_heading_type ) ) ? 'th' : 'td';
				$column_class = ( ! empty( $columns_classes ) && isset( $columns_classes[ $column_number ] ) ) ? ' class="' . $columns_classes[ $column_number ] . '"' : '';
				$column_style = ( ! empty( $columns_styles ) && isset( $columns_styles[ $column_number ] ) ) ? ' style="' . $columns_styles[ $column_number ] . '"' : '';
				$html .= '<' . $th_or_td . $column_class . $column_style . '>';
				$html .= $value;
				$html .= '</' . $th_or_td . '>';
			}
			$html .= '</tr>';
		}
		$html .= '</tbody>';
		$html .= '</table>';
		return $html;
	}
}

if ( ! function_exists( 'alg_convert_price' ) ) {
	/**
	 * alg_convert_price.
	 *
	 * @version 2.5.0
	 * @since   2.4.1
	 */
	function alg_convert_price( $atts ) {
		if ( ! isset( $atts['price'] ) ) {
			return '';
		}
		if ( ! isset( $atts['currency'] ) ) {
			$atts['currency'] = alg_get_current_currency_code();
		}
		$converted_price = alg_get_product_price_by_currency( $atts['price'], $atts['currency'] );
		if ( ! isset( $atts['format_price'] ) ) {
			$atts['format_price'] = 'yes';
		}
		return ( 'yes' === $atts['format_price'] || true === $atts['format_price'] ? wc_price( $converted_price, array( 'currency' => $atts['currency'] ) ) : $converted_price );
	}
}
add_shortcode( 'woocommerce_currency_switcher_convert_price', 'alg_convert_price' );
