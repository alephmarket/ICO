<?php
function ideothemo_getGeneralColorOption()
{
    $setting_transparent_light = array(
        'general_style_transparent_light_accent_setting',
        'general_style_transparent_light_title_setting',
        'general_style_transparent_light_text_setting',
        'general_style_transparent_light_icon_setting',
        'general_style_transparent_light_background_setting',
        'general_style_transparent_light_active_title_setting',
    );
    $setting_transparent_dark = array(
        'general_style_transparent_dark_accent_setting',
        'general_style_transparent_dark_title_setting',
        'general_style_transparent_dark_text_setting',
        'general_style_transparent_dark_icon_setting',
        'general_style_transparent_dark_background_setting',
        'general_style_transparent_dark_active_title_setting',
    );
    $setting_color_light = array(
        'general_style_color_light_accent_setting',
        'general_style_color_light_title_setting',
        'general_style_color_light_text_setting',
        'general_style_color_light_icon_setting',
        'general_style_color_light_background_setting',
        'general_style_color_light_active_title_setting',
    );
    $setting_color_dark = array(
        'general_style_color_dark_accent_setting',
        'general_style_color_dark_title_setting',
        'general_style_color_dark_text_setting',
        'general_style_color_dark_icon_setting',
        'general_style_color_dark_background_setting',
        'general_style_color_dark_active_title_setting',
    );
    $settings = array(
        $setting_color_dark,
        $setting_color_light,
        $setting_transparent_dark,
        $setting_transparent_light,
    );
    $setting_name = array(
        "accent_color",
        "title_color",
        "text_color",
        "icon_color",
        "background_color",
        "active_title_color"
    );
    $name = array(
        "Colored Dark",
        "Colored light",
        "Transparent dark",
        "Transparent light",
    );

    $option = get_option('theme_mods_themeOptions');
    $colors = array();
    $j = 0;
    foreach ($settings as $setting) {
        $color = array();
        $i = 0;
        foreach ($setting as $s) {
            $color[$setting_name[$i]] = ($option[$s] ? $option[$s] : "#000000");
            $i++;
        }
        $colors[] = array(
            'name' => $name[$j],
            'colors' => $color
        );
        $j++;
    }
    return $colors;
}

function ideothemo_getOptionCustomizer($setting)
{
    $option = get_option('theme_mods_themeOptions');
    return $option['setting'];
}

function ideothemo_getStateSwitcher($switcherOption)
{
    $switcher_state = ($switcherOption == 1 ? "Off" : "On");
    return $switcher_state;
}

function ideothemo_getOption()
{
    $option = ideothemo_getOptionAccent();
    global $settingHeader;
    $allOption = array();
    foreach ($settingHeader as $setting => $value) {
        if (is_array($value)) {
            foreach ($value as $setting => $value) {
                if (is_array($value)) {
                    foreach ($value as $setting => $value) {
                        if (is_array($value)) {
                            foreach ($value as $setting => $value) {
                                if (is_array($value)) {
                                    foreach ($value as $setting => $value) {
                                        if (is_array($value)) {
                                            foreach ($value as $setting => $value) {
                                                if (is_array($value)) {
                                                    foreach ($value as $setting => $value) {
                                                        if (is_array($value)) {
                                                            foreach ($value as $setting => $value) {
                                                                if (!array_key_exists($value, $option)) {
                                                                    $allOption[$value] = "X";
                                                                }
                                                            }
                                                        }
                                                        if (!array_key_exists($value, $option)) {
                                                            $allOption[$value] = "X";
                                                        }
                                                    }
                                                }
                                                if (!array_key_exists($value, $option)) {
                                                    $allOption[$value] = "X";
                                                }
                                            }
                                        }
                                        if (!array_key_exists($value, $option)) {
                                            $allOption[$value] = "X";
                                        }
                                    }
                                }
                                if (!array_key_exists($value, $option)) {
                                    $allOption[$value] = "X";
                                }
                            }
                        }
                        if (!array_key_exists($value, $option)) {
                            $allOption[$value] = "X";
                        }
                    }
                }
                if (!array_key_exists($value, $option)) {
                    $allOption[$value] = "X";
                }
            }
        }
        if (!array_key_exists($value, $option)) {
            $allOption[$value] = "X";
        }
    }
    $return = array_merge($option, $allOption);
    return $return;
}


function ideothemo_getOptionAccent()
{
    $option = get_theme_mods();
    global $settingHeader;
    $settHeaderColor = array();
    foreach ($settingHeader as $setting => $value) {
        if (is_array($value)) {
            foreach ($value as $setting => $value) {
                if (is_array($value)) {
                    foreach ($value as $setting => $value) {
                        if (is_array($value)) {
                            foreach ($value as $setting => $value) {
                                if (is_array($value)) {
                                    foreach ($value as $setting => $value) {
                                        if (is_array($value)) {
                                            foreach ($value as $setting => $value) {
                                                if (is_array($value)) {
                                                    foreach ($value as $setting => $value) {
                                                        if (is_array($value)) {
                                                            foreach ($value as $setting => $value) {
                                                                if (preg_match("/_color(_|\z)/", $value)) {
                                                                    $settHeaderColor[] = $value;
                                                                }
                                                            }
                                                        }
                                                        if (preg_match("/_color(_|\z)/", $value)) {
                                                            $settHeaderColor[] = $value;
                                                        }
                                                    }
                                                }
                                                if (preg_match("/_color(_|\z)/", $value)) {
                                                    $settHeaderColor[] = $value;
                                                }
                                            }
                                        }
                                        if (preg_match("/_color(_|\z)/", $value)) {
                                            $settHeaderColor[] = $value;
                                        }
                                    }
                                }
                                if (preg_match("/_color(_|\z)/", $value)) {
                                    $settHeaderColor[] = $value;
                                }
                            }
                        }
                        if (preg_match("/_color(_|\z)/", $value)) {
                            $settHeaderColor[] = $value;
                        }
                    }
                }
                if (preg_match("/_color(_|\z)/", $value)) {
                    $settHeaderColor[] = $value;
                }
            }
        }
        if (preg_match("/_color(_|\z)/", $value)) {
            $settHeaderColor[] = $value;
        }
    }
    $settingColor = array();
    foreach ($settHeaderColor as $color) {
        $settingColor[$color] = get_theme_mod($color, true);
    }
    
    foreach ($option as $opt => $value) {
        if ($opt != "top_sticky_header_styling_transparent_dark_mega_menu_sub_level_background_image_overlay_color" &&
            $opt != "top_sticky_header_styling_transparent_light_mega_menu_sub_level_background_image_overlay_color" &&
            $opt != "top_sticky_header_styling_transparent_light_background_color" &&
            $opt != "top_sticky_header_styling_transparent_dark_background_color" &&
            $opt != "top_sticky_header_styling_transparent_light_mega_menu_sub_level_separators_color_vertical" &&
            $opt != "top_sticky_header_styling_transparent_dark_mega_menu_sub_level_separators_color_vertical" &&
            $opt != "top_sticky_header_styling_transparent_light_mega_menu_sub_level_background_color" &&
            $opt != "top_sticky_header_styling_transparent_dark_mega_menu_sub_level_background_color" &&
            $opt != "side_header_dark_styling_background_color_pattern_color" &&
            $opt != "side_header_dark_styling_image_background_image_overlay_pattern_color" &&
            $opt != "side_header_light_styling_background_color_pattern_color" &&
            $opt != "side_header_light_styling_image_background_image_overlay_pattern_color"
        ) {
            foreach ($settingColor as $color => $val) {
                if ($opt == $color) {
                    if ($value == "" && $value != "0" && $value != "nav_menu_locations" || $value == null && $value != "0" && $value != "nav_menu_locations") {
                        $option[$opt] = ideothemo_get_general_accent_color();
                    }
                }
                if (!in_array($color, $option)) {
                    if ($val == "1") {
                        $option[$color] = ideothemo_get_general_accent_color();
                    } else {
                        $option[$color] = $val;
                    }
                }
            }
        }
    }
    return $option;
}

