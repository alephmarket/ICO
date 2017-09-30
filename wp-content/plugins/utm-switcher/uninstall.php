<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * @package   Utm_Switcher
 * @author    David Alberts and Jeff Shamley <mrrockgroin@gmail.com>
 * @license   GPL-2.0+
 * @link      https://jeffshamley.com
 * @copyright 2016 
 */
// If uninstall not called from WordPress, then exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

global $wpdb;
if ( is_multisite() ) {

	$blogs = $wpdb->get_results( "SELECT blog_id FROM {$wpdb->blogs}", ARRAY_A );

	if ( $blogs ) {

		foreach ( $blogs as $blog ) {
			switch_to_blog( $blog[ 'blog_id' ] );

			// Delete post and post meta data
			$posts = get_posts( array(
				'numberposts'	 => -1,
				'post_type'		 => 'utm_switcher',
				'post_status'	 => 'any' ) );

			foreach ( $posts as $post ) {
				wp_delete_post( $post->ID, true );
			}

			restore_current_blog();
		}
	}
} else {
	// Delete post and post meta data
	$posts = get_posts( array(
		'numberposts'	 => -1,
		'post_type'		 => 'utm_switcher',
		'post_status'	 => 'any' ) );

	foreach ( $posts as $post ) {
		wp_delete_post( $post->ID, true );
	}
}