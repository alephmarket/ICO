<?php

require(IDEOTHEMO_INIT_DIR . 'inc/meta_boxes/post.php');
require(IDEOTHEMO_INIT_DIR . 'inc/meta_boxes/portfolio.php');
require(IDEOTHEMO_INIT_DIR . 'inc/meta_boxes/team.php');
require(IDEOTHEMO_INIT_DIR . 'inc/meta_boxes/page.php');
require(IDEOTHEMO_INIT_DIR . 'inc/meta_boxes/user.php');

function ideothemo_meta_boxes()
{
    add_meta_box(
        'portfolio_mb',
        esc_html__('Portfolio Options', 'themo'),
        'ideothemo_portfolio_callback',
        'portfolio'
    );

    add_meta_box(
        'team_mb',
        esc_html__('Team Options', 'themo'),
        'ideothemo_team_callback',
        'team'
    );

    add_meta_box(
        'post_mb',
        esc_html__('Post Options', 'themo'),
        'ideothemo_post_callback',
        'post'
    );

    add_meta_box(
        'page_mb',
        esc_html__('Page Options', 'themo'),
        'ideothemo_page_callback',
        'page'
    );
}

add_action('add_meta_boxes', 'ideothemo_meta_boxes');

function ideothemo_save_meta_boxes_data($post_id)
{

    // Check if our nonce is set.
    if (!isset($_POST['ideo_meta_box_nonce'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['ideo_meta_box_nonce'], 'ideo_meta_box')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['_ideo_portfolio'])) {

        $data = $_POST['_ideo_portfolio'];
        update_post_meta($post_id, '_ideo_portfolio', $data);
    }

    if (isset($_POST['_ideo_team'])) {

        $data = $_POST['_ideo_team'];
        update_post_meta($post_id, '_ideo_team', $data);
    }

    if (isset($_POST['_ideo_post'])) {

        $data = $_POST['_ideo_post'];
        update_post_meta($post_id, '_ideo_post', $data);
    }

    if (isset($_POST['_ideo_page'])) {

        $data = $_POST['_ideo_page'];
        update_post_meta($post_id, '_ideo_page', $data);
    }


}

add_action('save_post', 'ideothemo_save_meta_boxes_data');