<?php
if(class_exists('IdeoThemoShortcodeGenerator')){
    class IdeoTable4x4Shortcode extends IdeoThemoShortcodeGenerator
    {
        protected $name = 'Table 4x4';
        protected $tag = 'ideo_table';
        protected $visible_list = false;
        protected $default = array
        (
            'type' => 'simple',
            'custom_class' => ''
        );

        public function shortcode($atts, $content = "")
        {
            $atts = shortcode_atts($this->default, $atts);

            return '<table class="ideo-table ' . $atts['type'] . ' ' . $atts['custom_class'] . '">' . do_shortcode($content) . '</table>';
        }
    }

    new IdeoTable4x4Shortcode;
}