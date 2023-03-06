<?php

get_header();

$params = array();
$params['content'] = 'shortcode';
// Include cpt content template
hendon_core_template_part( 'plugins/property/post-types/property', 'templates/content', '', $params );

get_footer();