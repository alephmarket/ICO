<?php

vc_map(array(
    'name' => __('Progress bar', 'ideo-themo'),
    'base' => 'ideo_progress_bar',
    'icon' => 'icon-progress-bar',
    'category' => __('Content', 'ideo-themo'),
    'description' => __('Animated progress bar for skills & data', 'ideo-themo'),
    'weight' => 75,
    'params' => array(
        
        array(
            'type' => 'ideo_slider',
            'heading' => __('FILLED AREA PERCENTAGE', 'ideo-themo'),
            'param_name' => 'el_cover',
            'min' => '0',
            'max' => '100',
            'value' => '75',
            'description' => __('Define what percentage of the the inactive bar will be covered by the active bar.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('BAR TITLE', 'ideo-themo'),
            'admin_label' => true,
            'param_name' => 'el_title',
            'value' => __('Progress bar title.', 'ideo-themo'),
            'description' => __('Enter progress bar title', 'ideo-themo'),
        ),
        array(
            'type' => 'textfield',
            'heading' => __('BAR NUMBER', 'ideo-themo'),
            'admin_label' => true,
            'param_name' => 'el_number',
            'value' => '199',
        ),
        array(
            'type' => 'textfield',
            'heading' => __('BAR UNIT', 'ideo-themo'),
            'param_name' => 'el_unit',
            'value' => '$',
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('BAR HEIGHT (px)', 'ideo-themo'),
            'param_name' => 'el_height',
            'min' => '0',
            'max' => '50',
            'value' => '20',
            'description' => __('Define progress bar height in pixels.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('FONT SIZE', 'ideo-themo'),
            'param_name' => 'el_font_size',
            'value' => '',
            'description' => __('Define font size for title, number and unit.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('BAR CORNERS TYPE', 'ideo-themo'),
            'param_name' => 'el_covers',
            'value' => array('Simple' => 'simple', 'Rounded' => 'rounded'),
            'std' => 'rounded',
            'description' => __('Choose Simple or Rounded style for progress bar corners.', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_slider',
            'heading' => __('MARGIN TOP (px)', 'ideo-themo'),
            'param_name' => 'el_margin_top',
            'min' => '0',
            'max' => '200',
            'value' => '40',
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
            'std' => ideothemo_get_shortcodes_default_style('ideo_progress_bar'),
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
                    'background_color' => __('BAR BACKGROUND COLOR', 'ideo-themo'),
                    'bar_color' => __('FILLED AREA COLOR', 'ideo-themo'),
                    'titles_color' => __('TITLE COLOR', 'ideo-themo'),
                    'tooltip_color' => __('NUMBER & UNIT BACKGROUND COLOR', 'ideo-themo'),
                    'percent_color' => __('NUMBER & UNIT COLOR', 'ideo-themo'),

                ),
                'transparent' => array(
                    'background_color' => __('BAR BACKGROUND COLOR', 'ideo-themo'),
                    'bar_color' => __('FILLED AREA COLOR', 'ideo-themo'),
                    'titles_color' => __('TITLE, NUMBER & UNIT COLOR', 'ideo-themo'),
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
    'js_view' => 'VcProgressBarView'
));

$el_cover = $el_unit = $el_number = $el_title = $el_font_size = $el_height = $el_covers = $el_margin_top = $el_margin_bottom = $el_extra_class = $el_custom_css = $el_elemnt_style = $el_elemnt_style_overwrite = $el_elemnt_style_colors = $el_animation = $el_animation_type = $el_animation_delay = $el_animation_duration = $el_animation_offset = $el_uid = '';


function ideothemo_progress_bar_func($atts, $content = '')
{
    
    extract(shortcode_atts(array(
        'el_cover' => '75',
        'el_unit' => '$',
        'el_number' => '199',
        'el_title' => __('Progress bar title', 'ideo-themo'),
        'el_font_size' => '',
        'el_height' => '20',
        'el_covers' => 'rounded',
        'el_margin_top' => '40',
        'el_margin_bottom' => '20',
        'el_extra_class' => '',
        'el_custom_css' => '',
        'el_elemnt_style' => ideothemo_get_shortcodes_default_style('ideo_progress_bar'),
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

    $data .= ' data-cover="' . $el_cover . '"';
    $data .= ' data-number="' . $el_number . '"';

    $less = '#progress_bar_' . $el_uid . '{';

    if ($el_margin_top != '') {
        $less .= 'margin-top:' . (int)$el_margin_top . 'px;';
    }
    if ($el_margin_bottom != '') {
        $less .= 'margin-bottom:' . (int)$el_margin_bottom . 'px;';
    }
    if ($el_font_size) {
        $less .= 'font-size:' . ideothemo_get_size($el_font_size) . ';';
    }

    $less .= '.cover{';
    $less .= 'height:' . (int)$el_height . 'px;';
    $less .= '}';

    $less .= '}';

    /* ===   custom style   ==== */
    $colors = ideothemo_get_colors_by_style($el_elemnt_style);
    $default_vars = array(
        'colored' => array(
            'titles_color' => 'undefined',
            'percent_color' => 'undefined',
            'background_color' => 'undefined',
            'bar_color' => 'undefined',
            'tooltip_color' => 'undefined',
        ),
        'transparent' => array(
            'titles_color' => 'undefined',
            'background_color' => 'undefined',
            'bar_color' => 'undefined',
        )
    );

    $html .= ideothemo_custom_style('progress_bar', $el_uid, $default_vars, $el_elemnt_style, $el_elemnt_style_colors, $less);
    /* ===   end custom style   ==== */


    $html .= '<div class="ideo-progress-bar ' . esc_attr($el_covers) . ' ' . esc_attr($el_elemnt_style) . ' ' . esc_attr($el_extra_class) . ' vc-layer" id="progress_bar_' . esc_attr($el_uid) . '" data-id="progress_bar_' . esc_attr($el_uid) . '" ' . $data . '>';
    $html .= '';
    $html .= '<div class="bar"><div class="cover"><span class="title">' . ideo_esc($el_title) . '</span>';
    if ($el_number) {
        $html .= '<span class="number"><span class="text">' . ideo_esc($el_number) . '</span> <span class="unit">' . ideo_esc($el_unit) . '</span></span>';
    }
    $html .= '</div></div>';
    $html .= '</div>';

    

    return $html;
}

add_shortcode('ideo_progress_bar', 'ideothemo_progress_bar_func');








