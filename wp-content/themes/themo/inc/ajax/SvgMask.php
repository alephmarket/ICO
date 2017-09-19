<?php

if ( ! class_exists('IdeoThemoSvgMask')) {
    class IdeoThemoSvgMask
    {
        public function __construct()
        {
            add_action( 'wp_ajax_svgmask_preview', array( $this, 'ajax' ) );
        }

        public function ajax()
        {
            header('Content-type: image/svg+xml');

            $mask  = isset( $_GET['mask'] ) ? basename( $_GET['mask'] ) : '';
            
            if( isset( $_GET['color'] ) ) {                
                $color = $this->get_color($_GET['color'], '#f00');                
            } else {
                $color = '#f00'; 
            } 
            if( isset( $_GET['color2'] ) ) {                
                $secondColor = $this->get_color($_GET['color2'], '#fff');                
            } else {
                $secondColor = '#fff'; 
            }            
            
            $radius = isset( $_GET['radius'] ) ? ideothemo_is_number($_GET['radius']) : '46';
            $stroke = isset( $_GET['stroke'] ) ? ideothemo_is_number($_GET['stroke']) : '1';

            if( isset( $_GET['mask'] ) && strpos($_GET['mask'], 'dividers')  === 0) {
                $maskFile = 'svg/' . esc_html($_GET['mask']);
            } else if (preg_match('/\.svg$/i', $mask)) {
                $maskFile = 'svg/' . $mask;
            } else {
                $maskFile = 'svg/masks/' . $mask . '.svg';
            }
            
            echo ideothemo_get_assets_svg( $maskFile , $color , $secondColor, $radius, $stroke, false);

            die();
        }
        
        function get_color($color, $default) {
            
            $color = str_replace('rgb_','rgb(',$color);
            $color = str_replace('rgba_','rgba(',$color);
            $color = str_replace('_',')',$color);

            return  ideothemo_is_color($color)? : $default;
          
        }
    }

    new IdeoThemoSvgMask;
}
