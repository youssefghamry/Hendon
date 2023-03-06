<?php

if ( ! function_exists( 'hendon_core_add_simple_list_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function hendon_core_add_simple_list_shortcode( $shortcodes ) {
		$shortcodes[] = 'HendonCoreSimpleListShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'hendon_core_filter_register_shortcodes', 'hendon_core_add_simple_list_shortcode' );
}

if ( class_exists( 'HendonCoreShortcode' ) ) {
	class HendonCoreSimpleListShortcode extends HendonCoreShortcode {
		
		public function map_shortcode() {
			$this->set_shortcode_path( HENDON_CORE_SHORTCODES_URL_PATH . '/simple-list' );
			$this->set_base( 'hendon_core_simple_list' );
			$this->set_name( esc_html__( 'Simple List', 'hendon-core' ) );
			$this->set_category( esc_html__( 'Hendon Core', 'hendon-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'hendon-core' ),
			) );
			$this->set_option( array(
				'field_type'    => 'color',
				'name'          => 'label_color',
				'title'         => esc_html__( 'Label Color', 'hendon-core' ),
			) );
            $this->set_option( array(
                'field_type' => 'text',
                'name'       => 'label_font_size',
                'title'      => esc_html__( 'Label Font Size', 'hendon-core' )
            ) );
            $this->set_option( array(
                'field_type'    => 'color',
                'name'          => 'text_color',
                'title'         => esc_html__( 'Text Color', 'hendon-core' ),
            ) );
            $this->set_option( array(
                'field_type' => 'text',
                'name'       => 'text_font_size',
                'title'      => esc_html__( 'Text Font Size', 'hendon-core' )
            ) );
			$this->set_option( array(
				'field_type' => 'repeater',
				'name'       => 'children',
				'title'      => esc_html__( 'List Items', 'hendon-core' ),
				'items'   => array(
					array(
						'field_type'    => 'text',
						'name'          => 'label',
						'title'         => esc_html__( 'Label', 'hendon-core' )
					),
                    array(
						'field_type'    => 'text',
						'name'          => 'text',
						'title'         => esc_html__( 'Text', 'hendon-core' )
					)
				)
			) );
			$this->map_extra_options();
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
            $atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['items']          = $this->parse_repeater_items( $atts['children'] );
			$atts['text_styles']    = $this->get_text_styles( $atts );
			$atts['label_styles']   = $this->get_label_styles( $atts );

			return hendon_core_get_template_part( 'shortcodes/simple-list', 'templates/simple-list', '', $atts );
		}

        private function get_holder_classes( $atts ) {
            $holder_classes = $this->init_holder_classes();

            $holder_classes[] = 'qodef-simple-list';

            return implode( ' ', $holder_classes );
        }

        public function get_text_styles( $atts ) {
            $styles = array();

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

        public function get_label_styles( $atts ) {
            $styles = array();

            if ( ! empty( $atts['label_color'] ) ) {
                $styles[] = 'color: ' . $atts['label_color'];
            }

            if ( !empty($atts['label_font_size']) && $atts['label_font_size'] !== '' ) {
                if ( qode_framework_string_ends_with_typography_units( $atts['label_font_size'] ) ) {
                    $styles[] = 'font-size: ' . $atts['label_font_size'];
                } else {
                    $styles[] = 'font-size: ' . intval( $atts['label_font_size'] ) . 'px';
                }
            }

            return $styles;
        }
	}
}