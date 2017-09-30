<?php

/*
  Plugin Name: VC Countdown Free - oCoder
  Plugin URI: http://ocoderEducation.com
  Description: Visual Composer Countdown by oCoder.  This is Free Version, please buy pro version for full function <a href="https://codecanyon.net/item/countdown-addons-for-visual-composer-easy-to-edit/19435651?ref=trungstormsix">here</a>.
  Version: 1.0
  Author: oCoder
  Author URI: http://ocoderEducation.com
  License: GPLv2 or later
 */

/*
  This example/starter plugin can be used to speed up Visual Composer plugins creation process.
  More information can be found here: http://kb.wpbakery.com/index.php?title=Category:Visual_Composer
 */


// don't load directly
if (!defined('ABSPATH'))
    die('-1');

if (!class_exists('VCCountDownFreeOcoderAddonClass')) {


//sitekey captcha google for http://localhost
    class VCCountDownFreeOcoderAddonClass {

        function __construct() {
            // We safely integrate with VC with this hook
            add_action('init', array($this, 'integrateWithVC'));
            // Use this when creating a shortcode addon
            add_shortcode('vc_countdown_ocoder_free', array($this, 'renderCountDownFreeHtml'));
            // Register CSS and JS
            add_action('wp_enqueue_scripts', array($this, 'loadCssAndJs'));
        }

        public function integrateWithVC() {
            // Check if Visual Composer is installed
            if (!defined('WPB_VC_VERSION')) {
                // Display notice that Visual Compser is required
                add_action('admin_notices', array($this, 'showVcVersionNotice'));
                return;
            }
            wp_enqueue_style('slider_admin_css', plugins_url('admin/css/admin.css', __FILE__));
            require_once 'admin/params/slider/slider-params.php';

            /*
              Add your Visual Composer logic here.
              Lets call vc_map function to "register" our custom shortcode within Visual Composer interface.

              More info: http://kb.wpbakery.com/index.php?title=Vc_map
             */
            vc_map(array(
                "name" => __("CountDown Free- oCoder", 'vc_ocoder'),
                "description" => __("CountDown by oCoder (Free Version)", 'vc_ocoder'),
                "base" => "vc_countdown_ocoder_free",
                "class" => "",
                "controls" => "full",
                "icon" => plugins_url('assets/countdown.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_ocoder_my_class"
                "category" => __('Content', 'js_composer'),
//            'admin_enqueue_js' => array(plugins_url('assets/js/admin.js', __FILE__)), // This will load js file in the VC backend editor
                'admin_enqueue_css' => array(plugins_url('assets/vc_ocoder_admin.css', __FILE__)), // This will load css file in the VC backend editor
                "params" => array(
                    array(
                        "type" => "textfield",
                        'heading' => __('Date (Y/m/d H:i:s Ex: 2017/11/28 15:11:12)', 'js_composer'),
                        'description' => __('The countdown will count from this moment to the date in this field.', 'js_composer'),
                        'param_name' => 'countdown_date',
                        'value' => date("Y/m/d H:i:s", strtotime("+1 month")),
                        'group' => __('Element Design  ', 'vc_ocoder'),
                    ),
                    array(
                        'type' => 'dropdown',
                        "heading" => __('Style<br>Please <a target="_blank" href="https://codecanyon.net/item/countdown-addons-for-visual-composer-easy-to-edit/19435651?ref=trungstormsix">buy pro version</a> for full function.  ', 'vc_ocoder'),
                        'description' => __('Select display style.', 'js_composer'),
                        'param_name' => 'display_style',
                        'group' => __('Element Design  ', 'vc_ocoder'),
                        'value' => array(
                            __('Default', 'js_composer') => 'cirlcle',
                            __('Circle Text Outside', 'js_composer') => 'circle_text_outside',
                            __('Clean', 'js_composer') => 'clean',
                            __('Clean With Background', 'js_composer') => 'clean_bg',
                            __('Bordered', 'js_composer') => 'border',
                            __('Clean Material (Pro only)', 'js_composer') => 'clean_material',
                            __('Hexagon (Pro only)', 'js_composer') => 'clean_hexagon',
                            __('Border Top (Pro only)', 'js_composer') => 'border_top',
                            __('Custom Background', 'js_composer') => 'clean_custome_background',
                        ),
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => __("Inside color", 'vc_ocoder'),
                        "param_name" => "inside_color",
                        "value" => '',
                        "dependency" => array('element' => 'circle_button', 'value' => 'on'),
                        "description" => __("Choose color of inside circle (for 'Circle Text Outside' syle only).", 'vc_ocoder'),
                        "dependency" => array('element' => 'display_style', 'value' => 'circle_text_outside'),
                        'group' => __('Element Design  ', 'vc_ocoder'),
                    ),
                    array(
                        'type' => 'prime_slider',
                        'heading' => __('Time Text Font Size', 'js_composer'),
                        'param_name' => 'time_text_size',
                        'tooltip' => __('Choose Time Text Size Here. For large numbers it\'s better use 18px Font Size.', 'team_vc'),
                        'min' => 0,
                        'max' => 120,
                        'step' => 1,
                        'value' => 0,
                        'unit' => 'px',
                        "description" => __("Chose Time Text Size as Pixel. Default is 0, this mean the font size depend on the default of each style.", "my-text-domain"),
                        'group' => __('Element Design  ', 'vc_ocoder'),
                    ),
                    array(
                        "type" => "prime_slider",
                        'heading' => __('Text Size (below time) (px)', 'js_composer'),
                        'description' => __('Size of the text below time (Days, Hours, Minutes, Seconds).', 'js_composer'),
                        'param_name' => 'text_size',
                        'min' => 0,
                        'max' => 120,
                        'step' => 1,
                        'value' => 0,
                        'unit' => 'px',
                        'group' => __('Element Design  ', 'vc_ocoder'),
                    ),
                    array(
                        "type" => "prime_slider",
                        'heading' => __('Block Spacing (px)', 'js_composer'),
                        'description' => __('Spacing bettwen countdown blocks, for Clean Style only.', 'js_composer'),
                        'param_name' => 'spacing',
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                        'value' => 0,
                        'unit' => 'px',
                        "dependency" => array('element' => 'display_style', 'value' => array('clean', 'clean_hexagon')),
                        'group' => __('Element Design  ', 'vc_ocoder'),
                    ),
                    //for colors
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => __('Please <a target="_blank" href="https://codecanyon.net/item/countdown-addons-for-visual-composer-easy-to-edit/19435651?ref=trungstormsix">buy pro version</a> for full function. <br>Day color', 'vc_ocoder'),
                        "param_name" => "d_color",
                        "value" => '',
                        "description" => __("Choose day color", 'vc_ocoder'),
                        'group' => __('Color Design  ', 'vc_ocoder'),
                    ),
                    array(
                        "type" => "attach_image",
                        "holder" => "div",
                        "class" => "icon",
                        "heading" => __("Day Background Image  (for Custom Background only)", 'vc_ocoder'),
                        "param_name" => "d_icon",
                        "value" => '',
                        "description" => __("Choose Day Background Image", 'vc_ocoder'),
                        "dependency" => array('element' => 'display_style', 'value' => 'clean_custome_background'),
                        'group' => __('Background', 'vc_ocoder'),
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => __("Hour color", 'vc_ocoder'),
                        "param_name" => "h_color",
                        "value" => '',
                        "description" => __("Choose hour color", 'vc_ocoder'),
                        'group' => __('Color Design  ', 'vc_ocoder'),
                    ),
                    array(
                        "type" => "attach_image",
                        "holder" => "div",
                        "class" => "icon",
                        "heading" => __("Hour Background Image (for Custom Background only)", 'vc_ocoder'),
                        "param_name" => "h_icon",
                        "value" => '',
                        "description" => __("Choose Hour Background Image", 'vc_ocoder'),
                        "dependency" => array('element' => 'display_style', 'value' => 'clean_custome_background'),
                        'group' => __('Background', 'vc_ocoder'),
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => __("Minute color", 'vc_ocoder'),
                        "param_name" => "i_color",
                        "value" => '',
                        "description" => __("Choose minute color", 'vc_ocoder'),
                        'group' => __('Color Design  ', 'vc_ocoder'),
                    ),
                    array(
                        "type" => "attach_image",
                        "holder" => "div",
                        "class" => "icon",
                        "heading" => __("Minute Background Image (for Custom Background only)", 'vc_ocoder'),
                        "param_name" => "i_icon",
                        "value" => '',
                        "description" => __("Choose Minute Background Image.", 'vc_ocoder'),
                        "dependency" => array('element' => 'display_style', 'value' => 'clean_custome_background'),
                        'group' => __('Background', 'vc_ocoder'),
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => __("Second color", 'vc_ocoder'),
                        "param_name" => "s_color",
                        "value" => '',
                        "description" => __("Choose second color", 'vc_ocoder'),
                        'group' => __('Color Design  ', 'vc_ocoder'),
                    ),
                    array(
                        "type" => "attach_image",
                        "holder" => "div",
                        "class" => "icon",
                        "heading" => __("Second Background Image (for Custom Background only)", 'vc_ocoder'),
                        "param_name" => "s_icon",
                        "value" => '',
                        "description" => __("Choose Second Background Image", 'vc_ocoder'),
                        "dependency" => array('element' => 'display_style', 'value' => 'clean_custome_background'),
                        'group' => __('Background', 'vc_ocoder'),
                    ),
                    array(
                        "type" => "colorpicker",
                        "holder" => "div",
                        "class" => "",
                        "heading" => __("Text color", 'vc_ocoder'),
                        "param_name" => "txt_color",
                        "value" => '',
                        "description" => __("Choose color of countdown and lable text. (Use as background color in Border Top style)", 'vc_ocoder'),
                        'group' => __('Color Design  ', 'vc_ocoder'),
                    ),
                    array(
                        'type' => 'css_editor',
                        'heading' => __('CSS box', 'vc_ocoder'),
                        'param_name' => 'css',
                        'group' => __('Block Design', 'vc_ocoder'),
                    )
                )
            ));
        }

        /*
          Shortcode logic how it should be rendered
         */

        public function renderCountDownFreeHtml($atts, $content = null) {

            $css = '';
            extract(shortcode_atts(array(
                'css' => '',
                'display_style' => 'circle',
                'time_text_size' => '',
                'text_size' => '',
                'd_color' => '',
                'h_color' => '',
                'i_color' => '',
                's_color' => '',
                'spacing' => '',
                'txt_color' => '',
                'inside_color' => '',
                'd_icon' => '',
                'h_icon' => '',
                'i_icon' => '',
                's_icon' => '',
                'countdown_date' => date("Y/m/d H:i:s", strtotime("+1 month")),
                            ), $atts));
            $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '), $this->settings['base'], $atts);
            $output = "";
            if (file_exists(plugin_dir_path(__FILE__) . "/template/$display_style.php")) {
                require(plugin_dir_path(__FILE__) . "/template/$display_style.php");
            }
            $output.= ob_get_contents();
            ob_end_clean();
            return $output;
        }

        /*
          Load plugin css and javascript files which you may need on front end of your site
         */

        public function loadCssAndJs() {
            wp_register_style('mega_round_icons_buttons', plugins_url('assets/css/mega_round_icons_buttons.css', __FILE__));
            wp_register_style('vc_bootstrap', plugins_url('assets/css/bootstrap.min.css', __FILE__));

            wp_register_style('vc_font_awsome', plugins_url('assets/font-awesome/css/font-awesome.min.css', __FILE__));

            wp_enqueue_style('vc_ocoder_style');
            wp_enqueue_style('vc_ocoder_style_oc_countdown');
            wp_enqueue_style('mega_round_icons_buttons');
            wp_enqueue_style('vc_bootstrap');

            wp_enqueue_style('vc_font_awsome');

            // If you need any javascript files on front end, here is how you can load them.
            wp_enqueue_script('vc_ocoder_js', plugins_url('assets/js/app.js', __FILE__), array('jquery'));
//            wp_enqueue_script('vc_bootstrap_js', plugins_url('assets/js/bootstrap.min.js', __FILE__));
        }

        /*
          Show notice if your plugin is activated but Visual Composer is not
         */

        public function showVcVersionNotice() {
            $plugin_data = get_plugin_data(__FILE__);
            echo '
        <div class="updated">
          <p>' . sprintf(__('<strong>%s</strong> requires <strong><a href="http://bit.ly/vcomposer" target="_blank">Visual Composer</a></strong> plugin to be installed and activated on your site.', 'vc_ocoder'), $plugin_data['Name']) . '</p>
        </div>';
        }

    }

// Finally initialize code
    new VCCountDownFreeOcoderAddonClass();
}

function VcCountdownoCoderAdjustBrightness($hex, $steps) {
    // Steps should be between -255 and 255. Negative = darker, positive = lighter
    $steps = max(-255, min(255, $steps));

    // Normalize into a six character long hex string
    $hex = str_replace('#', '', $hex);
    if (strlen($hex) == 3) {
        $hex = str_repeat(substr($hex, 0, 1), 2) . str_repeat(substr($hex, 1, 1), 2) . str_repeat(substr($hex, 2, 1), 2);
    }

    // Split into three parts: R, G and B
    $color_parts = str_split($hex, 2);
    $return = '#';

    foreach ($color_parts as $color) {
        $color = hexdec($color); // Convert to decimal
        $color = max(0, min(255, $color + $steps)); // Adjust color
        $return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
    }

    return $return;
}
