<?php

class HendonCoreElementorSectionTitle extends HendonCoreElementorWidgetBase {
	
	function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'hendon_core_section_title' );
		
		parent::__construct( $data, $args );
	}
}

hendon_core_get_elementor_widgets_manager()->register_widget_type( new HendonCoreElementorSectionTitle() );