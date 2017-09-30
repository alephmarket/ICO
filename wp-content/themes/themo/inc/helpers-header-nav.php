<?php

require_once(IDEOTHEMO_INIT_DIR . 'inc/customizer/function.php');
require_once(IDEOTHEMO_INIT_DIR . 'inc/header-default-vars.php');


add_filter('body_class', 'ideothemo_nav_body_classes');

if (!function_exists('ideothemo_nav_body_classes')) {
    function ideothemo_nav_body_classes($classes)
    {
        $header_type = ideothemo_get_header_setting('type');
        $classes[] = str_replace('_', '-', $header_type);

        if ($header_type == 'side_offcanvas_left_header') {
            $classes[] = 'side-left-header';
        }

        if ($header_type == 'side_offcanvas_right_header') {
            $classes[] = 'side-right-header';
        }

        if (in_array($header_type, array('side_offcanvas_left_header', 'side_offcanvas_right_header'))) {
            $classes[] = 'side-offcanvas-header';
            $classes[] =  ideothemo_get_header_setting( 'side.offcanvas.slide' ) == 'true' ? 'slide-content' : '';
            $classes[] =  ideothemo_get_header_setting( 'side.offcanvas.blur_content' ) == 'true' ? 'blur-content' : '';
        }

        if (in_array($header_type, array('side_left_header', 'side_right_header', 'side_offcanvas_left_header', 'side_offcanvas_right_header'))) {
            $classes[] = 'side-header';
        }

        if (in_array($header_type, array('side_left_header', 'side_offcanvas_left_header'))) {
            $classes[] = 'side-left';
        }

        if (in_array($header_type, array('side_right_header', 'side_offcanvas_right_header'))) {
            $classes[] = 'side-right';
        }

        return $classes;
    }
}

if (!function_exists('ideothemo_get_header_settings')) {
    function ideothemo_get_header_settings()
    {
        $default = ideothemo_get_header_default_settings();
        $global = ideothemo_array_replace_recursive($default, ideothemo_get_theme_mod_parse('header'));
        $local = ideothemo_get_page_option_setting('header');

        if (isset($local['overwrite_global_header']) && $local['overwrite_global_header'] == "on") {
            return ideothemo_migrate_header_settings(ideothemo_array_replace_recursive($global, $local));
        }

        return ideothemo_migrate_header_settings($global);
    }
}

if (!function_exists('ideothemo_migrate_header_settings')) {
    function ideothemo_migrate_header_settings($header_settings)
    {
        if ($header_settings['type'] == 'side_header') {
            $header_settings['type'] = 'side_' . $header_settings['side']['side'] . '_header';
        }

        return $header_settings;
    }
}

if (!function_exists('ideothemo_get_header_setting')) {
    function ideothemo_get_header_setting($string, $default = null)
    {
        if (($header_settings = wp_cache_get('header_settings_' . get_the_ID())) === false) {
            $header_settings = ideothemo_get_header_settings();
            wp_cache_set('header_settings_' . get_the_ID(), $header_settings);
        }
        return ideothemo_parse_dot_string($header_settings, $string, $default);
    }
}

if (!function_exists('ideothemo_get_header_true')) {
    function ideothemo_get_header_true($string, $default = false)
    {
        return ideothemo_get_header_setting($string, $default) === 'true' || ideothemo_get_header_setting($string, $default) === 'yes';
    }
}

if (!function_exists('ideothemo_is_header_type')) {
    function ideothemo_is_header_type($type)
    {
        $current_header = ideothemo_get_header_setting('type', false);

        if ($type == 'side')
            return $current_header == 'side_header' || $current_header == 'side_left_header' || $current_header == 'side_right_header';

        if ($type == 'side_offcanvas')
            return $current_header == 'side_offcanvas_header' || $current_header == 'side_offcanvas_left_header' || $current_header == 'side_offcanvas_right_header';

        $type .= '_header';

        return ideothemo_get_header_setting('type', false) === $type;
    }
}

