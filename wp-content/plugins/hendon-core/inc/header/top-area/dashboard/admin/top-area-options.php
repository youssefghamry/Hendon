<?php

if ( ! function_exists( 'hendon_core_add_top_area_options' ) ) {
	/**
	 * Function that add additional header layout options
	 *
	 * @param object $page
	 * @param array $general_header_tab
	 */
	function hendon_core_add_top_area_options( $page, $general_header_tab ) {

		$top_area_section = $general_header_tab->add_section_element(
			array(
				'name'        => 'qodef_top_area_section',
				'title'       => esc_html__( 'Top Area', 'hendon-core' ),
				'description' => esc_html__( 'Options related to top area', 'hendon-core' ),
				'dependency'  => array(
					'hide' => array(
						'qodef_header_layout' => array(
							'values'        => hendon_core_dependency_for_top_area_options(),
							'default_value' => apply_filters( 'hendon_core_filter_header_layout_default_option_value', '' )
						)
					)
				)
			)
		);

		$top_area_section->add_field_element(
			array(
				'field_type'    => 'yesno',
				'default_value' => 'no',
				'name'          => 'qodef_top_area_header',
				'title'         => esc_html__( 'Top Area', 'hendon-core' ),
				'description'   => esc_html__( 'Enable top area', 'hendon-core' )
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

	add_action( 'hendon_core_action_after_header_options_map', 'hendon_core_add_top_area_options', 20, 2 );
}