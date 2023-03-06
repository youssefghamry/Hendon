<?php

if ( ! function_exists( 'hendon_core_add_social_share_variation_list' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function hendon_core_add_social_share_variation_list( $variations ) {
		$variations['list'] = esc_html__( 'List', 'hendon-core' );
		
		return $variations;
	}
	
	add_filter( 'hendon_core_filter_social_share_layouts', 'hendon_core_add_social_share_variation_list' );
}
