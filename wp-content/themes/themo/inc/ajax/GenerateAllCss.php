<?php

if (!class_exists('IdeoThemoGenerateAllCssAjax')) {
    class IdeoThemoGenerateAllCssAjax
    {
        public function __construct()
        {
            add_action('wp_ajax_generate_all_css', array($this, 'ajax'));
        }

        public function ajax()
        {
            $generalCssGenerator = new IdeoThemoGenerateGeneralCss(true);
            $generalCssGenerator->customizer();
            $generalCssGenerator->shortcodes();

            $generalPageCssGenerator = new IdeoThemoGeneratePageCss(true);
            $generalPageCssGenerator->allPages();

            wp_die();
        }
    }

    new IdeoThemoGenerateAllCssAjax;
}