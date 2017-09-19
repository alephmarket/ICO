<?php

if (!function_exists('ideothemo_array_expand')) {
    function ideothemo_array_expand($arr_base, $arr_exp)
    {
        return array_replace($arr_base, array_filter($arr_exp));
    }
}