if (!function_exists('ideothemo_get_default_header_style')) {
    function ideothemo_get_default_header_style($headerType){
        $themeSkin = ideothemo_get_general_theme_skin();

        if ($headerType == 'mobile' || $headerType == 'side' || $headerType == 'side_left' || $headerType == 'side_right')
            return $themeSkin;

        return 'colored-' . $themeSkin;
    }
}

if (!function_exists('ideothemo_get_header_style')) {
    /**
     * @param bool $useLocal
     * @param null $header_type 'top', 'sticky', 'side' or null for currently chosen header
     * @return bool|mixed|string
     */
    function ideothemo_get_header_style($useLocal = false, $header_type = null)
    {

        $setting = 'top.style';
        $real_type = 'top';

        switch (true) {
            case (ideothemo_is_header_type('side') || ideothemo_is_header_type('side_offcanvas')) && ($header_type == null || $header_type == 'side'):
                $setting = 'side.style';
                $real_type = 'side';
                break;


            case (ideothemo_is_header_type('sticky') || ideothemo_is_header_type('sticky_slide') || ideothemo_is_header_type('sticky_slide_hide')) && ($header_type == null || $header_type == 'sticky' || $header_type == 'sticky_slide'):
                $setting = 'sticky.style';
                $real_type = 'sticky';
                break;

            case $header_type == 'mobile':
                $setting = 'mobile.header_skin';
                $real_type = 'mobile';
                break;
        }

        $value = $useLocal ? ideothemo_get_page_option_setting('header.' . $setting, false, get_the_ID()) : str_replace('_','-',ideothemo_get_header_setting($setting));
        
        if (empty($value)) {
            $value = ideothemo_get_default_header_style($real_type);
        }

        return $value;
    }
}

if (!function_exists('ideothemo_get_var_parse')) {
    function ideothemo_get_var_parse($array, $string, $default = null)
    {
        return ideothemo_parse_dot_string($array, $string, $default);
    }
}

add_filter('wp_nav_menu_items', 'ideothemo_nav_menu_mobile_language_switcher');

if (!function_exists('ideothemo_nav_menu_mobile_language_switcher')) {
    function ideothemo_nav_menu_mobile_language_switcher($items)
    {
        if (ideothemo_get_header_true('mobile.remove_language_switcher'))
            return $items;

        if (($languages = ideothemo_get_languages()) === false)
            return $items;

        $items .= '<li id="menu-item-language-switcher" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children dropdown navbar-normal visible-sm visible-xs js-menu-dropdown">';

        $items .= '<a href="#" class="dropdown-toggle js-menu-dropdown-link" aria-haspopup="true" data-toggle="dropdown"><i class="fa fa-flag-o"></i></a>';

        $items .= '<div class="dropmenu"><ul class="menu" role="menu">';

        foreach ($languages as $key => $val) {
            $items .= '<li class="menu-item menu-item-type-post_type menu-item-object-page navbar-normal"><a href="' . esc_url($val['url']) . '">' . esc_html($val['native_name']) . '</a></li>';
        }

        $items .= '</ul></div></li>';

        return $items;
    }
}

if (!function_exists('ideothemo_nav_menu')) {
    function ideothemo_nav_menu($depth = 3)
    {
        $standard_menu_location = ideothemo_get_header_setting('menu_location') ?: 'main-menu';
        $mobile_menu_location = ideothemo_get_header_setting('mobile_menu_location');
        $use_mobile = !empty($mobile_menu_location) && $standard_menu_location != $mobile_menu_location;

        wp_nav_menu(array(
                'theme_location' => $standard_menu_location,
                'depth' => $depth,
                'container' => '',
                'menu_class' => 'nav navbar-nav navbar-right navbar-menu' . ($use_mobile ? ' navbar-visible-standard' : ''),
                'fallback_cb' => 'ideothemo_navwalker::fallback',
                'walker' => new ideothemo_navwalker()
            )
        );

        if ($use_mobile) {
            wp_nav_menu(array(
                    'theme_location' => $mobile_menu_location,
                    'depth' => $depth,
                    'container' => '',
                    'menu_class' => 'nav navbar-nav navbar-right navbar-menu navbar-visible-mobile',
                    'fallback_cb' => 'ideothemo_navwalker::fallback',
                    'walker' => new ideothemo_navwalker()
                )
            );
        }
    }
}
if (!function_exists('ideothemo_logo_header')) {
    function ideothemo_logo_header($header_type, $alt = '')
    {
        echo ideothemo_get_logo_header($header_type, $alt);
    }
}

