<?php

if ( ! function_exists( 'hendon_core_add_separator_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function hendon_core_add_separator_widget( $widgets ) {
		$widgets[] = 'HendonCoreSeparatorWidget';
		
		return $widgets;
	}
	
	add_filter( 'hendon_core_filter_register_widgets', 'hendon_core_add_separator_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class HendonCoreSeparatorWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options( array(
				'shortcode_base' => 'hendon_core_separator'
			) );
			if( $widget_mapped ) {
				$this->set_base( 'hendon_core_separator' );
				$this->set_name( esc_html__( 'Hendon Separator', 'hendon-core' ) );
				$this->set_description( esc_html__( 'Add a separator element into widget areas', 'hendon-core' ) );
			}
		}
		
		public function render( $atts ) {
			$params = $this->generate_string_params( $atts );
			
			echo do_shortcode( "[hendon_core_separator $params]" ); // XSS OK
		}
	}
}