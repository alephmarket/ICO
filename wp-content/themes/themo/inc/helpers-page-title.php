<?php

if (!function_exists('ideothemo_get_page_title_setting')) {
    function ideothemo_get_page_title_setting($setting, $useLocal = false)
    {
        $highPriority = '';

        if ($useLocal) {

            $highPriority = ideothemo_get_page_title_local_setting($setting);
        }

        return ideothemo_blog_get_option(ideothemo_get_theme_mod_parse($setting), $highPriority);
    }
}

if (!function_exists('ideothemo_get_page_title_local_setting')) {
    function ideothemo_get_page_title_local_setting($setting)
    {
        $post_id = null;

        if (is_archive()) {
            $post_id = ideothemo_get_theme_mod_parse('blog.blog_archives.blog_archives_pt');
        } elseif (is_search()) {
            $post_id = ideothemo_get_theme_mod_parse('blog.blog_search.blog_search_pt');
        }

        if (empty($post_id) && !is_archive() && !is_search() && ideothemo_is_page_on_front() || is_singular() || is_admin() /* if compile less PO*/) {
            $post_id = get_the_ID();
        }

        if (!empty($post_id)) {
            return ideothemo_get_custom_post_meta($setting, $post_id);
        }

        return '';
    }
}


if (!function_exists('ideothemo_is_page_on_front')) {
    
    function ideothemo_is_page_on_front()
    {
        return is_front_page() && get_option( 'page_on_front' );        
    }
}

/**
 * GENERAL SETTINGS
 */

if (!function_exists('ideothemo_page_title_area_global_status')) {
    /**
     * Check Page Title Area global status
     *
     * @return bool
     */
    function ideothemo_page_title_area_global_status()
    {
        return ideothemo_get_theme_mod_parse('pagetitle.page_title_settings.page_title_area');
    }
}

if (!function_exists('ideothemo_page_title_area_enabled')) {
    /**
     * Check Page Title Area is enabled
     *
     * @return bool
     */
    function ideothemo_page_title_area_enabled()
    {
        return ideothemo_blog_is_part_enabled('pagetitle.page_title_settings.page_title_area', ideothemo_get_page_title_local_setting('pagetitle.page_title_settings.page_title_area'), false);
    }
}

if (!function_exists('ideothemo_page_title_area_attrs')) {
    function ideothemo_page_title_area_attrs()
    {
        ideothemo_customize_attrs(ideothemo_get_page_title_local_setting('pagetitle.page_title_settings.page_title_area'), ideothemo_page_title_area_enabled(false));
    }
}
if (!function_exists('ideothemo_breadcrumbs_area_attrs')) {
    function ideothemo_breadcrumbs_area_attrs()
    {
        ideothemo_customize_attrs(ideothemo_get_page_title_local_setting('pagetitle.page_title_settings.breadcrumbs_area'), ideothemo_breadcrumbs_area_enabled(false));
    }
}

if (!function_exists('ideothemo_breadcrumbs_area')) {

    /**
     * Get Global settings
     *
     * @return null
     */

    function ideothemo_breadcrumbs_area()
    {
        return ideothemo_get_theme_mod_parse('pagetitle.page_title_settings.breadcrumbs_area');
    }
}

if (!function_exists('ideothemo_breadcrumbs_position')) {

    /**
     * Get Breadcrumbs position
     *
     * @return null
     */

    function ideothemo_breadcrumbs_position()
    {
        return ideothemo_get_theme_mod_parse('pagetitle.page_title_settings.breadcrumbs_position');
    }
}

if (!function_exists('ideothemo_breadcrumbs_area_enabled')) {
    /**
     * Check Breadcrumbs Area is enabled
     *
     * @return bool
     */
    function ideothemo_breadcrumbs_area_enabled($useLocal = false)
    {
        return ideothemo_blog_is_switch_enabled(ideothemo_get_page_title_setting('pagetitle.page_title_settings.breadcrumbs_area', $useLocal));
    }
}

if (!function_exists('ideothemo_breadcrumbs_area_mobile_enabled')) {
    /**
     * Check Breadcrumbs Area is enabled on the mobile
     *
     * @return bool
     */
    function ideothemo_breadcrumbs_area_mobile_enabled($useLocal = false)
    {
        return ideothemo_blog_is_switch_enabled(ideothemo_get_page_title_setting('pagetitle.page_title_settings.breadcrumbs_mobile', $useLocal));
    }
}

