<?php

if ( ! function_exists( 'hendon_core_add_image_with_text_variation_text_below' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function hendon_core_add_image_with_text_variation_text_below( $variations ) {
		$variations['text-below'] = esc_html__( 'Text Below', 'hendon-core' );
		
		return $variations;
	}
	
	add_filter( 'hendon_core_filter_image_with_text_layouts', 'hendon_core_add_image_with_text_variation_text_below' );
}
