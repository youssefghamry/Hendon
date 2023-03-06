<?php

class DividedHeader extends HendonCoreHeader {
	private static $instance;

	public function __construct() {
		$this->set_slug( 'divided' );
		$this->search_layout         = 'covers-header';
		$this->default_header_height = 90;

		parent::__construct();
	}
	
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		
		return self::$instance;
	}
}