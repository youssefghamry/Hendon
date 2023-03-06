<?php

if ( ! function_exists( 'hendon_core_add_admin_user_options' ) ) {
	/**
	 * Function that add global user options
	 */
	function hendon_core_add_admin_user_options() {
		$qode_framework = qode_framework_get_framework_root();
		
		$page = $qode_framework->add_options_page(
			array(
				'scope' => array( 'administrator', 'author' ),
				'type'  => 'user',
				'title' => esc_html__( 'Social Networks', 'hendon-core' ),
				'slug'  => 'admin-options',
			)
		);
		
		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_facebook',
					'title'       => esc_html__( 'Facebook', 'hendon-core' ),
					'description' => esc_html__( 'Enter user Facebook profile URL', 'hendon-core' ),
				)
			);
			
			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_instagram',
					'title'       => esc_html__( 'Instagram', 'hendon-core' ),
					'description' => esc_html__( 'Enter user Instagram profile URL', 'hendon-core' ),
				)
			);
			
			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_twitter',
					'title'       => esc_html__( 'Twitter', 'hendon-core' ),
					'description' => esc_html__( 'Enter user Twitter profile URL', 'hendon-core' ),
				)
			);
			
			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_linkedin',
					'title'       => esc_html__( 'LinkedIn', 'hendon-core' ),
					'description' => esc_html__( 'Enter user LinkedIn profile URL', 'hendon-core' ),
				)
			);
			
			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_pinterest',
					'title'       => esc_html__( 'Pinterest', 'hendon-core' ),
					'description' => esc_html__( 'Enter user Pinterest profile URL', 'hendon-core' ),
				)
			);
			
			// Hook to include additional options after module options
			do_action( 'hendon_core_action_after_admin_user_options_map', $page );
		}
	}
	
	add_action( 'hendon_core_action_register_role_custom_fields', 'hendon_core_add_admin_user_options' );
}