<?php

if (!function_exists('ideothemo_blog_is_sidebar_left')) {
    /**
     * Check if sidebar is displayed to left
     *
     * @param string $blog_sidebar
     * @return boolean
     */

    function ideothemo_blog_is_sidebar_left($blog_sidebar)
    {
        return $blog_sidebar === 'left_sidebar';
    }
}

if (!function_exists('ideothemo_blog_meta_enabled')) {
    /**
     * Check if have to display meta data post title
     *
     * @param string $local
     * @return boolean
     */
    function ideothemo_blog_meta_enabled($local = '', $customizeEnabled = true)
    {
        if (is_singular('post')) {
            $local = ideothemo_get_post_meta('blog.blog_single.blog_single_meta');

            return ideothemo_blog_is_part_enabled('blog.blog_single.blog_single_meta', $local, $customizeEnabled);
        }

        return true;
    }
}

if (!function_exists('ideothemo_blog_post_title_enabled')) {
    /**
     * Check if have to display post title
     *
     * @param string $local
     * @return boolean
     */
    function ideothemo_blog_post_title_enabled($local = '', $customizeEnabled = true)
    {
        if (is_singular('post')) {

            $local = ideothemo_get_post_meta('blog.blog_single.blog_single_post_title');

            return ideothemo_blog_is_part_enabled('blog.blog_single.blog_single_post_title', $local, $customizeEnabled);
        }

        return true;
    }
}

if (!function_exists('ideothemo_blog_comments_enabled')) {
    /**
     * Check if have to display comments
     *
     * @param string $highPriority
     * @param bool $customizeEnabled
     * @return bool
     */
    function ideothemo_blog_comments_enabled($highPriority = '', $customizeEnabled = true)
    {
        if (is_search()) {
            return false;
        }

        if ($customizeEnabled && ideothemo_is_customize_preview())
            return true;

        $lowPriority = ideothemo_get_theme_mod_parse('blog.blog_settings.blog_hide_comments');

        if (is_archive() && ideothemo_get_custom_meta_settings('archives')) {
            $lowPriority = ideothemo_get_theme_mod_parse('blog.blog_archives.blog_archives_comments');
        }

        return ideothemo_blog_is_switch_enabled($lowPriority, $highPriority);
    }
}

if (!function_exists('ideothemo_blog_author_enabled')) {
    /**
     * Check if have to display author
     *
     * @param string $highPriority
     * @param bool $customizeEnabled
     * @return bool
     */
    function ideothemo_blog_author_enabled($highPriority = '', $customizeEnabled = true)
    {
        if ($customizeEnabled && ideothemo_is_customize_preview())
            return true;

        $lowPriority = ideothemo_get_theme_mod_parse('blog.blog_settings.blog_hide_authors');

        if (is_search()) {
            $lowPriority = ideothemo_get_theme_mod_parse('blog.blog_search.blog_search_meta_author');
        } elseif (is_archive() && ideothemo_get_custom_meta_settings('archives')) {
            $lowPriority = ideothemo_get_theme_mod_parse('blog.blog_archives.blog_archives_authors');
        }

        return ideothemo_blog_is_switch_enabled($lowPriority, $highPriority);
    }
}

if (!function_exists('ideothemo_blog_tags_enabled')) {
    /**
     * Check if have to display author
     *
     * @param string $highPriority
     * @param bool $customizeEnabled
     * @return bool
     */
    function ideothemo_blog_tags_enabled($highPriority = '', $customizeEnabled = true)
    {
        if (is_search()) {
            return false;
        }

        if ($customizeEnabled && ideothemo_is_customize_preview())
            return true;

        $lowPriority = ideothemo_get_theme_mod_parse('blog.blog_settings.blog_hide_tags');

        if (is_archive() && ideothemo_get_custom_meta_settings('archives')) {
            $lowPriority = ideothemo_get_theme_mod_parse('blog.blog_archives.blog_archives_tags');
        }

        return ideothemo_blog_is_switch_enabled($lowPriority, $highPriority);
    }
}

