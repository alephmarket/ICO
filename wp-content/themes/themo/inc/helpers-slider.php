<?php

if (!function_exists('ideothemo_get_slider')) {

    function ideothemo_get_slider()
    {
        $slider_settings = ideothemo_get_page_setting('slider', 1);

        if ($slider_settings['plugin'] == 'ls' && defined('LS_PLUGIN_VERSION')) {
            return '[layerslider id="' . (int)$slider_settings['ls'] . '"]';
        }

        if ($slider_settings['plugin'] == 'rs' && class_exists('GlobalsRevSlider')) {

            $slider = new RevSlider();
            $arrSliders = $slider->getArrSliders();

            foreach ($arrSliders as $slider) {
                if ($slider_settings['rs'] == $slider->getID()) {
                    $shortcode = $slider->getShortcode();
                    return $shortcode;
                }
            }
        }

        return false;
    }

}
if (!function_exists('ideothemo_is_slider_used')) {

    function ideothemo_is_slider_used()
    {
        $slider_settings = ideothemo_get_page_setting('slider', 1);

        if ($slider_settings['plugin'] == 'ls' || $slider_settings['plugin'] == 'rs') {
            return true;
        }
        return false;
    }

}
