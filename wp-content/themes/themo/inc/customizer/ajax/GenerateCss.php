<?php

if (!class_exists('IdeoThemoCustomizerGenerateCssAjax')) {
    class IdeoThemoCustomizerGenerateCssAjax
    {
        public function __construct()
        {
            add_action('wp_ajax_customizerGenerateCss', array($this, 'generate_css'));
        }

        public function generate_css()
        {
            $generate = new IdeoThemoGenerateGeneralCss();
            
            $customizer = $generate->customizer();
            $shortcodes = $generate->shortcodes();
            
            if($customizer === true && $shortcodes == true){
                $output = array('success' => true);                
            }else{
                $output = array('error' => $customizer['error'], 'data' => array('customizer' => $customizer, 'shortcodes' => $shortcodes));
            }
            
            echo json_encode($output);
            die();
        }
    }

    new IdeoThemoCustomizerGenerateCssAjax;
}
