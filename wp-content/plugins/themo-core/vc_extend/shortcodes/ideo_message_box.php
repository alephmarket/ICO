<?php
vc_map(array(
    'name' => __('Message box', 'ideo-themo'),
    'base' => 'ideo_message_box',
    'icon' => 'icon-message-box',
    'category' => __('Content', 'ideo-themo'),
    'description' => __('Notification box: custom, info, warning, succes, error, standard.', 'ideo-themo'),
    'weight' => 78,
    'params' => array(

        array(
            'type' => 'ideo_dropdown',
            'heading' => __('MESSAGE TYPE', 'ideo-themo'),
            'admin_label' => true,
            'param_name' => 'el_message_type',
            'value' => array(
                __('Info', 'ideo-themo') => 'info',
                __('Warning', 'ideo-themo') => 'warning',
                __('Success', 'ideo-themo') => 'success',
                __('Error', 'ideo-themo') => 'error',
                __('Standard', 'ideo-themo') => 'standard',
                __('Custom', 'ideo-themo') => 'custom',
            ),
            'dependencies' => array(
                'custom' => array('el_icon')
            ),
            'std' => 'info',
            'description' => __('Choose one of predefined message boxes or choose Custom to create an uniqe message box.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_choose_icon',
            'class' => '',
            'heading' => __('CHOOSE ICON', 'ideo-themo'),
            'param_name' => 'el_icon',
            'value' => 'fa fa-star',
            'description' => __('Choose icon which will be displayed in custom message box.', 'ideo-themo')
        ),

        array(
            'type' => 'textfield',
            'heading' => __('ICON SIZE', 'ideo-themo'),
            'param_name' => 'el_icon_size',
            'value' => '',
            'description' => __('Define icon font size or leave empty field to use default setting.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('TITLE', 'ideo-themo'),
            'param_name' => 'el_title',
            'admin_label' => true,
            'value' => __('Message title', 'ideo-themo'),
            'description' => __('Enter message box title or leave empty field to remove title area from the element.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('TITLE FONT SIZE', 'ideo-themo'),
            'param_name' => 'el_title_font_size',
            'value' => '',
            'description' => __('Define title font size or leave empty field to use default setting.', 'ideo-themo')
        ),
        array(
            'type' => 'textarea',
            'heading' => __('DESCRIPTION', 'ideo-themo'),
            'param_name' => 'content',
            'admin_label' => true,
            'value' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'ideo-themo'),
            'description' => __('Enter message box description or leave empty field to remove description area from the element.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('DESCRIPTION FONT SIZE', 'ideo-themo'),
            'param_name' => 'el_content_font_size',
            'value' => '',
            'description' => __('Define description font size or leave empty field to use default setting.', 'ideo-themo')
        ),


        array(
            'type' => 'ideo_buttons',
            'heading' => __('CONTENT ALIGNMENT', 'ideo-themo'),
            'param_name' => 'el_content_align',
            'value' => array('Left' => 'left', 'Center' => 'center', 'Right' => 'right'),
            'std' => 'left',
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
            'value' => array(
                'colored dark' => 'colored-dark',
                'colored light' => 'colored-light',
                'transparent dark' => 'transparent-dark',
                'transparent light' => 'transparent-light',

            ),
            'colors' => ideothemo_get_colors(),
            'std' => ideothemo_get_shortcodes_default_style('ideo_message_box'),
            'description' => __('Choose style for an element. Depending on which option you choose appropriate colorpickers will be available below. You can freely customize colors for chosen style but you can also leave empty colorpickers to use colors which are set for that style in Customizer.', 'ideo-themo'),
            'group' => __('STYLING', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_custom_colors',
            'heading' => __('COLORS', 'ideo-themo'),
            'param_name' => 'el_elemnt_style_colors',
            'colors' => ideothemo_get_colors(),
            'el_colors' => array(
                'colored' => array(
                    'content_background_color' => __('CONTENT BACKGROUND COLOR', 'ideo-themo'),
                    'title_color' => __('TITLE COLOR', 'ideo-themo'),
                    'desc_color' => __('DESCRIPTION COLOR', 'ideo-themo'),
                ),
                'transparent' => array(
                    'content_borders_color' => __('CONTENT BORDERS TOP & BOTTOM COLOR', 'ideo-themo'),
                    'title_color' => __('TITLE COLOR', 'ideo-themo'),
                    'desc_color' => __('DESCRIPTION COLOR', 'ideo-themo'),
                )
            ),
            'el_colors_dependencies' => array(
                'el_message_type' => array(
                    'info' => array(
                        'colored' => array(
                            'content_background_color' => __('CONTENT BACKGROUND COLOR', 'ideo-themo'),
                            'title_color' => __('TITLE COLOR', 'ideo-themo'),
                            'desc_color' => __('DESCRIPTION COLOR', 'ideo-themo'),

                        ),
                        'transparent' => array(
                            'content_borders_color' => __('CONTENT BORDERS TOP & BOTTOM COLOR', 'ideo-themo'),
                            'title_color' => __('TITLE COLOR', 'ideo-themo'),
                            'desc_color' => __('DESCRIPTION COLOR', 'ideo-themo'),
                        )
                    ),
                    'warning' => array(
                        'colored' => array(
                            'content_background_color' => __('CONTENT BACKGROUND COLOR', 'ideo-themo'),
                            'title_color' => __('TITLE COLOR', 'ideo-themo'),
                            'desc_color' => __('DESCRIPTION COLOR', 'ideo-themo'),

                        ),
                        'transparent' => array(
                            'content_borders_color' => __('CONTENT BORDERS TOP & BOTTOM COLOR', 'ideo-themo'),
                            'title_color' => __('TITLE COLOR', 'ideo-themo'),
                            'desc_color' => __('DESCRIPTION COLOR', 'ideo-themo'),
                        )
                    ),
                    'success' => array(
                        'colored' => array(
                            'content_background_color' => __('CONTENT BACKGROUND COLOR', 'ideo-themo'),
                            'title_color' => __('TITLE COLOR', 'ideo-themo'),
                            'desc_color' => __('DESCRIPTION COLOR', 'ideo-themo'),

                        ),
                        'transparent' => array(
                            'content_borders_color' => __('CONTENT BORDERS TOP & BOTTOM COLOR', 'ideo-themo'),
                            'title_color' => __('TITLE COLOR', 'ideo-themo'),
                            'desc_color' => __('DESCRIPTION COLOR', 'ideo-themo'),
                        )
                    ),
                    'error' => array(
                        'colored' => array(
                            'content_background_color' => __('CONTENT BACKGROUND COLOR', 'ideo-themo'),
                            'title_color' => __('TITLE COLOR', 'ideo-themo'),
                            'desc_color' => __('DESCRIPTION COLOR', 'ideo-themo'),

                        ),
                        'transparent' => array(
                            'content_borders_color' => __('CONTENT BORDERS TOP & BOTTOM COLOR', 'ideo-themo'),
                            'title_color' => __('TITLE COLOR', 'ideo-themo'),
                            'desc_color' => __('DESCRIPTION COLOR', 'ideo-themo'),
                        )
                    ),
                    'standard' => array(
                        'colored' => array(
                            'content_background_color' => __('CONTENT BACKGROUND COLOR', 'ideo-themo'),
                            'title_color' => __('TITLE COLOR', 'ideo-themo'),
                            'desc_color' => __('DESCRIPTION COLOR', 'ideo-themo'),

                        ),
                        'transparent' => array(
                            'content_borders_color' => __('CONTENT BORDERS TOP & BOTTOM COLOR', 'ideo-themo'),
                            'title_color' => __('TITLE COLOR', 'ideo-themo'),
                            'desc_color' => __('DESCRIPTION COLOR', 'ideo-themo'),
                        )
                    ),
                    'custom' => array(
                        'colored' => array(
                            'content_background_color' => __('CONTENT BACKGROUND COLOR', 'ideo-themo'),
                            'title_color' => __('TITLE COLOR', 'ideo-themo'),
                            'desc_color' => __('DESCRIPTION COLOR', 'ideo-themo'),
                            'custom_icon_background_color' => __('ICON AREA BACKGROUND COLOR', 'ideo-themo'),
                            'custom_icon_color' => __('ICON COLOR', 'ideo-themo'),
                        ),
                        'transparent' => array(
                            'content_borders_color' => __('CONTENT AREA BORDERS COLOR', 'ideo-themo'),
                            'title_color' => __('TITLE COLOR', 'ideo-themo'),
                            'desc_color' => __('DESCRIPTION COLOR', 'ideo-themo'),
                            'custom_icon_background_color' => __('ICON AREA BACKGROUND COLOR', 'ideo-themo'),
                            'custom_icon_color' => __('ICON COLOR', 'ideo-themo'),
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
    'js_view' => 'VcMessageboxView'
));

$el_message_type = $el_icon = $el_icon_size = $el_title = $el_title_font_size = $el_content_align = $el_content_font_size = $el_margin_top = $el_margin_bottom = $el_extra_class = $el_custom_css = $el_elemnt_style = $el_elemnt_style_overwrite = $el_elemnt_style_colors = $el_animation = $el_animation_type = $el_animation_delay = $el_animation_duration = $el_animation_offset = $el_uid = '';


function ideothemo_message_box_func($atts, $content = "")
{
    
    extract(shortcode_atts(array(
        'el_message_type' => 'info',
        'el_icon' => 'fa fa-star',
        'el_icon_size' => '',
        'el_title' => __('Message title', 'ideo-themo'),
        'el_title_font_size' => '',
        'el_content_align' => 'left',
        'el_content_font_size' => '',
        'el_margin_top' => '20',
        'el_margin_bottom' => '20',
        'el_extra_class' => '',
        'el_custom_css' => '',
        'el_elemnt_style' => ideothemo_get_shortcodes_default_style('ideo_message_box'),
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

    if ($el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-type="' . esc_attr($el_animation_type) . '"';
    if ($el_animation_delay && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-delay="' . esc_attr($el_animation_delay) . '"';
    if ($el_animation_duration && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-duration="' . esc_attr($el_animation_duration) . '"';
    if ($el_animation_offset && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-offset="' . esc_attr($el_animation_offset) . '"';


    $less = '#message_box_' . $el_uid . '{';

    if ($el_margin_top != '') {
        $less .= 'margin-top:' . (int)$el_margin_top . 'px;';
    }
    if ($el_margin_bottom != '') {
        $less .= 'margin-bottom:' . (int)$el_margin_bottom . 'px;';
    }
    if ($el_content_align) {
        $less .= 'text-align:' . $el_content_align . ';';
    }
    if ($el_content_font_size) {
        $less .= 'p{font-size:' . ideothemo_get_size($el_content_font_size) . '}';
    }
    if ($el_title_font_size) {
        $less .= 'span.title{font-size:' . ideothemo_get_size($el_title_font_size) . '}';
    }
    if ($el_icon_size) {
        $less .= '.icon, .ideo-message-box-content:after{font-size:' . ideothemo_get_size($el_icon_size) . '}';
    }
    $less .= '}';


    /* ===   custom style   ==== */
    $colors = ideothemo_get_colors_by_style($el_elemnt_style);
    $default_vars = array(
        'info' => array(
            'colored' => array(
                'content_background_color' => 'undefined',
                'title_color' => 'undefined',
                'desc_color' => 'undefined',
                'custom_icon_color' => 'undefined',
                'custom_icon_background_color' => 'undefined',
            ),
            'transparent' => array(
                'content_borders_color' => 'undefined',
                'title_color' => 'undefined',
                'desc_color' => 'undefined',
                'custom_icon_color' => 'undefined',
                'custom_icon_background_color' => 'undefined',
            )
        ),
        'warning' => array(
            'colored' => array(
                'content_background_color' => 'undefined',
                'title_color' => 'undefined',
                'desc_color' => 'undefined',
                'custom_icon_color' => 'undefined',
                'custom_icon_background_color' => 'undefined',

            ),
            'transparent' => array(
                'content_borders_color' => 'undefined',
                'title_color' => 'undefined',
                'desc_color' => 'undefined',
                'custom_icon_color' => 'undefined',
                'custom_icon_background_color' => 'undefined',
            )
        ),
        'success' => array(
            'colored' => array(
                'content_background_color' => 'undefined',
                'title_color' => 'undefined',
                'desc_color' => 'undefined',
                'custom_icon_color' => 'undefined',
                'custom_icon_background_color' => 'undefined',

            ),
            'transparent' => array(
                'content_borders_color' => 'undefined',
                'title_color' => 'undefined',
                'desc_color' => 'undefined',
                'custom_icon_color' => 'undefined',
                'custom_icon_background_color' => 'undefined',
            )
        ),
        'error' => array(
            'colored' => array(
                'content_background_color' => 'undefined',
                'title_color' => 'undefined',
                'desc_color' => 'undefined',
                'custom_icon_color' => 'undefined',
                'custom_icon_background_color' => 'undefined',

            ),
            'transparent' => array(
                'content_borders_color' => 'undefined',
                'title_color' => 'undefined',
                'desc_color' => 'undefined',
                'custom_icon_color' => 'undefined',
                'custom_icon_background_color' => 'undefined',
            )
        ),
        'standard' => array(
            'colored' => array(
                'content_background_color' => 'undefined',
                'title_color' => 'undefined',
                'desc_color' => 'undefined',
                'custom_icon_color' => 'undefined',
                'custom_icon_background_color' => 'undefined',

            ),
            'transparent' => array(
                'content_borders_color' => 'undefined',
                'title_color' => 'undefined',
                'desc_color' => 'undefined',
                'custom_icon_color' => 'undefined',
                'custom_icon_background_color' => 'undefined',
            )
        ),
        'custom' => array(
            'colored' => array(
                'content_background_color' => 'undefined',
                'title_color' => 'undefined',
                'desc_color' => 'undefined',
                'custom_icon_color' => 'undefined',
                'custom_icon_background_color' => 'undefined',
            ),
            'transparent' => array(
                'content_borders_color' => 'undefined',
                'title_color' => 'undefined',
                'desc_color' => 'undefined',
                'custom_icon_color' => 'undefined',
                'custom_icon_background_color' => 'undefined',
            )
        )
    );

    $html .= ideothemo_custom_style('message_box', $el_uid, $default_vars[$el_message_type], $el_elemnt_style, $el_elemnt_style_colors, $less);
    /* ===   end custom style   ==== */


    $html .= '<div class="ideo-message-box  type-' . esc_attr($el_message_type) . ' ' . esc_attr($el_elemnt_style) . ' ' . esc_attr($el_extra_class) . ' vc-layer" id="message_box_' . esc_attr($el_uid) . '" data-id="message_box_' . esc_attr($el_uid) . '" ' . $data . '>';
    $html .= '<div class="ideo-message-box-content">';
    $html .= '<a href="#" class="message-close"></a>';
    if ($el_message_type == 'custom' && $el_icon) {
        $html .= '<i class="icon ' . esc_attr($el_icon) . '"></i>';
    }
    if ($el_title != '') {
        $html .= '<span class="title">' . ideo_esc($el_title) . '</span>';
    }
    if ($content != '') {
        $html .= '<p>' . wpb_js_remove_wpautop($content) . '</p>';
    }
    $html .= '</div>';
    $html .= '</div>';

    


    return $html;
}

add_shortcode('ideo_message_box', 'ideothemo_message_box_func');