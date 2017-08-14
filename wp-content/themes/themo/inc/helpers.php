<?php

include_once(IDEOTHEMO_INIT_DIR . 'inc/helpers-settings.php');
include_once(IDEOTHEMO_INIT_DIR . 'inc/helpers-generals.php');
include_once(IDEOTHEMO_INIT_DIR . 'inc/helpers-customizer.php');
include_once(IDEOTHEMO_INIT_DIR . 'inc/helpers-page-title.php');
include_once(IDEOTHEMO_INIT_DIR . 'inc/helpers-post.php');
include_once(IDEOTHEMO_INIT_DIR . 'inc/helpers-fonts.php');
include_once(IDEOTHEMO_INIT_DIR . 'inc/helpers-sidebar.php');
include_once(IDEOTHEMO_INIT_DIR . 'inc/helpers-blog.php');
include_once(IDEOTHEMO_INIT_DIR . 'inc/helpers-team.php');
include_once(IDEOTHEMO_INIT_DIR . 'inc/helpers-slider.php');
include_once(IDEOTHEMO_INIT_DIR . 'inc/helpers-social.php');
include_once(IDEOTHEMO_INIT_DIR . 'inc/helpers-portfolio.php');
include_once(IDEOTHEMO_INIT_DIR . 'inc/helpers-blog-shortcode.php');
include_once(IDEOTHEMO_INIT_DIR . 'inc/helpers-archive.php');
include_once(IDEOTHEMO_INIT_DIR . 'inc/helpers-search.php');
include_once(IDEOTHEMO_INIT_DIR . 'inc/helpers-html.php');
include_once(IDEOTHEMO_INIT_DIR . 'inc/helpers-options.php');
include_once(IDEOTHEMO_INIT_DIR . 'inc/helpers-page-options.php');
include_once(IDEOTHEMO_INIT_DIR . 'inc/helpers-header-nav.php');
include_once(IDEOTHEMO_INIT_DIR . 'inc/helpers-others.php');
include_once(IDEOTHEMO_INIT_DIR . 'inc/helpers/customizer/customizer.php');

if (!class_exists('DirectoryIterator')) {
    wp_die(esc_html__('Class DirectoryIterator is disabled', 'themo'));
}

foreach (new DirectoryIterator(realpath(__DIR__ . '/helpers')) as $_dir) {
    if ($_dir->isFile()) {
        require $_dir->getPathname();
    }
}

function &ideothemo_add_custom_style($css = '')
{
    static $styles = '';
    static $styles_array = array();

    if ($css) {
        $styles .= $css;
        $styles_array[] = $css;
    }
    if ($css == 'reset') {
        $styles = '';
    }
    if ($css == 'array') {
        return $styles_array;
    }

    return $styles;
}

function ideothemo_add_style($css, $type = 'custom-css', $parms = array())
{
    $css = trim(ideothemo_compile_less($css, $parms));

    if ( 
    (defined('DOING_AJAX') && DOING_AJAX)
    ) {
        if (!empty($css)) {
            return '<style type="text/css" data-type="' . $type . '" >' . $css . '</style>';
        }
    } else {
        ideothemo_add_custom_style($css);
    }


    return '';
}

function ideothemo_str_clean($str)
{
    $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
    $clean = strtolower(trim($clean, '-'));
    $clean = preg_replace("/[\/_|+ -]+/", '-', $clean);

    return $clean;
}

function ideothemo_get_colors_defined($name = '')
{

    $theme_colors = get_theme_mod('colors');

    if ($name == 'all') {
        return $theme_colors;
    }

    if ($name && $theme_colors) {
        foreach ($theme_colors as $color) {
            if (ideothemo_str_clean($name) == ideothemo_str_clean($color['name'])) {
                return $color['colors'];
            }
        }
    }

    return $theme_colors[0]['colors'];

}

