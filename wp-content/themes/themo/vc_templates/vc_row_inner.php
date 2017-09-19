<?php

$output = $el_id = $el_class = $bg_image = $bg_color = $bg_image_repeat = $el_background = $el_background_color = $el_background_image = $el_background_overlay = $el_background_overlay_pattern = $el_background_overlay_pattern_color = $el_background_position = $el_background_repeat = $el_background_size = $el_background_overlay_color = $el_background_motion = $el_background_motion_speed = $el_video_motion = $el_video_ytlink = $el_video_vimeolink = $el_video_mp4 = $el_video_webm = $el_video_ogv = $el_video_fallback_image = $font_color = $padding = $margin_bottom = $css = $full_width = $el_animation = $el_animation_type = $el_animation_row_name = $el_animation_delay = $el_z_index = $el_rwd_lg = $el_rwd_md = $el_rwd_sm = $el_rwd_xs = $el_extra_class = '';
extract(shortcode_atts(array(
    'el_id' => '',
    'el_class' => '',
    'bg_image' => '',
    'bg_color' => '',
    'bg_image_repeat' => '',
    'el_background' => '',
    'el_background_color' => '',
    'el_background_image' => '',
    'el_background_position' => '',
    'el_background_repeat' => 'repeat',
    'el_background_size' => 'false',
    'el_background_overlay' => '',
    'el_background_overlay_color' => '',
    'el_background_overlay_pattern' => '',
    'el_background_overlay_pattern_color' => '',
    'el_background_motion' => 'scroll',
    'el_background_motion_speed' => '0.3',
    'el_video_motion' => 'scroll',
    'el_video_ytlink' => '',
    'el_video_vimeolink' => '',
    'el_video_mp4' => '',
    'el_video_webm' => '',
    'el_video_ogv' => '',
    'el_video_fallback_image' => '',
    'el_video_pattern' => '',
    'el_video_pattern_color' => '',
    'font_color' => '',
    'padding' => '',
    'margin_bottom' => '',
    'full_width' => false,
    'el_animation' => '',
    'el_animation_row_name' => '',
    'el_animation_type' => 'fadeIn',
    'el_animation_delay' => '500',    
    'el_animation_duration' => '1000',
    'el_animation_offset' => '95',
    'el_background_motion' => '',
    'el_background_motion_speed' => '',
    'el_extra_class' => '',
    'css' => '',
    'el_z_index' => '',
    'el_rwd_lg' => 'true',
    'el_rwd_md' => 'true',
    'el_rwd_sm' => 'true',
    'el_rwd_xs' => 'true',
    'el_uid' => ideothemo_shortcode_uid()
), $atts));

if($el_uid == '') $el_uid = ideothemo_shortcode_uid();

$data = '';
$html = '';

if ($el_background_motion) $data .= ' data-motion="' . $el_background_motion . '"';
if ($el_background_motion_speed) $data .= ' data-motion-speed="' . $el_background_motion_speed . '"';


if ($el_rwd_lg == 'false') {
    $el_extra_class .= ' vc_hidden-lg';
}

if ($el_rwd_md == 'false') {
    $el_extra_class .= ' vc_hidden-md';
}

if ($el_rwd_sm == 'false') {
    $el_extra_class .= ' vc_hidden-sm';
}

if ($el_rwd_xs == 'false') {
    $el_extra_class .= ' vc_hidden-xs';
}

$el_class = $this->getExtraClass($el_extra_class);

$less = 'div[data-id="' . $el_uid . '"]{';
$less .= 'position:relative;';
if ($el_z_index != '') {
    $less .= 'z-index:' . (int)$el_z_index . ';';
}

preg_match_all('/\{.+\}/', $css, $matches);

if (isset($matches[0][0])) {
    $less .= '&' . $matches[0][0] . ';';
}

if ($el_background_motion) $data .= ' data-motion="' . $el_background_motion . '"';
if ($el_background_motion_speed) $data .= ' data-motion-speed="' . $el_background_motion_speed . '"';

