<?php
add_action('wp_enqueue_scripts', 'idc_helix_scripts');

function idc_helix_scripts() {
	wp_register_style('helix_idcom_css', plugins_url('/css/helix_idcom.css', __FILE__));
	wp_enqueue_style('helix_idcom_css');
}

add_action('wp_enqueue_scripts', 'helix_idcom_scripts');

function helix_idcom_scripts() {
	wp_register_script('helix_idcom_js', plugins_url('/js/helix_idcom.js', __FILE__));
	wp_enqueue_script('jquery');
	wp_enqueue_script('helix_idcom_js');
} 

function helix_user_waitlisted($user_id = null) {
	if (empty($user_id)) {
		$current_user = wp_get_current_user();
		$user_id = $current_user->ID;
	}
	$waitlisted = helix_waitlist_seat($user_id);
	if (!empty($waitlisted) && $waitlisted > 0) {
		return true;
	}
	return false;
}

function helix_waitlist_seat($user_id) {
	return get_user_meta($user_id, 'idhelix_waitlist', true);
}

function helix_waitlist_length() {
	return get_option('idhelix_waitlist_length');
}

function helix_join_waitlist($user_id) {
	$waitlist_length = helix_waitlist_length();
	if (!helix_user_waitlisted($user_id)) {
		$waitlist_length = absint($waitlist_length) + (int) 1;
		update_user_meta($user_id, 'idhelix_waitlist', $waitlist_length);
		update_option('idhelix_waitlist_length', $waitlist_length);
	}
	else {
		echo 2;
	}
	return $waitlist_length;
}

function helix_join_waitlist_ajax() {
	$waitlist_length = 0;
	if (isset($_POST['USERID'])) {
		$user_id = absint($_POST['USERID']);
		if ($user_id > 0) {
			$waitlist_length = helix_join_waitlist($user_id);
		}
	}
	echo $waitlist_length;
	exit;
}

add_action('wp_ajax_helix_join_waitlist_ajax', 'helix_join_waitlist_ajax');
?>