<?php

if ( ! function_exists( 'hendon_core_add_cards_gallery_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function hendon_core_add_cards_gallery_shortcode( $shortcodes ) {
		$shortcodes[] = 'HendonCoreCardsGalleryShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'hendon_core_filter_register_shortcodes', 'hendon_core_add_cards_gallery_shortcode' );
}

if ( class_exists( 'HendonCoreShortcode' ) ) {
	class HendonCoreCardsGalleryShortcode extends HendonCoreShortcode {
		
		public function map_shortcode() {
			$this->set_shortcode_path( HENDON_CORE_SHORTCODES_URL_PATH . '/cards-gallery' );
			$this->set_base( 'hendon_core_cards_gallery' );
			$this->set_name( esc_html__( 'Cards Gallery', 'hendon-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds cards gallery holder', 'hendon-core' ) );
			$this->set_category( esc_html__( 'Hendon Core', 'hendon-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'hendon-core' ),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'link_target',
				'title'         => esc_html__( 'Link Target', 'hendon-core' ),
				'options'       => hendon_core_get_select_type_options_pool( 'link_target' ),
				'default_value' => '_self'
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'orientation',
				'title'         => esc_html__( 'Info Position', 'hendon-core' ),
				'options'       => array(
					''       => esc_html__( 'Default', 'hendon-core' ),
					'right'  => esc_html__( 'Shuffled Right', 'hendon-core' ),
					'left'   => esc_html__( 'Shuffled Left', 'hendon-core' )
				),
				'default_value' => 'right'
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'bundle_animation',
				'title'         => esc_html__( 'Bundle Animation', 'hendon-core' ),
				'options'       => hendon_core_get_select_type_options_pool( 'no_yes' ),
				'default_value' => 'no'
			) );
			$this->set_option( array(
				'field_type' => 'repeater',
				'name'       => 'children',
				'title'      => esc_html__( 'Image Items', 'hendon-core' ),
				'items'   => array(
					array(
						'field_type'    => 'text',
						'name'          => 'item_link',
						'title'         => esc_html__( 'Link', 'hendon-core' ),
						'default_value' => ''
					),
					array(
						'field_type' => 'image',
						'name'       => 'item_image',
						'title'      => esc_html__( 'Item Image', 'hendon-core' )
					),
				)
			) );
			$this->map_extra_options();
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['items']          = $this->parse_repeater_items( $atts['children'] );
			
			return hendon_core_get_template_part( 'shortcodes/cards-gallery', 'templates/cards-gallery', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-cards-gallery';
			$holder_classes[]  = ! empty( $atts['orientation'] ) ? 'qodef-orientation--' . $atts['orientation'] : 'qodef-orientation--right';
			$holder_classes[]  = isset( $atts['bundle_animation'] ) && $atts['bundle_animation'] === 'yes' ? 'qodef-animation--bundle' : 'qodef-animation--no';
			
			return implode( ' ', $holder_classes );
		}
	}
}