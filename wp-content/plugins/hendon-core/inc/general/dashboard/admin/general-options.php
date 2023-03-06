<?php

if ( ! function_exists( 'hendon_core_add_general_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function hendon_core_add_general_options( $page ) {

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_main_color',
					'title'       => esc_html__( 'Main Color', 'hendon-core' ),
					'description' => esc_html__( 'Choose the most dominant theme color', 'hendon-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_page_background_color',
					'title'       => esc_html__( 'Page Background Color', 'hendon-core' ),
					'description' => esc_html__( 'Set background color', 'hendon-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_page_background_image',
					'title'       => esc_html__( 'Page Background Image', 'hendon-core' ),
					'description' => esc_html__( 'Set background image', 'hendon-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_page_background_repeat',
					'title'       => esc_html__( 'Page Background Image Repeat', 'hendon-core' ),
					'description' => esc_html__( 'Set background image repeat', 'hendon-core' ),
					'options'     => array(
						''          => esc_html__( 'Default', 'hendon-core' ),
						'no-repeat' => esc_html__( 'No Repeat', 'hendon-core' ),
						'repeat'    => esc_html__( 'Repeat', 'hendon-core' ),
						'repeat-x'  => esc_html__( 'Repeat-x', 'hendon-core' ),
						'repeat-y'  => esc_html__( 'Repeat-y', 'hendon-core' )
					)
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_page_background_size',
					'title'       => esc_html__( 'Page Background Image Size', 'hendon-core' ),
					'description' => esc_html__( 'Set background image size', 'hendon-core' ),
					'options'     => array(
						''        => esc_html__( 'Default', 'hendon-core' ),
						'contain' => esc_html__( 'Contain', 'hendon-core' ),
						'cover'   => esc_html__( 'Cover', 'hendon-core' )
					)
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_page_background_attachment',
					'title'       => esc_html__( 'Page Background Image Attachment', 'hendon-core' ),
					'description' => esc_html__( 'Set background image attachment', 'hendon-core' ),
					'options'     => array(
						''       => esc_html__( 'Default', 'hendon-core' ),
						'fixed'  => esc_html__( 'Fixed', 'hendon-core' ),
						'scroll' => esc_html__( 'Scroll', 'hendon-core' )
					)
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_content_padding',
					'title'       => esc_html__( 'Page Content Padding', 'hendon-core' ),
					'description' => esc_html__( 'Set padding that will be applied for page content in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'hendon-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_content_padding_mobile',
					'title'       => esc_html__( 'Page Content Padding Mobile', 'hendon-core' ),
					'description' => esc_html__( 'Set padding that will be applied for page content on mobile screens (1024px and below) in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'hendon-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_boxed',
					'title'         => esc_html__( 'Boxed Layout', 'hendon-core' ),
					'description'   => esc_html__( 'Set boxed layout', 'hendon-core' ),
					'default_value' => 'no'
				)
			);

			$boxed_section = $page->add_section_element(
				array(
					'name'       => 'qodef_boxed_section',
					'title'      => esc_html__( 'Boxed Layout Section', 'hendon-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_boxed' => array(
								'values'        => 'no',
								'default_value' => ''
							)
						)
					)
				)
			);

			$boxed_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_boxed_background_color',
					'title'       => esc_html__( 'Boxed Background Color', 'hendon-core' ),
					'description' => esc_html__( 'Set boxed background color', 'hendon-core' )
				)
			);

            $boxed_section->add_field_element(
                array(
                    'field_type'  => 'image',
                    'name'        => 'qodef_boxed_background_pattern',
                    'title'       => esc_html__( 'Boxed Background Pattern', 'hendon-core' ),
                    'description' => esc_html__( 'Set boxed background pattern', 'hendon-core' )
                )
            );

            $boxed_section->add_field_element(
                array(
                    'field_type'  => 'select',
                    'name'        => 'qodef_boxed_background_pattern_behavior',
                    'title'       => esc_html__( 'Boxed Background Pattern Behavior', 'hendon-core' ),
                    'description' => esc_html__( 'Set boxed background pattern behavior', 'hendon-core' ),
                    'options'     => array(
                        'fixed'  => esc_html__( 'Fixed', 'hendon-core' ),
                        'scroll' => esc_html__( 'Scroll', 'hendon-core' )
                    ),
                )
            );

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_passepartout',
					'title'         => esc_html__( 'Passepartout', 'hendon-core' ),
					'description'   => esc_html__( 'Enabling this option will display a passepartout around website content', 'hendon-core' ),
					'default_value' => 'no'
				)
			);

			$passepartout_section = $page->add_section_element(
				array(
					'name'       => 'qodef_passepartout_section',
					'title'      => esc_html__( 'Passepartout Section', 'hendon-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_passepartout' => array(
								'values'        => 'no',
								'default_value' => ''
							)
						)
					)
				)
			);

			$passepartout_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_passepartout_color',
					'title'       => esc_html__( 'Passepartout Color', 'hendon-core' ),
					'description' => esc_html__( 'Choose background color for passepartout', 'hendon-core' )
				)
			);

			$passepartout_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_passepartout_image',
					'title'       => esc_html__( 'Passepartout Background Image', 'hendon-core' ),
					'description' => esc_html__( 'Set background image for passepartout', 'hendon-core' )
				)
			);

			$passepartout_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_passepartout_size',
					'title'       => esc_html__( 'Passepartout Size', 'hendon-core' ),
					'description' => esc_html__( 'Enter size amount for passepartout', 'hendon-core' ),
					'args'        => array(
						'suffix' => esc_html__( 'px or %', 'hendon-core' )
					)
				)
			);

			$passepartout_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_passepartout_size_responsive',
					'title'       => esc_html__( 'Passepartout Responsive Size', 'hendon-core' ),
					'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (1024px and below)', 'hendon-core' ),
					'args'        => array(
						'suffix' => esc_html__( 'px or %', 'hendon-core' )
					)
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_content_width',
					'title'         => esc_html__( 'Initial Width of Content', 'hendon-core' ),
					'description'   => esc_html__( 'Choose the initial width of content which is in grid (applies to pages set to "Default Template" and rows set to "In Grid")', 'hendon-core' ),
					'options'       => hendon_core_get_select_type_options_pool( 'content_width', false ),
					'default_value' => '1100'
				)
			);

			// Hook to include additional options after module options
			do_action( 'hendon_core_action_after_general_options_map', $page );
			
			$page->add_field_element(
				array(
					'field_type'  => 'textarea',
					'name'        => 'qodef_custom_js',
					'title'       => esc_html__( 'Custom JS', 'hendon-core' ),
					'description' => esc_html__( 'Enter your custom Javascript here', 'hendon-core' )
				)
			);
		}
	}

	add_action( 'hendon_core_action_default_options_init', 'hendon_core_add_general_options', hendon_core_get_admin_options_map_position( 'general' ) );
}