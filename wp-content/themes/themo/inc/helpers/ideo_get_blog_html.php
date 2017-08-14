<?php

if (!function_exists('ideothemo_get_blog_html')) {
    function ideothemo_get_blog_html($atts = array(), $echo = false)
    {

        global $wp_query;

        $html = '';

        if (empty($atts['el_uid'])) {
            $atts['el_uid'] = uniqid();
        }

        $colors_array = isset($atts['el_element_style_colors']) ? (array)json_decode(str_replace("'", '"', $atts['el_element_style_colors'])) : array();

        if (!defined('DOING_AJAX')) {
            $html = apply_filters('ideothemo_get_blog_html_before', $html, $atts);
        }

        $default = array(
            'el_pagination' => 'standard',
            'el_authors' => 'true',
            'el_comments' => 'true',
            'el_date' => 'true',
            'el_tags' => 'false',
            'el_categories' => 'true',

            'el_share' => 'true',
            'el_facebook' => 'true',
            'el_twitter' => 'true',
            'el_google' => 'true',
            'el_pinterest' => 'true',
            'el_reddit' => 'false',
            'el_linkedin' => 'false',
            'el_tumblr' => 'false',
            'el_vk' => 'false',
            'el_email' => 'true',

            'el_element_style' =>  ideothemo_get_shortcodes_default_style('ideo_blog') ?: 'colored-light',

            'el_type' => 'classic',

            'el_title_tag' => 'h2',
            'el_post_page' => '9',

            'el_select_categories' => '',
            'el_select_posts' => '',
            'el_orderby' => 'date',
            'el_order' => 'desc',
            'paged' => 1,

            'el_distance' => '30',
            'el_excerpt_words' => '55',
            'el_excerpt' => 'standard',

            'el_margin_top' => '0',
            'el_margin_bottom' => '20',

            'el_image_size' => 'original',
            'el_date_position' => 'left',
        );

        $id = '';
        if (isset($atts['el_uid']) && $atts['el_uid'] != '') {
            $id = $atts['el_uid'];
        }

        if (!isset($atts['el_type'])) {
            $atts['el_type'] = $default['el_type'];
        }

        if ($atts['el_type'] == 'masonry') {
            $options_layout = array(
                'el_large_desc_cols' => 3,
                'el_desc_cols' => 3,
                'el_tab_cols' => 2,
                'el_mob_cols' => 1,
                'el_distance' => 20,
                'el_image_height' => 300,
                'el_date_position' => 'meta',
            );
        } else {
            $options_layout = array(
                'el_image_height' => 450,
            );
        }

        $atts = shortcode_atts(array_merge($default, $options_layout), $atts);

        if ($atts['el_type'] == 'masonry' && is_archive()) {
            $large_desc_cols = intval($atts['el_desc_cols']);

            if ($large_desc_cols > 6)
                $large_desc_cols = 6;

            $cols_map = array(
                1 => array(1, 1, 1, 1),
                2 => array(2, 2, 2, 1),
                3 => array(3, 3, 2, 1),
                4 => array(4, 3, 2, 1),
                5 => array(5, 3, 2, 1),
                6 => array(6, 3, 2, 1)
            );

            $atts['el_large_desc_cols'] = $cols_map[$large_desc_cols][0];
            $atts['el_desc_cols'] = $cols_map[$large_desc_cols][1];
            $atts['el_tab_cols'] = $cols_map[$large_desc_cols][2];
            $atts['el_mob_cols'] = $cols_map[$large_desc_cols][3];
        }

        //add filter for masonry layout
        if ($atts['el_type'] === 'masonry') {
            add_filter('ideothemo_blog_post_classes', 'ideothemo_filter_masonry_column_classes', 10, 2);
        }

        //Get posts
        if (is_singular()) {

            $args = array(
                'post_type' => 'post',
                'paged' => ideothemo_get_paged(),
            );

            $args = array_merge($args, ideothemo_parse_shortcode_atts($atts));

            $wp_query = new WP_Query($args);
            $wp_query->is_archive = false;
        }

        if (have_posts()) {
            if (!defined('DOING_AJAX')) {

                $style = !empty($atts['el_margin_top']) ? ' style="margin-top: ' . intval($atts['el_margin_top']) . 'px;" ' : '';

                if (!empty($atts))

                    $html .= '<div id="blog_lists_' . $id . '"' . $style . ' class="' . ideothemo_get_shortcode_classes($atts) . '">';
            }

            while (have_posts()) {
                the_post();

                $html .= ideothemo_post_format(get_post_format(), $atts);

            }

            if (!defined('DOING_AJAX')) {

                $html .= '</div>';

                $style = !empty($atts['el_margin_bottom']) ? ' style="margin-bottom: ' . intval($atts['el_margin_bottom']) . 'px;" ' : '';
                $margin_bottom_added = false;

                if ($wp_query->max_num_pages > 1) {//not showing pagination if there is less then 2 pages

                    if ($atts['el_pagination'] == 'standard') {

                        $local_modifications = array();

                        if (ideothemo_is_customize_preview()) {
                            if (!empty($colors_array['text_color']))
                                $local_modifications[] = 'text_color';

                            if (!empty($colors_array['accent_color']))
                                $local_modifications[] = 'accent_color';
                        }
                        
                        $html .= '<div id="blog_pagination_' . $id . '"' . $style . ' class="' . ideothemo_get_shortcode_pagination_classes($atts) . '" ' .
                            (empty($local_modifications) ? '' : ('data-local-modifications="' . implode(',', $local_modifications) . '"' ))
                            . '>';
                        $html .= paginate_links(array(
                            'prev_text' => '&nbsp;',
                            'next_text' => '&nbsp;',
                        ));
                        $html .= '</div>';

                        $margin_bottom_added = true;

                    } elseif (in_array($atts['el_pagination'], array('load_more', 'infinity_scroll'))) {

                        wp_enqueue_script('wp-mediaelement');
                        wp_enqueue_style('mediaelement');

                        $data = array();
                        $data['action'] = 'loadMorePosts';
                        $data['max_num_pages'] = $wp_query->max_num_pages;
                        $data['paged'] = ideothemo_get_paged();
                        $data['post_type'] = $wp_query->query_vars['post_type'];
                        $data['is_search'] = is_search();


                        $data = array_merge($data, $wp_query->query, $atts);

                        if ($data['max_num_pages'] > $data['paged']) {
                            $html .= '<div id="blog_pagination_' . $id . '"' . $style . ' class="' . ideothemo_get_shortcode_pagination_classes($atts) . '">';
                            $html .= '<a href="#0" class="button btn-center load-more-button js--load-more-posts" ' . ideothemo_generate_data_attributes($data) . '><span>' . esc_html__('Load more', 'themo') . '</span></a>';
                            $html .= '<div class="loader">' . esc_html__('Loading...', 'themo') . '</div>';
                            $html .= '</div>';

                            $margin_bottom_added = true;
                        }
                    }
                }

                if (!$margin_bottom_added && !empty($atts['el_margin_bottom']))
                    $html .= '<div style="height: ' . $atts['el_margin_bottom'] . 'px; min-height: ' . $atts['el_margin_bottom'] . 'px">&nbsp;</div>';
            }
        } else {
            if (!defined('DOING_AJAX')) {
                $html .= esc_html__('No posts', 'themo');
            }
        }

        wp_reset_postdata();
        wp_reset_query();

        if (!defined('DOING_AJAX')) {
            $html = apply_filters('ideothemo_get_blog_html_after', $html, $atts);
        }

        if ($echo) {
            echo $html;
        }

        return $html;
    }
}
