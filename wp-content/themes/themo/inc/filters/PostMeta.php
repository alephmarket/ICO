<?php

if (!class_exists('IdeoThemoPostMeta')) {
    /**
     * Class IdeoPostMeta
     *
     * Filter custom post meta - get value from array
     */
    class IdeoThemoPostMeta
    {
        public function __construct()
        {
            add_filter('get_post_metadata', array($this, 'filter'), 10, 4);
        }

        public function filter($value, $object_id, $meta_key, $single)
        {
            $fields = apply_filters('ideothemo_post_meta_fields', array('member_position', 'member_name', 'portfolio_title', 'portfolio_subtitle'));
            $social_fields = apply_filters('ideothemo_post_meta_team_social_fields', array('behance-square', 'dribbble', 'facebook-square', 'flickr', 'google-plus-square', 'instagram', 'linkedin-square', 'pinterest-square', 'reddit-square', 'skype', 'soundcloud', 'tumblr-square', 'twitter-square', 'vimeo-square', 'vk', 'xing-square', 'youtube-square'));

            /**
             * If meta key is in array then return value
             */
            if (in_array($meta_key, $fields)) {
                return ideothemo_get_custom_post_meta($meta_key, $object_id);
            }

            /**
             * Get social value from member social
             */

            if (get_post_type($object_id) == 'team' && substr($meta_key, 0, 14) == 'member_social_') {
                $meta_key = str_replace('member_social_', '', $meta_key);

                if (in_array($meta_key, $social_fields)) {
                    return ideothemo_get_custom_post_meta('member_social.' . $meta_key, $object_id);
                }
            }

            return $value;
        }
    }
}

new IdeoThemoPostMeta;