<?php

if (!function_exists('ideothemo_get_customizer_local_modification_trigger_controls')) {
    function ideothemo_get_customizer_local_modification_trigger_controls()
    {
        $controls = array('header.top.style', 'header.top.height', 'header.top.top_distance', 'header.top.topbar.enabled', 'header.top.topbar.height', 'pagetitle.page_title_settings.page_title_area');
        $values = array();

        foreach ($controls as $v) {
            $values[$v] = ideothemo_get_theme_mod_parse($v, null, true, false);
        }

        return $values;
    }
}

if (!function_exists('ideothemo_registered_sidebars')) {
    /**
     * Creating array with all registered sidebars
     *
     * @global array $wp_registered_sidebars
     * @param string $dest customizer|metabox - diffrent select fields needs diffrent options format
     * @param mixed boolean|string $addDefault - false (no default value), true (with default value), string - custom label
     * @return array $sidebars
     */
    function ideothemo_registered_sidebars($dest = 'customizer', $addDefault = false)
    {
        global $wp_registered_sidebars;

        $sidebars = array();

        //Adding default option to output array
        if ($addDefault) {
            $defaultOption[] = '';
            $defaultOption[] = $addDefault === true ? esc_html__('Default', 'themo') : $addDefault;

            switch ($dest) {
                case 'metabox':
                    $sidebars[] = $defaultOption;
                    break;
                default:
                    $sidebars[$defaultOption[0]] = $defaultOption[1];
            }

        }

        foreach ($wp_registered_sidebars AS $sidebar) {
            switch ($dest) {
                case 'metabox':
                    $temp = array($sidebar['id'], $sidebar['name']);
                    $sidebars[] = $temp;
                    break;
                default:
                    $sidebars[$sidebar['id']] = $sidebar['name'];
            }
        }

        return $sidebars;
    }
}

if (!function_exists('ideothemo_pagination_methods')) {
    function ideothemo_pagination_methods()
    {
        return array(
            'standard' => esc_html__('Standard pagination', 'themo'),
            'load_more' => esc_html__('Load more button', 'themo'),
            'infinity_scroll' => esc_html__('Infinity scroll', 'themo'),
        );
    }
}

if (!function_exists('ideothemo_get_skins')) {
    function ideothemo_get_skins()
    {
        return array(
            array('', esc_html__('Default', 'themo')),
            array('light', esc_html__('Light', 'themo')),
            array('dark', esc_html__('Dark', 'themo')),
        );
    }
}

