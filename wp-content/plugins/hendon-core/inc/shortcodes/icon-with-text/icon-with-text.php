<?php

if ( ! function_exists( 'hendon_core_add_icon_with_text_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function hendon_core_add_icon_with_text_shortcode( $shortcodes ) {
		$shortcodes[] = 'HendonCoreIconWithTextShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'hendon_core_filter_register_shortcodes', 'hendon_core_add_icon_with_text_shortcode' );
}

if ( class_exists( 'HendonCoreShortcode' ) ) {
	class HendonCoreIconWithTextShortcode extends HendonCoreShortcode {
		
		public function __construct() {
			$this->set_layouts( apply_filters( 'hendon_core_filter_icon_with_text_layouts', array() ) );
			
			$options_map = hendon_core_get_variations_options_map( $this->get_layouts() );
			$default_value = $options_map['default_value'];
			
			$this->set_extra_options( apply_filters( 'hendon_core_filter_icon_with_text_extra_options', array(), $default_value ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( HENDON_CORE_SHORTCODES_URL_PATH . '/icon-with-text' );
			$this->set_base( 'hendon_core_icon_with_text' );
			$this->set_name( esc_html__( 'Icon With Text', 'hendon-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds icon with text element', 'hendon-core' ) );
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
				'options'		=> $this->get_layouts(),
				'default_value' => $options_map['default_value'],
				'visibility'    => array( 'map_for_page_builder' => $options_map['visibility'] )
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'enable_circle',
				'title'      => esc_html__( 'Enable Circular Frame', 'hendon-core' ),
				'options'       => hendon_core_get_select_type_options_pool( 'no_yes', false ),
				'dependency' => array(
					'show' => array(
						'layout' => array(
							'values'        => 'top',
							'default_value' => 'before-content'
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'circle_color',
				'title'      => esc_html__( 'Circle Color', 'hendon-core' ),
				'dependency' => array(
					'show' => array(
						'enable_circle' => array(
							'values'        => 'yes',
							'default_value' => 'no'
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'circle_hover_color',
				'title'      => esc_html__( 'Circle Hover Color', 'hendon-core' ),
				'dependency' => array(
					'show' => array(
						'enable_circle' => array(
							'values'        => 'yes',
							'default_value' => 'no'
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type'    => 'text',
				'name'          => 'link',
				'title'         => esc_html__( 'Link', 'hendon-core' ),
				'default_value' => ''
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'target',
				'title'         => esc_html__( 'Link Target', 'hendon-core' ),
				'options'       => hendon_core_get_select_type_options_pool( 'link_target' ),
				'default_value' => '_self'
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'icon_type',
				'title'         => esc_html__( 'Icon Type', 'hendon-core' ),
				'options'       => array(
					'icon-pack'   => esc_html__( 'Icon Pack', 'hendon-core' ),
					'custom-icon' => esc_html__( 'Custom Icon', 'hendon-core' ),
					'svg-path'    => esc_html__( 'SVG', 'hendon-core' )
				),
				'default_value' => 'icon-pack',
				'group'         => esc_html__( 'Icon', 'hendon-core' )
			) );
			$this->set_option( array(
				'field_type' => 'image',
				'name'       => 'custom_icon',
				'title'      => esc_html__( 'Custom Icon', 'hendon-core' ),
				'group'      => esc_html__( 'Icon', 'hendon-core' ),
				'dependency' => array(
					'show' => array(
						'icon_type' => array(
							'values'        => 'custom-icon',
							'default_value' => 'icon-pack'
						)
					)
				)
			) );
            $this->set_option( array(
                'field_type' => 'textarea',
                'name'       => 'svg_path',
                'title'      => esc_html__( 'SVG Path', 'hendon-core' ),
                'group'      => esc_html__( 'Icon', 'hendon-core' ),
                'dependency' => array(
                    'show' => array(
                        'icon_type' => array(
                            'values'        => 'svg-path',
                            'default_value' => 'icon-pack'
                        )
                    )
                )
            ) );
			$this->import_shortcode_options( array(
				'shortcode_base'    => 'hendon_core_icon',
				'exclude'           => array( 'custom_class', 'link', 'target', 'margin' ),
				'additional_params' => array(
					'group'      => esc_html__( 'Icon', 'hendon-core' ),
					'dependency' => array(
						'show' => array(
							'icon_type' => array(
								'values'        => 'icon-pack',
								'default_value' => 'icon-pack'
							)
						)
					)
				)
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
				'default_value' => 'h3',
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
				'field_type' => 'textarea',
				'name'       => 'text',
				'title'      => esc_html__( 'Text', 'hendon-core' ),
				'group'      => esc_html__( 'Content', 'hendon-core' )
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
			$this->map_extra_options();
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['title_styles']   = $this->get_title_styles( $atts );
			$atts['text_styles']    = $this->get_text_styles( $atts );
			$atts['box_styles']    = $this->get_box_styles( $atts );
			$atts['data_attrs']     = $this->get_data_attrs( $atts );
			$atts['icon_params']    = $this->generate_icon_params( $atts );
			
			return hendon_core_get_template_part( 'shortcodes/icon-with-text', 'variations/' . $atts['layout'] . '/templates/' . $atts['layout'], '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-icon-with-text';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			$holder_classes[] = ! empty( $atts['icon_type'] ) ? 'qodef--' . $atts['icon_type'] : '';
			$holder_classes[] = ! empty( $atts['enable_circle'] ) && $atts['enable_circle'] === 'yes' ? 'qodef--circle-frame-enabled' : '';
			
			$holder_classes = apply_filters( 'hendon_core_filter_icon_with_text_variation_classes', $holder_classes, $atts );
			
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
		
		private function get_box_styles( $atts ) {
			$styles = array();
			
			if ( $atts['border_color'] !== '' ) {
				$styles[] = 'border-color: ' . $atts['border_color'];
			}
			
			return $styles;
		}
		
		private function get_data_attrs( $atts ) {
			$data = array();
			
			if ( ! empty( $atts['hover_background_color'] ) ) {
				$data['data-hover-background-color'] = $atts['hover_background_color'];
			}

			if ( ! empty( $atts['circle_color'] ) ) {
				$data['data-circle-color'] = $atts['circle_color'];
			}

			if ( ! empty( $atts['circle_hover_color'] ) ) {
				$data['data-circle-hover-color'] = $atts['circle_hover_color'];
			}
			
			return $data;
		}
		
		private function generate_icon_params( $atts ) {
			$params = $this->populate_imported_shortcode_atts( array(
				'shortcode_base' => 'hendon_core_icon',
				'exclude'        => array( 'custom_class', 'link', 'target', 'margin' ),
				'atts'           => $atts,
			) );
			
			return $params;
		}
	}
}