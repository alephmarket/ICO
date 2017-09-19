<?php

define('IDEOTHEMO_LESS_PATH', get_template_directory() . '/inc/less/');
define('IDEOTHEMO_LESS_SC_PATH', get_template_directory() . '/inc/vc_extend/less/');


function ideothemo_add_admin_scripts()
{

    wp_enqueue_style('chosen', IDEOTHEMO_INIT_DIR_URI . '/js/chosen/chosen.css', false, IDEOTHEMO_VERSION, 'screen');
    wp_enqueue_style('ideothemo-vc-custom-style', IDEOTHEMO_INIT_DIR_URI . '/inc/vc_extend/css/admin-style.css', false, IDEOTHEMO_VERSION, 'screen');

    wp_enqueue_script('tweenmax', IDEOTHEMO_INIT_DIR_URI . '/js/greensock/TweenMax.min.js', array('jquery', 'jquery-ui-slider'), IDEOTHEMO_VERSION, true);
    wp_enqueue_script('chosen', IDEOTHEMO_INIT_DIR_URI . '/js/chosen/chosen.jquery.min.js', array('jquery'), IDEOTHEMO_VERSION, true);

    wp_enqueue_script('wp-color-picker-alpha', IDEOTHEMO_INIT_DIR_URI . '/inc/vc_extend/js/wp-color-picker-alpha.min.js', array('wp-color-picker'), '1.1', true);

    wp_enqueue_script('ideothemo-wpb_js_composer_js_custom_views', IDEOTHEMO_INIT_DIR_URI . '/inc/vc_extend/js/composer-custom-views' . IDEOTHEMO_JS_MODE, array(), WPB_VC_VERSION, true);

}

add_action('vc_backend_editor_enqueue_js_css', 'ideothemo_add_admin_scripts');


function ideothemo_get_testimonials()
{
    return array();
}

