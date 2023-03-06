<?php

if ( ! function_exists( 'hendon_core_add_sticky_header_options' ) ) {
	/**
	 * Function that add additional header layout global options
	 *
	 * @param object $page
	 * @param object $section
	 */
	function hendon_core_add_sticky_header_options( $page, $section ) {
		
		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_sticky_header_scroll_amount',
				'title'       => esc_html__( 'Sticky Scroll Amount', 'hendon-core' ),
				'description' => esc_html__( 'Enter scroll amount for sticky header to appear', 'hendon-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'hendon-core' )
				),
				'dependency'  => array(
					'show' => array(
						'qodef_header_scroll_appearance' => array(
							'values'        => 'sticky',
							'default_value' => ''
						)
					)
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_sticky_header_side_padding',
				'title'       => esc_html__( 'Sticky Header Side Padding', 'hendon-core' ),
				'description' => esc_html__( 'Enter side padding for sticky header area', 'hendon-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px or %', 'hendon-core' )
				),
				'dependency'  => array(
					'show' => array(
						'qodef_header_scroll_appearance' => array(
							'values'        => 'sticky',
							'default_value' => ''
						)
					)
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_sticky_header_background_color',
				'title'       => esc_html__( 'Sticky Header Background Color', 'hendon-core' ),
				'description' => esc_html__( 'Enter sticky header background color', 'hendon-core' ),
				'dependency'  => array(
					'show' => array(
						'qodef_header_scroll_appearance' => array(
							'values'        => 'sticky',
							'default_value' => ''
						)
					)
				)
			)
		);
	}
	
	add_action( 'hendon_core_action_after_header_scroll_appearance_options_map', 'hendon_core_add_sticky_header_options', 10, 2 );
}

if ( ! function_exists( 'hendon_core_add_sticky_header_logo_options' ) ) {
	/**
	 * Function that add additional header logo options
	 *
	 * @param object $page
	 * @param array $header_tab
	 */
	function hendon_core_add_sticky_header_logo_options( $page, $header_tab ) {
		
		if ( $header_tab ) {
			$header_tab->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_sticky',
					'title'       => esc_html__( 'Logo - Sticky', 'hendon-core' ),
					'description' => esc_html__( 'Choose sticky logo image', 'hendon-core' ),
					'multiple'    => 'no'
				)
			);
		}
	}
	
	add_action( 'hendon_core_action_after_header_logo_options_map', 'hendon_core_add_sticky_header_logo_options', 10, 2 );
}