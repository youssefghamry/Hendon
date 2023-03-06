<?php

if ( ! function_exists( 'hendon_core_filter_clients_list_image_only_fade_in' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function hendon_core_filter_clients_list_image_only_fade_in( $variations ) {
		$variations['fade-in'] = esc_html__( 'Fade In', 'hendon-core' );
		
		return $variations;
	}
	
	add_filter( 'hendon_core_filter_clients_list_image_only_animation_options', 'hendon_core_filter_clients_list_image_only_fade_in' );
}