<?php

if (!function_exists('ideothemo_get_global_font')) {
    function ideothemo_get_global_font()
    {
        return ideothemo_get_theme_mod_parse('fonts.body_font_settings.body_font_family');
    }
}

if (!function_exists('ideothemo_get_global_font_extension')) {
    function ideothemo_get_global_font_extension()
    {
        return ideothemo_get_theme_mod_parse('fonts.font_family.global_font_extension');
    }
}

if (!function_exists('ideothemo_get_body_font_size')) {
    function ideothemo_get_body_font_size()
    {
        return ideothemo_get_theme_mod_parse('fonts.body_font_settings.body_font_size');
    }
}

if (!function_exists('ideothemo_get_body_font_weight')) {
    function ideothemo_get_body_font_weight()
    {
        return ideothemo_get_theme_mod_parse('fonts.body_font_settings.body_font_weight');
    }
}

if (!function_exists('ideothemo_get_body_line_height')) {
    function ideothemo_get_body_line_height()
    {
        return ideothemo_get_theme_mod_parse('fonts.body_font_settings.body_line_height');
    }
}

if (!function_exists('ideothemo_get_body_letter_spacing')) {
    function ideothemo_get_body_letter_spacing()
    {
        return apply_filters('ideothemo_letter_spacing',ideothemo_get_theme_mod_parse('fonts.body_font_settings.body_letter_spacing'));
    }
}

if (!function_exists('ideothemo_get_google_fonts')) {
    function ideothemo_get_google_fonts()
    {        
        $webfonts = ideothemo_get_contents( IDEOTHEMO_INIT_DIR . 'assets/json/webfonts.json');
        return json_decode($webfonts, true);
    }
}

if (!function_exists('ideothemo_get_google_fonts_as_options')) {
    function ideothemo_get_google_fonts_as_options($default = false)
    {
        $webfonts = ideothemo_get_google_fonts();
        $fonts = array();

        if ($default) {
            $fonts['default'] = is_string($default) ? $default : esc_html__('Default', 'themo');
        }

        foreach ($webfonts['items'] as $item) {
            $fonts[$item['family']] = $item['family'];
        }

        return $fonts;
    }
}

if (!function_exists('ideothemo_get_google_fonts_subsets')) {
    function ideothemo_get_google_fonts_subsets($default = true)
    {
        $subsets = array();

        if ($default) {
            $subsets[''] = is_string($default) ? $default : esc_html__('Default', 'themo');
        }

        $subsets["arabic"] = "Arabic";
        $subsets["cyrillic"] = "Cyrillic";
        $subsets["cyrillic-ext"] = "Cyrillic Extended";
        $subsets["devanagari"] = "Devanagari";
        $subsets["greek"] = "Greek";
        $subsets["greek-ext"] = "Greek Extended";
        $subsets["hebrew"] = "Hebrew";
        $subsets["khmer"] = "Khmer";
        $subsets["latin"] = 'Latin';
        $subsets["latin-ext"] = "Latin Extended";
        $subsets["telugu"] = "Telugu";
        $subsets["vietnamese"] = "Vietnamese";

        return $subsets;
    }
}

if (!function_exists('ideothemo_get_google_fonts_variants')) {
    function ideothemo_get_google_fonts_variants($default = false)
    {
        $variants = array();

        if ($default) {
            $variants[''] = is_string($default) ? $default : esc_html__('Default', 'themo');
        }

        $variants['100'] = esc_html__('Thin (100)', 'themo');
        $variants['100italic'] = esc_html__('Thin italic(100)', 'themo');
        $variants['200'] = esc_html__('Extra light (200)', 'themo');
        $variants['200italic'] = esc_html__('Extra light italic (200)', 'themo');
        $variants['300'] = esc_html__('Light (300)', 'themo');
        $variants['300italic'] = esc_html__('Light italic (300)', 'themo');
        $variants['regular'] = esc_html__('Normal (400)', 'themo');
        $variants['italic'] = esc_html__('Normal italic (400)', 'themo');
        $variants['500'] = esc_html__('Medium (500)', 'themo');
        $variants['500italic'] = esc_html__('Medium italic (500)', 'themo');
        $variants['600'] = esc_html__('Semi bold (600)', 'themo');
        $variants['700'] = esc_html__('Bold (700)', 'themo');
        $variants['700italic'] = esc_html__('Bold italic (700)', 'themo');
        $variants['800'] = esc_html__('Extra bold (800)', 'themo');
        $variants['800italic'] = esc_html__('Extra bold italic (800)', 'themo');
        $variants['900'] = esc_html__('Ultra bold (900)', 'themo');
        $variants['900italic'] = esc_html__('Ultra bold italic (900)', 'themo');

        return $variants;
    }
}

