<?php

if ( ! function_exists( 'hendon_core_add_social_share_variation_text' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function hendon_core_add_social_share_variation_text( $variations ) {
		$variations['text'] = esc_html__( 'Text', 'hendon-core' );
		
		return $variations;
	}
	
	add_filter( 'hendon_core_filter_social_share_layouts', 'hendon_core_add_social_share_variation_text' );
}
