<?php

if ( ! function_exists( 'hendon_core_add_logo_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function hendon_core_add_logo_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => HENDON_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'logo',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Logo', 'hendon-core' ),
				'description' => esc_html__( 'Global Logo Options', 'hendon-core' ),
				'layout'      => 'tabbed'
			)
		);

		if ( $page ) {

			$header_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-header',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Header Logo Options', 'hendon-core' ),
					'description' => esc_html__( 'Set options for initial headers', 'hendon-core' )
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_logo_height',
					'title'       => esc_html__( 'Logo Height', 'hendon-core' ),
					'description' => esc_html__( 'Enter logo height', 'hendon-core' ),
					'args'        => array(
						'suffix' => esc_html__( 'px', 'hendon-core' )
					)
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'    => 'image',
					'name'          => 'qodef_logo_main',
					'title'         => esc_html__( 'Logo - Main', 'hendon-core' ),
					'description'   => esc_html__( 'Choose main logo image', 'hendon-core' ),
					'default_value' => defined( 'HENDON_ASSETS_ROOT' ) ? HENDON_ASSETS_ROOT . '/img/logo.png' : '',
					'multiple'      => 'no'
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_dark',
					'title'       => esc_html__( 'Logo - Dark', 'hendon-core' ),
					'description' => esc_html__( 'Choose dark logo image', 'hendon-core' ),
					'multiple'    => 'no'
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_light',
					'title'       => esc_html__( 'Logo - Light', 'hendon-core' ),
					'description' => esc_html__( 'Choose light logo image', 'hendon-core' ),
					'multiple'    => 'no'
				)
			);

			// Hook to include additional options after module options
			do_action( 'hendon_core_action_after_header_logo_options_map', $page, $header_tab );
		}
	}

	add_action( 'hendon_core_action_default_options_init', 'hendon_core_add_logo_options', hendon_core_get_admin_options_map_position( 'logo' ) );
}