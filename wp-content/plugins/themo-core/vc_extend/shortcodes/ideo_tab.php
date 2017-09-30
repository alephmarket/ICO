<?php

vc_map(array(
    'name' => __('Section', 'js_composer'),
    'base' => 'vc_tta_section',
    'icon' => 'icon-wpb-ui-tta-section',
    'allowed_container_element' => 'vc_row',
    'is_container' => true,
    'show_settings_on_create' => false,
    'as_child' => array(
        'only' => 'vc_tta_tour,vc_tta_tabs,vc_tta_accordion, ideo_testimonials_slider',
    ),
    'category' => __('Content', 'ideo-themo'),
    'description' => __('Tabbed content', 'ideo-themo'),
    'params' => array(

        array(
            'type' => 'textfield',
            'heading' => __('TITLE', 'ideo-themo'),
            'param_name' => 'title',
            'admin_label' => true,
            'value' => '',
            'description' => __('Enter tab title.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_switcher',
            'heading' => __('ICON DISPLAY', 'ideo-themo'),
            'param_name' => 'el_icon_display',
            'on' => 'true',
            'off' => 'false',
            'value' => 'false',
            'dependencies' => array('true' => array('el_icon')),
            'description' => __('Turn On or Off icon displaying - icon will be displayed next to title.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_choose_icon',
            'holder' => 'div',
            'class' => '',
            'heading' => __('CHOOSE ICON', 'ideo-themo'),
            'param_name' => 'el_icon',
            'value' => 'fa fa-check-circle',
            'description' => __('Choose icon.', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_id',
            'heading' => __('UniqID', 'ideo-themo'),
            'param_name' => 'el_uid',
            'value' => ideothemo_shortcode_uid(),
            'group' => __('ANIMATION', 'ideo-themo')
        ),
    ),
    'custom_markup' => '
		<div class="vc_tta-panel-heading">
		    <h4 class="vc_tta-panel-title vc_tta-controls-icon-position-left"><a href="javascript:;" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-accordion data-vc-container=".vc_tta-container"><span class="vc_tta-title-text">{{ section_title }}</span><i class="vc_tta-controls-icon vc_tta-controls-icon-plus"></i></a></h4>
		</div>
		<div class="vc_tta-panel-body">
			{{ editor_controls }}
			<div class="{{ container-class }}">
			{{ content }}
			</div>
		</div>',
    'default_content' => '',
    'js_view' => 'VcBackendTtaSectionView'
));

