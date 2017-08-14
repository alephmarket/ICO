<?php

if (!function_exists('ideothemo_footer_enabled')) {
    /**
     * Footer status
     *
     * @param bool $useLocal
     * @return bool
     */
    function ideothemo_footer_enabled($useLocal = false)
    {
        if (is_404() && !ideothemo_get_theme_mod_parse('advanced.advanced_404.404_choose'))
            return true;

        return ideothemo_blog_is_switch_enabled(ideothemo_get_footer_setting('footer.footer_settings.footer_on', $useLocal));
    }
}

if (!function_exists('ideothemo_get_footer_standard_footer_skin')) {
    /**
     * Get Standard Footer skin
     *
     * @param bool $useLocal
     * @return mixed
     */
    function ideothemo_get_footer_standard_footer_skin($useLocal = false)
    {
        return ideothemo_blog_get_option(ideothemo_get_general_theme_skin(), ideothemo_get_footer_setting('footer.footer_settings.standard_footer_skin', $useLocal));
    }
}

if (!function_exists('ideothemo_get_footer_type')) {
    /**
     * Footer Type
     *
     * @param bool $useLocal
     * @return mixed
     */
    function ideothemo_get_footer_type($useLocal = false)
    {
        return ideothemo_get_footer_setting('footer.footer_settings.footer_type', $useLocal);
    }
}

if (!function_exists('ideothemo_get_footer_advanced_footer_id')) {
    /**
     * Advenced Footer
     *
     * @param bool $useLocal
     * @return mixed
     */
    function ideothemo_get_footer_advanced_footer_id($useLocal = false)
    {
        if ($useLocal) {
            $default = ideothemo_get_custom_post_meta('footer.footer_settings.footer_type');

            if (empty($default)) {
                $useLocal = false;
            }
        }

        return ideothemo_get_footer_setting('footer.footer_settings.choose_advanced_footer', $useLocal);
    }
}

if (!function_exists('ideothemo_is_sticky_footer_enabled')) {
    /**
     * Sticky Footer Status
     *
     * @return bool
     */
    function ideothemo_is_sticky_footer_enabled()
    {
        return ideothemo_blog_is_switch_enabled(ideothemo_get_page_option_setting('footer.footer_settings.sticky_footer'));
    }
}

if (!function_exists('ideothemo_copyright_enabled')) {
    /**
     * Copyright status
     *
     * @param bool $useLocal
     * @return bool
     */
    function ideothemo_copyright_enabled($useLocal = false)
    {
        return ideothemo_blog_is_switch_enabled(ideothemo_get_footer_setting('footer.footer_settings.copywrite_area_on', $useLocal));
    }
}

if (!function_exists('ideothemo_get_copyright_skin')) {
    /**
     * Get Copyright skin
     *
     * @param bool $useLocal
     * @return mixed
     */
    function ideothemo_get_copyright_skin($useLocal = false)
    {
        return ideothemo_blog_get_option('dark', ideothemo_get_footer_setting('footer.footer_settings.copyright_skin', $useLocal));
    }
}

if (!function_exists('ideothemo_get_footer_copyright_paddings')) {
    /**
     * COPYWRITE PADDING TOP & BOTTOM
     *
     * @return mixed
     */
    function ideothemo_get_footer_copyright_paddings()
    {
        return ideothemo_get_footer_setting('footer.footer_settings.copyright_paddings');
    }
}

if (!function_exists('ideothemo_get_footer_copyright_text')) {
    /**
     * Copyright text
     *
     * @param bool $useLocal
     * @return mixed
     */
    function ideothemo_get_footer_copyright_text($useLocal = false)
    {
        return htmlspecialchars_decode(ideothemo_get_footer_setting('footer.footer_settings.copyright_text', $useLocal), ENT_QUOTES);
    }
}

if (!function_exists('ideothemo_get_footer_copyright_text_align')) {
    /**
     * COPYRIGHT TEXT ALIGN
     *
     * @return mixed
     */
    function ideothemo_get_footer_copyright_text_align()
    {
        return ideothemo_get_footer_setting('footer.footer_settings.copyright_text_align');
    }
}