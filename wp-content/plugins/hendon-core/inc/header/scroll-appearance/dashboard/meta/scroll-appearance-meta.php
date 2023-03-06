<?php

if ( ! function_exists( 'hendon_core_add_scroll_appearance_header_meta_options' ) ) {
	/**
	 * Function that add header meta options for this module
	 */
	function hendon_core_add_scroll_appearance_header_meta_options( $header_tab, $custom_sidebars ) {
		
		if ( $header_tab ) {
			
			$section = $header_tab->add_section_element(
				array(
					'name'       => 'qodef_header_scroll_appearance_section',
					'title'      => esc_html__( 'Scroll Appearance Section', 'hendon-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_header_layout' => array(
								'values'        => hendon_core_dependency_for_scroll_appearance_options(),
								'default_value' => ''
							)
						)
					)
				)
			);
			
			$section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_header_scroll_appearance',
					'title'       => esc_html__( 'Header Scroll Appearance', 'hendon-core' ),
					'description' => esc_html__( 'Choose how header will act on scroll', 'hendon-core' ),
					'options'     => apply_filters( 'hendon_core_filter_header_scroll_appearance_option', array(
						''     => esc_html__( 'Default', 'hendon-core' ),
						'none' => esc_html__( 'None', 'hendon-core' )
					) )
				)
			);
			
			// Hook to include additional options after module options
			do_action( 'hendon_core_action_after_header_scroll_appearance_meta_options_map', $section, $custom_sidebars );
		}
	}
	
	add_action( 'hendon_core_action_after_page_header_meta_map', 'hendon_core_add_scroll_appearance_header_meta_options', 15, 2 );
}