<?php

class HendonCoreElementorTwitterList extends HendonCoreElementorWidgetBase {
	
	function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'hendon_core_twitter_list' );
		
		parent::__construct( $data, $args );
	}
}

if ( qode_framework_is_installed( 'twitter' ) ) {
	hendon_core_get_elementor_widgets_manager()->register_widget_type( new HendonCoreElementorTwitterList() );
}