<?php

if (!class_exists('IdeoThemoFontFamily')) {
    class IdeoThemoFontFamily
    {
        public function __construct()
        {
            add_filter('ideothemo_font_family', array($this, 'filter'), 10, 3);
        }

        public function filter($value)
        {
            if (empty($value)) {
                return ideothemo_get_global_font();
            }

            return $value;
        }
    }
}

new IdeoThemoFontFamily;