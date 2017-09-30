<?php

function ideothemo_sc_social_icon($atts,$content=""){
    $atts = shortcode_atts( array(
		'icon' => '',
		'size' => '',
		'url' => '',
		'target' => '_blank',
		'title' => '',
		'icon_color' => '',
        'hover_color' => ''
	), $atts, 'social_icons' );

    $el_uid = uniqid('social_icons_');

    $atts['icon_color'] = ideothemo_is_color($atts['icon_color'], ideothemo_get_general_accent_color());

    if (empty($atts['size']))
        $atts['size'] = '16px';

    $less = '#' . $el_uid . ' {';

    $less .= 'padding: 0 0.1em;';
    $less .= 'font-size:'.$atts['size'].';';
    $less .= 'color:'.$atts['icon_color'].';';

    if (empty($atts['hover_color']))
        $atts['hover_color'] = $atts['icon_color'] . ' - #222';

    $less .= '&:hover{ color: ' . $atts['hover_color'] . ';}';

    $less .= '}';

    $html = '';

    if (empty($atts['url']))
        $html .= '<span';
    else
        $html .= '<a href="' . esc_url($atts['url']) . '"';

    $html .= ' title="'.esc_attr($atts['title']).'" class="ideo-social-icon" id="' . esc_attr($el_uid) . '" ' . (empty($atts['target']) ? '' : ('target="' .  esc_attr($atts['target']) . '"')) . '>';
    $html .= '<i class="fa '.  esc_attr($atts['icon']) . ' fa-fw"></i>';

    if (empty($atts['url']))
        $html .= '</span>';
    else
        $html .= '</a>';

    return $html . ideothemo_add_style($less);
}