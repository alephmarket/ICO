<?php

if (!function_exists('ideothemo_input_html')) {
    function ideothemo_input_html($atts = array(), $echo = true)
    {
        extract(shortcode_atts(array(
            'name' => '',
            'id' => '',
            'label' => '',
            'class' => '',
            'value' => '',
            'placeholder' => '',
            'description' => ''
        ), $atts));

        if (!isset($value)) $value = '';

        $html = '';
        $html .= '<label for="' . esc_attr($id) . '">';
        $html .= esc_html($label);
        $html .= '</label> ';
        $html .= '<input type="text" id="' . esc_attr($id) . '" class="' . esc_attr($class) . '" name="' . esc_attr($name) . '" value="' . esc_attr($value) . '"  placeholder="' . esc_attr($placeholder) . '" />';
        $html .= '<p>' . esc_html($description) . '</p>';

        if ($echo) {
            echo $html;
        } else {
            return $html;
        }
    }
}

if (!function_exists('ideothemo_select_html')) {
    function ideothemo_select_html($atts = array(), $echo = true)
    {

        extract(shortcode_atts(array(
            'name' => '',
            'id' => '',
            'label' => '',
            'class' => '',
            'value' => '',
            'options' => array(),
            'description' => ''
        ), $atts));

        $html = '';
        $html .= '<label for="' .  esc_attr($id) . '">';
        $html .= esc_html($label);
        $html .= '</label> ';
        $html .= '<select id="' .  esc_attr($id) . '" class="' .  esc_attr($class) . '" name="' .  esc_attr($name) . '">';
        foreach ($options as $option) {
            $html .= '<option value="' .  esc_attr($option[0]) . '" ' . selected($value, $option[0], false) . '>' . esc_html($option[1]) . '</option>';
        }
        $html .= '</select>';
        $html .= '<p>' . esc_html($description) . '</p>';

        if ($echo) {
            echo $html;
        } else {
            return $html;
        }
    }
}

if (!function_exists('ideothemo_normalize_text')) {
    function ideothemo_normalize_text($text, $use_br = false)
    {
        if (!empty($text))
            $text = str_replace(chr(7), $use_br ? '<br/>' : "\r\n", $text);

        return $text;
    }
}