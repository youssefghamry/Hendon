<?php

class MinimalHeader extends HendonCoreHeader {
	private static $instance;

	public function __construct() {
		$this->set_slug( 'minimal' );
		$this->search_layout         = 'fullscreen';
		$this->default_header_height = 100;

		add_action( 'hendon_action_before_wrapper_close_tag', array( $this, 'fullscreen_menu_template' ) );

		parent::__construct();
	}
	
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		
		return self::$instance;
	}

    public function enqueue_additional_assets() {
    }

	function fullscreen_menu_template() {
		$parameters = array(
			'fullscreen_menu_in_grid' => hendon_core_get_post_value_through_levels( 'qodef_fullscreen_menu_in_grid' ) === 'yes'
		);

		hendon_core_template_part( 'fullscreen-menu', 'templates/full-screen-menu', '', $parameters );
	}
}