if (!function_exists('ideothemo_get_font_weight')) {
    function ideothemo_get_font_weight($weight)
    {
        if($weight == 'italic') return $weight;
        
        return str_replace('italic','', $weight);
    }
}

if (!function_exists('ideothemo_font_is_italic')) {
    function ideothemo_font_is_italic($style)
    {
        return (int)!(stripos($style, 'italic') === false);
    }
}

if (!function_exists('ideothemo_get_font_family_tag')) {
    function ideothemo_get_font_family_tag($tag, $default = null)
    {
        if (!empty($default)) {
            return ideothemo_blog_get_option($default, ideothemo_get_theme_mod_parse('fonts.text_tag_settings.' . $tag . '_font_family'));
        }

        return apply_filters('ideothemo_font_family', ideothemo_blog_get_option(ideothemo_get_global_font(), ideothemo_get_theme_mod_parse('fonts.text_tag_settings.' . $tag . '_font_family')));
    }
}

if (!function_exists('ideothemo_get_font_extension_tag')) {
    function ideothemo_get_font_extension_tag($tag)
    {
        return ideothemo_blog_get_option(ideothemo_get_global_font_extension(), ideothemo_get_theme_mod_parse('fonts.text_tag_settings.' . $tag . '_font_extension'));
    }
}

if (!function_exists('ideothemo_get_font_size_tag')) {
    function ideothemo_get_font_size_tag($tag)
    {
        return ideothemo_get_theme_mod_parse('fonts.text_tag_settings.' . $tag . '_font_size');
    }
}

if (!function_exists('ideothemo_get_font_line_height_tag')) {
    function ideothemo_get_font_line_height_tag($tag)
    {
        return ideothemo_get_theme_mod_parse('fonts.text_tag_settings.' . $tag . '_line_height');
    }
}

if (!function_exists('ideothemo_get_font_weight_tag')) {
    function ideothemo_get_font_weight_tag($tag)
    {
        return ideothemo_get_theme_mod_parse('fonts.text_tag_settings.' . $tag . '_font_weight');
    }
}

if (!function_exists('ideothemo_get_font_letter_spacing_tag')) {
    function ideothemo_get_font_letter_spacing_tag($tag)
    {
        return apply_filters('ideothemo_letter_spacing', ideothemo_get_theme_mod_parse('fonts.text_tag_settings.' . $tag . '_letter_spacing'));
    }
}

if (!function_exists('ideothemo_get_font_text_transform_tag')) {
    function ideothemo_get_font_text_transform_tag($tag)
    {
        return ideothemo_get_theme_mod_parse('fonts.text_tag_settings.' . $tag . '_text_transform');
    }
}

if (!function_exists('ideothemo_get_font_text_decoration_tag')) {
    function ideothemo_get_font_text_decoration_tag($tag)
    {
        return ideothemo_get_theme_mod_parse('fonts.text_tag_settings.' . $tag . '_text_decoration');
    }
}

if (!function_exists('ideothemo_get_font_style_tag')) {
    function ideothemo_get_font_style_tag($tag)
    {
        return ideothemo_get_theme_mod_parse('fonts.text_tag_settings.' . $tag . '_font_style');
    }
}
if (!function_exists('ideothemo_get_font_extension')) {
    function ideothemo_get_font_extension()
    {
        return ideothemo_get_theme_mod_parse('fonts.font_family.global_font_extension');
    }
}

if (!function_exists('ideothemo_font_weight_parser')) {
    function ideothemo_font_weight_parser($weight)
    {
        if (in_array($weight, array('regular', 'italic'))) {
            $weight = 400;
        }

        return (int)$weight;
    }
}

if (!function_exists('ideothemo_font_style_parser')) {
    function ideothemo_font_style_parser($weight)
    {
        if (strstr($weight, 'italic'))
            return 'italic';

        return 'normal';
    }
}

