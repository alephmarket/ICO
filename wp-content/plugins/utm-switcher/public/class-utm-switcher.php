<?php

/**
 * UTM Switcher
 *
 * @package   Utm_Switcher
 * @author    David Alberts and Jeff Shamley <mrrockgroin@gmail.com>
 * @license   GPL-2.0+
 * @link      https://jeffshamley.com
 * @copyright 2016
 */

/**
 * Plugin class. This class should ideally be used to work with the
 * public-facing side of the WordPress site.
 *
 * If you're interested in introducing administrative or dashboard
 * functionality, then refer to `class-utm-switcher-admin.php`
 *
 * @package Utm_Switcher
 * @author  David Alberts and Jeff Shamley <mrrockgroin@gmail.com>
 */
class Utm_Switcher {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */
	const VERSION = '1.0.0';

	/**
	 * Unique identifier for your plugin.
	 *
	 * The variable name is used as the text domain when internationalizing strings
	 * of text. Its value should match the Text Domain file header in the main
	 * plugin file.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected static $plugin_slug = 'utm-switcher';

	/**
	 * Unique identifier for your plugin.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected static $plugin_name = 'UTM Switcher';

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Array of cpts of the plugin
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected $cpts = array( 'utm-switcher' );

	/**
	 * Initialize the plugin by setting localization and loading public scripts
	 * and styles.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {
		// Activate plugin when new blog is added.
		add_action( 'wpmu_new_blog', array( $this, 'activate_new_site' ) );
		// Enqueue Public Scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		// Enqueue Vars
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_js_vars' ) );
		// Add init action for CF7
		add_action( 'wpcf7_init', array( $this, 'wpcf7_utm_loader' ), 10 );
		// Filter data for UTM to mail tag
		add_filter( 'wpcf7_posted_data',  array( $this, 'filter_wpcf7_posted_data' ), 10, 1 ); 
	}

	/**
	 * Return the plugin slug.
	 *
	 * @since    1.0.0
	 *
	 * @return    Plugin slug variable.
	 */
	public function get_plugin_slug() {
		return self::$plugin_slug;
	}

	/**
	 * Return the plugin name.
	 *
	 * @since    1.0.0
	 *
	 * @return    Plugin name variable.
	 */
	public function get_plugin_name() {
		return self::$plugin_name;
	}

	/**
	 * Return the version
	 *
	 * @since    1.0.0
	 *
	 * @return    Version const.
	 */
	public function get_plugin_version() {
		return self::VERSION;
	}

