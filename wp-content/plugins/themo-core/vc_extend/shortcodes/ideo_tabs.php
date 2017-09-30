<?php

vc_map(array(
    'name' => __('Tabs', 'ideo-themo'),
    'base' => 'vc_tta_tabs',
    'is_container' => true,
    'icon' => 'icon-tabs',
    'category' => __('Content', 'ideo-themo'),
    'description' => __('Tabbed content area', 'ideo-themo'),
    'weight' => 73,
    'params' => array(

        array(
            'type' => 'ideo_buttons',
            'heading' => __('ELEMENT TYPE', 'ideo-themo'),
            'param_name' => 'el_type',
            'value' => array(
                __('horizontal', 'ideo-themo') => 'horizontal',
                __('vertical', 'ideo-themo') => 'vertical'
            ),
            'dependencies' => array(
                'horizontal' => array('el_title_boxes_width'),
                'vertical' => array('el_title_tabs_width')
            ),
            'std' => 'horizontal',
            'description' => __('Choose Horizontal or Vertical tabs type.', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_buttons',
            'heading' => __('TITLE BOXES WIDTH', 'ideo-themo'),
            'param_name' => 'el_title_boxes_width',
            'value' => array(
                __('Standard', 'ideo-themo') => '',
                __('Full width', 'ideo-themo') => 'fullwidth'
            ),
            'std' => '',
            'description' => __('Choose title boxes width. Standard means that single title box width adapt to title text lenght. Full width means that all title boxes width are equal and summed to 100% of shortcode width (egg. if you have 5 tabs, each of them gets 20% of shortcode width).', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_slider',
            'heading' => __('TITLE TABS WIDTH (%)', 'ideo-themo'),
            'param_name' => 'el_title_tabs_width',
            'min' => '0',
            'max' => '100',
            'value' => '25',
            'description' => __('Define width of title boxes in percentages.', 'ideo-themo')
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
            'std' => ideothemo_get_shortcodes_default_style('ideo_tabs'),
            'colors' => ideothemo_get_colors(),
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
                    'title_color' => __('ACTIVE TAB TITLE & ICON COLOR', 'ideo-themo'),
                    'active_title_border_color' => __('ACTIVE TAB BORDER TOP COLOR', 'ideo-themo'),
                    'inactive_title_background_color' => __('INACTIVE TABS BACKGROUND COLOR', 'ideo-themo'),
                    'inactive_section_title_color' => __('INACTIVE TITLE & ICON COLOR', 'ideo-themo'),
                    'border_bottom_block_color' => __('ELEMENT BORDER COLOR', 'ideo-themo'),
                ),
                'transparent' => array(
                    'title_color' => __('ACTIVE TITLE & ICON COLOR', 'ideo-themo'),
                    'inactive_section_title_color' => __('INACTIVE TAB TITLE & ICON COLOR', 'ideo-themo'),
                    'active_title_border_color' => __('ACTIVE TAB BORDER TOP COLOR', 'ideo-themo'),
                    'title_borders_color' => __('TITLE BORDERS COLOR', 'ideo-themo'),
                    'border_bottom_block_color' => __('BORDER BOTTOM COLOR', 'ideo-themo'),
                )
            ),
            'value' => '',
            'group' => __('STYLING', 'ideo-themo')
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
                'viewport' => array('el_animation_type', 'el_animation_delay', 'el_animation_duration', 'el_animation_offset')
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
            'group' => __('ANIMATION', 'ideo-themo')
        )

    ),
    'js_view' => 'VcBackendTtaTabsView',
    'custom_markup' => '
<div class="vc_tta-container" data-vc-action="collapse">
	<div class="vc_general vc_tta vc_tta-tabs vc_tta-color-backend-tabs-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-spacing-1 vc_tta-tabs-position-top vc_tta-controls-align-left">
		<div class="vc_tta-tabs-container">'
        . '<ul class="vc_tta-tabs-list">'
        . '<li class="vc_tta-tab" data-vc-tab data-vc-target-model-id="{{ model_id }}" data-element_type="vc_tta_section"><a href="javascript:;" data-vc-tabs data-vc-container=".vc_tta" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-target-model-id="{{ model_id }}"><span class="vc_tta-title-text">{{ section_title }}</span></a></li>'
        . '</ul>
		</div>
		<div class="vc_tta-panels vc_clearfix {{container-class}}">
		  {{ content }}
		</div>
	</div>
</div>',
    'default_content' => '
        [vc_tta_section title="' . sprintf('%s %d', __('Tab', 'js_composer'), 1) . '" el_uid="' . ideothemo_shortcode_uid() . '"][/vc_tta_section]
        [vc_tta_section title="' . sprintf('%s %d', __('Tab', 'js_composer'), 2) . '" el_uid="' . ideothemo_shortcode_uid() . '"][/vc_tta_section]
	',
    'admin_enqueue_js' => array(
        vc_asset_url('lib/vc_tabs/vc-tabs.min.js'),
    )
));

