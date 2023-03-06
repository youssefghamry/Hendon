<?php

if ( ! function_exists( 'hendon_core_add_blog_list_variation_metro' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function hendon_core_add_blog_list_variation_metro( $variations ) {
		$variations['metro'] = esc_html__( 'Metro', 'hendon-core' );
		
		return $variations;
	}
	
	add_filter( 'hendon_core_filter_blog_list_layouts', 'hendon_core_add_blog_list_variation_metro' );
}