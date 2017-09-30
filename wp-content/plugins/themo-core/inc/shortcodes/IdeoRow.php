<?php
if(class_exists('IdeoThemoShortcodeGenerator')){
    class IdeoThemoRowShortcode extends IdeoThemoShortcodeGenerator
    {
        protected $name = 'Row';
        protected $tag = 'bs_row';
        protected $default = array();
        protected $visible_list = false;

        public function shortcode($atts, $content = "")
        {
            $atts = shortcode_atts($this->default, $atts);
            
            $content = ideothemo_content_p_fix($content);   

            return '<div class="row">' . do_shortcode( $content ) . '</div>';
        }
    }

    new IdeoThemoRowShortcode;
}