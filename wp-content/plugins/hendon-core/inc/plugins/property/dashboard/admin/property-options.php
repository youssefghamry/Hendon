<?php

if ( ! function_exists( 'hendon_core_add_property_options' ) ) {
    /**
     * Function that add general options for this module
     */
    function hendon_core_add_property_options() {
        $qode_framework = qode_framework_get_framework_root();

        $page = $qode_framework->add_options_page(
            array(
                'scope'       => HENDON_CORE_OPTIONS_NAME,
                'type'        => 'admin',
                'slug'        => 'property',
                'icon'        => 'fa fa-camera-retro',
                'title'       => esc_html__( 'Property', 'hendon-core' ),
                'description' => esc_html__( 'Global Property Options', 'hendon-core' ),
                'layout'      => 'tabbed'
            )
        );

        if ( $page ) {

            // Hook to include additional options after module options
            do_action( 'hendon_core_action_property_options_map', $page );
        }
    }

    add_action( 'hendon_core_action_default_options_init', 'hendon_core_add_property_options', hendon_core_get_admin_options_map_position( 'property' ) );
}