function ideothemo_get_svg($filename, $color1 = '#000', $base64 = true)
{
    global $wp_filesystem;
   
    $svg = '';
    $file = get_template_directory() . '/assets/svg/' . $filename;
    if (file_exists($file)) {
        $svg = $wp_filesystem->get_contents($file);
        $svg = preg_replace('/@color1/i', '' . $color1 . '', $svg);        
    }
   
    return $svg;
}

add_action('wp_ajax_call_svg', 'ideothemo_call_svg_callback');

function ideothemo_call_svg_callback()
{
    $svg = ideothemo_get_svg($_POST['filename'], $_POST['color']);
    echo $svg;
    wp_die(); // this is required to terminate immediately and return a proper response
}

//top sticky
function ideothemo_topSetting($typeHeader = "normal")
{
    $option = ideothemo_getOption();
    global $settingHeader;

    if ($option[$settingHeader['top']['setting']['style']] == "transparent_light") {
        ideothemo_topStickyHeaderStylingTransparentLight($typeHeader);
    } else if ($option[$settingHeader['top']['setting']['style']] == "transparent_dark" || !isset($option[$settingHeader['top']['setting']['style']]) || $option[$settingHeader['top']['setting']['style']] == "X") {
        ideothemo_topStickyHeaderStylingTransparentDark($typeHeader);
    } else if ($option[$settingHeader['top']['setting']['style']] == "colored_light") {
        ideothemo_topStickyHeaderStylingColoredLight($typeHeader);
    } else if ($option[$settingHeader['top']['setting']['style']] == "colored_dark") {
        ideothemo_topStickyHeaderStylingColoredDark($typeHeader);
    }

    if ($option[$settingHeader['top']['setting']['width']] === "full" || !isset($option[$settingHeader['top']['setting']['width']]) || $option[$settingHeader['top']['setting']['width']] == "X") {
        echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . '{ width:100% }';
    } else if ($option[$settingHeader['top']['setting']['width']] === "boxed") {
        echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . '{ width:1200px }';
    } else if ($option[$settingHeader['top']['setting']['width']] === "custom") {
        echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . '{ width:' . (isset($option[$settingHeader['top']['setting']['custom_width']]) ? $option[$settingHeader['top']['setting']['custom_width']] : "50") . '% }';
    }
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content{ width: ' . (isset($option[$settingHeader['top']['setting']['content_width']]) ? $option[$settingHeader['top']['setting']['content_width']] : "90") . '% }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .logo > img{ height: ' . (isset($option[$settingHeader['top']['setting']['logo']['height']]) ? $option[$settingHeader['top']['setting']['logo']['height']] : "20") . 'px }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .logo > img{ margin-top: ' . (isset($option[$settingHeader['top']['setting']['logo']['margin']['top']]) ? $option[$settingHeader['top']['setting']['logo']['margin']['top']] : "20") . 'px }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .logo > img{ margin-bottom: ' . (isset($option[$settingHeader['top']['setting']['logo']['margin']['bottom']]) ? $option[$settingHeader['top']['setting']['logo']['margin']['bottom']] : "20") . 'px }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . '{ margin-top: ' . $option[$settingHeader['top']['setting']['top_distance']] . 'px }';
}

function ideothemo_overwriteTopSetting($typeHeader = "normal")
{
    $option = ideothemo_getOption();
    global $settingHeader;

    if ($option[$settingHeader['top']['setting']['width']] === "full") {
        echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . '{ width:100% }';
    } else if ($option[$settingHeader['top']['setting']['width']] === "boxed") {
        echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . '{ width:1200px }';
    } else if ($option[$settingHeader['top']['setting']['width']] === "custom") {
        echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . '{ width:' . (isset($option[$settingHeader['top']['setting']['custom_width']]) ? $option[$settingHeader['top']['setting']['custom_width']] : "50") . '% }';
    }
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content{ width: ' . (isset($option[$settingHeader['top']['setting']['content_width']]) ? $option[$settingHeader['top']['setting']['content_width']] : "90") . '% }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .logo > img{ height: ' . (isset($option[$settingHeader['top']['setting']['logo']['height']]) ? $option[$settingHeader['top']['setting']['logo']['height']] : "20") . 'px }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .logo > img{ margin-top: ' . (isset($option[$settingHeader['top']['setting']['logo']['margin']['top']]) ? $option[$settingHeader['top']['setting']['logo']['margin']['top']] : "20") . 'px }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .logo > img{ margin-bottom: ' . (isset($option[$settingHeader['top']['setting']['logo']['margin']['bottom']]) ? $option[$settingHeader['top']['setting']['logo']['margin']['bottom']] : "20") . 'px }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . '{ margin-top: ' . $option[$settingHeader['top']['setting']['top_distance']] . 'px }';
}

function ideothemo_stickySetting($typeHeader = "sticky")
{
    $option = ideothemo_getOption();
    global $settingHeader;
    if ($option[$settingHeader['sticky']['setting']['style']] == "transparent_light") {
        ideothemo_topStickyHeaderStylingTransparentLight($typeHeader);
    } else if ($option[$settingHeader['sticky']['setting']['style']] == "transparent_dark") {
        ideothemo_topStickyHeaderStylingTransparentDark($typeHeader);
    } else if ($option[$settingHeader['sticky']['setting']['style']] == "colored_light" || !isset($option[$settingHeader['sticky']['setting']['style']]) || $option[$settingHeader['sticky']['setting']['style']] == "X") {
        ideothemo_topStickyHeaderStylingColoredLight($typeHeader);
    } else if ($option[$settingHeader['sticky']['setting']['style']] == "colored_dark") {
        ideothemo_topStickyHeaderStylingColoredDark($typeHeader);
    }

    if ($option[$settingHeader['sticky']['setting']['width']] === "full_width") {
        echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . '{ width:100% }';
    } else if ($option[$settingHeader['sticky']['setting']['width']] === "boxed") {
        echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . '{ width:1200px }';
    } else if ($option[$settingHeader['sticky']['setting']['width']] === "custom_width") {
        echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . '{ width:' . (isset($option[$settingHeader['sticky']['setting']['custom_width']]) ? $option[$settingHeader['top']['setting']['custom_width']] : "50") . '% }';
    }
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content{ width: ' . (isset($option[$settingHeader['sticky']['setting']['content_width']]) ? $option[$settingHeader['top']['setting']['content_width']] : "90") . '% }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .logo > img{ height: ' . (isset($option[$settingHeader['sticky']['setting']['logo']['height']]) ? $option[$settingHeader['top']['setting']['logo']['height']] : "60") . 'px }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .logo > img{ margin-top: ' . (isset($option[$settingHeader['sticky']['setting']['logo']['margin']['top']]) ? $option[$settingHeader['top']['setting']['logo']['margin']['top']] : "20") . 'px }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .logo > img{ margin-bottom: ' . (isset($option[$settingHeader['sticky']['setting']['logo']['margin']['bottom']]) ? $option[$settingHeader['top']['setting']['logo']['margin']['bottom']] : "20") . 'px }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . '{ margin-top: ' . $option[$settingHeader['sticky']['setting']['top_distance']] . 'px }';
}

