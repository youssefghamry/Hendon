<?php

include_once HENDON_CORE_PLUGINS_PATH . '/property/post-types/property/shortcodes/property-info/property-info.php';

foreach ( glob( HENDON_CORE_PLUGINS_PATH . '/property/post-types/property/shortcodes/property-info/variations/*/include.php' ) as $variation ) {
    include_once $variation;
}