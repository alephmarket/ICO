<?php
/**
 * Plugin Name: Checkout Editor WooCommerce
 * Description: Customize WooCommerce checkout fields(Add, Edit, Delete and re-arrange fields).
 * Author:      themelocation
 * Version:     1.0
 * Author URI:  https://www.themelocation.com
 * Plugin URI:  https://www.themelocation.com.
 */


if(in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {


    require plugin_dir_path( __FILE__ ) . 'classes/class-wc-checkout-form-editor.php';

	/**
	 * Begins execution of the plugin.
	 *
	 * Since everything within the plugin is registered via hooks,
	 * then kicking off the plugin from this point in the file does
	 * not affect the page life cycle.
	 *
	 * @since    1.0.0
	 */
	function run_Wc_Checkout_Form_Editor() {

		$plugin = new Wc_Checkout_Form_Editor();
		$plugin->run();

	}
	run_Wc_Checkout_Form_Editor();



}