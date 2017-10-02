<?php
/*
 * 
Plugin Name: Order / Coupon / Subscription Export Import Plugin for WooCommerce (BASIC)
Plugin URI: https://www.xadapter.com/product/order-import-export-plugin-for-woocommerce/
Description: Export and Import Order detail including line items, From and To your WooCommerce Store.
Author: XAdapter
Author URI: https://www.xadapter.com/
Version: 1.2.5
Text Domain: wf_order_import_export
*/

if ( ! defined( 'ABSPATH' ) || ! is_admin() ) {
	return;
}

define( "WF_ORDER_IMP_EXP_ID", "wf_order_imp_exp" );
define( "WF_WOOCOMMERCE_ORDER_IM_EX", "wf_woocommerce_order_im_ex" );

define("WF_CPN_IMP_EXP_ID", "wf_cpn_imp_exp");
define("wf_coupon_csv_im_ex", "wf_coupon_csv_im_ex");

/**
 * Check if WooCommerce is active
 */
if (in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )) {	

	if ( ! class_exists( 'WF_Order_Import_Export_CSV' ) ) :

	/**
	 * Main CSV Import class
	 */
	class WF_Order_Import_Export_CSV {

		/**
		 * Constructor
		 */
		public function __construct() {
			define( 'WF_OrderImpExpCsv_FILE', __FILE__ );


			add_filter( 'woocommerce_screen_ids', array( $this, 'woocommerce_screen_ids' ) );
			add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'wf_plugin_action_links' ) );
			add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
			add_action( 'init', array( $this, 'catch_export_request' ), 20 );
			add_action( 'init', array( $this, 'catch_save_settings' ), 20 );
			add_action( 'admin_init', array( $this, 'register_importers' ) );

			include_once( 'includes/class-wf-orderimpexpcsv-admin-screen.php' );
			include_once( 'includes/importer/class-wf-orderimpexpcsv-importer.php' );

			if ( defined('DOING_AJAX') ) {
				include_once( 'includes/class-wf-orderimpexpcsv-ajax-handler.php' );
			}
		}
		
		public function wf_plugin_action_links( $links ) {
			$plugin_links = array(
				'<a href="' . admin_url( 'admin.php?page=wf_woocommerce_order_im_ex' ) . '">' . __( 'Import Export', 'wf_order_import_export' ) . '</a>',
                                '<a href="https://www.xadapter.com/product/order-import-export-plugin-for-woocommerce/" target="_blank" style="color:#3db634;">' . __( 'Premium Upgrade', 'wf_order_import_export' ) . '</a>',	
                                '<a href="https://wordpress.org/support/plugin/order-import-export-for-woocommerce">' . __( 'Support', 'wf_order_import_export' ) . '</a>',
			);
			return array_merge( $plugin_links, $links );
		}
		
		/**
		 * Add screen ID
		 */
		public function woocommerce_screen_ids( $ids ) {
			$ids[] = 'admin'; // For import screen
			return $ids;
		}

		/**
		 * Handle localisation
		 */
		public function load_plugin_textdomain() {
			load_plugin_textdomain( 'wf_order_import_export', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		}

		/**
		 * Catches an export request and exports the data. This class is only loaded in admin.
		 */
		public function catch_export_request() {
			if ( ! empty( $_GET['action'] ) && ! empty( $_GET['page'] ) && $_GET['page'] == 'wf_woocommerce_order_im_ex' ) {
				switch ( $_GET['action'] ) {
					case "export" :
                                                $user_ok = $this->hf_user_permission();
                                                if ($user_ok) {
						include_once( 'includes/exporter/class-wf-orderimpexpcsv-exporter.php' );
						WF_OrderImpExpCsv_Exporter::do_export( 'shop_order' );
                                                }  else {
                                                    wp_redirect(wp_login_url());
                                                }
					break;
				}
			}
		}
		
		public function catch_save_settings() {
			if ( ! empty( $_GET['action'] ) && ! empty( $_GET['page'] ) && $_GET['page'] == 'wf_woocommerce_order_im_ex' ) {
				switch ( $_GET['action'] ) {
					case "settings" :
						include_once( 'includes/settings/class-wf-orderimpexpcsv-settings.php' );
						WF_OrderImpExpCsv_Settings::save_settings( );
					break;
				}
			}
		}

		/**
		 * Register importers for use
		 */
		public function register_importers() {
			register_importer( 'woocommerce_wf_order_csv', 'WooCommerce Order (CSV)', __('Import <strong>Orders</strong> to your store via a csv file.', 'wf_order_import_export'), 'WF_OrderImpExpCsv_Importer::order_importer' );
		}
               
                private function hf_user_permission() {
                // Check if user has rights to export
                $current_user = wp_get_current_user();
                $user_ok = false;
                $wf_roles = apply_filters('hf_user_permission_roles', array('administrator', 'shop_manager'));
                if ($current_user instanceof WP_User) {
                    $can_users = array_intersect($wf_roles, $current_user->roles);
                    if (!empty($can_users)) {
                        $user_ok = true;
                    }
                }
                return $user_ok;
                }
	}
	endif;

	new WF_Order_Import_Export_CSV();
        
        
        
        if (!class_exists('WF_Coupon_Import_Export_CSV')) :

        class WF_Coupon_Import_Export_CSV {

            public $cron;
            public $cron_import;

            /**
             * Constructor
             */
            public function __construct() {
                define('WF_CpnImpExpCsv_FILE', __FILE__);


                if (is_admin()) {
                    add_action('admin_notices', array($this, 'wf_coupon_ie_admin_notice'), 15);
                }

                add_filter('woocommerce_screen_ids', array($this, 'woocommerce_screen_ids'));
                add_action('init', array($this, 'load_plugin_textdomain'));
                add_action('init', array($this, 'catch_export_request'), 20);
                add_action('init', array($this, 'catch_save_settings'), 20);
                add_action('admin_init', array($this, 'register_importers'));

                include_once( 'includes/class-wf-cpnimpexpcsv-admin-screen.php' );
                include_once( 'includes/importer/class-wf-cpnimpexpcsv-importer.php' );

               

                if (defined('DOING_AJAX')) {
                    include_once( 'includes/class-wf-cpnimpexpcsv-ajax-handler.php' );
                }

                
            }


            function wf_coupon_ie_admin_notice() {
                global $pagenow;
                global $post;

                if (!isset($_GET["wf_coupon_ie_msg"]) && empty($_GET["wf_coupon_ie_msg"])) {
                    return;
                }

                $wf_coupon_ie_msg = $_GET["wf_coupon_ie_msg"];

                switch ($wf_coupon_ie_msg) {
                    case "1":
                        echo '<div class="update"><p>' . __('Successfully uploaded via FTP.', 'wf_order_import_export') . '</p></div>';
                        break;
                    case "2":
                        echo '<div class="error"><p>' . __('Error while uploading via FTP.', 'wf_order_import_export') . '</p></div>';
                        break;
                    case "3":
                        echo '<div class="error"><p>' . __('Please choose the file in CSV format using Method 1.', 'wf_order_import_export') . '</p></div>';
                        break;
                }
            }

            /**
             * Add screen ID
             */
            public function woocommerce_screen_ids($ids) {
                $ids[] = 'admin'; // For import screen
                return $ids;
            }

            /**
             * Handle localisation
             */
            public function load_plugin_textdomain() {
                load_plugin_textdomain('wf_order_import_export', false, dirname(plugin_basename(__FILE__)) . '/lang/');
            }

            /**
             * Catches an export request and exports the data. This class is only loaded in admin.
             */
            public function catch_export_request() {
                if (!empty($_GET['action']) && !empty($_GET['page']) && $_GET['page'] == 'wf_coupon_csv_im_ex') {
                    switch ($_GET['action']) {
                        case "export" :
                            $user_ok = $this->hf_user_permission();
                            if ($user_ok) {
                                include_once( 'includes/exporter/class-wf-cpnimpexpcsv-exporter.php' );
                                WF_CpnImpExpCsv_Exporter::do_export('shop_coupon');
                            } else {
                                wp_redirect(wp_login_url());
                            }
                            break;
                    }
                }
            }

            public function catch_save_settings() {
                if (!empty($_GET['action']) && !empty($_GET['page']) && $_GET['page'] == 'wf_coupon_csv_im_ex') {
                    switch ($_GET['action']) {
                        case "settings" :
                            include_once( 'includes/settings/class-wf-allimpexpcsv-settings.php' );
                            wf_allImpExpCsv_Settings::save_settings();
                            break;
                    }
                }
            }

            /**
             * Register importers for use
             */
            public function register_importers() {
                register_importer('coupon_csv', 'WooCommerce Coupons (CSV)', __('Import <strong>coupon</strong> to your store via a csv file.', 'wf_order_import_export'), 'WF_CpnImpExpCsv_Importer::coupon_importer');
            }

            private function hf_user_permission() {
                // Check if user has rights to export
                $current_user = wp_get_current_user();
                $user_ok = false;
                $wf_roles = apply_filters('hf_user_permission_roles', array('administrator', 'shop_manager'));
                if ($current_user instanceof WP_User) {
                    $can_users = array_intersect($wf_roles, $current_user->roles);
                    if (!empty($can_users)) {
                        $user_ok = true;
                    }
                }
                return $user_ok;
            }

        }

        endif;

    new WF_Coupon_Import_Export_CSV();


}
