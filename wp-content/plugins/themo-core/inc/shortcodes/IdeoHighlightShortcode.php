<?php
if(class_exists('IdeoThemoShortcodeGenerator')){

    class IdeoThemoHighlightShortcode extends IdeoThemoShortcodeGenerator
    {
        protected $name = 'Highlight';
        protected $tag = 'highlight';
        protected $default = array
        (
            'text_color' => '',
            'background_color' => '',
        );

        public function shortcode($atts, $content = "")
        {
            $atts = shortcode_atts($this->default, $atts);

            $class[] = 'highlight';

            return '<span class="' . implode(' ', $class) . '"' . $this->renderStyles($atts) . '>' . $content . '</span>';
        }
    }

    new IdeoThemoHighlightShortcode;
}