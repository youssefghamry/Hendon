<?php

include_once HENDON_CORE_PLUGINS_PATH . '/property/post-types/property/shortcodes/property-list/property-list.php';

foreach ( glob( HENDON_CORE_PLUGINS_PATH . '/property/post-types/property/shortcodes/property-list/variations/*/include.php' ) as $variation ) {
    include_once $variation;
}