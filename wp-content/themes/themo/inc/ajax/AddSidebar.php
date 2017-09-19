<?php

if (!class_exists('IdeoThemoAddSidebarAjax')) {
    class IdeoThemoAddSidebarAjax
    {
        public function __construct()
        {
            add_action('wp_ajax_addSidebar', array($this, 'ajax'));
            add_action('wp_ajax_nopriv_addSidebar', array($this, 'ajax'));
        }

        public function ajax()
        {
            if (is_user_logged_in()) {

                $sidebars = ideothemo_get_sidebars(true);

                if (!is_array($sidebars))
                    $sidebars = array();

                $name = isset($_POST['name']) ? esc_sql(esc_html($_POST['name'])) : '';
                $slug = sanitize_title($name);

                if (empty($name))
                    wp_send_json_error(array('info' => esc_html__('Add sidebar name', 'themo')));

                if (!isset($sidebars[$slug])) {
                    $sidebars[$slug] = $name;
                }

                update_option('ideo_sidebars', $sidebars);

                wp_send_json_success();
            }

            wp_send_json_error(array('info' => esc_html__('Cheatin uh?', 'themo')));
        }
    }

    new IdeoThemoAddSidebarAjax;
}