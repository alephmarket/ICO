<?php

if (!function_exists('ideothemo_get_header_default_settings')) {
    function ideothemo_get_header_default_settings()
    {

        $accent_color = ideothemo_get_general_accent_color();

        return array
        (

            'type' => 'sticky_header',
            'top' => array
            (
                'top_distance' => 0,
                'width' => 'full',
                'style' => 'colored_light',
                'custom_width' => 1440,
                'content_width' => 1170,
                'height' => 50,
                'logo' => array
                (
                    'type' => 'normal',
                    'height' => 50,
                    'margin' => array
                    (
                        'top' => 15,
                        'bottom' => 15
                    )

                ),

                'first_level_menu_hover_style' => 'text',
                'search_form' => 'classic'
            ),

            'mobile' => array
            (
                'search_bar' => 'on',
                'social_media_icon' => 'on',
                'dark' => array
                (
                    'styling' => array
                    (
                        'background_color' => '#3a3a3a',
                        'icon_color' => $accent_color,
                        'first_dropdown_background' => '#151723',
                        'second_dropdown_background' => '#1a1c28',
                        'text_color' => '#f4f4f4',
                        'text_hover_color' => $accent_color,
                        'separators_color' => 'rgba(217,217,217,0.08)',
                        'reset' => ''
                    )

                ),

                'light' => array
                (
                    'styling' => array
                    (
                        'background_color' => '#fffffff',
                        'icon_color' => $accent_color,
                        'first_dropdown_background' => '#151723',
                        'second_dropdown_background' => '#1a1c28',
                        'text_color' => '#f4f4f4',
                        'text_hover_color' => $accent_color,
                        'separators_color' => 'rgba(217,217,217,0.08)',
                        'reset' => ''
                    )

                ),

                'header_skin' => 'dark',
                'logo' => array
                (
                    'type' => 'normal',
                    'height_in_mobile_menu' => 25,
                    'margin_top_bottom' => 5
                )

            ),

            'top_sticky' => array
            (
                'transparent' => array
                (
                    'light' => array
                    (
                        'background_color' => '',
                        'border_bottom' => array
                        (
                            'color' => $accent_color,
                            'thickness' => 2
                        ),

                        'first_level_menu_text' => array
                        (
                            'color' => '#ffffff',
                            'hover_color' => $accent_color,
                        ),

                        'search_language_icon_color' => ideothemo_get_themo_default_value('header.top_sticky.transparent.light.search_language_icon_color'),
                        'background_loading_effect_color' => $accent_color,
                        'first_reset' => '',
                        'mega_menu_sub_level' => array
                        (
                            'background' => array
                            (
                                'color' => '',
                                'image_overlay_color' => ''
                            ),

                            'hover_color' => $accent_color,
                            'column_title_color' => $accent_color,
                            'text_icon' => array
                            (
                                'color' => '#ffffff',
                                'hover_color' => $accent_color,
                            ),

                            'separators_color' => array
                            (
                                'vertical' => '',
                                'horizontal' => 'rgba(255,255,255,0.25)'
                            )

                        ),

                        'second_reset' => '',
                        'sub_section_header' => '',
                        'sub_section_mega_menu' => '',
                        'hover_background_color' => ''
                    ),

                    'dark' => array
                    (
                        'background_color' => '',
                        'border_bottom' => array
                        (
                            'color' => $accent_color,
                            'thickness' => 2
                        ),

                        'first_level_menu_text' => array
                        (
                            'color' => '#3a3a3a',
                            'hover_color' => $accent_color,
                        ),

                        'search_language_icon_color' => $accent_color,
                        'background_loading_effect_color' => '',
                        'first_reset' => '',
                        'mega_menu_sub_level' => array
                        (
                            'background' => array
                            (
                                'color' => '',
                                'image_overlay_color' => ''
                            ),

                            'hover_color' => $accent_color,
                            'column_title_color' => $accent_color,
                            'text_icon' => array
                            (
                                'color' => '#3a3a3a',
                                'hover_color' => '#ffffff'
                            ),

                            'separators_color' => array
                            (
                                'vertical' => '',
                                'horizontal' => 'rgba(58,58,58,0.25)'
                            )

                        ),

                        'second_reset' => '',
                        'sub_section_header' => '',
                        'sub_section_mega_menu' => '',
                        'hover_background_color' => ideothemo_hex2rgba($accent_color, 0.7)
                    )

                ),

                'colored' => array
                (
                    'light' => array
                    (
                        'background_color' => 'rgba(255,255,255,0.75)',
                        'border_bottom' => array
                        (
                            'color' => ideothemo_get_themo_default_value('header.top_sticky.colored.light.border_bottom.color'),
                            'thickness' => 1
                        ),

                        'first_level_menu_text' => array
                        (
                            'color' => '#434a54',
                            'hover_color' => $accent_color,
                        ),

                        'search_language_icon_color' => ideothemo_get_themo_default_value('header.top_sticky.colored.light.search_language_icon_color'),
                        'search_language_icon_hover_color' => $accent_color,
                        'background_loading_effect_color' => '#ffffff',
                        'first_reset' => '',
                        'mega_menu_sub_level' => array
                        (
                            'background' => array
                            (
                                'color' => ideothemo_get_themo_default_value('header.top_sticky.colored.light.mega_menu_sub_level.background.color')
                            ),

                            'hover_color' => ideothemo_get_themo_default_value('header.top_sticky.colored.light.mega_menu_sub_level.hover_color'),
                            'column_title_color' => $accent_color,
                            'text_icon' => array
                            (
                                'color' => ideothemo_get_themo_default_value('header.top_sticky.colored.light.mega_menu_sub_level.text_icon.color'),
                                'hover_color' => ideothemo_get_themo_default_value('header.top_sticky.colored.light.mega_menu_sub_level.text_icon.hover_color'),
                            ),

                            'separators_color' => array
                            (
                                'vertical' => ideothemo_get_themo_default_value('header.top_sticky.colored.light.mega_menu_sub_level.separators_color.vertical'),
                                'horizontal' => ideothemo_get_themo_default_value('header.top_sticky.colored.light.mega_menu_sub_level.separators_color.horizontal'),
                            )

                        ),

                        'second_reset' => '',
                        'sub_section_header' => '',
                        'sub_section_mega_menu' => ''
                    ),

                    'dark' => array
                    (
                        'background_color' => 'rgba(26,28,40,0.75)',
                        'border_bottom' => array
                        (
                            'color' => $accent_color,
                            'thickness' => 2
                        ),

                        'first_level_menu_text' => array
                        (
                            'color' => '#d9d9d9',
                            'hover_color' => $accent_color,
                        ),

                        'search_language_icon_color' => $accent_color,
                        'background_loading_effect_color' => '#1a1c28',
                        'first_reset' => '',
                        'mega_menu_sub_level' => array
                        (
                            'background' => array
                            (
                                'color' => '#1a1c28',
                                'image_overlay_color' => 'rgba(26,28,40,0.3)'
                            ),

                            'hover_color' => $accent_color,
                            'column_title_color' => $accent_color,
                            'text_icon' => array
                            (
                                'color' => '#d9d9d9',
                                'hover_color' => $accent_color,
                            ),

                            'separators_color' => array
                            (
                                'vertical' => 'rgba(217,217,217,0.08)',
                                'horizontal' => ''
                            )

                        ),

                        'second_reset' => '',
                        'sub_section_header' => '',
                        'sub_section_mega_menu' => ''
                    )

                )

            ),

            'side' => array
            (
                'search_form' => 'on',
                'social_icon' => 'on', 
                'dark' => array
                (
                    'styling' => array
                    (
                        'color_background' => array
                        (
                            'background_color' => '#1a1c28',
                            'pattern_color' => '',
                            'pattern_overlay' => 'none'
                        ),

                        'image_background' => array
                        (
                            'background_image' => '',
                            'image_overlay' => array
                            (
                                'color' => array
                                (
                                    'pattern_color' => 'rgba(35,35,35,0.37)'
                                ),

                                'pattern' => array
                                (
                                    'color' => 'rgba(35,35,35,0.37)',
                                    'type' => 'maska-1'
                                ),

                                'type' => 'none'
                            ),

                            'image_position' => 'top_left',
                            'image_size' => 'auto',
                            'image_repeat' => 'no-repeat'
                        ),

                        'menu_text_color' => '#d9d9d9',
                        'menu_text_hover_color' => $accent_color,
                        'dropdown_menu_background_color' => '#151723',
                        'dropdown_menu_separators_color' => 'rgba(217,217,217,0.08)',
                        'social_icon_background_color' => $accent_color,
                        'social_icons_color' => '#ffffff',
                        'copyrights' => '#d9d9d9',
                        'reset' => '',
                        'background' => 'color'
                    )

                ),

                'light' => array
                (
                    'styling' => array
                    (
                        'color_background' => array
                        (
                            'background_color' => 'rgba(255,255,255,0.75)',
                            'pattern_color' => '',
                            'pattern_overlay' => 'none'
                        ),

                        'image_background' => array
                        (
                            'background_image' => '',
                            'image_overlay' => array
                            (
                                'color' => array
                                (
                                    'pattern_color' => 'rgba(255,255,255,0.34)'
                                ),

                                'pattern' => array
                                (
                                    'color' => 'rgba(255,255,255,0.34)',
                                    'type' => 'maska-1'
                                ),

                                'type' => 'none'
                            ),

                            'image_position' => 'top_left',
                            'image_size' => 'auto',
                            'image_repeat' => 'no-repeat'
                        ),

                        'menu_text_color' => '#434a54',
                        'menu_text_hover_color' => $accent_color,
                        'dropdown_menu_background_color' => '#ffffff',
                        'dropdown_menu_separators_color' => 'rgba(67,74,84,0.08)',
                        'social_icon_background_color' => $accent_color,
                        'social_icons_color' => '#ffffff',
                        'copyrights' => '#434a54 ',
                        'reset' => '',
                        'background' => 'color'
                    )

                ),

                'side' => 'left',
                'align' => array
                (
                    'menu' => 'center',
                    'bottom_area' => 'center'
                ),

                'logo' => array
                (
                    'type' => 'normal',
                    'height' => '40',
                    'padding_left' => '0',
                    'padding_top' => '20',
                    'padding_bottom' => '20',
                    'align' => 'center',
                ),

                'copyright' => '',
                'style' => 'light'
            ),

            'sticky' => array
            (
                'hidding_effect' => 'off',
                'scroll_amount' => 'menu_height',
                'scroll_amount_input' => 500,
                'width' => 'full_width',
                'custom_width' => 1440,
                'content_width' => 1170,
                'height' => 50,
                'logo' => array
                (
                    'type' => 'normal',
                    'height' => 50,
                    'margin' => array
                    (
                        'top' => 15,
                        'bottom' => 15
                    )

                ),

                'top_distance' => 0,
                'search_form' => 'standard',
                'first_level_menu_hover_style' => 'text',
                'loading_effect' => 'disable',
                'style' => 'colored_light'
            ),

            'logo' => array
            (
                'normal' => '',
                'light' => '',
                'dark' => '',
                'sticky' => array
                (
                    'dark' => '',
                    'light' => ''
                ),

                'retina' => array
                (
                    'enable' => '',
                    'normal' => '',
                    'light' => '',
                    'dark' => '',
                    'sticky' => array
                    (
                        'dark' => '',
                        'light' => ''
                    )

                ),

                'favicon' => ''
            ),

            'typografy' => array
            (
                'main_menu' => array
                (
                    'seledyn' => '',
                    'font' => array
                    (
                        'type' => 'arial',
                        'size' => 20,
                        'weight' => 100
                    ),

                    'extension' => 'eot',
                    'line_height' => 10,
                    'letter_spacing' => 20,
                    'italic' => ''
                ),

                'submenu' => array
                (
                    'seledyn' => '',
                    'font' => array
                    (
                        'type' => 'arial',
                        'size' => 20,
                        'weight' => 100
                    ),

                    'extension' => 'eot',
                    'line_height' => 10,
                    'letter_spacing' => 20,
                    'italic' => ''
                ),

                'mega_menu' => array
                (
                    'seledyn' => '',
                    'font' => array
                    (
                        'type' => 'arial',
                        'size' => 20,
                        'weight' => 100
                    ),

                    'extension' => 'eot',
                    'line_height' => 10,
                    'letter_spacing' => 20,
                    'italic' => ''
                ),

                'mega_menu_column_title' => array
                (
                    'seledyn' => '',
                    'font' => array
                    (
                        'type' => 'arial',
                        'size' => 20,
                        'weight' => 100,
                    ),

                    'extension' => 'eot',
                    'line_height' => 10,
                    'letter_spacing' => 20,
                    'italic' => ''
                ),

                'mobile_menu' => array
                (
                    'seledyn' => '',
                    'font' => array
                    (
                        'type' => 'arial',
                        'size' => 20,
                        'weight' => 100
                    ),

                    'extension' => 'eot',
                    'line_height' => 10,
                    'letter_spacing' => 20,
                    'italic' => ''
                )

            )

        );
    }
}