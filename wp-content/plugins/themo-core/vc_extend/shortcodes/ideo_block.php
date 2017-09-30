<?php

// class WPBakeryShortCode_ideo_column_text extends WPBakeryShortCode
// {
//     protected function outputTitle($title)
//     {
//         $icon = $this->settings('icon');

//         return '<h4 class="wpb_element_title">' . $title . '<span class="vc_general vc_element-icon' . (!empty($icon) ? ' ' . $icon : '') . '"></span></h4>';
//     }
// }
vc_map(array(
    'name' => __('Text block', 'ideo-themo'),
    'base' => 'vc_column_text',    
    'icon' => 'icon-text-block',
    'wrapper_class' => 'clearfix',    
    "category" => __('Content', 'ideo-themo'),
    'description' => __('Simple text block', 'ideo-themo'),
    'weight' => 99,
    'params' => array(

        array(
            'type' => 'textarea_html',
            'admin_label' => true,
            'heading' => __('Text', 'ideo-themo'),
            'param_name' => 'content',
            'value' => __('<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_google_fonts',
            'heading' => __('FONT FAMILY', 'ideo-themo'),
            'param_name' => 'el_font_family',
            'value' => '',
            'description' => 'Choose font family or leave empty to use default setting.'
        ),
        array(
            'type' => 'textfield',
            'heading' => __('FONT SIZE', 'ideo-themo'),
            'param_name' => 'el_font_size',
            'value' => '',
            'description' => 'Define font size or leave empty to use default setting.'
        ),
        array(
            'type' => 'textfield',
            'heading' => __('LINE HEIGHT', 'ideo-themo'),
            'param_name' => 'el_line_height',
            'value' => '',
            'description' => 'Define line height or leave empty to use default setting.'
        ),
        array(
            'type' => 'textfield',
            'heading' => __('LETTER SPACING', 'ideo-themo'),
            'param_name' => 'el_letter_spacing',
            'value' => '',
            'description' => 'Define letter spacing or leave empty to use default setting.'
        ),
         array(
            'type' => 'ideo_buttons',
            'heading' => __('TEXT ALIGN', 'ideo-themo'),
            'param_name' => 'el_align',
            'value' => array(__('Inherit', 'ideo-themo') =>'none',  __('Left', 'ideo-themo') => 'left', __('Center', 'ideo-themo') => 'center', __('Right', 'ideo-themo') => 'right'),
            'std' => 'none',
            'description' => __('Using this option you can align the title to the Left, Center or Right side.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('TEXT ALIGN ON MOBILE', 'ideo-themo'),
            'param_name' => 'el_mobile_align',
            'value' => array(__('Inherit', 'ideo-themo') =>'none', __('Left', 'ideo-themo') => 'left', __('Center', 'ideo-themo') => 'center', __('Right', 'ideo-themo') => 'right'),
            'std' => 'none',
            'description' => __('Using this option you can align the title to the Left, Center or Right side on mobile.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_dropdown',
            'heading' => __('ELEMENT STYLE', 'ideo-themo'),
            'param_name' => 'el_elemnt_style',
            'value' => array(
                'transparent dark' => 'transparent-dark',
                'transparent light' => 'transparent-light',

            ),
            'colors' => ideothemo_get_colors(),
            'std' => ideothemo_get_shortcodes_default_style('ideo_block'),
            'admin_label' => true,
            'description' => __('Choose style for the element. Depending on which option you choose appropriate colorpicker will be available below.', 'ideo-themo'),
            'group' => __('STYLING', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_custom_colors',
            'heading' => __('COLORS', 'ideo-themo'),
            'param_name' => 'el_elemnt_style_colors',
            'colors' => ideothemo_get_colors(),
            'el_colors' => array(
                'colored' => array(
                    'text_color' => __('TEXT COLOR', 'ideo-themo')
                ),
                'transparent' => array(
                    'text_color' => __('TEXT COLOR', 'ideo-themo'),
                    'link_color' => __('LINKS COLOR', 'ideo-themo')
                )
            ),
            'value' => '',
            'group' => __('STYLING', 'ideo-themo')
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
        ),

        array(
            'type' => 'css_editor',
            'heading' => __('CSS', 'ideo-themo'),
            'param_name' => 'css',
            'group' => __('DESIGN OPTIONS', 'ideo-themo'),
        )
    ),
    'js_view' => 'VcColumnTextView'
));


$content = $el_font_family = $el_font_size = $el_font_weight = $el_font_style = $el_letter_spacing = $el_line_height = $el_align = $el_mobile_align = $el_margin_top = $el_margin_bottom = $el_extra_class = $el_custom_css = $el_animation = $el_animation_type = $el_animation_delay = $el_animation_duration = $el_animation_offset = $el_uid = $el_elemnt_style = $el_elemnt_style_colors = $css = '';


function ideothemo_column_text_func($atts, $content = "")
{
    
    extract(shortcode_atts(array(
        'el_color' => '',
        'el_font_family' => '',
        'el_font_size' => '',
        'el_font_weight' => '',
        'el_font_style' => '',
        'el_line_height' => '',
        'el_letter_spacing' => '',
        'el_align' => 'none',
        'el_mobile_align' => 'none',
        'el_elemnt_style' => ideothemo_get_shortcodes_default_style('ideo_block'),
        'el_elemnt_style_colors' => '',
        'el_margin_top' => '20',
        'el_margin_bottom' => '20',
        'el_extra_class' => '',
        'el_custom_css' => '',
        'el_animation' => '',
        'el_animation_type' => 'fadeIn',
        'el_animation_delay' => '500',
        'el_animation_duration' => '1000',
        'el_animation_offset' => '95',
        'css' => '',
        'el_uid' => ideothemo_shortcode_uid()
    ), $atts));
    
    if($el_uid == '') $el_uid = ideothemo_shortcode_uid();

    $html = '';
    $data = '';

    if ($el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-type="' . esc_attr($el_animation_type) . '"';
    if ($el_animation_delay && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-delay="' . esc_attr($el_animation_delay) . '"';
    if ($el_animation_duration && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-duration="' . esc_attr($el_animation_duration) . '"';
    if ($el_animation_offset && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-offset="' . esc_attr($el_animation_offset) . '"';


    $less = '#column_text_' . $el_uid . '{';

    $less .= ' *{';
    $custom_color = json_decode(str_replace("'", '"', $el_elemnt_style_colors));

    if (isset($custom_color->text_color) && $custom_color->text_color != '') {
        $less .= 'color:' . ideothemo_is_color($custom_color->text_color) . ';';
    }
    
    if ($el_font_size) {
        $less .= 'font-size:' . ideothemo_get_size($el_font_size) . ';';
    }
    if ($el_line_height) {
        $less .= 'line-height:' . $el_line_height . ';';
    }
    if ($el_letter_spacing) {
        $less .= 'letter-spacing:' . ideothemo_get_size($el_letter_spacing) . ';';
    }
    $less .= '}';

    if (isset($custom_color->link_color) && $custom_color->link_color != '') {
        $link_color = ideothemo_is_color($custom_color->link_color);
        $less .= ' a{';
        $less .= 'color:' . $link_color . ';';
        $less .= '&:hover{color:darken(' . $link_color . ',10)};';
        $less .= '}';
    }
    
    preg_match_all('/\{.+\}/', $css, $matches);

    if (isset($matches[0][0])) {
        $less .= '&' . preg_replace('/\!important/i', '', $matches[0][0]) . ';';
    }

    if (strstr($css, 'margin:') === false) {
        if ($el_margin_top != '' && strstr($css, 'margin-top:') === false) {
            $less .= 'margin-top:' . (int)$el_margin_top . 'px;';
        }
        if ($el_margin_bottom != '' && strstr($css, 'margin-bottom:') === false) {
            $less .= 'margin-bottom:' . (int)$el_margin_bottom . 'px;';
        }
    }

    if ($el_font_family) {
        if (defined('DOING_AJAX') && DOING_AJAX){
            $data .= ' data-font="'.$el_font_family.'"';            
        }
        $google_fonts_data = explode('|', $el_font_family);
        if (is_array($google_fonts_data) && count($google_fonts_data) == 3) {
            $handle = sanitize_title('ideothemo_google_fonts_' . $google_fonts_data[0] . ':' . $google_fonts_data[1]. ($google_fonts_data[2] != 'null' ? $google_fonts_data[2] : ''));
            wp_enqueue_style($handle, '//fonts.googleapis.com/css?family=' . $google_fonts_data[0] . ':' . $google_fonts_data[1] . '&subset=' . ($google_fonts_data[2] != 'null' ? $google_fonts_data[2] : ''));
            $less .= '*{';
            $less .= 'font-family:"' . $google_fonts_data[0] . '";';
            $font_weight = str_replace('regular', '', str_replace('italic', '', $google_fonts_data[1]));
            if (!empty($font_weight)) {
                $less .= 'font-weight:' . $font_weight . ';';
            } else if (strpos($google_fonts_data[1], 'regular') > -1) {
                $less .= 'font-weight:400;';
            }
            if (strpos($google_fonts_data[1], 'italic') > -1) {
                $less .= 'font-style:italic;';
            }
            $less .= '}';
        }
    }

    $less .= '}';

    /* ===   custom style   ==== */

    $html .= ideothemo_add_style($less, 'vc_shortcodes-custom-css');
    /* ===   end custom style   ==== */


    $html .= '<div class="column-text ' . esc_attr($el_extra_class) . ' ' . esc_attr($el_elemnt_style) . ' align-' . esc_attr($el_align) . ' mobile-align-' . esc_attr($el_mobile_align) . ' vc-layer" id="column_text_' . esc_attr($el_uid) . '" data-id="column_text_' . esc_attr($el_uid) . '" ' . $data . '>';
    $html .= wpb_js_remove_wpautop($content, true);
    $html .= '</div>';

    

    return $html;
}

add_shortcode('vc_column_text', 'ideothemo_column_text_func');