if (!function_exists('ideothemo_get_background_patterns')) {
    function ideothemo_get_background_patterns($flipArray = false)
    {
        $array = array(
            '' => esc_html__('None', 'themo'),
            'small_dense_dots' => esc_html__('Small dense dots', 'themo'),
            'diagonal_thick_lines_left' => esc_html__('Diagonal thick lines left', 'themo'),
            'diagonal_thick_lines_right' => esc_html__('Diagonal thick lines right', 'themo'),
            'diagonal_thin_lines_left' => esc_html__('Diagonal thin lines left', 'themo'),
            'diagonal_thin_lines_right' => esc_html__('Diagonal thin lines right', 'themo'),
            'horizontal_thick_lines' => esc_html__('Horizontal thick lines', 'themo'),
            'horizontal_thin_lines' => esc_html__('Horizontal thin lines', 'themo'),
            'big_dots' => esc_html__('Big dots', 'themo'),
            'small_sparse_dots' => esc_html__('Small sparse dots', 'themo'),
            'medium_dots' => esc_html__('Medium dots', 'themo'),
            'vertical_thick_lines' => esc_html__('Vertical thick lines', 'themo'),
            'vertical_thin_lines' => esc_html__('Vertical thin lines', 'themo'),
            'small_dense_dots_transparent' => esc_html__('Small dense dots transparent', 'themo'),
            'diagonal_thick_lines_left_transparent' => esc_html__('Diagonal thick lines left transparent', 'themo'),            
            'diagonal_thick_lines_right_transparent' => esc_html__('Diagonal thick lines right transparent', 'themo'),            
            'diagonal_thin_lines_left_transparent' => esc_html__('Diagonal thin lines left transparent', 'themo'),            
            'diagonal_thin_lines_right_transparent' => esc_html__('Diagonal thin lines right transparent', 'themo'),            
            'horizontal_thick_lines_transparent' => esc_html__('Horizontal thick lines transparent', 'themo'),             
            'horizontal_thin_lines_transparent' => esc_html__('Horizontal thin lines transparent', 'themo'),            
            'big_dots_transparent' => esc_html__('Big dots transparent', 'themo'),            
            'small_sparse_dots_transparent' => esc_html__('Small sparse dots transparent', 'themo'),            
            'medium_dots_transparent' => esc_html__('Medium dots transparent', 'themo'),            
            'vertical_thick_lines_transparent' => esc_html__('Vertical thick lines transparent', 'themo'),            
            'vertical_thin_lines_transparent' => esc_html__('Vertical thin lines transparent', 'themo')
        );

        if ($flipArray) {
            $array = array_flip($array);
        }

        return $array;
    }
}
if (!function_exists('ideothemo_get_separators')) {
    function ideothemo_get_separators($filter, $flipArray = false)
    {
        if($filter == 'top'){
            $array = array(
                'separators/style_1_top.svg' =>  esc_html__('Style 1', 'themo'),
                'separators/style_2_top.svg' =>  esc_html__('Style 2', 'themo'),
                'separators/style_3_top.svg' =>  esc_html__('Style 3', 'themo'),
                'separators/style_4_top.svg' =>  esc_html__('Style 4', 'themo'),
                'separators/style_5_top.svg' =>  esc_html__('Style 5', 'themo'),
                'separators/style_6_top.svg' =>  esc_html__('Style 6', 'themo'),
                'separators/style_7_top.svg' =>  esc_html__('Style 7', 'themo'),
                'separators/style_8_top.svg' =>  esc_html__('Style 8', 'themo'),
                'separators/style_9_top.svg' =>  esc_html__('Style 9', 'themo'),
                'separators/style_10_top.svg' =>  esc_html__('Style 10', 'themo'),
            );            
        }else{
            $array = array(
                'separators/style_1_bottom.svg' =>  esc_html__('Style 1', 'themo'),
                'separators/style_2_bottom.svg' =>  esc_html__('Style 2', 'themo'),
                'separators/style_3_bottom.svg' =>  esc_html__('Style 3', 'themo'),
                'separators/style_4_bottom.svg' =>  esc_html__('Style 4', 'themo'),
                'separators/style_5_bottom.svg' =>  esc_html__('Style 5', 'themo'),
                'separators/style_6_bottom.svg' =>  esc_html__('Style 6', 'themo'),
                'separators/style_7_bottom.svg' =>  esc_html__('Style 7', 'themo'),
                'separators/style_8_bottom.svg' =>  esc_html__('Style 8', 'themo'),
                'separators/style_9_bottom.svg' =>  esc_html__('Style 9', 'themo'),
                'separators/style_10_top.svg' =>  esc_html__('Style 10', 'themo'),
            );            
        }

        if ($flipArray) {
            $array = array_flip($array);
        }

        return $array;
    }
}

if (!function_exists('ideothemo_local_modifications')) {
    function ideothemo_local_modifications($settings, $allowedBy = 'default')
    {
        if (ideothemo_is_customize_preview()) {
            $content = '';

            if (is_array($settings)) {
                $labels = array();
                foreach ($settings as $setting) {
                    $localOption = ideothemo_get_page_title_local_setting($setting);
                    $actualOption = ideothemo_get_page_title_setting($setting, false);
                    if ($localOption !== $allowedBy && !empty($localOption)) {
                        $labels[] = $setting;
                    }
                }
                if (count($labels) > 0) {
                    $content = ' data-local-modifications="' . esc_attr(implode(',', $labels)) . '"';
                }

            } else {
                $localOption = ideothemo_get_page_title_local_setting($settings);
                $actualOption = ideothemo_get_page_title_setting($settings, false);

                if ($localOption !== $allowedBy && !empty($localOption)) {
                    $content = ' data-local-modifications="' . esc_attr($settings) . '"';
                }
            }
            echo $content;
        }
    }
}

if (!function_exists('ideothemo_customize_attrs')) {
    /**
     * Adding information for customizer if selected element can be modified
     * Used in loop
     *
     * @param string $localOption
     * @param string $actualOption
     * @param string $type type of echo, data attribute or class name (data|class)
     * @param string $allowedBy
     *
     */
    function ideothemo_customize_attrs($localOption, $actualOption, $type = 'data', $allowedBy = 'default', $echo = 1)
    {
        $content = '';
        if (ideothemo_is_customize_preview()) {

            if ($localOption !== $allowedBy && !empty($localOption)) {
                switch ($type) {
                    case 'class':
                        $content = ' js--local-modifications';
                        break;
                    default:
                        $content = ' data-local-modifications="1"';
                }
            }

            if (!$actualOption) {
                switch ($type) {
                    default:
                        $content .= ' style="display:none"';
                }
            }

            if ($echo)
                echo $content;
        }

        return $content;
    }
}

