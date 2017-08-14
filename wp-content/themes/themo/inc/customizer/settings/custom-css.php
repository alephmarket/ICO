<?php 
$settings[] = array(
                'id' => 'custom_css',
                'title' => esc_html__('CUSTOM CSS', 'themo'),
                'sections' => array(
                    array(
                        'id' => 'custom_css',
                        'title' => esc_html__('CUSTOM CSS', 'themo'),
                        'controls' => array(
                            array(
                                'id' => 'ideo_theme_options[custom][custom_css][custom_css]',
                                'type' => 'code',
                                'code_type' => 'css',
                                'label' => esc_html__('CUSTOM CSS', 'themo'),
                                'default' => '',
                                'description' => null,
                                'transport' => 'postMessage'
                            ),
                        ),
                    )
                ),
            );