<?php

if (!function_exists('ideothemo_blog_sc')) {
    function ideothemo_blog_sc($atts)
    {
        wp_enqueue_script('ideoteam-isotope');
        $html = ideothemo_get_blog_html($atts);
        return $html;
    }
}