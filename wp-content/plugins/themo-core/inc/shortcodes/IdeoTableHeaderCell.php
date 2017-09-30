<?php
if(class_exists('IdeoThemoShortcodeGenerator')){
    class IdeoTableHeaderCell extends IdeoThemoShortcodeGenerator
    {
        protected $name = 'Table 4x4 Header Cell';
        protected $tag = 'thcol';
        protected $visible_list = false;

        public function shortcode($atts, $content = "")
        {
            return '<th>' . do_shortcode($content) . '</th>';
        }
    }

    new IdeoTableHeaderCell;
}