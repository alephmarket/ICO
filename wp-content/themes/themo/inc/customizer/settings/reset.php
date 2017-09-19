<?php 
$settings[] = array(
                'id' => 'reset',
                'title' => esc_html__('RESET TO DEFAULT', 'themo'),
                'sections' => array(
                    array(
                        'id' => 'reset',
                        'title' => esc_html__('RESET TO DEFAULT', 'themo'),
                        'controls' => array(
                            array(
                                'id' => 'ideo_theme_options[reset][reset][reset_info]',
                                'type' => 'info',
                                'label' => esc_html__('INFO:', 'themo'),
                                'default' => '',
                                'description' => __('Reset to default option allows you to restore the default Customizer settings. !!! Be careful, once you turn it ON all your previous changes will be lost.</br>To restore default settings click the button, confirm the message and wait until the Customizer will reload.', 'themo'),
                                'transport' => 'refresh',
                            ),
                            array(
                                'id' => 'ideo_theme_options[reset][reset][reset_do_default]',
                                'type' => 'button-reset',
                                'label' => esc_html__('RESET TO DEFAULT', 'themo'),
                                'label_button' => esc_html__('RESET TO DEFAULT', 'themo'),
                                'default' => '',
                                'description' => '',
                                'transport' => 'refresh',
                                'js_callback' => 'resetToDefault()'
                            ),
                        ),
                    ),
                ),
            );