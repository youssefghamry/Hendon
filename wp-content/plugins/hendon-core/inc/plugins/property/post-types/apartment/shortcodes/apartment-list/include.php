<?php

include_once HENDON_CORE_PLUGINS_PATH . '/property/post-types/apartment/shortcodes/apartment-list/apartment-list.php';

foreach ( glob( HENDON_CORE_PLUGINS_PATH . '/property/post-types/apartment/shortcodes/apartment-list/variations/*/include.php' ) as $variation ) {
    include_once $variation;
}