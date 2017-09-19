<?php

if (!function_exists('ideothemo_get_template_part')) {
    function ideothemo_get_template_part($slug, $name = null, $return = true)
    {
        if ($return)
            ob_start();

        $slug = apply_filters('ideothemo_get_template_part_slug', str_replace('.', '/', $slug));
        $name = apply_filters('ideothemo_get_template_part_name', str_replace('.', '/', $name));

        get_template_part($slug, $name);

        if ($return)
            return apply_filters('ideothemo_get_template_part_return', ob_get_clean());
    }
}