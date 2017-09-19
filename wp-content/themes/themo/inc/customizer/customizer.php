<?php
if (!class_exists('WP_Customize_Control')) {
    require_once(ABSPATH . WPINC . '/class-wp-customize-setting.php');
    require_once(ABSPATH . WPINC . '/class-wp-customize-section.php');
    require_once(ABSPATH . WPINC . '/class-wp-customize-control.php');

}

include(IDEOTHEMO_INIT_DIR . 'inc/customizer/ajax/PageOptions.php');
include(IDEOTHEMO_INIT_DIR . 'inc/customizer/ajax/GenerateCss.php');



function ideothemo_customizer_sanitize_callback($value)
{
    return $value;
}

class IdeoThemoRefreshControl extends WP_Customize_Control
{
    public $type = 'refreshcontrol';

    public function __construct($manager, $id, $args = array())
    {
        parent::__construct($manager, $id, $args);


    }

    public function render_content()
    {

        ?>
        <input type="hidden" id="<?php echo esc_attr($this->id); ?>" <?php $this->link(); ?>>
        <?php
    }
}

class IdeoThemoPostMessageControl extends WP_Customize_Control
{
    public $type = 'postmessagecontrol';

    public function __construct($manager, $id, $args = array())
    {
        parent::__construct($manager, $id, $args);


    }

    public function render_content()
    {

        ?>
        <input type="hidden" id="<?php echo esc_attr($this->id); ?>" <?php $this->link(); ?>>
        <?php

    }
}

class IdeoThemoPanelControl extends WP_Customize_Control
{
    public $type = 'panel';
    public $subtitle = '';
    public $panel_structure = array();

    public function __construct($manager, $id, $args = array())
    {
        parent::__construct($manager, $id, $args);

        $this->panel_structure = $this->get_panel_settings();
    }

    public function get_panel_settings()
    {
        $page_list = array('' => esc_html__('None', 'themo')) + ideothemo_get_list_pages();

        $settings = array();
        include(IDEOTHEMO_INIT_DIR . 'inc/customizer/settings/generals.php');
        include(IDEOTHEMO_INIT_DIR . 'inc/customizer/settings/fonts.php');
        include(IDEOTHEMO_INIT_DIR . 'inc/customizer/settings/header.php');
        include(IDEOTHEMO_INIT_DIR . 'inc/customizer/settings/page-title.php');
        include(IDEOTHEMO_INIT_DIR . 'inc/customizer/settings/shortcodes.php');
        include(IDEOTHEMO_INIT_DIR . 'inc/customizer/settings/footer.php');
        include(IDEOTHEMO_INIT_DIR . 'inc/customizer/settings/sidebar.php');
        include(IDEOTHEMO_INIT_DIR . 'inc/customizer/settings/blog.php');
        include(IDEOTHEMO_INIT_DIR . 'inc/customizer/settings/portfolio.php');
        include(IDEOTHEMO_INIT_DIR . 'inc/customizer/settings/social-media.php');
        include(IDEOTHEMO_INIT_DIR . 'inc/customizer/settings/lightbox.php');
        include(IDEOTHEMO_INIT_DIR . 'inc/customizer/settings/advanced.php');
        include(IDEOTHEMO_INIT_DIR . 'inc/customizer/settings/custom-css.php');
        include(IDEOTHEMO_INIT_DIR . 'inc/customizer/settings/custom-js.php');
        include(IDEOTHEMO_INIT_DIR . 'inc/customizer/settings/import-export.php');
        include(IDEOTHEMO_INIT_DIR . 'inc/customizer/settings/reset.php');

        return $settings;
    }

