<?php

if ( ! function_exists( 'hendon_core_add_property_list_variation_image_only' ) ) {
	function hendon_core_add_property_list_variation_image_only( $variations ) {
		
		$variations['image-only'] = esc_html__( 'Image Only', 'hendon-core' );
		
		return $variations;
	}
	
	add_filter( 'hendon_core_filter_property_list_layouts', 'hendon_core_add_property_list_variation_image_only' );
}