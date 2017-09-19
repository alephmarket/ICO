<?php

add_filter('wp_setup_nav_menu_item', 'ideothemo_anchor_nav_item');
function ideothemo_anchor_nav_item($menu_item)
{
    $menu_item->anchor = get_post_meta($menu_item->ID, '_menu_item_anchor', true);
    return $menu_item;
}

add_filter('wp_setup_nav_menu_item', 'ideothemo_link_nav_item');
function ideothemo_link_nav_item($menu_item)
{
    $menu_item->link = get_post_meta($menu_item->ID, '_menu_item_link', true);
    return $menu_item;
}

add_filter('wp_setup_nav_menu_item', 'ideothemo_mega_menu_nav_item');
function ideothemo_mega_menu_nav_item($menu_item)
{
    $menu_item->mega_menu = get_post_meta($menu_item->ID, '_menu_item_mega_menu', true);
    return $menu_item;
}

add_filter('wp_setup_nav_menu_item', 'ideothemo_mega_menu_icon');
function ideothemo_mega_menu_icon($menu_item)
{
    $menu_item->icon = get_post_meta($menu_item->ID, '_menu_item_icon', true);
    return $menu_item;
}

add_filter('wp_setup_nav_menu_item', 'ideothemo_mega_menu_background');
function ideothemo_mega_menu_background($menu_item)
{
    $menu_item->background = get_post_meta($menu_item->ID, '_menu_item_background', true);
    return $menu_item;
}
add_filter('wp_setup_nav_menu_item', 'ideothemo_menu_tag_background');
function ideothemo_menu_tag_background($menu_item)
{
    $menu_item->tag_background = get_post_meta($menu_item->ID, '_menu_item_tag_background', true);
    return $menu_item;
}
add_filter('wp_setup_nav_menu_item', 'ideothemo_menu_tag_text');
function ideothemo_menu_tag_text($menu_item)
{
    $menu_item->tag_text = get_post_meta($menu_item->ID, '_menu_item_tag_text', true);
    return $menu_item;
}