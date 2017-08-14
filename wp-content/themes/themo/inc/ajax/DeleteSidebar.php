<?php

if (!class_exists('IdeoThemoDeleteSidebarAjax')) {
    class IdeoThemoDeleteSidebarAjax
    {
        public function __construct()
        {
            add_action('wp_ajax_deleteSidebar', array($this, 'ajax'));
            add_action('wp_ajax_nopriv_deleteSidebar', array($this, 'ajax'));
        }

        public function ajax()
        {
            if (is_user_logged_in()) {

                $sidebars = ideothemo_get_sidebars(true);

                if ($sidebars === false)
                    wp_send_json_error(array('info' => 'No registered sidebars'));

                $sidebar_id = isset($_POST['sidebar_id']) ? $_POST['sidebar_id'] : '';

                //check if sidebar exsits
                if (isset($sidebars[$sidebar_id])) {

                    //remove sidebar
                    unset($sidebars[$sidebar_id]);

                    //update sidebars list
                    update_option('ideo_sidebars', $sidebars);

                    wp_send_json_success();
                }

                wp_send_json_error(array('info' => 'Sidebar was not found'));
            }

            wp_send_json_error(array('info' => esc_html__('Cheatin uh?', 'themo')));
        }
    }

    new IdeoThemoDeleteSidebarAjax;
}