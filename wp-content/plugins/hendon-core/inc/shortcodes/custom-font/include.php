<?php

include_once HENDON_CORE_SHORTCODES_PATH . '/custom-font/custom-font.php';

foreach ( glob( HENDON_CORE_SHORTCODES_PATH . '/custom-font/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}