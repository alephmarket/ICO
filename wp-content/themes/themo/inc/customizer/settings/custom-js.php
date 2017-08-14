<?php
$settings[] = array(
                'id' => 'custom_js',
                'title' => esc_html__('CUSTOM JS ', 'themo'),
                'sections' => array(
                    array(
                        'id' => 'custom_js',
                        'title' => esc_html__('CUSTOM JS', 'themo'),
                        'controls' => array(
                            array(
                                'id' => 'ideo_theme_options[custom][custom_js][info]',
                                'type' => 'info',
                                'label' => esc_html__('INFO:', 'themo'),
                                'default' => '',
                                'description' => __('In Layout section you can decide to use Boxed layout or Wide layout and set custom width of page content.', 'themo'),
                                'transport' => 'refresh',
                            ),
                            array(
                                'id' => 'ideo_theme_options[custom][custom_js][custom_js]',
                                'type' => 'code',
                                'code_type' => 'javascript',
                                'label' => esc_html__('CUSTOM JS', 'themo'),
                                'default' => '',
                                'description' => null,
                                'transport' => 'refresh',
                                'add_preview_button' => true
                            ),
                        ),
                    ),
                ),
            );