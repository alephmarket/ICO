<?php

class WPBakeryShortCode_ideo_Testimonials_slider extends WPBakeryShortCode
{
    static $filter_added = false;
    protected $controls_css_settings = 'out-tc vc_controls-content-widget';
    protected $controls_list = array('edit', 'clone', 'delete');

    public function __construct($settings)
    {
        parent::__construct($settings);
        if (!self::$filter_added) {
            $this->addFilter('vc_inline_template_content', 'setCustomTabId');
            self::$filter_added = true;
        }
    }

    public function contentAdmin($atts, $content = null)
    {
        $width = $custom_markup = '';
        $shortcode_attributes = array('width' => '1/1');
        foreach ($this->settings['params'] as $param) {
            if ($param['param_name'] != 'content') {
                if (isset($param['value']) && is_string($param['value'])) {
                    $shortcode_attributes[$param['param_name']] = __($param['value'], "js_composer");
                } elseif (isset($param['value'])) {
                    $shortcode_attributes[$param['param_name']] = $param['value'];
                }
            } else if ($param['param_name'] == 'content' && $content == NULL) {
                $content = __($param['value'], "js_composer");
            }
        }
        extract(shortcode_atts(
            $shortcode_attributes
            , $atts));

        // Extract tab titles

        preg_match_all('/ideo_testimonial_item title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}/i', $content, $matches, PREG_OFFSET_CAPTURE);

        $output = '';
        $items = array();

        if (isset($matches[0])) {
            $items = $matches[0];
        }
        $tmp = '';
        if (count($items)) {
            $tmp .= '<ul class="clearfix tabs_controls">';
            foreach ($items as $tab) {
                preg_match('/title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE);
                if (isset($tab_matches[1][0])) {
                    $tmp .= '<li><a href="#tab-' . (isset($tab_matches[3][0]) ? $tab_matches[3][0] : sanitize_title($tab_matches[1][0])) . '">' . $tab_matches[1][0] . '</a></li>';

                }
            }
            $tmp .= '</ul>' . "\n";
        } else {
            $output .= do_shortcode($content);
        }


        $elem = $this->getElementHolder($width);

        $iner = '';
        foreach ($this->settings['params'] as $param) {
            $custom_markup = '';
            $param_value = isset($$param['param_name']) ? $$param['param_name'] : '';
            if (is_array($param_value)) {
                // Get first element from the array
                reset($param_value);
                $first_key = key($param_value);
                $param_value = $param_value[$first_key];
            }
            $iner .= $this->singleParamHtmlHolder($param, $param_value);
        }

        if (isset($this->settings["custom_markup"]) && $this->settings["custom_markup"] != '') {
            if ($content != '') {
                $custom_markup = str_ireplace("%content%", $tmp . $content, $this->settings["custom_markup"]);
            } else if ($content == '' && isset($this->settings["default_content_in_template"]) && $this->settings["default_content_in_template"] != '') {
                $custom_markup = str_ireplace("%content%", $this->settings["default_content_in_template"], $this->settings["custom_markup"]);
            } else {
                $custom_markup = str_ireplace("%content%", '', $this->settings["custom_markup"]);
            }
            $iner .= do_shortcode($custom_markup);
        }
        $elem = str_ireplace('%wpb_element_content%', $iner, $elem);
        $output = $elem;

        return $output;
    }

    public function getTabTemplate()
    {
        return '<div class="wpb_template">' . do_shortcode('[ideo_testimonial_item title="Tab" tab_id=""][/ideo_testimonial_item]') . '</div>';
    }

    public function setCustomTabId($content)
    {
        return preg_replace('/tab\_id\=\"([^\"]+)\"/', 'tab_id="$1-' . time() . '"', $content);
    }
}


vc_map(array(
    'name' => __('Testimonials slider', 'ideo-themo'),
    'base' => 'ideo_testimonials_slider',
    'show_settings_on_create' => false,
    'content_element' => true,
    'as_parent' => array('except' => ''),
    'icon' => 'icon-testimonials',
    'category' => __('Content', 'ideo-themo'),
    'description' => __('Testimonials slider with quotation, author name, company name and author image.', 'ideo-themo'),
    'weight' => 70,
    'params' => array(

        array(
            'type' => 'textfield',
            'heading' => __('NAME FONT SIZE', 'ideo-themo'),
            'param_name' => 'el_name_font_size',
            'value' => '',
            'description' => __('Define author name font size.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('COMPANY FONT SIZE', 'ideo-themo'),
            'param_name' => 'el_company_font_size',
            'value' => '',
            'description' => __('Define company font size.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('QUOTE FONT SIZE', 'ideo-themo'),
            'param_name' => 'el_quote_font_size',
            'value' => '',
            'description' => __('Define quote font size.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('AUTOROTATE DURATION (sec)', 'ideo-themo'),
            'param_name' => 'el_duration',
            'min' => '0',
            'max' => '20',
            'value' => '5',
            'description' => __('Define testimonials changing duration in seconds. Testimonials will be changing one by one in the loop. Set 0 seconds if you want to disable autorotation (user will be able to change slides only manually using navigation wings).', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_switcher',
            'heading' => __('SHOW NAVIGATION', 'ideo-themo'),
            'param_name' => 'el_show_navigation',
            'on' => 'true',
            'off' => 'false',
            'value' => 'true',
            'description' => __('Turn On or Off manual navigation wings.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('NAVIGATION WIDTH', 'ideo-themo'),
            'param_name' => 'el_navigation_width',
            'min' => '15',
            'max' => '100',
            'value' => '30',
            'description' => __('Define in pixels width of navigation wings.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('TRANSITION TYPE', 'ideo-themo'),
            'param_name' => 'el_change_animation',
            'value' => array(
                __('Slide', 'ideo-themo') => 'slide',
                __('Fade', 'ideo-themo') => 'fade'
            ),
            'std' => 'slide',
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('MARGIN TOP (px)', 'ideo-themo'),
            'param_name' => 'el_margin_top',
            'min' => '0',
            'max' => '200',
            'value' => '20',
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('MARGIN BOTTOM (px)', 'ideo-themo'),
            'param_name' => 'el_margin_bottom',
            'min' => '0',
            'max' => '200',
            'value' => '20',
        ),
        array(
            'type' => 'textfield',
            'heading' => __('EXTRA CLASS NAME', 'ideo-themo'),
            'param_name' => 'el_extra_class',
            'value' => '',
            'description' => __('Type in an extra class name for this particular element, so you can refer to that class in custom css.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_dropdown',
            'heading' => __('ELEMENT STYLE', 'ideo-themo'),
            'param_name' => 'el_elemnt_style',
            'admin_label' => true,
            'value' => array(
                'colored dark' => 'colored-dark',
                'colored light' => 'colored-light',
                'transparent dark' => 'transparent-dark',
                'transparent light' => 'transparent-light',

            ),
            'colors' => ideothemo_get_colors(),
            'std' => ideothemo_get_shortcodes_default_style('ideo_testimonials_slider'),
            'description' => __('Choose style for the element. Depending on which option you choose appropriate colorpickers will be available below. You can freely customize colors for chosen style but you can also leave empty colorpickers to use colors which are set for that style in Customizer.', 'ideo-themo'),
            'group' => __('STYLING', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_custom_colors',
            'heading' => __('COLORS', 'ideo-themo'),
            'param_name' => 'el_elemnt_style_colors',
            'colors' => ideothemo_get_colors(),
            'el_colors' => array(
                'colored' => array(
                    'background_color' => __('BACKGROUND COLOR', 'ideo-themo'),
                    'quote_color' => __('QUOTE COLOR', 'ideo-themo'),
                    'author_text_color' => __('AUTHOR TEXT COLOR', 'ideo-themo'),
                    'company_text_color' => __('COMPANY TEXT COLOR', 'ideo-themo'),
                    'author_image_border_color' => __('AUTHOR IMAGE BORDER COLOR', 'ideo-themo'),
                    'navigation_background_color' => __('NAVIGATION BACKGROUND COLOR', 'ideo-themo'),
                    'navigation_arrows_color' => __('NAVIGATION ARROWS COLOR', 'ideo-themo'),
                    'navigation_background_hover_color' => __('NAVIGATION BACKGROUND HOVER COLOR', 'ideo-themo'),
                ),
                'transparent' => array(
                    'quote_color' => __('QUOTE COLOR', 'ideo-themo'),
                    'author_text_color' => __('AUTHOR TEXT COLOR', 'ideo-themo'),
                    'company_text_color' => __('COMPANY TEXT COLOR', 'ideo-themo'),
                    'author_image_border_color' => __('AUTHOR IMAGE BORDER COLOR', 'ideo-themo'),
                    'navigation_arrows_color' => __('NAVIGATION ARROWS COLOR', 'ideo-themo'),
                )
            ),
            'value' => '',
            'group' => __('STYLING', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('ANIMATION', 'ideo-themo'),
            'param_name' => 'el_animation',
            'value' => array(
                __('none', 'ideo-themo') => '',
                __('Viewport', 'ideo-themo') => 'viewport',
            ),
            'dependencies' => array(
                'viewport' => array('el_animation_type', 'el_animation_delay', 'el_animation_duration', 'el_animation_offset')
            ),
            'std' => '',
            'description' => __('Using this option you can enable viewport animation for the element. If you choose Viewport two additional options will be available below.', 'ideo-themo'),
            'group' => __('ANIMATION', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_animation_type',
            'heading' => __('ANIMATION TYPE', 'ideo-themo'),
            'param_name' => 'el_animation_type',
            'group' => __('ANIMATION', 'ideo-themo'),
            'value' => ideothemo_get_animate_viewport(),
            'description' => __('Choose one of predefined animations.', 'ideo-themo'),
            'group' => __('ANIMATION', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('ANIMATION DELAY', 'ideo-themo'),
            'param_name' => 'el_animation_delay',
            'min' => '0',
            'max' => '5000',
            'value' => '500',
            'description' => __('Define animation delay in ms.', 'ideo-themo'),
            'group' => __('ANIMATION', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('ANIMATION DURATION', 'ideo-themo'),
            'param_name' => 'el_animation_duration',
            'min' => '0',
            'max' => '5000',
            'value' => '500',
            'description' => __('Define animation duration in ms.', 'ideo-themo'),
            'group' => __('ANIMATION', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('ANIMATION OFFSET', 'ideo-themo'),
            'param_name' => 'el_animation_offset',
            'min' => '0',
            'max' => '100',
            'value' => '95',
            'description' => __('Define animation offset in %. Offset is ', 'ideo-themo'),
            'group' => __('ANIMATION', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_id',
            'heading' => __('UniqID', 'ideo-themo'),
            'param_name' => 'el_uid',
            'value' => 0,
            'group' => __('ANIMATION', 'ideo-themo')
        )

    ),
    'custom_markup' => '<div class="wpb_tabs_holder wpb_holder vc_container_for_children"><ul class="tabs_controls"></ul>%content%</div>'
,
    'default_content' => '
    [ideo_testimonial_item title="' . __('Testimonial 1', 'ideo-themo') . '" tab_id=""][/ideo_testimonial_item]
    [ideo_testimonial_item title="' . __('Testimonial 2', 'ideo-themo') . '" tab_id=""][/ideo_testimonial_item]
    ',
    'js_view' => 'VcTestimonialsSliderView'

));


$title = $el_name_font_size = $el_company_font_size = $el_quote_font_size = $el_duration = $el_show_navigation = $el_change_animation = $el_navigation_width = $el_margin_top = $el_margin_bottom = $el_extra_class = $el_custom_css = $el_elemnt_style = $el_elemnt_style_overwrite = $el_elemnt_style_colors = $el_animation = $el_animation_type = $el_animation_delay = $el_animation_duration = $el_animation_offset = $el_uid = '';


function ideothemo_testimonials_slider_func($atts, $content = "")
{
    
    extract(shortcode_atts(array(
        'el_name_font_size' => '',
        'el_company_font_size' => '',
        'el_quote_font_size' => '',
        'el_duration' => '5',
        'el_show_navigation' => 'true',
        'el_change_animation' => 'slide',
        'el_navigation_width' => '30',
        'el_margin_top' => '20',
        'el_margin_bottom' => '20',
        'el_extra_class' => '',
        'el_custom_css' => '',
        'el_elemnt_style' => ideothemo_get_shortcodes_default_style('ideo_testimonials_slider'),
        'el_elemnt_style_overwrite' => '',
        'el_elemnt_style_colors' => '',
        'el_animation' => '',
        'el_animation_type' => 'fadeIn',
        'el_animation_delay' => '500',
        'el_animation_duration' => '1000',
        'el_animation_offset' => '95',
        'el_uid' => ideothemo_shortcode_uid()
    ), $atts));
    
    if($el_uid == '') $el_uid = ideothemo_shortcode_uid();

    $html = '';
    $data = '';
    $data_carousel = '';

    if ($el_animation_type && $el_animation == 'viewport') {
        $data .= ' data-animation-type="' . esc_attr($el_animation_type) . '"';
    }
    if ($el_animation_delay && $el_animation_type && $el_animation == 'viewport') {
        $data .= ' data-animation-delay="' . esc_attr($el_animation_delay) . '"';
    }
    if ($el_animation_duration && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-duration="' .    $el_animation_duration . '"';
    if ($el_animation_offset && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-offset="' . esc_attr($el_animation_offset) . '"';

    if ($el_duration === '0') {
        $data_carousel .= ' data-interval="false"';
    } else {
        $data_carousel .= ' data-interval="' . (int)($el_duration * 1000) . '"';
    }


    $less = '#testimonials_slider_' . $el_uid . ', #testimonials_slider_' . $el_uid . '_2{';

    if ($el_margin_top != '') {
        $less .= 'margin-top:' . (int)$el_margin_top . 'px;';
    }
    if ($el_margin_bottom != '') {
        $less .= 'margin-bottom:' . (int)$el_margin_bottom . 'px;';
    }
    if ($el_name_font_size) {
        $less .= '.author{font-size:' . ideothemo_get_size($el_name_font_size) . '}';
    }
    if ($el_company_font_size) {
        $less .= '.company, .company a{font-size:' . ideothemo_get_size($el_company_font_size) . '}';
    }
    if ($el_quote_font_size) {
        $less .= '.content{font-size:' . ideothemo_get_size($el_quote_font_size) . '}';
    }
    if ($el_navigation_width) {
        if ($el_show_navigation === 'true') {
            $less .= '&.navigation { margin-left: ' . $el_navigation_width . 'px;}';
            $less .= '&.navigation { margin-right: ' . $el_navigation_width . 'px;}';
        } else {
            $less .= '&.navigation { margin: 0 ' . $el_navigation_width . 'px 30px;}';
        }
        $less .= '.carousel-control {width:' . $el_navigation_width . 'px; &:after{font-size: ' . $el_navigation_width . 'px / 2;}}';
    }

    $less .= '}';

    /* ===   custom style   ==== */
    $colors = ideothemo_get_colors_by_style($el_elemnt_style);
    $default_vars = array(
        'colored' => array(
            'background_color' => 'undefined',
            'author_text_color' => 'undefined',
            'company_text_color' => 'undefined',
            'quote_color' => 'undefined',
            'author_image_border_color' => 'undefined',
            'navigation_background_color' => 'undefined',
            'navigation_arrows_color' => 'undefined',
            'navigation_background_hover_color' => 'undefined',
        ),
        'transparent' => array(
            'quote_color' => 'undefined',
            'author_text_color' => 'undefined',
            'author_image_border_color' => 'undefined',
            'company_text_color' => 'undefined',
            'navigation_arrows_color' => 'undefined',
        )
    );

    $html .= ideothemo_custom_style('testimonials_slider', $el_uid, $default_vars, $el_elemnt_style, $el_elemnt_style_colors, $less);
    /* ===   end custom style   ==== */

    preg_match_all('/ideo_testimonial_item([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE);
    $items = array();

    if (isset($matches[1])) {
        $items = $matches[1];
        //first active
        if (isset($items[0][0])) {
            $content = str_replace($items[0][0], $items[0][0] . ' active="true"', $content);
        }
    }

    $html .= '<div class="ideo-testimonials-slider  ' . esc_attr($el_elemnt_style) . ' ' . ($el_show_navigation == 'true' ? 'navigation' : '') . ' ' . esc_attr($el_extra_class) . ' vc-layer" id="testimonials_slider_' . esc_attr($el_uid) . '" data-id="testimonials_slider_' . esc_attr($el_uid) . '" ' . $data . '>';
    $html .= '  <div id="carousel_testimonials_' . esc_attr($el_uid) . '" class="carousel slide carousel-' . esc_attr($el_change_animation) . '" data-ride="carousel" ' . $data_carousel . '> 
                    <div class="carousel-inner" role="listbox">';
    $html .= do_shortcode($content);
    $html .= '      </div>';
    if ($el_show_navigation == 'true') {
        $html .= '  <a class="left carousel-control" href="#carousel_testimonials_' . esc_attr($el_uid) . '" role="button" data-slide="prev"></a>
                <a class="right carousel-control" href="#carousel_testimonials_' . esc_attr($el_uid) . '" role="button" data-slide="next"></a>';
    }
    $html .= '  </div>';
    $html .= '</div>';

    

    return $html;
}

add_shortcode('ideo_testimonials_slider', 'ideothemo_testimonials_slider_func');