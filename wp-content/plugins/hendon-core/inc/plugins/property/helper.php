<?php

if ( ! function_exists( 'hendon_core_property_set_admin_options_map_position' ) ) {
    /**
     * Function that set dashboard admin options map position for this module
     *
     * @param int $position
     * @param string $map
     *
     * @return int
     */
    function hendon_core_property_set_admin_options_map_position( $position, $map ) {

        if ( $map === 'property' ) {
            $position = 55;
        }

        return $position;
    }

    add_filter( 'hendon_core_filter_admin_options_map_position', 'hendon_core_property_set_admin_options_map_position', 10, 2 );
}