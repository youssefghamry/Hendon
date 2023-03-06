<?php

include_once HENDON_CORE_SHORTCODES_PATH . '/icon-with-text/icon-with-text.php';

foreach ( glob( HENDON_CORE_SHORTCODES_PATH . '/icon-with-text/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}