    public function render_content()
    {
        $data_refresh = get_theme_mod('data_refresh', '{}') ?: 0;
        $data_refresh = (array)json_decode($data_refresh);
        $data_refresh['ideo_theme_options[custom][custom_js][custom_js]'] = preg_replace('/\<[\/]*script(.+)*\>/i', '', $data_refresh['ideo_theme_options[custom][custom_js][custom_js]']);
        $data_refresh = json_encode($data_refresh);
        ?>
        <script>
            function migrateSettings(settings) {
                if (settings['ideo_theme_options[header][type]'] == 'side_header') {
                    settings['ideo_theme_options[header][type]'] = 'side_' + settings['ideo_theme_options[header][side][side]'] + '_header';
                }
                
                return settings;
            };

            var panel_structure = <?php echo json_encode($this->panel_structure); ?>;
            var panel_data = migrateSettings(<?php echo $data_refresh; ?> || {});                  

        </script>        

        <div class="ideo-theme-options" ng-app="panelApp" ng-controller="panelCtrl">
            <div class="ideo-theme-options-loader" ng-class="{active:show_loader}">
                <div class="ideo-theme-options-loader-content">
                    <i class="fa fa-spinner fa-pulse fa-fw"></i>
                    <p><?php _e('loading preview', 'themo'); ?></p>
                </div>
            </div>
            <form class="ideo-theme-options-form" data-link="#<?php echo $this->id; ?>">
                <ul class="ideo-theme-options-panel" ng-class="{open:isOpenPanel()}">
                    <li accordion-panel ng-repeat="panel in panel_structure" id="accordion-panel-{{::panel.id}}"
                        class="">
                        <h3 class="ideo-theme-options-panel-title" ng-bind="::panel.title"
                            ng-click="togglePanel(panel)"></h3>
                    </li>
                </ul>
                <ul class="ideo-theme-options-subpanel">
                    <li accordion-subpanel ng-repeat="panel in panel_structure"
                        id="ideo-theme-options-accordion-subpanel-generals" ng-class="{open:showSubPanel(panel)}"
                        class="ng-scope">
                        <h3 class="ideo-theme-options-subpanel-title" ng-bind="::panel.title"
                            ng-click="hideSubPanel()"></h3>
                        <ul class="ideo-panel-sections">
                            <li accordion-section ng-repeat="section in panel.sections"
                                id="accordion-panel-{{::section.id}}" class="ideo-panel-section" ng-class="{hidden:!isVisible(section)}">
                                <h3 section-title="" class="ideo-section-title" ng-click="toggleSection()"
                                    title="{{::section.title}}"></h3>
                                <div class="ideo-panel-controls ng-scope" ng-repeat="control in section.controls">
                                    <div panel-controls="" control="control" paneldata="panel_data"
                                         ng-class="{hidden:!isVisible(control), depending:isControlDepending(control) }"></div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </form>
        </div>
        <?php

    }
}

function ideothemo_customize_register($wp_customize)
{

    $wp_customize->remove_section('colors');
    $wp_customize->remove_section('header_image');
    $wp_customize->remove_section('background_image');

    $wp_customize->add_section('layout', array(
        'title' => esc_html__('Themo options', 'themo'),
        'priority' => 10
    ));

    $wp_customize->add_setting('data_refresh', array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'ideothemo_customizer_sanitize_callback',
    ));

    $wp_customize->add_control(new IdeoThemoRefreshControl($wp_customize, 'data_refresh', array(
        'setting' => 'data_refresh',
        'section' => 'layout',
    )));

    $wp_customize->add_setting('data_postMessage', array(
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'ideothemo_customizer_sanitize_callback',
    ));

    $wp_customize->add_control(new IdeoThemoPostMessageControl($wp_customize, 'data_postMessage', array(
        'setting' => 'data_postMessage',
        'section' => 'layout',
    )));

    $wp_customize->add_setting('ideo_panel', array(
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'ideothemo_customizer_sanitize_callback',
    ));


    $wp_customize->add_control(new IdeoThemoPanelControl($wp_customize, 'ideo_panel', array(
        'setting' => 'ideo_panel',
        'section' => 'layout',
    )));

}

add_action('customize_register', 'ideothemo_customize_register');

function ideothemo_customize_save_response($response, $wp)
{

    $post = $wp->unsanitized_post_values();
    if (isset($post['data_postMessage'])) {
        set_theme_mod('data_postMessage', $post['data_postMessage']);
        set_theme_mod('data_refresh', $post['data_postMessage']);
    }
    if (isset($post['data_refresh'])) {
        set_theme_mod('data_refresh', $post['data_refresh']);
        set_theme_mod('data_postMessage', $post['data_refresh']);
    }
    return $response;
}

add_filter('customize_save_response', 'ideothemo_customize_save_response', 99, 2);

