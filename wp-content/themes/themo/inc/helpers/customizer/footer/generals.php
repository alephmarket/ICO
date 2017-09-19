<?php

if (!function_exists('ideothemo_get_footer_background_setting')) {
    function ideothemo_get_footer_background_setting($setting, $useLocal = false)
    {
        if ($useLocal && ideothemo_is_footer_default_background()) {
            $useLocal = false;
        }

        return ideothemo_get_footer_setting($setting, $useLocal);
    }
}

if (!function_exists('ideothemo_is_footer_default_background')) {
    function ideothemo_is_footer_default_background()
    {
        $default = ideothemo_get_custom_post_meta('footer.standard_footer_background.footer_background_type');

        return empty($default);
    }
}

if (!function_exists('ideothemo_get_footer_setting')) {
    function ideothemo_get_footer_setting($setting, $useLocal = false)
    {
        $highPriority = '';  
        $post_id = null;
        
        if ($useLocal && !is_404()) {
            if (is_archive()) {
                $post_id = ideothemo_get_theme_mod_parse('blog.blog_archives.blog_archives_pt');
            } elseif (is_search()) {
                $post_id = ideothemo_get_theme_mod_parse('blog.blog_search.blog_search_pt');
            }

            if (empty($post_id) && !is_archive() && !is_search() && !is_front_page()) {
                $post_id = get_the_ID();
            }
            $highPriority = ideothemo_get_custom_post_meta($setting, $post_id);
        }

        return ideothemo_blog_get_option(ideothemo_get_theme_mod_parse($setting), $highPriority);
    }
}

if (!function_exists('ideothemo_get_footer_post_type')) {
    function ideothemo_get_footer_post_type()
    {
        return 'footer-post';
    }
}

if (!function_exists('ideothemo_register_footer_sidebars')) {
    function ideothemo_register_footer_sidebars($sidebars)
    {
        for ($i = 0; ++$i <= $sidebars;) {
            register_sidebar(

                apply_filters('ideothemo_footer_sidebar_args', array(
                    'name' => sprintf(esc_html__('Footer Column %s', 'themo'), $i),
                    'id' => 'footer-column-' . $i,
                    'class' => 'widget-sidebar',
                    'description' => esc_html__('Widgets in this area will be shown on all posts and pages.', 'themo'),
                    'before_widget' => '<div id="%1$s" class="widget %2$s">',
                    'after_widget' => '</div>',
                    'before_title' => '<h3 class="widget-title">',
                    'after_title' => '</h3>',
                ), $i)

            );
        }
    }
}

if (!function_exists('ideothemo_get_footers')) {
    function ideothemo_get_footers()
    {
        global $wp_query;

        if (($footers = wp_cache_get('ideo_footers')) === false) {

            $wp_query = new WP_Query(array(
                'post_type' => ideothemo_get_footer_post_type(),
                'post_status' => 'publish',
                'posts_per_page' => -1,
            ));

            $footers = array();

            if (have_posts()) {
                while (have_posts()) {
                    the_post();
                    $footers[get_the_ID()] = get_the_title();
                }
            }
            
            wp_reset_postdata();
            wp_reset_query();

            wp_cache_set('ideo_footers', $footers);
        }

        return $footers;
    }
}

if (!function_exists('ideothemo_register_footer_sidebars')) {
    function ideothemo_register_footer_sidebars($sidebars)
    {
        for ($i = 0; ++$i <= $sidebars;) {
            register_sidebar(

                apply_filters('ideothemo_footer_sidebar_args', array(
                    'name' => sprintf(esc_html__('Footer Column %s', 'themo'), $i),
                    'id' => 'footer-column-' . $i,
                    'class' => 'widget-sidebar',
                    'description' => esc_html__('Widgets in this area will be shown on all posts and pages.', 'themo'),
                    'before_widget' => '<li id="%1$s" class="widget %2$s">',
                    'after_widget' => '</li>',
                    'before_title' => '<h3 class="widget-title">',
                    'after_title' => '</h3>',
                ), $i)

            );
        }
    }
}

