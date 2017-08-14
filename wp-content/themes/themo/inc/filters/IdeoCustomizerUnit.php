<?php

if (!class_exists('IdeoThemoCustomizerUnit')) {
    class IdeoThemoCustomizerUnit
    {
        public function __construct()
        {
            add_filter('ideothemo_customizer_unit', array($this, 'filter'), 10, 2);
        }

        /**
         * Get unit from string
         *
         * @see: http://www.w3schools.com/cssref/css_units.asp
         *
         * @param string $value
         * @param string $default
         *
         * @return string
         */
        public function filter($value, $default = 'px')
        {
            //list of acceptance css units
            $units = array('px', 'em', 'pt', '%', 'cm', 'mm', 'in', 'pt', 'pc', 'ch', 'rem', 'vw', 'vmin', 'vmax');
            foreach ($units AS $unit) {
                if (strpos(strtolower($value), strtolower($unit)) !== false) {
                    return $unit;
                }
            }
            return $default;
        }
    }
}

new IdeoThemoCustomizerUnit;
