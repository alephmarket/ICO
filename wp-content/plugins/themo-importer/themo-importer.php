<?php
/*
Plugin Name: Themo Importer
Plugin URI: 
Description: Themo Importer allows you to import our outstanding demos from Themo. 
Author: IdeoThemes
Author URI: http://ideothemes.com/
Version: 1.0.3
Text Domain: ideo-importer
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

error_reporting(0);
ini_set('display_errors', false);
ini_set('max_execution_time', 900);

if (!class_exists('WP_Importer')) {
    $class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
    if (file_exists($class_wp_importer)) {
        require $class_wp_importer;
    }
}


// Include importer engine
require dirname( __FILE__ ) . '/engine.php';
require dirname( __FILE__ ) . '/wordpress-importer/wordpress-importer.php';

if ( class_exists( 'WP_Importer' ) ) {
    class Ideo_Import extends WP_Importer
    {

        var $plugin_dir = '';

        var $authors = array();
        var $posts = array();
        var $terms = array();
        var $categories = array();
        var $tags = array();
        var $base_url = '';

        function __construct() {
            // Set current file directory as plugin directory
            $dirname = dirname(__FILE__);
            $tmp = explode('/', $dirname);
            $this->plugin_dir = array_pop($tmp);
        }

        /**
         * Prints import page content
         */
        function dispatch() {
            $this->header();
            $this->grid();
            $this->footer();
        }

        /**
         * Prints import page header
         */
        function header() {
            echo '<style>@import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700&subset=latin,latin-ext);</style>';
            echo '<div class="wrap ideo-oci">';
            screen_icon();
            echo '<h2>' . __( 'THEMO - One-Click Import', 'wordpress-importer' ) . '</h2>';
            echo '<div class="wrapper"><h3 class="header">Import Demo Content</h3>';
        }

        /**
         * Prints import page footer
         */
        function footer() {
            echo '</div></div>';
        }

        /**
         * Creates grid with available demos
         */
        function grid() {

            // Create div for import result
            echo '<div id="import_result" style="display: none"></div>';

            // Add files necessary for dialogs
            add_thickbox();

            echo '
            <div style="head-import">
            <p style="font-size:14px; font-weight:600;">Here you can import one of our demos which is the easiest way to start journey with Themo, you get all theme options and all content from chosen demo. Please read ‘Important notes’ below and when you are ready click Import button and confirm the message.</p>
            </div>
            <div class="alert"><strong>Important notes:</strong><ul>
            <li>We recommend to import demos on a clean WordPress installation.</li>
            <li>All theme options (in Customizer) will be override but none of existing pages, posts, grid, footers or any other data will be deleted or modified.</li>
            <li>Before importing make sure that all required and recommended plugins are installed and activated.</li>
            <li>If you want to import <strong>SLIDERS</strong> you have to <a href="'.admin_url('themes.php?page=install-required-plugins').'"> Install and activate</a> <strong>Slider Revolution and/or LayerSlider</strong> plugins before you run the import.</li>
            <li>Import may take a while because importer has to upload all pages and posts, settings, attachments and generate style to make your site good looking. When you importing Main demo it may take even few minutes.</li>
            <li>Do not refresh the page or close the tab while importnig – wait until the overlay with loader disappear.</li>
            <li>Not all of images which you see on our online demos will be imported because of copyrights but they will be replaced by graphics to keep pages good looking.</li>
            </ul></div>';
            echo '<div class="content">';
            echo '<h3 class="header">Choose demo site you want to import</h3><div class="themes-grid">';

            // Get available demos
            $a = new Ideo\Demos(get_template_directory());

            foreach($a->fetch() as $demo) {
                $id = substr(md5(time().rand(100,999)), 0, 16);

                // Print demo information
                echo '<div class="grid"><div class="item">
                        <img class="image" src="' . DEMO_URL . $demo['id'] . '/cover.png" alt="Demo cover"/>
                        <h2>'.$demo['name'].'</h2>
                        <div class="btns">
                            <a class="btn" href="'.$demo['demo_url'].'" target="_blank">Live&nbsp;demo</a>
                            <a class="btn thickbox" href="#TB_inline/width=600&height=200&inlineId='.$id.'">Import</a>
                        </div>
                      </div></div>';

                // Create form for import starting
                echo '<div id="'.$id.'" class="ideo-confirm" style="display:none;"><h1>'.$demo['name'].'</h1><h3>Are your sure you want to import chosen demo?</h3>
                <div id="plugin-information-footer">
                <form action="admin.php?page='.$this->plugin_dir.'%2FTHEMO.php" method="POST">
                    <input type="hidden" name="demo" value="'.base64_encode($demo['id']).'">
                    <button type="submit" title="'.$demo['name'].'" class="button button-primary right ajax-ideo-loader">Import Now</button>
                </form> 
<!--<a class="button button-primary right ajax-ideo-loader" title="'.$demo['name'].'" href="&demo='.base64_encode($demo['dir']).'" style="margin-left: 6px;">Import Now</a>-->
<a class="button button-default right" onclick="jQuery(\'#TB_closeWindowButton\').click()">Cancel</a></div></div>';
            }

            echo '<div style="clear:both;"></div></div></div>';

            // Create import overlay
            echo '<div class="loading-box" id="ajax-ideo-overlay" style="display: none">
    <div class="loading-content">
        <h1> IMPORTING DEMO </h1>

        <h3 id="title-to-import">{{title-to-import}}</h3>
        <span id="import-step" class="test"></span>
        <div style="background-image:url('.plugin_dir_url( __FILE__ ).'loader_black.gif);height: 20px;background-position: center;background-size: contain;margin: 10px;"></div>
        <span>it can take a few minutes, relax...</span>
    </div>
</div>';
        }
    }
}