if (!function_exists('ideothemo_page_title_area_content_align')) {

    /**
     * Page Title align (left|center|right) or default for PO
     *
     * @return null
     */

    function ideothemo_page_title_area_content_align($useLocal = true)
    {
        $setting = 'pagetitle.page_title_settings.page_title_area_content_align';

        return ideothemo_get_page_title_setting($setting, $useLocal);
    }
}

if (!function_exists('ideothemo_get_pt_parallax_moving_speed')) {

    /**
     * Return page title parallax motion speed (there is no settings in TO for now)
     *
     * @return null
     */

    function ideothemo_get_pt_parallax_moving_speed($useLocal = true)
    {
        return 0.5;
    }
}

if (!function_exists('ideothemo_get_page_title_skin_area')) {

    /**
     * Get skin
     *
     * @return mixed
     */

    function ideothemo_get_page_title_skin_area($useLocal = false)
    {
        $area_skin = ideothemo_get_page_title_setting('pagetitle.page_title_settings.page_title_area_skin', $useLocal);
        
        if( !$area_skin ){
            return 'light';
        }
        return ideothemo_blog_get_option(ideothemo_get_general_theme_skin(true), $area_skin);
    }
}

if (!function_exists('ideothemo_get_header_classes')) {
    function ideothemo_get_header_classes($useLocal = false)
    {
        $classes = array();

        if (is_customize_preview()) {
            $classes[] = 'customize-preview';
        }

        $classes[] = 'skin-' . ideothemo_get_general_theme_skin();
        $classes[] = ideothemo_get_layout_type_class();

        $classes[] = 'background-header';
        $classes[] = 'breadcrumbs-' . ideothemo_breadcrumbs_position();

        if (ideothemo_page_title_area_enabled()) {
            $classes = array_merge($classes, ideothemo_get_background_classes(array(
                'background-type' => ideothemo_get_pt_area_background($useLocal),
                'background-overlay' => ideothemo_get_pt_background_overlay_type($useLocal),
                'background-video-platform' => ideothemo_get_pt_background_video_platform($useLocal),
                'enable-parallax-effect' => ideothemo_pt_background_effect_enabled('parallax', $useLocal) || ideothemo_pt_background_effect_enabled('fixed', $useLocal)
            )));
        }
        
        if($motion = ideothemo_get_page_title_local_setting('pagetitle.page_title_background.pt_background_motion')){
            $classes[] = 'background-motion-' . $motion;            
        }else{
            $classes[] = 'background-motion-' . ideothemo_get_page_title_setting('pagetitle.page_title_background.pt_background_motion');                        
        }
        

        if (ideothemo_get_page_title_local_setting('pagetitle.page_title_background.page_title_area_background')) {
            $classes[] = 'js--local-modifications';
        }

        if (ideothemo_is_header_type('standard') || ideothemo_is_header_type('top') || ideothemo_is_header_type('sticky') || ideothemo_is_header_type('sticky_slide')) {
            $classes[] = 'menu-' . ideothemo_get_header_setting('top.align.menu');
        }
        $useLocal = true;
        
        if(is_front_page() && !get_option('page_on_front')){
            $useLocal = false;
        }
        $classes[] = ideothemo_get_header_style($useLocal, (ideothemo_is_header_type('sticky') || ideothemo_is_header_type('sticky_slide')) ? 'top' : null);

        return trim(implode(' ', apply_filters(__FUNCTION__, $classes)));
    }
}

