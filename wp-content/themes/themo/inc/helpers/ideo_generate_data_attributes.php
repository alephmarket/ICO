<?php

if (!function_exists('ideothemo_generate_data_attributes')) {
    function ideothemo_generate_data_attributes($data)
    {
        $html = '';

        foreach ($data AS $id => $value) {
            if (is_array($value)) {
                $value = implode(',', array_values($value));
            }

            if (!empty($value)) {
                $html .= ' data-' . $id . '="' . $value . '"';
            }
        }

        return trim($html);
    }
}