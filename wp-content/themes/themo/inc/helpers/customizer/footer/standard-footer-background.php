<?php

if (!function_exists('ideothemo_get_standard_footer_background_type')) {
    /**
     * FOOTER BAACKGROUND TYPE
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_standard_footer_background_type($useLocal = false)
    {
        return ideothemo_get_footer_background_setting('footer.standard_footer_background.footer_background_type', $useLocal);
    }
}

/** BACKGROUND COLOR */

if (!function_exists('ideothemo_get_standard_footer_background_color')) {
    /**
     *
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_standard_footer_background_color($useLocal = false)
    {
        return ideothemo_is_color(ideothemo_get_footer_background_setting('footer.standard_footer_background.footer_background_color', $useLocal), 'undefined');
    }
}

if (!function_exists('ideothemo_get_standard_footer_background_color_overlay')) {
    /**
     *
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_standard_footer_background_color_overlay($useLocal = false)
    {
        return ideothemo_get_footer_background_setting('footer.standard_footer_background.footer_background_color_overlay', $useLocal);
    }
}

if (!function_exists('ideothemo_get_standard_footer_background_color_overlay_color')) {
    /**
     *
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_standard_footer_background_color_overlay_color($useLocal = false)
    {
        return ideothemo_is_color(ideothemo_get_footer_background_setting('footer.standard_footer_background.footer_background_color_overlay_color', $useLocal), 'undefined');
    }
}

if (!function_exists('ideothemo_get_standard_footer_background_color_pattern')) {
    /**
     *
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_standard_footer_background_color_pattern($useLocal = false)
    {
        return ideothemo_get_footer_background_setting('footer.standard_footer_background.footer_background_color_pattern', $useLocal);
    }
}

if (!function_exists('ideothemo_get_standard_footer_background_color_pattern_color')) {
    /**
     *
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_standard_footer_background_color_pattern_color($useLocal = false)
    {
        return ideothemo_is_color(ideothemo_get_footer_background_setting('footer.standard_footer_background.footer_background_color_pattern_color', $useLocal), 'undefined');
    }
}

/** BACKGROUND IMAGE */

if (!function_exists('ideothemo_get_standard_footer_background_upload_image')) {
    /**
     *
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_standard_footer_background_upload_image($useLocal = false)
    {
        return ideothemo_get_footer_background_setting('footer.standard_footer_background.footer_background_upload_image', $useLocal);
    }
}

if (!function_exists('ideothemo_get_standard_footer_background_cover')) {
    /**
     *
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_standard_footer_background_cover($useLocal = false)
    {
        return (int)ideothemo_blog_is_switch_enabled(ideothemo_get_footer_background_setting('footer.standard_footer_background.footer_background_cover', $useLocal));
    }
}

if (!function_exists('ideothemo_get_standard_footer_background_image_position')) {
    /**
     *
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_standard_footer_background_image_position($useLocal = false)
    {
        return str_replace('_', ' ', ideothemo_get_footer_background_setting('footer.standard_footer_background.footer_background_image_position', $useLocal));
    }
}

if (!function_exists('ideothemo_get_standard_footer_background_image_repeat')) {
    /**
     *
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_standard_footer_background_image_repeat($useLocal = false)
    {
        $value = str_replace('_', '-', ideothemo_get_footer_background_setting('footer.standard_footer_background.footer_background_image_repeat', $useLocal));

        return str_replace('repeat-xy', 'repeat', $value);
    }
}

if (!function_exists('ideothemo_get_standard_footer_background_image_overlay')) {
    /**
     *
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_standard_footer_background_image_overlay($useLocal = false)
    {
        return ideothemo_get_footer_background_setting('footer.standard_footer_background.footer_background_image_overlay', $useLocal);
    }
}

if (!function_exists('ideothemo_get_standard_footer_background_image_overlay_color')) {
    /**
     *
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_standard_footer_background_image_overlay_color($useLocal = false)
    {
        return ideothemo_is_color(ideothemo_get_footer_background_setting('footer.standard_footer_background.footer_background_image_overlay_color', $useLocal), 'undefined');
    }
}

if (!function_exists('ideothemo_get_standard_footer_background_image_overlay_pattern')) {
    /**
     *
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_standard_footer_background_image_overlay_pattern($useLocal = false)
    {
        return ideothemo_get_footer_background_setting('footer.standard_footer_background.footer_background_image_overlay_pattern', $useLocal);
    }
}

if (!function_exists('ideothemo_get_standard_footer_background_image_overlay_pattern_color')) {
    /**
     *
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_standard_footer_background_image_overlay_pattern_color($useLocal = false)
    {
        return ideothemo_is_color(ideothemo_get_footer_background_setting('footer.standard_footer_background.footer_background_image_overlay_pattern_color', $useLocal), 'undefined');
    }
}