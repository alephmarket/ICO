<?php

function ideothemo_pc_sanitize_callback($value)
{
    return $value;
}

class ParallaxComposer
{

    var $path = '';
    var $mode = '';


    function __construct()
    {

        if (isset($_GET['mode'])) {
            $this->mode = $_GET['mode'];
        }

        if ($this->mode == 'pc') {
            add_action('wp_enqueue_scripts', array(&$this, 'scripts'));
            add_action('admin_enqueue_scripts', array(&$this, 'admin_scripts'));
        }
        add_action('customize_register', array(&$this, 'customize_register'));
        add_action('customize_preview_init', array(&$this, 'customize_preview_init'));


        add_action("wp_ajax_pcgateway", array(&$this, "gateway_function"));
        add_action("wp_ajax_nopriv_pcgateway", array(&$this, "gateway_function"));
        add_action( 'init', array( $this, 'set_direction' ) );

    }


    function scripts()
    {
        wp_enqueue_style('ideothemo-pc-style', IDEOTHEMO_PC_URL . 'css/theme-customizer.css', array());
    }

    function wp_enqueue_scripts($scripts = array())
    {

        foreach ($scripts as $script) {
            wp_enqueue_script($script['name'], $script['url'], $script['dep'], $script['version']);
        }
    }

    function admin_scripts()
    {

        wp_enqueue_media();

        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('wp-color-picker');

        wp_enqueue_script('ideothemo-pc-angular', IDEOTHEMO_PC_URL . 'js/angular/angular.min.js', array('jquery', 'jquery-ui-resizable'), '1.6.2', true);
        wp_enqueue_script('ideothemo-pc-angular-route', IDEOTHEMO_PC_URL . 'js/angular/angular-route.min.js', array('ideothemo-pc-angular'), '1.6.2', true);
        wp_enqueue_script('ideothemo-pc-angular-animate', IDEOTHEMO_PC_URL . 'js/angular/angular-animate.min.js', array('ideothemo-pc-angular'), '1.6.2', true);
        wp_enqueue_script('ideothemo-pc-angular-sanitize', IDEOTHEMO_PC_URL . 'js/angular/angular-sanitize.min.js', array('ideothemo-pc-angular'), '1.6.2', true);
        wp_enqueue_script('ideothemo-pc-angular-resource', IDEOTHEMO_PC_URL . 'js/angular/angular-resource.min.js', array('ideothemo-pc-angular'), '1.6.2', true);
        wp_enqueue_script('ideothemo-pc-angular-tree', IDEOTHEMO_PC_URL . 'js/angular/angular-tree/angular-ui-tree.js', array('ideothemo-pc-angular'), '2.15.0', true);

        wp_enqueue_script('ideothemo-pc-angular-bootstrap-colorpicker', IDEOTHEMO_PC_URL . 'js/angular/angular-colorpicker/js/bootstrap-colorpicker-module.js', array('jquery', 'ideothemo-pc-angular'), '1.6.2', true);
        

        wp_enqueue_script('ideothemo-pc-bootstrap', IDEOTHEMO_INIT_DIR_URI . '/js/bootstrap.min.js', array('jquery'), '3.3.4', true);
        wp_enqueue_script('ideothemo-tinymce', includes_url() . '/js/tinymce/tinymce.min.js', array('jquery'), '3.3.4', true);
        wp_enqueue_script('ideothemo-tinymce-plugins', includes_url() . '/js/tinymce/plugins/compat3x/plugin.min.js', array('ideothemo-tinymce'), '3.3.4', true);


        wp_enqueue_style('ideothemo-pc-jquery-ui', IDEOTHEMO_PC_URL . 'css/jquery-ui.css', array());
        wp_enqueue_style('ideothemo-pc-angular-tree-style', IDEOTHEMO_PC_URL . 'js/angular/angular-tree/angular-ui-tree.css', array());
        wp_enqueue_style('ideothemo-pc-bootstrap-style', IDEOTHEMO_INIT_DIR_URI . '/css/bootstrap.min.css', array(), '3.3.5');
        wp_enqueue_style('ideothemo-pc-angular-colorpicker-style', IDEOTHEMO_PC_URL . 'js/angular/angular-colorpicker/css/colorpicker.css', array());

        wp_enqueue_style('font-ideo', IDEOTHEMO_INIT_DIR_URI . '/css/font-ideo.css', array(), IDEOTHEMO_VERSION);
        wp_enqueue_style('ideothemo-pc-fonts-awesome-style', IDEOTHEMO_INIT_DIR_URI . '/css/font-awesome.min.css', array(), '4.3.0');
        wp_enqueue_style('ideothemo-pc-style', IDEOTHEMO_PC_URL . 'css/pc-style.css', array('dashicons', 'editor-buttons'));

        wp_enqueue_script('ideothemo-pc-app', IDEOTHEMO_PC_URL . 'js/pc-app.js' , array('ideothemo-pc-angular', 'ideothemo-pc-angular-tree'), IDEOTHEMO_PC_VERSION, true);


        wp_localize_script('ideothemo-pc-app', '_pcl10n', array(
                'name' => esc_html__('Label', 'themo'),
                'code' => esc_html__('Code', 'themo'),
                'quickimport' => esc_html__('Quick import', 'themo'),
                'mainimport' => esc_html__('Main import', 'themo'),
                'quickexport' => esc_html__('Quick export', 'themo'),
                'mainexport' => esc_html__('Main export', 'themo'),
                'content' => esc_html__('Content', 'themo'),
                'file' => esc_html__('File', 'themo'),
                'files' => esc_html__('Files', 'themo'),
                'save' => esc_html__('Save', 'themo'),
                'cancel' => esc_html__('Cancel', 'themo'),
                'close' => esc_html__('Exit', 'themo'),
                'yes' => esc_html__('Yes', 'themo'),
                'no' => esc_html__('No', 'themo'),
                'on' => esc_html__('ON', 'themo'),
                'off' => esc_html__('OFF', 'themo'),
                'delete' => esc_html__('Delete', 'themo'),
                'import' => esc_html__('Import', 'themo'),
                'export' => esc_html__('Export', 'themo'),
                'copyAll' => esc_html__('Copy all', 'themo'),
                'exportFiles' => esc_html__('Export files', 'themo'),
                'exportAll' => esc_html__('Generate export file', 'themo'),
                'uploadFile' => esc_html__('Upload file', 'themo'),
                'deleteAskAnimation' => esc_html__('Are you sure you want to delete layer animations?', 'themo'),
                'deleteAskLayer' => esc_html__('Are you sure you want to delete the layer?', 'themo'),
                'deleteVC' => wp_kses(__('When you click Delete button your VC column layer will be removed from the Parallax Composer but only temporarily. To complete process and delete VC column permanently you have to disable animation for deleted column in Visual Composer. Go to WordPress admin panel and edit the page with deleted column layer, edit settings of deleted VC column, go to Animation tab and choose None value for Animation option. Save column settings and Update the page.  <b>If you do not disable animation for deleted column it will be added again to the Parallax Composer after refresh.</b>', 'themo'), IDEOTHEMO_KSES_TAGS::allow()),
                'page' => esc_html__('Page', 'themo'),
                'pages' => esc_html__('Pages', 'themo'),
                'section' => esc_html__('Section', 'themo'),
                'sections' => esc_html__('Sections', 'themo'),
                'layer' => esc_html__('Layer', 'themo'),
                'layers' => esc_html__('Layers', 'themo'),
                'layerVC' => esc_html__('VC Column', 'themo'),
                'globalSection' => esc_html__('Body section', 'themo'),
                'addNewLayer' => esc_html__('ADD NEW LAYER', 'themo'),
                'alertError' => esc_html__('ERROR', 'themo'),
                'alertErrorFileValidation' => esc_html__('Wrong file format', 'themo'),
                'alertWarning' => esc_html__('WARNING', 'themo'),
                'alertSuccess' => esc_html__('SUCCESS', 'themo'),
                'alertLinkClick' => esc_html__('Links are permanently locked - if you left the Parallax Composer then your animations would be lost.', 'themo'),
                'alertOffsetSuccess' => esc_html__('Animation has been moved', 'themo'),
                'alertWarningAddFreez' => esc_html__('Failure adding the Freeze. You can not Freeze the Layer in the area, wherein the layer is already freezed. You can freeze one layer many times at different points of the scroll height, but Freeze areas can not overlap themselves and contain themselves.', 'themo'),
                'alertWarningMove' => esc_html__('You are trying to move in prohibited place.', 'themo'),
                'alertWarningEditFreez' => esc_html__('You can not edit the "Position Y" parameter inside the area where the Layer is freezed.', 'themo'),
                'preloader' => array(
                    'pageLoading' => array(
                        'title' => esc_html__('Uploading preview...', 'themo'),
                        'info' => esc_html__('...it takes a moment.', 'themo')
                    ),
                    'copyAnimation' => array(
                        'title' => esc_html__('Copying animations sequence...', 'themo'),
                        'info' => esc_html__('...it takes a moment.', 'themo')
                    )

                ),
                'emptySection' => array(
                    'text' => wp_kses(__('This section is empty. <br>Add your first layer.', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'addLayer' => array(
                    'image' => esc_html__('Image Layer', 'themo'),
                    'audio' => esc_html__('Audio Layer', 'themo'),
                    'shape' => esc_html__('Shape Layer', 'themo'),
                    'multi' => esc_html__('Multiobject Layer', 'themo'),
                    'text' => esc_html__('Text Layer', 'themo'),
                    'textblock' => esc_html__('Text Block Layer', 'themo'),
                    'nullobject' => esc_html__('Null Object', 'themo'),
                    'vc' => esc_html__('VC Column', 'themo'),
                ),
                'editLayer' => array(
                    'sections' => array(
                        'title' => array(
                            'settings' => array(
                                'title' => esc_html__('Generals', 'themo'),
                                'info' => esc_html__('Expand this section to set general Layers options', 'themo')
                            ),
                            'visibility' => array(
                                'title' => esc_html__('LAYER VISIBILITY', 'themo'),
                                'info' => esc_html__('Manage visibility on different resolutions', 'themo')
                            ),
                            'position' => array(
                                'title' => esc_html__('Position parameter', 'themo'),
                                'info' => esc_html__('Create motion animations', 'themo')
                            ),
                            'scale' => array(
                                'title' => esc_html__('Size parameter', 'themo'),
                                'info' => esc_html__('Create scaling animations', 'themo')
                            ),
                            'freez' => array(
                                'title' => esc_html__('Freeze', 'themo'),
                                'info' => esc_html__('Keep the Layer visible while scrolling - Position Y gets fixed position.', 'themo')
                            ),
                            'rotate' => array(
                                'title' => esc_html__('Rotation parameter', 'themo'),
                                'info' => esc_html__('Create rotation animations', 'themo')
                            ),
                            'transform' => array(
                                'title' => esc_html__('Transform parameter', 'themo'),
                                'info' => esc_html__('Create transform animations', 'themo')
                            ),
                            'opacity' => array(
                                'title' => esc_html__('Opacity', 'themo'),
                                'info' => esc_html__('Create fade-in and fade-out animations', 'themo')
                            ),
                            'color' => array(
                                'title' => esc_html__('Background color', 'themo'),
                                'info' => esc_html__('Create color transition animations', 'themo')
                            ),
                            'border' => array(
                                'title' => esc_html__('Layer border', 'themo'),
                                'info' => esc_html__('Animate layer borders', 'themo')
                            ),
                            'borderRadius' => array(
                                'title' => esc_html__('Border radius', 'themo'),
                                'info' => esc_html__('Animate border radiuses', 'themo')
                            ),
                            'start' => array(
                                'title' => esc_html__('Play mode', 'themo'),
                                'info' => esc_html__('Start and stop images changing', 'themo')
                            ),
                            'startStop' => array(
                                'title' => esc_html__('Playing', 'themo'),
                                'info' => esc_html__('Start and stop file playing', 'themo')
                            ),
                            'volume' => array(
                                'title' => esc_html__('Volume', 'themo'),
                                'info' => esc_html__('Increase and decrease the file volume', 'themo')
                            ),
                            'editText' => array(
                                'title' => esc_html__('Text edit', 'themo'),
                                'info' => esc_html__('Animate font options', 'themo')
                            ),
                            'background' => array(
                                'title' => esc_html__('Background', 'themo'),
                                'info' => esc_html__('Main layer settings', 'themo')
                            ),
                        ),
                        'size' => esc_html__('Size', 'themo'),
                        'fontSize' => esc_html__('Font Size', 'themo'),
                        'parent' => esc_html__('Parent section', 'themo'),
                        'copyAnim' => esc_html__('Copy all', 'themo'),
                        'deleteAnim' => esc_html__('Delete all Layer animations', 'themo'),
                        'deleteAudioAnim' => esc_html__('Delete playmode settings', 'themo'),
                        'overflow' => esc_html__('Set overflow hidden to layer', 'themo'),
                        'visible' => esc_html__('Layer visibility', 'themo'),
                        'relative2screen' => esc_html__('Relative to screen', 'themo'),
                        'relative2screenDisableOptimization' => esc_html__('Disable optimization (RS)', 'themo'),
                        'visibleLG' => esc_html__('Large devices displaying (1200px and up)', 'themo'),
                        'visibleMD' => esc_html__('Medium devices displaying (992-1199px)', 'themo'),
                        'visibleSM' => esc_html__('Small devices displaying (768-991px)', 'themo'),
                        'visibleXS' => esc_html__('Extra small devices displaying (less than 768px)', 'themo'),
                        'zIndex' => esc_html__('Display in front of content', 'themo'),
                        'activity' => esc_html__('Layer activity', 'themo'),
                        'align' => esc_html__('Anchor point', 'themo'),
                        'transformOrigin' => esc_html__('Transform origin', 'themo'),
                        'perspective' => esc_html__('Perspective', 'themo'),
                        'backfaceVisibility' => esc_html__('Backface visibility', 'themo'),
                        'positionX' => esc_html__('Position X (horizontal)', 'themo'),
                        'positionY' => esc_html__('Position Y (vertical)', 'themo'),
                        'width' => esc_html__('Width', 'themo'),
                        'height' => esc_html__('Height', 'themo'),
                        'imageSize' => esc_html__('Image size', 'themo'),
                        'imagePosition' => esc_html__('Image position', 'themo'),
                        'imageRepeat' => esc_html__('Image repeat', 'themo'),
                        'rotationX' => esc_html__('X-axis rotation', 'themo'),
                        'rotationY' => esc_html__('Y-axis rotation', 'themo'),
                        'rotationZ' => esc_html__('Z-axis rotation', 'themo'),
                        'scaleX' => esc_html__('X-axis scale', 'themo'),
                        'scaleY' => esc_html__('Y-axis scale', 'themo'),
                        'scaleZ' => esc_html__('Z-axis scale', 'themo'),
                        'translateX' => esc_html__('X-axis translate', 'themo'),
                        'translateY' => esc_html__('Y-axis translate', 'themo'),
                        'translateZ' => esc_html__('Z-axis translate', 'themo'),
                        'skewX' => esc_html__('X-axis skew', 'themo'),
                        'skewY' => esc_html__('Y-axis skew', 'themo'),
                        'scaleImage' => esc_html__('Scale image', 'themo'),
                        'setOffset' => esc_html__('Shift animations', 'themo'),
                        'changeImage' => esc_html__('Change image', 'themo'),
                        'changeImages' => esc_html__('Change images', 'themo'),
                        'changeFile' => esc_html__('Change file', 'themo'),
                        'changeContent' => esc_html__('Change text', 'themo'),
                        'change' => esc_html__('Upload', 'themo'),
                        'startFreez' => esc_html__('start freeze', 'themo'),
                        'stopFreez' => esc_html__('stop freeze', 'themo'),
                        'rotate' => esc_html__('Axis of rotation', 'themo'),
                        'type' => esc_html__('Border type', 'themo'),
                        'color' => esc_html__('Color', 'themo'),
                        'colorFont' => esc_html__('Font color', 'themo'),
                        'fileUploadSuccess' => esc_html__('Files have been uploaded successfully.', 'themo'),
                        'showFiles' => esc_html__('[ + Expand files list]', 'themo'),
                        'hideFiles' => esc_html__('[ - Collapse files list]', 'themo'),
                        'file' => esc_html__('File:', 'themo'),
                        'ppf' => esc_html__('Frequency of changing', 'themo'),
                        'startAnim' => esc_html__('Start', 'themo'),
                        'stopAnim' => esc_html__('Stop', 'themo'),
                        'loopNum' => esc_html__('Repetitions number', 'themo'),
                        'offsetAnim' => esc_html__('Move', 'themo'),
                        'loop' => esc_html__('Play indefinitely', 'themo'),
                        'start' => esc_html__('Start', 'themo'),
                        'stop' => esc_html__('Stop', 'themo'),
                        'relative2parent' => esc_html__('Relative To Parent ', 'themo'),
                        'spacing' => esc_html__('Letter-spacing', 'themo'),
                        'lineHeight' => esc_html__('Line-height', 'themo'),
                        'fontFamily' => esc_html__('Font Family', 'themo'),
                        'fontWeight' => esc_html__('Font Weight', 'themo'),
                        'padding' => esc_html__('Padding:', 'themo'),
                        'opacity' => esc_html__('Opacity', 'themo'),
                        'volume' => esc_html__('Volume', 'themo'),
                        'useCreateJS' => esc_html__('Animation from FLASH CANVAS', 'themo'),
                        'backgroundColor' => esc_html__('Color', 'themo'),
                        'borderColor' => esc_html__('Border color', 'themo'),
                        'horizontal' => esc_html__('Horiznontal', 'themo'),
                        'vertical' => esc_html__('Vertical', 'themo'),
                    )
                ),
                'chooseFile' => esc_html__('Choose file', 'themo'),
                'chooseFiles' => esc_html__('Choose files', 'themo'),
                'chooseAudioFile' => esc_html__('Choose audio file', 'themo'),
                'modalWindow' => array(
                    'infoAudio' => esc_html__('The Parallax Composer supports .mp3 and .ogg files.', 'themo'),
                    'infoMulti' => esc_html__('The Parallax Composer supports .jpg, .png and .gif files.', 'themo'),
                    'infoImport' => esc_html__('Upload previously generated.zip file.', 'themo'),
                    'infoShape' => esc_html__('Shape layer supports only canvas code and and already contains tags.', 'themo'),
                    'settings' => esc_html__('Settings', 'themo'),
                    'import' => esc_html__('Import', 'themo'),
                    'importInfo' => esc_html__('Paste import code (copied from export textfield) into textfield above or use options below to upload previously generated export file.', 'themo'),
                    'export' => esc_html__('Export', 'themo'),
                    'exportInfo' => esc_html__('Quicky import works only for layers added via Parallax Composer, it does not work for VC column layers (while Quick import VC column layers are replaced by Null object layers to keep layers structure). !!! We recommend to use Quick import only within one project (website).', 'themo'),
                    'exportFilesInfo' => esc_html__('Import all layers with animations (PC layers and VC column layers) and all files attached to layers. !!! Remember, when you import VC column layers the columns to which you import should have the same Unique IDs as columns from which you import (you have to copy Unique IDs from original columns and paste them to new columns via Classic editor in WP Backend). After zip generate please click save and then leave in popup.', 'themo'),
                    'displayLayerNames' => esc_html__('Layers names', 'themo'),
                    'displayLayerNamesTypeOff' => esc_html__('Off', 'themo'),
                    'displayLayerNamesTypeAll' => esc_html__('Show all', 'themo'),
                    'displayLayerNamesTypeHover' => esc_html__('Block hover', 'themo'),
                    'displayLayerNamesInfo' => esc_html__('Layers names option displays layers labels above layers on the Preview screen: Show all means all layers names are permanently visible on the preview screen (above every single layer); Block hover means layer name will be visible on the preview when you hover on the layer on the layer list.', 'themo'),
                    'displayTootltips' => esc_html__('Info popups', 'themo'),
                    'displayPanelOverlayed' => esc_html__('Panel Overlayed', 'themo'),
                    'displayPanelOverlayedInfo' => esc_html__('Enable this option if you want to display PC panel over the Preview screen instead of next to it. This is helpful for users with smaller screen resolutions.', 'themo'),
                    'displaySectionBorder' => esc_html__('Section borders', 'themo'),
                    'displaySectionOverlay' => esc_html__('Display section overlay', 'themo'),
                    'displayContentWidthBorder' => esc_html__('Content borders', 'themo'),
                    'displayContentWidthBorderInfo' => esc_html__('Content borders option displays on the Preview screen auxiliary lines which defining borders of the content width (set in Customizer theme options).', 'themo'),
                    'panelColor' => esc_html__('Panel color', 'themo'),
                    'panelColorInfo' => esc_html__('Panel color option changes the color of admin panel. It is only for better contrast between panel and page background.', 'themo'),
                    'panelColorBlack' => esc_html__('Dark', 'themo'),
                    'panelColorWhite' => esc_html__('Light', 'themo'),

                    'add' => array(
                        'image' => esc_html__('Add Image layer', 'themo'),
                        'audio' => esc_html__('Add Audio layer', 'themo'),
                        'shape' => esc_html__('Add Shape layer', 'themo'),
                        'multi' => esc_html__('Add Multiobject layer', 'themo'),
                        'text' => esc_html__('Add Text layer', 'themo'),
                        'textblock' => esc_html__('Add Text Block layer', 'themo'),
                        'nullobject' => esc_html__('Add Null Object layer', 'themo')
                    ),
                    'edit' => array(
                        'image' => esc_html__('Edit Image layer', 'themo'),
                        'audio' => esc_html__('Edit Audio layer', 'themo'),
                        'shape' => esc_html__('Edit Shape layer', 'themo'),
                        'multi' => esc_html__('Edit Multiobject layer', 'themo'),
                        'text' => esc_html__('Edit Text layer', 'themo'),
                        'textblock' => esc_html__('Edit Text Block layer', 'themo'),
                        'nullobject' => esc_html__('Edit Null Object layer', 'themo')
                    )
                ),
                'timeline' => array(
                    'width' => esc_html__('Width', 'themo'),
                    'height' => esc_html__('Height', 'themo'),
                    'top' => esc_html__('Position Y', 'themo'),
                    'left' => esc_html__('Position X', 'themo'),
                    'align' => esc_html__('Anchor point', 'themo'),
                    'borderTopLeftRadius' => esc_html__('Top-left radius', 'themo'),
                    'borderTopRightRadius' => esc_html__('Top-right radius', 'themo'),
                    'borderBottomLeftRadius' => esc_html__('Bottom-left radius', 'themo'),
                    'borderBottomRightRadius' => esc_html__('Bottom-right radius', 'themo'),
                    'borderStyle' => esc_html__('Border type', 'themo'),
                    'borderWidth' => esc_html__('Border thickness', 'themo'),
                    'borderColor' => esc_html__('Border color', 'themo'),
                    'rotationX' => esc_html__('Rotation X', 'themo'),
                    'rotationY' => esc_html__('Rotation Y', 'themo'),
                    'rotationZ' => esc_html__('Rotation Z', 'themo'),
                    'scaleX' => esc_html__('Scale X', 'themo'),
                    'scaleY' => esc_html__('Scale Y', 'themo'),
                    'scaleZ' => esc_html__('Scale Z', 'themo'),
                    'x' => esc_html__('Translate X', 'themo'),
                    'y' => esc_html__('Translate Y', 'themo'),
                    'z' => esc_html__('Translate Z', 'themo'),
                    'skewX' => esc_html__('Skew X', 'themo'),
                    'skewY' => esc_html__('Skew Y', 'themo'),                    
                    'opacity' => esc_html__('Opacity', 'themo'),
                    'backgroundColor' => esc_html__('Background color', 'themo'),
                    'volume' => esc_html__('Volume', 'themo'),
                    'fontSize' => esc_html__('Font size', 'themo'),
                    'color' => esc_html__('Font color', 'themo'),
                    'letterSpacing' => esc_html__('Letter-spacing', 'themo'),
                    'lineHeight' => esc_html__('Line-height', 'themo'),
                    'paddingTop' => esc_html__('Padding top', 'themo'),
                    'paddingRight' => esc_html__('Padding right', 'themo'),
                    'paddingBottom' => esc_html__('Padding bottom', 'themo'),
                    'paddingLeft' => esc_html__('Padding left', 'themo')
                ),
                'tooltip' => array(
                    'title' => esc_html__('Tooltip TITLE', 'themo'),
                    'content' => esc_html__('Tooltip Content', 'themo')
                ),
                'ParentSection' => array(
                    'title' => esc_html__('Parent Section', 'themo'),
                    'content' => wp_kses(__('<p>Parent section is the page section (container) to which the layer is assigned. By default the layer is assigned to the section to which it has been added, but using this option you can move this layer to other section. When you change Parent section for the layer it will be moved to other section with all its animations - all Key points will be shifted on the Scroll line.</p><div class="important"><h4>Important</h4><p>Layer assignment is strictly related with its visibility. The layer assigned to the section will be visible only within this section, so it will be hiding behind neighboring sections. BUT, if you want to animate the layer accross more than one section, you can assign this layer to Body section and you will be able to animate layer across the whole site.</p><p>Layer assignment affects the order of layers displaying on the screen. By default, all layers added to Parallax Composer are assigned to page sections and they are displayed behind the content (behind VC shortcodes which are not added to PC). When you assign a layer to the Body section it will be always displayed at the very front on the screen. Layers ordering is very important feature, so take your time and see below description to find how layers assignment and two other options affect this order.</br>There are three layer options which determine the order of layers displaying on the screen: Parent section, Relative to screen and Display in front of content.</p></div>', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'RelativeToScreen' => array(
                    'title' => esc_html__('Relative to screen', 'themo'),
                    'content' => wp_kses(__('<p>Realtive to screen option (RTS) allows to positioning the layer in relation to the browser window, so it keeps the layer visible on the screen without freezing. It is very useful option, it greatly simplifies work with PC so we strongly recommend to use it.</p><div class="important"><h4>Important</h4><p>Relative to screen causes that to the parent section to which the layer is assigned, an additional container is added and this additional container (RTS container) becomes the new workspace for the layer and takes over the role of the parent element. This feature changes the principles of most animations, but only for better. Read below how it works for better understanding how to use it.</p><p>RTS container is still part of the parent section so it moves together with the parent section while scrolling. BUT when, and only when the parent section covers entire screen, this additional RTS container stop moving with the section, it is positioning to the browser window now, so it stays visible on the screen until next section (section below) comes on the screen.On the example below, Realtive to screen option is turned on for green layer and turned off for red layer (for better view an additional RTS container is marked with black border). As you see, while scrolling both layers are moving the same - the green layer moves in relation to additional container while the red layer moves in relation to the section. But when the section covers entire screen, the additional container stops, so the green layer stops too. And they stay still until below section comes on the screen. Accordingly, when an additional container stay still on the screen, it covers entire screen which gives you ability to animate the layer in relation to the screen.</p><p>Relative to screen option affects the order of layers displaying on the screen. Layers ordering is very important feature, so take your time and see below description to find how RTS and two other options affect this order.</br>There are three layer options which determine the order of layers displaying on the screen: Parent section, Relative to screen and Display in front of content.</p></div>', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'RelativeToScreenOptimization' => array(
                    'title' => esc_html__('Disable Optimization (RS)', 'themo'),
                    'content' => wp_kses(__('<p>Disable optimization is an additional option which refers directly to Relative to screen container. Disable optimization option is turned off by default (optimization is enabled) and should stay turned off for most of your work with the PC. However, if you’re gonna place the layer assigned to R2S container outside the parent section, you should disable optimization because layer animation may run improperly.</p>', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'AnchorPoint' => array(
                    'title' => esc_html__('Anchor point', 'themo'),
                    'content' => wp_kses(__('<p>Anchor point is a starting position of the layer placed inside a parent container (parent section or body section or RTS container or parent layer if you assign the layer to another layer).</p><div class="important"><h4>Important</h4><p>Changing the Anchor point does not change the values of the Position parameters. If you change the Anchor point the layer will be displayed in different place on the Preview screen - Position parameters will still have the same values but will be positioned in relation to different point inside the parent element.</p></div>', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'DisplayInFrontOfContent' => array(
                    'title' => esc_html__('Display in front of content', 'themo'),
                    'content' => wp_kses(__('<p>By default all layers added in Parallax Composer are displayed behind the content (means shortcodes added via Visual Composer) but can place it in the front of content using this option.</p><div class="important"><h4>Important</h4><p>Layers ordering is very important feature, so take your time and see below description to find how Display in front of content and two other options affect this order.</br>There are three layer options which determine the order of layers displaying on the screen: Parent section, Relative to screen and Display in front of content.</p></div>', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'UploadImage' => array(
                    'title' => esc_html__('Upload image', 'themo'),
                    'content' => wp_kses(__('<p>Using this option you can replace image file - image will be changed but all options and created animations will be kept intact.</p>', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'UploadImages' => array(
                    'title' => esc_html__('Upload images', 'themo'),
                    'content' => wp_kses(__('<p>Using this option you can replace images files - images will be changed but all options and created animations will be kept intact.</p>', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'ChangeFile' => array(
                    'title' => esc_html__('Change audio file', 'themo'),
                    'content' => wp_kses(__('<p>Using this option you can replace audio file with the new one but all your settings will be kept - all Key points will stay on the Scrollline in the same place and unchanged.</p>', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'ShiftAnimations' => array(
                    'title' => esc_html__('Shift animations', 'themo'),
                    'content' => wp_kses(__('<p>Using this option you can shift all layer animations on scroll height - all Key points will be shifted on the Scroll line. You can set positive or negative values to move your animation up and down. It&acute;s very useful option, when you want that all animations will proceed in the same form but at the different point of the page height, you do not have to shift all Key points separately.</p>', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'ShiftAnimationsAudio' => array(
                    'title' => esc_html__('Shift animations', 'themo'),
                    'content' => wp_kses(__('<p>Using this option you can shift all layer play options on scroll height - all Key points will be shifted on the Scroll line. You can set positive or negative values to move Key points up and down on Scrloll line. It&acute;s very useful option, when you want play audio in the same form but at the different point of the page height, you do not have to shift all Key points separately.</p>', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'DeleteAllLayerAnimiations' => array(
                    'title' => esc_html__('Delete all layer animations', 'themo'),
                    'content' => wp_kses(__('<p>Using this option you can delete all layer animations but not the layer itself - this option erase all Key points from Scroll line.</p>', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'DeleteAllLayerAnimiationsAudio' => array(
                    'title' => esc_html__('Delete all play settings', 'themo'),
                    'content' => wp_kses(__('<p>Using this option you can delete all Play mode settings but not layer itself - all Key points will be removed from the Scrolline.</p>', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'LayerVisibility' => array(
                    'title' => esc_html__('Layer visibility', 'themo'),
                    'content' => wp_kses(__('<p>In this tab you can decide on which screen resolutions your layer will be visable. It is very useful when you create advanced animations and it is hard to keep them good looking on every resolutions. You can use particular layers on some resolutions and use different layers on other resolutions.</p>', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'LayerActivity' => array(
                    'title' => esc_html__('Layer visibility', 'themo'),
                    'content' => wp_kses(__('<p>Using this option you can You can turn off your layer without removing it. It will be turned Off but you can turn it On other time and use it again.</p>', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'Position' => array(
                    'title' => esc_html__('Position parameter', 'themo'),
                    'content' => wp_kses(__('<p>In this tab you find parameters which generate motion animations. Position X parameter apply to moving layer horizontally, Position Y parameter apply to moving layer vertically. To move layer on the screen you need to assign to position parameters different values at different points on the scroll.</br>For position parameters you can use pixels or percentages (choose unit using switcher). Percentages relate to the parent container or to RTS container if Relative to screen option is enabled.</p><div class="important"><h4>Important</h4><p>Notice, that if you decide to use pixels or percentages once, you should use it constantly by all the time for one layer. Changing unit from pixels to percentages and vice versa at different points of the scroll may cause problems with position conversion, so your animation may runs improperly. Keep it always in mind.</p></div>', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'Freeze' => array(
                    'title' => esc_html__('Freeze function', 'themo'),
                    'content' => wp_kses(__('<p>Freeze function is an additional option relates directly to Position Y parameter. When you Freeze the layer it gets fixed position. It means that the layer stays in the same position on the screen even when you scroll because it is positioned in relation to the browser window. To use Freeze function simply start freeze at one point of the scroll height and stop freeze at the different point of the scroll.</p><div class="important"><h4>Important</h4><p>You CAN NOT edit and change Position Y parameter when the layer is freezed (between the starting point and the end point of the Freeze) because it gets fixed position, which is directly related with Position Y parameter.</p><p>Freeze function must be started and stopped. When you decide to use Freeze function and you start it at one point of the scroll, you have to stop it at the different point of the scroll - you CAN NOT leave Freeze function started without stopping it because it may cause unexpected problems.</p><p>DO NOT freeze layer if you use Boxed layout. When you turn on Freeze the layer changes its anchor point from parent section container to browser window, and because container of boxed section does not coincide with browser window, the layer positions will change and your motion animation will not proceed properly.</p><p>DO NOT freeze layer if you use percentages unit for Size parameter. Percentages are calculated in relation to parent container. When you turn on Freeze the layer changes its relation from parent section container to browser window, and in most cases the size of parent section is not the same as the size of browser window. That is why when you turn on Freeze your layer change its size, which is rather undesirable.</p></div>', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'Size' => array(
                    'title' => esc_html__('Size parameter', 'themo'),
                    'content' => wp_kses(__('<p>In this tab you have two size parameters, which generate scaling animation: Width parameter and Height parameter, and two customization, non-animated options. To scale up or down the layer you need to assign to Width and Height parameters different values at different points on the scroll. To set layer size you can use pixels or percentages (choose unit using switcher). Percentages relate to the parent container or to RTS container if Relative to screen option is enabled.</br>Notice, that there is a link icon between two size parameters. When you link both values together, changing value of one parameter will automatically change the value of second parameter to maintain initial aspect ratio of the image.</p><div class="important"><h4>Important</h4><p>Both size parameters refer to the size of the layer container, not to the image itself - image is added as a background to that container and it gets background properties in css. Keep it always in mind.</br>This solution is more flexible - together with Image size and Image position options give you much more uses.</p></div>', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'SizeAlt' => array(
                    'title' => esc_html__('Size parameter', 'themo'),
                    'content' => wp_kses(__('<p>In this tab you have two size parameters, which generate scaling animation: Width parameter and Height parameter. Both size parameters refer to the size of the layer container. To scale up or down the layer you need to assign to Width and Height parameters different values at different points on the scroll. To set layer size you can use pixels or percentages (choose unit using switcher). Percentages relate to the parent container or to RTS container if Relative to screen option is enabled.</br>Notice, that there is a link icon between two size parameters. When you link both values together, changing value of one parameter will automatically change the value of second parameter to maintain initial aspect ratio of the image.</p>', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'ImageSize' => array(
                    'title' => esc_html__('Image size', 'themo'),
                    'content' => wp_kses(__('<p>Image size is an additional option which can not be animated but it relate to Image displaying inside lthe Layer container. As you already know the image has the css background properties. Using this option you can set background-size property for the image inside the layer container:</p><ul><li>No scale - the image will be displayed in a container in its original size and aspect ratio (proportions). When original size of the image is smaller than size of the layer container then the image will be repeated but when original size of the image is bigger then some parts of image will be missing.</li><li>Scale - the image takes 100% width and 100% height of the layer container. It will be scale to cover whole container without keeping aspect aratio of the image. When aspect ratio of the layer container is different than aspect ratio of the image then the image will be stretched or squeezed.</li><li>Cover - the image will be scale, with its original aspect ratio, to cover whole container. When aspect ratio of the container is different than aspect ratio of the image then some parts of the image will be missing.</li><li>Contain - the image will be scale, with its original aspect ratio, to the largest size such that both its width and its height can fit inside the container. If aspect ratio of the container is different than aspect ratio of the image then image will be repeated.</li></ul> ', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'Rotation' => array(
                    'title' => esc_html__('Rotation', 'themo'),
                    'content' => wp_kses(__('<p>In this tab you have three parameters which generate rotation animations and three customization, non-animated options. To rotate layer you need to assign to the X, Y and Z-axis rotation parameters different values at different points on the scroll. Axis X, Axis Y and axis Z are separated parameters, so you can rotate the layer around all axises at the same time, creating 3D rotations.</br>As you see, to each rotation parameters you can enter two values. In the first field you can enter number of full rotations, and in the second field you can enter exact number of degrees that the layer has to rotate.</p>', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'Transform' => array(
                    'title' => esc_html__('Transform', 'themo'),
                    'content' => wp_kses(__('', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'TransformOrigin' => array(
                    'title' => esc_html__('Transform origin', 'themo'),
                    'content' => wp_kses(__('<p>For each X, Y and Z rotations, you can choose Transform origin for rotation axises. Transfer origin is kind of tangential point of rotation, it means a place on the layer container, where you want to anchore (place) rotation axis:</p><ul><li>X-axis is a horizontal line, so you can place its Transform origin at the top, center or bottom points on the graph.</li><li>Y-axis is a vertical line, so you can place its Transform origin at the left, center or right points on the graph.</li><li>Z-axis runs "into" the layer (perpendicular to the screen surface), so you can place its Transform origin at all points on the graph.</li></ul>', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'BackfaceVisibility' => array(
                    'title' => esc_html__('Backface visibility', 'themo'),
                    'content' => wp_kses(__('<p>When this option is turned on then the backface of the layer is visible while rotating.</p>', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'Perspective' => array(
                    'title' => esc_html__('Perspective', 'themo'),
                    'content' => wp_kses(__('<p>This option helps you to create 3D effect for rotated layers. The Perspective property defines how many pixels a layer is placed from the view. This property allows you to change the perspective on how layers are viewed.</p><div class="important"><h4>Important</h4<p>Perspective property refers to the child of the layer, not to the layer itself. It means that if you want to make a perspective view for the layer you should define Perspective property for its parent.</br>If you are not sure how to set Parent-Child relation navigate to Parenting section in PC documentation.</p></div>', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'Opacity' => array(
                    'title' => esc_html__('Opacity', 'themo'),
                    'content' => wp_kses(__('<p>In this tab you find only one parameter which generate Fade-in and Fade-out animations. Opacity parameter ranges from 0 - 100%, where 0 makes the layer completely invisible, and 1 makes the layer fully visible. To generate fade-in or fade-out animation you need to assigned different values to Opacity parameter at different points on the scroll. The layer will appear or disappear gradually.</p>', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'Background' => array(
                    'title' => esc_html__('Background', 'themo'),
                    'content' => wp_kses(__('<p>In this tab you have two background parameters - the Background color and Background opacity. You can animate the background parameters by assigning different values at the different scroll height. Notice that the background parameters will be visible only for .png and .gif files which do not have the background.</p>', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'LayerBorder' => array(
                    'title' => esc_html__('Layer border', 'themo'),
                    'content' => wp_kses(__('<p>In this tab you can set the layer container border type and color, using several parameters. You can animate border by changing each parameter values at different points on scroll.</p>', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'BorderRadius' => array(
                    'title' => esc_html__('Border radius', 'themo'),
                    'content' => wp_kses(__('<p>In this tab you can add and animate radius of layer container corners. Each of the four corners are separate parameters, so you can change them independently. If you want that all the corners have the same radius, click a link icon and type shared value in active text field.</p>', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'PlayMode' => array(
                    'title' => esc_html__('Play mode', 'themo'),
                    'content' => wp_kses(__('<p>In this tab you have several parameters and options which are used to play the sequence of added images. To create time-laps animation (sequence of changing images) you have to set the starting and stop point at different points on the scroll, set frequency of images changing and decide how many times the full sequence will be repeated.</p>', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'StartStopMulti' => array(
                    'title' => esc_html__('Start and Stop', 'themo'),
                    'content' => wp_kses(__('<p>Set the Start and Stop point of the animation, means where on the page the images start to change, and where they stop changing.</p><p>The starting and end positions are not editable, means that once you set them you cannot change theirs positions on the Scroll line, so if you are going to play the sequence of images at the different point on the scroll then you have to set the starting and end positions once again and the previous interval will be automatically removed.</p>', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'FrequencyOfChanging' => array(
                    'title' => esc_html__('Frequency of changing', 'themo'),
                    'content' => wp_kses(__('<p>Using this option you can define how many pixels scrolling will change image to another - images will be changing one by one while scrolling, by defined number of pixels.</p>', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'RepetitionsNumber' => array(
                    'title' => esc_html__('Repetitions number', 'themo'),
                    'content' => wp_kses(__('<p>Using this option you can set precise number of repetitions of all images sequence or you can check Play indefinitely option below.</p>', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'TextEdit' => array(
                    'title' => esc_html__('Text edit', 'themo'),
                    'content' => wp_kses(__('<p>In this section you have several parameters which generate text animations and three customization, non-animated font settings from whcih you should start. Font family, Font weight and Letter spacing are settings which you can not use for animations, you can set in once for text appearance customization. Rest of controls in Text edit tab you can freely animate. You can use Font size parameter and Line-height parameter for scale animation, Font color and Opacity parameters for colors transition animation and padding parameters to animate background size.</p>', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'StartStopAudio' => array(
                    'title' => esc_html__('Start and Stop', 'themo'),
                    'content' => wp_kses(__('<p>Using this option you can add a playing area in which your audio file will be played. Simply choose the Starting point and the Stop point at different scroll height. Your file will be played only between these points.</p><p>The starting and end positions are not editable, means that once you set them you cannot change theirs positions on the Scroll line, so if you are going to play audio at the different point on the scroll then you have to set the starting and end positions once again and the previous interval will be automatically removed.</p>', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'PlayIndefinitely' => array(
                    'title' => esc_html__('Play indefinitely', 'themo'),
                    'content' => wp_kses(__('<p>By default your audio file will be played once, but using this option you cause that audio will be played indefinitely (naturally only inside playing area which you defined).</p>', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'Volume' => array(
                    'title' => esc_html__('Volume', 'themo'),
                    'content' => wp_kses(__('<p>Using options in this tab you can control the volume of your audio file. Notice, that you can set different volumes at different points on the page height and if you do so your file will be smoothly volumed up or volumed down.</p>', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                ),
                'NullBorderColor' => array(
                    'title' => esc_html__('Border Color', 'themo'),
                    'content' => wp_kses(__('<p>Set color for Null object border and set color opacity using slider below. This is only auxiliary border which are visible only on the Preview screen, it will not be displayed on the site.</p>', 'themo'), IDEOTHEMO_KSES_TAGS::allow())
                )                
            )
        );

        wp_localize_script('ideothemo-pc-app', '_pc', array(
                'config' => array(
                    'url' => IDEOTHEMO_PC_URL,
                    'ajax' => array(
                        'url' => 'admin-ajax.php?action=pcgateway',
                        'nonce' => wp_create_nonce('pc-nonce')
                    )
                ),
                'data' => get_option("pc_data", array()),
                'fonts' => ideothemo_get_google_fonts(),
                'fonts_extension' => ideothemo_get_font_extension(),
                'version' => IDEOTHEMO_PC_VERSION,
                'settings' => get_option("pc_settings", array(
                        'disableParallaxComposerAnimWidth' => false,
                        'displayContentWidthBorder' => false,
                        'displayLayerNames' => false,
                        'displayLayerNamesType' => "all",
                        'displaySectionBorder' => false,
                        'displaySectionOverlay' => false,
                        'displayTootltips' => true,
                        'panelColor' => "black",
                    )
                ),
            )
        );
    }

    function customize_register($wp_customize)
    {        

        if( $this->mode == 'pc' || defined( 'DOING_AJAX' ) ){

                $wp_customize->remove_section('layout');
                $wp_customize->remove_section('title');
                $wp_customize->remove_section('themes');
                $wp_customize->remove_section('nav');
                $wp_customize->remove_section('colors');
                $wp_customize->remove_section('title_tagline');
                $wp_customize->remove_section('static_front_page');
                $wp_customize->remove_section('header_image');
                $wp_customize->remove_section('background_image');
                $wp_customize->remove_section('custom_css');

                $wp_customize->add_section('pc_section', array(
                    'title' => esc_html__('Parallax Composer', 'themo'),
                    'priority' => 200,
                ));
                $wp_customize->add_setting('pc_settings', array(
                    'capability' => 'edit_theme_options',
                    'type' => 'option',
                    'transport' => 'postMessage',
                    'sanitize_callback' => 'ideothemo_pc_sanitize_callback',
                ));
                $wp_customize->add_control(new WP_Customize_PcPanel_Control($wp_customize, 'pcpanel', array(
                    'label' => esc_html__('PC Panel', 'themo'),
                    'section' => 'pc_section',
                    'settings' => 'pc_settings'
                )));
                
        }


    }

    function customize_preview_init()
    {

        wp_enqueue_script('ideothemo-pc-themecustomizer', IDEOTHEMO_PC_URL . 'js/theme-customizer' . IDEOTHEMO_JS_MODE, array('jquery'), IDEOTHEMO_PC_VERSION, true);
        wp_enqueue_style('ideothemo-pc-themecustomizer-style', IDEOTHEMO_PC_URL . 'css/theme-customizer.css', array(), IDEOTHEMO_PC_VERSION);

    }

    function clear_image_array(&$obj)
    {
        if (!is_object($obj)) return false;

        $keys = array('id', 'title', 'url', 'filesizeHumanReadable', 'filename', 'width', 'height');
        foreach (array_keys((array)$obj) as $key) {
            if (!in_array($key, $keys)) unset($obj->{$key});
        }
    }

    function gateway_function()
    {
        global $wp_filesystem;

        $nonce = $_GET['nonce'];
        $method = $_GET['method'];        
       
        $rawdata = $wp_filesystem->get_contents('php://input');
        
        if(!$rawdata){
            $rawdata =  apply_filters( 'pc_gateway_rawdata', $rawdata );
        }
        
        $rawdata = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $rawdata);
        $data = json_decode($rawdata, true);

        if (!wp_verify_nonce($nonce, "pc-nonce")) {
            exit("No naughty business please");
        }

        switch ($method) {
            case 'save':
                $save = get_option('pc_data', array());
                $pageID = $data['currentPage']['id'];
                $save[$pageID] = $data['sections'];

                echo json_encode($save);
                update_option("pc_data", $save);


                break;
            case 'savesettings':

                echo json_encode($data);
                update_option("pc_settings", $data);


                break;
            case 'getpages':
                $output = array();
                $args = array('post_type' => 'page', 'posts_per_page' => -1);
                $query = new WP_Query($args);

                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();
                        $output[] = array('id' => get_the_ID(), 'title' => get_the_title(), 'url' => get_permalink());
                    }
                }

                wp_reset_query();
                wp_reset_postdata();


                echo json_encode($output);
                break;
            case 'export':
                $wp_upload_dir = wp_upload_dir();

                $filename = $wp_upload_dir['path'] . '/export_' . date('YmdHis') . '.zip';

                $layers = $data;
                $assets = array();
                $output = array();

                if (is_array($layers)) {
                    foreach ($layers as $layer) {
                        if ($layer['type'] == 'image') {
                            $assets[] = array('id' => $layer['id'], 'file' => $layer['image']);
                        } else if ($layer['type'] == 'multi') {
                            if (is_array($layer['multiimages'])) {
                                foreach ($layer['multiimages'] as $file) {
                                    $assets[] = array('id' => $layer['id'], 'file' => $file);
                                }
                            }
                        } else if ($layer['type'] == 'audio') {
                            $assets[] = array('id' => $layer['id'], 'file' => $layer['audio']);
                        }
                        if (count($layer['nodes'] > 0)) {
                            foreach ($layer['nodes'] as $nodes_layer) {
                                if ($nodes_layer['type'] == 'image') {
                                    $assets[] = array('id' => $nodes_layer['id'], 'file' => $nodes_layer['image']);
                                } else if ($nodes_layer['type'] == 'multi') {
                                    if (is_array($nodes_layer['multiimages'])) {
                                        foreach ($nodes_layer['multiimages'] as $file) {
                                            $assets[] = array('id' => $nodes_layer['id'], 'file' => $file);
                                        }
                                    }
                                } else if ($nodes_layer['type'] == 'audio') {
                                    $assets[] = array('id' => $nodes_layer['id'], 'file' => $nodes_layer['audio']);
                                }
                                /////////////////////////////////////////////////
                                if (count($nodes_layer['nodes'] > 0)) {
                                    foreach ($nodes_layer['nodes'] as $nodes2_layer) {
                                        if ($nodes2_layer['type'] == 'image') {
                                            $assets[] = array('id' => $nodes2_layer['id'], 'file' => $nodes2_layer['image']);
                                        } else if ($nodes2_layer['type'] == 'multi') {
                                            if (is_array($nodes2_layer['multiimages'])) {
                                                foreach ($nodes2_layer['multiimages'] as $file) {
                                                    $assets[] = array('id' => $nodes2_layer['id'], 'file' => $file);
                                                }
                                            }
                                        } else if ($nodes2_layer['type'] == 'audio') {
                                            $assets[] = array('id' => $nodes2_layer['id'], 'file' => $nodes2_layer['audio']);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }


                $zip = new ZipArchive();


                if ($zip->open($filename, ZipArchive::CREATE || ZipArchive::OVERWRITE) !== TRUE) {
                    exit("cannot open <$filename>\n");
                }
                $zip->addFromString("data.json", json_encode($layers));
                $zip->addEmptyDir('assets');

                $site_url = site_url();
                $get_home_path = get_home_path();


                foreach ($assets as $asset) {
                    if (file_exists(str_replace($site_url . '/', $get_home_path, $asset['file']['url']))) {
                        $zip->addFromString('assets/' . $asset['id'] . '/' . $asset['file']['filename'], ideothemo_get_contents($asset['file']['url']));
                    }
                }

                $zip->close();

                $output = array('file' => $wp_upload_dir['url'] . '/' . basename($filename), 'asset' => $assets, 'path' => get_home_path(), 'site' => site_url());

                echo json_encode($output);
                wp_die();

                break;
            case 'import':
                WP_Filesystem();
                $wp_upload_dir = wp_upload_dir();

                $assets = array();
                $output = array();
                $error = false;

                $layers = json_decode($data['code']);
                $filename = $data['file'];
                $src = $data['src'];

                if (!$filename && $data['code'] == '') {
                    $output = array('error' => 'Nothing to import');
                    echo json_encode($output);
                    die();
                }


                if ($filename && $src == 'file') {
                    $destination_path = $wp_upload_dir['path'];
                    $unzipfile = unzip_file($destination_path . '/' . $filename, $destination_path . '/import/');


                    if ($unzipfile) {
                        if (file_exists($destination_path . '/import/data.json')) {
                            $layers = json_decode($wp_filesystem->get_contents($destination_path . '/import/data.json'));
                        } else {
                            $output = array('error' => 'File data.json not found.');
                            echo json_encode($output);
                            die();
                        }
                    } else {
                        $output = array('error' => 'There was an error unzipping the file.');
                        echo json_encode($output);
                        die();
                    }
                }

                if (is_array($layers)) {
                    foreach ($layers as $layer) {
                        if (is_object($layer) && isset($layer->type)) {

                            if (isset($destination_path)) {
                                $path_import = $destination_path . '/import/assets/' . $layer->id . '/';

                                if ($layer->type == 'image') {

                                    $attachment = $this->add_attachment($path_import . $layer->image->filename);
                                    $layer->image = $this->update_file_data($layer->image, $attachment);
                                    $this->clear_image_array($layer->image);

                                } else if ($layer->type == 'multi') {
                                    foreach ($layer->multiimages as $im => &$image) {
                                        $attachment = $this->add_attachment($path_import . $image->filename);
                                        $image = $this->update_file_data($image, $attachment);
                                        $this->clear_image_array($image);
                                    }
                                } else if ($layer->type == 'audio') {
                                    $attachment = $this->add_attachment($path_import . $layer->audio->filename);
                                    $layer->audio = $this->update_file_data($layer->audio, $attachment);
                                }
                            }


                            ///////////////////////////////////////////////
                            if (count($layer->nodes > 0)) {
                                foreach ($layer->nodes as $i => &$nodes_layer) {
                                    if (isset($destination_path)) {
                                        $path_import = $destination_path . '/import/assets/' . $nodes_layer->id . '/';

                                        if ($nodes_layer->type == 'image') {
                                            $attachment = $this->add_attachment($path_import . $nodes_layer->image->filename);
                                            $nodes_layer->image = $this->update_file_data($nodes_layer->image, $attachment);
                                            $this->clear_image_array($nodes_layer->image);

                                        } else if ($nodes_layer->type == 'multi') {
                                            foreach ($nodes_layer->multiimages as $im => &$image) {
                                                $attachment = $this->add_attachment($path_import . $image->filename);
                                                $image = $this->update_file_data($image, $attachment);
                                                $this->clear_image_array($image);
                                            }
                                        } else if ($nodes_layer->type == 'audio') {
                                            $attachment = $this->add_attachment($path_import . $nodes_layer->audio->filename);
                                            $nodes_layer->audio = $this->update_file_data($nodes_layer->audio, $attachment);
                                        }
                                    }

                                    if ($nodes_layer->type != 'vc') {
                                        $nodes_layer->id = uniqid();
                                    }

                                    //                                /////////////////////////////////////////////////
                                    if (count($nodes_layer->nodes > 0)) {
                                        foreach ($nodes_layer->nodes as $i2 => &$nodes2_layer) {
                                            if (isset($destination_path)) {
                                                $path_import = $destination_path . '/import/assets/' . $nodes2_layer->id . '/';

                                                if ($nodes2_layer->type == 'image') {
                                                    $attachment = $this->add_attachment($path_import . $nodes2_layer->image->filename);
                                                    $nodes2_layer->image = $this->update_file_data($nodes2_layer->image, $attachment);
                                                    $this->clear_image_array($nodes2_layer->image);

                                                } else if ($nodes2_layer->type == 'multi') {
                                                    foreach ($nodes2_layer->multiimages as $im => &$image) {
                                                        $attachment = $this->add_attachment($path_import . $image->filename);
                                                        $image = $this->update_file_data($image, $attachment);
                                                        $this->clear_image_array($image);
                                                    }
                                                } else if ($nodes2_layer->type == 'audio') {
                                                    $attachment = $this->add_attachment($path_import . $nodes2_layer->audio->filename);
                                                    $nodes2_layer->audio = $this->update_file_data($nodes2_layer->audio, $attachment);
                                                }
                                            }
                                            if ($nodes2_layer->type != 'vc') {
                                                $nodes2_layer->id = uniqid();
                                            }
                                        }
                                    }
                                }
                            }
                            //////////////////////////////////////
                            if ($layer->type != 'vc') {
                                $layer->id = uniqid();
                            }
                            $output[] = $layer;

                        }
                    }
                } else {
                    $output = array('error' => 'Nothing to import');
                }

                print_r(json_encode($output));
                break;
            case 'upload':

                break;
        }

        die();
    }

    function update_file_data($file, $data)
    {

        $file->id = $data['id'];
        $file->url = $data['url'];
        $file->link = $data['link'];

        return $file;
    }

    function check_attachment($filename)
    {
        global $wpdb;

        $file = basename($filename);
        $sql = $wpdb->prepare("SELECT `ID`,`guid` FROM {$wpdb->posts} WHERE `post_type` = 'attachment' AND `guid` LIKE '%s' LIMIT 1", '%/' . $wpdb->esc_like($file));
        $post = $wpdb->get_row($sql);

        return $post;
    }

    function add_attachment($filename)
    {

        if ($post = $this->check_attachment($filename)) {

            $attach_id = $post->ID;

        } else {

            $filetype = wp_check_filetype(basename($filename), null);
            $wp_upload_dir = wp_upload_dir();
            $attachment = array(
                'guid' => $filename,
                'post_mime_type' => $filetype['type'],
                'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
                'post_content' => '',
                'post_status' => 'publish'
            );

            $attach_id = wp_insert_attachment($attachment, $filename);
            $attach_data = wp_generate_attachment_metadata($attach_id, $filename);
            wp_update_attachment_metadata($attach_id, $attach_data);
        }


        $file = array(
            'id' => $attach_id,
            'url' => wp_get_attachment_url($attach_id),
            'link' => get_attachment_link($attach_id)
        );

        return $file;
    }
    
    function set_direction() {
        global $wp_locale, $wp_styles;

        $_user_id = get_current_user_id();

        $wp_locale->text_direction = 'ltr';
        if ( ! is_a( $wp_styles, 'WP_Styles' ) ) {
            $wp_styles = new WP_Styles();
        }
        $wp_styles->text_direction = 'ltr';
    }

}