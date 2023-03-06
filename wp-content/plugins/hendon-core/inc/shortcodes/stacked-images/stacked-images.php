<?php

if ( ! function_exists( 'hendon_core_add_stacked_images_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function hendon_core_add_stacked_images_shortcode( $shortcodes ) {
		$shortcodes[] = 'HendonCoreStackedImagesShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'hendon_core_filter_register_shortcodes', 'hendon_core_add_stacked_images_shortcode' );
}

if ( class_exists( 'HendonCoreShortcode' ) ) {
	class HendonCoreStackedImagesShortcode extends HendonCoreShortcode {
		
		public function __construct() {
			$this->set_layouts( apply_filters( 'hendon_core_filter_stacked_images_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'hendon_core_filter_stacked_images_extra_options', array() ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( HENDON_CORE_SHORTCODES_URL_PATH . '/stacked-images' );
			$this->set_base( 'hendon_core_stacked_images' );
			$this->set_name( esc_html__( 'Stacked Images', 'hendon-core' ) );
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
				'options'       => $this->get_layouts(),
				'default_value' => $options_map['default_value'],
				'visibility'    => array( 'map_for_page_builder' => $options_map['visibility'] )
			) );
			$this->set_option( array(
				'field_type' => 'image',
				'name'       => 'main_image',
				'title'      => esc_html__( 'Main Image', 'hendon-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'image',
				'name'       => 'stacked_image',
				'title'      => esc_html__( 'Stacked Image', 'hendon-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'top_offset',
				'title'      => esc_html__( 'Top Offset (px or %)', 'hendon-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'left_offset',
				'title'      => esc_html__( 'Left Offset (px or %)', 'hendon-core' ),
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
				'default_value' => 'left',
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
                'options'       => hendon_core_get_select_type_options_pool( 'no_yes', false),
            ) );
            $this->set_option( array(
                'field_type'    => 'select',
                'name'          => 'enable_additional_stacked_image',
                'title'         => esc_html__( 'Enable Additional Stacked Image', 'hendon-core' ),
                'options'       => hendon_core_get_select_type_options_pool( 'no_yes', false ),
            ) );
            $this->set_option( array(
                'field_type' => 'image',
                'name'       => 'additional_stacked_image',
                'title'      => esc_html__( 'Additional Stacked Image', 'hendon-core' ),
                'dependency' => array(
                    'show' => array(
                        'enable_additional_stacked_image' => array(
                            'values'        => 'yes',
                            'default_value' => ''
                        )
                    )
                )
            ) );
			$this->map_extra_options();
		}
		
		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'hendon_core_stacked_images', $params );
			$html = str_replace( "\n", '', $html );
			
			return $html;
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['stack_image_styles'] = $this->get_stack_image_styles( $atts );
			$atts['images_holder_styles'] = $this->get_images_holder_styles( $atts );
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['image_params']   = $this->generate_image_params( $atts );
			$holder_classes[] = ! empty ( $atts['outline_position'] ) ? 'qodef-image-outline-' . $atts['outline_position'] : '';
			
			return hendon_core_get_template_part( 'shortcodes/stacked-images', 'variations/' . $atts['layout'] . '/templates/' . $atts['layout'], '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-stacked-images';
			$holder_classes[] = ! empty ( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
            $holder_classes[] = ! empty ( $atts['enable_outline'] ) && $atts['enable_outline'] === 'yes' ? 'qodef-image-outline' : '';
            $holder_classes[] = ! empty ( $atts['outline_position'] ) ? 'qodef-image-outline-' . $atts['outline_position'] : '';
            $holder_classes[] = ! empty ( $atts['enable_shadow'] ) && $atts['enable_shadow'] === 'yes' ? 'qodef-image-shadow' : '';
            $holder_classes[] = ! empty ( $atts['enable_additional_stacked_image'] ) && $atts['enable_additional_stacked_image'] === 'yes' ? 'qodef-has-additional-image' : '';

            if ( ! empty( $atts['left_offset'] )) {
                if( intval( $atts['left_offset'] ) < 0 ) {
                    $holder_classes[] = 'qodef-stacked-image-left';
                } else {
                    $holder_classes[] = 'qodef-stacked-image-right';
                }
            }
			
			return implode( ' ', $holder_classes );
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
		
		public function get_stack_image_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['top_offset'] ) ) {
				if ( qode_framework_string_ends_with_space_units( $atts['top_offset'] ) ) {
					$styles[] = 'top: ' . $atts['top_offset'];
				} else {
					$styles[] = 'top: ' . intval( $atts['top_offset'] ) . '%';
				}
			}

			if ( ! empty( $atts['left_offset'] ) ) {
				if ( qode_framework_string_ends_with_space_units( $atts['left_offset'] ) ) {
					$styles[] = 'left: ' . $atts['left_offset'];
				} else {
					$styles[] = 'left: ' . intval( $atts['left_offset'] ) . '%';
				}
			}

			return $styles;
		}

        public function get_images_holder_styles( $atts ) {
            $styles = array();
            $positive_left_offset = abs(intval( $atts['left_offset']));

            if ( ! empty( $atts['left_offset'] ) && intval( $atts['left_offset']) < 0 ) {

                if ( qode_framework_string_ends_with($atts['left_offset'], '%') ) {
                    $styles[] = 'transform: translateX(' . $positive_left_offset . '%)';
                } elseif ( qode_framework_string_ends_with($atts['left_offset'], 'px')) {
                    $styles[] = 'transform: translateX(' . $positive_left_offset . 'px)';
                }
            }

            return $styles;
        }
	}
}