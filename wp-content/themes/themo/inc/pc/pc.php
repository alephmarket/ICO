<?php

define('IDEOTHEMO_PC_VERSION', '0.9.2');
define('IDEOTHEMO_PC_URL', IDEOTHEMO_INIT_DIR_URI . '/inc/pc/');
define('IDEOTHEMO_PC_DIR', get_template_directory());

if (!function_exists('add_action') && !defined('IDEOTHEMO_CORE_VERSION')) {
    exit;
}

if ((isset($_GET['mode']) && $_GET['mode'] == 'pc') || (isset($_SERVER['HTTP_REFERER']) && parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY ) == 'mode=pc' )) {

    require('php/class/class-custom_control.php');
    require('php/class/class-pc.php');

    $pc_framework = new ParallaxComposer();
}