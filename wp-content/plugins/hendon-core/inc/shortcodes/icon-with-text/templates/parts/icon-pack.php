<?php

if( ! empty( $link ) && $layout !== 'content-in-box' ) {
	$icon_params['link']   = $link;
	$icon_params['target'] = $target;
}

if ( $icon_type == 'icon-pack' ) {
	echo HendonCoreIconShortcode::call_shortcode( $icon_params );
}