<?php

if ( ! function_exists( 'hendon_core_add_property_info_variation_simple' ) ) {
    function hendon_core_add_property_info_variation_simple( $variations ) {

        $variations['simple'] = esc_html__( 'Simple', 'hendon-core' );

        return $variations;
    }

    add_filter( 'hendon_core_filter_property_info_layouts', 'hendon_core_add_property_info_variation_simple' );
}