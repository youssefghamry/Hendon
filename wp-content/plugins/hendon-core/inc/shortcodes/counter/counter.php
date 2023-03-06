<?php

if ( ! function_exists( 'hendon_core_add_counter_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function hendon_core_add_counter_shortcode( $shortcodes ) {
		$shortcodes[] = 'HendonCoreCounterShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'hendon_core_filter_register_shortcodes', 'hendon_core_add_counter_shortcode' );
}

if ( class_exists( 'HendonCoreShortcode' ) ) {
	class HendonCoreCounterShortcode extends HendonCoreShortcode {
		
		public function __construct() {
			$this->set_layouts( apply_filters( 'hendon_core_filter_counter_layouts', array() ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( HENDON_CORE_SHORTCODES_URL_PATH . '/counter' );
			$this->set_base( 'hendon_core_counter' );
			$this->set_name( esc_html__( 'Counter', 'hendon-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays counter with provided parameters', 'hendon-core' ) );
			$this->set_category( esc_html__( 'Hendon Core', 'hendon-core' ) );

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
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'hendon-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'start_digit',
				'title'      => esc_html__( 'Start Digit', 'hendon-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'end_digit',
				'title'      => esc_html__( 'End Digit', 'hendon-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'step_digit',
				'title'      => esc_html__( 'Step Between Digits', 'hendon-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'step_delay',
				'title'      => esc_html__( 'Step Delay', 'hendon-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'digit_label',
				'title'      => esc_html__( 'Digit Label', 'hendon-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'digit_font_size',
				'title'      => esc_html__( 'Digit Font Size', 'hendon-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'digit_color',
				'title'      => esc_html__( 'Digit Color', 'hendon-core' )
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
				'default_value' => 'h6',
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
		}
		
		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'hendon_core_counter', $params );
			$html = str_replace( "\n", '', $html );
			
			return $html;
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['data_attrs']     = $this->get_data_attrs( $atts );
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['digit_styles']   = $this->get_digit_styles( $atts );
			$atts['title_styles']   = $this->get_title_styles( $atts );
			$atts['text_styles']    = $this->get_text_styles( $atts );

			return hendon_core_get_template_part( 'shortcodes/counter', 'variations/'.$atts['layout'].'/templates/counter', '', $atts );
		}
		
		private function get_data_attrs( $atts ) {
			$data = array();
			
			if ( ! empty( $atts['start_digit'] ) ) {
				$data['data-start-digit'] = $atts['start_digit'];
			}
			
			if ( ! empty( $atts['end_digit'] ) ) {
				$data['data-end-digit'] = $atts['end_digit'];
			}
			
			if ( ! empty( $atts['step_digit'] ) ) {
				$data['data-step-digit'] = $atts['step_digit'];
			}
			
			if ( ! empty( $atts['step_delay'] ) ) {
				$data['data-step-delay'] = $atts['step_delay'];
			}
			
			if ( ! empty( $atts['digit_label'] ) ) {
				$data['data-digit-label'] = $atts['digit_label'];
			}
			
			return $data;
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-counter';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			
			return implode( ' ', $holder_classes );
		}
		
		private function get_digit_styles( $atts ) {
			$styles = array();
			
			if ( $atts['digit_font_size'] !== '' ) {
				if ( qode_framework_string_ends_with_typography_units( $atts['digit_font_size'] ) ) {
					$styles[] = 'font-size: ' . $atts['digit_font_size'];
				} else {
					$styles[] = 'font-size: ' . intval( $atts['digit_font_size'] ) . 'px';
				}
			}
			
			if ( ! empty( $atts['digit_color'] ) ) {
				$styles[] = 'color: ' . $atts['digit_color'];
			}
			
			return $styles;
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
	}
}