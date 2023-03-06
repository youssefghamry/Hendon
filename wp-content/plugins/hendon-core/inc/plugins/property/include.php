<?php

include_once HENDON_CORE_PLUGINS_PATH . '/property/helper.php';
include_once HENDON_CORE_PLUGINS_PATH . '/property/dashboard/admin/property-options.php';

foreach ( glob( HENDON_CORE_PLUGINS_PATH . '/property/*/include.php' ) as $module ) {
    include_once $module;
}