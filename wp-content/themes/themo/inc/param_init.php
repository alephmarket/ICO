<?php

set_theme_mod('ideo_theme_skin', array(
    'light' => array(
        'generals' => array(
            'background' => array(
                'content_background_color' => '#fff',
                'boxed_background_color' => '#f3f3f3'
            )
        ),

        'pagetitle' => array(
            'page_title_settings' => array(
                'page_title_area_skin' => 'dark'
            ),
            'page_title_background' => array(
                'pt_background_color' => '#f3f3f3'
            )
        ),

        'shortcodes' => array(
        ),

        'footer' => array(
            'footer_settings' => array(
                'standard_footer_skin' => 'light',
                'copyright_skin' => 'dark'
            ),
            'standard_footer_background' => array(
                'footer_background_color' => '#3c3f40'
            )
        ),

        'sidebar' => array(
            'sidebar_settings' => array(
                'sidebar_skin' => 'dark'
            )
        ),

        'advanced' => array(
            'advanced_loading' => array(
                'advanced_loader_background_color' => '#fff',
                'advanced_loader_color' => '#3a3a3a'
            )
        ),
        'body_font_color' => '#3a3a3a'

    ),
    'dark' => array(
        'generals' => array(
            'background' => array(
                'content_background_color' => '#3a3a3a',
                'boxed_background_color' => '#000000'
            )
        ),

        'pagetitle' => array(
            'page_title_settings' => array(
                'page_title_area_skin' => 'light'
            ),
            'page_title_background' => array(
                'pt_background_color' => '#3a3a3a'
            )
        ),

        'shortcodes' => array(
            'shortcodes_settings' => array(
                'shortcodes_style' => 'transparent-light'
            )
        ),

        'footer' => array(
            'footer_settings' => array(
                'standard_footer_skin' => 'light',
                'copyright_skin' => 'dark'
            ),
            'standard_footer_background' => array(
                'footer_background_color' => '#212223'
            )
        ),

        'sidebar' => array(
            'sidebar_settings' => array(
                'sidebar_skin' => 'light'
            )
        ),

        'advanced' => array(
            'advanced_loading' => array(
                'advanced_loader_background_color' => '#3a3a3a',
                'advanced_loader_color' => '#fff'
            )
        ),
        'body_font_color' => '#fff'

    )
));

set_theme_mod('ideo_default_theme_skin', 'light');

$ideo_default_skin = 'light';
$ideo_default_accent_color = '#31aad1';

$ideo_theme_skins = get_theme_mod('ideo_theme_skin', array());
$ideo_theme_skin = $ideo_theme_skins[$ideo_default_skin];


set_theme_mod('global_shortcode_style', 'colored-dark');
set_theme_mod('colors', array(
        array(
            'name' => "Colored Dark",
            'colors' => array(
                "accent_color" => "#ed5564",
                "title_color" => "#ffffff",
                "text_color" => "#ffffff",
                "icon_color" => "#ffffff",
                "background_color" => "#000000",
                "alternative_title_color" => "#ffffff"
            )
        ),
        array(
            'name' => "Colored Light",
            'colors' => array(
                "accent_color" => "#ed5564",
                "title_color" => "#3a3a3a",
                "text_color" => "#3a3a3a",
                "icon_color" => "#3a3a3a",
                "background_color" => "#ffffff",
                "alternative_title_color" => "#ffffff"
            )
        ),
        array(
            'name' => "Transparent Dark",
            'colors' => array(
                "accent_color" => "#ed5564",
                "title_color" => "#3a3a3a",
                "text_color" => "#3a3a3a",
                "icon_color" => "#3a3a3a"
            )
        ),
        array(
            'name' => "Transparent Light",
            'colors' => array(
                "accent_color" => "#ed5564",
                "title_color" => "#ffffff",
                "text_color" => "#ffffff",
                "icon_color" => "#ffffff"
            )
        )

    )

);
function ideothemo_get_global_style()
{
    if ($cache = ideothemo_global_vars_get('ideo_get_global_style')) {
        return $cache;
    }
    $output = get_theme_mod('global_shortcode_style');
    ideothemo_global_vars_add('ideo_get_colors', $output);
    return $output;
}
