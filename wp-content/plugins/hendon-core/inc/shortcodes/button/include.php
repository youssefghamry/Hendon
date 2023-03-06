<?php

include_once HENDON_CORE_SHORTCODES_PATH . '/button/button.php';

foreach ( glob( HENDON_CORE_SHORTCODES_PATH . '/button/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}