<?php
class Maven_Msg_Init {
	function __construct() {
		$this->set_filters();
	}

	function set_filters() {
		add_action('init', array($this, 'create_post_type'));
		add_action('init', array($this, 'create_taxonomy'));
	}

	function create_post_type() {
		$slug = apply_filters('maven_msg_slug', __('message', 'maven'));
		register_post_type('maven_msg',
			array(
				'labels' => array(
					'name' => __('Messages', 'maven'),
					'singular_name' => __('Message', 'maven'),
					'add_new' => _x('Create New Message', 'maven'),
					'add_new_item' => __('Create New Message', 'maven'),
					'edit_item', __('Edit Message', 'maven'),
					'new_item', __('New Message', 'maven'),
					'view_item' => __('View Message', 'maven'),
					'view_items' => __('View Messages', 'maven'),
					'search_items' => __('Search Messages', 'maven'),
					'not_found' => __('No messages found', 'maven'),
					'not_found_in_trash' => __('No messages found in trash', 'maven'),
					//'parent_item_colon' => __('Parent Message', 'maven'),
					'all_items' => __('All Messages', 'maven'),
					'archives' => __('Message Archives', 'maven'),
					'insert_into_item' => __('Insert into message', 'maven'),
				),
				//'public' => false,
				//'show_in_nav_menus' => true,
				'show_ui' => true,
				'show_in_menu' => true,
				'show_in_admin_bar' => true,
				//'publicly_queryable' => true,
				//'exclude_from_search' => false,
				//'hierarchical' => apply_filters('maven_msg_hierarchical', true),
				'menu_position' => 5,
				'capability_type' => 'post',
				'query_var' => true,
				'rewrite' => apply_filters('maven_msg_rewrite', array('slug' => $slug, 'with_front' => false)),
				//'has_archive' => apply_filters('maven_msg_has_archive', $slug),
				'supports' => array('editor'),
				'taxonomies' => array('maven_msg_type'),
				'register_meta_box_cb' => array($this, 'maven_msg_metabox_cb'),
				//'show_in_rest' => true,
			)
		);
	}

	function maven_msg_metabox_cb() {
		// do nothing
	}

	function create_taxonomy() {
		$slug = apply_filters('maven_msg_type_slug', __('message type', 'maven'));
		$labels = array(
			'name' => __('Message Types', 'maven'),
			'singular_name' => __('Message Type', 'maven'),
			'add_new' => _x('Add New Message Type', 'maven'),
			'add_new_item' => __('Add New Message Type', 'maven'),
			'edit_item', __('Edit Message Type', 'maven'),
			'new_item', __('New Message Type', 'maven'),
			'view_item' => __('View Message Type', 'maven'),
			'view_items' => __('View Message Types', 'maven'),
			'search_items' => __('Search Message Types', 'maven'),
			'not_found' => __('No message types found', 'maven'),
			'not_found_in_trash' => __('No message types found in trash', 'maven'),
			'parent_item_colon' => __('Parent Message Type', 'maven'),
		);
		$args = array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => false,
			'show_admin_column' => false,
			'show_in_rest' => false,
			//'update_count_callback' => array($this, 'maven_msg_type_update_count_cb'),
			'query_var' => true,
			'rewrite' => apply_filters('maven_msg_type_rewrite', array('slug' => $slug))
		);
		$args = apply_filters('maven_msg_type_args', $args);
		register_taxonomy('maven_msg_type', 'maven_msg', $args);
	}
}
$maven_msg = new Maven_Msg_Init();
?>