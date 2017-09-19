<?php

if (!class_exists('IdeoThemoBodyClass')) {
    class IdeoThemoBodyClass
    {
        public function __construct()
        {
            add_filter('body_class', array($this, 'filter'), 10, 3);
        }

        public function filter($classes)
        {
            $classes[] = ideothemo_get_body_font_skin(true);

            return $classes;
        }
    }
}

new IdeoThemoBodyClass;