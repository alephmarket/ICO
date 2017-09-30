<?php
if(class_exists('IdeoThemoShortcodeGenerator')){
    class IdeoTableCell extends IdeoThemoShortcodeGenerator
    {
        protected $name = 'Table 4x4 Cell';
        protected $tag = 'tcol';
        protected $visible_list = false;

        public function shortcode($atts, $content = "")
        {
            return '<td>' . do_shortcode($content) . '</td>';
        }
    }

    new IdeoTableCell;
}