function ideothemo_overwriteStickySetting($typeHeader = "sticky")
{
    $option = ideothemo_getOption();
    global $settingHeader;
    if ($option[$settingHeader['sticky']['setting']['width']] === "full_width") {
        echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . '{ width:100% }';
    } else if ($option[$settingHeader['sticky']['setting']['width']] === "boxed") {
        echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . '{ width:1200px }';
    } else if ($option[$settingHeader['sticky']['setting']['width']] === "custom_width") {
        echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . '{ width:' . (isset($option[$settingHeader['sticky']['setting']['custom_width']]) ? $option[$settingHeader['top']['setting']['custom_width']] : "50") . '% }';
    }
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content{ width: ' . (isset($option[$settingHeader['sticky']['setting']['content_width']]) ? $option[$settingHeader['top']['setting']['content_width']] : "90") . '% }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .logo > img{ height: ' . (isset($option[$settingHeader['sticky']['setting']['logo']['height']]) ? $option[$settingHeader['top']['setting']['logo']['height']] : "20") . 'px }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .logo > img{ margin-top: ' . (isset($option[$settingHeader['sticky']['setting']['logo']['margin']['top']]) ? $option[$settingHeader['top']['setting']['logo']['margin']['top']] : "20") . 'px }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .logo > img{ margin-bottom: ' . (isset($option[$settingHeader['sticky']['setting']['logo']['margin']['bottom']]) ? $option[$settingHeader['top']['setting']['logo']['margin']['bottom']] : "20") . 'px }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . '{ margin-top: ' . $option[$settingHeader['sticky']['setting']['top_distance']] . 'px }';
}

function ideothemo_topStickyHeaderStylingTransparentLight($typeHeader = null)
{
    $option = ideothemo_getOption();
    global $settingHeader;
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . '{ background: ' . $option[$settingHeader['top_sticky']['transparent']['light']['background_color']] . ' }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . '{ border-bottom-color: ' . $option[$settingHeader['top_sticky']['transparent']['light']['border_bottom']['color']] . ' }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . '{ border-bottom-width: ' . $option[$settingHeader['top_sticky']['transparent']['light']['border_bottom']['thickness']] . ' }';
    if (isset($option[$settingHeader['top_sticky']['transparent']['light']['border_bottom']['color']])) {
        echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . '{ border-bottom-style: solid }';
    }
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' .icon{ color: ' . $option[$settingHeader['top_sticky']['transparent']['light']['search_language_icon_color']] . ' }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu{ background: ' . $option[$settingHeader['top_sticky']['transparent']['light']['mega_menu_sub_level']['background']['color']] . ' }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu .overMenu{ background: ' . $option[$settingHeader['top_sticky']['transparent']['light']['mega_menu_sub_level']['background']['image_overlay_color']] . ' }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu a{ color: ' . $option[$settingHeader['top_sticky']['transparent']['light']['mega_menu_sub_level']['text_icon']['color']] . '!important }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu a:hover{ color: ' . $option[$settingHeader['top_sticky']['transparent']['light']['mega_menu_sub_level']['text_icon']['hover_color']] . '!important }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu a:hover{ background: ' . $option[$settingHeader['top_sticky']['transparent']['light']['mega_menu_sub_level']['hover_color']] . ' }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu a{ border-right-color: ' . $option[$settingHeader['top_sticky']['transparent']['light']['mega_menu_sub_level']['separators_color']['vertical']] . ' }';
    if (isset($option[$settingHeader['top_sticky']['transparent']['light']['mega_menu_sub_level']['separators_color']['vertical']])) {
        echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu a{border-right-style:solid}';
        echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu a{border-right-width:1px}';
    }
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu a{ border-bottom-color: ' . $option[$settingHeader['top_sticky']['transparent']['light']['mega_menu_sub_level']['separators_color']['horizontal']] . ' }';
    if (isset($option[$settingHeader['top_sticky']['transparent']['light']['mega_menu_sub_level']['separators_color']['horizontal']])) {
        echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu a{border-bottom-style:solid}';
        echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu a{border-bottom-width:1px}';
    }
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content a{ color: ' . $option[$settingHeader['top_sticky']['transparent']['light']['first_level_menu_text']['color']] . ' }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content a:hover{ color: ' . $option[$settingHeader['top_sticky']['transparent']['light']['first_level_menu_text']['hover_color']] . ' }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .megamenu > a{ color: ' . $option[$settingHeader['top_sticky']['transparent']['light']['mega_menu_sub_level']['column_title_color']] . '!important }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .megamenu > .overMenu > a{ color: ' . $option[$settingHeader['top_sticky']['transparent']['light']['mega_menu_sub_level']['column_title_color']] . '!important }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .megamenu > a:hover{ background: none!important }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .megamenu > .overMenu > a:hover{ background: none!important }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .megamenu > a:hover{ color: ' . $option[$settingHeader['top_sticky']['transparent']['light']['mega_menu_sub_level']['column_title_color']] . '!important }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .megamenu > .overMenu > a:hover{ color: ' . $option[$settingHeader['top_sticky']['transparent']['light']['mega_menu_sub_level']['column_title_color']] . '!important }';

    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' .loading_effect_color{ background: ' . $option[$settingHeader['top_sticky']['transparent']['light']['background_loading_effect_color']] . '!important }';
}

function ideothemo_topStickyHeaderStylingTransparentDark($typeHeader = null)
{
    $option = ideothemo_getOption();
    global $settingHeader;
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . '{ background: ' . $option[$settingHeader['top_sticky']['transparent']['dark']['background_color']] . ' }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . '{ border-bottom-color: ' . $option[$settingHeader['top_sticky']['transparent']['dark']['border_bottom']['color']] . ' }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . '{ border-bottom-width: ' . $option[$settingHeader['top_sticky']['transparent']['dark']['border_bottom']['thickness']] . ' }';
    if (isset($option[$settingHeader['top_sticky']['transparent']['dark']['border_bottom']['color']])) {
        echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . '{ border-bottom-style: solid }';
    }
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' .icon{ color: ' . $option[$settingHeader['top_sticky']['transparent']['dark']['search_language_icon_color']] . ' }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu{ background: ' . $option[$settingHeader['top_sticky']['transparent']['dark']['mega_menu_sub_level']['background']['color']] . ' }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu .overMenu{ background: ' . $option[$settingHeader['top_sticky']['transparent']['dark']['mega_menu_sub_level']['background']['image_overlay_color']] . ' }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu a{ color: ' . $option[$settingHeader['top_sticky']['transparent']['dark']['mega_menu_sub_level']['text_icon']['color']] . '!important }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu a:hover{ color: ' . $option[$settingHeader['top_sticky']['transparent']['dark']['mega_menu_sub_level']['text_icon']['hover_color']] . '!important }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu a:hover{ background: ' . $option[$settingHeader['top_sticky']['transparent']['dark']['mega_menu_sub_level']['hover_color']] . ' }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu a{ border-right-color: ' . $option[$settingHeader['top_sticky']['transparent']['dark']['mega_menu_sub_level']['separators_color']['vertical']] . ' }';
    if (isset($option[$settingHeader['top_sticky']['transparent']['dark']['mega_menu_sub_level']['separators_color']['vertical']])) {
        echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu a{border-right-style:solid}';
        echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu a{border-right-width:1px}';
    }
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu a{ border-bottom-color: ' . $option[$settingHeader['top_sticky']['transparent']['dark']['mega_menu_sub_level']['separators_color']['horizontal']] . ' }';
    if (isset($option[$settingHeader['top_sticky']['transparent']['dark']['mega_menu_sub_level']['separators_color']['horizontal']])) {
        echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu a{border-bottom-style:solid}';
        echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu a{border-bottom-width:1px}';
    }
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content a{ color: ' . $option[$settingHeader['top_sticky']['transparent']['dark']['first_level_menu_text']['color']] . ' }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content a:hover{ color: ' . $option[$settingHeader['top_sticky']['transparent']['dark']['first_level_menu_text']['hover_color']] . ' }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .megamenu > a{ color: ' . $option[$settingHeader['top_sticky']['transparent']['dark']['mega_menu_sub_level']['column_title_color']] . '!important }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .megamenu > .overMenu > a{ color: ' . $option[$settingHeader['top_sticky']['transparent']['dark']['mega_menu_sub_level']['column_title_color']] . '!important }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .megamenu > a:hover{ background: none!important }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .megamenu > .overMenu > a:hover{ background: none!important }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .megamenu > a:hover{ color: ' . $option[$settingHeader['top_sticky']['transparent']['dark']['mega_menu_sub_level']['column_title_color']] . '!important }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .megamenu > .overMenu > a:hover{ color: ' . $option[$settingHeader['top_sticky']['transparent']['dark']['mega_menu_sub_level']['column_title_color']] . '!important }';

    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' .loading_effect_color{ background: ' . $option[$settingHeader['top_sticky']['transparent']['dark']['background_loading_effect_color']] . '!important }';
}