if ($el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-type="' . $el_animation_type . '"';
if ($el_animation_delay && $el_animation == 'viewport') $data .= ' data-animation-delay="' . $el_animation_delay . '"';
if ($el_animation_duration && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-duration="' . $el_animation_duration . '"';
if ($el_animation_offset && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-offset="' . $el_animation_offset . '"';
if ($el_animation_row_name != '') $data .= ' data-row-name="' . $el_animation_row_name . '"';


switch ($el_background) {
    case 'color':
        if ($el_background_color) $less .= 'background-color:' . $el_background_color . ';';
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
            $less .= '&>.overlay,&>.container>.overlay{background-attachment:fixed;}';
        }

        break;

    case 'video':
        break;
}


$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row ' . ($this->settings('base') === 'vc_row_inner' ? 'vc_inner ' : '') . 
    $el_class . vc_shortcode_custom_css_class($css, ' '), $this->settings['base'], $atts);



if ($el_animation == 'parallax') $css_class .= ' parallax';

$style = $this->buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);
$html .= '<div id="' . ($el_id ?: $el_uid) . '" data-id="' . $el_uid . '" ' . $data . ' class="' . esc_attr($css_class) . ' ' . ($full_width == 'stretch_row_content_no_spaces' ? ' vc_row-no-padding' : '') . ' vc_row_' . $el_background . '"';

if (!empty($full_width)) {
    $html .= ' data-vc-full-width="true"';
    if ($full_width == 'stretch_row_content' || $full_width == 'stretch_row_content_no_spaces') {
        $html .= ' data-vc-stretch-content="true"';
    }
}
$html .= $style . '>';

switch ($el_background) {
    case 'color':
        break;

    case 'image':
        break;

    case 'video':
        $style_video_background = '';
        if ($el_video_fallback_image) {
            $fallback_image = wp_get_attachment_image_src($el_video_fallback_image, 'full');
            $less .= '@media (max-width: 991px) { .video-background{background-image:url(' . $fallback_image[0] . ');}}';
        }

        if ($el_video_ytlink) {
            $html .= '<div class="video-background ' . $el_video_motion . ' ' . $el_visabillity . ' ' . $el_extra_class . '" style="' . $style_video_background . '" data-youtube_id="' . ideothemo_get_youtube_video_id($el_video_ytlink) . '">';
        } else
            if ($el_video_vimeolink) {
                $html .= '<div class="video-background ' . $el_video_motion . ' ' . $el_visabillity . '" style="' . $style_video_background . '"><iframe class="video-player"
         src="//player.vimeo.com/video/' . ideothemo_get_vimeo_video_id($el_video_vimeolink) . '?background=1&loop=1" title="vimeo video player"
         width="960" height="540" webkitallowfullscreen
         mozallowfullscreen allowfullscreen></iframe>';
            } else
                if ($el_video_mp4 || $el_video_webm || $el_video_ogv) {
                    $html .= '<div class="video-background ' . $el_video_motion . ' ' . $el_visabillity . '" style="' . $style_video_background . '"><video class="video-player" muted autoplay loop>';
                    if ($el_video_mp4) $html .= ' <source src="' . $el_video_mp4 . '" type="video/mp4">';
                    if ($el_video_webm) $html .= ' <source src="' . $el_video_webm . '" type="video/webm">';
                    if ($el_video_ogv) $html .= ' <source src="' . $el_video_ogv . '" type="video/ogg">';
                    $html .= '</video>';
                }

        $html .= '</div>';
        break;
}


if ($el_background_overlay == 'pattern' && $el_background_overlay_pattern) {
    $less .= '&>.overlay,&>.container>.overlay{background-image:url(' . ideothemo_get_assets_svg_data('svg/masks/' . $el_background_overlay_pattern . '.svg', $el_background_overlay_pattern_color) . ');}';
} else
    if ($el_background_overlay == 'color') {
        $less .= '&>.overlay,&>.container>.overlay{background-color:' . $el_background_overlay_color . ';}';
    }

$html .= '<div class="overlay"></div>';

$html .= wpb_js_remove_wpautop($content);//FIXME: wpb_js_remove_wpautop  3s

$less .= '}';
$html .= ideothemo_add_style($less, 'vc_shortcodes-custom-css');

$html .= '</div>' . $this->endBlockComment('row');

echo trim($html);

