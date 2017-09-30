<?php
if(class_exists('IdeoThemoShortcodeGenerator')){
    class IdeoThemoTableShortcode extends IdeoThemoShortcodeGenerator
    {
        protected $name = 'Table';
        protected $tag = 'table';
        protected $visible_list = false;
        protected $default = array
        (
            'title_backgr_color' => '',
            'title_text_color' => '',
            'odd_rows_backgr_color' => '#f1f1f1',
            'odd_rows_backgr_text_color' => '',
            'even_rows_backgr_color' => '#e5e1e1',
            'even_rows_backgr_text_color' => '',
        );

        public function shortcode($atts, $content = "")
        {
            $atts = shortcode_atts($this->default, $atts);

            $atts['id'] = uniqid('table_');

            return '<div id="' . $atts['id'] . '">' . trim($content) . $this->style($atts) . '</div>';
        }

        private function style($vars)
        {
            $args = array();
            $args['file_path'] = IDEOTHEMO_LESS_DIR . 'shortcodes/table.less';

            foreach ($vars as $var => $value) {
                $args['vars'][$var] = ideothemo_is_color($value, 'undefined');
            }

            $args['vars']['id'] = $vars['id'];

            return ideothemo_add_style('', 'ideo-table-' . $args['vars']['id'] . '-shortcode-styling-inline-css', $args);
        }
    }

    new IdeoThemoTableShortcode;
}