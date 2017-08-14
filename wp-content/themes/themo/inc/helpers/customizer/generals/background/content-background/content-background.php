<?php

include 'global.php';

if (!function_exists('ideothemo_get_content_background_type')) {
    /**
     * BOXED BACKGROUND TYPE
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_content_background_type($useLocal = false)
    {
        return ideothemo_blog_get_option('default', ideothemo_get_content_background_setting('generals.background.content_background_type', $useLocal));
    }
}

/** BACKGROUND COLOR */

if (!function_exists('ideothemo_get_content_background_color')) {
    /**
     *
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_content_background_color($useLocal = false)
    {
        return ideothemo_is_color(ideothemo_get_content_background_setting('generals.background.content_background_color', $useLocal), 'undefined');
    }
}

if (!function_exists('ideothemo_get_content_background_color_overlay')) {
    /**
     *
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_content_background_color_overlay($useLocal = false)
    {
        return ideothemo_get_content_background_setting('generals.background.content_background_color_overlay', $useLocal);
    }
}

if (!function_exists('ideothemo_get_content_background_color_overlay_color')) {
    /**
     *
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_content_background_color_overlay_color($useLocal = false)
    {
        return ideothemo_is_color(ideothemo_get_content_background_setting('generals.background.content_background_color_overlay_color', $useLocal), 'undefined');
    }
}

if (!function_exists('ideothemo_get_content_background_color_pattern')) {
    /**
     *
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_content_background_color_pattern($useLocal = false)
    {
        return ideothemo_get_content_background_setting('generals.background.content_background_color_pattern', $useLocal);
    }
}

if (!function_exists('ideothemo_get_content_background_color_pattern_color')) {
    /**
     *
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_content_background_color_pattern_color($useLocal = false)
    {
        return ideothemo_is_color(ideothemo_get_content_background_setting('generals.background.content_background_color_pattern_color', $useLocal), 'undefined');
    }
}

/** BACKGROUND IMAGE */

if (!function_exists('ideothemo_get_content_background_upload_image')) {
    /**
     *
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_content_background_upload_image($useLocal = false)
    {
        return ideothemo_get_content_background_setting('generals.background.content_background_upload_image', $useLocal);
    }
}

if (!function_exists('ideothemo_get_content_background_cover')) {
    /**
     *
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_content_background_cover($useLocal = false)
    {
        return (int)ideothemo_blog_is_switch_enabled(ideothemo_get_content_background_setting('generals.background.content_background_cover', $useLocal));
    }
}

if (!function_exists('ideothemo_get_content_background_image_motion')) {
    /**
     *
     *
     * @param bool $useLocal
     * @return string
     */
    function ideothemo_get_content_background_image_motion($useLocal = false)
    {
        return ideothemo_get_content_background_setting('generals.background.content_background_image_motion', $useLocal);
    }
}

if (!function_exists('ideothemo_get_content_background_image_position')) {
    /**
     *
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_content_background_image_position($useLocal = false)
    {
        return str_replace('_', ' ', ideothemo_get_content_background_setting('generals.background.content_background_image_position', $useLocal));
    }
}

if (!function_exists('ideothemo_get_content_background_image_repeat')) {
    /**
     *
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_content_background_image_repeat($useLocal = false)
    {
        $value = str_replace('_', '-', ideothemo_get_content_background_setting('generals.background.content_background_image_repeat', $useLocal));

        return str_replace('repeat-xy', 'repeat', $value);
    }
}

if (!function_exists('ideothemo_get_content_background_image_overlay')) {
    /**
     *
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_content_background_image_overlay($useLocal = false)
    {
        return ideothemo_get_content_background_setting('generals.background.content_background_image_overlay', $useLocal);
    }
}

if (!function_exists('ideothemo_get_content_background_image_overlay_color')) {
    /**
     *
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_content_background_image_overlay_color($useLocal = false)
    {
        return ideothemo_is_color(ideothemo_get_content_background_setting('generals.background.content_background_image_overlay_color', $useLocal), 'undefined');
    }
}

if (!function_exists('ideothemo_get_content_background_image_overlay_pattern')) {
    /**
     *
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_content_background_image_overlay_pattern($useLocal = false)
    {
        return ideothemo_get_content_background_setting('generals.background.content_background_image_overlay_pattern', $useLocal);
    }
}

if (!function_exists('ideothemo_get_content_background_image_overlay_pattern_color')) {
    /**
     *
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_content_background_image_overlay_pattern_color($useLocal = false)
    {
        return ideothemo_is_color(ideothemo_get_content_background_setting('generals.background.content_background_image_overlay_pattern_color', $useLocal), 'undefined');
    }
}

/** BACKGROUND VIDEO */

if (!function_exists('ideothemo_get_content_background_video_overlay')) {
    /**
     *
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_content_background_video_overlay($useLocal = false)
    {
        return ideothemo_get_content_background_setting('generals.background.content_background_video_overlay', $useLocal);
    }
}

if (!function_exists('ideothemo_get_content_background_video_overlay_color')) {
    /**
     *
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_content_background_video_overlay_color($useLocal = false)
    {
        return ideothemo_is_color(ideothemo_get_content_background_setting('generals.background.content_background_video_overlay_color', $useLocal), 'undefined');
    }
}

if (!function_exists('ideothemo_get_content_background_video_overlay_pattern')) {
    /**
     *
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_content_background_video_overlay_pattern($useLocal = false)
    {
        return ideothemo_get_content_background_setting('generals.background.content_background_video_overlay_pattern', $useLocal);
    }
}

if (!function_exists('ideothemo_get_content_background_video_overlay_pattern_color')) {
    /**
     *
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_content_background_video_overlay_pattern_color($useLocal = false)
    {
        return ideothemo_is_color(ideothemo_get_content_background_setting('generals.background.content_background_video_overlay_pattern_color', $useLocal), 'undefined');
    }
}

if (!function_exists('ideothemo_get_content_background_video_platform')) {
    function ideothemo_get_content_background_video_platform($useLocal = false)
    {
        return ideothemo_get_content_background_setting('generals.background.content_background_video_platform', $useLocal);
    }
}

if (!function_exists('ideothemo_get_content_background_youtube')) {
    /**
     * YOUTUBE VIDEO
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_content_background_youtube($useLocal = false)
    {
        return ideothemo_get_youtube_video_id(ideothemo_get_content_background_setting('generals.background.content_background_youtube', $useLocal));
    }
}

if (!function_exists('ideothemo_get_content_background_mp4')) {
    function ideothemo_get_content_background_mp4($useLocal = false)
    {
        return ideothemo_get_content_background_setting('generals.background.content_background_mp4', $useLocal);
    }
}

if (!function_exists('ideothemo_get_content_background_webm')) {
    function ideothemo_get_content_background_webm($useLocal = false)
    {
        return ideothemo_get_content_background_setting('generals.background.content_background_webm', $useLocal);
    }
}

if (!function_exists('ideothemo_get_content_background_fallback_image')) {
    function ideothemo_get_content_background_fallback_image($useLocal = false)
    {
        return ideothemo_get_content_background_setting('generals.background.content_background_fallback_image', $useLocal);
    }
}