if (!function_exists('ideothemo_setting_class')) {
    function ideothemo_setting_class($setting, $class = '')
    {
        $string = ideothemo_get_header_setting($setting);
        if (!empty($setting)) {
            if (!$class) {
                echo ideothemo_get_header_setting($string);
            } else {
                echo esc_attr($class);
            }
        }
    }
}
if (!function_exists('ideothemo_get_logo_header')) {
    function ideothemo_get_logo_header($header_type, $alt = '')
    {
        
        $logo_type = ideothemo_get_header_setting($header_type . '.logo.type');
        $src = ideothemo_get_header_setting('logo.' . $logo_type);

        $data = '';
        if (ideothemo_get_header_setting('logo.retina.enable')) {
            $src_retina = ideothemo_get_header_setting('logo.retina.' . $logo_type);
            if ($src_retina) {
                $data = ' data-at2x="' . $src_retina . '"';
            }
        }

        return '<img src="http://alephmarket.io/wp-content/uploads/2017/02/logo-uni-01-dark.png"' . $data . ' alt="' . $alt . '" class="logo-' . ($header_type == 'mobile' ? 'mobile' : 'standard') . ' ' . ($src == '' ? 'no-src' : '') . '">';
    }
}
if (!function_exists('ideothemo_get_offcanvas_bar_logo')) {
    function ideothemo_get_offcanvas_bar_logo($bar, $alt = '')
    {
        
        $logo_topbar_type = ideothemo_get_header_setting('side.offcanvas.topbar.logo.type');
        $logo_stickybar_type = ideothemo_get_header_setting('side.offcanvas.stickybar.logo.type');
        $src_topbar = ideothemo_get_header_setting('logo.' . $logo_topbar_type);
        $src_stickybar = ideothemo_get_header_setting('logo.' . $logo_stickybar_type);

        $data = ' data-topbar-src="' . $src_topbar . '" data-stickybar-src="' . $src_stickybar . '" ';
        if (ideothemo_get_header_setting('logo.retina.enable')) {
            $src_retina_topbar = ideothemo_get_header_setting('logo.retina.' . $logo_topbar_type);
            $src_retina_stickybar = ideothemo_get_header_setting('logo.retina.' . $logo_stickybar_type);
            if ($src_retina_topbar) {
                $data .= ' data-at2x="' . $src_retina_topbar . '"';
            }
        }

        return '<img src="' . $src_topbar . '"' . $data . ' alt="' . $alt . '" class="' . ($src_topbar == '' ? 'no-src' : '') . '">';
    }
}

function ideothemo_getAccentColor($args)
{
    $options = ideothemo_getOption();
    if ($args['typeColor'] == "TopStickyColoredDark" || $args['typeColor'] == "SideDark" || $args['typeColor'] == "MobileDark") {
        return $options['general_style_color_dark_accent_setting'];
    } else if ($args['typeColor'] == "TopStickyColoredLight" || $args['typeColor'] == "SideLight" || $args['typeColor'] == "MobileLight") {
        return $options['general_style_color_light_accent_setting'];
    } else if ($args['typeColor'] == "TopStickyTransparentDark") {
        return $options['general_style_transparent_dark_accent_setting'];
    } else if ($args['typeColor'] == "TopStickyTransparentLight") {
        return $options['general_style_transparent_light_accent_setting'];
    }
}

