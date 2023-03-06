<?php

include_once HENDON_CORE_SHORTCODES_PATH . '/pricing-table/pricing-table.php';

foreach ( glob( HENDON_CORE_SHORTCODES_PATH . '/pricing-table/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}