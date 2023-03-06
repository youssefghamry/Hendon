<?php

if ( ! function_exists( 'hendon_core_add_testimonials_list_shortcode' ) ) {
	/**
	 * Function that is adding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function hendon_core_add_testimonials_list_shortcode( $shortcodes ) {
		$shortcodes[] = 'HendonCoreTestimonialsListShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'hendon_core_filter_register_shortcodes', 'hendon_core_add_testimonials_list_shortcode' );
}

if ( class_exists( 'HendonCoreListShortcode' ) ) {
	class HendonCoreTestimonialsListShortcode extends HendonCoreListShortcode {
		
		public function __construct() {
			$this->set_post_type( 'testimonials' );
			$this->set_post_type_additional_taxonomies( array( 'testimonials-category' ) );
			$this->set_layouts( apply_filters( 'hendon_core_filter_testimonials_list_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'hendon_core_filter_testimonials_list_extra_options', array() ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( HENDON_CORE_CPT_URL_PATH . '/testimonials/shortcodes/testimonials-list' );
			$this->set_base( 'hendon_core_testimonials_list' );
			$this->set_name( esc_html__( 'Testimonials List', 'hendon-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays list of testimonials', 'hendon-core' ) );
			$this->set_category( esc_html__( 'Hendon Core', 'hendon-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'hendon-core' )
			) );
			$this->map_list_options( array(
				'exclude_behavior' => array( 'masonry', 'justified-gallery' ),
				'exclude_option'   => array( 'images_proportion' )
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'skin',
				'title'      => esc_html__( 'Skin', 'hendon-core' ),
				'options'    => array(
					''      => esc_html__( 'Default', 'hendon-core' ),
					'light' => esc_html__( 'Light', 'hendon-core' )
				),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title_font_size',
				'title'      => esc_html__( 'Title Font Size', 'hendon-core' ),
				'group'      => esc_html__( 'Layout', 'hendon-core' )
			) );
			$this->map_query_options( array( 'post_type' => $this->get_post_type() ) );
			$this->map_layout_options( array( 'layouts' => $this->get_layouts() ) );
			$this->map_extra_options();
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			
			$atts = $this->get_atts();
			
			$atts['post_type'] = $this->get_post_type();
			
			// Additional query args
			$atts['additional_query_args'] = $this->get_additional_query_args( $atts );
			
			$atts['unique'] = wp_unique_id();
			
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['item_classes']   = $this->get_item_classes( $atts );
			$atts['slider_attr']    = $this->get_slider_data( $atts, array( 'unique' => $atts['unique'], 'outsideNavigation' => 'yes' ) );
			$atts['query_result']   = new \WP_Query( hendon_core_get_query_params( $atts ) );
			
			$atts['this_shortcode'] = $this;
			
			return hendon_core_get_template_part( 'post-types/testimonials/shortcodes/testimonials-list', 'templates/content', $atts['behavior'], $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-testimonials-list';
			$holder_classes[] = isset( $atts['skin'] ) && ! empty( $atts['skin'] ) ? 'qodef-skin--' . $atts['skin'] : '';
			
			$list_classes   = $this->get_list_classes( $atts );
			$holder_classes = array_merge( $holder_classes, $list_classes );
			
			return implode( ' ', $holder_classes );
		}
		
		private function get_item_classes( $atts ) {
			$item_classes = $this->init_item_classes();
			
			$list_item_classes = $this->get_list_item_classes( $atts );
			
			$item_classes = array_merge( $item_classes, $list_item_classes );
			
			return implode( ' ', $item_classes );
		}
		
		public function get_title_styles( $atts ) {
			$styles = array();
			
			if ( ! empty( $atts['text_transform'] ) ) {
				$styles[] = 'text-transform: ' . $atts['text_transform'];
			}
			
			if ( !empty($atts['title_font_size']) && $atts['title_font_size'] !== '' ) {
				if ( qode_framework_string_ends_with_typography_units( $atts['title_font_size'] ) ) {
					$styles[] = 'font-size: ' . $atts['title_font_size'];
				} else {
					$styles[] = 'font-size: ' . intval( $atts['title_font_size'] ) . 'px';
				}
			}
			
			return $styles;
		}
	}
}