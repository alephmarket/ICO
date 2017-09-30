<?php

class IdeoThemoShortcodeGenerator
{
    protected $tag;
    protected $name;
    protected $default = array();
    protected $options = array();
    protected $short = false;
    protected $visible_list = true;
    
    public function __construct()
    {
        add_shortcode($this->tag, array($this, 'shortcode'));
        if($this->visible_list){
            IdeoThemoShortcodeMaps::addShortcode($this->name, $this->tag, $this->default, $this->options, $this->short);
        }
    }

    public function shortcode($atts, $content = "")
    {

    }

    protected function renderStyles($atts)
    {
        $style = array();

        if (isset($atts['text_color']) && !empty($atts['text_color'])) {
            $style[] = 'color: ' . $atts['text_color'];
        }

        if (isset($atts['background_color']) && !empty($atts['background_color'])) {
            $style[] = 'background-color: ' . $atts['background_color'];
        }

        if (isset($atts['border_color']) && !empty($atts['border_color'])) {
            $style[] = 'border-color: ' . $atts['border_color'];
        }

        if (isset($atts['border_thickness']) && !empty($atts['border_thickness'])) {
            $style[] = 'border-width: ' . $atts['border_thickness'];

            $value = intval($atts['border_thickness']);

            if (isset($atts['style']) && $atts['style'] != 'simple' && $value > 1) {
                $style[] = 'line-height: ' . (50 - (2 * $value)) . 'px';
            }
        }

        if (isset($atts['font_family']) && !empty($atts['font_family'])) {
            $style[] = 'font-family: ' . $atts['font_family'];
        }

        if (isset($atts['font_size']) && !empty($atts['font_size'])) {
            $style[] = 'font-size: ' . $atts['font_size'];
        }

        if (!empty($style)) {
            return ' style="' . implode('; ', $style) . '" ';
        }

        return '';
    }
}