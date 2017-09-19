<?php

if (!class_exists('IdeoThemoRenderBackground')) {
    class IdeoThemoRenderBackground
    {
        public function __construct()
        {
            add_action('wp_head', array($this, 'wp_head'), 0);
            add_action('wp_footer', array($this, 'wp_head'), 0);
            add_action('ideothemo_body_entry_before', array($this, 'body_entry_before'));
            add_action('ideothemo_content_entry_after', array($this, 'content_entry_after'));
        }

        public function wp_head()
        {
            if (ideothemo_is_ajax_preview() && isset($_POST['action']) && in_array($_POST['action'], array('render_boxed_background', 'render_content_background'))) {
                remove_all_actions('wp_head');
                remove_all_actions('wp_footer');
            }
        }

        public function body_entry_before()
        {
            if (ideothemo_is_boxed_version() && ideothemo_get_boxed_background_type(1) == 'video') {
                do_action('ideothemo_page_background_' . ideothemo_get_boxed_background_video_platform(1));
            }
        }

        public function content_entry_after()
        {
            if (ideothemo_get_content_background_type(1) == 'video') {
                do_action('ideothemo_content_background_' . ideothemo_get_content_background_video_platform(1));
            }
        }
    }
}

new IdeoThemoRenderBackground;