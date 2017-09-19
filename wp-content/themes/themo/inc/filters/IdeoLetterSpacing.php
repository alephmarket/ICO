<?php

if (!class_exists('IdeoThemoLetterSpacing')) {
    class IdeoThemoLetterSpacing
    {
        public function __construct()
        {
            add_filter('ideothemo_letter_spacing', array($this, 'filter'), 10, 3);
        }

        public function filter($value)
        {
            if ($value && !strpos($value, 'px')) {
                $value = (float)$value . 'px';
            }

            return $value;
        }
    }
}

new IdeoThemoLetterSpacing;