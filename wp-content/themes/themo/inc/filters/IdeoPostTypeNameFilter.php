<?php

if (!class_exists('IdeoThemoPostTypeNameFilter')) {
    class IdeoThemoPostTypeNameFilter
    {
        public function __construct()
        {
            add_filter('ideothemo_post_type_name', array($this, 'filter'), 10, 3);
        }

        public function filter($label, $post_type, $post_type_object)
        {
            if ($post_type == 'post') {

                return esc_html__('Post', 'themo');

            } elseif ($post_type == 'page') {

                return esc_html__('Page', 'themo');

            } elseif ($post_type == 'team') {

                return esc_html__('Team Member', 'themo');

            } elseif ($post_type == ideothemo_get_portfolio_slug()) {

                return esc_html__('Portfolio Item', 'themo');

            }

            return $label;
        }
    }
}

new IdeoThemoPostTypeNameFilter;