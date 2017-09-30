<?php
if(!defined( 'ABSPATH' )) exit;

/**
 * WC_Checkout_Form_Editor class.
 */

class Wc_Checkout_Form_Editor {


    protected $loader;

    protected $plugin_name;

    protected $version;

    protected $locale_fields;
    

    /**
     * __construct function.
     */
    function __construct() {

        $this->plugin_name = 'Checkout Editor WooCommerce';
        $this->version = '1.0.0';


        $this->load_dependencies();
        $this->define_admin_hooks();
        $this->define_public_hooks();
        

        // Validation rules are controlled by the local fields and can't be changed
        $this->locale_fields = array(
            'billing_address_1', 'billing_address_2', 'billing_state', 'billing_postcode', 'billing_city',
            'shipping_address_1', 'shipping_address_2', 'shipping_state', 'shipping_postcode', 'shipping_city',
            'order_comments', 'account_username', 'account_password'
        );

    }

    private function load_dependencies() {


  

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/wc_checkout_form_editor_loader.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/wc_checkout_form_editor_admin.php';


        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/wc_checkout_form_editor_public.php';


        $this->loader = new Wc_Checkout_Form_Editor_Loader();

    }


    /*private function define_admin_hooks() {
    /*}


    /**
     * menu function.
     */

    private function define_admin_hooks() {
        $plugin_admin = new Wc_Checkout_Form_Editor_Admin( $this->get_plugin_name(), $this->get_version() );
         
         $this->loader->add_action( 'admin_menu', $plugin_admin, 'add_plugin_admin_menu' );
         $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
         $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

        }



    private function define_public_hooks() {

        $plugin_public = new WC_Checkout_Form_Editor_Public( $this->get_plugin_name(), $this->get_version() );

        $this->loader->add_filter('woocommerce_default_address_fields' , $plugin_public, 'wcfe_woo_default_address_fields' );

        $this->loader->add_filter('woocommerce_billing_fields', $plugin_public, 'wcfe_billing_fields_lite', 1000);
        $this->loader->add_filter('woocommerce_shipping_fields', $plugin_public, 'wcfe_shipping_fields_lite', 1000);
       $this->loader->add_action('woocommerce_register_form_start', $plugin_public, 'wcfe_account_fields_lite', 1000);
       $this->loader->add_action('woocommerce_created_customer', $plugin_public, 'save_wcfe_account_fields_lite');
       $this->loader->add_action( 'woocommerce_before_my_account', $plugin_public, 'wcfe_show_data_my_account_page' );
       //$this->loader->add_action( 'woocommerce_form_field_text', $plugin_public, 'wcfe_custom_heading', 10, 2 );
       

        $this->loader->add_action('woocommerce_after_checkout_validation', $plugin_public, 'wcfe_checkout_fields_validation_lite');
        $this->loader->add_filter('woocommerce_email_order_meta_keys', $plugin_public, 'wcfe_display_custom_fields_in_emails_lite', 10, 1);
        $this->loader->add_action('woocommerce_order_details_after_customer_details', $plugin_public, 'wcfe_order_details_after_customer_details_lite', 20, 1);

        //$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );

       // $this->loader->add_action( 'woocommerce_before_shop_loop_item_title', $plugin_public, 'add_text_above_wc_shop_image');


    }



    public function run() {
            $this->loader->run();
    }

    public function get_plugin_name() {
        return $this->plugin_name;
    }

    public function get_version() {
        return $this->version;
    }



}