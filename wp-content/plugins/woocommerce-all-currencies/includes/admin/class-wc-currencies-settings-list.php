<?php
/**
 * WooCommerce All Currencies - List Country Section Settings
 *
 * @version 2.1.1
 * @since   2.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_All_Currencies_Settings_List' ) ) :

class Alg_WC_All_Currencies_Settings_List extends Alg_WC_All_Currencies_Settings_Section {

	/**
	 * Constructor.
	 *
	 * @version 2.1.1
	 * @since   2.0.0
	 */
	function __construct() {
		$this->id   = 'currencies_list';
		$this->desc = __( 'Country Currencies', 'woocommerce-all-currencies' );
		parent::__construct();
	}

	/**
	 * get_section_settings.
	 *
	 * @version 2.1.1
	 * @since   2.0.0
	 */
	function get_section_settings() {
		return alg_wcac_get_list_section_settings( 'country' );
	}

}

endif;

return new Alg_WC_All_Currencies_Settings_List();
