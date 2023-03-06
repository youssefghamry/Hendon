<?php

if ( ! function_exists( 'hendon_core_add_content_bottom_single_meta_box' ) ) {
	/**
	 * Function that add general meta box options for this module
	 *
	 * @param object $page
	 */
	function hendon_core_add_content_bottom_single_meta_box( $page ) {
		
		if ( $page ) {

            $content_bottom_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-content-bottom',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Content Bottom Settings', 'hendon-core' ),
					'description' => esc_html__( 'Content Bottom Settings', 'hendon-core' )
				)
			);

            $content_bottom_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_enable_content_bottom_area',
					'title'       => esc_html__( 'Enable Content Bottom Area', 'hendon-core' ),
					'description' => esc_html__( 'This option will enable Content Bottom area on pages', 'hendon-core' ),
					'options'     => hendon_core_get_select_type_options_pool( 'no_yes' ),
                    'default'     => 'no'
				)
			);

            $content_bottom_tab->add_field_element(
                array(
                    'field_type'  => 'select',
                    'name'        => 'qodef_content_bottom_sidebar_custom_display',
                    'title'       => esc_html__( 'Sidebar to Display', 'hendon-core' ),
                    'description' => esc_html__( 'Choose a content bottom sidebar to display', 'hendon-core' ),
                    'options'     => hendon_core_get_custom_sidebars(),
                    'dependency' => array(
                        'hide' => array(
                            'qodef_enable_content_bottom_area' => array(
                                'values'        => 'no',
                                'default_value' => ''
                            )
                        )
                    )
                )
            );
			
			// Hook to include additional options after module options
			do_action( 'hendon_core_action_after_page_content_bottom_meta_box_map', $content_bottom_tab );
		}
	}
	
	add_action( 'hendon_core_action_after_general_meta_box_map', 'hendon_core_add_content_bottom_single_meta_box' );
}