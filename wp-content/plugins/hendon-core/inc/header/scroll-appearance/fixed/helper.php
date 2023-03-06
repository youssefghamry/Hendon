<?php

if ( ! function_exists( 'hendon_core_add_fixed_header_option' ) ) {
	/**
	 * This function set header scrolling appearance value for global header option map
	 */
	function hendon_core_add_fixed_header_option( $options ) {
		$options['fixed'] = esc_html__( 'Fixed', 'hendon-core' );

		return $options;
	}

	add_filter( 'hendon_core_filter_header_scroll_appearance_option', 'hendon_core_add_fixed_header_option' );
}