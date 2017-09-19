<?php

if ( ! class_exists('IdeoThemoYoutube')) {
    class IdeoThemoYoutube
    {
        function __construct()
        {
            add_action( 'ideothemo_header_background_tag', array( $this, 'header_background_tag' ), 99 );
            add_action( 'ideothemo_body_tag', array( $this, 'body_tag' ), 99 );
            add_action( 'ideothemo_content_tag', array( $this, 'content_tag' ), 99 );
        }

        /**
         * Page Title
         */

        public function header_background_tag()
        {
            if (ideothemo_page_title_area_enabled() && ideothemo_get_pt_area_background( 1 ) == 'video') {
            	if (!wp_is_mobile() && ideothemo_get_pt_background_video_platform( 1 ) == 'youtube') {
	                wp_enqueue_script('youtubebackground');
	                echo ' data-youtube_id="' . ideothemo_get_pt_background_youtube( 1 ) . '" ';
            	}
            	
            	if (/*wp_is_mobile() &&*/ ideothemo_get_pt_background_fallback_image(1)) {
            		echo sprintf(' style="background-image:url(\'%s\');"', ideothemo_get_pt_background_fallback_image(1));
            	}
            }
        }

        /**
         * Body
         */

        public function body_tag()
        {
            if (ideothemo_get_boxed_background_type( 1 ) == 'video' && ideothemo_get_boxed_background_video_platform( 1 ) == 'youtube' && ideothemo_is_boxed_version()) {
                echo ' data-youtube_id="' . ideothemo_get_boxed_background_youtube( 1 ) . '" ';
            }
        }

        /**
         * #content
         */
        public function content_tag()
        {
            if (ideothemo_get_content_background_type( 1 ) == 'video' && ideothemo_get_content_background_video_platform( 1 ) == 'youtube') {
                echo ' data-youtube_id="' . ideothemo_get_content_background_youtube( 1 ) . '" ';
            }
        }
    }

    new IdeoThemoYoutube;
}