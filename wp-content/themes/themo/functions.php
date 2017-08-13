<?php
require_once(get_template_directory() . '/inc/theme_init.php');


if (!isset($content_width)) {
    $content_width = 660;
}

add_action('customize_preview_init', 'ideothemo_customize_preview_init');

function ideothemo_customize_preview_init()
{
    $controls = ideothemo_get_customizer_local_modification_trigger_controls();

    update_option('ideo_customizer_local_modification_trigger_controls', serialize($controls), false);
}

add_action('after_setup_theme', 'ideothemo_setup');

function ideothemo_setup()
{
    load_theme_textdomain('themo', get_template_directory() . '/languages');

    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');    
    add_theme_support( 'custom-header');
    add_theme_support( 'custom-background');
    add_theme_support( 'automatic-feed-links' );

    set_post_thumbnail_size(865, 450, true);

    add_image_size('ideothemo-blog-featured-image', 865, 450, true);
    add_image_size('ideothemo-blog-thumbnail-widget', 75, 60, true);
    add_image_size('ideothemo-blog-list-image', 1024, 1024, false);
    add_image_size('ideothemo-blog-classic', 1024, 0, false);
    add_image_size('ideothemo-blog-masonry', 500, 0, false);

    // -sc (shortcode)
    add_image_size('ideothemo-team-box-sc', 560, 560, true);
    add_image_size('ideothemo-team-box-sc-window-modal', 140, 140, true);
    add_image_size('ideothemo-testimonial-slider-image-sc', 100, 100, true);

    function ideothemo_register_custom_nav_menus()
    {
        register_nav_menus(array(
            'fourth-menu' => esc_html__('Fourth Navigation', 'themo'),
            'fifth-menu' => esc_html__('Fifth Navigation', 'themo'),
        ));
    }

    add_action('init', 'ideothemo_register_custom_nav_menus');

    register_sidebar(array(
        'name' => esc_html__('Default Sidebar', 'themo'),
        'id' => 'sidebar-1',
        'class' => 'widget-sidebar',
        'description' => esc_html__('Widgets in this area will be shown on all posts and pages.', 'themo'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Header Topbar Left', 'themo'),
        'id' => 'header-topbar-left',
        'class' => 'widget-sidebar',
        'description' => esc_html__('Widgets in this area will be shown on all posts and pages.', 'themo'),
        'before_widget' => '<div id="%1$s" class="topbar-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="topbar-widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Header Topbar Right', 'themo'),
        'id' => 'header-topbar-right',
        'class' => 'widget-sidebar',
        'description' => esc_html__('Widgets in this area will be shown on all posts and pages.', 'themo'),
        'before_widget' => '<div id="%1$s" class="topbar-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="topbar-widget-title">',
        'after_title' => '</h3>',
    ));

    ideothemo_register_footer_sidebars(4);

    add_theme_support('post-formats', array(
        'video', 'quote', 'link', 'gallery', 'audio'
    ));
}

add_action('init', 'ideothemo_register_sidebars');

function ideothemo_register_sidebars()
{
    foreach (get_option('ideo_sidebars', array()) AS $id => $name) {

        register_sidebar(
            apply_filters('ideothemo_register_sidebar_args',
                          array(
                              'name' => $name,
                              'id' => $id,
                              'description' => '',
                              'class' => '',
                              'before_widget' => '<div id="%1$s" class="widget %2$s">',
                              'after_widget' => '</div>',
                              'before_title' => '<h3 class="widget-title">',
                              'after_title' => '</h3>'
                          ), $id)
        );
    }
}


/**
 * Function get a similar posts
 *
 * @param array $args
 * @return WP_Query
 */

function ideothemo_get_similar_posts($args = array())
{
    $default = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 3,
        'post__not_in' => array(get_the_ID()),
        'category__in' => wp_get_post_categories(get_the_ID())
    );

    $args = array_merge($default, $args);

    return new WP_Query(
        apply_filters('get_similar_posts_args', $args)
    );
}


/**
 * Filter Comment fields
 */

add_filter('comment_form_default_fields', 'ideothemo_filter_comment_form_default_fields');

