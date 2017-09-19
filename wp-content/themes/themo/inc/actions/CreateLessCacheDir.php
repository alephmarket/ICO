<?php

if ( ! class_exists('IdeoThemoCreateLessCacheDir')) {
    class IdeoThemoCreateLessCacheDir
    {
        function __construct()
        {
            add_action( 'after_switch_theme', array( $this, 'after_switch_theme' ) );
        }

        public function after_switch_theme()
        {
            global $wp_filesystem;
            $dir = IDEOTHEMO_CACHE_DIR . 'ideo_get_page_css';
            
            if ( !$wp_filesystem->is_dir( IDEOTHEMO_CACHE_DIR )) {
                wp_mkdir_p( IDEOTHEMO_CACHE_DIR );
            }
            if ( !$wp_filesystem->is_dir( $dir )) {
                wp_mkdir_p( $dir );
            }            
        }
    }

    new IdeoThemoCreateLessCacheDir;
}