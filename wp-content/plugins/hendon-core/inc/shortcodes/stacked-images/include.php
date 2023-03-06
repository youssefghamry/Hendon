<?php

include_once HENDON_CORE_SHORTCODES_PATH . '/stacked-images/stacked-images.php';

foreach ( glob( HENDON_CORE_SHORTCODES_PATH . '/stacked-images/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}