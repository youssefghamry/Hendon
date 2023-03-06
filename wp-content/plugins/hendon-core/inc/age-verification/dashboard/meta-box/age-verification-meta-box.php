<?php

if ( ! function_exists( 'hendon_core_add_age_verification_single_meta_box' ) ) {
	/**
	 * Function that add general meta box options for this module
	 *
	 * @param object $page
	 */
	function hendon_core_add_age_verification_single_meta_box( $page ) {
		
		if ( $page ) {
			
			$age_verification_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-age-verification',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Age Verification Settings', 'hendon-core' ),
					'description' => esc_html__( 'Age Verification Settings', 'hendon-core' )
				)
			);
			
			$age_verification_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_enable_age_verification',
					'title'       => esc_html__( 'Enable Age Verification', 'hendon-core' ),
					'description' => esc_html__( 'Use this option to enable/disable Age Verification', 'hendon-core' ),
					'options'     => hendon_core_get_select_type_options_pool( 'no_yes' )
				)
			);
			
			// Hook to include additional options after module options
			do_action( 'hendon_core_action_after_page_age_verification_meta_box_map', $age_verification_tab );
		}
	}
	
	add_action( 'hendon_core_action_after_general_meta_box_map', 'hendon_core_add_age_verification_single_meta_box' );
}