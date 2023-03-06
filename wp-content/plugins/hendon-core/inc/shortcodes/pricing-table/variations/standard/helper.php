<?php

if ( ! function_exists( 'hendon_core_add_pricing_table_variation_standard' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function hendon_core_add_pricing_table_variation_standard( $variations ) {
		
		$variations['standard'] = esc_html__( 'Standard', 'hendon-core' );
		
		return $variations;
	}
	
	add_filter( 'hendon_core_filter_pricing_table_layouts', 'hendon_core_add_pricing_table_variation_standard' );
}
