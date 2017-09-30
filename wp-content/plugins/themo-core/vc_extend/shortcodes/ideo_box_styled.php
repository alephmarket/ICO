<?php

vc_map(array(
    'name' => __('Styled box', 'ideo-themo'),
    'base' => 'ideo_box_styled',    
    "as_parent" => array('except' => ''),
    'content_element' => true,
    'is_container' => true,
    'icon' => 'icon-box-styled',
    'category' => __('Content', 'ideo-themo'),
    'show_settings_on_create' => false,
    'description' => __('Customizable content box with hover and advanced background options.', 'ideo-themo'),
    'weight' => 74,
    'params' => array(

        array(
            'type' => 'ideo_slider',
            'heading' => __('PADDING TOP (px)', 'ideo-themo'),
            'param_name' => 'el_padding_top',
            'min' => '0',
            'max' => '200',
            'value' => '20',
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('PADDING RIGHT (px)', 'ideo-themo'),
            'param_name' => 'el_padding_right',
            'min' => '0',
            'max' => '200',
            'value' => '20',
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('PADDING BOTTOM (px)', 'ideo-themo'),
            'param_name' => 'el_padding_bottom',
            'min' => '0',
            'max' => '200',
            'value' => '20',
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('PADDING LEFT (px)', 'ideo-themo'),
            'param_name' => 'el_padding_left',
            'min' => '0',
            'max' => '200',
            'value' => '20',
        ),

        array(
            'type' => 'textfield',
            'heading' => __('BOX MINUMUM HEIGHT', 'ideo-themo'),
            'param_name' => 'el_min_height',
            'value' => '',
            'description' => __('Define in pixels minimum height for the box. It is a minimum height property so the content which you place inside the box can distend that height.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('STYLED BOX RADIUS', 'ideo-themo'),
            'param_name' => 'el_radius',
            'min' => '0',
            'max' => '150',
            'value' => '0',
            'description' => __('Define radius for box corners.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('BORDER THICKNESS (px)', 'ideo-themo'),
            'param_name' => 'el_border_width',
            'min' => '0',
            'max' => '10',
            'value' => '0',
            'description' => __('Define border thickness.', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_slider',
            'heading' => __('BORDER DISTANCE', 'ideo-themo'),
            'param_name' => 'el_border_distance',
            'min' => '0',
            'max' => '10',
            'value' => '0',
            'description' => __('Define border distance which is a space between a background and a border.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_colorpicker',
            'heading' => __('BORDER COLOR', 'ideo-themo'),
            'param_name' => 'el_border_color',
            'value' => '',
            'description' => __('Pick border color.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_colorpicker',
            'heading' => __('BORDER HOVER COLOR', 'ideo-themo'),
            'param_name' => 'el_border_hover_color',
            'value' => '',
            'description' => __('Pick border hover color.', 'ideo-themo')
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
            'heading' => __('BACKGROUND', 'ideo-themo'),
            'param_name' => 'el_background',
            'value' => array(
                __('default', 'ideo-themo') => '',
                __('Color', 'ideo-themo') => 'color',
                __('Image', 'ideo-themo') => 'image',
            ),
            'dependencies' => array(
                'color' => array('el_background_color', 'el_background_color_pattern', 'el_background_color_pattern_color'),
                'image' => array('el_background_image', 'el_background_position', 'el_background_repeat', 'el_background_size', 'el_background_overlay_pattern', 'el_background_overlay_pattern_color', 'el_background_overlay_color'),

            ),
            'std' => '',
            'description' => __('Choose Color or Image background type. Depending on which option you choose appropriate styling options will be available below.', 'ideo-themo'),
            'group' => __('BACKGROUND', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_colorpicker',
            'heading' => __('COLOR', 'ideo-themo'),
            'param_name' => 'el_background_color',
            'value' => '',
            'description' => __('Pick background color.', 'ideo-themo'),
            'group' => __('BACKGROUND', 'ideo-themo')
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('PATTERN OVERLAY', 'ideo-themo'),
            'param_name' => 'el_background_color_pattern',
            'value' => array_merge(array(__('None', 'ideo-themo') => ''), ideothemo_get_background_patterns(true)),
            'description' => __('Choose one of predefined background patterns.', 'ideo-themo'),
            'group' => __('BACKGROUND', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_colorpicker',
            'heading' => __('PATTERN COLOR', 'ideo-themo'),
            'param_name' => 'el_background_color_pattern_color',
            'value' => '',
            'description' => __('Pick pattern color.', 'ideo-themo'),
            'group' => __('BACKGROUND', 'ideo-themo')
        ),

        array(
            'type' => 'attach_image',
            'heading' => __('UPLOAD IMAGE', 'ideo-themo'),
            'param_name' => 'el_background_image',
            'value' => array(),
            'group' => __('BACKGROUND', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_switcher',
            'heading' => __('100% BACKGROUND IMAGE', 'ideo-themo'),
            'param_name' => 'el_background_size',
            'on' => 'true',
            'off' => 'false',
            'value' => 'false',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('By default this option is Off so your image has set ‘auto’ property (original width and height). Turn On this option to set ‘cover’ property for your image (it will be scale to be as large as possible so that the background area is completely covered by the background image).', 'ideo-themo'),
        ),

        array(
            'type' => 'dropdown',
            'heading' => __('BACKGROUND POSITION', 'ideo-themo'),
            'param_name' => 'el_background_position',
            'value' => array(
                __('-select-', 'ideo-themo') => '',
                'left top' => 'left top',
                'center top' => 'center top',
                'right top' => 'right top',
                'left center' => 'left center',
                'center center' => 'center center',
                'right center' => 'right center',
                'left bottom' => 'left bottom',
                'center bottom' => 'center bottom',
                'right bottom' => 'right bottom'
            ),
            'std' => '',
            'description' => __('Set position property to set a starting position for background image.', 'ideo-themo'),
            'group' => __('BACKGROUND', 'ideo-themo')
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('BACKGROUND REPEAT', 'ideo-themo'),
            'param_name' => 'el_background_repeat',
            'value' => array(
                __('-select-', 'ideo-themo') => '',
                'repeat' => 'repeat',
                'repeat-x' => 'repeat-x',
                'repeat-y' => 'repeat-y',
                'no-repeat' => 'no-repeat'
            ),
            'std' => '',
            'description' => __('Set repeat property to set if/how the image will be repeated.', 'ideo-themo'),
            'group' => __('BACKGROUND', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_colorpicker',
            'heading' => __('COLOR OVERLAY', 'ideo-themo'),
            'param_name' => 'el_background_overlay_color',
            'value' => '',
            'description' => __('Pick overlay color.', 'ideo-themo'),
            'group' => __('BACKGROUND', 'ideo-themo')
        ),

        array(
            'type' => 'dropdown',
            'heading' => __('PATTERN OVERLAY', 'ideo-themo'),
            'param_name' => 'el_background_overlay_pattern',
            'value' => array_merge(array(__('None', 'ideo-themo') => ''), ideothemo_get_background_patterns(true)),
            'description' => __('Choose one of predefined background patterns.', 'ideo-themo'),
            'group' => __('BACKGROUND', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_colorpicker',
            'heading' => __('PATTERN COLOR', 'ideo-themo'),
            'param_name' => 'el_background_overlay_pattern_color',
            'value' => '',
            'description' => __('Pick pattern color.', 'ideo-themo'),
            'group' => __('BACKGROUND', 'ideo-themo')
        ),

        /* hover */
        array(
            'type' => 'ideo_buttons',
            'heading' => __('BACKGROUND HOVER', 'ideo-themo'),
            'param_name' => 'el_background_hover',
            'value' => array(
                __('default', 'ideo-themo') => '',
                __('Color', 'ideo-themo') => 'color',
                __('Image', 'ideo-themo') => 'image',
            ),
            'dependencies' => array(
                'color' => array('el_background_hover_color', 'el_background_hover_color_pattern', 'el_background_hover_color_pattern_color'),
                'image' => array('el_background_hover_image', 'el_background_hover_position', 'el_background_hover_repeat', 'el_background_hover_size', 'el_background_hover_overlay_pattern', 'el_background_hover_overlay_pattern_color', 'el_background_hover_overlay_color'),

            ),
            'std' => '',
            'description' => __('Choose Color or Image hover background type. Depending on which option you choose appropriate styling options will be available below.', 'ideo-themo'),
            'group' => __('BACKGROUND', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_colorpicker',
            'heading' => __('COLOR', 'ideo-themo'),
            'param_name' => 'el_background_hover_color',
            'value' => '',
            'description' => __('Pick background hover color.', 'ideo-themo'),
            'group' => __('BACKGROUND', 'ideo-themo')
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('PATTERN OVERLAY', 'ideo-themo'),
            'param_name' => 'el_background_hover_color_pattern',
            'value' => array_merge(array(__('None', 'ideo-themo') => ''), ideothemo_get_background_patterns(true)),
            'description' => __('Choose one of predefined patterns.', 'ideo-themo'),
            'group' => __('BACKGROUND', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_colorpicker',
            'heading' => __('PATTERN COLOR', 'ideo-themo'),
            'param_name' => 'el_background_hover_color_pattern_color',
            'value' => '',
            'description' => __('Pick pattern color.', 'ideo-themo'),
            'group' => __('BACKGROUND', 'ideo-themo')
        ),

        array(
            'type' => 'attach_image',
            'heading' => __('UPLOAD IMAGE', 'ideo-themo'),
            'param_name' => 'el_background_hover_image',
            'value' => array(),
            'group' => __('BACKGROUND', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_switcher',
            'heading' => __('100% BACKGROUND IMAGE', 'ideo-themo'),
            'param_name' => 'el_background_hover_size',
            'on' => 'true',
            'off' => 'false',
            'value' => 'false',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('By default this option is Off so your image has set ‘auto’ property (original width and height). Turn On this option to set ‘cover’ property for your image (it will be scale to be as large as possible so that the background area is completely covered by the background image).', 'ideo-themo'),
        ),

        array(
            'type' => 'dropdown',
            'heading' => __('BACKGROUND POSITION', 'ideo-themo'),
            'param_name' => 'el_background_hover_position',
            'value' => array(
                __('-select-', 'ideo-themo') => '',
                'left top' => 'left top',
                'center top' => 'center top',
                'right top' => 'right top',
                'left center' => 'left center',
                'center center' => 'center center',
                'right center' => 'right center',
                'left bottom' => 'left bottom',
                'center bottom' => 'center bottom',
                'right bottom' => 'right bottom'
            ),
            'std' => '',
            'description' => __('Set position property to set a starting position for background image.', 'ideo-themo'),
            'group' => __('BACKGROUND', 'ideo-themo')
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('BACKGROUND REPEAT', 'ideo-themo'),
            'param_name' => 'el_background_hover_repeat',
            'value' => array(
                __('-select-', 'ideo-themo') => '',
                'repeat' => 'repeat',
                'repeat-x' => 'repeat-x',
                'repeat-y' => 'repeat-y',
                'no-repeat' => 'no-repeat'
            ),
            'std' => '',
            'description' => __('Set repeat property to set if/how the image will be repeated.', 'ideo-themo'),
            'group' => __('BACKGROUND', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_colorpicker',
            'heading' => __('COLOR OVERLAY', 'ideo-themo'),
            'param_name' => 'el_background_hover_overlay_color',
            'value' => '',
            'description' => __('Pick overlay color.', 'ideo-themo'),
            'group' => __('BACKGROUND', 'ideo-themo')
        ),

        array(
            'type' => 'dropdown',
            'heading' => __('PATTERN OVERLAY', 'ideo-themo'),
            'param_name' => 'el_background_hover_overlay_pattern',
            'value' => array_merge(array(__('None', 'ideo-themo') => ''), ideothemo_get_background_patterns(true)),
            'description' => __('Choose one of predefined background patterns.', 'ideo-themo'),
            'group' => __('BACKGROUND', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_colorpicker',
            'heading' => __('PATTERN COLOR', 'ideo-themo'),
            'param_name' => 'el_background_hover_overlay_pattern_color',
            'value' => '',
            'description' => __('Pick pattern color.', 'ideo-themo'),
            'group' => __('BACKGROUND', 'ideo-themo')
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
    'js_view' => 'VcColumnView'
));


if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_Ideo_Box_Styled extends WPBakeryShortCodesContainer
    {
    }
}


$el_padding_top = $el_padding_right = $el_padding_bottom = $el_padding_left = $el_min_height = $el_radius = $el_border_width = $el_border_distance = $el_border_color = $el_border_hover_color = $el_margin_top = $el_margin_bottom = $el_extra_class = $el_custom_css = $el_background = $el_blur = $el_background_color = $el_background_color_pattern = $el_background_color_pattern_color = $el_background_image = $el_background_size = $el_background_position = $el_background_repeat = $el_background_overlay_color = $el_background_overlay_pattern = $el_background_overlay_pattern_color = $el_background_hover = $el_background_hover_color = $el_background_hover_color_pattern = $el_background_hover_color_pattern_color = $el_background_hover_image = $el_background_hover_size = $el_background_hover_position = $el_background_hover_repeat = $el_background_hover_overlay_color = $el_background_hover_overlay_pattern = $el_background_hover_overlay_pattern_color = $el_animation = $el_animation_type = $el_animation_delay = $el_animation_duration = $el_animation_offset = $el_uid = '';

function ideothemo_box_styled_func($atts, $content = '')
{
    
    extract(shortcode_atts(array(
        'el_padding_top' => '20',
        'el_padding_right' => '20',
        'el_padding_bottom' => '20',
        'el_padding_left' => '20',
        'el_min_height' => '',
        'el_radius' => '0',
        'el_border_width' => '0',
        'el_border_distance' => '0',
        'el_border_color' => '',
        'el_border_hover_color' => '',
        'el_margin_top' => '20',
        'el_margin_bottom' => '20',
        'el_extra_class' => '',
        'el_custom_css' => '',
        'el_background' => '',
        'el_background_color' => '',
        'el_background_color_pattern' => '',
        'el_background_color_pattern_color' => '',
        'el_background_image' => '',
        'el_background_size' => 'false',
        'el_background_position' => '',
        'el_background_repeat' => '',
        'el_background_overlay_color' => '',
        'el_background_overlay_pattern' => '',
        'el_background_overlay_pattern_color' => '',
        'el_background_hover' => '',
        'el_background_hover_color' => '',
        'el_background_hover_color_pattern' => '',
        'el_background_hover_color_pattern_color' => '',
        'el_background_hover_image' => '',
        'el_background_hover_size' => 'false',
        'el_background_hover_position' => '',
        'el_background_hover_repeat' => '',
        'el_background_hover_overlay_color' => '',
        'el_background_hover_overlay_pattern' => '',
        'el_background_hover_overlay_pattern_color' => '',
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

    if ($el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-type="' . esc_attr($el_animation_type) . '"';
    if ($el_animation_delay && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-delay="' . esc_attr($el_animation_delay) . '"';
    if ($el_animation_duration && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-duration="' . esc_attr($el_animation_duration) . '"';
    if ($el_animation_offset && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-offset="' . esc_attr($el_animation_offset) . '"';

    $less = '#ideo_box_' . $el_uid . '{';

    if ($el_margin_top != '') {
        $less .= 'margin-top:' . (int)$el_margin_top . 'px;';
    }
    if ($el_margin_bottom != '') {
        $less .= 'margin-bottom:' . (int)$el_margin_bottom . 'px;';
    }

    if ($el_radius) {
        $less .= 'border-radius:' . $el_radius . 'px;';
    }

    if ($el_border_width && $el_border_color) {
        $less .= 'border: solid ' . (int)$el_border_width . 'px ' . $el_border_color . ';';
    }

    if ($el_border_hover_color) {
        $less .= '&:hover {border-color: ' . $el_border_hover_color . ';}';
    }

    $less .= '.ideo-box-inner{';

    $less .= 'padding:' . (int)$el_padding_top . 'px ' . (int)$el_padding_right . 'px ' . (int)$el_padding_bottom . 'px ' . (int)$el_padding_left . 'px;';

    $less .= 'margin:' . (int)$el_border_distance . 'px;';

    if ($el_radius) {
        $less .= 'border-radius:' . $el_radius . 'px;';
        $less .= '.ideo-box-overlay{ border-radius: ' . $el_radius . 'px;} ';
    }

    if ($el_min_height) {
        $less .= 'min-height:' . (int)$el_min_height . 'px;';
    }

    switch ($el_background) {
        case 'color':
            if ($el_background_color) {
                $less .= 'background-color:' . $el_background_color . ';';
            }
            if ($el_background_color_pattern) {
                $less .= '.ideo-box-overlay{background-image:url(' . ideothemo_get_assets_svg_data('svg/masks/' . $el_background_color_pattern . '.svg', $el_background_color_pattern_color) . ');}';
            }
            break;
        case 'image':
            if ($el_background_image) {
                $background_image = wp_get_attachment_image_src($el_background_image, 'full');
                $less .= 'background-image:url(' . $background_image[0] . ');';
            }
            if ($el_background_position) $less .= 'background-position:' . $el_background_position . ';';
            if ($el_background_repeat) $less .= 'background-repeat:' . $el_background_repeat . ';';
            if ($el_background_size === 'true') $less .= 'background-size:cover;';
            if ($el_background_overlay_pattern) {
                $less .= '.ideo-box-overlay{background-image:url(' . ideothemo_get_assets_svg_data('svg/masks/' . $el_background_overlay_pattern . '.svg', $el_background_overlay_pattern_color) . ');} ';
            }
            if ($el_background_overlay_color) {
                $less .= '.ideo-box-overlay{background-color:' . $el_background_overlay_color . ';} ';
            }
            break;
    }

    $less .= '&:hover{';
    $preload_image = '';

    switch ($el_background_hover) {
        case 'color':
            if ($el_background_hover_color) {
                $less .= 'background-color:' . $el_background_hover_color . ';';
                $less .= 'background-image: none;';
            }
            if ($el_background_hover_color_pattern) {
                $less .= '.ideo-box-overlay{background-image:url(' . ideothemo_get_assets_svg_data('svg/masks/' . $el_background_hover_color_pattern . '.svg', $el_background_hover_color_pattern_color) . ');} ';
            }
            break;
        case 'image':
            if ($el_background_hover_image) {
                $background_image = wp_get_attachment_image_src($el_background_hover_image, 'full');
                $less .= 'background-image:url(' . $background_image[0] . ');';
                $preload_image = $background_image[0];
            }
            if ($el_background_hover_position) $less .= 'background-position:' . $el_background_hover_position . ';';
            if ($el_background_hover_repeat) $less .= 'background-repeat:' . $el_background_hover_repeat . ';';
            if ($el_background_hover_size === 'true') $less .= 'background-size:cover;';
            if ($el_background_hover_overlay_pattern) {
                $less .= '.ideo-box-overlay{background-image:url(' . ideothemo_get_assets_svg_data('svg/masks/' . $el_background_hover_overlay_pattern . '.svg', $el_background_hover_overlay_pattern_color) . ');} ';
            } else {
                $less .= '.ideo-box-overlay{background-image:none;} ';
            }
            if ($el_background_hover_overlay_color) {
                $less .= '.ideo-box-overlay{background-color:' . $el_background_hover_overlay_color . ';} ';
            } else {
                $less .= '.ideo-box-overlay{background-color:transparent;} ';
            }
            break;
    }

    $less .= '}';

    if (!empty($background_image[0]))
        $less .= '&:after { content: url(' . $preload_image . '); display: none;}';

    $less .= '}';

    $less .= '}';

    /* ===   custom style   ==== */
    $html .= ideothemo_add_style($less, 'vc_shortcodes-custom-css');
    /* ===   end custom style   ==== */


    $html .= '<div class="ideo-box ' . esc_attr($el_extra_class) . '' . esc_attr($el_animation == ' viewport' ? $el_animation_type : '') . ' vc-layer" id="ideo_box_' . esc_attr($el_uid) . '" data-id="ideo_box_' . esc_attr($el_uid) . '" ' . $data . '>';
    $html .= '<div class="ideo-box-inner">';
    $html .= '<div class="ideo-box-overlay"></div>';
    $html .= '<div class="ideo-box-content">' . wpb_js_remove_wpautop($content) . '</div>';
    $html .= '</div>';
    $html .= '</div>';

    

    return $html;

}

add_shortcode('ideo_box_styled', 'ideothemo_box_styled_func');






