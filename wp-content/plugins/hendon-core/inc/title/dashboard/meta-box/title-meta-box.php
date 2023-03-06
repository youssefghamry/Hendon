<?php

if ( ! function_exists( 'hendon_core_add_page_title_meta_box' ) ) {
	/**
	 * Function that add general meta box options for this module
	 *
	 * @param object $page
	 */
	function hendon_core_add_page_title_meta_box( $page ) {

		if ( $page ) {

			$title_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-title',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Title Settings', 'hendon-core' ),
					'description' => esc_html__( 'Title layout settings', 'hendon-core' )
				)
			);

			$title_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_enable_page_title',
					'title'       => esc_html__( 'Enable Page Title', 'hendon-core' ),
					'description' => esc_html__( 'Use this option to enable/disable page title', 'hendon-core' ),
					'options'     => hendon_core_get_select_type_options_pool( 'no_yes' )
				)
			);

			$page_title_section = $title_tab->add_section_element(
				array(
					'name'       => 'qodef_page_title_section',
					'title'      => esc_html__( 'Title Area', 'hendon-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_enable_page_title' => array(
								'values'        => 'no',
								'default_value' => ''
							)
						)
					)
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_title_layout',
					'title'       => esc_html__( 'Title Layout', 'hendon-core' ),
					'description' => esc_html__( 'Choose a title layout', 'hendon-core' ),
					'options'     => apply_filters( 'hendon_core_filter_title_layout_options', $layouts = array( '' => esc_html__( 'Default', 'hendon-core' ) ) )
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_set_page_title_area_in_grid',
					'title'       => esc_html__( 'Page Title In Grid', 'hendon-core' ),
					'description' => esc_html__( 'Enabling this option will set page title area to be in grid', 'hendon-core' ),
					'options'     => hendon_core_get_select_type_options_pool( 'no_yes' )
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_title_height',
					'title'       => esc_html__( 'Height', 'hendon-core' ),
					'description' => esc_html__( 'Enter title height', 'hendon-core' ),
					'args'        => array(
						'suffix' => esc_html__( 'px', 'hendon-core' )
					)
				)
			);
			
			$page_title_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_title_height_on_smaller_screens',
					'title'       => esc_html__( 'Height on Smaller Screens', 'hendon-core' ),
					'description' => esc_html__( 'Enter title height to be displayed on smaller screens with active mobile header', 'hendon-core' ),
					'args'        => array(
						'suffix' => esc_html__( 'px', 'hendon-core' )
					)
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_page_title_background_color',
					'title'       => esc_html__( 'Background Color', 'hendon-core' ),
					'description' => esc_html__( 'Enter page title area background color', 'hendon-core' )
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_page_title_background_image',
					'title'       => esc_html__( 'Background Image', 'hendon-core' ),
					'description' => esc_html__( 'Enter page title area background image', 'hendon-core' )
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_page_title_background_image_behavior',
					'title'      => esc_html__( 'Background Image Behavior', 'hendon-core' ),
					'options'    => array(
						''           => esc_html__( 'Default', 'hendon-core' ),
						'responsive' => esc_html__( 'Set Responsive Image', 'hendon-core' ),
						'parallax'   => esc_html__( 'Set Parallax Image', 'hendon-core' )
					)
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_page_title_color',
					'title'      => esc_html__( 'Title Color', 'hendon-core' )
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_page_title_tag',
					'title'         => esc_html__( 'Title Tag', 'hendon-core' ),
					'description'   => esc_html__( 'Enabling this option will set title tag', 'hendon-core' ),
					'options'       => hendon_core_get_select_type_options_pool( 'title_tag' ),
					'default_value' => '',
					'dependency'    => array(
						'show' => array(
							'qodef_title_layout' => array(
								'values'        => array( 'standard-with-breadcrumbs', 'standard' ),
								'default_value' => ''
							)
						)
					)
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_page_title_text_alignment',
					'title'         => esc_html__( 'Text Alignment', 'hendon-core' ),
					'options'       => array(
						''       => esc_html__( 'Default', 'hendon-core' ),
						'left'   => esc_html__( 'Left', 'hendon-core' ),
						'center' => esc_html__( 'Center', 'hendon-core' ),
						'right'  => esc_html__( 'Right', 'hendon-core' )
					),
					'default_value' => ''
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_page_title_vertical_text_alignment',
					'title'         => esc_html__( 'Vertical Text Alignment', 'hendon-core' ),
					'options'       => array(
						''              => esc_html__( 'Default', 'hendon-core' ),
						'header-bottom' => esc_html__( 'From Bottom of Header', 'hendon-core' ),
						'window-top'    => esc_html__( 'From Window Top', 'hendon-core' )
					),
					'default_value' => ''
				)
			);

			// Hook to include additional options after module options
			do_action( 'hendon_core_action_after_page_title_meta_box_map', $page_title_section );
		}
	}

	add_action( 'hendon_core_action_after_general_meta_box_map', 'hendon_core_add_page_title_meta_box' );
}

if ( ! function_exists( 'hendon_core_add_general_page_title_meta_box_callback' ) ) {
	/**
	 * Function that set current meta box callback as general callback functions
	 *
	 * @param array $callbacks
	 *
	 * @return array
	 */
	function hendon_core_add_general_page_title_meta_box_callback( $callbacks ) {
		$callbacks['page-title'] = 'hendon_core_add_page_title_meta_box';
		
		return $callbacks;
	}
	
	add_filter( 'hendon_core_filter_general_meta_box_callbacks', 'hendon_core_add_general_page_title_meta_box_callback');
}