if (!function_exists('ideothemo_font_italic_tag_enabled')) {
    function ideothemo_font_italic_tag_enabled($tag)
    {
        return ideothemo_font_is_italic(ideothemo_get_font_weight_tag($tag));
    }
}

if (!function_exists('ideothemo_get_body_font_skin')) {
    function ideothemo_get_body_font_skin($useLocal = false)
    {
        $skin = ideothemo_get_page_setting('fonts.font_coloring.body_text_skin', $useLocal);

        if ($skin == 'default') {
            if (ideothemo_get_theme_mod_parse('generals.styling.theme_skin') == 'dark')
                return 'font-light';

            return 'font-dark';
        }

        return 'font-' . $skin;
    }
}

/** WIDGET TITLE FONT */

if (!function_exists('ideothemo_get_widget_title_font_family')) {
    function ideothemo_get_widget_title_font_family($useLocal = false)
    {
        return apply_filters('ideothemo_font_family', ideothemo_blog_get_option(ideothemo_get_global_font(), ideothemo_get_footer_setting('footer.widgets_title_font.widget_title_font_family', $useLocal)));
    }
}

if (!function_exists('ideothemo_get_widget_title_font_weight')) {
    function ideothemo_get_widget_title_font_weight()
    {
        return ideothemo_get_theme_mod_parse('footer.widgets_title_font.widget_title_font_weight');
    }
}

/** SIDEBAR TITLE */

if (!function_exists('ideothemo_sidebar_title_font_family')) {
    function ideothemo_get_sidebar_title_font_family()
    {
        return apply_filters('ideothemo_font_family', ideothemo_blog_get_option(ideothemo_get_global_font(), ideothemo_get_sidebar_title_font('font_family')));
    }
}

if (!function_exists('ideothemo_sidebar_title_font_weight')) {
    function ideothemo_get_sidebar_title_font_weight()
    {
        return ideothemo_get_font_weight(ideothemo_get_sidebar_title_font('font_weight'));
    }
}

/** COPYRIGHT */

if (!function_exists('ideothemo_get_copyright_font_family')) {
    function ideothemo_get_copyright_font_family($useLocal = false)
    {
        return apply_filters('ideothemo_font_family', ideothemo_blog_get_option(ideothemo_get_global_font(), ideothemo_get_copyright_fonts('font_family', $useLocal)));
    }
}

if (!function_exists('ideothemo_get_copyright_font_weight')) {
    function ideothemo_get_copyright_font_weight()
    {
        return ideothemo_get_copyright_fonts('font_weight');
    }
}

/** PAGE TITLE */

if (!function_exists('ideothemo_get_pagetitle_font_family')) {
    function ideothemo_get_pagetitle_font_family()
    {
        return ideothemo_get_theme_mod_parse('pagetitle.page_title_fonts.pt_title_font_family');
    }
}

if (!function_exists('ideothemo_get_pagetitle_font_weight')) {
    function ideothemo_get_pagetitle_font_weight()
    {
        return ideothemo_get_theme_mod_parse('pagetitle.page_title_fonts.pt_title_font_weight');
    }
}

/** PAGE TITLE SUBTITLE */

if (!function_exists('ideothemo_get_pagetitle_subtitle_font_family')) {
    function ideothemo_get_pagetitle_subtitle_font_family()
    {
        return ideothemo_get_theme_mod_parse('pagetitle.page_title_fonts.pt_subtitle_font_family');
    }
}

if (!function_exists('ideothemo_get_pagetitle_subtitle_font_weight')) {
    function ideothemo_get_pagetitle_subtitle_font_weight()
    {
        return ideothemo_get_theme_mod_parse('pagetitle.page_title_fonts.pt_title_font_weight');
    }
}

/** PAGE TITLE BREADCRUMBS*/

if (!function_exists('ideothemo_get_pagetitle_breadcrumbs_font_family')) {
    function ideothemo_get_pagetitle_breadcrumbs_font_family()
    {
        return ideothemo_get_theme_mod_parse('pagetitle.page_title_fonts.pt_breadcrumbs_font_family');
    }
}

if (!function_exists('ideothemo_get_pagetitle_breadcrumbs_font_weight')) {
    function ideothemo_get_pagetitle_breadcrumbs_font_weight()
    {
        return ideothemo_get_theme_mod_parse('pagetitle.page_title_fonts.pt_breadcrumbs_font_weight');
    }
}

/** HEADER MAIN MENU */

