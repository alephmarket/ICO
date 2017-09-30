<?php
if(class_exists('IdeoThemoShortcodeGenerator')){
    class IdeoThemoQuoteShortcode extends IdeoThemoShortcodeGenerator
    {
        protected $name = 'Quote';
        protected $tag = 'quote';
        protected $default = array
        (
            'icon'             => 'small',
            'font_family'      => '',
            'font_size'        => '14px',
            'background_color' => '',
            'text_color'       => '',
            'icon_color'       => '',
            'border_color'	   => '',
            'custom_class'     => ''
        );

        protected $options = array
        (
            'icon' => array( 'none', 'small', 'big' )
        );

        public function shortcode( $atts, $content = "" )
        {
            $atts = shortcode_atts( $this->default, $atts );

            $atts['id'] = uniqid( 'quote_' );

            $class[] = 'itQuote quote';
            $class[] = 'icon-' . $atts['icon'];

            $atts['custom_class'] = !empty($atts['custom_class']) ? ' ' . $atts['custom_class'] : $atts['custom_class'];
            
            $content = ideothemo_content_p_fix($content);   

            return '<blockquote id="' . $atts['id'] . '" class="' . trim( implode( ' ',
                $class ) ) . $atts['custom_class'] . '">' . $content . '</blockquote>' . $this->style( $atts );
        }

        private function style( $vars )
        {
            $args         = array();            
            $args['file_path'] = IDEOTHEMO_LESS_DIR . 'shortcodes/quote.less';

            $args['vars'] = array(
                'id'               => $vars['id'],
                'font_family'      => empty($vars['font_family']) ? 'undefined' : $vars['font_family'],
                'font_size'        => $vars['font_size'],
                'font_weight'      => 'undefined',
                'font_style'       => 'undefined',
                'background_color' => ideothemo_is_color( $vars['background_color'], 'undefined' ),
                'text_color'       => ideothemo_is_color( $vars['text_color'], 'undefined' ),
                'icon_color'       => ideothemo_is_color( $vars['icon_color'], 'undefined' ),
                'border_color'     => ideothemo_is_color( $vars['border_color'], ideothemo_get_general_accent_color()),
            );

            if ($args['vars']['font_family'] != 'undefined') {

                if (strpos($args['vars']['font_family'], '|') === false) {
                    $google_fonts_data = array(
                        $args['vars']['font_family'],
                        'regular',
                        'null'
                    );
                }else{
                    $google_fonts_data = explode('|', $args['vars']['font_family']);                    
                }
                $handle = sanitize_title('ideothemo_google_fonts_' . $google_fonts_data[0] . ':' . $google_fonts_data[1]. ($google_fonts_data[2] != 'null' ? $google_fonts_data[2] : ''));
                wp_enqueue_style($handle, '//fonts.googleapis.com/css?family=' . $google_fonts_data[0] . ':' . $google_fonts_data[1] . '&subset=' . ($google_fonts_data[2] != 'null' ? $google_fonts_data[2] : ''));

                $args['vars']['font_family'] = $google_fonts_data[0];
                $args['vars']['font_weight'] = str_replace('regular', '', str_replace('italic', '', $google_fonts_data[1]));
                if (empty($args['vars']['font_weight']))
                    $args['vars']['font_weight'] = 'undefined';

                $args['vars']['font_style'] = strpos($google_fonts_data[1], 'italic') > -1 ? 'italic' : 'undefined';
            }


            return ideothemo_add_style( '', 'ideo-quote-' . $args['vars']['id'] . '-shortcode-styling-inline-css', $args );
        }
    }

    new IdeoThemoQuoteShortcode;
}