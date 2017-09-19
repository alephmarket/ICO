<?php

if (!class_exists('IdeoThemoBackTopButton')) {
    class IdeoThemoBackTopButton
    {
        function __construct()
        {
            add_action('wp_footer', array($this, 'addButton'), 1);
        }

        public function addButton()
        {
            if (ideothemo_get_back_top_button_enabled()) {
                echo '<a href="#top" class="js--back-top-button back-top-button"><i class="id id-up"></i></a>';
            }
        }
    }

    new IdeoThemoBackTopButton;
}