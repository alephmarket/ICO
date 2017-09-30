<?php

class WPBakeryShortCode_Ideo_Pricing_Table extends WPBakeryShortCode
{
}

vc_map(array(
        'name' => __('Pricing table', 'ideo-themo'),
        'base' => 'ideo_pricing_table',
        'icon' => 'icon-pricing-table',
        'category' => __('Content', 'ideo-themo'),
        'description' => __('Pricing & data tables.', 'ideo-themo'),
        'weight' => 76,
        'params' => array(
            array(
                'type' => 'ideo_switcher',
                'heading' => __('HIGHLIGHT TABLE', 'ideo-themo'),
                'param_name' => 'el_highlight_table',
                'on' => 'true',
                'off' => 'false',
                'value' => 'false',
                'description' => __('Enable or disable the highlight of the table.', 'ideo-themo'),
            ),

            array(
                'type' => 'textfield',
                'heading' => __('TITLE', 'ideo-themo'),
                'admin_label' => true,
                'param_name' => 'el_title',
                'value' => __('Place title here', 'ideo-themo'),
            ),

            array(
                'type' => 'textfield',
                'heading' => __('SUBTITLE', 'ideo-themo'),
                'param_name' => 'el_subtitle',
                'value' => __('subtitle', 'ideo-themo'),
            ),

            array(
                'type' => 'ideo_switcher',
                'heading' => __('ICON', 'ideo-themo'),
                'param_name' => 'el_display_icon',
                'on' => 'true',
                'off' => 'false',
                'std' => 'true',
                'value' => array(__('Yes', 'ideo-themo') => 'yes', __('No', 'ideo-themo') => 'no'),
                'dependencies' => array(
                    'true' => array('el_icon_type', 'el_icon_font', 'el_icon_custom', 'el_image_height'),
                ),
                'description' => __('Enable or disable icon displaying. When this option is turned on the additional options are available.', 'ideo-themo')
            ),

            array(
                'type' => 'ideo_buttons',
                'heading' => __('ICON TYPE', 'ideo-themo'),
                'param_name' => 'el_icon_type',
                'value' => array('Font icon' => 'font', 'Custom image' => 'custom'),
                'dependencies' => array(
                    'font' => array('el_icon_font'),
                    'custom' => array('el_icon_custom', 'el_image_height'),
                ),
                'std' => 'font',
                'description' => __('Choose Font icon to display standard icon or choose Custom image to upload your own icon/image. Depending on which option you choose appropriate options will be available below.', 'ideo-themo')
            ),
            array(
                'type' => 'ideo_choose_icon',
                'class' => '',
                'heading' => __('CHOOSE ICON', 'ideo-themo'),
                'param_name' => 'el_icon_font',
                'value' => 'fa fa-desktop',
            ),
            array(
                'type' => 'attach_image',
                'heading' => __('UPLOAD IMAGE', 'ideo-themo'),
                'param_name' => 'el_icon_custom'
            ),

            array(
                'type' => 'textfield',
                'heading' => __('IMAGE AREA HEIGHT', 'ideo-themo'),
                'param_name' => 'el_image_height',
                'value' => '',
                'description' => __('Define height of custom image area. Notice that in this case image is added as a background so this option relates directly to image area height not to the image itself. Uploaded image has set contain property which means that it will be scale to the largest size such that both its width and its height can fit inside the image area.', 'ideo-themo')
            ),

            array(
                'type' => 'textfield',
                'heading' => __('PRICE AMOUNT ', 'ideo-themo'),
                'param_name' => 'el_price_amount',
                'value' => 19,
            ),

            array(
                'type' => 'textfield',
                'heading' => __('PRICE UNIT', 'ideo-themo'),
                'param_name' => 'el_price_unit',
                'value' => '$',
            ),

            array(
                'type' => 'textfield',
                'heading' => __('PRICE PERIOD', 'ideo-themo'),
                'param_name' => 'el_price_peroid',
                'value' => __('per month', 'ideo-themo'),
            ),

            array(
                'type' => 'textarea_html',
                'heading' => __('FEATURES', 'ideo-themo'),
                'param_name' => 'content',
                'value' => __('<ul><li>Projects</li><li>4 users</li><li>5 GB Space</li></ul>', 'ideo-themo'),
                'description' => __('Enter table features using unordered list.', 'ideo-themo')
            ),

            array(
                'type' => 'ideo_slider',
                'heading' => __('MARGIN TOP (px)', 'ideo-themo'),
                'param_name' => 'el_margin_top',
                'min' => '0',
                'max' => '200',
                'value' => '',
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
                'type' => 'ideo_switcher',
                'heading' => __('BUTTON', 'ideo-themo'),
                'param_name' => 'el_button_display',
                'on' => 'true',
                'off' => 'false',
                'value' => 'true',
                'description' => __('Enable or disable button displaying.', 'ideo-themo'),
                'group' => __('BUTTON', 'ideo-themo')

            ),
            array(
                'type' => 'textfield',
                'heading' => __('BUTTON LABEL', 'ideo-themo'),
                'param_name' => 'el_button_label',
                'value' => __('Read more', 'ideo-themo'),
                'description' => __('Enter text which will be displayed on the button.', 'ideo-themo'),
                'group' => __('BUTTON', 'ideo-themo')
            ),
            array(
                'type' => 'vc_link',
                'heading' => __('BUTTON URL (LINK)', 'ideo-themo'),
                'param_name' => 'el_button_link',
                'value' => '',
                'description' => __('Enter button URL.', 'ideo-themo'),
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
                'description' => __('Define button border thickness.', 'ideo-themo'),
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
                'std' => 'small',
                'description' => __('Choose Small, Medium or Large button size. Button size option refers to button height and button label font size.', 'ideo-themo'),
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
                'description' => __('Decide if/how the icon will be displayed on the button.</br><b>Standard</b> - the icon is displayed on the button continuously.</br><b>Reveal</b> - the icon slides in on hover.Decide if/how the icon will be displayed on the button.</br><b>Standard</b> - the icon is displayed on the button continuously.</br><b>Reveal</b> - the icon slides in on hover.', 'ideo-themo'),
                'group' => __('BUTTON', 'ideo-themo')
            ),
            array(
                'type' => 'ideo_choose_icon',
                'class' => '',
                'heading' => __('CHOOSE BUTTON ICON', 'ideo-themo'),
                'param_name' => 'el_button_icon',
                'value' => 'fa-angle-right',
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
                'std' => ideothemo_get_shortcodes_default_style('ideo_pricing_table'),
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
                        'subtitle_color' => __('SUBTITLE COLOR', 'ideo-themo'),
                        'icon_color' => __('ICON COLOR', 'ideo-themo'),
                        'price_area_background_color' => __('PRICE AREA BACKGROUND COLOR', 'ideo-themo'),
                        'price_amount_unit_color' => __('PRICE AMOUNT & UNIT COLOR', 'ideo-themo'),
                        'price_peroid_color' => __('PRICE PERIOD COLOR', 'ideo-themo'),
                        'features_text_color' => __('FEATURES TEXT COLOR', 'ideo-themo'),
                        'features_separator_color' => __('FEATURES SEPARATOR COLOR', 'ideo-themo'),
                        'borders_color' => __('BORDER TOP & BOTTOM COLOR', 'ideo-themo'),
                        'side_borders_color' => __('BORDER LEFT & RIGHT COLOR', 'ideo-themo'),
                    ),
                    'transparent' => array(
                        'title_color' => __('TITLE COLOR', 'ideo-themo'),
                        'subtitle_color' => __('SUBTITLE COLOR', 'ideo-themo'),
                        'icon_color' => __('ICON COLOR', 'ideo-themo'),
                        'price_area_background_color' => __('PRICE AREA BACKGROUND COLOR', 'ideo-themo'),
                        'price_amount_unit_color' => __('PRICE AMOUNT & UNIT COLOR', 'ideo-themo'),
                        'price_peroid_color' => __('PRICE PERIOD COLOR', 'ideo-themo'),
                        'features_text_color' => __('FEATURES TEXT COLOR', 'ideo-themo'),
                        'features_separator_color' => __('FEATURES SEPARATOR COLOR', 'ideo-themo'),
                        'border_top_color' => __('BORDER TOP COLOR', 'ideo-themo'),
                        'border_bottom_color' => __('BORDER BOTTOM COLOR', 'ideo-themo'),
                        'side_borders_color' => __('BORDER LEFT & RIGHT COLOR', 'ideo-themo'),
                    )
                ),
                'el_colors_dependencies' => array(
                    'el_highlight_table' => array(
                        'false' => array(
                            'colored' => array(
                                'background_color' => __('BACKGROUND COLOR', 'ideo-themo'),
                                'title_color' => __('TITLE COLOR', 'ideo-themo'),
                                'subtitle_color' => __('SUBTITLE COLOR', 'ideo-themo'),
                                'icon_color' => __('ICON COLOR', 'ideo-themo'),
                                'price_area_background_color' => __('PRICE AREA BACKGROUND COLOR', 'ideo-themo'),
                                'price_amount_unit_color' => __('PRICE AMOUNT & UNIT COLOR', 'ideo-themo'),
                                'price_peroid_color' => __('PRICE PERIOD COLOR', 'ideo-themo'),
                                'features_text_color' => __('FEATURES TEXT COLOR', 'ideo-themo'),
                                'features_separator_color' => __('FEATURES SEPARATOR COLOR', 'ideo-themo'),
                                'borders_color' => __('BORDER TOP & BOTTOM COLOR', 'ideo-themo'),
                                'side_borders_color' => __('BORDER LEFT & RIGHT COLOR', 'ideo-themo'),
                            ),
                            'transparent' => array(
                                'title_color' => __('TITLE COLOR', 'ideo-themo'),
                                'subtitle_color' => __('SUBTITLE COLOR', 'ideo-themo'),
                                'icon_color' => __('ICON COLOR', 'ideo-themo'),
                                'price_area_background_color' => __('PRICE AREA BACKGROUND COLOR', 'ideo-themo'),
                                'price_amount_unit_color' => __('PRICE AMOUNT & UNIT COLOR', 'ideo-themo'),
                                'price_peroid_color' => __('PRICE PERIOD COLOR', 'ideo-themo'),
                                'features_text_color' => __('FEATURES TEXT COLOR', 'ideo-themo'),
                                'features_separator_color' => __('FEATURES SEPARATOR COLOR', 'ideo-themo'),
                                'border_top_color' => __('BORDER TOP COLOR', 'ideo-themo'),
                                'border_bottom_color' => __('BORDER BOTTOM COLOR', 'ideo-themo'),
                                'side_borders_color' => __('BORDER LEFT & RIGHT COLOR', 'ideo-themo'),
                            )
                        ),
                        'true' => array(
                            'colored' => array(
                                'background_color' => __('BACKGROUND COLOR', 'ideo-themo'),
                                'title_color' => __('TITLE COLOR', 'ideo-themo'),
                                'subtitle_color' => __('SUBTITLE COLOR', 'ideo-themo'),
                                'icon_color' => __('ICON COLOR', 'ideo-themo'),
                                'price_area_background_color' => __('PRICE AREA BACKGROUND COLOR', 'ideo-themo'),
                                'price_amount_unit_color' => __('PRICE AMOUNT & UNIT COLOR', 'ideo-themo'),
                                'price_peroid_color' => __('PRICE PERIOD COLOR', 'ideo-themo'),
                                'features_text_color' => __('FEATURES TEXT COLOR', 'ideo-themo'),
                                'features_separator_color' => __('FEATURES SEPARATOR COLOR', 'ideo-themo'),
                                'borders_color' => __('BORDER TOP & BOTTOM COLOR', 'ideo-themo'),
                                'side_borders_color' => __('BORDER LEFT & RIGHT COLOR', 'ideo-themo'),
                            ),
                            'transparent' => array(
                                'price_area_background_color' => __('BACKGROUND COLOR', 'ideo-themo'),
                                'title_color' => __('TITLE COLOR', 'ideo-themo'),
                                'subtitle_color' => __('SUBTITLE COLOR', 'ideo-themo'),
                                'icon_color' => __('ICON COLOR', 'ideo-themo'),
                                'price_amount_unit_color' => __('PRICE AMOUNT & UNIT COLOR', 'ideo-themo'),
                                'price_peroid_color' => __('PRICE PERIOD COLOR', 'ideo-themo'),
                                'features_text_color' => __('FEATURES TEXT COLOR', 'ideo-themo'),
                                'features_separator_color' => __('FEATURES SEPARATOR COLOR', 'ideo-themo'),
                                'border_top_color' => __('BORDER TOP COLOR', 'ideo-themo'),
                                'border_bottom_color' => __('BORDER BOTTOM COLOR', 'ideo-themo'),
                                'side_borders_color' => __('BORDER LEFT & RIGHT COLOR', 'ideo-themo'),
                            )
                        )
                    )
                ),
                'value' => '',
                'group' => __('STYLING', 'ideo-themo')
            ),


            /////////
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
                'description' => __('Choose button style. Depending on which option you choose appropriate colorpickers will be available below. You can freely customize colors for chosen style but you can also leave empty colorpickers to use colors which are set for that style in Customizer.</br>Notice that Transparent to colored and Colored to transparent styles take colors from Colored palettes from Customizer.', 'ideo-themo'),
                'group' => __('STYLING', 'ideo-themo')
            ),


            array(
                'type' => 'ideo_custom_colors',
                'heading' => __('BUTTON COLORS', 'ideo-themo'),
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
                'max' => '2000',
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
        'js_view' => 'VcPricingTableView'
    )
);


