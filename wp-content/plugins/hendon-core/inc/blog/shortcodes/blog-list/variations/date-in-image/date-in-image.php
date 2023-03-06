<?php

if ( ! function_exists( 'hendon_core_add_blog_list_variation_date_in_image' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function hendon_core_add_blog_list_variation_date_in_image( $variations ) {
		$variations['date-in-image'] = esc_html__( 'Date in Image', 'hendon-core' );
		
		return $variations;
	}
	
	add_filter( 'hendon_core_filter_blog_list_layouts', 'hendon_core_add_blog_list_variation_date_in_image' );
}