if (!function_exists('ideothemo_blog_categories_enabled')) {
    function ideothemo_blog_categories_enabled($highPriority = '', $customizeEnabled = true)
    {
        if (is_search()) {
            return false;
        }

        if ($customizeEnabled && ideothemo_is_customize_preview())
            return true;

        $lowPriority = filter_var(ideothemo_get_theme_mod_parse('blog.blog_settings.blog_hide_categories'), FILTER_VALIDATE_BOOLEAN);

        if (is_archive() && ideothemo_get_custom_meta_settings('archives')) {
            $lowPriority = ideothemo_get_theme_mod_parse('blog.blog_archives.blog_archives_categories');
        } else if (is_singular('post') && empty($highPriority)) {
            $po = ideothemo_get_post_meta('blog.blog_single.blog_single_meta');
            if ($lowPriority) {
                $lowPriority = ideothemo_get_theme_mod_parse('blog.blog_single.blog_single_meta');
            }

            if ($po !== null) {
                $lowPriority = ideothemo_get_post_meta('blog.blog_single.blog_single_meta');
            }


            if (filter_var($lowPriority, FILTER_VALIDATE_BOOLEAN)) {
                $highPriority = ideothemo_get_theme_mod_parse('blog.blog_settings.blog_hide_categories');
            }
        }
        return ideothemo_blog_is_switch_enabled($lowPriority, $highPriority);
    }
}

if (!function_exists('ideothemo_blog_social_enabled')) {
    /**
     * Check if have to display social icons
     *
     * @param string $highPriority
     * @param bool $customizeEnabled
     * @return bool
     */
    function ideothemo_blog_social_enabled($highPriority = '', $customizeEnabled = true)
    {
        if ($customizeEnabled && ideothemo_is_customize_preview() && !is_search()) {
            return true;
        }

        $lowPriority = true;

        if (is_archive()) {
            $lowPriority = ideothemo_get_theme_mod_parse('blog.blog_archives.blog_archives_socials');
        } elseif (is_singular('post')) {
            $lowPriority = ideothemo_get_theme_mod_parse('blog.blog_single.blog_single_socials');
        } elseif (is_singular(ideothemo_get_portfolio_slug())) {
            $lowPriority = ideothemo_portfolio_socials_enabled();
        } elseif (is_search()) {
            $lowPriority = false;
        }

        return ideothemo_blog_is_switch_enabled($lowPriority, $highPriority);
    }
}

if (!function_exists('ideothemo_blog_feature_image_enabled')) {
    /**
     * Check if have to display feature image
     *
     * @param string $highPriority
     * @param bool $customizeEnabled
     * @return bool
     */
    function ideothemo_blog_feature_image_enabled($highPriority = '', $customizeEnabled = true)
    {
        if ($customizeEnabled && ideothemo_is_customize_preview())
            return true;

        $lowPriority = true;

        if (is_singular('post')) {
            $highPriority = ideothemo_get_page_option_setting('blog.blog_single.blog_single_featured_image');

            $lowPriority = ideothemo_get_theme_mod_parse('blog.blog_single.blog_single_featured_image');
        } elseif (is_search()) {
            $lowPriority = ideothemo_get_theme_mod_parse('blog.blog_search.blog_search_featured_image');
        }


        return ideothemo_blog_is_switch_enabled($lowPriority, $highPriority);
    }
}

if (!function_exists('ideothemo_get_enabled_social_media')) {
    /**
     * @param $social
     * @param string $highPriority
     * @param bool $customizeEnabled
     * @return bool
     */

    function ideothemo_get_enabled_social_media($social, $highPriority = '', $customizeEnabled = true)
    {
        if ($customizeEnabled && ideothemo_is_customize_preview())
            return true;

        if (is_singular('post')) {
            $lowPriority = ideothemo_get_theme_mod_parse('blog.blog_single.blog_single_' . $social);
        } elseif (is_singular(ideothemo_get_portfolio_slug()) || is_page()) {
            $lowPriority = ideothemo_portfolio_social_enabled($social);
        } else {
            $lowPriority = ideothemo_get_theme_mod_parse('blog.blog_archives.blog_archives_' . $social);
        }

        return ideothemo_blog_is_switch_enabled($lowPriority, $highPriority);
    }
}

if (!function_exists('ideothemo_blog_date_enabled')) {
    /**
     * Check if have to display post date
     *
     * @param string $highPriority
     * @param bool $customizeEnabled
     * @return bool
     */

    function ideothemo_blog_date_enabled($highPriority = '', $customizeEnabled = true)
    {
        if ($customizeEnabled && ideothemo_is_customize_preview())
            return true;

        $lowPriority = ideothemo_get_theme_mod_parse('blog.blog_settings.blog_hide_date');

        if (is_search()) {
            $lowPriority = ideothemo_get_theme_mod_parse('blog.blog_search.blog_search_meta_date');
        } elseif (is_archive() && ideothemo_get_custom_meta_settings('archives')) {
            $lowPriority = ideothemo_get_theme_mod_parse('blog.blog_archives.blog_archives_date');
        }

        return ideothemo_blog_is_switch_enabled($lowPriority, $highPriority);
    }
}

