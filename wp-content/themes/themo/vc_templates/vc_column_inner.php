<?php
$html = $font_color = $el_class = $width = $offset = '';
$html = $el_alignment = $el_valignment = $el_padding_top = $el_padding_bottom = $el_padding_left = $el_padding_right = $el_background = $el_background_color = $el_background_color_pattern = $el_background_color_pattern_color = $el_background_image = $el_background_size = $el_background_position = $el_background_repeat = $el_background_overlay_color = $el_background_overlay_pattern = $el_background_overlay_pattern_color = $el_background_motion = $el_background_motion_speed = $el_background_hover = $el_background_hover_color = $el_background_hover_color_pattern = $el_background_hover_color_pattern_color = $el_background_hover_image = $el_background_hover_size = $el_background_hover_position = $el_background_hover_repeat = $el_background_hover_overlay_color = $el_background_hover_overlay_pattern = $el_background_hover_overlay_pattern_color = $el_background_hover_motion = $el_background_hover_motion_speed = $el_url = $el_padding_left_right = $el_padding_top = $el_padding_bottom = $el_extra_class = $el_custom_css = $el_animation = $el_animation_type = $el_animation_delay = $el_animation_column_name = $el_remove_from_grid = $css = $el_uid = '';


extract(shortcode_atts(array(
    'font_color' => '',
    'el_uid' => ideothemo_shortcode_uid(),
    'el_anchor_point' => '',
    'el_class' => '',
    'width' => '1/1',
    'css' => '',
    'offset' => '',
    'el_alignment' => 'left',
    'el_alignment_mobile' => 'left',
    'el_valignment' => 'start',
    'el_background' => '',
    'el_background_color' => '',
    'el_background_color_pattern' => '',
    'el_background_color_pattern_color' => '',
    'el_background_image' => '',
    'el_background_size' => 'false',
    'el_background_position' => '',
    'el_background_repeat' => '',
    'el_background_overlay_color' => '',
    'el_background_overlay_pattern' => '',
    'el_background_overlay_pattern_color' => '',
    'el_background_motion' => '',
    'el_background_motion_speed' => '',
    'el_background_hover' => '',
    'el_background_hover_color' => '',
    'el_background_hover_color_pattern' => '',
    'el_background_hover_color_pattern_color' => '',
    'el_background_hover_image' => '',
    'el_background_hover_size' => 'false',
    'el_background_hover_position' => '',
    'el_background_hover_repeat' => '',
    'el_background_hover_overlay_color' => '',
    'el_background_hover_overlay_pattern' => '',
    'el_background_hover_overlay_pattern_color' => '',
    'el_background_hover_motion' => '',
    'el_background_hover_motion_speed' => '',
    'el_url' => '',
    'el_extra_class' => '',
    'el_custom_css' => '',
    'el_animation' => '',
    'el_animation_type' => 'fadeIn',
    'el_animation_delay' => '500',    
    'el_animation_duration' => '1000',
    'el_animation_offset' => '95',
    'el_animation_column_name' => '',
    'el_remove_from_grid' => '',
    'el_minimum_column_height' => '',
), $atts));

if($el_uid == '') $el_uid = ideothemo_shortcode_uid();

$el_class = $this->getExtraClass($el_class);
$width = wpb_translateColumnWidthToSpan($width);
$width = vc_column_offset_class_merge($offset, $width);
$el_class .= ' wpb_column vc_column_container';
$style = $this->buildStyle($font_color);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $width . $el_class, $this->settings['base'], $atts);


$style_before = '';

$script = '';
$data = '';
$data_hover = '';

$less = '.vc_page_section .vc_column_container[data-id="' . $el_uid . '"], 
         .vc_page_section .vc_column_container[data-source="' . $el_uid . '"],
         .vc_page_section .row .vc_column_container[data-id="' . $el_uid . '"], 
         .vc_page_section .row .vc_column_container[data-source="' . $el_uid . '"]{';

if ($el_remove_from_grid) {
    $less .= 'position:absolute; visibility: hidden;';
}
    $less .= '.wpb_wrapper{
        width:100%;
    }';

$less .= '}';

