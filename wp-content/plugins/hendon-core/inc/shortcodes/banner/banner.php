<?php

if ( ! function_exists( 'hendon_core_add_banner_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function hendon_core_add_banner_shortcode( $shortcodes ) {
		$shortcodes[] = 'HendonCoreBannerShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'hendon_core_filter_register_shortcodes', 'hendon_core_add_banner_shortcode' );
}

if ( class_exists( 'HendonCoreShortcode' ) ) {
	class HendonCoreBannerShortcode extends HendonCoreShortcode {
		
		public function __construct() {
			$this->set_layouts( apply_filters( 'hendon_core_filter_banner_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'hendon_core_filter_banner_extra_options', array() ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( HENDON_CORE_SHORTCODES_URL_PATH . '/banner' );
			$this->set_base( 'hendon_core_banner' );
			$this->set_name( esc_html__( 'Banner', 'hendon-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds banner element', 'hendon-core' ) );
			$this->set_category( esc_html__( 'Hendon Core', 'hendon-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'hendon-core' ),
			) );
			
			$options_map = hendon_core_get_variations_options_map( $this->get_layouts() );
			
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'layout',
				'title'         => esc_html__( 'Layout', 'hendon-core' ),
				'options'       => $this->get_layouts(),
				'default_value' => $options_map['default_value'],
				'visibility'    => array( 'map_for_page_builder' => $options_map['visibility'] )
			) );
			$this->set_option( array(
				'field_type' => 'image',
				'name'       => 'image',
				'title'      => esc_html__( 'Image', 'hendon-core' ),
                'dependency'    => array(
                    'hide' => array(
                        'layout' => array(
                            'values'        => array('with-custom-icon'),
                            'default_value' => ''
                        )
                    )
                )
			) );
            $this->set_option( array(
                'field_type'    => 'select',
                'name'          => 'icon_type',
                'title'         => esc_html__( 'Icon Type', 'hendon-core' ),
                'options'       => array(
                    'custom-icon' => esc_html__( 'Custom Icon', 'hendon-core' ),
                    'svg-path'    => esc_html__( 'SVG', 'hendon-core' )
                ),
                'default_value' => '',
                'dependency' => array(
                    'show' => array(
                        'layout' => array(
                            'values'        => 'with-custom-icon',
                            'default_value' => ''
                        )
                    )
                )
            ) );
            $this->set_option( array(
                'field_type' => 'image',
                'name'       => 'custom_icon',
                'title'      => esc_html__( 'Custom Icon', 'hendon-core' ),
                'dependency' => array(
                    'show' => array(
                        'icon_type' => array(
                            'values'        => 'custom-icon',
                            'default_value' => ''
                        )
                    )
                )
            ) );
            $this->set_option( array(
                'field_type' => 'textarea',
                'name'       => 'svg_path',
                'title'      => esc_html__( 'SVG Path', 'hendon-core' ),
                'dependency' => array(
                    'show' => array(
                        'icon_type' => array(
                            'values'        => 'svg-path',
                            'default_value' => ''
                        )
                    )
                )
            ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'link_url',
				'title'      => esc_html__( 'Link', 'hendon-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'link_target',
				'title'         => esc_html__( 'Link Target', 'hendon-core' ),
				'options'       => hendon_core_get_select_type_options_pool( 'link_target' ),
				'default_value' => '_self'
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title',
				'title'      => esc_html__( 'Title', 'hendon-core' ),
				'group'      => esc_html__( 'Content', 'hendon-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'title_tag',
				'title'         => esc_html__( 'Title Tag', 'hendon-core' ),
				'options'       => hendon_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => 'h5',
				'group'         => esc_html__( 'Content', 'hendon-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'title_color',
				'title'      => esc_html__( 'Title Color', 'hendon-core' ),
				'group'      => esc_html__( 'Content', 'hendon-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title_margin_top',
				'title'      => esc_html__( 'Title Margin Top', 'hendon-core' ),
				'group'      => esc_html__( 'Content', 'hendon-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'subtitle',
				'title'      => esc_html__( 'Subtitle', 'hendon-core' ),
				'group'      => esc_html__( 'Content', 'hendon-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'subtitle_tag',
				'title'         => esc_html__( 'Subtitle Tag', 'hendon-core' ),
				'options'       => hendon_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => 'h6',
				'group'         => esc_html__( 'Content', 'hendon-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'subtitle_color',
				'title'      => esc_html__( 'Subtitle Color', 'hendon-core' ),
				'group'      => esc_html__( 'Content', 'hendon-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'subtitle_margin_top',
				'title'      => esc_html__( 'Subtitle Margin Top', 'hendon-core' ),
				'group'      => esc_html__( 'Content', 'hendon-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'text_field',
				'title'      => esc_html__( 'Text', 'hendon-core' ),
				'group'      => esc_html__( 'Content', 'hendon-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'text_tag',
				'title'         => esc_html__( 'Text Tag', 'hendon-core' ),
				'options'       => hendon_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => 'p',
				'group'         => esc_html__( 'Content', 'hendon-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'text_color',
				'title'      => esc_html__( 'Text Color', 'hendon-core' ),
				'group'      => esc_html__( 'Content', 'hendon-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'text_margin_top',
				'title'      => esc_html__( 'Text Margin Top', 'hendon-core' ),
				'group'      => esc_html__( 'Content', 'hendon-core' )
			) );
			$this->import_shortcode_options( array(
				'shortcode_base'    => 'hendon_core_button',
				'exclude'           => array( 'custom_class', 'link', 'target' ),
				'additional_params' => array(
					'group' => esc_html__( 'Button', 'hendon-core' ),
					'dependency'    => array(
						'show' => array(
							'layout' => array(
								'values'        => array('link-button', 'with-custom-icon'),
								'default_value' => ''
							)
						)
					)
				)
			) );
			
			$this->map_extra_options();
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['holder_classes']  = $this->get_holder_classes( $atts );
			$atts['title_styles']    = $this->get_title_styles( $atts );
			$atts['subtitle_styles'] = $this->get_subtitle_styles( $atts );
			$atts['text_styles']     = $this->get_text_styles( $atts );
			$atts['button_params']   = $this->generate_button_params( $atts );
			
			return hendon_core_get_template_part( 'shortcodes/banner', 'variations/' . $atts['layout'] . '/templates/' . $atts['layout'], '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-banner';
			$holder_classes[] = ! empty ( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			
			return implode( ' ', $holder_classes );
		}
		
		private function get_title_styles( $atts ) {
			$styles = array();
			
			if ( $atts['title_margin_top'] !== '' ) {
				if ( qode_framework_string_ends_with_space_units( $atts['title_margin_top'] ) ) {
					$styles[] = 'margin-top: ' . $atts['title_margin_top'];
				} else {
					$styles[] = 'margin-top: ' . intval( $atts['title_margin_top'] ) . 'px';
				}
			}
			
			if ( ! empty( $atts['title_color'] ) ) {
				$styles[] = 'color: ' . $atts['title_color'];
			}
			
			return $styles;
		}
		
		private function get_subtitle_styles( $atts ) {
			$styles = array();
			
			if ( $atts['subtitle_margin_top'] !== '' ) {
				if ( qode_framework_string_ends_with_space_units( $atts['subtitle_margin_top'] ) ) {
					$styles[] = 'margin-top: ' . $atts['subtitle_margin_top'];
				} else {
					$styles[] = 'margin-top: ' . intval( $atts['subtitle_margin_top'] ) . 'px';
				}
			}
			
			if ( ! empty( $atts['subtitle_color'] ) ) {
				$styles[] = 'color: ' . $atts['subtitle_color'];
			}
			
			return $styles;
		}
		
		private function get_text_styles( $atts ) {
			$styles = array();
			
			if ( $atts['text_margin_top'] !== '' ) {
				if ( qode_framework_string_ends_with_space_units( $atts['text_margin_top'] ) ) {
					$styles[] = 'margin-top: ' . $atts['text_margin_top'];
				} else {
					$styles[] = 'margin-top: ' . intval( $atts['text_margin_top'] ) . 'px';
				}
			}
			
			if ( ! empty( $atts['text_color'] ) ) {
				$styles[] = 'color: ' . $atts['text_color'];
			}
			
			return $styles;
		}
		
		private function generate_button_params( $atts ) {
			$params = $this->populate_imported_shortcode_atts( array(
				'shortcode_base' => 'hendon_core_button',
				'exclude'        => array( 'custom_class', 'link', 'target' ),
				'atts'           => $atts,
			) );
			
			$params['link']   = ! empty( $atts['link_url'] ) ? $atts['link_url'] : '';
			$params['target'] = ! empty( $atts['link_target'] ) ? $atts['link_target'] : '';
			
			return $params;
		}
	}
}