if (!function_exists('ideothemo_blog_related_posts_enabled')) {
    /**
     * Check if have to display feature image
     *
     * @param string $highPriority
     * @param bool $customizeEnabled
     * @return bool
     */
    function ideothemo_blog_related_posts_enabled($highPriority = '', $customizeEnabled = true)
    {
        if (is_singular('post') && empty($highPriority)) {
            $highPriority = ideothemo_get_post_meta('blog.blog_single.blog_single_related_posts');
        }

        if ($customizeEnabled && ideothemo_is_customize_preview() && empty($highPriority))
            return true;

        $lowPriority = ideothemo_get_theme_mod_parse('blog.blog_single.blog_single_related_posts');

        return ideothemo_blog_is_switch_enabled($lowPriority, $highPriority);
    }
}

if (!function_exists('ideothemo_get_blog_sidebar_page_classes')) {
    /**
     * Get classes for conetent container on pages with or without sidebar
     *
     *
     * @param string $sidebar_setting none|left_sidebar|right_sidebar
     * @return mixed
     */
    function ideothemo_get_blog_sidebar_page_classes($sidebar_setting)
    {
        $classes = array();

        if ($sidebar_setting === 'none') {
            $classes[] = 'col-md-12';
        } else {
            $classes[] = 'col-xs-12';
            $classes[] = 'col-sm-9';
            $classes[] = 'col-md-9';
        }

        $classes[] = ideothemo_blog_is_sidebar_left($sidebar_setting) ? 'pull-right' : '';

        return implode(' ', apply_filters('ideothemo_get_blog_sidebar_page_classes', $classes));
    }
}

if (!function_exists('ideothemo_blog_list_style_inline')) {
    function ideothemo_blog_list_style_inline($atts)
    {
        $styles = array();
        $styles = apply_filters('ideothemo_blog_list_style_inline', $styles, $atts);

        return ideothemo_implode_styles($styles);
    }
}

if (!function_exists('ideothemo_implode_styles')) {
    /**
     * Convert array styles to inline style
     *
     * @param array $styles
     * @return string
     */

    function ideothemo_implode_styles($styles = array())
    {
        return !empty($styles) ? 'style="' . implode('; ', $styles) . '" ' : '';
    }
}

if (!function_exists('ideothemo_blog_list_excerpt')) {
    function ideothemo_blog_list_excerpt($atts)
    {
        global $post;

        if (get_post_type() != 'post')
            return '';

        $html = '<div class="ideo-entry-excerpt">';

        if (!isset($atts['el_excerpt_words'])) {
            $atts['el_excerpt_words'] = 55;
        }

        $text = $post->post_excerpt;

        if (!empty($text) && $atts['el_excerpt'] == 'automatic') {
            $text = wp_trim_words($post->post_excerpt, $atts['el_excerpt_words'], '');
        }

        if (!empty($text)) {
            $text = '<p>' . $text . '</p>';
        }

        if (empty($text)) {
            $text = apply_filters('the_content', get_the_content(''));
        }

        $text = strip_tags(do_shortcode($text));

        $html .= $text . '</div>';

        return $html;
    }
}

if (!function_exists('ideothemo_related_post_excerpt')) {
    function ideothemo_related_post_excerpt()
    {
        return wp_trim_words(apply_filters('the_excerpt', get_the_excerpt()), 25);
    }
}

if (!function_exists('ideothemo_related_post_comments_number')) {
    function ideothemo_related_post_comments_number()
    {
        return '<div class="comments-count"><i class="fa fa-comments"></i>' . get_comments_number() . '</div>';
    }
}

if (!function_exists('ideothemo_get_the_post_thumbnail_size')) {
    function ideothemo_get_the_post_thumbnail_size($atts = array(), $post_id = null)
    {
        $full = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full');

        if ($full && isset($atts['el_image_size']) && $atts['el_image_size'] == 'custom') {
            $size = array($full[1], $atts['el_image_height']);
        } else {
            $size = 'ideothemo-blog-featured-image';
        }

        return apply_filters('ideothemo_get_the_post_thumbnail_size', $size);
    }
}


