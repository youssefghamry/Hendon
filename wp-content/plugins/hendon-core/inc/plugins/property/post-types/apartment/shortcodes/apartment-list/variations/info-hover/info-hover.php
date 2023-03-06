<?php

if ( ! function_exists( 'hendon_core_add_apartment_list_variation_info_hover' ) ) {
	function hendon_core_add_apartment_list_variation_info_hover( $variations ) {
		
		$variations['info-hover'] = esc_html__( 'Info On Hover', 'hendon-core' );
		
		return $variations;
	}
	
	add_filter( 'hendon_core_filter_apartment_list_layouts', 'hendon_core_add_apartment_list_variation_info_hover' );
}