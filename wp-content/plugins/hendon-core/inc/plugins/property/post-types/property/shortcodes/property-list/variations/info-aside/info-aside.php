<?php

if ( ! function_exists( 'hendon_core_add_property_list_variation_info_aside' ) ) {
	function hendon_core_add_property_list_variation_info_aside( $variations ) {
		
		$variations['info-aside'] = esc_html__( 'Info Aside', 'hendon-core' );
		
		return $variations;
	}
	
	add_filter( 'hendon_core_filter_property_list_layouts', 'hendon_core_add_property_list_variation_info_aside' );
}