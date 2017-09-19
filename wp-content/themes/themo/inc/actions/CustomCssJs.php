<?php

if (!class_exists('IdeoThemoCustomCssJs')) {
    class IdeoThemoCustomCssJs
    {
        function __construct()
        {
            add_action('wp_enqueue_scripts', array($this, 'custom'), 999);
        }

        public function custom()
        {
            $customCss = ideothemo_get_custom_css();
            if (!empty($customCss) || ideothemo_is_customize_preview()) {
                wp_add_inline_style('ideothemo-shortcode', htmlspecialchars_decode($customCss, ENT_QUOTES));
                
            }
            

            $customJs = ideothemo_get_custom_js();
            if (!empty($customJs)) {
                wp_add_inline_script('ideothemo-scripts-config', htmlspecialchars_decode($customJs, ENT_QUOTES));
            }
        }
    }

    new IdeoThemoCustomCssJs;
}