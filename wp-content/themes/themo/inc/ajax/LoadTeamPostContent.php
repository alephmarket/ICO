<?php

if (!class_exists('IdeoThemoLoadTeamPostContentAjax')) {
    class IdeoThemoLoadTeamPostContentAjax
    {
        public function __construct()
        {
            add_action('wp_ajax_loadTeamPostContent', array($this, 'ajax'));
            add_action('wp_ajax_nopriv_loadTeamPostContent', array($this, 'ajax'));
        }

        public function ajax()
        {
            $post_id = isset($_POST['post_id']) ? absint($_POST['post_id']) : 0;
            
            WPBMap::addAllMappedShortcodes();

            echo ideothemo_get_the_content($post_id);            

            $shortcodes_custom_css = get_post_meta($_POST['post_id'], '_wpb_shortcodes_custom_css', true);
            if (!empty($shortcodes_custom_css)) {
                echo '<style type="text/css" data-type="vc_shortcodes-custom-css">';
                echo $shortcodes_custom_css;
                echo '</style>';
            }

            wp_die();
        }
    }

    new IdeoThemoLoadTeamPostContentAjax;
}