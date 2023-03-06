<?php

if ( ! function_exists( 'hendon_core_add_hendon_spinner_layout_option' ) ) {
	/**
	 * Function that set new value into page spinner layout options map
	 *
	 * @param array $layouts  - module layouts
	 *
	 * @return array
	 */
	function hendon_core_add_hendon_spinner_layout_option( $layouts ) {
		$layouts['hendon'] = esc_html__( 'Hendon', 'hendon-core' );
		
		return $layouts;
	}
	
	add_filter( 'hendon_core_filter_page_spinner_layout_options', 'hendon_core_add_hendon_spinner_layout_option' );
}

if ( ! function_exists( 'hendon_core_set_hendon_spinner_layout_as_default_option' ) ) {
	/**
	 * Function that set default value for page spinner layout options map
	 *
	 * @param string $default_value
	 *
	 * @return string
	 */
	function hendon_core_set_hendon_spinner_layout_as_default_option( $default_value ) {
		return 'hendon';
	}
	
	add_filter( 'hendon_core_filter_page_spinner_default_layout_option', 'hendon_core_set_hendon_spinner_layout_as_default_option' );
}