if (!function_exists('ideothemo_get_header_nav')) {
    function ideothemo_get_header_nav()
    {
        if (!ideothemo_header_is_enabled())
            return;

        $header_type = ideothemo_get_header_setting('type');

        if ($header_type == 'side_left_header' || $header_type == 'side_right_header') {
            $header_type = 'side_header';
        }

        if ($header_type == 'side_offcanvas_left_header' || $header_type == 'side_offcanvas_right_header') {
            $header_type = 'side_offcanvas_header';
        }

        if (locate_template('parts/menu/' . $header_type . '.php') != '') {
            get_template_part('parts/menu/' . $header_type);
        } else {
            echo 'no menu file ' . ideothemo_get_header_setting('type');
        }


    }
}

if (!function_exists('ideothemo_header_is_enabled')) {
    /*
     * Check if header (menu) is enabled
     * This option can be set only in Page Options
     * 
     * @return boolean
     * 
     */

    function ideothemo_header_is_enabled()
    {

//        if (ideothemo_is_nopo_template()) {
//            return true;
//        }

        if(ideothemo_get_custom_post_meta('header.overwrite_global_header')){
            return ideothemo_blog_is_switch_enabled(ideothemo_get_custom_post_meta('header.overwrite_global_header'));            
        }
        
        return true;
    }
}


