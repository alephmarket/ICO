<?php
vc_map(array(
    'name' => __('Google map 2.0', 'ideo-themo'),
    'base' => 'ideo_google_map_v2',
    'icon' => 'icon-google-maps',
    'category' => __('Content', 'ideo-themo'),
    'description' => __('Advanced and customizable Google Map 2.0.', 'ideo-themo'),
    'weight' => 85,
    'params' => array(

        array(
            'type' => 'ideo_info',
            'heading' => __('Key info', 'ideo-themo'), 
            'param_name' => 'key_info',
            'text' =>  __('According to Google requirements, to use Google maps you have to generate Google API Key and paste it into Google API textfield in Customizer (Generals/Advanced section). For more details see online documentation.', 'ideo-themo')            
        ),
        
        array(
            'type' => 'ideo_switcher',
            'heading' => __('Custom bounds', 'ideo-themo'),
            'param_name' => 'el_bounds',
            'on' => 'true',
            'off' => 'false',
            'value' => 'false',
            'dependencies' => array(
                'true' => array('el_centermap', 'el_zoom')
            ),
            'description' => __('By default your map uses autocenter function. Enable this option if you want to customize zoom and center point for the map.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_google_locations_centermap',
            'heading' => __('Center point', 'ideo-themo'),
            'param_name' => 'el_centermap',
            'value' => '',
            'description' => __(' Choose one of added locations on which the map will be centered (this particular location will be displayed in the middle of the map).', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('Map zoom', 'ideo-themo'),
            'param_name' => 'el_zoom',
            'min' => '1',
            'max' => '19',
            'value' => '14',
            'description' => __('Define zoom level for the map.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_google_locations',
            'heading' => __('Locations', 'ideo-themo'),            
            'param_name' => 'el_locations',
            'value' => '',
            'description' => __('', 'ideo-themo')
        ),        
        array(
            'type' => 'attach_image',
            'heading' => __('Custom maker', 'ideo-themo'),
            'param_name' => 'el_custom_marker',
            'value' => '',
            'description' => __('Upload custom map marker or leave empty to display standard Google map marker.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('Map height', 'ideo-themo'),
            'param_name' => 'el_height',
            'min' => '50',
            'max' => '1000',
            'value' => '400',
            'description' => __('Define map height in pixels.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_switcher',
            'heading' => __('Fullscreen size', 'ideo-themo'),
            'param_name' => 'el_full_size',
            'on' => 'true',
            'off' => 'false',
            'value' => 'false',
            'description' => __('Enable or disable fullscreen map – your Google map gets full height of browser window (this option override Map height setting).', 'ideo-themo')
        ),

        
        array(
            'type' => 'dropdown',
            'heading' => __('Map type', 'ideo-themo'),
            'param_name' => 'el_map_type',
            'value' => array(__('roadmap', 'ideo-themo') => 'roadmap', __('hybrid', 'ideo-themo') => 'hybrid', __('satellite', 'ideo-themo') => 'satellite', __('terrain', 'ideo-themo') => 'terrain'),
            'std' => 'roadmap',
            'description' => __('Choose one of google map types:</br><b>Road map</b> - displays the default road map view;</br><b>Satellite</b> - displays Google Earth satellite images;</br><b>Hybrid</b> - displays a mixture of normal and satellite views;</br><b>Terrain</b> - displays a physical map based on terrain information.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_switcher',
            'heading' => __('Draggable', 'ideo-themo'),
            'param_name' => 'el_dragable',
            'on' => 'true',
            'off' => 'false',
            'value' => 'true',
            'description' => __('Enable or disable map dragging function.', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_switcher',
            'heading' => __('Hide controls', 'ideo-themo'),
            'param_name' => 'el_controls',
            'on' => 'true',
            'off' => 'false',
            'value' => 'true',
            'description' => __('By default all map controls are enabled. Using this option you can turn them off.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_switcher',
            'heading' => __('Scrollwheel', 'ideo-themo'),
            'param_name' => 'el_scrollwheel',
            'on' => 'true',
            'off' => 'false',
            'value' => 'false',
            'description' => __('Enable or disable scrollwheel function which allows to zoom map while scrolling over the map.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('Margin top (px)', 'ideo-themo'),
            'param_name' => 'el_margin_top',
            'min' => '0',
            'max' => '200',
            'value' => '20',
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('Margin bottom (px)', 'ideo-themo'),
            'param_name' => 'el_margin_bottom',
            'min' => '0',
            'max' => '200',
            'value' => '20',
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Extra class name', 'ideo-themo'),
            'param_name' => 'el_extra_class',
            'value' => '',
            'description' => __('Type in an extra class name for this particular element, so you can refer to that class in custom css.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_info',
            'heading' => __('Coloring info', 'ideo-themo'), 
            'param_name' => 'styling_info',
            'text' =>  __('In this tab you can choose map styling method:</br>
Default – default Google Map styling</br>
Simple – you can set Hue color, Lightness and Saturation for the map</br>
Advanced – allows you to customize colors for each element on the map separately.', 'ideo-themo'),   
            'group' => __('COLORING', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('Coloring method', 'ideo-themo'),
            'param_name' => 'el_custom_map_style',
            'value' => array(
                __('Default', 'ideo-themo') => '',
                __('Simple', 'ideo-themo') => 'simple',
                __('Advanced', 'ideo-themo') => 'advanced',
            ),
            'dependencies' => array(
                'simple' => array('el_hue', 'el_saturation', 'el_lightness'),
                'advanced' => array('el_style', 'el_coloring_info')
            ),
            'std' => '',
            'group' => __('COLORING', 'ideo-themo')
        ),        
        array(
            'type' => 'ideo_colorpicker',
            'heading' => __('Custom color (HUE)', 'ideo-themo'),
            'param_name' => 'el_hue',
            'value' => '',
            'description' => __('Choose map overlay color.', 'ideo-themo'),
            'group' => __('COLORING', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('Saturation', 'ideo-themo'),
            'param_name' => 'el_saturation',
            'min' => '-100',
            'max' => '100',
            'value' => '0',
            'description' => __('Define overlay color saturation.', 'ideo-themo'),
            'group' => __('COLORING', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('Lightness', 'ideo-themo'),
            'param_name' => 'el_lightness',
            'min' => '-100',
            'max' => '100',
            'value' => '0',
            'description' => __('Define map lightness.', 'ideo-themo'),
            'group' => __('COLORING', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_info',
            'heading' => __('Advanced coloring info', 'ideo-themo'), 
            'param_name' => 'el_coloring_info',
            'text' =>  __('In filed below you can paste Custom JS code for map coloring. You can create your own JS style but you can also use one of dozens of predefined, free styling examples from <a href="https://snazzymaps.com/" target="_blank">https://snazzymaps.com/</a>. To use SnazzyMaps simply choose the map style you like, copy its code and paste into textfield below. Then you can customize the map specifically to your needs by changing colors, lightness and other settings for particular elements on the map. It is very easy and effect is splendid.', 'ideo-themo'),
            'group' => __('COLORING', 'ideo-themo')
        ),
        array(
            'type' => 'textarea',
            'heading' => __('Map coloring code', 'ideo-themo'),
            'param_name' => 'el_style',
            'value' => '',
            'group' => __('COLORING', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('Animation', 'ideo-themo'),
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
            'heading' => __('Animation type', 'ideo-themo'),
            'param_name' => 'el_animation_type',
            'group' => __('ANIMATION', 'ideo-themo'),
            'value' => ideothemo_get_animate_viewport(),
            'description' => __('Choose one of predefined animations.', 'ideo-themo'),
            'group' => __('ANIMATION', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('Animation delay', 'ideo-themo'),
            'param_name' => 'el_animation_delay',
            'min' => '0',
            'max' => '5000',
            'value' => '500',
            'description' => __('Define animation delay in ms.', 'ideo-themo'),
            'group' => __('ANIMATION', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('Animation duration', 'ideo-themo'),
            'param_name' => 'el_animation_duration',
            'min' => '0',
            'max' => '5000',
            'value' => '500',
            'description' => __('Define animation duration in ms.', 'ideo-themo'),
            'group' => __('ANIMATION', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('Animation offset', 'ideo-themo'),
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

$el_centermap = $el_style = $el_style_type = $el_bounds = $el_locations = $el_address_1_text = $el_address_1_lat = $el_address_1_lng = $el_address_2_text = $el_address_2_lat = $el_address_2_lng = $el_address_3_text = $el_address_3_lat = $el_address_3_lng = $el_custom_marker = $el_height = $el_full_size = $el_zoom = $el_map_type = $el_dragable = $el_scrollwheel = $el_controls = $el_custom_map_style = $el_hue = $el_saturation = $el_lightness = $el_margin_top = $el_margin_bottom = $el_extra_class = $el_animation = $el_animation_type = $el_animation_delay = $el_animation_duration = $el_animation_offset = $el_uid = '';

function ideothemo_google_map_v2_func($atts, $content = "")
{
    
    extract(shortcode_atts(array(
        'el_bounds' => 'false',       
        'el_centermap' => 0,       
        'el_locations' => '',       
        'el_custom_marker' => '',
        'el_height' => '400',
        'el_full_size' => 'false',
        'el_zoom' => '14',
        'el_map_type' => 'roadmap',
        'el_dragable' => 'true',
        'el_controls' => 'true',
        'el_scrollwheel' => 'false',
        'el_custom_map_style' => 'none',        
        'el_style' => '',
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

    
    
    $data_style = '';
    if ($el_custom_map_style == 'simple' && $el_hue != '') {
        $data_style = ' data-stylers="' .esc_html__(json_encode(array('stylers' => array(array('hue' => $el_hue), array('saturation' => $el_saturation), array('lightness' => $el_lightness))))) .'"';
    }
    
    if ($el_custom_map_style == 'advanced' && $el_style != '') {
        
        $data_style = ' data-style-array="' . esc_html__(json_encode(json_decode(str_replace('{{','[{',str_replace('}}','}]',preg_replace('/\'/i','"',preg_replace('/`/i','',preg_replace('/``/i','"',$el_style))))), true))) .'"';
    }

    $full_height_class = '';
    if ($el_full_size == 'true') {
        $full_height_class = ' full-screen-height';
    }
    $data_json = array();
    if($el_locations){
        $locations = json_decode(str_replace('{{','[{',str_replace('}}','}]',preg_replace('/\'/i','"',preg_replace('/`/i','',$el_locations)))), true);
        if(is_array($locations) && $locations){
           $data_json = array_merge($data_json, $locations);
        }
    }

    $html .= '<div class="ideo-google-map vc-layer ' . esc_attr($el_extra_class) . '" id="ideo_google_map_' . esc_attr($el_uid) . '" data-id="ideo_google_map_' . esc_attr($el_uid) . '" ' . $data . '>';
    $html .= '<div class="ideo-google-map-canvas' . esc_attr($full_height_class) . '" data-zoom="' . esc_attr($el_zoom) . '" data-icon="' . esc_attr($icon) . '" data-bounds="' . esc_attr($el_bounds) . '" data-centermap="' . (int)($el_centermap) . '" data-markers="' . esc_html__(json_encode($data_json)) . '" ' . $data_style . ' data-draggable="' . esc_attr($el_dragable). '" data-controls="' . esc_attr($el_controls) . '" data-scrollwheel="' . esc_attr($el_scrollwheel) . '" data-map-type="' . esc_attr($el_map_type) . '"></div>';
    $html .= '</div>';

    

    return $html;
}

add_shortcode('ideo_google_map_v2', 'ideothemo_google_map_v2_func');