function ideothemo_topStickyHeaderStylingColoredLight($typeHeader = null)
{
    $option = ideothemo_getOption();
    global $settingHeader;
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . '{ background: ' . $option[$settingHeader['top_sticky']['colored']['light']['background_color']] . ' }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . '{ border-bottom-color: ' . $option[$settingHeader['top_sticky']['colored']['light']['border_bottom']['color']] . ' }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . '{ border-bottom-width: ' . $option[$settingHeader['top_sticky']['colored']['light']['border_bottom']['thickness']] . ' }';
    if (isset($option[$settingHeader['top_sticky']['colored']['light']['border_bottom']['color']])) {
        echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . '{ border-bottom-style: solid }';
    }
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' .icon{ color: ' . $option[$settingHeader['top_sticky']['colored']['light']['search_language_icon_color']] . ' }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu{ background: ' . $option[$settingHeader['top_sticky']['colored']['light']['mega_menu_sub_level']['background']['color']] . ' }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu .overMenu{ background: ' . $option[$settingHeader['top_sticky']['colored']['light']['mega_menu_sub_level']['background']['image_overlay_color']] . ' }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu a{ color: ' . $option[$settingHeader['top_sticky']['colored']['light']['mega_menu_sub_level']['text_icon']['color']] . '!important }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu a:hover{ color: ' . $option[$settingHeader['top_sticky']['colored']['light']['mega_menu_sub_level']['text_icon']['hover_color']] . '!important }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu a:hover{ background: ' . $option[$settingHeader['top_sticky']['colored']['light']['mega_menu_sub_level']['hover_color']] . ' }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu a{ border-right-color: ' . $option[$settingHeader['top_sticky']['colored']['light']['mega_menu_sub_level']['separators_color']['vertical']] . ' }';
    if (isset($option[$settingHeader['top_sticky']['colored']['light']['mega_menu_sub_level']['separators_color']['vertical']])) {
        echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu a{border-right-style:solid}';
        echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu a{border-right-width:1px}';
    }
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu a{ border-bottom-color: ' . $option[$settingHeader['top_sticky']['colored']['light']['mega_menu_sub_level']['separators_color']['horizontal']] . ' }';
    if (isset($option[$settingHeader['top_sticky']['colored']['light']['mega_menu_sub_level']['separators_color']['horizontal']])) {
        echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu a{border-bottom-style:solid}';
        echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu a{border-bottom-width:1px}';
    }
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content a{ color: ' . $option[$settingHeader['top_sticky']['colored']['light']['first_level_menu_text']['color']] . ' }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content a:hover{ color: ' . $option[$settingHeader['top_sticky']['colored']['light']['first_level_menu_text']['hover_color']] . ' }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .megamenu > a{ color: ' . $option[$settingHeader['top_sticky']['colored']['light']['mega_menu_sub_level']['column_title_color']] . '!important }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .megamenu > .overMenu > a{ color: ' . $option[$settingHeader['top_sticky']['colored']['light']['mega_menu_sub_level']['column_title_color']] . '!important }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' .loading_effect_color{ background: ' . $option[$settingHeader['top_sticky']['colored']['light']['background_loading_effect_color']] . '!important }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .megamenu > a:hover{ background: none!important }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .megamenu > .overMenu > a:hover{ background: none!important }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .megamenu > a:hover{ color: ' . $option[$settingHeader['top_sticky']['colored']['light']['mega_menu_sub_level']['column_title_color']] . '!important }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .megamenu > .overMenu > a:hover{ color: ' . $option[$settingHeader['top_sticky']['colored']['light']['mega_menu_sub_level']['column_title_color']] . '!important }';
}

function ideothemo_topStickyHeaderStylingColoredDark($typeHeader = null)
{
    $option = ideothemo_getOption();
    global $settingHeader;
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . '{ background: ' . $option[$settingHeader['top_sticky']['colored']['dark']['background_color']] . ' }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . '{ border-bottom-color: ' . $option[$settingHeader['top_sticky']['colored']['dark']['border_bottom']['color']] . ' }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . '{ border-bottom-width: ' . $option[$settingHeader['top_sticky']['colored']['dark']['border_bottom']['thickness']] . ' }';
    if (isset($option[$settingHeader['top_sticky']['colored']['dark']['border_bottom']['color']])) {
        echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . '{ border-bottom-style: solid }';
    }
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' .icon{ color: ' . $option[$settingHeader['top_sticky']['colored']['dark']['search_language_icon_color']] . ' }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu{ background: ' . $option[$settingHeader['top_sticky']['colored']['dark']['mega_menu_sub_level']['background']['color']] . ' }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu .overMenu{ background: ' . $option[$settingHeader['top_sticky']['colored']['dark']['mega_menu_sub_level']['background']['image_overlay_color']] . ' }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu a{ color: ' . $option[$settingHeader['top_sticky']['colored']['dark']['mega_menu_sub_level']['text_icon']['color']] . '!important }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu a:hover{ color: ' . $option[$settingHeader['top_sticky']['colored']['dark']['mega_menu_sub_level']['text_icon']['hover_color']] . '!important }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu a:hover{ background: ' . $option[$settingHeader['top_sticky']['colored']['dark']['mega_menu_sub_level']['hover_color']] . ' }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu a{ border-right-color: ' . $option[$settingHeader['top_sticky']['colored']['dark']['mega_menu_sub_level']['separators_color']['vertical']] . ' }';
    if (isset($option[$settingHeader['top_sticky']['colored']['dark']['mega_menu_sub_level']['separators_color']['vertical']])) {
        echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu a{border-right-style:solid}';
        echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu a{border-right-width:1px}';
    }
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu a{ border-bottom-color: ' . $option[$settingHeader['top_sticky']['colored']['dark']['mega_menu_sub_level']['separators_color']['horizontal']] . ' }';
    if (isset($option[$settingHeader['top_sticky']['colored']['dark']['mega_menu_sub_level']['separators_color']['horizontal']])) {
        echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu a{border-bottom-style:solid}';
        echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .sub-menu a{border-bottom-width:1px}';
    }
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content a{ color: ' . $option[$settingHeader['top_sticky']['colored']['dark']['first_level_menu_text']['color']] . ' }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content a:hover{ color: ' . $option[$settingHeader['top_sticky']['colored']['dark']['first_level_menu_text']['hover_color']] . ' }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .megamenu > a{ color: ' . $option[$settingHeader['top_sticky']['colored']['dark']['mega_menu_sub_level']['column_title_color']] . '!important }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .megamenu > .overMenu > a{ color: ' . $option[$settingHeader['top_sticky']['colored']['dark']['mega_menu_sub_level']['column_title_color']] . '!important }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .megamenu > a:hover{ background: none!important }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .megamenu > .overMenu > a:hover{ background: none!important }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .megamenu > a:hover{ color: ' . $option[$settingHeader['top_sticky']['colored']['dark']['mega_menu_sub_level']['column_title_color']] . '!important }';
    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' > .content .megamenu > .overMenu > a:hover{ color: ' . $option[$settingHeader['top_sticky']['colored']['dark']['mega_menu_sub_level']['column_title_color']] . '!important }';

    echo '.menu-normal' . ($typeHeader != null ? "." . $typeHeader : "") . ' .loading_effect_color{ background: ' . $option[$settingHeader['top_sticky']['colored']['dark']['background_loading_effect_color']] . '!important }';
}

