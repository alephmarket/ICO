<?php

if (!function_exists('ideothemo_parse_shortcode_atts')) {
    function ideothemo_parse_shortcode_atts($atts = array())
    {
        $args = array();

        if (isset($atts['el_select_categories']) && !empty($atts['el_select_categories'])) {
            $categories = str_replace(' ', '', $atts['el_select_categories']);
            $args['category__in'] = explode(',', $categories);
        }

        if (isset($atts['el_select_posts']) && !empty($atts['el_select_posts'])) {
            $posts = str_replace(' ', '', $atts['el_select_posts']);
            $args['post__in'] = explode(',', $posts);
        }

        if (isset($atts['el_post_page']) && !empty($atts['el_post_page'])) {
            $args['posts_per_page'] = $atts['el_post_page'];
        }

        if (isset($atts['el_order']) && !empty($atts['el_order'])) {
            $args['order'] = $atts['el_order'];
        }

        if (isset($atts['el_orderby']) && !empty($atts['el_orderby'])) {
            $args['orderby'] = $atts['el_orderby'];
        }

        return $args;
    }
}