/**
 * Creates instance of Ideo_Importer and registers it as importer
 */
function ideo_importer_init() {
    $GLOBALS['ideo_import'] = new Ideo_Import();
    register_importer( 'ideo', 'themo', 'Importer', array( $GLOBALS['ideo_import'], 'dispatch' ) );
}

// Create custom plugin settings menu
add_action('admin_menu', 'ideo_plugin_create_menu');

// Allow external host request
add_filter( 'http_request_host_is_external', '__return_true' );

function ideo_plugin_create_menu() {
    // Create new top-level menu
    $GLOBALS['ideo_import'] = new Ideo_Import();
    add_menu_page('IMPORTER', 'Themo Importer', 'manage_options', __FILE__, array( $GLOBALS['ideo_import'], 'dispatch' ), 'dashicons-download', 80);
}

/**
 * Load importer style file
 */
function load_custom_wp_admin_style() {
        wp_register_style( 'custom_wp_admin_css', plugin_dir_url( __FILE__ ) . 'styles.css', false, '1.0.0' );
        wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );


// Add javascript code for managing import on client side
add_action( 'admin_footer', 'import_demo_action_javascript' );

function import_demo_action_javascript() { ?>
    <script>
        (function($){
            
        
       
            var stepInfoContainer = $('#import-step');
            var steps = [
                {
                    title: 'Importing media...'
                },
                {
                    title: 'Importing demo content and settings...'
                },
                {
                    title: 'Generating styles...'
                }
            ];

            function setStep(step, dontUseAnimation){
                if (dontUseAnimation)
                    stepInfoContainer.text('Step ' + (step + 1) + ' - ' + steps[step].title);
                else {
                    stepInfoContainer.addClass('animation-hidden').one('transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd', function () {
                        stepInfoContainer.text('Step ' + (step + 1) + ' - ' + steps[step].title);
                        stepInfoContainer.removeClass('animation-hidden');
                    });
                }
            };

            function setProgress(progress){
                stepInfoContainer.find('.progress-info').remove();
                stepInfoContainer.append('<span class="progress-info"> ' + Math.floor(progress * 100) + '%</span>')
            }

            $(".ajax-ideo-loader").on("click", function(e) {
                e.preventDefault();

                // Close import dialog
                $(".tb-close-icon").click();

                // Set title in overlay
                $("#title-to-import").text($(this).attr("title"));

                setStep(0, true);
                // Fade in overlay
                $("#ajax-ideo-overlay").fadeIn();

                var resultContainer = $('#import_result');
                var form = $(this).parents("form");
                var currentStep = 0;
                var resultInfo = '';

                // Hide previous import result
                resultContainer.hide();

                // Prepare ajax request data
                var data = {
                    action: "import_demo_action",
                    demo: form.find('[name=demo]').val(),
                    step: 0
                };

                function handleImportResponse(response) {
                    try {
                        response = JSON.parse(response);
                    } catch(e) {
                        response = {
                            code: 1,
                            message: response
                        };
                    }

                    if (response.code !== 0){
                        // There was an error, add message to info panel and finish import
                        resultContainer.html('<div class="error notice"><p>' + response.message + '</p></div>');
                    } else {
                        // All went ok, add message to previous
                        resultInfo += response.message;
                        data.temp_path = response.temp_path;

                        if (response.continue){
                            data.continue = true;
                            setProgress(response.progress);
                            jQuery.post(ajaxurl, data, handleImportResponse);
                            return;
                        }

                        delete data.continue;

                        // While there are steps to perform
                        if (data.step < steps.length - 1){
                            data.step++;
                            setStep(data.step);
                            jQuery.post(ajaxurl, data, handleImportResponse);
                            return;
                        }

                        // All steps finished, show all info
                        resultContainer.html('<div class="updated notice"><p>IMPORT OK <a href="#" onclick="jQuery(\'#import-details\').fadeIn()">Show details</a></p>' +
                            '<div id="import-details">' + resultInfo + '</div>' +
                            '</div></div>');
                        ;
                    }

                    // End of import, hide overlay, scroll to top and fade in result
                    $("#ajax-ideo-overlay").fadeOut({
                        complete: function(){
                            $('html,body').scrollTop(0);
                            resultContainer.fadeIn();
                        }
                    });
                }

                // Send import ajax request
                jQuery.post(ajaxurl, data, handleImportResponse);
            });
       

            // Blocking unintentional page leaving
            var start = 0;
            window.onbeforeunload = function (event) {
                var message = "Sure you want to leave?";
                if (typeof event == "undefined") {
                    event = window.event;
                }

                if(start > 0) {
                    if (event) {
                        event.returnValue = message;
                    }
                    return message;
                } else {
                    // Ignore completely first leave attempt
                    start += 1;
                }
            }

       
            $(function () {
                $('body').on('click', '.thickbox', function () {
                    var height = Math.min(300, $(window).height());
                    var width = Math.min(600, $(window).width());
                    $('#TB_window').css({
                        'height': height + 'px',
                        'width': width + 'px',
                        'margin-left': (-width / 2) + 'px',
                        'top': '50%',
                        'margin-top': (-height / 2) + 'px'
                    });
                    $('#TB_ajaxContent').css('height', (height - 60) + 'px');
                });
            });
       
        })(jQuery);
    </script> <?php
}

