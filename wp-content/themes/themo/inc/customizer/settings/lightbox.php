<?php 
$settings[] = array(
                'id' => 'lightbox',
                'title' => esc_html__('LIGHTBOX', 'themo'),
                'sections' => array(
                    array(
                        'id' => 'lightbox_settings',
                        'title' => esc_html__('SETTINGS', 'themo'),
                        'controls' => array(
                            array(
                                'id' => 'ideo_theme_options[lightbox][lightbox_settings][lightbox_text_align]',
                                'type' => 'select',
                                'label' => esc_html__('TEXT & TITLE ALIGN ', 'themo'),
                                'default' => ideothemo_get_themo_default_value('lightbox.lightbox_settings.lightbox_text_align'),
                                'choices' => array(
                                    'left' => 'Left',
                                    'center' => 'Center',
                                    'right' => 'Right',
                                ),
                                'description' => __('Justify text elements in lightbox.', 'themo'),
                                'transport' => 'postMessage',
                            ),
                            array(
                                'id' => 'ideo_theme_options[lightbox][lightbox_settings][lightbox_entry_animation]',
                                'type' => 'select',
                                'label' => esc_html__('ENTRY/OPENNING ANIMATION', 'themo'),
                                'default' => ideothemo_get_themo_default_value('lightbox.lightbox_settings.lightbox_entry_animation'),
                                'choices' => array(
                                    'zoom-in' => 'Zoom',
                                    'newspaper' => 'Newspaper',
                                    'move-horizontal' => 'Horizontal move',
                                    'newspaper' => 'Newspaper',
                                    'move-from-top' => 'Move from top',
                                    '3d-unfold' => '3d unfold',
                                    'zoom-out' => 'Zoom-out',
                                ),
                                'description' => __('Choose one of predefined lightbox entry animations. !!! Notice, that you will not see this change immediately on the preview screen, you have to save and refresh Customizer to see it.', 'themo'),
                                'transport' => 'refresh',
                            ),
                        ),
                    ),
                    array(
                        'id' => 'lightbox_coloring',
                        'title' => esc_html__('COLORING', 'themo'),
                        'controls' => array(
                            array(
                                'id' => 'ideo_theme_options[lightbox][lightbox_coloring][lightbox_overlay_color]',
                                'type' => 'alphacolor',
                                'label' => esc_html__('BACKGROUND COLOR', 'themo'),
                                'default' => ideothemo_get_themo_default_value('lightbox.lightbox_coloring.lightbox_overlay_color'),
                                'description' => '',
                                'transport' => 'postMessage',
                            ),
                            array(
                                'id' => 'ideo_theme_options[lightbox][lightbox_coloring][lightbox_text_and_nav_color]',
                                'type' => 'alphacolor',
                                'label' => esc_html__('TEXT & NAVIGATION COLOR', 'themo'),
                                'default' => ideothemo_get_themo_default_value('lightbox.lightbox_coloring.lightbox_text_and_nav_color'),
                                'description' => '',
                                'transport' => 'postMessage',
                            ),
                        ),
                    ),
                ),
            );