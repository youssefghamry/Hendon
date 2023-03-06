<?php

if ( ! function_exists( 'hendon_core_add_apartment_single_meta_box' ) ) {
    /**
     * Function that add general options for this module
     */
    function hendon_core_add_apartment_single_meta_box() {
        $qode_framework = qode_framework_get_framework_root();

        $page = $qode_framework->add_options_page(
            array(
                'scope'  => array( 'apartment-item' ),
                'type'   => 'meta',
                'slug'   => 'apartment-item',
                'title'  => esc_html__( 'Apartment Settings', 'hendon-core' ),
                'layout' => 'tabbed'
            )
        );

        if ( $page ) {

            /* General section */

            $general_tab = $page->add_tab_element(
                array(
                    'name'        => 'tab-general',
                    'title'       => esc_html__( 'Apartment General', 'hendon-core' )
                )
            );

            $general_tab->add_field_element(
                array(
                    'field_type'    => 'select',
                    'name'          => 'qodef_apartment_property',
                    'title'         => esc_html__( 'Property', 'hendon-core' ),
                    'description'   => esc_html__( 'Choose property associated with this apartment item', 'hendon-core' ),
                    'options'       => hendon_core_get_property_items_list(),
                    'default_value' => '0'
                )
            );

            $general_tab->add_field_element(
                array(
                    'field_type' => 'select',
                    'name'       => 'qodef_show_title_area_apartment_single',
                    'title'      => esc_html__( 'Show Title Area', 'hendon-core' ),
                    'description'=> esc_html__( 'Enabling this option will show title area on your single apartment page', 'hendon-core' ),
                    'options'    => hendon_core_get_select_type_options_pool('yes_no')
                )
            );

            $general_tab->add_field_element(
                array(
                    'field_type' => 'select',
                    'name'       => 'qodef_apartment_single_item_layout',
                    'title'      => esc_html__( 'Single Item Layout', 'hendon-core' ),
                    'options'    => array(
                        ''                   => esc_html__('Default', 'hendon-core'),
                        'custom'             => esc_html__( 'Custom', 'hendon-core' ),
                        'full-width-custom'  => esc_html__( 'Full Width Custom', 'hendon-core' )
                    ),
                )
            );

            $general_tab->add_field_element( array(
                'field_type'  => 'image',
                'name'        => 'qodef_apartment_list_image',
                'title'       => esc_html__( 'Apartment List Image', 'hendon-core' ),
                'description' => esc_html__( 'Upload image to be displayed on apartment list instead of featured image', 'hendon-core' ),
            ) );

            $general_tab->add_field_element( array(
                'field_type'  => 'select',
                'name'        => 'qodef_masonry_image_dimension_apartment_item',
                'title'       => esc_html__( 'Image Dimension', 'hendon-core' ),
                'description' => esc_html__( 'Choose an image layout for "masonry behavior" apartment list. If you are using fixed image proportions on the list, choose an option other than default', 'hendon-core' ),
                'options'     => hendon_core_get_select_type_options_pool( 'masonry_image_dimension' )
            ) );

            // Hook to include additional options after module options
            do_action( 'hendon_core_action_after_apartment_meta_box_map', $page, $general_tab );
        }
    }

    add_action( 'hendon_core_action_default_meta_boxes_init', 'hendon_core_add_apartment_single_meta_box' );
}

if ( ! function_exists( 'hendon_core_include_general_meta_boxes_for_apartment_single' ) ) {
    /**
     * Function that add general meta box options for this module
     */
    function hendon_core_include_general_meta_boxes_for_apartment_single() {
        $callbacks = hendon_core_general_meta_box_callbacks();

        if ( ! empty( $callbacks ) ) {
            foreach ( $callbacks as $module => $callback ) {
                if( $module !== 'logo' && $module !== 'page-title' ) {
                    add_action('hendon_core_action_after_apartment_meta_box_map', $callback);
                }
            }
        }
    }

    add_action( 'hendon_core_action_default_meta_boxes_init', 'hendon_core_include_general_meta_boxes_for_apartment_single', 8 ); // Permission 8 is set in order to load it before default meta box function
}