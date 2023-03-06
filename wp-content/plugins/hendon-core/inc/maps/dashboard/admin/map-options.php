<?php

if ( ! function_exists( 'hendon_core_add_map_options' ) ) {
	/**
	 * Function that add map options
	 */
	function hendon_core_add_map_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => HENDON_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'map',
				'icon'        => 'fa fa-book',
				'title'       => esc_html__( 'Maps', 'hendon-core' ),
				'description' => esc_html__( 'Global Maps Options', 'hendon-core' )
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_maps_api_key',
					'title'       => esc_html__( 'Maps API Key', 'hendon-core' ),
					'description' => esc_html__( 'Enter Google Maps API key', 'hendon-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'textarea',
					'name'        => 'qodef_map_style',
					'title'       => esc_html__( 'Map Style', 'hendon-core' ),
					'description' => esc_html__( 'Enter Snazzy Map style JSON code', 'hendon-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_map_zoom',
					'title'       => esc_html__( 'Map Zoom', 'hendon-core' ),
					'description' => esc_html__( 'Enter default zoom value for map', 'hendon-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_map_scroll',
					'title'         => esc_html__( 'Enable Map Scroll', 'hendon-core' ),
					'description'   => esc_html__( 'Use this option to enable map scrolling', 'hendon-core' ),
					'default_value' => 'no'
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_map_drag',
					'title'         => esc_html__( 'Enable Map Dragging', 'hendon-core' ),
					'description'   => esc_html__( 'Use this option to enable map dragging', 'hendon-core' ),
					'default_value' => 'yes'
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_map_street_view_control',
					'title'         => esc_html__( 'Enable Map Street View Control', 'hendon-core' ),
					'description'   => esc_html__( 'Use this option to enable street view control on map', 'hendon-core' ),
					'default_value' => 'yes'
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_map_zoom_control',
					'title'         => esc_html__( 'Enable Map Zoom Control', 'hendon-core' ),
					'description'   => esc_html__( 'Use this option to enable zoom control on map', 'hendon-core' ),
					'default_value' => 'yes'
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_map_type_control',
					'title'         => esc_html__( 'Enable Map Type Control', 'hendon-core' ),
					'description'   => esc_html__( 'Use this option to enable type control on map', 'hendon-core' ),
					'default_value' => 'yes'
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_map_full_screen_control',
					'title'         => esc_html__( 'Enable Map Full Screen Control', 'hendon-core' ),
					'description'   => esc_html__( 'Use this option to enable full screen control on map', 'hendon-core' ),
					'default_value' => 'yes'
				)
			);

			// Hook to include additional options after module options
			do_action( 'hendon_core_action_after_map_options_map', $page );
		}
	}

	add_action( 'hendon_core_action_default_options_init', 'hendon_core_add_map_options', hendon_core_get_admin_options_map_position( 'maps' ) );
}