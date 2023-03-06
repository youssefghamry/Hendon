<?php

$params                      = array();
$params['layout']            = 'dropdown';
$params['icon_font']         = 'font-awesome';
$params['dropdown_behavior'] = 'left';
$params['title']             = ' ';

if(is_singular('post')) {
	$params['layout'] = 'list';
}
if( class_exists( 'HendonCoreSocialShareShortcode' ) ) {
	echo HendonCoreSocialShareShortcode::call_shortcode($params);
}