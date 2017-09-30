<?php
/*
Plugin Name: Themo Core
Description: Themo Core plugin for Themo theme. 
Version: 1.0.9
Author: IdeoThemes
Author URI: http://ideothemes.com/
*/
define('IDEOTHEMO_CORE_VERSION', '1.0.9');

require_once(plugin_dir_path(__FILE__) . '/inc/helpers_functions.php');
require_once(plugin_dir_path(__FILE__) . '/inc/class/class.IdeoShortcodeMaps.php'); 
require_once(plugin_dir_path(__FILE__) . '/inc/class/class.IdeoShortcodeGenerator.php');
require_once(plugin_dir_path(__FILE__) . '/inc/class/class.IdeoGoogleFontsApi.php');
require_once(plugin_dir_path(__FILE__) . '/inc/shortcodes.php');
require_once(plugin_dir_path(__FILE__) . '/inc/custom_post_types.php');

if (!class_exists('Less_Parser')) {
    require_once(plugin_dir_path(__FILE__) . '/inc/lessphp/Less.php');
    $upload_dir = wp_upload_dir();
    
    if (is_writable($upload_dir['basedir']) && !is_dir($upload_dir['basedir'] . '/cache/css/')) {
        mkdir($upload_dir['basedir'] . '/cache/');
        mkdir($upload_dir['basedir'] . '/cache/css/');       
    } 
}


add_action('after_setup_theme', 'ideothemo_core_setup');

function ideothemo_core_setup()
{   
    
    //Add shortcodes to VC
    if (defined('IDEOTHEMO_VERSION') && class_exists('WPBakeryVisualComposerAbstract')) {
        
        require('vc_extend/shortcodes/parms.php');
        require('vc_extend/shortcodes/map.php');
    }
}

add_filter( 'customize_loaded_components', 'ideothemo_remove_panels', 99 );
//remove default panels
function ideothemo_remove_panels( $components ) {
    $i = array_search( 'nav_menus', $components );
    if ( false !== $i) {
       unset( $components[ $i ] );
    }   
    return $components;
}

add_filter('ideothemo_get_assets_svg_data_encode', 'ideothemo_get_assets_svg_data_encode_base64');

function ideothemo_get_assets_svg_data_encode_base64($svg) {
    return 'data:image/svg+xml;base64,' . base64_encode($svg);
}

add_action('wp_enqueue_scripts', 'ideothemo_core_scripts_styles');

function ideothemo_core_scripts_styles() {    
    //deregister greensock script from Layerslider plugin (lib TweenLight), register TweenMax script (extended Tweenlite) needed in Parallax Composer in line 163
    wp_deregister_script('greensock');
    //deregister script from js_Composer plugin, register modified version isotope in line 175
    wp_deregister_script('isotope');
    
}

add_action('admin_enqueue_scripts', 'ideothemo_core_admin_scripts_styles');

function ideothemo_core_admin_scripts_styles() {    
    if (defined('IDEOTHEMO_VERSION') && class_exists('WPBakeryVisualComposerAbstract') && !ideothemo_is_customize_preview() ) {
        wp_enqueue_script('ideothemo-admin-angular', IDEOTHEMO_INIT_DIR_URI . '/inc/pc/js/angular/angular.min.js', array('jquery'), '1.4.7', true);
    }
    
}

//SC in widgets
add_filter('widget_text', 'shortcode_unautop');
add_filter('widget_text', 'do_shortcode');

add_action('admin_menu', 'ideothemo_core_admin_menu');

function ideothemo_core_admin_menu(){
    if(defined('IDEOTHEMO_VERSION')){
        add_menu_page( 'Themo Options', 'Themo Options', 'customize', 'customize.php','' ,'dashicons-admin-generic' , 81);     
        add_menu_page('Parallax Composer', 'Parallax Composer&nbsp;&nbsp;', 'manage_options', 'customize.php?mode=pc', '', IDEOTHEMO_INIT_DIR_URI.'/inc/pc/images/PC-icon-panel.png');        
    }
}

add_filter( 'pc_gateway_rawdata', 'ideothemo_pc_gateway_rawdata' );

function ideothemo_pc_gateway_rawdata( $rawdata ) {
    return file_get_contents('php://input');
}

function ideothemo_content_p_fix( $content ) {
    
    
    if( strpos( $content, '</p>') == 0 ){
        preg_match_all('/^<\/p>(.*?)<p>$/s', $content, $matches);
        if($matches[1] && $matches[1][0] ){
            $content = $matches[1][0];                    
        }
    }
    
    return $content;
}

//add_filter('the_content', 'the_content_filter');
function the_content_filter($content) {
    // array of custom shortcodes requiring the fix
    $block = join("|",array( 'quote' ));
    // opening tag
    $rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
    // closing tag
    $rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
    return $rep;
}

