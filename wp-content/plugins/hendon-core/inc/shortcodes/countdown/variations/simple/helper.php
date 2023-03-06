<?php

if ( ! function_exists( 'hendon_core_add_countdown_variation_simple' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function hendon_core_add_countdown_variation_simple( $variations ) {
		$variations['simple'] = esc_html__( 'Simple', 'hendon-core' );
		
		return $variations;
	}
	
	add_filter( 'hendon_core_filter_countdown_layouts', 'hendon_core_add_countdown_variation_simple' );
}
