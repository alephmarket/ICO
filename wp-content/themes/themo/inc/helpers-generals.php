<?php

if (!function_exists('ideothemo_get_general_theme_skin')) {
    function ideothemo_get_general_theme_skin($invert = false)
    {
        $value = ideothemo_get_theme_mod_parse('generals.styling.theme_skin');

        if (!$invert)
            return $value;

        return $value == 'light' ? 'dark' : 'light';
    }
}

if (!function_exists('ideothemo_get_general_accent_color')) {
    function ideothemo_get_general_accent_color()
    {
        if (($accent_color = ideothemo_get_theme_mod_parse('generals.styling.accent_color')) === 'custom') {
            $accent_color = ideothemo_get_theme_mod_parse('generals.styling.custom_accent_color');
        }

        return $accent_color;
    }
}
if (!function_exists('ideothemo_get_accent_color')) {
    function ideothemo_get_accent_color($string)
    {
        $accent_color = ideothemo_get_page_option_setting($string, false, null, false);

        if (!$accent_color) {
            return ideothemo_get_general_accent_color();
        }

        return $accent_color;
    }
}

if (!function_exists('ideothemo_get_general_sidebar')) {
    function ideothemo_get_general_sidebar()
    {
        return ideothemo_get_theme_mod_parse('sidebar.sidebar_settings.sidebar_choose');
    }
}

if (!function_exists('ideothemo_get_animate_viewport')) {
    function ideothemo_get_animate_viewport()
    {
        return array(
            'fadeIn' => 'fadeIn',
            'bounce' => 'bounce',
            'flash' => 'flash',
            'pulse' => 'pulse',
            'rubberBand' => 'rubberBand',
            'shake' => 'shake',
            'swing' => 'swing',
            'tada' => 'tada',
            'wobble' => 'wobble',
            'jello' => 'jello',
            'bounceIn' => 'bounceIn',
            'bounceInDown' => 'bounceInDown',
            'bounceInLeft' => 'bounceInLeft',
            'bounceInRight' => 'bounceInRight',
            'bounceInUp' => 'bounceInUp',
            'bounceOut' => 'bounceOut',
            'bounceOutDown' => 'bounceOutDown',
            'bounceOutLeft' => 'bounceOutLeft',
            'bounceOutRight' => 'bounceOutRight',
            'bounceOutUp' => 'bounceOutUp',
            'fadeInDown' => 'fadeInDown',
            'fadeInDownBig' => 'fadeInDownBig',
            'fadeInLeft' => 'fadeInLeft',
            'fadeInLeftBig' => 'fadeInLeftBig',
            'fadeInRight' => 'fadeInRight',
            'fadeInRightBig' => 'fadeInRightBig',
            'fadeInUp' => 'fadeInUp',
            'fadeInUpBig' => 'fadeInUpBig',
            'fadeOut' => 'fadeOut',
            'fadeOutDown' => 'fadeOutDown',
            'fadeOutDownBig' => 'fadeOutDownBig',
            'fadeOutLeft' => 'fadeOutLeft',
            'fadeOutLeftBig' => 'fadeOutLeftBig',
            'fadeOutRight' => 'fadeOutRight',
            'fadeOutRightBig' => 'fadeOutRightBig',
            'fadeOutUp' => 'fadeOutUp',
            'fadeOutUpBig' => 'fadeOutUpBig',
            'flipInX' => 'flipInX',
            'flipInY' => 'flipInY',
            'flipOutX' => 'flipOutX',
            'flipOutY' => 'flipOutY',
            'lightSpeedIn' => 'lightSpeedIn',
            'lightSpeedOut' => 'lightSpeedOut',
            'rotateIn' => 'rotateIn',
            'rotateInDownLeft' => 'rotateInDownLeft',
            'rotateInDownRight' => 'rotateInDownRight',
            'rotateInUpLeft' => 'rotateInUpLeft',
            'rotateInUpRight' => 'rotateInUpRight',
            'rotateOut' => 'rotateOut',
            'rotateOutDownLeft' => 'rotateOutDownLeft',
            'rotateOutDownRight' => 'rotateOutDownRight',
            'rotateOutUpLeft' => 'rotateOutUpLeft',
            'rotateOutUpRight' => 'rotateOutUpRight',
            'hinge' => 'hinge',
            'rollIn' => 'rollIn',
            'rollOut' => 'rollOut',
            'zoomIn' => 'zoomIn',
            'zoomInDown' => 'zoomInDown',
            'zoomInLeft' => 'zoomInLeft',
            'zoomInRight' => 'zoomInRight',
            'zoomInUp' => 'zoomInUp',
            'zoomOut' => 'zoomOut',
            'zoomOutDown' => 'zoomOutDown',
            'zoomOutLeft' => 'zoomOutLeft',
            'zoomOutRight' => 'zoomOutRight',
            'zoomOutUp' => 'zoomOutUp',
            'slideInDown' => 'slideInDown',
            'slideInLeft' => 'slideInLeft',
            'slideInRight' => 'slideInRight',
            'slideInUp' => 'slideInUp',
            'slideOutDown' => 'slideOutDown',
            'slideOutLeft' => 'slideOutLeft',
            'slideOutRight' => 'slideOutRight',
            'slideOutUp' => 'slideOutUp',

        );
    }
}

if (!function_exists('ideothemo_is_image')) {
    function ideothemo_is_image($url, $default = '')
    {
        if (!filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED) === false) {
            return '"' . $url . '"';
        }else{
            return $default;
        }
    }
}

if (!function_exists('ideothemo_is_color')) {
    function ideothemo_is_color($color, $invalidColor = '')
    {


        $named = array('aliceblue', 'antiquewhite', 'aqua', 'aquamarine', 'azure', 'beige', 'bisque', 'black', 'blanchedalmond', 'blue', 'blueviolet', 'brown', 'burlywood', 'cadetblue', 'chartreuse', 'chocolate', 'coral', 'cornflowerblue', 'cornsilk', 'crimson', 'cyan', 'darkblue', 'darkcyan', 'darkgoldenrod', 'darkgray', 'darkgreen', 'darkkhaki', 'darkmagenta', 'darkolivegreen', 'darkorange', 'darkorchid', 'darkred', 'darksalmon', 'darkseagreen', 'darkslateblue', 'darkslategray', 'darkturquoise', 'darkviolet', 'deeppink', 'deepskyblue', 'dimgray', 'dodgerblue', 'firebrick', 'floralwhite', 'forestgreen', 'fuchsia', 'gainsboro', 'ghostwhite', 'gold', 'goldenrod', 'gray', 'green', 'greenyellow', 'honeydew', 'hotpink', 'indianred', 'indigo', 'ivory', 'khaki', 'lavender', 'lavenderblush', 'lawngreen', 'lemonchiffon', 'lightblue', 'lightcoral', 'lightcyan', 'lightgoldenrodyellow', 'lightgreen', 'lightgrey', 'lightpink', 'lightsalmon', 'lightseagreen', 'lightskyblue', 'lightslategray', 'lightsteelblue', 'lightyellow', 'lime', 'limegreen', 'linen', 'magenta', 'maroon', 'mediumaquamarine', 'mediumblue', 'mediumorchid', 'mediumpurple', 'mediumseagreen', 'mediumslateblue', 'mediumspringgreen', 'mediumturquoise', 'mediumvioletred', 'midnightblue', 'mintcream', 'mistyrose', 'moccasin', 'navajowhite', 'navy', 'oldlace', 'olive', 'olivedrab', 'orange', 'orangered', 'orchid', 'palegoldenrod', 'palegreen', 'paleturquoise', 'palevioletred', 'papayawhip', 'peachpuff', 'peru', 'pink', 'plum', 'powderblue', 'purple', 'red', 'rosybrown', 'royalblue', 'saddlebrown', 'salmon', 'sandybrown', 'seagreen', 'seashell', 'sienna', 'silver', 'skyblue', 'slateblue', 'slategray', 'snow', 'springgreen', 'steelblue', 'tan', 'teal', 'thistle', 'tomato', 'turquoise', 'violet', 'wheat', 'white', 'whitesmoke', 'yellow', 'yellowgreen');

        if (in_array(strtolower($color), $named)) {
            return $color;
        }

        $color = trim(preg_replace('/\s+/', '', $color));

        if (preg_match('/^#[a-f0-9]{6}$/i', $color)) { //#000000
            return $color;
        } else if (preg_match('/^#[a-f0-9]{3}$/i', $color)) { //#000
            return $color;
        } else if (preg_match('/^[a-f0-9]{6}$/i', $color)) { //000000
            return '#' . $color;
        } else if (preg_match('/^rgba\([0-9]{1,3},[0-9]{1,3},[0-9]{1,3},[0-9.]{1,4}\)$/i', $color)) { //rgba(221,51,51,0.76)
            return $color;
        } else if (preg_match('/^rgb\([0-9]{1,3},[0-9]{1,3},[0-9]{1,3}\)$/i', $color)) { //rgb(221,51,51)
            return $color;
        }


        return $invalidColor;

    }
}

