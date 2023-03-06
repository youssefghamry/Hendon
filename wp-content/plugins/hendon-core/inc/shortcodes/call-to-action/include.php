<?php

include_once HENDON_CORE_SHORTCODES_PATH . '/call-to-action/call-to-action.php';

foreach ( glob( HENDON_CORE_SHORTCODES_PATH . '/call-to-action/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}