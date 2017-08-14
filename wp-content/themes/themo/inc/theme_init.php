<?php
define('IDEOTHEMO_VERSION', '1.4.2');

if (!defined('IDEOTHEMO_DEVELOP_MODE')) {
    define('IDEOTHEMO_DEVELOP_MODE', false);
}

if (IDEOTHEMO_DEVELOP_MODE === true) {
    define('IDEOTHEMO_JS_MODE', '.js');
} else {
    define('IDEOTHEMO_JS_MODE', '.min.js');
}

define('IDEOTHEMO_INIT_DIR', get_template_directory() . DIRECTORY_SEPARATOR);
define('IDEOTHEMO_INIT_DIR_URI', get_template_directory_uri());

global $wp_filesystem;

if (empty($wp_filesystem)) {
    require_once(ABSPATH . '/wp-admin/includes/file.php');

    $creds = request_filesystem_credentials(site_url() . '/wp-admin/', '', false, false, array());
    WP_Filesystem($creds);
}


$upload_dir = wp_upload_dir();

if (is_writable($upload_dir['basedir'])) {
    $basedir = $upload_dir['basedir'];
    $baseurl = $upload_dir['baseurl'];
    if (!$wp_filesystem->is_dir($basedir . '/cache/css/')) {
        wp_mkdir_p($basedir . '/cache/');
        wp_mkdir_p($basedir . '/cache/css/');
    }
} else {
    $basedir = WP_CONTENT_DIR;
    $baseurl = WP_CONTENT_URL;
}

define('IDEOTHEMO_LESS_DIR', IDEOTHEMO_INIT_DIR . '/inc/less' . DIRECTORY_SEPARATOR);
define('IDEOTHEMO_SC_LESS_DIR', IDEOTHEMO_INIT_DIR . '/inc/vc_extend/less' . DIRECTORY_SEPARATOR);
define('IDEOTHEMO_GENERATED_DIR', get_template_directory() . '/assets/css' . DIRECTORY_SEPARATOR);

define('IDEOTHEMO_CACHE_DIR', $basedir . '/cache/css/');
define('IDEOTHEMO_CACHE_URL', $baseurl . '/cache/css/');

require_once(get_template_directory() . '/inc/customizer/customizer.php');
require_once(get_template_directory() . '/inc/pc/pc.php');


require_once(IDEOTHEMO_INIT_DIR . 'inc/class/class.IdeoGlobalVars.php');
require_once(IDEOTHEMO_INIT_DIR . 'inc/param_init.php');
require_once(IDEOTHEMO_INIT_DIR . 'inc/helpers.php');
require_once(IDEOTHEMO_INIT_DIR . 'inc/ajax.php');
require_once(IDEOTHEMO_INIT_DIR . 'inc/widgets.php');
require_once(IDEOTHEMO_INIT_DIR . 'inc/filters.php');
require_once(IDEOTHEMO_INIT_DIR . 'inc/actions.php');
require_once(IDEOTHEMO_INIT_DIR . 'inc/class-tgm-plugin-activation.php');
require_once(IDEOTHEMO_INIT_DIR . 'inc/wp_bootstrap_navwalker.php');


require_once(IDEOTHEMO_INIT_DIR . 'inc/meta_boxes.php');
require_once(IDEOTHEMO_INIT_DIR . 'inc/menufield/function.php');


function ideothemo_overwrite_wp_enqueue()
{
    wp_dequeue_style('font-awesome');
    wp_enqueue_style('font-awesome', IDEOTHEMO_INIT_DIR_URI . '/css/font-awesome.min.css', array(), '4.3.0');
}

add_action('wp_head', 'ideothemo_overwrite_wp_enqueue', 101);

function ideothemo_overwrite_wp_scripts()
{

    //Advanced Carousel for Visual Composer
    if (class_exists("Ultimate_Carousel")) {
        wp_dequeue_script("ult-slick");
        wp_enqueue_script("ideothemo-ult-slick", IDEOTHEMO_INIT_DIR_URI . '/js/slick/slick.custom' . IDEOTHEMO_JS_MODE, array());
    }

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

}

add_action('wp_enqueue_scripts', 'ideothemo_overwrite_wp_scripts', 101);

