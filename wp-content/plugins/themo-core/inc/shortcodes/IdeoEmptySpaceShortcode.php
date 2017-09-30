<?php
if(class_exists('IdeoThemoShortcodeGenerator')){
    class IdeoThemoEmptySpaceShortcode extends IdeoThemoShortcodeGenerator
    {
        protected $name = 'Empty Space';
        protected $tag = 'empty_space';
        protected $default = array
        (
            'height' => '50px',
        );

        public function shortcode($atts, $content = "")
        {
            $atts = shortcode_atts($this->default, $atts);

            return '<div style="height: ' . $atts['height'] . '; width: 100%; float: none; clear: both;"></div>';
        }
    }

    new IdeoThemoEmptySpaceShortcode;
}