<?php

vc_map(array(
    'name' => __('BLOG', 'ideo-themo'),
    'base' => 'ideo_blog',    
    'icon' => 'icon-blog',
    'category' => __('Content', 'ideo-themo'),
    'description' => __('Blog posts list with Classic and Masonry layout.', 'ideo-themo'),
    'weight' => 92,
    'params' => array(

        array(
            'type' => 'ideo_buttons',
            'heading' => __('BLOG LAYOUT', 'ideo-themo'),
            'param_name' => 'el_type',
            'value' => array(
                __('Classic', 'ideo-themo') => 'classic',
                __('Masonry', 'ideo-themo') => 'masonry'
            ),
            'dependencies' => array(
                'classic' => array('el_date_position'),
                'masonry' => array('el_large_desc_cols', 'el_desc_cols', 'el_mob_cols', 'el_tab_cols', 'el_distance'),
            ),
            'std' => 'classic',
            'description' => __('Choose Classic or Masonry blog layout. Depending on which layout you choose appropriate additional options will be available below.', 'ideo-themo'),
        ),
        // BLOG MASONRY OPTIONS 

        array(
            'type' => 'ideo_slider',
            'heading' => __('LARGE DESKTOP COLUMNS', 'ideo-themo'),
            'param_name' => 'el_large_desc_cols',
            'min' => '1',
            'max' => '6',
            'value' => '3',
            'description' => __('Define how many columns will be set in one row on large desktop devices.', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_slider',
            'heading' => __('DESKTOP COLUMNS', 'ideo-themo'),
            'param_name' => 'el_desc_cols',
            'min' => '1',
            'max' => '6',
            'value' => '3',
            'description' => __('Define how many columns will be set in one row on desktop devices.', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_slider',
            'heading' => __('TABLET COLUMNS', 'ideo-themo'),
            'param_name' => 'el_tab_cols',
            'min' => '1',
            'max' => '6',
            'value' => '2',
            'description' => __('Define how many columns will be set in one row on tablets (992 to 768 pixels of screen width).', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_slider',
            'heading' => __('MOBILE COLUMNS', 'ideo-themo'),
            'param_name' => 'el_mob_cols',
            'min' => '1',
            'max' => '6',
            'value' => '1',
            'description' => __('Define how many columns will be set in one row on mobiles (less than 768 pixels of screen width).', 'ideo-themo')
        ),

        // BLOG CLASSIC OPTIONS

        array(
            'type' => 'ideo_buttons',
            'heading' => __('DATE POSITION', 'ideo-themo'),
            'param_name' => 'el_date_position',
            'value' => array(
                __('Fancy left', 'ideo-themo') => 'left',
                __('Fancy right', 'ideo-themo') => 'right',
                __('Meta', 'ideo-themo') => 'meta',
            ),
            'std' => 'left',
            'description' => __('Decide where you want to display the date for each post: <b>Fancy left</b> (displays date next to left-top corner of the post); <b>Fancy right</b> (displays date next to right-top corner of the post); <b>Meta</b> (displays date in meta data section).', 'ideo-themo'),
        ),

        array(
            'type' => 'ideo_slider',
            'heading' => __('DISTANCE BETWEEN BLOCKS (px) ', 'ideo-themo'),
            'param_name' => 'el_distance',
            'min' => '0',
            'max' => '100',
            'value' => '30',
            'description' => __('Define in pixels distance between masonry columns.', 'ideo-themo')
        ),


        array(
            'type' => 'ideo_buttons',
            'heading' => __('EXCERPT', 'ideo-themo'),
            'param_name' => 'el_excerpt',
            'value' => array(
                __('Standard', 'ideo-themo') => 'standard',
                __('Custom', 'ideo-themo') => 'automatic'
            ),
            'std' => 'standard',
            'dependencies' => array(
                'automatic' => array('el_excerpt_words'),
            ),
            'description' => __('Choose Standard or Custom excerpt displaying. When you choose <b>Standard</b> whole excerpt you have added to the posts will be displayed on blog posts list. When you choose <b>Custom</b> you will be able to define precise number of words that will be displayed on blog posts list.', 'ideo-themo'),
        ),

        array(
            'type' => 'textfield',
            'heading' => __('NUMBER OF WORDS ', 'ideo-themo'),
            'param_name' => 'el_excerpt_words',
            'value' => '55',
            'description' => __('Define how many words from posts excerpts will be displayed on the blog posts list.', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_buttons',
            'heading' => __('IMAGE SIZE', 'ideo-themo'),
            'param_name' => 'el_image_size',
            'value' => array(
                __('Original', 'ideo-themo') => 'original',
                __('Custom', 'ideo-themo') => 'custom'
            ),
            'std' => 'original',
            'dependencies' => array(
                'custom' => array('el_image_height'),
            ),
            'description' => __('Choose Original or Custom image size. When you choose <b>Original size</b> the image will be scale with original aspect ratio to cover 100% width of container (whole image will be in view with original proportions). When you choose <b>Custom size</b> you will be able to define precise height of image container – image will be added as a background, it will be scale and cropped (some parts of the image may not be in view).', 'ideo-themo'),
        ),

        array(
            'type' => 'ideo_slider',
            'heading' => __('CUSTOM IMAGE HEIGHT ', 'ideo-themo'),
            'param_name' => 'el_image_height',
            'min' => '100',
            'max' => '800',
            'value' => '250',
            'description' => __('Define in pixels height of the image container.', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_dropdown',
            'heading' => __('TITLE TAG', 'ideo-themo'),
            'param_name' => 'el_title_tag',
            'value' => array(
                'H1' => 'h1',
                'H2' => 'h2',
                'H3' => 'h3',
                'H4' => 'h4',
                'H5' => 'h5',
                'H6' => 'h6',
            ),
            'std' => 'h2',
            'description' => __('Choose text tag for posts titles.', 'ideo-themo'),
        ),

        array(
            'type' => 'ideo_slider',
            'heading' => __('NUMBER OF POSTS', 'ideo-themo'),
            'param_name' => 'el_post_page',
            'min' => '1',
            'max' => '25',
            'value' => '9',
            'description' => __('Enter number of posts you want to displayed initially on the blog posts list.', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_dropdown',
            'heading' => __('PAGINATION', 'ideo-themo'),
            'param_name' => 'el_pagination',
            'value' => array(
                __('None', 'ideo-themo') => 'none',
                __('Standard pagination', 'ideo-themo') => 'standard',
                __('Load more button', 'ideo-themo') => 'load_more',
                __('Infinity scroll', 'ideo-themo') => 'infinity_scroll',
            ),
            'std' => 'standard',
            'description' => __('Choose pagination type. You can choose Standard Pagination, Load more button or Infinite scroll. </br><b>Standard pagination</b> displays numbered buttons at the bottom of the page, so you can navigate through particular pages; </br><b>Load more button</b> displayed at the bottom of the page allows you to load more posts on click; </br><b>Infinite scroll</b> loads more posts automatically while scrolling down.', 'ideo-themo'),
        ),
        array(
            'type' => 'ideo_categories',
            'heading' => __('SELECT SPECIFIC CATEGORIES', 'ideo-themo'),
            'param_name' => 'el_select_categories',
            'value' => '',
            'description' => __('Choose categories which posts will be displayed on the blog posts list.', 'ideo-themo'),
        ),
        array(
            'type' => 'ideo_items',
            'heading' => __('SELECT SPECIFIC POSTS', 'ideo-themo'),
            'param_name' => 'el_select_posts',
            'value' => '',
            'description' => __('Choose particular posts which will be displayed on the blog posts list.', 'ideo-themo'),
        ),


        array(
            'type' => 'ideo_buttons',
            'heading' => __('ORDER BY', 'ideo-themo'),
            'param_name' => 'el_orderby',
            'value' => array(
                __('Date', 'ideo-themo') => 'date',
                __('Title', 'ideo-themo') => 'title'
            ),
            'std' => 'date',
            'description' => __('Choose parameter by which posts will be sorted.', 'ideo-themo'),
        ),

        array(
            'type' => 'ideo_buttons',
            'heading' => __('ORDER', 'ideo-themo'),
            'param_name' => 'el_order',
            'value' => array(
                __('ASC', 'ideo-themo') => 'asc',
                __('DESC', 'ideo-themo') => 'desc',
            ),
            'std' => 'desc',
            'description' => __('Choose between ascending or descending posts ordering.', 'ideo-themo'),
        ),


        array(
            'type' => 'ideo_slider',
            'heading' => __('MARGIN TOP (px)', 'ideo-themo'),
            'param_name' => 'el_margin_top',
            'min' => '0',
            'max' => '200',
            'value' => '0',
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('MARGIN BOTTOM (px)', 'ideo-themo'),
            'param_name' => 'el_margin_bottom',
            'min' => '0',
            'max' => '200',
            'value' => '20',
        ),

        array(
            'type' => 'textfield',
            'heading' => __('EXTRA CLASS NAME', 'ideo-themo'),
            'param_name' => 'el_extra_class',
            'value' => '',
            'description' => __('Type in an extra class name for this particular element, so you can refer to that class in custom css.', 'ideo-themo')
        ),


        // tab META
        array(
            'type' => 'ideo_switcher',
            'heading' => __('META AUTHOR NAME', 'ideo-themo'),
            'param_name' => 'el_authors',
            'on' => 'true',
            'off' => 'false',
            'value' => 'true',
            'group' => __('META', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_switcher',
            'heading' => __('META DATE', 'ideo-themo'),
            'param_name' => 'el_date',
            'on' => 'true',
            'off' => 'false',
            'value' => 'true',
            'group' => __('META', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_switcher',
            'heading' => __('META CATEGORIES ', 'ideo-themo'),
            'param_name' => 'el_categories',
            'on' => 'true',
            'off' => 'false',
            'value' => 'true',
            'group' => __('META', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_switcher',
            'heading' => __('META COMMENTS', 'ideo-themo'),
            'param_name' => 'el_comments',
            'on' => 'true',
            'off' => 'false',
            'value' => 'true',
            'group' => __('META', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_switcher',
            'heading' => __('META TAGS', 'ideo-themo'),
            'param_name' => 'el_tags',
            'on' => 'true',
            'off' => 'false',
            'value' => 'false',
            'group' => __('META', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_switcher',
            'heading' => __('SOCIAL SHARE', 'ideo-themo'),
            'param_name' => 'el_share',
            'on' => 'true',
            'off' => 'false',
            'value' => 'true',
            'dependencies' => array(
                'true' => array('el_facebook', 'el_twitter', 'el_google', 'el_pinterest', 'el_reddit', 'el_linkedin', 'el_tumblr', 'el_vk', 'el_email'),
            ),
            'group' => __('META', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_switcher',
            'heading' => __('FACEBOOK ', 'ideo-themo'),
            'param_name' => 'el_facebook',
            'on' => 'true',
            'off' => 'false',
            'value' => 'true',
            'group' => __('META', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_switcher',
            'heading' => __('TWITTER', 'ideo-themo'),
            'param_name' => 'el_twitter',
            'on' => 'true',
            'off' => 'false',
            'value' => 'true',
            'group' => __('META', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_switcher',
            'heading' => __('GOOGLE+', 'ideo-themo'),
            'param_name' => 'el_google',
            'on' => 'true',
            'off' => 'false',
            'value' => 'true',
            'group' => __('META', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_switcher',
            'heading' => __('PINTEREST', 'ideo-themo'),
            'param_name' => 'el_pinterest',
            'on' => 'true',
            'off' => 'false',
            'value' => 'true',
            'group' => __('META', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_switcher',
            'heading' => __('REDDIT', 'ideo-themo'),
            'param_name' => 'el_reddit',
            'on' => 'true',
            'off' => 'false',
            'value' => 'false',
            'group' => __('META', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_switcher',
            'heading' => __('LINKED IN ', 'ideo-themo'),
            'param_name' => 'el_linkedin',
            'on' => 'true',
            'off' => 'false',
            'value' => 'false',
            'group' => __('META', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_switcher',
            'heading' => __('TUMBLR', 'ideo-themo'),
            'param_name' => 'el_tumblr',
            'on' => 'true',
            'off' => 'false',
            'value' => 'false',
            'group' => __('META', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_switcher',
            'heading' => __('VK', 'ideo-themo'),
            'param_name' => 'el_vk',
            'on' => 'true',
            'off' => 'false',
            'value' => 'false',
            'group' => __('META', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_switcher',
            'heading' => __('EMAIL', 'ideo-themo'),
            'param_name' => 'el_email',
            'on' => 'true',
            'off' => 'false',
            'value' => 'true',
            'group' => __('META', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_dropdown',
            'heading' => __('ELEMENT STYLE', 'ideo-themo'),
            'param_name' => 'el_element_style',
            'value' => array(
                'colored dark (light fonts)' => 'colored-dark',
                'colored light (dark fonts)' => 'colored-light',

            ),
            'colors' => ideothemo_get_colors(),
            'std' => ideothemo_get_shortcodes_default_style('ideo_blog'),
            'admin_label' => true,
            'description' => __('Choose style for the element. Depending on which option you choose appropriate colorpickers will be available below. You can freely customize colors for chosen style but you can also leave empty colorpickers to use colors which are set for that style in Customizer.', 'ideo-themo'),
            'group' => __('STYLING', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_custom_colors',
            'heading' => __('COLORS', 'ideo-themo'),
            'param_name' => 'el_element_style_colors',
            'colors' => ideothemo_get_colors(),
            'el_colors' => array(
                'colored' => array(
                    'accent_color' => __('ACCENT COLOR', 'ideo-themo'),
                    'title_color' => __('TITLE COLOR', 'ideo-themo'),
                    'text_color' => __('TEXT & LINKS COLOR', 'ideo-themo'),
                    'alternative_text_color' => __('ALTERNATIVE TEXT COLOR', 'ideo-themo'),
                    'background_color' => __('BACKGROUND COLOR', 'ideo-themo'),
                ),
                'transparent' => array()
            ),
            'group' => __('STYLING', 'ideo-themo')
        ),

    ),
    'js_view' => 'VcBlogView'
));

add_filter('ideothemo_get_blog_html_before', 'ideothemo_blog_style_inline', 1, 2);

function ideothemo_blog_style_inline($html, $atts, $content = null)
{
    if (is_search() || is_archive())
        return '';

    $less = '';

    $el_element_style = isset($atts['el_element_style']) ? $atts['el_element_style'] : ideothemo_get_shortcodes_default_style('ideo_blog');


    if ($el_element_style && $el_element_style == 'colored-dark') {
        $text_color = ideothemo_get_theme_mod_parse('shortcodes.shortcodes_coloring.sc_colored_dark_text_color');
    } else {
        $text_color = ideothemo_get_theme_mod_parse('shortcodes.shortcodes_coloring.sc_colored_light_text_color');
    }

    if ($el_element_style && $el_element_style == 'colored-dark') {
        $accent_color = ideothemo_get_theme_mod_parse('shortcodes.shortcodes_coloring.sc_colored_dark_accent_color');
    } else {
        $accent_color = ideothemo_get_theme_mod_parse('shortcodes.shortcodes_coloring.sc_colored_light_accent_color');
    }

    $colors_array = isset($atts['el_element_style_colors']) ? (array)json_decode(str_replace("'", '"', $atts['el_element_style_colors'])) : array();

    if (!empty($colors_array['text_color']))
        $text_color = $colors_array['text_color'];

    if (!empty($colors_array['accent_color']))
        $accent_color = $colors_array['accent_color'];

    if (empty($accent_color))
        $accent_color = ideothemo_get_general_accent_color();

    $single_distance = (empty($atts['el_distance']) ? 30 : $atts['el_distance']) / 2;

    $less .= '    
    #blog_lists_' . $atts['el_uid'] . '.blog-lists-posts {
        &.skin-colored_dark, &.skin-colored-dark, &.skin-colored_light, &.skin-colored-light {
            .post-title a {
                ' . (isset($colors_array['title_color']) && $colors_array['title_color'] ? 'color: ' . ideothemo_is_color($colors_array['title_color']) . ' !important;' : '') . '
                &:hover {
                   ' . (isset($colors_array['accent_color']) && $colors_array['accent_color'] ? 'color: ' . ideothemo_is_color($colors_array['accent_color']) . ' !important;' : '') . '
                }
            }
            .post-sticky-marker {
                ' . (isset($colors_array['accent_color']) && $colors_array['accent_color'] ? 'border-top-color: ' . ideothemo_is_color($colors_array['accent_color']) . '; border-bottom-color: ' . ideothemo_is_color($colors_array['accent_color']) . ' ;' : '') . ' 
            }
            .text-hover:before, .text-hover span:before, .text-hover:hover > i {
        		' . (isset($colors_array['accent_color']) && $colors_array['accent_color'] ? 'color: ' . ideothemo_is_color($colors_array['accent_color']) . ' !important;' : '') . '
    		}
            .ideo-blog-entry .date-box {
                .day {
                   ' . (isset($colors_array['alternative_text_color']) && $colors_array['alternative_text_color'] ? 'color: ' . ideothemo_is_color($colors_array['alternative_text_color']) . ' !important;' : '') . '
                   ' . (isset($colors_array['accent_color']) && $colors_array['accent_color'] ? 'background-color: ' . ideothemo_is_color($colors_array['accent_color']) . ' !important;' : '') . '
                }
                .month {
                   ' . (isset($colors_array['text_color']) && $colors_array['text_color'] ? 'color: ' . ideothemo_is_color($colors_array['text_color']) . ' !important;' : '') . '
                }
                .year {
                   ' . (isset($colors_array['title_color']) && $colors_array['title_color'] ? 'color: ' . ideothemo_is_color($colors_array['title_color']) . ' !important;' : '') . '
                }
            }
            .social a {
               ' . (isset($colors_array['accent_color']) && $colors_array['accent_color'] ? 'color: ' . ideothemo_is_color($colors_array['accent_color']) . ' !important;' : '') . '
                &:hover {
                   ' . (isset($colors_array['accent_color']) && $colors_array['accent_color'] ? 'color: ' . ideothemo_is_color($colors_array['accent_color']) . ' - #222 !important;' : '') . '
                }
            }
            .post-meta {
            	' . (isset($colors_array['text_color']) && $colors_array['text_color'] ? 'border-bottom-color: fade(' . ideothemo_is_color($colors_array['text_color']) . ',20%) !important;' : '') . '
                &, li:before, a, .author, .categories ul:before, &> div:before, &> div:after {
                   ' . (isset($colors_array['text_color']) && $colors_array['text_color'] ? 'color: ' . ideothemo_is_color($colors_array['text_color']) . ' !important;' : '') . '
                }
            }
            blockquote.quote,
            blockquote.url {
               ' . (isset($colors_array['alternative_text_color']) && $colors_array['alternative_text_color'] ? 'color: ' . ideothemo_is_color($colors_array['alternative_text_color']) . ' !important;' : '') . '
               ' . (isset($colors_array['accent_color']) && $colors_array['accent_color'] ? 'background-color: ' . ideothemo_is_color($colors_array['accent_color']) . ' !important;' : '') . '
                &:hover {
                   ' . (isset($colors_array['accent_color']) && $colors_array['accent_color'] ? 'background-color: ' . ideothemo_is_color($colors_array['accent_color']) . ' - #222 !important;' : '') . '
                }
                &:before {
                   ' . (isset($colors_array['alternative_text_color']) && $colors_array['alternative_text_color'] ? 'background: ' . ideothemo_is_color($colors_array['alternative_text_color']) . ';' : '') . '
                   ' . (isset($colors_array['accent_color']) && $colors_array['accent_color'] ? 'color: ' . ideothemo_is_color($colors_array['accent_color']) . ' ;' : '') . '
                }
            }
            .ideo-blog-entry .carousel .carousel-control .glyphicon:after{
                ' . (isset($colors_array['accent_color']) && $colors_array['accent_color'] ? 'background-color: ' . ideothemo_is_color($colors_array['accent_color']) . ' !important;' : '') . '
            }
            .ideo-entry-excerpt,
            .ideo-entry-excerpt p a,
            .ideo-entry-excerpt p {
                   ' . (isset($colors_array['text_color']) && $colors_array['text_color'] ? 'color: ' . ideothemo_is_color($colors_array['text_color']) . ' !important;' : '') . '                
            }
			.read-more {
				' . (isset($colors_array['title_color']) && $colors_array['title_color'] ? 'color: ' . ideothemo_is_color($colors_array['title_color']) . ';' : '') . ' 
            	> i {
                	' . (isset($colors_array['accent_color']) && $colors_array['accent_color'] ? 'color: ' . ideothemo_is_color($colors_array['accent_color']) . ';' : '') . ' 
            	}
        	}
            .ideo-blog-entry .ideo-entry-content .ideo-entry-footer{
                ' . (isset($colors_array['text_color']) && $colors_array['text_color'] ? 'border-bottom-color: fade(' . ideothemo_is_color($colors_array['text_color']) . ', 20%) !important;' : '') . '
            }
            
            .ideo-blog-entry .carousel {
                 .carousel-indicators li{
                    ' . (isset($colors_array['alternative_text_color']) && $colors_array['alternative_text_color'] ? 'background-color: fade( ' . ideothemo_is_color($colors_array['alternative_text_color']) . ',50%) !important;' : '') . '
                    &.active{
                        ' . (isset($colors_array['alternative_text_color']) && $colors_array['alternative_text_color'] ? 'border-color:' . ideothemo_is_color($colors_array['alternative_text_color']) . ' !important; background-color: fade( ' . ideothemo_is_color($colors_array['alternative_text_color']) . ',50%) !important;' : '') . '
                    }
                }
                .carousel-control span{
                    ' . (isset($colors_array['alternative_text_color']) && $colors_array['alternative_text_color'] ? ' color: ' . ideothemo_is_color($colors_array['alternative_text_color']) . ' !important; background-color: fade( ' . ideothemo_is_color($colors_array['alternative_text_color']) . ',20%) !important;' : '') . '                
                }
            }
            .mejs-container .mejs-inner .mejs-controls .mejs-playpause-button,
            .mejs-controls .mejs-time-rail .mejs-time-current,
            .mejs-horizontal-volume-current,
            .mejs-controls .mejs-volume-button .mejs-volume-slider .mejs-volume-current {
               ' . (isset($colors_array['accent_color']) && $colors_array['accent_color'] ? 'background: ' . ideothemo_is_color($colors_array['accent_color']) . ' !important;' : '') . '
            }
            
            .mejs-controls .mejs-playpause-button button:before {
               ' . (isset($colors_array['alternative_text_color']) && $colors_array['alternative_text_color'] ? 'color: ' . ideothemo_is_color($colors_array['alternative_text_color']) . ' !important;' : '') . '
            }
            

            ' . ((!empty($atts['el_type']) && $atts['el_type'] == 'masonry') ? '

			&.ideo-blog-masonry {
			    margin-left: -' . ($single_distance) . 'px;
			    margin-right: -' . ($single_distance) . 'px;
			}

            .ideo-blog-entry {
            	padding-bottom: ' . (2 * $single_distance) . 'px;
            	padding-left: ' . ($single_distance + 10) . 'px;
            	padding-right: ' . ($single_distance + 10) . 'px;
            	
            	&:before {
            		' . (isset($colors_array['background_color']) && $colors_array['background_color'] ? 'background-color: ' . ideothemo_is_color($colors_array['background_color']) . ';' : '') . '
            		' . (isset($colors_array['text_color']) && $colors_array['text_color'] ? 'border-color: fade(' . ideothemo_is_color($colors_array['text_color']) . ', 20%);' : '') . '
            		
            		left: ' . $single_distance . 'px;
            		right: ' . $single_distance . 'px;
            		bottom: ' . (2 * $single_distance) . 'px;
            	}
            	
            	&:after {
            		left: ' . ($single_distance + 1) . 'px;
            		right: ' . ($single_distance + 1) . 'px;
            		bottom: ' . (2 * $single_distance + 2) . 'px;
            		' . (isset($colors_array['accent_color']) && $colors_array['accent_color'] ? 'border-color: ' . ideothemo_is_color($colors_array['accent_color']) . ';' : '') . '
            	}
            }
            
            ' : '') . '
            
        }
    }

    #blog_pagination_' . $atts['el_uid'] . '.pagination {
        &.skin-dark, &.skin-colored-dark {
            .button {
               ' . (isset($colors_array['alternative_text_color']) && $colors_array['alternative_text_color'] ? 'color: ' . ideothemo_is_color($colors_array['alternative_text_color']) . ' !important;' : '') . '
               ' . (isset($colors_array['accent_color']) && $colors_array['accent_color'] ? 'background-color: ' . ideothemo_is_color($colors_array['accent_color']) . ' !important;' : '') . '
               ' . (isset($colors_array['accent_color']) && $colors_array['accent_color'] ? 'border-color: ' . ideothemo_is_color($colors_array['accent_color']) . ' !important;' : '') . '
                &:hover {
                   ' . (isset($colors_array['accent_color']) && $colors_array['accent_color'] ? 'background-color: ' . ideothemo_is_color($colors_array['accent_color']) . ' - #222 !important;' : '') . '
                   ' . (isset($colors_array['accent_color']) && $colors_array['accent_color'] ? 'border-color: ' . ideothemo_is_color($colors_array['accent_color']) . ' - #222 !important;' : '') . '
                }
            }
        }
        &.skin-light,
        &.skin-colored-light {
            .button {
               ' . (isset($colors_array['alternative_text_color']) && $colors_array['alternative_text_color'] ? 'color: ' . ideothemo_is_color($colors_array['alternative_text_color']) . ' !important;' : '') . '
               ' . (isset($colors_array['accent_color']) && $colors_array['accent_color'] ? 'background-color: ' . ideothemo_is_color($colors_array['accent_color']) . ' !important;' : '') . '
               ' . (isset($colors_array['accent_color']) && $colors_array['accent_color'] ? 'border-color: ' . ideothemo_is_color($colors_array['accent_color']) . ' !important;' : '') . '
                &:hover {
                   ' . (isset($colors_array['accent_color']) && $colors_array['accent_color'] ? 'background-color: ' . ideothemo_is_color($colors_array['accent_color']) . ' - #222 !important;' : '') . '
                   ' . (isset($colors_array['accent_color']) && $colors_array['accent_color'] ? 'border-color: ' . ideothemo_is_color($colors_array['accent_color']) . ' - #222 !important;' : '') . '
                }
            }
        }
        &.standard {
            &.skin-dark, &.skin-colored-dark, &.skin-light, &.skin-colored-light {
				a{
					' . (isset($text_color) && $text_color ? 'color: ' . ideothemo_is_color($text_color) . ';' : '') . '
					' . (isset($text_color) && $text_color ? 'border-color: fade(' . ideothemo_is_color($text_color) . ', 40);' : '') . '
					&:hover{
						' . (!empty($accent_color) ? 'color: ' . $accent_color . ' !important;' : '') . '
						' . (!empty($accent_color) ? 'border-color: ' .$accent_color . ' !important;' : '') . '
					}
				}
				.current{
					' . (isset($colors_array['alternative_text_color']) && $colors_array['alternative_text_color'] ? 'color: ' . ideothemo_is_color($colors_array['alternative_text_color']) . ' !important;' : '') . '
					' . (!empty($accent_color) ? 'background-color: ' . $accent_color . ' !important;' : '') . '
					' . (!empty($accent_color) ? 'border-color: ' . $accent_color . ' !important;' : '') . '
				}
				.prev, .next{
					' . (isset($text_color) && $text_color ? 'border-color: fade(' . ideothemo_is_color($text_color) . ', 40) !important;' : '') . '
					&:hover{
						' . (isset($text_color) && $text_color ? 'border-color: fade(' . ideothemo_is_color($text_color) . ', 40) !important;' : '') . '
						' . (isset($text_color) && $text_color ? 'color: ' . ideothemo_is_color($text_color) . ' !important;' : '') . '
					}
					&:before{
						' . (isset($text_color) && $text_color ? 'background-color: fade(' . ideothemo_is_color($text_color) . ', 20) !important;' : '') . '
					}
				}
            }            
        }
    }
    
    ';


    $less .= '#blog_pagination_' . $atts['el_uid'] . '.pagination.load-more .loader{';
    $less .= 'color:' . $text_color . ';';
    $less .= 'background-image:url(' . ideothemo_get_assets_svg_data('svg/preloader.svg', $text_color) . ');';
    $less .= '}';

    return $html . ideothemo_add_style($less);

}

		