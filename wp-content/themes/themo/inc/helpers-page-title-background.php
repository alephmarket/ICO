<?php

//GENERAL

if (!function_exists('ideothemo_is_pt_default_background')) {
    function ideothemo_is_pt_default_background()
    {
        $default = ideothemo_get_page_title_local_setting('pagetitle.page_title_background.page_title_area_background');

        return empty($default);
    }
}

if (!function_exists('ideothemo_get_pt_background_setting')) {
    function ideothemo_get_pt_background_setting($setting, $useLocal = false)
    {
        if ($useLocal && (ideothemo_is_pt_default_background() && $setting != 'pagetitle.page_title_background.pt_background_parallax')) {
            $useLocal = false;
        }
        return ideothemo_get_page_title_setting($setting, $useLocal);
    }
}

if (!function_exists('ideothemo_get_pt_area_background')) {
    /**
     * PAGE TITLE AREA BACKGROUND
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_pt_area_background($useLocal = false)
    {
        $backgroundType = ideothemo_get_pt_background_setting('pagetitle.page_title_background.page_title_area_background', $useLocal);

        return empty($backgroundType) ? 'default' : $backgroundType;
    }
}

// BACKGROUND TYPE - COLOR

if (!function_exists('ideothemo_get_pt_background_color')) {
    /**
     * BACKGROUND COLOR
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_pt_background_color($useLocal = false)
    {
        return ideothemo_is_color(ideothemo_get_pt_background_setting('pagetitle.page_title_background.pt_background_color', $useLocal), 'undefined');
    }
}

if (!function_exists('ideothemo_get_pt_background_color_overlay')) {
    /**
     * OVERLAY TYPE
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_pt_background_color_overlay($useLocal = false)
    {
        return ideothemo_get_pt_background_setting('pagetitle.page_title_background.pt_background_color_overlay', $useLocal);
    }
}

if (!function_exists('ideothemo_get_pt_background_color_overlay_color')) {
    /**
     * OVERLAY COLOR
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_pt_background_color_overlay_color($useLocal = false)
    {
        return ideothemo_is_color(ideothemo_get_pt_background_setting('pagetitle.page_title_background.pt_background_color_overlay_color', $useLocal), 'undefined');
    }
}

if (!function_exists('ideothemo_get_pt_background_color_pattern')) {
    /**
     * PATTERN
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_pt_background_color_pattern($useLocal = false)
    {
        return ideothemo_get_pt_background_setting('pagetitle.page_title_background.pt_background_color_pattern', $useLocal);
    }
}

if (!function_exists('ideothemo_get_pt_background_color_pattern_color')) {
    /**
     * PATTERN COLOR
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_pt_background_color_pattern_color($useLocal = false)
    {
        return ideothemo_is_color(ideothemo_get_pt_background_setting('pagetitle.page_title_background.pt_background_color_pattern_color', $useLocal), 'undefined');
    }
}

// BACKGROUND TYPE - IMAGE

if (!function_exists('ideothemo_get_pt_background_upload_image')) {
    /**
     * UPLOAD IMAGE
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_pt_background_upload_image($useLocal = false)
    {
        return ideothemo_get_pt_background_setting('pagetitle.page_title_background.pt_background_upload_image', $useLocal);
    }
}

if (!function_exists('ideothemo_get_pt_background_cover')) {
    /**
     * 100% BACKGROUND
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_pt_background_cover($useLocal = false)
    {
        return (int)ideothemo_blog_is_switch_enabled(ideothemo_get_pt_background_setting('pagetitle.page_title_background.pt_background_cover', $useLocal));
    }
}

if (!function_exists('ideothemo_get_pt_background_image_position')) {
    /**
     * IMAGE POSITION
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_pt_background_image_position($useLocal = false)
    {
        return str_replace('_', ' ', ideothemo_get_pt_background_setting('pagetitle.page_title_background.pt_background_image_position', $useLocal));
    }
}

if (!function_exists('ideothemo_get_pt_background_image_repeat')) {
    /**
     * IMAGE REPEAT
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_pt_background_image_repeat($useLocal = false)
    {
        $value = str_replace('_', '-', ideothemo_get_pt_background_setting('pagetitle.page_title_background.pt_background_image_repeat', $useLocal));

        return str_replace('repeat-xy', 'repeat', $value);
    }
}

if (!function_exists('ideothemo_get_pt_background_motion')) {
    /**
     * BACKGROUND MOTION
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_pt_background_motion($useLocal = false)
    {
        return ideothemo_get_pt_background_setting('pagetitle.page_title_background.pt_background_motion', $useLocal);
    }
}

if (!function_exists('ideothemo_get_pt_background_moving_speed')) {
    /**
     * MOVING SPEED
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_pt_background_moving_speed($useLocal = false)
    {
        return ideothemo_get_pt_background_setting('pagetitle.page_title_background.pt_background_moving_speed', $useLocal);
    }
}

if (!function_exists('ideothemo_get_pt_background_parallax')) {
    /**
     * PAGE TITLE PARALLAX EFFECT
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_pt_background_parallax($useLocal = false)
    {
        return ideothemo_blog_is_switch_enabled(ideothemo_get_pt_background_setting('pagetitle.page_title_background.pt_background_parallax', $useLocal));
    }
}

if (!function_exists('ideothemo_get_pt_background_image_overlay')) {
    /**
     * IMAGE OVERLAY
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_pt_background_image_overlay($useLocal = false)
    {
        return ideothemo_get_pt_background_setting('pagetitle.page_title_background.pt_background_image_overlay', $useLocal);
    }
}

if (!function_exists('ideothemo_get_pt_background_image_overlay_color')) {
    /**
     * OVERLAY COLOR
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_pt_background_image_overlay_color($useLocal = false)
    {
        return ideothemo_is_color(ideothemo_get_pt_background_setting('pagetitle.page_title_background.pt_background_image_overlay_color', $useLocal), 'undefined');
    }
}

if (!function_exists('ideothemo_get_pt_background_image_overlay_pattern')) {
    /**
     * PATTERN
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_pt_background_image_overlay_pattern($useLocal = false)
    {
        return ideothemo_get_pt_background_setting('pagetitle.page_title_background.pt_background_image_overlay_pattern', $useLocal);
    }
}

if (!function_exists('ideothemo_get_pt_background_image_overlay_pattern_color')) {
    /**
     * PATTERN COLOR
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_pt_background_image_overlay_pattern_color($useLocal = false)
    {
        return ideothemo_get_pt_background_setting('pagetitle.page_title_background.pt_background_image_overlay_pattern_color', $useLocal);
    }
}

// BACKGROUND TYPE - VIDEO

if (!function_exists('ideothemo_get_pt_background_fallback_image')) {
    /**
     * MOBILE FALLBACK IMAGE
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_pt_background_fallback_image($useLocal = false)
    {
        return ideothemo_get_pt_background_setting('pagetitle.page_title_background.pt_background_fallback_image', $useLocal);
    }
}

if (!function_exists('ideothemo_get_pt_background_video_platform')) {
    /**
     * VIDEO PLATFORM
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_pt_background_video_platform($useLocal = false)
    {
        return ideothemo_get_pt_background_setting('pagetitle.page_title_background.pt_background_video_platform', $useLocal);
    }
}

if (!function_exists('ideothemo_get_pt_background_youtube')) {
    /**
     * YOUTUBE VIDEO
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_pt_background_youtube($useLocal = false)
    {
        return ideothemo_get_youtube_video_id(ideothemo_get_pt_background_setting('pagetitle.page_title_background.pt_background_youtube', $useLocal));
    }
}

if (!function_exists('ideothemo_get_pt_background_mp4')) {
    /**
     * MP4 FORMAT
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_pt_background_mp4($useLocal = false)
    {
        return ideothemo_get_pt_background_setting('pagetitle.page_title_background.pt_background_mp4', $useLocal);
    }
}

if (!function_exists('ideothemo_get_pt_background_webm')) {
    /**
     * WEBM FORMAT
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_pt_background_webm($useLocal = false)
    {
        return ideothemo_get_pt_background_setting('pagetitle.page_title_background.pt_background_webm', $useLocal);
    }
}

if (!function_exists('ideothemo_get_pt_background_fallback_image')) {
    /**
     * FALLBACK & MOBILE IMAGE
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_pt_background_fallback_image($useLocal = false)
    {
        return ideothemo_get_pt_background_setting('pagetitle.page_title_background.pt_background_fallback_image', $useLocal);
    }
}

if (!function_exists('ideothemo_get_pt_background_video_overlay')) {
    /**
     * VIDEO OVERLAY
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_pt_background_video_overlay($useLocal = false)
    {
        return ideothemo_get_pt_background_setting('pagetitle.page_title_background.pt_background_video_overlay', $useLocal);
    }
}

if (!function_exists('ideothemo_get_pt_background_video_overlay_color')) {
    /**
     * OVERLAY COLOR
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_pt_background_video_overlay_color($useLocal = false)
    {
        return ideothemo_is_color(ideothemo_get_pt_background_setting('pagetitle.page_title_background.pt_background_video_overlay_color', $useLocal), 'undefined');
    }
}

if (!function_exists('ideothemo_get_pt_background_video_overlay_pattern')) {
    /**
     * PATTERN
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_pt_background_video_overlay_pattern($useLocal = false)
    {
        return ideothemo_get_pt_background_setting('pagetitle.page_title_background.pt_background_video_overlay_pattern', $useLocal);
    }
}

if (!function_exists('ideothemo_get_pt_background_video_overlay_pattern_color')) {
    /**
     * PATTERN COLOR
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */
    function ideothemo_get_pt_background_video_overlay_pattern_color($useLocal = false)
    {
        return ideothemo_get_pt_background_setting('pagetitle.page_title_background.pt_background_video_overlay_pattern_color', $useLocal);
    }
}

if (!function_exists('ideothemo_pt_background_overlay_pattern')) {
    function ideothemo_pt_background_overlay_pattern($type, $useLocal = false)
    {
        $mask = $color = 'undefined';

        if ($type == 'color') {

            $mask = ideothemo_get_pt_background_color_pattern($useLocal);
            $color = ideothemo_get_pt_background_color_pattern_color($useLocal);

        } elseif ($type == 'image') {

            $mask = ideothemo_get_pt_background_image_overlay_pattern($useLocal);
            $color = ideothemo_get_pt_background_image_overlay_pattern_color($useLocal);

        } elseif ($type == 'video') {

            $mask = ideothemo_get_pt_background_video_overlay_pattern($useLocal);
            $color = ideothemo_get_pt_background_video_overlay_pattern_color($useLocal);

        }

        return ideothemo_get_assets_svg('svg/masks/' . $mask . '.svg', $color);
    }
}