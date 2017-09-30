<?php
vc_map(array(
    'name' => __('Custom list', 'ideo-themo'),
    'base' => 'ideo_custom_list',    
    'icon' => 'icon-custom-list', 
    'category' => __('Content', 'ideo-themo'),
    'description' => __('Styled items list with icon beside.', 'ideo-themo'),
    'weight' => 87,
    'params' => array(

        array(
            'type' => 'textarea_html',
            'admin_label' => true,
            'heading' => __('ADD ITEMS', 'ideo-themo'),
            'param_name' => 'content',
            'value' => __('<ul><li>Lorem 1</li><li>Lorem 2</li><li>Lorem 3</li></ul>', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_google_fonts',
            'heading' => __('FONT FAMILY', 'ideo-themo'),
            'param_name' => 'el_font_family',
            'value' => '',
            'description' => __('Choose font family or leave empty to use default setting.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('FONT SIZE', 'ideo-themo'),
            'param_name' => 'el_font_size',
            'value' => '',
            'description' => __('Define font size or leave empty to use default setting.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('LINE HEIGHT', 'ideo-themo'),
            'param_name' => 'el_line_height',
            'value' => '',
            'description' => __('Define line height or leave empty to use default setting.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('LETTER SPACING', 'ideo-themo'),
            'param_name' => 'el_letter_spacing',
            'value' => '',
            'description' => __('Define letter spacing or leave empty to use default setting.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_switcher',
            'heading' => __('ICON', 'ideo-themo'),
            'param_name' => 'el_icon_enable',
            'on' => 'true',
            'off' => 'false',
            'value' => 'true',
            'dependencies' => array(
                'true' => array('el_icon', 'el_icon_size', 'el_icon_color', 'el_icon_margin')
            ),
            'description' => __('Enable this option if you want to use custom icon as list items marker instead of default markers. If you turn On this option several icon options will be available below.', 'ideo-themo'),
        ),
        array(
            'type' => 'ideo_choose_icon',
            'class' => '',
            'heading' => __('CHOOSE ICON', 'ideo-themo'),
            'param_name' => 'el_icon',
            'value' => 'fa fa-check',
            'description' => __('Choose icon which will be used as list items marker.', 'ideo-themo')
        ),

        array(
            'type' => 'textfield',
            'heading' => __('ICON SIZE', 'ideo-themo'),
            'param_name' => 'el_icon_size',
            'value' => '',
            'description' => __('Define icon size.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('ICON MARGIN', 'ideo-themo'),
            'param_name' => 'el_icon_margin',
            'value' => '10',
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
            'type' => 'ideo_slider',
            'heading' => __('MARGIN LEFT (px)', 'ideo-themo'),
            'param_name' => 'el_margin_left',
            'min' => '0',
            'max' => '200',
            'value' => '0',
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
                'transparent dark' => 'transparent-dark',
                'transparent light' => 'transparent-light',

            ),
            'colors' => ideothemo_get_colors(),
            'std' => ideothemo_get_shortcodes_default_style('ideo_custom_list'),
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
                    'text_color' => __('TEXT COLOR', 'ideo-themo'),
                    'icon_color' => __('ICON COLOR', 'ideo-themo'),
                ),
                'transparent' => array(
                    'text_color' => __('TEXT COLOR', 'ideo-themo'),
                    'icon_color' => __('ICON COLOR', 'ideo-themo'),
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
    'js_view' => 'VcCustomListView'
));

$el_font_family = $el_font_size = $el_font_weight = $el_font_style = $el_letter_spacing = $el_line_height = $el_icon_enable = $el_icon = $el_text_color = $el_icon_color = $el_icon_size = $el_icon_margin = $el_line_height = $el_margin_top = $el_margin_bottom = $el_margin_left = $el_extra_class = $el_custom_css = $el_animation = $el_animation_type = $el_animation_delay = $el_animation_duration = $el_animation_offset = $el_uid = $el_element_style = $el_element_style_colors = '';

function ideothemo_custom_list_func($atts, $content = "")
{
    
    extract(shortcode_atts(array(
        'el_font_family' => '',
        'el_font_size' => '',
        'el_font_weight' => '',
        'el_font_style' => '',
        'el_line_height' => '',
        'el_letter_spacing' => '',
        'el_icon_enable' => 'true',
        'el_icon' => 'fa fa-check',
        'el_icon_size' => '',
        'el_icon_margin' => '10',
        'el_line_height' => '',
        'el_icon_color' => '',
        'el_text_color' => '',
        'el_margin_top' => '20',
        'el_margin_bottom' => '20',
        'el_margin_left' => '0',
        'el_extra_class' => '',
        'el_custom_css' => '',
        'el_element_style' => ideothemo_get_shortcodes_default_style('ideo_custom_list'),
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


    $less = '#custom_list_' . $el_uid . '{';

    $custom_color = json_decode(str_replace("'", '"', $el_element_style_colors));

    $colors = ideothemo_get_colors_by_style($el_element_style);
    if (isset($custom_color->text_color) && $custom_color->text_color != '') {
        $less .= 'color:' . ideothemo_is_color($custom_color->text_color) . ';';
    }

    if ($el_line_height) {
        $less .= 'line-height:' . $el_line_height . ';';
    }
    if ($el_margin_top != '') {
        $less .= 'margin-top:' . (int)$el_margin_top . 'px;';
    }
    if ($el_margin_bottom != '') {
        $less .= 'margin-bottom:' . (int)$el_margin_bottom . 'px;';
    }
    if ($el_margin_left != '') {
        $less .= 'margin-left:' . (int)$el_margin_left . 'px;';
    }


    if ($el_font_family) {
        if (defined('DOING_AJAX') && DOING_AJAX){
            $data .= ' data-font="'.$el_font_family.'"';            
        }
        
        $google_fonts_data = explode('|', $el_font_family);
        if (is_array($google_fonts_data) && count($google_fonts_data) == 3) {
            $handle = sanitize_title('ideothemo_google_fonts_' . $google_fonts_data[0] . ':' . $google_fonts_data[1]. ($google_fonts_data[2] != 'null' ? $google_fonts_data[2] : ''));
            wp_enqueue_style($handle, '//fonts.googleapis.com/css?family=' . $google_fonts_data[0] . ':' . $google_fonts_data[1] . '&subset=' . ($google_fonts_data[2] != 'null' ? $google_fonts_data[2] : ''));

            $less .= 'font-family:' . $google_fonts_data[0] . ';';
            $font_weight = str_replace('regular', '', str_replace('italic', '', $google_fonts_data[1]));
            if (!empty($font_weight)) {
                $less .= 'font-weight:' . $font_weight . ';';
            } else if (strpos($google_fonts_data[1], 'regular') > -1 || empty($font_weight)) {
                $less .= 'font-weight:400;';
            }
            if (strpos($google_fonts_data[1], 'italic') > -1) {
                $less .= 'font-style:italic;';
            }

        }
    }
    $less .= '&,li{';
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


    if ($el_icon_enable == 'true') {
        if (isset($custom_color->icon_color) && $custom_color->icon_color != '') {
            $less .= 'li.with-icon>i.icon{color:' . ideothemo_is_color($custom_color->icon_color) . ';}';
        }
    }
    if ($el_icon_size && $el_icon_enable == 'true') {
        $less .= 'li.with-icon{margin-left:' . ideothemo_get_size($el_icon_size) . '*1.2;}';
        $less .= 'li.with-icon>i.icon{font-size:' . ideothemo_get_size($el_icon_size) . ';}';
    }
    if ($el_icon_margin && $el_icon_enable == 'true') {        
        $less .= 'li.with-icon>i.icon{margin-right:' . ideothemo_get_size($el_icon_margin) . ';}';
        $less .= 'li.with-icon>i.icon{ [dir="rtl"] &{margin-right:0;margin-left:' . ideothemo_get_size($el_icon_margin) . ';}}';
    }

    $less .= '}';

    /* ===   custom style   ==== */
    $html .= ideothemo_add_style($less, 'vc_shortcodes-custom-css');
    /* ===   end custom style   ==== */

    $html .= '<div class="ideo-custom-list ' . esc_attr($el_extra_class) . ' ' . esc_attr($el_element_style) . ' vc-layer" id="custom_list_' . esc_attr($el_uid) . '" data-id="custom_list_' . esc_attr($el_uid) . '" ' . $data . '>';
    
    $content = strip_tags($content, '<ul><ol><li><a><strong><em>');
    
    if ($el_icon && $el_icon_enable == 'true') {
        $html .= preg_replace('/<li([^>]*)>/', '<li class="with-icon"$1><i class="icon ' . esc_attr($el_icon) . '"></i>', $content);
    } else {
        $html .= wpb_js_remove_wpautop($content);
    }
    $html .= '</div>';

    

    return $html;
}

add_shortcode('ideo_custom_list', 'ideothemo_custom_list_func');