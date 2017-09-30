<?php



/**

 * The admin-specific functionality of the plugin.

 *

 * @since      1.0.0

 *

 * @package    checkout_editor_woo

 * @subpackage checkout_editor_woo/admin

 */



/**

 * The admin-specific functionality of the plugin.

 *

 * Defines the plugin name, version, and two examples hooks for how to

 * enqueue the admin-specific stylesheet and JavaScript.

 *

 * @package    checkout_editor_woo

 * @subpackage checkout_editor_woo/admin

 * @author     Junaid <junaidali.it@gmail.com>

 */

class Wc_Checkout_Form_Editor_Admin {



	/**

	 * The ID of this plugin.

	 *

	 * @since    1.0.0

	 * @access   private

	 * @var      string    $plugin_name    The ID of this plugin.

	 */

	private $plugin_name;



	/**

	 * The version of this plugin.

	 *

	 * @since    1.0.0

	 * @access   private

	 * @var      string    $version    The current version of this plugin.

	 */

	private $version;



	/**

	 * Initialize the class and set its properties.

	 *

	 * @since    1.0.0

	 * @param      string    $plugin_name       The name of this plugin.

	 * @param      string    $version    The version of this plugin.

	 */

	public function __construct( $plugin_name, $version ) {



		$this->plugin_name = $plugin_name;

		$this->version = $version;



	}



	/**

	 * Register the stylesheets for the admin area.

	 *

	 * @since    1.0.0

	 */

	public function enqueue_styles() {



		/**

		 * This function is provided for demonstration purposes only.

		 *

		 * An instance of this class should be passed to the run() function

		 * defined in WC_Checkout_form_Editor_Admin as all of the hooks are defined

		 * in that particular class.

		 *

		 * The WC_Checkout_form_Editor_Admin will then create the relationship

		 * between the defined hooks and the functions defined in this

		 * class.

		 */


		global $wp_scripts;
		// get registered script object for jquery-ui
	    $ui = $wp_scripts->query('jquery-ui-core');
	 	
	    // tell WordPress to load the Smoothness theme from Google CDN
	    $protocol = is_ssl() ? 'https' : 'http';
	    $url = "$protocol://ajax.googleapis.com/ajax/libs/jqueryui/{$ui->ver}/themes/smoothness/jquery-ui.min.css";
	    if (isset($_GET['page']) && ($_GET['page'] == 'checkout_editor_woocommerce')) {
	    	wp_enqueue_style('jquery-ui-smoothness', $url, array(), $this->version, 'all');
	    }
	    

	    wp_enqueue_style( 'wc-checkout-form-editor-admin', plugin_dir_url( __FILE__ ) . 'css/wc-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'wc-checkout-form-editor', plugin_dir_url( __FILE__ ) . 'css/wc-checkout-form-editor-admin.css', array(), $this->version, 'all' );



	}



	/**

	 * Register the JavaScript for the admin area.

	 *

	 * @since    1.0.0

	 */

	public function enqueue_scripts() {



		/**

		 * This function is provided for demonstration purposes only.

		 *

		 * An instance of this class should be passed to the run() function

		 * defined in WC_Checkout_form_Editor_Admin as all of the hooks are defined

		 * in that particular class.

		 *

		 * The WC_Checkout_form_Editor_Admin will then create the relationship

		 * between the defined hooks and the functions defined in this

		 * class.

		 */

	wp_enqueue_script('wc-checkout-form-editor-admin', plugins_url('/admin/js/wcfe_custom.js', dirname(__FILE__)), array('jquery', 'jquery-ui-dialog', 'jquery-ui-sortable',
			'woocommerce_admin', 'select2', 'jquery-tiptip'), '1.0', true);	

		



	}





public function add_plugin_admin_menu() {



    /*

     * Add a settings page for this plugin to the Settings menu.

     *

     * NOTE:  Alternative menu locations are available via WordPress administration menu functions.

     *

     *        Administration Menus: http://codex.wordpress.org/Administration_Menus

     *

     */

add_menu_page( 'Checkout Editor WooCommerce', 'Checkout Editor WooCommerce', 'manage_options','checkout_editor_woocommerce', array($this, 'display_plugin_setup_page')

    );

}



 /**

 * Add settings action link to the plugins page.

 *

 * @since    1.0.0

 */




public function add_action_links( $links ) {

    /*

    *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)

    */

   $settings_link = array(

    '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',

   );

   return array_merge(  $settings_link, $links );



}



/**

 * Render the settings page for this plugin.

 *

 * @since    1.0.0

 */

 

public function display_plugin_setup_page() {

    include_once( 'display_setting_page.php' );

}




}

