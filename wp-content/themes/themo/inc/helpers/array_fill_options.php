<?php

if (!function_exists('ideothemo_array_fill_options')) {
    function ideothemo_array_fill_options($arr_base, $arr_fill)
    {
        return array_replace_recursive($arr_base, $arr_fill);
    }
}

if (!function_exists('ideothemo_array_replace_recursive')) {
    function ideothemo_array_replace_recursive($array, $array1)
    {
        if (!function_exists('ideothemo_recurse')) {
            function ideothemo_recurse($array, $array1)
            {
                foreach ($array1 as $key => $value) {

                    if (!isset($array[$key])) {
                        $array[$key] = '';
                    }


                    if (is_array($value)) {
                        $value = ideothemo_recurse($array[$key], $value);
                    }

                    $array[$key] = $value != '' && $value != 'default' ? $value : $array[$key];
                }
                return $array;
            }
        }


        $args = func_get_args();
        $array = $args[0];
        if (!is_array($array)) {
            return $array;
        }
        for ($i = 1; $i < count($args); $i++) {
            if (is_array($args[$i])) {
                $array = ideothemo_recurse($array, $args[$i]);
            }
        }
        return $array;
    }
}