if (!function_exists('ideothemo_get_footer_content')) {
    function ideothemo_get_footer_content()
    {
        $footer_id = ideothemo_get_footer_advanced_footer_id(1);

        if (!empty($footer_id) && get_post_type($footer_id) == ideothemo_get_footer_post_type()) {
            return ideothemo_get_the_content($footer_id);
        }

        return '';
    }
}

if (!function_exists('ideothemo_get_footers')) {
    function ideothemo_get_footers()
    {
        global $wp_query;

        if (($footers = wp_cache_get('ideo_footers')) === false) {

            $wp_query = new WP_Query(array(
                'post_type' => ideothemo_get_footer_post_type(),
                'post_status' => 'publish',
                'posts_per_page' => -1,
            ));

            $footers = array();

            if (have_posts()) {
                while (have_posts()) {
                    the_post();
                    $footers[get_the_ID()] = get_the_title();
                }
            }

            wp_reset_postdata();
            wp_reset_query();

            wp_cache_set('ideo_footers', $footers);
        }

        return $footers;
    }
}

if (!function_exists('ideothemo_calculate_column_width')) {
    function ideothemo_calculate_column_width($width)
    {
        if( ideothemo_get_standard_footer_layout_footer_layout(1) != 'full_width' ){
            return 'col-md-' . round($width * 12 / 100, 0) . (($width != 100) ? ' col-sm-6' : '');            
        }else{
            return 'col-sm-' . round($width * 12 / 100, 0);
        }
    }
}

if (!function_exists('ideothemo_get_footer_skin')) {
    function ideothemo_get_footer_skin($post_id = null)
    {
        $local = ideothemo_get_page_option_setting('footer.footer_settings.standard_footer_skin', false, $post_id);

        return ideothemo_blog_get_option('light', $local);
    }
}

if (!function_exists('ideothemo_explode_columns_widths')) {
    function ideothemo_explode_columns_widths($useLocal = false)
    {
        return explode('_', ideothemo_get_standard_footer_layout_footer_columns($useLocal));
    }
}

if (!function_exists('ideothemo_get_footer_columns_count')) {
    /**
     * Count footer columns
     *
     * @return int
     */
    function ideothemo_get_footer_columns_count($useLocal = false)
    {
        return count(ideothemo_explode_columns_widths($useLocal));
    }
}

if (!function_exists('ideothemo_get_footer_column_class')) {
    function ideothemo_get_footer_column_class($column, $useLocal = false)
    {
        $widths = ideothemo_explode_columns_widths($useLocal);

        return ideothemo_calculate_column_width($widths[$column - 1]);
    }
}

if (!function_exists('ideothemo_get_footer_classes')) {
    function ideothemo_get_footer_classes($useLocal = false)
    {
        $classes = array();

        if (ideothemo_footer_enabled($useLocal)) {
            $classes[] = 'type-' . ideothemo_get_footer_type($useLocal);

            if (ideothemo_get_footer_type($useLocal) == 'standard') {
                $footer_background_type = ideothemo_get_standard_footer_background_type($useLocal);

                if (empty($footer_background_type))
                    $footer_background_type = 'default';

                $classes = array_merge($classes, ideothemo_get_background_classes(array(
                    'background-type'           => $footer_background_type,
                    'background-overlay'        => ideothemo_get_footer_background_overlay_type($useLocal)
                )));
                
                $classes[] = 'layout-' . str_replace('_', '-', ideothemo_get_standard_footer_layout_footer_layout($useLocal));
            }
            
            if (ideothemo_is_sticky_footer_enabled($useLocal)) {
                $classes[] = 'sticky';
            }
        }else{
                $classes[] = 'footer-area-off';            
        }
        
        if(ideothemo_get_page_title_local_setting('footer.standard_footer_background.footer_background_type')) {
            $classes[] = 'js--local-modifications';
        }    
        
        if(ideothemo_is_boxed_version()) {
            //$classes[] = 'container';
        }
        
        $classes[] = ideothemo_get_layout_type_class($useLocal);
        return trim(implode(' ', apply_filters('ideothemo_get_footer_classes', $classes)));
    }
}

