<?php

if (!function_exists('ideothemo_parse_dot_string')) {
    /**
     * @param $array
     * @param $string
     * @param null $default
     * @param bool $defaultInit
     * @return mixed
     */
    function ideothemo_parse_dot_string($array, $string, $default = null, $defaultInit = true)
    {
        $vars = explode('.', $string);
        foreach ($vars as $var) {
            if (!is_array($array) || !array_key_exists($var, $array))
                return $default;

            $array = $array[$var];
        }

        if ($array === '') return $default;

        return $array;
    }
}