if (!function_exists('ideothemo_get_header_main_menu_font_family')) {
    function ideothemo_get_header_main_menu_font_family()
    {
        return apply_filters('ideothemo_font_family', ideothemo_get_header_font_setting('main_menu', 'font_family'));
    }
}

if (!function_exists('ideothemo_get_header_main_menu_font_weight')) {
    function ideothemo_get_header_main_menu_font_weight()
    {
        return ideothemo_get_header_font_setting('main_menu', 'font_weight');
    }
}

/** HEADER SUBMENU */

if (!function_exists('ideothemo_get_header_submenu_font_family')) {
    function ideothemo_get_header_submenu_font_family()
    {
        return apply_filters('ideothemo_font_family', ideothemo_get_header_font_setting('submenu', 'font_family'));
    }
}

if (!function_exists('ideothemo_get_header_submenu_font_weight')) {
    function ideothemo_get_header_submenu_font_weight()
    {
        return ideothemo_get_header_font_setting('submenu', 'font_weight');
    }
}

/** HEADER MEGA MENU */

if (!function_exists('ideothemo_get_header_mega_menu_font_family')) {
    function ideothemo_get_header_mega_menu_font_family()
    {
        return apply_filters('ideothemo_font_family', ideothemo_get_header_font_setting('mega_menu', 'font_family'));
    }
}

if (!function_exists('ideothemo_get_header_mega_menu_font_weight')) {
    function ideothemo_get_header_mega_menu_font_weight()
    {
        return ideothemo_get_header_font_setting('mega_menu', 'font_weight');
    }
}

/** HEADER MEGA MENU COLUMN TITLE */

if (!function_exists('ideothemo_get_header_mega_menu_column_title_font_family')) {
    function ideothemo_get_header_mega_menu_column_title_font_family()
    {
        return apply_filters('ideothemo_font_family', ideothemo_get_header_font_setting('mega_menu_column_title', 'font_family'));
    }
}

if (!function_exists('ideothemo_get_header_mega_menu_column_title_font_weight')) {
    function ideothemo_get_header_mega_menu_column_title_font_weight()
    {
        return ideothemo_get_header_font_setting('mega_menu_column_title', 'font_weight');
    }
}

/** HEADER SIDE MENU */

if (!function_exists('ideothemo_get_header_side_menu_font_family')) {
    function ideothemo_get_header_side_menu_font_family()
    {
        return apply_filters('ideothemo_font_family', ideothemo_get_header_font_setting('side_menu', 'font_family'));
    }
}

if (!function_exists('ideothemo_get_header_side_menu_font_weight')) {
    function ideothemo_get_header_side_menu_font_weight()
    {
        return ideothemo_get_header_font_setting('side_menu', 'font_weight');
    }
}

/** HEADER SIDE MENU SUBMENU */

if (!function_exists('ideothemo_get_header_side_menu_submenu_font_family')) {
    function ideothemo_get_header_side_menu_submenu_font_family()
    {
        return apply_filters('ideothemo_font_family', ideothemo_get_header_font_setting('side_menu_submenu', 'font_family'));
    }
}

if (!function_exists('ideothemo_get_header_side_menu_submenu_font_weight')) {
    function ideothemo_get_header_side_menu_submenu_font_weight()
    {
        return ideothemo_get_header_font_setting('side_menu_submenu', 'font_weight');
    }
}

/** HEADER MOBILE MENU */

if (!function_exists('ideothemo_get_header_mobile_menu_font_family')) {
    function ideothemo_get_header_mobile_menu_font_family()
    {
        return apply_filters('ideothemo_font_family', ideothemo_get_header_font_setting('mobile_menu', 'font_family'));
    }
}

if (!function_exists('ideothemo_get_header_mobile_menu_font_weight')) {
    function ideothemo_get_header_mobile_menu_font_weight()
    {
        return ideothemo_get_header_font_setting('mobile_menu', 'font_weight');
    }
}

/** BUTTON */

if (!function_exists('ideothemo_get_button_font_family')) {
    function ideothemo_get_button_font_family()
    {
        return ideothemo_get_theme_mod_parse('shortcodes.button_font.button_font_family');
    }
}

if (!function_exists('ideothemo_get_button_font_weight')) {
    function ideothemo_get_button_font_weight()
    {
        return ideothemo_get_theme_mod_parse('shortcodes.button_font.button_font_weight');
    }
}