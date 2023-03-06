<?php

if ( ! function_exists( 'hendon_core_add_clients_list_variation_image_only' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function hendon_core_add_clients_list_variation_image_only( $variations ) {
		$variations['image-only'] = esc_html__( 'Image Only', 'hendon-core' );
		
		return $variations;
	}
	
	add_filter( 'hendon_core_filter_clients_list_layouts', 'hendon_core_add_clients_list_variation_image_only' );
}