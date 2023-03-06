<?php

class HendonCoreElementorSocialShare extends HendonCoreElementorWidgetBase {
	
	function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'hendon_core_social_share' );
		
		parent::__construct( $data, $args );
	}
}

hendon_core_get_elementor_widgets_manager()->register_widget_type( new HendonCoreElementorSocialShare() );