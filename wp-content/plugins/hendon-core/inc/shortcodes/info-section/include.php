<?php

include_once HENDON_CORE_SHORTCODES_PATH . '/info-section/info-section.php';

foreach ( glob( HENDON_CORE_SHORTCODES_PATH . '/info-section/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}