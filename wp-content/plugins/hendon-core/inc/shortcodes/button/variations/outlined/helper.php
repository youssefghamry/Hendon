<?php

if ( ! function_exists( 'hendon_core_add_button_variation_outlined' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function hendon_core_add_button_variation_outlined( $variations ) {
		$variations['outlined'] = esc_html__( 'Outlined', 'hendon-core' );
		
		return $variations;
	}
	
	add_filter( 'hendon_core_filter_button_layouts', 'hendon_core_add_button_variation_outlined' );
}
