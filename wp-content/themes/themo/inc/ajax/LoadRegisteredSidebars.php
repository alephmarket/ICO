<?php

if (!class_exists('IdeoThemoLoadRegisteredSidebarsAjax')) {
    class IdeoThemoLoadRegisteredSidebarsAjax
    {
        public function __construct()
        {
            add_action('wp_ajax_loadRegisteredSidebars', array($this, 'ajax'));
            add_action('wp_ajax_nopriv_loadRegisteredSidebars', array($this, 'ajax'));
        }

        public function ajax()
        {
            wp_send_json_success(ideothemo_get_sidebars(true));
        }
    }

    new IdeoThemoLoadRegisteredSidebarsAjax;
}