if (!function_exists('ideothemo_is_number')) {
    function ideothemo_is_number($number, $invalidNumber = '')
    {
        $number = trim(preg_replace('/\s+/', '', $number));

        if (preg_match('/^-? *[0-9]+([\.,][0-9]+)?$/', $number))
            return $number;

        return $invalidNumber;
    }
}

if (!function_exists('ideothemo_color_or_accent')) {
    function ideothemo_color_or_accent($color, $accent_opacity = null, $accent_darken = null, $default = '#3498db')
    {
        $color = ideothemo_is_color($color);

        if (!empty($color))
            return $color;

        $color =  ideothemo_is_color(ideothemo_get_general_accent_color(), $default);        
       

        if ($accent_opacity)
            $color = 'fade(' . $color . ', ' . $accent_opacity . ')';
        
        if ($accent_darken)
            $color = 'darken(' . $color . ', ' . $accent_darken . ')';        

        return $color;
    }
}

if (!function_exists('ideothemo_url_decode')) {
    function ideothemo_url_decode($parameter)
    {
        return (str_replace('-', '=', $parameter));
    }
}

if (!function_exists('ideothemo_nextprev_navi_enabled')) {
    /**
     * Check if have to display next/prev navigation
     *
     * @param string $highPriority
     * @param bool $customizeEnabled
     * @return bool
     */
    function ideothemo_nextprev_navi_enabled($highPriority = '', $customizeEnabled = true)
    {
        if ($customizeEnabled && ideothemo_is_customize_preview()) {
            return true;
        }

        $lowPriority = false;

        if (is_singular('post')) {
            $lowPriority = ideothemo_get_theme_mod_parse('blog.blog_single.blog_single_navigation');
        } elseif (is_singular(ideothemo_get_portfolio_slug())) {
            $lowPriority = ideothemo_get_theme_mod_parse('portfolio.portfolio_standard_card.navigation');
        }

        return ideothemo_blog_is_switch_enabled($lowPriority, $highPriority);
    }
}

if (!function_exists('ideothemo_save_cache_css')) {
    function ideothemo_save_cache_css($file, $css, $flag = null)
    {
        global $wp_filesystem;


        if (!file_exists(IDEOTHEMO_CACHE_DIR)) {
            wp_mkdir_p(IDEOTHEMO_CACHE_DIR);
        }

        return ideothemo_put_contents(IDEOTHEMO_CACHE_DIR . $file, $css, $flag);
    }
}

if (!function_exists('ideothemo_get_layout_type_class')) {
    function ideothemo_get_layout_type_class()
    {
        return ideothemo_is_boxed_version() ? 'wrap-boxed' : 'wrap-wide';
    }
}

if (!function_exists('ideothemo_is_vc_used')) {
    /*
     * Check if is visual composer on
     * 
     * @global WP_Post $post
     */
    function ideothemo_is_vc_used($post_id = null)
    {
        global $post;

        if ($post_id === null) {
            return ($post instanceof WP_Post) ? has_shortcode($post->post_content, 'vc_row') : false;
        } else {
            $content_post = get_post($post_id);
            return ($content_post instanceof WP_Post) ? has_shortcode($content_post->post_content, 'vc_row') : false;
        }
    }
}

if (!function_exists('ideothemo_is_customizer_mode')) {
    /*
     * Check if is PC mode in wp-admin
     * 
     * @return bool
     */
    function ideothemo_is_customizer_mode()
    {
        return !isset($_GET['mode']);
    }
}

if (!function_exists('ideothemo_is_customizer_mode')) {
    /*
     * Check if is customizer mode in wp-admin
     * 
     * @return bool
     */
    function ideothemo_is_pc_mode()
    {
        return isset($_GET['mode']);
    }
}
if (!function_exists('ideothemo_is_advanced_sticky_loading')) {
    function ideothemo_is_advanced_sticky_loading()
    {
        return ideothemo_get_theme_mod_parse('advanced.advanced_loading.advanced_sticky_loading') === 'true' && !is_customize_preview();
    }
}

if (!function_exists('ideothemo_parse_background_postion')) {
    function ideothemo_parse_background_postion($setting)
    {
        return str_replace('_', ' ', $setting);
    }
}

if (!function_exists('ideothemo_parse_background_repeat')) {
    function ideothemo_parse_background_repeat($setting)
    {
        $value = str_replace('_', '-', $setting);

        return str_replace('repeat-xy', 'repeat', $value);
    }
}

