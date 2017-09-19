<?php

/**
 * Functions to help working with theme settings
 */

if (!function_exists('ideothemo_blog_setting_enabled')) {
    /**
     * check if have to render element
     *
     * @param string $name
     * @param string $local
     * @return boolean
     */

    function ideothemo_blog_setting_enabled($name, $local = '')
    {
        return ideothemo_blog_is_part_enabled('blog.blog_settings.' . $name, $local);
    }
}

if (!function_exists('ideothemo_blog_is_part_enabled')) {
    /**
     * check if have to render element
     * add extra conditions here for all elements
     *
     * @param string $globalName
     * @param string $local
     * @param boolean $customizeEnabled if customize should have impact on return value
     * @return boolean
     */
    function ideothemo_blog_is_part_enabled($globalName, $local = '', $customizeEnabled = true)
    {

        if ($customizeEnabled && ideothemo_is_customize_preview()) {
            return true;
        }

        $global = ideothemo_get_theme_mod_parse($globalName);

        return ideothemo_blog_is_switch_enabled($global, $local);
    }
}

if (!function_exists('ideothemo_blog_is_switch_enabled')) {
    /**
     * Let's you compare local and global on/off settings
     *
     * @param string $global
     * @param string $local
     * @return boolean
     */
}

if (!function_exists('ideothemo_blog_is_switch_enabled')) {
    /**
     * Check option value
     *
     * @param $lowPriority
     * @param string $highPriority
     * @return bool
     */

    function ideothemo_blog_is_switch_enabled($lowPriority, $highPriority = '')
    {
        $option = filter_var(ideothemo_blog_get_option($lowPriority, $highPriority), FILTER_VALIDATE_BOOLEAN);

        return $option;
    }
}

if (!function_exists('ideothemo_blog_get_option')) {
    /**
     * Get local or global setting
     *
     * @param string $lowPriority
     * @param string $highPriority
     * @return mixed $switch
     *
     * TODO: function name is confusing
     */
    function ideothemo_blog_get_option($lowPriority, $highPriority = '')
    {
        $switch = $lowPriority;
        if ($highPriority !== null && $highPriority !== '' && $highPriority !== 'default') {
            $switch = $highPriority;
        }

        return $switch;
    }
}

if (!function_exists('get_list_enabled_social_media')) {
    /**
     * Get enabled social media list
     *
     * @param array $atts
     * @return array
     */

    function get_list_enabled_social_media($atts = array())
    {
        $social_array = array();

        foreach (ideothemo_get_social_media_list() AS $social) {

            $local = isset($atts['el_' . $social]) ? $atts['el_' . $social] : '';

            if (ideothemo_get_enabled_social_media($social, $local))
                $social_array[] = $social;
        }

        return $social_array;
    }
}


if (!function_exists('ideothemo_get_theme_skin_class')) {
    /**
     * Return theme skin class
     *
     * @return string
     */
    function ideothemo_get_theme_skin_class()
    {
        $prefix = 'skin-';
        $themeSkin = ideothemo_get_general_theme_skin();

        return $prefix . $themeSkin;
    }
}

if (!function_exists('ideothemo_get_shortcodes_default_style')) {
    /**
     * Return default shortcodes skin
     *
     * @return string
     */
    function ideothemo_get_shortcodes_default_style($shortcode)
    {
        switch($shortcode){
            case 'ideo_accordion': return 'colored-light';
            case 'ideo_block': return 'transparent-dark';
            case 'ideo_block_styled': return 'colored-light';
            case 'ideo_blog': return 'colored-light';
            case 'ideo_button': return 'colored-dark';
            case 'ideo_calltoaction': return 'colored-light';
            case 'ideo_contact_form7': return 'transparent-dark';
            case 'ideo_counter': return 'transparent-dark';
            case 'ideo_custom_list': return 'transparent-dark';
            case 'ideo_divider': return 'transparent-dark';
            case 'ideo_divider_icon': return 'colored-dark';
            case 'ideo_iconbox': return 'colored-light';
            case 'ideo_iconbox2': return 'colored-light';
            case 'ideo_icons': return 'colored-dark';
            case 'ideo_imagebox': return 'colored-light';
            case 'ideo_message_box': return 'colored-light';
            case 'ideo_pie_chart': return 'transparent-dark';
            case 'ideo_pricing_table': return 'colored-light';
            case 'ideo_progress_bar': return 'colored-dark';
            case 'ideo_single_image': return 'colored-dark';
            case 'ideo_tabs': return 'colored-light';
            case 'ideo_team_box': return 'colored-dark';
            case 'ideo_team_box_caption': return 'colored-light';
            case 'ideo_testimonials_slider': return 'transparent-dark';
            case 'ideo_wow_title': return 'transparent-dark';
            default: return '';
        }
    }
}