$el_highlight_table = $el_title = $el_subtitle = $el_display_icon = $el_icon_type = $el_icon_font = $el_icon_custom = $el_image_height = $el_price_amount = $el_price_unit = $el_price_peroid = $el_margin_top = $el_margin_bottom = $el_extra_class = $el_button_display = $el_button_label = $el_button_link = $el_button_type = $el_button_radius = $el_button_border_thickness = $el_button_size = $el_button_icon_type = $el_button_icon = $el_button_icon_position = $el_elemnt_style = $el_elemnt_style_colors = $el_button_elemnt_style = $el_button_elemnt_style_colors = $el_button_elemnt_style_overwrite = $el_animation = $el_animation_type = $el_animation_delay = $el_animation_duration = $el_animation_offset = $el_uid = '';

function ideothemo_pricing_table_func($atts, $content = "")
{
    $content = ideothemo_content_p_fix($content);   
    
    extract(shortcode_atts(array(

        'el_highlight_table' => 'false',
        'el_title' => __('Place title here', 'ideo-themo'),
        'el_subtitle' => __('subtitle', 'ideo-themo'),
        'el_display_icon' => 'true',
        'el_icon_type' => 'font',
        'el_icon_font' => 'fa fa-desktop',
        'el_icon_custom' => '',
        'el_image_height' => '',
        'el_price_amount' => 19,
        'el_price_unit' => '$',
        'el_price_peroid' => __('per month', 'ideo-themo'),
        'el_margin_top' => '',
        'el_margin_bottom' => '20',
        'el_extra_class' => '',
        'el_button_display' => 'true',
        'el_button_label' => __('Read more', 'ideo-themo'),
        'el_button_link' => '',
        'el_button_type' => 'flat',
        'el_button_radius' => '',
        'el_button_border_thickness' => '1',
        'el_button_size' => 'small',
        'el_button_icon_type' => 'reveal',
        'el_button_icon' => 'fa fa-angle-right',
        'el_button_icon_position' => 'right-icon',
        'el_elemnt_style' => ideothemo_get_shortcodes_default_style('ideo_pricing_table'),
        'el_elemnt_style_colors' => '',
        'el_button_elemnt_style' => 'default',
        'el_button_elemnt_style_colors' => '',
        'el_button_elemnt_style_overwrite' => '',
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

    if ($el_highlight_table != 'true') $el_highlight_table = 'false';

    if ($el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-type="' . esc_attr($el_animation_type) . '"';
    if ($el_animation_delay && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-delay="' . esc_attr($el_animation_delay) . '"';
    if ($el_animation_duration && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-duration="' . esc_attr($el_animation_duration) . '"';
    if ($el_animation_offset && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-offset="' . esc_attr($el_animation_offset) . '"';

    $less = '#pricing_table_' . $el_uid . '{';

    if ($el_margin_top != '') {
        $less .= 'margin-top:' . (int)$el_margin_top . 'px;';
    }
    if ($el_margin_bottom != '') {
        $less .= 'margin-bottom:' . (int)$el_margin_bottom . 'px;';
    }

    if ($el_icon_type == 'custom' && $el_icon_custom) {

        $background_image = wp_get_attachment_image_src($el_icon_custom, 'full');

        $less .= '.icon{';
        $less .= 'background-image:url(' . $background_image[0] . ')';
        $less .= '}';
    }
    $less .= '}';

    $colors_array = array();
    if ($el_elemnt_style_colors) {
        $colors_array = (array)json_decode(str_replace("'", '"', $el_elemnt_style_colors));
    }
    $colors_array = array_replace_recursive(ideothemo_get_colors_by_style($el_elemnt_style), array_filter($colors_array));

    /* ===   custom style   ==== */
    $colors = ideothemo_get_colors_by_style($el_elemnt_style);
    $default_vars = array(
        'false' => array(
            'colored' => array(
                'background_color' => 'undefined',
                'title_color' => 'undefined',
                'subtitle_color' => 'undefined',
                'icon_color' => 'undefined',
                'price_area_background_color' => 'undefined',
                'price_amount_unit_color' => 'undefined',
                'price_peroid_color' => 'undefined',
                'features_text_color' => 'undefined',
                'features_separator_color' => 'undefined',
                'borders_color' => 'undefined',
                'side_borders_color' => 'undefined',
            ),
            'transparent' => array(
                'title_color' => 'undefined',
                'subtitle_color' => 'undefined',
                'icon_color' => 'undefined',
                'price_area_background_color' => 'undefined',
                'price_amount_unit_color' => 'undefined',
                'price_peroid_color' => 'undefined',
                'features_text_color' => 'undefined',
                'features_separator_color' => 'undefined',
                'border_top_color' => 'undefined',
                'border_bottom_color' => 'undefined',
                'side_borders_color' => 'undefined',
            )
        ),
        'true' => array(
            'colored' => array(
                'background_color' => 'undefined',
                'title_color' => 'undefined',
                'subtitle_color' => 'undefined',
                'icon_color' => 'undefined',
                'price_area_background_color' => 'undefined',
                'price_amount_unit_color' => 'undefined',
                'price_peroid_color' => 'undefined',
                'features_text_color' => 'undefined',
                'features_separator_color' => 'undefined',
                'borders_color' => 'undefined',
                'side_borders_color' => 'undefined',
            ),
            'transparent' => array(
                'title_color' => 'undefined',
                'subtitle_color' => 'undefined',
                'icon_color' => 'undefined',
                'price_area_background_color' => 'undefined',
                'price_amount_unit_color' => 'undefined',
                'price_peroid_color' => 'undefined',
                'features_text_color' => 'undefined',
                'features_separator_color' => 'undefined',
                'border_top_color' => 'undefined',
                'border_bottom_color' => 'undefined',
                'side_borders_color' => 'undefined',
            )
        )
    );


    $html .= ideothemo_custom_style('pricing_table', $el_uid, $default_vars[$el_highlight_table], $el_elemnt_style, $el_elemnt_style_colors, $less);
    /* ===   end custom style   ==== */

    $html .= '<div class="ideo-pricing-table ' . ($el_highlight_table == 'true' ? 'highlight-table' : '') . ' ' . esc_attr($el_elemnt_style) . ' ' . ($el_button_display == 'false' ? 'btn-off' : '') . ' ' . esc_attr($el_extra_class) . ' vc-layer" id="pricing_table_' . esc_attr($el_uid) . '" data-id="pricing_table_' . esc_attr($el_uid) . '" ' . $data . '>';
    $html .= '<div class="header">';
    if ($el_display_icon == 'true') {
        $html .= '<span class="icon ' . $el_icon_type . '"><i class="' . esc_attr(isset($el_icon_font) && $el_icon_type == 'font' ? $el_icon_font : '') . '"></i></span>';
    }

    if ($el_title) $html .= '<h3 class="title">' . ideo_esc($el_title) . '</h3>';
    if ($el_subtitle) $html .= '<p class="subtitle">' . ideo_esc($el_subtitle) . '</p>';

    $html .= '</div>';
    $html .= '<span class="price">';
    if ($el_price_amount) {
        $html .= '<span class="amount">' . ideo_esc($el_price_amount) . '</span><span class="unit">' . ideo_esc($el_price_unit) . '</span>';
        if ($el_price_peroid) $html .= '<span class="peroid">' . ideo_esc($el_price_peroid) . '</span>';
    }
    $html .= '</span>';

    if ($content) $html .= '' . $content . '';

    if ($el_button_display == 'true') {
        $html .= do_shortcode('[vc_button 
            el_label="' . $el_button_label . '" 
            el_type="' . $el_button_type . '" 
            el_size="' . $el_button_size . '"   
            el_icon_position="' . $el_button_icon_position . '"
            el_element_style="' . ($el_button_elemnt_style == 'default' ? ideothemo_get_shortcodes_button_default_style($el_elemnt_style, 'ideo_pricing_table') : $el_button_elemnt_style ) . '"
            el_uid="' . $el_uid . '" 
            el_link="' . $el_button_link . '" 
            el_radius="' . $el_button_radius . '" 
            el_border_thickness="' . $el_button_border_thickness . '" 
            el_icon_type="' . $el_button_icon_type . '" 
            el_icon="' . $el_button_icon . '" 
            el_element_style_overwrite="' . $el_button_elemnt_style_overwrite . '"    
            el_element_style_colors="' . $el_button_elemnt_style_colors . '"         
        ]');
    }
    $html .= '</div>';

    

    return $html;
}

add_shortcode('ideo_pricing_table', 'ideothemo_pricing_table_func');
    
    
    
