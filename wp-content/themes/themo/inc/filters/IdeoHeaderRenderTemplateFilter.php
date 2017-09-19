<?php

if (!class_exists('IdeoThemoHeaderRenderTemplateFilter')) {
    class IdeoThemoHeaderRenderTemplateFilter
    {
        public function __construct()
        {
            add_filter('template_include', array($this, 'template_include_filter'));
        }

        public function template_include_filter($template)
        {
            if (ideothemo_is_ajax_preview() && isset($_POST['action']) && $_POST['action'] == 'render_page_title') {

                $themeFile = 'parts/header/header.php';

                $templateFile = get_template_directory() . '/' . $themeFile;

                if (file_exists($templateFile)) {
                    $template = $templateFile;
                }
            }

            return $template;
        }
    }
}

new IdeoThemoHeaderRenderTemplateFilter;