<?php

class IdeoThemoShortcodeMaps
{
    private static $allowedShortcodes = array
    (
        'ideo_icon_simple',
        'ideo_icon_advanced'
    );

    private static $shortcodes = array();

    public static function addShortcode($name, $tag, $parms, $options = array(), $short = false)
    {
        $shortcode = array();
        $shortcode['name'] = $name;
        $shortcode['default'] = !empty($parms) ? $parms : false;
        $shortcode['options'] = !empty($options) ? $options : false;
        $shortcode['short'] = !empty($short) ? $short : false;

        static::$shortcodes[$tag] = $shortcode;
    }

    public static function getShortcodes()
    {
        return static::$shortcodes;
    }

    public static function addVcShortcode($shortcode)
    {
        if (in_array($shortcode['base'], static::$allowedShortcodes)) {

            $params = $options = array();

            foreach ($shortcode['params'] AS $param) {
                if (isset($param['value'])) {

                    //if params is array
                    if (is_array($param['value'])) {

                        //save all options
                        $_params = array_filter(array_values($param['value']));
                        $options[$param['param_name']] = $_params;

                        //first option as default option
                        $param['value'] = isset($_params[0]) ? $_params[0] : '';
                    }

                    $params[$param['param_name']] = $param['value'];
                }
            }

            static::addShortcode($shortcode['name'], $shortcode['base'], $params, $options);
        }

        return false;
    }
}