$el_type = $el_title_boxes_width = $el_title_tabs_width = $el_margin_top = $el_margin_bottom = $el_extra_class = $el_custom_css = $el_elemnt_style = $el_elemnt_style_overwrite = $el_elemnt_style_colors = $el_animation = $el_animation_type = $el_animation_delay = $el_animation_duration = $el_animation_offset = $el_uid = '';

//WPBakeryShortCode_VC_Tta_Section::$self_count = 0;

function ideothemo_tabs_func($atts, $content = "")
{

    ideothemo_tab_counter('reset');

    
    extract(shortcode_atts(array(
        'el_type' => 'horizontal',
        'el_title_boxes_width' => '',
        'el_title_tabs_width' => '25',
        'el_margin_top' => '20',
        'el_margin_bottom' => '20',
        'el_extra_class' => '',
        'el_custom_css' => '',
        'el_elemnt_style' => ideothemo_get_shortcodes_default_style('ideo_tabs'),
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


    $less = '#tabs_' . $el_uid . ', #tabs_' . $el_uid . '_2{';

    if ($el_margin_top != '') {
        $less .= 'margin-top:' . (int)$el_margin_top . 'px;';
    }
    if ($el_margin_bottom != '') {
        $less .= 'margin-bottom:' . (int)$el_margin_bottom . 'px;';
    }


    if ($el_type == 'vertical' && $el_title_tabs_width) {
        $less .= '&.container-tabs.vertical .nav-tabs{ width:' . (int)$el_title_tabs_width . '%;}';
        $less .= '&.container-tabs.vertical .tab-content{ width:' . (100 - (int)$el_title_tabs_width) . '%;}';
    }
    $less .= '}';

    /* ===   custom style   ==== */
    $colors = ideothemo_get_colors_by_style($el_elemnt_style);
    $default_vars = array(
        'colored' => array(
            'title_color' => 'undefined',
            'inactive_section_title_color' => 'undefined',
            'background_color' => 'undefined',
            'inactive_title_background_color' => 'undefined',
            'active_title_border_color' => 'undefined',
            'border_bottom_block_color' => 'undefined'
        ),
        'transparent' => array(
            'title_color' => 'undefined',
            'inactive_section_title_color' => 'undefined',
            'active_title_border_color' => 'undefined',
            'title_borders_color' => 'undefined',
            'border_bottom_block_color' => 'undefined'
        )
    );

    $html .= ideothemo_custom_style('tabs', $el_uid, $default_vars, $el_elemnt_style, $el_elemnt_style_colors, $less);
    /* ===   end custom style   ==== */

    preg_match_all('/vc_tta_section([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE);
    $tab_titles = array();

    if (isset($matches[1])) {
        $tab_titles = $matches[1];
    }

    $tabs_nav = '';
    $active = '';
    $tabs_nav .= '<ul class="nav nav-tabs" role="tablist" >';
    foreach ($tab_titles as $key => $tab) {
        $tab_atts = shortcode_parse_atts($tab[0]);
        if ($key == 0) {
            $active = (isset($tab_atts['el_uid']) ? $tab_atts['el_uid'] : sanitize_title($tab_atts['title']));
        }

        if (isset($tab_atts['title'])) {
            $icon = '';
            if (isset($tab_atts['el_icon_display']) && $tab_atts['el_icon_display'] == 'true') {
                $icon = '<span class="icon"><i class="' . esc_attr(isset($tab_atts['el_icon']) ? $tab_atts['el_icon'] : 'fa fa-check-circle') . '"></i></span>';
            }

            $tabs_nav .= '<li' . ($key == 0 ? ' class="active"' : '') . ' ><a href="#tab_' . esc_attr(isset($tab_atts['el_uid']) ? $tab_atts['el_uid'] : sanitize_title($tab_atts['title'])) . '" role="tab" data-toggle="tab" >' . $icon . '<span class="title">' . esc_html($tab_atts['title']) . '</span></a></li>';
        }
    }


    $tabs_nav .= '</ul>' . "\n";

    $html .= '<div class="container-tabs ' . esc_attr($el_extra_class) . ' ' . esc_attr($el_type) . ' ' . esc_attr($el_title_boxes_width) . ' ' . esc_attr($el_elemnt_style) . ' vc-layer" id="tabs_' . esc_attr($el_uid) . '" data-id="tabs_' . esc_attr($el_uid) . '" ' . $data . '>';

    $html .= $tabs_nav;

    $html .= '<div class="tab-content">';
    $html .= do_shortcode($content);
    $html .= '<span class="tabs-line"></span>';
    $html .= '</div>';

    $html .= '</div>';

    

    return $html;
}

add_shortcode('vc_tta_tabs', 'ideothemo_tabs_func');