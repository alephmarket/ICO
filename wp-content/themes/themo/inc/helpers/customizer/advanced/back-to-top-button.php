<?php

if (!function_exists('ideothemo_get_back_top_button_enabled')) {
    function ideothemo_get_back_top_button_enabled()
    {
        return ideothemo_blog_is_switch_enabled(ideothemo_get_theme_mod_parse('advanced.advanced_backtotop.advanced_backtotop_button'));
    }
}

if (!function_exists('ideothemo_get_back_top_button_border_radius')) {
    function ideothemo_get_back_top_button_border_radius()
    {
        return (int)ideothemo_get_theme_mod_parse('advanced.advanced_backtotop.advanced_backtotop_radius');
    }
}

if (!function_exists('ideothemo_get_back_top_button_background_color')) {
    function ideothemo_get_back_top_button_background_color()
    {
        return ideothemo_is_color(ideothemo_get_theme_mod_parse('advanced.advanced_backtotop.advanced_backtotop_background_color'), 'undefined');
    }
}

if (!function_exists('ideothemo_get_back_top_button_background_hover_color')) {
    function ideothemo_get_back_top_button_background_hover_color()
    {
        return ideothemo_is_color(ideothemo_get_theme_mod_parse('advanced.advanced_backtotop.advanced_backtotop_background_hover_color'), 'undefined');
    }
}

if (!function_exists('ideothemo_get_back_top_button_icon_color')) {
    function ideothemo_get_back_top_button_icon_color()
    {
        return ideothemo_is_color(ideothemo_get_theme_mod_parse('advanced.advanced_backtotop.advanced_backtotop_icon_color'), 'undefined');
    }
}


if (!function_exists('ideothemo_get_back_top_button_icon_hover_color')) {
    function ideothemo_get_back_top_button_icon_hover_color()
    {
        return ideothemo_is_color(ideothemo_get_theme_mod_parse('advanced.advanced_backtotop.advanced_backtotop_icon_hover_color'), 'undefined');
    }
}
