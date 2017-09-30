<?php
/*
Plugin Name: Currency Switcher for WooCommerce
Plugin URI: https://wpcodefactory.com/item/currency-switcher-woocommerce-wordpress-plugin/
Description: Currency Switcher for WooCommerce.
Version: 2.5.2
Author: Algoritmika Ltd
Author URI: http://www.algoritmika.com
Text Domain: currency-switcher-woocommerce
Domain Path: /langs
Copyright: � 2017 Tom Anbinder
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Check if WooCommerce is active
$plugin = 'woocommerce/woocommerce.php';
if (
	! in_array( $plugin, apply_filters( 'active_plugins', get_option( 'active_plugins', array() ) ) ) &&
	! ( is_multisite() && array_key_exists( $plugin, get_site_option( 'active_sitewide_plugins', array() ) ) )
) return;

if ( 'currency-switcher-woocommerce.php' === basename( __FILE__ ) ) {
	// Check if Pro is active, if so then return
	$plugin = 'currency-switcher-woocommerce-pro/currency-switcher-woocommerce-pro.php';
	if (
		in_array( $plugin, apply_filters( 'active_plugins', get_option( 'active_plugins', array() ) ) ) ||
		( is_multisite() && array_key_exists( $plugin, get_site_option( 'active_sitewide_plugins', array() ) ) )
	) return;
}

// Constants
require_once( 'includes/alg-constants.php' );

if ( ! class_exists( 'Alg_WC_Currency_Switcher' ) ) :

/**
 * Main Alg_WC_Currency_Switcher Class
 *
 * @class   Alg_WC_Currency_Switcher
 * @version 2.5.0
 * @since   1.0.0
 */
final class Alg_WC_Currency_Switcher {

	/**
	 * Currency Switcher plugin version.
	 *
	 * @var   string
	 * @since 1.0.0
	 */
	public $version = '2.5.2';

	/**
	 * @var   Alg_WC_Currency_Switcher The single instance of the class
	 * @since 1.0.0
	 */
	protected static $_instance = null;

