<?php


vc_map(array(
        'name' => __('Row section', 'ideo-themo'),
        'base' => 'vc_row_inner',
        'as_parent' => array('only' => 'vc_row,vc_row_inner'),
        'weight' => 1000,
        'is_container' => true,
        'description' => __('Place content elements in customizable section', 'ideo-themo'),
        'icon' => 'icon-page-section',
        'show_settings_on_create' => false,
        'content_element' => false,
        'category' => __('Content', 'ideo-themo'),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => __('ANCHOR', 'ideo-themo'),
                'param_name' => 'el_id',
                'value' => '',
                'description' => __('Enter Anchor ID if you want to link to this section.', 'ideo-themo')
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
                __('Video', 'ideo-themo') => 'video'
            ),
            'dependencies' => array(
                'color' => array(
                    'el_background_color',
                    'el_background_color_pattern',
                    'el_background_color_pattern_color'
                ),
                'image' => array(
                    'el_background_image',
                    'el_background_position',
                    'el_background_repeat',
                    'el_background_size',
                    'el_background_image_pattern',
                    'el_background_image_pattern_color',
                    'el_background_motion',
                    'el_background_motion_speed'
                ),
                'video' => array(
                    'el_video_ytlink',
                    'el_video_vimeolink',
                    'el_video_mp4',
                    'el_video_webm',
                    'el_video_ogv',
                    'el_video_fallback_image',
                    'el_video_pattern',
                    'el_video_pattern_color',
                    'el_video_motion'
                )
            ),
            'std' => '',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Choose Color, Image or Video background type. Depending on which option you choose appropriate styling options will be available below.', 'ideo-themo')
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
            'type' => 'attach_image',
            'heading' => __('UPLOAD IMAGE', 'ideo-themo'),
            'param_name' => 'el_background_image',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'value' => array()
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
            'std' => 'left top',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Choose the background image position property to set the starting position of the image in relation to the section container.', 'ideo-themo')
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('BACKGROUND REPEAT', 'ideo-themo'),
            'param_name' => 'el_background_repeat',
            'value' => array(
                'repeat' => 'repeat',
                'repeat-x' => 'repeat-x',
                'repeat-y' => 'repeat-y',
                'no-repeat' => 'no-repeat'
            ),
            'std' => 'repeat',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Choose repeat property to set if/how the image will be repeated.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('YOUTUBE VIDEO', 'ideo-themo'),
            'param_name' => 'el_video_ytlink',
            'value' => '',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Enter YouTube link to load video directly from Youtube.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('VIMEO VIDEO', 'ideo-themo'),
            'param_name' => 'el_video_vimeolink',
            'value' => '',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Enter Vimeo link to load video directly from Vimeo.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('MP4 FORMAT', 'ideo-themo'),
            'param_name' => 'el_video_mp4',
            'value' => '',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Enter selfhosted video URL to load MP4 video from Media library. </br>!!! If you use selfhosted video we recommend to use both formats (MP4 and WebM) at the same time – you get guarantee that your video background will be properly displayed on every browser.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('WEBM FORMAT', 'ideo-themo'),
            'param_name' => 'el_video_webm',
            'value' => '',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Enter selfhosted video URL to load WebM video from Media library. </br>!!! If you use selfhosted video we recommend to use both formats (MP4 and WebM) at the same time – you get guarantee that your video background will be properly displayed on every browser.', 'ideo-themo')
        ),
        array(
            'type' => 'attach_image',
            'heading' => __('MOBILE IMAGE', 'ideo-themo'),
            'param_name' => 'el_video_fallback_image',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'value' => '',
            'description' => __('Upload the image which will be displayed on mobile devices instead of video.', 'ideo-themo'),
            'value' => array()
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('BACKGROUND MOTION', 'ideo-themo'),
            'param_name' => 'el_background_motion',
            'value' => array(
                'scroll' => 'scroll',
                'fixed' => 'fixed',
                'parallax' => 'parallax',
                'mousemove' => 'mousemove'
            ),
            'std' => 'scroll',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Choose one of predefined background image motions:</br>
			<b>Scroll</b> - the background image moves the same speed as scroll;</br>
			<b>Fixed</b> - the background image is static, fixed in relation to browser window;</br>
			<b>Parallax</b> - the background image moves at a different speed than scroll.', 'ideo-themo')
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('VIDEO MOTION', 'ideo-themo'),
            'param_name' => 'el_video_motion',
            'value' => array(
                'scroll' => 'scroll',
                'fixed' => 'fixed',
            ),
            'std' => 'scroll',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Choose one of predefined background image motions:
			<b>Scroll</b> - the video background moves the same speed as scroll;</br>
			<b>Fixed</b> - the video background is static, fixed in relation to browser window;</br>', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('MOVING SPEED', 'ideo-themo'),
            'param_name' => 'el_background_motion_speed',
            'min' => '-2',
            'max' => '2',
            'step' => '0.1',
            'value' => '0.3',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('This option works only if you set Parallax background motion. Using this option you can define the motion speed of the background image in relation to the scroll. You can set values from -2 to 2 (for 1 value the background image moves at the same speed as scroll).', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('BACKGROUND OVERLAY', 'ideo-themo'),
            'param_name' => 'el_background_overlay',
            'value' => array(
                __('none', 'ideo-themo') => '',
                __('pattern', 'ideo-themo') => 'pattern',
                __('color', 'ideo-themo') => 'color',
            ),
            'dependencies' => array(
                'pattern' => array(
                    'el_background_overlay_pattern',
                    'el_background_overlay_pattern_color'
                ),
                'color' => array(
                    'el_background_overlay_color'
                )
            ),
            'std' => '',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Choose Pattern or Color background overlay or choose None if you do not need any overlay. Depending on which option you choose appropriate settings will be available below.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_colorpicker',
            'heading' => __('BACKGROUND OVERLAY COLOR', 'ideo-themo'),
            'param_name' => 'el_background_overlay_color',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'std' => '',
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
                    'viewport' => array(
                        'el_animation_type',
                        'el_animation_delay',                        
                        'el_animation_duration',
                        'el_animation_offset'
                    ),
                    'parallax' => array(
                        'el_animation_row_name'
                    )
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
                'group' => __('ANIMATION', 'ideo-themo')
            ),
            array(
                'type' => 'css_editor',
                'heading' => __('CSS', 'ideo-themo'),
                'param_name' => 'css',
                'group' => __('DESIGN OPTIONS', 'ideo-themo'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Z INDEX', 'ideo-themo'),
                'param_name' => 'el_z_index',
                'value' => '',
                'group' => __('DESIGN OPTIONS', 'ideo-themo'),
            ),
            array(
                'type' => 'ideo_switcher',
                'heading' => __('Large devices displaying (1200px and up)', 'ideo-themo'),
                'param_name' => 'el_rwd_lg',
                'on' => 'true',
                'off' => 'false',
                'value' => 'true',
                'group' => __('DESIGN OPTIONS', 'ideo-themo'),

            ),
            array(
                'type' => 'ideo_switcher',
                'heading' => __('Medium devices displaying (992-1199px)', 'ideo-themo'),
                'param_name' => 'el_rwd_md',
                'on' => 'true',
                'off' => 'false',
                'value' => 'true',
                'group' => __('DESIGN OPTIONS', 'ideo-themo'),

            ),
            array(
                'type' => 'ideo_switcher',
                'heading' => __('Small devices displaying (768-991px)', 'ideo-themo'),
                'param_name' => 'el_rwd_sm',
                'on' => 'true',
                'off' => 'false',
                'value' => 'true',
                'group' => __('DESIGN OPTIONS', 'ideo-themo'),

            ),
            array(
                'type' => 'ideo_switcher',
                'heading' => __('Extra small devices displaying (less than 768px)', 'ideo-themo'),
                'param_name' => 'el_rwd_xs',
                'on' => 'true',
                'off' => 'false',
                'value' => 'true',
                'group' => __('DESIGN OPTIONS', 'ideo-themo'),

            )
        ),
        'js_view' => 'VcRowView'
    )
);

