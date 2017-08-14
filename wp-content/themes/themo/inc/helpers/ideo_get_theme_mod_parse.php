<?php

if (!function_exists('ideothemo_get_theme_mod_parse')) {
    function ideothemo_get_theme_mod_parse($string, $default = null, $defaultInit = true, $useCache = true)
    {

        if (($ideo_theme_options = wp_cache_get('ideo_options')) === false || !$useCache) {
            $ideo_theme_options = ideothemo_get_theme_mod($defaultInit); 
            wp_cache_set('ideo_options', $ideo_theme_options);
        }

        return ideothemo_parse_dot_string($ideo_theme_options, $string, $default, $defaultInit);
    }
}