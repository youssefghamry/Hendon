<?php

if ( ! function_exists( 'hendon_load_page_mobile_header' ) ) {
	/**
	 * Function which loads page template module
	 */
	function hendon_load_page_mobile_header() {
		// Include mobile header template
		echo apply_filters( 'hendon_filter_mobile_header_template', hendon_get_template_part( 'mobile-header', 'templates/mobile-header' ) );
	}
	
	add_action( 'hendon_action_page_header_template', 'hendon_load_page_mobile_header' );
}

if ( ! function_exists( 'hendon_register_mobile_navigation_menus' ) ) {
	/**
	 * Function which registers navigation menus
	 */
	function hendon_register_mobile_navigation_menus() {
		$navigation_menus = apply_filters( 'hendon_filter_register_mobile_navigation_menus', array( 'mobile-navigation' => esc_html__( 'Mobile Navigation', 'hendon' ) ) );
		
		if ( ! empty( $navigation_menus ) ) {
			register_nav_menus( $navigation_menus );
		}
	}
	
	add_action( 'hendon_action_after_include_modules', 'hendon_register_mobile_navigation_menus' );
}