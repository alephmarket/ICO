<?php

class IdeoThemoGoogleFontsApi
{
    private $fonts = array();

    public function __construct()
    {
        //GLOBAL
        $this->addFont(ideothemo_get_global_font());

        //THEME OPTIONS
        $this->loadFontsFromThemeOptions();

        //PAGE TITLE
        $this->addFont(ideothemo_get_pagetitle_font_family(), ideothemo_get_pagetitle_font_weight());
        $this->addFont(ideothemo_get_pagetitle_subtitle_font_family(), ideothemo_get_pagetitle_subtitle_font_weight());
        $this->addFont(ideothemo_get_pagetitle_breadcrumbs_font_family(), ideothemo_get_pagetitle_breadcrumbs_font_weight());

        //FOOTER FONTS
        $this->addFont(ideothemo_get_widget_title_font_family(), ideothemo_get_widget_title_font_weight());
        $this->addFont(ideothemo_get_copyright_font_family(), ideothemo_get_copyright_font_weight());

        //SIDEBAR
        $this->addFont(ideothemo_get_sidebar_title_font_family(), ideothemo_get_sidebar_title_font_weight());

        //Header
        $this->addFont(ideothemo_get_header_main_menu_font_family(), ideothemo_get_header_main_menu_font_weight());
        $this->addFont(ideothemo_get_header_submenu_font_family(), ideothemo_get_header_submenu_font_weight());
        $this->addFont(ideothemo_get_header_mega_menu_font_family(), ideothemo_get_header_mega_menu_font_weight());
        $this->addFont(ideothemo_get_header_mega_menu_column_title_font_family(), ideothemo_get_header_mega_menu_column_title_font_weight());
        $this->addFont(ideothemo_get_header_side_menu_font_family(), ideothemo_get_header_side_menu_font_weight());
        $this->addFont(ideothemo_get_header_side_menu_submenu_font_family(), ideothemo_get_header_side_menu_submenu_font_weight());
        $this->addFont(ideothemo_get_header_mobile_menu_font_family(), ideothemo_get_header_mobile_menu_font_weight());

        //SHORTCODES
        $this->addFont(ideothemo_get_button_font_family(), ideothemo_get_button_font_weight());
        
        add_action('wp_enqueue_scripts', array($this, 'wp_enqueue_scripts_action'));
    }

    private function addFont($fontFamily = '', $fontWeight = '')
    {
        if (!empty($fontFamily) && $fontFamily !='default') {
            if (!isset($this->fonts[$fontFamily])) {
                $this->fonts[$fontFamily] = array('ext' => array(), 'weights' => array());
            }

            $this->fonts[$fontFamily]['ext'][] = ideothemo_get_global_font_extension();

            if (!empty($fontWeight)) {
                $this->fonts[$fontFamily]['weights'][] = $fontWeight;
            }


        }
    }

    private function loadFontsFromThemeOptions()
    {
        $tags = array('body', 'link', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p');

        foreach ($tags AS $tag) {
            $fontFamily = ideothemo_get_font_family_tag($tag);
            $fontWeight = ideothemo_get_font_weight_tag($tag);

            $this->addFont($fontFamily, $fontWeight);
        }
    }

    public function renderFontsCss()
    {
        $fonts = array();

        foreach (apply_filters('ideothemo_google_fonts_api_array_fonts', $this->fonts) AS $fontName => $fontDetails) {
            if (!empty($fontName)) {
                $url = '//fonts.googleapis.com/css';

                $name = $fontName;

                //add font weight to font name
                if (!empty($fontDetails['weights'])) {
                    $name .= ':' . implode(',', array_unique($fontDetails['weights']));
                }

                //generate font URL
                $url = add_query_arg(array('family' => $name), $url);

                //add font extension to URL
                if (!empty($fontDetails['ext'])) {
                    $url = add_query_arg(array('subset' => implode(',', array_unique($fontDetails['ext']))), $url);
                }

                $fonts[$fontName] = $url;
            }
        }

        return apply_filters('ideothemo_google_fonts_api_urls', $fonts);
    }

    public function wp_enqueue_scripts_action()
    {
        foreach ($this->renderFontsCss() AS $fontName => $url) {
            wp_enqueue_style('font-' . sanitize_title($fontName), $url);
        }
    }
}
