<?php

vc_map(array(
    "name" => __('EMPTY SPACE', 'ideo-themo'),
    'base' => 'vc_separator_padding',
    'icon' => 'icon-padding-divider',    
    'description' => __('Padding divider.', 'ideo-themo'),
    'category' => __('Content', 'ideo-themo'),
    'weight' => 96,
    'params' => array(

        array(
            'type' => 'ideo_buttons',
            'heading' => __('EMPTY SPACE TYPE', 'ideo-themo'),
            'param_name' => 'el_type',
            'value' => array(
                __('Simple', 'ideo-themo') => 'simple',
                __('Advanced', 'ideo-themo') => 'advanced',
            ),
            'dependencies' => array(
                'simple' => array('el_height'),
                'advanced' => array('el_height_lg', 'el_height_md', 'el_height_sm', 'el_height_xs')
            ),
            'std' => 'simple',
            'description' => __('Choose Simple or Advanced type. With Simple divider you can set only one general height for empty space shortcode. Advanced divider gives you ability to display different empty spaces on different screen resolutions, you can set different values for different screen widths. ', 'ideo-themo')
        ),

        array(
            'type' => 'textfield',
            'heading' => __('HEIGHT', 'ideo-themo'),
            'param_name' => 'el_height',
            'admin_label' => true,
            'value' => '40',
            'description' => __('Define empty space value.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('LARGE DEVICES (1200px and up)', 'ideo-themo'),
            'param_name' => 'el_height_lg',
            'value' => '40',
            'description' => __('Define empty space for screens which have 1200px width and more.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('MEDIUM DEVICES (992-1199px)', 'ideo-themo'),
            'param_name' => 'el_height_md',
            'value' => '40',
            'description' => __('Define empty space for screens which have width from 992px to 1199px.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('SMALL DEVICES (768-991px)', 'ideo-themo'),
            'param_name' => 'el_height_sm',
            'value' => '40',
            'description' => __('Define empty space for screens which have width from 768px to 991px.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('EXTRA-SMALL DEVICES (less than 767px)', 'ideo-themo'),
            'param_name' => 'el_height_xs',
            'value' => '40',
            'description' => __('Define empty space for screens which have 767px width and less.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_id',
            'heading' => __('UniqID', 'ideo-themo'),
            'param_name' => 'el_uid',
            'value' => 0,
        )

    ),

));

$el_type = $el_height = $el_height_lg = $el_height_md = $el_height_sm = $el_height_xs = $el_uid = '';

function ideothemo_separator_padding_func($atts, $content = "")
{
    
    extract(shortcode_atts(array(
        'el_type' => 'simple',
        'el_height' => '40',
        'el_height_lg' => '40',
        'el_height_md' => '40',
        'el_height_sm' => '40',
        'el_height_xs' => '40',
        'el_uid' => ideothemo_shortcode_uid()
    ), $atts));

    $less = '#empty_space_' . $el_uid . '{';
    if ($el_type == 'simple') {
        if ($el_height) $less .= 'height:' . ideothemo_get_size($el_height) . ';';
    } else {
        if ($el_height_lg != '') $less .= '@media (min-width:1200px){height:' . ideothemo_get_size($el_height_lg) . ';}';
        if ($el_height_md != '') $less .= '@media (max-width:1199px){height:' . ideothemo_get_size($el_height_md) . ';}';
        if ($el_height_sm != '') $less .= '@media (max-width:991px){height:' . ideothemo_get_size($el_height_sm) . ';}';
        if ($el_height_xs != '') $less .= '@media (max-width:767px){height:' . ideothemo_get_size($el_height_xs) . ';}';
    }
    $less .= '}';

    $html = '';

    /* ===   custom style   ==== */
    $html .= ideothemo_add_style($less, 'vc_shortcodes-custom-css');
    /* ===   end custom style   ==== */
    $html .= '<div id="empty_space_' . esc_attr($el_uid) . '" class="diver-padding">';

    $html .= '</div>';

    

    return $html;
}

add_shortcode('vc_separator_padding', 'ideothemo_separator_padding_func');