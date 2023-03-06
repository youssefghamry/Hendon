<?php

if ( ! function_exists( 'hendon_core_add_content_bottom_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function hendon_core_add_content_bottom_options() {
		$qode_framework = qode_framework_get_framework_root();
		
		$page = $qode_framework->add_options_page(
			array(
				'scope'       => HENDON_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'content-bottom',
				'icon'        => 'fa fa-envelope',
				'title'       => esc_html__( 'Content Bottom Area', 'hendon-core' ),
				'description' => esc_html__( 'Content Bottom Area', 'hendon-core' )
			)
		);
		
		if ( $page ) {
			
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_content_bottom_area',
					'title'         => esc_html__( 'Enable Content Bottom Area', 'hendon-core' ),
					'description'   => esc_html__( 'This option will enable Content Bottom area on pages', 'hendon-core' ),
					'default_value' => 'no'
				)
			);
			
			$content_bottom_section = $page->add_section_element(
				array(
					'name'       => 'qodef_content_bottom_area_section',
					'title'      => esc_html__( 'Content Bottom Area', 'hendon-core' ),
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

            $content_bottom_section->add_field_element(
                array(
                    'field_type'  => 'select',
                    'name'        => 'qodef_content_bottom_sidebar_custom_display',
                    'title'       => esc_html__( 'Sidebar to Display', 'hendon-core' ),
                    'description' => esc_html__( 'Choose a content bottom sidebar to display', 'hendon-core' ),
                    'options'     => hendon_core_get_custom_sidebars()
                )
            );

			// Hook to include additional options after module options
			do_action( 'hendon_core_action_after_content_bottom_options_map', $content_bottom_section );
		}
	}
	
	add_action( 'hendon_core_action_default_options_init', 'hendon_core_add_content_bottom_options', hendon_core_get_admin_options_map_position( 'content-bottom' ) );
}