function ideothemo_filter_comment_form_default_fields($fields)
{
    $fields['url'] = '';
    $fields['author'] = '<p class="comment-form-author"><input id="author" name="author" type="text" value="" size="30" placeholder="'.esc_html__('Name (required)', 'themo').'" aria-required="true"></p>';
    $fields['email'] = '<p class="comment-form-email"><input id="email" name="email" placeholder="'.esc_html__('E-mail (required)', 'themo').'" type="text" value="" size="30" aria-describedby="email-notes" aria-required="true"></p>';

    return $fields;
}

function ideothemo_custom_posts_per_page($query)
{
    /** @var WP_Query $query */

    if (is_admin() || !$query->is_main_query())
        return;

    if ($query->is_archive()) {
        $query->set('posts_per_page', ideothemo_get_blog_archives_posts_per_page());
    } elseif ($query->is_search()) {
        $query->set('posts_per_page', ideothemo_get_blog_search_posts_per_page());
    }
}

add_action('pre_get_posts', 'ideothemo_custom_posts_per_page');

if(class_exists('IdeoThemoGoogleFontsApi')){
    $fonts = new IdeoThemoGoogleFontsApi;
}

function IdeoShortcodeMapsArrayJs()
{
    global $vc_manager, $test;

    if(!class_exists('IdeoThemoTinyMCEShortcodesGenerator')){
        return false;
    }

    if (is_a($vc_manager, 'Vc_Manager')) {
        $vc_manager->mapper()->init();

        foreach (WPBMap::getShortCodes() AS $shortcode) {
            IdeoThemoShortcodeMaps::addVcShortcode($shortcode);
        }
    }

    $columns = IdeoThemoTinyMCEShortcodesGenerator::get();

    foreach ($columns as $column) {
        IdeoThemoShortcodeMaps::addShortcode($column[0], $column[1], '');
    }

    wp_localize_script('ideothemo-admin-script', '_ideo_shortcodes',  json_encode(IdeoThemoShortcodeMaps::getShortcodes()));

}

add_filter('body_class', 'ideothemo_body_class_filter', 10, 2);

function ideothemo_body_class_filter($classes, $class)
{
    global $is_safari;

    $classes[] = 'skin-' . ideothemo_get_general_theme_skin();
    $classes[] = 'background-page';

    if (ideothemo_is_boxed_version()) {

        $classes = array_merge($classes, ideothemo_get_background_classes(array(
            'background-type' => ideothemo_get_boxed_background_type(1),
            'background-overlay' => ideothemo_get_boxed_background_overlay_type(1),
            'background-video-platform' => ideothemo_get_boxed_background_video_platform(1)
        )));
    }
    $classes[] = ideothemo_get_layout_type_class();
    $classes[] = 'header-' . (!ideothemo_header_is_enabled() ? 'off' : 'on');
    //This one is risky, is necessary for archive.php for working height
    $classes[] = ideothemo_is_nopo_template() ? 'page' : '';
    
    if ( !defined('IDEOTHEMO_CORE_VERSION') && is_singular('post') && ideothemo_get_page_title_local_setting('pagetitle.page_title_settings.page_title_area') == null ){
        $classes[] = 'pagetitle-off'; 
    }else{        
        $classes[] = 'pagetitle-' . (ideothemo_page_title_area_enabled() ? 'on' : 'off'); 
    }
    $classes[] = 'sidebar-' . (ideothemo_is_sidebar_enabled() ? 'on' : 'off');
    $classes[] = 'sidebar-' . (ideothemo_get_sidebar_position() == 'left_sidebar' ? 'left' : (ideothemo_get_sidebar_position() == 'right_sidebar' ? 'right' : 'none'));
    if (!is_archive() && !is_search()) {
        $classes[] = 'vc-' . (ideothemo_is_vc_used() ? 'on' : 'off');
    }
    $classes[] = 'slider-' . (ideothemo_is_slider_used() ? 'on' : 'off');
    $classes[] = 'topbar-' . (ideothemo_get_header_true('top.topbar.enabled') && ideothemo_get_header_setting('type') != 'side_left_header' && ideothemo_get_header_setting('type') != 'side_right_header' ? 'on' : 'off');

    if ($is_safari) {
        $classes[] = 'browser-safari';
    }
    if(!defined('IDEOTHEMO_CORE_VERSION')){   
        $classes[] = 'no-ideothemo-core';
    }

    return $classes;
}


