<?php

include_once HENDON_CORE_CPT_PATH . '/clients/shortcodes/clients-list/clients-list.php';

foreach ( glob( HENDON_CORE_CPT_PATH . '/clients/shortcodes/clients-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}