if (!function_exists('ideothemo_get_header_navbar_classes')) {
    function ideothemo_get_header_navbar_classes()
    {
        $classes = array();

        $classes[] = ideothemo_get_header_setting('top.dropdown_animation');
        $classes[] = ideothemo_get_header_setting('top.first_level_menu_hover_style');

        if (ideothemo_is_header_type('sticky') || ideothemo_is_header_type('sticky_slide')) {
            $classes[] = ideothemo_get_header_setting('sticky.loading_effect');
        }
        if (ideothemo_is_header_type('sticky')) {
            $classes[] = 'sticky';
        }

        if (ideothemo_is_header_type('sticky_slide')) {
            $classes[] = 'sticky-slide';
        }

        if (ideothemo_is_header_type('sticky_slide_hide')) {
            $classes[] = 'sticky-slide-hide';
        }

        if (ideothemo_is_header_type('side_left') || ideothemo_is_header_type('side_right') || ideothemo_is_header_type('side_offcanvas_left') || ideothemo_is_header_type('side_offcanvas_right')) {
            $classes[] = 'mobile';
        }

        $type = ideothemo_get_header_setting('type', false);
        
        if($type === 'side_offcanvas_left_header'){
            $classes[] = 'side_header';
            $classes[] = 'side_offcanvas_header';
            $classes[] = 'side_left_header';
        }

        if($type === 'side_offcanvas_right_header'){
            $classes[] = 'side_header';
            $classes[] = 'side_offcanvas_header';
            $classes[] = 'side_right_header';
        }

        $classes[] = $type;

        return trim(implode(' ', apply_filters(__FUNCTION__, $classes)));
    }
}
if (!function_exists('ideothemo_get_header_navbar_mobile_skin')) {
    function ideothemo_get_header_navbar_mobile_skin()
    {
        return ideothemo_get_header_style(true, 'mobile');
    }
}
if (!function_exists('ideothemo_get_header_nav_standard_classes')) {
    function ideothemo_get_header_nav_standard_classes()
    {
        $classes = array();
        $classes[] = 'navbar';
        $classes[] = 'navbar-standard';
        $classes[] = 'navbar-static-top';

        if (ideothemo_get_header_setting('top.width') == 'custom') {
            $classes[] = 'custom';
        }
        if (ideothemo_get_header_setting('top.width') == 'container' && !ideothemo_is_boxed_version()) {
            $classes[] = 'container';
        }
        
        $classes[] = 'navbar-standard-width-' . ideothemo_get_header_setting('top.width');
        $classes[] = 'navbar-sticky-width-' . ideothemo_get_header_setting('sticky.width');

        $classes[] = 'mobile-skin-' . ideothemo_get_header_style(true, 'mobile');
        $classes[] = 'mobile-search-bar-' . (ideothemo_get_header_setting('mobile.search_bar') == 'true' ? 'on' : 'off');
        $classes[] = 'mobile-social-media-' . (ideothemo_get_header_setting('mobile.social_media_icon') == 'true' ? 'on' : 'off');

        if (ideothemo_get_header_setting('mobile.sticky') == "true") {
            $classes[] = 'mobile-sticky';
        }

        return trim(implode(' ', apply_filters(__FUNCTION__, $classes)));
    }
}

if (!function_exists('ideothemo_get_pt_background_overlay_type')) {
    function ideothemo_get_pt_background_overlay_type($useLocal = false)
    {
        $background_type = ideothemo_get_pt_area_background($useLocal);

        if ($background_type == 'color') {

            return ideothemo_get_pt_background_color_overlay($useLocal);

        } elseif ($background_type == 'image') {

            return ideothemo_get_pt_background_image_overlay($useLocal);

        } elseif ($background_type == 'video') {

            return ideothemo_get_pt_background_video_overlay($useLocal);

        }

        return 'none';
    }
}

if (!function_exists('ideothemo_get_pt_background_overlay_color')) {
    function ideothemo_get_pt_background_overlay_color($useLocal = false)
    {
        $background_type = ideothemo_get_pt_area_background($useLocal);

        if ($background_type == 'color') {

            return ideothemo_get_pt_background_color_overlay_color($useLocal);

        } elseif ($background_type == 'image') {

            return ideothemo_get_pt_background_image_overlay_color($useLocal);

        } elseif ($background_type == 'video') {

            return ideothemo_get_pt_background_video_overlay_color($useLocal);

        }

        return 'none';
    }
}

if (!function_exists('ideothemo_get_pt_background_pattern_color')) {
    function ideothemo_get_pt_background_pattern_color($useLocal = false)
    {
        $background_type = ideothemo_get_pt_area_background($useLocal);

        if ($background_type == 'color') {

            return ideothemo_get_pt_background_color_pattern_color($useLocal);

        } elseif ($background_type == 'image') {

            return ideothemo_get_pt_background_image_overlay_pattern_color($useLocal);

        } elseif ($background_type == 'video') {

            return ideothemo_get_pt_background_video_overlay_pattern_color($useLocal);

        }

        return 'none';
    }
}

if (!function_exists('ideothemo_get_pt_background_overlay_pattern')) {

    /**
     * Background Pattern
     *
     * @param bool $useLocal
     * @return bool|mixed|string
     */

    function ideothemo_get_pt_background_overlay_pattern($useLocal = false)
    {
        $background_type = ideothemo_get_pt_area_background($useLocal);

        if ($background_type == 'color') {

            return ideothemo_get_pt_background_color_pattern($useLocal);

        } elseif ($background_type == 'image') {

            return ideothemo_get_pt_background_image_overlay_pattern($useLocal);

        } elseif ($background_type == 'video') {

            return ideothemo_get_pt_background_video_overlay_pattern($useLocal);

        }

        return 'none';
    }
}

