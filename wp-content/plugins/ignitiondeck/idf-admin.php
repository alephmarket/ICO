<?php

add_action('admin_init', 'idf_admin_init');

function idf_admin_init() {
	do_action('idf_notice_checks');
}

add_action('admin_menu', 'idf_admin_menus');

function idf_admin_menus() {
	if (current_user_can('manage_options')) {
		global $admin_page_hooks;
		// pretty red bubble
		$notice_count = apply_filters('idf_notice_count', 0);
		$notice_counter = sprintf( '<span class="update-plugins count-%1$d"><span class="plugin-count">%1$d</span></span>', $notice_count);
		
		$home = add_menu_page(__('Dashboard', 'idf'), __('IgnitionDeck', 'idf').' '.$notice_counter, 'manage_options', 'idf', 'idf_main_menu', plugins_url( '/images/ignitiondeck-menu.png', __FILE__ ));
		$admin_page_hooks['idf'] = 'ignitiondeck'; // Wipe notification bits from hooks. Thank you WP SEO.
		
		$dashboard = add_submenu_page( 'idf', __('IgnitionDeck Dashboard', 'idf'), apply_filters('idf_menu_title_idf', __('Dashboard', 'idf')), 'manage_options', 'idf');
		$theme_list = add_submenu_page( 'idf', __('Themes', 'idf'), apply_filters('idf_menu_title_idf-themes', __('Themes', 'idf')), 'manage_options', 'idf-themes', 'idf_theme_list');
		$extension_list = add_submenu_page( 'idf', __('Modules', 'idf'), apply_filters('idf_menu_title_idf-extensions', __('Modules', 'idf')), 'manage_options', 'idf-extensions', 'idf_modules_menu');
		$menu_array = array($home,
						$theme_list,
						$extension_list
						);
		foreach ($menu_array as $menu) {
			add_action('admin_print_styles-'.$menu, 'idf_admin_enqueues');
		}
	}
}

add_action('admin_menu', 'idf_dev_menus', 100);

function idf_dev_menus() {
	if (idf_dev_mode()) {
		$dev_menu = add_submenu_page( 'idf' , __('Dev Tools', 'idf'), apply_filters('idf_menu_title_idf-dev-tools', __('Dev Tools', 'idf')), 'manage_options', 'idf-dev-tools', 'idf_dev_tools');
		add_action('admin_print_styles-'.$dev_menu, 'idf_admin_enqueues');
		//add_action('admin_print_styles-'.$dev_menu, 'idf_dev_tools_enqueues');
	}
}

function idf_main_menu() {
	$requirements = new IDF_Requirements;
	$install_data = $requirements->install_check();
	$idf_registered = get_option('idf_registered');
	$platform = idf_platform();
	$plugins_path = plugin_dir_path(dirname(__FILE__));
	$platforms = idf_platforms();
	$super = idf_is_super();
	$active_products = array();
	$is_id_licensed = false;
	$is_idc_licensed = false;
	if (idf_has_idcf()) {
		$idcf_license_key = get_option('id_license_key');
		$is_pro = is_id_pro();
		$is_basic = is_id_basic();
		if (isset($_POST['idcf_license_key'])) {
			$is_pro = 0;
			$is_basic = 0;
			$idcf_license_key = sanitize_text_field($_POST['idcf_license_key']);
			do_action('idcf_license_update', $idcf_license_key);
			$is_pro = is_id_pro();
			$is_basic = is_id_basic();
		}
		if ($is_pro) {
			$active_products[] = 'IgnitionDeck Enterprise';
			$is_id_licensed = true;
		}
		else if ($is_basic) {
			$active_products[] = 'IgnitionDeck Crowdfunding';
			$is_id_licensed = true;
		}
	}
	if (idf_has_idc()) {
		$is_idc_licensed = is_idc_licensed();
		$general = get_option('md_receipt_settings');
		$general = maybe_unserialize($general);
		$idc_license_key = (isset($general['license_key']) ? $general['license_key'] : '');
		if (isset($_POST['idc_license_key'])) {
			$idc_license_key = sanitize_text_field($_POST['idc_license_key']);
			do_action('idc_license_update', $idc_license_key);
			$is_idc_licensed = is_idc_licensed();
		}
		if ($is_idc_licensed) {
			$active_products[] = 'IgnitionDeck Commerce';
		}
	}
	$type_msg = '';
	if (!empty($active_products)) {
		$count = count($active_products);
		$type_msg = ' '.$active_products[0];
		if ($count > 1) {
			$i = 0;
			foreach ($active_products as $product) {
				if ($i > 0) {
					$type_msg .= ', '.$active_products[$i];
				}
				$i++;
			}
		}
	}
	if (isset($_POST['commerce_submit'])) {
		$platform = sanitize_text_field($_POST['commerce_selection']);
		update_option('idf_commerce_platform', $platform);
		do_action('idf_update_commerce_platform', $platform);
	}
	if (isset($_POST['update_idcf'])) {
		if (file_exists($plugins_path.'ignitiondeck-crowdfunding')) {
			deactivate_plugins($plugins_path.'ignitiondeck-crowdfunding/ignitiondeck.php');
			$dir = $plugins_path.'ignitiondeck-crowdfunding';
			rrmdir($dir);
		}
		idf_idcf_delivery();
		echo '<script>location.href="'.site_url('/wp-admin/admin.php?page=idf').'";</script>';
	}
	// modules list
	$data = idf_extension_list();
	$extension_data = (!empty($data) ? array_slice($data, -3) : array());
	// upgrades
	$license_type = 'free';
	if (idf_has_idcf()) {
		$pro = get_option('is_id_pro', false);
		if ($pro) {
			$license_type = 'ide';
		}
		else {
			if (idf_has_idc()) {
				if (is_idc_licensed()) {
					$license_type = 'idc';
				}
			}
		}
	}
	include_once 'templates/admin/_idfMenu.php';
}

