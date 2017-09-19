<?php
include_once(IDEOTHEMO_INIT_DIR . 'inc/menufield/CustomField.php');
include_once(IDEOTHEMO_INIT_DIR . 'inc/menufield/updateCustomField.php');
include_once(IDEOTHEMO_INIT_DIR . 'inc/menufield/addCustomField.php');
include_once(IDEOTHEMO_INIT_DIR . 'inc/menufield/walkerMenu.php');


function ideothemo_register_main_menu()
{
    register_nav_menu('main-menu', esc_html__('Main menu (primary)', 'themo'));
}

add_action('init', 'ideothemo_register_main_menu');

function ideothemo_register_secondary_menu()
{
    register_nav_menu('secondary-menu', esc_html__('Secondary menu', 'themo'));
}

add_action('init', 'ideothemo_register_secondary_menu');

function ideothemo_register_third_menu()
{
    register_nav_menu('third-menu', esc_html__('Third menu', 'themo'));
}

add_action('init', 'ideothemo_register_third_menu');


add_filter('wp_edit_nav_menu_walker', 'ideothemo_custom_nav_edit_walker', 10, 2);

function ideothemo_custom_nav_edit_walker($walker, $menu_id)
{
    return 'CustomField';
}
