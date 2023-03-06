<?php

if ( ! function_exists( 'hendon_core_property_post_types' ) ) {
    function hendon_core_property_post_types( $class ) {
        foreach ( glob( HENDON_CORE_PLUGINS_PATH . '/property/post-types/*', GLOB_ONLYDIR ) as $post_type ) {

            if ( basename( $post_type ) !== 'dashboard' ) {
                $is_disabled = hendon_core_performance_get_option_value( $post_type, 'hendon_core_performance_post_type_' );

                if ( empty( $is_disabled ) ) {
                    $class->set_allowed_post_types( $post_type );
                }
            }
        }
    }

    add_action( 'hendon_core_action_add_custom_post_type', 'hendon_core_property_post_types' );
}