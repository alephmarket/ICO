<?php

function ideothemo_get_the_content($my_postid = null)
{
    global $wp_embed;

    $post = get_post($my_postid);

    if (!$post) {
        return false;
    }

    $wp_embed->post_ID = $post->ID;

    $content = apply_filters('get_the_content', $post->post_content);
    $content = str_replace(']]>', ']]&gt;', $content);

    return do_shortcode($content);
}

function ideothemo_get_paged()
{
    if (get_query_var('paged')) {
        $paged = get_query_var('paged');
    } else if (get_query_var('page')) {
        $paged = get_query_var('page');
    }

    if (empty($paged)) {
        $paged = 1;
    }

    return max(1, $paged);
}

function ideothemo_get_post_type_name($post_type = null)
{
    if (empty($post_type)) {
        $post_type = get_post_type();
    }

    $post_type_object = get_post_type_object($post_type);

    return apply_filters('ideothemo_post_type_name', $post_type_object->labels->name, $post_type, $post_type_object);
}

function ideothemo_get_vimeo_video_id($url)
{

    $url_parts = explode("/", parse_url($url, PHP_URL_PATH));
    if (is_array($url_parts)) {
        return end($url_parts);
    }
    return '';
}

function ideothemo_get_youtube_video_id($url)
{
    $pattern = '%^# Match any youtube URL
        (?:https?://)?  # Optional scheme. Either http or https
        (?:www\.)?      # Optional www subdomain
        (?:             # Group host alternatives
          youtu\.be/    # Either youtu.be,
        | youtube\.com  # or youtube.com
          (?:           # Group path alternatives
            /embed/     # Either /embed/
          | /v/         # or /v/
          | /watch\?v=  # or /watch\?v=
          )             # End path alternatives.
        )               # End host alternatives.
        ([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
        $%x';
    $result = preg_match($pattern, $url, $matches);
    if (false !== $result && isset($matches[1])) {
        return $matches[1];
    }

    return false;
}


function ideothemo_get_assets_svg($filename, $color1 = '#000', $color2 = '#fff', $radius = '46', $stroke = '1', $encode = true)
{ 
    $svg = '';
    $file =  IDEOTHEMO_INIT_DIR . 'assets/' . $filename;
    if (file_exists($file)) {
        $svg = ideothemo_get_contents($file);

        $svg = preg_replace('/@color1/i', '' . $color1 . '', $svg);
        $svg = preg_replace('/@color2/i', '' . $color2 . '', $svg);
        $svg = preg_replace('/@radius/i', '' . $radius . '', $svg);
        $svg = preg_replace('/@stroke/i', '' . $stroke . '', $svg);        
    }        
    return $svg;
}    



function ideothemo_get_assets_svg_data($filename, $color1 = '#000', $color2 = '#fff', $radius = '46', $stroke = '1', $encode = true)
{     
    $svg = ideothemo_get_assets_svg($filename, $color1, $color2, $radius, $stroke, $encode);
    
    if($encode && has_filter('ideothemo_get_assets_svg_data_encode')){
        return apply_filters('ideothemo_get_assets_svg_data_encode', $svg);        
    }else{        
        return 'data:image/svg+xml;utf8,' . rawurlencode($svg);
    }
}    


function ideothemo_get_portfolio_list($ids=false)
{

    $output = array();

    $args = array('post_type' => ideothemo_get_portfolio_slug(), 'posts_per_page' => -1);
    if($ids){
        $args['post__in'] = $ids;
    }
    $query = new WP_Query($args);

    $list_enabled_social = get_list_enabled_social_media();

    // The 2nd Loop
    while ($query->have_posts()) {
        $query->the_post();
        $cf = get_post_meta($query->post->ID, '_ideo_portfolio', true);

        $array = array(
            'post_id' => (int)$query->post->ID,
            'image' => isset($cf['portfolio_modern_featured_image']) ? $cf['portfolio_modern_featured_image'] : '',
            'image_cover' => isset($cf['portfolio_modern_featured_image_cover']) ? $cf['portfolio_modern_featured_image_cover'] : '',
            'image_position' => isset($cf['portfolio_modern_featured_image_position']) ? $cf['portfolio_modern_featured_image_position'] : '',
            'image_repeat' => isset($cf['portfolio_modern_featured_image_repeat']) ? $cf['portfolio_modern_featured_image_repeat'] : '',
            'featured_image' => isset($cf['featured_image']) ? $cf['featured_image'] : '',
            'title' => !empty($cf['portfolio_title']) ? $cf['portfolio_title'] : $query->post->post_title,
            'subtitle' => isset($cf['portfolio_subtitle']) ? $cf['portfolio_subtitle'] : '',
            'social' => ideothemo_portfolio_format_social(null, $list_enabled_social),
            'background_color' => isset($cf['portfolio_modern_pt_background_color']) ? $cf['portfolio_modern_pt_background_color'] : '',
            'content_align' => isset($cf['portfolio_page_title_area_content_align']) ? $cf['portfolio_page_title_area_content_align'] : '',
            'title_font_size' => isset($cf['portfolio_modern_title_font_size']) ? $cf['portfolio_modern_title_font_size'] : '',
            'title_font_color' => isset($cf['portfolio_modern_title_font_color']) ? $cf['portfolio_modern_title_font_color'] : '',
            'subtitle_font_size' => isset($cf['portfolio_modern_subtitle_font_size']) ? $cf['portfolio_modern_subtitle_font_size'] : '',
            'subtitlefont_color' => isset($cf['portfolio_modern_subtitle_font_color']) ? $cf['portfolio_modern_subtitle_font_color'] : '',
            'social_icons_color' => isset($cf['modern_share_color']) ? $cf['modern_share_color'] : '',
            'arrows_color' => isset($cf['modern_nav_arrows_color']) ? $cf['modern_nav_arrows_color'] : '',
            'parameters_display' => isset($cf['portfolio_modern_parameters_display']) ? $cf['portfolio_modern_parameters_display'] : 'inline-block',
            'parametrs_label_color' => isset($cf['modern_parametrs_label_color']) ? $cf['modern_parametrs_label_color'] : '',
            'parametrs_value_color' => isset($cf['modern_parametrs_value_color']) ? $cf['modern_parametrs_value_color'] : '',
            'parametrs_font_size' => isset($cf['portfolio_modern_parametrs_font_size']) ? $cf['portfolio_modern_parametrs_font_size'] : '',
            'portfolio_parametrs' => isset($cf['portfolio_parametrs']) ? $cf['portfolio_parametrs'] : '',
            'portfolio_parameters_arr' => isset($cf['portfolio_parameters_arr']) ? $cf['portfolio_parameters_arr'] : ''            
        );

        $output[$query->post->ID] = $array;
    }

    // Restore original Post Data
    wp_reset_postdata();
    wp_reset_query();

    return $output;
}

if (!function_exists('ideothemo_get_header_logo')) {
    function ideothemo_get_header_logo($type, $retina = false)
    {

        $optionName = 'header.logo.';

        if ($retina) {
            $optionName .= 'retina.';
        }

        $optionName .= $type;

        return ideothemo_get_theme_mod_parse($optionName);
    }
}

if (!function_exists('ideothemo_get_header_logo')) {
    function ideothemo_get_header_logo($type, $retina = false)
    {

        $optionName = 'header.logo.';

        if ($retina) {
            $optionName .= 'retina.';
        }

        $optionName .= $type;

        return ideothemo_get_theme_mod_parse($optionName);
    }
}

if (!function_exists('ideothemo_get_logo_by_header')) {
    function ideothemo_get_logo_by_header($type, $retina = false)
    {
        switch ($type) {
            case 'normal':
                $optionName = ideothemo_get_header_setting('top.logo.type', false);
                break;
            case 'sticky':
                $optionName = ideothemo_get_header_setting('sticky.logo.type', false);
                break;
            case 'side':
                $optionName = ideothemo_get_header_setting('side.logo.type', false);
                break;
            case 'mobile':
                $optionName = ideothemo_get_header_setting('mobile.logo.type', false);
                break;
        }

        $logoType = str_replace('_', '.', $optionName);

        return ideothemo_get_header_logo($logoType, $retina);
    }
}

if (!function_exists('ideothemo_get_link_ajax_card_id')) {
    function ideothemo_get_link_ajax_card_id()
    {
        return empty($_GET['ajax_card']) || !is_numeric($_GET['ajax_card']) ? null : intval($_GET['ajax_card']);
    }
}
