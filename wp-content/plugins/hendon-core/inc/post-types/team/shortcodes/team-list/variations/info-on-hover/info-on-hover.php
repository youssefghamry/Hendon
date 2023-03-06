<?php

if ( ! function_exists( 'hendon_core_add_team_list_variation_info_on_hover' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function hendon_core_add_team_list_variation_info_on_hover( $variations ) {
		$variations['info-on-hover'] = esc_html__( 'Info on Hover', 'hendon-core' );
		
		return $variations;
	}
	
	add_filter( 'hendon_core_filter_team_list_layouts', 'hendon_core_add_team_list_variation_info_on_hover' );
}