function idf_modules_menu() {
	$active_modules = get_transient('id_modules');
	$data = idf_extension_list();
	include_once 'templates/admin/_extensionList.php';
}

function idf_theme_list() {
	$themes = wp_get_themes();
	$name_array = array();
	if (!empty($themes)) {
		foreach ($themes as $theme) {
			$name_array[] = $theme->Name;
		}
	}
	$active_theme = wp_get_theme();
	$active_name = $active_theme->Name;
	$prefix = 'http';
	if (is_ssl()) {
		$prefix = 'https';
	}
	$api = $prefix.'://www.ignitiondeck.com/id/?action=get_themes';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_URL, $api);

	$json = curl_exec($ch);
	curl_close($ch);
	$data = json_decode($json);
	include_once 'templates/admin/_themeList.php';
}

function idf_dev_tools() {
	ob_start();
	phpinfo();
	$php_info = ob_get_contents();
	ob_end_clean();
	$php_info = preg_replace('%^.*<body>(.*)</body>.*$%ms', '$1', $php_info);
	include_once 'templates/admin/_devTools.php';
}

add_action('idf_notice_checks', 'idf_notice_checks');

function idf_notice_checks() {
	// IDC version check
	if (idf_has_idc()) {
		$idc_data = get_plugin_data(WP_PLUGIN_DIR . '/idcommerce/idcommerce.php');
		if (!empty($idc_data['Version'])) {
			$current_idc_version = $idc_data['Version'];
			$versions = get_transient('idf_plugin_versions');
			if (isset($versions['idcommerce/idcommerce.php'])) {
				$new_idc_version = $versions['idcommerce/idcommerce.php'];
				if (version_compare($current_idc_version, $new_idc_version, '<')) {
					add_action('admin_notices', 'idf_idc_notice');
				}
			}
		}
	}
}

function idf_notice_count($count) {
	add_filter('idf_menu_title_idf-extensions', function($title) {
		return $title.' <i class="fa fa-star idf_menu_notice"></i>';
	});
	return 1;
}

function idf_idc_notice() {
	echo '<div class="updated">
			<p>'.
	       		__('Your IgnitionDeck Commerce installation is out of date.', 'ignitiondeck').' <a href="'.admin_url('update-core.php').'">'.__('Click here', 'ignitiondeck').'</a> '.__('to update to the latest version.', 'ignitiondeck')
	       	.'</p>
	    </div>';
}

add_action('admin_enqueue_scripts', 'idf_additional_enqueues');

function idf_additional_enqueues() {
	global $post;
	if (isset($post->post_type) && $post->post_type == 'ignition_product') {
		$platform = idf_platform();
		if (empty($platform) || $platform !== 'legacy') {
			idf_admin_enqueues();
		}
	}
}

