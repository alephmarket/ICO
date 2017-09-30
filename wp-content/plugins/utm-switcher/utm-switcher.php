<?php

/**
 * The WordPress Plugin Boilerplate.
 *
 * A foundation off of which to build well-documented WordPress plugins that
 * also follow WordPress Coding Standards and PHP best practices.
 *
 * @package   Utm_Switcher
 * @author    David Alberts and Jeff Shamley <mrrockgroin@gmail.com>
 * @license   GPL-2.0+
 * @link      https://jeffshamley.com
 * @copyright 2016 
 *
 * @wordpress-plugin
 * Plugin Name:       UTM Switcher
 * Plugin URI:        https://wordpress.org/plugins/utm-switcher/
 * Description:       Allows GET variables from Social Media Campaigns to modify content based on criteria. Also, adds these variables to CF7 Forms
 * Version:           1.0.2
 * Author:            David Alberts and Jeff Shamley
 * Author URI:        https://jeffshamley.com
 * Text Domain:       utm-switcher
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
	die;
}

//Define Paths for later use
if ( ! defined( 'UTM_SWITCHER_PLUGIN_PATH' ) ) {
	define('UTM_SWITCHER_PLUGIN_PATH', plugin_dir_path( __FILE__ ));
}

if ( ! defined( 'UTM_SWITCHER_PLUGIN_URL' ) ) {
	define('UTM_SWITCHER_PLUGIN_URL', untrailingslashit( plugins_url( basename( plugin_dir_path( __FILE__ ) ), basename( __FILE__ ) ) ));
}

//Define Paths for Carbon Fields, if they aren't already set
if ( ! defined( 'Carbon_Fields\DIR' ) ) {
	define( 'Carbon_Fields\DIR', UTM_SWITCHER_PLUGIN_PATH .'/vendor/htmlburger/carbon-fields' );
}

if ( ! defined( 'Carbon_Fields\URL' ) ) {
	define( 'Carbon_Fields\URL', UTM_SWITCHER_PLUGIN_URL .'/vendor/htmlburger/carbon-fields' );
}

//Load vendor components
require_once( plugin_dir_path( __FILE__ ) . 'vendor/autoload.php' );

/*
 * ------------------------------------------------------------------------------
 * Public-Facing Functionality
 * ------------------------------------------------------------------------------
 */

//Textdomain
require_once( plugin_dir_path( __FILE__ ) . 'includes/load_textdomain.php' );


//Main Public class
require_once( plugin_dir_path( __FILE__ ) . 'public/class-utm-switcher.php' );

//Hooks on activate/deactivate
register_activation_hook( __FILE__, array( 'Utm_Switcher', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Utm_Switcher', 'deactivate' ) );

//Get class instance
add_action( 'plugins_loaded', array( 'Utm_Switcher', 'get_instance' ));

/*
 * -----------------------------------------------------------------------------
 * Dashboard and Administrative Functionality
 * -----------------------------------------------------------------------------
*/

//Load CPT
require_once( plugin_dir_path( __FILE__ )."post-types/utm-switcher.php" );


//Engage
if ( is_admin() && (!defined( 'DOING_AJAX' ) || !DOING_AJAX ) ) {
	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-utm-switcher-admin.php' );
	add_action( 'plugins_loaded', array( 'Utm_Switcher_Admin', 'get_instance' ) );
}
