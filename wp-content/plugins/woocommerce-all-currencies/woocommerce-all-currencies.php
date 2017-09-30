<?php
/*
Plugin Name: All Currencies for WooCommerce
Plugin URI: https://wpcodefactory.com/item/woocommerce-all-currencies-plugin/
Description: Add all countries currencies and cryptocurrencies to WooCommerce.
Version: 2.1.1
Author: Algoritmika Ltd
Author URI: http://www.algoritmika.com
Text Domain: woocommerce-all-currencies
Domain Path: /langs
Copyright: © 2017 Algoritmika Ltd.
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
) {
	return;
}

if ( 'woocommerce-all-currencies.php' === basename( __FILE__ ) ) {
	// Check if Pro is active, if so then return
	$plugin = 'woocommerce-all-currencies-pro/woocommerce-all-currencies-pro.php';
	if (
		in_array( $plugin, apply_filters( 'active_plugins', get_option( 'active_plugins', array() ) ) ) ||
		( is_multisite() && array_key_exists( $plugin, get_site_option( 'active_sitewide_plugins', array() ) ) )
	) {
		return;
	}
}

if ( ! class_exists( 'Alg_WC_All_Currencies' ) ) :

/**
 * Main Alg_WC_All_Currencies Class
 *
 * @version 2.1.1
 * @class   Alg_WC_All_Currencies
 */
final class Alg_WC_All_Currencies {

	/**
	 * Plugin version.
	 *
	 * @var   string
	 * @since 2.1.0
	 */
	public $version = '2.1.1';

	/**
	 * @var Alg_WC_All_Currencies The single instance of the class
	 */
	protected static $_instance = null;

	/**
	 * Main Alg_WC_All_Currencies Instance
	 *
	 * Ensures only one instance of Alg_WC_All_Currencies is loaded or can be loaded.
	 *
	 * @static
	 * @return Alg_WC_All_Currencies - Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) )
			self::$_instance = new self();
		return self::$_instance;
	}

	/**
	 * Alg_WC_All_Currencies Constructor.
	 *
	 * @version 2.1.0
	 * @access  public
	 */
	function __construct() {

		// Set up localisation
		load_plugin_textdomain( 'woocommerce-all-currencies', false, dirname( plugin_basename( __FILE__ ) ) . '/langs/' );

		// Include required files
		$this->includes();

		// Settings
		if ( is_admin() ) {
			add_filter( 'woocommerce_get_settings_pages',                     array( $this, 'add_woocommerce_currencies_settings_tab' ) );
			add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'action_links' ) );
		}
	}

	/**
	 * Show action links on the plugin screen
	 *
	 * @version 2.1.0
	 * @param   mixed $links
	 * @return  array
	 */
	function action_links( $links ) {
		$custom_links = array();
		$custom_links[] = '<a href="' . admin_url( 'admin.php?page=wc-settings&tab=alg_wc_all_currencies' ) . '">' . __( 'Settings', 'woocommerce' ) . '</a>';
		if ( 'woocommerce-all-currencies.php' === basename( __FILE__ ) ) {
			$custom_links[] = '<a href="https://wpcodefactory.com/item/woocommerce-all-currencies-plugin/">' . __( 'Unlock All', 'woocommerce-all-currencies' ) . '</a>';
		}
		return array_merge( $custom_links, $links );
	}

	/**
	 * Include required core files used in admin and on the frontend.
	 *
	 * @version 2.1.1
	 */
	function includes() {
		// Admin functions
		require_once( 'includes/admin/admin-functions.php' );
		// Currencies array
		require_once( 'includes/currencies.php' );
		// Core
		$this->core = require_once( 'includes/class-wc-currencies-core.php' );
		// Settings
		require_once( 'includes/admin/class-wc-currencies-settings-section.php' );
		$settings = array();
		$settings[] = require_once( 'includes/admin/class-wc-currencies-settings-general.php' );
		$settings[] = require_once( 'includes/admin/class-wc-currencies-settings-list.php' );
		$settings[] = require_once( 'includes/admin/class-wc-currencies-settings-list-crypto.php' );
		if ( is_admin() && get_option( 'alg_wc_all_currencies_version', '' ) !== $this->version ) {
			foreach ( $settings as $section ) {
				foreach ( $section->get_settings() as $value ) {
					if ( isset( $value['default'] ) && isset( $value['id'] ) ) {
						$autoload = isset( $value['autoload'] ) ? ( bool ) $value['autoload'] : true;
						add_option( $value['id'], $value['default'], '', ( $autoload ? 'yes' : 'no' ) );
					}
				}
			}
			update_option( 'alg_wc_all_currencies_version', $this->version );
			add_action( 'admin_notices', array( $this, 'plugin_updated_notice' ) );
		}
	}

	/**
	 * plugin_updated_notice.
	 *
	 * @version 2.1.0
	 * @since   2.1.0
	 */
	function plugin_updated_notice() {
		if ( get_option( 'alg_wc_all_currencies_version', '' ) === $this->version ) {
			$class   = 'notice notice-success is-dismissible';
			$message = sprintf( __( '<strong>All Currencies for WooCommerce</strong> plugin successfully updated to version %s.', 'woocommerce-all-currencies' ), $this->version );
		} else {
			$class   = 'notice notice-error';
			$message = __( 'Something went wrong when updating <strong>All Currencies for WooCommerce</strong> plugin.', 'woocommerce-all-currencies' );
		}
		echo sprintf( '<div class="%s"><p>%s</p></div>', $class, $message );
	}

	/**
	 * Add Woocommerce Currencies settings tab to WooCommerce settings.
	 */
	function add_woocommerce_currencies_settings_tab( $settings ) {
		$settings[] = include( 'includes/admin/class-wc-settings-currencies.php' );
		return $settings;
	}

	/**
	 * Get the plugin url.
	 *
	 * @return string
	 */
	function plugin_url() {
		return untrailingslashit( plugin_dir_url( __FILE__ ) );
	}

	/**
	 * Get the plugin path.
	 *
	 * @return string
	 */
	function plugin_path() {
		return untrailingslashit( plugin_dir_path( __FILE__ ) );
	}
}

endif;

if ( ! function_exists( 'alg_wc_all_currencies' ) ) {
	/**
	 * Returns the main instance of Alg_WC_All_Currencies to prevent the need to use globals.
	 *
	 * @version 2.1.0
	 * @return  Alg_WC_All_Currencies
	 */
	function alg_wc_all_currencies() {
		return Alg_WC_All_Currencies::instance();
	}
}

alg_wc_all_currencies();