//side
function ideothemo_sideSettings()
{
    $option = ideothemo_getOption();
    global $settingHeader;
    if ($option[$settingHeader['side']['setting']['style']] == "light") {
        ideothemo_sideHeaderLightStyling();
    } else if ($option[$settingHeader['side']['setting']['style']] == "dark") {
        ideothemo_sideHeaderDarkStyling();
    }

    if ($option[$settingHeader['side']['setting']['align']['menu']] == "left") {
        echo '.menu-side .content{ text-align: left }';
    } else if ($option[$settingHeader['side']['setting']['align']['menu']] == "center" || !isset($option[$settingHeader['side']['setting']['align']['menu']]) || $option[$settingHeader['sticky']['setting']['style']] == "X") {
        echo '.menu-side .content{ text-align: center }';
    } else if ($option[$settingHeader['side']['setting']['align']['menu']] == "right") {
        echo '.menu-side .content{ text-align: right }';
    }
    if ($option[$settingHeader['side']['setting']['align']['bottom_area']] == "left") {
        echo '.menu-side .bottom_area{ text-align: left }';
    } else if ($option[$settingHeader['side']['setting']['align']['bottom_area']] == "center" || !isset($option[$settingHeader['side']['setting']['align']['bottom_area']]) || $option[$settingHeader['sticky']['setting']['style']] == "X") {
        echo '.menu-side .bottom_area{ text-align: center }';
    } else if ($option[$settingHeader['side']['setting']['align']['bottom_area']] == "right") {
        echo '.menu-side .bottom_area{ text-align: right }';
    }

    echo '.menu-side .logo{ padding-left: ' . $option[$settingHeader['side']['setting']['logo']['align']] . ' }';
    echo '.menu-side .logo{ padding-top: ' . $option[$settingHeader['side']['setting']['logo']['padding']['top']] . 'px }';
    echo '.menu-side .logo{ padding-bottom: ' . $option[$settingHeader['side']['setting']['logo']['padding']['bottom']] . 'px }';
    echo '.menu-side .logo img{ height: ' . $option[$settingHeader['side']['setting']['logo']['height']] . '}';

    if ($option[$settingHeader['side']['setting']['search_form']]) {
        echo '.menu-side .search input{ display:block }';
    } else {
        echo '.menu-side .search input{ display:none }';
    }

    if ($option[$settingHeader['side']['setting']['social_icon']]) {
        echo '.menu-side .bottom_area .social_icon{ display:block }';
    } else {
        echo '.menu-side .bottom_area .social_icon{ display:none }';
    }
}

function ideothemo_sideHeaderLightStylingColor()
{
    $option = ideothemo_getOption();
    global $settingHeader;
    echo '.menu-side{ background: ' . $option[$settingHeader['side']['light']['styling']['color_background']['background_color']] . ' }';
}

function ideothemo_sideHeaderLightStylingImage()
{
    $option = ideothemo_getOption();
    global $settingHeader;

    echo '.menu-side{ background-image: url(' . $option[$settingHeader['side']['light']['styling']['image_background']['background_image']] . ') }';
    switch ($option[$settingHeader['side']['light']['styling']['image_background']['image_position']]) {
        case "top_left":
            echo '.menu-side{ background-position: left top }';
            break;
        case "top_center":
            echo '.menu-side{ background-position: center top }';
            break;
        case "top_right":
            echo '.menu-side{ background-position: right top }';
            break;
        case "center_left":
            echo '.menu-side{ background-position: left center }';
            break;
        case "center_center":
            echo '.menu-side{ background-position: center center }';
            break;
        case "center_right":
            echo '.menu-side{ background-position: right center }';
            break;
        case "bottom_left":
            echo '.menu-side{ background-position: left bottom }';
            break;
        case "bottom_center":
            echo '.menu-side{ background-position: center bottom }';
            break;
        case "bottom_right":
            echo '.menu-side{ background-position: right bottom }';
            break;
        default:
            echo '.menu-side{ background-position: left top }';
            break;
    }

    if (is_null($option[$settingHeader['side']['light']['styling']['image_background']['image_size']])) {
        echo '.menu-side{ background-size: auto;}';
    } else {
        echo '.menu-side{ background-size: ' . $option[$settingHeader['side']['light']['styling']['image_background']['image_size']] . ' }';
    }
    if (is_null($option[$settingHeader['side']['light']['styling']['image_background']['image_repeat']])) {
        echo '.menu-side{ background-repeat: no-repeat;}';
    } else {
        echo '.menu-side{ background-repeat: ' . $option[$settingHeader['side']['light']['styling']['image_background']['image_repeat']] . ' }';
    }
    if ($option[$settingHeader['side']['light']['styling']['image_background']['image_overlay']['type']] == "color") {
        echo '.menu-side{ background-repeat: ' . $option[$settingHeader['side']['light']['styling']['image_background']['image_overlay']['color']['pattern_color']] . ' }';
    }
}

function ideothemo_sideHeaderLightStyling()
{
    $option = ideothemo_getOption();
    global $settingHeader;
    if ($option[$settingHeader['side']['light']['styling']['background']] == "color") {
        ideothemo_sideHeaderLightStylingColor();
    } else if ($option[$settingHeader['side']['light']['styling']['background']] == "image") {
        ideothemo_sideHeaderLightStylingImage();
    }

    echo '.menu-side a{ color: ' . $option[$settingHeader['side']['light']['styling']['menu_text_color']] . ' }';
    echo '.menu-side a:hover{ color: ' . $option[$settingHeader['side']['light']['styling']['menu_text_hover_color']] . ' }';
    echo '.menu-side .sub-menu{ background-color: ' . $option[$settingHeader['side']['light']['styling']['dropdown_menu_background_color']] . ' }';
    if (isset($option[$settingHeader['side']['light']['styling']['dropdown_menu_separators_color']])) {
        echo '.menu-side .sub-menu a{ border-bottom-color: ' . $option[$settingHeader['side']['light']['styling']['dropdown_menu_separators_color']] . ' }';
        echo '.menu-side .sub-menu a{ border-bottom-style: solid }';
        echo '.menu-side .sub-menu a{ border-bottom-width: 1px }';
    }

    echo '.menu-side .social_icon{ background-color: ' . $option[$settingHeader['side']['light']['styling']['social_icon_background_color']] . ' }';
    echo '.menu-side .social_icon{ color: ' . $option[$settingHeader['side']['light']['styling']['social_icons_color']] . ' }';
    echo '.menu-side .copyright{ color: ' . $option[$settingHeader['side']['light']['styling']['copyrights']] . ' }';
}

