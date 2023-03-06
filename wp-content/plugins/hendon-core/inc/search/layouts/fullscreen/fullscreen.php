<?php
class FullscreenSearch extends HendonCoreSearch {
	private static $instance;

	public function __construct() {
		parent::__construct();
		add_action('hendon_action_page_footer_template', array($this, 'load_template'), 11); //after footer
	}
	
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		
		return self::$instance;
	}

	public function load_template() {

	    $header_widget_areas = get_post_meta( get_the_ID(), 'qodef_show_header_widget_areas', true );

		if(is_active_widget(false,false,'hendon_core_search_opener') && $header_widget_areas !== 'no') {
			hendon_core_template_part('search/layouts/' . $this->search_layout, 'templates/' . $this->search_layout);
		}
	}
}