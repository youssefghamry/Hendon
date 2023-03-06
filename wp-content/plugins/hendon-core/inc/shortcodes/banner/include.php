<?php

include_once HENDON_CORE_SHORTCODES_PATH . '/banner/banner.php';

foreach ( glob( HENDON_CORE_INC_PATH . '/shortcodes/banner/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}