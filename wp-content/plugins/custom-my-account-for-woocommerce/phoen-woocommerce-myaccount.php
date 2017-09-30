<?php 
/**
Plugin Name: Custom My Account for Woocommerce
Plugin URI: http://www.phoeniixx.com
Description: Woocommerce custom my account template plugin by phoeniixx designs
Author: phoeniixx
Version: 1.2.7
Text Domain:custom-my-account
Domain Path: /languages
Author URI: http://www.phoeniixx.com
**/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	include(dirname(__FILE__).'/myaccount_settings.php');
	 
	add_action( 'init', 'init' );

	function init(){
		
		!defined( 'PHOEN_CUSTOM_TEMPLATE_PATH' )   && define( 'PHOEN_CUSTOM_TEMPLATE_PATH', plugin_dir_path( __FILE__ ) . 'woocommerce/' );
		 
		add_filter( 'woocommerce_locate_template', 'phoen_custom_my_account_template', 10, 3 );
		
		add_filter( 'pcmac_woocommerce_custom_my_account', 'do_shortcode' );
	} 
	
	function phoen_custom_my_account_template( $template, $template_name, $template_path ){
		
		if('myaccount/navigation.php' == $template_name ){
			
			$template = PHOEN_CUSTOM_TEMPLATE_PATH . 'myaccount/navigation.php';
		
		}
		if('myaccount/dashboard.php' == $template_name ){
			
			$template = PHOEN_CUSTOM_TEMPLATE_PATH . 'myaccount/dashboard.php';
			
		}
		
		return $template;
	} 

	add_action('admin_enqueue_scripts','phoen_my_account');
	
	function phoen_my_account(){
		
		wp_enqueue_style( 'phoen-wcmap3',  plugin_dir_url(__FILE__).'/css/phoen-wcmap.css'); 
				
		wp_enqueue_script( 'script_myaccount_request', plugin_dir_url( __FILE__ ).'/js/my_account.js', array( 'jquery' ));
		
		?>
			<script>
				
				var plugin_url= '<?php echo plugin_dir_url(__FILE__);?>';
			
			</script>
			
		<?php	 
	}

	add_filter( 'pcmac_woocommerce_custom_my_account', 'do_shortcode' );

	register_activation_hook( __FILE__, 'phoen_wc_myaccount_registration' );

	function phoen_wc_myaccount_registration()
	{
		$arg ='dashboard,downloads,orders,edit-account,edit-address,customer-logout';
		
		$dashbord =array(
			'active'=>'1',
			'label'=>'Dashboard',
			'icon'=>'tachometer',
			'content'=>'',
			'type'=>'pre'
		); 
		
		$my_downloads =array(
			'active'=>'1',
			'slug'=>'downloads',
			'label'=>'My Downloads',
			'icon'=>'download',
			'content'=>'[my_downloads_content]',
			'type'=>'pre'
		); 
		
		$view_orders =array(
			'active'=>'1',
			'slug'=>'orders',
			'label'=>'My Orders',
			'icon'=>'file-text-o',
			'content'=>'[view_order_content]',
			'type'=>'pre'
		); 
		
		$edit_account =array(
			'active'=>'1',
			'slug'=>'edit-account',
			'label'=>'Edit Account',
			'icon'=>'pencil-square-o',
			'content'=>'',
			'type'=>'pre'
		); 
		
		$edit_address =array(
			'active'=>'1',
			'slug'=>'edit-address',
			'label'=>'Edit Address',
			'icon'=>'pencil-square-o',
			'content'=>'',
			'type'=>'pre'
		); 
		
		$log_out =array(
			'active'=>'1',
			'slug'=>'customer-logout',
			'label'=>'Logout',
			'icon'=>'pencil-square-o',
			'type'=>'pre'
			
		); 
		
		$general_setting = array(
									'phoen_enable_plugin'=>'enable',
									'custom_profile'=>'enable',
									'menu_text_size'=>'16',
									'menu_width_size'=>'30',
									'menu_icon_font_size'=>'20',
									'phoen_das_text'=>'0',
									'phoen_first_das_text'=>'0',
									'phoen_sec_das_text'=>'0',
									'menu_style'=>'sidebar',					
									'menu_style'=>'sidebar',					
									'menu_item_color'=>'#777777',
									'menu_item_hover_color'=>'#000000',
									'menu_background_color'=>'#ffffff',
									'menu_background_hover_color_'=>'#ffffff',
									'user_name_color'=>'#c0c0c0',
									'icon_text_menu_margin'=>'5',
									'menu_icon_color'=>'',
									'menu_icon_hvr_color'=>'',
						
								);
		
		if(!get_option('phoen-endpoint'))
		{
			update_option('myaccount_general_setting', $general_setting);
			
			update_option('phoen-endpoint', $arg);
			
			update_option('phoen-endpoint-dashboard', $dashbord);
			
			update_option('phoen-endpoint-downloads', $my_downloads);
			
			//update_option('phoen-endpoint-payment-methods', $payment_methods);
			
			update_option('phoen-endpoint-orders', $view_orders);
			
			update_option('phoen-endpoint-edit-account', $edit_account);
			
			update_option('phoen-endpoint-edit-address', $edit_address);
			
			update_option('phoen-endpoint-customer-logout', $log_out);
		}
		
	}