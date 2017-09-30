<?php
/**
 * Currency Switcher - General Section Settings
 *
 * @version 2.5.2
 * @since   1.0.0
 * @author  Tom Anbinder
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_Currency_Switcher_Settings_General' ) ) :

class Alg_WC_Currency_Switcher_Settings_General extends Alg_WC_Currency_Switcher_Settings_Section {

	/**
	 * Constructor.
	 *
	 * @version 2.5.2
	 * @since   1.0.0
	 */
	function __construct() {
		$this->id   = '';
		$this->desc = __( 'General', 'currency-switcher-woocommerce' );
		parent::__construct();
		add_filter( 'woocommerce_admin_settings_sanitize_option', array( $this, 'unclean_textarea' ), PHP_INT_MAX, 3 );
	}

	/**
	 * unclean_textarea.
	 *
	 * @version 2.5.2
	 * @since   2.5.2
	 */
	function unclean_textarea( $value, $option, $raw_value ) {
		return ( 'alg_wc_currency_switcher_link_list_separator' === $option['id'] ) ? $raw_value : $value;
	}

	/**
	 * get_general_settings.
	 *
	 * @version 2.5.2
	 * @since   1.0.0
	 * @todo    styling (and flags)
	 * @todo    add more placement options
	 * @todo    (Booster) "Apply Currency Conversion for Fixed Amount Coupons"
	 */
	function get_general_settings( $settings ) {
		$settings = array_merge( $settings, array(
			array(
				'title'    => __( 'Currency Switcher Plugin Options', 'currency-switcher-woocommerce' ),
				'type'     => 'title',
				'id'       => 'alg_wc_currency_switcher_plugin_options',
			),
			array(
				'title'    => __( 'WooCommerce Currency Switcher Plugin', 'currency-switcher-woocommerce' ),
				'desc'     => '<strong>' . __( 'Enable plugin', 'currency-switcher-woocommerce' ) . '</strong>',
				'desc_tip' => __( 'Currency Switcher for WooCommerce', 'currency-switcher-woocommerce' ) . ' [v' . get_option( 'alg_currency_switcher_version', '' ) . '].',
				'id'       => 'alg_wc_currency_switcher_enabled',
				'default'  => 'yes',
				'type'     => 'checkbox',
			),
			array(
				'type'     => 'sectionend',
				'id'       => 'alg_wc_currency_switcher_plugin_options',
			),
			array(
				'title'    => __( 'General Options', 'currency-switcher-woocommerce' ),
				'type'     => 'title',
				'id'       => 'alg_wc_currency_switcher_general_options',
			),
			array(
				'title'    => __( 'Currency Switcher on per Product Basis', 'currency-switcher-woocommerce' ),
				'desc'     => __( 'Enable', 'currency-switcher-woocommerce' ),
				'desc_tip' => __( 'This will add meta boxes in product edit.', 'currency-switcher-woocommerce' ),
				'id'       => 'alg_currency_switcher_per_product_enabled',
				'default'  => 'yes',
				'type'     => 'checkbox',
			),
			array(
				'title'    => __( 'Revert Currency to Default on Checkout', 'currency-switcher-woocommerce' ),
				'desc'     => __( 'Enable', 'currency-switcher-woocommerce' ),
				'id'       => 'alg_currency_switcher_revert',
				'default'  => 'no',
				'type'     => 'checkbox',
			),
			array(
				'type'     => 'sectionend',
				'id'       => 'alg_wc_currency_switcher_general_options',
			),
			array(
				'title'    => __( 'Switcher Placement and Format Options', 'currency-switcher-woocommerce' ),
				'type'     => 'title',
				'id'       => 'alg_wc_currency_switcher_placement_format_options',
			),
			array(
				'title'    => __( 'Switcher Placement', 'currency-switcher-woocommerce' ),
				'desc'     => '<br>' . sprintf( __( 'You can also use <strong>switcher widget</strong>, %s <strong>shortcodes</strong> or %s <strong>PHP function</strong>.', 'currency-switcher-woocommerce' ),
					'<code>' . '[woocommerce_currency_switcher_drop_down_box]' . '</code>, <code>' .
						'[woocommerce_currency_switcher_radio_list]' . '</code>, <code>' . '[woocommerce_currency_switcher_link_list]' . '</code>',
					'<code>' . 'do_shortcode()' . '</code>' ),
				'id'       => 'alg_currency_switcher_placement',
				'default'  => '',
				'type'     => 'multiselect',
				'class'    => 'chosen_select',
				'options'  => array(
					'single_page_after_price_radio'  => __( 'Product Single Page - After Price - Radio', 'currency-switcher-woocommerce' ),
					'single_page_after_price_select' => __( 'Product Single Page - After Price - Drop Down', 'currency-switcher-woocommerce' ),
					'single_page_after_price_links'  => __( 'Product Single Page - After Price - Links', 'currency-switcher-woocommerce' ),
				),
			),
			array(
				'title'    => __( 'Switcher Wrapper', 'currency-switcher-woocommerce' ),
				'desc'     => sprintf( __( 'Replaced value: %s.', 'currency-switcher-woocommerce' ), '<code>' . '%currency_switcher%' . '</code>' ) . ' ' .
					sprintf( __( 'You can wrap switcher in HTML here, e.g.: %s', 'currency-switcher-woocommerce' ),
						'<code>' . esc_html( '<div id="alg_currency_switcher">%currency_switcher%</div>' ) . '</code>' ),
				'id'       => 'alg_currency_switcher_wrapper',
				'default'  => '%currency_switcher%',
				'type'     => 'textarea',
				'css'      => 'width:50%;min-width:300px;',
			),
			array(
				'title'    => __( 'Switcher Item Format', 'currency-switcher-woocommerce' ),
				'desc'     => sprintf( __( 'Replaced values: %s', 'currency-switcher-woocommerce' ),
					'<code>' . '%currency_name%' . '</code>, <code>' . '%currency_code%' . '</code>, <code>' . '%currency_symbol%' . '</code>, <code>' . '%product_price%'. '</code>' ),
				'id'       => 'alg_currency_switcher_format',
				'default'  => '%currency_name%',
				'type'     => 'textarea',
				'css'      => 'width:50%;min-width:300px;',
			),
			array(
				'title'    => __( 'Link List Switcher - Separator', 'currency-switcher-woocommerce' ),
				'id'       => 'alg_wc_currency_switcher_link_list_separator',
				'default'  => '<br>',
				'type'     => 'textarea',
				'css'      => 'width:50%;min-width:300px;',
			),
			array(
				'title'    => __( 'Reposition Page after Currency Switch', 'currency-switcher-woocommerce' ),
				'desc_tip' => __( 'Focus currency switcher after switch (with JavaScript)', 'currency-switcher-woocommerce' ),
				'desc'     => __( 'Enable', 'currency-switcher-woocommerce' ),
				'id'       => 'alg_currency_switcher_js_reposition_enabled',
				'default'  => 'no',
				'type'     => 'checkbox',
			),
			array(
				'type'     => 'sectionend',
				'id'       => 'alg_wc_currency_switcher_placement_format_options',
			),
			array(
				'title'    => __( 'Exchange Rates Final Price Correction Options', 'currency-switcher-woocommerce' ),
				'type'     => 'title',
				'id'       => 'alg_wc_currency_switcher_price_correction_options',
			),
			array(
				'title'    => __( 'Rounding', 'currency-switcher-woocommerce' ),
				'desc'     => __( 'If using exchange rates, choose rounding here.', 'currency-switcher-woocommerce' ),
				'id'       => 'alg_currency_switcher_rounding',
				'default'  => 'no_round',
				'type'     => 'select',
				'options'  => array(
					'no_round'   => __( 'No rounding', 'currency-switcher-woocommerce' ),
					'round'      => __( 'Round', 'currency-switcher-woocommerce' ),
					'round_up'   => __( 'Round up', 'currency-switcher-woocommerce' ),
					'round_down' => __( 'Round down', 'currency-switcher-woocommerce' ),
				),
			),
			array(
				'title'    => __( 'Precision', 'currency-switcher-woocommerce' ),
				'desc'     => __( 'If rounding enabled, set precision here.', 'currency-switcher-woocommerce' ),
				'id'       => 'alg_currency_switcher_rounding_precision',
				'default'  => absint( get_option( 'woocommerce_price_num_decimals', 2 ) ),
				'type'     => 'number',
				'custom_attributes' => array( 'min' => 0 ),
			),
			array(
				'title'    => __( 'Make "Pretty Price"', 'currency-switcher-woocommerce' ),
				'desc'     => __( 'Enable', 'currency-switcher-woocommerce' ),
				'desc_tip' => __( 'If enabled, this will be applied if exchange rates are used. Final converted price will be rounded, then decreased by smallest possible value. For example: $9,75 -> $10,00 -> $9,99.', 'currency-switcher-woocommerce' ),
				'id'       => 'alg_currency_switcher_make_pretty_price',
				'default'  => 'no',
				'type'     => 'checkbox',
			),
			array(
				'type'     => 'sectionend',
				'id'       => 'alg_wc_currency_switcher_price_correction_options',
			),
			array(
				'title'    => __( 'Advanced Options', 'currency-switcher-woocommerce' ),
				'type'     => 'title',
				'id'       => 'alg_wc_currency_switcher_advanced_options',
			),
			array(
				'title'    => __( 'Fix Mini Cart', 'currency-switcher-woocommerce' ),
				'desc'     => __( 'Enable', 'currency-switcher-woocommerce' ),
				'desc_tip' => __( 'Enable this option if you have issues with currencies in mini cart. It will recalculate cart totals on each page load.', 'currency-switcher-woocommerce' ),
				'id'       => 'alg_currency_switcher_fix_mini_cart',
				'default'  => 'no',
				'type'     => 'checkbox',
			),
			array(
				'title'    => __( 'Apply Currency Conversion for Fixed Amount Coupons', 'currency-switcher-woocommerce' ),
				'desc'     => __( 'Enable', 'currency-switcher-woocommerce' ),
				'id'       => 'alg_currency_switcher_fixed_amount_coupons_enabled',
				'default'  => 'yes',
				'type'     => 'checkbox',
			),
			array(
				'title'    => __( 'Apply Currency Conversion for Free Shipping Minimum Order Amount', 'currency-switcher-woocommerce' ),
				'desc'     => __( 'Enable', 'currency-switcher-woocommerce' ),
				'id'       => 'alg_currency_switcher_free_shipping_min_amount_enabled',
				'default'  => 'yes',
				'type'     => 'checkbox',
			),
			array(
				'title'    => __( 'Apply Rounding and "Pretty Price" to Shop\'s Default Currency', 'currency-switcher-woocommerce' ),
				'desc'     => __( 'Enable', 'currency-switcher-woocommerce' ),
				'id'       => 'alg_currency_switcher_default_currency_enabled',
				'default'  => 'no',
				'type'     => 'checkbox',
			),
			array(
				'title'    => __( 'Show Flags in Admin Settings Section', 'currency-switcher-woocommerce' ),
				'desc'     => __( 'Show', 'currency-switcher-woocommerce' ),
				'id'       => 'alg_currency_switcher_show_flags_in_admin_settings_enabled',
				'default'  => 'yes',
				'type'     => 'checkbox',
			),
			array(
				'title'    => __( 'Disable on URI', 'currency-switcher-woocommerce' ),
				'desc'     => __( 'List URIs where you want switcher functionality to be disabled. One per line. Leave blank if not sure.', 'currency-switcher-woocommerce' ),
				'id'       => 'alg_currency_switcher_disable_uri',
				'default'  => '',
				'type'     => 'textarea',
				'css'      => 'min-width:300px;min-height:100px;',
			),
			array(
				'title'    => __( 'Additional Price Filters', 'currency-switcher-woocommerce' ),
				'desc'     => __( 'List additional price filters to apply price conversion by currency. One per line. Leave blank if not sure.', 'currency-switcher-woocommerce' ),
				'id'       => 'alg_currency_switcher_additional_price_filters',
				'default'  => '',
				'type'     => 'textarea',
				'css'      => 'min-width:300px;min-height:100px;',
			),
			array(
				'type'     => 'sectionend',
				'id'       => 'alg_wc_currency_switcher_advanced_options',
			),
		) );
		return $settings;
	}

}

endif;

return new Alg_WC_Currency_Switcher_Settings_General();
