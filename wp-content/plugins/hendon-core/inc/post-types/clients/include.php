<?php

include_once HENDON_CORE_CPT_PATH . '/clients/helper.php';

foreach ( glob( HENDON_CORE_CPT_PATH . '/clients/dashboard/meta-box/*.php' ) as $module ) {
	include_once $module;
}