<?php

function ideothemo_filter_masonry_column_classes($classes, $atts)
{
    $bootstrap = array();

    $grids = array(
        'xs' => 'el_mob_cols',
        'sm' => 'el_tab_cols',
        'md' => 'el_desc_cols',
        'lg' => 'el_large_desc_cols'
    );

    foreach ($grids AS $type => $name) {
        if (isset($atts[$name])) {
            $bootstrap[] = 'col-' . $type . '-' . ceil(ideothemo_get_grid_columns() / $atts[$name]);
        }
    }

    return array_merge($classes, $bootstrap);
}
