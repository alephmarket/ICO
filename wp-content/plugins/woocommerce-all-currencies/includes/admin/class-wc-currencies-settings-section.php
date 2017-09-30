<?php
/**
 * WooCommerce All Currencies - Settings Section
 *
 * @version 2.1.1
 * @since   2.1.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_All_Currencies_Settings_Section' ) ) :

class Alg_WC_All_Currencies_Settings_Section {

	/**
	 * Constructor.
	 *
	 * @version 2.1.1
	 * @since   2.1.0
	 */
	function __construct() {
		add_filter( 'woocommerce_get_sections_alg_wc_all_currencies',              array( $this, 'settings_section' ) );
		add_filter( 'woocommerce_get_settings_alg_wc_all_currencies_' . $this->id, array( $this, 'get_settings' ), PHP_INT_MAX );
		add_filter( 'init',                                                        array( $this, 'add_section_settings' ), PHP_INT_MAX );
	}

	/**
	 * add_section_settings.
	 *
	 * @version 2.1.1
	 * @since   2.1.1
	 */
	function add_section_settings( $sections ) {
		add_filter( 'alg_wc_all_currencies_settings_' . $this->id, array( $this, 'get_section_settings' ) );
	}

	/**
	 * settings_section.
	 *
	 * @version 2.1.0
	 * @since   2.1.0
	 */
	function settings_section( $sections ) {
		$sections[ $this->id ] = $this->desc;
		return $sections;
	}

	/**
	 * get_settings.
	 *
	 * @version 2.1.1
	 * @since   2.1.0
	 */
	function get_settings() {
		return array_merge( apply_filters( 'alg_wc_all_currencies_settings_' . $this->id, array() ), array(
			array(
				'title'    => __( 'Reset Section Settings', 'woocommerce-all-currencies' ),
				'type'     => 'title',
				'id'       => 'alg_wc_all_currencies' . '_' . $this->id . '_reset_options',
			),
			array(
				'title'    => __( 'Reset Settings', 'woocommerce-all-currencies' ),
				'desc'     => '<strong>' . __( 'Reset', 'woocommerce-all-currencies' ) . '</strong>',
				'id'       => 'alg_wc_all_currencies' . '_' . $this->id . '_reset',
				'default'  => 'no',
				'type'     => 'checkbox',
			),
			array(
				'type'     => 'sectionend',
				'id'       => 'alg_wc_all_currencies' . '_' . $this->id . '_reset_options',
			),
		) );
	}

}

endif;
