<?php

add_action('init', 'ideothemo_custom_post_types_init');

//add_action('ideo_init_custom_post_types', 'ideo_post_types_init');

function ideothemo_custom_post_types_init()
{

    // Portfolio
    $labels = array(
        'name' => _x('Portfolio', 'post type general name', 'ideo-themo'),
        'singular_name' => _x('Portfolio', 'post type singular name', 'ideo-themo'),
        'menu_name' => _x('Portfolio', 'admin menu', 'ideo-themo'),
        'name_admin_bar' => _x('Portfolio', 'add new on admin bar', 'ideo-themo'),
        'add_new' => _x('Add New', 'book', 'ideo-themo'),
        'add_new_item' => __('Add New Portfolio', 'ideo-themo'),
        'new_item' => __('New Portfolio', 'ideo-themo'),
        'edit_item' => __('Edit Portfolio', 'ideo-themo'),
        'view_item' => __('View Portfolio', 'ideo-themo'),
        'all_items' => __('All Portfolio', 'ideo-themo'),
        'search_items' => __('Search Portfolio', 'ideo-themo'),
        'parent_item_colon' => __('Parent Portfolio:', 'ideo-themo'),
        'not_found' => __('No Portfolio found.', 'ideo-themo'),
        'not_found_in_trash' => __('No Portfolio found in Trash.', 'ideo-themo')
    );
    
    if(function_exists('ideothemo_get_portfolio_slug')){
        $portfolio_slug = ideothemo_get_portfolio_slug();
    }else{
        $portfolio_slug = 'portfolio';
    }

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => $portfolio_slug),
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => null,
        'menu_icon' => 'dashicons-images-alt2',
        'supports' => array('title', 'editor', 'thumbnail', 'revisions')
    );

    register_post_type('portfolio', $args);


    $labels = array(
        'name' => _x('Categories', 'taxonomy general name', 'ideo-themo'),
        'singular_name' => _x('Category', 'taxonomy singular name', 'ideo-themo'),
        'search_items' => __('Search Categories', 'ideo-themo'),
        'all_items' => __('All Categories', 'ideo-themo'),
        'parent_item' => __('Parent Categories', 'ideo-themo'),
        'parent_item_colon' => __('Parent Categories:', 'ideo-themo'),
        'edit_item' => __('Edit Categories', 'ideo-themo'),
        'update_item' => __('Update Categories', 'ideo-themo'),
        'add_new_item' => __('Add New Category', 'ideo-themo'),
        'new_item_name' => __('New Category Name', 'ideo-themo'),
        'menu_name' => __('Categories', 'ideo-themo'),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'portfolio-categories'),
    );

    register_taxonomy('portfolio_categories', array('portfolio'), $args);

    // Team
    $labels = array(
        'name' => _x('Team', 'post type general name', 'ideo-themo'),
        'singular_name' => _x('Member', 'post type singular name', 'ideo-themo'),
        'menu_name' => _x('Team', 'admin menu', 'ideo-themo'),
        'name_admin_bar' => _x('Team', 'add new on admin bar', 'ideo-themo'),
        'add_new' => _x('Add New', 'book', 'ideo-themo'),
        'add_new_item' => __('Add New Member', 'ideo-themo'),
        'new_item' => __('New Member', 'ideo-themo'),
        'edit_item' => __('Edit Member', 'ideo-themo'),
        'view_item' => __('View Member', 'ideo-themo'),
        'all_items' => __('All Members', 'ideo-themo'),
        'search_items' => __('Search Members', 'ideo-themo'),
        'parent_item_colon' => __('Parent Members:', 'ideo-themo'),
        'not_found' => __('No Member found.', 'ideo-themo'),
        'not_found_in_trash' => __('No Member found in Trash.', 'ideo-themo')
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'team'),
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => null,
        'menu_icon' =>  'dashicons-businessman',
        'supports' => array('title', 'editor', 'thumbnail', 'revisions', 'custom-fields')
    );

    register_post_type('team', $args);


    $labels = array(
        'name' => _x('Group', 'post type general name', 'ideo-themo'),
        'singular_name' => _x('Member', 'post type singular name', 'ideo-themo'),
        'menu_name' => _x('Group', 'admin menu', 'ideo-themo'),
        'name_admin_bar' => _x('Group', 'add new on admin bar', 'ideo-themo'),
        'add_new' => _x('Add New', 'book', 'ideo-themo'),
        'add_new_item' => __('Add New Group', 'ideo-themo'),
        'new_item' => __('New Group', 'ideo-themo'),
        'edit_item' => __('Edit Group', 'ideo-themo'),
        'view_item' => __('View Group', 'ideo-themo'),
        'all_items' => __('All Groups', 'ideo-themo'),
        'search_items' => __('Search Group', 'ideo-themo'),
        'parent_item_colon' => __('Parent Group:', 'ideo-themo'),
        'not_found' => __('No Group found.', 'ideo-themo'),
        'not_found_in_trash' => __('No Group found in Trash.', 'ideo-themo')
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array('slug' => 'team-category'),
    );

    register_taxonomy('team-category', 'team', $args);

    // Footer
    $labels = array(
        'name' => _x('Footers', 'post type general name', 'ideo-themo'),
        'singular_name' => _x('Footer', 'post type singular name', 'ideo-themo'),
        'menu_name' => _x('Footer', 'admin menu', 'ideo-themo'),
        'name_admin_bar' => _x('Footer', 'add new on admin bar', 'ideo-themo'),
        'add_new' => _x('Add New', 'book', 'ideo-themo'),
        'add_new_item' => __('Add New Footer', 'ideo-themo'),
        'new_item' => __('New Footer', 'ideo-themo'),
        'edit_item' => __('Edit Footer', 'ideo-themo'),
        'view_item' => __('View Footer', 'ideo-themo'),
        'all_items' => __('All Footers', 'ideo-themo'),
        'search_items' => __('Search Footers', 'ideo-themo'),
        'parent_item_colon' => __('Parent Footers:', 'ideo-themo'),
        'not_found' => __('No Footer found.', 'ideo-themo'),
        'not_found_in_trash' => __('No Footer found in Trash.', 'ideo-themo')
    );

    $args = array(
        'labels' => $labels,
        'exclude_from_search' => true,
        'public' => true,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => false,
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => null,
        'menu_icon' => plugin_dir_url(__FILE__) . '../assets/images/ico-footer.png',
        'supports' => array('title', 'editor', 'revisions')
    );
    
    if(function_exists('ideothemo_get_footer_post_type')){
        $footer_post_type = ideothemo_get_footer_post_type();
    }else{
        $footer_post_type = 'footer-post';
    }

    register_post_type($footer_post_type, $args);

}