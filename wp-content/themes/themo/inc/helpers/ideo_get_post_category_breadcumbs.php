<?php

if (!function_exists('ideothemo_get_post_category_breadcumbs')) {
    function ideothemo_get_post_category_breadcumbs($post_id = 0)
    {
        $categories = wp_get_post_categories($post_id, array('orderby' => 'name', 'fields' => 'ids'));

        return isset($categories[0]) ? $categories[0] : false;
    }
}