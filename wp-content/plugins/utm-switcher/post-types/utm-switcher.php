<?php

function utm_switcher_init() {
	register_post_type( 'utm_switcher', array(
		'labels'			 => array(
			'name'				 => __( 'UTM Switch', 'utm-switcher' ),
			'singular_name'		 => __( 'UTM Switcher', 'utm-switcher' ),
			'all_items'			 => __( 'All UTM Switchers', 'utm-switcher' ),
			'new_item'			 => __( 'New UTM Switcher', 'utm-switcher' ),
			'add_new'			 => __( 'Add New', 'utm-switcher' ),
			'add_new_item'		 => __( 'Add New UTM Switcher', 'utm-switcher' ),
			'edit_item'			 => __( 'Edit UTM Switcher', 'utm-switcher' ),
			'view_item'			 => __( 'View UTM Switcher', 'utm-switcher' ),
			'search_items'		 => __( 'Search UTM Switchers', 'utm-switcher' ),
			'not_found'			 => __( 'No UTM Switchers found', 'utm-switcher' ),
			'not_found_in_trash' => __( 'No UTM Switchers found in trash', 'utm-switcher' ),
			'parent_item_colon'	 => __( 'Parent UTM Switcher', 'utm-switcher' ),
			'menu_name'			 => __( 'UTM Switchers', 'utm-switcher' ),
		),
		'public'			 => false,
		'hierarchical'		 => false,
		'show_ui'			 => true,
		'show_in_nav_menus'	 => false,
		'supports'			 => array( 'title' ),
		'has_archive'		 => false,
		'rewrite'			 => true,
		'query_var'			 => true,
		'menu_icon'			 => 'dashicons-randomize',
	) );
}

add_action( 'init', 'utm_switcher_init' );

	/**
	 * Sets up messages.
	 *
	 * @since	1.0.0
	 *
	 * @param	array	$messages	Array of messages.
	 */
function utm_switcher_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['utm_switcher'] = array(
		0	 => '', // Unused. Messages start at index 1.
		1	 => sprintf( __( 'UTM Switcher updated.', 'utm-switcher' ), esc_url( $permalink ) ),
		2	 => __( 'Custom field updated.', 'utm-switcher' ),
		3	 => __( 'Custom field deleted.', 'utm-switcher' ),
		4	 => __( 'UTM Switcher updated.', 'utm-switcher' ),
		/* translators: %s: date and time of the revision */
		5	 => isset( $_GET['revision'] ) ? sprintf( __( 'UTM Switcher restored to revision from %s', 'utm-switcher' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6	 => sprintf( __( 'UTM Switcher published.', 'utm-switcher' ), esc_url( $permalink ) ),
		7	 => __( 'UTM Switcher saved.', 'utm-switcher' ),
		8	 => sprintf( __( 'UTM Switcher submitted. ', 'utm-switcher' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9	 => sprintf( __( 'UTM Switcher scheduled for: <strong>%1$s</strong>.', 'utm-switcher' ),
					 date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		10	 => sprintf( __( 'UTM Switcher draft updated.', 'utm-switcher' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}

add_filter( 'post_updated_messages', 'utm_switcher_updated_messages' );

	/**
	 * Sets up columns.
	 *
	 * @since	1.0.0
	 *
	 * @param	array	$columns	Array of columns.
	 */
function utm_switcher_set_admin_column_list($columns) { 
  unset($columns['date']); 
  // Delete the element from the array and the column disappears.
  unset($columns['title']);  
  // Delete title so I can add it back with a new title.
  $columns['title'] = __('Identifier', 'utm-switcher');
  // Add Type Column
  $columns['type'] = __('Type', 'utm-switcher'); 

  
  return $columns;
}
add_filter('manage_utm_switcher_posts_columns', 'utm_switcher_set_admin_column_list');

	/**
 * Sets up column data.
 *
 * @since 1.0.0
 *
 * @param string $column Column name.
 * @param int $post_id Post ID.
 */
function utm_switcher_populate_custom_columns( $column, $post_id ) {

	if ( 'type' === $column ) {

		$switcher_type = carbon_get_post_meta( get_the_ID(), 'switcher_type' );

		switch ( $switcher_type ) {
			case 'phone':
				$type = __( 'Phone Number Element', 'utm-switcher' );
				break;
			case 'text':
				$type = __( 'Text Replacement', 'utm-switcher' );
				break;
			default:
				$type = ucfirst( $switcher_type );
				break;
		}

		echo apply_filters( 'utm_switcher_populate_custom_columns', $type, $post_id );
	}
}

add_action( 'manage_utm_switcher_posts_custom_column', 'utm_switcher_populate_custom_columns', 10, 2 );
