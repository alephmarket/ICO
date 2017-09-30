<?php
if(class_exists('IdeoThemoShortcodeGenerator')){
    class IdeoThemoColumnShortcode extends IdeoThemoShortcodeGenerator
    {
        protected $name = 'Column';
        protected $tag = 'bs_column';
        protected $default = array('width' => 12);
        protected $visible_list = false;

        public function shortcode($atts, $content = "")
        {
            $atts = shortcode_atts($this->default, $atts);
            
            $width = explode('/', $atts['width']);
            $col = (12 / $width[1]) * $width[0];
            
            $content = ideothemo_content_p_fix($content);              

            return '<div class="col-sm-' . $col . '">' . do_shortcode( $content ) . '</div>';
        }
    }

    new IdeoThemoColumnShortcode;
}