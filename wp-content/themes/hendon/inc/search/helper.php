<?php

if ( ! function_exists( 'hendon_get_search_page_excerpt_length' ) ) {
	/**
	 * Function that return number of characters for excerpt on search page
	 *
	 * @return int
	 */
	function hendon_get_search_page_excerpt_length() {
		$length = apply_filters( 'hendon_filter_search_page_excerpt_length', 180 );
		
		return intval( $length );
	}
}
