<?php

add_action('init', 'helix_idcf_menu');

function helix_idcf_menu() {
	if (is_user_logged_in()) {
		if (idf_has_idc()) {
			add_filter('helix_backer_profile_url', 'helix_set_backer_profile_url', 2);
			add_filter('helix_creator_profile_url', 'helix_set_creator_profile_url', 2);
			add_filter('helix_creator_settings_url', 'helix_set_creator_settings_url', 2);
			add_filter('helix_my_projects_url', 'helix_set_my_projects_url', 2);
			add_action('helix_below_commerce_icons', 'helix_crowdfunding_icons');
			add_action('helix_below_commerce_menu', 'helix_crowdfunding_menu');
		}
	}
}

function helix_set_backer_profile_url($url = '') {
	$url = md_get_durl();
	$url .= idf_get_querystring_prefix();
	$url .= apply_filters('idc_backer_profile_slug', 'backer_profile').'=';
	return $url;
}

function helix_set_creator_profile_url($url = '') {
	$url = md_get_durl();
	$url .= idf_get_querystring_prefix();
	$url .= apply_filters('idc_creator_profile_slug', 'creator_profile').'=';
	return $url;
}

function helix_set_creator_settings_url($url = '') {
	$url = md_get_durl();
	$url .= idf_get_querystring_prefix();
	$url .= 'payment_settings=1';
	return $url;
}

function helix_set_my_projects_url($url = '') {
	$url = md_get_durl();
	$url .= idf_get_querystring_prefix();
	$url .= apply_filters('idc_creator_projects_slug', 'creator_projects').'=1';
	return $url;
}

function helix_crowdfunding_icons() {
	$current_user = wp_get_current_user();
	$params = helix_params();
	$project_count = ID_Project::count_user_projects($current_user->ID);
	if ($project_count <= 0 && is_id_pro()) {
		$params['my_projects_url'] = ide_create_project_url();
	}
	ob_start();
	include_once('templates/_helixCrowdfundingIcons.php');
	$content = ob_get_contents();
	ob_end_clean();
	echo $content;
}

function helix_crowdfunding_menu() {
	$current_user = wp_get_current_user();
	$params = helix_params();
	$project_count = ID_Project::count_user_projects($current_user->ID);
	if ($project_count <= 0 && is_id_pro()) {
		$params['my_projects_url'] = ide_create_project_url();
		add_filter('gettext', function($translated_text, $text, $domain) {
			if ($domain == 'idf') {
				if ($text == 'My Projects') {
					return __('Create Project', 'idf');
				}
			}
			return $translated_text;
		}, 20, 3);
	}
	ob_start();
	include_once('templates/_helixCrowdfundingMenu.php');
	$content = ob_get_contents();
	ob_end_clean();
	echo $content;
}
?>