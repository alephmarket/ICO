<?php

if (!function_exists('ideothemo_controls_html')) {
    function ideothemo_controls_html($atts = array(), $echo = true)
    {

        extract(shortcode_atts(array(
            'type' => '',
            'name' => '',
            'id' => '',
            'label' => '',
            'button_label' => esc_html__('Choose', 'themo'),
            'class' => '',
            'value' => '',
            'min' => 0,
            'max' => 0,
            'step' => '',
            'options' => array(),
            'description' => '',
            'placeholder' => '',
        ), $atts));

        $html = '';
        $html .= '<div class="ideo-row ' . esc_attr($class) . '">';
        $html .= '    <div class="ideo-label">';
        $html .= '        <h5>' . esc_html($label) . '</h5>';
        $html .= '        <p>' . esc_html($description) . '</p>';
        $html .= '    </div>';
        $html .= '    <div class="ideo-control">';
        $html .= '       <div class="ideo-' . esc_attr($type) . '">';

        switch ($type) {
            case 'buttonset':
                foreach ($options as $option) {
                    $html .= '<input type="radio" id="' . esc_attr($id) . '_' . esc_attr($option[0]) . '"  name="' . esc_attr($name) . '" value="' . esc_attr($option[0]) . '" ' . checked($value, $option[0], false) . ' /><label for="' . esc_attr($id) . '_' . esc_attr($option[0]) . '">' . esc_html($option[1]) . '</label>';
                }
                break;
            case 'slider':
                $html .= '<input type="text" name="' . esc_attr($name) . '" value="' . esc_attr($value) . '" data-min="' . esc_attr($min) . '" data-max="' . esc_attr($max) . '" data-step="' . esc_attr($step) . '">';
                break;
            case 'switcher':
                $html .= '<input type="hidden" id="' . esc_attr($id) . '" name="' . esc_attr($name) . '" value="' . esc_attr($value) . '"><label for="' . esc_attr($id) . '" data-value-on="' .  esc_attr($options[0][0]) . '" data-value-off="' .  esc_attr($options[1][0]) . '"><span class="on" data-value="' .  esc_attr($options[0][0]) . '">' . esc_html($options[0][1]) . '</span><span class="off" data-value="' .  esc_attr($options[1][0]) . '">' . esc_html($options[1][1]) . '</span></label>';
                break;
            case 'colorpicker':
                $html .= '<input type="text" name="' . esc_attr($name) . '" value="' . esc_attr($value) . '" class="colorpicker" data-alpha="true">';
                break;
            case 'textfield':
                $html .= '<input type="text" id="' . esc_attr($id) . '" name="' . esc_attr($name) . '" value="' . esc_attr($value) . '"  placeholder="' .  esc_attr($placeholder) . '" />';
                break;
            case 'textarea':
                $html .= '<textarea id="' . esc_attr($id) . '" name="' . esc_attr($name) . '" placeholder="' .  esc_attr($placeholder) . '" >' . esc_attr($value) . '</textarea>';
                break;
            case 'attach-image':
                $html .= '<input type="text" name="' . esc_attr($name) . '" value="' . esc_attr($value) . '" class="attach-image"><a href="#" class="ideo-button">' . esc_html($button_label) . '</a>';
                break;
            case 'gallery':
                $html .= '<input id="gallery_image" type="hidden" name="' . esc_attr($name) . '" value="' . esc_attr($value) . '" class="attach-image">';
                $html .= '<div id="gallery_images_container" class="sortable">';

                if (isset($value) && !empty($value)) {
                    foreach (ideothemo_get_photos_from_array(explode(',', $value)) AS $attachment_id => $photo) {
                        $html .= '<img for="gallery_image" data-id="' .  esc_attr($attachment_id) . '" src="' . esc_url($photo) . '" alt="">';
                    }
                }
                $html .= '</div>';

                $html .= '<button data-images_ids="gallery_image" data-images_container="gallery_images_container" data-uploader_title="' . esc_html__('Photos Gallery', 'themo') . '" type="button" data-multiple="true" id="gallery_image_btn" class="ideo-button">' . esc_html__('Select photos', 'themo') . '</button>';

                break;

            case 'video':
                $html .= '<input id="video_url" type="text" name="' . esc_attr($name) . '" value="' . esc_attr($value) . '" class="attach-image">';
                $html .= '<button data-images_ids="video_url" data-type="url" data-uploader_title="' . esc_html__('Video', 'themo') . '" type="button" data-multiple="false" id="video_button" class="ideo-button">' . esc_html__('Choose', 'themo') . '</button>';

                break;

            case 'audio':
                $html .= '<input id="audio_url" type="text" name="' . esc_attr($name) . '" value="' . esc_attr($value) . '" class="attach-image">';
                $html .= '<button data-images_ids="audio_url" data-type="url" data-uploader_title="' . esc_html__('Audio', 'themo') . '" type="button" data-multiple="false" id="audio_button" class="ideo-button">' . esc_html__('Choose', 'themo') . '</button>';

                break;

            case 'selectmenu':
                $html .= '          <select id="' . esc_attr($id) . '"  name="' . esc_attr($name) . '">';
                foreach ($options as $key => $option) {

                    if (is_array($option)) {
                        $html .= '<option value="' . esc_attr($option[0]) . '" ' . selected($value, $option[0], false) . '>' . esc_html($option[1]) . '</option>';
                    } else {
                        $html .= '<option value="' .  esc_attr($key) . '" ' . selected($value, $key, false) . '>' . esc_html($option) . '</option>';
                    }
                }
                $html .= '          </select>';
                break;

            case 'select':
                $html .= '          <select id="' . esc_attr($id) . '"  name="' . esc_attr($name) . '">';
                foreach ($options as $key => $option) {
                    $html .= '<option value="' .  esc_attr($key) . '" ' . selected($value, $key, false) . '>' . esc_html($option) . '</option>';
                }
                $html .= '          </select>';
                break;

            default:
                $html .= 'no type';

        }
        $html .= '       </div>';
        $html .= '    </div>';
        $html .= '</div>';


        if ($echo) {
            echo $html;
        } else {
            return $html;
        }
    }
}