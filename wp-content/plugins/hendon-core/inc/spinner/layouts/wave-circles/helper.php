<?php

if ( ! function_exists( 'hendon_core_add_wave_circles_spinner_layout_option' ) ) {
	/**
	 * Function that set new value into page spinner layout options map
	 *
	 * @param array $layouts  - module layouts
	 *
	 * @return array
	 */
	function hendon_core_add_wave_circles_spinner_layout_option( $layouts ) {
		$layouts['wave-circles'] = esc_html__( 'Wave Circles', 'hendon-core' );
		
		return $layouts;
	}
	
	add_filter( 'hendon_core_filter_page_spinner_layout_options', 'hendon_core_add_wave_circles_spinner_layout_option' );
}