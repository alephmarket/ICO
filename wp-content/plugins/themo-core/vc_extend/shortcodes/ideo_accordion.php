<?php

class WPBakeryShortCode_Accordion extends WPBakeryShortCode
{
}

vc_map(array(
    'name' => __('ACCORDION / TOGGLE', 'ideo-themo'),
    'base' => 'vc_accordion',
    'is_container' => true,
    'icon' => 'icon-accordions',
    'category' => __('Content', 'ideo-themo'),
    'description' => __('Collapsible content panels', 'ideo-themo'),
    'weight' => 94,
    'params' => array(
        array(
            'type' => 'ideo_buttons',
            'heading' => __('ELEMENT TYPE', 'ideo-themo'),
            'param_name' => 'el_collapse_type',
            'value' => array(
                __('Accordion', 'ideo-themo') => 'one',
                __('Toggle', 'ideo-themo') => 'all'
            ),
            'dependencies' => array(
                'one' => array(
                    'el_open_hover'
                )
            ),
            'std' => 'one',
            'description' => __('Accordion type means that only one section can be open at the time; Toggle type means that multiple sections can be open at the time.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_switcher',
            'heading' => __('OPEN ON HOVER', 'ideo-themo'),
            'param_name' => 'el_open_hover',
            'on' => 'true',
            'off' => 'false',
            'value' => 'false',
            'description' => __('Turn On this option if you want to open each section on hover instead of click.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('ACTIVE SECTION', 'ideo-themo'),
            'param_name' => 'el_open_item',
            'value' => '1',
            'description' => __('Enter number of section which should be active (open) on load initialy or enter 0 to collapse all sections on load.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('ACCORDIONS SIZE', 'ideo-themo'),
            'param_name' => 'el_size',
            'value' => array(
                __('Small', 'ideo-themo') => 'small',
                __('Medium', 'ideo-themo') => 'medium',
                __('Big', 'ideo-themo') => 'big'
            ),
            'std' => 'medium',
            'description' => __('', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_switcher',
            'heading' => __('SPACE BETWEEN PANELS (Colored)', 'ideo-themo'),
            'param_name' => 'el_space',
            'on' => 'true',
            'off' => 'false',
            'value' => 'false',
            'description' => __('Add space between panels. It works only with colored skins.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('MARGIN TOP (px)', 'ideo-themo'),
            'param_name' => 'el_margin_top',
            'min' => '0',
            'max' => '200',
            'value' => '20',
            'description' => __('Define in pixels element margin-top.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('MARGIN BOTTOM (px)', 'ideo-themo'),
            'param_name' => 'el_margin_bottom',
            'min' => '0',
            'max' => '200',
            'value' => '20',
            'description' => __('Define in pixels element margin-top.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('EXTRA CLASS NAME', 'ideo-themo'),
            'param_name' => 'el_extra_class',
            'value' => '',
            'description' => __('Type in extra css class for the element, so you can refer to it in css file.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_dropdown',
            'heading' => __('ELEMENT STYLE', 'ideo-themo'),
            'param_name' => 'el_elemnt_style',
            'value' => array(
                'Colored dark' => 'colored-dark',
                'Colored light' => 'colored-light',
                'Transparent dark' => 'transparent-dark',
                'Transparent light' => 'transparent-light',
            ),
            'colors' => ideothemo_get_colors(),
            'std' => ideothemo_get_shortcodes_default_style('ideo_accordion'),
            'description' => __('Choose element style. Depending of which option you choose several colorpickers will be displayed below.', 'ideo-themo'),
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
                    'title_background_color' => __('SECTION TITLE BACKGROUND COLOR'),
                    'title_color' => __('SECTION TITLE TEXT COLOR', 'ideo-themo', 'ideo-themo'),                    
                    'active_section_background_color' => __('ACTIVE SECTION TITLE BACKGROUND COLOR', 'ideo-themo'),
                    'active_section_title_color' => __('ACTIVE SECTION TITLE TEXT COLOR', 'ideo-themo'),
                    'sections_separators_color' => __('BORDERS COLOR', 'ideo-themo'),
                ),
                'transparent' => array(
                    'title_color' => __('SECTION TITLE TEXT COLOR', 'ideo-themo'),
                    'active_section_title_color' => __('ACTIVE SECTION TITLE TEXT COLOR', 'ideo-themo'),
                    'active_section_border_top_color' => __('ACTIVE SECTION BORDER TOP COLOR', 'ideo-themo'),
                    'sections_separators_color' => __('BORDERS COLOR', 'ideo-themo'),
                )
            ),
            'value' => '',
            'description' => __('Define colors for chosen style & skin.', 'ideo-themo'),
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
                'viewport' => array(
                    'el_animation_type', 'el_animation_delay', 'el_animation_duration', 'el_animation_offset'
                )
            ),
            'std' => '',
            'description' => __('Choose between Viewport animation or choose None if you don’t want to animate shortcode. If you choose Viewport animation two additional animation options will be available.', 'ideo-themo'),
            'group' => __('ANIMATION', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_animation_type',
            'heading' => __('ANIMATION TYPE', 'ideo-themo'),
            'param_name' => 'el_animation_type',
            'group' => __('ANIMATION', 'ideo-themo'),
            'value' => ideothemo_get_animate_viewport(),
            'description' => __('Choose one of viewport animation types.', 'ideo-themo'),
            'group' => __('ANIMATION', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('ANIMATION DELAY', 'ideo-themo'),
            'param_name' => 'el_animation_delay',
            'min' => '0',
            'max' => '5000',
            'value' => '500',
            'description' => __('Define in ms viewport animation delay.', 'ideo-themo'),
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
            'description' => __('This is inactive field where you can see unique Parallax Composer ID generated for this shortcode.', 'ideo-themo'),
            'group' => __('ANIMATION', 'ideo-themo')
        )
    ),
    'custom_markup' => '
        <div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">
        %content%
        </div>
        <div class="tab_controls">
            <a class="add_tab" title="' . __('Add section', 'ideo-themo') . '"><span class="vc_icon"></span> <span class="tab-label">' . __('Add section', 'ideo-themo') . '</span></a>
        </div>
',
    'default_content' => '
        [vc_accordion_tab title="' . __('Section 1', 'ideo-themo') . '"][/vc_accordion_tab]
        [vc_accordion_tab title="' . __('Section 2', 'ideo-themo') . '"][/vc_accordion_tab]
    ',
    'js_view' => 'VcAccordionView'
));
$el_collapse_type = $el_open_hover = $el_active = $el_open_item = $el_margin_top = $el_margin_bottom = $el_extra_class = $el_custom_css = $el_elemnt_style = $el_elemnt_style_overwrite = $el_elemnt_style_colors = $el_blur = $el_animation = $el_animation_type = $el_animation_delay = $el_animation_duration = $el_animation_offset = $el_uid = '';

function ideothemo_accordion_func($atts, $content = "")
{
    
    extract(shortcode_atts(array(
        'el_active' => '',
        'el_collapse_type' => 'one',
        'el_open_hover' => 'false',
        'el_open_item' => '1',
        'el_size' => 'medium',
        'el_space' => 'false',
        'el_margin_top' => '20',
        'el_margin_bottom' => '20',
        'el_extra_class' => '',
        'el_custom_css' => '',
        'el_elemnt_style' => ideothemo_get_shortcodes_default_style('ideo_accordion'),
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
    if ($el_collapse_type === 'one' && $el_open_hover === 'true') $data .= ' data-open-hover="true"';


    $less = '#accordion_' . $el_uid . ', #accordion_' . $el_uid . '_2{';
    if ($el_margin_top != '') {
        $less .= 'margin-top:' . (int)$el_margin_top . 'px;';
    }

    if ($el_margin_bottom != '') {
        $less .= 'margin-bottom:' . (int)$el_margin_bottom . 'px;';
    }

    if ($el_custom_css) {
        $less .= $el_custom_css;
    }
    
    if ($el_space == 'true'){
        $less .= '&.panel-group .panel + .panel{';
        $less .= 'margin-top: 0.5em !important;';  
        $less .= 'border-bottom: solid 1px transparent !important;';
        $less .= '}';
        $less .= '&.panel-group .panel {';
        $less .= 'border-bottom: solid 1px transparent !important;';
        $less .= '}';
    }
    $less .= '}';
    
    
    /* ===   custom style   ==== */
    $colors = ideothemo_get_colors_by_style($el_elemnt_style);
    $default_vars = array(
        'colored' => array(
            'background_color' => 'undefined',
            'title_background_color' => 'undefined',
            'title_color' => 'undefined',
            'active_section_title_color' => 'undefined',
            'active_section_background_color' => 'undefined',
            'sections_separators_color' => 'undefined',
        ),
        'transparent' => array(
            'title_color' => 'undefined',
            'active_section_title_color' => 'undefined',
            'sections_separators_color' => 'undefined',
            'active_section_border_top_color' => 'undefined',
        )
    );

    $html .= ideothemo_custom_style('accordion', $el_uid, $default_vars, $el_elemnt_style, $el_elemnt_style_colors, $less);
    /* ===   end custom style   ==== */


    $content = str_replace('[vc_accordion_tab', '[vc_accordion_tab id="' . $el_uid . '" type="' . $el_collapse_type . '"', $content);
    if ($el_animation == 'parallax') {
        $html .= '<div class="vc-placeholder">';
    }

    $html .= '<div class="panel-group accordion ' . esc_attr($el_elemnt_style) . ' ' . esc_attr($el_size) . ' vc-layer" id="accordion_' . esc_attr($el_uid) . '" data-id="accordion_' . esc_attr($el_uid) . '" ' . $data . ' data-open-item="' .  esc_attr($el_open_item) . '" >' . do_shortcode($content) . '</div>';
    if ($el_animation == 'parallax') {
        $html .= '</div>';
    }

    

    return $html;
}

add_shortcode('vc_accordion', 'ideothemo_accordion_func');

function ideothemo_accordion_tab_func($atts, $content = "")
{
    $id = ideothemo_shortcode_uid();
    $html = '<div class="panel panel-default vc-layer-child">
                        <div class="panel-heading ">
                          <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" ' . (isset($atts['type']) && $atts['type'] == 'one' ? 'data-parent="#accordion_' . $atts['id'] . '" ' : '') . ' href="#collapse-' .  esc_attr($id) . '" >
                              ' . (isset($atts['title']) ? $atts['title'] : __('Section', 'ideo-themo')) . '
                            </a>
                          </h4>
                        </div>
                        <div id="collapse-' .  esc_attr($id) . '" class="panel-collapse collapse">
                          <div class="panel-body">
                          	' . do_shortcode($content) . '
                          </div>
                        </div>
                      </div>';
    return $html;
}

add_shortcode('vc_accordion_tab', 'ideothemo_accordion_tab_func');