<?php

vc_map(array(
    "name" => __('Divider', 'ideo-themo'),
    'base' => 'vc_separator',    
    'category' => __('Content', 'ideo-themo'),
    'icon' => 'icon-divider',
    'description' => __('Horizontal separator.', 'ideo-themo'),
    'weight' => 86,
    'params' => array(
        array(
            'type' => 'dropdown',
            'heading' => __('DIVIDER TYPE', 'ideo-themo'),
            'admin_label' => true,
            'param_name' => 'el_type',
            'value' => array(
                __('Thin solid line', 'ideo-themo') => 'dividers/thin-solid-line.svg',
                __('Medium solid line', 'ideo-themo') => 'dividers/medium-solid-line.svg',
                __('Thick solid line', 'ideo-themo') => 'dividers/thick-solid-line.svg',
                __('Thin dotted line', 'ideo-themo') => 'dividers/thin-dotted-line.svg',
                __('Thick dotted line', 'ideo-themo') => 'dividers/thick-dotted-line.svg',
                __('Thin short sticks line', 'ideo-themo') => 'dividers/thin-short-sticks-line.svg',
                __('Thick short sticks line', 'ideo-themo') => 'dividers/thick-short-sticks-line.svg',
                __('Thin diagonal sticks line', 'ideo-themo') => 'dividers/thin-diagonal-sticks-line.svg',
                __('Thick diagonal sticks line', 'ideo-themo') => 'dividers/thick-diagonal-sticks-line.svg',
                __('Quadruple thin solid lines', 'ideo-themo') => 'dividers/quadruple-thin-solid-lines.svg',
                __('Quadruple medium solid lines', 'ideo-themo') => 'dividers/quadruple-medium-solid-lines.svg',
                __('Quadruple thick solid lines', 'ideo-themo') => 'dividers/quadruple-thick-solid-lines.svg',
                __('Triple thin dotted lines', 'ideo-themo') => 'dividers/triple-thin-dotted-lines.svg',
                __('Triple thick dotted lines', 'ideo-themo') => 'dividers/triple-thick-dotted-lines.svg',
            ),
            'std' => 'dividers/thin-solid-line.svg',
            'description' => __('Choose one of predefined dividers.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('DIVIDER WIDTH', 'ideo-themo'),
            'param_name' => 'el_width',
            'value' => array(
                'percentages' => 'percentages',
                'pixels' => 'pixels'
            ),
            'dependencies' => array(
                'percentages' => array('el_width_percentages'),
                'pixels' => array('el_width_pixels'),
            ),
            'std' => 'percentages',
            'description' => __('Choose percentages or pixels as the value by which you defined the width of the divider. Depending on which option you choose appropriate width slider will be available below.', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_slider',
            'heading' => __('WIDTH (%)', 'ideo-themo'),
            'param_name' => 'el_width_percentages',
            'min' => '0',
            'max' => '100',
            'value' => '100',
            'description' => __('Define divider width in percentages.', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_slider',
            'heading' => __('WIDTH (px)', 'ideo-themo'),
            'param_name' => 'el_width_pixels',
            'min' => '0',
            'max' => '800',
            'value' => '200',
            'description' => __('Define divider width in pixels.', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_buttons',
            'heading' => __('DIVIDER ALIGN', 'ideo-themo'),
            'param_name' => 'el_align',
            'value' => array(__('Inherit', 'ideo-themo') =>'none', __('Left', 'ideo-themo') => 'left', __('Center', 'ideo-themo') => 'center', __('Right', 'ideo-themo') => 'right'),
            'std' => 'center',
        ),
        
        array(
            'type' => 'ideo_buttons',
            'heading' => __('DIVIDER ALIGN ON MOBILE', 'ideo-themo'),
            'param_name' => 'el_mobile_align',
            'value' => array(__('Inherit', 'ideo-themo') =>'none', __('Left', 'ideo-themo') => 'left', __('Center', 'ideo-themo') => 'center', __('Right', 'ideo-themo') => 'right'),
            'std' => 'center',
        ),

        array(
            'type' => 'ideo_dropdown',
            'heading' => __('ELEMENT STYLE', 'ideo-themo'),
            'param_name' => 'el_element_style',
            'value' => array(
                'transparent dark' => 'transparent-dark',
                'transparent light' => 'transparent-light',

            ),
            'colors' => ideothemo_get_colors(),
            'std' => ideothemo_get_shortcodes_default_style('ideo_divider'),
            'admin_label' => true,
            'description' => __('Choose style for the element. Depending on which option you choose appropriate colorpicker will be available below. You can pick custom color for divider but you can also leave empty colorpicker to use color which is set in Customizer.', 'ideo-themo'),
            'group' => __('STYLING', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_custom_colors',
            'heading' => __('COLORS', 'ideo-themo'),
            'param_name' => 'el_element_style_colors',
            'colors' => ideothemo_get_colors(),
            'el_colors' => array(
                'colored' => array(
                    'text_color' => __('DIVIDER COLOR', 'ideo-themo')
                ),
                'transparent' => array(
                    'text_color' => __('DIVIDER COLOR', 'ideo-themo')
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
            'group' => __('ANIMATION', 'ideo-themo'),
            'value' => array(
                __('none', 'ideo-themo') => '',
                __('Viewport', 'ideo-themo') => 'viewport',
            ),
            'dependencies' => array(
                'viewport' => array('el_animation_type', 'el_animation_delay', 'el_animation_duration', 'el_animation_offset')
            ),
            'std' => '',
            'description' => __('Using this option you can enable viewport animation for the element. If you choose Viewport two additional options will be available below.', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_animation_type',
            'heading' => __('ANIMATION TYPE', 'ideo-themo'),
            'param_name' => 'el_animation_type',
            'group' => __('ANIMATION', 'ideo-themo'),
            'value' => ideothemo_get_animate_viewport(),
            'description' => __('Choose one of predefined animations.', 'ideo-themo'),
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
    'js_view' => 'VcTextSeparatorView'
));


$el_type = $el_width = $el_width_percentages = $el_width_pixels = $el_align = $el_mobile_align = $el_color = $el_margin_top = $el_margin_bottom = $el_extra_class = $el_custom_css = $el_animation = $el_animation_type = $el_animation_delay = $el_animation_duration = $el_animation_offset = $el_element_style = $el_element_style_colors = '';

function ideothemo_separator_func($atts, $content = "")
{
    
    extract(shortcode_atts(array(
        'el_type' => 'dividers/thin-solid-line.svg',
        'el_width' => 'percentages',
        'el_width_percentages' => '100',
        'el_width_pixels' => '200',
        'el_align' => 'center',
        'el_mobile_align' => 'center',
        'el_element_style' => ideothemo_get_shortcodes_default_style('ideo_divider'), 
        'el_element_style_colors' => '', 
        'el_margin_top' => '20',
        'el_margin_bottom' => '20',
        'el_extra_class' => '',
        'el_custom_css' => '',
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

    $custom_color = json_decode(str_replace("'", '"', $el_element_style_colors));

    if (isset($custom_color->text_color) && $custom_color->text_color != '') {
        $el_color = ideothemo_is_color($custom_color->text_color);
    } else {
        $colors = ideothemo_get_colors_by_style($el_element_style);
        $el_color = $colors['text_color'];
        $data .= (ideothemo_is_customize_preview() ? ' data-svg-type="' . $el_type . '" ' : '');
    }


    $svg = ideothemo_get_assets_svg_data('svg/' . $el_type, $el_color);

    if ($el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-type="' . esc_attr($el_animation_type) . '"';
    if ($el_animation_delay && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-delay="' . esc_attr($el_animation_delay) . '"';
    if ($el_animation_duration && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-duration="' . esc_attr($el_animation_duration) . '"';
    if ($el_animation_offset && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-offset="' . esc_attr($el_animation_offset) . '"';


    $less = '#diver_' . $el_uid . '{';

    $less .= 'background-image:url(' . $svg . ');';

    if ($el_margin_top != '') {
        $less .= 'margin-top:' . (int)$el_margin_top . 'px;';
    }
    if ($el_margin_bottom != '') {
        $less .= 'margin-bottom:' . (int)$el_margin_bottom . 'px;';
    }
    if ($el_width == 'percentages') {
        $less .= 'width:' . (int)$el_width_percentages . '%;';
    } else {
        $less .= 'width:' . (int)$el_width_pixels . 'px;';
    }

    $less .= '}';


    /* ===   custom style   ==== */
    $html .= ideothemo_add_style($less, 'vc_shortcodes-custom-css');
    /* ===   end custom style   ==== */

    //$svg is data:image, not link
    $img = '<img src="' . $svg . '" alt="diver"/>';

    $html .= '<div class="diver-wrap align-' . esc_attr($el_align) . ' ' . ' mobile-align-' . esc_attr($el_mobile_align) . '"><div class="diver ' . esc_attr($el_element_style) . ' ' . esc_attr($el_extra_class) . '" id="diver_' . esc_attr($el_uid) . '" data-id="diver_' . esc_attr($el_uid) . '" ' . $data . '>';

    $html .= '' . $img;

    $html .= '</div></div>';

    

    return $html;
}

add_shortcode('vc_separator', 'ideothemo_separator_func');