	/**
	 * Return the cpts
	 *
	 * @since    1.0.0
	 *
	 * @return    Cpts array
	 */
	public function get_cpts() {
		return $this->cpts;
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Fired when the plugin is activated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Activate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       activated on an individual blog.
	 */
	public static function activate( $network_wide ) {
		if ( function_exists( 'is_multisite' ) && is_multisite() ) {
			if ( $network_wide ) {
				// Get all blog ids.
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_activate();

					restore_current_blog();
				}
			} else {
				self::single_activate();
			}
		} else {
			self::single_activate();
		}
	}

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Deactivate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       deactivated on an individual blog.
	 */
	public static function deactivate( $network_wide ) {
		if ( function_exists( 'is_multisite' ) && is_multisite() ) {
			if ( $network_wide ) {
				// Get all blog ids.
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_deactivate();

					restore_current_blog();
				}
			} else {
				self::single_deactivate();
			}
		} else {
			self::single_deactivate();
		}
	}

	/**
	 * Fired when a new site is activated with a WPMU environment.
	 *
	 * @since    1.0.0
	 *
	 * @param    int $blog_id ID of the new blog.
	 */
	public function activate_new_site( $blog_id ) {
		if ( 1 !== did_action( 'wpmu_new_blog' ) ) {
			return;
		}

		switch_to_blog( $blog_id );
		self::single_activate();
		restore_current_blog();
	}

	/**
	 * Get all blog ids of blogs in the current network that are:
	 * - not archived
	 * - not spam
	 * - not deleted
	 *
	 * @since    1.0.0
	 *
	 * @return   array|false    The blog ids, false if no matches.
	 */
	private static function get_blog_ids() {
		global $wpdb;

		// Get an array of blog ids.
		$sql = 'SELECT blog_id FROM ' . $wpdb->blogs .
		" WHERE archived = '0' AND spam = '0'
			AND deleted = '0'";

		return $wpdb->get_col( $sql );
	}

	/**
	 * Fired for each blog when the plugin is activated.
	 *
	 * @since    1.0.0
	 */
	private static function single_activate() {
		// Requirements Detection System - read the doc/example in the library file.
		require_once( plugin_dir_path( __FILE__ ) . 'includes/requirements.php' );
		new Utm_Switcher_Plugin_Requirements( self::$plugin_name, self::$plugin_slug, array(
			'WP' => new Utm_Switcher_WordPress_Requirement( '4.0.0' ),
		) );
		
	}

	/**
	 * Fired for each blog when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 */
	private static function single_deactivate() {
		// @TODO: Define deactivation functionality here
		// Clear the permalinks
		flush_rewrite_rules();
	}

	/**
	 * Register and enqueues public-facing JavaScript files.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		if ( !defined( 'WP_DEBUG' ) || WP_DEBUG == false ) {
			wp_enqueue_script( $this->get_plugin_slug() . '-plugin-script', plugins_url( 'dist/scripts/public.js', __FILE__ ), array( 'jquery' ), self::VERSION );
		} else {
			wp_enqueue_script( $this->get_plugin_slug() . '-plugin-script', plugins_url( 'assets/js/public.js', __FILE__ ), array( 'jquery' ), self::VERSION );
		}
	}

	/**
	 * Print the PHP var in the HTML of the frontend for access by JavaScript
	 *
	 * @since    1.0.0
	 */
	public function enqueue_js_vars() {
		//Localize to add information about switchers
		wp_localize_script( $this->get_plugin_slug() . '-plugin-script', 'utm_switchers', $this->get_switchers() );
	}

	/**
	 * Registers the Custom Fields.
	 *
	 * @since    1.0.0
	 */
	function crb_register_custom_fields() {
		include_once( UTM_SWITCHER_PLUGIN_PATH . '/includes/post-meta.php' );
	}

	/**
	 * Gets the Switchers using get_posts.
	 *
	 * @since    1.0.0
	 */
	public function get_switchers() {

		$campaign_switcher	 = array();
		$campaign_switchers	 = array();

		$args = array(
			'posts_per_page' => -1,
			'post_type'		 => 'utm_switcher',
		);

		$utm_switchers = get_posts( $args );

		foreach ( $utm_switchers as $utm_switcher ) {
			$campaign_switcher[ 'match_element' ]	 = carbon_get_post_meta( $utm_switcher->ID, 'match_element' );
			$campaign_switcher[ 'switcher_type' ]	 = carbon_get_post_meta( $utm_switcher->ID, 'switcher_type' );
			$campaign_switcher[ 'switchers' ]		 = carbon_get_post_meta( $utm_switcher->ID, 'campaign_switchers', 'complex' );
			$campaign_switchers[]				 = $campaign_switcher;
		}

		return $campaign_switchers;
	}

	/**
	 * Adds the wpcf7 shortcode.
	 *
	 * @since    1.0.0
	 */
	public function wpcf7_utm_loader() {
		if ( function_exists( 'wpcf7_add_shortcode' ) ) {
			wpcf7_add_shortcode( 'UTM', array( $this, 'wpcf7_utm_shortcode_handler' ), true );
		}
	}

	/**
	 * Handles the wpcf7 shortcode.
	 *
	 * @since    1.0.0
	 *
	 * @param	mixed $tag The Tag.
	 */
	public function wpcf7_utm_shortcode_handler( $tag ) {
		$tag = new WPCF7_Shortcode( $tag );

		if ( empty( $tag->name ) ) {
			return '';
		}

		$validation_error = wpcf7_get_validation_error( $tag->name );

		$class = wpcf7_form_controls_class( 'utm' );

		$atts						 = array();
		$atts[ 'class' ]				 = $tag->get_class_option( $class );
		$atts[ 'id' ]					 = $tag->get_option( 'id', 'id', true );
		$atts[ 'message' ]			 = __( 'Please leave this field empty.', 'utm-switcher' );
		$atts[ 'name' ]				 = $tag->name;
		$atts[ 'type' ]				 = $tag->type;
		$atts[ 'validation_error' ]	 = $validation_error;
		$inputid					 = (!empty( $atts[ 'id' ] )) ? 'id="' . $atts[ 'id' ] . '" ' : '';
		$html						 = '<span class="wpcf7-form-control-wrap utm-wrap ' . $atts[ 'name' ] . '-wrap" style="display:none !important;visibility:hidden !important;">';
		$html .= '<input ' . $inputid . 'class="utm-field utm-field-source ' . $atts[ 'class' ] . '"  type="hidden" name="utm-source-' . $atts[ 'name' ] . '" value="" tabindex="-1" />';
		$html .= '<input ' . $inputid . 'class="utm-field utm-field-medium ' . $atts[ 'class' ] . '"  type="hidden" name="utm-medium-' . $atts[ 'name' ] . '" value="" tabindex="-1" />';
		$html .= '<input ' . $inputid . 'class="utm-field utm-field-campaign ' . $atts[ 'class' ] . '"  type="hidden" name="utm-campaign-' . $atts[ 'name' ] . '" value="" tabindex="-1" />';
		$html .= '</span>';

		// Hook for filtering finished UTM form element.
		return apply_filters( 'wpcf7_utm_html_output', $html, $atts );
	}
	
	/**
	 * Replaces missing UTM data into the mail tag
	 *
	 * @since    1.0.0
	 *
	 * @param    array $posted_data Data posted to the mail function.
	 */
	public function filter_wpcf7_posted_data( $posted_data ){
		// nothing's here... do nothing...
		if( empty( $posted_data ) ){
			return $posted_data;
		}
		//Find the UTM key
		foreach( $posted_data as $key => $element ){
			if($this->startsWith( $key, 'UTM-' )){
				$UTM_Key = $key;
			}
		}
		//The key isn't there.
		if( empty( $UTM_Key ) ){
			return $posted_data;
		}
		
		foreach ( $posted_data as $key => $element ){
			if($this->endsWith( $key, $UTM_Key ) && ! empty($element) ){
				$keyname = preg_replace('/-'.$UTM_Key.'/', '', $key);
				$UTM_data[$keyname] = $element;
			}
		}
		
		$posted_data[$UTM_Key] = implode( ', ', $UTM_data );
				
		return $posted_data; 
	}
		
	/**
	 * Helper function to check if string starts with.
	 *
	 * @since     1.0.0
	 *
	 * @param string $haystack The string we are searching.
	 * @param string $needle The string we are looking for.
	 */
	public function startsWith($haystack, $needle) {
		// search backwards starting from haystack length characters from the end
		return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
	}

	/**
	 * Helper function to check if string ends with.
	 *
	 * @since     1.0.0
	 *
	 * @param string $haystack The string we are searching.
	 * @param string $needle The string we are looking for.
	 */
	public function endsWith($haystack, $needle) {
		// search forward starting from end minus needle length characters
		return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
	}

	/**
	 * Helper function to write a log.
	 *
	 * @since     1.0.0
	 *
	 * @param mixed $log A string or array or object to log.
	 */
	private function write_log( $log ) {
		if ( true === WP_DEBUG ) {
			if ( is_array( $log ) || is_object( $log ) ) {
				file_put_contents( UTM_SWITCHER_PLUGIN_PATH . '/utm_switcher.log', print_r( $log, true ), FILE_APPEND );
			} else {
				file_put_contents( UTM_SWITCHER_PLUGIN_PATH . '/utm_switcher.log', $log, FILE_APPEND );
			}
		}
	}

}
