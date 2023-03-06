<?php

if ( ! function_exists( 'hendon_core_add_icon_with_text_variation_top' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function hendon_core_add_icon_with_text_variation_top( $variations ) {
		$variations['top'] = esc_html__( 'Top', 'hendon-core' );
		
		return $variations;
	}
	
	add_filter( 'hendon_core_filter_icon_with_text_layouts', 'hendon_core_add_icon_with_text_variation_top' );
}

if ( ! function_exists( 'hendon_core_add_icon_with_text_options_text_align' ) ) {
	/**
	 * Function that add additional options for variation layout
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	function hendon_core_add_icon_with_text_options_text_align( $options, $default_layout ) {
		$icon_with_text_options   = array();
		
		$alignment_option = array(
			'field_type' => 'select',
			'name'       => 'content_alignment',
			'title'      => esc_html__( 'Content Alignment', 'hendon-core' ),
			'options'       => array(
				''       => esc_html__( 'Default', 'hendon-core' ),
				'left'   => esc_html__( 'Left', 'hendon-core' ),
				'center' => esc_html__( 'Center', 'hendon-core' ),
				'right'  => esc_html__( 'Right', 'hendon-core' )
			),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values'        => 'top',
						'default_value' => $default_layout
					)
				)
			),
			'group'      => esc_html__( 'Content', 'hendon-core' )
		);
		
		$icon_with_text_options[] = $alignment_option;
		
		return array_merge( $options, $icon_with_text_options );
	}
	
	add_filter( 'hendon_core_filter_icon_with_text_extra_options', 'hendon_core_add_icon_with_text_options_text_align', 10, 2 );
}

if ( ! function_exists( 'hendon_core_add_icon_with_text_classes_alignment' ) ) {
	/**
	 * Function that return additional holder classes for this module
	 *
	 * @param array $holder_classes
	 * @param array $atts
	 *
	 * @return array
	 */
	function hendon_core_add_icon_with_text_classes_alignment( $holder_classes, $atts ) {
		
		if( $atts['layout'] == 'top' ) {
			$holder_classes[] = ! empty( $atts['content_alignment'] ) ?  'qodef-alignment--' . $atts['content_alignment'] : 'qodef-alignment--center';
		}
		
		return $holder_classes;
	}
	
	add_filter( 'hendon_core_filter_icon_with_text_variation_classes', 'hendon_core_add_icon_with_text_classes_alignment', 10, 2 );
}