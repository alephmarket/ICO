<?php

add_action('wp_update_nav_menu_item', 'ideothemo_custom_nav_update', 10, 3);

function ideothemo_custom_nav_update($menu_id, $menu_item_db_id, $args)
{
    if (isset($_REQUEST['menu-item-anchor']) && is_array($_REQUEST['menu-item-anchor'])) {
        $custom_value = $_REQUEST['menu-item-anchor'][$menu_item_db_id];
        update_post_meta($menu_item_db_id, '_menu_item_anchor', $custom_value);
    }
    if (isset($_REQUEST['menu-item-link'])) {
        $custom_value = isset($_REQUEST['menu-item-link'][$menu_item_db_id]) ? 'true' : false;
        update_post_meta($menu_item_db_id, '_menu_item_link', $custom_value);
    } else {
        update_post_meta($menu_item_db_id, '_menu_item_link', false);
    }
    if (isset($_REQUEST['menu-item-mega-menu'])) {
        $custom_value = isset($_REQUEST['menu-item-mega-menu'][$menu_item_db_id]) ? 'true' : false;
        update_post_meta($menu_item_db_id, '_menu_item_mega_menu', $custom_value);
    } else {
        update_post_meta($menu_item_db_id, '_menu_item_mega_menu', false);
    }
    if (isset($_REQUEST['menu-item-icon']) && is_array($_REQUEST['menu-item-icon'])) {
        $custom_value = $_REQUEST['menu-item-icon'][$menu_item_db_id];
        update_post_meta($menu_item_db_id, '_menu_item_icon', $custom_value);
    }
    if (isset($_REQUEST['menu-item-background']) && is_array($_REQUEST['menu-item-background'])) {
        $custom_value = $_REQUEST['menu-item-background'][$menu_item_db_id];
        update_post_meta($menu_item_db_id, '_menu_item_background', $custom_value);
    }
    if (isset($_REQUEST['menu-item-tag-background']) && is_array($_REQUEST['menu-item-tag-background'])) {
        $custom_value = $_REQUEST['menu-item-tag-background'][$menu_item_db_id];
        update_post_meta($menu_item_db_id, '_menu_item_tag_background', $custom_value);
    }
    if (isset($_REQUEST['menu-item-tag-text']) && is_array($_REQUEST['menu-item-tag-text'])) {
        $custom_value = $_REQUEST['menu-item-tag-text'][$menu_item_db_id];
        update_post_meta($menu_item_db_id, '_menu_item_tag_text', $custom_value);
    }
}