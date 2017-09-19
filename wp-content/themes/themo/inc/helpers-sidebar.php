<?php

if (!function_exists('ideothemo_get_sidebar_skin')) {

    function ideothemo_get_sidebar_skin($post_id = null)
    {
        $local = ideothemo_get_page_option_setting('sidebar.sidebar_settings.sidebar_skin', false, $post_id);

        return ideothemo_blog_get_option(ideothemo_get_general_theme_skin(true), $local);
    }

}

if (!function_exists('ideothemo_get_theme_sidebar')) {

    function ideothemo_get_theme_sidebar()
    {
        $local = '';

        if (is_singular()) {

            $post_setting_status = ideothemo_get_custom_post_meta('sidebar.sidebar_settings.sidebar_global');

            if (!empty($post_setting_status)) {
                $local = ideothemo_get_custom_post_meta('sidebar.sidebar_settings.sidebar_choose');
            }

            if (is_singular('post')) {
                $local = ideothemo_blog_get_option(ideothemo_get_theme_mod_parse('blog.blog_single.blog_sidebar_choose'), $local);
            }
        } elseif (is_search()) {
            $local = ideothemo_get_theme_mod_parse('blog.blog_search.blog_search_sidebar_choose');
        } elseif (is_archive()) {
            $local = ideothemo_get_theme_mod_parse('blog.blog_archives.blog_archives_sidebar_choose');
        }

        return ideothemo_blog_get_option(ideothemo_get_general_sidebar(), $local);
    }

}

if (!function_exists('ideothemo_get_sidebar_classes')) {

    function ideothemo_get_sidebar_classes()
    {
        $classes = array();

        $classes[] = 'col-xs-12';
        $classes[] = 'col-sm-3';
        $classes[] = 'col-md-3';
        $classes[] = 'sidebar';
        $classes[] = 'skin-' . ideothemo_get_sidebar_skin();
        $classes[] = ideothemo_get_theme_sidebar();
        $classes[] = ideothemo_blog_is_sidebar_left(ideothemo_get_sidebar_position()) ? 'pull-left' : '';

        return trim(implode(' ', apply_filters('ideothemo_get_sidebar_classes', $classes)));
    }

}

if (!function_exists('ideothemo_get_sidebar_position')) {

    /**
     * Get sidebar position
     *
     * @param string $local
     * @return mixed
     */
    function ideothemo_get_sidebar_position($local = '')
    {
        $global = ideothemo_get_theme_mod_parse('sidebar.sidebar_settings.sidebar_global');

        if (is_singular() && empty($local)) {
            if (is_singular('post')) {
                $local = ideothemo_get_post_meta('sidebar.sidebar_settings.sidebar_global');

                if (empty($local))
                    $local = ideothemo_get_theme_mod_parse('blog.blog_single.blog_sidebar');
            } else {
                $local = ideothemo_get_custom_post_meta('sidebar.sidebar_settings.sidebar_global');
            }
        } elseif (is_archive()) {
            $local = ideothemo_get_theme_mod_parse('blog.blog_archives.blog_archives_sidebar');
        } elseif (is_search()) {
            $local = ideothemo_get_theme_mod_parse('blog.blog_search.blog_search_sidebar');
        }

        return ideothemo_blog_get_option($global, $local);
    }

}

if (!function_exists('ideothemo_is_sidebar_enabled')) {

    function ideothemo_is_sidebar_enabled()
    {
        return in_array(ideothemo_get_sidebar_position(), array('left_sidebar', 'right_sidebar'));
    }

}

/** COLORING */
if (!function_exists('ideothemo_get_sidebar_accent_color')) {

    function ideothemo_get_sidebar_accent_color($skin)
    {
        $accent_color = ideothemo_get_theme_mod_parse('sidebar.sidebar_coloring.sidebar_' . $skin . '_accent_color');

        return ideothemo_blog_get_option(ideothemo_get_general_accent_color(), $accent_color);
    }

}

if (!function_exists('ideothemo_get_sidebar_title_color')) {

    function ideothemo_get_sidebar_title_color($skin)
    {
        return ideothemo_get_theme_mod_parse('sidebar.sidebar_coloring.sidebar_' . $skin . '_titles_color');
    }

}

if (!function_exists('ideothemo_get_sidebar_text_color')) {

    function ideothemo_get_sidebar_text_color($skin)
    {
        return ideothemo_get_theme_mod_parse('sidebar.sidebar_coloring.sidebar_' . $skin . '_text_color');
    }

}

/** FONT TITLE */
if (!function_exists('ideothemo_get_sidebar_title_font')) {

    function ideothemo_get_sidebar_title_font($option)
    {
        return ideothemo_get_theme_mod_parse('sidebar.sidebar_widgets_title_font.sidebar_title_' . $option);
    }

}

if (!function_exists('ideothemo_sidebar_title_font_size')) {

    function ideothemo_get_sidebar_title_font_size()
    {
        return ideothemo_get_sidebar_title_font('font_size');
    }

}

if (!function_exists('ideothemo_sidebar_title_line_height')) {

    function ideothemo_get_sidebar_title_line_height()
    {
        return ideothemo_get_sidebar_title_font('line_height');
    }

}

if (!function_exists('ideothemo_sidebar_title_letter_spacing')) {

    function ideothemo_get_sidebar_title_letter_spacing()
    {
        return ideothemo_get_sidebar_title_font('letter_spacing');
    }

}