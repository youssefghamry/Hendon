<?php

if ( ! function_exists( 'hendon_core_add_button_variation_filled' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function hendon_core_add_button_variation_filled( $variations ) {
		$variations['filled'] = esc_html__( 'Filled', 'hendon-core' );
		
		return $variations;
	}
	
	add_filter( 'hendon_core_filter_button_layouts', 'hendon_core_add_button_variation_filled' );
}
