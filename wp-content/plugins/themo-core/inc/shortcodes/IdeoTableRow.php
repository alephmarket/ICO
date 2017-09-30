<?php
if(class_exists('IdeoThemoShortcodeGenerator')){
    class IdeoTableRow extends IdeoThemoShortcodeGenerator
    {
        protected $name = 'Table 4x4 Row';
        protected $tag = 'trow';
        protected $visible_list = false;

        public function shortcode($atts, $content = "")
        {
            return '<tr>' . do_shortcode($content) . '</tr>';
        }
    }

    new IdeoTableRow;
}