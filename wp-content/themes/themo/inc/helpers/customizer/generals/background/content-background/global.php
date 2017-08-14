<?php

if (!function_exists('ideothemo_get_content_classes')) {
    function ideothemo_get_content_classes($useLocal = true)
    {
        $classes = array();

        $classes[] = 'skin-' . ideothemo_get_general_theme_skin();
        $classes[] = 'background-content';

        $classes[] = ideothemo_get_layout_type_class();

        $classes = array_merge($classes, ideothemo_get_background_classes(
            array(
            'background-type'           => ideothemo_get_content_background_type($useLocal),
            'background-overlay'        => ideothemo_get_content_background_overlay_type($useLocal),
            'background-video-platform' => ideothemo_get_content_background_video_platform($useLocal)
        ))
        );
        
        

        return trim(implode(' ', apply_filters('ideothemo_content_classes', $classes)));
    }
}

if (!function_exists('ideothemo_get_background_classes')) {

    function ideothemo_get_background_classes($bgSettings = array()) {

        $classes = array();

        $backgroundType = $bgSettings['background-type'];
        $backgroundOverlay = $bgSettings['background-overlay'];
        
        

        if ($backgroundType != 'default') {
            $classes[] = 'has-background';
            $classes[] = 'background-type-' . $backgroundType;
        }

        if ($backgroundType == 'video') {
            $classes[] = 'background-video-platform-' . $bgSettings['background-video-platform'];
        }

        if ($backgroundOverlay != 'none') {
            $classes[] = 'background-overlay';
            $classes[] = 'background-overlay-' . $backgroundOverlay;

            //@Deprecated
            $classes[] = 'background-overlay-' . $backgroundType . '-' . $backgroundOverlay;
        }


        return $classes;
    }
}

if (!function_exists('ideothemo_get_content_background_setting')) {
    function ideothemo_get_content_background_setting($setting, $useLocal = false)
    {
        if ($useLocal && ideothemo_is_content_background_default()) {
            $useLocal = false;
        }

        return ideothemo_get_page_setting($setting, $useLocal);
    }
}

if (!function_exists('ideothemo_is_content_background_default')) {
    function ideothemo_is_content_background_default()
    {
        $default = ideothemo_get_custom_post_meta('generals.background.content_background_type');

        return empty($default);
    }
}

if (!function_exists('ideothemo_get_content_background_overlay_type')) {

    /**
     * Return Footer Background Overlay Type
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */

    function ideothemo_get_content_background_overlay_type($useLocal = false)
    {
        $background_type = ideothemo_get_content_background_type($useLocal);

        if ($background_type == 'color') {

            return ideothemo_get_content_background_color_overlay($useLocal);

        } elseif ($background_type == 'image') {

            return ideothemo_get_content_background_image_overlay($useLocal);

        } elseif ($background_type == 'video') {

            return ideothemo_get_content_background_video_overlay($useLocal);

        }

        return 'none';
    }
}

if (!function_exists('ideothemo_get_content_background_overlay_color')) {
    function ideothemo_get_content_background_overlay_color($useLocal = false)
    {
        $background_type = ideothemo_get_content_background_type($useLocal);

        if ($background_type == 'color') {

            return ideothemo_get_content_background_color_overlay_color($useLocal);

        } elseif ($background_type == 'image') {

            return ideothemo_get_content_background_image_overlay_color($useLocal);

        } elseif ($background_type == 'video') {

            return ideothemo_get_content_background_video_overlay_color($useLocal);

        }

        return 'undefined';
    }
}

if (!function_exists('ideothemo_get_content_background_overlay_pattern')) {

    /**
     * Background Pattern
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */

    function ideothemo_get_content_background_overlay_pattern($useLocal = false)
    {
        $background_type = ideothemo_get_content_background_type($useLocal);

        if ($background_type == 'color') {

            return ideothemo_get_content_background_color_pattern($useLocal);

        } elseif ($background_type == 'image') {

            return ideothemo_get_content_background_image_overlay_pattern($useLocal);

        } elseif ($background_type == 'video') {

            return ideothemo_get_content_background_video_overlay_pattern($useLocal);

        }

        return 'none';
    }
}

if (!function_exists('ideothemo_get_content_background_pattern_color')) {
    function ideothemo_get_content_background_pattern_color($useLocal = false)
    {
        $background_type = ideothemo_get_content_background_type($useLocal);

        if ($background_type == 'color') {

            return ideothemo_get_content_background_color_pattern_color($useLocal);

        } elseif ($background_type == 'image') {

            return ideothemo_get_content_background_image_overlay_pattern_color($useLocal);

        } elseif ($background_type == 'video') {

            return ideothemo_get_content_background_video_overlay_pattern_color($useLocal);

        }

        return 'none';
    }
}

if (!function_exists('ideothemo_content_background_overlay_pattern')) {
    function ideothemo_content_background_overlay_pattern($type, $useLocal = false)
    {
        $mask = $color = 'undefined';

        if ($type == 'color') {

            $mask = ideothemo_get_content_background_color_pattern($useLocal);
            $color = ideothemo_get_content_background_color_pattern_color($useLocal);

        } elseif ($type == 'image') {

            $mask =  ideothemo_get_content_background_image_overlay_pattern($useLocal);
            $color = ideothemo_get_content_background_image_overlay_pattern_color($useLocal);

        } elseif ($type == 'video') {

            $mask =  ideothemo_get_content_background_video_overlay_pattern($useLocal);
            $color = ideothemo_get_content_background_video_overlay_pattern_color($useLocal);

        }

        return ideothemo_get_assets_svg('svg/masks/' . $mask . '.svg', $color);
    }
}

if (!function_exists('ideothemo_get_content_overlay_pattern')) {
    function ideothemo_get_content_overlay_pattern($useLocal = false)
    {
        return ideothemo_get_assets_svg_data('svg/masks/' . ideothemo_get_content_background_overlay_pattern($useLocal) . '.svg', ideothemo_get_content_background_pattern_color($useLocal));
    }
}