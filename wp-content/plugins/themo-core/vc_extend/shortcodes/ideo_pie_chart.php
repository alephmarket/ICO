<?php

vc_map(array(
    'name' => __('Pie chart', 'ideo-themo'),
    'base' => 'ideo_pie_chart',
    'category' => __('Content', 'ideo-themo'),
    'icon' => 'icon-pie-chart',
    'description' => __('Round animated counter.', 'ideo-themo'),
    'weight' => 77,
    'params' => array(

        array(
            'type' => 'textfield',
            'heading' => __('PIE CHART MAX SIZE (px)', 'ideo-themo'),
            'param_name' => 'el_size',
            'value' => 150,
            'description' => __('Define maximum width of the Pie chart. If you leave this field empty then the element gets 100% width of the parent container.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('COUNTER NUMBER', 'ideo-themo'),
            'admin_label' => true,
            'param_name' => 'el_number',
            'value' => 60,
            'description' => __('Enter number which will be displayed in Pie chart.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('COUNTER UNIT', 'ideo-themo'),
            'param_name' => 'el_number_unit',
            'value' => '$',
            'description' => __('Enter unit which will be displayed in Pie chart next to the number.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('NUMBER & UNIT FONT SIZE', 'ideo-themo'),
            'param_name' => 'el_number_font_size',
            'value' => 22,
            'description' => __('Define number & unit font size.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('ROUND BAR PERCENTAGE (%)', 'ideo-themo'),
            'param_name' => 'el_round_counter_prec',
            'min' => '0',
            'max' => '100',
            'value' => '75',
            'description' => __('Define what percentage of the inactive round bar will be covered by the active round bar.', 'ideo-themo')
        ),

        array(
            'type' => 'dropdown',
            'heading' => __('ROUND BAR STYLE', 'ideo-themo'),
            'param_name' => 'el_round_counter_border_style',
            'value' => array(
                __('Sharp ends', 'ideo-themo') => 'butt',
                __('Rounded ends', 'ideo-themo') => 'round',
            ),
            'std' => 'round',
            'description' => __('Choose Sharp or Rounded ends for active round bar.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('ROUND BAR thickness (%)', 'ideo-themo'),
            'param_name' => 'el_round_counter_size',
            'min' => '0',
            'max' => '100',
            'value' => '15',
            'description' => __('Define in percentages round bar thickness.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('ROUND BAR DISTANCE (%)', 'ideo-themo'),
            'param_name' => 'el_round_counter_distance',
            'min' => '0',
            'max' => '50',
            'value' => '3',
            'description' => __('Define in percentages distance between round bar and content area background.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('ROUND BAR DURATION (ms)', 'ideo-themo'),
            'param_name' => 'el_round_counter_duration',
            'value' => 1500,
            'description' => __('Define counting duration.', 'ideo-themo')
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('ROUND BAR EASING', 'ideo-themo'),
            'param_name' => 'el_round_counter_easing',
            'value' => array(
                'linear',
                'swing',
                'easeInQuad',
                'easeOutQuad',
                'easeInOutQuad',
                'easeInCubic',
                'easeOutCubic',
                'easeInOutCubic',
                'easeInQuart',
                'easeOutQuart',
                'easeInOutQuart',
                'easeInQuint',
                'easeOutQuint',
                'easeInOutQuint',
                'easeInSine',
                'easeOutSine',
                'easeInOutSine',
                'easeInExpo',
                'easeOutExpo',
                'easeInOutExpo',
                'easeInCirc',
                'easeOutCirc',
                'easeInOutCirc',
                'easeInElastic',
                'easeOutElastic',
                'easeInOutElastic',
                'easeInBack',
                'easeOutBack',
                'easeInOutBack',
                'easeInBounce',
                'easeOutBounce',
                'easeInOutBounce',
            ),
            'std' => 'easeOutQuad',
            'description' => __('Choose one of predefined easing animations.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_switcher',
            'heading' => __('ICON', 'ideo-themo'),
            'param_name' => 'el_icon_display',
            'on' => 'true',
            'off' => 'false',
            'value' => 'true',
            'dependencies' => array(
                'true' => array('el_icon', 'el_icon_size')
            ),
            'description' => __('Enable or disable icon displaying. If you turn On icon additional options will be available below.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_choose_icon',
            'class' => '',
            'heading' => __('CHOOSE ICON', 'ideo-themo'),
            'param_name' => 'el_icon',
            'value' => 'fa fa-lightbulb-o',
        ),
        array(
            'type' => 'textfield',
            'heading' => __('ICON SIZE', 'ideo-themo'),
            'param_name' => 'el_icon_size',
            'value' => 40,
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
            'std' => ideothemo_get_shortcodes_default_style('ideo_pie_chart'),
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
                    'counter_background_color' => __('BACKGROUND COLOR', 'ideo-themo'),
                    'number_color' => __('NUMBER & UNIT COLOR', 'ideo-themo'),
                    'icon_color' => __('ICON COLOR', 'ideo-themo'),
                    'round_counter_color' => __('ROUND BAR ACTIVE COLOR', 'ideo-themo'),
                    'round_counter_background_color' => __('ROUND BAR INACTIVE COLOR', 'ideo-themo'),
                ),
                'transparent' => array(
                    'number_color' => __('NUMBER & UNIT COLOR', 'ideo-themo'),
                    'icon_color' => __('ICON COLOR', 'ideo-themo'),
                    'round_counter_color' => __('ROUND BAR ACTIVE COLOR', 'ideo-themo'),
                    'round_counter_border_color' => __('ROUND BAR INACTIVE LINE COLOR', 'ideo-themo'),
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
    'js_view' => 'VcPieChartView'
));

$el_size = $el_number = $el_number_unit = $el_number_font_size = $el_round_counter_prec = $el_round_counter_size = $el_round_counter_border_style = $el_round_counter_easing = $el_round_counter_distance = $el_round_counter_duration = $el_icon = $el_icon_display = $el_icon_size = $el_margin_top = $el_margin_bottom = $el_extra_class = $el_custom_css = $el_elemnt_style = $el_elemnt_style_overwrite = $el_elemnt_style_colors = $el_animation = $el_animation_type = $el_animation_delay = $el_animation_duration = $el_animation_offset = $el_uid = '';

function ideothemo_pie_chart_func($atts, $content = "")
{
    
    extract(shortcode_atts(array(
        'el_size' => 150,
        'el_number' => 60,
        'el_number_unit' => '$',
        'el_number_font_size' => 22,
        'el_round_counter_prec' => '75',
        'el_round_counter_border_style' => 'round',
        'el_round_counter_size' => '15',
        'el_round_counter_easing' => 'easeOutQuad',
        'el_round_counter_distance' => '3',
        'el_round_counter_duration' => 1500,
        'el_icon' => 'fa fa-lightbulb-o',
        'el_icon_display' => 'true',
        'el_icon_size' => '40',
        'el_margin_top' => '20',
        'el_margin_bottom' => '20',
        'el_extra_class' => '',
        'el_custom_css' => '',
        'el_elemnt_style' => ideothemo_get_shortcodes_default_style('ideo_pie_chart'),
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

    if ($el_round_counter_duration) {
        $data .= ' data-duration="' . $el_round_counter_duration . '"';
    }


    $less = '#pie_chart_' . $el_uid . '{';

    if ($el_margin_top != '') {
        $less .= 'margin-top:' . (int)$el_margin_top . 'px;';
    }
    if ($el_margin_bottom != '') {
        $less .= 'margin-bottom:' . (int)$el_margin_bottom . 'px;';
    }

    if ($el_icon_size) {
        $less .= '.icon{font-size:' . ideothemo_get_size($el_icon_size) . '}';
    }
    if ($el_number_font_size) {
        $less .= '.number-unit{font-size:' . ideothemo_get_size($el_number_font_size) . '}';
    }
    if ($el_size) {
        $less .= 'max-width:' . $el_size . 'px;max-height:' . $el_size . 'px';
    }

    $less .= '}';


    /* ===   custom style   ==== */
    $colors = ideothemo_get_colors_by_style($el_elemnt_style);
    $default_vars = array(
        'colored' => array(
            'number_color' => 'undefined',
            'icon_color' => 'undefined',
            'counter_background_color' => 'undefined',
            'round_counter_color' => 'undefined',
            'round_counter_background_color' => 'undefined',
        ),
        'transparent' => array(
            'number_color' => 'undefined',
            'icon_color' => 'undefined',
            'round_counter_color' => 'undefined',
            'round_counter_border_color' => 'undefined',
        )
    );


    $html .= ideothemo_custom_style('pie_chart', $el_uid, $default_vars, $el_elemnt_style, $el_elemnt_style_colors, $less);
    /* ===   end custom style   ==== */

    $html .= '<div class="ideo-pie-chart  ' . esc_attr($el_elemnt_style) . ' ' . esc_attr($el_extra_class) . '  vc-layer" id="pie_chart_' . esc_attr($el_uid) . '" data-id="pie_chart_' . esc_attr($el_uid) . '" ' . $data . '>';


    $size = $el_round_counter_size * $el_size / 2 / 100;


    $html .= '<div class="circle" style="height:' . esc_attr($el_size) . 'px">';

    $html .= '<svg width="100%" height="100%" shape-rendering="geometricPrecision" version="1.1" xmlns="http://www.w3.org/2000/svg">';

    $html .= '<circle class="bg-circle" cx="50%" cy="50%" r="' . esc_attr($el_size / 2 - $size - $el_round_counter_distance) . '" fill="red"/>';

    $html .= '<circle class="bg-bar" cx="50%" cy="50%" r="' . esc_attr($el_size / 2 - $size / 2) . '" fill="none" stroke="#6e6b6b" stroke-width="' . esc_attr($size) . '"  />';

    $html .= '<circle class="bar" cx="50%" cy="50%" r="' . esc_attr($el_size / 2 - $size / 2) . '" fill="none" stroke-dasharray="' . round(M_PI * (($el_size / 2 - $size / 2) * 2), 2) . '" stroke-dashoffset="0" stroke="red" stroke-width="' . esc_attr($size) . '" stroke-linecap="' . esc_attr($el_round_counter_border_style) . '"  data-prec="' . esc_attr($el_round_counter_prec) . '" data-easing="' . esc_attr($el_round_counter_easing) . '" data-counter-size="' . esc_attr($el_round_counter_size) . '" data-counter-distance="' . esc_attr($el_round_counter_distance) . '" />';
    $html .= '</svg>';

    $html .= '  <div class="number-icon">';
    if ($el_icon_display == 'true' && $el_icon) {
        $html .= ' <div><i class="icon ' . esc_attr($el_icon) . '"></i></div>';
    }
    $html .= '  <span class="number-unit"><span class="number">' . esc_html($el_number) . '</span><span class="unit">' . esc_html($el_number_unit) . '</span></span>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';

    

    return $html;
}

add_shortcode('ideo_pie_chart', 'ideothemo_pie_chart_func');

