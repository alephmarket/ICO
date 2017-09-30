<?php

/**
 * UTM Switcher
 *
 * @package   Utm_Switcher_Admin
 * @author    David Alberts and Jeff Shamley <mrrockgroin@gmail.com>
 * @license   GPL-2.0+
 * @link      https://jeffshamley.com
 * @copyright 2016
 */

/**
 * Plugin class. This class should ideally be used to work with the
 * administrative side of the WordPress site.
 *
 * If you're interested in introducing public-facing
 * functionality, then refer to `class-utm-switcher.php`
 *
 * @package Utm_Switcher_Admin
 * @author  David Alberts and Jeff Shamley <mrrockgroin@gmail.com>
 */
class Utm_Switcher_Admin {

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Slug of the plugin screen.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;

	/**
	 * Initialize the plugin by loading admin scripts & styles and adding a
	 * settings page and menu.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		$plugin				 = Utm_Switcher::get_instance();
		$this->plugin_slug	 = $plugin->get_plugin_slug();
		$this->plugin_name	 = $plugin->get_plugin_name();
		$this->version		 = $plugin->get_plugin_version();
		$this->cpts			 = $plugin->get_cpts();
		$this->plugin_screen_hook_suffix = 'utm_switcher_ref';

		add_action( 'carbon_register_fields', array( $this, 'crb_register_custom_fields' ) );

		// Load admin style sheet and JavaScript.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		// Tag Generator.
		add_action( 'admin_init', array( $this, 'add_tag_generator_utm' ), 35 );

		// Adds Help and Reference Page.
		add_action( 'admin_menu', array( $this, 'utm_switcher_register_ref_page' ) );
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
	 * Register custom fields.
	 *
	 * @since     1.0.0
	 */
	function crb_register_custom_fields() {
		include_once( UTM_SWITCHER_PLUGIN_PATH . '/includes/post-meta.php' );
	}

	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_styles() {
		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		$plugin = Utm_Switcher::get_instance();
		if ( $plugin->startsWith( $screen->id, $this->plugin_screen_hook_suffix ) || strpos( $_SERVER[ 'REQUEST_URI' ], 'index.php' ) || strpos( $_SERVER[ 'REQUEST_URI' ], get_bloginfo( 'wpurl' ) . '/wp-admin/' ) ) {
			wp_enqueue_style( $this->plugin_slug . '-admin-styles', plugins_url( 'assets/css/admin.css', __FILE__ ), array( 'dashicons' ), Utm_Switcher::VERSION );
		}
	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts() {
		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		$plugin = Utm_Switcher::get_instance();
		if ( $plugin->startsWith( $screen->id, $this->plugin_screen_hook_suffix ) ) {
			wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'assets/js/admin.js', __FILE__ ), array( 'jquery', 'jquery-ui-tabs' ), Utm_Switcher::VERSION );
		}
	}

	/**
	 * Adds a submenu page under a custom post type parent.
	 */
	public function utm_switcher_register_ref_page() {
		add_submenu_page(
			'edit.php?post_type=utm_switcher',
			__( 'UTM Switcher Help', 'utm-switcher' ),
			__( 'Help', 'utm-switcher' ),
			'manage_options',
			$this->plugin_screen_hook_suffix . '_general',
			array( $this, 'utm_switcher_admin_page_general_callback' )
		);
		add_submenu_page(
			null,
			__( 'UTM Switcher Help', 'utm-switcher' ),
			__( 'Help', 'utm-switcher' ),
			'manage_options',
			$this->plugin_screen_hook_suffix . '_cf7',
			array( $this, 'utm_switcher_admin_page_cf7_callback' )
		);
	}

	/**
	 * Display callback for the submenu page.
	 */
	public function utm_switcher_admin_page_general_callback() {
		include_once( 'views/admin_page_general.php' );
	}

	/**
	 * Display callback for the submenu page.
	 */
	public function utm_switcher_admin_page_cf7_callback() {
		include_once( 'views/admin_page_cf7.php' );
	}

	/**
	 * Add the WPCF7 Tag.
	 *
	 * @since     1.0.0
	 */
	public function add_tag_generator_utm() {
		if ( function_exists( 'wpcf7_add_tag_generator' ) ) {
			wpcf7_add_tag_generator( 'UTM', __( 'UTM', 'utm-switcher' ), 'utm-switcher-tag-pane', array( $this, 'utm_switcher_tag_pane' ) );
		}
	}

	/**
	 * Add the WPCF7 Tag Pane View.
	 *
	 * @since     1.0.0
	 *
	 * @param string $contact_form The Contact Form.
	 * @param string $args The Arguments.
	 */
	public function utm_switcher_tag_pane( $contact_form, $args = "" ) {
		include_once( 'views/utm_switcher_tag_pane.php' );
	}
}
