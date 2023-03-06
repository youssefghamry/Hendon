<?php

if ( ! function_exists( 'hendon_core_add_numbered_carousel_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function hendon_core_add_numbered_carousel_shortcode( $shortcodes ) {
		$shortcodes[] = 'HendonCoreNumberedCarouselShortcode';

		return $shortcodes;
	}

	add_filter( 'hendon_core_filter_register_shortcodes', 'hendon_core_add_numbered_carousel_shortcode' );
}

if ( class_exists( 'HendonCoreShortcode' ) ) {
	class HendonCoreNumberedCarouselShortcode extends HendonCoreShortcode {
		
		public function __construct() {
			$this->set_extra_options( apply_filters( 'hendon_core_filter_numbered_carousel_extra_options', array() ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( HENDON_CORE_SHORTCODES_URL_PATH . '/numbered-carousel' );
			$this->set_base( 'hendon_core_numbered_carousel' );
			$this->set_name( esc_html__( 'Numbered Carousel', 'hendon-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds Numbered Carousel holder', 'hendon-core' ) );
			$this->set_category( esc_html__( 'Hendon Core', 'hendon-core' ) );

			$this->set_option( array(
				'field_type' => 'repeater',
				'name'       => 'children',
				'title'      => esc_html__( 'Child elements', 'hendon-core' ),
				'items'   => array(
                    array(
                        'field_type'    => 'select',
                        'name'          => 'media_type',
                        'title'         => esc_html__( 'Media Type', 'hendon-core' ),
                        'options'       => [
                            'image' => esc_html__( 'Image', 'hendon-core' ),
                            'video' => esc_html__( 'Video', 'hendon-core' )
                        ],
                        'default_value' => ''
                    ),
                    array(
                        'field_type' => 'image',
                        'name'       => 'image',
                        'title'      => esc_html__( 'Image', 'hendon-core' ),
                        'dependency' => array(
                            'show' => array(
                                'media_type' => array(
                                    'values'        => 'image',
                                    'default_value' => ''
                                )
                            )
                        ),
                    ),
                    array(
                        'field_type'    => 'text',
                        'name'          => 'video_url',
                        'title'         => esc_html__( 'Video Url', 'hendon-core' ),
                        'dependency' => array(
                            'show' => array(
                                'media_type' => array(
                                    'values'        => 'video',
                                    'default_value' => ''
                                )
                            )
                        ),
                    ),
                    array(
                        'field_type' => 'text',
                        'name'       => 'title',
                        'title'      => esc_html__( 'Title', 'hendon-core' )
                    ),
                    array(
                        'field_type' => 'text',
                        'name'       => 'text',
                        'title'      => esc_html__( 'Text', 'hendon-core' )
                    ),
                    array(
                        'field_type' => 'text',
                        'name'       => 'link',
                        'title'      => esc_html__( 'Link', 'hendon-core' )
                    ),
                    array(
                        'field_type'    => 'select',
                        'name'          => 'target',
                        'title'         => esc_html__( 'Link target', 'hendon-core' ),
                        'options'       => hendon_core_get_select_type_options_pool('link_target'),
                        'default_value' => ''
                    )
				)
			) );

            $this->set_option( array(
                'field_type' => 'select',
                'name'       => 'change_slides_on_scroll',
                'title'      => esc_html__( 'Change Slides On Scroll', 'hendon-core' ),
                'options'    => hendon_core_get_select_type_options_pool('yes_no'),
                'default_value' => 'yes'
            ) );

			$this->map_extra_options();
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['items']          = $this->parse_repeater_items( $atts['children'] );
			$atts['this_shortcode'] = $this;
			
			return hendon_core_get_template_part( 'shortcodes/numbered-carousel', 'templates/numbered-carousel', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-numbered-carousel';
			$holder_classes[] = ! empty( $atts['change_slides_on_scroll'] ) && $atts['change_slides_on_scroll'] === 'yes' ? 'qodef-change-on-scroll' : '';
			
			return implode( ' ', $holder_classes );
		}

		public function get_image_styles( $atts ) {
			$styles = array();
			
			if ( ! empty( $atts['item_image'] ) ) {
				$styles[] = 'background-image: url(' . esc_url( wp_get_attachment_url( $atts['item_image'] ) ) . ')';
			}
			
			return $styles;
		}
	}
}