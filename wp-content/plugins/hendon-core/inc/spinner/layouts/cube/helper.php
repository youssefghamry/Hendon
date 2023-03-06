<?php

if ( ! function_exists( 'hendon_core_add_cube_spinner_layout_option' ) ) {
	/**
	 * Function that set new value into page spinner layout options map
	 *
	 * @param array $layouts  - module layouts
	 *
	 * @return array
	 */
	function hendon_core_add_cube_spinner_layout_option( $layouts ) {
		$layouts['cube'] = esc_html__( 'Cube', 'hendon-core' );
		
		return $layouts;
	}
	
	add_filter( 'hendon_core_filter_page_spinner_layout_options', 'hendon_core_add_cube_spinner_layout_option' );
}