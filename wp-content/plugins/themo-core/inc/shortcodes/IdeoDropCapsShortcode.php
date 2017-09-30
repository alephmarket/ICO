<?php
if(class_exists('IdeoThemoShortcodeGenerator')){
    
    class IdeoThemoDropCapsShortcode extends IdeoThemoShortcodeGenerator
    {
        protected $name = 'DropCaps';
        protected $tag = 'dropcaps';
        protected $default = array
        (
            'style' => 'simple',
            'text_color' => '',
            'background_color' => '',
            'border_color' => '',
            'border_thickness' => '1px'
        );

        protected $options = array
        (
            'style' => array('simple', 'square', 'circle')
        );

        public function shortcode($atts, $content = "")
        {
            $atts = shortcode_atts($this->default, $atts);

            $firstLetter = mb_substr($content, 0, 1);
            $content = mb_substr($content, 1);

            $class[] = 'itDropc';
            $class[] = $atts['style'];

            return '<span class="' . implode(' ', $class) . '"' . $this->renderStyles($atts) . '>' . $firstLetter . '</span>' . $content;
        }
    }

    new IdeoThemoDropCapsShortcode;
}