function ideothemo_customizer_live_preview()
{
    if (wp_script_is('ideothemo-pc-themecustomizer')) return false;

    wp_cache_delete('ideo_options');

    wp_register_script('ideothemo-themecustomizer-helpers', IDEOTHEMO_INIT_DIR_URI . '/inc/customizer/js/helpers' . IDEOTHEMO_JS_MODE, array('ideothemo-scripts'), IDEOTHEMO_VERSION, true);
    wp_register_script('ideothemo-themecustomizer-helpers-footer', IDEOTHEMO_INIT_DIR_URI . '/inc/customizer/js/helpers/footer' . IDEOTHEMO_JS_MODE, array('ideothemo-themecustomizer-helpers'), IDEOTHEMO_VERSION, true);
    wp_enqueue_script('ideothemo-themecustomizer', IDEOTHEMO_INIT_DIR_URI . '/inc/customizer/js/theme-customizer' . IDEOTHEMO_JS_MODE, array('jquery', 'ideothemo-tiny-color', 'customize-preview', 'ideothemo-themecustomizer-helpers', 'ideothemo-themecustomizer-helpers-footer'), IDEOTHEMO_VERSION, true);

    wp_localize_script('ideothemo-themecustomizer-helpers', 'ideo', array('fonts' => ideothemo_get_google_fonts(), 'fontSubsets' => ideothemo_get_google_fonts_subsets()));
}

add_action('customize_preview_init', 'ideothemo_customizer_live_preview', 99);

function ideothemo_customize_enqueue()
{
    if (!wp_script_is('ideothemo-pc-angular')) {
        wp_enqueue_style('ideothemo-customizer', IDEOTHEMO_INIT_DIR_URI . '/inc/customizer/css/customizer-style.css', null, false);
        wp_enqueue_style('ideothemo-codemirror', IDEOTHEMO_INIT_DIR_URI . '/inc/customizer/js/code-mirror/lib/codemirror.css', null, false);
        wp_enqueue_style('ideothemo-codemirror-railscasts', IDEOTHEMO_INIT_DIR_URI . '/inc/customizer/js/code-mirror/theme/railscasts.css', null, false);

        wp_register_script('ideothemo-codemirror-lib', IDEOTHEMO_INIT_DIR_URI . '/inc/customizer/js/code-mirror/lib/codemirror.js', null, true);
        wp_register_script('ideothemo-codemirror-javascript', IDEOTHEMO_INIT_DIR_URI . '/inc/customizer/js/code-mirror/mode/javascript/javascript.js', array('ideothemo-codemirror-lib'), true);
        wp_register_script('ideothemo-codemirror-autorefresh', IDEOTHEMO_INIT_DIR_URI . '/inc/customizer/js/code-mirror/addon/display/autorefresh.js', array('ideothemo-codemirror-lib'), true);
        wp_register_script('ideothemo-codemirror-css', IDEOTHEMO_INIT_DIR_URI . '/inc/customizer/js/code-mirror/mode/css/css.js', array('ideothemo-codemirror-lib'), true);
        wp_register_script('ideothemo-panel-customizer', IDEOTHEMO_INIT_DIR_URI . '/inc/customizer/js/panel-customizer.js', array('ideothemo-admin-customizer-angular'), IDEOTHEMO_VERSION, true);

        wp_enqueue_script('ideothemo-admin-customizer-angular', IDEOTHEMO_INIT_DIR_URI . '/inc/pc/js/angular/angular.min.js', array('jquery', 'jquery-ui-resizable', 'ideothemo-codemirror-javascript', 'ideothemo-codemirror-autorefresh', 'ideothemo-codemirror-css'), '1.6.2', true);
        wp_localize_script('ideothemo-admin-customizer-angular', '_ideo_customizer', array(
            'base_url' => get_template_directory_uri(),
            'error' => esc_html__("<strong>Ooops!</strong> <p>Something's wrong. It seems that your changes have caused errors of styles generating. This error occur usually when invalid value has been entered into textfields, e.g. color ###ffffff. </p> <p>Make sure that all entered values are correct, if they are not, correct them and save Customizer again but if entered values are correct and error still appears then contact our support team </p> <a href='https://themo.ticksy.com/' target='_blank'>themo.ticksy.com</a>", 'themo'),
            'error_2' => sprintf(esc_html__('<strong>Ooops!</strong> Something is wrong - styles cannot be generated without active Themo Core plugin.</br> Please <a href="%s">install and activate</a> Themo Core plugin.', 'themo'), esc_url(admin_url('themes.php?page=install-required-plugins'))),
            'progress' => esc_html__('Generating styles...', 'themo'),
        ));

        wp_enqueue_script('ideothemo-panel-customizer');
      

    }
}

add_action('customize_controls_enqueue_scripts', 'ideothemo_customize_enqueue');
