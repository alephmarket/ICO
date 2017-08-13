<?php

$html = $css = $el_class = $el_id = $el_uid = $el_fullwidth_content = $el_row_height = $el_content_center = $el_background = $el_background_color = $el_background_image = $el_background_overlay = $el_background_overlay_pattern = $el_background_overlay_pattern_color = $el_background_position = $el_background_repeat = $el_background_size = $el_background_overlay_color = $el_background_motion = $el_background_motion_speed = $el_video_motion = $el_video_ytlink = $el_video_vimeolink = $el_video_mp4 = $el_video_webm = $el_video_ogv = $el_video_fallback_image = $el_text_color = $el_full_height = $el_visabillity = $el_top_separator = $el_top_separator_color1 = $el_top_separator_color2 = $el_bottom_separator = $el_bottom_separator_color1 = $el_bottom_separator_color2 = $el_extra_class = $el_custom_css = $el_animation = $el_animation_type = $el_animation_row_name = $el_animation_delay = $el_z_index = $el_rwd_lg = $el_rwd_md = $el_rwd_sm = $el_rwd_xs = $el_padding_top = $el_padding_bottom = '';

extract(shortcode_atts(array(
    'el_id' => '',
    'el_uid' => ideothemo_shortcode_uid(),
    'el_fullwidth_content' => 'false',
    'el_row_height' => '',
    'el_content_center' => '',
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
    'el_full_height' => 'false',
    'el_top_separator' => '',
    'el_top_separator_color1' => '',
    'el_top_separator_color2' => '',
    'el_bottom_separator' => '',
    'el_bottom_separator_color1' => '',
    'el_bottom_separator_color2' => '',
    'el_extra_class' => '',
    'el_custom_css' => '',
    'css' => '',
    'el_z_index' => '',
    'el_rwd_lg' => 'true',
    'el_rwd_md' => 'true',
    'el_rwd_sm' => 'true',
    'el_rwd_xs' => 'true',
    'el_animation' => '',
    'el_animation_type' => 'fadeIn',
    'el_animation_delay' => '500',    
    'el_animation_duration' => '1000',
    'el_animation_offset' => '95',
    'el_animation_row_name' => ''
), $atts));

if($el_uid == '') $el_uid = ideothemo_shortcode_uid();


wp_enqueue_script('wpb_composer_front_js');

$el_class = $this->getExtraClass($el_class);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row ' . ($this->settings('base') === 'vc_row_inner' ? 'vc_inner ' : '') . 
    $el_class . vc_shortcode_custom_css_class($css, ' '), $this->settings['base'], $atts);


$data = '';
$script = '';

$less = '.vc_page_section[data-id="' . $el_uid . '"]{';

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


if ($el_row_height && $el_full_height == 'false') {
    $less .= 'min-height:' . ideothemo_get_size($el_row_height) . ';';
    $cell_height = ideothemo_get_size($el_row_height) . '-' . ideothemo_get_size($el_padding_top) . '-' . ideothemo_get_size($el_padding_bottom);
    $less .= '& > div[class*="col-"], .dcenter{min-height:(' . $cell_height . ');}';
} else if ($el_full_height == 'true') {

    $cell_height = ideothemo_get_size($el_row_height) . '-' . ideothemo_get_size($el_padding_top) . '-' . ideothemo_get_size($el_padding_bottom);
    $less .= '& > div[class*="col-"], .dcenter{min-height:(' . $cell_height . ');}';
}

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

$full_height_class = '';
if ($el_full_height == 'true') {
    $full_height_class .= ' full-screen-height';

    if ($el_content_center == 'centred_content') {
        $full_height_class .= ' content-center';
    }
    if ($el_content_center == 'full_height_column') {
        $full_height_class .= ' full-height-column';
    }
}


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

if ($el_animation == 'parallax') $el_extra_class .= ' parallax ';

/*Adding classes sidebar and sidebar skin to PS contain shortcodes WP widgets to color widgets correctly */
if (has_shortcode($content, 'vc_wp_archives') || has_shortcode($content, 'vc_wp_calendar') || has_shortcode($content, 'vc_wp_categories') || has_shortcode($content, 'vc_wp_custommenu') || has_shortcode($content, 'vc_wp_links') || has_shortcode($content, 'vc_wp_meta') || has_shortcode($content, 'vc_wp_pages') || has_shortcode($content, 'vc_wp_posts') || has_shortcode($content, 'vc_wp_recentcomments') || has_shortcode($content, 'vc_wp_rss') || has_shortcode($content, 'vc_wp_search') || has_shortcode($content, 'vc_wp_tagcloud') || has_shortcode($content, 'vc_wp_text') || has_shortcode($content, 'ideo_wp_newest_posts')) $el_extra_class .= ' sidebar '; 

if (ideothemo_get_general_theme_skin()=='dark'){
    $el_extra_class .= ' skin-light ';
} else {
    $el_extra_class .= ' skin-dark ';
}
/*END adding classes*/

$html .= '<div id="' . ($el_id ?: $el_uid) . '" data-id="' . $el_uid . '" ' . $data . ' class="vc_page_section vc_page_section_' . $el_background . ' ' . $el_visabillity . ' ' . $el_extra_class . '' . $full_height_class . ' ">';


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
            $html .= '<div class="video-background ' . $el_video_motion . ' ' . $el_visabillity . '" style="' . $style_video_background . '" data-youtube_id="' . ideothemo_get_youtube_video_id($el_video_ytlink) . '">';
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

if ($el_top_separator) {
    $svg =  ideothemo_get_assets_svg_data('svg/' . $el_top_separator, $el_top_separator_color1, $el_top_separator_color2);
    $html .= '<div class="separator separator-top">' . ideothemo_get_assets_svg('svg/' . $el_top_separator, $el_top_separator_color1, $el_top_separator_color2, NULL, NULL, false) . '</div>';
}

if ($el_bottom_separator) {
    $svg = ideothemo_get_assets_svg_data('svg/' . $el_bottom_separator, $el_bottom_separator_color1, $el_bottom_separator_color2);
    $html .= '<div class="separator separator-bottom">' . ideothemo_get_assets_svg('svg/' . $el_bottom_separator, $el_bottom_separator_color1, $el_bottom_separator_color2, NULL, NULL, false) . '</div>';
}

if ($el_fullwidth_content == 'false' && !ideothemo_is_boxed_version()) {
    $html .= '    <div class="container"><div class="row">' . wpb_js_remove_wpautop($content) . '</div></div>';
} else {
    $html .= '    <div class="row">' . wpb_js_remove_wpautop($content) . '</div>';//FIXME: wpb_js_remove_wpautop  3s
}


$less .= '}';
$html .= ideothemo_add_style($less, 'vc_shortcodes-custom-css');

$html .= '</div>' . $this->endBlockComment('row');

echo trim($html);
