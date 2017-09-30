<?php
/**
 * WooCommerce All Currencies - General Section Settings
 *
 * @version 2.1.1
 * @since   2.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_All_Currencies_Settings_General' ) ) :

class Alg_WC_All_Currencies_Settings_General extends Alg_WC_All_Currencies_Settings_Section {

	/**
	 * Constructor.
	 *
	 * @version 2.1.1
	 */
	function __construct() {
		$this->id   = '';
		$this->desc = __( 'General', 'woocommerce-all-currencies' );
		parent::__construct();
		add_action( 'admin_head', array( $this, 'add_custom_css' ) );
		if ( 'yes' === get_option( 'alg_wc_all_currencies_enabled', 'yes' ) ) {
			add_filter( 'woocommerce_general_settings', array( $this, 'add_edit_currency_symbol_field' ), PHP_INT_MAX );
		}
	}

	/**
	 * add_custom_css.
	 *
	 * @version 2.1.1
	 */
	function add_custom_css() {
		if (
			isset( $_GET['page'] )    && 'wc-settings'           === $_GET['page'] &&
			isset( $_GET['tab'] )     && 'alg_wc_all_currencies' === $_GET['tab'] &&
			isset( $_GET['section'] ) && ( 'currencies_list' === $_GET['section'] || 'crypto_currencies_list' === $_GET['section'] )
		) {
			echo '<style type="text/css">' . PHP_EOL .
				'table.form-table th.titledesc { padding-top: 0px !important; padding-bottom: 0px !important; }' . PHP_EOL .
				'table.form-table td.forminp-text { padding-top: 0px !important; padding-bottom: 0px !important; }' . PHP_EOL .
			'</style>' . PHP_EOL;
		}
	}

	/**
	 * add_edit_currency_symbol_field.
	 *
	 * @version 2.1.1
	 */
	function add_edit_currency_symbol_field( $settings ) {
		$updated_settings = array();
		foreach ( $settings as $section ) {
			if ( isset( $section['id'] ) && 'woocommerce_currency_pos' == $section['id'] ) {
				$updated_settings[] = array(
					'name'     => __( 'Currency Symbol', 'woocommerce-all-currencies' ),
					'desc_tip' => __( 'This sets the currency symbol.', 'woocommerce-all-currencies' ),
					'id'       => 'woocommerce_currencies_pro_currency_' . get_woocommerce_currency(),
					'type'     => 'text',
					'default'  => alg_wc_all_currencies()->core->get_default_currency_symbol(),
					'css'      => 'width: 50px;',
					'desc'     => apply_filters( 'alg_wc_all_currencies_filter', sprintf( __( 'You will need <a target="_blank" href="%s">All Currencies for WooCommerce Pro</a> plugin to change currency symbol.', 'woocommerce-all-currencies' ), 'https://wpcodefactory.com/item/woocommerce-all-currencies-plugin/' ), 'settings' ),
					'custom_attributes' => apply_filters( 'alg_wc_all_currencies_filter', array( 'readonly' => 'readonly' ), 'settings' ),
				);
			}
			$updated_settings[] = $section;
		}
		return $updated_settings;
	}

	/**
	 * get_section_settings.
	 *
	 * @version 2.1.1
	 */
	function get_section_settings() {
		$settings = array(
			array(
				'title'    => __( 'General Options', 'woocommerce-all-currencies' ),
				'type'     => 'title',
				'id'       => 'alg_wc_all_currencies_options',
			),
			array(
				'title'    => __( 'WooCommerce All Currencies', 'woocommerce-all-currencies' ),
				'desc'     => '<strong>' . __( 'Enable plugin', 'woocommerce-all-currencies' ) . '</strong>',
				'desc_tip' => __( 'Add all world currencies to your WooCommerce store.', 'woocommerce-all-currencies' ),
				'id'       => 'alg_wc_all_currencies_enabled',
				'default'  => 'yes',
				'type'     => 'checkbox'
			),
			array(
				'type'     => 'sectionend',
				'id'       => 'alg_wc_all_currencies_options',
			),
			array(
				'title'    => __( 'Lists Options', 'woocommerce-all-currencies' ),
				'type'     => 'title',
				'id'       => 'alg_wc_all_currencies_lists_options',
			),
			array(
				'title'    => __( 'Add Country Currencies', 'woocommerce-all-currencies' ),
				'desc'     => __( 'Add', 'woocommerce-all-currencies' ),
				'type'     => 'checkbox',
				'id'       => 'alg_wc_all_currencies_list_country_enabled',
				'default'  => 'yes',
			),
			array(
				'title'    => __( 'Add Crypto Currencies', 'woocommerce-all-currencies' ),
				'desc'     => __( 'Add', 'woocommerce-all-currencies' ),
				'type'     => 'checkbox',
				'id'       => 'alg_wc_all_currencies_list_crypto_enabled',
				'default'  => 'yes',
			),
			array(
				'type'     => 'sectionend',
				'id'       => 'alg_wc_all_currencies_lists_options',
			),
			array(
				'title'    => __( 'Symbol Options', 'woocommerce-all-currencies' ),
				'type'     => 'title',
				'id'       => 'alg_wc_all_currencies_symbol_options',
			),
			array(
				'name'     => __( 'Current Currency Symbol', 'woocommerce-all-currencies' ) . ' (' . get_woocommerce_currency() . ')',
				'id'       => 'woocommerce_currencies_pro_currency_' . get_woocommerce_currency(),
				'type'     => 'text',
				'default'  => alg_wc_all_currencies()->core->get_default_currency_symbol(),
				'css'      => 'width: 50px;',
				'desc'     => apply_filters( 'alg_wc_all_currencies_filter', sprintf( __( 'You will need <a target="_blank" href="%s">All Currencies for WooCommerce Pro</a> plugin to change currency symbol.', 'woocommerce-all-currencies' ), 'https://wpcodefactory.com/item/woocommerce-all-currencies-plugin/' ), 'settings' ),
				'custom_attributes' => apply_filters( 'alg_wc_all_currencies_filter', array( 'readonly' => 'readonly' ), 'settings' ),
			),
			array(
				'title'    => __( 'Use Currency Code as Symbol', 'woocommerce-all-currencies' ),
				'desc'     => __( 'Enable', 'woocommerce-all-currencies' ),
				'id'       => 'alg_wc_all_currencies_use_code_as_symbol',
				'default'  => 'no',
				'type'     => 'checkbox',
			),
			array(
				'title'    => __( 'Hide Currency Symbol on Frontend', 'woocommerce-all-currencies' ),
				'desc'     => __( 'Hide', 'woocommerce-all-currencies' ),
				'id'       => 'alg_wc_all_currencies_hide_symbol',
				'default'  => 'no',
				'type'     => 'checkbox',
			),
			array(
				'type'     => 'sectionend',
				'id'       => 'alg_wc_all_currencies_symbol_options',
			),
		);
		return $settings;
	}

}

endif;

return new Alg_WC_All_Currencies_Settings_General();
