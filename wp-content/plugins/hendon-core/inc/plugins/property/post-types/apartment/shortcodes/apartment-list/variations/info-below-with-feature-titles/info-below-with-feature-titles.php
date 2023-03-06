<?php

if ( ! function_exists( 'hendon_core_add_apartment_list_variation_info_below_with_feature_titles' ) ) {
	function hendon_core_add_apartment_list_variation_info_below_with_feature_titles( $variations ) {
		
		$variations['info-below-with-feature-titles'] = esc_html__( 'Info Below With Feature Titles', 'hendon-core' );
		
		return $variations;
	}
	
	add_filter( 'hendon_core_filter_apartment_list_layouts', 'hendon_core_add_apartment_list_variation_info_below_with_feature_titles' );
}