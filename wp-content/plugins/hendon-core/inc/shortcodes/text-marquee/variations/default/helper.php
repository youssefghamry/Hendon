<?php

if ( ! function_exists( 'hendon_core_add_text_marquee_variation_default' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function hendon_core_add_text_marquee_variation_default( $variations ) {
		$variations['default'] = esc_html__( 'Default', 'hendon-core' );
		
		return $variations;
	}
	
	add_filter( 'hendon_core_filter_text_marquee_layouts', 'hendon_core_add_text_marquee_variation_default' );
}