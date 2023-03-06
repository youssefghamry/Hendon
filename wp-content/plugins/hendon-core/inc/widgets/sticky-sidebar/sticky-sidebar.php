<?php

if ( ! function_exists( 'hendon_core_add_sticky_sidebar_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function hendon_core_add_sticky_sidebar_widget( $widgets ) {
		$widgets[] = 'HendonCoreStickySidebarWidget';
		
		return $widgets;
	}
	
	add_filter( 'hendon_core_filter_register_widgets', 'hendon_core_add_sticky_sidebar_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class HendonCoreStickySidebarWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$this->set_base( 'hendon_core_sticky_sidebar' );
			$this->set_name( esc_html__( 'Hendon Sticky Sidebar', 'hendon-core' ) );
			$this->set_description( esc_html__( 'Use this widget to make the sidebar sticky. Drag it into the sidebar above the widget which you want to be the first element in the sticky sidebar', 'hendon-core' ) );
		}
		
		public function render( $atts ) {
		}
	}
}