if (!function_exists('ideothemo_get_footer_container_classes')) {
    function ideothemo_get_footer_container_classes($useLocal=false)
    {
        $classes = array('footer-content', 'row');

        $classes[] = 'skin-' . ideothemo_get_footer_skin();
        $classes[] = 'footer-columns-' . ideothemo_get_footer_columns_count(); //TODO add only to type-standard footer
                 
        return trim(implode(' ', apply_filters('ideothemo_get_footer_classes', $classes)));
    }
}

if (!function_exists('ideothemo_get_copyright_classes')) {

    /**
     * Return Copyright classes
     *
     * @param bool $useLocal
     * @return string
     */

    function ideothemo_get_copyright_classes($useLocal = false)
    {
        $classes[] = 'copyright-container';
        $classes[] = 'skin-' . ideothemo_get_copyright_skin($useLocal);

        return trim(implode(' ', apply_filters('ideothemo_get_copyright_classes', $classes)));
    }
}

if (!function_exists('ideothemo_get_footer_background_overlay_type')) {

    /**
     * Return Footer Background Overlay Type
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */

    function ideothemo_get_footer_background_overlay_type($useLocal = false)
    {
        $background_type = ideothemo_get_standard_footer_background_type($useLocal);

        if ($background_type == 'color') {

            return ideothemo_get_standard_footer_background_color_overlay($useLocal);

        } elseif ($background_type == 'image') {

            return ideothemo_get_standard_footer_background_image_overlay($useLocal);

        }

        return 'none';
    }
}

if (!function_exists('ideothemo_get_footer_background_overlay_color')) {
    function ideothemo_get_footer_background_overlay_color($useLocal = false)
    {
        $background_type = ideothemo_get_standard_footer_background_type($useLocal);

        if ($background_type == 'color') {

            return ideothemo_get_standard_footer_background_color_overlay_color($useLocal);

        } elseif ($background_type == 'image') {

            return ideothemo_get_standard_footer_background_image_overlay_color($useLocal);

        }

        return 'none';
    }
}

if (!function_exists('ideothemo_get_footer_background_overlay_pattern')) {

    /**
     * Background Pattern
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */

    function ideothemo_get_footer_background_overlay_pattern($useLocal = false)
    {
        $background_type = ideothemo_get_standard_footer_background_type($useLocal);

        if ($background_type == 'color') {

            return ideothemo_get_standard_footer_background_color_pattern($useLocal);

        } elseif ($background_type == 'image') {

            return ideothemo_get_standard_footer_background_image_overlay_pattern($useLocal);

        }

        return 'none';
    }
}

if (!function_exists('ideothemo_get_footer_background_pattern_color')) {
    function ideothemo_get_footer_background_pattern_color($useLocal = false)
    {
        $background_type = ideothemo_get_standard_footer_background_type($useLocal);

        if ($background_type == 'color') {

            return ideothemo_get_standard_footer_background_color_pattern_color($useLocal);

        } elseif ($background_type == 'image') {

            return ideothemo_get_standard_footer_background_image_overlay_pattern_color($useLocal);

        }

        return 'none';
    }
}

if (!function_exists('ideothemo_get_footer_overlay_pattern')) {
    function ideothemo_get_footer_overlay_pattern($useLocal = false)
    {
        return ideothemo_get_assets_svg_data('svg/masks/' . ideothemo_get_footer_background_overlay_pattern($useLocal) . '.svg', ideothemo_get_footer_background_pattern_color($useLocal));
    }
}
