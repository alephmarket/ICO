<?php

add_filter('helix_dashboard_id', 'helix_set_idc_dashid', 2);

function helix_set_idc_dashid($page_id = null) {
	return md_get_did();
}

add_filter('helix_dashboard_url', 'helix_set_idc_durl', 2);

function helix_set_idc_durl($url = '') {
	return md_get_durl();
}

add_filter('helix_register_url', 'helix_set_idc_register_url', 2);

function helix_set_idc_register_url($url) {
	return md_get_durl().idf_get_querystring_prefix()."action=register";
}

add_filter('helix_orders_url', 'helix_set_idc_orders_url', 2);

function helix_set_idc_orders_url($url = '') {
	return md_get_durl().idf_get_querystring_prefix().'idc_orders=1';

}

add_filter('helix_edit_profile_url', 'helix_set_idc_edit_profile_url', 2);

function helix_set_idc_edit_profile_url($url = '') {
	return md_get_durl().idf_get_querystring_prefix().'edit-profile=1';
}

/**
 * Filter for displaying any text with the user avatar, in case of IDC user credits will be displayed
 */
add_filter('helix_credits_display_text', 'idc_user_credits_text_helix', 2, 2);
function idc_user_credits_text_helix($text, $user_id) {
	$member = new ID_Member($user_id);
	$credits = $member->get_user_credits();
	if ($credits > 0) {
		$text = '<p>'.$credits.' '.__('Credits', 'memberdeck').'</p>';
	}
	return $text;
}

add_filter('helix_avatar_link', 'idc_helix_avatar_link');

function idc_helix_avatar_link($link) {
	$prefix = (function_exists('idf_get_querystring_prefix') ? idf_get_querystring_prefix() : '?');
	return md_get_durl().$prefix.'edit-profile=1';
}
?>