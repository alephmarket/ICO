<?php

if (!class_exists('IdeoThemoCustomizerNumber')) {
    class IdeoThemoCustomizerNumber
    {
        public function __construct()
        {
            add_filter('ideothemo_customizer_number', array($this, 'filter'), 10, 3);
        }

        public function filter($value)
        {
            return (float)str_replace(',', '.', preg_replace('/[^0-9,.-]/', '', $value));
        }
    }
}

new IdeoThemoCustomizerNumber;

