<?php

if (!class_exists('IdeoThemoAdminMenu')) {
    class IdeoThemoAdminMenu
    {
        function __construct()
        {
            add_action('admin_menu', array($this, 'admin_menu'), 99);
        }

        public function admin_menu()
        {
            if(!defined('IDEOTHEMO_CORE_VERSION')){
                add_theme_page( 'Themo Options', 'Themo Options', 'customize', 'customize.php', '','dashicons-admin-generic');                
            }
        }
    }

    new IdeoThemoAdminMenu;
}