<?php

if ( ! function_exists( 'hendon_core_add_image_with_text_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function hendon_core_add_image_with_text_shortcode( $shortcodes ) {
		$shortcodes[] = 'HendonCoreImageWithTextShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'hendon_core_filter_register_shortcodes', 'hendon_core_add_image_with_text_shortcode' );
}

if ( class_exists( 'HendonCoreShortcode' ) ) {
	class HendonCoreImageWithTextShortcode extends HendonCoreShortcode {
		
		public function __construct() {
			$this->set_layouts( apply_filters( 'hendon_core_filter_image_with_text_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'hendon_core_filter_image_with_text_extra_options', array() ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( HENDON_CORE_SHORTCODES_URL_PATH . '/image-with-text' );
			$this->set_base( 'hendon_core_image_with_text' );
			$this->set_name( esc_html__( 'Image With Text', 'hendon-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds image with text element', 'hendon-core' ) );
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
				'field_type' => 'image',
				'name'       => 'image',
				'title'      => esc_html__( 'Image', 'hendon-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'image_size',
				'title'      => esc_html__( 'Image Size', 'hendon-core' ),
				'description'=> esc_html__( 'For predefined image sizes input thumbnail, medium, large or full. If you wish to set a custom image size, type in the desired image dimensions in pixels (e.g. 400x400).', 'hendon-core' ),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'image_action',
				'title'         => esc_html__( 'Image Action', 'hendon-core' ),
				'options'       => array(
					''            => esc_html__( 'No Action', 'hendon-core' ),
					'open-popup'  => esc_html__( 'Open Popup', 'hendon-core' ),
					'custom-link' => esc_html__( 'Custom Link', 'hendon-core' )
				)
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'link',
				'title'      => esc_html__( 'Custom Link', 'hendon-core' ),
				'dependency' => array(
					'show' => array(
						'image_action' => array(
							'values'        => 'custom-link',
							'default_value' => ''
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'target',
				'title'         => esc_html__( 'Custom Link Target', 'hendon-core' ),
				'options'       => hendon_core_get_select_type_options_pool( 'link_target' ),
				'default_value' => '_self',
				'dependency' => array(
					'show' => array(
						'image_action' => array(
							'values'        => 'custom-link',
							'default_value' => ''
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'enable_outline',
				'title'         => esc_html__( 'Enable Outline', 'hendon-core' ),
				'options'       => hendon_core_get_select_type_options_pool( 'yes_no' ),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'outline_position',
				'title'         => esc_html__( 'Outline Position', 'hendon-core' ),
				'options'       => array(
					'left'        => esc_html__( 'Left', 'hendon-core' ),
					'right'       => esc_html__( 'Right', 'hendon-core' ),
					'top-left'    => esc_html__( 'Top/Left', 'hendon-core' ),
					'top-right'   => esc_html__( 'Top/Right', 'hendon-core' ),
				),
				'default_value' => 'top-right',
				'dependency' => array(
					'show' => array(
						'enable_outline' => array(
							'values'        => 'yes',
							'default_value' => ''
						)
					)
				)
			) );
            $this->set_option( array(
                'field_type'    => 'select',
                'name'          => 'enable_shadow',
                'title'         => esc_html__( 'Enable Shadow', 'hendon-core' ),
                'options'       => hendon_core_get_select_type_options_pool( 'no_yes' ),
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
				'default_value' => 'h4',
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
                'field_type'    => 'select',
                'name'          => 'text_tag',
                'title'         => esc_html__( 'Text Tag', 'hendon-core' ),
                'options'       => hendon_core_get_select_type_options_pool( 'title_tag' ),
                'default_value' => 'h6',
                'group'         => esc_html__( 'Content', 'hendon-core' )
            ) );
            $this->set_option( array(
                'field_type' => 'text',
                'name'       => 'text_font_size',
                'title'      => esc_html__( 'Text Font Size', 'hendon-core' ),
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
		
		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'hendon_core_image_with_text', $params );
			$html = str_replace( "\n", '', $html );
			
			return $html;
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['title_styles']   = $this->get_title_styles( $atts );
			$atts['text_styles']    = $this->get_text_styles( $atts );
			$atts['image_params']   = $this->generate_image_params( $atts );
			
			return hendon_core_get_template_part( 'shortcodes/image-with-text', 'variations/' . $atts['layout'] . '/templates/' . $atts['layout'], '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-image-with-text';
			$holder_classes[] = ! empty ( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			$holder_classes[] = ! empty ( $atts['enable_outline'] ) && $atts['enable_outline'] === 'yes' ? 'qodef-image-outline' : '';
			$holder_classes[] = ! empty ( $atts['outline_position'] ) ? 'qodef-image-outline-' . $atts['outline_position'] : '';
            $holder_classes[] = ! empty ( $atts['enable_shadow'] ) && $atts['enable_shadow'] === 'yes' ? 'qodef-image-shadow' : '';
			
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

            if ( !empty($atts['text_font_size']) && $atts['text_font_size'] !== '' ) {
                if ( qode_framework_string_ends_with_typography_units( $atts['text_font_size'] ) ) {
                    $styles[] = 'font-size: ' . $atts['text_font_size'];
                } else {
                    $styles[] = 'font-size: ' . intval( $atts['text_font_size'] ) . 'px';
                }
            }
			
			return $styles;
		}
		
		private function generate_image_params( $atts ) {
			$image = array();
			
			if ( ! empty( $atts['image'] ) ) {
				$id = $atts['image'];
				
				$image['image_id'] = intval( $id );
				$image_original    = wp_get_attachment_image_src( $id, 'full' );
				$image['url']      = $image_original[0];
				$image['alt']      = get_post_meta( $id, '_wp_attachment_image_alt', true );
				
				$image_size = trim( $atts['image_size'] );
				preg_match_all( '/\d+/', $image_size, $matches ); /* check if numeral width and height are entered */
				if ( in_array( $image_size, array( 'thumbnail', 'thumb', 'medium', 'large', 'full' ) ) ) {
					$image['image_size'] = $image_size;
				} elseif ( ! empty( $matches[0] ) ) {
					$image['image_size'] = array(
						$matches[0][0],
						$matches[0][1]
					);
				} else {
					$image['image_size'] = 'full';
				}
			}
			
			return $image;
		}
	}
}