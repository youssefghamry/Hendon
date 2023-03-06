<?php

include_once HENDON_CORE_INC_PATH . '/social-share/shortcodes/social-share/social-share.php';

foreach ( glob( HENDON_CORE_INC_PATH . '/social-share/shortcodes/social-share/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}