function ideothemo_sideHeaderDarkStylingColor()
{
    $option = ideothemo_getOption();
    global $settingHeader;

    echo '.menu-side{ background-color: ' . $option[$settingHeader['side']['dark']['styling']['color_background']['background_color']] . ' }';
}

function ideothemo_sideHeaderDarkStylingImage()
{
    $option = ideothemo_getOption();
    global $settingHeader;
    echo '.menu-side{ background-image: url(' . $option[$settingHeader['side']['dark']['styling']['image_background']['background_image']] . ') }';
    switch ($option[$settingHeader['side']['dark']['styling']['image_background']['image_position']]) {
        case "top_left":
            echo '.menu-side{ background-position: left top }';
            break;
        case "top_center":
            echo '.menu-side{ background-position: center top }';
            break;
        case "top_right":
            echo '.menu-side{ background-position: right top }';
            break;
        case "center_left":
            echo '.menu-side{ background-position: left center }';
            break;
        case "center_center":
            echo '.menu-side{ background-position: center center }';
            break;
        case "center_right":
            echo '.menu-side{ background-position: right center }';
            break;
        case "bottom_left":
            echo '.menu-side{ background-position: left bottom }';
            break;
        case "bottom_center":
            echo '.menu-side{ background-position: center bottom }';
            break;
        case "bottom_right":
            echo '.menu-side{ background-position: right bottom }';
            break;
    }
    if (is_null($option[$settingHeader['side']['dark']['styling']['image_background']['image_size']])) {
        echo '.menu-side{ background-size: auto;}';
    } else {
        echo '.menu-side{ background-size: ' . $option[$settingHeader['side']['dark']['styling']['image_background']['image_size']] . ' }';
    }
    if (is_null($option[$settingHeader['side']['dark']['styling']['image_background']['image_repeat']])) {
        echo '.menu-side{ background-repeat: no-repeat;}';
    } else {
        echo '.menu-side{ background-repeat: ' . $option[$settingHeader['side']['dark']['styling']['image_background']['image_repeat']] . ' }';
    }
    if ($option[$settingHeader['side']['dark']['styling']['image_background']['image_overlay']['type']] == "color") {
        echo '.menu-side{ background-repeat: ' . $option[$settingHeader['side']['dark']['styling']['image_background']['image_overlay']['color']['pattern_color']] . ' }';
    } else if ($option[$settingHeader['side']['dark']['styling']['image_background']['image_overlay']['type']] == "pattern") {

    }
}

function ideothemo_sideHeaderDarkStyling()
{
    $option = ideothemo_getOption();
    global $settingHeader;

    if ($option[$settingHeader['side']['dark']['styling']['background']] == "color") {
        ideothemo_sideHeaderDarkStylingColor();
    } else if ($option[$settingHeader['side']['dark']['styling']['background']] == "image") {
        ideothemo_sideHeaderDarkStylingImage();
    }

    echo '.menu-side a{ color: ' . $option[$settingHeader['side']['dark']['styling']['menu_text_color']] . ' }';
    echo '.menu-side a:hover{ color: ' . $option[$settingHeader['side']['dark']['styling']['menu_text_hover_color']] . ' }';
    echo '.menu-side .sub-menu{ background-color: ' . $option[$settingHeader['side']['dark']['styling']['dropdown_menu_background_color']] . ' }';
    if (isset($option[$settingHeader['side']['dark']['styling']['dropdown_menu_separators_color']])) {
        echo '.menu-side .sub-menu a{ border-bottom-color: ' . $option[$settingHeader['side']['dark']['styling']['dropdown_menu_separators_color']] . ' }';
        echo '.menu-side .sub-menu a{ border-bottom-style: solid }';
        echo '.menu-side .sub-menu a{ border-bottom-width: 1px }';
    }

    echo '.menu-side .social_icon{ background-color: ' . $option[$settingHeader['side']['dark']['styling']['social_icon_background_color']] . ' }';
    echo '.menu-side .social_icon{ color: ' . $option[$settingHeader['side']['dark']['styling']['social_icons_color']] . ' }';
    echo '.menu-side .copyright{ color: ' . $option[$settingHeader['side']['dark']['styling']['copyrights']] . ' }';
}

//typografy
function ideothemo_typografyMobileMenu()
{
    $option = ideothemo_getOption();
    global $settingHeader;

    echo '.menu-mobile a{ font-family: ' . (isset($option[$settingHeader['typografy']['mobile_menu']['font']['type']]) ? $option[$settingHeader['typografy']['mobile_menu']['font']['type']] : "arial") . ' }';
    echo '.menu-mobile a{ font-size: ' . (isset($option[$settingHeader['typografy']['mobile_menu']['font']['size']]) ? $option[$settingHeader['typografy']['mobile_menu']['font']['size']] : "20") . 'px }';
    echo '.menu-mobile a{ font-weight: ' . (isset($option[$settingHeader['typografy']['mobile_menu']['font']['weight']]) ? $option[$settingHeader['typografy']['mobile_menu']['font']['weight']] : "light") . ' }';
    echo '.menu-mobile a{ line-height: ' . (isset($option[$settingHeader['typografy']['mobile_menu']['line_height']]) ? $option[$settingHeader['typografy']['mobile_menu']['line_height']] / 10 : "1") . ' }';
    echo '.menu-mobile a{ letter-spacing: ' . (isset($option[$settingHeader['typografy']['mobile_menu']['letter_spacing']]) ? $option[$settingHeader['typografy']['mobile_menu']['letter_spacing']] : "20") . 'px }';
    if ($option[$settingHeader['typografy']['mobile_menu']['italic']]) {
        echo '.menu-mobile a{font-style:italic}';
    } else {
        echo '.menu-mobile a{font-style:normal}';
    }
}

function ideothemo_typografyMegaMenuColumnTitle()
{
    $option = ideothemo_getOption();
    global $settingHeader;

    echo '.menu-normal .megamenu{ font-family: ' . (isset($option[$settingHeader['typografy']['mega_menu_column_title']['font']['type']]) ? $option[$settingHeader['typografy']['mega_menu_column_title']['font']['type']] : "arial") . ' }';
    echo '.menu-normal .megamenu{ font-size: ' . (isset($option[$settingHeader['typografy']['mega_menu_column_title']['font']['size']]) ? $option[$settingHeader['typografy']['mega_menu_column_title']['font']['size']] : "20") . 'px }';
    echo '.menu-normal .megamenu{ font-weight: ' . (isset($option[$settingHeader['typografy']['mega_menu_column_title']['font']['weight']]) ? $option[$settingHeader['typografy']['mega_menu_column_title']['font']['weight']] : "light") . ' }';
    echo '.menu-normal .megamenu{ line-height: ' . (isset($option[$settingHeader['typografy']['mega_menu_column_title']['line_height']]) ? $option[$settingHeader['typografy']['mega_menu_column_title']['line_height']] / 10 : "1") . ' }';
    echo '.menu-normal .sub-menu .megamenu > a{ letter-spacing: ' . (isset($option[$settingHeader['typografy']['mega_menu_column_title']['letter_spacing']]) ? $option[$settingHeader['typografy']['mega_menu_column_title']['letter_spacing']] : "20") . 'px }';
    echo '.menu-normal .sub-menu .megamenu .overMenu > a{ letter-spacing: ' . (isset($option[$settingHeader['typografy']['mega_menu_column_title']['letter_spacing']]) ? $option[$settingHeader['typografy']['mega_menu_column_title']['letter_spacing']] : "20") . 'px }';
    if ($option[$settingHeader['typografy']['mega_menu_column_title']['italic']]) {
        echo '.menu-normal .megamenu{font-style:italic}';
    } else {
        echo '.menu-normal .megamenu{font-style:normal}';
    }
}