function ideothemo_custom_style($element, $uid, $default_vars, $style, $element_colors, $less)
{
    $vars = false;

    if (is_array($default_vars)) {
        if ($style == 'colored-dark' || $style == 'colored-light' || $style == 'colored-light-to-transparent' || $style == 'colored-dark-to-transparent' || $style == 'colored-light-to-transparent-invert' || $style == 'colored-dark-to-transparent-invert') {
            $lessfile = IDEOTHEMO_LESS_SC_PATH . $element . '-colored-custom.less';
            $default_vars = $default_vars['colored'];
        } else if ($style == 'transparent-dark' || $style == 'transparent-light') {
            $lessfile = IDEOTHEMO_LESS_SC_PATH . $element . '-transparent-custom.less';
            $default_vars = $default_vars['transparent'];
        }

        $default_vars['id'] = $element . '_' . $uid;

        $vars = ideothemo_custom_style_colors($default_vars['id'], $element_colors, $default_vars);

    }

    if ($vars) {
        return ideothemo_add_style($less, 'vc_shortcodes-custom-css', array('vars' => $vars, 'file' => $lessfile));
    } else {
        return ideothemo_add_style($less, 'vc_shortcodes-custom-css');
    }

}

function ideothemo_get_colors()
{
    $theme_colors = get_theme_mod('colors');
    $output = array();

    foreach ($theme_colors as $color) {
        $output[ideothemo_str_clean($color['name'])] = $color['colors'];
    }

    return $output;
}

function ideothemo_get_colors_by_style($style)
{

    if ($cache = ideothemo_global_vars_get('ideo_get_colors_by_style_' . $style)) {
        return $cache;
    }

    $style_name = 'colored-light';

    $def_array = array(
        'accent_color' => '',
        'title_color' => '',
        'text_color' => '',
        'icon_color' => '',
        'background_color' => '',
        'alternative_title_color' => ''
    );

    $colors = ideothemo_get_theme_mod_sc_colors();

    if ($style == 'colored-dark' || $style == 'colored-light' || $style == 'transparent-dark' || $style == 'transparent-light') {
        $style_name = $style;
    } else if ($style == 'colored-light-to-transparent' || $style == 'colored-light-to-transparent-invert') {
        $style_name = 'colored-light';
    } else if ($style == 'colored-dark-to-transparent' || $style == 'colored-dark-to-transparent-invert') {
        $style_name = 'colored-dark';
    }

    $out = array_replace_recursive($def_array, (array)$colors[$style_name]);

    ideothemo_global_vars_add('ideo_get_colors_by_style_' . $style, $out);

    return $out;
}

function ideothemo_hex2rgba($color, $opacity = false)
{

    $default = 'rgb(0,0,0)';

    if (empty($color)) {
        return $default;
    }

    if ($color[0] == '#') {
        $color = substr($color, 1);
    }

    if (strlen($color) == 6) {
        $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
    } elseif (strlen($color) == 3) {
        $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
    } else {
        return $default;
    }

    $rgb = array_map('hexdec', $hex);

    if ($opacity !== false) {
        if (abs($opacity) > 1) {
            $opacity = 1.0;
        }
        $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
    } else {
        $output = 'rgb(' . implode(",", $rgb) . ')';
    }

    return $output;
}

function ideothemo_get_colors_by_name($name, $darken = false, $alpha = 100)
{

    $colors = ideothemo_get_colors();
    $style = get_theme_mod('global_shortcode_style');

    $color = $colors[$style][$name];
    if ($darken === true && class_exists('Less_Parser')) {
        $parser = new Less_Parser();
        $parser->parse('.color{color:' . $color . ' - #222;}');

        preg_match('/:\s([#A-Fa-f0-9]+);/', $parser->getCss(), $matches);
        $color = $matches[1];
    }

    return $color;
}

function ideothemo_get_theme_mod_sc_color($skin, $type, $default='#f00')
{

   $colors = ideothemo_get_theme_mod_sc_colors();

   return isset($colors[$skin][$type]) && !empty($colors[$skin][$type]) ? $colors[$skin][$type] :$default;
}

