<?php 
/*
Plugin Name: Subscribe Forms
Description: Add Beautiful froms to your website to increase converions
Author: Web-Settler
Plugin URI: http://web-settler.com/mailchimp-subscribe-form/
Author URI: http://web-settler.com/mailchimp-subscribe-form/
Version: 3.9.8.1
Donate link: http://web-settler.com/mailchimp-subscribe-form/
License: GPL V2
*/
if ( ! defined( 'ABSPATH' ) ) exit;

include 'config.php';
include 'ssm_cs_post_type.php';
include 'ssm_cs_scripts.php';
include 'ssm_meta_boxes.php';
include 'ssm_menu_pages.php';
include 'ssm_wp_ajax.php';
include 'ssm_wp_widgets.php';
include 'Ask-Rev.php';


function ssm_plugin_add_settings_link( $links ) {
    $settings_link = '<a href="edit.php?post_type=subscribe_me_forms">' . __( 'Dashboard' ) . '</a>';
    $support_link = '<a href="http://web-settler.com/ulp-support/">' . __( 'Support' ) . '</a>';
    array_push( $links, $settings_link );
    array_push( $links, $support_link );
  	return $links;
}
$plugin = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$plugin", 'ssm_plugin_add_settings_link' );

register_activation_hook(__FILE__, 'ssmf_plugin_activation');
add_action('admin_init', 'ssmf_plugin_redirect_activation');

function ssmf_plugin_activation() {
flush_rewrite_rules();
add_option('ssmf_plugin_activation_check_option', true);
}

function ssmf_plugin_redirect_activation() {
if (get_option('ssmf_plugin_activation_check_option', false)) {
    delete_option('ssmf_plugin_activation_check_option');
    if(!isset($_GET['activate-multi']))
    {
        wp_redirect("edit.php?post_type=subscribe_me_forms&page=ssm_dashboard");
        exit();
    }
 }
}


  ?>