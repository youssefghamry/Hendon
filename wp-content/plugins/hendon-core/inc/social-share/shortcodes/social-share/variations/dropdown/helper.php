<?php

if ( ! function_exists( 'hendon_core_add_social_share_variation_dropdown' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function hendon_core_add_social_share_variation_dropdown( $variations ) {
		$variations['dropdown'] = esc_html__( 'Dropdown', 'hendon-core' );
		
		return $variations;
	}
	
	add_filter( 'hendon_core_filter_social_share_layouts', 'hendon_core_add_social_share_variation_dropdown' );
}