$less .= '.vc_page_section .vc_column_container[data-id="' . $el_uid . '"], 
         .vc_page_section .vc_column_container[data-source="' . $el_uid . '"],
         .vc_page_section .row .vc_column_container[data-id="' . $el_uid . '"], 
         .vc_page_section .row .vc_column_container[data-source="' . $el_uid . '"], 
         .vc_page_section .pc-clone[data-id="' . $el_uid . '"],
         .vc_page_section .row .pc-clone[data-id="' . $el_uid . '"]{';

$less .= 'text-align:' . $el_alignment . ';';
$less .= '@media (max-width: 767px) { text-align:' . $el_alignment_mobile . ';}';

$less .= 'display: -webkit-box; display: -ms-flexbox; display: flex;
    -webkit-box-align: ' . $el_valignment . ';-ms-flex-align: ' . $el_valignment . '; align-items:' . ($el_valignment != 'center' ? 'flex-'.$el_valignment:$el_valignment) . ';';

if ($el_minimum_column_height) {
     $less .= 'min-height:' . ideothemo_get_size($el_minimum_column_height) . ';';
}

preg_match_all('/\{.+\}/', $css, $matches);

if (isset($matches[0][0])) {
    $less .= '&' . preg_replace('/\!important/i', '', $matches[0][0]) . ';';
}

if ($el_background_motion) $data .= ' data-motion="' . esc_attr($el_background_motion) . '"';
if ($el_background_motion_speed) $data .= ' data-motion-speed="' . esc_attr($el_background_motion_speed) . '"';

if ($el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-type="' . esc_attr($el_animation_type) . '"';
if ($el_animation_delay && $el_animation == 'viewport') $data .= ' data-animation-delay="' . esc_attr($el_animation_delay) . '"';
if ($el_animation_duration && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-duration="' . esc_attr($el_animation_duration) . '"';
if ($el_animation_offset && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-offset="' . esc_attr($el_animation_offset) . '"';

if ($el_animation == 'parallax') $css_class .= ' parallax';
if ($el_animation_column_name != '') $data .= ' data-column-name="' . esc_attr($el_animation_column_name) . '"';


switch ($el_background) {
    case 'color':
        if ($el_background_color) $less .= 'background-color:' . $el_background_color . ';';
        if ($el_background_color_pattern) $less .= 'background-image:url(' . ideothemo_get_assets_svg_data('svg/' . $el_background_color_pattern, $el_background_color_pattern_color) . ');';
        break;
    case 'image':
        if ($el_background_image) {
            $background_image = wp_get_attachment_image_src($el_background_image, 'full');
            $less .= 'background-image:url(' . $background_image[0] . ');';
            $data .= ' data-background-width="' . $background_image[1] . '"';
            $data .= ' data-background-height="' . $background_image[2] . '"';
        }
        if ($el_background_position) $less .= 'background-position:' . $el_background_position . ';';
        if ($el_background_repeat) $less .= 'background-repeat:' . $el_background_repeat . ';';
        if ($el_background_size == 'true') $less .= 'background-size:cover;';
        if ($el_background_motion == 'fixed' || $el_background_motion == 'parallax') {
            $less .= 'background-attachment:fixed;';
        }
        if ($el_background_overlay_pattern) $less .= '&:before{background-image:url(' . ideothemo_get_assets_svg_data('svg/masks/' . $el_background_overlay_pattern . '.svg', $el_background_overlay_pattern_color) . ');}';
        if ($el_background_overlay_color) $less .= '&:before{background-color:' . $el_background_overlay_color . ';}';

        break;
}

switch ($el_background_hover) {
    case 'color':
        if ($el_background_hover_color) $less .= '.vc_column_container_hover{background-color:' . $el_background_hover_color . ';}';
        if ($el_background_hover_color_pattern) $less .= '.vc_column_container_hover{background-image:url(' . ideothemo_get_assets_svg_data('svg/masks/' . $el_background_hover_color_pattern . '.svg', $el_background_hover_color_pattern_color) . ');}';
        break;
    case 'image':

        $less .= '.vc_column_container_hover{';
        if ($el_background_hover_image) {
            $background_image = wp_get_attachment_image_src($el_background_hover_image, 'full');
            $less .= 'background-image:url(' . $background_image[0] . ');';
            $data_hover .= ' data-background-width="' . $background_image[1] . '"';
            $data_hover .= ' data-background-height="' . $background_image[2] . '"';
        }
        if ($el_background_hover_position) $less .= 'background-position:' . $el_background_hover_position . ';';
        if ($el_background_hover_repeat) $less .= 'background-repeat:' . $el_background_hover_repeat . ';';
        if ($el_background_hover_size == 'true') $less .= 'background-size:cover;';
        if ($el_background_hover_motion == 'fixed' || $el_background_hover_motion == 'parallax') {
            $less .= 'background-attachment:fixed;';
        }
        $less .= '&:before{';
        if ($el_background_hover_overlay_pattern) $less .= 'background-image:url(' . ideothemo_get_assets_svg_data('svg/masks/' . $el_background_hover_overlay_pattern . '.svg', $el_background_hover_overlay_pattern_color) . ');';
        if ($el_background_hover_overlay_color) $less .= 'background-color:' . $el_background_hover_overlay_color . ';';
        $less .= '}';

        $less .= '}';
        break;
}

$less .= '}';


$html .= ideothemo_add_style($less, 'vc_shortcodes-custom-css');


$html .= "\n\t" . '<div id="' . esc_attr($el_anchor_point?:$el_uid) . '" class="' . esc_attr($css_class) . ' ' . esc_attr($el_extra_class) . '" data-id="' . esc_attr($el_uid) . '" data-source="' . esc_attr($el_uid) . '" ' . $data . '>';

if ($el_background_hover != '') {
    $html .= '<div class="vc_column_container_hover"></div>';
}


$html .= "\n\t\t" . '<div class="wpb_wrapper">';
$html .= "\n\t\t\t" . wpb_js_remove_wpautop($content);
$html .= "\n\t\t" . '</div> ' . $this->endBlockComment('.wpb_wrapper');


if ($el_url) {
    $el_url = ($el_url == '||') ? '' : $el_url;
    $el_url = vc_build_link($el_url);
    $a_href = $el_url['url'];
    $a_title = $el_url['title'];
    $a_target = trim($el_url['target']);
    $html .= '<a class="vc_column_container_link" href="' . esc_url($a_href) . '"
   title="' . esc_attr($a_title) . '" target="' . esc_attr($a_target) . '"></a>';
}
$html .= "\n\t" . '</div> ' . $this->endBlockComment($el_class) . "\n";

echo $html;