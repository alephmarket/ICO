<?php

/*
Plugin Name: FireFly Effect on WordPress
Plugin URI: http://motyar.blogspot.com/2010/04/firefly-jquery-animation-plugin.html
Description: FireFly is a Jquery Plugin that creates spark effect on web page. Sparks moves in random motion and path. You have to call firefly_wp_setup() on every page template you want to use the plugin on.
Version: 1.0 
Author: Motyar D @motyar
Author URI: http://motyar.blogspot.com/ncr
License: GPL 2.0 license http://www.gnu.org/licenses/gpl-2.0.html
*/


//Group the code inside a function
function firefly_wp_setup(){
  wp_enqueue_style(
    "jquery.firefly.css", WP_PLUGIN_URL."/firefly-effect-jquery/jquery.firefly.css", 
    false, "1.0");
  wp_enqueue_script("jquery");
wp_enqueue_script(
		'jquery.firefly',
		plugins_url('jquery.firefly.min.js', __FILE__),
		array('jquery')
	);
wp_localize_script( 'jquery.firefly', 'fireFlyPath', WP_PLUGIN_URL."/firefly-effect-jquery/" );
wp_enqueue_script(
		'jquery.firefly-setup',
		plugins_url('jquery.firefly-setup.js', __FILE__),
		array('jquery','jquery.firefly')
	);
 }

//firefly_wp_setup();

 //You have to call firefly_wp_setup() on every page template you want to use the plugin on
?>