function ideothemo_scripts_styles()
{
   
    if (IDEOTHEMO_DEVELOP_MODE === true) {
        wp_enqueue_style('ideothemo-ideo-transition', IDEOTHEMO_INIT_DIR_URI . '/css/ideo-transition.min.css', array(), IDEOTHEMO_VERSION);
        wp_enqueue_style('ideothemo-pc', IDEOTHEMO_INIT_DIR_URI . '/inc/pc/css/pc.css', array(), IDEOTHEMO_VERSION);
        wp_enqueue_style('ideothemo-font-ideo', IDEOTHEMO_INIT_DIR_URI . '/css/font-ideo.css', array(), IDEOTHEMO_VERSION);
        wp_enqueue_style('bootstrap', IDEOTHEMO_INIT_DIR_URI . '/css/bootstrap.min.css', array(), '3.3.5');
        wp_enqueue_style('magnific', IDEOTHEMO_INIT_DIR_URI . '/css/magnific-popup.css', array(), '3.3.4');
        wp_enqueue_style('animate', IDEOTHEMO_INIT_DIR_URI . '/css/animate.css', array(), IDEOTHEMO_VERSION);
        wp_enqueue_style('grey', IDEOTHEMO_INIT_DIR_URI . '/css/gray.min.css', array(), '1.4.2');
        wp_enqueue_style('selectric', IDEOTHEMO_INIT_DIR_URI . '/css/selectric.css', array(), '1.9.3');
        wp_enqueue_style('hamburgers', IDEOTHEMO_INIT_DIR_URI . '/css/hamburgers.min.css', array(), IDEOTHEMO_VERSION);
    } else {
        wp_enqueue_style('ideothemo-libs', IDEOTHEMO_INIT_DIR_URI . '/css/libs.min.css', array(), IDEOTHEMO_VERSION);
    }

    wp_enqueue_style('ideothemo-style', IDEOTHEMO_INIT_DIR_URI . '/css/style.css', array(), IDEOTHEMO_VERSION);

    if (class_exists('WPBakeryVisualComposerAbstract')) {
        wp_enqueue_style('js_composer_front');
    }
    wp_enqueue_style('themepunchboxextcss');

    wp_enqueue_style('ideothemo-style-cache', IDEOTHEMO_CACHE_URL . 'style.css', array(), get_option('ideo_css_date'));

    if (is_singular() && file_exists(IDEOTHEMO_CACHE_DIR . 'post-' . get_the_ID() . '.css')) {
        wp_enqueue_style('ideothemo-style-page-' . get_the_ID(), IDEOTHEMO_CACHE_URL . 'post-' . get_the_ID() . '.css', array(), get_post_meta(get_the_ID(), 'ideo_css_date', 1));
    }

    wp_enqueue_style('ideothemo-shortcode', IDEOTHEMO_INIT_DIR_URI . '/inc/vc_extend/css/shortcode.css', array(), '1.0.0');

    if (is_singular() && file_exists(IDEOTHEMO_CACHE_DIR . 'shortcode.css')) {
        wp_enqueue_style('ideothemo-shortcode-style', IDEOTHEMO_CACHE_URL . 'shortcode.css', array(), get_post_meta(get_the_ID(), 'ideo_css_date', 1));
    }

    if (ideothemo_is_nopo_template() || is_front_page()) {
        $post_id = ideothemo_get_inheritet_pt_page_id();

        if (file_exists(IDEOTHEMO_CACHE_DIR . 'post-' . $post_id . '.css')) {
            wp_enqueue_style('ideothemo-style-page-' . $post_id, IDEOTHEMO_CACHE_URL . 'post-' . $post_id . '.css', array(), get_post_meta($post_id, 'ideo_css_date', 1));
        }
    }
    if (is_404()) {
        wp_add_inline_style('ideothemo-style-page-0', '
            html, body { height: 100%; }
            .error404.wrap-boxed #content  { height: 100vh; }
            #ideo-page, #ideo-transition-page-container, #page-container, #content, .e404-container, .e404-row, .e404-entry-content { height: 100%; min-height: 100%; }
            .e404-entry-content { padding: 0; }
            .page-title-row { display: none !important; }
        ');
    }
    wp_enqueue_script('ideothemo-scripts-config', IDEOTHEMO_INIT_DIR_URI . '/js/script-config' . IDEOTHEMO_JS_MODE, array('jquery'), IDEOTHEMO_VERSION, false);
    
    if (IDEOTHEMO_DEVELOP_MODE === true) {
        wp_register_script('mousewheel', IDEOTHEMO_INIT_DIR_URI . '/js/jquery.mousewheel.min.js', array('jquery'), '3.1.13', true);
        wp_register_script('jquery-easing', IDEOTHEMO_INIT_DIR_URI . '/js/jquery.easing.min.js', array('jquery'), '1.3.0', true);
        wp_register_script('tweenmax', IDEOTHEMO_INIT_DIR_URI . '/js/greensock/TweenMax.min.js', array('jquery'), '1.18.0', true);
        wp_register_script('tweenmax-scrollto', IDEOTHEMO_INIT_DIR_URI . '/js/greensock/plugins/ScrollToPlugin.min.js', array('jquery', 'tweenmax'), '1.7.6', true);
        wp_register_script('bootstrap', IDEOTHEMO_INIT_DIR_URI . '/js/bootstrap.min.js', array('jquery'), '3.3.4', true);
        wp_register_script('jquery-mobile-custom', IDEOTHEMO_INIT_DIR_URI . '/js/jquery.mobile.custom.min.js', array('jquery'), '1.4.5', true);
        wp_register_script('onscreen', IDEOTHEMO_INIT_DIR_URI . '/js/jquery.onscreen.min.js', array('jquery'), IDEOTHEMO_VERSION, true);
        wp_register_script('waypoint', IDEOTHEMO_INIT_DIR_URI . '/js/jquery.waypoints.min.js', array('jquery'), IDEOTHEMO_VERSION, true);
        wp_register_script('ideothemo-ideo-plugins', IDEOTHEMO_INIT_DIR_URI . '/js/jquery.ideo.plugins' . IDEOTHEMO_JS_MODE, array('jquery'), IDEOTHEMO_VERSION, true);
        wp_register_script('ideothemo-parallax', IDEOTHEMO_INIT_DIR_URI . '/js/jquery.parallax-1.1.3' . IDEOTHEMO_JS_MODE, array('jquery'), '1.1.3', true);
        wp_register_script('ideothemo-mouse-parallax', IDEOTHEMO_INIT_DIR_URI . '/js/jquery.mousemove-parallax' . IDEOTHEMO_JS_MODE, array('jquery'), IDEOTHEMO_VERSION, true);
        wp_register_script('ideothemo-parallax-opacity', IDEOTHEMO_INIT_DIR_URI . '/js/jquery.parallax-opacity' . IDEOTHEMO_JS_MODE, array('jquery'), IDEOTHEMO_VERSION, true);
        wp_register_script('ideothemo-parallax-obj', IDEOTHEMO_INIT_DIR_URI . '/js/jquery.parallax-obj' . IDEOTHEMO_JS_MODE, array('jquery'), IDEOTHEMO_VERSION, true);
        wp_register_script('ideothemo-parallax-height', IDEOTHEMO_INIT_DIR_URI . '/js/jquery.parallax-height' . IDEOTHEMO_JS_MODE, array('jquery'), IDEOTHEMO_VERSION, true);
        wp_register_script('isotope', IDEOTHEMO_INIT_DIR_URI . '/js/isotope.pkgd.min.js', array('jquery'), '2.2.2', true);
        wp_register_script('typed', IDEOTHEMO_INIT_DIR_URI . '/js/typed.js', array('jquery'), '1.1.1', true);
        wp_register_script('grey', IDEOTHEMO_INIT_DIR_URI . '/js/jquery.gray.min.js', array('jquery'), '1.4.2', true);
        wp_register_script('magnific', IDEOTHEMO_INIT_DIR_URI . '/js/jquery.magnific-popup.min.js', array('jquery'), '1.0.0', true);
        wp_register_script('selectric', IDEOTHEMO_INIT_DIR_URI . '/js/jquery.selectric.min.js', array('jquery'), '1.9.3', true);
        wp_register_script('retina', IDEOTHEMO_INIT_DIR_URI . '/js/vendor/retina.min.js', null, '1.3.0');
        wp_register_script('imagesloaded', IDEOTHEMO_INIT_DIR_URI . '/js/imagesloaded.pkgd.min.js', 'isotope', '4.1.1');
    } else {
        wp_register_script('ideothemo-libs', IDEOTHEMO_INIT_DIR_URI . '/js/libs.js', null, '1.0.0');
    }

    if ($google_maps_key = ideothemo_get_advanced_google_maps_api_key()) {
        wp_register_script('ideothemo-maps-googleapis', 'https://maps.googleapis.com/maps/api/js?v=3.exp&key=' . $google_maps_key, array('underscore'), 'v3');
    }

    /*
     * Library for color manipulatin
     * https://github.com/bgrins/TinyColor
     */
    wp_register_script('ideothemo-tiny-color', IDEOTHEMO_INIT_DIR_URI . '/js/vendor/tinycolor-min.js', false, '1.3.0');
    wp_enqueue_script('ideothemo-youtubebackground', IDEOTHEMO_INIT_DIR_URI . '/js/jquery.youtubebackground' . IDEOTHEMO_JS_MODE, array('jquery'), IDEOTHEMO_VERSION, true);

    if (ideothemo_is_advanced_sticky_loading()) {
        wp_enqueue_script('ideothemo-ideo-transition', IDEOTHEMO_INIT_DIR_URI . '/js/ideo.transition' . IDEOTHEMO_JS_MODE, array('jquery'), IDEOTHEMO_VERSION, true);

        wp_add_inline_script('ideothemo-ideo-transition', '
        jQuery(document).ready(function(){
            ideotransition({
                "transitionIn": "' . ideothemo_get_theme_mod_parse('advanced.advanced_loading.transition_in') . '", 
                "transitionOut": "' . ideothemo_get_theme_mod_parse('advanced.advanced_loading.transition_out') . '"
            }); 
        });
        ');
        wp_enqueue_script('ideothemo-ideo-transition', IDEOTHEMO_INIT_DIR_URI . '/js/ideo.transition' . IDEOTHEMO_JS_MODE, array('jquery'), IDEOTHEMO_VERSION, true);

        wp_add_inline_style('ideothemo-style', '
                .sk-rotating-plane,
                .sk-double-bounce .sk-child,
                .sk-wave .sk-rect,
                .sk-wandering-cubes .sk-cube,
                .sk-spinner-pulse,
                .sk-chasing-dots .sk-child,
                .sk-three-bounce .sk-child,
                .sk-circle .sk-child:before,
                .sk-cube-grid .sk-cube,
                .sk-fading-circle .sk-circle:before,
                .sk-folding-cube .sk-cube:before,
                .ball-pulse > div,
                .ball-grid-pulse > div,
                .ball-pulse-rise > div,
                .ball-rotate > div,
                .cube-transition > div,
                .ball-zig-zag > div,
                .ball-zig-zag-deflect > div,
                .ball-scale > div,
                .line-scale > div,
                .line-scale-party > div,
                .ball-scale-multiple > div,
                .ball-pulse-sync > div,
                .ball-beat > div,
                .line-scale-pulse-out > div,
                .line-scale-pulse-out-rapid > div,
                .line-spin-fade-loader > div,
                .ball-grid-beat > div,
                .square-spin > div,
                .ball-spin-fade-loader > div,
                .pacman > div:nth-child(3), .pacman > div:nth-child(4), .pacman > div:nth-child(5), .pacman > div:nth-child(6),
                .ball-clip-rotate-pulse > div:first-child,
                .ball-rotate > div:before, .ball-rotate > div:after
                {
                    background: ' . ideothemo_get_advanced_loader_color() . ';
                }

                .square-spin > div,
                .ball-clip-rotate > div,
                .ball-triangle-path > div,
                .ball-scale-ripple > div,
                .ball-scale-ripple-multiple > div{
                    border-color: ' . ideothemo_get_advanced_loader_color() . ';
                }

                .ball-clip-rotate > div {
                    border-bottom-color: transparent;
                }

                .ball-clip-rotate-multiple > div {
                    border-color: ' . ideothemo_get_advanced_loader_color() . ';
                    border-bottom-color: transparent;
                    border-top-color: transparent;
                }

                .ball-clip-rotate-multiple > div:last-child,
                .ball-clip-rotate-pulse > div:last-child{
                    border-color: ' . ideothemo_get_advanced_loader_color() . ' transparent ' . ideothemo_get_advanced_loader_color() . ' transparent;
                }

                .triangle-skew-spin > div {
                    border-bottom-color: ' . ideothemo_get_advanced_loader_color() . ';
                }

                .pacman > div:first-of-type,
                .pacman > div:nth-child(2) {
                    border-top-color: ' . ideothemo_get_advanced_loader_color() . ';
                    border-left-color: ' . ideothemo_get_advanced_loader_color() . ';
                    border-bottom-color: ' . ideothemo_get_advanced_loader_color() . ';
                }

                .semi-circle-spin > div {
                     background-image: -webkit-linear-gradient(transparent 0%, transparent 70%, ' . ideothemo_get_advanced_loader_color() . ' 30%, ' . ideothemo_get_advanced_loader_color() . ' 100%);
                    background-image: linear-gradient(transparent 0%, transparent 70%, ' . ideothemo_get_advanced_loader_color() . ' 30%, ' . ideothemo_get_advanced_loader_color() . ' 100%);
                }
        ');


        if (ideothemo_get_theme_mod_parse('advanced.advanced_loading.logo_retina')) {


            wp_add_inline_script('ideothemo-ideo-transition', "
         var isRetina = (
                window.devicePixelRatio > 1 ||
                (window.matchMedia && window.matchMedia(\"(-webkit-min-device-pixel-ratio: 1.5),(-moz-min-device-pixel-ratio: 1.5),(min-device-pixel-ratio: 1.5)\").matches)
            );

            if (isRetina) {
                var logo = document.getElementById('transition_logo');
                if(logo){
                    if (logo.offsetWidth === 0 && logo.offsetHeight === 0) {
                        logo.setAttribute('width', logo.naturalWidth);
                        logo.setAttribute('height', logo.naturalHeight);
                    } else {
                        logo.setAttribute('width', logo.offsetWidth);
                        logo.setAttribute('height', logo.offsetHeight);
                    }

                    logo.src = logo.getAttribute('data-at2x');                
                }
            } 
        ");

        }
    }

    if (IDEOTHEMO_DEVELOP_MODE === true) {
        $array_scripts = array('underscore', 'mousewheel', 'jquery-easing', 'onscreen', 'waypoint', 'bootstrap', 'jquery-mobile-custom', 'ideothemo-ideo-plugins', 'jquery', 'isotope', 'tweenmax', 'tweenmax-scrollto', 'ideothemo-parallax', 'ideothemo-mouse-parallax', 'ideothemo-parallax-opacity', 'ideothemo-parallax-obj', 'ideothemo-parallax-height', 'grey', 'magnific', 'selectric', 'typed', 'imagesloaded', 'retina');
    } else {
        $array_scripts = array('underscore', 'ideothemo-libs');
    }

    if ($google_maps_key) {
        $array_scripts[] = 'ideothemo-maps-googleapis';
    }

    wp_enqueue_script('ideothemo-scripts', IDEOTHEMO_INIT_DIR_URI . '/js/script' . IDEOTHEMO_JS_MODE, $array_scripts, IDEOTHEMO_VERSION, true);
    wp_add_inline_script('ideothemo-scripts', '(function(html){html.className = html.className.replace(/\bno-js\b/,"js")})(document.documentElement);');


    if (IDEOTHEMO_DEVELOP_MODE === true) {
        wp_enqueue_script('ideothemo-pc-script', IDEOTHEMO_INIT_DIR_URI . '/inc/pc/js/script' . IDEOTHEMO_JS_MODE, array('jquery', 'underscore', 'tweenmax', 'tweenmax-scrollto', 'bootstrap', 'ideothemo-scripts'), IDEOTHEMO_VERSION, true);
    } else {
        wp_enqueue_script('ideothemo-pc-script', IDEOTHEMO_INIT_DIR_URI . '/inc/pc/js/script' . IDEOTHEMO_JS_MODE, array('jquery', 'underscore', 'ideothemo-libs'), IDEOTHEMO_VERSION, true);
    }

    function ideothemo_get_pc_data() {
        global $wpdb;
        $pc_data = get_option("pc_data", array());

        if($pc_data == ''){
            global $wpdb;
            $sql = "SELECT `option_value` FROM $wpdb->options WHERE `option_name` = 'pc_data'";
            $option_value = $wpdb->get_var( $sql );
            if($option_value){
                $fixed = preg_replace_callback(
                    '/s:([0-9]+):\"(.*?)\";/',
                    function ($matches) { return "s:".strlen($matches[2]).':"'.$matches[2].'";';     },
                    $option_value
                ); 
                $pc_data = unserialize($fixed);               
                update_option( 'pc_data', unserialize($pc_data) );    
            }
        }
        return $pc_data;
    }

    if(defined('IDEOTHEMO_PC_VERSION')){
        if (!(int)ideothemo_is_customize_preview()) {
            $ps_var = '_pc';
        } else {
            $ps_var = '_pcdata';
        }
        wp_localize_script('ideothemo-pc-script', $ps_var, array(
                'config' => array(
                    'url' => IDEOTHEMO_PC_URL,
                    'ajax' => array(
                        'url' => 'admin-ajax.php?action=pcgateway',
                        'nonce' => wp_create_nonce('pc-nonce')
                    )
                ),
                'data' => ideothemo_get_pc_data(),
                'version' => IDEOTHEMO_PC_VERSION,
                'fonts_extension' => ideothemo_get_font_extension(),
                'page_id' => get_the_ID()
            )
        );        
    }

    ideothemo_page_loading_logo();

    if (get_the_ID()) {
        global $post, $pages, $page;

        if (empty($page))
            $page = 1;

        if ($pages === null) {
            if ($post == null)
                $post = get_post();
            setup_postdata($post);
        }

        $portfolio_list = array();
        if ($ids = ideothemo_has_content_the_grid_portfolio(get_the_content())) {
            $portfolio_list = ideothemo_get_portfolio_list();
        }
    }

    wp_localize_script('jquery', '_ideo', array(
            'ajaxurl' => esc_url(admin_url('admin-ajax.php')),
            'is_customize_preview' => (int)ideothemo_is_customize_preview(),
            'settings' => array(
                'generals' => array(
                    'layout_boxed_version' => ideothemo_get_theme_mod_parse('generals.layout.boxed_version'),
                    'layout_site_width' => ideothemo_get_theme_mod_parse('generals.layout.site_width'),
                ),
                'accent_color' => ideothemo_get_general_accent_color(),
                'lightbox_entry_animation' => ideothemo_get_theme_mod_parse('lightbox.lightbox_settings.lightbox_entry_animation'),
                'header' => array(
                    'type' => ideothemo_get_theme_mod_parse('header.type'),
                    'top_class' => ideothemo_get_header_style(true, 'top'),
                    'top_width' => ideothemo_get_theme_mod_parse('header.top.width'),
                    'top_custom_width' => ideothemo_get_theme_mod_parse('header.top.custom_width'),
                    'top_top_distance' => ideothemo_get_page_option_setting('header.top.top_distance'),
                    'top_logo' => ideothemo_get_theme_mod_parse('header.logo.' . ideothemo_get_page_option_setting('header.top.logo.type')),
                    'content_padding_top' => ideothemo_get_custom_post_meta('generals.layout.content_padding_top'),
                    'sticky_class' => ideothemo_get_header_style(true, 'sticky'),
                    'sticky_width' => ideothemo_get_theme_mod_parse('header.sticky.width'),
                    'sticky_height' => (int)ideothemo_get_header_setting('sticky.height'),
                    'sticky_custom_width' => (int)ideothemo_get_theme_mod_parse('header.sticky.custom_width'),
                    'sticky_top_distance' => (int)ideothemo_get_page_option_setting('header.sticky.top_distance'),
                    'sticky_logo' => ideothemo_get_theme_mod_parse('header.logo.' . ideothemo_get_page_option_setting('header.sticky.logo.type')),
                    'menu_dropmenu_width' => 225,
                    'amount_to_change' => ideothemo_get_theme_mod_parse('header.sticky.scroll_amount_input'),
                    'colored_light_border_bottom_thickness' => ideothemo_get_theme_mod_parse('header.top_sticky.colored.light.border_bottom.thickness'),
                    'colored_dark_border_bottom_thickness' => ideothemo_get_theme_mod_parse('header.top_sticky.colored.dark.border_bottom.thickness'),
                    'transparent_light_border_bottom_thickness' => ideothemo_get_theme_mod_parse('header.top_sticky.transparent.light.border_bottom.thickness'),
                    'transparent_dark_border_bottom_thickness' => ideothemo_get_theme_mod_parse('header.top_sticky.transparent.dark.border_bottom.thickness'),
                    'page_title_area_height' => (int)ideothemo_get_custom_post_meta('pagetitle.page_title_settings.page_title_area_height') ?: (int)ideothemo_get_theme_mod_parse('pagetitle.page_title_settings.page_title_area_height'),
                    'offcanvas_topbar_style' => ideothemo_get_page_option_setting('header.side.offcanvas.topbar.style') ?: ideothemo_get_general_theme_skin(),
                    'offcanvas_topbar_height' => (int)ideothemo_get_theme_mod_parse('header.side.offcanvas.topbar.height'),
                    'offcanvas_topbar_logo_height' => (int)ideothemo_get_theme_mod_parse('header.side.offcanvas.topbar.logo.height'),
                    'offcanvas_stickybar_style' => ideothemo_get_page_option_setting('header.side.offcanvas.stickybar.style') ?: ideothemo_get_general_theme_skin(),
                    'offcanvas_stickybar_height' => (int)ideothemo_get_theme_mod_parse('header.side.offcanvas.stickybar.height'),
                    'offcanvas_stickybar_logo_height' => (int)ideothemo_get_theme_mod_parse('header.side.offcanvas.stickybar.logo.height'),
                ),
                'advanced' => array(
                    'backtotop_scroll_speed' => ideothemo_get_theme_mod_parse('advanced.advanced_backtotop.scroll_speed'),
                    'one_page_scroll_speed' => ideothemo_get_theme_mod_parse('advanced.advanced_onepage.scroll_speed'),
                    'smoothscroll_enabled' => ideothemo_get_theme_mod_parse('generals.general_smoothscroll.smoothscrolling'),
                    'smoothscroll_preset' => ideothemo_get_theme_mod_parse('generals.general_smoothscroll.smoothscroll_preset'),
                    'viewport_disable_on_mobile' => ideothemo_get_theme_mod_parse('advanced.advanced_viewport.disable_on_mobile'),
                ),
                'portfolio' => array(
                    'social_media_share' => ideothemo_portfolio_socials_enabled()
                )
            ),
            'portfolio' => isset($portfolio_list) ? $portfolio_list : null,
            'post_id' => get_the_ID(),
            'logoURL' => array(
                'normal' => ideothemo_get_logo_by_header('normal'),
                'sticky' => ideothemo_get_logo_by_header('sticky'),
                'side' => ideothemo_get_logo_by_header('side'),
                'mobile' => ideothemo_get_logo_by_header('mobile'),
                'stickyRetina' => ideothemo_get_logo_by_header('sticky', true),
                'sideRetina' => ideothemo_get_logo_by_header('side', true),
                'normalRetina' => ideothemo_get_logo_by_header('normal', true),
                'mobileRetina' => ideothemo_get_logo_by_header('mobile', true)
            ),
            'ajax_card' => ideothemo_get_link_ajax_card_id()
        )
    );

}

add_action('wp_enqueue_scripts', 'ideothemo_scripts_styles');

function ideothemo_admin_scripts_styles()
{
    wp_enqueue_style('animate', IDEOTHEMO_INIT_DIR_URI . '/css/animate.css', array(), IDEOTHEMO_VERSION);
    wp_deregister_style('font-awesome');
    wp_enqueue_style('font-awesome', IDEOTHEMO_INIT_DIR_URI . '/css/font-awesome.min.css', array(), '4.3.0');
    wp_enqueue_style('ideothemo-font-ideo', IDEOTHEMO_INIT_DIR_URI . '/css/font-ideo.css', array(), IDEOTHEMO_VERSION);
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_style('ideothemo-admin-style', IDEOTHEMO_INIT_DIR_URI . '/css/admin-style.css', array(), IDEOTHEMO_VERSION);
    wp_enqueue_script('wp-color-picker-alpha', IDEOTHEMO_INIT_DIR_URI . '/js/wp-color-picker-alpha.min.js', array('wp-color-picker'), '1.1.1', true);
    wp_enqueue_script('ideothemo-admin-bootstrap', IDEOTHEMO_INIT_DIR_URI . '/js/bootstrap.min.js', array('jquery'), IDEOTHEMO_VERSION, true);
    wp_enqueue_script('ideothemo-admin-script', IDEOTHEMO_INIT_DIR_URI . '/js/admin-script' . IDEOTHEMO_JS_MODE, array('jquery-ui-button', 'jquery-ui-slider', 'jquery-ui-selectmenu', 'jquery-ui-sortable'), IDEOTHEMO_VERSION, true);
    wp_enqueue_script('ideothemo-ideo-plugins', IDEOTHEMO_INIT_DIR_URI . '/js/jquery.ideo.plugins' . IDEOTHEMO_JS_MODE, array('jquery'), IDEOTHEMO_VERSION, true);
    $translation_array = array('addWidgetButtonText' => esc_html__('Add sidebar', 'themo'), 'widgetAreaPlaceholder' => esc_html__('Enter Name of the new Widget Area', 'themo'), 'customWidgetArea' => esc_html__('Add sidebar', 'themo'), 'removeSidebarConfirm' => esc_html__('Are you sure you want to remove this sidebar?', 'themo'));

    wp_localize_script('ideothemo-admin-script', '_ideo_translations', $translation_array);
    wp_localize_script('ideothemo-admin-script', '_ideo', array('webfonts' => ideothemo_get_google_fonts()));

    IdeoShortcodeMapsArrayJs();

    wp_register_script('ideothemo-page-options', IDEOTHEMO_INIT_DIR_URI . '/js/admin-page-options' . IDEOTHEMO_JS_MODE, array('jquery'), IDEOTHEMO_VERSION, true);

}

add_action('admin_enqueue_scripts', 'ideothemo_admin_scripts_styles');

add_action('tgmpa_register', 'ideothemo_register_required_plugins');

function ideothemo_register_required_plugins()
{

    $plugins = array(

        array(
            'name' => esc_html__('THEMO CORE', 'themo'),  
            'slug' => 'themo-core',  
            'source' => get_template_directory() . '/plugins/themo-core.zip', 
            'required' => true, 
            'version' => '1.0.9',
            'force_activation' => false, 
            'force_deactivation' => false, 
            'external_url' => '', 
            'is_callable' => '', 
        ),
        array(
            'name' => esc_html__('THEMO IMPORTER', 'themo'),  
            'slug' => 'themo-importer',  
            'source' => get_template_directory() . '/plugins/themo-importer.zip', 
            'required' => false, 
            'version' => '1.0.3', 
            'force_activation' => false, 
            'force_deactivation' => false, 
            'external_url' => '', 
            'is_callable' => '', 
        ),
        array(
            'name' => esc_html__('Layer Slider', 'themo'),  
            'slug' => 'LayerSlider',  
            'source' => get_template_directory() . '/plugins/layerslider.zip', 
            'required' => false, 
            'version' => '6.1.0',
            'force_activation' => false, 
            'force_deactivation' => false, 
            'external_url' => '', 
            'is_callable' => '', 
        ),
        array(
            'name' => esc_html__('Revolution Slider', 'themo'),  
            'slug' => 'revslider',  
            'source' => get_template_directory() . '/plugins/revslider.zip', 
            'required' => false, 
            'version' => '5.3.1.5',
            'force_activation' => false, 
            'force_deactivation' => false, 
            'external_url' => '', 
            'is_callable' => '', 
        ),
        array(
            'name' => esc_html__('The Grid (ideo modified version)', 'themo'),  
            'slug' => 'the-grid',  
            'source' => get_template_directory() . '/plugins/the-grid-ideo.zip', 
            'required' => true, 
            'version' => '2.2.0',
            'force_activation' => false, 
            'force_deactivation' => false, 
            'external_url' => '', 
            'is_callable' => '', 
        ),
        array(
            'name' => esc_html__('Advanced Carousel', 'themo'),  
            'slug' => 'advanced_carousel',  
            'source' => get_template_directory() . '/plugins/advanced_carousel.zip', 
            'required' => false, 
            'version' => '1.1.4',
            'force_activation' => false, 
            'force_deactivation' => false, 
            'external_url' => '', 
            'is_callable' => '', 
        ),
        array(
            'name' => esc_html__('Visual Composer (ideo modified version)', 'themo'),  
            'slug' => 'js_composer',  
            'source' => get_template_directory() . '/plugins/js_composer_ideo.zip', 
            'required' => true, 
            'version' => '5.0.1',
            'force_activation' => false, 
            'force_deactivation' => false, 
            'external_url' => '', 
            'is_callable' => '', 
        ),
        array(
            'name' => esc_html__('Envato Market', 'themo'),  
            'slug' => 'envato-market',  
            'source' => get_template_directory() . '/plugins/envato-market.zip', 
            'required' => false, 
            'version' => '1.0.0-RC2',
            'force_activation' => false, 
            'force_deactivation' => false, 
            'external_url' => '', 
            'is_callable' => '', 
        ),
        array(
            'name' => 'Contact Form 7',
            'slug' => 'contact-form-7',
            'required' => false,
        ),
        array(
            'name' => 'Duplicate Post',
            'slug' => 'duplicate-post',
            'required' => false,
        ),
    );

    $theme_text_domain = 'themo';

    $config = array(
        'id' => 'themo',
        'default_path' => '',
        'menu' => 'install-required-plugins',
        'has_notices' => true,
        'is_automatic' => false,
        'message' => '',
        'strings' => array(
            'page_title' => esc_html__('Install Required Plugins', 'tgmpa'),
            'menu_title' => esc_html__('Install Plugins', 'tgmpa'),
            'installing' => esc_html__('Installing Plugin: %s', 'tgmpa'),
            'oops' => esc_html__('Something went wrong with the plugin API.', 'tgmpa'),
            'notice_can_install_required' => _n_noop(
                'This theme requires the following plugin: %1$s.',
                'This theme requires the following plugins: %1$s.',
                'tgmpa'
            ),
            'notice_can_install_recommended' => _n_noop(
                'This theme recommends the following plugin: %1$s.',
                'This theme recommends the following plugins: %1$s.',
                'tgmpa'
            ),
            'notice_cannot_install' => _n_noop(
                'Sorry, but you do not have the correct permissions to install the %1$s plugin.',
                'Sorry, but you do not have the correct permissions to install the %1$s plugins.',
                'tgmpa'
            ),
            'notice_ask_to_update' => _n_noop(
                'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
                'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
                'tgmpa'
            ),
            'notice_ask_to_update_maybe' => _n_noop(
                'There is an update available for: %1$s.',
                'There are updates available for the following plugins: %1$s.',
                'tgmpa'
            ),
            'notice_cannot_update' => _n_noop(
                'Sorry, but you do not have the correct permissions to update the %1$s plugin.',
                'Sorry, but you do not have the correct permissions to update the %1$s plugins.',
                'tgmpa'
            ),
            'notice_can_activate_required' => _n_noop(
                'The following required plugin is currently inactive: %1$s.',
                'The following required plugins are currently inactive: %1$s.',
                'tgmpa'
            ),
            'notice_can_activate_recommended' => _n_noop(
                'The following recommended plugin is currently inactive: %1$s.',
                'The following recommended plugins are currently inactive: %1$s.',
                'tgmpa'
            ),
            'notice_cannot_activate' => _n_noop(
                'Sorry, but you do not have the correct permissions to activate the %1$s plugin.',
                'Sorry, but you do not have the correct permissions to activate the %1$s plugins.',
                'tgmpa'
            ),
            'install_link' => _n_noop(
                'Begin installing plugin',
                'Begin installing plugins',
                'tgmpa'
            ),
            'update_link' => _n_noop(
                'Begin updating plugin',
                'Begin updating plugins',
                'tgmpa'
            ),
            'activate_link' => _n_noop(
                'Begin activating plugin',
                'Begin activating plugins',
                'tgmpa'
            ),
            'return' => esc_html__('Return to Required Plugins Installer', 'tgmpa'),
            'dashboard' => esc_html__('Return to the dashboard', 'tgmpa'),
            'plugin_activated' => esc_html__('Plugin activated successfully.', 'tgmpa'),
            'activated_successfully' => esc_html__('The following plugin was activated successfully:', 'tgmpa'),
            'plugin_already_active' => esc_html__('No action taken. Plugin %1$s was already active.', 'tgmpa'),
            'plugin_needs_higher_version' => esc_html__('Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'tgmpa'),
            'complete' => esc_html__('All plugins installed and activated successfully. %1$s', 'tgmpa'),
            'dismiss' => esc_html__('Dismiss this notice', 'tgmpa'),
            'contact_admin' => esc_html__('Please contact the administrator of this site for help.', 'tgmpa'),
        )
    );

    tgmpa($plugins, $config);

}

add_action('vc_before_init', 'ideothemo_vc_set_as_theme');
function ideothemo_vc_set_as_theme()
{
    vc_set_as_theme();
    remove_action('admin_enqueue_scripts', 'vc_pointer_load');
}

if (class_exists('WPBakeryVisualComposerAbstract')) {
    require_once(IDEOTHEMO_INIT_DIR . 'inc/vc_extend/init.php');

    $list = array(
        'post',
        'page',
        ideothemo_get_portfolio_slug(),
        ideothemo_get_footer_post_type(),
        'team'
    );

    if (function_exists('vc_set_default_editor_post_types')) {
        vc_set_default_editor_post_types($list);
    }
    if (is_admin()) {
        add_action('admin_menu', 'ideothemo_remove_vc_grid');
    }
}

function ideothemo_remove_vc_grid()
{
    remove_submenu_page(VC_PAGE_MAIN_SLUG, 'edit.php?post_type=vc_grid_item');
}

function ideothemo_vc_remove_frontend_links()
{
    vc_disable_frontend();
}

add_action('vc_after_init', 'ideothemo_vc_remove_frontend_links');

// Disabling redirect to VC welcome page
remove_action('admin_init', 'vc_page_welcome_redirect');

add_action('admin_menu', 'ideothemo_wp_menu', 999);
function ideothemo_wp_menu()
{
    global $submenu;

    $menu_slug = 'themes.php';
    if(is_array($submenu[$menu_slug])){
        foreach ($submenu[$menu_slug] as $i => $item) {
            if ('switch_themes' == $item[1] && $menu_slug != $item[2]) {
                unset($submenu[$menu_slug][$i]);
            }
        }
    }

}


function ideothemo_wp_video_shortcode_responsive($html)
{
    return str_ireplace('width: 640px', 'width: 100%', $html);
}

add_filter('wp_video_shortcode', 'ideothemo_wp_video_shortcode_responsive');

add_action('admin_footer', 'ideothemo_reset_footer_post', 9);

function ideothemo_reset_footer_post()
{
    global $post;
    if (isset($GLOBALS['post_ID'])) {
        $post = get_post($GLOBALS['post_ID']);
    }
}


add_filter('content_save_pre', 'ideothemo_remove_duplicate_el_uid', 10, 1);

function ideothemo_remove_duplicate_el_uid($content)
{
    $array_ids = array();
    preg_match_all('/el_uid=\\\"(\w+)\\\"/i', $content, $matches, PREG_OFFSET_CAPTURE);

    if (is_array($matches) && is_array($matches[1])) {
        foreach ($matches[1] as $matche) {
            if ($matche[0]) {
                if (!in_array($matche[0], $array_ids)) {
                    $array_ids[] = $matche[0];
                } else {
                    $content = substr_replace($content, uniqid(), $matche[1], strlen($matche[0]));
                }
            }
        }
    }

    return $content;
}

if (!defined('IDEOTHEMO_CORE_VERSION')) {
    add_action('admin_notices', 'ideothemo_themo_core_disabled_admin_notice');
}

function ideothemo_themo_core_disabled_admin_notice()
{
    ?>
    <div class="notice notice-warning notice-themo-core is-dismissible">
        <p><?php printf(wp_kses(__('Please <a href="%s">install and activate</a> Themo Core plugin.', 'themo'), array('a' => array('href' => array()))), esc_url(admin_url('themes.php?page=install-required-plugins'))); ?></p>
    </div>
    <?php
}

function ideothemo_get_contents($file)
{
    global $wp_filesystem;

    $target_dir = $wp_filesystem->find_folder(dirname($file));
    $target_file = trailingslashit($target_dir) . basename($file);

    return $wp_filesystem->get_contents($target_file);
}

function ideothemo_put_contents($file, $content, $flag)
{
    global $wp_filesystem;

    $target_dir = $wp_filesystem->find_folder(dirname($file));
    $target_file = trailingslashit($target_dir) . basename($file);

    if ($flag == FILE_APPEND) {
        $content = ideothemo_get_contents($target_file) . '' . $content;
    }

    if (!$wp_filesystem->put_contents($target_file, $content)) {
        echo 'Error writing file: ' . $target_file;

        die();
        return false;
    }
    return true;
}

function ideothemo_set_ID()
{
    global $post;
    if (is_archive() || is_search()) {
        if ($post_id = ideothemo_get_inheritet_pt_page_id()) {
            $post = get_post($post_id);
            setup_postdata($post);
        }
    }
}


function ideothemo_has_content_the_grid_portfolio($content)
{
    global $tg_grid_data, $tg_grid_query;
    if (class_exists('The_Grid')) {
        preg_match_all('/\[the_grid\s+name=\"(.+?)"/', $content, $matches);
        if (count($matches[1])) {
            return true;
            $post_ids = array();
            foreach ($matches[1] as $grid_name) {
                if ($grid_name) {
                    try {
                        $grid = new The_Grid();
                        $grid->get_data($grid_name);
                        if (in_array('portfolio', $tg_grid_data['post_type'])) {
                            $grid->data_processing();
                            foreach ($tg_grid_query->posts as $post) {
                                $post_ids[] = $post->ID;
                            }
                        }
                    } catch (Exception $e) {
                    }
                }
            }
            if (count($post_ids) > 0) {
                return $post_ids;
            }
        }
    }
    return false;
}

function ideo_esc($content)
{
    return $content;
}

function ideothemo_scripts_styles_fix()
{
    $scripts_styles = ideothemo_get_page_option_setting('scripts_styles', false, get_the_ID());

    if (isset($scripts_styles['cf7']) && $scripts_styles['cf7'] == 'off') {
        wp_dequeue_script('contact-form-7');
        wp_dequeue_style('contact-form-7');
    }

    if (isset($scripts_styles['rev']) && $scripts_styles['rev'] == 'off') {
        wp_dequeue_script('tp-tools');
        wp_dequeue_script('revmin');
        wp_dequeue_style('rs-plugin-settings');
        wp_dequeue_style('rs-icon-set-fa-icon-');
        wp_dequeue_style('rs-icon-set-pe-7s-');
    }

    if (isset($scripts_styles['tg']) && $scripts_styles['tg'] == 'off') {
        wp_dequeue_script('the-grid');
        wp_dequeue_style('the-grid');
    }

    if (isset($scripts_styles['ac']) && $scripts_styles['ac'] == 'off') {
        wp_dequeue_script("ult-slick");
        wp_dequeue_script("ult-slick-custom");
        wp_dequeue_style("ult-slick");
        wp_dequeue_style("ult-icons");
        wp_dequeue_style("ult-slick-animate");
    }

    if (isset($scripts_styles['ls']) && $scripts_styles['ls'] == 'off') {
        wp_dequeue_script('layerslider');
        wp_dequeue_script('layerslider-transitions');
        wp_dequeue_script('ls-user-transitions');
        wp_dequeue_style('layerslider');
    }

}

add_action('wp_enqueue_scripts', 'ideothemo_scripts_styles_fix', 999);

add_action('layerslider_ready', 'ideothemo_layerslider_overrides');
function ideothemo_layerslider_overrides()
{
    // Disable auto-updates
    $GLOBALS['lsAutoUpdateBox'] = false;
}


if (function_exists('set_revslider_as_theme')) {
    if (!defined('REV_SLIDER_AS_THEME')) {
        define('REV_SLIDER_AS_THEME', TRUE);
    }
    set_revslider_as_theme();
}

if(isset($_GET['fixpcdata'])){
    global $wpdb;
    $sql = "SELECT `option_value` FROM $wpdb->options WHERE `option_name` = 'pc_data'";
    $option_value = $wpdb->get_var( $sql );

    $fixed = preg_replace_callback(
        '/s:([0-9]+):\"(.*?)\";/',
        function ($matches) { return "s:".strlen($matches[2]).':"'.$matches[2].'";';     },
        $option_value
    );
    //echo $fixed;
    update_option( 'pc_data', unserialize($fixed) );    
}