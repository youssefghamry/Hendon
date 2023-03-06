<?php

if ( ! function_exists( 'hendon_core_add_standard_header_options' ) ) {
	/**
	 * Function that add additional header layout options
	 *
	 * @param object $page
	 * @param array $general_header_tab
	 */
	function hendon_core_add_standard_header_options( $page, $general_header_tab ) {
		
		$section = $general_header_tab->add_section_element(
			array(
				'name'        => 'qodef_standard_header_section',
				'title'       => esc_html__( 'Standard Header', 'hendon-core' ),
				'description' => esc_html__( 'Standard header settings', 'hendon-core' ),
				'dependency'  => array(
					'show'    => array(
						'qodef_header_layout' => array(
							'values' => 'standard',
							'default_value' => ''
						)
					)
				)
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'yesno',
				'name'        => 'qodef_standard_header_in_grid',
				'title'       => esc_html__( 'Content in Grid', 'hendon-core' ),
				'description' => esc_html__( 'Set content to be in grid', 'hendon-core' ),
				'default_value' => 'no',
				'args'        => array(
					'suffix' => esc_html__( 'px', 'hendon-core' )
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_standard_header_height',
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
				'name'        => 'qodef_standard_header_side_padding',
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
				'name'        => 'qodef_standard_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'hendon-core' ),
				'description' => esc_html__( 'Enter header background color', 'hendon-core' )
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_standard_header_menu_position',
				'title'         => esc_html__( 'Menu position', 'hendon-core' ),
				'default_value' => 'right',
				'options'       => array(
					'left'   => esc_html__( 'Left', 'hendon-core' ),
					'center' => esc_html__( 'Center', 'hendon-core' ),
					'right'  => esc_html__( 'Right', 'hendon-core' ),
				)
			)
		);
	}
	
	add_action( 'hendon_core_action_after_header_options_map', 'hendon_core_add_standard_header_options', 10, 2 );
}