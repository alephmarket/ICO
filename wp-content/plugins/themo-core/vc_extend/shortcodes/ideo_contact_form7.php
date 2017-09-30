<?php
vc_map(array(
    'name' => __('Contact Form 7', 'ideo-themo'),
    'base' => 'ideo_contact_form7',    
    'icon' => 'icon-contact-form-7',
    'category' => __('Content', 'ideo-themo'),
    'description' => __('Contact Form 7 element.', 'ideo-themo'),
    'weight' => 89,
    'params' => array(

        array(
            'type' => 'dropdown',
            'heading' => __('CONTACT FORM', 'ideo-themo'),
            'param_name' => 'el_form',
            'admin_label' => true,
            'value' => ideothemo_get_contact_form7(),
            'description' => __('Choose from dropdown one of contact forms which you have created. If you have not created any contact form yet, you can do this in Contact tab, in WordPress dashboard.', 'ideo-themo')
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
            'type' => 'textfield',
            'holder' => 'div',
            'class' => '',
            'heading' => __('BUTTON LABEL', 'ideo-themo'),
            'param_name' => 'el_button_label',
            'value' => __('SEND ME', 'ideo-themo'),
            'description' => __('Enter text which will be displayed on button.', 'ideo-themo'),
            'group' => __('BUTTON', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('BUTTON TYPE', 'ideo-themo'),
            'param_name' => 'el_button_type',
            'value' => array('Flat' => 'flat', '3D' => 'button3d'),
            'std' => 'flat',
            'description' => __('Choose Flat or 3D button type.', 'ideo-themo'),
            'group' => __('BUTTON', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_buttons',
            'heading' => __('BUTTON RADIUS', 'ideo-themo'),
            'param_name' => 'el_button_radius',
            'value' => array(
                __('Default', 'ideo-themo') => '',
                __('None', 'ideo-themo') => 'none',
                __('Small', 'ideo-themo') => 'small',
                __('Big', 'ideo-themo') => 'big'
            ),
            'std' => '',
            'description' => __('Choose None, Small or Big radius type or choose Default to use default setting from Customizer. Notice that in Customizer you can define precise value for Small and Big types.', 'ideo-themo'),
            'group' => __('BUTTON', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('BORDER THICKNESS (px)', 'ideo-themo'),
            'param_name' => 'el_button_border_thickness',
            'min' => '0',
            'max' => '10',
            'value' => '1',
            'description' => __('Define border thickness.', 'ideo-themo'),
            'group' => __('BUTTON', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_buttons',
            'heading' => __('BUTTON SIZE', 'ideo-themo'),
            'param_name' => 'el_button_size',
            'value' => array(
                __('X-Small', 'ideo-themo') => 'xsmall', 
                __('Small', 'ideo-themo') => 'small', 
                __('Medium', 'ideo-themo') => 'medium', 
                __('Large', 'ideo-themo') => 'large',
                __('X-Large', 'ideo-themo') => 'xlarge'
            ),
            'std' => 'medium',
            'description' => __('Choose Small, Medium or Large button size. Button size option refers to button height and button label font size.', 'ideo-themo'),
            'group' => __('BUTTON', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('DISPLAY TYPE', 'ideo-themo'),
            'param_name' => 'el_button_display',
            'value' => array(__('Block', 'ideo-themo') => 'block', __('Fit Container', 'ideo-themo') => 'fit'),
            'dependencies' => array(
                'block' => array('el_button_align'),
            ),
            'std' => 'block',
            'description' => __('Choose Block or Fit container to set display property which specifies the type of the container used for an element. In this case Display property refers to button width only. If you choose Block the button width will adapt to the lenght of the label text and you will be able to choose button alignment. If you choose Fit container the button will be displayed as full width element.', 'ideo-themo'),
            'group' => __('BUTTON', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_buttons',
            'heading' => __('BUTTON ALIGNMENT', 'ideo-themo'),
            'param_name' => 'el_button_align',
            'value' => array('Left' => 'left', 'Center' => 'center', 'Right' => 'right'),
            'std' => 'right',
            'description' => __('Using this option you can align button to the Left, Center or Right side.', 'ideo-themo'),
            'group' => __('BUTTON', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('BUTTON ICON', 'ideo-themo'),
            'param_name' => 'el_button_icon_type',
            'value' => array('No icon' => '', 'Reveal icon' => 'reveal', 'Standard icon' => 'standard'),
            'dependencies' => array(
                'reveal' => array('el_button_icon', 'el_button_icon_position'),
                'standard' => array('el_button_icon', 'el_button_icon_position'),
            ),
            'std' => 'reveal',
            'description' => __('Decide if/how the icon will be displayed on the button.</br><b>Standard</b> - the icon is displayed on the button continuously.</br><b>Reveal</b> - the icon slides in on hover.', 'ideo-themo'),
            'group' => __('BUTTON', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_choose_icon',
            'holder' => 'div',
            'class' => '',
            'heading' => __('CHOOSE BUTTON ICON', 'ideo-themo'),
            'param_name' => 'el_button_icon',
            'value' => 'fa fa-angle-right',
            'group' => __('BUTTON', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('ICON POSITION', 'ideo-themo'),
            'param_name' => 'el_button_icon_position',
            'value' => array('Left' => 'left-icon', 'Right' => 'right-icon'),
            'std' => 'right-icon',
            'description' => __('Decide on which side of the button the icon will be displayed.', 'ideo-themo'),
            'group' => __('BUTTON', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_dropdown',
            'heading' => __('ELEMENT STYLE & SKIN', 'ideo-themo'),
            'param_name' => 'el_elemnt_style',
            'admin_label' => true,
            'value' => array(
                'colored dark' => 'colored-dark',
                'colored light' => 'colored-light',
                'transparent dark' => 'transparent-dark',
                'transparent light' => 'transparent-light',

            ),
            'colors' => ideothemo_get_colors(),
            'std' => ideothemo_get_shortcodes_default_style('ideo_contact_form7'),
            'description' => __('Choose style for the element. Depending on which option you choose appropriate colorpickers will be available below. You can freely customize colors for chosen style but you can also leave empty colorpickers to use colors which are set for that style in Customizer.', 'ideo-themo'),
            'group' => __('STYLING', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_custom_colors',
            'heading' => __('SKIN COLORS', 'ideo-themo'),
            'param_name' => 'el_elemnt_style_colors',
            'colors' => ideothemo_get_colors(),
            'el_colors' => array(
                'colored' => array(
                    'background_color' => __('BACKGROUND COLOR', 'ideo-themo'),
                    'active_borders_color' => __('ACTIVE BORDERS', 'ideo-themo'),
                    'text_color' => __('TEXT COLOR', 'ideo-themo'),
                    'placeholder_color' => __('PLACEHOLDER COLOR', 'ideo-themo'),
                    'alert_border_color' => __('ALERT BORDER COLOR', 'ideo-themo'),
                ),
                'transparent' => array(
                    'borders_color' => __('BORDERS COLOR', 'ideo-themo'),
                    'active_borders_color' => __('ACTIVE BORDERS', 'ideo-themo'),
                    'text_color' => __('TEXT COLOR', 'ideo-themo'),
                    'placeholder_color' => __('PLACEHOLDER COLOR', 'ideo-themo'),
                    'alert_border_color' => __('ALERT BORDER COLOR', 'ideo-themo'),
                )
            ),
            'value' => '',
            'group' => __('STYLING', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_dropdown',
            'heading' => __('BUTTON STYLE', 'ideo-themo'),
            'param_name' => 'el_button_elemnt_style',
            'value' => array(
                'default' => 'default',
                'colored light' => 'colored-light',
                'colored dark' => 'colored-dark',
                'colored light to transparent' => 'colored-light-to-transparent',
                'colored dark to transparent' => 'colored-dark-to-transparent',
                'transparent to colored light' => 'colored-light-to-transparent-invert',
                'transparent to colored dark' => 'colored-dark-to-transparent-invert',
                'transparent light' => 'transparent-light',
                'transparent dark' => 'transparent-dark',

            ),
            'colors' => ideothemo_get_colors(),
            'std' => 'default',
            'description' => __('Choose style for an element. Depending on which option you choose appropriate colorpickers will be available below. You can freely customize colors for chosen style but you can also leave empty colorpickers to use colors which are set for that style in Customizer.</br>Notice that Transparent to colored and Colored to transparent styles take colors from Colored palettes from Customizer.', 'ideo-themo'),
            'group' => __('STYLING', 'ideo-themo')
        ),


        array(
            'type' => 'ideo_custom_colors',
            'heading' => __('COLORS', 'ideo-themo'),
            'param_name' => 'el_button_elemnt_style_colors',
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
                    'borders_hover_color' => __('BORDER HOVER COLOR', 'ideo-themo'),
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
    'js_view' => 'VcCF7View'
));

$el_form = $el_button_label = $el_button_align = $el_button_type = $el_button_radius = $el_button_border_thickness = $el_button_size = $el_button_display = $el_button_icon_type = $el_button_icon = $el_button_icon_position = $el_margin_top = $el_margin_bottom = $el_extra_class = $el_custom_css = $el_elemnt_style = $el_elemnt_style_overwrite = $el_elemnt_style_colors = $el_button_elemnt_style = $el_button_elemnt_style_overwrite = $el_button_elemnt_style_colors = $el_animation = $el_animation_type = $el_animation_delay = $el_animation_duration = $el_animation_offset = $el_uid = '';

function ideothemo_contact_form7_func($atts, $content = "")
{
    
    extract(shortcode_atts(array(
        'el_form' => '',
        'el_button_label' => __('SEND ME', 'ideo-themo'),
        'el_button_type' => 'flat',
        'el_button_radius' => '',
        'el_button_border_thickness' => '1',
        'el_button_size' => 'medium',
        'el_button_display' => 'block',
        'el_button_align' => 'right',
        'el_button_icon_type' => 'reveal',
        'el_button_icon' => 'fa fa-angle-right',
        'el_button_icon_position' => 'right-icon',
        'el_margin_top' => '20',
        'el_margin_bottom' => '20',
        'el_extra_class' => '',
        'el_custom_css' => '',
        'el_elemnt_style' => ideothemo_get_shortcodes_default_style('ideo_contact_form7'),
        'el_elemnt_style_overwrite' => '',
        'el_elemnt_style_colors' => '',
        'el_button_elemnt_style' => 'default',
        'el_button_elemnt_style_overwrite' => '',
        'el_button_elemnt_style_colors' => '',
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

    $less = '#contact_form_7_' . $el_uid . '{';

    if ($el_margin_top != '') {
        $less .= 'margin-top:' . (int)$el_margin_top . 'px;';
    }
    if ($el_margin_bottom != '') {
        $less .= 'margin-bottom:' . (int)$el_margin_bottom . 'px;';
    }

    $less .= '}';


    /* ===   custom style   ==== */
    $colors = ideothemo_get_colors_by_style($el_elemnt_style);
    $default_vars = array(
        'colored' => array(
            'background_color' => 'undefined',
            'active_borders_color' => 'undefined',
            'text_color' => 'undefined',
            'placeholder_color' => 'undefined',
            'alert_border_color' => 'undefined',

        ),
        'transparent' => array(
            'borders_color' => 'undefined',
            'active_borders_color' => 'undefined',
            'text_color' => 'undefined',
            'placeholder_color' => 'undefined',
            'alert_border_color' => 'undefined',
        )

    );

    $html .= ideothemo_custom_style('contact_form_7', $el_uid, $default_vars, $el_elemnt_style, $el_elemnt_style_colors, $less);
    /* ===   end custom style   ==== */


    $html .= '<div class="ideo-contact-form7  ' . esc_attr($el_elemnt_style) . ' ' . esc_attr($el_extra_class) . ' vc-layer" id="contact_form_7_' . esc_attr($el_uid) . '" data-id="contact_form_7_' . esc_attr($el_uid) . '" ' . $data . '>';

    if ($cf7 = wpcf7_contact_form((int)$el_form)) {
        $form = $cf7->prop('form');

        $button = do_shortcode('[vc_button 
            el_tag="button" 
            el_input_type="submit"             
            el_label="' . $el_button_label . '" 
            el_type="' . $el_button_type . '"             
            el_radius="' . $el_button_radius . '" 
            el_border_thickness="' . $el_button_border_thickness . '" 
            el_size="' . $el_button_size . '" 
            el_display="' . $el_button_display . '" 
            el_margin_top="9"
            el_margin_right="0"
            el_margin_left="0"
            el_align="' . $el_button_align . '" 
            el_icon_position="' . $el_button_icon_position . '" 
            el_element_style="' . ($el_button_elemnt_style == 'default' ? ideothemo_get_shortcodes_button_default_style($el_elemnt_style, 'ideo_contact_form7') : $el_button_elemnt_style ) . '"
            el_uid="' . $el_uid . '"
            el_icon_type="' . $el_button_icon_type . '" 
            el_icon="' . $el_button_icon . '" 
            el_elemnt_style_overwrite="' . $el_button_elemnt_style_overwrite . '"    
            el_element_style_colors="' . $el_button_elemnt_style_colors . '"            
            el_extra_class="wpcf7-form-control wpcf7-submit"
        ]');


        $form = preg_replace('/\[submit.+\]/', $button, $form);
        $cf7->set_properties(array('form' => $form));
        $html .= $cf7->form_html();


    } else {
        $html .= __('No contact forms found', 'ideo-themo');
    }

    $html .= '</div>';

    

    return $html;
}

add_shortcode('ideo_contact_form7', 'ideothemo_contact_form7_func');