function ideothemo_get_theme_mod_sc_colors()
{
    if ($cache = ideothemo_global_vars_get('ideo_get_theme_mod_sc_colors')) {
        return $cache;
    }
    $default = ideothemo_get_colors();

    $accent_color = ideothemo_is_color(ideothemo_get_general_accent_color());

    $colored_dark_accent_color = ideothemo_get_accent_color('shortcodes.shortcodes_coloring.sc_colored_dark_accent_color');
    $colored_light_accent_color = ideothemo_get_accent_color('shortcodes.shortcodes_coloring.sc_colored_light_accent_color');
    $transparent_dark_accent_color = ideothemo_get_accent_color('shortcodes.shortcodes_coloring.sc_transparent_dark_accent_color');
    $transparent_light_accent_color = ideothemo_get_accent_color('shortcodes.shortcodes_coloring.sc_transparent_light_accent_color');

    $sc_colors = array(
        'colored-dark' => array(
            'accent_color' => ideothemo_is_color($colored_dark_accent_color),
            'title_color' => ideothemo_is_color(ideothemo_get_page_option_setting('shortcodes.shortcodes_coloring.sc_colored_dark_title_color')),
            'text_color' => ideothemo_is_color(ideothemo_get_page_option_setting('shortcodes.shortcodes_coloring.sc_colored_dark_text_color')),
            'icon_color' => ideothemo_is_color(ideothemo_get_page_option_setting('shortcodes.shortcodes_coloring.sc_colored_dark_icon_color')),
            'background_color' => ideothemo_is_color(ideothemo_get_page_option_setting('shortcodes.shortcodes_coloring.sc_colored_dark_background_color')),
            'alternative_title_color' => ideothemo_is_color(ideothemo_get_page_option_setting('shortcodes.shortcodes_coloring.sc_colored_dark_alternative_title_color')),
        ),
        'colored-light' => array(
            'accent_color' => ideothemo_is_color($colored_light_accent_color),
            'title_color' => ideothemo_is_color(ideothemo_get_page_option_setting('shortcodes.shortcodes_coloring.sc_colored_light_title_color')),
            'text_color' => ideothemo_is_color(ideothemo_get_page_option_setting('shortcodes.shortcodes_coloring.sc_colored_light_text_color')),
            'icon_color' => ideothemo_is_color(ideothemo_get_page_option_setting('shortcodes.shortcodes_coloring.sc_colored_light_icon_color')),
            'background_color' => ideothemo_is_color(ideothemo_get_page_option_setting('shortcodes.shortcodes_coloring.sc_colored_light_background_color')),
            'alternative_title_color' => ideothemo_is_color(ideothemo_get_page_option_setting('shortcodes.shortcodes_coloring.sc_colored_light_alternative_title_color')),
        ),
        'transparent-dark' => array(
            'accent_color' => ideothemo_is_color($transparent_dark_accent_color),
            'title_color' => ideothemo_is_color(ideothemo_get_page_option_setting('shortcodes.shortcodes_coloring.sc_transparent_dark_title_color')),
            'text_color' => ideothemo_is_color(ideothemo_get_page_option_setting('shortcodes.shortcodes_coloring.sc_transparent_dark_text_color')),
            'icon_color' => ideothemo_is_color(ideothemo_get_page_option_setting('shortcodes.shortcodes_coloring.sc_transparent_dark_icon_color'))
        ),
        'transparent-light' => array(
            'accent_color' => ideothemo_is_color($transparent_light_accent_color),
            'title_color' => ideothemo_is_color(ideothemo_get_page_option_setting('shortcodes.shortcodes_coloring.sc_transparent_light_title_color')),
            'text_color' => ideothemo_is_color(ideothemo_get_page_option_setting('shortcodes.shortcodes_coloring.sc_transparent_light_text_color')),
            'icon_color' => ideothemo_is_color(ideothemo_get_page_option_setting('shortcodes.shortcodes_coloring.sc_transparent_light_icon_color'))
        )
    );
    $out = shortcode_atts($default, $sc_colors);
    ideothemo_global_vars_add('ideo_get_theme_mod_sc_colors', $out);

    return $out;
}