function ideothemo_typografyMegaMenu()
{
    $option = ideothemo_getOption();
    global $settingHeader;
    echo '.menu-normal .megamenu .sub-menu{ font-family: ' . (isset($option[$settingHeader['typografy']['mega_menu']['font']['type']]) ? $option[$settingHeader['typografy']['mega_menu']['font']['type']] : "arial") . ' }';
    echo '.menu-normal .megamenu .sub-menu{ font-size: ' . (isset($option[$settingHeader['typografy']['mega_menu']['font']['size']]) ? $option[$settingHeader['typografy']['mega_menu']['font']['size']] : "20") . 'px }';
    echo '.menu-normal .megamenu .sub-menu{ font-weight: ' . (isset($option[$settingHeader['typografy']['mega_menu']['font']['weight']]) ? $option[$settingHeader['typografy']['mega_menu']['font']['weight']] : "light") . ' }';
    echo '.menu-normal .megamenu .sub-menu{ line-height: ' . (isset($option[$settingHeader['typografy']['mega_menu']['line_height']]) ? $option[$settingHeader['typografy']['mega_menu']['line_height']] / 10 : "1") . ' }';
    echo '.menu-normal .megamenu .sub-menu a{ letter-spacing: ' . (isset($option[$settingHeader['typografy']['mega_menu']['letter_spacing']]) ? $option[$settingHeader['typografy']['mega_menu']['letter_spacing']] : "20") . 'px }';
    if ($option[$settingHeader['typografy']['mega_menu']['italic']]) {
        echo '.menu-normal .megamenu .sub-menu{font-style:italic}';
    } else {
        echo '.menu-normal .megamenu .sub-menu{font-style:normal}';
    }
}

function ideothemo_typografySubMenu()
{
    $option = ideothemo_getOption();
    global $settingHeader;
    echo '.menu-normal .sub-menu{ font-family: ' . (isset($option[$settingHeader['typografy']['submenu']['font']['type']]) ? $option[$settingHeader['typografy']['submenu']['font']['type']] : "arial") . ' }';
    echo '.menu-normal .sub-menu{ font-size: ' . (isset($option[$settingHeader['typografy']['submenu']['font']['size']]) ? $option[$settingHeader['typografy']['submenu']['font']['size']] : "20") . 'px }';
    echo '.menu-normal .sub-menu{ font-weight: ' . (isset($option[$settingHeader['typografy']['submenu']['font']['weight']]) ? $option[$settingHeader['typografy']['submenu']['font']['weight']] : "light") . ' }';
    echo '.menu-normal .sub-menu{ line-height: ' . (isset($option[$settingHeader['typografy']['submenu']['line_height']]) ? $option[$settingHeader['typografy']['submenu']['line_height']] / 10 : "1") . ' }';
    echo '.menu-normal .sub-menu a{ letter-spacing: ' . (isset($option[$settingHeader['typografy']['submenu']['letter_spacing']]) ? $option[$settingHeader['typografy']['submenu']['letter_spacing']] : "20") . 'px }';

    echo '.menu-side .sub-menu{ font-family: ' . (isset($option[$settingHeader['typografy']['submenu']['font']['type']]) ? $option[$settingHeader['typografy']['submenu']['font']['type']] : "arial") . ' }';
    echo '.menu-side .sub-menu{ font-size: ' . (isset($option[$settingHeader['typografy']['submenu']['font']['size']]) ? $option[$settingHeader['typografy']['submenu']['font']['size']] : "20") . 'px }';
    echo '.menu-side .sub-menu{ font-weight: ' . (isset($option[$settingHeader['typografy']['submenu']['font']['weight']]) ? $option[$settingHeader['typografy']['submenu']['font']['weight']] : "light") . ' }';
    echo '.menu-side .sub-menu{ line-height: ' . (isset($option[$settingHeader['typografy']['submenu']['line_height']]) ? $option[$settingHeader['typografy']['submenu']['line_height']] / 10 : "1") . ' }';
    echo '.menu-side .sub-menu a{ letter-spacing: ' . (isset($option[$settingHeader['typografy']['submenu']['letter_spacing']]) ? $option[$settingHeader['typografy']['submenu']['letter_spacing']] : "20") . 'px }';

    if ($option[$settingHeader['typografy']['submenu']['italic']]) {
        echo '.menu-normal .sub-menu{font-style:italic}';
        echo '.menu-side .sub-menu{font-style:italic}';
    } else {
        echo '.menu-normal .sub-menu{font-style:normal}';
        echo '.menu-side .sub-menu{font-style:normal}';
    }
}

