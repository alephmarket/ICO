<?php

if (!function_exists('ideothemo_get_photos_from_array')) {
    function ideothemo_get_photos_from_array($ids, $size = 'thumbnail')
    {
        if (!empty($ids)) {

            $images = array();

            foreach ($ids as $attachment_id) {
                $attachment_id = absint(trim($attachment_id));
                if (!empty($attachment_id)) {
                    $image_src = wp_get_attachment_image_src($attachment_id, $size);
                    if ($image_src) {
                        $images[$attachment_id] = $image_src[0];
                    }
                }
            }

            return $images;
        }

        return false;
    }
}