<?php

include_once HENDON_CORE_SHORTCODES_PATH . '/counter/counter.php';

foreach ( glob( HENDON_CORE_SHORTCODES_PATH . '/counter/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}