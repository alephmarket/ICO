<?php

if (!function_exists('ideothemo_get_custom_css')) {
    function ideothemo_get_custom_css()
    {
        return ideothemo_normalize_text(ideothemo_get_theme_mod_parse('custom.custom_css.custom_css'));
    }
}

if (!function_exists('ideothemo_get_custom_js')) {
    function ideothemo_get_custom_js()
    {
        return 'try {' . ideothemo_normalize_text(ideothemo_get_theme_mod_parse('custom.custom_js.custom_js')) . '}catch(err) {  alert("CUSTOM JS: " + err.message); }';
    }
}