vc_map(array(
    'name' => __('Page section', 'ideo-themo'),
    'base' => 'vc_row',
    'weight' => 1000,
    'as_parent' => array('except' => 'vc_row,vc_row_inner'),
    'is_container' => true,
    'description' => __('Place content elements in customizable section', 'ideo-themo'),
    'icon' => 'icon-page-section',
    'show_settings_on_create' => false,
    'category' => __('Content', 'ideo-themo'),
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => __('ANCHOR', 'ideo-themo'),
            'param_name' => 'el_id',
            'value' => '',
            'description' => __('Enter Anchor ID if you want to link to this section.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_switcher',
            'heading' => __('FULLWIDTH CONTENT', 'ideo-themo'),
            'param_name' => 'el_fullwidth_content',
            'on' => 'true',
            'off' => 'false',
            'value' => 'false',
            'description' => __('Enable fullwidth section. When this option is turned On then the content placed in this section gets full width of browser window, if it is turned Off the content gets custom content width which is set in Customizer.</br><b>This option works only when Wide layout is in use.</b>', 'ideo-themo'),
        ),
        array(
            'type' => 'textfield',
            'heading' => __('MINIMUM SECTION HEIGHT', 'ideo-themo'),
            'param_name' => 'el_row_height',
            'value' => '',
            'description' => __('Define the minimum section height. By default the height of the section adapts to the content placed in it but using this option you can set stretch this section - even if there is not much content inside this section its height will not be lower than defined minimum height.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_switcher',
            'heading' => __('FULL SCREEN SECTION', 'ideo-themo'),
            'param_name' => 'el_full_height',
            'on' => 'true',
            'off' => 'false',
            'value' => 'false',
            'dependencies' => array('true' => array('el_content_center')),
            'description' => __('Enable the fullscreen section. Full screen section means that section height gets always 100% of browser window height. Full screen option override Minimum section height set above.', 'ideo-themo')
        ),
//		array(
//			'type' => 'ideo_switcher',
//			'heading' => __('CONTENT CENTER', 'ideo-themo') ,
//			'param_name' => 'el_content_center',
//			'on' => 'true',
//            'off' => 'false',
//            'std' => 'false',
//			'description' => __('Turn On or Off vertically centering. If it is turn On content gets exactly the same distance from the top and from the bottom section edges.', 'ideo-themo')
//		) ,	
        array(
            'type' => 'ideo_buttons',
            'heading' => __('FULL SCREEN OPTIONS', 'ideo-themo'),
            'param_name' => 'el_content_center',
            'value' => array(
                __('None', 'ideo-themo') => '',
                __('CENTERED CONTENT', 'ideo-themo') => 'centred_content',
                __('FULL HEIGHT COLUMN', 'ideo-themo') => 'full_height_column',
            ),
            'std' => '',
            'description' => __('Using this option you can control vertical position and heights of columns containers:<br>
<b>NONE</b> – this is a default setting, columns containers are placed at the top of the section and theirs heights adapts to the content placed in it;<br>
<b>CENTERED CONTENT</b> – columns containers are centered vertically and theirs height adapts to the content placed in it;<br>
<b>FULL HEIGHT COLUMNS</b> – columns containers are placed at the top of the section nad theirs heights cover the full height of the section container.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('BACKGROUND', 'ideo-themo'),
            'param_name' => 'el_background',
            'value' => array(
                __('None', 'ideo-themo') => '',
                __('Color', 'ideo-themo') => 'color',
                __('Image', 'ideo-themo') => 'image',
                __('Video', 'ideo-themo') => 'video'
            ),
            'dependencies' => array(
                'color' => array(
                    'el_background_color',
                    'el_background_color_pattern',
                    'el_background_color_pattern_color'
                ),
                'image' => array(
                    'el_background_image',
                    'el_background_position',
                    'el_background_repeat',
                    'el_background_size',
                    'el_background_image_pattern',
                    'el_background_image_pattern_color',
                    'el_background_motion',
                    'el_background_motion_speed'
                ),
                'video' => array(
                    'el_video_ytlink',
                    'el_video_vimeolink',
                    'el_video_mp4',
                    'el_video_webm',
                    'el_video_ogv',
                    'el_video_fallback_image',
                    'el_video_pattern',
                    'el_video_pattern_color',
                    'el_video_motion'
                )
            ),
            'std' => '',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Choose Color, Image or Video background type. Depending on which option you choose appropriate styling options will be available below.', 'ideo-themo')
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
            'type' => 'attach_image',
            'heading' => __('UPLOAD IMAGE', 'ideo-themo'),
            'param_name' => 'el_background_image',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'value' => array()
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
            'std' => 'left top',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Choose the background image position property to set the starting position of the image in relation to the section container.', 'ideo-themo')
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('BACKGROUND REPEAT', 'ideo-themo'),
            'param_name' => 'el_background_repeat',
            'value' => array(
                'repeat' => 'repeat',
                'repeat-x' => 'repeat-x',
                'repeat-y' => 'repeat-y',
                'no-repeat' => 'no-repeat'
            ),
            'std' => 'repeat',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Choose repeat property to set if/how the image will be repeated.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('YOUTUBE VIDEO', 'ideo-themo'),
            'param_name' => 'el_video_ytlink',
            'value' => '',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Enter YouTube link to load video directly from Youtube.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('VIMEO VIDEO', 'ideo-themo'),
            'param_name' => 'el_video_vimeolink',
            'value' => '',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Enter Vimeo link to load video directly from Vimeo.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('MP4 FORMAT', 'ideo-themo'),
            'param_name' => 'el_video_mp4',
            'value' => '',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Enter selfhosted video URL to load MP4 video from Media library. </br>!!! If you use selfhosted video we recommend to use both formats (MP4 and WebM) at the same time – you get guarantee that your video background will be properly displayed on every browser.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('WEBM FORMAT', 'ideo-themo'),
            'param_name' => 'el_video_webm',
            'value' => '',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Enter selfhosted video URL to load WebM video from Media library. </br>!!! If you use selfhosted video we recommend to use both formats (MP4 and WebM) at the same time – you get guarantee that your video background will be properly displayed on every browser.', 'ideo-themo')
        ),
        array(
            'type' => 'attach_image',
            'heading' => __('MOBILE IMAGE', 'ideo-themo'),
            'param_name' => 'el_video_fallback_image',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'value' => '',
            'description' => __('Upload the image which will be displayed on mobile devices instead of video.', 'ideo-themo'),
            'value' => array()
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('BACKGROUND MOTION', 'ideo-themo'),
            'param_name' => 'el_background_motion',
            'value' => array(
                'scroll' => 'scroll',
                'fixed' => 'fixed',
                'parallax' => 'parallax',
                'mousemove' => 'mousemove'
            ),
            'std' => 'scroll',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Choose one of predefined background image motions:</br>
			<b>Scroll</b> - the background image moves the same speed as scroll;</br>
			<b>Fixed</b> - the background image is static, fixed in relation to browser window;</br>
			<b>Parallax</b> - the background image moves at a different speed than scroll.', 'ideo-themo')
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('VIDEO MOTION', 'ideo-themo'),
            'param_name' => 'el_video_motion',
            'value' => array(
                'scroll' => 'scroll',
                'fixed' => 'fixed',
            ),
            'std' => 'scroll',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Choose one of predefined background image motions:
			<b>Scroll</b> - the video background moves the same speed as scroll;</br>
			<b>Fixed</b> - the video background is static, fixed in relation to browser window;</br>', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('MOVING SPEED', 'ideo-themo'),
            'param_name' => 'el_background_motion_speed',
            'min' => '-2',
            'max' => '2',
            'step' => '0.1',
            'value' => '0.3',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('This option works only if you set Parallax background motion. Using this option you can define the motion speed of the background image in relation to the scroll. You can set values from -2 to 2 (for 1 value the background image moves at the same speed as scroll).', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('BACKGROUND OVERLAY', 'ideo-themo'),
            'param_name' => 'el_background_overlay',
            'value' => array(
                __('none', 'ideo-themo') => '',
                __('pattern', 'ideo-themo') => 'pattern',
                __('color', 'ideo-themo') => 'color',
            ),
            'dependencies' => array(
                'pattern' => array(
                    'el_background_overlay_pattern',
                    'el_background_overlay_pattern_color'
                ),
                'color' => array(
                    'el_background_overlay_color'
                )
            ),
            'std' => '',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'description' => __('Choose Pattern or Color background overlay or choose None if you do not need any overlay. Depending on which option you choose appropriate settings will be available below.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_colorpicker',
            'heading' => __('BACKGROUND OVERLAY COLOR', 'ideo-themo'),
            'param_name' => 'el_background_overlay_color',
            'group' => __('BACKGROUND', 'ideo-themo'),
            'std' => '',
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
        array(
            'type' => 'ideo_dropdown',
            'heading' => __('TOP SEPARATOR', 'ideo-themo'),
            'param_name' => 'el_top_separator',
            'value' => array_merge(array(__('None', 'ideo-themo') => ''), ideothemo_get_separators('top', true)),
            'dependencies' => array(
                'all' => array(
                    'el_top_separator_color1',
                    'el_top_separator_color2'
                )
            ),
            'std' => '',
            'group' => __('SEPARATORS', 'ideo-themo'),
            'description' => __('Choose one of predefined top separators. Each top separator has its counterpart at the bottom but you can also use different separator for top and bottom of the section.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_colorpicker',
            'heading' => __('SEPARATOR COLOR 1', 'ideo-themo'),
            'param_name' => 'el_top_separator_color1',
            'value' => '',
            'group' => __('SEPARATORS', 'ideo-themo'),
            'description' => __('Choose main color for top separator.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_colorpicker',
            'heading' => __('SEPARATOR COLOR 2', 'ideo-themo'),
            'param_name' => 'el_top_separator_color2',
            'value' => '',
            'group' => __('SEPARATORS', 'ideo-themo'),
            'description' => __('Choose second color for top separator.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_dropdown',
            'heading' => __('BOTTOM SEPARATOR', 'ideo-themo'),
            'param_name' => 'el_bottom_separator',
            'value' => array_merge(array(__('None', 'ideo-themo') => ''), ideothemo_get_separators('bottom', true)),
            'dependencies' => array(
                'all' => array(
                    'el_bottom_separator_color1',
                    'el_bottom_separator_color2'
                )
            ),
            'std' => '',
            'group' => __('SEPARATORS', 'ideo-themo'),
            'description' => __('Choose one of predefined bottom separators. Each bottom separator has its counterpart at the top but you can also use different separator for top and bottom of the section.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_colorpicker',
            'heading' => __('SEPARATOR COLOR 1', 'ideo-themo'),
            'param_name' => 'el_bottom_separator_color1',
            'value' => '',
            'group' => __('SEPARATORS', 'ideo-themo'),
            'description' => __('Choose main color for bottom separator.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_colorpicker',
            'heading' => __('SEPARATOR COLOR 2', 'ideo-themo'),
            'param_name' => 'el_bottom_separator_color2',
            'value' => '',
            'group' => __('SEPARATORS', 'ideo-themo'),
            'description' => __('Choose second color for bottom separator.', 'ideo-themo')
        ),
        /*array(
            'type' => 'dropdown',
            'heading' => __('VISABILLITY', 'ideo-themo') ,
            'param_name' => 'el_visabillity',
            'value' => array(
                __('display on all devices', 'ideo-themo') => '',
                __('only desktop', 'ideo-themo') => 'desktop-only',
                __('only mobile', 'ideo-themo') => 'mobile-only'
            ) ,
            'std' => '',
            'description' => __('Decide on which devices section will be dispalyed. This option gives you abillity to build different content and design for desktop devices and different for mobile devices.', 'ideo-themo')
        ),*/

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
                    'el_animation_row_name'
                )
            ),
            'description' => __('Choose between Viewport and Parallax Composer animations or choose None if you do not want to animate shortcode. </br>If you choose <b>Viewport animation</b> two additional animation options will be available below. </br>If you choose <b>Parallax Composer</b> the section will be automatically added to the Parallax Composer.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('ROW NAME', 'ideo-themo'),
            'param_name' => 'el_animation_row_name',
            'group' => __('ANIMATION', 'ideo-themo'),
            'value' => '',
            'description' => __('Enter section name which will be used as a section label in Parallax Composer.', 'ideo-themo'),
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
            'group' => __('ANIMATION', 'ideo-themo')
        ),
        array(
            'type' => 'css_editor',
            'heading' => __('CSS', 'ideo-themo'),
            'param_name' => 'css',
            'group' => __('DESIGN OPTIONS', 'ideo-themo'),
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Z INDEX', 'ideo-themo'),
            'param_name' => 'el_z_index',
            'value' => '',
            'group' => __('DESIGN OPTIONS', 'ideo-themo'),
        ),
        array(
            'type' => 'ideo_switcher',
            'heading' => __('Large devices displaying (1200px and up)', 'ideo-themo'),
            'param_name' => 'el_rwd_lg',
            'on' => 'true',
            'off' => 'false',
            'value' => 'true',
            'group' => __('DESIGN OPTIONS', 'ideo-themo'),

        ),
        array(
            'type' => 'ideo_switcher',
            'heading' => __('Medium devices displaying (992-1199px)', 'ideo-themo'),
            'param_name' => 'el_rwd_md',
            'on' => 'true',
            'off' => 'false',
            'value' => 'true',
            'group' => __('DESIGN OPTIONS', 'ideo-themo'),

        ),
        array(
            'type' => 'ideo_switcher',
            'heading' => __('Small devices displaying (768-991px)', 'ideo-themo'),
            'param_name' => 'el_rwd_sm',
            'on' => 'true',
            'off' => 'false',
            'value' => 'true',
            'group' => __('DESIGN OPTIONS', 'ideo-themo'),

        ),
        array(
            'type' => 'ideo_switcher',
            'heading' => __('Extra small devices displaying (less than 768px)', 'ideo-themo'),
            'param_name' => 'el_rwd_xs',
            'on' => 'true',
            'off' => 'false',
            'value' => 'true',
            'group' => __('DESIGN OPTIONS', 'ideo-themo'),

        )

    ),
    'js_view' => 'VcPageSectionView'
));
