<?php

if ( ! function_exists( 'hendon_core_add_button_variation_textual' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function hendon_core_add_button_variation_textual( $variations ) {
		$variations['textual'] = esc_html__( 'Textual', 'hendon-core' );
		
		return $variations;
	}
	
	add_filter( 'hendon_core_filter_button_layouts', 'hendon_core_add_button_variation_textual' );
}
