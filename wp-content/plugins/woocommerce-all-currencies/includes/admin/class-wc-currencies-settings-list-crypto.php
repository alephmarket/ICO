<?php
/**
 * WooCommerce All Currencies - List Cryptocurrencies Section Settings
 *
 * @version 2.1.1
 * @since   2.1.1
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_All_Currencies_Settings_List_Crypto' ) ) :

class Alg_WC_All_Currencies_Settings_List_Crypto extends Alg_WC_All_Currencies_Settings_Section {

	/**
	 * Constructor.
	 *
	 * @version 2.1.1
	 * @since   2.1.1
	 */
	function __construct() {
		$this->id   = 'crypto_currencies_list';
		$this->desc = __( 'Crypto Currencies', 'woocommerce-all-currencies' );
		parent::__construct();
	}

	/**
	 * get_section_settings.
	 *
	 * @version 2.1.1
	 * @since   2.1.1
	 */
	function get_section_settings() {
		return alg_wcac_get_list_section_settings( 'crypto' );
	}

}

endif;

return new Alg_WC_All_Currencies_Settings_List_Crypto();
