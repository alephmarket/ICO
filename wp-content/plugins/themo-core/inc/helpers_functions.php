<?php

$ideothemo_shortcode_index = 0;

if (!function_exists('ideothemo_shortcode_uid')) {
    function ideothemo_shortcode_uid() {
        global $post, $ideothemo_shortcode_index;

        $ideothemo_shortcode_index++;

        return uniqid();
    }
};
