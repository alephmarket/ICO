<?php

if (!function_exists('ideothemo_get_shortcodes_skin_class')) {
    /**
     * Return theme skin class
     *
     * @return string
     */
    function ideothemo_get_shortcodes_skin_class($prefix = 'skin-')
    {
        
        $themeSkin = ideothemo_get_general_theme_skin();


        return $prefix . $themeSkin;
    }
}

if (!function_exists('ideothemo_get_shortcode_classes')) {
    function ideothemo_get_shortcode_classes($atts = array())
    {
        $classes[] = 'blog-lists-posts';

        $classes[] = 'js--posts-list';

        if (isset($atts['el_type']))
            $classes[] = 'ideo-blog-' . $atts['el_type'];

        if (is_archive()) {
            $classes[] = 'blog-list-archive';
            $classes[] = ideothemo_get_blog_archives_pagination();
        }

        if (is_search()) {
            $classes[] = 'blog-list-search';
            $classes[] = ideothemo_get_blog_search_pagination();
        }

        if (ideothemo_blog_date_enabled($atts['el_date']) && ($date_position = ideothemo_get_date_position($atts)) != '' && ideothemo_blog_date_enabled($atts['el_date'])) {
            $classes[] = 'date-position-' . $date_position;
        }

        if (!ideothemo_blog_date_enabled(null, false) && ideothemo_blog_date_enabled($atts['el_date'])) {
            $classes[] = 'hide-date';
        }

        if ($atts['el_pagination'] == 'infinity_scroll') {
            $classes[] = 'infinity-scroll';
        }

        if (is_search() || is_archive() || is_front_page()) {
            $classes[] = 'skin-colored-' . ideothemo_get_general_theme_skin();
        } else {
            $classes[] = isset($atts['el_element_style']) && $atts['el_element_style'] != '' ? 'skin-' . str_replace('_', '-', $atts['el_element_style']) : ideothemo_get_shortcodes_skin_class('skin-colored-');
        }

        return trim(implode(' ', apply_filters('ideothemo_get_shortcode_classes', $classes, $atts)));
    }
}

if (!function_exists('ideothemo_get_shortcode_pagination_classes')) {
    function ideothemo_get_shortcode_pagination_classes($atts = array())
    {
        $classes[] = 'pagination';

        if ($atts['el_pagination'] == 'standard') {
            $classes[] = 'standard';
        }

        if (in_array($atts['el_pagination'], array('load_more', 'infinity_scroll'))) {
            $classes[] = 'load-more';
        }

        if (is_search() || is_archive()) {
            $classes[] = 'skin-colored-' . ideothemo_get_general_theme_skin();
        } else {
            $classes[] = isset($atts['el_element_style']) && $atts['el_element_style'] != '' ? 'skin-' . $atts['el_element_style'] : ideothemo_get_shortcodes_skin_class();
        }
        return trim(implode(' ', apply_filters('ideothemo_get_shortcode_pagination_classes', $classes, $atts)));
    }
}

if (!function_exists('ideothemo_get_date_position')) {
    function ideothemo_get_date_position($atts = array())
    {
        if (!isset($atts['el_date_position'])) {
            $atts['el_date_position'] = '';
        }

        return apply_filters('ideothemo_get_date_position', $atts['el_date_position'], $atts);
    }
}