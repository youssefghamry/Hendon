<?php

if ( ! function_exists( 'hendon_core_add_property_info_variation_advanced' ) ) {
    function hendon_core_add_property_info_variation_advanced( $variations ) {

        $variations['advanced'] = esc_html__( 'Advanced', 'hendon-core' );

        return $variations;
    }

    add_filter( 'hendon_core_filter_property_info_layouts', 'hendon_core_add_property_info_variation_advanced' );
}