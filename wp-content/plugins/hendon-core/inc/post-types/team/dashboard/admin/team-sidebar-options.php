<?php

if ( ! function_exists( 'hendon_core_add_team_archive_sidebar_options' ) ) {
	/**
	 * Function that add sidebar options for team archive module
	 */
	function hendon_core_add_team_archive_sidebar_options( $tab ) {
		
		if ( $tab ) {
			$tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_team_archive_sidebar_layout',
					'title'         => esc_html__( 'Sidebar Layout', 'hendon-core' ),
					'description'   => esc_html__( 'Choose default sidebar layout for team archives', 'hendon-core' ),
					'default_value' => 'no-sidebar',
					'options'       => hendon_core_get_select_type_options_pool( 'sidebar_layouts', false )
				)
			);
			
			$custom_sidebars = hendon_core_get_custom_sidebars();
			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {
				$tab->add_field_element(
					array(
						'field_type'    => 'select',
						'name'          => 'qodef_team_archive_custom_sidebar',
						'title'         => esc_html__( 'Custom Sidebar', 'hendon-core' ),
						'description'   => esc_html__( 'Choose a custom sidebar to display on team archives', 'hendon-core' ),
						'options'       => $custom_sidebars
					)
				);
			}
			
			$tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_team_archive_sidebar_grid_gutter',
					'title'       => esc_html__( 'Set Grid Gutter', 'hendon-core' ),
					'description' => esc_html__( 'Choose grid gutter size to set space between content and sidebar', 'hendon-core' ),
					'options'     => hendon_core_get_select_type_options_pool( 'items_space' )
				)
			);
		}
	}
	
	add_action( 'hendon_core_action_after_team_options_archive', 'hendon_core_add_team_archive_sidebar_options' );
}

if ( ! function_exists( 'hendon_core_add_team_single_sidebar_options' ) ) {
	/**
	 * Function that add sidebar options for team single module
	 */
	function hendon_core_add_team_single_sidebar_options( $tab ) {
		
		if ( $tab ) {
			$tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_team_single_sidebar_layout',
					'title'         => esc_html__( 'Sidebar Layout', 'hendon-core' ),
					'description'   => esc_html__( 'Choose default sidebar layout for team singles', 'hendon-core' ),
					'default_value' => 'no-sidebar',
					'options'       => hendon_core_get_select_type_options_pool( 'sidebar_layouts', false )
				)
			);
			
			$custom_sidebars = hendon_core_get_custom_sidebars();
			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {
				$tab->add_field_element(
					array(
						'field_type'    => 'select',
						'name'          => 'qodef_team_single_custom_sidebar',
						'title'         => esc_html__( 'Custom Sidebar', 'hendon-core' ),
						'description'   => esc_html__( 'Choose a custom sidebar to display on team singles', 'hendon-core' ),
						'options'       => $custom_sidebars
					)
				);
			}
			
			$tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_team_single_sidebar_grid_gutter',
					'title'       => esc_html__( 'Set Grid Gutter', 'hendon-core' ),
					'description' => esc_html__( 'Choose grid gutter size to set space between content and sidebar', 'hendon-core' ),
					'options'     => hendon_core_get_select_type_options_pool( 'items_space' )
				)
			);
		}
	}
	
	add_action( 'hendon_core_action_after_team_options_single', 'hendon_core_add_team_single_sidebar_options' );
}