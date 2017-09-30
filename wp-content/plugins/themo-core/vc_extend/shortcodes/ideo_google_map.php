<?php
vc_map(array(
    'name' => __('Google map', 'ideo-themo'),
    'base' => 'ideo_google_map',
    'icon' => 'icon-google-maps',
    'category' => __('Content', 'ideo-themo'),
    'description' => __('Advanced and customizable Google Map.', 'ideo-themo'),
    'weight' => 84,
    'params' => array(

        array(
            'type' => 'ideo_info',
            'heading' => __('KEY INFO', 'ideo-themo'), 
            'param_name' => 'key_info',
            'text' =>  __('According to Google requirements, to use Google maps you have to generate Google API Key and paste it into Google API textfield in Customizer (Generals/Advanced section). For more details see online documentation.', 'ideo-themo')            
        ),        
        array(
            'type' => 'textfield',
            'heading' => __('ADDRESS 1 (TOOLTIP)', 'ideo-themo'),
            'admin_label' => true,
            'param_name' => 'el_address_1_text',
            'value' => '',
            'description' => __('Enter the first address which will be displayed in tooltip over the first map marker.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('ADDRESS 1 (LATITUDE)', 'ideo-themo'),
            'param_name' => 'el_address_1_lat',
            'value' => '',
            'description' => __('Enter latitude for the first address marker.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('ADDRESS 1 (LONGITUDE)', 'ideo-themo'),
            'param_name' => 'el_address_1_lng',
            'value' => '',
            'description' => __('Enter longitude for the first address marker.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('ADDRESS 2 (TOOLTIP)', 'ideo-themo'),
            'param_name' => 'el_address_2_text',
            'value' => '',
            'description' => __('Enter the second address which will be displayed in tooltip over the second map marker.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('ADDRESS 2 (LATITUDE)', 'ideo-themo'),
            'param_name' => 'el_address_2_lat',
            'value' => '',
            'description' => __('Enter latitude for the second address marker.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('ADDRESS 2 (LONGITUDE)', 'ideo-themo'),
            'param_name' => 'el_address_2_lng',
            'value' => '',
            'description' => __('Enter longitude for the second address marker.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('ADDRESS 3 (TOOLTIP)', 'ideo-themo'),
            'param_name' => 'el_address_3_text',
            'value' => '',
            'description' => __('Enter the third address which will be displayed in tooltip over the third map marker.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('ADDRESS 3 (LATITUDE)', 'ideo-themo'),
            'param_name' => 'el_address_3_lat',
            'value' => '',
            'description' => __('Enter latitude for the third address marker.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('ADDRESS 3 (LONGITUDE)', 'ideo-themo'),
            'param_name' => 'el_address_3_lng',
            'value' => '',
            'description' => __('Enter longitude for the third address marker.', 'ideo-themo')
        ),
        array(
            'type' => 'attach_image',
            'heading' => __('CUSTOM MARKER', 'ideo-themo'),
            'param_name' => 'el_custom_marker',
            'value' => '',
            'description' => __('Upload custom map marker or leave empty to display standard Google map marker.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('MAP HEIGHT', 'ideo-themo'),
            'param_name' => 'el_height',
            'min' => '50',
            'max' => '1000',
            'value' => '400',
            'description' => __('Define map height in pixels.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_switcher',
            'heading' => __('FULLSCREEN SIZE', 'ideo-themo'),
            'param_name' => 'el_full_size',
            'on' => 'true',
            'off' => 'false',
            'value' => 'false',
            'description' => __('Enable or disable fullscreen map – your Google map gets full height of browser window (this option override Map height setting).', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_slider',
            'heading' => __('MAP ZOOM', 'ideo-themo'),
            'param_name' => 'el_zoom',
            'min' => '1',
            'max' => '19',
            'value' => '14',
            'description' => __('Define zoom level for the map.', 'ideo-themo')
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('MAP TYPE', 'ideo-themo'),
            'param_name' => 'el_map_type',
            'value' => array(__('roadmap', 'ideo-themo') => 'roadmap', __('hybrid', 'ideo-themo') => 'hybrid', __('satellite', 'ideo-themo') => 'satellite', __('terrain', 'ideo-themo') => 'terrain'),
            'std' => 'roadmap',
            'description' => __('Choose one of google map types:</br><b>Road map</b> - displays the default road map view;</br><b>Satellite</b> - displays Google Earth satellite images;</br><b>Hybrid</b> - displays a mixture of normal and satellite views;</br><b>Terrain</b> - displays a physical map based on terrain information.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_switcher',
            'heading' => __('DRAGGABLE', 'ideo-themo'),
            'param_name' => 'el_dragable',
            'on' => 'true',
            'off' => 'false',
            'value' => 'true',
            'description' => __('Enable or disable map dragging function.', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_switcher',
            'heading' => __('HIDE CONTROLS', 'ideo-themo'),
            'param_name' => 'el_controls',
            'on' => 'true',
            'off' => 'false',
            'value' => 'true',
            'description' => __('By default all map controls are enabled. Using this option you can turn them off.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_switcher',
            'heading' => __('SCROLLWHEEL', 'ideo-themo'),
            'param_name' => 'el_scrollwheel',
            'on' => 'true',
            'off' => 'false',
            'value' => 'false',
            'description' => __('Enable or disable scrollwheel function which allows to zoom map while scrolling over the map.', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_switcher',
            'heading' => __('CUSTOM STYLING', 'ideo-themo'),
            'param_name' => 'el_custom_map_style',
            'on' => 'true',
            'off' => 'false',
            'value' => 'false',
            'dependencies' => array(
                'true' => array('el_hue', 'el_saturation', 'el_lightness')
            ),
            'description' => __('Turn On or Off custom styling options. If you turn it On appropriate styling options will be available below.', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_colorpicker',
            'heading' => __('CUSTOM COLOR (HUE)', 'ideo-themo'),
            'param_name' => 'el_hue',
            'value' => '',
            'description' => __('Choose map overlay color.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('SATURATION', 'ideo-themo'),
            'param_name' => 'el_saturation',
            'min' => '-100',
            'max' => '100',
            'value' => '0',
            'description' => __('Define overlay color saturation.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('LIGHTNESS', 'ideo-themo'),
            'param_name' => 'el_lightness',
            'min' => '-100',
            'max' => '100',
            'value' => '0',
            'description' => __('Define map lightness.', 'ideo-themo')
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
    'js_view' => 'VcGoogleMapView'
));

 $el_address_1_text = $el_address_1_lat = $el_address_1_lng = $el_address_2_text = $el_address_2_lat = $el_address_2_lng = $el_address_3_text = $el_address_3_lat = $el_address_3_lng = $el_custom_marker = $el_height = $el_full_size = $el_zoom = $el_map_type = $el_dragable = $el_scrollwheel = $el_controls = $el_custom_map_style = $el_hue = $el_saturation = $el_lightness = $el_margin_top = $el_margin_bottom = $el_extra_class = $el_animation = $el_animation_type = $el_animation_delay = $el_animation_duration = $el_animation_offset = $el_uid = '';

function ideothemo_google_map_func($atts, $content = "")
{
    
    extract(shortcode_atts(array(        
        'el_address_1_text' => '',
        'el_address_1_lat' => '',
        'el_address_1_lng' => '',
        'el_address_2_text' => '',
        'el_address_2_lat' => '',
        'el_address_2_lng' => '',
        'el_address_3_text' => '',
        'el_address_3_lat' => '',
        'el_address_3_lng' => '',
        'el_custom_marker' => '',
        'el_height' => '400',
        'el_full_size' => 'false',
        'el_zoom' => '14',
        'el_map_type' => 'roadmap',
        'el_dragable' => 'true',
        'el_controls' => 'true',
        'el_scrollwheel' => 'false',
        'el_custom_map_style' => 'false',
        'el_hue' => '',
        'el_saturation' => '0',
        'el_lightness' => '0',
        'el_margin_top' => '20',
        'el_margin_bottom' => '20',
        'el_extra_class' => '',
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

    $options = array('compress' => true);
    $parser = new Less_Parser($options);

    $less = '#ideo_google_map_' . $el_uid . '{';

    if ($el_margin_top != '') {
        $less .= 'margin-top:' . (int)$el_margin_top . 'px;';
    }
    if ($el_margin_bottom != '') {
        $less .= 'margin-bottom:' . (int)$el_margin_bottom . 'px;';
    }

    if ($el_full_size == 'true') {
        $less .= '   height:100%;';
    } else {
        $less .= '   height:' . (int)$el_height . 'px;';
    }
    $less .= '  .ideo-google-map-canvas{';
    if ($el_full_size == 'true') {
        $less .= '   height:100%;';
    } else {
        $less .= '   height:' . (int)$el_height . 'px;';
    }
    $less .= '  }';
    $less .= '}';

    /* ===   custom style   ==== */
    $html .= ideothemo_add_style($less, 'vc_shortcodes-custom-css');
    /* ===   end custom style   ==== */

    $icon = '';
    if ($el_custom_marker != '') {
        $icon = wp_get_attachment_image_src($el_custom_marker, 'full');
        $icon = $icon[0];
    }

    $data_json = array();

    if ($el_address_1_text != '' && $el_address_1_lat != '' && $el_address_1_lng != '') {
        $data_json[] = array('text' => $el_address_1_text, 'lat' => (float)$el_address_1_lat, 'lng' => (float)$el_address_1_lng);
    }
    if ($el_address_2_text != '' && $el_address_2_lat != '' && $el_address_2_lng != '') {
        $data_json[] = array('text' => $el_address_2_text, 'lat' => (float)$el_address_2_lat, 'lng' => (float)$el_address_2_lng);
    }
    if ($el_address_3_text != '' && $el_address_3_lat != '' && $el_address_3_lng != '') {
        $data_json[] = array('text' => $el_address_3_text, 'lat' => (float)$el_address_3_lat, 'lng' => (float)$el_address_3_lng);
    }
    $stylers = array();
    if ($el_custom_map_style && $el_hue != '') {
        $stylers = array('stylers' => array(array('hue' => $el_hue), array('saturation' => $el_saturation), array('lightness' => $el_lightness)));
    }

    $full_height_class = '';
    if ($el_full_size == 'true') {
        $full_height_class = ' full-screen-height';
    }
    

    $html .= '<div class="ideo-google-map vc-layer ' . esc_attr($el_extra_class) . '" id="ideo_google_map_' . esc_attr($el_uid) . '" data-id="ideo_google_map_' . esc_attr($el_uid) . '" ' . $data . '>';
    $html .= '<div class="ideo-google-map-canvas' . esc_attr($full_height_class) . '" data-zoom="' . esc_attr($el_zoom) . '" data-icon="' . esc_attr($icon) . '" data-markers="' . esc_html__(json_encode($data_json)) . '" data-stylers="' . esc_html__(json_encode($stylers)) . '" data-draggable="' . esc_attr($el_dragable). '" data-controls="' . esc_attr($el_controls) . '" data-scrollwheel="' . esc_attr($el_scrollwheel) . '" data-map-type="' . esc_attr($el_map_type) . '"></div>';
    $html .= '</div>';

    

    return $html;
}

add_shortcode('ideo_google_map', 'ideothemo_google_map_func');