if (!function_exists('ideothemo_get_the_title')) {
    function ideothemo_get_the_title()
    {

        //NOTE: Consider use filter from functions.php: add_filter('the_title', 'the_title_filter', 10, 2);
        if (is_page()) {
            $page_title_text = ideothemo_get_page_meta('pagetitle.page_title_settings.page_title_text');

            if (!empty($page_title_text))
                return $page_title_text;

            return get_the_title();
        } elseif (is_singular('post')) {
            $page_title_text = ideothemo_get_custom_post_meta('pagetitle.page_title_settings.page_title_text');

            if (!empty($page_title_text))
                return $page_title_text;

            return get_the_title();
        } elseif (is_singular(ideothemo_get_portfolio_slug())) {
            $page_title_text = ideothemo_get_custom_post_meta('portfolio_title');

            if (!empty($page_title_text))
                return $page_title_text;

            return get_the_title();
        } elseif (is_singular('team')) {
            $page_title_text = ideothemo_get_custom_post_meta('member_name');

            if (!empty($page_title_text))
                return $page_title_text;

            return get_the_title();
        } elseif (is_singular())
            return get_the_title();
        elseif (is_category()) {
            return esc_html__('Category Archives:', 'themo') . ' ' . single_cat_title('', false);
        } elseif (is_tag()) {
            return esc_html__('Tag Archives:', 'themo') . ' ' . single_tag_title('', false);
        } elseif (is_author()) {
            $author = get_userdata(get_query_var('author'));

            return esc_html__('Author Archives:', 'themo') . ' ' . $author->display_name;
        } elseif (is_search()) {
            return esc_html__('Search results for:', 'themo') . ' ' . esc_html(get_search_query());
        } elseif (is_day()) {
            return esc_html__('Archive for day:', 'themo') . ' ' . get_the_time(esc_html__('l, F jS, Y', 'themo'));
        } elseif (is_month()) {
            return esc_html__('Archive for month:', 'themo') . ' ' . get_the_time(esc_html__('F, Y', 'themo'));
        } elseif (is_year()) {
            return esc_html__('Archive for year:', 'themo') . ' ' . get_the_time('Y');
        }

        return get_bloginfo('name');
    }
}

if (!function_exists('ideothemo_get_the_subtitle')) {
    function ideothemo_get_the_subtitle()
    {
        if (is_singular(ideothemo_get_portfolio_slug())) {
            return ideothemo_get_custom_post_meta('portfolio_subtitle');
        } elseif (is_singular('team')) {
            return ideothemo_get_custom_post_meta('member_position');
        }

        return ideothemo_get_custom_post_meta('pagetitle.page_title_settings.page_subtitle_text');
    }
}

if (!function_exists('ideothemo_is_blog_template')) {
    /**
     * Whatever it is archive, category or author posts
     *
     * @return boolean
     */
    function ideothemo_is_blog_template()
    {
        return is_archive();
    }
}

if (!function_exists('ideothemo_is_nopo_template')) {
    /**
     * Whatever it is archive, category, search, author posts or standard 404 page
     *
     * @return boolean
     * @TODO Metoda do przerobienia, wyciągnąć is_search
     */
    function ideothemo_is_nopo_template()
    {
        return ideothemo_is_blog_template() || is_search() || (is_404() && !ideothemo_get_theme_mod_parse('advanced.advanced_404.404_choose'));
    }
}

if (!function_exists('ideothemo_get_inheritet_pt_page_id')) {
    /**
     * Whatever it is archive, category, search or author posts
     *
     * @return boolean
     */
    function ideothemo_get_inheritet_pt_page_id()
    {
        $post_id = 0;

        if (ideothemo_is_blog_template()) {
            $post_id = ideothemo_get_theme_mod_parse('blog.blog_archives.blog_archives_pt');
        }

        if (is_search()) {
            $post_id = ideothemo_get_theme_mod_parse('blog.blog_search.blog_search_pt');
        }

        if (!$post_id) $post_id = 0;

        return $post_id;
    }
}

if (!function_exists('ideothemo_get_meta_inherit_settings')) {

    function ideothemo_get_custom_meta_settings($type)
    {
        switch ($type) {
            case 'archives':
                $setting = 'blog.blog_archives.blog_archives_meta';
                break;
        }

        return filter_var(ideothemo_get_theme_mod_parse($setting), FILTER_VALIDATE_BOOLEAN);
    }
}