if (!function_exists('ideothemo_language_switcher')) {

    function ideothemo_language_switcher()
    {

        if (function_exists('icl_object_id')) {

            if (ideothemo_get_header_true('top.remove_language_switcher'))
                return null;

            $languages = apply_filters('wpml_active_languages', NULL, 'orderby=id&order=desc');

            $enable_shortcuts = ideothemo_get_header_true('top.enable_language_shortcuts');

            if (0 < count($languages)) {
                ?>

                <li class="navbar-normal navbar-language-switcher<?php if (!$enable_shortcuts) echo ' language-switcher-full-names'; ?>">
                    <a href="#" class="dropdown-toggle"><i class="fa fa-flag-o"></i></a>
                    <div class="dropmenu">
                        <ul class="menu ">
                            <?php
                            foreach ($languages as $key => $val) {
                                ?>
                                <li>
                                    <a href="<?php echo esc_url($val['url']); ?>"><?php echo $enable_shortcuts ? esc_html($key) : esc_html($val['native_name']); ?></a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </li>
                <?php
            }
        }
    }
}

if (!function_exists('ideothemo_language_switcher_side')) {

    function ideothemo_language_switcher_side()
    {

        if (ideothemo_get_header_true('side.remove_language_switcher'))
            return null;

        if (($languages = ideothemo_get_languages()) === false)
            return null;
        ?>
        <ul class="lang-switch">
            <?php foreach ($languages as $key => $val) { ?>
                <li<?php if ($val['active'] == '1') { ?> class="active"<?php } ?>>
                       <a href="<?php echo esc_url($val['url']); ?>"><?php echo esc_html($key); ?></a></li>
            <?php } ?>
        </ul>
        <?php
    }
}

if (!function_exists('ideothemo_language_switcher')) {

    function ideothemo_language_switcher()
    {

        if (ideothemo_get_header_true('top.remove_language_switcher'))
            return null;

        if (($languages = ideothemo_get_languages()) === false)
            return null;

        $enable_shortcuts = ideothemo_get_header_true('top.enable_language_shortcuts');

        ?>

        <li class="navbar-normal navbar-language-switcher<?php if (!$enable_shortcuts) echo ' language-switcher-full-names'; ?>">
            <a href="#" class="dropdown-toggle"><i class="fa fa-flag-o"></i></a>
            <div class="dropmenu">
                <ul class="menu ">
                    <?php
                    foreach ($languages as $key => $val) {
                        ?>
                        <li>
                            <a href="<?php echo esc_url($val['url']); ?>"><?php echo $enable_shortcuts ? esc_html($key) : esc_html($val['native_name']); ?></a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </li>
        <?php
    }
}

if (!function_exists('ideothemo_get_languages')) {
    function ideothemo_get_languages()
    {
        if (function_exists('icl_object_id')) {
            $languages = apply_filters('wpml_active_languages', NULL, 'orderby=id&order=desc');

            if (count($languages) > 0)
                return $languages;
        }

        return false;
    }
}

if (!function_exists('ideothemo_calc_header_menu_height')) {
    /**
     * Calculate real height of header menu or top bar
     *
     * @return integer calculated height value
     */
    function ideothemo_calc_header_menu_height()
    {
        $calculated = ideothemo_get_header_setting('top.height') + ideothemo_get_header_setting('top.top_distance') ?: 0;
        $settings = ideothemo_get_header_setting('top.topbar');

        if (isset($settings['enabled']) && filter_var($settings['enabled'], FILTER_VALIDATE_BOOLEAN)) {
            $calculated += 20;
        }

        $headerType = ideothemo_get_header_setting('type');

        if ('side_left_header' === $headerType || 'side_right_header' === $headerType) {
            $calculated -= ideothemo_get_header_setting('top.height') + ideothemo_get_header_setting('top.top_distance');
        }

        return $calculated;
    }
}

if (!function_exists('ideothemo_side_header_classes')) {
    function ideothemo_side_header_classes($classes = array())
    {

        $skin = ideothemo_get_header_style(true, 'side');

        $classes[] = 'navbar-menu';

        $align = ideothemo_get_header_setting('type') == 'side_offcanvas_right_header' || ideothemo_get_header_setting('type') == 'side_right_header' ? 'right' : 'left';
        $classes[] = sprintf('align-%s', $align);

        $classes[] = sprintf('skin-%s', $skin);
        $classes[] = ideothemo_is_boxed_version() ? 'row' : 'row';

        $classes[] = 'navbar-menu';
        $classes[] = 'menu-' . ideothemo_get_header_setting('side.align.menu');
        $classes[] = 'bottom-' . ideothemo_get_header_setting('side.align.bottom_area');

        if (ideothemo_get_header_setting('side.search_form') == 'false')
            $classes[] = 'side-search-off';

        $type = ideothemo_get_header_setting('side.' . $skin . '.styling.background');
        $overlay = $type == 'image' ? ideothemo_get_header_setting('side.' . $skin . '.styling.image_background.image_overlay.type') : 'pattern';

        $bgSettings = array(
            'background-type' => $type,
            'background-overlay' => $overlay
        );

        $classes = array_merge($classes, ideothemo_get_background_classes($bgSettings));

        return implode(' ', $classes);
    }
}

if (!function_exists('ideothemo_is_topbar_enabled')) {
    /**
     * Chech if top bar is enabled
     *
     * @return boolean
     */
    function ideothemo_is_topbar_enabled()
    {
        //local setting
        $is_localy_enabled = ideothemo_get_header_setting('overwrite_global_header') == 'on';
        $has_active_sidebar = is_active_sidebar('header-topbar-left') || is_active_sidebar('header-topbar-right');

        return ideothemo_get_header_true('top.topbar.enabled');
    }

}

if (!function_exists('ideothemo_side_header_copyright')) {
    /**
     * Gets copyright text for side header with new lines converted to <br/> tags
     *
     * @return string
     */
    function ideothemo_side_header_copyright()
    {
        return ideothemo_normalize_text(ideothemo_get_header_setting('side.copyright'), true);
    }
}

if (!function_exists('ideothemo_get_header_font_setting')) {
    /**
     * Gets header font setting
     *
     * @param $element Font element (i.e. main_menu)
     * @param $option Setting type (i.e. font_family)
     * @return mixed Setting value
     */
    function ideothemo_get_header_font_setting($element, $option)
    {
        return ideothemo_get_theme_mod_parse("header.typography.$element.$option");
    }

}