function ideothemo_is_first_visit()
{
    return isset($_COOKIE['first_visit']);
}

function ideothemo_check_first_visit()
{
    if (!isset($_COOKIE['no_first_visit']) && !isset($_COOKIE['first_visit'])) {
        $_COOKIE['first_visit'] = 1;
        setcookie('first_visit', '1', 0, '/');
    } else {
        if (isset($_COOKIE['first_visit'])) {
            setcookie('first_visit', 0, time() - 3600, '/');
            unset($_COOKIE['first_visit']);
        }

        if (!isset($_COOKIE['no_first_visit'])) {
            setcookie('no_first_visit', '1', 0, '/');
        }
    }
}

add_action('init', 'ideothemo_check_first_visit');

function ideothemo_page_loading_logo()
{
    if (ideothemo_is_advanced_sticky_loading()) {
        $logo = ideothemo_get_theme_mod_parse('advanced.advanced_loading.logo');

        if (wp_get_referer() === false && !empty($logo)) {
            wp_add_inline_script('ideothemo-scripts',sprintf('var img = new Image();img.src="%s";', $logo));
        }
    }
}

add_action('after_switch_theme', 'ideothemo_switch');

function ideothemo_switch()
{
    global $wp_filesystem;

    $path_gen = IDEOTHEMO_GENERATED_DIR;
    $path_cache = IDEOTHEMO_CACHE_DIR;
    $access_type = get_filesystem_method();

    if($access_type == 'ftpsockets'){      
        //If path FTP and WP_CONTENT_DIR is different
        $subpath = explode($wp_filesystem->wp_content_dir(), IDEOTHEMO_GENERATED_DIR );
        if(count($subpath) == 2){
            $path_gen = $wp_filesystem->wp_content_dir() . $subpath[1];            
        }       
        $subpath = explode($wp_filesystem->wp_content_dir(), IDEOTHEMO_CACHE_DIR );
        if(count($subpath) == 2){
            $path_cache = $wp_filesystem->wp_content_dir() . $subpath[1];            
        }
    }

    // Copy pre-generated css files

    if($filelist = $wp_filesystem->dirlist($path_gen)){

        if (!$wp_filesystem->is_dir($path_cache)) {
            wp_mkdir_p($path_cache);
        }

        foreach($filelist as $file=>$data){ 
            $wp_filesystem->copy($path_gen . $file, $path_cache . $file, false);
        }       
    }    

    // Generate new styles
    wp_remote_request(esc_url(admin_url('admin-ajax.php') . '?action=generate_all_css'), array(
        'method' => 'GET',
        'blocking' => false,
        'timeout' => 0.1
    ));
}

add_filter('404_template', 'ideothemo_show_404_page');

function ideothemo_show_404_page($template)
{
    global $wp_query;

    $page_id = ideothemo_get_theme_mod_parse('advanced.advanced_404.404_choose');

    if ($page_id > 0) {
        $wp_query = new WP_Query('page_id=' . $page_id);
        $wp_query->the_post();
        $template = get_page_template();
        rewind_posts();
        ideothemo_is_custom_404(true);

        return $template;
    }

    return get_query_template('page', array('page-templates/404.php'));
}

add_filter('get_search_form', 'ideothemo_search_form');

function ideothemo_search_form($text)
{
    $text = preg_replace('/type *= *[\'"]text[\'"]/', '$0 placeholder="' . esc_html__('Search', 'themo') . '"', $text);
    return $text;
}

add_filter('pre_get_document_title', 'ideothemo_page_title');

function ideothemo_page_title($title)
{
    if (is_404() || ideothemo_is_custom_404())
        return esc_html__('Page not found', 'themo') . ' | ' . get_bloginfo('name');

    return $title;
}
