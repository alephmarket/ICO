<?php
/*
Plugin Name: Custom VC Column Layout
Plugin URI: http://www.jezweb.info/
Description: This is a custom Visual Composer addon for making custom layouts.
Author: Cenemil Jones Sumbalan
Version: 1.1
Author URI: http://jezweb.com.au/
*/


class VCExtendAddonCustomLayoutClass {
  
    function __construct() {
        add_action( 'init', array( $this, 'integrateWithVC' ) );
		add_action('init', array( $this, 'add_new_vccustom' ) );
	  	add_action( 'admin_enqueue_scripts', array( $this, 'load_custom_vc_layout_admin_style' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'loadCssAndJs' ) );
    }
	
  	function load_custom_vc_layout_admin_style () {
    	wp_register_style( 'custom_vc_layout_admin_css', plugins_url( '/custom_vc_layout_admin.css', __FILE__ ) );
   		wp_enqueue_style( 'custom_vc_layout_admin_css' );
	}
  	
    function add_new_vccustom() {
	  global $vc_row_layouts;
	  $vc_row_layouts = array(
		array( 'cells' => '11', 'mask' => '12', 'title' => '1/1', 'icon_class' => 'l_11' ),
		array( 'cells' => '12_12', 'mask' => '26', 'title' => '1/2 + 1/2', 'icon_class' => 'l_12_12' ),
		array( 'cells' => '23_13', 'mask' => '29', 'title' => '2/3 + 1/3', 'icon_class' => 'l_23_13' ),
		array( 'cells' => '13_13_13', 'mask' => '312', 'title' => '1/3 + 1/3 + 1/3', 'icon_class' => 'l_13_13_13' ),		array( 'cells' => '14_14_14_14', 'mask' => '420', 'title' => '1/4 + 1/4 + 1/4 + 1/4', 'icon_class' => 'l_14_14_14_14' ),
		array( 'cells' => '14_34', 'mask' => '212', 'title' => '1/4 + 3/4', 'icon_class' => 'l_14_34' ),
		array( 'cells' => '14_12_14', 'mask' => '313', 'title' => '1/4 + 1/2 + 1/4', 'icon_class' => 'l_14_12_14' ),
		array( 'cells' => '56_16', 'mask' => '218', 'title' => '5/6 + 1/6', 'icon_class' => 'l_56_16' ),
		array( 'cells' => '16_16_16_16_16_16', 'mask' => '642', 'title' => '1/6 + 1/6 + 1/6 + 1/6 + 1/6 + 1/6', 'icon_class' => 'l_16_16_16_16_16_16' ),
		array( 'cells' => '16_23_16', 'mask' => '319', 'title' => '1/6 + 4/6 + 1/6', 'icon_class' => 'l_16_46_16' ),
		array( 'cells' => '16_16_16_12', 'mask' => '424', 'title' => '1/6 + 1/6 + 1/6 + 1/2', 'icon_class' => 'l_16_16_16_12' ),
		array( 'cells' => '15_15_15_15_15', 'mask' => '530', 'title' => '1/5 + 1/5 + 1/5 + 1/5 + 1/5', 'icon_class' => 'l_15_15_15_15_15' )
	  );
	return $vc_row_layouts;
    }

    public function integrateWithVC() {
        if ( ! defined( 'WPB_VC_VERSION' ) ) {
            add_action('admin_notices', array( $this, 'showVcVersionNotice' ));
            return;
        }
    }
 
    public function loadCssAndJs() {
	 	wp_enqueue_style( 'custom-styles-vc-layout', plugins_url( '/custom_vc_layout.css', __FILE__ ) );
    }
}

new VCExtendAddonCustomLayoutClass();

?>