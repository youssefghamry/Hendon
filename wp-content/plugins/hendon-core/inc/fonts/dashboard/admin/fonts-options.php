<?php

if ( ! function_exists( 'hendon_core_add_fonts_options' ) ) {
	/**
	 * Function that add options for this module
	 */
	function hendon_core_add_fonts_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => HENDON_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'fonts',
				'title'       => esc_html__( 'Fonts', 'hendon-core' ),
				'description' => esc_html__( 'Global Fonts Options', 'hendon-core' ),
				'icon'        => 'fa fa-cog'
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_google_fonts',
					'title'         => esc_html__( 'Enable Google Fonts', 'hendon-core' ),
					'default_value' => 'yes',
					'args'          => array(
						'custom_class' => 'qodef-enable-google-fonts'
					)
				)
			);

			$google_fonts_section = $page->add_section_element(
				array(
					'name'       => 'qodef_google_fonts_section',
					'title'      => esc_html__( 'Google Fonts Options', 'hendon-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_enable_google_fonts' => array(
								'values'        => 'yes',
								'default_value' => ''
							)
						)
					)
				)
			);

			$page_repeater = $google_fonts_section->add_repeater_element(
				array(
					'name'        => 'qodef_choose_google_fonts',
					'title'       => esc_html__( 'Google Fonts to Include', 'hendon-core' ),
					'description' => esc_html__( 'Choose Google Fonts which you want to use on your website', 'hendon-core' ),
					'button_text' => esc_html__( 'Add New Google Font', 'hendon-core' )
				)
			);

			$page_repeater->add_field_element( array(
				'field_type'  => 'googlefont',
				'name'        => 'qodef_choose_google_font',
				'title'       => esc_html__( 'Google Font', 'hendon-core' ),
				'description' => esc_html__( 'Choose Google Font', 'hendon-core' ),
				'args'        => array(
					'include' => 'google-fonts'
				)
			) );

			$google_fonts_section->add_field_element(
				array(
					'field_type'  => 'checkbox',
					'name'        => 'qodef_google_fonts_weight',
					'title'       => esc_html__( 'Google Fonts Weight', 'hendon-core' ),
					'description' => esc_html__( 'Choose a default Google Fonts weights for your website. Impact on page load time', 'hendon-core' ),
					'options'     => array(
						'100'  => esc_html__( '100 Thin', 'hendon-core' ),
						'100i' => esc_html__( '100 Thin Italic', 'hendon-core' ),
						'200'  => esc_html__( '200 Extra-Light', 'hendon-core' ),
						'200i' => esc_html__( '200 Extra-Light Italic', 'hendon-core' ),
						'300'  => esc_html__( '300 Light', 'hendon-core' ),
						'300i' => esc_html__( '300 Light Italic', 'hendon-core' ),
						'400'  => esc_html__( '400 Regular', 'hendon-core' ),
						'400i' => esc_html__( '400 Regular Italic', 'hendon-core' ),
						'500'  => esc_html__( '500 Medium', 'hendon-core' ),
						'500i' => esc_html__( '500 Medium Italic', 'hendon-core' ),
						'600'  => esc_html__( '600 Semi-Bold', 'hendon-core' ),
						'600i' => esc_html__( '600 Semi-Bold Italic', 'hendon-core' ),
						'700'  => esc_html__( '700 Bold', 'hendon-core' ),
						'700i' => esc_html__( '700 Bold Italic', 'hendon-core' ),
						'800'  => esc_html__( '800 Extra-Bold', 'hendon-core' ),
						'800i' => esc_html__( '800 Extra-Bold Italic', 'hendon-core' ),
						'900'  => esc_html__( '900 Ultra-Bold', 'hendon-core' ),
						'900i' => esc_html__( '900 Ultra-Bold Italic', 'hendon-core' )
					)
				)
			);

			$google_fonts_section->add_field_element(
				array(
					'field_type'  => 'checkbox',
					'name'        => 'qodef_google_fonts_subset',
					'title'       => esc_html__( 'Google Fonts Style', 'hendon-core' ),
					'description' => esc_html__( 'Choose a default Google Fonts style for your website. Impact on page load time', 'hendon-core' ),
					'options'     => array(
						'latin'        => esc_html__( 'Latin', 'hendon-core' ),
						'latin-ext'    => esc_html__( 'Latin Extended', 'hendon-core' ),
						'cyrillic'     => esc_html__( 'Cyrillic', 'hendon-core' ),
						'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'hendon-core' ),
						'greek'        => esc_html__( 'Greek', 'hendon-core' ),
						'greek-ext'    => esc_html__( 'Greek Extended', 'hendon-core' ),
						'vietnamese'   => esc_html__( 'Vietnamese', 'hendon-core' )
					)
				)
			);

			$page_repeater = $page->add_repeater_element(
				array(
					'name'        => 'qodef_custom_fonts',
					'title'       => esc_html__( 'Custom Fonts', 'hendon-core' ),
					'description' => esc_html__( 'Add custom fonts', 'hendon-core' ),
					'button_text' => esc_html__( 'Add New Custom Font', 'hendon-core' )
				)
			);

			$page_repeater->add_field_element( array(
				'field_type' => 'file',
				'name'       => 'qodef_custom_font_ttf',
				'title'      => esc_html__( 'Custom Font TTF', 'hendon-core' ),
				'args'       => array(
					'allowed_type' => 'application/octet-stream'
				)
			) );

			$page_repeater->add_field_element( array(
				'field_type' => 'file',
				'name'       => 'qodef_custom_font_otf',
				'title'      => esc_html__( 'Custom Font OTF', 'hendon-core' ),
				'args'       => array(
					'allowed_type' => 'application/octet-stream'
				)
			) );

			$page_repeater->add_field_element( array(
				'field_type' => 'file',
				'name'       => 'qodef_custom_font_woff',
				'title'      => esc_html__( 'Custom Font WOFF', 'hendon-core' ),
				'args'       => array(
					'allowed_type' => 'application/octet-stream'
				)
			) );

			$page_repeater->add_field_element( array(
				'field_type' => 'file',
				'name'       => 'qodef_custom_font_woff2',
				'title'      => esc_html__( 'Custom Font WOFF2', 'hendon-core' ),
				'args'       => array(
					'allowed_type' => 'application/octet-stream'
				)
			) );

			$page_repeater->add_field_element( array(
				'field_type' => 'text',
				'name'       => 'qodef_custom_font_name',
				'title'      => esc_html__( 'Custom Font Name', 'hendon-core' ),
			) );

			// Hook to include additional options after module options
			do_action( 'hendon_core_action_after_page_fonts_options_map', $page );
		}
	}

	add_action( 'hendon_core_action_default_options_init', 'hendon_core_add_fonts_options', hendon_core_get_admin_options_map_position( 'fonts' ) );
}