<?php

include_once HENDON_CORE_SHORTCODES_PATH . '/countdown/countdown.php';

foreach ( glob( HENDON_CORE_SHORTCODES_PATH . '/countdown/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}