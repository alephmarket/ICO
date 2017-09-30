<?php

vc_map(array(
    'name' => __('Column', 'ideo-themo'),
    'base' => 'vc_column',
    'is_container' => true,
    'content_element' => false,
    'show_settings_on_create' => false,
    'category' => __('Content', 'ideo-themo'),
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => __('ANCHOR POINT', 'ideo-themo'),
            'param_name' => 'el_anchor_point',
            'value' => '',
            'description' => __('Enter anchor ID if you want to link to this column.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('MINIMUM COLUMN HEIGHT', 'ideo-themo'),
            'param_name' => 'el_minimum_column_height',
            'value' => '',
            'description' => __('Define the minimum column height. By default the height of the column adapts to the content placed in it but using this option you can set stretch this section - even if there is not much content inside this section its height will not be lower than defined minimum height.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('CONTENT ALIGN', 'ideo-themo'),
            'param_name' => 'el_alignment',
            'value' => array('Left' => 'left', 'Center' => 'center', 'Right' => 'right'),
            'std' => 'left',
            'description' => __('Choose Left, Center and Right alignment for content placed inside this column.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('CONTENT ALIGN ON MOBILE', 'ideo-themo'),
            'param_name' => 'el_alignment_mobile',
            'value' => array('Left' => 'left', 'Center' => 'center', 'Right' => 'right'),
            'std' => 'left',
            'description' => __('Choose Left, Center and Right alignment for content placed inside this column on mobile devices <786px', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('CONTENT POSITION', 'ideo-themo'),
            'param_name' => 'el_valignment',
            'value' => array('Top' => 'start', 'Center' => 'center', 'Bottom' => 'end'),
            'std' => 'start',
            'description' => __('Choose Top, Center and Bottom alignment for content placed inside this column.', 'ideo-themo')
        ),
        array(
            'type' => 'vc_link',
            'heading' => __('COLUMN URL', 'ideo-themo'),
            'param_name' => 'el_url',
            'value' => '',
            'description' => __('Enter column URL if you want to link whole column.', 'ideo-themo')
        ),
       array(
            'type' => 'ideo_switcher',
            'heading' => __('STICKY COLUMN', 'ideo-themo'),
            'param_name' => 'el_sticky',
            'on' => 'true',
            'off' => 'false',
            'value' => 'false',
            'description' => __('Column sticky', 'ideo-themo'),
           'dependencies' => array(
                'true' => array(
                    'el_sticky_offset'
                )
            ),
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('OFFSET (px)', 'ideo-themo'),
            'param_name' => 'el_sticky_offset',
            'min' => '0',
            'max' => '200',
            'value' => '20',
            'description' => __('Column sticky offset.', 'ideo-themo')
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
                __('None', 'ideo-themo') => '',
                __('Color', 'ideo-themo') => 'color',
                __('Image', 'ideo-themo') => 'image',
            ),
            'dependencies' => array(
                'color' => array(
                    'el_background_color',
                    'el_background_color_pattern',
                    'el_background_color_pattern_color',
                ),
                'image' => array(
                    'el_background_image',
                    'el_background_position',
                    'el_background_repeat',
                    'el_background_size',
                    'el_background_overlay_pattern',
                    'el_background_overlay_pattern_color',
                    'el_background_overlay_color'
                ),
            ),
            'std' => '',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Choose Color or Image background type. Depending on which option you choose appropriate styling options will be available below.', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_colorpicker',
            'heading' => __('COLOR', 'ideo-themo'),
            'param_name' => 'el_background_color',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'value' => '',
            'description' => __('Pick background color.', 'ideo-themo')
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('PATTERN OVERLAY', 'ideo-themo'),
            'param_name' => 'el_background_color_pattern',
            'value' => array_merge(array(__('None', 'ideo-themo') => ''), ideothemo_get_background_patterns(true)),
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Choose one of predefined background patterns.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_colorpicker',
            'heading' => __('PATTERN COLOR', 'ideo-themo'),
            'param_name' => 'el_background_color_pattern_color',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'value' => '',
            'description' => __('Pick pattern color.', 'ideo-themo')
        ),
        array(
            'type' => 'attach_image',
            'heading' => __('UPLOAD IMAGE', 'ideo-themo'),
            'param_name' => 'el_background_image',
            'value' => array(),
            'group' => __('BACKGROUND', 'ideo-themo'),
        ),
        array(
            'type' => 'ideo_switcher',
            'heading' => __('100% BACKGROUND IMAGE', 'ideo-themo'),
            'param_name' => 'el_background_size',
            'on' => 'true',
            'off' => 'false',
            'value' => 'false',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('By default this option is turned Off so your image has set ‘auto’ property (original width and height). Turn On this option to set ‘cover’ property for the image (it will be scale to be as large as possible so that the background area is completely covered by the background image).', 'ideo-themo'),
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
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Choose the background image position property to set the starting position of the image.', 'ideo-themo')
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
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Choose repeat property to set if/how the image will be repeated.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_colorpicker',
            'heading' => __('COLOR OVERLAY', 'ideo-themo'),
            'param_name' => 'el_background_overlay_color',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'value' => '',
            'description' => __('Pick overlay color.', 'ideo-themo')
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('PATTERN OVERLAY', 'ideo-themo'),
            'param_name' => 'el_background_overlay_pattern',
            'value' => array_merge(array(__('None', 'ideo-themo') => ''), ideothemo_get_background_patterns(true)),
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Choose one of predefined background patterns.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_colorpicker',
            'heading' => __('PATTERN COLOR', 'ideo-themo'),
            'param_name' => 'el_background_overlay_pattern_color',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'value' => '',
            'description' => __('Pick pattern color.', 'ideo-themo')
        ),
        /* hover */
        array(
            'type' => 'ideo_buttons',
            'heading' => __('BACKGROUND HOVER', 'ideo-themo'),
            'param_name' => 'el_background_hover',
            'value' => array(
                __('None', 'ideo-themo') => '',
                __('Color', 'ideo-themo') => 'color',
                __('Image', 'ideo-themo') => 'image',
            ),
            'dependencies' => array(
                'color' => array(
                    'el_background_hover_color',
                    'el_background_hover_color_pattern',
                    'el_background_hover_color_pattern_color'
                ),
                'image' => array(
                    'el_background_hover_image',
                    'el_background_hover_position',
                    'el_background_hover_repeat',
                    'el_background_hover_size',
                    'el_background_hover_overlay_pattern',
                    'el_background_hover_overlay_pattern_color',
                    'el_background_hover_overlay_color'
                ),
            ),
            'std' => '',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Choose Color or Image hover background type. Depending on which option you choose appropriate styling options will be available below.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_colorpicker',
            'heading' => __('COLOR', 'ideo-themo'),
            'param_name' => 'el_background_hover_color',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'value' => '',
            'description' => __('Pick background hover color.', 'ideo-themo')
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('PATTERN OVERLAY', 'ideo-themo'),
            'param_name' => 'el_background_hover_color_pattern',
            'value' => array_merge(array(__('None', 'ideo-themo') => ''), ideothemo_get_background_patterns(true)),
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Choose one of predefined patterns.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_colorpicker',
            'heading' => __('PATTERN COLOR', 'ideo-themo'),
            'param_name' => 'el_background_hover_color_pattern_color',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'value' => '',
            'description' => __('Pick pattern color.', 'ideo-themo')
        ),
        array(
            'type' => 'attach_image',
            'heading' => __('UPLOAD IMAGE', 'ideo-themo'),
            'param_name' => 'el_background_hover_image',
            'value' => array(),
            'group' => __('BACKGROUND', 'ideo-themo'),
        ),

        array(
            'type' => 'ideo_switcher',
            'heading' => __('100% BACKGROUND IMAGE', 'ideo-themo'),
            'param_name' => 'el_background_hover_size',
            'on' => 'true',
            'off' => 'false',
            'value' => 'false',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('By default this option is turned Off so your image has set ‘auto’ property (original width and height). Turn On this option to set ‘cover’ property for the image (it will be scale to be as large as possible so that the background area is completely covered by the background image).', 'ideo-themo'),
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
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Choose the background image position property to set the starting position of the image.', 'ideo-themo')
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
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Choose repeat property to set if/how the image will be repeated.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_colorpicker',
            'heading' => __('COLOR OVERLAY', 'ideo-themo'),
            'param_name' => 'el_background_hover_overlay_color',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'value' => '',
            'description' => __('Pick overlay color.', 'ideo-themo')
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('PATTERN OVERLAY', 'ideo-themo'),
            'param_name' => 'el_background_hover_overlay_pattern',
            'value' => array_merge(array(__('None', 'ideo-themo') => ''), ideothemo_get_background_patterns(true)),
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Choose one of predefined background patterns.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_colorpicker',
            'heading' => __('PATTERN COLOR', 'ideo-themo'),
            'param_name' => 'el_background_hover_overlay_pattern_color',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'value' => '',
            'description' => __('Pick pattern color.', 'ideo-themo')
        ),
        /* hover */

        array(
            'type' => 'ideo_buttons',
            'heading' => __('ANIMATION', 'ideo-themo'),
            'param_name' => 'el_animation',
            'group' => __('ANIMATION', 'ideo-themo'),
            'value' => array(
                __('None', 'ideo-themo') => '',
                __('Viewport', 'ideo-themo') => 'viewport',
                __('Parallax Composer', 'ideo-themo') => 'parallax'
            ),
            'dependencies' => array(
                'viewport' => array(
                    'el_animation_type',
                    'el_animation_delay',                    
                    'el_animation_duration',
                    'el_animation_offset'
                ),
                'parallax' => array(
                    'el_animation_column_name',
                    'el_remove_from_grid'
                )
            ),
            'std' => '',
            'description' => __('Choose between Viewport and Parallax Composer animations or choose None if you do not want to animate shortcode. </br>If you choose <b>Viewport animation</b> two additional animation options will be available below. </br>If you choose <b>Parallax Composer</b> the column with all its content will be automatically added as a VC Column layer to the Parallax Composer.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('COLUMN NAME', 'ideo-themo'),
            'param_name' => 'el_animation_column_name',
            'group' => __('ANIMATION', 'ideo-themo'),
            'value' => '',
            'description' => __('Column name is used as a label for VC column layer in Parallax Composer.', 'ideo-themo'),
        ),
        array(
            'type' => 'ideo_switcher',
            'heading' => __('REMOVE FROM GRID', 'ideo-themo'),
            'param_name' => 'el_remove_from_grid',
            'on' => 'true',
            'off' => 'false',
            'value' => 'false',
            'group' => __('ANIMATION', 'ideo-themo'),
            'description' => __('This option removes column container from Page section grid. Basically, content placed in the column distend the height of Page section. When you add a column to Parallax Composer, that column with content becomes a VC layer and changes position inside the Page section but column container stays in place to maintain the height of Page section.  Using Remove from grid option you can remove column container from Page section grid and that container will no longer maintain the height of Page section.', 'ideo-themo'),
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
        ),
        array(
            'type' => 'css_editor',
            'heading' => __('CSS', 'ideo-themo'),
            'param_name' => 'css',
            'group' => __('DESIGN OPTIONS', 'ideo-themo'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('WIDTH', 'ideo-themo'),
            'param_name' => 'width',
            'std' => '1/1',
            'value' => array(
                '1 column - 1/12' => "1/12",
                '2 columns - 1/6' => "1/6",
                '3 columns - 1/4' => "1/4",
                '4 columns - 1/3' => "1/3",
                '5 columns - 5/12' => "5/12",
                '6 columns - 1/2' => "1/2",
                '7 columns - 7/12' => "7/12",
                '8 columns - 2/3' => "2/3",
                '9 columns - 3/4' => "3/4",
                '10 columns - 5/6' => "5/6",
                '11 columns - 11/12' => "11/12",
                '12 columns - 1/1' => "1/1",
            ),
            'description' => __('Using this option you can change default width for the column inside the grid.', 'js_composer'),
            'group' => __('WIDTH & RESPONSIVENESS', 'ideo-themo'),
        ),
        array(
            'type' => 'column_offset',
            'heading' => __('RESPONSIVENESS', 'ideo-themo'),
            'param_name' => 'offset',
            'description' => __('In this section you can set column width and offset for default column width and for other devices by taking into account default value. You can also hide column on specific type of devices.', 'js_composer'),
            'group' => __('WIDTH & RESPONSIVENESS', 'ideo-themo'),
        ),
    ),
    'js_view' => 'VcColumnView',
    'admin_enqueue_css' => array(
        get_template_directory_uri() . '/inc/vc_extend/css/animation-type.css',
        get_template_directory_uri() . '/inc/vc_extend/css/parms.css',
        get_template_directory_uri() . '/inc/vc_extend/css/shortcode.css',
    ),
));
vc_map(array(
    'name' => __('Column', 'ideo-themo'),
    'base' => 'vc_column_inner',
    'is_container' => true,
    'content_element' => false,
    'show_settings_on_create' => false,
    'category' => __('Content', 'ideo-themo'),
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => __('ANCHOR POINT', 'ideo-themo'),
            'param_name' => 'el_anchor_point',
            'value' => '',
            'description' => __('Enter anchor ID if you want to link to this column.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('MINIMUM COLUMN HEIGHT', 'ideo-themo'),
            'param_name' => 'el_minimum_column_height',
            'value' => '',
            'description' => __('Define the minimum column height. By default the height of the column adapts to the content placed in it but using this option you can set stretch this section - even if there is not much content inside this section its height will not be lower than defined minimum height.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('CONTENT HORIZONTAL ALIGNMENT', 'ideo-themo'),
            'param_name' => 'el_alignment',
            'value' => array('Left' => 'left', 'Center' => 'center', 'Right' => 'right'),
            'std' => 'left',
            'description' => __('Choose Left, Center and Right alignment for content placed inside this column.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('CONTENT HORIZONTAL ALIGNMENT ON MOBILE', 'ideo-themo'),
            'param_name' => 'el_alignment_mobile',
            'value' => array('Left' => 'left', 'Center' => 'center', 'Right' => 'right'),
            'std' => 'left',
            'description' => __('Choose Left, Center and Right alignment for content placed inside this column on mobile devices <786px', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('CONTENT VERTICAL ALIGNMENT', 'ideo-themo'),
            'param_name' => 'el_valignment',
            'value' => array('Top' => 'start', 'Center' => 'center', 'Bottom' => 'end'),
            'std' => 'start',
            'description' => __('Choose Top, Center and Bottom alignment for content placed inside this column.', 'ideo-themo')
        ),
        array(
            'type' => 'vc_link',
            'heading' => __('COLUMN URL', 'ideo-themo'),
            'param_name' => 'el_url',
            'value' => '',
            'description' => __('Enter column URL if you want to link whole column.', 'ideo-themo')
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
                __('None', 'ideo-themo') => '',
                __('Color', 'ideo-themo') => 'color',
                __('Image', 'ideo-themo') => 'image',
            ),
            'dependencies' => array(
                'color' => array(
                    'el_background_color',
                    'el_background_color_pattern',
                    'el_background_color_pattern_color',
                ),
                'image' => array(
                    'el_background_image',
                    'el_background_position',
                    'el_background_repeat',
                    'el_background_size',
                    'el_background_overlay_pattern',
                    'el_background_overlay_pattern_color',
                    'el_background_overlay_color'
                ),
            ),
            'std' => '',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Choose Color or Image background type. Depending on which option you choose appropriate styling options will be available below.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_colorpicker',
            'heading' => __('COLOR', 'ideo-themo'),
            'param_name' => 'el_background_color',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'value' => '',
            'description' => __('Pick background color.', 'ideo-themo')
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('PATTERN OVERLAY', 'ideo-themo'),
            'param_name' => 'el_background_color_pattern',
            'value' => array_merge(array(__('None', 'ideo-themo') => ''), ideothemo_get_background_patterns(true)),
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Choose one of predefined background patterns.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_colorpicker',
            'heading' => __('PATTERN COLOR', 'ideo-themo'),
            'param_name' => 'el_background_color_pattern_color',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'value' => '',
            'description' => __('Pick pattern color.', 'ideo-themo')
        ),
        array(
            'type' => 'attach_image',
            'heading' => __('UPLOAD IMAGE', 'ideo-themo'),
            'param_name' => 'el_background_image',
            'value' => array(),
            'group' => __('BACKGROUND', 'ideo-themo'),
        ),
        array(
            'type' => 'ideo_switcher',
            'heading' => __('100% BACKGROUND IMAGE', 'ideo-themo'),
            'param_name' => 'el_background_size',
            'on' => 'true',
            'off' => 'false',
            'value' => 'false',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('By default this option is turned Off so your image has set ‘auto’ property (original width and height). Turn On this option to set ‘cover’ property for the image (it will be scale to be as large as possible so that the background area is completely covered by the background image).', 'ideo-themo'),
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
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Choose the background image position property to set the starting position of the image.', 'ideo-themo')
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
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Choose repeat property to set if/how the image will be repeated.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_colorpicker',
            'heading' => __('COLOR OVERLAY', 'ideo-themo'),
            'param_name' => 'el_background_overlay_color',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'value' => '',
            'description' => __('Pick overlay color.', 'ideo-themo')
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('PATTERN OVERLAY', 'ideo-themo'),
            'param_name' => 'el_background_overlay_pattern',
            'value' => array_merge(array(__('None', 'ideo-themo') => ''), ideothemo_get_background_patterns(true)),
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Choose one of predefined background patterns.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_colorpicker',
            'heading' => __('PATTERN COLOR', 'ideo-themo'),
            'param_name' => 'el_background_overlay_pattern_color',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'value' => '',
            'description' => __('Pick pattern color.', 'ideo-themo')
        ),
        /* hover */
        array(
            'type' => 'ideo_buttons',
            'heading' => __('BACKGROUND HOVER', 'ideo-themo'),
            'param_name' => 'el_background_hover',
            'value' => array(
                __('None', 'ideo-themo') => '',
                __('Color', 'ideo-themo') => 'color',
                __('Image', 'ideo-themo') => 'image',
            ),
            'dependencies' => array(
                'color' => array(
                    'el_background_hover_color',
                    'el_background_hover_color_pattern',
                    'el_background_hover_color_pattern_color'
                ),
                'image' => array(
                    'el_background_hover_image',
                    'el_background_hover_position',
                    'el_background_hover_repeat',
                    'el_background_hover_size',
                    'el_background_hover_overlay_pattern',
                    'el_background_hover_overlay_pattern_color',
                    'el_background_hover_overlay_color'
                ),
            ),
            'std' => '',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Choose Color or Image hover background type. Depending on which option you choose appropriate styling options will be available below.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_colorpicker',
            'heading' => __('COLOR', 'ideo-themo'),
            'param_name' => 'el_background_hover_color',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'std' => '',
            'description' => __('Pick background hover color.', 'ideo-themo')
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('PATTERN OVERLAY', 'ideo-themo'),
            'param_name' => 'el_background_hover_color_pattern',
            'value' => array_merge(array(__('None', 'ideo-themo') => ''), ideothemo_get_background_patterns(true)),
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Choose one of predefined patterns.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_colorpicker',
            'heading' => __('PATTERN COLOR', 'ideo-themo'),
            'param_name' => 'el_background_hover_color_pattern_color',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'std' => '',
            'description' => __('Pick pattern color.', 'ideo-themo')
        ),
        array(
            'type' => 'attach_image',
            'heading' => __('UPLOAD IMAGE', 'ideo-themo'),
            'param_name' => 'el_background_hover_image',
            'value' => array(),
            'group' => __('BACKGROUND', 'ideo-themo'),
        ),

        array(
            'type' => 'ideo_switcher',
            'heading' => __('100% BACKGROUND IMAGE', 'ideo-themo'),
            'param_name' => 'el_background_hover_size',
            'on' => 'true',
            'off' => 'false',
            'value' => 'false',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('By default this option is turned Off so your image has set ‘auto’ property (original width and height). Turn On this option to set ‘cover’ property for the image (it will be scale to be as large as possible so that the background area is completely covered by the background image).', 'ideo-themo'),
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
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Choose the background image position property to set the starting position of the image.', 'ideo-themo')
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
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Choose repeat property to set if/how the image will be repeated.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_colorpicker',
            'heading' => __('COLOR OVERLAY', 'ideo-themo'),
            'param_name' => 'el_background_hover_overlay_color',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'std' => '',
            'description' => __('Pick overlay color.', 'ideo-themo')
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('PATTERN OVERLAY', 'ideo-themo'),
            'param_name' => 'el_background_hover_overlay_pattern',
            'value' => array_merge(array(__('None', 'ideo-themo') => ''), ideothemo_get_background_patterns(true)),
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Choose one of predefined background patterns.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_colorpicker',
            'heading' => __('PATTERN COLOR', 'ideo-themo'),
            'param_name' => 'el_background_hover_overlay_pattern_color',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'std' => '',
            'description' => __('Pick pattern color.', 'ideo-themo')
        ),
        /* hover */

        array(
            'type' => 'ideo_buttons',
            'heading' => __('ANIMATION', 'ideo-themo'),
            'param_name' => 'el_animation',
            'group' => __('ANIMATION', 'ideo-themo'),
            'value' => array(
                __('None', 'ideo-themo') => '',
                __('Viewport', 'ideo-themo') => 'viewport',
                __('Parallax Composer', 'ideo-themo') => 'parallax'
            ),
            'dependencies' => array(
                'viewport' => array(
                    'el_animation_type', 'el_animation_delay', 'el_animation_duration', 'el_animation_offset'
                ),
                'parallax' => array(
                    'el_animation_column_name',
                    'el_remove_from_grid'
                )
            ),
            'std' => '',
            'description' => __('Choose between Viewport and Parallax Composer animations or choose None if you do not want to animate shortcode. </br>If you choose <b>Viewport animation</b> two additional animation options will be available below. </br>If you choose <b>Parallax Composer</b> the column with all its content will be automatically added as a VC Column layer to the Parallax Composer.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('COLUMN NAME', 'ideo-themo'),
            'param_name' => 'el_animation_column_name',
            'group' => __('ANIMATION', 'ideo-themo'),
            'value' => '',
            'description' => __('Column name is used as a label for VC column layer in Parallax Composer.', 'ideo-themo'),
        ),
        array(
            'type' => 'ideo_switcher',
            'heading' => __('REMOVE FROM GRID', 'ideo-themo'),
            'param_name' => 'el_remove_from_grid',
            'on' => 'true',
            'off' => 'false',
            'value' => 'false',
            'group' => __('ANIMATION', 'ideo-themo'),
            'description' => __('This option removes column container from Page section grid. Basically, content placed in the column distend the height of Page section. When you add a column to Parallax Composer, that column with content becomes a VC layer and changes position inside the Page section but column container stays in place to maintain the height of Page section.  Using Remove from grid option you can remove column container from Page section grid and that container will no longer maintain the height of Page section.', 'ideo-themo'),
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
        ),
        array(
            'type' => 'css_editor',
            'heading' => __('CSS', 'ideo-themo'),
            'param_name' => 'css',
            'group' => __('DESIGN OPTIONS', 'ideo-themo'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('WIDTH', 'ideo-themo'),
            'param_name' => 'width',
            'std' => '1/1',
            'value' => array(
                '1 column - 1/12' => "1/12",
                '2 columns - 1/6' => "1/6",
                '3 columns - 1/4' => "1/4",
                '4 columns - 1/3' => "1/3",
                '5 columns - 5/12' => "5/12",
                '6 columns - 1/2' => "1/2",
                '7 columns - 7/12' => "7/12",
                '8 columns - 2/3' => "2/3",
                '9 columns - 3/4' => "3/4",
                '10 columns - 5/6' => "5/6",
                '11 columns - 11/12' => "11/12",
                '12 columns - 1/1' => "1/1",
            ),
            'description' => __('Using this option you can change default width for the column inside the grid.', 'js_composer'),
            'group' => __('WIDTH & RESPONSIVENESS', 'ideo-themo'),
        ),
        array(
            'type' => 'column_offset',
            'heading' => __('RESPONSIVENESS', 'ideo-themo'),
            'param_name' => 'offset',
            'description' => __('In this section you can set column width and offset for default column width and for other devices by taking into account default value. You can also hide column on specific type of devices.', 'js_composer'),
            'group' => __('WIDTH & RESPONSIVENESS', 'ideo-themo'),
        )

    ),
    'js_view' => 'VcColumnView'
));

