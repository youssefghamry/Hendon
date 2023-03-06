<?php
if ( ! function_exists( 'hendon_core_add_top_area_meta_options' ) ) {
	/**
	 * Function that add additional header layout meta box options
	 *
	 * @param object $page
	 */
	function hendon_core_add_top_area_meta_options( $page ) {
		$top_area_section = $page->add_section_element(
			array(
				'name'       => 'qodef_top_area_section',
				'title'      => esc_html__( 'Top Area', 'hendon-core' ),
				'dependency' => array(
					'hide' => array(
						'qodef_header_layout' => array(
							'values'        => hendon_core_dependency_for_top_area_options(),
							'default_value' => ''
						)
					)
				)
			)
		);

		$top_area_section->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_top_area_header',
				'title'       => esc_html__( 'Top Area', 'hendon-core' ),
				'description' => esc_html__( 'Enable top area', 'hendon-core' ),
				'options'     => hendon_core_get_select_type_options_pool( 'yes_no' )
			)
		);

		$top_area_options_section = $top_area_section->add_section_element(
			array(
				'name'        => 'qodef_top_area_options_section',
				'title'       => esc_html__( 'Top Area Options', 'hendon-core' ),
				'description' => esc_html__( 'Set desired values for top area', 'hendon-core' ),
				'dependency'  => array(
					'show' => array(
						'qodef_top_area_header' => array(
							'values'        => 'yes',
							'default_value' => 'no'
						)
					)
				)
			)
		);

		$top_area_options_section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_top_area_header_background_color',
				'title'       => esc_html__( 'Top Area Background Color', 'hendon-core' ),
				'description' => esc_html__( 'Choose top area background color', 'hendon-core' )
			)
		);

		$top_area_options_section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_top_area_header_height',
				'title'       => esc_html__( 'Top Area Height', 'hendon-core' ),
				'description' => esc_html__( 'Enter top area height (default is 30px)', 'hendon-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'hendon-core' )
				)
			)
		);

		$top_area_options_section->add_field_element(
			array(
				'field_type' => 'text',
				'name'       => 'qodef_top_area_header_side_padding',
				'title'      => esc_html__( 'Top Area Side Padding', 'hendon-core' ),
				'args'       => array(
					'suffix' => esc_html__( 'px or %', 'hendon-core' )
				)
			)
		);
	}

	add_action( 'hendon_core_action_after_page_header_meta_map', 'hendon_core_add_top_area_meta_options', 20 );
}