function ideothemo_compile_less($less, $parms = array())
{
    $md5 = md5($less . serialize($parms));
    $css = '';
    
    if (!class_exists('Less_Parser')) {
        return '';
    }

    if (false === ($css = get_transient($md5))) { 
        $options = array(
            'compress' => true,
            'sourceMap' => false,
            'cache_dir' => IDEOTHEMO_CACHE_DIR . '/ideo_compile_less'
        );
        $parser = new Less_Parser($options);
        $css = '';
        try {
            if (isset($parms['vars']) && (isset($parms['file']) || isset($parms['file_path'])) ) {
                if(isset($parms['file_path'])){
                    $file = $parms['file_path'];
                }else{
                    $file = IDEOTHEMO_LESS_SC_PATH . preg_replace("/_/", '-', basename($parms['file']));
                }
                $parser->ModifyVars($parms['vars']);
                $parser->parseFile($file);
            }

            $parser->parse($less);
            $css = $parser->getCss();
            set_transient($md5, $css, 24 * 60 * 60);

        } catch (Exception $e) {
            $error_message = $e->getMessage();
            echo '<code>' . print_r($error_message, true) . '</code>';
        }
    }

    return $css;
}

function ideothemo_custom_style_colors($id, $style_colors, $default_vars = array())
{
    $vars = array('id' => $id);

    if ($style_colors != '') {
        $custom_colors = json_decode(str_replace("'", '"', $style_colors));

        if (!is_object($custom_colors) || count(array_filter((array)$custom_colors)) == 0) {
            return false;
        }

        foreach ($custom_colors as $key => $color) {
            if ($color) {
                $vars[$key] = $color;
            }
        }

        $vars = shortcode_atts($default_vars, $vars);
    } else {
        return false;
    }

    return $vars;
}

function ideothemo_get_style($name, $value, $extra = '')
{
    $style = '';
    if (isset($value)) {
        $style = $name + ':' + $value + $extra + ';';
    }

    return $style;
}

function ideothemo_microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());

    return ((float)$usec + (float)$sec);
}

class IDEOTHEMO_KSES_TAGS{
    static function all(){
        return null;
    }
    static function allow(){
        return array(
            'a' => array(
                'href' => array(),
                'class' => array(),
                'style' => array(),
                'title' => array(),
                'data-filter' => array(),
            ),
            'div' => array(
                'class' => array(),
                'style' => array(),
            ),
            'span' => array(
                'class' => array(),
                'value' => array(),
                'style' => array(),
                'data-text' => array(),
                'data-text-effect' => array(),
            ),
            'h4' => array(
                'class' => array(),
                'style' => array(),
            ),
            'strong' => array(
                'class' => array(),
                'style' => array(),
            ),
            'b' => array(),
            'br' => array(),
            'p' => array(
                'class' => array(),
                'style' => array(),
            ),
            'button' => array(
                'class' => array(),
                'style' => array(),
            ),
            'li' => array(
                'class' => array(),
                'style' => array(),
            ),
            'ol' => array(
                'class' => array(),
                'style' => array(),
            ),
            'ul' => array(
                'class' => array(),
                'style' => array(),
            ),
            'source' => array(
                'class' => array(),
                'style' => array(),
                'src'	=> array(),
                'type'	=> array()
            ),
            'img' => array(
                'class' => array(),
                'id' => array(),
                'style' => array(),
                'alt' => array(),
                'src' => array(),
                'srcset' => array(),
                'height' => array(),
                'width' => array(),
            ),
            'i' => array(
                'class' => array(),
                'style' => array(),
            ),
            'dl' => array(
                'class' => array(),
                'style' => array(),
            ),
            'dd' => array(
                'class' => array(),
                'style' => array(),
            ),
            'dt' => array(
                'class' => array(),
                'style' => array(),
            ),
        );
    }
}