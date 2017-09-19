<?php

if (!class_exists('IdeoThemoFooterTags')) {
    class IdeoThemoFooterTags
    {
        function __construct()
        {
            add_action('wp_footer', array($this, 'tags'), 999);
        }

        public function tags()
        {
            echo apply_filters('ideothemo_footer_tags', ideothemo_get_advanced_body_tags());
        }
    }

    new IdeoThemoFooterTags;
}