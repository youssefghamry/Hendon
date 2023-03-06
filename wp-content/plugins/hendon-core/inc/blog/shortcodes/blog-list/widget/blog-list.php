<?php

if ( ! function_exists( 'hendon_core_add_blog_list_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function hendon_core_add_blog_list_widget( $widgets ) {
		$widgets[] = 'HendonCoreBlogListWidget';
		
		return $widgets;
	}
	
	add_filter( 'hendon_core_filter_register_widgets', 'hendon_core_add_blog_list_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class HendonCoreBlogListWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'widget_title',
					'title'      => esc_html__( 'Title', 'hendon-core' )
				)
			);
			$widget_mapped = $this->import_shortcode_options( array(
				'shortcode_base' => 'hendon_core_blog_list'
			) );
			
			if ( $widget_mapped ) {
				$this->set_base( 'hendon_core_blog_list' );
				$this->set_name( esc_html__( 'Hendon Blog List', 'hendon-core' ) );
				$this->set_description( esc_html__( 'Display a list of blog posts', 'hendon-core' ) );
			}
		}
		
		public function render( $atts ) {
			$params = $this->generate_string_params( $atts );
			
			echo do_shortcode( "[hendon_core_blog_list $params]" ); // XSS OK
		}
	}
}
