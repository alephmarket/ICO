<?php

// Exit if accessed directly
if (!defined('ABSPATH')) { 
	exit;
}

$js = '<script type="text/javascript">jQuery(document).ready(function(){';
$js .= sprintf('if (typeof jQuery != "undefined" && typeof jQuery.fn != "undefined" && typeof jQuery.fn.theGridSetup != "undefined") jQuery("#' . $tg_grid_data['ID'] . '").theGridSetup({modalWindow: true, %s easingIn: "%s", easingOut: "%s", easingInDuration: %s, easingOutDuration: %s, accentColor: "#FFF"});',
		!empty($tg_grid_data['modal_window_linking_css_selector']) ?  sprintf('modalWindowLinking: "%s",', $tg_grid_data['modal_window_linking_css_selector']) : null,
		!empty($tg_grid_data['modal_window_easing_in']) ? $tg_grid_data['modal_window_easing_in'] : 'none',
		!empty($tg_grid_data['modal_window_easing_out']) ? $tg_grid_data['modal_window_easing_out'] : 'none',
		!empty($tg_grid_data['modal_window_easing_in_duration']) ? $tg_grid_data['modal_window_easing_in_duration'] : '1.5',
		!empty($tg_grid_data['modal_window_easing_out_duration']) ? $tg_grid_data['modal_window_easing_out_duration'] : '1.5'
		);

$js .= '});</script>';

echo $js;
