<?php

if ( ! function_exists( 'hendon_core_add_banner_variation_custom_icon' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function hendon_core_add_banner_variation_custom_icon( $variations ) {
		$variations['with-custom-icon'] = esc_html__( 'With Custom Icon', 'hendon-core' );
		
		return $variations;
	}
	
	add_filter( 'hendon_core_filter_banner_layouts', 'hendon_core_add_banner_variation_custom_icon' );
}
