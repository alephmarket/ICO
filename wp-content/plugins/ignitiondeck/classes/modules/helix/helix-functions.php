<?php

add_action('idf_update_commerce_platform', 'helix_reset_params');
add_action('activate_plugin', 'helix_reset_params');
add_action('deactivate_plugin', 'helix_reset_params');

function helix_reset_params($platform) {
	idf_flush_object('helix_params');
}

function helix_show_menu() {
	if (class_exists('IDF') && is_user_logged_in()) {
		return true;
	}
	return false;
}

function helix_show_loggedout_menu() {
	if (class_exists('IDF') && !is_user_logged_in()) {
		return true;
	}
	return false;
}

function helix_settings() {
	$settings = get_option('helix_settings');
	if (empty($settings)) {
		$settings['menu_position'] = 'left';
		$settings['menu_style'] = 'light';
	}
	return $settings;
}

function helix_params() {
	$params = idf_get_object('helix_params');
	if (empty($params)) {
		$params = array();
		$params['dash_id'] = apply_filters('helix_dashboard_id', 0);
		$params['durl'] = apply_filters('helix_dashboard_url', home_url());
		$params['reg_url'] = apply_filters('helix_register_url', wp_registration_url());
		$params['orders_url'] = apply_filters('helix_orders_url', home_url());
		$params['edit_profile_url'] = apply_filters('helix_edit_profile_url', admin_url());
		if (idf_crowdfunding()) {
			$params['backer_profile_url'] = apply_filters('helix_backer_profile_url', home_url());
			$params['creator_profile_url'] = apply_filters('helix_creator_profile_url', home_url());
			$params['creator_settings_url'] = apply_filters('helix_creator_settings_url', home_url());
			$params['my_projects_url'] = apply_filters('helix_my_projects_url', home_url());
		}
		$params = apply_filters('helix_params', $params);
		do_action('idf_cache_object', 'helix_params', $params, 60*60);
	}
	return $params;
}

add_action('wp_login_failed', 'helix_login_failed', 9);

function helix_login_failed($username) {
	if (isset($_SERVER['HTTP_REFERER'])) {
		$referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?
	}
	// if there's a valid referrer, and it's not the default log-in screen
	if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
		if (function_exists('idf_get_querystring_prefix')) {
			$prefix = idf_get_querystring_prefix();
			// if $referrer have a query string, remove it in case $prefix is '?', else, check that &helix_error=login_failed exists in the
			// referrer URL
			if ($prefix == '?' && strpos($referrer, "?") !== false) {
				$referrer_array = explode("?", $referrer);
				$referrer = $referrer_array[0];
			} else if ($prefix == '&' && strpos($referrer, "helix_error=login_failed") !== false) {
				$referrer = str_replace("&helix_error=login_failed", "", $referrer);
			}
			wp_redirect($referrer . $prefix.'helix_error=login_failed' );
		} else {
			wp_redirect(home_url() . '/?helix_error=login_failed&framework_missing=1' );
		}
		exit;
	}
	else if ( empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
		if (function_exists('idf_get_querystring_prefix')) {
			$durl = apply_filters('helix_dashboard_url', home_url());
			$prefix = idf_get_querystring_prefix();
			wp_redirect($durl . '/'.$prefix.'helix_error=login_failed' );
		} else {
			wp_redirect(home_url() . '/?helix_error=login_failed&framework_missing=1' );
		}
		exit;
	}
}

function helix_primary_nav() {
	$args = array(
		'theme_location' => 'helix_primary',
		'fallback_cb' => false,
		'echo' => false,
		'container' => false,
		'items_wrap' => '%3$s',
	);
	$primary_nav = wp_nav_menu($args);
	return $primary_nav;
}

add_filter('helix_menu_logo', 'helix_popout');

function helix_popout($content) {
	$content = '<a href="'.HELIX_URL.'" class="pop-out">'.$content.'</a>';
	/*
	Used for launch popout on IDCOM
	ob_start();
	include_once('templates/_helixPopout.php');
	$content .= ob_get_contents();
	ob_end_clean();
	*/
	return $content;
}
?>