if (!function_exists('ideothemo_get_shortcodes_button_default_style')) {
    /**
     * Return default shortcodes skin
     *
     * @return string
     */
    function ideothemo_get_shortcodes_button_default_style($style, $shortcode ='')
    {
        switch($shortcode){
            case 'ideo_contact_form7': 
                    switch($style){
                        case 'colored-dark' : return 'colored-dark';
                        case 'colored-light' : return 'colored-dark';
                        case 'transparent-dark' : return 'colored-dark-to-transparent-invert';
                        case 'transparent-light' : return 'transparent-light';
                        default: return ideothemo_get_shortcodes_default_style('ideo_button');
                    }
                break;
            case 'ideo_cta_button': 
                    switch($style){
                        case 'colored-dark' : return 'colored-dark';
                        case 'colored-light' : return 'colored-dark';
                        case 'transparent-dark' : return 'colored-dark';
                        case 'transparent-light' : return 'colored-dark';
                        default: return ideothemo_get_shortcodes_default_style('ideo_button');
                    }
                break;
            case 'ideo_pricing_table': 
                    switch($style){
                        case 'colored-dark' : return 'colored-dark';
                        case 'colored-light' : return 'colored-dark';
                        case 'transparent-dark' : return 'colored-dark';
                        case 'transparent-light' : return 'colored-dark';
                        default: return ideothemo_get_shortcodes_default_style('ideo_button');
                    }
                break;
            default:
                switch($style){
                    case 'colored-dark' : return 'transparent-light';
                    case 'colored-light' : return 'colored-dark-to-transparent-invert';
                    case 'transparent-dark' : return 'colored-dark-to-transparent-invert';
                    case 'transparent-light' : return 'transparent-light';
                    default: return ideothemo_get_shortcodes_default_style('ideo_button');
                }
        }
        
    }
}

if (!function_exists('ideothemo_get_shortcodes_skin_class')) {
    /**
     * Return theme skin class
     *
     * @return string
     */
    function ideothemo_get_shortcodes_skin_class()
    {
        $prefix = 'skin-';
        $themeSkin = ideothemo_get_general_theme_skin();


        return $prefix . $themeSkin;
    }
}

if (!function_exists('ideothemo_customizer_visibility_class')) {
    /**
     * Return class for preview in WP customizer
     *
     * @param string $global
     * @param string $local
     * @return string
     */
    function ideothemo_customizer_visibility_class($global, $local = '')
    {
        $class = '';

        if (ideothemo_is_customize_preview() && !ideothemo_blog_is_part_enabled($global, ideothemo_get_post_meta($global))) {
            $class = 'hide';
        }

        return $class;
    }
}

if (!function_exists('ideothemo_get_layout_type')) {
    /**
     * Return layout type name as string boxed | wide
     *
     * @return string
     */
    function ideothemo_get_layout_type()
    {
        return ideothemo_get_page_setting('generals.layout.boxed_version', 1) ? 'boxed' : 'wide';
    }
}

if (!function_exists('ideothemo_get_advanced_loader_color')) {
    function ideothemo_get_advanced_loader_color() {
        $value = ideothemo_get_theme_mod_parse('advanced.advanced_loading.advanced_loader_color');

        if (!empty($value))
            return $value;

        return ideothemo_get_general_theme_skin() == 'light' ? '#3a3a3a' : "#ffffff";
    }
}

if (!function_exists('ideothemo_get_advanced_loader_background_color')) {
    function ideothemo_get_advanced_loader_background_color() {
        $value = ideothemo_get_theme_mod_parse('advanced.advanced_loading.advanced_loader_background_color');

        if (!empty($value))
            return $value;

        return ideothemo_get_general_theme_skin() == 'light' ? "#ffffff": '#3a3a3a';
    }
}