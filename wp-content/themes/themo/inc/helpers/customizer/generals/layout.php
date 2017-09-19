<?php

if (!function_exists('ideothemo_is_boxed_version')) {
    /**
     * @return bool
     */
    function ideothemo_is_boxed_version()
    {
        $value = ideothemo_blog_is_switch_enabled(ideothemo_get_page_setting('generals.layout.boxed_version', 1));

        return $value;
    }
}

if (!function_exists('ideothemo_get_boxed_version')) {
    function ideothemo_get_boxed_version()
    {
        $class = ideothemo_is_boxed_version() ? 'container' : 'container-fluid';
        
        return $class;
    }
}

if (!function_exists('ideothemo_get_site_width')) {
    function ideothemo_get_site_width()
    {
        if ($cache = ideothemo_global_vars_get('ideo_get_site_width')) {
            return $cache;
        }

        $value = (int)ideothemo_get_theme_mod_parse('generals.layout.site_width');

        ideothemo_global_vars_add('ideo_get_site_width', $out);
        return $value;
    }
}

if (!function_exists('ideothemo_get_body_font_color')) {
    /**
     * @param bool $useLocal
     *
     * @return bool
     */
    function ideothemo_get_body_font_color($useLocal = false)
    {
        return ideothemo_get_page_setting('fonts.font_coloring.body_text_skin', $useLocal);
    }
}

if (!function_exists('ideothemo_get_content_padding_top')) {
    /**
     * @param bool $useLocal
     *
     * @return bool
     */
    function ideothemo_get_content_padding_top($useLocal = false)
    {
        return ideothemo_get_page_setting('generals.layout.content_padding_top', $useLocal);
    }
}

if (!function_exists('ideothemo_get_content_padding_bottom')) {
    /**
     * @param bool $useLocal
     *
     * @return bool
     */
    function ideothemo_get_content_padding_bottom($useLocal = false)
    {
        return ideothemo_get_page_setting('generals.layout.content_padding_bottom', $useLocal);
    }
}

if (!function_exists('ideothemo_is_custom_404')) {

    $is_custom_404 = false;

    /**
     * @param bool $useLocal
     *
     * @return bool
     */
    function ideothemo_is_custom_404($new_value = null)
    {
        global $is_custom_404;

        if ($new_value === null)
            return $is_custom_404;

        $is_custom_404 = $new_value;
    }
}
