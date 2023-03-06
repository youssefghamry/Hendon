<?php

if ( ! function_exists( 'hendon_core_add_icon_with_text_variation_before_content' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function hendon_core_add_icon_with_text_variation_before_content( $variations ) {
		$variations['before-content'] = esc_html__( 'Before Content', 'hendon-core' );
		
		return $variations;
	}
	
	add_filter( 'hendon_core_filter_icon_with_text_layouts', 'hendon_core_add_icon_with_text_variation_before_content' );
}