function ideothemo_get_contact_form7()
{
    $forms = array(esc_html__('choose', 'themo') => '');

    $args = array('post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1);
    if ($cf7Forms = get_posts($args)) {
        foreach ($cf7Forms as $cf7Form) {
            $forms[$cf7Form->post_title] = $cf7Form->ID;
        }
    }

    return $forms;
}

function ideothemo_get_size($size)
{
    $pattern = '/^([-]*\d*(?:\.\d+)?)\s*(px|\%|in|cm|mm|em|rem|ex|pt|pc|vw|vh|vmin|vmax)?$/';
    $regexr = preg_match($pattern, $size, $matches);
    $value = isset($matches[1]) ? (float)$matches[1] : 0;
    $unit = isset($matches[2]) ? $matches[2] : 'px';
    return $value . $unit;
}

function ideothemo_get_image_size($attachment_id, $size)
{
    //width x height
    preg_match('/^(\d+)x(\d+)$/', trim($size), $matches);
    if (count($matches) == 3) {
        return array($matches[1], $matches[2]);
    }
    // width
    preg_match('/^(\d+)$/', trim($size), $matches);
    if (count($matches) == 2) {
        return array($matches[1], $matches[1]);
    }
    //
    $image = wp_get_attachment_image_src($attachment_id, $size);
    return array($image[1], $image[2]);

}

function ideothemo_asset_url($file)
{
    return IDEOTHEMO_INIT_DIR_URI . '/assets/' . $file;
}

function ideothemo_add_presets() 
{
    do_action( 'vc_register_settings_preset', 'Second preset', 'vc_column_text', array(
        'content' => 'Short and simple.'
    ), false );
    
    do_action( 'vc_register_settings_preset', 'preset_number', 'shortcode-base', array(
        'param name' => 'value',
        'param name' => 'value'
    ), false );
    
     do_action( 'vc_register_settings_preset', 'preset_01', 'ideo_iconbox', array(
        'el_icon_align' => 'center',
        'el_icon_font_size' => '40',
        'el_icon_circle_border_size' => '5',
        'el_title' => 'PLACE TITLE HERE',
        'el_title_size' => '15',
        'content' => 'Lorem ipsum dolor sit amet, tellus matis elit. Ut elit tellus, luctus nec mattis.',
        'el_text_size' => '13',
        'el_text_align' => 'center',
        'el_button_align' => 'center',
        'el_button_label' => 'More',
        'el_button_radius' => 'big',
        'el_button_icon_type' => 'reveal',
        'el_elemnt_style' => 'transparent-dark',
        'el_elemnt_style_colors' => "{'title_color':'#272f39','separator_color':'#rgba(14,65,73,0.18)','text_color':'#7b8695','icon_background_color':'#36bbe6','icon_color':'#ffffff','icon_border_color':'#2cafda'}",
        'el_button_elemnt_style' => 'colored-dark-to-transparent-invert',
        'el_button_elemnt_style_colors' => "{'font_color':'#3498db','icon_color':'#3498db','borders_color':'#3498db','background_hover_color':'#3498db','font_hover_color':'#ffffff','icon_hover_color':'#ffffff','borders_hover_color':'#3498db'}"
    ), false );
    
    do_action( 'vc_register_settings_preset', 'preset_02', 'ideo_iconbox', array(
        'el_icon_align' => 'left',
        'el_icon_font_size' => '20',
        'el_icon_circle_border_size' => '0',
        'el_title' => 'Icon box title',
        'el_title_size' => '15',
        'content' => 'Lorem ipsum dolor sit consectetur, amet adipiscing elit. Ut elit tellus, luctus nec.',
        'el_text_size' => '13',
        'el_text_align' => 'left',
        'el_margin_top' => '0',
        'el_margin_bottom' => '0',
        'el_button_display' => 'false',
        'el_elemnt_style' => 'transparent-dark',
        'el_elemnt_style_colors' => "{'title_color':'#272f39','separator_color':'#rgba(14,65,73,0.18)','text_color':'#7b8695','icon_background_color':'#185059','icon_color':'#ffffff','icon_border_color':'#0e4149'}"
    ), false );
    
    do_action( 'vc_register_settings_preset', 'preset_03', 'ideo_iconbox', array(
        'el_icon_align' => 'center',
        'el_icon_font_size' => '50',
        'el_title' => 'Icon box title',
        'el_title_size' => '16',
        'content' => 'All our dreams can come true, if we have the courage to pursue them.',
        'el_text_size' => '13',
        'el_text_align' => 'center',
        'el_icon_circle_border_size' => '3',
        'el_margin_top' => '22',
        'el_button_align' => 'center',
        'el_button_label' => 'Read more',
        'el_button_radius' => 'small',
        'el_button_border_thickness' => '0',
        'el_button_icon_type' => 'reveal',
        'el_elemnt_style' => 'transparent-dark',
        'el_elemnt_style_colors' => "{'title_color':'#272f39','separator_color':'rgba(14,65,73,0.18)','text_color':'#7b8695','icon_background_color':'rgba(52,152,219,0)','icon_color':'#16a085','icon_border_color':'#1abc9c'}",
        'el_button_elemnt_style' => 'colored-dark',
        'el_button_elemnt_style_colors' => "{'background_color':'rgba(52,152,219,0)','font_color':'#1abc9c','icon_color':'#1abc9c','borders_color':'rgba(52,152,219,0)','background_hover_color':'rgba(52,152,219,0)','font_hover_color':'#16a085','icon_hover_color':'#16a085','borders_hover_color':'rgba(52,152,219,0)'}"
    ), false );
    
    do_action( 'vc_register_settings_preset', 'preset_04', 'ideo_iconbox', array(
        'el_icon_align' => 'right',
        'el_icon_font_size' => '25',
        'el_icon_circle_border_size' => '2',
        'el_title' => 'Icon box title',
        'el_title_size' => '25',
        'content' => 'All our dreams can come true, if we have the courage to pursue them.',
        'el_text_size' => '13',
        'el_text_align' => 'right',
        'el_button_display' => 'false',
        'el_elemnt_style' => 'transparent-dark',
        'el_elemnt_style_colors' => "{'title_color':'#272f39','separator_color':'rgba(14,65,73,0.18)','text_color':'#7b8695','icon_background_color':'rgba(52,152,219,0)','icon_color':'#e74c3c','icon_border_color':'#e74c3c'}"
    ), false );
    
    do_action( 'vc_register_settings_preset', 'preset_05', 'ideo_iconbox', array(
        'el_icon_align' => 'center',
        'el_icon_font_size' => '40',
        'el_icon_circle_border_size' => '5',
        'el_title' => 'Icon box title',
        'el_title_size' => '22',
        'content' => 'Nulla tellus elit, vulputate sit amet ultricies at, interdum at mauris. Sed id ex tellus. Etiam convallis vehicula erat, eu fringilla neque congue a.',
        'el_text_size' => '14',
        'el_text_align' => 'center',
        'el_margin_top' => '26',
        'el_button_align' => 'center',
        'el_button_label' => 'Read more',
        'el_button_type' => 'button3d',
        'el_button_radius' => 'big',
        'el_button_border_thickness' => '2',
        'el_button_icon_type' => 'reveal',
        'el_elemnt_style' => 'colored-dark',
        'el_elemnt_style_colors' => "{'background_color':'#272f39','title_color':'#ffffff','separator_color':'rgba(255,255,255,0.18)','text_color':'#92a0b1','icon_background_color':'#1abc9c','icon_color':'#ffffff','icon_border_color':'#16a085','border_color':'#1abc9c'}",
        'el_button_elemnt_style' => 'transparent-light',
        'el_button_elemnt_style_colors' => "{'font_color':'#ffffff','icon_color':'#ffffff','borders_color':'rgba(255,255,255,0.18)','font_hover_color':'#ffffff','icon_hover_color':'#ffffff','borders_hover_color':'rgba(255,255,255,0.18)'}"
    ), false );
    
    do_action( 'vc_register_settings_preset', 'preset_06', 'ideo_iconbox', array(
        'el_icon_align' => 'left',
        'el_icon_font_size' => '25',
        'el_icon_circle_border_size' => '2',
        'el_title' => 'Icon box title',
        'el_title_size' => '20',
        'content' => 'All our dreams can come true, if we have the courage to pursue them.',
        'el_text_size' => '14',
        'el_text_align' => 'left',
        'el_button_display' => 'false',
        'el_elemnt_style' => 'colored-dark',
        'el_elemnt_style_colors' => "{'background_color':'rgba(14,65,73,0.8)','title_color':'#ffffff','separator_color':'rgba(255,255,255,0.18)','text_color':'#f0f0f0','icon_background_color':'#3498db','icon_color':'#ffffff','icon_border_color':'#3498db','border_color':'#3498db'}"
    ), false );
    
    do_action( 'vc_register_settings_preset', 'preset_07', 'ideo_iconbox', array(
        'el_icon_align' => 'center',
        'el_icon_font_size' => '35',
        'el_icon_circle_border_size' => '3',
        'el_title' => 'Icon box title',
        'el_title_size' => '22',
        'content' => 'Nulla tellus elit, vulputate sit amet ultricies at, interdum at mauris. Sed id ex tellus. Etiam convallis vehicula erat, eu fringilla neque congue a.',
        'el_text_size' => '13',
        'el_text_align' => 'left',
        'el_margin_top' => '26',
        'el_button_align' => 'left',
        'el_button_label' => 'Read more',
        'el_button_radius' => 'big',
        'el_button_border_thickness' => '2',
        'el_button_icon_type' => 'standard',
        'el_elemnt_style' => 'colored-light',
        'el_elemnt_style_colors' => "{'background_color':'rgba(255,255,255,0.2)','title_color':'#42ccf9','separator_color':'#42ccf9','text_color':'#ffffff','icon_background_color':'rgba(255,255,255,0)','icon_color':'#42ccf9','icon_border_color':'#ffffff','border_color':'rgba(52,152,219,0)'}",
        'el_button_elemnt_style' => 'colored-light-to-transparent-invert',
        'el_button_elemnt_style_colors' => "{'background_color':'rgba(255,255,255,0)','font_color':'#42ccf9','icon_color':'#42ccf9','borders_color':'#ffffff','background_hover_color':'#0e4149','font_hover_color':'#ffffff','icon_hover_color':'#ffffff','borders_hover_color':'#457a82'}"
    ), false );
    
    do_action( 'vc_register_settings_preset', 'preset_08', 'ideo_iconbox', array(
        'el_icon_align' => 'right',
        'el_icon_font_size' => '60',
        'el_icon_circle_border_size' => '0',
        'el_title' => 'Amazing backgrounds',
        'el_title_size' => '20',
        'content' => 'Nulla tellus elit, vulputate sit amet ultricies at, interdum at mauris. Sed id ex tellus. Etiam convallis vehicula erat, eu fringilla neque congue a. Proin tincidunt risus urna, et maximus dui bibendum eu.',
        'el_text_align' => 'right',
        'el_button_display' => 'false',
        'el_elemnt_style' => 'colored-dark',
        'el_elemnt_style_colors'=> "{'background_color':'rgba(26,188,156,0.5)','title_color':'#ffffff','separator_color':'rgba(255,255,255,0.18)','text_color':'#f0f0f0','icon_background_color':'rgba(66,204,249,0.72)','icon_color':'#ffffff','icon_border_color':'#3498db','border_color':'#16a085'}"
    ), false );
    
    do_action( 'vc_register_settings_preset', 'preset_09', 'ideo_iconbox', array(
        'el_icon_align' => 'center',
        'el_icon_font_size' => '40',
        'el_icon_circle_border_size' => '8',
        'el_title' => '278',
        'el_title_size' => '50',
        'content' => 'completed projects',
        'el_text_size' => '15',
        'el_text_align' => 'center',
        'el_button_display' => 'false',
        'el_elemnt_style' => 'colored-light',
        'el_elemnt_style_colors' => "{'background_color':'#fefefe','title_color':'#42ccf9','separator_color':'#42ccf9','text_color':'#2f3336','icon_background_color':'#42ccf9','icon_color':'#ffffff','icon_border_color':'#f0f0f0','border_color':'#1e73be'}"
    ), false );
    
    do_action( 'vc_register_settings_preset', 'preset_10', 'ideo_iconbox', array(
        'el_icon_align' => 'center',
        'el_icon_type' => 'custom',
        'el_icon_font_size' => '70',
        'el_icon_circle_border_size' => '10',
        'el_title' => 'Jason Thomas',
        'el_title_size' => '25',
        'content' => 'All our dreams can come true, if we have the courage to pursue them.',
        'el_text_align' => 'center',
        'el_button_align' => 'center',
        'el_button_label' => 'Contact me',
        'el_button_type' => 'button3d',
        'el_button_radius' => 'small',
        'el_button_icon_type' => 'reveal',
        'el_elemnt_style' => 'transparent-dark',
        'el_elemnt_style_colors' => "{'title_color':'#272f39','separator_color':'gba(14,65,73,0.18)','text_color':'#7b8695','icon_background_color':'rgba(52,152,219,0)','icon_color':'#ffffff','icon_border_color':'#1abc9c'}",
        'el_button_elemnt_style' => 'colored-light',
        'el_button_elemnt_style_colors' => "{'background_color':'#1abc9c','font_color':'#ffffff','icon_color':'#ffffff','borders_color':'rgba(52,152,219,0)','background_hover_color':'#16a085','font_hover_color':'#ffffff','icon_hover_color':'#ffffff','borders_hover_color':'rgba(52,152,219,0)'}"
    ), false );
    
    do_action( 'vc_register_settings_preset', 'preset_11', 'ideo_iconbox', array(
        'el_icon_type' => 'custom',
        'el_icon_align' => 'left',
        'el_icon_font_size' => '50',
        'el_icon_circle_border_size' => '0',
        'el_title' => 'My house',
        'el_title_size' => '25',
        'content' => 'All our dreams can come true, if we have the courage to pursue them.',
        'el_text_align' => 'left',
        'el_button_align' => 'left',
        'el_button_label' => 'Read more',
        'el_button_radius' => 'small',
        'el_button_border_thickness' => '2',
        'el_button_icon_type' => 'standard',
        'el_elemnt_style' => 'transparent-dark',
        'el_elemnt_style_colors' => "{'title_color':'#272f39','separator_color':'rgba(39,47,57,0.18)','text_color':'#7b8695','icon_background_color':'#0e4149','icon_color':'#ffffff','icon_border_color':'#1abc9c'}",
        'el_button_elemnt_style' => 'colored-light',
        'el_button_elemnt_style_colors' => "{'background_color':'rgba(255,255,255,0)','font_color':'#1abc9c','icon_color':'#1abc9c','borders_color':'rgba(52,152,219,0)','background_hover_color':'rgba(255,255,255,0)','font_hover_color':'#16a085','icon_hover_color':'#16a085','borders_hover_color':'rgba(44,175,218,0)'}"
    ), false );
    
    do_action( 'vc_register_settings_preset', 'preset_01', 'ideo_iconbox2', array(
        'el_icon_circle_size' => '40',
        'el_title' => 'PLACE TITLE HERE',
        'el_title_size' => '15',
        'content' => 'All our dreams can come true, if we have the courage to pursue them.',
        'el_button_label' => 'More',
        'el_button_radius' => 'big',
        'el_button_icon_type' => 'reveal',
        'el_elemnt_style' => 'colored-light',
        'el_elemnt_style_colors' => "{'background_color':'#f0f4f7','title_color':'#272f39','separator_color':'rgba(14,65,73,0.18)','text_color':'#7b8695','icon_background_color':'#36bbe6','icon_color':'#ffffff','border_color':'#2cafda'}",
        'el_button_elemnt_style' => 'transparent-dark',
        'el_button_elemnt_style_colors' => "{'font_color':'#272f39','icon_color':'#272f39','borders_color':'rgba(39,47,57,0.18)','font_hover_color':'#272f39','icon_hover_color':'#272f39','borders_hover_color':'rgba(39,47,57,0.18)'}"
    ), false );
    
    do_action( 'vc_register_settings_preset', 'preset_02', 'ideo_iconbox2', array(
        'el_icon_align' => 'left',
        'el_icon_circle_size' => '40',
        'el_title' => 'Icon box title',
        'el_title_size' => '15',
        'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        'el_text_size' => '12',
        'el_text_align' => 'left',
        'el_button_display' => 'false',
        'el_elemnt_style' => 'colored-light',
        'el_elemnt_style_colors' => "{'background_color':'#f0f4f7','title_color':'#272f39','separator_color':'rgba(14,65,73,0.18)','text_color':'#7b8695','icon_background_color':'#185059','icon_color':'#ffffff','border_color':'#3498db'}"
    ), false );
    
    do_action( 'vc_register_settings_preset', 'preset_03', 'ideo_iconbox2', array(
        'el_icon_font_size' => '40',
        'el_icon_circle_size' => '45',
        'el_icon_circle_border_size' => '0',
        'el_title' => 'Icon box title',
        'el_title_size' => '14',
        'content' => 'All our dreams can come true, if we have the courage to pursue them.',
        'el_button_label' => 'Read more',
        'el_button_border_thickness' => '0',
        'el_button_icon_type' => 'reveal',
        'el_elemnt_style' => 'colored-light',
        'el_elemnt_style_colors' => "{'background_color':'#ffffff','title_color':'#272f39','separator_color':'rgba(39,47,57,0.18)','text_color':'#7b8695','icon_background_color':'#1abc9c','icon_color':'#ffffff','border_color':'#1abc9c'}",
        'el_button_elemnt_style' => 'colored-light',
        'el_button_elemnt_style_colors' => "{'background_color':'rgba(52,152,219,0)','font_color':'#1abc9c','icon_color':'#1abc9c','borders_color':'rgba(52,152,219,0)','background_hover_color':'rgba(52,152,219,0)','font_hover_color':'#16a085','icon_hover_color':'#16a085','borders_hover_color':'rgba(52,152,219,0)'}"
    ), false );
    
    do_action( 'vc_register_settings_preset', 'preset_04', 'ideo_iconbox2', array(
        'el_icon_align' => 'right',
        'el_icon_font_size' => '35',
        'el_title' => 'Icon box title',
        'el_title_size' => '25',
        'content' => 'All our dreams can come true, if we have the courage to pursue them.',
        'el_text_align' => 'right',
        'el_button_display' => 'false',
        'el_elemnt_style' => 'colored-light',
        'el_elemnt_style_colors' => "{'background_color':'#ffffff','title_color':'#272f39','separator_color':'rgba(39,47,57,0.18)','text_color':'#7b8695','icon_background_color':'#e74c3c','icon_color':'#ffffff','border_color':'#e74c3c'}"
    ), false );
    
    do_action( 'vc_register_settings_preset', 'preset_05', 'ideo_iconbox2', array(
        'el_icon_font_size' => '40',
        'el_icon_circle_size' => '43',
        'el_title' => 'Icon box title',
        'el_title_size' => '22',
        'content' => 'Nulla tellus elit, vulputate sit amet ultricies at, interdum at mauris. Sed id ex tellus. Etiam convallis vehicula erat, eu fringilla neque congue a. Proin tincidunt risus urna, et maximus dui bibendum eu.',
        'el_text_size' => '13',
        'el_button_label' => 'Read more',
        'el_button_type' => 'button3d',
        'el_button_icon_type' => 'reveal',
        'el_elemnt_style' => 'colored-dark',
        'el_elemnt_style_colors' => "{'background_color':'#272f39','title_color':'#ffffff','separator_color':'rgba(255,255,255,0.18)','text_color':'#92a0b1','icon_background_color':'#1abc9c','icon_color':'#ffffff','border_color':'#1abc9c'}",
        'el_button_elemnt_style' => 'transparent-light',
        'el_button_elemnt_style_colors' => "{'font_color':'#ffffff','icon_color':'#ffffff','borders_color':'rgba(255,255,255,0.18)','font_hover_color':'#ffffff','icon_hover_color':'#ffffff','borders_hover_color':'rgba(255,255,255,0.18)'}"
    ), false );
    
        do_action( 'vc_register_settings_preset', 'preset_06', 'ideo_iconbox2', array(
        'el_icon_align' => 'left',
        'el_icon_font_size' => '25',
        'el_title' => 'Icon box title',
        'el_title_size' => '20',
        'content' => 'Lorem ipsum dolor sit amet, ipsum consectetur adipiscing elit.',
        'el_text_align' => 'left',
        'el_button_display' => 'false',
        'el_elemnt_style' => 'colored-dark',
        'el_elemnt_style_colors' => "{'background_color':'rgba(14,65,73,0.8)','title_color':'#ffffff','separator_color':'rgba(255,255,255,0.18)','text_color':'#f0f0f0','icon_background_color':'#3498db','icon_color':'#ffffff','border_color':'#3498db'}"
    ), false );
    
    do_action( 'vc_register_settings_preset', 'preset_07', 'ideo_iconbox2', array(
        'el_icon_font_size' => '35',
        'el_title' => 'Icon box title',
        'el_title_size' => '22',
        'content' => 'Nulla tellus elit, vulputate sit amet ultricies, interdum at mauris. Sed id ex tellus. Etiam convallis vehicula erat, eu fringilla neque congue a. Proin tincidunt risus urna, et maximus dui bibendum eu.',
        'el_text_size' => '13',
        'el_text_align' => 'left',
        'el_button_align' => 'left',
        'el_button_label' => 'Read more',
        'el_button_border_thickness' => '2',
        'el_button_icon_type' => 'standard',
        'el_elemnt_style' => 'colored-light',
        'el_elemnt_style_colors' => "{'background_color':'rgba(255,255,255,0.2)','title_color':'#42ccf9','separator_color':'2cafda','text_color':'#ffffff','icon_background_color':'#42ccf9','icon_color':'#ffffff','border_color':'#3498db'}",
        'el_button_elemnt_style' => 'colored-dark-to-transparent-invert',
        'el_button_elemnt_style_colors' => "{'background_color':'rgba(14,65,73,0)','font_color':'#42ccf9','icon_color':'#42ccf9','borders_color':'#ffffff','background_hover_color':'#0e4149','font_hover_color':'#ffffff','icon_hover_color':'#ffffff','borders_hover_color':'#457a82'}"
    ), false );
    
    do_action( 'vc_register_settings_preset', 'preset_08', 'ideo_iconbox2', array(
        'el_icon_align' => 'right',
        'el_icon_font_size' => '40',
        'el_icon_circle_size' => '40',
        'el_icon_circle_border_size' => '5',
        'el_title' => 'Icon box title',
        'el_title_size' => '22',
        'content' => 'Nulla tellus elit, vulputate sit amet ultricies at, interdum at mauris. Sed id ex tellus. Etiam convallis vehicula erat, eu fringilla neque congue a. Proin tincidunt risus urna, et maximus dui bibendum eu.',
        'el_text_align' => 'right',
        'el_button_display' => 'false',
        'el_elemnt_style' => 'colored-dark',
        'el_elemnt_style_colors' => "{'background_color':'rgba(26,188,156,0.5)','title_color':'#ffffff','separator_color':'rgba(255,255,255,0.18)','text_color':'#f0f0f0','icon_background_color':'rgba(66,204,249,0.72)','icon_color':'#ffffff','border_color':'#16a085'}"
    ), false );
    
    do_action( 'vc_register_settings_preset', 'preset_09', 'ideo_iconbox2', array(
        'el_icon_font_size' => '40',
        'el_icon_circle_size' => '36',
        'el_icon_circle_border_size' => '9',
        'el_title' => '278',
        'el_title_size' => '50',
        'content' => 'completed projects',
        'el_text_size' => '15',
        'el_button_display' => 'false',
        'el_elemnt_style' => 'colored-light',
        'el_elemnt_style_colors' => "{'background_color':'f0f4f7','title_color':'#42ccf9','separator_color':'#42ccf9','text_color':'#0e4149','icon_background_color':'#42ccf9','icon_color':'#ffffff','border_color':'#2cafda'}"
    ), false );
    
    do_action( 'vc_register_settings_preset', 'preset_10', 'ideo_iconbox2', array(
        'el_icon_type' => 'custom',
        'el_icon_circle_size' => '42',
        'el_icon_circle_border_size' => '3',
        'el_title' => 'Jason Thomas',
        'el_title_size' => '25',
        'content' => 'All our dreams can come true, if we have the courage to pursue them.',
        'el_button_label' => 'Contact me',
        'el_button_type' => 'button3d',
        'el_button_radius' => 'small',
        'el_button_border_thickness' => '0',
        'el_button_icon_type' => 'reveal',
        'el_elemnt_style' => 'colored-light',
        'el_elemnt_style_colors' => "{'background_color':'#ffffff','title_color':'#272f39','separator_color':'rgba(39,47,57,0.18)','text_color':'#7b8695','icon_background_color':'#1abc9c','icon_color':'#ffffff','border_color':'#1abc9c'}",
        'el_button_elemnt_style' => 'colored-light',
        'el_button_elemnt_style_colors' => "{'background_color':'#1abc9c','font_color':'#ffffff','icon_color':'#ffffff','borders_color':'#1abc9c','background_hover_color':'#16a085','font_hover_color':'#ffffff','icon_hover_color':'#ffffff','borders_hover_color':'#16a085'}"
    ), false );
    
    do_action( 'vc_register_settings_preset', 'preset_11', 'ideo_iconbox2', array(
        'el_icon_type' => 'custom',
        'el_icon_align' => 'left',
        'el_icon_circle_size' => '45',
        'el_icon_circle_border_size' => '0',
        'el_title' => 'My house',
        'el_title_size' => '25',
        'content' => 'All our dreams can come true, if we have the courage to pursue them.',
        'el_text_align' => 'left',
        'el_button_align' => 'left',
        'el_button_label' => 'Read more',
        'el_button_border_thickness' => '0',
        'el_button_icon_type' => 'standard',
        'el_elemnt_style' => 'colored-light',
        'el_elemnt_style_colors' => "{'background_color':'#ffffff','title_color':'#272f39','separator_color':'rgba(39,47,57,0.18)','text_color':'#7b8695','icon_background_color':'#1abc9c','icon_color':'#ffffff','border_color':'#1abc9c'}",
        'el_button_elemnt_style' => 'colored-light',
        'el_button_elemnt_style_colors' => "{'background_color':'rgba(52,152,219,0)','font_color':'#1abc9c','icon_color':'#1abc9c','borders_color':'rgba(52,152,219,0)','background_hover_color':'rgba(52,152,219,0)','font_hover_color':'#16a085','icon_hover_color':'#16a085','borders_hover_color':'rgba(52,152,219,0)'}"
    ), false );
    
        do_action( 'vc_register_settings_preset', 'preset_01', 'ideo_imagebox', array(
        'el_title' => 'CUSTOMIZABLE TITLE',
        'el_title_size' => '18',
        'content' => 'Quisque dignissim nec magna a vehicula. Aliquam pulvinar ligula sed mi placerat porta. In placerat nisi sit amet accumsan consequat. Mauris ac augue non tellus tempor ornare id at nisi. Nulla euismod est sed leo eleifend condimentum.',
        'el_button_label' => 'Read more',
        'el_button_radius' => 'big',
        'el_button_icon_type' => 'reveal',
        'el_elemnt_style' => 'colored-dark',
        'el_elemnt_style_colors' => "{'background_color':'rgba(23,26,30,0.9)','title_color':'#ffffff','separator_color':'rgba(255,255,255,0.18)','text_color':'#92a0b1','border_color':'#2cafda'}",
        'el_button_elemnt_style' => 'transparent-light',
        'el_button_elemnt_style_colors' => "{'font_color':'#ffffff','icon_color':'#ffffff','borders_color':'rgba(255,255,255,0.18)','font_hover_color':'#ffffff','icon_hover_color':'#ffffff','borders_hover_color':'rgba(255,255,255,0.18)'}"
    ), false );
    
        do_action( 'vc_register_settings_preset', 'preset_02', 'ideo_imagebox', array(
        'el_title' => 'Image box title',
        'el_title_size' => '18',
        'content' => 'Quisque dignissim nec magna a vehicula. Aliquam pulvinar ligula sed mi placerat porta. In placerat nisi sit amet accumsan consequat. Mauris ac augue non tellus tempor ornare id at nisi.',
        'el_text_align' => 'left',
        'el_button_display' => 'false',
        'el_elemnt_style' => 'colored-dark',
        'el_elemnt_style_colors' => "{'background_color':'rgba(26,188,156,0.9)','title_color':'#ffffff','separator_color':'rgba(255,255,255,0.18)','text_color':'#f0f0f0','border_color':'#16a085'}"
    ), false );
    
        do_action( 'vc_register_settings_preset', 'preset_03', 'ideo_imagebox', array(
        'el_title' => 'Image box title',
        'el_title_size' => '20',
        'content' => 'Quisque dignissim nec magna a vehicula. Aliquam pulvinar ligula sed mi placerat porta. In placerat nisi sit amet accumsan consequat. Mauris ac augue non tellus tempor ornare id at nisi.',
        'el_button_label' => 'Read more',
        'el_button_radius' => 'big',
        'el_button_border_thickness' => '0',
        'el_button_icon_type' => 'reveal',
        'el_elemnt_style' => 'transparent-dark',
        'el_elemnt_style_colors' => "{'title_color':'#272f39','separator_color':'#1abc9c','text_color':'#171a1e'}",
        'el_button_elemnt_style' => 'colored-light-to-transparent-invert',
        'el_button_elemnt_style_colors' => "{'background_color':'rgba(22,160,133,0.6)','font_color':'#ffffff','icon_color':'#ffffff','borders_color':'#16a085','background_hover_color':'#16a085','font_hover_color':'#ffffff','icon_hover_color':'#ffffff','borders_hover_color':'#16a085'}"
    ), false );
    
        do_action( 'vc_register_settings_preset', 'preset_04', 'ideo_imagebox', array(
        'el_title' => 'PORTFOLIO',
        'el_title_size' => '18',
        'content' => '',
        'el_button_label' => 'SEE DEMO SITE',
        'el_button_radius' => 'big',
        'el_elemnt_style' => 'colored-light',
        'el_elemnt_style_colors' => "{'background_color':'#f0f4f7','title_color':'#272f39','separator_color':'rgba(39,47,57,0.18)','text_color':'#7b8695','border_color':'#3498db'}",
        'el_button_elemnt_style' => 'colored-dark-to-transparent-invert',
        'el_button_elemnt_style_colors' => "{'background_color':'rgba(52,152,219,0)','font_color':'#3498db','icon_color':'#3498db','borders_color':'#2cafda','background_hover_color':'#3498db','font_hover_color':'#ffffff','icon_hover_color':'#ffffff','borders_hover_color':'#3498db'}"
    ), false );
    
        do_action( 'vc_register_settings_preset', 'preset_05', 'ideo_imagebox', array(
        'el_title' => '01.',
        'el_title_size' => '70',
        'content' => 'Quisque dignissim nec magna a vehicula. Aliquam pulvinar ligula sed mi placerat porta. In placerat nisi sit amet accumsan consequat. Mauris ac augue non tellus tempor ornare id at nisi. purus lobortis blandit eget auctor magna. ',
        'el_text_size' => '12',
        'el_text_align' => 'justify',
        'el_button_align' => 'left',
        'el_button_label' => 'GO',
        'el_button_radius' => 'none',
        'el_button_size' => 'medium',
        'el_button_icon_type' => 'reveal',
        'el_elemnt_style' => 'transparent-light',
        'el_elemnt_style_colors' => "{'title_color':'#ffffff','separator_color':'rgba(255,255,255,0.18)','text_color':'#ffffff'}",
        'el_button_elemnt_style' => 'transparent-light',
        'el_button_elemnt_style_colors' => "{'font_color':'#ffffff','icon_color':'#ffffff','borders_color':'rgba(255,255,255,0.18)','font_hover_color':'#ffffff','icon_hover_color':'#ffffff','borders_hover_color':'rgba(255,255,255,0.18)'}"
    ), false );
    
        do_action( 'vc_register_settings_preset', 'preset_01', 'ideo_pie_chart', array(
        'el_size' => '150',
        'el_number_font_size' => '24',
        'el_round_counter_size' => '30',
        'el_round_counter_border_style' => 'butt',
        'el_round_counter_duration' => '1000',
        'el_round_counter_easing' => 'easeInBack',
        'el_icon_display' => 'false',
        'el_elemnt_style' => 'transparent-light',
        'el_elemnt_style_colors' => "{'number_color':'#ffffff','icon_color':'#ffffff','round_counter_color':'rgba(26,188,156,0.55)','round_counter_border_color':'rgba(255,255,255,0.75)'}"
    ), false );
    
        do_action( 'vc_register_settings_preset', 'preset_02', 'ideo_pie_chart', array(
        'el_size' => '190',
        'el_number_unit' => '&copy;',
        'el_number_font_size' => '28',
        'el_round_counter_border_style' => 'round',
        'el_round_counter_size' => '15',
        'el_round_counter_distance' => '4',
        'el_round_counter_duration' => '1000',
        'el_round_counter_easing' => 'easeInOutBounce',
        'el_icon_display' => 'true',
        'el_icon_size' => '30',
        'el_elemnt_style' => 'transparent-light',
        'el_elemnt_style_colors' => "{'number_color':'#ffffff','icon_color':'#42ccf9','round_counter_color':'rgba(255,255,255,0.26)','round_counter_border_color':'rgba(66,204,249,0.59)'}"
    ), false );
    
        do_action( 'vc_register_settings_preset', 'preset_03', 'ideo_pie_chart', array(
        'el_size' => '180',
        'el_number_unit' => '&euro;',
        'el_number_font_size' => '24',
        'el_round_counter_border_style' => 'round',
        'el_round_counter_size' => '18',
        'el_round_counter_distance' => '4',
        'el_round_counter_duration' => '1000',
        'el_icon_display' => 'false',
        'el_elemnt_style' => 'colored-light',
        'el_elemnt_style_colors' => "{'counter_background_color':'rgba(255,255,255,0.15)','number_color':'#ffffff','icon_color':'#e74c3c','round_counter_color':'#e74c3c','round_counter_background_color':'rgba(255,255,255,0.05)'}"
    ), false );
    
        do_action( 'vc_register_settings_preset', 'preset_04', 'ideo_pie_chart', array(
        'el_size' => '190',
        'el_number_font_size' => '24',
        'el_round_counter_border_style' => 'butt',
        'el_round_counter_size' => '27',
        'el_round_counter_distance' => '4',
        'el_icon_display' => 'true',
        'el_icon_size' => '30',
        'el_elemnt_style' => 'colored-light',
        'el_elemnt_style_colors' => "{'counter_background_color':'rgba(255,255,255,0.86)','number_color':'#7b8695','icon_color':'#2c3e50','round_counter_color':'#2a6eb2','round_counter_background_color':'rgba(52,152,219,0.76)'}"
    ), false );
    
        do_action( 'vc_register_settings_preset', 'preset_05', 'ideo_pie_chart', array(
        'el_size' => '140',
        'el_number_font_size' => '25',
        'el_round_counter_border_style' => 'butt',
        'el_round_counter_size' => '21',
        'el_round_counter_duration' => '1000',
        'el_icon_display' => 'false',
        'el_elemnt_style' => 'transparent-dark',
        'el_elemnt_style_colors' => "{'number_color':'#7b8695','icon_color':'#7b8695','round_counter_color':'#3498db','round_counter_border_color':'#3498db'}"
    ), false );
    
        do_action( 'vc_register_settings_preset', 'preset_06', 'ideo_pie_chart', array(
        'el_size' => '160',
        'el_number_font_size' => '24',
        'el_round_counter_border_style' => 'butt',
        'el_round_counter_size' => '16',
        'el_round_counter_distance' => '3',
        'el_round_counter_duration' => '1000',
        'el_icon_display' => 'false',
        'el_elemnt_style' => 'colored-light',
        'el_elemnt_style_colors' => "{'counter_background_color':'#dededd','number_color':'#272f39','icon_color':'#272f39','round_counter_color':'#1abc9c','round_counter_background_color':'rgba(222,222,221,0)'}"
    ), false );
    
        do_action( 'vc_register_settings_preset', 'preset_01', 'ideo_progress_bar', array(
        'el_title' => 'progress bar',
        'el_unit' => 'lvl',
        'el_height' => '30',
        'el_covers' => 'simple',
        'el_elemnt_style' => 'transparent-dark',
        'el_elemnt_style_colors' => "{'background_color':'rgba(39,47,57,0.1)','bar_color':'#e74c3c','titles_color':'#272f39'}"
    ), false );
    
        do_action( 'vc_register_settings_preset', 'preset_02', 'ideo_progress_bar', array(
        'el_title' => 'progress bar',
        'el_unit' => 'lvl',
        'el_height' => '30',
        'el_covers' => 'rounded',
        'el_elemnt_style' => 'colored-dark',
        'el_elemnt_style_colors' => "{'background_color':'rgba(39,47,57,0.1)','bar_color':'#5c80a3','titles_color':'#ffffff','tooltip_color':'#5c80a3','percent_color':'#ffffff'}"
    ), false );
    
        do_action( 'vc_register_settings_preset', 'preset_03', 'ideo_progress_bar', array(
        'el_title' => 'progress bar',
        'el_unit' => '%',
        'el_height' => '5',
        'el_covers' => 'rounded',
        'el_elemnt_style' => 'transparent-dark',
        'el_elemnt_style_colors' => "{'background_color':'rgba(255,255,255,0.2)','bar_color':'#3498db','titles_color':'#ffffff'}"
    ), false );
    
        do_action( 'vc_register_settings_preset', 'preset_04', 'ideo_progress_bar', array(
        'el_title' => 'progress bar',
        'el_unit' => '%',
        'el_height' => '5',
        'el_covers' => 'rounded',
        'el_elemnt_style' => 'transparent-dark',
        'el_elemnt_style_colors' => "{'background_color':'rgba(39,47,57,0.1)','bar_color':'#3498db','titles_color':'#272f39'}"
    ), false );
    
        do_action( 'vc_register_settings_preset', 'preset_05', 'ideo_progress_bar', array(
        'el_title' => 'photography <b>80%</b>',
        'el_number' => '0',
        'el_unit' => '',
        'el_height' => '25',
        'el_font_size' => '13',
        'el_covers' => 'rounded',
        'el_margin_top' => '10',
        'el_margin_bottom' => '0',
        'el_elemnt_style' => 'colored-light',
        'el_elemnt_style_colors' => "{'background_color':'rgba(255,255,255,0.1)','bar_color':'#e74c3c','titles_color':'#ffffff','tooltip_color':'#e74c3c','percent_color':'#ffffff'}"
    ), false );
    
        do_action( 'vc_register_settings_preset', 'preset_06', 'ideo_progress_bar', array(
        'el_title' => '',
        'el_number' => '0',
        'el_unit' => '',
        'el_height' => '2',
        'el_covers' => 'simple',
        'el_margin_top' => '15',
        'el_margin_bottom' => '0',
        'el_elemnt_style' => 'colored-light',
        'el_elemnt_style_colors' => "{'background_color':'rgba(0,0,0,0.69)','bar_color':'#ffffff','titles_color':'#272f39','tooltip_color':'#ffffff','percent_color':'#272f39'}"
    ), false );
    
        do_action( 'vc_register_settings_preset', 'preset_07', 'ideo_progress_bar', array(
        'el_title' => 'progress bar',
        'el_number' => '95',
        'el_unit' => '%',
        'el_height' => '5',
        'el_covers' => 'rounded',
        'el_elemnt_style' => 'transparent-dark',
        'el_elemnt_style_colors' => "{'background_color':'rgba(39,47,57,0.1)','bar_color':'#3498db','titles_color':'#272f39'}"
    ), false );
    
        do_action( 'vc_register_settings_preset', 'preset_08', 'ideo_progress_bar', array(
        'el_title' => 'progress bar',
        'el_number' => '95',
        'el_unit' => 'meters',
        'el_height' => '28',
        'el_covers' => 'rounded',
        'el_elemnt_style' => 'colored-dark',
        'el_elemnt_style_colors' => "{'background_color':'#1abc9c','bar_color':'#f1c40f','titles_color':'#0d6554','tooltip_color':'#e74c3c','percent_color':'#ffffff'}"
    ), false );
    
     do_action( 'vc_register_settings_preset', 'preset_01', 'ideo_team_box_caption', array(
        'content' => '',
        'el_image_linking_method' => 'modern',
        'el_easing_in_time' => '1.2',
        'el_easing_out_time' => '1.2',
        'el_name_fotn_size' => '20',
        'el_desc_font_size' => '16',
        'el_margin_top' => '20',
        'el_margin_bottom' => '70',
        'el_elemnt_style' => 'colored-dark',
        'el_elemnt_style_colors' => "{'background_color':'#1abc9c','name_color':'#ffffff','position_color':'#ffffff','description_color':'#ffffff','hover_icon_color':'#ffffff','social_bar_color':'#16a085','social_icon_color':'#ffffff'}"
    ), false );
    
    do_action( 'vc_register_settings_preset', 'preset_02', 'ideo_team_box_caption', array(
        'content' => '',
        'el_image_linking_method' => 'modern',
        'el_easing_in_time' => '1.2',
        'el_easing_out_time' => '1.2',
        'el_name_fotn_size' => '24',
        'el_margin_top' => '20',
        'el_margin_bottom' => '40',
        'el_elemnt_style' => 'transparent-dark',
        'el_elemnt_style_colors' => "{'name_color':'#34495e','position_color':'#7f8c8d','description_color':'#7f8c8d','hover_icon_color':'#3498db','border_color':'#34495e','social_icon_color':'#34495e'}"
    ), false );
}

add_action('vc_after_init', 'ideothemo_add_presets');

