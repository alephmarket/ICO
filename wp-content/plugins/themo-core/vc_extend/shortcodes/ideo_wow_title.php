<?php

class WPBakeryShortCode_ideo_wow_title extends WPBakeryShortCode
{  
    protected function outputTitle($title)
    {
        $icon = $this->settings('icon');

        return '<h4 class="wpb_element_title">' . $title . '<span class="vc_general vc_element-icon' . (!empty($icon) ? ' ' . $icon : '') . '"></span></h4>';
    }
}

vc_map(array(
    'name' => __('IDEO Titile', 'ideo-themo'),
    'base' => 'ideo_wow_title',
    'icon' => 'icon-themo-title',
    'weight' => 97,
    'category' => __('Content', 'ideo-themo'),
    'description' => __('Advanced Title element with many styles and options.', 'ideo-themo'),
    'params' => array(

        array(
            'type' => 'textfield',
            'admin_label' => true,
            'heading' => __('TITLE', 'ideo-themo'),
            'param_name' => 'content',
            'value' => __('Place title here', 'ideo-themo'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('TITLE TAG', 'ideo-themo'),
            'param_name' => 'el_tag',
            'value' => array(__('h1', 'ideo-themo') => 'h1', __('h2', 'ideo-themo') => 'h2', __('h3', 'ideo-themo') => 'h3', __('h4', 'ideo-themo') => 'h4', __('h5', 'ideo-themo') => 'h5', __('h6', 'ideo-themo') => 'h6'),
            'std' => 'h2',
            'description' => __('Tag the title with one of html tags for SEO needs.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('TITLE STYLE', 'ideo-themo'),
            'param_name' => 'el_style',
            'std' => 'text',
            'value' => array(__('Text only', 'ideo-themo') => 'text', __('Simple', 'ideo-themo') => 'simple', __('Icon', 'ideo-themo') => 'icon', __('Underlined', 'ideo-themo') => 'underlined'),
            'dependencies' => array(
                'text' => array(),
                'simple' => array('el_title_side_wings', 'el_title_side_wings_distance', 'el_title_side_wings_width', 'el_border_enable'),
                'icon' => array('el_title_side_wings', 'el_title_side_wings_distance', 'el_title_side_wings_width', 'el_icon_background_shape', 'el_icon', 'el_icon_size',),
                'underlined' => array('el_title_side_wings', 'el_title_side_wings_distance', 'el_title_side_wings_width'),
            ),
            'description' => __('Choose title style:</br>
			<b>Text only</b> - plain text;</br>
			<b>Simple</b> - text with customizable background, border and side wings;</br>
			<b>Icon</b> - text with customizable background, side wings and icon which is displayed above the text;</br>
			<b>Underlined</b> - text with customizable background, side wings and underline.</br>
			Depending on which option you choose appropriate additional options will be available.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_switcher',
            'heading' => __('BORDER', 'ideo-themo'),
            'param_name' => 'el_border_enable',
            'on' => 'true',
            'off' => 'false',
            'value' => 'true',
            'dependencies' => array(
                'true' => array('el_border_thickness', 'el_border_distance', 'el_border_radius')
            ),
            'description' => __('Enable or disable border. When this option is turned on additional options are available.', 'ideo-themo'),
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('BORDER THICKNESS (px)', 'ideo-themo'),
            'param_name' => 'el_border_thickness',
            'min' => '0',
            'max' => '10',
            'value' => '1',
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('BORDER DISTANCE (px)', 'ideo-themo'),
            'param_name' => 'el_border_distance',
            'min' => '0',
            'max' => '10',
            'value' => '4',
            'description' => __('Define the distance between border and background.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('BORDER RADIUS (px)', 'ideo-themo'),
            'param_name' => 'el_border_radius',
            'min' => '0',
            'max' => '150',
            'value' => '150',
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
            'std' => 'icon-bg-1.svg',
            'description' => __('Choose one of predefined icon background shapes or choose None to display plain icon.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_choose_icon',
            'class' => '',
            'heading' => __('CHOOSE ICON', 'ideo-themo'),
            'param_name' => 'el_icon',
            'value' => 'fa fa-star',
        ),

        array(
            'type' => 'ideo_buttons',
            'heading' => __('ICON SIZE', 'ideo-themo'),
            'param_name' => 'el_icon_size',
            'value' => array(__('small', 'ideo-themo') => 'small', __('medium', 'ideo-themo') => 'medium', __('large', 'ideo-themo') => 'large'),
            'std' => 'medium',
            'description' => __('Choose Small, Medium or Large icon size - this option refers to the icon background and the icon itself.', 'ideo-themo')
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('TITLE SIDE WINGS', 'ideo-themo'),
            'param_name' => 'el_title_side_wings',
            'value' => array(
                __('None', 'ideo-themo') => '',
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
            'std' => '',
            'description' => __('Choose one of predefined title side wings or choose None if you do not want to display title wings.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('TITLE WINGS DISTANCE', 'ideo-themo'),
            'param_name' => 'el_title_side_wings_distance',
            'value' => '10',
            'description' => __('Define distance between the title and the title side wings.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('TITLE WINGS WIDHT', 'ideo-themo'),
            'param_name' => 'el_title_side_wings_width',
            'value' => '',
            'description' => __('By default title wings gets 100% of column width. You can set custom width using pixels or percentages, so you should enter unit (px or %) next to the number.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('TITLE ALIGN', 'ideo-themo'),
            'param_name' => 'el_title_align',
            'value' => array(__('Inherit', 'ideo-themo') =>'none',  __('Left', 'ideo-themo') => 'left', __('Center', 'ideo-themo') => 'center', __('Right', 'ideo-themo') => 'right'),
            'std' => 'center',
            'description' => __('Using this option you can align the title to the Left, Center or Right side.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('TITLE ALIGN ON MOBILE', 'ideo-themo'),
            'param_name' => 'el_title_mobile_align',
            'value' => array(__('Inherit', 'ideo-themo') =>'none', __('Left', 'ideo-themo') => 'left', __('Center', 'ideo-themo') => 'center', __('Right', 'ideo-themo') => 'right'),
            'std' => 'center',
            'description' => __('Using this option you can align the title to the Left, Center or Right side on mobile.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_google_fonts',
            'heading' => __('FONT FAMILY', 'ideo-themo'),
            'param_name' => 'el_font_family',
            'value' => '',
            'description' => __('Choose font family or leave empty to use default font family which is set on upper management level.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('FONT SIZE', 'ideo-themo'),
            'param_name' => 'el_font_size',
            'value' => '',
        ),
        array(
            'type' => 'textfield',
            'heading' => __('LINE HEIGHT', 'ideo-themo'),
            'param_name' => 'el_line_height',
            'value' => '',
        ),
        array(
            'type' => 'textfield',
            'heading' => __('LETTER SPACING', 'ideo-themo'),
            'param_name' => 'el_letter_spacing',
            'value' => '',
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
            'std' => ideothemo_get_shortcodes_default_style('ideo_wow_title'),
            'admin_label' => true,
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
                    'background_color' => __('BACKGROUND COLOR', 'ideo-themo'),
                    'title_color' => __('TITLE COLOR', 'ideo-themo'),
                    'border_color' => __('BORDER COLOR', 'ideo-themo'),
                    'icon_color' => __('ICON COLOR', 'ideo-themo'),
                    'icon_background_color' => __('ICON BACKGROUND COLOR', 'ideo-themo'),
                    'underline_color' => __('UNDERLINE COLOR', 'ideo-themo'),
                    'underline_accent_color' => __('UNDERLINE ACCENT COLOR', 'ideo-themo'),
                    'title_wings_color' => __('TITLE WINGS COLOR', 'ideo-themo'),
                ),
                'transparent' => array(
                    'title_color' => __('TITLE COLOR', 'ideo-themo'),
                    'border_color' => __('BORDER COLOR', 'ideo-themo'),
                    'icon_color' => __('ICON COLOR', 'ideo-themo'),
                    'icon_background_color' => __('ICON BACKGROUND COLOR', 'ideo-themo'),
                    'underline_color' => __('UNDERLINE COLOR', 'ideo-themo'),
                    'underline_accent_color' => __('UNDERLINE ACCENT COLOR', 'ideo-themo'),
                    'title_wings_color' => __('TITLE WINGS COLOR', 'ideo-themo'),
                )
            ),

            'el_colors_dependencies' => array(
                'el_style' => array(
                    'text' => array(
                        'colored' => array(
                            'title_color' => __('TITLE COLOR', 'ideo-themo'),
                        ),
                        'transparent' => array(
                            'title_color' => __('TITLE COLOR', 'ideo-themo'),
                        )
                    ),
                    'simple' => array(
                        'colored' => array(
                            'background_color' => __('BACKGROUND COLOR', 'ideo-themo'),
                            'title_color' => __('TITLE COLOR', 'ideo-themo'),
                            'border_color' => __('BORDER COLOR', 'ideo-themo'),
                            'title_wings_color' => __('TITLE WINGS COLOR', 'ideo-themo'),
                        ),
                        'transparent' => array(
                            'title_color' => __('TITLE COLOR', 'ideo-themo'),
                            'border_color' => __('BORDER COLOR', 'ideo-themo'),
                            'title_wings_color' => __('TITLE WINGS COLOR', 'ideo-themo'),
                        )
                    ),
                    'icon' => array(
                        'colored' => array(
                            'background_color' => __('BACKGROUND COLOR', 'ideo-themo'),
                            'title_color' => __('TITLE COLOR', 'ideo-themo'),
                            'icon_background_color' => __('ICON BACKGROUND COLOR', 'ideo-themo'),
                            'icon_color' => __('ICON COLOR', 'ideo-themo'),
                            'title_wings_color' => __('TITLE WINGS COLOR', 'ideo-themo'),
                        ),
                        'transparent' => array(
                            'title_color' => __('TITLE COLOR', 'ideo-themo'),
                            'icon_background_color' => __('ICON BACKGROUND COLOR', 'ideo-themo'),
                            'icon_color' => __('ICON COLOR', 'ideo-themo'),
                            'title_wings_color' => __('TITLE WINGS COLOR', 'ideo-themo'),
                        )
                    ),
                    'underlined' => array(
                        'colored' => array(
                            'background_color' => __('BACKGROUND COLOR', 'ideo-themo'),
                            'title_color' => __('TITLE COLOR', 'ideo-themo'),
                            'underline_color' => __('UNDERLINE COLOR', 'ideo-themo'),
                            'underline_accent_color' => __('UNDERLINE ACCENT COLOR', 'ideo-themo'),
                            'title_wings_color' => __('TITLE WINGS COLOR', 'ideo-themo'),
                        ),
                        'transparent' => array(
                            'title_color' => __('TITLE COLOR', 'ideo-themo'),
                            'underline_color' => __('UNDERLINE COLOR', 'ideo-themo'),
                            'underline_accent_color' => __('UNDERLINE ACCENT COLOR', 'ideo-themo'),
                            'title_wings_color' => __('TITLE WINGS COLOR', 'ideo-themo'),
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
    'js_view' => 'VcWowTitleView'
));

$el_tag = $el_style = $el_border_enable = $el_border_thickness = $el_border_distance = $el_border_radius = $el_icon_background_shape = $el_icon = $el_icon_size = $el_title_side_wings = $el_title_align = $el_title_mobile_align = $el_font_family = $el_font_size = $el_font_weight = $el_font_style = $el_letter_spacing = $el_line_height = $el_margin_top = $el_title_side_wings_distance = $el_title_side_wings_width = $el_margin_bottom = $el_extra_class = $el_custom_css = $el_elemnt_style = $el_elemnt_style_overwrite = $el_elemnt_style_colors = $el_animation = $el_animation_type = $el_animation_delay = $el_animation_duration = $el_animation_offset = $el_uid = '';

function ideothemo_wow_title_func($atts, $content = "")
{
    
    extract(shortcode_atts(array(
        'el_tag' => 'h2',
        'el_style' => 'text',
        'el_border_enable' => 'true',
        'el_border_thickness' => '1',
        'el_border_distance' => '4',
        'el_border_radius' => '150',
        'el_icon_background_shape' => 'icon-bg-1.svg',
        'el_icon' => 'fa fa-star',
        'el_icon_size' => 'medium',
        'el_title_side_wings' => '',
        'el_title_side_wings_distance' => '10',
        'el_title_side_wings_width' => '',
        'el_title_align' => 'center',
        'el_title_mobile_align' => 'center',
        'el_font_family' => '',
        'el_font_size' => '',
        'el_font_weight' => '',
        'el_font_style' => '',
        'el_line_height' => '',
        'el_letter_spacing' => '',
        'el_margin_top' => '20',
        'el_margin_bottom' => '20',
        'el_extra_class' => '',
        'el_custom_css' => '',
        'el_elemnt_style' => ideothemo_get_shortcodes_default_style('ideo_wow_title'),
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
    $classes = array();

    if ($el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-type="' . esc_attr($el_animation_type) . '"';
    if ($el_animation_delay && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-delay="' . esc_attr($el_animation_delay) . '"';
    if ($el_animation_duration && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-duration="' . esc_attr($el_animation_duration) . '"';
    if ($el_animation_offset && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-offset="' . esc_attr($el_animation_offset) . '"';

    $data .= ideothemo_is_customize_preview() ? '' : '';

    $less = '#wow_title_' . $el_uid . '{';

    if ($el_margin_top != '') {
        $less .= 'margin-top:' . (int)$el_margin_top . 'px;';
    }
    if ($el_margin_bottom != '') {
        $less .= 'margin-bottom:' . (int)$el_margin_bottom . 'px;';
    }

    if ($el_font_family) {
        if (defined('DOING_AJAX') && DOING_AJAX){
            $data .= ' data-font="'.$el_font_family.'"';            
        }
        $google_fonts_data = explode('|', $el_font_family);
        if (is_array($google_fonts_data) && count($google_fonts_data) == 3) {
            $handle = sanitize_title('ideothemo_google_fonts_' . $google_fonts_data[0] . ':' . $google_fonts_data[1]. ($google_fonts_data[2] != 'null' ? $google_fonts_data[2] : ''));
            wp_enqueue_style($handle, '//fonts.googleapis.com/css?family=' . $google_fonts_data[0] . ':' . $google_fonts_data[1] . '&subset=' . ($google_fonts_data[2] != 'null' ? $google_fonts_data[2] : ''));
            $less .= '.title{';
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
            $less .= '}';
        }
    }

    if ($el_font_size) {
        $less .= '.title{font-size:' . ideothemo_get_size($el_font_size) . ';}';
    }
    if ($el_line_height) {
        $less .= '.title{line-height:' . $el_line_height . ';}';
    }
    if ($el_letter_spacing) {
        $less .= '.title{letter-spacing:' . ideothemo_get_size($el_letter_spacing) . ';}';
        $less .= '.title-bg{padding: 0.2em 0  0.2em ' . ideothemo_get_size($el_letter_spacing) . ';}';
    }


    if ($el_style == 'simple') {
        if ($el_border_enable == 'true') {
            $less .= '.title{border-width:' . (int)$el_border_thickness . 'px; border-radius:' . (int)$el_border_radius . 'px;}';
            $less .= '.title-bg{margin:' . (int)$el_border_distance . 'px; border-radius:' . ((int)$el_border_radius - (int)$el_border_distance) . 'px;}';
            $classes[] = 'with-border';
        } else {
            $less .= '.title{border-width:0px; border-radius:0px;}';
            $less .= '.title-bg{margin:0px; border-radius:0px;}';
        }
    }

    $colors_array = array();
    if ($el_elemnt_style_colors) {
        $colors_array = (array)json_decode(str_replace("'", '"', $el_elemnt_style_colors));
    }
    $colors_array = array_replace_recursive(ideothemo_get_colors_by_style($el_elemnt_style), array_filter($colors_array));

    if ($el_style == 'icon') {
        $classes []= 'size-icon-' . $el_icon_size;

        if (isset($colors_array['icon_background_color']))
            $el_color = $colors_array['icon_background_color'];
        else {
            $el_color = $colors_array['accent_color'];
            $data .= ' data-icon-svg-type="' . $el_icon_background_shape . '" ';
        }

        $svg_icon = ideothemo_get_assets_svg_data('svg/' . $el_icon_background_shape, $el_color);
        $less .= '.title-icon{background-image: url(' . $svg_icon . '); }';
    }
    $colors = ideothemo_get_colors_by_style($el_elemnt_style);

    if ($el_style != 'text' && $el_title_side_wings != '') {
        if (isset($colors_array['title_wings_color'])) {
            $el_color = $colors_array['title_wings_color'];
        } else {
            $data .= ' data-wings-svg-type="' . $el_title_side_wings . '" ';
            if ($el_elemnt_style == 'colored-dark' || $el_elemnt_style == 'colored-light') {
                $el_color = $colors['background_color'];
            } else {
                $el_color = $colors['title_color'];
            }
        }

        $svg_wings = ideothemo_get_assets_svg_data('svg/' . $el_title_side_wings, $el_color);
        $less .= '.title-bg{&:before{background-image: url(' . $svg_wings . ');} &:after{background-image: url(' . $svg_wings . ');} }';

        if ($el_title_side_wings_width != '') {
            $less .= '.title-bg{&:before,&:after{width:' . $el_title_side_wings_width . '} }';
        }

        $wings_distance = ideothemo_is_number($el_title_side_wings_distance, 0);

        if ($el_style == 'simple' && $el_border_enable == 'true') {
            $wings_distance += intval($el_border_thickness) + intval($el_border_distance);
        }

        $less .= '.title-bg{&:before{margin-right:' . ideothemo_get_size($wings_distance) . ';}&:after{margin-left:' . ideothemo_get_size($wings_distance) . ';} }';
    }


    $less .= '}';

    /* ===   custom style   ==== */

    $default_vars = array(
        'text' => array(
            'colored' => array(
                'title_color' => 'undefined',
                'background_color' => 'undefined',
                'border_color' => 'undefined',
                'title_wings_color' => 'undefined',
                'icon_color' => 'undefined',
                'border_color' => 'undefined',
                'underline_color' => 'undefined',
                'underline_accent_color' => 'undefined',
            ),
            'transparent' => array(
                'title_color' => 'undefined',
                'border_color' => 'undefined',
                'title_wings_color' => 'undefined',
                'icon_color' => 'undefined',
                'border_color' => 'undefined',
                'underline_color' => 'undefined',
                'underline_accent_color' => 'undefined',
            )
        ),
        'simple' => array(
            'colored' => array(
                'title_color' => 'undefined',
                'background_color' => 'undefined',
                'border_color' => 'undefined',
                'title_wings_color' => 'undefined',
                'icon_color' => 'undefined',
                'border_color' => 'undefined',
                'underline_color' => 'undefined',
                'underline_accent_color' => 'undefined',
            ),
            'transparent' => array(
                'title_color' => 'undefined',
                'border_color' => 'undefined',
                'title_wings_color' => 'undefined',
                'icon_color' => 'undefined',
                'border_color' => 'undefined',
                'underline_color' => 'undefined',
                'underline_accent_color' => 'undefined',
            )
        ),
        'icon' => array(
            'colored' => array(
                'title_color' => 'undefined',
                'background_color' => 'undefined',
                'icon_color' => 'undefined',
                'icon_background_color' => 'undefined',
                'title_wings_color' => 'undefined',
                'border_color' => 'undefined',
                'underline_color' => 'undefined',
                'underline_accent_color' => 'undefined',
            ),
            'transparent' => array(
                'title_color' => 'undefined',
                'icon_color' => 'undefined',
                'icon_background_color' => 'undefined',
                'title_wings_color' => 'undefined',
                'border_color' => 'undefined',
                'underline_color' => 'undefined',
                'underline_accent_color' => 'undefined',
            )
        ),
        'underlined' => array(
            'colored' => array(
                'title_color' => 'undefined',
                'background_color' => 'undefined',
                'underline_color' => 'undefined',
                'underline_accent_color' => 'undefined',
                'title_wings_color' => 'undefined',
                'border_color' => 'undefined',
                'icon_color' => 'undefined',
            ),
            'transparent' => array(
                'title_color' => 'undefined',
                'underline_color' => 'undefined',
                'underline_accent_color' => 'undefined',
                'title_wings_color' => 'undefined',
                'border_color' => 'undefined',
                'icon_color' => 'undefined',
            )
        )
    );

    $html .= ideothemo_custom_style('wow_title', $el_uid, $default_vars[$el_style], $el_elemnt_style, $el_elemnt_style_colors, $less);
    /* ===   end custom style   ==== */

    $html .= '<div class="ideo-wow-title  style-' . esc_attr($el_style) . ' align-' . esc_attr($el_title_align) . ' mobile-align-' . esc_attr($el_title_mobile_align) . ' ' . esc_attr($el_elemnt_style) . ' ' . esc_attr($el_extra_class) . ' ' . esc_attr(join(' ', $classes)) . ' vc-layer" id="wow_title_' . esc_attr($el_uid) . '" data-id="wow_title_' . esc_attr($el_uid) . '" ' . $data . '>';

    $html .= '<' . $el_tag . ' class="title' . ($el_title_side_wings != '' ? ' wings' : '') . '">';
    if ($el_style == 'icon') {
        $html .= '<span class="title-icon"><i class="icon ' . esc_attr($el_icon) . '"></i></span>';
    }
    $html .= '<span class="title-bg">' . wpb_js_remove_wpautop($content) . '</span>';
    $html .= '</' . $el_tag . '>';
    $html .= '</div>';

    

    return $html;
}

add_shortcode('ideo_wow_title', 'ideothemo_wow_title_func');