// Add ajax action for import
add_action( 'wp_ajax_import_demo_action', 'import_demo_action_callback' );

function import_demo_action_callback() {
    Ideo\Import::$ExpectedFiles = array('data.xml', 'customizer.json', 'pc.json', 'sidebars.json', 'options.json', 'remote.json', 'sliders.json');

   
    $step = intval($_POST['step']);

    if (empty($_POST['continue']) && $step == 0) {
        // Create import with base directory
        $wp_upload_dir = wp_upload_dir();
        $ii = new Ideo\Import($wp_upload_dir['basedir']);
    } else {
        // Load importer from data file
        $data = file_get_contents($_POST['temp_path'] . '/restart.dat');
        $ii = unserialize($data);
    }

    // Decode chosen demo directory based on passed value
    $demo_id = base64_decode($_POST['demo']);

    // Do import
    $result = $ii->process($demo_id, $step);

    if ($step != 2) {
        // Store current state of importer to file
        file_put_contents($ii->getTempDestination() . '/restart.dat', serialize($ii));
    }
   

    echo json_encode($result);
    wp_die();
}

register_shutdown_function('ideo_shutdown');

function ideo_shutdown() {
    if ($error = error_get_last()) {
        if (ob_get_contents()) ob_clean();
        if ($error['type'] === E_ERROR) {
            wp_die($error['message']);
        }
    }
}