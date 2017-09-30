<?php

vc_map(array(
    'name' => __('Divider with Icon', 'ideo-themo'),
    'base' => 'vc_separator_icon',
    'icon' => 'icon-icon-divider',
    'category' => __('Content', 'ideo-themo'),
    'description' => __('Horizontal separator with icon.', 'ideo-themo'),
    'weight' => 85,
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
            'value' => array('percentages' => 'percentages', 'pixels' => 'pixels'),
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
            'description' => __('Define divider width in pixels', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_buttons',
            'heading' => __('DIVIDER ALIGN', 'ideo-themo'),
            'param_name' => 'el_align',
            'value' => array(__('Left', 'ideo-themo') => 'left', __('Center', 'ideo-themo') => 'center', __('Right', 'ideo-themo') => 'right'),
            'std' => 'center',
        ),
        
        array(
            'type' => 'ideo_buttons',
            'heading' => __('DIVIDER ALIGN ON MOBILE', 'ideo-themo'),
            'param_name' => 'el_mobile_align',
            'value' => array(__('Left', 'ideo-themo') => 'left', __('Center', 'ideo-themo') => 'center', __('Right', 'ideo-themo') => 'right'),
            'std' => 'center',
        ),

        array(
            'type' => 'ideo_buttons',
            'heading' => __('ICON POSITION', 'ideo-themo'),
            'param_name' => 'el_icon_position',
            'value' => array('Center' => 'center-icon', 'Left' => 'left-icon', 'Right' => 'right-icon'),
            'std' => 'center-icon',
            'description' => __('Decide on which side of the divider the icon will be displayed.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_choose_icon',
            'admin_label' => true,
            'class' => '',
            'heading' => __('CHOOSE ICON', 'ideo-themo'),
            'param_name' => 'el_icon',
            'value' => 'fa fa-star',
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('ICON SIZE (px)', 'ideo-themo'),
            'param_name' => 'el_icon_size',
            'min' => '4',
            'max' => '100',
            'value' => '30',
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('SPACE BETWEEN DIVIDER AND ICON (px)', 'ideo-themo'),
            'param_name' => 'el_icon_space',
            'min' => '0',
            'max' => '50',
            'value' => '5',
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('ICON BACKGROUND SHAPE', 'ideo-themo'),
            'param_name' => 'el_icon_background_shape',
            'value' => array(
                __('None', 'ideo-themo') => 'none',
                __('Circle', 'ideo-themo') => 'icon-bg-1.svg',
                __('Bordered circle', 'ideo-themo') => 'icon-bg-4.svg',
                __('Hexagon', 'ideo-themo') => 'icon-bg-2.svg',
                __('Rounded hexagon', 'ideo-themo') => 'icon-bg-3.svg',
                __('Bottle cap', 'ideo-themo') => 'icon-bg-6.svg',
                __('Bordered bottle cap', 'ideo-themo') => 'icon-bg-5.svg'
            ),
            'std' => 'none',
            'description' => __('Choose one of predefined icon background shapes or choose None to display plain icon.', 'ideo-themo')
        ),


        array(
            'type' => 'ideo_dropdown',
            'heading' => __('ELEMENT STYLE', 'ideo-themo'),
            'param_name' => 'el_element_style',
            'value' => array(
                'colored dark' => 'colored-dark',
                'colored light' => 'colored-light',
            ),
            'colors' => ideothemo_get_colors(),
            'std' => ideothemo_get_shortcodes_default_style('ideo_divider'),
            'admin_label' => true,
            'description' => __('Choose style for the element. Depending on which option you choose appropriate colorpickers will be available below. You can freely customize colors for chosen style but you can also leave empty colorpickers to use colors which are set for that style in Customizer.', 'ideo-themo'),
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
            ),
            'el_colors_dependencies' => array(
                'el_icon_background_shape' => array(
                    'none' => array(
                        'colored' => array(
                            'icon_color' => __('ICON COLOR', 'ideo-themo'),
                            'divider_color' => __('DIVIDER COLOR', 'ideo-themo')

                        ),
                    ),
                    'icon-bg-1.svg' => array(
                        'colored' => array(
                            'icon_background_color' => __('ICON BACKGROUND COLOR', 'ideo-themo'),
                            'icon_color' => __('ICON COLOR', 'ideo-themo'),
                            'divider_color' => __('DIVIDER COLOR', 'ideo-themo')

                        ),
                    ),
                    'icon-bg-2.svg' => array(
                        'colored' => array(
                            'icon_background_color' => __('ICON BACKGROUND COLOR', 'ideo-themo'),
                            'icon_color' => __('ICON COLOR', 'ideo-themo'),
                            'divider_color' => __('DIVIDER COLOR', 'ideo-themo')

                        ),
                    ),
                    'icon-bg-3.svg' => array(
                        'colored' => array(
                            'icon_background_color' => __('ICON BACKGROUND COLOR', 'ideo-themo'),
                            'icon_color' => __('ICON COLOR', 'ideo-themo'),
                            'divider_color' => __('DIVIDER COLOR', 'ideo-themo')

                        ),
                    ),
                    'icon-bg-4.svg' => array(
                        'colored' => array(
                            'icon_background_color' => __('ICON BACKGROUND COLOR', 'ideo-themo'),
                            'icon_color' => __('ICON COLOR', 'ideo-themo'),
                            'divider_color' => __('DIVIDER COLOR', 'ideo-themo')

                        ),
                    ),
                    'icon-bg-5.svg' => array(
                        'colored' => array(
                            'icon_background_color' => __('ICON BACKGROUND COLOR', 'ideo-themo'),
                            'icon_color' => __('ICON COLOR', 'ideo-themo'),
                            'divider_color' => __('DIVIDER COLOR', 'ideo-themo')

                        ),
                    ),
                    'icon-bg-6.svg' => array(
                        'colored' => array(
                            'icon_background_color' => __('ICON BACKGROUND COLOR', 'ideo-themo'),
                            'icon_color' => __('ICON COLOR', 'ideo-themo'),
                            'divider_color' => __('DIVIDER COLOR', 'ideo-themo')

                        ),
                    )
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
            'value' => '20',
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
    'js_view' => 'VcTextSeparatorIconView'
));


$el_type = $el_width = $el_width_percentages = $el_width_pixels = $el_align = $el_mobile_align = $el_color = $el_icon_color = $el_icon = $el_icon_position = $el_margin_top = $el_margin_bottom = $el_extra_class = $el_custom_css = $el_animation = $el_animation_type = $el_animation_delay = $el_animation_duration = $el_animation_offset = $el_icon_background_shape = $el_icon_background_color = $el_element_style = $el_element_style_colors = '';

function ideothemo_separator_icon_func($atts, $content = '')
{
    
    extract(shortcode_atts(array(
        'el_type' => 'dividers/thin-solid-line.svg',
        'el_width' => 'percentages',
        'el_width_percentages' => '100',
        'el_width_pixels' => '200',
        'el_align' => 'center',
        'el_mobile_align' => 'center',
        'el_color' => '',
        'el_icon_color' => '',
        'el_icon' => 'fa fa-star',
        'el_icon_position' => 'center-icon',
        'el_icon_size' => '30',
        'el_icon_space' => '5',
        'el_icon_background_shape' => 'none',
        'el_icon_background_color' => '',
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
    $colors = ideothemo_get_colors_by_style($el_element_style);


    if (isset($custom_color->icon_background_color) && $custom_color->icon_background_color != '') {
        $el_icon_background_color = ideothemo_is_color($custom_color->icon_background_color);
    } else {
        $el_icon_background_color = ideothemo_hex2rgba($colors['background_color'], 0.18);
        $data .= (ideothemo_is_customize_preview() && $el_icon_background_shape != 'none') ? ' data-icon-svg-type="' . $el_icon_background_shape . '" ' : '';
    }

    if (isset($custom_color->divider_color) && $custom_color->divider_color != '') {
        $el_color = ideothemo_is_color($custom_color->divider_color);
    } else {
        $el_color = $colors['background_color'];
        $data .= (ideothemo_is_customize_preview() ? ' data-svg-type="' . $el_type . '" ' : '');
    }

    if (isset($custom_color->icon_color) && $custom_color->icon_color != '') {
        $el_icon_color = ideothemo_is_color($custom_color->icon_color);
    } else {
        $el_icon_color = $colors['accent_color'];
        $data .= (ideothemo_is_customize_preview()) ? ' data-icon-colored="true" ' : '';
    }

    $svg = ideothemo_get_assets_svg_data('svg/' . $el_type, $el_color);


    if ($el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-type="' . esc_attr($el_animation_type) . '"';
    if ($el_animation_delay && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-delay="' . esc_attr($el_animation_delay) . '"';
    if ($el_animation_duration && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-duration="' . esc_attr($el_animation_duration) . '"';
    if ($el_animation_offset && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-offset="' . esc_attr($el_animation_offset) . '"';


    $less = '#diver_icon_' . $el_uid . '{';

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

    if ($el_custom_css) {
        $less .= $el_custom_css;
    }

    $less .= '.line-left,';
    $less .= '.line-right{';
    $less .= 'background-image:url(' . $svg . ');';
    $less .= '}';

    $less .= '.icon{';
    if ($el_icon_color) {
        $less .= 'color:' . $el_icon_color . ';';
    }
    $less .= 'font-size:' . $el_icon_size . 'px;';
    $less .= ' i { margin: 0 ' . $el_icon_space . 'px; } ';

    if ($el_icon_background_shape) {
        $svg_icon = ideothemo_get_assets_svg_data('svg/' . $el_icon_background_shape, $el_icon_background_color);
        $less .= 'background-image: url(' . $svg_icon . '); background-size: contain;background-position: center center;background-repeat: no-repeat;';
    }


    $less .= '}';

    $less .= '}';

    /* ===   custom style   ==== */
    $html .= ideothemo_add_style($less, 'vc_shortcodes-custom-css');
    /* ===   end custom style   ==== */

    //$svg is data:image, not url
    $img = '<img src="' . $svg . '" alt="divider" />';

    $html .= '<div class="diver-wrap divider-icon align-' . esc_attr($el_align) . ' ' . ' mobile-align-' . esc_attr($el_mobile_align) . '"><div class="diver-icon ' . esc_attr(isset($el_icon_position) ? $el_icon_position : '') . ' ' . esc_attr($el_element_style) . ' ' . esc_attr($el_extra_class) . '" id="diver_icon_' . esc_attr($el_uid) . '" data-id="diver_icon_' . esc_attr($el_uid) . '" ' . $data . '>';

    $html .= '<span class="line-left">' . $img . '</span>';

    if ($el_icon_background_shape != '') {
        $html .= '<span class="icon"><i class="bg ' . esc_attr(isset($el_icon) ? $el_icon : '') . '"></i></span>';

    } else {
        $html .= '<span class="icon"><i class="' . esc_attr(isset($el_icon) ? $el_icon : '') . '"></i></span>';
    }

    $html .= '<span class="line-right">' . $img . '</span>';


    $html .= '</div></div>';

    

    return $html;
}

add_shortcode('vc_separator_icon', 'ideothemo_separator_icon_func');

