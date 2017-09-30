<?php
vc_map(array(
    'name' => __('Icon', 'ideo-themo'),
    'base' => 'ideo_icons',
    'icon' => 'icon-icons',
    'category' => __('Content', 'ideo-themo'),
    'description' => __('Single icon with simple or advanced settings.', 'ideo-themo'),
    'weight' => 82,
    'params' => array(
        array(
            'type' => 'ideo_buttons',
            'heading' => __('ICON TYPE', 'ideo-themo'),
            'admin_label' => true,
            'param_name' => 'el_style',
            'value' => array(__('Simple', 'ideo-themo') => 'simple', __('Advanced', 'ideo-themo') => 'advanced'),
            'dependencies' => array(
                'simple' => array(),
                'advanced' => array('el_radius', 'el_border_weight', 'el_advanced_icon_color', 'el_advanced_icon_hover_color', 'el_advanced_background_color', 'el_advanced_background_hover_color', 'el_advanced_border_color', 'el_advanced_border_hover_color')
            ),
            'std' => 'simple',
            'description' => __('Choose icon type: Simple (plain icon) or Advanced (icon with background and border). Depending on which option you choose appropriate options will be available below.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('BORDER RADIUS %', 'ideo-themo'),
            'param_name' => 'el_radius',
            'min' => '0',
            'max' => '50',
            'value' => '0',
            'description' => __('Define icon border radius in percentages. This option allows you to add rounded borders.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('BORDER THICKNESS (px)', 'ideo-themo'),
            'param_name' => 'el_border_weight',
            'min' => '0',
            'max' => '10',
            'value' => '2',
            'description' => __('Define icon border thickness in pixels.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('ICON SIZE', 'ideo-themo'),
            'param_name' => 'el_size',
            'value' => '',
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
            'type' => 'ideo_switcher',
            'heading' => __('HOVER', 'ideo-themo'),
            'param_name' => 'el_hover',
            'on' => 'true',
            'off' => 'false',
            'value' => 'false',
            'description' => __('Enable or disable icon hover.', 'ideo-themo')
        ),

        array(
            'type' => 'vc_link',
            'heading' => __('ICON URL', 'ideo-themo'),
            'param_name' => 'el_url',
            'value' => '',
            'description' => __('Enter icon URL if you want to set icon linking.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('ICON DISPLAY', 'ideo-themo'),
            'param_name' => 'el_icon_display',
            'value' => array(__('Inline Block', 'ideo-themo') => 'inline', __('Block', 'ideo-themo') => 'block'),
            'dependencies' => array(
                'inline' => array('el_float'),
                'block' => array('el_align', 'el_mobile_align'),
            ),
            'std' => 'inline',
            'description' => __('Choose Inline block or Block to set display property which specifies the type of the container used for an element. Inline block allows you to display several icons next to each other while the Block containers are displayed one under another.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('ICON ALIGN', 'ideo-themo'),
            'param_name' => 'el_align',
            'value' => array(__('Inherit', 'ideo-themo') =>'none', __('Left', 'ideo-themo') => 'left', __('Center', 'ideo-themo') => 'center', __('Right', 'ideo-themo') => 'right'),
            'std' => 'left',
            'description' => __('Using this option you can align the icon to the Left, Center or Right side of the container.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('ICON ALIGN ON MOBILE', 'ideo-themo'),
            'param_name' => 'el_mobile_align',
            'value' => array(__('Inherit', 'ideo-themo') =>'none', __('Left', 'ideo-themo') => 'left', __('Center', 'ideo-themo') => 'center', __('Right', 'ideo-themo') => 'right'),
            'std' => 'left',
            'description' => __('Using this option you can align the icon to the Left, Center or Right side of the container.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('ICON FLOAT', 'ideo-themo'),
            'param_name' => 'el_float',
            'value' => array(__('None', 'ideo-themo') => '', __('Left', 'ideo-themo') => 'left', __('Right', 'ideo-themo') => 'right'),
            'std' => '',
            'description' => __('The float property specifies if/how the icon should float between neighbouring inline elements. You can choose Left or Right float or choose None to display the icon just where it occurs in grid.', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_dropdown',
            'heading' => __('INFINITE ANIMATION', 'ideo-themo'),
            'param_name' => 'el_icon_animation',
            'value' => array(
                __('None', 'ideo-themo') => '',
                __('FLOAT VERTICALLY', 'ideo-themo') => 'floaty',
                __('FLOAT HORIZONTALLY', 'ideo-themo') => 'floatx',
                __('PULSE', 'ideo-themo') => 'pulse',
                __('TOSSING', 'ideo-themo') => 'tossing',
                __('SPIN', 'ideo-themo') => 'spin',
                __('FLIP', 'ideo-themo') => 'flip'
            ),
            'std' => '',
            'description' => __('Choose one of predefined infinite animation or choose None to display static icon.', 'ideo-themo')
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
            'heading' => __('MARGIN RIGHT (px)', 'ideo-themo'),
            'param_name' => 'el_margin_right',
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
            'type' => 'ideo_slider',
            'heading' => __('MARGIN LEFT (px)', 'ideo-themo'),
            'param_name' => 'el_margin_left',
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
            'param_name' => 'el_element_style',
            'value' => array(
                'colored dark' => 'colored-dark',
                'colored light' => 'colored-light',
                'transparent dark' => 'transparent-dark',
                'transparent light' => 'transparent-light',

            ),
            'colors' => ideothemo_get_colors(),
            'std' => ideothemo_get_shortcodes_default_style('ideo_icons'),
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
                'transparent' => array(
                    'text_color' => __('DIVIDER COLOR', 'ideo-themo')
                )
            ),
            'el_colors_dependencies' => array(
                'el_style' => array(
                    'simple' => array(
                        'colored' => array(
                            'icon_color' => __('ICON COLOR', 'ideo-themo'),
                            'icon_hover_color' => __('ICON HOVER COLOR', 'ideo-themo')
                        ),
                        'transparent' => array(
                            'icon_color' => __('ICON COLOR', 'ideo-themo'),
                            'icon_hover_color' => __('ICON HOVER COLOR', 'ideo-themo')
                        )
                    ),
                    'advanced' => array(
                        'colored' => array(
                            'icon_background_color' => __('ICON BACKGROUND COLOR', 'ideo-themo'),
                            'icon_color' => __('ICON COLOR', 'ideo-themo'),
                            'icon_border_color' => __('ICON BORDER COLOR', 'ideo-themo'),
                            'icon_background_hover_color' => __('ICON BACKGROUND HOVER COLOR', 'ideo-themo'),
                            'icon_hover_color' => __('ICON HOVER COLOR', 'ideo-themo'),
                            'icon_hover_border_color' => __('ICON HOVER BORDER COLOR', 'ideo-themo'),

                        ),
                        'transparent' => array(

                            'icon_color' => __('ICON COLOR', 'ideo-themo'),
                            'icon_border_color' => __('ICON BORDER COLOR', 'ideo-themo'),
                            'icon_hover_color' => __('ICON HOVER COLOR', 'ideo-themo'),
                            'icon_hover_border_color' => __('ICON HOVER BORDER COLOR', 'ideo-themo'),

                        )
                    )
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
    'js_view' => 'VcIconsView'
));


$el_style = $el_radius = $el_border_weight = $el_size = $el_icon = $el_hover = $el_url = $el_align = $el_mobile_align = $el_icon_display = $el_float = $el_icon_animation = $el_margin_top = $el_margin_bottom = $el_margin_left = $el_margin_right = $el_extra_class = $el_custom_css = $el_animation = $el_animation_type = $el_animation_delay = $el_animation_duration = $el_animation_offset = $el_uid = $el_element_style = $el_element_style_colors = '';

function ideothemo_icons_func($atts, $content = "")
{
    
    extract(shortcode_atts(array(
        'el_style' => 'simple',
        'el_radius' => '0',
        'el_border_weight' => '2',
        'el_size' => '',
        'el_icon' => 'fa fa-star',
        'el_hover' => 'false',
        'el_url' => '',
        'el_align' => 'left',
        'el_mobile_align' => 'left',
        'el_float' => '',
        'el_icon_display' => 'inline',
        'el_icon_animation' => '',
        'el_margin_top' => '20',
        'el_margin_right' => '20',
        'el_margin_bottom' => '20',
        'el_margin_left' => '20',
        'el_extra_class' => '',
        'el_custom_css' => '',
        'el_element_style' => ideothemo_get_shortcodes_default_style('ideo_icons'),
        'el_element_style_colors' => '',
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

    $less = '#icons_' . $el_uid . '{';


    if ($el_icon_display == 'inline' && $el_float != '') {
        $less .= 'float:' . $el_float . ';';
    }
    if ($el_margin_top != '') {
        $less .= 'margin-top:' . (int)$el_margin_top . 'px;';
    }
    if ($el_margin_right != '') {
        $less .= 'margin-right:' . (int)$el_margin_right . 'px;';
    }
    if ($el_margin_bottom != '') {
        $less .= 'margin-bottom:' . (int)$el_margin_bottom . 'px;';
    }
    if ($el_margin_left != '') {
        $less .= 'margin-left:' . (int)$el_margin_left . 'px;';
    }

    $custom_color = json_decode(str_replace("'", '"', $el_element_style_colors));
    $colors = ideothemo_get_colors_by_style($el_element_style);


    if (isset($custom_color->icon_color) && $custom_color->icon_color != '') {
        $el_icon_color = ideothemo_is_color($custom_color->icon_color);
    } else {
        $el_icon_color = $colors['text_color'];
    }

    $less .= 'i{';
    if ($el_size) {
        $less .= 'font-size:' . ideothemo_get_size($el_size) . ';';
    }
    if ($el_style == 'simple') {


    } else {  //advanced
        if ($el_border_weight) {
            $less .= 'border-style:solid;';
            $less .= 'border-width:' . $el_border_weight . 'px ;';
        }
        if ($el_radius) $less .= 'border-radius: ' . $el_radius . '%;';

        $less .= 'padding: 0.5em;';

    }
    $less .= '}';

    $less .= '}';

    /* ===   custom style   ==== */
    $colors = ideothemo_get_colors_by_style($el_element_style);

    if ($el_style == 'simple') {
        $icon_color = $colors['accent_color'];
    } else {
        $icon_color = $colors['alternative_title_color'];
    }

    $default_vars = array(
        'colored' => array(
            'icon_background_color' => 'undefined',
            'icon_color' => 'undefined',
            'icon_border_color' => 'undefined',
            'icon_background_hover_color' => 'undefined',
            'icon_hover_color' => 'undefined',
            'icon_hover_border_color' => 'undefined',

        ),
        'transparent' => array(
            'icon_color' => 'undefined',
            'icon_border_color' => 'undefined',
            'icon_hover_color' => 'undefined',
            'icon_hover_border_color' => 'undefined',
        )
    );


    $html .= ideothemo_custom_style('icons', $el_uid, $default_vars, $el_element_style, $el_element_style_colors, $less);
    /* ===   end custom style   ==== */

    $animation_classes = '';

    if ($el_animation_type)
        $animation_classes .= ' animation-' . $el_animation_type;

    if ($el_icon_animation)
        $animation_classes .= ' animation-' . $el_icon_animation;

    if ($el_url) {
        $el_url = ($el_url == '||') ? '' : $el_url;
        $el_url = vc_build_link($el_url);
        $a_href = $el_url['url'];
        $a_title = $el_url['title'];
        $a_target = trim($el_url['target'])?:'_self';

        $html .= '<a class="ideo-icons  style-' . esc_attr($el_style) . ' ' . $el_element_style . ' align-' . esc_attr($el_align) . ' mobile-align-' . esc_attr($el_mobile_align) . ' display-' . esc_attr($el_icon_display) . ' ' . ($el_hover == 'true' ? 'icon-hover' : '') . ' ' . esc_attr($el_extra_class) . ' vc-layer" id="icons_' . esc_attr($el_uid) . '" data-id="icons_' . esc_attr($el_uid) . '" ' . $data . ' href="' . esc_url($a_href) . '"
       title="' . esc_attr($a_title) . '" target="' . esc_attr($a_target) . '"><i class="icon ' . esc_attr($el_icon . $animation_classes) . '"></i></a>';
    } else {
        $html .= '<span class="ideo-icons  style-' . esc_attr($el_style) . ' ' . esc_attr($el_element_style) . ' align-' . esc_attr($el_align) . ' mobile-align-' . esc_attr($el_mobile_align) . ' display-' . esc_attr($el_icon_display) . ' ' . ($el_hover == 'true' ? 'icon-hover' : '') . ' ' . esc_attr($el_extra_class) . ' vc-layer" id="icons_' . esc_attr($el_uid) . '" data-id="icons_' . esc_attr($el_uid) . '" ' . $data . '>';
        $html .= '<i class="icon ' . esc_attr($el_icon . $animation_classes) . '"></i>';
        $html .= '</span>';
    }

    

    return $html;
}

add_shortcode('ideo_icons', 'ideothemo_icons_func');