<?php

if ( ! function_exists( 'hendon_core_add_divided_header_meta' ) ) {
	/**
	 * Function that add additional header layout meta box options
	 *
	 * @param object $page
	 */
	function hendon_core_add_divided_header_meta( $page ) {
		
		$section = $page->add_section_element(
			array(
				'name'       => 'qodef_divided_header_section',
				'title'      => esc_html__( 'Divided Header', 'hendon-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_header_layout' => array(
							'values' => 'divided',
							'default_value' => ''
						)
					)
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_divided_header_height',
				'title'       => esc_html__( 'Header Height', 'hendon-core' ),
				'description' => esc_html__( 'Enter header height', 'hendon-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'hendon-core' )
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_divided_header_side_padding',
				'title'       => esc_html__( 'Header Side Padding', 'hendon-core' ),
				'description' => esc_html__( 'Enter side padding for header area', 'hendon-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px or %', 'hendon-core' )
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_divided_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'hendon-core' ),
				'description' => esc_html__( 'Enter header background color', 'hendon-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'hendon-core' )
				)
			)
		);

	}
	
	add_action( 'hendon_core_action_after_page_header_meta_map', 'hendon_core_add_divided_header_meta' );
}