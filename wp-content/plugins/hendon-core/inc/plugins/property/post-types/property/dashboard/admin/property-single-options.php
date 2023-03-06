<?php

if ( ! function_exists( 'hendon_core_add_property_single_options' ) ) {
    /**
     * Function that add general options for this module
     */
    function hendon_core_add_property_single_options( $page ) {

        $single_tab = $page->add_tab_element(
            array(
                'name'        => 'tab-single-property',
                'icon'        => 'fa fa-cog',
                'title'       => esc_html__( 'Property Single', 'hendon-core' ),
                'description' => esc_html__( 'Settings related to property single page', 'hendon-core' )
            )
        );

        if ( $single_tab ) {

            $single_tab->add_field_element( array(
                'field_type'    => 'select',
                'name'          => 'qodef_property_single_item_layout',
                'title'         => esc_html__( 'Single Item Layout', 'hendon-core' ),
                'description'   => esc_html__( 'Set item layout for Property single page. Defauly is "Custom"', 'hendon-core' ),
                'default_value' => 'custom',
                'options'       => array(
                    'custom'             => esc_html__( 'Custom', 'hendon-core' ),
                    'full-width-custom'  => esc_html__( 'Full Width Custom', 'hendon-core' )
                ),
            ) );

            $single_tab->add_field_element( array(
                'field_type'    => 'select',
                'name'          => 'qodef_show_title_area_property_single',
                'title'         => esc_html__( 'Show Title Area', 'hendon-core' ),
                'description'   => esc_html__( 'Enabling this option will show title area on single projects', 'hendon-core' ),
                'options'       => hendon_core_get_select_type_options_pool('yes_no')
            ) );

        }
    }

    add_action( 'hendon_core_action_property_options_map', 'hendon_core_add_property_single_options', 3);
}