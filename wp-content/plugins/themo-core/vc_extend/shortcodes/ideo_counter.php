<?php

vc_map(array(
    'name' => __('Counter', 'ideo-themo'),
    'base' => 'ideo_counter',    
    'icon' => 'icon-counter',
    'category' => __('Content', 'ideo-themo'),
    'description' => __('Animated counter.', 'ideo-themo'),
    'weight' => 88,
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => __('COUNTER HEIGHT', 'ideo-themo'),
            'param_name' => 'el_height',
            'value' => 150,
            'description' => __('Define Counter height.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('COUNTER NUMBER', 'ideo-themo'),
            'admin_label' => true,
            'param_name' => 'el_number',
            'value' => 59,
            'description' => __('Enter number which will be displayed in Counter.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('COUNTER UNIT', 'ideo-themo'),
            'param_name' => 'el_number_unit',
            'value' => '$',
            'description' => __('Enter unit which will be displayed in Counter next to the number.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('NUMBER & UNIT FONT SIZE', 'ideo-themo'),
            'param_name' => 'el_number_font_size',
            'value' => 35,
            'description' => __('Define number & unit font size.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('COUNTER DESCRIPTION', 'ideo-themo'),
            'admin_label' => true,
            'param_name' => 'el_desc',
            'value' => __('Counter title', 'ideo-themo'),
            'description' => __('Enter text which will be displayed below the number & unit.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('COUNTER DESCRIPTION FONT SIZE', 'ideo-themo'),
            'param_name' => 'el_desc_font_size',
            'value' => '20',
            'description' => __('Define description font size.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('CORNER BORDER RADIUS', 'ideo-themo'),
            'param_name' => 'el_border_radius',
            'value' => '0',
            'description' => __('Define counter corners radius.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('COUNTING DURATION (ms)', 'ideo-themo'),
            'param_name' => 'el_counter_duration',
            'value' => 1500,
            'description' => __('Define counting duration in ms.', 'ideo-themo')
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
            'admin_label' => true,
            'param_name' => 'el_elemnt_style',
            'value' => array(
                'colored dark' => 'colored-dark',
                'colored light' => 'colored-light',
                'transparent dark' => 'transparent-dark',
                'transparent light' => 'transparent-light',

            ),
            'colors' => ideothemo_get_colors(),
            'std' => ideothemo_get_shortcodes_default_style('ideo_counter'),
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
                    'counter_background_color' => __('COUNTER BACKGROUND COLOR', 'ideo-themo'),
                    'number_color' => __('NUMBER & UNIT FONT COLOR', 'ideo-themo'),
                    'text_color' => __('DESCRIPTION COLOR', 'ideo-themo'),
                    'border_color' => __('DIVIDER COLOR', 'ideo-themo'),
                ),
                'transparent' => array(
                    'number_color' => __('NUMBER & UNIT FONT COLOR', 'ideo-themo'),
                    'text_color' => __('DESCRIPTION COLOR', 'ideo-themo'),
                    'border_color' => __('DIVIDER COLOR', 'ideo-themo'),
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
    'js_view' => 'VcCounterView'
));

$el_size = $el_height = $el_number = $el_number_unit = $el_number_font_size = $el_desc = $el_desc_font_size = $el_border_radius = $el_counter_duration = $el_padding_top = $el_padding_bottom = $el_margin_top = $el_margin_bottom = $el_extra_class = $el_custom_css = $el_elemnt_style = $el_elemnt_style_overwrite = $el_elemnt_style_colors = $el_animation = $el_animation_type = $el_animation_delay = $el_animation_duration = $el_animation_offset = $el_uid = '';

function ideothemo_counter_func($atts, $content = "")
{
    
    extract(shortcode_atts(array(
        'el_height' => 150,
        'el_number' => 59,
        'el_number_unit' => '$',
        'el_number_font_size' => 35,
        'el_desc' => __('Counter title', 'ideo-themo'),
        'el_desc_font_size' => '20',
        'el_border_radius' => '0',
        'el_counter_duration' => 1500,
        'el_padding_top' => '',
        'el_padding_bottom' => '',
        'el_margin_top' => '20',
        'el_margin_bottom' => '20',
        'el_extra_class' => '',
        'el_custom_css' => '',
        'el_elemnt_style' => ideothemo_get_shortcodes_default_style('ideo_counter'),
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

    if ($el_animation_type && $el_animation == 'viewport') {
        $data .= ' data-animation-type="' . esc_attr($el_animation_type) . '"';
    }
    if ($el_animation_delay && $el_animation_type && $el_animation == 'viewport') {
        $data .= ' data-animation-delay="' . esc_attr($el_animation_delay) . '"';
    }
    if ($el_animation_duration && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-duration="' . esc_attr($el_animation_duration) . '"';
    if ($el_animation_offset && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-offset="' . esc_attr($el_animation_offset) . '"';

    if (!$el_number) {
        $el_number = 0;
    }
    $data .= ' data-number="' . $el_number . '"';

    if ($el_counter_duration) {
        $data .= ' data-duration="' . $el_counter_duration . '"';
    }


    $less = '#counter_' . $el_uid . '{';

    if ($el_margin_top != '') {
        $less .= 'margin-top:' . (int)$el_margin_top . 'px;';
    }
    if ($el_margin_bottom != '') {
        $less .= 'margin-bottom:' . (int)$el_margin_bottom . 'px;';
    }

    if ($el_number_font_size) {
        $less .= '.number-unit{font-size:' . ideothemo_get_size($el_number_font_size) . '}';
    }
    if ($el_desc_font_size) {
        $less .= '.description{font-size:' . ideothemo_get_size($el_desc_font_size) . '}';
    }
    if ($el_height) {
        $less .= 'height:' . $el_height . 'px;';
        $less .= '.circle{height:' . $el_height . 'px;}';
    }
    if ($el_border_radius) {
        $less .= 'border-radius:' . $el_border_radius . 'px;';
        $less .= '.circle{border-radius:' . $el_border_radius . 'px;}';
    }

    $less .= '}';

    /* ===   custom style   ==== */
    $colors = ideothemo_get_colors_by_style($el_elemnt_style);
    $default_vars = array(
        'colored' => array(
            'number_color' => 'undefined',
            'counter_background_color' => 'undefined',
            'text_color' => 'undefined',
            'border_color' => 'undefined',
        ),
        'transparent' => array(
            'number_color' => 'undefined',
            'text_color' => 'undefined',
            'border_color' => 'undefined',
        )
    );

    $html .= ideothemo_custom_style('counter', $el_uid, $default_vars, $el_elemnt_style, $el_elemnt_style_colors, $less);
    /* ===   end custom style   ==== */

    $html .= '<div class="ideo-counter  ' . esc_attr($el_elemnt_style) . ' ' . esc_attr($el_extra_class) . ' vc-layer" id="counter_' . esc_attr($el_uid) . '" data-id="counter_' . esc_attr($el_uid) . '" ' . $data . '>';


    $html .= '<div class="circle">';


    $html .= '  <div class="number-icon">';

    $html .= '  <span class="number-unit"><span class="number">' . esc_html($el_number) . '</span><span class="unit">' . esc_html($el_number_unit) . '</span></span>';
    $html .= '<p class="description">' . esc_html($el_desc) . '</p>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';

    

    return $html;
}

add_shortcode('ideo_counter', 'ideothemo_counter_func');

