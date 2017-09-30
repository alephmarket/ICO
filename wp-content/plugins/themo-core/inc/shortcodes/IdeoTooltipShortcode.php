<?php
if(class_exists('IdeoThemoShortcodeGenerator')){
    class IdeoThemoTooltipShortcode extends IdeoThemoShortcodeGenerator
    {
        protected $name = 'Tooltip';
        protected $tag = 'tooltip';
        protected $default = array
        (
            'text' => 'ENTER TEXT IN TOOLTIP',
            'text_color' => '',
            'background_color' => ''
        );

        public function shortcode($atts, $content = "")
        {
            $id = uniqid("it_tooltip");
            $atts = shortcode_atts($this->default, $atts);

            $css = '';

            if (!empty($atts['background_color'])) {
                $less = '#' . $id . ' {';
                $less .= '.itTooltip_body {';
                $less .= 'border-color: ' . $atts['background_color'] . ';';
                $less .= '&:before { border-top-color: ' . $atts['background_color'] . '}';
                $less .= '}';
                $less .= '}';

                $css = ideothemo_add_style($less, 'vc_shortcodes-custom-css');
            }


            return '<span id="' . $id . '" class="itTooltip">' . $content . ' <span class="itTooltip_body" ' . $this->renderStyles($atts) . '>' . $atts['text'] . '</span></span>' . $css;
        }
    }

    new IdeoThemoTooltipShortcode;
}