<?php

if ( ! function_exists( 'hendon_core_nav_menu_meta_options' ) ) {
	/**
	 * Function that add general options for this module
	 *
	 * @param object $page
	 */
	function hendon_core_nav_menu_meta_options( $page ) {
		
		if ( $page ) {
			
			$section = $page->add_section_element(
				array(
					'name'  => 'qodef_nav_menu_section',
					'title' => esc_html__( 'Main Menu', 'hendon-core' )
				)
			);
			
			$section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_dropdown_top_position',
					'title'       => esc_html__( 'Dropdown Position', 'hendon-core' ),
					'description' => esc_html__( 'Enter value in percentage of entire header height', 'hendon-core' ),
				)
			);
		}
	}
	
	add_action( 'hendon_core_action_after_page_header_meta_map', 'hendon_core_nav_menu_meta_options' );
}