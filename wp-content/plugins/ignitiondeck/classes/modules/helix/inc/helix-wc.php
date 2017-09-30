<?php
function helix_wc_dashid() {
	$page_id = get_option('woocommerce_myaccount_page_id');
	return $page_id;
}
/*
Deprecated
*/
function helix_wc_orders_id() {
	$page_id = get_option('woocommerce_view_order_page_id');
	return $page_id;
}

function helix_wc_orders_url() {
	$did = helix_wc_dashid();
	$durl = get_permalink($did);
	return wc_get_endpoint_url('orders', '', $durl);
}

function helix_wc_cart_url() {
	global $woocommerce;
	return $woocommerce->cart->get_cart_url();
}

/*
Deprecated
*/
function helix_wc_edit_profile_id() {
	$page_id = get_option('woocommerce_edit_address_page_id', 2);
	return $page_id;
}

function helix_wc_edit_profile_url() {
	$did = helix_wc_dashid();
	$durl = get_permalink($did);
	return wc_get_endpoint_url('edit-account', '', $durl);
}

add_filter('helix_dashboard_id', 'helix_set_wc_dashid', 2);

function helix_set_wc_dashid($id = null) {
	return helix_wc_dashid();
}

add_filter('helix_dashboard_url', 'helix_set_wc_durl', 2);
add_filter('helix_register_url', 'helix_set_wc_durl', 2);

function helix_set_wc_durl($url = '') {
	return get_permalink(helix_wc_dashid());
}

add_filter('helix_cart_url', 'helix_set_wc_cart_url', 2);

function helix_set_wc_cart_url($url = '') {
	return helix_wc_cart_url();
}

add_filter('helix_orders_url', 'helix_set_wc_orders_url', 2);

function helix_set_wc_orders_url($url = '') {
	return helix_wc_orders_url();
}

add_filter('helix_edit_profile_url', 'helix_set_edit_profile_url', 2);

function helix_set_edit_profile_url($url = '') {
	return helix_wc_edit_profile_url();
}

add_filter('helix_params', 'helix_wc_menu_params');

function helix_wc_menu_params($params) {
	$params['cart_url'] = apply_filters('helix_cart_url', home_url().'/basket/');
	return $params;
}

add_action('helix_above_commerce_icons', 'helix_wc_menu_icons', 1);

function helix_wc_menu_icons() {
	$params = helix_params();
	$cart_count = WC()->cart->get_cart_contents_count();
	if (!empty($cart_count)) {
		ob_start();
		include_once('templates/_helixWCIcons.php');
		$content = ob_get_contents();
		ob_end_clean();
		echo $content;
	}
}

add_action('helix_above_commerce_menu', 'helix_wc_menu', 1);

function helix_wc_menu() {
	$params = helix_params();
	$cart_count = WC()->cart->get_cart_contents_count();
	if (!empty($cart_count)) {
		ob_start();
		include_once('templates/_helixWCMenu.php');
		$content = ob_get_contents();
		ob_end_clean();
		echo $content;
	}
}
?>