<?php

if ( ! function_exists( 'hendon_core_add_banner_variation_link_overlay' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function hendon_core_add_banner_variation_link_overlay( $variations ) {
		$variations['link-overlay'] = esc_html__( 'Link Overlay', 'hendon-core' );
		
		return $variations;
	}
	
	add_filter( 'hendon_core_filter_banner_layouts', 'hendon_core_add_banner_variation_link_overlay' );
}
