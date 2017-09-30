<?php

vc_map(array(
    'name' => __('Button', 'ideo-themo'),
    'base' => 'vc_button',
    'icon' => 'icon-button',
    'show_settings_on_create' => true,    
    'category' => __('Content', 'ideo-themo'),
    'description' => __('Advanced button with Flat & 3D styles.', 'ideo-themo'),
    'weight' => 91,
    'params' => array(
        array(
            'type' => 'textfield',
            'holder' => 'div',
            'class' => '',
            'heading' => __('BUTTON LABEL', 'ideo-themo'),
            'param_name' => 'el_label',
            'admin_label' => true,
            'value' => __('Label', 'ideo-themo'),
            'description' => __('Enter text which will be displayed on the button.', 'ideo-themo'),
        ),
        array(
            'type' => 'vc_link',
            'heading' => __('BUTTON URL (LINK)', 'ideo-themo'),
            'param_name' => 'el_link',
            'value' => '',
            'description' => __('Enter button URL.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('BUTTON TYPE', 'ideo-themo'),
            'param_name' => 'el_type',
            'admin_label' => true,
            'value' => array('Flat' => 'flat', '3D' => 'button3d'),
            'std' => 'flat',
            'description' => __('Choose Flat or 3D button type.', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_buttons',
            'heading' => __('BUTTON RADIUS', 'ideo-themo'),
            'param_name' => 'el_radius',
            'value' => array(
                __('Default', 'ideo-themo') => '',
                __('None', 'ideo-themo') => 'none',
                __('Small', 'ideo-themo') => 'small',
                __('Big', 'ideo-themo') => 'big'
            ),
            'std' => '',
            'description' => __('Choose None, Small or Big radius type or choose Default to use default setting from Customizer. Notice that in Customizer you can define precise value for Small and Big types.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('BORDER THICKNESS', 'ideo-themo'),
            'param_name' => 'el_border_thickness',
            'min' => '0',
            'max' => '10',
            'value' => '1',
            'description' => __('Define border thickness.', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_buttons',
            'heading' => __('BUTTON SIZE', 'ideo-themo'),
            'param_name' => 'el_size',
            'value' => array(
                __('X-Small', 'ideo-themo') => 'xsmall', 
                __('Small', 'ideo-themo') => 'small', 
                __('Medium', 'ideo-themo') => 'medium', 
                __('Large', 'ideo-themo') => 'large',
                __('X-Large', 'ideo-themo') => 'xlarge'
            ),
            'std' => 'medium',
            'description' => __('Choose Small, Medium or Large button size. Button size option refers to button height and button label font size.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('DISPLAY TYPE', 'ideo-themo'),
            'param_name' => 'el_display',
            'value' => array(__('Inline Block', 'ideo-themo') => 'inline-block', __('Block', 'ideo-themo') => 'block', __('Fit Container', 'ideo-themo') => 'fit'),
            'dependencies' => array(
                'inline-block' => array('el_float'),
                'block' => array('el_align', 'el_mobile_align'),
            ),
            'std' => 'block',
            'description' => __('Choose Inline block, Block or Fit container to set display property which specifies the type of the container used for an element. Inline block allows you to display several buttons in one line while the Block containers are displayed one under another. Fit container makes full width element.', 'ideo-themo')
        ),

       array(
            'type' => 'ideo_buttons',
            'heading' => __('BUTTON ALIGN', 'ideo-themo'),
            'param_name' => 'el_align',
            'value' => array(__('Inherit', 'ideo-themo') =>'none', __('Left', 'ideo-themo') => 'left', __('Center', 'ideo-themo') => 'center', __('Right', 'ideo-themo') => 'right'),
            'std' => 'center',
            'description' => __('Using this option you can align the icon to the Left, Center or Right side of the container.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('BUTTON ALIGN ON MOBILE', 'ideo-themo'),
            'param_name' => 'el_mobile_align',
            'value' => array(__('Inherit', 'ideo-themo') =>'none', __('Left', 'ideo-themo') => 'left', __('Center', 'ideo-themo') => 'center', __('Right', 'ideo-themo') => 'right'),
            'std' => 'center',
            'description' => __('Using this option you can align the icon to the Left, Center or Right side of the container.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('BUTTON FLOAT', 'ideo-themo'),
            'param_name' => 'el_float',
            'value' => array(__('None', 'ideo-themo') => '', __('Left', 'ideo-themo') => 'left', __('Right', 'ideo-themo') => 'right'),
            'std' => '',
            'description' => __('The float property specifies if/how the icon should float between neighbouring inline elements. You can choose Left or Right float or choose None to display the icon just where it occurs in grid.', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_buttons',
            'heading' => __('BUTTON ICON', 'ideo-themo'),
            'param_name' => 'el_icon_type',
            'value' => array('No icon' => '', 'Reveal icon' => 'reveal', 'Standard icon' => 'standard'),
            'dependencies' => array(
                'reveal' => array('el_icon', 'el_icon_position'),
                'standard' => array('el_icon', 'el_icon_position'),
            ),
            'std' => 'reveal',
            'description' => __('Decide if/how the icon will be displayed on the button.</br><b>Standard</b> - the icon is displayed on the button continuously.</br><b>Reveal</b> - the icon slides in on hover.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_choose_icon',
            'class' => '',
            'heading' => __('CHOOSE BUTTON ICON', 'ideo-themo'),
            'param_name' => 'el_icon',
            'value' => 'fa fa-angle-right',
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('ICON POSITION', 'ideo-themo'),
            'param_name' => 'el_icon_position',
            'value' => array('Left' => 'left-icon', 'Right' => 'right-icon'),
            'std' => 'right-icon',
            'description' => __('Decide on which side of the button the icon will be displayed.', 'ideo-themo')
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
            'admin_label' => true,
            'param_name' => 'el_element_style',
            'value' => array(
                'colored light' => 'colored-light',
                'colored dark' => 'colored-dark',
                'colored light to transparent' => 'colored-light-to-transparent',
                'colored dark to transparent' => 'colored-dark-to-transparent',
                'transparent to colored light' => 'colored-light-to-transparent-invert',
                'transparent to colored dark' => 'colored-dark-to-transparent-invert',
                'transparent light' => 'transparent-light',
                'transparent dark' => 'transparent-dark',
            ),
            'std' => ideothemo_get_shortcodes_default_style('ideo_button'),
            'colors' => ideothemo_get_colors(),
            'description' => __('Choose button style. Depending on which option you choose appropriate colorpickers will be available below. You can freely customize colors for chosen style but you can also leave empty colorpickers to use colors which are set for that style in Customizer.</br>Notice that Transparent to colored and Colored to transparent styles take colors from Colored palettes from Customizer.', 'ideo-themo'),
            'group' => __('STYLING', 'ideo-themo'),
        ),

        array(
            'type' => 'ideo_custom_colors',
            'heading' => __('COLORS', 'ideo-themo'),
            'param_name' => 'el_element_style_colors',
            'colors' => ideothemo_get_colors(),
            'el_colors' => array(
                'colored' => array(
                    'background_color' => __('BACKGROUND COLOR', 'ideo-themo'),
                    'font_color' => __('LABEL COLOR', 'ideo-themo'),
                    'icon_color' => __('ICON COLOR', 'ideo-themo'),
                    'borders_color' => __('BORDERS COLOR', 'ideo-themo'),
                    'background_hover_color' => __('BACKGROUND HOVER COLOR', 'ideo-themo'),
                    'font_hover_color' => __('LABEL HOVER COLOR', 'ideo-themo'),
                    'icon_hover_color' => __('ICON HOVER COLOR', 'ideo-themo'),
                    'borders_hover_color' => __('BORDERS HOVER COLOR', 'ideo-themo'),
                ),
                'transparent' => array(
                    'font_color' => __('LABEL COLOR', 'ideo-themo'),
                    'icon_color' => __('ICON COLOR', 'ideo-themo'),
                    'borders_color' => __('BORDERS COLOR', 'ideo-themo'),
                    'font_hover_color' => __('LABEL HOVER COLOR', 'ideo-themo'),
                    'icon_hover_color' => __('ICON HOVER COLOR', 'ideo-themo'),
                    'borders_hover_color' => __('BORDERS HOVER COLOR', 'ideo-themo'),
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
    'js_view' => 'VcButtonView'

));

$el_tag = $el_value = $el_float = $el_input_type = $el_label = $el_link = $el_type = $el_radius = $el_border_thickness = $el_size = $el_align = $el_mobile_align = $el_icon_type = $el_icon = $el_icon_position = $el_display = $el_margin_top = $el_margin_bottom = $el_margin_left = $el_margin_right = $el_extra_class = $el_custom_css = $el_element_style = $el_blur = $el_element_style_colors = $el_animation = $el_animation_type = $el_animation_delay = $el_animation_duration = $el_animation_offset = $el_uid = '';

function ideothemo_button_func($atts, $content = "")
{
    
    extract(shortcode_atts(array(
        'el_tag' => 'a',
        'el_value' => '',
        'el_input_type' => '',
        'el_label' => __('Label', 'ideo-themo'),
        'el_link' => '',
        'el_type' => 'flat',
        'el_radius' => '',
        'el_border_thickness' => '1',
        'el_size' => 'medium',
        'el_align' => 'center',
        'el_mobile_align' => 'center',
        'el_icon_type' => 'reveal',
        'el_icon' => 'fa fa-angle-right',
        'el_icon_position' => 'right-icon',
        'el_display' => 'block',
        'el_float' => '',
        'el_margin_top' => '20',
        'el_margin_right' => '20',
        'el_margin_bottom' => '20',
        'el_margin_left' => '20',
        'el_extra_class' => '',
        'el_custom_css' => '',
        'el_element_style' => ideothemo_get_shortcodes_default_style('ideo_button'),
        'el_element_style_colors' => '',
        'el_animation' => '',
        'el_animation_type' => 'fadeIn',
        'el_animation_delay' => '500',
        'el_animation_duration' => '1000',
        'el_animation_offset' => '95',
        'el_uid' => ideothemo_shortcode_uid()
    ), $atts));
    
    if($el_uid == '') $el_uid = ideothemo_shortcode_uid();

    $link = vc_build_link($el_link);
    $a_href = $link['url'];
    $a_title = $link['title'];
    $a_target = trim($link['target']);


    $html = '';

    $less = '#button_' . $el_uid . '{';

    if ($el_display == 'inline-block' && $el_float != '') {
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
    $less .= 'border-width:' . (int)$el_border_thickness . 'px;';
    $less .= '}';


    /* ===   custom style   ==== */
    $colors = ideothemo_get_colors_by_style($el_element_style);

    $custom_color = (array)json_decode(str_replace("'", '"', $el_element_style_colors));

    $background_color = $colors['accent_color'];
    $background_hover_color = ideothemo_get_color_darken($colors['accent_color'], 10);

    $font_color = $colors['alternative_title_color'];
    $font_hover_color = $colors['alternative_title_color'];

    $icon_color = $colors['alternative_title_color'];
    $icon_hover_color = $colors['alternative_title_color'];

    if (($el_element_style == 'colored-light-to-transparent' || $el_element_style == 'colored-dark-to-transparent')  && isset($custom_color['background_hover_color']) && $custom_color['background_hover_color'] == '') {
        $background_hover_color = 'transparent';
        $font_hover_color = $colors['accent_color'];
        $icon_hover_color = $colors['accent_color'];
    }
    if (($el_element_style == 'colored-light-to-transparent-invert' || $el_element_style == 'colored-dark-to-transparent-invert') && isset($custom_color['background_color']) && $custom_color['background_color'] == '') {
        $background_color = 'transparent';
        $font_color = $colors['accent_color'];
        $icon_color = $colors['accent_color'];
    }


    $default_vars = array(
        'colored' => array(
            'font_color' => 'undefined',
            'font_hover_color' => 'undefined',
            'background_color' => 'undefined',
            'background_hover_color' => 'undefined',
            'borders_color' => 'undefined',
            'borders_hover_color' => 'undefined',
            'icon_color' => 'undefined',
            'icon_hover_color' => 'undefined'

        ),
        'transparent' => array(
            'font_color' => 'undefined',
            'font_hover_color' => 'undefined',
            'borders_color' => 'undefined',
            'borders_hover_color' => 'undefined',
            'icon_color' => 'undefined',
            'icon_hover_color' => 'undefined',
        )
    );


    $html .= ideothemo_custom_style('button', $el_uid, $default_vars, $el_element_style, $el_element_style_colors, $less);
    /* ===   end custom style   ==== */

    $data = '';

    if ($el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-type="' . esc_attr($el_animation_type) . '"';
    if ($el_animation_delay && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-delay="' . esc_attr($el_animation_delay) . '"';
    if ($el_animation_duration && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-duration="' . esc_attr($el_animation_duration) . '"';
    if ($el_animation_offset && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-offset="' . esc_attr($el_animation_offset) . '"';


    if ($el_radius == '') {
        $el_radius = ideothemo_get_theme_mod_parse('shortcodes.button_radius.button_default_radius');
    }

    if ($el_value) $data .= ' value="' . esc_attr($el_value) . '"';
    if ($el_input_type) $data .= ' type="' . esc_attr($el_input_type) . '"';

    $html_button = '';

    $html_button .= '<' . $el_tag . ' id="button_' . esc_attr($el_uid) . '"';
    if($el_tag == 'a'){
        $html_button .= ' href="' . esc_url($a_href) . '"';        
    }
    if ($a_target) {
        $html_button .= ' target="' . esc_attr($a_target) . '"';
    }
    if ($a_title) {
        $html_button .= ' title="' . esc_attr($a_title) . '"';
    }
    $html_button .= ' class="button ' . 
        esc_attr($el_type) . ' ' . 
        esc_attr($el_radius ? 'radius-' . $el_radius : '') . 
        esc_attr($el_size ? ' size-' . $el_size : '') . 
        esc_attr($el_align ? ' align-' . $el_align : '') . ' ' .
        esc_attr(($el_icon_type && $el_icon && $el_icon_position ? $el_icon_type . ' ' . $el_icon_position : '')) . ' ' . 
        esc_attr($el_display) . ' ' . 
        esc_attr($el_element_style) . ' ' .
        esc_attr($el_extra_class) . ' " data-id="button-' . esc_attr($el_uid) . '" ' . $data . '>';

    if ($el_icon_type && $el_icon && $el_icon_position == 'left-icon') {
        $html_button .= '<i class="' . esc_attr($el_icon) . '"></i>';
    }

    $html_button .= '<span>' . ideo_esc($el_label) . '</span>';

    if ($el_icon_type && $el_icon && $el_icon_position != 'left-icon') {
        $html_button .= '<i class="' . esc_attr($el_icon) . '"></i>';
    }

    $html_button .= '</' . $el_tag . '>';

    if ($el_display == 'block') {
        $html_button = '<div class="button-wrap ' . esc_attr($el_align ? ' align-' . $el_align : '') . esc_attr($el_mobile_align ? ' mobile-align-' . $el_mobile_align : '') . ' ' . ' ">' . $html_button . '</div>';
    }

    $html .= $html_button;

    

    return $html;
}

add_shortcode('vc_button', 'ideothemo_button_func');


