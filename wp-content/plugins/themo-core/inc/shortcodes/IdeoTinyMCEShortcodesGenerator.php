<?php

class IdeoThemoTinyMCEShortcodesGenerator
{
    protected static $columns = array(
        array(
            'Icon',
            'ideo_icons el_style="advanced" el_radius="0" el_border_weight="1" el_icon="fa fa-star-o" el_size="35" el_hover="true" el_icon_display="inline" el_float="left" el_icon_animation="" el_margin_top="20" el_margin_right="20" el_margin_bottom="20" el_margin_left="20" el_element_style="colored-dark" el_element_style_colors="{\'icon_background_color\':\'\',\'icon_color\':\'\',\'icon_border_color\':\'\',\'icon_background_hover_color\':\'\',\'icon_hover_color\':\'\',\'icon_hover_border_color\':\'\'}" el_animation="viewport" el_animation_type="" el_uid=""'
        ),
        array(
            'Icon list',
            'ideo_custom_list el_font_family="Open Sans|regular|latin-ext" el_font_size="" el_line_height="" el_letter_spacing="" el_icon="fa fa-check active" el_icon_size="" el_icon_margin="10px" el_margin_top="21" el_margin_bottom="21" el_margin_left="1" el_element_style="transparent-dark" el_element_style_colors="{\'text_color\':\'\',\'icon_color\':\'\'}" el_animation="viewport" el_animation_type="flash" el_uid=""]
<ul>
	<li>Lorem 1</li>
	<li>Lorem 2</li>
	<li>Lorem 3</li>
	<li>Lorem 4</li>
</ul>
[/ideo_custom_list'
        ),  
        
        array(
            'Divider',
            'vc_separator el_type="dividers/thin-dotted-line.svg" el_width_percentages="25" el_align="center" el_element_style="transparent-dark" el_element_style_colors="{\'text_color\':\'\'}" el_margin_top="20" el_margin_bottom="20" el_animation="viewport" el_animation_type="bounce" el_uid=""'
        ),
        array(
            'Table 4x4',
            'ideo_table type="simple" custom_class=""]<br/>[trow]<br/>[thcol]HEAD COL 1[/thcol]<br/>[thcol]HEAD COL 2[/thcol]<br/>[thcol]HEAD COL 3[/thcol]<br/>[thcol]HEAD COL 4[/thcol]<br/>[/trow]<br/>[trow]<br/>[tcol]ROW 1 COL 1[/tcol]<br/>[tcol]ROW 1 COL 2[/tcol]<br/>[tcol]ROW 1 COL 3[/tcol]<br/>[tcol]ROW 1 COL 4[/tcol]<br/>[/trow]<br/>[trow]<br/>[tcol]ROW 2 COL 1[/tcol]<br/>[tcol]ROW 2 COL 2[/tcol]<br/>[tcol]ROW 2 COL 3[/tcol]<br/>[tcol]ROW 2 COL 4[/tcol]<br/>[/trow]<br/>[trow]<br/>[tcol]ROW 3 COL 1[/tcol]<br/>[tcol]ROW 3 COL 2[/tcol]<br/>[tcol]ROW 3 COL 3[/tcol]<br/>[tcol]ROW 3 COL 4[/tcol]<br/>[/trow]<br/>[trow]<br/>[tcol]ROW 4 COL 1[/tcol]<br/>[tcol]ROW 4 COL 2[/tcol]<br/>[tcol]ROW 4 COL 3[/tcol]<br/>[tcol]ROW 4 COL 4[/tcol]<br/>[/trow]<br/>[/ideo_table'
        ),
        array(
            'Columns: 1/2 + 1/2',
            'bs_row][bs_column width="1/2"][/bs_column][bs_column width="1/2"][/bs_column][/bs_row'
        ),
        array(
            'Columns: 1/3 + 2/3',
            'bs_row][bs_column width="1/3"][/bs_column][bs_column width="2/3"][/bs_column][/bs_row'
        ),
        array(
            'Columns: 2/3 + 1/3',
            'bs_row][bs_column width="2/3"][/bs_column][bs_column width="1/3"][/bs_column][/bs_row'
        ),
        array(
            'Columns: 1/3 + 1/3 + 1/3',
            'bs_row][bs_column width="1/3"][/bs_column][bs_column width="1/3"][/bs_column][bs_column width="1/3"][/bs_column][/bs_row'
        ),
        array(
            'Columns: 1/4 + 1/4 + 1/4 + 1/4',
            'bs_row][bs_column width="1/4"][/bs_column][bs_column width="1/4"][/bs_column][bs_column width="1/4"][/bs_column][bs_column width="1/4"][/bs_column][/bs_row'
        ),
        array(
            'Columns: 1/4 + 3/4',
            'bs_row][bs_column width="1/4"][/bs_column][bs_column width="3/4"][/bs_column][/bs_row'
        ),
        array(
            'Columns: 3/4 + 1/4',
            'bs_row][bs_column width="3/4"][/bs_column][bs_column width="1/4"][/bs_column][/bs_row'
        ),
        array(
            'Columns: 1/4 + 1/2 + 1/4',
            'bs_row][bs_column width="1/4"][/bs_column][bs_column width="1/2"][/bs_column][bs_column width="1/4"][/bs_column][/bs_row'
        ),
        array(
            'Columns: 5/6 + 1/6',
            'bs_row][bs_column width="5/6"][/bs_column][bs_column width="1/6"][/bs_column][/bs_row'
        ),
        array(
            'Columns: 1/6 + 5/6',
            'bs_row][bs_column width="1/6"][/bs_column][bs_column width="5/6"][/bs_column][/bs_row'
        ),
        array(
            'Columns: 1/6 + 1/6 + 1/6 + 1/6 + 1/6 + 1/6',
            'bs_row][bs_column width="1/6"][/bs_column][bs_column width="1/6"][/bs_column][bs_column width="1/6"][/bs_column][bs_column width="1/6"][/bs_column][bs_column width="1/6"][/bs_column][bs_column width="1/6"][/bs_column][/bs_row'
        ),
        array(
            'Columns: 1/6 + 2/3 + 1/6',
            'bs_row][bs_column width="1/6"][/bs_column][bs_column width="2/3"][/bs_column][bs_column width="1/6"][/bs_column][/bs_row'
        )

    );
    
    public static function get() {
        return self::$columns;
    }
}