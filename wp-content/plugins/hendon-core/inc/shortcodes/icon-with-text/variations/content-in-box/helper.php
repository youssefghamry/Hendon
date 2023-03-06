<?php

if ( ! function_exists( 'hendon_core_add_icon_with_text_variation_content_in_box' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function hendon_core_add_icon_with_text_variation_content_in_box( $variations ) {
		$variations['content-in-box'] = esc_html__( 'Content in Box', 'hendon-core' );
		
		return $variations;
	}
	
	add_filter( 'hendon_core_filter_icon_with_text_layouts', 'hendon_core_add_icon_with_text_variation_content_in_box' );
}

if ( ! function_exists( 'hendon_core_add_icon_with_text_additional_options' ) ) {
	/**
	 * Function that add additional options for variation layout
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	function hendon_core_add_icon_with_text_additional_options( $options, $default_layout ) {
		$icon_with_text_options   = array();
		
		$border_color_option = array(
			'field_type' => 'color',
			'name'       => 'border_color',
			'title'      => esc_html__( 'Border Color', 'hendon-core' ),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values'        => 'content-in-box',
						'default_value' => $default_layout
					)
				)
			)
		);
		
		$hover_background_option = array(
			'field_type' => 'color',
			'name'       => 'hover_background_color',
			'title'      => esc_html__( 'Hover Background Color', 'hendon-core' ),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values'        => 'content-in-box',
						'default_value' => $default_layout
					)
				)
			)
		);
		
		$icon_with_text_options[] = $border_color_option;
		$icon_with_text_options[] = $hover_background_option;
		
		return array_merge( $options, $icon_with_text_options );
	}
	
	add_filter( 'hendon_core_filter_icon_with_text_extra_options', 'hendon_core_add_icon_with_text_additional_options', 10, 2 );
}
