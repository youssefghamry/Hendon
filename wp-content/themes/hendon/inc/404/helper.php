<?php

if ( ! function_exists( 'hendon_set_404_page_inner_classes' ) ) {
	/**
	 * Function that return classes for the page inner div from header.php
	 *
	 * @param string $classes
	 *
	 * @return string
	 */
	function hendon_set_404_page_inner_classes( $classes ) {
		
		if ( is_404() ) {
			$classes = 'qodef-content-full-width';
		}
		
		return $classes;
	}
	
	add_filter( 'hendon_filter_page_inner_classes', 'hendon_set_404_page_inner_classes' );
}

if ( ! function_exists( 'hendon_get_404_page_parameters' ) ) {
	/**
	 * Function that set 404 page area content parameters
	 */
	function hendon_get_404_page_parameters() {
		
		$params = array(
			'title'       => esc_html__( '404', 'hendon' ),
			'text'        => esc_html__( 'The page you are looking for doesn\'t exist. It may have been moved or removed altogether.', 'hendon' ),
			'button_text' => esc_html__( 'Homepage', 'hendon' ),
		);
		
		return apply_filters( 'hendon_filter_404_page_template_params', $params );
	}
}