function idf_admin_enqueues() {
	if (function_exists('get_plugin_data')) {
		$idf_data = get_plugin_data(DIRNAME(__FILE__).'/idf.php');
	}
	wp_register_script('idf-admin', plugins_url('/js/idf-admin.js', __FILE__));
	wp_register_script('idf-admin-media', plugins_url('/js/idf-admin-media.js', __FILE__));
	wp_register_style('idf-admin', plugins_url('/css/idf-admin.css', __FILE__));
	wp_register_style('magnific', plugins_url('lib/magnific/magnific.css', __FILE__));
	wp_register_script('magnific', plugins_url('lib/magnific/magnific.js', __FILE__));
	wp_enqueue_script('jquery');
	if (menu_page_url('idf', false) == idf_current_url()) {
		wp_enqueue_script('dashboard');
	}
	wp_enqueue_media();
	wp_enqueue_script('magnific');
	wp_enqueue_script('idf-admin');
	wp_enqueue_script('idf-admin-media');
	if (menu_page_url('idf', false) == idf_current_url()) {
		wp_enqueue_style('dashboard');
	}
	wp_enqueue_style('magnific');
	wp_enqueue_style('idf-admin');
	$idf_ajaxurl = site_url('/wp-admin/admin-ajax.php');
	$platform = idf_platform();
	wp_localize_script('idf-admin', 'idf_admin_siteurl', site_url());
	wp_localize_script('idf-admin', 'idf_admin_ajaxurl', $idf_ajaxurl);
	wp_localize_script('idf-admin', 'idf_platform', $platform);
	$prefix = 'http';
	if (is_ssl()) {
		$prefix = 'https';
	}
	wp_localize_script('idf-admin', 'launchpad_link', $prefix.'://ignitiondeck.com/id/id-launchpad-checkout/');
	wp_localize_script('idf-admin', 'idf_version', (isset($idf_data['Version']) ? $idf_data['Version'] : '0.0.0'));
}

add_action('admin_init', 'filter_idcf_admin');

function idf_dev_tools_enqueues() {
	wp_register_script('idf-dev_tools', plugins_url('js/idf-admin-dev_tools.js', __FILE__));
	wp_enqueue_script('jquery');
	wp_enqueue_script('idf-dev_tools');
}

function filter_idcf_admin() {
	$platform = idf_platform();
	if (!empty($platform) && $platform !== 'legacy') {
		global $admin_page_hooks;
		if (!empty($admin_page_hooks['ignitiondeck'])) {
			//remove_submenu_page('ignitiondeck', 'project-settings');
			remove_submenu_page('ignitiondeck', 'payment-options');
			remove_submenu_page('ignitiondeck', 'custom-settings');
		}
		else {
			remove_submenu_page('idf', 'payment-options');
			remove_submenu_page('idf', 'custom-settings');
		}
		//add_filter('idcf_project_settings_tab', 'filter_idcf_project_settings_tab');
		add_filter('idcf_custom_settings_tab', 'filter_idcf_custom_settings_tab');
		add_filter('idcf_payment_settings_tab', 'filter_idcf_payment_settings_tab');
		remove_action('add_meta_boxes', 'add_ty_url');
	}
	if ($platform == 'wc') {
		add_action('idcf_below_project_settings', 'idf_wc_settings');
		remove_action('add_meta_boxes', 'add_purchase_url');
	}
}

add_action('plugins_loaded', 'filter_idc_admin');

function filter_idc_admin() {
	$platform = idf_platform();
	if ($platform !== 'idc') {
		remove_action('add_meta_boxes', 'mdid_project_metaboxes');
	}
}

function filter_idcf_project_settings_tab($tab) {
	//$tabs = null;
	return null;
}

function filter_idcf_custom_settings_tab($tab) {
	//$tabs = null;
	return null;
}

function filter_idcf_payment_settings_tab($tab) {
	//$tabs = null;
	return null;
}

function idf_wc_settings() {
	// #devnote create a function for this
	$idf_wc_checkout_url = get_option('idf_wc_checkout_url', 'get_cart_url');
	if (isset($_POST['idf_wc_checkout_url'])) {
		$idf_wc_checkout_url = sanitize_text_field($_POST['idf_wc_checkout_url']);
		update_option('idf_wc_checkout_url', $idf_wc_checkout_url);
	}
	include_once('templates/admin/_wcSettings.php');
}
?>