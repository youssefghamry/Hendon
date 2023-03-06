<?php

if ( ! function_exists( 'hendon_core_add_property_list_variation_info_below' ) ) {
	function hendon_core_add_property_list_variation_info_below( $variations ) {
		
		$variations['info-below'] = esc_html__( 'Info Below', 'hendon-core' );
		
		return $variations;
	}
	
	add_filter( 'hendon_core_filter_property_list_layouts', 'hendon_core_add_property_list_variation_info_below' );
}

//if ( ! function_exists( 'hendon_core_add_portfolio_list_options_info_below' ) ) {
//	function hendon_core_add_portfolio_list_options_info_below( $options ) {
//		$info_below_options   = array();
//		$margin_option        = array(
//			'field_type' => 'text',
//			'name'       => 'info_below_content_margin_top',
//			'title'      => esc_html__( 'Content Top Margin', 'hendon-core' ),
//			'dependency' => array(
//				'show' => array(
//					'layout' => array(
//						'values'        => 'info-below',
//						'default_value' => ''
//					)
//				)
//			),
//			'group'      => esc_html__( 'Layout', 'hendon-core' )
//		);
//		$info_below_options[] = $margin_option;
//
//		return array_merge( $options, $info_below_options );
//	}
//
//	add_filter( 'hendon_core_filter_portfolio_list_extra_options', 'hendon_core_add_portfolio_list_options_info_below' );
//}