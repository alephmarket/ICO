<?php

use Carbon_Fields\Container\Container;
use Carbon_Fields\Field\Field;

$campaign_switchers_labels = array(
    'plural_name' => 'Switchers',
    'singular_name' => 'Switcher',
);

Container::make( 'post_meta', __('UTM Switcher Options', 'utm-switcher') )
->show_on_post_type( 'utm_switcher' )
->add_fields( array(
	Field::make( 'text', 'match_element',  __('Match Element', 'utm-switcher') )
	->help_text( __('A selector that will be targeted for replacement. Uses jQuery syntax.', 'utm-switcher') ),
	Field::make( 'select', 'switcher_type',  __('Switcher Type', 'utm-switcher') )
	->help_text( __('Choose a type. Phone Number Element will replace the whole element with an anchor link with a tel: attribute. Text replacement replaces all text in the above element.', 'utm-switcher') )
	->add_options( array(
		'phone'	 => __('Phone Number Element', 'utm-switcher'),
		'text'	 => __('Text Replacement', 'utm-switcher'),
	) ),
	Field::make( 'complex', 'campaign_switchers' )
	->setup_labels($campaign_switchers_labels)
	->add_fields( array(
		Field::make( 'text', 'campaign_source', __('UTM Source (utm_source=[thisvalue])', 'utm-switcher') ),
		Field::make( 'text', 'replace_value', __('Replacement Value', 'utm-switcher') ),
	) ),
) );
