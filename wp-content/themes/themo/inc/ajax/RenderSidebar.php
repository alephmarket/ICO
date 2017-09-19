<?php

if (!class_exists('IdeoThemoRenderSidebarAjax')) {
    class IdeoThemoRenderSidebarAjax
    {
        public function __construct()
        {
            add_action('wp_ajax_render_sidebar', array($this, 'ajax'));
            add_action('wp_ajax_nopriv_render_sidebar', array($this, 'ajax'));
        }

        public function ajax()
        {
            $sidebar = filter_input(INPUT_GET, 'sidebar');
            if(is_active_sidebar($sidebar)){
                echo dynamic_sidebar($sidebar);                
            }
            wp_die();
        }
    }

    new IdeoThemoRenderSidebarAjax;
}