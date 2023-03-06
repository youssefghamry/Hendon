<?php

if ( ! function_exists( 'hendon_core_add_banner_variation_link_button' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function hendon_core_add_banner_variation_link_button( $variations ) {
		$variations['link-button'] = esc_html__( 'Link Button', 'hendon-core' );
		
		return $variations;
	}
	
	add_filter( 'hendon_core_filter_banner_layouts', 'hendon_core_add_banner_variation_link_button' );
}
