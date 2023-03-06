<?php

if ( ! function_exists( 'hendon_core_add_apartment_list_variation_info_below' ) ) {
	function hendon_core_add_apartment_list_variation_info_below( $variations ) {
		
		$variations['info-below'] = esc_html__( 'Info Below', 'hendon-core' );
		
		return $variations;
	}
	
	add_filter( 'hendon_core_filter_apartment_list_layouts', 'hendon_core_add_apartment_list_variation_info_below' );
}