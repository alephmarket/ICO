<?php

function ideothemo_portfolio_callback($post)
{

    wp_enqueue_script('ideothemo-page-options');
    
    wp_localize_script('ideothemo-page-options', 'dependArray', json_encode(
        array(
            "_ideo_portfolio[portfolio_parametrs]" => array(
                "1" => array(
                    "_ideo_portfolio[portfolio_parameters_arr][labels][]",
                ),
                "" => array(
                    "",
                ),
                "0" => array(
                    "",
                ),
            ),
            "_ideo_portfolio[generals][background][content_background_type]" => array(
                "" => array(
                    "",
                ),
                "color" => array(
                    "_ideo_portfolio[generals][background][content_background_color]",
                    array(
                        "_ideo_portfolio[generals][background][content_background_color_overlay]" => array(
                            "none" => array(
                                "",
                            ),
                            "color" => array(
                                "_ideo_portfolio[generals][background][content_background_color_overlay_color]",
                            ),
                            "pattern" => array(
                                "_ideo_portfolio[generals][background][content_background_color_pattern]",
                                "_ideo_portfolio[generals][background][content_background_color_pattern_color]",
                            ),
                        ),
                    ),
                ),
                "image" => array(
                    "_ideo_portfolio[generals][background][content_background_upload_image]",
                    "_ideo_portfolio[generals][background][content_background_cover]",
                    "_ideo_portfolio[generals][background][content_background_image_position]",
                    "_ideo_portfolio[generals][background][content_background_image_repeat]",
                    "_ideo_portfolio[generals][background][content_background_image_motion]",
                    array(
                        "_ideo_portfolio[generals][background][content_background_image_overlay]" => array(
                            "none" => array(
                                "",
                            ),
                            "color" => array(
                                "_ideo_portfolio[generals][background][content_background_image_overlay_color]",
                            ),
                            "pattern" => array(
                                "_ideo_portfolio[generals][background][content_background_image_overlay_pattern]",
                                "_ideo_portfolio[generals][background][content_background_image_overlay_pattern_color]",
                            ),
                        ),
                    ),
                ),
                "video" => array(
                    array(
                        "_ideo_portfolio[generals][background][content_background_video_platform]" => array(
                            "youtube" => array(
                                "_ideo_portfolio[generals][background][content_background_youtube]",
                            ),
                            "self_hosted" => array(
                                "_ideo_portfolio[generals][background][content_background_mp4]",
                                "_ideo_portfolio[generals][background][content_background_webm]",
                            ),
                        ),
                    ),
                    "_ideo_portfolio[generals][background][content_background_fallback_image]",
                    array(
                        "_ideo_portfolio[generals][background][content_background_video_overlay]" => array(
                            "none" => array(
                                "",
                            ),
                            "color" => array(
                                "_ideo_portfolio[generals][background][content_background_video_overlay_color]",
                            ),
                            "pattern" => array(
                                "_ideo_portfolio[generals][background][content_background_video_overlay_pattern]",
                                "_ideo_portfolio[generals][background][content_background_video_overlay_pattern_color]",
                            ),
                        ),
                    ),
                ),
            ),
            "_ideo_portfolio[generals][background][boxed_background_type]" => array(
                "" => array(
                    "",
                ),
                "color" => array(
                    "_ideo_portfolio[generals][background][boxed_background_color]",
                    array(
                        "_ideo_portfolio[generals][background][boxed_background_color_overlay]" => array(
                            "none" => array(
                                "",
                            ),
                            "color" => array(
                                "_ideo_portfolio[generals][background][boxed_background_color_overlay_color]",
                            ),
                            "pattern" => array(
                                "_ideo_portfolio[generals][background][boxed_background_color_pattern]",
                                "_ideo_portfolio[generals][background][boxed_background_color_pattern_color]",
                            ),
                        ),
                    ),
                ),
                "image" => array(
                    "_ideo_portfolio[generals][background][boxed_background_upload_image]",
                    "_ideo_portfolio[generals][background][boxed_background_cover]",
                    "_ideo_portfolio[generals][background][boxed_background_image_position]",
                    "_ideo_portfolio[generals][background][boxed_background_image_repeat]",
                    "_ideo_portfolio[generals][background][boxed_background_image_motion]",
                    array(
                        "_ideo_portfolio[generals][background][boxed_background_image_overlay]" => array(
                            "none" => array(
                                "",
                            ),
                            "color" => array(
                                "_ideo_portfolio[generals][background][boxed_background_image_overlay_color]",
                            ),
                            "pattern" => array(
                                "_ideo_portfolio[generals][background][boxed_background_image_overlay_pattern]",
                                "_ideo_portfolio[generals][background][boxed_background_image_overlay_pattern_color]",
                            ),
                        ),
                    ),
                ),
                "video" => array(
                    array(
                        "_ideo_portfolio[generals][background][boxed_background_video_platform]" => array(
                            "youtube" => array(
                                "_ideo_portfolio[generals][background][boxed_background_youtube]",
                            ),
                            "self_hosted" => array(
                                "_ideo_portfolio[generals][background][boxed_background_mp4]",
                                "_ideo_portfolio[generals][background][boxed_background_webm]",
                            ),
                        ),
                    ),
                    "_ideo_portfolio[generals][background][boxed_background_video_sound]",
                    "_ideo_portfolio[generals][background][boxed_background_fallback_image]",
                    array(
                        "_ideo_portfolio[generals][background][boxed_background_video_overlay]" => array(
                            "none" => array(
                                "",
                            ),
                            "color" => array(
                                "_ideo_portfolio[generals][background][boxed_background_video_overlay_color]",
                            ),
                            "pattern" => array(
                                "_ideo_portfolio[generals][background][boxed_background_video_overlay_pattern]",
                                "_ideo_portfolio[generals][background][boxed_background_video_overlay_pattern_color]",
                            ),
                        ),
                    ),
                ),
            ),
            "_ideo_portfolio[pagetitle][page_title_background][page_title_area_background]" => array(
                "" => array(
                    "",
                ),
                "color" => array(
                    "_ideo_portfolio[pagetitle][page_title_background][pt_background_color]",
                    array(
                        "_ideo_portfolio[pagetitle][page_title_background][pt_background_color_overlay]" => array(
                            "none" => array(
                                "",
                            ),
                            "color" => array(
                                "_ideo_portfolio[pagetitle][page_title_background][pt_background_color_overlay_color]",
                            ),
                            "pattern" => array(
                                "_ideo_portfolio[pagetitle][page_title_background][pt_background_color_pattern]",
                                "_ideo_portfolio[pagetitle][page_title_background][pt_background_color_pattern_color]",
                            ),
                        ),
                    ),
                ),
                "image" => array(
                    "_ideo_portfolio[pagetitle][page_title_background][pt_background_upload_image]",
                    "_ideo_portfolio[pagetitle][page_title_background][pt_background_cover]",
                    "_ideo_portfolio[pagetitle][page_title_background][pt_background_image_position]",
                    "_ideo_portfolio[pagetitle][page_title_background][pt_background_image_repeat]",
                    array(
                        "_ideo_portfolio[pagetitle][page_title_background][pt_background_motion]" => array(
                            "scroll" => array(
                                "",
                            ),
                            "fixed" => array(
                                "",
                            ),
                            "parallax" => array(
                                "_ideo_portfolio[pagetitle][page_title_background][pt_background_moving_speed]",
                            ),
                        ),
                    ),
                    array(
                        "_ideo_portfolio[pagetitle][page_title_background][pt_background_image_overlay]" => array(
                            "none" => array(
                                "",
                            ),
                            "color" => array(
                                "_ideo_portfolio[pagetitle][page_title_background][pt_background_image_overlay_color]",
                            ),
                            "pattern" => array(
                                "_ideo_portfolio[pagetitle][page_title_background][pt_background_image_overlay_pattern]",
                                "_ideo_portfolio[pagetitle][page_title_background][pt_background_image_overlay_pattern_color]",
                            ),
                        ),
                    ),
                ),
                "video" => array(
                    array(
                        "_ideo_portfolio[pagetitle][page_title_background][pt_background_video_platform]" => array(
                            "youtube" => array(
                                "_ideo_portfolio[pagetitle][page_title_background][pt_background_youtube]",
                            ),
                            "self_hosted" => array(
                                "_ideo_portfolio[pagetitle][page_title_background][pt_background_mp4]",
                                "_ideo_portfolio[pagetitle][page_title_background][pt_background_webm]",
                            ),
                        ),
                    ),
                    "_ideo_portfolio[pagetitle][page_title_background][pt_background_video_sound]",
                    "_ideo_portfolio[pagetitle][page_title_background][pt_background_fallback_image]",
                    array(
                        "_ideo_portfolio[pagetitle][page_title_background][pt_background_video_overlay]" => array(
                            "none" => array(
                                "",
                            ),
                            "color" => array(
                                "_ideo_portfolio[pagetitle][page_title_background][pt_background_video_overlay_color]",
                            ),
                            "pattern" => array(
                                "_ideo_portfolio[pagetitle][page_title_background][pt_background_video_overlay_pattern]",
                                "_ideo_portfolio[pagetitle][page_title_background][pt_background_video_overlay_pattern_color]",
                            ),
                        ),
                    ),
                ),
            ),
            "_ideo_portfolio[footer][footer_settings][footer_type]" => array(
                "" => array(
                    "",
                ),
                "standard" => array(
                    "",
                ),
                "advanced" => array(
                    "_ideo_portfolio[footer][footer_settings][choose_advanced_footer]",
                ),
            ),
            "_ideo_portfolio[footer][standard_footer_background][footer_background_type]" => array(
                "" => array(
                    "",
                ),
                "color" => array(
                    "_ideo_portfolio[footer][standard_footer_background][footer_background_color]",
                    array(
                        "_ideo_portfolio[footer][standard_footer_background][footer_background_color_overlay]" => array(
                            "none" => array(
                                "",
                            ),
                            "color" => array(
                                "_ideo_portfolio[footer][standard_footer_background][footer_background_color_overlay_color]",
                            ),
                            "pattern" => array(
                                "_ideo_portfolio[footer][standard_footer_background][footer_background_color_pattern]",
                                "_ideo_portfolio[footer][standard_footer_background][footer_background_color_pattern_color]",
                            ),
                        ),
                    ),
                ),
                "image" => array(
                    "_ideo_portfolio[footer][standard_footer_background][footer_background_upload_image]",
                    "_ideo_portfolio[footer][standard_footer_background][footer_background_cover]",
                    "_ideo_portfolio[footer][standard_footer_background][footer_background_image_position]",
                    "_ideo_portfolio[footer][standard_footer_background][footer_background_image_repeat]",
                    "_ideo_portfolio[footer][standard_footer_background][footer_background_image_overlay]",
                    array(
                        "_ideo_portfolio[footer][standard_footer_background][footer_background_image_overlay]" => array(
                            "none" => array(
                                "",
                            ),
                            "color" => array(
                                "_ideo_portfolio[footer][standard_footer_background][footer_background_image_overlay_color]",
                            ),
                            "pattern" => array(
                                "_ideo_portfolio[footer][standard_footer_background][footer_background_image_overlay_pattern]",
                                "_ideo_portfolio[footer][standard_footer_background][footer_background_image_overlay_pattern_color]",
                            ),
                        ),
                    ),
                ),
            ),
            "_ideo_portfolio[sidebar][sidebar_settings][sidebar_global]" => array(
                "" => array(
                    "",
                ),
                "none" => array(
                    "",
                ),
                "left_sidebar" => array(
                    "_ideo_portfolio[sidebar][sidebar_settings][sidebar_choose]",
                ),
                "right_sidebar" => array(
                    "_ideo_portfolio[sidebar][sidebar_settings][sidebar_choose]",
                ),
            ),
            "_ideo_portfolio[slider][plugin]" => array(
                "" => array(
                    "",
                ),
                "none" => array(
                    "",
                ),
                "ls" => array(
                    "_ideo_portfolio[slider][ls]",
                ),
                "rs" => array(
                    "_ideo_portfolio[slider][rs]",
                ),
            ),
        )
    ));
    
    wp_nonce_field('ideo_meta_box', 'ideo_meta_box_nonce');

    $_portfolio = get_post_meta($post->ID, '_ideo_portfolio', true);

    ?>
   
    <div class="ideo-page-options">
        <div class="ideo-tabs-bar">
            <ul class="tabs">
                <li><a href="#tab-portfolio-info" class="active"><i
                            class="id id-Portfolio_info"></i> <?php esc_html_e('Portfolio Info', 'themo'); ?></a></li>
                <li><a href="#tab-portfolio-modern_titlearea"> <i
                            class="id id-Ajax_card "></i> <?php esc_html_e('Ajax Card', 'themo'); ?></a></li>
                <li><a href="#tab-layout"><i class="id id-laybackground"
                                             title="Layout & background"></i> <?php esc_html_e('Lay & Background', 'themo'); ?>
                    </a></li>
                <li><a href="#tab-header"><i class="id id-Header" title="Header"></i> <?php esc_html_e('Header', 'themo'); ?>
                    </a></li>
                <li><a href="#tab-portfolio-standard_titlearea"> <i class="id id-Page_title"
                                                                    title="Page title"></i> <?php esc_html_e('Page title', 'themo'); ?>
                    </a></li>
                <li><a href="#tab-slider"><i class="id id-Slider" title="Slider"></i> <?php esc_html_e('Slider', 'themo'); ?>
                    </a></li>
                <li><a href="#tab-footer"><i class="id id-Footer" title="Footer"></i> <?php esc_html_e('Footer', 'themo'); ?>
                    </a></li>
                <li><a href="#tab-sidebar"><i class="id id-Sidebar"
                                              title="Sidebar"></i> <?php esc_html_e('Sidebar', 'themo'); ?></a></li>
                <li><a href="#tab-scripts-styles"><i class="id id-Footer"></i> <?php esc_html_e('Scripts & Styles', 'themo'); ?>
                    </a></li>
            </ul>
        </div>
        <div class="ideo-tabs-content">
            <div id="tab-portfolio-info" class="tab-content active">
                <div class="ideo-accordions">
                    <div class="ideo-section">
                        <div class="ideo-info">
                            <h5><?php esc_html_e('Info:', 'themo'); ?></h5>
                            <p><?php echo wp_kses(__('In Portfolio options you can customize portfolio single post appearance and settings. THEMO gives you dozens of options so you can create unique design for every single portfolio post. </br><b>Notice, that in Portfolio post options you can customize two different styles of portfolio card: PORTFOLIO STANDARD and PORTFOLIO MODERN. In portfolio post options you can customize both cards to use them on different pages (when adding portfolio shortcode to any you can decide which portfolio card will be displayed).</b>', 'themo'),  IDEOTHEMO_KSES_TAGS::allow()); ?></p>
                        </div>
                        <?php
                        if (!isset($_portfolio['portfolio_title'])) {
                            $_portfolio['portfolio_title'] = '';
                        }
                        ideothemo_controls_html(array(
                            'type' => 'textfield',
                            'name' => '_ideo_portfolio[portfolio_title]',
                            'id' => 'portfolio_title',
                            'class' => '',
                            'label' => esc_html__('PORTFOLIO TITLE ', 'themo'),
                            'value' => wp_kses($_portfolio['portfolio_title'],  IDEOTHEMO_KSES_TAGS::allow()),
                            'placeholder' => esc_html__('Enter portfolio title here', 'themo'),
                            'description' => esc_html__('You can enter portfolio title which will be displayed in page title area instead of main post title entered in WordPress title field above.', 'themo')
                        ));

                        if (!isset($_portfolio['portfolio_subtitle'])) {
                            $_portfolio['portfolio_subtitle'] = '';
                        }
                        ideothemo_controls_html(array(
                            'type' => 'textfield',
                            'name' => '_ideo_portfolio[portfolio_subtitle]',
                            'id' => 'portfolio_subtitle',
                            'class' => '',
                            'label' => esc_html__('PORTFOLIO SUBTITLE ', 'themo'),
                            'value' => wp_kses($_portfolio['portfolio_subtitle'],  IDEOTHEMO_KSES_TAGS::allow()),
                            'placeholder' => esc_html__('Enter portfolio subtitle here', 'themo'),
                            'description' => esc_html__('Enter portfolio subtitle text.', 'themo')
                        ));
                        ?>
                    </div>
                </div>

                <div class="ideo-accordions">
                    <div class="ideo-accordions-section">
                        <h4 class="ideo-accordions-title"><?php esc_html_e('PORTFOLIO PARAMETRS', 'themo'); ?></h4>
                        <div class="ideo-accordions-content">
                            <div class="ideo-section">
                                <div class="ideo-info">
                                    <h5><?php esc_html_e('Info:', 'themo'); ?></h5>
                                    <p><?php echo wp_kses(__('In this section you can enable or disable parameters displaying. Parameters will be displayed in portfolio title area. When you turn this option ON you will be able to add and customize parameters below.', 'themo'),  IDEOTHEMO_KSES_TAGS::allow()); ?></p>
                                </div>
                                <?php
                                if (!isset($_portfolio['portfolio_parametrs'])) {
                                    $_portfolio['portfolio_parametrs'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'switcher',
                                    'name' => '_ideo_portfolio[portfolio_parametrs]',
                                    'id' => 'portfolio_portfolio_parametrs',
                                    'label' => esc_html__('PORTFOLIO PARAMETERS', 'themo'),
                                    'class' => 'switcher',
                                    'value' => $_portfolio['portfolio_parametrs'],
                                    'options' => array(
                                        array(1, esc_html__('On', 'themo')),
                                        array(0, esc_html__('Off', 'themo')),
                                    ),
                                    'description' => ''
                                ));

                                ?>

                                <div class="ideo-section">
                                    <div class="ideo-row">
                                        <div class="ideo-label">
                                            <h5><?php esc_html_e('PARAMETERS', 'themo'); ?></h5>
                                            <p><?php esc_html_e('Add custom parameters to portfolio item - enter parameter label, parameter value and optionally parameter URL.', 'themo'); ?></p>
                                        </div>
                                        <?php

                                        if (!isset($_portfolio['portfolio_parameters_arr'])) {
                                            $_portfolio['portfolio_parameters_arr'] = array();
                                        }

                                        ?>
                                        <div class="ideo-control ideo-repeat-control">
                                            <ul class="js--portfolio-parameters-cont">
                                                <?php if (count($_portfolio['portfolio_parameters_arr']) > 0): ?>
                                                    <?php for ($i = 0; $i < count($_portfolio['portfolio_parameters_arr']['labels']); $i++): ?>
                                                        <li class="ideo-textfield inline">
                                                            <input type="text" placeholder="Parameter label"
                                                                   name="_ideo_portfolio[portfolio_parameters_arr][labels][]"
                                                                   value="<?php echo wp_kses($_portfolio['portfolio_parameters_arr']['labels'][$i],  IDEOTHEMO_KSES_TAGS::allow()); ?>">
                                                            <input type="text" placeholder="Parameter value"
                                                                   name="_ideo_portfolio[portfolio_parameters_arr][values][]"
                                                                   value="<?php echo wp_kses($_portfolio['portfolio_parameters_arr']['values'][$i],  IDEOTHEMO_KSES_TAGS::allow()); ?>">
                                                            <input type="text" placeholder="URL"
                                                                   name="_ideo_portfolio[portfolio_parameters_arr][urls][]"
                                                                   value="<?php echo wp_kses($_portfolio['portfolio_parameters_arr']['urls'][$i],  IDEOTHEMO_KSES_TAGS::allow()); ?>">
                                                            <button type="button"
                                                                    class="js--portfolio-remove-item ideo-button-remove">
                                                                <i class="fa fa-trash-o fa-fw"></i></button>
                                                        </li>

                                                    <?php endfor; ?>
                                                <?php else: ?>
                                                    <li class="ideo-textfield inline">
                                                        <input type="text" placeholder="Parameter label"
                                                               name="_ideo_portfolio[portfolio_parameters_arr][labels][]"
                                                               value="">
                                                        <input type="text" placeholder="Parameter value"
                                                               name="_ideo_portfolio[portfolio_parameters_arr][values][]"
                                                               value="">
                                                        <input type="text" placeholder="URL"
                                                               name="_ideo_portfolio[portfolio_parameters_arr][urls][]"
                                                               value="">
                                                        <button type="button"
                                                                class="js--portfolio-remove-item ideo-button-remove"><i
                                                                class="fa fa-trash-o fa-fw"></i></button>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                            <button type="button" class="js--portfolio-add-item ideo-button-add"><i
                                                    class="fa fa-plus-square"></i><?php esc_html_e('ADD PARAMETER', 'themo'); ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

            </div>


            <div id="tab-portfolio-modern_titlearea" class="tab-content">
                <div class="ideo-accordions">
                    <div class="ideo-section">
                        <div class="ideo-info">
                            <h5><?php esc_html_e('Info:', 'themo'); ?></h5>
                            <p><?php echo wp_kses(__('In this section you can customize page title area for Portfolio modern card. </br> <b>All options available in this section affects MODERN CARD only.</b>', 'themo'),  IDEOTHEMO_KSES_TAGS::allow()); ?></p>
                        </div>
                        <?php
                        if (!isset($_portfolio['portfolio_modern_pt_background_color'])) {
                            $_portfolio['portfolio_modern_pt_background_color'] = '';
                        }
                        ideothemo_controls_html(array(
                            'type' => 'colorpicker',
                            'name' => '_ideo_portfolio[portfolio_modern_pt_background_color]',
                            'id' => 'portfolio_modern_pt_background_color',
                            'class' => 'colorpicker',
                            'label' => esc_html__('TITLE AREA BACKGROUND COLOR ', 'themo'),
                            'value' => $_portfolio['portfolio_modern_pt_background_color'],
                            'description' => esc_html__('Pick title area background color.', 'themo')
                        ));

                        if (!isset($_portfolio['portfolio_page_title_area_content_align'])) {
                            $_portfolio['portfolio_page_title_area_content_align'] = 'left';
                        }
                        ideothemo_controls_html(array(
                            'type' => 'selectmenu',
                            'name' => '_ideo_portfolio[portfolio_page_title_area_content_align]',
                            'id' => 'portfolio_page_title_area_content_align',
                            'label' => esc_html__('TITLE AREA CONTENT ALIGN', 'themo'),
                            'value' => $_portfolio['portfolio_page_title_area_content_align'],
                            'options' => array(
                                array('left', esc_html__('Left', 'themo')),
                                array('center', esc_html__('Center', 'themo')),
                                array('right', esc_html__('Right', 'themo')),
                            ),
                            'description' => esc_html__('Justify title area content to the Left, Center or Right side.', 'themo')
                        ));

                        if (!isset($_portfolio['portfolio_modern_title_font_size'])) {
                            $_portfolio['portfolio_modern_title_font_size'] = '';
                        }
                        ideothemo_controls_html(array(
                            'type' => 'textfield',
                            'name' => '_ideo_portfolio[portfolio_modern_title_font_size]',
                            'id' => 'portfolio_modern_title_font_size',
                            'class' => '',
                            'label' => esc_html__('TITLE FONT SIZE (px)', 'themo'),
                            'value' => $_portfolio['portfolio_modern_title_font_size'],
                            'placeholder' => esc_html__('Enter portfolio title font size', 'themo'),
                        ));

                        if (!isset($_portfolio['portfolio_modern_title_font_color'])) {
                            $_portfolio['portfolio_modern_title_font_color'] = '';
                        }
                        ideothemo_controls_html(array(
                            'type' => 'colorpicker',
                            'name' => '_ideo_portfolio[portfolio_modern_title_font_color]',
                            'id' => 'portfolio_modern_title_font_color',
                            'class' => 'colorpicker',
                            'label' => esc_html__('TITLE FONT COLOR', 'themo'),
                            'value' => $_portfolio['portfolio_modern_title_font_color'],
                            'placeholder' => esc_html__('Enter portfolio title font color', 'themo'),
                        ));

                        if (!isset($_portfolio['portfolio_modern_subtitle_font_size'])) {
                            $_portfolio['portfolio_modern_subtitle_font_size'] = '';
                        }
                        ideothemo_controls_html(array(
                            'type' => 'textfield',
                            'name' => '_ideo_portfolio[portfolio_modern_subtitle_font_size]',
                            'id' => 'portfolio_modern_subtitle_font_size',
                            'class' => '',
                            'label' => esc_html__('SUBTITLE FONT SIZE (px)', 'themo'),
                            'value' => $_portfolio['portfolio_modern_subtitle_font_size'],
                            'placeholder' => esc_html__('Enter portfolio subtitle font size', 'themo'),
                        ));

                        if (!isset($_portfolio['portfolio_modern_subtitle_font_color'])) {
                            $_portfolio['portfolio_modern_subtitle_font_color'] = '';
                        }
                        ideothemo_controls_html(array(
                            'type' => 'colorpicker',
                            'name' => '_ideo_portfolio[portfolio_modern_subtitle_font_color]',
                            'id' => 'portfolio_modern_subtitle_font_color',
                            'class' => 'colorpicker',
                            'label' => esc_html__('SUBTITLE FONT COLOR', 'themo'),
                            'value' => $_portfolio['portfolio_modern_subtitle_font_color'],
                            'placeholder' => esc_html__('Enter portfolio subtitle font color', 'themo'),
                        ));

                        if (!isset($_portfolio['portfolio_modern_parameters_display'])) {
                            $_portfolio['portfolio_modern_parameters_display'] = 'inline';
                        }

                        ideothemo_controls_html(array(
                            'type' => 'selectmenu',
                            'name' => '_ideo_portfolio[portfolio_modern_parameters_display]',
                            'id' => 'portfolio_modern_parameters_display',
                            'class' => '',
                            'label' => esc_html__('PARAMETERS DISPLAY', 'themo'),
                            'value' => $_portfolio['portfolio_modern_parameters_display'],
                            'options' => array(
                                array('inline-block', esc_html__('Inline', 'themo')),
                                array('block', esc_html__('Block', 'themo')),
                            ),
                        ));

                        if (!isset($_portfolio['portfolio_modern_parametrs_font_size'])) {
                            $_portfolio['portfolio_modern_parametrs_font_size'] = '';
                        }
                        ideothemo_controls_html(array(
                            'type' => 'textfield',
                            'name' => '_ideo_portfolio[portfolio_modern_parametrs_font_size]',
                            'id' => 'portfolio_modern_parametrs_font_size',
                            'class' => '',
                            'label' => esc_html__('PARAMETER LABEL & VALUE FONT SIZE (px)', 'themo'),
                            'value' => $_portfolio['portfolio_modern_parametrs_font_size'],
                            'placeholder' => esc_html__('Enter portfolio parameters font size', 'themo'),
                        ));

                        if (!isset($_portfolio['modern_parametrs_label_color'])) {
                            $_portfolio['modern_parametrs_label_color'] = '';
                        }
                        ideothemo_controls_html(array(
                            'type' => 'colorpicker',
                            'name' => '_ideo_portfolio[modern_parametrs_label_color]',
                            'id' => 'portfolio_modern_parametrs_label_color',
                            'class' => 'colorpicker',
                            'label' => esc_html__('PARAMETER LABEL COLOR', 'themo'),
                            'value' => $_portfolio['modern_parametrs_label_color'],

                        ));

                        if (!isset($_portfolio['modern_parametrs_value_color'])) {
                            $_portfolio['modern_parametrs_value_color'] = '';
                        }
                        ideothemo_controls_html(array(
                            'type' => 'colorpicker',
                            'name' => '_ideo_portfolio[modern_parametrs_value_color]',
                            'id' => 'portfolio_modern_parametrs_value_color',
                            'class' => 'colorpicker',
                            'label' => esc_html__('PARAMETER VALUE COLOR', 'themo'),
                            'value' => $_portfolio['modern_parametrs_value_color'],
                        ));

                        if (!isset($_portfolio['modern_share_color'])) {
                            $_portfolio['modern_share_color'] = '';
                        }
                        ideothemo_controls_html(array(
                            'type' => 'colorpicker',
                            'name' => '_ideo_portfolio[modern_share_color]',
                            'id' => 'portfolio_modern_share_color',
                            'class' => 'colorpicker',
                            'label' => esc_html__('SHARE COLOR', 'themo'),
                            'value' => $_portfolio['modern_share_color'],
                        ));

                        if (!isset($_portfolio['modern_nav_arrows_color'])) {
                            $_portfolio['modern_nav_arrows_color'] = '';
                        }
                        ideothemo_controls_html(array(
                            'type' => 'colorpicker',
                            'name' => '_ideo_portfolio[modern_nav_arrows_color]',
                            'id' => 'portfolio_modern_nav_arrows_color',
                            'class' => 'colorpicker',
                            'label' => esc_html__('NAVIGATION ARROWS COLOR', 'themo'),
                            'value' => $_portfolio['modern_nav_arrows_color'],
                        ));
                        ?>
                    </div>
                </div>
            </div>
            <div id="tab-layout" class="tab-content">
                <div class="ideo-accordions">
                    <div class="ideo-accordions-section active">
                        <h4 class="ideo-accordions-title"><?php esc_html_e('LAYOUT', 'themo'); ?></h4>
                        <div class="ideo-accordions-content">
                            <div class="ideo-section">
                                <div class="ideo-info">
                                    <h5><?php esc_html_e('Info:', 'themo'); ?></h5>
                                    <p><?php echo wp_kses(__('In this section you can customize Layout and background for this particular single portfolio page. Default Layout and background settings are taken from Customizer settings (from GENERALS section). You can override those global settings for this particular portfolio page using options below or use Customizer global settings by choosing Default setting in dropdowns or leave empty fields.', 'themo'),  IDEOTHEMO_KSES_TAGS::allow()); ?></p>
                                </div>
                                <?php
                                if (!isset($_portfolio['generals']['layout']['boxed_version'])) {
                                    $_portfolio['generals']['layout']['boxed_version'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'selectmenu',
                                    'name' => '_ideo_portfolio[generals][layout][boxed_version]',
                                    'id' => 'portfolio_boxed_version',
                                    'label' => esc_html__('BOXED VERSION', 'themo'),
                                    'value' => $_portfolio['generals']['layout']['boxed_version'],
                                    'options' => array(
                                        array('', esc_html__('Default', 'themo')),
                                        array('yes', esc_html__('Yes', 'themo')),
                                        array('no', esc_html__('No', 'themo')),
                                    ),
                                    'description' => esc_html__('Choose page layout: pick YES to use Boxed version; pick NO to use Wide layout; pick DEFAULT to use Customizer setting.', 'themo')
                                ));

                                if (!isset($_portfolio['fonts']['font_coloring']['body_text_skin'])) {
                                    $_portfolio['fonts']['font_coloring']['body_text_skin'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'selectmenu',
                                    'name' => '_ideo_portfolio[fonts][font_coloring][body_text_skin]',
                                    'id' => 'portfolio_body_text_skin',
                                    'label' => esc_html__('BODY FONT COLOR', 'themo'),
                                    'value' => $_portfolio['fonts']['font_coloring']['body_text_skin'],
                                    'options' => array(
                                        array('', esc_html__('Default', 'themo')),
                                        array('light', esc_html__('Light', 'themo')),
                                        array('dark', esc_html__('Dark', 'themo')),
                                    ),
                                    'description' => esc_html__('Choose between LIGHT and DARK font skin or choose DEFAULT to use Customizer setting. Body font color is in use only if you build your content without Visual Composer (it does not affect Visual Composer shortcodes fonts). Fonts color for Visual Composer are set in Shortcodes section, where you can customize font colors for each of shortcode styles.', 'themo')
                                ));

                                if (!isset($_portfolio['generals']['layout']['content_start_position'])) {
                                    $_portfolio['generals']['layout']['content_start_position'] = '';
                                }

                                if (!isset($_portfolio['generals']['layout']['content_padding_top'])) {
                                    $_portfolio['generals']['layout']['content_padding_top'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'textfield',
                                    'name' => '_ideo_portfolio[generals][layout][content_padding_top]',
                                    'id' => 'portfolio_content_padding_top',
                                    'class' => '',
                                    'label' => esc_html__('CONTENT PADDING TOP (px)', 'themo'),
                                    'value' => $_portfolio['generals']['layout']['content_padding_top'],
                                    'description' => 'Using this option you can define space between main content and upper element (e.g. top edge of the page, Page title or Slider). By default, it does not matter which upper elements you use above the content. We ensure you that your content will be always legible and look good by default, but using Content padding top option you can change it according to your own needs and likings.',
                                ));

                                if (!isset($_portfolio['generals']['layout']['content_padding_bottom'])) {
                                    $_portfolio['generals']['layout']['content_padding_bottom'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'textfield',
                                    'name' => '_ideo_portfolio[generals][layout][content_padding_bottom]',
                                    'id' => 'portfolio_content_padding_bottom',
                                    'class' => '',
                                    'label' => esc_html__('CONTENT PADDING BOTTOM (px)', 'themo'),
                                    'value' => $_portfolio['generals']['layout']['content_padding_bottom'],
                                    'description' => '',
                                ));
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ideo-accordions">
                    <div class="ideo-accordions-section">
                        <h4 class="ideo-accordions-title"><?php esc_html_e('CONTENT BACKGROUND', 'themo'); ?></h4>
                        <div class="ideo-accordions-content">
                            <div class="ideo-section">

                                <?php

                                if (!isset($_portfolio['generals']['background']['content_background_type'])) {
                                    $_portfolio['generals']['background']['content_background_type'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'selectmenu',
                                    'name' => '_ideo_portfolio[generals][background][content_background_type]',
                                    'id' => 'portfolio_content_background_type',
                                    'label' => esc_html__('CONTENT BACKGROUND TYPE', 'themo'),
                                    'value' => $_portfolio['generals']['background']['content_background_type'],
                                    'options' => array(
                                        array('', esc_html__('Default', 'themo')),
                                        array('color', esc_html__('Color', 'themo')),
                                        array('image', esc_html__('Image', 'themo')),
                                    ),
                                    'description' => esc_html__('Choose COLOR or IMAGE background type or choose DEFAULT to use Customizer setting. Depending on which option you choose appropriate options will be available below.', 'themo')
                                ));

                                ?>

                                <div class="ideo-section">

                                    <?php
                                    if (!isset($_portfolio['generals']['background']['content_background_color'])) {
                                        $_portfolio['generals']['background']['content_background_color'] = '';
                                    }
                                    ideothemo_controls_html(array(
                                        'type' => 'colorpicker',
                                        'name' => '_ideo_portfolio[generals][background][content_background_color]',
                                        'id' => 'portfolio_content_background_color',
                                        'class' => 'colorpicker',
                                        'label' => esc_html__('BACKGROUND COLOR', 'themo'),
                                        'value' => $_portfolio['generals']['background']['content_background_color'],
                                        'description' => esc_html__('Define portfolio page background color.', 'themo')
                                    ));

                                    if (!isset($_portfolio['generals']['background']['content_background_color_overlay'])) {
                                        $_portfolio['generals']['background']['content_background_color_overlay'] = '';
                                    }
                                    ideothemo_controls_html(array(
                                        'type' => 'selectmenu',
                                        'name' => '_ideo_portfolio[generals][background][content_background_color_overlay]',
                                        'id' => 'portfolio_content_background_color_overlay',
                                        'label' => esc_html__('OVERLAY', 'themo'),
                                        'value' => $_portfolio['generals']['background']['content_background_color_overlay'],
                                        'options' => array(
                                            array('none', esc_html__('None', 'themo')),
                                            array('color', esc_html__('Color', 'themo')),
                                            array('pattern', esc_html__('Pattern', 'themo')),
                                        ),
                                        'description' => esc_html__('Choose between Color or Pattern background overlay or choose None if you do not need any background overlay. Depending on which option you choose, appropriate additional options will be available below.', 'themo')
                                    ));
                                    ?>

                                    <div class="ideo-section">

                                        <?php
                                        if (!isset($_portfolio['generals']['background']['content_background_color_overlay_color'])) {
                                            $_portfolio['generals']['background']['content_background_color_overlay_color'] = '';
                                        }
                                        ideothemo_controls_html(array(
                                            'type' => 'colorpicker',
                                            'name' => '_ideo_portfolio[generals][background][content_background_color_overlay_color]',
                                            'id' => 'portfolio_content_background_color_overlay_color',
                                            'class' => 'colorpicker',
                                            'label' => esc_html__('OVERLAY COLOR', 'themo'),
                                            'value' => $_portfolio['generals']['background']['content_background_color_overlay_color'],
                                            'description' => esc_html__('Pick background overlay color.', 'themo')
                                        ));

                                        if (!isset($_portfolio['generals']['background']['content_background_color_pattern'])) {
                                            $_portfolio['generals']['background']['content_background_color_pattern'] = '';
                                        }
                                        ideothemo_controls_html(array(
                                            'type' => 'selectmenu',
                                            'name' => '_ideo_portfolio[generals][background][content_background_color_pattern]',
                                            'id' => 'portfolio_content_background_color_pattern',
                                            'label' => esc_html__('PATTERN', 'themo'),
                                            'value' => $_portfolio['generals']['background']['content_background_color_pattern'],
                                            'options' => array_flip(ideothemo_get_background_patterns(true)),
                                            'description' => esc_html__('Choose one of predefined background patterns.', 'themo')
                                        ));

                                        if (!isset($_portfolio['generals']['background']['content_background_color_pattern_color'])) {
                                            $_portfolio['generals']['background']['content_background_color_pattern_color'] = '';
                                        }
                                        ideothemo_controls_html(array(
                                            'type' => 'colorpicker',
                                            'name' => '_ideo_portfolio[generals][background][content_background_color_pattern_color]',
                                            'id' => 'portfolio_content_background_color_pattern_color',
                                            'class' => 'colorpicker',
                                            'label' => esc_html__('PATTERN COLOR', 'themo'),
                                            'value' => $_portfolio['generals']['background']['content_background_color_pattern_color'],
                                            'description' => esc_html__('Pick pattern color.', 'themo')
                                        ));
                                        ?>

                                    </div>

                                    <?php

                                    if (!isset($_portfolio['generals']['background']['content_background_upload_image'])) {
                                        $_portfolio['generals']['background']['content_background_upload_image'] = '';
                                    }
                                    ideothemo_controls_html(array(
                                        'type' => 'attach-image',
                                        'name' => '_ideo_portfolio[generals][background][content_background_upload_image]',
                                        'id' => 'portfolio_content_background_upload_image',
                                        'label' => esc_html__('UPLOAD FILE', 'themo'),
                                        'button_label' => esc_html__('UPLOAD', 'themo'),
                                        'value' => $_portfolio['generals']['background']['content_background_upload_image'],
                                        'description' => esc_html__('Upload image which will be set as a portfolio page background. Only .jpg .png .bmp formats are allowed.', 'themo')
                                    ));

                                    if (!isset($_portfolio['generals']['background']['content_background_cover'])) {
                                        $_portfolio['generals']['background']['content_background_cover'] = 0;
                                    }
                                    ideothemo_controls_html(array(
                                        'type' => 'switcher',
                                        'name' => '_ideo_portfolio[generals][background][content_background_cover]',
                                        'id' => 'portfolio_content_background_cover',
                                        'label' => esc_html__('100% BACKGROUND ', 'themo'),
                                        'class' => 'switcher',
                                        'value' => $_portfolio['generals']['background']['content_background_cover'],
                                        'options' => array(
                                            array(1, esc_html__('On', 'themo')),
                                            array(0, esc_html__('Off', 'themo')),
                                        ),
                                        'description' => esc_html__('Turn On this option to set -cover- property for background image size (it will be scale to be as large as possible so that the background area is completely covered by the background image). By default this option is turned Off, so background image size has set -auto- property (original width and height).', 'themo')
                                    ));

                                    if (!isset($_portfolio['generals']['background']['content_background_image_position'])) {
                                        $_portfolio['generals']['background']['content_background_image_position'] = '';
                                    }
                                    ideothemo_controls_html(array(
                                        'type' => 'selectmenu',
                                        'name' => '_ideo_portfolio[generals][background][content_background_image_position]',
                                        'id' => 'portfolio_content_background_image_position',
                                        'label' => esc_html__('IMAGE POSITION', 'themo'),
                                        'value' => $_portfolio['generals']['background']['content_background_image_position'],
                                        'options' => array(
                                            array('left_top', esc_html__('Left top', 'themo')),
                                            array('center_top', esc_html__('Center top', 'themo')),
                                            array('right_top', esc_html__('Right top', 'themo')),
                                            array('left_center', esc_html__('Left center', 'themo')),
                                            array('center_center', esc_html__('Center center', 'themo')),
                                            array('right_center', esc_html__('Right center', 'themo')),
                                            array('left_bottom', esc_html__('Left bottom', 'themo')),
                                            array('center_bottom', esc_html__('Center bottom', 'themo')),
                                            array('right_bottom', esc_html__('Right bottom', 'themo')),
                                        ),
                                        'description' => esc_html__('Choose image position property to set the starting position of background image.', 'themo')
                                    ));

                                    if (!isset($_portfolio['generals']['background']['content_background_image_repeat'])) {
                                        $_portfolio['generals']['background']['content_background_image_repeat'] = '';
                                    }
                                    ideothemo_controls_html(array(
                                        'type' => 'selectmenu',
                                        'name' => '_ideo_portfolio[generals][background][content_background_image_repeat]',
                                        'id' => 'portfolio_content_background_image_repeat',
                                        'label' => esc_html__('IMAGE REPEAT', 'themo'),
                                        'value' => $_portfolio['generals']['background']['content_background_image_repeat'],
                                        'options' => array(
                                            array('no_repeat', esc_html__('No repeat', 'themo')),
                                            array('repeat_x', esc_html__('Repeat X', 'themo')),
                                            array('repeat_y', esc_html__('Repeat Y', 'themo')),
                                            array('repeat', esc_html__('Repeat XY', 'themo')),
                                        ),
                                        'description' => esc_html__('Choose image repeat property to set if/how the background image it will be repeated.', 'themo')
                                    ));

                                    if (!isset($_portfolio['generals']['background']['content_background_image_motion'])) {
                                        $_portfolio['generals']['background']['content_background_image_motion'] = '';
                                    }
                                    ideothemo_controls_html(array(
                                        'type' => 'selectmenu',
                                        'name' => '_ideo_portfolio[generals][background][content_background_image_motion]',
                                        'id' => 'portfolio_content_background_image_motion',
                                        'label' => esc_html__('BACKGROUND MOTION', 'themo'),
                                        'value' => $_portfolio['generals']['background']['content_background_image_motion'],
                                        'options' => array(
                                            array('scroll', esc_html__('Scroll', 'themo')),
                                            array('fixed', esc_html__('Fixed', 'themo'))
                                        ),
                                        'description' => esc_html__('Choose between 2 types of background image motion: Scroll (the background image scrolls along with elements), Fixed (the background image is fixed with regard to the viewport).', 'themo')
                                    ));

                                    if (!isset($_portfolio['generals']['background']['content_background_image_overlay'])) {
                                        $_portfolio['generals']['background']['content_background_image_overlay'] = '';
                                    }
                                    ideothemo_controls_html(array(
                                        'type' => 'selectmenu',
                                        'name' => '_ideo_portfolio[generals][background][content_background_image_overlay]',
                                        'id' => 'portfolio_content_background_image_overlay',
                                        'label' => esc_html__('IMAGE OVERLAY', 'themo'),
                                        'value' => $_portfolio['generals']['background']['content_background_image_overlay'],
                                        'options' => array(
                                            array('none', esc_html__('None', 'themo')),
                                            array('color', esc_html__('Color', 'themo')),
                                            array('pattern', esc_html__('Pattern', 'themo')),
                                        ),
                                        'description' => esc_html__('Choose between Color or Pattern background overlay type or choose None if you do not need any background overlay. Depending on which option you choose, additional options will be available below.', 'themo')
                                    ));
                                    ?>

                                    <div class="ideo-section">

                                        <?php
                                        if (!isset($_portfolio['generals']['background']['content_background_image_overlay_color'])) {
                                            $_portfolio['generals']['background']['content_background_image_overlay_color'] = '';
                                        }
                                        ideothemo_controls_html(array(
                                            'type' => 'colorpicker',
                                            'name' => '_ideo_portfolio[generals][background][content_background_image_overlay_color]',
                                            'id' => 'portfolio_content_background_image_overlay_color',
                                            'class' => 'colorpicker',
                                            'label' => esc_html__('OVERLAY COLOR', 'themo'),
                                            'value' => $_portfolio['generals']['background']['content_background_image_overlay_color'],
                                            'description' => esc_html__('Pick background image overlay color.', 'themo')
                                        ));

                                        if (!isset($_portfolio['generals']['background']['content_background_image_overlay_pattern'])) {
                                            $_portfolio['generals']['background']['content_background_image_overlay_pattern'] = '';
                                        }
                                        ideothemo_controls_html(array(
                                            'type' => 'selectmenu',
                                            'name' => '_ideo_portfolio[generals][background][content_background_image_overlay_pattern]',
                                            'id' => 'portfolio_content_background_image_overlay_pattern',
                                            'label' => esc_html__('PATTERN', 'themo'),
                                            'value' => $_portfolio['generals']['background']['content_background_image_overlay_pattern'],
                                            'options' => array_flip(ideothemo_get_background_patterns(true)),
                                            'description' => esc_html__('Choose one of predefined background image patterns.', 'themo')
                                        ));

                                        if (!isset($_portfolio['generals']['background']['content_background_image_overlay_pattern_color'])) {
                                            $_portfolio['generals']['background']['content_background_image_overlay_pattern_color'] = '';
                                        }
                                        ideothemo_controls_html(array(
                                            'type' => 'colorpicker',
                                            'name' => '_ideo_portfolio[generals][background][content_background_image_overlay_pattern_color]',
                                            'id' => 'portfolio_content_background_image_overlay_pattern_color',
                                            'class' => 'colorpicker',
                                            'label' => esc_html__('PATTERN COLOR', 'themo'),
                                            'value' => $_portfolio['generals']['background']['content_background_image_overlay_pattern_color'],
                                            'description' => esc_html__('Pick color for background image pattern.', 'themo')
                                        ));
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ideo-accordions">
                    <div class="ideo-accordions-section">
                        <h4 class="ideo-accordions-title"><?php esc_html_e('BOXED BACKGROUND', 'themo'); ?></h4>
                        <div class="ideo-accordions-content">
                            <div class="ideo-section">

                                <!-- boxed -->
                                <?php

                                if (!isset($_portfolio['generals']['background']['boxed_background_type'])) {
                                    $_portfolio['generals']['background']['boxed_background_type'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'selectmenu',
                                    'name' => '_ideo_portfolio[generals][background][boxed_background_type]',
                                    'id' => 'portfolio_boxed_background_type',
                                    'label' => esc_html__('OUTER AREA BACKGROUND (only for Boxed layout)', 'themo'),
                                    'value' => $_portfolio['generals']['background']['boxed_background_type'],
                                    'options' => array(
                                        array('', esc_html__('Default', 'themo')),
                                        array('color', esc_html__('Color', 'themo')),
                                        array('image', esc_html__('Image', 'themo')),
                                    ),
                                    'description' => esc_html__('Choose COLOR or IMAGE background type or choose DEFAULT to use Customizer setting. Depending on which option you choose, appropriate options will be available below.', 'themo')
                                ));

                                ?>

                                <div class="ideo-section">

                                    <?php
                                    if (!isset($_portfolio['generals']['background']['boxed_background_color'])) {
                                        $_portfolio['generals']['background']['boxed_background_color'] = '';
                                    }
                                    ideothemo_controls_html(array(
                                        'type' => 'colorpicker',
                                        'name' => '_ideo_portfolio[generals][background][boxed_background_color]',
                                        'id' => 'portfolio_boxed_background_color',
                                        'class' => 'colorpicker',
                                        'label' => esc_html__('BACKGROUND COLOR', 'themo'),
                                        'value' => $_portfolio['generals']['background']['boxed_background_color'],
                                        'description' => esc_html__('Pick outer area background color.', 'themo')
                                    ));

                                    if (!isset($_portfolio['generals']['background']['boxed_background_color_overlay'])) {
                                        $_portfolio['generals']['background']['boxed_background_color_overlay'] = '';
                                    }
                                    ideothemo_controls_html(array(
                                        'type' => 'selectmenu',
                                        'name' => '_ideo_portfolio[generals][background][boxed_background_color_overlay]',
                                        'id' => 'portfolio_boxed_background_color_overlay',
                                        'label' => esc_html__('OVERLAY', 'themo'),
                                        'value' => $_portfolio['generals']['background']['boxed_background_color_overlay'],
                                        'options' => array(
                                            array('none', esc_html__('None', 'themo')),
                                            array('color', esc_html__('Color', 'themo')),
                                            array('pattern', esc_html__('Pattern', 'themo')),
                                        ),
                                        'description' => esc_html__('Choose between Color or Pattern background overlay or choose None if you do not need any background overlay. Depending on which option you choose, appropriate additional options will be available below.', 'themo')
                                    ));
                                    ?>

                                    <div class="ideo-section">

                                        <?php
                                        if (!isset($_portfolio['generals']['background']['boxed_background_color_overlay_color'])) {
                                            $_portfolio['generals']['background']['boxed_background_color_overlay_color'] = '';
                                        }
                                        ideothemo_controls_html(array(
                                            'type' => 'colorpicker',
                                            'name' => '_ideo_portfolio[generals][background][boxed_background_color_overlay_color]',
                                            'id' => 'portfolio_boxed_background_color_overlay_color',
                                            'class' => 'colorpicker',
                                            'label' => esc_html__('OVERLAY COLOR', 'themo'),
                                            'value' => $_portfolio['generals']['background']['boxed_background_color_overlay_color'],
                                            'description' => esc_html__('Pick background overlay color.', 'themo')
                                        ));

                                        if (!isset($_portfolio['generals']['background']['boxed_background_color_pattern'])) {
                                            $_portfolio['generals']['background']['boxed_background_color_pattern'] = '';
                                        }
                                        ideothemo_controls_html(array(
                                            'type' => 'selectmenu',
                                            'name' => '_ideo_portfolio[generals][background][boxed_background_color_pattern]',
                                            'id' => 'portfolio_boxed_background_color_pattern',
                                            'label' => esc_html__('PATTERN', 'themo'),
                                            'value' => $_portfolio['generals']['background']['boxed_background_color_pattern'],
                                            'options' => array_flip(ideothemo_get_background_patterns(true)),
                                            'description' => esc_html__('Choose one of predefined pattern types.', 'themo')
                                        ));

                                        if (!isset($_portfolio['generals']['background']['boxed_background_color_pattern_color'])) {
                                            $_portfolio['generals']['background']['boxed_background_color_pattern_color'] = '';
                                        }
                                        ideothemo_controls_html(array(
                                            'type' => 'colorpicker',
                                            'name' => '_ideo_portfolio[generals][background][boxed_background_color_pattern_color]',
                                            'id' => 'portfolio_boxed_background_color_pattern_color',
                                            'class' => 'colorpicker',
                                            'label' => esc_html__('PATTERN COLOR', 'themo'),
                                            'value' => $_portfolio['generals']['background']['boxed_background_color_pattern_color'],
                                            'description' => esc_html__('Pick background pattern color.', 'themo')
                                        ));
                                        ?>

                                    </div>

                                    <?php

                                    if (!isset($_portfolio['generals']['background']['boxed_background_upload_image'])) {
                                        $_portfolio['generals']['background']['boxed_background_upload_image'] = '';
                                    }
                                    ideothemo_controls_html(array(
                                        'type' => 'attach-image',
                                        'name' => '_ideo_portfolio[generals][background][boxed_background_upload_image]',
                                        'id' => 'portfolio_boxed_background_upload_image',
                                        'label' => esc_html__('UPLOAD FILE', 'themo'),
                                        'button_label' => esc_html__('UPLOAD', 'themo'),
                                        'value' => $_portfolio['generals']['background']['boxed_background_upload_image'],
                                        'description' => esc_html__('Upload image which will be set as a portfolio page background. Only .jpg .png .bmp formats are allowed.', 'themo')
                                    ));

                                    if (!isset($_portfolio['generals']['background']['boxed_background_cover'])) {
                                        $_portfolio['generals']['background']['boxed_background_cover'] = 0;
                                    }
                                    ideothemo_controls_html(array(
                                        'type' => 'switcher',
                                        'name' => '_ideo_portfolio[generals][background][boxed_background_cover]',
                                        'id' => 'portfolio_boxed_background_cover',
                                        'label' => esc_html__('100% BACKGROUND ', 'themo'),
                                        'class' => 'switcher',
                                        'value' => $_portfolio['generals']['background']['boxed_background_cover'],
                                        'options' => array(
                                            array(1, esc_html__('On', 'themo')),
                                            array(0, esc_html__('Off', 'themo')),
                                        ),
                                        'description' => esc_html__('Turn On this option to set -cover- property for background image size (it will be scale to be as large as possible so that the background area is completely covered by the background image). By default this option is turned Off, so background image size has set -auto- property (original width and height).', 'themo')
                                    ));

                                    if (!isset($_portfolio['generals']['background']['boxed_background_image_position'])) {
                                        $_portfolio['generals']['background']['boxed_background_image_position'] = '';
                                    }
                                    ideothemo_controls_html(array(
                                        'type' => 'selectmenu',
                                        'name' => '_ideo_portfolio[generals][background][boxed_background_image_position]',
                                        'id' => 'portfolio_boxed_background_image_position',
                                        'label' => esc_html__('IMAGE POSITION', 'themo'),
                                        'value' => $_portfolio['generals']['background']['boxed_background_image_position'],
                                        'options' => array(
                                            array('left_top', esc_html__('Left top', 'themo')),
                                            array('center_top', esc_html__('Center top', 'themo')),
                                            array('right_top', esc_html__('Right top', 'themo')),
                                            array('left_center', esc_html__('Left center', 'themo')),
                                            array('center_center', esc_html__('Center center', 'themo')),
                                            array('right_center', esc_html__('Right center', 'themo')),
                                            array('left_bottom', esc_html__('Left bottom', 'themo')),
                                            array('center_bottom', esc_html__('Center bottom', 'themo')),
                                            array('right_bottom', esc_html__('Right bottom', 'themo')),
                                        ),
                                        'description' => esc_html__('Choose image position property to set the starting position of background image.', 'themo')
                                    ));

                                    if (!isset($_portfolio['generals']['background']['boxed_background_image_repeat'])) {
                                        $_portfolio['generals']['background']['boxed_background_image_repeat'] = '';
                                    }
                                    ideothemo_controls_html(array(
                                        'type' => 'selectmenu',
                                        'name' => '_ideo_portfolio[generals][background][boxed_background_image_repeat]',
                                        'id' => 'portfolio_boxed_background_image_repeat',
                                        'label' => esc_html__('IMAGE REPEAT', 'themo'),
                                        'value' => $_portfolio['generals']['background']['boxed_background_image_repeat'],
                                        'options' => array(
                                            array('no_repeat', esc_html__('No repeat', 'themo')),
                                            array('repeat_x', esc_html__('Repeat X', 'themo')),
                                            array('repeat_y', esc_html__('Repeat Y', 'themo')),
                                            array('repeat', esc_html__('Repeat XY', 'themo')),
                                        ),
                                        'description' => esc_html__('Choose image repeat property to set if/how the background image it will be repeated.', 'themo')
                                    ));

                                    if (!isset($_portfolio['generals']['background']['boxed_background_image_motion'])) {
                                        $_portfolio['generals']['background']['boxed_background_image_motion'] = '';
                                    }
                                    ideothemo_controls_html(array(
                                        'type' => 'selectmenu',
                                        'name' => '_ideo_portfolio[generals][background][boxed_background_image_motion]',
                                        'id' => 'portfolio_boxed_background_image_motion',
                                        'label' => esc_html__('BACKGROUND MOTION', 'themo'),
                                        'value' => $_portfolio['generals']['background']['boxed_background_image_motion'],
                                        'options' => array(
                                            array('scroll', esc_html__('Scroll', 'themo')),
                                            array('fixed', esc_html__('Fixed', 'themo'))
                                        ),
                                        'description' => esc_html__('Choose between 2 types of background image motion: Scroll (the background image scrolls along with elements), Fixed (the background image is fixed with regard to the viewport).', 'themo')
                                    ));

                                    if (!isset($_portfolio['generals']['background']['boxed_background_image_overlay'])) {
                                        $_portfolio['generals']['background']['boxed_background_image_overlay'] = '';
                                    }
                                    ideothemo_controls_html(array(
                                        'type' => 'selectmenu',
                                        'name' => '_ideo_portfolio[generals][background][boxed_background_image_overlay]',
                                        'id' => 'portfolio_boxed_background_image_overlay',
                                        'label' => esc_html__('IMAGE OVERLAY', 'themo'),
                                        'value' => $_portfolio['generals']['background']['boxed_background_image_overlay'],
                                        'options' => array(
                                            array('none', esc_html__('None', 'themo')),
                                            array('color', esc_html__('Color', 'themo')),
                                            array('pattern', esc_html__('Pattern', 'themo')),
                                        ),
                                        'description' => esc_html__('Choose between Color or Pattern background overlay or choose None if you do not need any background overlay. Depending on which option you choose, appropriate additional options will be available below.', 'themo')
                                    ));
                                    ?>

                                    <div class="ideo-section">

                                        <?php
                                        if (!isset($_portfolio['generals']['background']['boxed_background_image_overlay_color'])) {
                                            $_portfolio['generals']['background']['boxed_background_image_overlay_color'] = '';
                                        }
                                        ideothemo_controls_html(array(
                                            'type' => 'colorpicker',
                                            'name' => '_ideo_portfolio[generals][background][boxed_background_image_overlay_color]',
                                            'id' => 'portfolio_boxed_background_image_overlay_color',
                                            'class' => 'colorpicker',
                                            'label' => esc_html__('OVERLAY COLOR', 'themo'),
                                            'value' => $_portfolio['generals']['background']['boxed_background_image_overlay_color'],
                                            'description' => esc_html__('Pick background image overlay color.', 'themo')
                                        ));

                                        if (!isset($_portfolio['generals']['background']['boxed_background_image_overlay_pattern'])) {
                                            $_portfolio['generals']['background']['boxed_background_image_overlay_pattern'] = '';
                                        }
                                        ideothemo_controls_html(array(
                                            'type' => 'selectmenu',
                                            'name' => '_ideo_portfolio[generals][background][boxed_background_image_overlay_pattern]',
                                            'id' => 'portfolio_boxed_background_image_overlay_pattern',
                                            'label' => esc_html__('PATTERN', 'themo'),
                                            'value' => $_portfolio['generals']['background']['boxed_background_image_overlay_pattern'],
                                            'options' => array_flip(ideothemo_get_background_patterns(true)),
                                            'description' => esc_html__('Choose one of predefined pattern types.', 'themo')
                                        ));

                                        if (!isset($_portfolio['generals']['background']['boxed_background_image_overlay_pattern_color'])) {
                                            $_portfolio['generals']['background']['boxed_background_image_overlay_pattern_color'] = '';
                                        }
                                        ideothemo_controls_html(array(
                                            'type' => 'colorpicker',
                                            'name' => '_ideo_portfolio[generals][background][boxed_background_image_overlay_pattern_color]',
                                            'id' => 'portfolio_boxed_background_image_overlay_pattern_color',
                                            'class' => 'colorpicker',
                                            'label' => esc_html__('PATTERN COLOR', 'themo'),
                                            'value' => $_portfolio['generals']['background']['boxed_background_image_overlay_pattern_color'],
                                            'description' => esc_html__('Pick color for background image pattern.', 'themo')
                                        ));
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="tab-header" class="tab-content">
                <div class="ideo-section">
                    <div class="ideo-info">
                        <h5><?php esc_html_e('Info:', 'themo'); ?></h5>
                        <p><?php echo wp_kses(__('In this section you can customize header for this particular single page. You can override global header type, assign different menu, pick suitable header style and customize some header options in appropriate sections. </br> <b>!!! Notice, that all detailed header options are available in Customizer. Besides global header, you can customize there all header types and all header styles separately, so here in Page options you can simply pick suitable header type and its style. </b>', 'themo'),  IDEOTHEMO_KSES_TAGS::allow()); ?></p>
                    </div>
                    <?php
                    $prefix = 'portfolio_options_';

                    if (!isset($_portfolio['header']['overwrite_global_header'])) {
                        $_portfolio['header']['overwrite_global_header'] = 'on';
                    }
                    ideothemo_controls_html(array(
                        'type' => 'switcher',
                        'name' => '_ideo_portfolio[header][overwrite_global_header]',
                        'id' => 'portfolio_header_on',
                        'label' => esc_html__('HEADER', 'themo'),
                        'class' => 'switcher',
                        'value' => $_portfolio['header']['overwrite_global_header'],
                        'options' => array(
                            array('on', esc_html__('On', 'themo')),
                            array('off', esc_html__('Off', 'themo')),
                        ),
                        'description' => esc_html__('Enable or disable header displaying.', 'themo')
                    ));

                    if (!isset($_portfolio['header']['type'])) {
                        $_portfolio['header']['type'] = '';
                    }

                    if (!empty($_portfolio['header']['type']) && $_portfolio['header']['type'] == 'side_header') {
                        $_portfolio['header']['type'] = 'side_' . $_portfolio['header']['side']['side'] . '_header';
                        unset($_portfolio['header']['side']['side']);
                    }

                    ideothemo_controls_html(array(
                        'type' => 'selectmenu',
                        'name' => '_ideo_portfolio[header][type]',
                        'id' => $prefix . 'type',
                        'label' => esc_html__('HEADER TYPE', 'themo'),
                        'value' => $_portfolio['header']['type'],
                        'options' => array(
                            array('default', esc_html__('Default', 'themo')),
                            array('standard_header', esc_html__('Top header', 'themo')),
                            array('sticky_header', esc_html__('Top/Sticky fade', 'themo')),
                            array('sticky_slide_header', esc_html__('Top/Sticky slide', 'themo')),
                            array('sticky_slide_hide_header', esc_html__('Top/Sticky slide & hide', 'themo')),
                            array('side_left_header', esc_html__('Side header - left', 'themo')),
                            array('side_right_header', esc_html__('Side header - right', 'themo')),
                            array('side_offcanvas_left_header', esc_html__('Side & offcanvas - left', 'themo')),
                            array('side_offcanvas_right_header', esc_html__('Side & offcanvas - right', 'themo')),
                        ),
                        'description' => esc_html__('Choose header type for this particular page or choose DEFAULT to use global header chosen in Customizer. If you are going to change default header then use options in appropriate sections below to customize it.', 'themo')
                    ));

                    if (!isset($_portfolio['header']['menu_location'])) {
                        $_portfolio['header']['menu_location'] = '';
                    }
                    ideothemo_controls_html(array(
                        'type' => 'selectmenu',
                        'name' => '_ideo_portfolio[header][menu_location]',
                        'id' => $prefix . 'menu_location',
                        'label' => esc_html__('MENU LOCATION', 'themo'),
                        'value' => $_portfolio['header']['menu_location'],
                        'options' => array(
                            array('main-menu', esc_html__('Main menu', 'themo')),
                            array('secondary-menu', esc_html__('Secondary menu', 'themo')),
                            array('third-menu', esc_html__('Third menu', 'themo')),
                            array('fourth-menu', esc_html__('Fourth menu', 'themo')),
                            array('fifth-menu', esc_html__('Fifth menu', 'themo')),
                        ),
                        'description' => esc_html__('Choose menu location.', 'themo')
                    ));

                    if (!isset($_portfolio['header']['mobile_menu_location'])) {
                        $_portfolio['header']['mobile_menu_location'] = '';
                    }
                    ideothemo_controls_html(array(
                        'type' => 'selectmenu',
                        'name' => '_ideo_portfolio[header][mobile_menu_location]',
                        'id' => $prefix . 'mobile_menu_location',
                        'label' => esc_html__('MOBILE MENU LOCATION', 'themo'),
                        'value' => $_portfolio['header']['mobile_menu_location'],
                        'options' => array(
                            array('main-menu', esc_html__('Main menu', 'themo')),
                            array('secondary-menu', esc_html__('Secondary menu', 'themo')),
                            array('third-menu', esc_html__('Third menu', 'themo')),
                            array('fourth-menu', esc_html__('Fourth menu', 'themo')),
                            array('fifth-menu', esc_html__('Fifth menu', 'themo')),
                        ),
                        'description' => esc_html__('Choose menu location for mobile.', 'themo')
                    ));

                    ?>
                </div>
                <div class="ideo-accordions">
                    <div class="ideo-accordions-section">
                        <h4 class="ideo-accordions-title">
                            <?php esc_html_e('TOP HEADER & TOPBAR', 'themo'); ?>
                        </h4>
                        <div class="ideo-accordions-content">
                            <div class="ideo-section">
                                <?php
                                $prefix = 'portfolio_options_top_';
                                if (!isset($_portfolio['header']['top']['style'])) {
                                    $_portfolio['header']['top']['style'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'selectmenu',
                                    'name' => '_ideo_portfolio[header][top][style]',
                                    'id' => $prefix . 'style',
                                    'label' => esc_html__('TOP HEADER & TOPBAR STYLE', 'themo'),
                                    'value' => $_portfolio['header']['top']['style'],
                                    'options' => array(
                                        array('default', esc_html__('DEFAULT', 'themo')),
                                        array('colored-dark', esc_html__('Colored dark', 'themo')),
                                        array('colored-light', esc_html__('Colored light', 'themo')),
                                        array('transparent-dark', esc_html__('Transparent dark', 'themo')),
                                        array('transparent-light', esc_html__('Transparent light', 'themo')),
                                    ),
                                    'description' => wp_kses(__('Choose style for Top header or choose DEFAULT to use style set in Customizer. </br><b>!!! Depending on which style you choose you can customize every single color for chosen style in Customizer, in appropriate Top/Sticky header coloring section.</b>', 'themo'),  IDEOTHEMO_KSES_TAGS::allow())
                                ));

                                if (!isset($_portfolio['header']['top']['logo']['type'])) {
                                    $_portfolio['header']['top']['logo']['type'] = 'default';
                                }

                                ideothemo_controls_html(array(
                                    'type' => 'selectmenu',
                                    'name' => '_ideo_portfolio[header][top][logo][type]',
                                    'id' => $prefix . 'logo_type',
                                    'label' => esc_html__('LOGO', 'themo'),
                                    'value' => $_portfolio['header']['top']['logo']['type'],
                                    'options' => array(
                                        array('default', esc_html__('DEFAULT', 'themo')),
                                        array('normal', esc_html__('Normal', 'themo')),
                                        array('light', esc_html__('Light', 'themo')),
                                        array('dark', esc_html__('Dark', 'themo')),
                                    ),
                                    'description' => esc_html__('Choose logo for Top header (choose one of logo versions you have uploaded in logo section: Normal logo, Light logo or Dark logo) or choose DEFAULT to use logo set in Customizer.', 'themo'),
                                ));

                                if (!isset($_portfolio['header']['top']['top_distance'])) {
                                    $_portfolio['header']['top']['top_distance'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'textfield',
                                    'name' => '_ideo_portfolio[header][top][top_distance]',
                                    'id' => $prefix . 'top_distance',
                                    'class' => '',
                                    'label' => esc_html__('HEADER TOP DISTANCE (px)', 'themo'),
                                    'value' => $_portfolio['header']['top']['top_distance'],
                                    'placeholder' => '',
                                    'description' => esc_html__('Define in pixels header top distance or leave empty field to use Customizer setting. This option makes empty space between the top edge of the header (main header container) and browser window edge.', 'themo')
                                ));

                                if (gettype($_portfolio['header']['top']['topbar']) != 'array')
                                    $_portfolio['header']['top']['topbar'] = array('enabled' => $_portfolio['header']['top']['topbar']);

                                ideothemo_controls_html(array(
                                    'type' => 'selectmenu',
                                    'name' => '_ideo_portfolio[header][top][topbar][enabled]',
                                    'id' => $prefix . 'topbar_enable',
                                    'label' => esc_html__('TOPBAR', 'themo'),
                                    'value' => $_portfolio['header']['top']['topbar']['enabled'],
                                    'options' => array(
                                        array('', esc_html__('DEFAULT', 'themo')),
                                        array('yes', esc_html__('Yes', 'themo')),
                                        array('no', esc_html__('No', 'themo')),
                                    ),
                                    'description' => wp_kses(__('Choose style for topbar or choose DEFAULT to use style set in Customizer. </br><b>!!! Depending on which style you choose you can customize every single color for chosen style in Customizer, in appropriate Top/Sticky header coloring section.</b>', 'themo'),  IDEOTHEMO_KSES_TAGS::allow())
                                ));
                                ?>

                            </div>
                        </div>
                    </div>
                    <div class="ideo-accordions-section">
                        <h4 class="ideo-accordions-title">
                            <?php esc_html_e('STICKY HEADER', 'themo'); ?>
                        </h4>
                        <div class="ideo-accordions-content">
                            <div class="ideo-section">
                                <?php
                                $prefix = 'portfolio_options_sticky_';

                                if (!isset($_portfolio['header']['sticky']['style'])) {
                                    $_portfolio['header']['sticky']['style'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'selectmenu',
                                    'name' => '_ideo_portfolio[header][sticky][style]',
                                    'id' => $prefix . 'sticky_header_style',
                                    'label' => esc_html__('STICKY HEADER STYLE', 'themo'),
                                    'value' => $_portfolio['header']['sticky']['style'],
                                    'options' => array(
                                        array('default', esc_html__('DEFAULT', 'themo')),
                                        array('colored-dark', esc_html__('Colored dark', 'themo')),
                                        array('colored-light', esc_html__('Colored light', 'themo')),
                                        array('transparent-dark', esc_html__('Transparent dark', 'themo')),
                                        array('transparent-light', esc_html__('Transparent light', 'themo')),
                                    ),
                                    'description' => wp_kses(__('Choose style for Sticky header or choose DEFAULT to use style set in Customizer. </br><b>!!! Depending on which style you choose you can customize every single color for chosen style in Customizer, in appropriate Top/Sticky header coloring section.</b>', 'themo'),  IDEOTHEMO_KSES_TAGS::allow())
                                ));

                                if (!isset($_portfolio['header']['sticky']['logo']['type'])) {
                                    $_portfolio['header']['sticky']['logo']['type'] = 'default';
                                }

                                ideothemo_controls_html(array(
                                    'type' => 'selectmenu',
                                    'name' => '_ideo_portfolio[header][sticky][logo][type]',
                                    'id' => $prefix . 'logo_type',
                                    'label' => esc_html__('LOGO', 'themo'),
                                    'value' => $_portfolio['header']['sticky']['logo']['type'],
                                    'options' => array(
                                        array('default', esc_html__('DEFAULT', 'themo')),
                                        array('normal', esc_html__('Normal', 'themo')),
                                        array('light', esc_html__('Light', 'themo')),
                                        array('dark', esc_html__('Dark', 'themo')),
                                        array('sticky.light', esc_html__('Sticky light', 'themo')),
                                        array('sticky.dark', esc_html__('Sticky dark', 'themo')),
                                    ),
                                    'description' => esc_html__('Choose logo for Sticky header (choose one of logo versions you have uploaded in logo section: Normal logo, Light logo, Dark logo, Sticky light logo or Sticky dark logo) or choose DEFAULT to use logo set in Customizer.', 'themo'),
                                ));

                                if (!isset($_portfolio['header']['sticky']['top_distance'])) {
                                    $_portfolio['header']['sticky']['top_distance'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'textfield',
                                    'name' => '_ideo_portfolio[header][sticky][top_distance]',
                                    'id' => $prefix . 'sticky_header_distance',
                                    'class' => '',
                                    'label' => esc_html__('STICKY HEADER TOP DISTANCE', 'themo'),
                                    'value' => $_portfolio['header']['sticky']['top_distance'],
                                    'placeholder' => '',
                                    'description' => esc_html__('Define in pixels Sticky header top distance or leave empty field to use Customizer setting. This option makes empty space between the top edge of the header (main header container) and browser window edge.', 'themo')
                                ));

                                if (!isset($_portfolio['header']['sticky']['loading_effect'])) {
                                    $_portfolio['header']['sticky']['loading_effect'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'selectmenu',
                                    'name' => '_ideo_portfolio[header][sticky][loading_effect]',
                                    'id' => $prefix . 'sticky_header_loading_effect',
                                    'label' => esc_html__('STICKY HEADER LOADING EFFECT', 'themo'),
                                    'value' => $_portfolio['header']['sticky']['loading_effect'],
                                    'options' => array(
                                        array('default', esc_html__('DEFAULT', 'themo')),
                                        array('loading-effect-1', esc_html__('Style 1', 'themo')),
                                        array('loading-effect-2', esc_html__('Style 2', 'themo')),
                                    ),
                                    'description' => wp_kses(__('Sticky header loading effect is an additional effect for header - header bacome a loading bar which loads smoothly while page scrolling. Disable Sticky header loading effect or enable this option by choosing one of loading styles: <b>Style 1 (header border bottom loading)</b>; <b>Style 2 (header background loading)</b>', 'themo'),  IDEOTHEMO_KSES_TAGS::allow())
                                ));

                                ?>

                            </div>
                        </div>
                    </div>

                    <div class="ideo-accordions-section">
                        <h4 class="ideo-accordions-title">
                            <?php esc_html_e('SIDE & OFFCANVAS HEADER', 'themo'); ?>
                        </h4>
                        <div class="ideo-accordions-content">
                            <div class="ideo-section">
                                <?php
                                $prefix = 'portfolio_options_side_';

                                if (!isset($_portfolio['header']['side']['style'])) {
                                    $_portfolio['header']['side']['style'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'selectmenu',
                                    'name' => '_ideo_portfolio[header][side][style]',
                                    'id' => $prefix . 'sticky_header_style',
                                    'label' => esc_html__('SIDE HEADER STYLE', 'themo'),
                                    'value' => $_portfolio['header']['side']['style'],
                                    'options' => array(
                                        array('default', esc_html__('DEFAULT', 'themo')),
                                        array('dark', esc_html__('Dark', 'themo')),
                                        array('light', esc_html__('Light', 'themo'))
                                    ),
                                    'description' => wp_kses(__('Choose style for Side header or choose DEFAULT to use style set in Customizer. </br><b>!!! Depending on which style you choose you can customize every single color for chosen style in Customizer, in appropriate Side header coloring section.</b>', 'themo'),  IDEOTHEMO_KSES_TAGS::allow())
                                ));


                                
                                if (!isset($_portfolio['header']['side']['logo']['type'])) {
                                    $_portfolio['header']['side']['logo']['type'] = 'default';
                                }

                                ideothemo_controls_html(array(
                                    'type' => 'selectmenu',
                                    'name' => '_ideo_portfolio[header][side][logo][type]',
                                    'id' => $prefix . 'logo_type',
                                    'label' => esc_html__('LOGO', 'themo'),
                                    'value' => $_portfolio['header']['side']['logo']['type'],
                                    'options' => array(
                                        array('default', esc_html__('DEFAULT', 'themo')),
                                        array('normal', esc_html__('Normal', 'themo')),
                                        array('light', esc_html__('Light', 'themo')),
                                        array('dark', esc_html__('Dark', 'themo')),
                                    ),
                                    'description' => esc_html__('Choose logo for Side header (choose one of logo versions you have uploaded in logo section: Normal logo, Light logo or Dark logo) or choose DEFAULT to use logo set in Customizer.', 'themo'),
                                ));

                                if (!isset($_portfolio['header']['side']['align']['menu'])) {
                                    $_portfolio['header']['side']['align']['menu'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'selectmenu',
                                    'name' => '_ideo_portfolio[header][side][align][menu]',
                                    'id' => $prefix . 'align_menu',
                                    'label' => esc_html__('MENU ALIGN', 'themo'),
                                    'value' => $_portfolio['header']['side']['align']['menu'],
                                    'options' => array(
                                        array('default', esc_html__('DEFAULT', 'themo')),
                                        array('left', esc_html__('Left', 'themo')),
                                        array('center', esc_html__('Center', 'themo')),
                                        array('right', esc_html__('Right', 'themo')),
                                    ),
                                    'description' => esc_html__('Justify menu content to the Left, Center or Right side inside header container.', 'themo')
                                ));

                                if (!isset($_portfolio['header']['side']['align']['bottom_area'])) {
                                    $_portfolio['header']['side']['align']['bottom_area'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'selectmenu',
                                    'name' => '_ideo_portfolio[header][side][align][bottom_area]',
                                    'id' => $prefix . 'bottom_area_align',
                                    'label' => esc_html__('BOTTOM AREA ALIGN', 'themo'),
                                    'value' => $_portfolio['header']['side']['align']['bottom_area'],
                                    'options' => array(
                                        array('default', esc_html__('DEFAULT', 'themo')),
                                        array('left', esc_html__('Left', 'themo')),
                                        array('center', esc_html__('Center', 'themo')),
                                        array('right', esc_html__('Right', 'themo')),
                                    ),
                                    'description' => esc_html__('Justify bottom area content (social icons and copyrights) to the Left, Center and Right side inside header container.', 'themo')
                                ));
                                
                                if (!isset($_portfolio['header']['side']['offcanvas']['topbar']['style'])) {
                                    $_portfolio['header']['side']['offcanvas']['topbar']['style'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'selectmenu',
                                    'name' => '_ideo_portfolio[header][side][offcanvas][topbar][style]',
                                    'id' => $prefix . 'offcanvas_topbar_style',
                                    'label' => esc_html__('OFFCANVAS TOP BAR SKIN', 'themo'),
                                    'value' => $_portfolio['header']['side']['offcanvas']['topbar']['style'],
                                    'options' => array(
                                        array('default', esc_html__('DEFAULT', 'themo')),
                                        array('dark', esc_html__('Dark', 'themo')),
                                        array('light', esc_html__('Light', 'themo'))
                                    ),
                                    'description' => esc_html__('', 'themo')
                                ));
                                if (!isset($_portfolio['header']['side']['offcanvas']['topbar']['transparent'])) {
                                    $_portfolio['header']['side']['offcanvas']['topbar']['transparent'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'selectmenu',
                                    'name' => '_ideo_portfolio[header][side][offcanvas][topbar][transparent]',
                                    'id' => $prefix . 'offcanvas_topbar_transparent',
                                    'label' => esc_html__('OFFCANVAS TOP BAR TRANSPARENT', 'themo'),
                                    'class' => 'switcher',
                                    'value' => $_portfolio['header']['side']['offcanvas']['topbar']['transparent'],
                                    'options' => array(
                                        array('', esc_html__('DEFAULT', 'themo')),
                                        array('true', esc_html__('Yes', 'themo')),
                                        array('false', esc_html__('No', 'themo')),
                                    ),
                                    'description' => esc_html__('', 'themo')
                                ));
    
                                if (!isset($_portfolio['header']['side']['offcanvas']['topbar']['logo']['type'])) {
                                    $_portfolio['header']['side']['offcanvas']['topbar']['logo']['type'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'selectmenu',
                                    'name' => '_ideo_portfolio[header][side][offcanvas][topbar][logo][type]',
                                    'id' => $prefix . 'offcanvas_topbar_logo_type',
                                    'label' => esc_html__('OFFCANVAS TOPBAR BAR LOGO', 'themo'),
                                    'value' => $_portfolio['header']['side']['offcanvas']['topbar']['logo']['type'],
                                    'options' => array(
                                        array('default', esc_html__('DEFAULT', 'themo')),
                                        array('normal', esc_html__('Normal', 'themo')),
                                        array('light', esc_html__('Light', 'themo')),
                                        array('dark', esc_html__('Dark', 'themo')),
                                    ),
                                    'description' => esc_html__('', 'themo')
                                ));
                                if (!isset($_portfolio['header']['side']['offcanvas']['stickybar']['style'])) {
                                    $_portfolio['header']['side']['offcanvas']['stickybar']['style'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'selectmenu',
                                    'name' => '_ideo_portfolio[header][side][offcanvas][stickybar][style]',
                                    'id' => $prefix . 'offcanvas_stickybar_style',
                                    'label' => esc_html__('OFFCANVAS STICKY BAR SKIN', 'themo'),
                                    'value' => $_portfolio['header']['side']['offcanvas']['stickybar']['style'],
                                    'options' => array(
                                        array('default', esc_html__('DEFAULT', 'themo')),
                                        array('dark', esc_html__('Dark', 'themo')),
                                        array('light', esc_html__('Light', 'themo'))
                                    ),
                                    'description' => esc_html__('', 'themo')
                                ));
                                if (!isset($_portfolio['header']['side']['offcanvas']['stickybar']['logo']['type'])) {
                                    $_portfolio['header']['side']['offcanvas']['stickybar']['logo']['type'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'selectmenu',
                                    'name' => '_ideo_portfolio[header][side][offcanvas][stickybar][logo][type]',
                                    'id' => $prefix . 'offcanvas_stickybar_logo_type',
                                    'label' => esc_html__('OFFCANVAS STICKY BAR LOGO', 'themo'),
                                    'value' => $_portfolio['header']['side']['offcanvas']['stickybar']['logo']['type'],
                                    'options' => array(
                                        array('default', esc_html__('DEFAULT', 'themo')),
                                        array('normal', esc_html__('Normal', 'themo')),
                                        array('light', esc_html__('Light', 'themo')),
                                        array('dark', esc_html__('Dark', 'themo')),
                                    ),
                                    'description' => esc_html__('', 'themo')
                                ));


                                
                                ?>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div id="tab-portfolio-standard_titlearea" class="tab-content">
                <div class="ideo-accordions">
                    <div class="ideo-section">
                        <div class="ideo-info">
                            <h5><?php esc_html_e('Info:', 'themo'); ?></h5>
                            <p><?php echo wp_kses(__('In this section you can customize Page title options for PORTFOLIO STANDARD page. Default Page title settings are taken from Customizer settings (form PAGE TITLE section). THEMO allows you to create totally different page titles for different portfolio pages. You can override Page title appearance for this particular portfolio page using options below but if you change your mind you can return to default Customizer settings simply choosing Default settings in dropdowns and leaving empty fields. </br> <b>All options available in this section affects MODERN CARD only.</b>', 'themo'),  IDEOTHEMO_KSES_TAGS::allow()); ?></p>
                        </div>
                        <?php
                        if (!isset($_portfolio['pagetitle']['page_title_settings']['page_title_area'])) {
                            $_portfolio['pagetitle']['page_title_settings']['page_title_area'] = '';
                        }
                        ideothemo_controls_html(array(
                            'type' => 'selectmenu',
                            'name' => '_ideo_portfolio[pagetitle][page_title_settings][page_title_area]',
                            'id' => 'portfolio_page_title_area',
                            'label' => esc_html__('PORTFOLIO TITLE AREA', 'themo'),
                            'value' => $_portfolio['pagetitle']['page_title_settings']['page_title_area'],
                            'options' => array(
                                array('', esc_html__('Default', 'themo')),
                                array('yes', esc_html__('Yes', 'themo')),
                                array('no', esc_html__('No', 'themo')),
                            ),
                            'description' => esc_html__('You can turn On (Yes) or Off (NO) Page title area on the portfolio page. Choose DEAFAULT to use Customizer setting.', 'themo')
                        ));

                        if (!isset($_portfolio['pagetitle']['page_title_settings']['breadcrumbs_area'])) {
                            $_portfolio['pagetitle']['page_title_settings']['breadcrumbs_area'] = '';
                        }
                        ideothemo_controls_html(array(
                            'type' => 'selectmenu',
                            'name' => '_ideo_portfolio[pagetitle][page_title_settings][breadcrumbs_area]',
                            'id' => 'portfolio_breadcrumbs_area',
                            'label' => esc_html__('BREADCRUMBS AREA', 'themo'),
                            'value' => $_portfolio['pagetitle']['page_title_settings']['breadcrumbs_area'],
                            'options' => array(
                                array('', esc_html__('Default', 'themo')),
                                array('yes', esc_html__('Yes', 'themo')),
                                array('no', esc_html__('No', 'themo')),
                            ),
                            'description' => esc_html__('You can turn On (Yes) or Off (NO) Breadcrumbs area on the portfolio page. Choose DEAFAULT to use Customizer setting.', 'themo')
                        ));
                        ?>
                    </div>
                </div>
                <div class="ideo-accordions">
                    <div class="ideo-accordions-section">
                        <h4 class="ideo-accordions-title"><?php esc_html_e('SETTINGS AND STYLING', 'themo'); ?></h4>
                        <div class="ideo-accordions-content">
                            <div class="ideo-section">
                                <?php
                                if (!isset($_portfolio['pagetitle']['page_title_settings']['page_title_area_skin'])) {
                                    $_portfolio['pagetitle']['page_title_settings']['page_title_area_skin'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'selectmenu',
                                    'name' => '_ideo_portfolio[pagetitle][page_title_settings][page_title_area_skin]',
                                    'id' => 'portfolio_page_title_area_skin',
                                    'label' => esc_html__('PORTFOLIO TITLE AREA SKIN', 'themo'),
                                    'value' => $_portfolio['pagetitle']['page_title_settings']['page_title_area_skin'],
                                    'options' => ideothemo_get_skins(),
                                    'description' => esc_html__('Choose between Light and Dark skin for Page title area or choose DEFAULT to use Customizer setting. Besides choosing the style you can also customize colors for page title elements using options at the bottom of this section.', 'themo')
                                ));

                                if (!isset($_portfolio['pagetitle']['page_title_settings']['page_title_area_height'])) {
                                    $_portfolio['pagetitle']['page_title_settings']['page_title_area_height'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'textfield',
                                    'name' => '_ideo_portfolio[pagetitle][page_title_settings][page_title_area_height]',
                                    'id' => 'portfolio_page_title_area_height',
                                    'class' => '',
                                    'label' => esc_html__('PORTFOLIO TITLE AREA HEIGHT (px)', 'themo'),
                                    'value' => $_portfolio['pagetitle']['page_title_settings']['page_title_area_height'],
                                    'placeholder' => esc_html__('enter Page Title height in px', 'themo'),
                                    'description' => esc_html__('Define Page title area height in pixels or leave empty field to use Customizer setting.', 'themo')
                                ));

                                if (!isset($_portfolio['pagetitle']['page_title_background']['page_title_area_background'])) {
                                    $_portfolio['pagetitle']['page_title_background']['page_title_area_background'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'selectmenu',
                                    'name' => '_ideo_portfolio[pagetitle][page_title_background][page_title_area_background]',
                                    'id' => 'portfolio_page_title_area_background',
                                    'label' => esc_html__('PORTFOLIO TITLE AREA BACKGROUND', 'themo'),
                                    'value' => $_portfolio['pagetitle']['page_title_background']['page_title_area_background'],
                                    'options' => array(
                                        array('', esc_html__('Default', 'themo')),
                                        array('color', esc_html__('Color', 'themo')),
                                        array('image', esc_html__('Image', 'themo')),
                                        array('video', esc_html__('Video', 'themo')),
                                    ),
                                    'description' => esc_html__('Choose Color, Image or Video background type for page title area or choose DEFAULT to use Customizer setting. Depending on which background type you choose appropriate options will be available below.', 'themo')
                                ));
                                ?>

                                <div class="ideo-section">

                                    <?php
                                    if (!isset($_portfolio['pagetitle']['page_title_background']['pt_background_color'])) {
                                        $_portfolio['pagetitle']['page_title_background']['pt_background_color'] = '';
                                    }
                                    ideothemo_controls_html(array(
                                        'type' => 'colorpicker',
                                        'name' => '_ideo_portfolio[pagetitle][page_title_background][pt_background_color]',
                                        'id' => 'portfolio_pt_background_color',
                                        'class' => 'colorpicker',
                                        'label' => esc_html__('COLOR', 'themo'),
                                        'value' => $_portfolio['pagetitle']['page_title_background']['pt_background_color'],
                                        'description' => esc_html__('Pick page title area background color.', 'themo')
                                    ));

                                    if (!isset($_portfolio['pagetitle']['page_title_background']['pt_background_color_overlay'])) {
                                        $_portfolio['pagetitle']['page_title_background']['pt_background_color_overlay'] = '';
                                    }
                                    ideothemo_controls_html(array(
                                        'type' => 'selectmenu',
                                        'name' => '_ideo_portfolio[pagetitle][page_title_background][pt_background_color_overlay]',
                                        'id' => 'portfolio_pt_background_color_overlay',
                                        'label' => esc_html__('OVERLAY', 'themo'),
                                        'value' => $_portfolio['pagetitle']['page_title_background']['pt_background_color_overlay'],
                                        'options' => array(
                                            array('none', esc_html__('None', 'themo')),
                                            array('color', esc_html__('Color', 'themo')),
                                            array('pattern', esc_html__('Pattern', 'themo')),
                                        ),
                                        'description' => esc_html__('Choose between Color or Pattern background overlay or choose None if you do not need any background overlay. Depending on which option you choose the several styling options will be available below.', 'themo')
                                    ));
                                    ?>

                                    <div class="ideo-section">
                                        <?php
                                        if (!isset($_portfolio['pagetitle']['page_title_background']['pt_background_color_overlay_color'])) {
                                            $_portfolio['pagetitle']['page_title_background']['pt_background_color_overlay_color'] = '';
                                        }
                                        ideothemo_controls_html(array(
                                            'type' => 'colorpicker',
                                            'name' => '_ideo_portfolio[pagetitle][page_title_background][pt_background_color_overlay_color]',
                                            'id' => 'portfolio_pt_background_color_overlay_color',
                                            'class' => 'colorpicker',
                                            'label' => esc_html__('OVERLAY COLOR', 'themo'),
                                            'value' => $_portfolio['pagetitle']['page_title_background']['pt_background_color_overlay_color'],
                                            'description' => esc_html__('Pick background overlay color.', 'themo')
                                        ));

                                        if (!isset($_portfolio['pagetitle']['page_title_background']['pt_background_color_pattern'])) {
                                            $_portfolio['pagetitle']['page_title_background']['pt_background_color_pattern'] = '';
                                        }
                                        ideothemo_controls_html(array(
                                            'type' => 'selectmenu',
                                            'name' => '_ideo_portfolio[pagetitle][page_title_background][pt_background_color_pattern]',
                                            'id' => 'portfolio_pt_background_color_pattern',
                                            'label' => esc_html__('PATTERN', 'themo'),
                                            'value' => $_portfolio['pagetitle']['page_title_background']['pt_background_color_pattern'],
                                            'options' => array_flip(ideothemo_get_background_patterns(true)),
                                            'description' => esc_html__('Choose one of predefined pattern types.', 'themo')
                                        ));

                                        if (!isset($_portfolio['pagetitle']['page_title_background']['pt_background_color_pattern_color'])) {
                                            $_portfolio['pagetitle']['page_title_background']['pt_background_color_pattern_color'] = '';
                                        }
                                        ideothemo_controls_html(array(
                                            'type' => 'colorpicker',
                                            'name' => '_ideo_portfolio[pagetitle][page_title_background][pt_background_color_pattern_color]',
                                            'id' => 'portfolio_pt_background_color_pattern_color',
                                            'class' => 'colorpicker',
                                            'label' => esc_html__('PATTERN COLOR', 'themo'),
                                            'value' => $_portfolio['pagetitle']['page_title_background']['pt_background_color_pattern_color'],
                                            'description' => esc_html__('Pick background pattern color.', 'themo')
                                        ));
                                        ?>

                                    </div>

                                    <?php

                                    if (!isset($_portfolio['pagetitle']['page_title_background']['pt_background_upload_image'])) {
                                        $_portfolio['pagetitle']['page_title_background']['pt_background_upload_image'] = '';
                                    }
                                    ideothemo_controls_html(array(
                                        'type' => 'attach-image',
                                        'name' => '_ideo_portfolio[pagetitle][page_title_background][pt_background_upload_image]',
                                        'id' => 'portfolio_pt_background_upload_image',
                                        'label' => esc_html__('UPLOAD FILE', 'themo'),
                                        'button_label' => esc_html__('UPLOAD', 'themo'),
                                        'value' => $_portfolio['pagetitle']['page_title_background']['pt_background_upload_image'],
                                        'description' => esc_html__('Upload image which will be set as a portfolio page title background. Only .jpg .png .bmp formats are allowed.', 'themo')
                                    ));

                                    if (!isset($_portfolio['pagetitle']['page_title_background']['pt_background_cover'])) {
                                        $_portfolio['pagetitle']['page_title_background']['pt_background_cover'] = 0;
                                    }
                                    ideothemo_controls_html(array(
                                        'type' => 'switcher',
                                        'name' => '_ideo_portfolio[pagetitle][page_title_background][pt_background_cover]',
                                        'id' => 'portfolio_pt_background_cover',
                                        'label' => esc_html__('100% BACKGROUND ', 'themo'),
                                        'class' => 'switcher',
                                        'value' => $_portfolio['pagetitle']['page_title_background']['pt_background_cover'],
                                        'options' => array(
                                            array(1, esc_html__('On', 'themo')),
                                            array(0, esc_html__('Off', 'themo')),
                                        ),
                                        'description' => esc_html__('Turn On this option to set -cover- property for background image size (it will be scale to be as large as possible so that the background area is completely covered by the background image). By default this option is turned Off, so background image size has set -auto- property (original width and height).', 'themo')
                                    ));

                                    if (!isset($_portfolio['pagetitle']['page_title_background']['pt_background_image_position'])) {
                                        $_portfolio['pagetitle']['page_title_background']['pt_background_image_position'] = '';
                                    }
                                    ideothemo_controls_html(array(
                                        'type' => 'selectmenu',
                                        'name' => '_ideo_portfolio[pagetitle][page_title_background][pt_background_image_position]',
                                        'id' => 'portfolio_pt_background_image_position',
                                        'label' => esc_html__('IMAGE POSITION', 'themo'),
                                        'value' => $_portfolio['pagetitle']['page_title_background']['pt_background_image_position'],
                                        'options' => array(
                                            array('left_top', esc_html__('Left top', 'themo')),
                                            array('center_top', esc_html__('Center top', 'themo')),
                                            array('right_top', esc_html__('Right top', 'themo')),
                                            array('left_center', esc_html__('Left center', 'themo')),
                                            array('center_center', esc_html__('Center center', 'themo')),
                                            array('right_center', esc_html__('Right center', 'themo')),
                                            array('left_bottom', esc_html__('Left bottom', 'themo')),
                                            array('center_bottom', esc_html__('Center bottom', 'themo')),
                                            array('right_bottom', esc_html__('Right bottom', 'themo')),
                                        ),
                                        'description' => esc_html__('Choose image position property to set the starting position of background image.', 'themo')
                                    ));

                                    if (!isset($_portfolio['pagetitle']['page_title_background']['pt_background_image_repeat'])) {
                                        $_portfolio['pagetitle']['page_title_background']['pt_background_image_repeat'] = '';
                                    }
                                    ideothemo_controls_html(array(
                                        'type' => 'selectmenu',
                                        'name' => '_ideo_portfolio[pagetitle][page_title_background][pt_background_image_repeat]',
                                        'id' => 'portfolio_pt_background_image_repeat',
                                        'label' => esc_html__('IMAGE REPEAT', 'themo'),
                                        'value' => $_portfolio['pagetitle']['page_title_background']['pt_background_image_repeat'],
                                        'options' => array(
                                            array('no_repeat', esc_html__('No repeat', 'themo')),
                                            array('repeat_x', esc_html__('Repeat X', 'themo')),
                                            array('repeat_y', esc_html__('Repeat Y', 'themo')),
                                            array('repeat', esc_html__('Repeat XY', 'themo')),
                                        ),
                                        'description' => esc_html__('Choose image repeat property to set if/how the background image it will be repeated.', 'themo')
                                    ));

                                    if (!isset($_portfolio['pagetitle']['page_title_background']['pt_background_motion'])) {
                                        $_portfolio['pagetitle']['page_title_background']['pt_background_motion'] = '';
                                    }
                                    ideothemo_controls_html(array(
                                        'type' => 'selectmenu',
                                        'name' => '_ideo_portfolio[pagetitle][page_title_background][pt_background_motion]',
                                        'id' => 'portfolio_pt_background_motion',
                                        'label' => esc_html__('BACKGROUND MOTION', 'themo'),
                                        'value' => $_portfolio['pagetitle']['page_title_background']['pt_background_motion'],
                                        'options' => array(
                                            array('scroll', esc_html__('Scroll', 'themo')),
                                            array('fixed', esc_html__('Fixed', 'themo')),
                                            array('parallax', esc_html__('Parallax', 'themo')),
                                        ),
                                        'description' => esc_html__('Choose between 3 types of background image motion: Scroll (the background image scrolls along with elements), Fixed (the background image is fixed with regard to the viewport) and Parallax (background image moves irrespectively of elements). If you choose Parallax type, Motion speed option will be loaded below so you can define precise speed of background motion.', 'themo')
                                    ));

                                    ?>

                                    <div class="ideo-section">
                                        <?php
                                        if (!isset($_portfolio['pagetitle']['page_title_background']['pt_background_moving_speed'])) {
                                            $_portfolio['pagetitle']['page_title_background']['pt_background_moving_speed'] = 0;
                                        }
                                        ideothemo_controls_html(array(
                                            'type' => 'textfield',
                                            'name' => '_ideo_portfolio[pagetitle][page_title_background][pt_background_moving_speed]',
                                            'id' => 'portfolio_pt_background_moving_speed',
                                            'label' => esc_html__('MOVING SPEED', 'themo'),
                                            'value' => $_portfolio['pagetitle']['page_title_background']['pt_background_moving_speed'],
                                            'description' => esc_html__('Define background image vertical motion speed in relation to scrolling speed. You can set values beetween -2 to 2. 0 value means that your background image will be moving the same speed as scroll.', 'themo')
                                        ));

                                        ?>
                                    </div>

                                    <?php


                                    if (!isset($_portfolio['pagetitle']['page_title_background']['pt_background_image_overlay'])) {
                                        $_portfolio['pagetitle']['page_title_background']['pt_background_image_overlay'] = '';
                                    }
                                    ideothemo_controls_html(array(
                                        'type' => 'selectmenu',
                                        'name' => '_ideo_portfolio[pagetitle][page_title_background][pt_background_image_overlay]',
                                        'id' => 'portfolio_pt_background_image_overlay',
                                        'label' => esc_html__('IMAGE OVERLAY', 'themo'),
                                        'value' => $_portfolio['pagetitle']['page_title_background']['pt_background_image_overlay'],
                                        'options' => array(
                                            array('none', esc_html__('None', 'themo')),
                                            array('color', esc_html__('Color', 'themo')),
                                            array('pattern', esc_html__('Pattern', 'themo')),
                                        ),
                                        'description' => esc_html__('Choose between Color or Pattern background image overlay or choose None if you do not need any background image overlay. Depending on which option you choose the several styling options will be available below.', 'themo')
                                    ));
                                    ?>

                                    <div class="ideo-section">

                                        <?php
                                        if (!isset($_portfolio['pagetitle']['page_title_background']['pt_background_image_overlay_color'])) {
                                            $_portfolio['pagetitle']['page_title_background']['pt_background_image_overlay_color'] = '';
                                        }
                                        ideothemo_controls_html(array(
                                            'type' => 'colorpicker',
                                            'name' => '_ideo_portfolio[pagetitle][page_title_background][pt_background_image_overlay_color]',
                                            'id' => 'portfolio_pt_background_image_overlay_color',
                                            'class' => 'colorpicker',
                                            'label' => esc_html__('OVERLAY COLOR', 'themo'),
                                            'value' => $_portfolio['pagetitle']['page_title_background']['pt_background_image_overlay_color'],
                                            'description' => esc_html__('Pick background image overlay color.', 'themo')
                                        ));

                                        if (!isset($_portfolio['pagetitle']['page_title_background']['pt_background_image_overlay_pattern'])) {
                                            $_portfolio['pagetitle']['page_title_background']['pt_background_image_overlay_pattern'] = '';
                                        }
                                        ideothemo_controls_html(array(
                                            'type' => 'selectmenu',
                                            'name' => '_ideo_portfolio[pagetitle][page_title_background][pt_background_image_overlay_pattern]',
                                            'id' => 'portfolio_pt_background_image_overlay_pattern',
                                            'label' => esc_html__('PATTERN', 'themo'),
                                            'value' => $_portfolio['pagetitle']['page_title_background']['pt_background_image_overlay_pattern'],
                                            'options' => array_flip(ideothemo_get_background_patterns(true)),
                                            'description' => esc_html__('Choose one of predefined pattern types.', 'themo')
                                        ));

                                        if (!isset($_portfolio['pagetitle']['page_title_background']['pt_background_image_overlay_pattern_color'])) {
                                            $_portfolio['pagetitle']['page_title_background']['pt_background_image_overlay_pattern_color'] = '';
                                        }
                                        ideothemo_controls_html(array(
                                            'type' => 'colorpicker',
                                            'name' => '_ideo_portfolio[pagetitle][page_title_background][pt_background_image_overlay_pattern_color]',
                                            'id' => 'portfolio_pt_background_image_overlay_pattern_color',
                                            'class' => 'colorpicker',
                                            'label' => esc_html__('PATTERN COLOR', 'themo'),
                                            'value' => $_portfolio['pagetitle']['page_title_background']['pt_background_image_overlay_pattern_color'],
                                            'description' => esc_html__('Pick background image pattern color.', 'themo')
                                        ));
                                        ?>

                                    </div>

                                    <?php
                                    if (!isset($_portfolio['pagetitle']['page_title_background']['pt_background_video_platform'])) {
                                        $_portfolio['pagetitle']['page_title_background']['pt_background_video_platform'] = '';
                                    }
                                    ideothemo_controls_html(array(
                                        'type' => 'selectmenu',
                                        'name' => '_ideo_portfolio[pagetitle][page_title_background][pt_background_video_platform]',
                                        'id' => 'portfolio_pt_background_video_platform',
                                        'label' => esc_html__('VIDEO PLATFORM', 'themo'),
                                        'value' => $_portfolio['pagetitle']['page_title_background']['pt_background_video_platform'],
                                        'options' => array(
                                            array('youtube', esc_html__('Youtube', 'themo')),
                                            array('self_hosted', esc_html__('Self hosted', 'themo')),
                                        ),
                                        'description' => esc_html__('Choose the hosting platform from which you want to upload background video. Depending on which option you choose appropriate options will be available below.', 'themo')
                                    ));
                                    ?>

                                    <div class="ideo-section">
                                        <?php
                                        if (!isset($_portfolio['pagetitle']['page_title_background']['pt_background_youtube'])) {
                                            $_portfolio['pagetitle']['page_title_background']['pt_background_youtube'] = '';
                                        }
                                        ideothemo_controls_html(array(
                                            'type' => 'textfield',
                                            'name' => '_ideo_portfolio[pagetitle][page_title_background][pt_background_youtube]',
                                            'id' => 'portfolio_pt_background_youtube',
                                            'class' => '',
                                            'label' => esc_html__('YOUTUBE VIDEO', 'themo'),
                                            'value' => $_portfolio['pagetitle']['page_title_background']['pt_background_youtube'],
                                            'placeholder' => esc_html__('youtube URL', 'themo'),
                                            'description' => esc_html__('Enter Youtube video link.', 'themo')
                                        ));

                                        if (!isset($_portfolio['pagetitle']['page_title_background']['pt_background_mp4'])) {
                                            $_portfolio['pagetitle']['page_title_background']['pt_background_mp4'] = '';
                                        }
                                        ideothemo_controls_html(array(
                                            'type' => 'textfield',
                                            'name' => '_ideo_portfolio[pagetitle][page_title_background][pt_background_mp4]',
                                            'id' => 'portfolio_pt_background_mp4',
                                            'class' => '',
                                            'label' => esc_html__('MP4 FORMAT', 'themo'),
                                            'value' => $_portfolio['pagetitle']['page_title_background']['pt_background_mp4'],
                                            'placeholder' => esc_html__('mp4 format URL', 'themo'),
                                            'description' => esc_html__('Enter link to MP4 video. It has to be direct link to the file - it should have .mp4 extension at the end of the link. Notice, that if you are using selfhosted video you should also add WebM video to have guarantee that your video will be displayed on every browser.', 'themo')
                                        ));

                                        if (!isset($_portfolio['pagetitle']['page_title_background']['pt_background_webm'])) {
                                            $_portfolio['pagetitle']['page_title_background']['pt_background_webm'] = '';
                                        }
                                        ideothemo_controls_html(array(
                                            'type' => 'textfield',
                                            'name' => '_ideo_portfolio[pagetitle][page_title_background][pt_background_webm]',
                                            'id' => 'portfolio_pt_background_webm',
                                            'class' => '',
                                            'label' => esc_html__('WEBM FORMAT', 'themo'),
                                            'value' => $_portfolio['pagetitle']['page_title_background']['pt_background_webm'],
                                            'placeholder' => esc_html__('webM format URL', 'themo'),
                                            'description' => esc_html__('Enter link to WebM video. It has to be direct link to the file - it should have .webm extension at the end of the link. Notice, that if you are using selfhosted video you should also add MP4 video to have guarantee that your video will be displayed on every browser.', 'themo')
                                        ));
                                        ?>
                                    </div>

                                    <?php
                                    if (!isset($_portfolio['pagetitle']['page_title_background']['pt_background_fallback_image'])) {
                                        $_portfolio['pagetitle']['page_title_background']['pt_background_fallback_image'] = '';
                                    }
                                    ideothemo_controls_html(array(
                                        'type' => 'attach-image',
                                        'name' => '_ideo_portfolio[pagetitle][page_title_background][pt_background_fallback_image]',
                                        'id' => 'portfolio_pt_background_fallback_image',
                                        'label' => esc_html__('MOBILE FALLBACK IMAGE', 'themo'),
                                        'button_label' => esc_html__('UPLOAD', 'themo'),
                                        'value' => $_portfolio['pagetitle']['page_title_background']['pt_background_fallback_image'],
                                        'description' => esc_html__('Upload fallback image which will be display on mobile devices instead of video. Fallback image will be also displayed on desktop devices until your video will load. Only .jpg .png .bmp image formats are allowed.', 'themo')
                                    ));

                                    if (!isset($_portfolio['pagetitle']['page_title_background']['pt_background_video_overlay'])) {
                                        $_portfolio['pagetitle']['page_title_background']['pt_background_video_overlay'] = '';
                                    }
                                    ideothemo_controls_html(array(
                                        'type' => 'selectmenu',
                                        'name' => '_ideo_portfolio[pagetitle][page_title_background][pt_background_video_overlay]',
                                        'id' => 'portfolio_pt_background_image_overlay',
                                        'label' => esc_html__('VIDEO OVERLAY', 'themo'),
                                        'value' => $_portfolio['pagetitle']['page_title_background']['pt_background_video_overlay'],
                                        'options' => array(
                                            array('none', esc_html__('None', 'themo')),
                                            array('color', esc_html__('Color', 'themo')),
                                            array('pattern', esc_html__('Pattern', 'themo')),
                                        ),
                                        'description' => esc_html__('Choose between Color or Pattern background video overlay or choose None if you do not need any background video overlay. Depending on which option you choose the several styling options will be available below.', 'themo')
                                    ));
                                    ?>

                                    <div class="ideo-section">
                                        <?php
                                        if (!isset($_portfolio['pagetitle']['page_title_background']['pt_background_video_overlay_color'])) {
                                            $_portfolio['pagetitle']['page_title_background']['pt_background_video_overlay_color'] = '';
                                        }
                                        ideothemo_controls_html(array(
                                            'type' => 'colorpicker',
                                            'name' => '_ideo_portfolio[pagetitle][page_title_background][pt_background_video_overlay_color]',
                                            'id' => 'portfolio_pt_background_video_overlay',
                                            'class' => 'colorpicker',
                                            'label' => esc_html__('OVERLAY COLOR', 'themo'),
                                            'value' => $_portfolio['pagetitle']['page_title_background']['pt_background_video_overlay_color'],
                                            'description' => esc_html__('Pick background video overlay color.', 'themo')
                                        ));

                                        if (!isset($_portfolio['pagetitle']['page_title_background']['pt_background_video_overlay_pattern'])) {
                                            $_portfolio['pagetitle']['page_title_background']['pt_background_video_overlay_pattern'] = '';
                                        }
                                        ideothemo_controls_html(array(
                                            'type' => 'selectmenu',
                                            'name' => '_ideo_portfolio[pagetitle][page_title_background][pt_background_video_overlay_pattern]',
                                            'id' => 'portfolio_pt_background_video_overlay_pattern',
                                            'label' => esc_html__('PATTERN', 'themo'),
                                            'value' => $_portfolio['pagetitle']['page_title_background']['pt_background_video_overlay_pattern'],
                                            'options' => array_flip(ideothemo_get_background_patterns(true)),
                                            'description' => esc_html__('Choose one of predefined pattern types.', 'themo')
                                        ));

                                        if (!isset($_portfolio['pagetitle']['page_title_background']['pt_background_video_overlay_pattern_color'])) {
                                            $_portfolio['pagetitle']['page_title_background']['pt_background_video_overlay_pattern_color'] = '';
                                        }
                                        ideothemo_controls_html(array(
                                            'type' => 'colorpicker',
                                            'name' => '_ideo_portfolio[pagetitle][page_title_background][pt_background_video_overlay_pattern_color]',
                                            'id' => 'portfolio_pt_background_image_overlay_pattern_color',
                                            'class' => 'colorpicker',
                                            'label' => esc_html__('PATTERN COLOR', 'themo'),
                                            'value' => $_portfolio['pagetitle']['page_title_background']['pt_background_video_overlay_pattern_color'],
                                            'placeholder' => esc_html__('kolorpicker', 'themo'),
                                            'description' => esc_html__('Pick color for background video pattern.', 'themo')
                                        ));
                                        ?>
                                    </div>

                                </div>

                                <?php
                                if (!isset($_portfolio['pagetitle']['page_title_settings']['page_title_area_content_align'])) {
                                    $_portfolio['pagetitle']['page_title_settings']['page_title_area_content_align'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'selectmenu',
                                    'name' => '_ideo_portfolio[pagetitle][page_title_settings][page_title_area_content_align]',
                                    'id' => 'portfolio_page_title_area_content_align',
                                    'label' => esc_html__('CONTENT ALIGN', 'themo'),
                                    'value' => $_portfolio['pagetitle']['page_title_settings']['page_title_area_content_align'],
                                    'options' => array(
                                        array('', esc_html__('Default', 'themo')),
                                        array('left', esc_html__('Left', 'themo')),
                                        array('center', esc_html__('Center', 'themo')),
                                        array('right', esc_html__('Right', 'themo')),
                                    ),
                                    'description' => esc_html__('Justify content elements (title and subtitle) to the Left, Center or Right side of page title area. Choose DEFAULT to use Customizer setting.', 'themo')
                                ));

                                if (!isset($_portfolio['pagetitle']['page_title_background']['pt_background_parallax'])) {
                                    $_portfolio['pagetitle']['page_title_background']['pt_background_parallax'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'selectmenu',
                                    'name' => '_ideo_portfolio[pagetitle][page_title_background][pt_background_parallax]',
                                    'id' => 'portfolio_pt_background_parallax',
                                    'label' => esc_html__('PAGE TITLE PARALLAX EFFECT', 'themo'),
                                    'value' => $_portfolio['pagetitle']['page_title_background']['pt_background_parallax'],
                                    'options' => array(
                                        array('', esc_html__('Default', 'themo')),
                                        array('on', esc_html__('Yes', 'themo')),
                                        array('off', esc_html__('No', 'themo')),
                                    ),
                                    'description' => esc_html__('Page title parallax effect is a additional effect which override Background motion setting. When it is turned ON content (page title and subtitle) moves irrespectively of background and gets additional fade-out animation.', 'themo')
                                ));

                                if (!isset($_portfolio['pagetitle']['page_title_fonts']['pt_title_font_size'])) {
                                    $_portfolio['pagetitle']['page_title_fonts']['pt_title_font_size'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'textfield',
                                    'name' => '_ideo_portfolio[pagetitle][page_title_fonts][pt_title_font_size]',
                                    'id' => 'portfolio_pt_title_font_size',
                                    'class' => '',
                                    'label' => esc_html__('TITLE FONT SIZE', 'themo'),
                                    'value' => $_portfolio['pagetitle']['page_title_fonts']['pt_title_font_size'],
                                    'placeholder' => esc_html__('enter Title font size', 'themo'),
                                ));

                                if (!isset($_portfolio['pagetitle']['page_title_coloring']['pt_title_color'])) {
                                    $_portfolio['pagetitle']['page_title_coloring']['pt_title_color'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'colorpicker',
                                    'name' => '_ideo_portfolio[pagetitle][page_title_coloring][pt_title_color]',
                                    'id' => 'portfolio_pt_title_color',
                                    'class' => 'colorpicker',
                                    'label' => esc_html__('TITLE FONT COLOR', 'themo'),
                                    'value' => $_portfolio['pagetitle']['page_title_coloring']['pt_title_color'],
                                    'placeholder' => esc_html__('color', 'themo'),
                                ));

                                if (!isset($_portfolio['pagetitle']['page_title_fonts']['pt_subtitle_font_size'])) {
                                    $_portfolio['pagetitle']['page_title_fonts']['pt_subtitle_font_size'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'textfield',
                                    'name' => '_ideo_portfolio[pagetitle][page_title_fonts][pt_subtitle_font_size]',
                                    'id' => 'portfolio_pt_subtitle_font_size',
                                    'class' => '',
                                    'label' => esc_html__('SUBTITLE FONT SIZE', 'themo'),
                                    'value' => $_portfolio['pagetitle']['page_title_fonts']['pt_subtitle_font_size'],
                                    'placeholder' => esc_html__('enter Subtitle font size', 'themo'),
                                ));

                                if (!isset($_portfolio['pagetitle']['page_title_coloring']['pt_subtitle_color'])) {
                                    $_portfolio['pagetitle']['page_title_coloring']['pt_subtitle_color'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'colorpicker',
                                    'name' => '_ideo_portfolio[pagetitle][page_title_coloring][pt_subtitle_color]',
                                    'id' => 'portfolio_pt_subtitle_color',
                                    'class' => 'colorpicker',
                                    'label' => esc_html__('SUBTITLE FONT COLOR', 'themo'),
                                    'value' => $_portfolio['pagetitle']['page_title_coloring']['pt_subtitle_color'],
                                    'placeholder' => esc_html__('color', 'themo'),
                                ));


                                if (!isset($_portfolio['parametrs_font_size'])) {
                                    $_portfolio['parametrs_font_size'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'textfield',
                                    'name' => '_ideo_portfolio[parametrs_font_size]',
                                    'id' => 'portfolio_parametrs_font_size',
                                    'class' => '',
                                    'label' => esc_html__('PARAMETER LABEL & VALUE FONT SIZE (px)', 'themo'),
                                    'value' => $_portfolio['parametrs_font_size'],
                                    'placeholder' => esc_html__('Enter value in px', 'themo'),
                                ));

                                if (!isset($_portfolio['parametrs_label_color'])) {
                                    $_portfolio['parametrs_label_color'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'colorpicker',
                                    'name' => '_ideo_portfolio[parametrs_label_color]',
                                    'id' => 'portfolio_parametrs_label_color',
                                    'class' => 'colorpicker',
                                    'label' => esc_html__('PARAMETER LABEL COLOR', 'themo'),
                                    'value' => $_portfolio['parametrs_label_color'],
                                    'placeholder' => esc_html__('enter Page Title height in px', 'themo'),
                                ));

                                if (!isset($_portfolio['parametrs_value_color'])) {
                                    $_portfolio['parametrs_value_color'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'colorpicker',
                                    'name' => '_ideo_portfolio[parametrs_value_color]',
                                    'id' => 'portfolio_parametrs_value_color',
                                    'class' => 'colorpicker',
                                    'label' => esc_html__('PARAMETER VALUE COLOR', 'themo'),
                                    'value' => $_portfolio['parametrs_value_color'],
                                    'placeholder' => esc_html__('enter Page Title height in px', 'themo'),
                                ));

                                if (!isset($_portfolio['pagetitle']['page_title_coloring']['pt_b_text_color'])) {
                                    $_portfolio['pagetitle']['page_title_coloring']['pt_b_text_color'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'colorpicker',
                                    'name' => '_ideo_portfolio[pagetitle][page_title_coloring][pt_b_text_color]',
                                    'id' => 'portfolio_pt_b_text_color',
                                    'class' => 'colorpicker',
                                    'label' => esc_html__('BREADCRUMBS TEXT COLOR', 'themo'),
                                    'value' => $_portfolio['pagetitle']['page_title_coloring']['pt_b_text_color'],
                                    'placeholder' => esc_html__('color', 'themo'),
                                ));

                                if (!isset($_portfolio['pagetitle']['page_title_coloring']['pt_b_text_accent_color'])) {
                                    $_portfolio['pagetitle']['page_title_coloring']['pt_b_text_accent_color'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'colorpicker',
                                    'name' => '_ideo_portfolio[pagetitle][page_title_coloring][pt_b_text_accent_color]',
                                    'id' => 'portfolio_pt_b_text_accent_color',
                                    'class' => 'colorpicker',
                                    'label' => esc_html__('BREADCRUMBS TEXT ACCENT COLOR', 'themo'),
                                    'value' => $_portfolio['pagetitle']['page_title_coloring']['pt_b_text_accent_color'],
                                    'placeholder' => esc_html__('color', 'themo'),
                                ));

                                if (!isset($_portfolio['pagetitle']['page_title_coloring']['pt_b_background_color'])) {
                                    $_portfolio['pagetitle']['page_title_coloring']['pt_b_background_color'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'colorpicker',
                                    'name' => '_ideo_portfolio[pagetitle][page_title_coloring][pt_b_background_color]',
                                    'id' => 'portfolio_pt_b_background_color',
                                    'class' => 'colorpicker',
                                    'label' => esc_html__('BREADCRUMBS BACKGROUND COLOR', 'themo'),
                                    'value' => $_portfolio['pagetitle']['page_title_coloring']['pt_b_background_color'],
                                    'placeholder' => esc_html__('color', 'themo'),
                                ));


                                if (!isset($_portfolio['pagetitle']['page_title_coloring']['pt_b_border_color'])) {
                                    $_portfolio['pagetitle']['page_title_coloring']['pt_b_border_color'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'colorpicker',
                                    'name' => '_ideo_portfolio[pagetitle][page_title_coloring][pt_b_border_color]',
                                    'id' => 'portfolio_pt_b_border_color',
                                    'class' => 'colorpicker',
                                    'label' => esc_html__('BREADCRUMBS TOP BORDER COLOR', 'themo'),
                                    'value' => $_portfolio['pagetitle']['page_title_coloring']['pt_b_border_color'],

                                ));

                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="tab-footer" class="tab-content">
                <div class="ideo-section">
                    <div class="ideo-info">
                        <h5><?php esc_html_e('Info:', 'themo'); ?></h5>
                        <p><?php echo wp_kses(__('In this section you customize footer for particular single portfolio page. Default Footer settings are taken from Customizer settings (from FOOTER section). THEMO allows you to create totally different footers for different portfolio pages. You can override Footer options for this particular single portfolio page in Portfolio options but if you change your mind you can return to default Customizer settings simply choosing Default settings in dropdowns and leaving empty fields.', 'themo'),  IDEOTHEMO_KSES_TAGS::allow()); ?></p>
                    </div>
                    <?php
                    if (!isset($_portfolio['footer']['footer_settings']['footer_on'])) {
                        $_portfolio['footer']['footer_settings']['footer_on'] = '';
                    }
                    ideothemo_controls_html(array(
                        'type' => 'selectmenu',
                        'name' => '_ideo_portfolio[footer][footer_settings][footer_on]',
                        'id' => 'portfolio_footer_on',
                        'label' => esc_html__('FOOTER', 'themo'),
                        'value' => $_portfolio['footer']['footer_settings']['footer_on'],
                        'options' => array(
                            array('', esc_html__('Default', 'themo')),
                            array('yes', esc_html__('Yes', 'themo')),
                            array('no', esc_html__('No', 'themo')),
                        ),
                        'description' => esc_html__('You can turn On (Yes) or Off (NO) Footer on this portfolio page. Choose DEAFAULT to use Customizer setting.', 'themo')
                    ));

                    if (!isset($_portfolio['footer']['footer_settings']['footer_type'])) {
                        $_portfolio['footer']['footer_settings']['footer_type'] = '';
                    }
                    ideothemo_controls_html(array(
                        'type' => 'selectmenu',
                        'name' => '_ideo_portfolio[footer][footer_settings][footer_type]',
                        'id' => 'portfolio_footer_type',
                        'label' => esc_html__('FOOTER TYPE', 'themo'),
                        'value' => $_portfolio['footer']['footer_settings']['footer_type'],
                        'options' => array(
                            array('', esc_html__('Default', 'themo')),
                            array('standard', esc_html__('Standard', 'themo')),
                            array('advanced', esc_html__('Advanced', 'themo')),

                        ),
                        'description' => esc_html__('Choose footer type for this portfolio page or choose Default to use Customizer setting. If you choose Standard footer use options available in sections below to customize its appearance. If you choose Advanced footer, simply choose one of Advanced footers you have created.', 'themo')
                    ));
                    ?>

                    <div class="ideo-section">
                        <?php
                        if (!isset($_portfolio['footer']['footer_settings']['choose_advanced_footer'])) {
                            $_portfolio['footer']['footer_settings']['choose_advanced_footer'] = '';
                        }
                        ideothemo_controls_html(array(
                            'type' => 'selectmenu',
                            'name' => '_ideo_portfolio[footer][footer_settings][choose_advanced_footer]',
                            'id' => 'portfolio_choose_advanced_footer',
                            'label' => esc_html__('CHOOSE ADVANCED FOOTER', 'themo'),
                            'value' => $_portfolio['footer']['footer_settings']['choose_advanced_footer'],
                            'options' => ideothemo_get_footers(),
                            'description' => esc_html__('Choose one of Advanced footer you have created.', 'themo')
                        ));
                        ?>
                    </div>

                    <?php
                    if (!isset($_portfolio['footer']['footer_settings']['standard_footer_skin'])) {
                        $_portfolio['footer']['footer_settings']['standard_footer_skin'] = '';
                    }
                    ideothemo_controls_html(array(
                        'type' => 'selectmenu',
                        'name' => '_ideo_portfolio[footer][footer_settings][standard_footer_skin]',
                        'id' => 'portfolio_standard_footer_skin',
                        'label' => esc_html__('STANDARD FOOTER SKIN ', 'themo'),
                        'value' => $_portfolio['footer']['footer_settings']['standard_footer_skin'],
                        'options' => array(
                            array('', esc_html__('Default', 'themo')),
                            array('light', esc_html__('Light', 'themo')),
                            array('dark', esc_html__('Dark', 'themo')),

                        ),
                        'description' => esc_html__('Choose Light or Dark skin for Standard footer on this portfolio page or choose Default to use Customizer setting. Light skin means light content (fonts) and Dark skin means dark content (fonts).', 'themo')
                    ));

                    if (!isset($_portfolio['footer']['standard_footer_coloring']['footer_light_accent_color'])) {
                        $_portfolio['footer']['standard_footer_coloring']['footer_light_accent_color'] = '';
                    }
                    ideothemo_controls_html(array(
                        'type' => 'colorpicker',
                        'name' => '_ideo_portfolio[footer][standard_footer_coloring][footer_light_accent_color]',
                        'id' => 'portfolio_footer_light_accent_color',
                        'class' => 'colorpicker',
                        'label' => esc_html__('ACCENT COLOR', 'themo'),
                        'value' => $_portfolio['footer']['standard_footer_coloring']['footer_light_accent_color'],
                        'description' => esc_html__('Pick footer accent color or leave empty to use Customizer setting.', 'themo')
                    ));

                    if (!isset($_portfolio['footer']['standard_footer_coloring']['footer_light_widgets_title_color'])) {
                        $_portfolio['footer']['standard_footer_coloring']['footer_light_widgets_title_color'] = '';
                    }
                    ideothemo_controls_html(array(
                        'type' => 'colorpicker',
                        'name' => '_ideo_portfolio[footer][standard_footer_coloring][footer_light_widgets_title_color]',
                        'id' => 'portfolio_footer_light_widgets_title_color',
                        'class' => 'colorpicker',
                        'label' => esc_html__('TITLES COLOR', 'themo'),
                        'value' => $_portfolio['footer']['standard_footer_coloring']['footer_light_widgets_title_color'],
                        'description' => esc_html__('Pick widgets titles color or leave empty to use Customizer setting.', 'themo')
                    ));

                    if (!isset($_portfolio['footer']['standard_footer_coloring']['footer_light_widgets_text_color'])) {
                        $_portfolio['footer']['standard_footer_coloring']['footer_light_widgets_text_color'] = '';
                    }
                    ideothemo_controls_html(array(
                        'type' => 'colorpicker',
                        'name' => '_ideo_portfolio[footer][standard_footer_coloring][footer_light_widgets_text_color]',
                        'id' => 'portfolio_footer_light_widgets_text_color',
                        'class' => 'colorpicker',
                        'label' => esc_html__('TEXT COLOR', 'themo'),
                        'value' => $_portfolio['footer']['standard_footer_coloring']['footer_light_widgets_text_color'],
                        'description' => esc_html__('Pick text color or leave empty to use Customizer setting.', 'themo')
                    ));
                    ?>

                </div>
                <div class="ideo-accordions">
                    <div class="ideo-accordions-section">
                        <h4 class="ideo-accordions-title"><?php esc_html_e('STANDARD FOOTER BACKGROUND', 'themo'); ?></h4>
                        <div class="ideo-accordions-content">
                            <div class="ideo-section">
                                <?php
                                if (!isset($_portfolio['footer']['standard_footer_background']['footer_background_type'])) {
                                    $_portfolio['footer']['background']['footer_background_type'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'selectmenu',
                                    'name' => '_ideo_portfolio[footer][standard_footer_background][footer_background_type]',
                                    'id' => 'portfolio_standard_footer_background',
                                    'label' => esc_html__('FOOTER BACKGROUND TYPE', 'themo'),
                                    'value' => $_portfolio['footer']['standard_footer_background']['footer_background_type'],
                                    'options' => array(
                                        array('', esc_html__('Default', 'themo')),
                                        array('color', esc_html__('Color', 'themo')),
                                        array('image', esc_html__('Image', 'themo')),
                                    ),
                                    'description' => esc_html__('Choose Color or Image background type for footer area or choose Default to use Customizer setting. Depending on which option you choose appropriate options will be available below.', 'themo')
                                ));
                                ?>

                                <div class="ideo-section"> <!--color-->
                                    <?php
                                    if (!isset($_portfolio['footer']['standard_footer_background']['footer_background_color'])) {
                                        $_portfolio['footer']['standard_footer_background']['footer_background_color'] = '';
                                    }
                                    ideothemo_controls_html(array(
                                        'type' => 'colorpicker',
                                        'name' => '_ideo_portfolio[footer][standard_footer_background][footer_background_color]',
                                        'id' => 'portfolio_footer_background_color',
                                        'class' => 'colorpicker',
                                        'label' => esc_html__('BACKGROUND COLOR', 'themo'),
                                        'value' => $_portfolio['footer']['standard_footer_background']['footer_background_color'],
                                        'description' => esc_html__('Pick Footer background color or leave empty to use Customizer setting.', 'themo')
                                    ));

                                    if (!isset($_portfolio['footer']['standard_footer_background']['footer_background_color_overlay'])) {
                                        $_portfolio['footer']['standard_footer_background']['footer_background_color_overlay'] = '';
                                    }
                                    ideothemo_controls_html(array(
                                        'type' => 'selectmenu',
                                        'name' => '_ideo_portfolio[footer][standard_footer_background][footer_background_color_overlay]',
                                        'id' => '`footer_footer_background_color_overlay',
                                        'label' => esc_html__('BACKGROUND OVERLAY', 'themo'),
                                        'value' => $_portfolio['footer']['standard_footer_background']['footer_background_color_overlay'],
                                        'options' => array(
                                            array('none', esc_html__('None', 'themo')),
                                            array('color', esc_html__('Color', 'themo')),
                                            array('pattern', esc_html__('Pattern', 'themo')),
                                        ),
                                        'description' => esc_html__('Choose between Color or Pattern background overlay type or choose None if you do not need any background overlay. Depending on which option you choose additional options will be available below.', 'themo')
                                    ));
                                    ?>

                                    <div class="ideo-section">
                                        <?php
                                        if (!isset($_portfolio['footer']['standard_footer_background']['footer_background_color_overlay_color'])) {
                                            $_portfolio['footer']['standard_footer_background']['footer_background_color_overlay_color'] = '';
                                        }
                                        ideothemo_controls_html(array(
                                            'type' => 'colorpicker',
                                            'name' => '_ideo_portfolio[footer][standard_footer_background][footer_background_color_overlay_color]',
                                            'id' => 'portfolio_footer_background_color_overlay_color',
                                            'class' => 'colorpicker',
                                            'label' => esc_html__('OVERLAY COLOR', 'themo'),
                                            'value' => $_portfolio['footer']['standard_footer_background']['footer_background_color_overlay_color'],
                                            'description' => esc_html__('Pick overlay color for background or leave empty to use Customizer setting.', 'themo')
                                        ));

                                        if (!isset($_portfolio['footer']['standard_footer_background']['footer_background_color_pattern'])) {
                                            $_portfolio['footer']['standard_footer_background']['footer_background_color_pattern'] = '';
                                        }
                                        ideothemo_controls_html(array(
                                            'type' => 'selectmenu',
                                            'name' => '_ideo_portfolio[footer][standard_footer_background][footer_background_color_pattern]',
                                            'id' => 'portfolio_footer_background_color_pattern',
                                            'label' => esc_html__('PATTERN', 'themo'),
                                            'value' => $_portfolio['footer']['standard_footer_background']['footer_background_color_pattern'],
                                            'options' => array_flip(ideothemo_get_background_patterns(true)),
                                            'description' => esc_html__('Choose one of predefined pattern types', 'themo')
                                        ));

                                        if (!isset($_portfolio['footer']['standard_footer_background']['footer_background_color_pattern_color'])) {
                                            $_portfolio['footer']['standard_footer_background']['footer_background_color_pattern_color'] = '';
                                        }
                                        ideothemo_controls_html(array(
                                            'type' => 'colorpicker',
                                            'name' => '_ideo_portfolio[footer][standard_footer_background][footer_background_color_pattern_color]',
                                            'id' => 'portfolio_footer_background_color_pattern_color',
                                            'class' => 'colorpicker',
                                            'label' => esc_html__('PATTERN COLOR', 'themo'),
                                            'value' => $_portfolio['footer']['standard_footer_background']['footer_background_color_pattern_color'],
                                            'description' => esc_html__('Pick background pattern color.', 'themo')
                                        ));
                                        ?>
                                    </div>

                                </div>

                                <?php
                                if (!isset($_portfolio['footer']['standard_footer_background']['footer_background_upload_image'])) {
                                    $_portfolio['footer']['standard_footer_background']['footer_background_upload_image'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'attach-image',
                                    'name' => '_ideo_portfolio[footer][standard_footer_background][footer_background_upload_image]',
                                    'id' => 'portfolio_footer_background_upload_image',
                                    'label' => esc_html__('UPLOAD FILE', 'themo'),
                                    'button_label' => esc_html__('UPLOAD', 'themo'),
                                    'value' => $_portfolio['footer']['standard_footer_background']['footer_background_upload_image'],
                                    'description' => esc_html__('Upload image which will be set as a footer background. Only .jpg .png .bmp formats are allowed.', 'themo')
                                ));

                                if (!isset($_portfolio['footer']['standard_footer_background']['footer_background_cover'])) {
                                    $_portfolio['footer']['standard_footer_background']['footer_background_cover'] = 0;
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'switcher',
                                    'name' => '_ideo_portfolio[footer][standard_footer_background][footer_background_cover]',
                                    'id' => 'portfolio_footer_background_cover',
                                    'label' => esc_html__('100% BACKGROUND ', 'themo'),
                                    'class' => 'switcher',
                                    'value' => $_portfolio['footer']['standard_footer_background']['footer_background_cover'],
                                    'options' => array(
                                        array(1, esc_html__('On', 'themo')),
                                        array(0, esc_html__('Off', 'themo')),
                                    ),
                                    'description' => esc_html__('Turn On this option to set -cover- property for background image size (it will be scale to be as large as possible so that the background area is completely covered by the background image). By default this option is turned Off, so background image size has set -auto- property (original width and height).', 'themo')
                                ));

                                if (!isset($_portfolio['footer']['standard_footer_background']['footer_background_image_position'])) {
                                    $_portfolio['footer']['standard_footer_background']['footer_background_image_position'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'selectmenu',
                                    'name' => '_ideo_portfolio[footer][standard_footer_background][footer_background_image_position]',
                                    'id' => 'portfolio_footer_background_image_position',
                                    'label' => esc_html__('IMAGE POSITION', 'themo'),
                                    'value' => $_portfolio['footer']['standard_footer_background']['footer_background_image_position'],
                                    'options' => array(
                                        array('left_top', esc_html__('Left top', 'themo')),
                                        array('center_top', esc_html__('Center top', 'themo')),
                                        array('right_top', esc_html__('Right top', 'themo')),
                                        array('left_center', esc_html__('Left center', 'themo')),
                                        array('center_center', esc_html__('Center center', 'themo')),
                                        array('right_center', esc_html__('Right center', 'themo')),
                                        array('left_bottom', esc_html__('Left bottom', 'themo')),
                                        array('center_bottom', esc_html__('Center bottom', 'themo')),
                                        array('right_bottom', esc_html__('Right bottom', 'themo')),
                                    ),
                                    'description' => esc_html__('Choose image position property to set the starting position of background image.', 'themo')
                                ));

                                if (!isset($_portfolio['footer']['standard_footer_background']['footer_background_image_repeat'])) {
                                    $_portfolio['footer']['standard_footer_background']['footer_background_image_repeat'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'selectmenu',
                                    'name' => '_ideo_portfolio[footer][standard_footer_background][footer_background_image_repeat]',
                                    'id' => 'portfolio_footer_background_image_repeat',
                                    'label' => esc_html__('IMAGE REPEAT', 'themo'),
                                    'value' => $_portfolio['footer']['standard_footer_background']['footer_background_image_repeat'],
                                    'options' => array(
                                        array('no_repeat', esc_html__('No repeat', 'themo')),
                                        array('repeat_x', esc_html__('Repeat X', 'themo')),
                                        array('repeat_y', esc_html__('Repeat Y', 'themo')),
                                        array('repeat', esc_html__('Repeat XY', 'themo')),
                                    ),
                                    'description' => esc_html__('Choose image repeat property to set if/how the background image it will be repeated.', 'themo')
                                ));

                                if (!isset($_portfolio['footer']['standard_footer_background']['footer_background_image_overlay'])) {
                                    $_portfolio['footer']['standard_footer_background']['footer_background_image_overlay'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'selectmenu',
                                    'name' => '_ideo_portfolio[footer][standard_footer_background][footer_background_image_overlay]',
                                    'id' => 'portfolio_footer_background_image_overlay',
                                    'label' => esc_html__('IMAGE OVERLAY', 'themo'),
                                    'value' => $_portfolio['footer']['standard_footer_background']['footer_background_image_overlay'],
                                    'options' => array(
                                        array('none', esc_html__('None', 'themo')),
                                        array('color', esc_html__('Color', 'themo')),
                                        array('pattern', esc_html__('Pattern', 'themo')),
                                    ),
                                    'description' => esc_html__('Choose between Color or Pattern background overlay type or choose None if you do not need any background overlay. Depending on which option you choose additional options will be available below.', 'themo')
                                ));
                                ?>

                                <div class="ideo-section">
                                    <?php
                                    if (!isset($_portfolio['footer']['standard_footer_background']['footer_background_image_overlay_color'])) {
                                        $_portfolio['footer']['standard_footer_background']['footer_background_image_overlay_color'] = '';
                                    }
                                    ideothemo_controls_html(array(
                                        'type' => 'colorpicker',
                                        'name' => '_ideo_portfolio[footer][standard_footer_background][footer_background_image_overlay_color]',
                                        'id' => 'portfolio_footer_background_image_overlay_color',
                                        'class' => 'colorpicker',
                                        'label' => esc_html__('OVERLAY COLOR', 'themo'),
                                        'value' => $_portfolio['footer']['standard_footer_background']['footer_background_image_overlay_color'],
                                        'description' => esc_html__('Pick background image overlay color.', 'themo')
                                    ));

                                    if (!isset($_portfolio['footer']['standard_footer_background']['footer_background_image_overlay_pattern'])) {
                                        $_portfolio['footer']['standard_footer_background']['footer_background_image_overlay_pattern'] = '';
                                    }
                                    ideothemo_controls_html(array(
                                        'type' => 'selectmenu',
                                        'name' => '_ideo_portfolio[footer][standard_footer_background][footer_background_image_overlay_pattern]',
                                        'id' => 'portfolio_footer_background_image_overlay_pattern',
                                        'label' => esc_html__('PATTERN', 'themo'),
                                        'value' => $_portfolio['footer']['standard_footer_background']['footer_background_image_overlay_pattern'],
                                        'options' => array_flip(ideothemo_get_background_patterns(true)),
                                        'description' => esc_html__('Choose one of predefined pattern types.', 'themo')
                                    ));

                                    if (!isset($_portfolio['footer']['standard_footer_background']['footer_background_image_overlay_pattern_color'])) {
                                        $_portfolio['footer']['standard_footer_background']['footer_background_image_overlay_pattern_color'] = '';
                                    }
                                    ideothemo_controls_html(array(
                                        'type' => 'colorpicker',
                                        'name' => '_ideo_portfolio[footer][standard_footer_background][footer_background_image_overlay_pattern_color]',
                                        'id' => 'portfolio_footer_background_image_overlay_pattern_color',
                                        'class' => 'colorpicker',
                                        'label' => esc_html__('PATTERN COLOR', 'themo'),
                                        'value' => $_portfolio['footer']['standard_footer_background']['footer_background_image_overlay_pattern_color'],
                                        'description' => esc_html__('Pick background image pattern color.', 'themo')
                                    ));
                                    ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="ideo-accordions">
                    <div class="ideo-accordions-section">
                        <h4 class="ideo-accordions-title"><?php esc_html_e('COPYRIGHT', 'themo'); ?></h4>
                        <div class="ideo-accordions-content">
                            <div class="ideo-section">
                                <?php
                                if (!isset($_portfolio['footer']['footer_settings']['copywrite_area_on'])) {
                                    $_portfolio['footer']['footer_settings']['copywrite_area_on'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'selectmenu',
                                    'name' => '_ideo_portfolio[footer][footer_settings][copywrite_area_on]',
                                    'id' => 'portfolio_copywrite_area_on',
                                    'label' => esc_html__('COPYRIGHT AREA ', 'themo'),
                                    'value' => wp_kses($_portfolio['footer']['footer_settings']['copyright_text'],  IDEOTHEMO_KSES_TAGS::allow()),
                                    'options' => array(
                                        array('', esc_html__('Default', 'themo')),
                                        array('yes', esc_html__('Yes', 'themo')),
                                        array('no', esc_html__('No', 'themo')),
                                    ),
                                    'description' => esc_html__('You can turn On (YES) or Off (NO) Copyright area on this portfolio page. Choose DEAFAULT to use Customizer setting.', 'themo')
                                ));

                                if (!isset($_portfolio['footer']['footer_settings']['copyright_text'])) {
                                    $_portfolio['footer']['footer_settings']['copyright_text'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'textfield',
                                    'name' => '_ideo_portfolio[footer][footer_settings][copyright_text]',
                                    'id' => 'portfolio_copyright_text',
                                    'class' => '',
                                    'label' => esc_html__('COPYRIGHT TEXT', 'themo'),
                                    'value' => $_portfolio['footer']['footer_settings']['copyright_text'],
                                    'placeholder' => esc_html__('enter copyright text', 'themo'),
                                    'description' => esc_html__('Enter copyright text or leave empty to use text entered in Customizer.', 'themo')
                                ));

                                if (!isset($_portfolio['footer']['footer_settings']['copyright_skin'])) {
                                    $_portfolio['footer']['footer_settings']['copyright_skin'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'selectmenu',
                                    'name' => '_ideo_portfolio[footer][footer_settings][copyright_skin]',
                                    'id' => 'portfolio_copyright_skin',
                                    'label' => esc_html__('COPYRIGHT SKIN', 'themo'),
                                    'value' => $_portfolio['footer']['footer_settings']['copyright_skin'],
                                    'options' => array(
                                        array('', esc_html__('Default', 'themo')),
                                        array('light', esc_html__('Light', 'themo')),
                                        array('dark', esc_html__('Dark', 'themo')),
                                    ),
                                    'description' => esc_html__('Choose Light or Dark skin for Standard footer on this portfolio page or choose Default to use Customizer setting. Light skin means light background/light content and Dark skin means dark background/light content.', 'themo')
                                ));

                                if (!isset($_portfolio['footer']['copyrights_coloring']['copyrights_background_color'])) {
                                    $_portfolio['footer']['copyrights_coloring']['copyrights_background_color'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'colorpicker',
                                    'name' => '_ideo_portfolio[footer][copyrights_coloring][copyrights_background_color]',
                                    'id' => 'portfolio_copyrights_background_color',
                                    'class' => 'colorpicker',
                                    'label' => esc_html__('BACKGROUND COLOR ', 'themo'),
                                    'value' => $_portfolio['footer']['copyrights_coloring']['copyrights_background_color'],
                                    'description' => esc_html__('Pick background color for copyrights area or leave empty to use Customizer setting.', 'themo')
                                ));

                                if (!isset($_portfolio['footer']['copyrights_coloring']['copyrights_text_color'])) {
                                    $_portfolio['footer']['copyrights_coloring']['copyrights_text_color'] = '';
                                }
                                ideothemo_controls_html(array(
                                    'type' => 'colorpicker',
                                    'name' => '_ideo_portfolio[footer][copyrights_coloring][copyrights_text_color]',
                                    'id' => 'portfolio_copyrights_text_color',
                                    'class' => 'colorpicker',
                                    'label' => esc_html__('TEXT COLOR', 'themo'),
                                    'value' => $_portfolio['footer']['copyrights_coloring']['copyrights_text_color'],
                                    'description' => esc_html__('Pick copyright text color or leave empty to use Customizer setting.', 'themo')
                                ));
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div id="tab-sidebar" class="tab-content">
                <div class="ideo-section">
                    <?php
                    if (!isset($_portfolio['sidebar']['sidebar_settings']['sidebar_global'])) {
                        $_portfolio['sidebar']['sidebar_settings']['sidebar_global'] = '';
                    }
                    ideothemo_controls_html(array(
                        'type' => 'selectmenu',
                        'name' => '_ideo_portfolio[sidebar][sidebar_settings][sidebar_global]',
                        'id' => 'portfolio_sidebar_global',
                        'label' => esc_html__('SIDEBAR', 'themo'),
                        'value' => $_portfolio['sidebar']['sidebar_settings']['sidebar_global'],
                        'options' => array(
                            array('', esc_html__('Default', 'themo')),
                            array('none', esc_html__('None', 'themo')),
                            array('left_sidebar', esc_html__('Left sidebar', 'themo')),
                            array('right_sidebar', esc_html__('Right sidebar', 'themo')),
                        ),
                        'description' => esc_html__('Choose between Left or Right sidebar position or choose None if you do not want to display sidebar on this portfolio page. Choose Default to use Customizer setting.', 'themo')
                    ));
                    ?>
                    <div class="ideo-section">
                        <?php
                        if (!isset($_portfolio['sidebar']['sidebar_settings']['sidebar_choose'])) {
                            $_portfolio['sidebar']['sidebar_settings']['sidebar_choose'] = '';
                        }
                        ideothemo_controls_html(array(
                            'type' => 'selectmenu',
                            'name' => '_ideo_portfolio[sidebar][sidebar_settings][sidebar_choose]',
                            'id' => 'portfolio_sidebar_choose',
                            'label' => esc_html__('CHOOSE SIDEBAR', 'themo'),
                            'value' => $_portfolio['sidebar']['sidebar_settings']['sidebar_choose'],
                            'options' => ideothemo_registered_sidebars('metabox', true),
                            'description' => esc_html__('Choose from dropdown one of sidebars you have created in WordPress widgets panel.', 'themo')
                        ));
                        ?>
                    </div>
                    <?php
                    if (!isset($_portfolio['sidebar']['sidebar_settings']['sidebar_skin'])) {
                        $_portfolio['sidebar']['sidebar_settings']['sidebar_skin'] = '';
                    }
                    ideothemo_controls_html(array(
                        'type' => 'selectmenu',
                        'name' => '_ideo_portfolio[sidebar][sidebar_settings][sidebar_skin]',
                        'id' => 'portfolio_sidebar_skin',
                        'label' => esc_html__('SIDEBAR SKIN', 'themo'),
                        'value' => $_portfolio['sidebar']['sidebar_settings']['sidebar_skin'],
                        'options' => array(
                            array('', esc_html__('Default', 'themo')),
                            array('light', esc_html__('Light', 'themo')),
                            array('dark', esc_html__('Dark', 'themo')),
                        ),
                        'description' => esc_html__('Choose between Light and Dark Sidebar skin or choose Default to use Customizer setting. Light skin means light content (fonts) and Dark skin means dark content (fonts).', 'themo')
                    ));

                    if (!isset($_portfolio['sidebar']['sidebar_coloring']['sidebar_light_accent_color'])) {
                        $_portfolio['sidebar']['sidebar_coloring']['sidebar_light_accent_color'] = '';
                    }
                    ideothemo_controls_html(array(
                        'type' => 'colorpicker',
                        'name' => '_ideo_portfolio[sidebar][sidebar_coloring][sidebar_light_accent_color]',
                        'id' => 'portfolio_sidebar_light_accent_color',
                        'class' => 'colorpicker',
                        'label' => esc_html__('ACCENT COLOR', 'themo'),
                        'value' => $_portfolio['sidebar']['sidebar_coloring']['sidebar_light_accent_color'],
                        'description' => esc_html__('Pick sidebar accent color or leave empty to use Customizer setting.', 'themo')
                    ));

                    if (!isset($_portfolio['sidebar']['sidebar_coloring']['sidebar_light_titles_color'])) {
                        $_portfolio['sidebar']['sidebar_coloring']['sidebar_light_titles_color'] = '';
                    }
                    ideothemo_controls_html(array(
                        'type' => 'colorpicker',
                        'name' => '_ideo_portfolio[sidebar][sidebar_coloring][sidebar_light_titles_color]',
                        'id' => 'portfolio_sidebar_light_titles_color',
                        'class' => 'colorpicker',
                        'label' => esc_html__('TITLES COLOR', 'themo'),
                        'value' => $_portfolio['sidebar']['sidebar_coloring']['sidebar_light_titles_color'],
                        'description' => esc_html__('Pick widgets titles color or leave empty to use Customizer setting.', 'themo')
                    ));

                    if (!isset($_portfolio['sidebar']['sidebar_coloring']['sidebar_light_text_color'])) {
                        $_portfolio['sidebar']['sidebar_coloring']['sidebar_light_text_color'] = '';
                    }
                    ideothemo_controls_html(array(
                        'type' => 'colorpicker',
                        'name' => '_ideo_portfolio[sidebar][sidebar_coloring][sidebar_light_text_color]',
                        'id' => 'portfolio_sidebar_light_text_color',
                        'class' => 'colorpicker',
                        'label' => esc_html__('TEXT COLOR', 'themo'),
                        'value' => $_portfolio['sidebar']['sidebar_coloring']['sidebar_light_text_color'],
                        'description' => esc_html__('Pick text color or leave empty to use Customizer setting.', 'themo')
                    ));
                    ?>
                </div>
            </div>

            <div id="tab-slider" class="tab-content">
                <div class="ideo-section">

                    <div class="ideo-info">
                        <h5><?php esc_html_e('Info:', 'themo'); ?></h5>
                        <p><?php echo wp_kses(__(' In this section you can set slider on the top of the page. With THEMO you have two slider plugins available, so firtsly you should decide which of those plugins you are going to use on this page/post, and then you can choose particular slider which you have already created. </br> !!! If you want to display slider right below the header, you should Turn off page title area.', 'themo'),  IDEOTHEMO_KSES_TAGS::allow()); ?></p>
                    </div>
                    <?php

                    $enabled_plugin_sliders = array(array('', esc_html__('No Slider', 'themo')));
                    $slider_array = array('ls' => array(), 'rs' => array());

                    if (class_exists('GlobalsRevSlider')) {
                        $enabled_plugin_sliders[] = array('rs', 'Revolution Slider');

                        $slider = new RevSlider();
                        $arrSliders = $slider->getArrSliders();

                        foreach ($arrSliders as $slider) {
                            $id = $slider->getID();
                            $title = $slider->getTitle();
                            $slider_array['rs'][] = array($id, $title);
                        }
                    }

                    if (defined('LS_PLUGIN_VERSION')) {
                        $enabled_plugin_sliders[] = array('ls', 'LayerSlider WP');
                        $sliders = LS_Sliders::find();

                        foreach ($sliders as $slider) {
                            $slider_array['ls'][] = array($slider['id'], $slider['name']);
                        }
                    }

                    if (!isset($_portfolio['slider']['plugin'])) {
                        $_portfolio['slider']['plugin'] = '';
                    }
                    ideothemo_controls_html(array(
                        'type' => 'selectmenu',
                        'name' => '_ideo_portfolio[slider][plugin]',
                        'id' => 'portfolio_slider_plugin',
                        'label' => esc_html__('SELECT SLIDER PLUGIN', 'themo'),
                        'value' => $_portfolio['slider']['plugin'],
                        'options' => $enabled_plugin_sliders,
                        'description' => esc_html__('Choose slider plugin which you are going to use on this particular page/post.', 'themo')
                    ));

                    if (count($slider_array['rs'])) {
                        if (!isset($_portfolio['slider']['rs'])) {
                            $_portfolio['slider']['rs'] = '';
                        }
                        ideothemo_controls_html(array(
                            'type' => 'selectmenu',
                            'name' => '_ideo_portfolio[slider][rs]',
                            'id' => 'portfolio_slider_rs',
                            'label' => esc_html__('SELECT SLIDER', 'themo'),
                            'value' => $_portfolio['slider']['rs'],
                            'options' => $slider_array['rs'],
                            'description' => esc_html__('Choose one of sliders which you already created.', 'themo')
                        ));
                    }

                    if (count($slider_array['ls'])) {
                        if (!isset($_portfolio['slider']['ls'])) {
                            $_portfolio['slider']['ls'] = '';
                        }
                        ideothemo_controls_html(array(
                            'type' => 'selectmenu',
                            'name' => '_ideo_portfolio[slider][ls]',
                            'id' => 'portfolio_slider_ls',
                            'label' => esc_html__('SELECT SLIDER', 'themo'),
                            'value' => $_portfolio['slider']['ls'],
                            'options' => $slider_array['ls'],
                            'description' => esc_html__('Choose one of sliders which you already created.', 'themo')
                        ));
                    }

                    ?>
                </div>
            </div>

            <div id="tab-scripts-styles" class="tab-content">
                <div class="ideo-section">
                    <div class="ideo-info">
                        <h5><?php esc_html_e('Info:', 'themo'); ?></h5>
                        <p><?php echo wp_kses(__('In this section you can disable particular plugins which you do not use on this page. You have to notice, that for each activated plugin several…page loading. As a result, each plugin increase page loading time but you can disable unnecessary plugins on particular pages to reduce loading time.', 'themo'),  IDEOTHEMO_KSES_TAGS::allow()); ?></p>
                    </div>
                    <?php
                    if (defined('LS_PLUGIN_VERSION')) {
                        if (!isset($_portfolio['scripts_styles']['ls'])) {
                            $_portfolio['scripts_styles']['ls'] = 'on';
                        }
                        ideothemo_controls_html(array(
                            'type' => 'switcher',
                            'name' => '_ideo_portfolio[scripts_styles][ls]',
                            'id' => 'portfolio_ls_on',
                            'label' => esc_html__('Layer Slider', 'themo'),
                            'class' => 'switcher',
                            'value' => $_portfolio['scripts_styles']['ls'],
                            'options' => array(
                                array('on', esc_html__('On', 'themo')),
                                array('off', esc_html__('Off', 'themo')),
                            ),
                            'description' => esc_html__('Enable or disable Layer Slider loading scripts & styles.', 'themo')
                        ));
                    }

                    if (defined('RS_PLUGIN_URL')) {
                        if (!isset($_portfolio['scripts_styles']['rev'])) {
                            $_portfolio['scripts_styles']['rev'] = 'on';
                        }
                        ideothemo_controls_html(array(
                            'type' => 'switcher',
                            'name' => '_ideo_portfolio[scripts_styles][rev]',
                            'id' => 'portfolio_rev_on',
                            'label' => esc_html__('Revolution Slider', 'themo'),
                            'class' => 'switcher',
                            'value' => $_portfolio['scripts_styles']['rev'],
                            'options' => array(
                                array('on', esc_html__('On', 'themo')),
                                array('off', esc_html__('Off', 'themo')),
                            ),
                            'description' => esc_html__('Enable or disable Revolution Slider loading scripts & styles.', 'themo')
                        ));
                    }

                    if (defined('TG_VERSION')) {
                        if (!isset($_portfolio['scripts_styles']['tg'])) {
                            $_portfolio['scripts_styles']['tg'] = 'on';
                        }
                        ideothemo_controls_html(array(
                            'type' => 'switcher',
                            'name' => '_ideo_portfolio[scripts_styles][tg]',
                            'id' => 'portfolio_tg_on',
                            'label' => esc_html__('The Grid', 'themo'),
                            'class' => 'switcher',
                            'value' => $_portfolio['scripts_styles']['tg'],
                            'options' => array(
                                array('on', esc_html__('On', 'themo')),
                                array('off', esc_html__('Off', 'themo')),
                            ),
                            'description' => esc_html__('Enable or disable The Grid loading scripts & styles.', 'themo')
                        ));
                    }

                    if (defined('WPCF7_VERSION')) {
                        if (!isset($_portfolio['scripts_styles']['cf7'])) {
                            $_portfolio['scripts_styles']['cf7'] = 'on';
                        }
                        ideothemo_controls_html(array(
                            'type' => 'switcher',
                            'name' => '_ideo_portfolio[scripts_styles][cf7]',
                            'id' => 'portfolio_cf7_on',
                            'label' => esc_html__('Contact Form 7', 'themo'),
                            'class' => 'switcher',
                            'value' => $_portfolio['scripts_styles']['cf7'],
                            'options' => array(
                                array('on', esc_html__('On', 'themo')),
                                array('off', esc_html__('Off', 'themo')),
                            ),
                            'description' => esc_html__('Enable or disable Contact Form 7 loading scripts & styles.', 'themo')
                        ));
                    }


                    if (class_exists("Ultimate_Carousel")) {
                        if (!isset($_portfolio['scripts_styles']['ac'])) {
                            $_portfolio['scripts_styles']['ac'] = 'on';
                        }
                        ideothemo_controls_html(array(
                            'type' => 'switcher',
                            'name' => '_ideo_portfolio[scripts_styles][ac]',
                            'id' => 'portfolio_ac_on',
                            'label' => esc_html__('Advanced Carousel', 'themo'),
                            'class' => 'switcher',
                            'value' => $_portfolio['scripts_styles']['ac'],
                            'options' => array(
                                array('on', esc_html__('On', 'themo')),
                                array('off', esc_html__('Off', 'themo')),
                            ),
                            'description' => esc_html__('Enable or disable Advanced carousel loading scripts & styles.', 'themo')
                        ));
                    }

                    ?>
                </div>
            </div>

        </div>
    </div>

    <?php
}