if (!function_exists('ideothemo_get_pt_overlay_pattern')) {
    function ideothemo_get_pt_overlay_pattern($useLocal = false)
    {
        return ideothemo_get_assets_svg_data('svg/masks/' . ideothemo_get_pt_background_overlay_pattern($useLocal) . '.svg', ideothemo_get_pt_background_pattern_color($useLocal));
    }
}

if (!function_exists('ideothemo_get_side_overlay_pattern')) {
    function ideothemo_get_side_overlay_pattern($useLocal = false)
    {
        $skin = ideothemo_get_header_style(true, 'side');
        $type = ideothemo_get_header_setting('side.' . $skin . '.styling.background');
        $overlay = $type == 'image' ? 'image_background.image_overlay.pattern.type' : 'color_background.pattern_overlay';

        if ('none' === $overlay) {
            return '';
        }

        $color = $type == 'image' ? 'image_background.image_overlay.pattern.color' : 'color_background.pattern_color';

        return 'url(' . ideothemo_get_assets_svg_data('svg/masks/' . ideothemo_get_header_setting('side.' . $skin . '.styling.' . $overlay) . '.svg', ideothemo_get_header_setting('side.' . $skin . '.styling.' . $color)) . ')';
    }
}

if (!function_exists('ideothemo_pt_background_effect_enabled')) {
    function ideothemo_pt_background_effect_enabled($type = 'parallax', $useLocal = false)
    {
        return ideothemo_get_pt_area_background($useLocal) == 'image' && ideothemo_get_pt_background_motion($useLocal) == $type;
    }
}

if (!function_exists('ideothemo_pt_parallax_effect_enabled')) {
    function ideothemo_pt_parallax_effect_enabled()
    {
        return ideothemo_blog_is_switch_enabled(ideothemo_get_pt_background_setting('pagetitle.page_title_background.pt_background_parallax', true));
    }
}

if (!function_exists('ideothemo_page_title_classes')) {
    /*
     * Returns classes for page title element
     * 
     * @return string
     */

    function ideothemo_page_title_classes()
    {

        $classes = array('page-title');

        //prevent overrighting styles for single team
        //single team has no breadcrumbs
        if (!is_singular('team')) {
            $classes[] = 'breadcrumbs-position-' . ideothemo_breadcrumbs_position();
        }

        $classes[] = 'page-title-position-' . ideothemo_page_title_area_content_align();
        $classes[] = 'page-title-area-' . (ideothemo_get_theme_mod_parse('pagetitle.page_title_settings.page_title_area') ? 'on' : 'off');

        if (ideothemo_get_the_title()) {
            $classes[] = 'page-title-with-title';
        }

        if (ideothemo_get_the_subtitle()) {
            $classes[] = 'page-title-with-subtitle';
        }

        if (ideothemo_has_not_empty_portfolio_parameters()) {
            $classes[] = 'page-title-with-parameters';
        }

        echo esc_attr(implode(' ', $classes));
    }
}

if (!function_exists('ideothemo_breadcrumbspost_parents')) {
    /**
     * A Breadcrumb Trail Filling Function
     *
     * This recursive functions fills the trail with breadcrumbs for parent posts/pages.
     * Source breadcrumb-navxt
     * @param int $id The id of the parent page.
     * @param int $frontpage The id of the front page.
     * @return WP_Post The parent we stopped at
     *
     */
    function ideothemo_breadcrumbspost_parents($id, $frontpage, $breadcrumbs)
    {
        $parent = get_post($id);

        if ($parent->post_parent >= 0 && $parent->post_parent != false && $id != $parent->post_parent && $frontpage != $parent->post_parent) {
            //If valid, recursively call this function
            $breadcrumbs .= ideothemo_breadcrumbspost_parents($parent->post_parent, $frontpage, $breadcrumbs);
        }
        $breadcrumbs .= '<li><a href="' . get_permalink($id) . '">' . get_the_title($parent) . '</a></li>';

        return $breadcrumbs;
    }
}

include(IDEOTHEMO_INIT_DIR . 'inc/helpers-page-title-background.php');