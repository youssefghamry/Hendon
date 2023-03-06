<?php

if ( ! function_exists( 'hendon_core_add_icon_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function hendon_core_add_icon_widget( $widgets ) {
		$widgets[] = 'HendonCoreIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'hendon_core_filter_register_widgets', 'hendon_core_add_icon_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class HendonCoreIconWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options( array(
				'shortcode_base' => 'hendon_core_icon'
			) );
			if( $widget_mapped ) {
				$this->set_base( 'hendon_core_icon' );
				$this->set_name( esc_html__( 'Hendon Icon', 'hendon-core' ) );
				$this->set_description( esc_html__( 'Add a icon element into widget areas', 'hendon-core' ) );
			}
		}
		
		public function render( $atts ) {
			
			$params = $this->generate_string_params( $atts );
			
			echo do_shortcode( "[hendon_core_icon $params]" ); // XSS OK
		}
	}
}
