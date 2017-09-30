<?php
if (!wp_next_scheduled('schedule_twicedaily_idf_cron')) {
	wp_schedule_event(time(), 'twicedaily', 'schedule_twicedaily_idf_cron');
}

function idf_schedule_install($path) {
	require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	activate_plugin($path);
}

add_action('idf_schedule_install', 'idf_schedule_install');
?>