if (!function_exists('ideothemo_is_customize_preview')) {
    function ideothemo_is_customize_preview()
    {
        return is_customize_preview() || ideothemo_is_ajax_preview();
    }
}


if (!function_exists('ideothemo_is_pc_mode')) {
    function ideothemo_is_pc_mode()
    {
        return is_customize_preview() && (isset($_GET['mode']) && $_GET['mode'] == 'pc') || (isset($_SERVER['HTTP_REFERER']) && parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY ) == 'mode=pc' );
    }
}

if (!function_exists('ideothemo_is_ajax_preview')) {
    function ideothemo_is_ajax_preview()
    {
        return (isset($_POST['ideo_theme_options']) && isset($_POST['ideo_action']) && $_POST['ideo_action'] == 'customize');
    }
}

if (!function_exists('ideothemo_get_button_styles')) {
    function ideothemo_get_button_styles()
    {
        return array(
            'none' => esc_html__('None', 'themo'),
            'small' => esc_html__('Small', 'themo'),
            'big' => esc_html__('Big', 'themo'),
        );
    }
}


if (!function_exists('ideothemo_get_list_pages')) {
    function ideothemo_get_list_pages()
    {
        if (($pages = wp_cache_get(__FUNCTION__)) === false) {
            $pages = array();

            /** @var WP_Post $page */
            foreach (get_pages() AS $page) {
                $pages[$page->ID] = $page->post_title;
            }

            wp_cache_set(__FUNCTION__, $pages);
        }

        return $pages;
    }
}

if (!function_exists('ideothemo_get_sidebar_position_settings')) {
    function ideothemo_get_sidebar_position_settings($default = true)
    {
        $positions = array();

        if ($default) {
            $positions[] = is_string($default) ? $default : esc_html__('Default', 'themo');
        }
        $positions['none'] = esc_html__('No sidebar', 'themo');
        $positions['left_sidebar'] = esc_html__('Left sidebar', 'themo');
        $positions['right_sidebar'] = esc_html__('Right sidebar', 'themo');

        return $positions;
    }
}

if (!function_exists('ideothemo_parse_mod_theme')) {
    function ideothemo_parse_mod_theme($mods)
    {
        $array = array();
        $mods = json_decode($mods, 1);

        if (!empty($mods)) {
            foreach ($mods AS $key => $value) {
                $array = array_merge_recursive($array, ideothemo_keys_do_array(ideothemo_string_to_array_keys($key), $value));
            }
        }

        return $array;
    }
}

if (!function_exists('ideothemo_keys_do_array')) {
    function ideothemo_keys_do_array($keys, $value)
    {
        $array = array();
        $current = &$array;
        foreach (array_slice($keys, 0, -1) as $k) {
            $current[$k] = array();
            $current =& $current[$k];
        }
        $current[$keys[count($keys) - 1]] = $value;

        return $array;
    }
}

if (!function_exists('ideothemo_string_to_array_keys')) {
    function ideothemo_string_to_array_keys($string)
    {
        $string = trim(str_replace('ideo_theme_options[', '', $string), ']');

        return array_values(explode('][', $string));
    }
}

if (!function_exists('ideothemo_get_pages_as_option')) {
    function ideothemo_get_pages_as_option()
    {
        $pages = get_pages(array(
            'posts_per_page' => -1,
            'sort_column' => 'ID'
        ));

        $options = array('' => esc_html__('Default', 'themo'));

        foreach ($pages as $page) {
            $options[$page->ID] = $page->post_title;
        }

        return $options;
    }
}

if (!function_exists('ideothemo_get_css_value_with_unit')) {
    function ideothemo_get_css_value_with_unit($value, $defaultUnit = 'px')
    {

        if (empty($value) && $value == '') {
            return 'false';
        }

        $number = apply_filters('ideothemo_customizer_number', $value);
        $unit = apply_filters('ideothemo_customizer_unit', $value, $defaultUnit);
        return $number . $unit;
    }
}

if (!function_exists('ideothemo_get_color_darken')) {
    function ideothemo_get_color_darken($value, $darken = 15)
    {

        if (empty($value) && $value == '') {
            return '';
        }

        return sprintf('darken(%s, %d%%)', $value, $darken);
    }
}
