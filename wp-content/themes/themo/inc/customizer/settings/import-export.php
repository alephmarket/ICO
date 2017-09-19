<?php 
$settings[] = array(
                'id' => 'import',
                'title' => esc_html__('IMPORT / EXPORT', 'themo'),
                'sections' => array(
                    array(
                        'id' => 'import',
                        'title' => esc_html__('IMPORT', 'themo'),
                        'controls' => array(
                            array(
                                'id' => 'ideo_theme_options[import][import][import_info]',
                                'type' => 'info',
                                'label' => esc_html__('INFO:', 'themo'),
                                'default' => '',
                                'description' => __('In this section you can import from another THEMO project all theme options set in Customizer. To do so, go to another THEMO project from which you want to transfer settings and click export button and copy export code. Then come back here and paste copied code to import textfield below. Click Save and publish button and your settings will be transferred.', 'themo'),
                                'transport' => 'refresh',
                            ),
                            array(
                                'id' => 'import_code',
                                'type' => 'import',
                                'label' => esc_html__('IMPORT CODE', 'themo'),
                                'default' => '',
                                'description' => '',
                                'transport' => 'both',
                            ),
                        ),
                    ),
                    array(
                        'id' => 'export',
                        'title' => esc_html__('EXPORT', 'themo'),
                        'controls' => array(
                            array(
                                'id' => 'ideo_theme_options[import][export][export_info]',
                                'type' => 'info',
                                'label' => esc_html__('INFO:', 'themo'),
                                'default' => '',
                                'description' => __('In this section you can export all Customizer settings to other THEMO project. Simply click Export button and copy code from textfield below. Paste copied code to IMPORT section in target project. Click Save and publish button and your settings will be transferred.', 'themo'),
                                'transport' => 'none',
                            ),
                            array(
                                'id' => 'export_code',
                                'type' => 'export',
                                'label' => esc_html__('EXPORT CODE', 'themo'),
                                'default' => '',
                                'description' => '',
                                'transport' => 'none',
                            ),
                        ),
                    ),
                ),
            );