	/**
	 * Main Alg_WC_Currency_Switcher Instance
	 *
	 * Ensures only one instance of Alg_WC_Currency_Switcher is loaded or can be loaded.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @static
	 * @return Alg_WC_Currency_Switcher - Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Alg_WC_Currency_Switcher Constructor.
	 *
	 * @version 2.0.0
	 * @since   1.0.0
	 * @access  public
	 * @todo    (maybe) AJAX in admin "Currencies" settings section
	 * @todo    unschedule crons on plugin deactivate
	 * @todo    check for caching issues
	 * @todo    (maybe) add all currencies (so no other additional plugin is required)
	 */
	function __construct() {

		// Set up localisation
		load_plugin_textdomain( 'currency-switcher-woocommerce', false, dirname( plugin_basename( __FILE__ ) ) . '/langs/' );

		// Include required files
		$this->includes();

		// Settings & Scripts
		if ( is_admin() ) {
			add_filter( 'woocommerce_get_settings_pages', array( $this, 'add_woocommerce_settings_tab' ) );
			add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'action_links' ) );
		}
	}

	/**
	 * Show action links on the plugin screen
	 *
	 * @version 2.4.0
	 * @since   1.0.0
	 * @param   mixed $links
	 * @return  array
	 */
	function action_links( $links ) {
		$settings_link   = '<a href="' . admin_url( 'admin.php?page=wc-settings&tab=alg_wc_currency_switcher' ) . '">' . __( 'Settings', 'woocommerce' )   . '</a>';
		$unlock_all_link = '<a target="_blank" href="' . esc_url( 'https://wpcodefactory.com/item/currency-switcher-woocommerce-wordpress-plugin/' ) . '">' . __( 'Unlock all', 'woocommerce' ) . '</a>';
		$custom_links    = ( PHP_INT_MAX === apply_filters( 'alg_wc_currency_switcher_plugin_option', 2 ) ) ? array( $settings_link ) : array( $settings_link, $unlock_all_link );
		return array_merge( $custom_links, $links );
	}

	/**
	 * Include required core files used in admin and on the frontend.
	 *
	 * @version 2.5.0
	 * @since   1.0.0
	 * @todo    (maybe) import/export all settings
	 */
	private function includes() {

		// Functions
		if ( ! is_admin() ) {
			// Frontend
			require_once( 'includes/functions/alg-switcher-selector-functions.php' );
		}
		require_once( 'includes/functions/alg-switcher-functions.php' );
		require_once( 'includes/functions/alg-switcher-country-functions.php' );
		require_once( 'includes/functions/alg-switcher-locale-functions.php' );

		// Settings
		require_once( 'includes/admin/settings/class-alg-wc-currency-switcher-settings-section.php' );
		$settings = array();
		$settings[] = require_once( 'includes/admin/settings/class-alg-wc-currency-switcher-settings-general.php' );
		$settings[] = require_once( 'includes/admin/settings/class-alg-wc-currency-switcher-settings-currencies.php' );
		$settings[] = require_once( 'includes/admin/settings/class-alg-wc-currency-switcher-settings-exchange-rates.php' );
		$settings[] = require_once( 'includes/admin/settings/class-alg-wc-currency-switcher-settings-currency-countries.php' );
		$settings[] = require_once( 'includes/admin/settings/class-alg-wc-currency-switcher-settings-currency-locales.php' );
		$settings[] = require_once( 'includes/admin/settings/class-alg-wc-currency-switcher-settings-price-formats.php' );
		$settings[] = require_once( 'includes/admin/settings/class-alg-wc-currency-switcher-settings-flags.php' );
		if ( is_admin() && get_option( 'alg_currency_switcher_version', '' ) !== $this->version ) {
			foreach ( $settings as $section ) {
				foreach ( $section->get_settings() as $value ) {
					if ( isset( $value['default'] ) && isset( $value['id'] ) ) {
						$autoload = isset( $value['autoload'] ) ? (bool) $value['autoload'] : true;
						add_option( $value['id'], $value['default'], '', $autoload );
					}
				}
			}
			update_option( 'alg_currency_switcher_version', $this->version );
		}

		// Per product Settings
		if ( 'yes' === get_option( 'alg_currency_switcher_per_product_enabled', 'yes' ) ) {
			require_once( 'includes/admin/class-alg-wc-currency-switcher-per-product.php' );
		}

		// Crons & Reports
		if ( 'yes' === get_option( 'alg_wc_currency_switcher_enabled', 'yes' ) ) {
			if ( 'manual' != get_option( 'alg_currency_switcher_exchange_rate_update', 'manual' ) ) {
				require_once( 'includes/class-alg-exchange-rates-crons.php' );
			}
			if ( is_admin() ) {
				require_once( 'includes/admin/class-alg-currency-reports.php' );
			}
		}

		// Widget
		require_once( 'includes/class-alg-widget-currency-switcher.php' );

		// Core
		$this->core = require_once( 'includes/class-alg-wc-currency-switcher.php' );
	}

	/**
	 * Add Currency Switcher Plugin settings tab to WooCommerce settings.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function add_woocommerce_settings_tab( $settings ) {
		$settings[] = include( 'includes/admin/settings/class-wc-settings-currency-switcher.php' );
		return $settings;
	}

	/**
	 * Get the plugin url.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @return  string
	 */
	function plugin_url() {
		return untrailingslashit( plugin_dir_url( __FILE__ ) );
	}

	/**
	 * Get the plugin path.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @return  string
	 */
	function plugin_path() {
		return untrailingslashit( plugin_dir_path( __FILE__ ) );
	}

}

endif;

/**
 * Returns the main instance of Alg_WC_Currency_Switcher to prevent the need to use globals.
 *
 * @version 1.0.0
 * @since   1.0.0
 * @return  Alg_WC_Currency_Switcher
 */
if ( ! function_exists( 'alg_wc_currency_switcher_plugin' ) ) {
	function alg_wc_currency_switcher_plugin() {
		return Alg_WC_Currency_Switcher::instance();
	}
}

alg_wc_currency_switcher_plugin();