if (!function_exists('ideothemo_get_themo_default_value')) {

    /**
     * Get any default value setting
     *
     *
     * @param string $option_name
     * @return mixed
     */
    function ideothemo_get_themo_default_value($option_name)
    {
        //keep array in alphabetic order
        $settings = array(
            'option.name' => 'default_value',
            'generals.layout.boxed_version' => 'false',
            'generals.layout.site_width' => '1170',
            'generals.styling.theme_skin' => 'light',
            'generals.styling.accent_color' => 'custom',
            'generals.styling.custom_accent_color' => '#3498db',
            'generals.background.content_background_info' => '',
            'generals.background.content_background_type' => '', //default from theme_skin

            'generals.background.content_background_color' => '#f6f6f6',
            'generals.background.content_background_color_overlay' => 'none',
            'generals.background.content_background_color_overlay_color' => '',
            'generals.background.content_background_color_pattern' => 'small_dense_dots',
            'generals.background.content_background_color_pattern_color' => '#3a3a3a',

            'generals.background.content_background_upload_image' => '',
            'generals.background.content_background_cover' => 'true',
            'generals.background.content_background_image_position' => 'left_top',
            'generals.background.content_background_image_repeat' => 'no_repeat',
            'generals.background.content_background_image_motion' => 'fixed',
            'generals.background.content_background_image_overlay' => 'none',
            'generals.background.content_background_image_overlay_color' => '',
            'generals.background.content_background_image_overlay_pattern' => 'small_dense_dots',
            'generals.background.content_background_image_overlay_pattern_color' => '#3a3a3a',

            'generals.background.content_background_video_platform' => 'youtube',
            'generals.background.content_background_youtube' => '',
            'generals.background.content_background_mp4' => '',
            'generals.background.content_background_webm' => '',
            'generals.background.content_background_fallback_image' => '',
            'generals.background.content_background_video_overlay' => 'none',
            'generals.background.content_background_video_overlay_color' => '',
            'generals.background.content_background_video_overlay_pattern' => 'small_dense_dots',
            'generals.background.content_background_video_overlay_pattern_color' => '#3a3a3a',

            'generals.background.boxed_background_info' => '',
            'generals.background.boxed_background_type' => '', //default from theme_skin

            'generals.background.boxed_background_color' => '#DDDDDD',
            'generals.background.boxed_background_color_overlay' => 'none',
            'generals.background.boxed_background_color_overlay_color' => '',
            'generals.background.boxed_background_color_pattern' => 'small_dense_dots',
            'generals.background.boxed_background_color_pattern_color' => '#3a3a3a',

            'generals.background.boxed_background_upload_image' => '',
            'generals.background.boxed_background_cover' => 'true',
            'generals.background.boxed_background_image_position' => 'left_top',
            'generals.background.boxed_background_image_repeat' => 'no_repeat',
            'generals.background.boxed_background_image_motion' => 'fixed',
            'generals.background.boxed_background_image_overlay' => 'none',
            'generals.background.boxed_background_image_overlay_color' => '',
            'generals.background.boxed_background_image_overlay_pattern' => 'small_dense_dots',
            'generals.background.boxed_background_image_overlay_pattern_color' => '#3a3a3a',

            'generals.background.boxed_background_video_platform' => 'youtube',
            'generals.background.boxed_background_youtube' => '',
            'generals.background.boxed_background_mp4' => '',
            'generals.background.boxed_background_webm' => '',
            'generals.background.boxed_background_fallback_image' => '',
            'generals.background.boxed_background_video_overlay' => 'none',
            'generals.background.boxed_background_video_overlay_color' => '',
            'generals.background.boxed_background_video_overlay_pattern' => 'small_dense_dots',
            'generals.background.boxed_background_video_overlay_pattern_color' => '#3a3a3a',
            
            'generals.general_smoothscroll.smoothscrolling' => 'scroll4websites',
            'generals.general_smoothscroll.smoothscroll_preset' => 'dynamic',
            
            'advanced.advanced_advanced.advanced_smoothscroll' => 'true',
            'advanced.advanced_advanced.advanced_head_tags' => '',
            'advanced.advanced_advanced.advanced_body_tags' => '',

            'fonts.font_family.global_font_info' => '',
            'fonts.font_family.global_font_extension' => 'latin',
            'fonts.body_font_settings.body_font_family' => 'Open Sans',
            'fonts.body_font_settings.body_font_weight' => 'regular',
            'fonts.body_font_settings.body_font_size' => '15',
            'fonts.body_font_settings.body_line_height' => '1.8em',
            'fonts.body_font_settings.body_letter_spacing' => '',
            

            'fonts.text_tag_settings.text_tag_settings' => '',

            'fonts.text_tag_settings.p_font_size' => '15',
            'fonts.text_tag_settings.p_line_height' => '1.8em',
            'fonts.text_tag_settings.p_font_family' => '', // default global_font
            'fonts.text_tag_settings.p_font_weight' => 'regular',
            'fonts.text_tag_settings.p_letter_spacing' => '',
            'fonts.text_tag_settings.p_text_transform' => 'none',

            'fonts.text_tag_settings.link_font_style' => 'normal',
            'fonts.text_tag_settings.link_font_weight' => 'regular',
            'fonts.text_tag_settings.link_text_decoration' => 'none',

            'fonts.text_tag_settings.h1_font_size' => '35',
            'fonts.text_tag_settings.h1_line_height' => '1.094em',
            'fonts.text_tag_settings.h1_font_family' => '', // default global_font
            'fonts.text_tag_settings.h1_font_weight' => 'regular',
            'fonts.text_tag_settings.h1_letter_spacing' => '',
            'fonts.text_tag_settings.h1_text_transform' => 'none',

            'fonts.text_tag_settings.h2_font_size' => '32',
            'fonts.text_tag_settings.h2_line_height' => '1.167em',
            'fonts.text_tag_settings.h2_font_family' => '', // default global_font
            'fonts.text_tag_settings.h2_font_weight' => 'regular',
            'fonts.text_tag_settings.h2_letter_spacing' => '',
            'fonts.text_tag_settings.h2_text_transform' => 'none',

            'fonts.text_tag_settings.h3_font_size' => '26',
            'fonts.text_tag_settings.h3_line_height' => '1.111em',
            'fonts.text_tag_settings.h3_font_family' => '', // default global_font
            'fonts.text_tag_settings.h3_font_weight' => 'regular',
            'fonts.text_tag_settings.h3_letter_spacing' => '',
            'fonts.text_tag_settings.h3_text_transform' => 'none',

            'fonts.text_tag_settings.h4_font_size' => '22',
            'fonts.text_tag_settings.h4_line_height' => '1.214em',
            'fonts.text_tag_settings.h4_font_family' => '', // default global_font
            'fonts.text_tag_settings.h4_font_weight' => 'regular',
            'fonts.text_tag_settings.h4_letter_spacing' => '',
            'fonts.text_tag_settings.h4_text_transform' => 'none',

            'fonts.text_tag_settings.h5_font_size' => '18',
            'fonts.text_tag_settings.h5_line_height' => '1.308em',
            'fonts.text_tag_settings.h5_font_family' => '', // default global_font
            'fonts.text_tag_settings.h5_font_weight' => 'regular',
            'fonts.text_tag_settings.h5_letter_spacing' => '',
            'fonts.text_tag_settings.h5_text_transform' => 'none',

            'fonts.text_tag_settings.h6_font_size' => '16',
            'fonts.text_tag_settings.h6_line_height' => '1.250em',
            'fonts.text_tag_settings.h6_font_family' => '', // default global_font
            'fonts.text_tag_settings.h6_font_weight' => 'regular',
            'fonts.text_tag_settings.h6_letter_spacing' => '',
            'fonts.text_tag_settings.h6_text_transform' => 'none',

            'fonts.font_coloring.body_text_skin' => 'default',
            'fonts.font_coloring.light.h1' => '#ffffff',
            'fonts.font_coloring.light.h2' => '#ffffff',
            'fonts.font_coloring.light.h3' => '#ffffff',
            'fonts.font_coloring.light.h4' => '#ffffff',
            'fonts.font_coloring.light.h5' => '#ffffff',
            'fonts.font_coloring.light.h6' => '#ffffff',
            'fonts.font_coloring.light.paragraph' => '#f0f0f0',
            'fonts.font_coloring.light.link' => '',
            'fonts.font_coloring.light.link_hover' => '',

            'fonts.font_coloring.dark.h1' => '#272f39',
            'fonts.font_coloring.dark.h2' => '#272f39',
            'fonts.font_coloring.dark.h3' => '#272f39',
            'fonts.font_coloring.dark.h4' => '#272f39',
            'fonts.font_coloring.dark.h5' => '#272f39',
            'fonts.font_coloring.dark.h6' => '#272f39',
            'fonts.font_coloring.dark.paragraph' => '#57606c',
            'fonts.font_coloring.dark.link' => '',
            'fonts.font_coloring.dark.link_hover' => '',


            'header.type' => 'sticky_header',

            'header.logo.normal' => IDEOTHEMO_INIT_DIR_URI . '/assets/images/logo.png',
            'header.logo.light' => '',
            'header.logo.dark' => '',
            'header.logo.sticky.dark' => '',
            'header.logo.sticky.light' => '',
            'header.logo.retina.enable' => 'false',
            'header.logo.retina.normal' => IDEOTHEMO_INIT_DIR_URI . '/assets/images/logo-retina.png',
            'header.logo.retina.light' => '',
            'header.logo.retina.dark' => '',
            'header.logo.retina.sticky.dark' => '',
            'header.logo.retina.sticky.light' => '',
            'header.logo.favicon' => '',

            'header.top.align.menu' => 'right',
            'header.top.first_level_menu_hover_style' => 'hover-style3',
            'header.top.dropdown_animation' => 'dropdown-slide-up',
            'header.top.search_form' => 'navbar-form-modern',
            'header.top.social_media' => 'true',
            'header.top.remove_language_switcher' => 'false',
            'header.top.enable_language_shortcuts' => 'true',
            'header.sticky.scroll_amount_input' => '600',
            'header.sticky.loading_effect' => 'disable',
            'header.top.topbar.enabled' => 'false',
            'header.top.topbar.height' => '35',
            'header.top.topbar_mobile' => 'false',

            'header.top.style' => '',
            'header.top.width' => '',
            'header.top.custom_width' => '1440',
            'header.top.content_width' => '1170',
            'header.top.height' => '80',
            'header.top.logo.type' => 'normal',
            'header.top.logo.height' => '21',
            'header.top.logo.margin.top' => '0',
            'header.top.top_distance' => '0',
            'header.sticky.style' => '',
            'header.sticky.width' => '',
            'header.sticky.custom_width' => '1440',
            'header.sticky.content_width' => '1170',
            'header.sticky.height' => '60',
            'header.sticky.logo.type' => 'normal',
            'header.sticky.logo.height' => '21',
            'header.sticky.logo.margin.top' => '0',
            'header.sticky.top_distance' => '0',

            'header.side' => '',
            'header.side.align.menu' => 'center',
            'header.side.align.bottom_area' => 'center',
            'header.side.logo.type' => 'normal',
            'header.side.logo.height' => '25',
            'header.side.logo.margin_left' => '80',
            'header.side.logo.margin_top' => '65',
            'header.side.logo.margin_bottom' => '55',
            'header.side.search_form' => '',
            'header.side.search_form' => 'true',
            'header.side.social_icon' => 'true',
            'header.side.remove_language_switcher' => 'false',
            'header.side.copyright' => 'Created by <a href="http://ideothemes.com" target="_blank" style="font-size: 12px; text-decoration: none;"> IdeoThemes</a>',
            
            'header.side.offcanvas.topbar.type' => 'hide-slide',
            'header.side.offcanvas.opening' => 'click',
            'header.side.offcanvas.slide' => 'false',
            'header.side.offcanvas.blur_content' => 'true',
            'header.side.offcanvas.blur_strength' => '5',
            'header.side.offcanvas.pagetitle.enabled' => 'false',
            'header.side.offcanvas.pagetitle.text' => 'Homepage',               
            'header.side.offcanvas.icon_style' => 'spin',
            'header.side.offcanvas.icon_size' => 'large',
            
            'header.side.offcanvas.topbar.height' => '60',
            'header.side.offcanvas.topbar.style' => '',                        
            'header.side.offcanvas.topbar.transparent' => 'false',
            'header.side.offcanvas.topbar.logo.type' => 'normal',
            'header.side.offcanvas.topbar.logo.height' => '30',     
            'header.side.offcanvas.stickybar.style' => '',
            'header.side.offcanvas.stickybar.height' => '50',
            'header.side.offcanvas.stickybar.logo.type' => 'normal',
            'header.side.offcanvas.stickybar.logo.height' => '25',     
            
            'header.side.offcanvas.light.styling.bar.background_color' => '#ffffff',
            'header.side.offcanvas.dark.styling.bar.background_color' => '#272f39',
            'header.side.offcanvas.light.styling.bar.border_bottom_thickness' => '1',
            'header.side.offcanvas.dark.styling.bar.border_bottom_thickness' => '0',
            'header.side.offcanvas.light.styling.bar.border_bottom_color' => '#ededed',
            'header.side.offcanvas.dark.styling.bar.border_bottom_color' => '#0c1616',

            'header.side.offcanvas.light.styling.menu_icon' => '#576068',
            'header.side.offcanvas.dark.styling.menu_icon' => '#ffffff',
            'header.side.offcanvas.light.styling.menu_icon_hover' => '#263038',
            'header.side.offcanvas.dark.styling.menu_icon_hover' => '#d7d9dd',
            'header.side.offcanvas.light.styling.pagetitle' => '#3b4347',
            'header.side.offcanvas.dark.styling.pagetitle' => '#d7d9dd',            
            'header.side.offcanvas.light.styling.overlay' => 'rgba(255,255,255,0.75)',
            'header.side.offcanvas.dark.styling.overlay' => 'rgba(31,35,35,0.75)', 
            

            'header.mobile.sticky' => 'false',
            'header.mobile.header_skin' => '',
            'header.mobile.height' => '50',
            'header.mobile.logo.type' => 'normal',
            'header.mobile.logo.height_in_mobile_menu' => '20',
            'header.mobile.search_bar' => 'true',
            'header.mobile.social_media_icon' => 'false',
            'header.mobile.remove_language_switcher' => 'false',


            'header.typography.main_menu.font_size' => '15',
            'header.typography.main_menu.font_family' => '',
            'header.typography.main_menu.font_weight' => '600',
            'header.typography.main_menu.letter_spacing' => '0',
            'header.typography.main_menu.text_transform' => 'none',

            'header.typography.submenu.font_size' => '14',
            'header.typography.submenu.line_height' => '1',
            'header.typography.submenu.font_family' => '',
            'header.typography.submenu.font_weight' => 'regular',
            'header.typography.submenu.letter_spacing' => '0',
            'header.typography.submenu.text_transform' => 'none',

            'header.typography.mega_menu.font_size' => '14',
            'header.typography.mega_menu.line_height' => '1',
            'header.typography.mega_menu.font_family' => '',
            'header.typography.mega_menu.font_weight' => 'regular',
            'header.typography.mega_menu.letter_spacing' => '0',
            'header.typography.mega_menu.text_transform' => 'none',

            'header.typography.mega_menu_column_title.font_size' => '15',
            'header.typography.mega_menu_column_title.line_height' => '1.3',
            'header.typography.mega_menu_column_title.font_family' => '',
            'header.typography.mega_menu_column_title.font_weight' => '600',
            'header.typography.mega_menu_column_title.letter_spacing' => '0',
            'header.typography.mega_menu_column_title.text_transform' => 'none',

            'header.typography.side_menu.font_size' => '15',
            'header.typography.side_menu.line_height' => '1',
            'header.typography.side_men.font_family' => '',
            'header.typography.side_menu.font_weight' => 'regular',
            'header.typography.side_menu.letter_spacing' => '0',
            'header.typography.side_menu.text_transform' => 'none',

            'header.typography.side_menu_submenu.font_size' => '14',
            'header.typography.side_menu_submenu.line_height' => '1',
            'header.typography.side_menu_submenu.font_family' => '',
            'header.typography.side_menu_submenu.font_weight' => 'regular',
            'header.typography.side_menu_submenu.letter_spacing' => '0',
            'header.typography.side_menu_submenu.text_transform' => 'none',

            'header.typography.mobile_menu.font_size' => '14',
            'header.typography.mobile_menu.line_height' => '1',
            'header.typography.mobile_menu.font_family' => '',
            'header.typography.mobile_menu.font_weight' => 'regular',
            'header.typography.mobile_menu.letter_spacing' => '0',
            'header.typography.mobile_menu.text_transform' => 'none',

            'header.top_sticky.colored.light.background_color' => '#ffffff',
            'header.top_sticky.colored.light.border_bottom.color' => '#d8d8d8',
            'header.top_sticky.colored.light.border_bottom.thickness' => '1',
            'header.top_sticky.colored.light.first_level_menu_text.color' => '#272f39',
            'header.top_sticky.colored.light.first_level_menu_text.hover_color' => '',
            'header.top_sticky.colored.light.hover_border_color' => '',
            'header.top_sticky.colored.light.hover_background_color' => '',
            'header.top_sticky.colored.light.search_language_icon_color' => '#272f39',
            'header.top_sticky.colored.light.search_language_icon_hover_color' => '',
            'header.top_sticky.colored.light.loading_effect1_color' => '',
            'header.top_sticky.colored.light.loading_effect2_color' => '',
            'header.top_sticky.colored.light.mega_menu_sub_level.background.color' => 'rgba(39,47,57,0.95)',
            'header.top_sticky.colored.light.mega_menu_sub_level.hover_color' => 'rgba(255,255,255,0.1)',
            'header.top_sticky.colored.light.mega_menu_sub_level.column_title_color' => '',
            'header.top_sticky.colored.light.mega_menu_sub_level.column_title.border_color' => '',
            'header.top_sticky.colored.light.mega_menu_sub_level.text_icon.color' => '#ffffff',
            'header.top_sticky.colored.light.mega_menu_sub_level.text_icon.hover_color' => '#ffffff',
            'header.top_sticky.colored.light.mega_menu_sub_level.separators_color.horizontal' => 'rgba(255,255,255,0)',
            'header.top_sticky.colored.light.mega_menu_sub_level.separators_color.vertical' => 'rgba(255,255,255,0.1)',
            'header.top_sticky.colored.light.topbar.background' => '#272f39',
            'header.top_sticky.colored.dark.topbar.text' => '#ffffff',
            'header.top_sticky.colored.light.topbar.border_top_thickness' => '0',
            'header.top_sticky.colored.light.topbar.border_top_color' => '',
            'header.top_sticky.colored.light.topbar.border_bottom_thickness' => '0',
            'header.top_sticky.colored.light.topbar.border_bottom_color' => '',

            'header.top_sticky.colored.dark.background_color' => '#272f39',
            'header.top_sticky.colored.dark.border_bottom.color' => '',
            'header.top_sticky.colored.dark.border_bottom.thickness' => '2',
            'header.top_sticky.colored.dark.first_level_menu_text.color' => '#ffffff',
            'header.top_sticky.colored.dark.first_level_menu_text.hover_color' => '#dedede',
            'header.top_sticky.colored.dark.hover_border_color' => 'rgba(255,255,255,0.2)',
            'header.top_sticky.colored.dark.hover_background_color' => '',
            'header.top_sticky.colored.dark.search_language_icon_color' => '#ffffff',
            'header.top_sticky.colored.dark.search_language_icon_hover_color' => '',
            'header.top_sticky.colored.dark.loading_effect1_color' => '',
            'header.top_sticky.colored.dark.loading_effect2_color' => '#2c3541',
            'header.top_sticky.colored.dark.mega_menu_sub_level.background.color' => 'rgba(39,47,57,0.95)',
            'header.top_sticky.colored.dark.mega_menu_sub_level.hover_color' => 'rgba(255,255,255,0.1)',
            'header.top_sticky.colored.dark.mega_menu_sub_level.column_title_color' => '',
            'header.top_sticky.colored.dark.mega_menu_sub_level.column_title.border_color' => '',
            'header.top_sticky.colored.dark.mega_menu_sub_level.text_icon.color' => '#ffffff',
            'header.top_sticky.colored.dark.mega_menu_sub_level.text_icon.hover_color' => '#ffffff',
            'header.top_sticky.colored.dark.mega_menu_sub_level.separators_color.horizontal' => 'rgba(255,255,255,0.0)',
            'header.top_sticky.colored.dark.mega_menu_sub_level.separators_color.vertical' => 'rgba(255,255,255,0.1)',
            'header.top_sticky.colored.dark.topbar.background' => '#22282f',
            'header.top_sticky.colored.dark.topbar.text' => '#ffffff',
            'header.top_sticky.colored.dark.topbar.border_top_thickness' => '0',
            'header.top_sticky.colored.dark.topbar.border_top_color' => '',
            'header.top_sticky.colored.dark.topbar.border_bottom_thickness' => '1',
            'header.top_sticky.colored.dark.topbar.border_bottom_color' => 'rgba(255,255,255,0.14)',

            'header.top_sticky.transparent.light.background_color' => 'rgba(255,255,255,0.0)',
            'header.top_sticky.transparent.light.border_bottom.color' => 'rgba(255,255,255,0.1)',
            'header.top_sticky.transparent.light.border_bottom.thickness' => '1',
            'header.top_sticky.transparent.light.first_level_menu_text.color' => '#ffffff',
            'header.top_sticky.transparent.light.first_level_menu_text.hover_color' => '#ffffff',
            'header.top_sticky.transparent.light.hover_border_color' => 'rgba(255,255,255,0.6)',
            'header.top_sticky.transparent.light.hover_background_color' => '',
            'header.top_sticky.transparent.light.search_language_icon_color' => '#ffffff',
            'header.top_sticky.transparent.light.search_language_icon_hover_color' => '',
            'header.top_sticky.transparent.light.loading_effect1_color' => 'rgba(255,255,255,0.8)',
            'header.top_sticky.transparent.light.loading_effect2_color' => 'rgba(255,255,255,0.1)',
            'header.top_sticky.transparent.light.mega_menu_sub_level.background.color' => 'rgba(39,47,57,0.95)',
            'header.top_sticky.transparent.light.mega_menu_sub_level.hover_color' => 'rgba(255,255,255,0.1)',
            'header.top_sticky.transparent.light.mega_menu_sub_level.column_title_color' => '',
            'header.top_sticky.transparent.light.mega_menu_sub_level.column_title.border_color' => '',
            'header.top_sticky.transparent.light.mega_menu_sub_level.text_icon.color' => '#ffffff',
            'header.top_sticky.transparent.light.mega_menu_sub_level.text_icon.hover_color' => '#ffffff',
            'header.top_sticky.transparent.light.mega_menu_sub_level.separators_color.horizontal' => 'rgba(255,255,255,0)',
            'header.top_sticky.transparent.light.mega_menu_sub_level.separators_color.vertical' => 'rgba(255,255,255,0.1)',
            'header.top_sticky.transparent.light.topbar.background' => 'rgba(0,0,0,0.1)',
            'header.top_sticky.transparent.light.topbar.text' => '#ffffff',
            'header.top_sticky.transparent.light.topbar.border_top_thickness' => '0',
            'header.top_sticky.transparent.light.topbar.border_top_color' => '',
            'header.top_sticky.transparent.light.topbar.border_bottom_thickness' => '1',
            'header.top_sticky.transparent.light.topbar.border_bottom_color' => 'rgba(255,255,255,0.4)',

            'header.top_sticky.transparent.dark.background_color' => 'rgba(0,0,0,0)',
            'header.top_sticky.transparent.dark.border_bottom.color' => 'rgba(39,47,57,0.1)',
            'header.top_sticky.transparent.dark.border_bottom.thickness' => '1',
            'header.top_sticky.transparent.dark.first_level_menu_text.color' => '#272f39',
            'header.top_sticky.transparent.dark.first_level_menu_text.hover_color' => '',
            'header.top_sticky.transparent.dark.hover_border_color' => '',
            'header.top_sticky.transparent.dark.hover_background_color' => 'rgba(39,47,57,0.1)',
            'header.top_sticky.transparent.dark.search_language_icon_color' => '#272f39',
            'header.top_sticky.transparent.dark.search_language_icon_hover_color' => '',
            'header.top_sticky.transparent.dark.loading_effect1_color' => 'rgba(0,0,0,0.6)',
            'header.top_sticky.transparent.dark.loading_effect2_color' => 'rgba(0,0,0,0.4)',
            'header.top_sticky.transparent.dark.mega_menu_sub_level.background.color' => 'rgba(39,47,57,0.95)',
            'header.top_sticky.transparent.dark.mega_menu_sub_level.hover_color' => 'rgba(255,255,255,0.1)',
            'header.top_sticky.transparent.dark.mega_menu_sub_level.column_title_color' => '',
            'header.top_sticky.transparent.dark.mega_menu_sub_level.column_title.border_color' => '',
            'header.top_sticky.transparent.dark.mega_menu_sub_level.text_icon.color' => '#ffffff',
            'header.top_sticky.transparent.dark.mega_menu_sub_level.text_icon.hover_color' => '#ffffff',
            'header.top_sticky.transparent.dark.mega_menu_sub_level.separators_color.horizontal' => 'rgba(255,255,255,0)',
            'header.top_sticky.transparent.dark.mega_menu_sub_level.separators_color.vertical' => 'rgba(255,255,255,0.1)',
            'header.top_sticky.transparent.dark.topbar.background' => 'rgba(0, 0, 0, 0.1)',
            'header.top_sticky.transparent.dark.topbar.text' => '#272f39',
            'header.top_sticky.transparent.dark.topbar.border_top_thickness' => '0',
            'header.top_sticky.transparent.dark.topbar.border_top_color' => '',
            'header.top_sticky.transparent.dark.topbar.border_bottom_thickness' => '1',
            'header.top_sticky.transparent.dark.topbar.border_bottom_color' => 'rgba(39,47,57,0.1)',

            'header.side.light.styling.background' => 'color',
            'header.side.light.styling.color_background.background_color' => '#ffffff',
            'header.side.light.styling.color_background.pattern_overlay' => 'none',
            'header.side.light.styling.color_background.pattern_color' => 'rgba(255,255,255,0.1)',
            'header.side.light.styling.image_background.background_image' => '',
            'header.side.light.styling.image_background.image_position' => 'top_left',
            'header.side.light.styling.image_background.image_size' => 'auto',
            'header.side.light.styling.image_background.image_repeat' => 'no_repeat',
            'header.side.light.styling.image_background.image_overlay.type' => 'none',
            'header.side.light.styling.image_background.image_overlay.color.pattern_color' => '',
            'header.side.light.styling.image_background.image_overlay.pattern.type' => 'small_dense_dots',
            'header.side.light.styling.image_background.image_overlay.pattern.color' => 'rgba(255,255,255,0.4)',
            'header.side.light.styling.menu_text_color' => '#272f39',
            'header.side.light.styling.menu_text_hover_color' => '',
            'header.side.light.styling.separators_color' => '#dedede',
            'header.side.light.styling.dropdown_menu_background_color' => '#f3f6f9',
            'header.side.light.styling.search_input_color' => '#f3f6f9',
            'header.side.light.styling.search_text_color' => '#272f39',
            'header.side.light.styling.social_icon_background_color' => '',
            'header.side.light.styling.social_icons_color' => '#ffffff',
            'header.side.light.styling.copyrights' => '#272f39',

            'header.side.dark.styling.background' => 'color',
            'header.side.dark.styling.color_background.background_color' => '#272f39',
            'header.side.dark.styling.color_background.pattern_overlay' => 'none',
            'header.side.dark.styling.color_background.pattern_color' => 'rgba(255,255,255,0.1)',
            'header.side.dark.styling.image_background.background_image' => '',
            'header.side.dark.styling.image_background.image_position' => 'top_left',
            'header.side.dark.styling.image_background.image_size' => 'auto',
            'header.side.dark.styling.image_background.image_repeat' => 'no_repeat',
            'header.side.dark.styling.image_background.image_overlay.type' => 'none',
            'header.side.dark.styling.image_background.image_overlay.color.pattern_color' => '',
            'header.side.dark.styling.image_background.image_overlay.pattern.type' => 'small_dense_dots',
            'header.side.dark.styling.image_background.image_overlay.pattern.color' => 'rgba(5,30,41,0.4)',
            'header.side.dark.styling.menu_text_color' => '#ffffff',
            'header.side.dark.styling.menu_text_hover_color' => '',
            'header.side.dark.styling.separators_color' => 'rgba(255,255,255,0.1)',
            'header.side.dark.styling.dropdown_menu_background_color' => '#22282f',
            'header.side.dark.styling.search_input_color' => '#ffffff',
            'header.side.dark.styling.search_text_color' => '#272f39',
            'header.side.dark.styling.social_icon_background_color' => '',
            'header.side.dark.styling.social_icons_color' => '#ffffff',
            'header.side.dark.styling.copyrights' => '#ffffff',

            'header.mobile.light.styling.background_color' => '#ffffff',
            'header.mobile.light.styling.border_top_color' => '',
            'header.mobile.light.styling.border_top_thickness' => '2',
            'header.mobile.light.styling.icon_color' => '',
            'header.mobile.light.styling.first_dropdown_background' => '#f0f4f7',
            'header.mobile.light.styling.second_dropdown_background' => '#fbfbfb',
            'header.mobile.light.styling.text_color' => '#272f39',
            'header.mobile.light.styling.text_hover_color' => '',
            'header.mobile.light.styling.separators_color' => '#dedede',
            'header.mobile.light.styling.search_input_color' => '#ffffff',
            'header.mobile.light.styling.search_text_color' => '#051e29',
            'header.mobile.light.styling.topbar_background_color' => '#ffffff',

            'header.mobile.dark.styling.background_color' => '#22282f',
            'header.mobile.dark.styling.border_top_color' => '',
            'header.mobile.dark.styling.border_top_thickness' => '2',
            'header.mobile.dark.styling.icon_color' => '',
            'header.mobile.dark.styling.first_dropdown_background' => '#272f39',
            'header.mobile.dark.styling.second_dropdown_background' => '#2c3541',
            'header.mobile.dark.styling.text_color' => '#ffffff',
            'header.mobile.dark.styling.text_hover_color' => '',
            'header.mobile.dark.styling.separators_color' => 'rgba(255,255,255,0.1)',
            'header.mobile.dark.styling.search_input_color' => '#ffffff',
            'header.mobile.dark.styling.search_text_color' => '#272f39',
            'header.mobile.dark.styling.topbar_background_color' => '#22282f',


            'pagetitle.page_title_settings.page_title_area' => 'true',
            'pagetitle.page_title_settings.page_title_area_skin' => '', //theme_skin
            'pagetitle.page_title_settings.page_title_area_height' => '510',
            'pagetitle.page_title_settings.page_title_area_content_align' => 'left',
            'pagetitle.page_title_background.pt_background_parallax' => 'false',
            'pagetitle.page_title_settings.breadcrumbs_area' => 'false',
            'pagetitle.page_title_settings.breadcrumbs_position' => 'bottom',
            'pagetitle.page_title_settings.breadcrumbs_mobile' => 'false',

            'pagetitle.page_title_background.page_title_area_background' => '', //theme-skin

            'pagetitle.page_title_background.pt_background_color' => '#92A0B1',
            'pagetitle.page_title_background.pt_background_color_overlay' => 'none',
            'pagetitle.page_title_background.pt_background_color_overlay_color' => '',
            'pagetitle.page_title_background.pt_background_color_pattern' => 'small_dense_dots',
            'pagetitle.page_title_background.pt_background_color_pattern_color' => '#3a3a3a',

            'pagetitle.page_title_background.pt_background_upload_image' => '',
            'pagetitle.page_title_background.pt_background_cover' => 'true',
            'pagetitle.page_title_background.pt_background_image_position' => 'left_top',
            'pagetitle.page_title_background.pt_background_image_repeat' => 'no_repeat',
            'pagetitle.page_title_background.pt_background_motion' => 'scroll',
            'pagetitle.page_title_background.pt_background_moving_speed' => '1',
            'pagetitle.page_title_background.pt_background_image_overlay' => 'none',
            'pagetitle.page_title_background.pt_background_image_overlay_color' => '',
            'pagetitle.page_title_background.pt_background_image_overlay_pattern' => 'small_dense_dots',
            'pagetitle.page_title_background.pt_background_image_overlay_pattern_color' => '#3a3a3a',

            'pagetitle.page_title_background.pt_background_video_platform' => 'youtube',
            'pagetitle.page_title_background.pt_background_youtube' => '',
            'pagetitle.page_title_background.pt_background_mp4' => '',
            'pagetitle.page_title_background.pt_background_webm' => '',
            'pagetitle.page_title_background.pt_background_fallback_image' => '',
            'pagetitle.page_title_background.pt_background_video_overlay' => 'none',
            'pagetitle.page_title_background.pt_background_video_overlay_color' => '',
            'pagetitle.page_title_background.pt_background_video_overlay_pattern' => 'small_dense_dots',
            'pagetitle.page_title_background.pt_background_video_overlay_pattern_color' => '#3a3a3a',

            'pagetitle.page_title_fonts.pt_title_font_size' => '45',
            'pagetitle.page_title_fonts.pt_title_line_height' => '1.3',
            'pagetitle.page_title_fonts.pt_title_font_family' => '', //global_font
            'pagetitle.page_title_fonts.pt_title_font_weight' => 'regular',
            'pagetitle.page_title_fonts.pt_title_letter_spacing' => '0.5px',
            'pagetitle.page_title_fonts.pt_title_text_transform' => 'none',
            'pagetitle.page_title_fonts.pt_subtitle_font_size' => '20',
            'pagetitle.page_title_fonts.pt_subtitle_line_height' => '1.5',
            'pagetitle.page_title_fonts.pt_subtitle_font_family' => '', //global_font
            'pagetitle.page_title_fonts.pt_subtitle_font_weight' => 'regular',
            'pagetitle.page_title_fonts.pt_subtitle_letter_spacing' => '',
            'pagetitle.page_title_fonts.pt_subtitle_text_transform' => 'none',
            'pagetitle.page_title_fonts.pt_breadcrumbs_font_size' => '13',
            'pagetitle.page_title_fonts.pt_breadcrumbs_line_height' => '1.692',
            'pagetitle.page_title_fonts.pt_breadcrumbs_font_family' => '', //global_font
            'pagetitle.page_title_fonts.pt_breadcrumbs_font_weight' => 'regular',
            'pagetitle.page_title_fonts.pt_breadcrumbs_letter_spacing' => '',
            'pagetitle.page_title_fonts.pt_breadcrumbs_text_transform' => 'none',

            'pagetitle.page_title_coloring.pt_light_title_color' => '#ffffff',
            'pagetitle.page_title_coloring.pt_light_subtitle_color' => '#ffffff',
            'pagetitle.page_title_coloring.pt_light_b_text_color' => '#ffffff',
            'pagetitle.page_title_coloring.pt_light_b_text_accent_color' => '', // accent_color
            'pagetitle.page_title_coloring.pt_light_b_background_color' => 'rgba(255,255,255,0.02)',
            'pagetitle.page_title_coloring.pt_light_b_border_color' => 'rgba(255,255,255, 0.2)',
            'pagetitle.page_title_coloring.pt_dark_title_color' => '#272f39',
            'pagetitle.page_title_coloring.pt_dark_subtitle_color' => '#272f39',
            'pagetitle.page_title_coloring.pt_dark_b_text_color' => '#272f39',
            'pagetitle.page_title_coloring.pt_dark_b_text_accent_color' => '', // accent_color
            'pagetitle.page_title_coloring.pt_dark_b_background_color' => 'rgba(14,65,73,0.02)',
            'pagetitle.page_title_coloring.pt_dark_b_border_color' => 'rgba(39,47,57,0.27)',

            'shortcodes.shortcodes_coloring.sc_colored_light_accent_color' => '',
            'shortcodes.shortcodes_coloring.sc_colored_light_title_color' => '#272f39',
            'shortcodes.shortcodes_coloring.sc_colored_light_text_color' => '#57606c',
            'shortcodes.shortcodes_coloring.sc_colored_light_icon_color' => '#272f39',
            'shortcodes.shortcodes_coloring.sc_colored_light_background_color' => '#ffffff',
            'shortcodes.shortcodes_coloring.sc_colored_light_alternative_title_color' => '#ffffff',

            'shortcodes.shortcodes_coloring.sc_colored_dark_accent_color' => '',
            'shortcodes.shortcodes_coloring.sc_colored_dark_title_color' => '#ffffff',
            'shortcodes.shortcodes_coloring.sc_colored_dark_text_color' => '#7b8695',
            'shortcodes.shortcodes_coloring.sc_colored_dark_icon_color' => '#ffffff',
            'shortcodes.shortcodes_coloring.sc_colored_dark_background_color' => '#272f39',
            'shortcodes.shortcodes_coloring.sc_colored_dark_alternative_title_color' => '#ffffff',

            'shortcodes.shortcodes_coloring.sc_transparent_light_accent_color' => '',
            'shortcodes.shortcodes_coloring.sc_transparent_light_title_color' => '#ffffff',
            'shortcodes.shortcodes_coloring.sc_transparent_light_text_color' => '#ffffff',
            'shortcodes.shortcodes_coloring.sc_transparent_light_icon_color' => '#ffffff',

            'shortcodes.shortcodes_coloring.sc_transparent_dark_accent_color' => '',
            'shortcodes.shortcodes_coloring.sc_transparent_dark_title_color' => '#272f39',
            'shortcodes.shortcodes_coloring.sc_transparent_dark_text_color' => '#57606c',
            'shortcodes.shortcodes_coloring.sc_transparent_dark_icon_color' => '#272f39',

            'shortcodes.button_radius.button_default_radius' => 'small',
            'shortcodes.button_radius.button_radius_small' => '5',
            'shortcodes.button_radius.button_radius_big' => '50',
            
            'shortcodes.button_font.button_font_family' => '', // global_font
            'shortcodes.button_font.button_font_weight' => 'regular', 
            'shortcodes.button_font.button_letter_spacing' => '', 
            'shortcodes.button_font.button_text_transform' => 'none', 

            'footer.footer_settings.footer_on' => 'true',
            'footer.footer_settings.footer_type' => 'standard',
            'footer.footer_settings.standard_footer_skin' => '', // theme_skin
            'footer.footer_settings.copywrite_area_on' => 'true',
            'footer.footer_settings.copyright_skin' => '', // theme_skin
            'footer.footer_settings.copyright_paddings' => '20',
            'footer.footer_settings.copyright_text' => 'Created by <a href="http://ideothemes.com" target="_blank" style="font-size: 13px; text-decoration: none;"> IdeoThemes</a>',
            'footer.footer_settings.copyright_text_align' => 'center',
            'footer.footer_settings.choose_advanced_footer' => '',
            'footer.footer_settings.sticky_footer' => 'false',

            'footer.standard_footer_layout.footer_layout' => 'in_grid',
            'footer.standard_footer_layout.footer_custom_layout' => '1170',
            'footer.standard_footer_layout.footer_columns' => '33_34_33',
            'footer.standard_footer_layout.footer_padding_top' => '50',
            'footer.standard_footer_layout.footer_padding_bottom' => '50',

            'footer.standard_footer_background.footer_background_type' => '',
            'footer.standard_footer_background.footer_background_color' => '#272F39',
            'footer.standard_footer_background.footer_background_color_overlay' => 'none',
            'footer.standard_footer_background.footer_background_color_overlay_color' => '',
            'footer.standard_footer_background.footer_background_color_pattern' => 'small_dense_dots',
            'footer.standard_footer_background.footer_background_color_pattern_color' => '#000000',
            
            'footer.standard_footer_background.footer_background_upload_image' => '',
            'footer.standard_footer_background.footer_background_cover' => 'true',
            'footer.standard_footer_background.footer_background_image_position' => 'left_top',
            'footer.standard_footer_background.footer_background_image_repeat' => 'no_repeat',
            'footer.standard_footer_background.footer_background_image_overlay' => 'none',
            'footer.standard_footer_background.footer_background_image_overlay_color' => '',
            'footer.standard_footer_background.footer_background_image_overlay_pattern' => 'small_dense_dots',
            'footer.standard_footer_background.footer_background_image_overlay_pattern_color' => '#000000',

            'footer.standard_footer_coloring.footer_light_accent_color' => '', // accent_color
            'footer.standard_footer_coloring.footer_light_widgets_title_color' => '#ffffff',
            'footer.standard_footer_coloring.footer_light_widgets_text_color' => '#f0f0f0',
            'footer.standard_footer_coloring.footer_dark_accent_color' => '', // accent_color
            'footer.standard_footer_coloring.footer_dark_widgets_title_color' => '#272f39',
            'footer.standard_footer_coloring.footer_dark_widgets_text_color' => '#57606c',

            'footer.widgets_title_font.widget_title_font_size' => '15',
            'footer.widgets_title_font.widget_title_line_height' => '1.8em',
            'footer.widgets_title_font.widget_title_font_family' => '', // global_font
            'footer.widgets_title_font.widget_title_font_weight' => 'regular',
            'footer.widgets_title_font.widget_title_letter_spacing' => '',

            'footer.copyrights_coloring.copyrights_light_background_color' => '#20262C',
            'footer.copyrights_coloring.copyrights_light_text_color' => '#ffffff',
            'footer.copyrights_coloring.copyrights_dark_background_color' => '#20262C',
            'footer.copyrights_coloring.copyrights_dark_text_color' => '#ffffff',

            'footer.copyrights_font.copyrights_font_size' => '13',
            'footer.copyrights_font.copyrights_line_height' => '1.833em',
            'footer.copyrights_font.copyrights_font_family' => '', // global_font
            'footer.copyrights_font.copyrights_font_weight' => 'regular',
            'footer.copyrights_font.copyrights_letter_spacing' => '',


            'sidebar.sidebar_settings.sidebar_global' => 'right_sidebar',
            'sidebar.sidebar_settings.sidebar_choose' => 'sidebar-1',
            'sidebar.sidebar_settings.sidebar_skin' => '', //theme_skin

            'sidebar.sidebar_coloring.sidebar_light_accent_color' => '', // accent_color
            'sidebar.sidebar_coloring.sidebar_light_titles_color' => '#ffffff',
            'sidebar.sidebar_coloring.sidebar_light_text_color' => '#f0f0f0',

            'sidebar.sidebar_coloring.sidebar_dark_accent_color' => '', // accent_color
            'sidebar.sidebar_coloring.sidebar_dark_titles_color' => '#272f39',
            'sidebar.sidebar_coloring.sidebar_dark_text_color' => '#57606c',

            'sidebar.sidebar_widgets_title_font.sidebar_title_font_size' => '15',
            'sidebar.sidebar_widgets_title_font.sidebar_title_line_height' => '1.8em',
            'sidebar.sidebar_widgets_title_font.sidebar_title_font_family' => '', // global_font
            'sidebar.sidebar_widgets_title_font.sidebar_title_font_weight' => 'regular',
            'sidebar.sidebar_widgets_title_font.sidebar_title_letter_spacing' => '',


            'blog.blog_settings.blog_hide_authors' => 'true',
            'blog.blog_settings.blog_hide_comments' => 'true',
            'blog.blog_settings.blog_hide_date' => 'true',
            'blog.blog_settings.blog_hide_tags' => 'true',
            'blog.blog_settings.blog_hide_categories' => 'true',

            'blog.blog_single.blog_sidebar' => 'right_sidebar',
            'blog.blog_single.blog_sidebar_choose' => '',
            'blog.blog_single.blog_single_navigation' => 'true',
            'blog.blog_single.blog_single_featured_image' => 'true',
            'blog.blog_single.blog_single_post_title' => 'true',
            'blog.blog_single.blog_single_meta' => 'true',
            'blog.blog_single.blog_single_related_posts' => 'true',
            'blog.blog_single.blog_single_socials' => 'true',
            'blog.blog_single.blog_single_facebook' => '1',
            'blog.blog_single.blog_single_twitter' => '1',
            'blog.blog_single.blog_single_google' => '1',
            'blog.blog_single.blog_single_pinterest' => '0',
            'blog.blog_single.blog_single_reddit' => '0',
            'blog.blog_single.blog_single_linkedin' => '1',
            'blog.blog_single.blog_single_tumblr' => '0',
            'blog.blog_single.blog_single_vk' => '0',
            'blog.blog_single.blog_single_email' => '0',

            'blog.blog_archives.blog_archives_layout' => 'masonry',
            'blog.blog_archives.blog_archives_masonry_blocks' => '2',
            'blog.blog_archives.blog_archives_sidebar' => 'right_sidebar',
            'blog.blog_archives.blog_archives_sidebar_choose' => '',
            'blog.blog_archives.blog_archives_pt' => '',
            'blog.blog_archives.blog_archives_posts_per_page' => '9',
            'blog.blog_archives.blog_archives_pagination' => 'load_more',
            'blog.blog_archives.blog_archives_excerpt_words' => '55',
            'blog.blog_archives.blog_archives_meta' => 'false',
            'blog.blog_archives.blog_archives_socials' => 'true',
            'blog.blog_archives.blog_archives_facebook' => '0',
            'blog.blog_archives.blog_archives_twitter' => '0',
            'blog.blog_archives.blog_archives_google' => '0',
            'blog.blog_archives.blog_archives_pinterest' => '0',
            'blog.blog_archives.blog_archives_reddit' => '0',
            'blog.blog_archives.blog_archives_linkedin' => '0',
            'blog.blog_archives.blog_archives_tumblr' => '0',
            'blog.blog_archives.blog_archives_vk' => '0',
            'blog.blog_archives.blog_archives_email' => '0',
            'blog.blog_archives.blog_archives_authors' => 'false',
            'blog.blog_archives.blog_archives_comments' => 'true',
            'blog.blog_archives.blog_archives_date' => 'true',
            'blog.blog_archives.blog_archives_tags' => 'false',
            'blog.blog_archives.blog_archives_categories' => 'true',
            'blog.blog_archives.blog_archives_block_distance' => '30',

            'blog.blog_search.blog_search_sidebar' => 'right_sidebar',
            'blog.blog_search.blog_search_sidebar_choose' => '',
            'blog.blog_search.blog_search_posts_per_page' => '9',
            'blog.blog_search.blog_search_excerpt_words' => '55',
            'blog.blog_search.blog_search_pagination' => 'load_more',
            'blog.blog_search.blog_search_pt' => '',
            'blog.blog_search.blog_search_featured_image' => 'true',
            'blog.blog_search.blog_search_meta_date' => 'true',
            'blog.blog_search.blog_search_meta_author' => 'true',


            'portfolio.portfolio_settings.main_page' => '',
            'portfolio.portfolio_settings.slug' => '',

            'portfolio.portfolio_standard_card.navigation' => 'true',
            'portfolio.portfolio_standard_card.social_media_share' => 'true',
            'portfolio.portfolio_standard_card.facebook' => 'true',
            'portfolio.portfolio_standard_card.twitter' => 'true',
            'portfolio.portfolio_standard_card.google' => 'true',
            'portfolio.portfolio_standard_card.reddit' => 'false',
            'portfolio.portfolio_standard_card.linkedin' => 'true',
            'portfolio.portfolio_standard_card.tumblr' => 'false',
            'portfolio.portfolio_standard_card.pinterest' => 'true',
            'portfolio.portfolio_standard_card.vk' => 'false',
            'portfolio.portfolio_standard_card.email' => 'true',

            'portfolio.portfolio_navigation.enabled' => 'true',
            'portfolio.portfolio_navigation.background_color' => '',
            'portfolio.portfolio_navigation.border_top_color' => '',
            'portfolio.portfolio_navigation.border_bottom_color' => '',
            'portfolio.portfolio_navigation.text_color' => '',
            'portfolio.portfolio_navigation.accent_color' => '',

            'social_media.social_media_profiles.behance' => '#',
            'social_media.social_media_profiles.dribbble' => '',
            'social_media.social_media_profiles.facebook' => '',
            'social_media.social_media_profiles.flickr' => '',
            'social_media.social_media_profiles.google' => '',
            'social_media.social_media_profiles.istagram' => '',
            'social_media.social_media_profiles.linkedin' => '#',
            'social_media.social_media_profiles.pinterest' => '',
            'social_media.social_media_profiles.reddit' => '',
            'social_media.social_media_profiles.skype' => '',
            'social_media.social_media_profiles.soundcloud' => '',
            'social_media.social_media_profiles.tumblr' => '',
            'social_media.social_media_profiles.twitter' => '',
            'social_media.social_media_profiles.vimeo' => '',
            'social_media.social_media_profiles.vk' => '',
            'social_media.social_media_profiles.xing' => '',
            'social_media.social_media_profiles.youtube' => '#',


            'lightbox.lightbox_settings.lightbox_text_align' => 'left',
            'lightbox.lightbox_settings.lightbox_entry_animation' => 'zoom-in',

            'lightbox.lightbox_coloring.lightbox_overlay_color' => 'rgba(0, 0, 0, 0.8)',
            'lightbox.lightbox_coloring.lightbox_text_and_nav_color' => '#f0f0f0',


            'advanced.advanced_loading.advanced_sticky_loading' => 'true',
            'advanced.advanced_loading.transition_in' => 'fade-in',
            'advanced.advanced_loading.transition_out' => 'fade-out',
            'advanced.advanced_loading.logo' => IDEOTHEMO_INIT_DIR_URI . '/assets/images/logo.png',
            'advanced.advanced_loading.logo_retina' => IDEOTHEMO_INIT_DIR_URI . '/assets/images/logo-retina.png',
            'advanced.advanced_loading.advanced_loader' => 'ball-scale-multiple',
            'advanced.advanced_loading.advanced_loader_background_color' => '',
            'advanced.advanced_loading.advanced_loader_color' => '',

            'advanced.advanced_backtotop.advanced_backtotop_button' => 'true',
            'advanced.advanced_backtotop.scroll_speed' => '500',
            'advanced.advanced_backtotop.advanced_backtotop_radius' => '50',
            'advanced.advanced_backtotop.advanced_backtotop_background_color' => '#3a3a3a',
            'advanced.advanced_backtotop.advanced_backtotop_background_hover_color' => '', //default accent_color
            'advanced.advanced_backtotop.advanced_backtotop_icon_color' => '#ffffff',
            'advanced.advanced_backtotop.advanced_backtotop_icon_hover_color' => '#ffffff',

            'advanced.advanced_specyfic.advanced_404_choose' => '',

            'advanced.advanced_onepage.scroll_speed' => '500',

            'advanced.advanced_open_graph.open_graph' => 'true',

            'advanced.advanced_viewport.disable_on_mobile' => 'true'


        );

        return isset($settings[$option_name]) ? $settings[$option_name] : '';
    }
}