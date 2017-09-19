<?php
if (!defined('ABSPATH')) {
    die('-1');
}

$atts = vc_map_get_attributes($this->getShortcode(), $atts);

$this->resetVariables($atts, $content);
$tab_index = ideothemo_tab_counter(1);
WPBakeryShortCode_VC_Tta_Section::$section_info[] = $atts;
$isPageEditable = vc_is_page_editable();


$output = '';

$output .= '<div class="tab-pane fade ' . ($tab_index == 1 ? 'in active' : '') . ' ' . esc_attr($this->getElementClasses()) . '"';
$output .= ' id="tab_' . esc_attr($atts['el_uid']) . '"';
$output .= ' >';
$output .= '<div class="vc_tta-panel-body">';

if ($isPageEditable) {
    $output .= '<div data-js-panel-body>';
}
$output .= $this->getTemplateVariable('content');
if ($isPageEditable) {
    $output .= '</div>';
}
$output .= '</div>';
$output .= '</div>';

echo $output;
