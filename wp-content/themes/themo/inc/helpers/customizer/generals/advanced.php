<?php


if (!function_exists('ideothemo_get_advanced_google_maps_api_key')) {
    function ideothemo_get_advanced_google_maps_api_key()
    {
        return ideothemo_get_theme_mod_parse('advanced.advanced_advanced.advanced_gm_api_key');
    }
}

if (!function_exists('ideothemo_get_advanced_head_tags')) {
    function ideothemo_get_advanced_head_tags()
    {
        return htmlspecialchars_decode(ideothemo_get_theme_mod_parse('advanced.advanced_advanced.advanced_head_tags'), ENT_QUOTES);
    }
}

if (!function_exists('ideothemo_get_advanced_body_tags')) {
    function ideothemo_get_advanced_body_tags()
    {
        return htmlspecialchars_decode(ideothemo_get_theme_mod_parse('advanced.advanced_advanced.advanced_body_tags'), ENT_QUOTES);
    }
}