<?php

if ( ! function_exists( 'hendon_core_add_mobile_header_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function hendon_core_add_mobile_header_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => HENDON_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'layout'      => 'tabbed',
				'slug'        => 'mobile-header',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Mobile Header', 'hendon-core' ),
				'description' => esc_html__( 'Global Mobile Header Options', 'hendon-core' )
			)
		);

		if ( $page ) {
			$general_tab = $page->add_tab_element(
				array(
					'name'  => 'tab-mobile-header-general',
					'icon'  => 'fa fa-cog',
					'title' => esc_html__( 'General Settings', 'hendon-core' )
				)
			);
			
			$general_tab->add_field_element(
				array(
					'field_type'    => 'yesno',
					'default_value' => 'no',
					'name'          => 'qodef_mobile_header_scroll_appearance',
					'title'         => esc_html__( 'Sticky Mobile Header', 'hendon-core' ),
					'description'   => esc_html__( 'Set mobile header to be sticky', 'hendon-core' )
				)
			);
			
			$general_tab->add_field_element(
				array(
					'field_type'    => 'radio',
					'name'          => 'qodef_mobile_header_layout',
					'title'         => esc_html__( 'Mobile Header Layout', 'hendon-core' ),
					'description'   => esc_html__( 'Choose a mobile header layout to set for your website', 'hendon-core' ),
					'args'          => array( 'images' => true ),
					'default_value' => apply_filters( 'hendon_core_filter_mobile_header_layout_default_option', '' ),
					'options'       => apply_filters( 'hendon_core_filter_mobile_header_layout_option', $mobile_header_layout_options = array() )
				)
			);

			// Hook to include additional options after module options
			do_action( 'hendon_core_action_after_mobile_header_options_map', $page, $general_tab );
		}
	}

	add_action( 'hendon_core_action_default_options_init', 'hendon_core_add_mobile_header_options', hendon_core_get_admin_options_map_position( 'mobile-header' ) );
}