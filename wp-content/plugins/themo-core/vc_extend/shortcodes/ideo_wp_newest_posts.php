<?php
vc_map(array(
	'name' => 'WP ' . __( 'Newest Posts' ),
	'base' => 'ideo_wp_newest_posts',
	'icon' => 'icon-wpb-wp',
	'category' => __( 'WordPress Widgets', 'ideo-themo' ),
    'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => __( 'Your site’s newests Posts.', 'ideo-themo' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'ideo-themo' ),
			'param_name' => 'title',
			'description' => __( 'What text use as a widget title. Leave blank to use default widget title.', 'ideo-themo' ),
			'value' => __( '' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Number of posts to show:', 'ideo-themo' ),
			'param_name' => 'number_of_posts',
			'description' => __( 'How many posts would you like to show.', 'ideo-themo' ),
			'admin_label' => true,
            'value' => __( '3' ),
		),
        array(
			'type' => 'ideo_categories',
			'heading' => __( 'Select specyfic categories', 'ideo-themo' ),
			'param_name' => 'categories',
			'description' => __( 'Choose categories to show posts from.', 'ideo-themo' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'ideo-themo' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'ideo-themo' ),
		),
	),
));

function ideothemo_wp_newest_posts_func($atts)
{
	$title = $number_of_posts = $categories = $el_class = '';

	extract(shortcode_atts(array(
		'title' => null,
		'number_of_posts' => 5,
		'categories' => null,
		'el_class' => ''
	), $atts));

	global $wp_query;

	$wp_query_args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' => $number_of_posts,
	);

	if (!empty($categories))
		$wp_query_args['category__in'] = explode(',', $categories);

	$wp_query = new WP_Query($wp_query_args);

    echo '<div class="wpb_wrapper">';
    echo '<div class="vc_wp_recentposts">';
	echo '<div class="widget widget_recentpostwidget ' . esc_attr($el_class) . '">';

	if (!empty($title)) {
		echo '<h3 class="widget-title">' . $title . '</h3>';
	}

	echo ideothemo_get_template_part('parts.widget.newest.post');
	echo '</div>';
	echo '</div>';
	echo '</div>';

	wp_reset_postdata();
	wp_reset_query();
}

add_shortcode('ideo_wp_newest_posts', 'ideothemo_wp_newest_posts_func');