function ideothemo_typografyMainMenu()
{
    $option = ideothemo_getOption();
    global $settingHeader;

    echo '.menu-normal .content{ font-family: ' . (isset($option[$settingHeader['typografy']['main_menu']['font']['type']]) ? $option[$settingHeader['typografy']['main_menu']['font']['type']] : "arial") . ' }';
    echo '.menu-normal .content{ font-size: ' . (isset($option[$settingHeader['typografy']['main_menu']['font']['size']]) ? $option[$settingHeader['typografy']['main_menu']['font']['size']] : "20") . 'px }';
    echo '.menu-normal .content{ font-weight: ' . (isset($option[$settingHeader['typografy']['main_menu']['font']['weight']]) ? $option[$settingHeader['typografy']['main_menu']['font']['weight']] : "light") . ' }';
    echo '.menu-normal .content{ line-height: ' . (isset($option[$settingHeader['typografy']['main_menu']['line_height']]) ? $option[$settingHeader['typografy']['main_menu']['line_height']] / 10 : "1") . ' }';
    echo '.menu-normal .content a{ letter-spacing: ' . (isset($option[$settingHeader['typografy']['main_menu']['letter_spacing']]) ? $option[$settingHeader['typografy']['main_menu']['letter_spacing']] : "20") . 'px }';

    echo '.menu-side .content{ font-family: ' . (isset($option[$settingHeader['typografy']['main_menu']['font']['type']]) ? $option[$settingHeader['typografy']['main_menu']['font']['type']] : "arial") . ' }';
    echo '.menu-side .content{ font-size: ' . (isset($option[$settingHeader['typografy']['main_menu']['font']['size']]) ? $option[$settingHeader['typografy']['main_menu']['font']['size']] : "20") . 'px }';
    echo '.menu-side .content{ font-weight: ' . (isset($option[$settingHeader['typografy']['main_menu']['font']['weight']]) ? $option[$settingHeader['typografy']['main_menu']['font']['weight']] : "light") . ' }';
    echo '.menu-side .content{ line-height: ' . (isset($option[$settingHeader['typografy']['main_menu']['line_height']]) ? $option[$settingHeader['typografy']['main_menu']['line_height']] / 10 : "1") . ' }';
    echo '.menu-side .content a{ letter-spacing: ' . (isset($option[$settingHeader['typografy']['main_menu']['letter_spacing']]) ? $option[$settingHeader['typografy']['main_menu']['letter_spacing']] : "20") . 'px }';

    if ($option[$settingHeader['typografy']['main_menu']['italic']]) {
        echo '.menu-normal .content{font-style:italic}';
        echo '.menu-side .content{font-style:italic}';
    } else {
        echo '.menu-normal .content{font-style:normal}';
        echo '.menu-side .content{font-style:normal}';
    }

    echo '.menu-normal .social_icon{ font-family: ' . (isset($option[$settingHeader['typografy']['main_menu']['font']['type']]) ? $option[$settingHeader['typografy']['main_menu']['font']['type']] : "arial") . ' }';
    echo '.menu-normal .social_icon{ font-size: ' . (isset($option[$settingHeader['typografy']['main_menu']['font']['size']]) ? $option[$settingHeader['typografy']['main_menu']['font']['size']] : "20") . 'px }';
    echo '.menu-normal .social_icon{ font-weight: ' . (isset($option[$settingHeader['typografy']['main_menu']['font']['weight']]) ? $option[$settingHeader['typografy']['main_menu']['font']['weight']] : "light") . ' }';
    echo '.menu-normal .social_icon{ line-height: ' . (isset($option[$settingHeader['typografy']['main_menu']['line_height']]) ? $option[$settingHeader['typografy']['main_menu']['line_height']] / 10 : "1") . ' }';
    echo '.menu-normal .social_icon a{ letter-spacing: ' . (isset($option[$settingHeader['typografy']['main_menu']['letter_spacing']]) ? $option[$settingHeader['typografy']['main_menu']['letter_spacing']] : "20") . 'px }';

    echo '.menu-side .social_icon{ font-family: ' . (isset($option[$settingHeader['typografy']['main_menu']['font']['type']]) ? $option[$settingHeader['typografy']['main_menu']['font']['type']] : "arial") . ' }';
    echo '.menu-side .social_icon{ font-size: ' . (isset($option[$settingHeader['typografy']['main_menu']['font']['size']]) ? $option[$settingHeader['typografy']['main_menu']['font']['size']] : "20") . 'px }';
    echo '.menu-side .social_icon{ font-weight: ' . (isset($option[$settingHeader['typografy']['main_menu']['font']['weight']]) ? $option[$settingHeader['typografy']['main_menu']['font']['weight']] : "light") . ' }';
    echo '.menu-side .social_icon{ line-height: ' . (isset($option[$settingHeader['typografy']['main_menu']['line_height']]) ? $option[$settingHeader['typografy']['main_menu']['line_height']] / 10 : "1") . ' }';
    echo '.menu-side .social_icon a{ letter-spacing: ' . (isset($option[$settingHeader['typografy']['main_menu']['letter_spacing']]) ? $option[$settingHeader['typografy']['main_menu']['letter_spacing']] : "20") . 'px }';

    if ($option[$settingHeader['typografy']['main_menu']['italic']]) {
        echo '.menu-normal .social_icon{font-style:italic}';
        echo '.menu-side .social_icon{font-style:italic}';
    } else {
        echo '.menu-normal .social_icon{font-style:normal}';
        echo '.menu-side .social_icon{font-style:normal}';
    }
}

//mobile

function ideothemo_mobileSettings()
{
    $option = ideothemo_getOption();
    global $settingHeader;
    if ($option[$settingHeader['mobile']['setting']['header_skin']] == "light" || !isset($option[$settingHeader['mobile']['setting']['header_skin']]) || $option[$settingHeader['sticky']['setting']['style']] == "X") {
        ideothemo_mobileLightStyling();
    } else if ($option[$settingHeader['mobile']['setting']['header_skin']] == "dark") {
        ideothemo_mobileDarkStyling();
    }
    if ($option[$settingHeader['mobile']['setting']['search_bar']]) {
        echo '.menu-mobile > .search input{ display: block }';
    } else {
        echo '.menu-mobile > .search input{ display: none }';
    }

    if ($option[$settingHeader['mobile']['setting']['social_media_icon']]) {
        echo '.menu-mobile > .content .icon{ display: block }';
    } else {
        echo '.menu-mobile > .content .icon{ display: none }';
    }
    echo '.menu-mobile > .logo img{ height: ' . (isset($option[$settingHeader['mobile']['setting']['logo']['height_in_mobile_menu']]) ? $option[$settingHeader['mobile']['setting']['logo']['height_in_mobile_menu']] : "10") . 'px }';
    echo '.menu-mobile > .logo img{ margin-top: ' . (isset($option[$settingHeader['mobile']['setting']['logo']['margin_top_bottom']]) ? $option[$settingHeader['mobile']['setting']['logo']['margin_top_bottom']] : "10") . 'px }';
    echo '.menu-mobile > .logo img{ margin-bottom: ' . (isset($option[$settingHeader['mobile']['setting']['logo']['margin_top_bottom']]) ? $option[$settingHeader['mobile']['setting']['logo']['margin_top_bottom']] : "10") . 'px }';
}

function ideothemo_mobileDarkStyling()
{
    $option = ideothemo_getOption();
    global $settingHeader;
    echo '.menu-mobile{ background: ' . $option[$settingHeader['mobile']['dark']['styling']['background_color']] . ' }';
    echo '.menu-mobile a{ color: ' . $option[$settingHeader['mobile']['dark']['styling']['text_color']] . ' }';
    if (isset($option[$settingHeader['mobile']['dark']['styling']['border-bottom-color']])) {
        echo '.menu-mobile a{ border-bottom-color: ' . $option[$settingHeader['mobile']['dark']['styling']['separators_color']] . ' }';
        echo '.menu-mobile a{ border-bottom-style: solid }';
        echo '.menu-mobile a{ border-bottom-width: 1px }';
    }
    echo '.open-close-menu-mobile span{color: ' . $option[$settingHeader['mobile']['dark']['styling']['icon_color']] . '}';
    echo '.menu-mobile .sub-menu{ background: ' . $option[$settingHeader['mobile']['dark']['styling']['first_dropdown_background']] . '}';
    echo '.menu-mobile .sub-menu .sub-menu{ background: ' . $option[$settingHeader['mobile']['dark']['styling']['second_dropdown_background']] . '}';
    echo '.menu-mobile a:hover{ color: ' . $option[$settingHeader['mobile']['dark']['styling']['text_hover_color']] . '}';
}

function ideothemo_mobileLightStyling()
{
    $option = ideothemo_getOption();
    global $settingHeader;
    echo '.menu-mobile{ background: ' . $option[$settingHeader['mobile']['light']['styling']['background_color']] . ' }';
    echo '.menu-mobile a{ color: ' . $option[$settingHeader['mobile']['light']['styling']['text_color']] . ' }';
    if (isset($option[$settingHeader['mobile']['light']['styling']['border-bottom-color']])) {
        echo '.menu-mobile a{ border-bottom-color: ' . $option[$settingHeader['mobile']['light']['styling']['separators_color']] . ' }';
        echo '.menu-mobile a{ border-bottom-style: solid }';
        echo '.menu-mobile a{ border-bottom-width: 1px }';
    }
    echo '.open-close-menu-mobile span{color: ' . $option[$settingHeader['mobile']['light']['styling']['icon_color']] . '}';
    echo '.menu-mobile .sub-menu{ background: ' . $option[$settingHeader['mobile']['light']['styling']['first_dropdown_background']] . '}';
    echo '.menu-mobile .sub-menu .sub-menu{ background: ' . $option[$settingHeader['mobile']['light']['styling']['second_dropdown_background']] . '}';
    echo '.menu-mobile a:hover{ color: ' . $option[$settingHeader['mobile']['light']['styling']['text_hover_color']] . '}';
}
