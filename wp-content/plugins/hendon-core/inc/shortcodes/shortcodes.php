<?php

if ( ! class_exists( 'HendonCoreShortcodes' ) ) {
	class HendonCoreShortcodes {
		private static $instance;
		private $allowed_shortcodes = array();
		
		public function __construct() {
			// Include core files
			$this->init();
			
			// Set properties value
			$this->set_enabled_shortcodes();
			
			// Include shortcode abstract classes
			add_action( 'qode_framework_action_before_shortcodes_register', array( $this, 'include_shortcode_classes' ), 5 );
			
			// Include shortcodes
			add_action( 'qode_framework_action_before_shortcodes_register', array( $this, 'include_shortcodes' ) );
			
			// Register shortcodes
			add_action( 'qode_framework_action_before_shortcodes_register', array( $this, 'register_shortcodes' ), 11 ); // Priority 11 set because include of files is called on default action 10
			
			// Include shortcodes widget
			add_action( 'qode_framework_action_before_widgets_register', array( $this, 'include_shortcodes_widget' ) );
			
			// Include shortcodes media fields
			add_action( 'qode_framework_action_custom_media_fields', array( $this, 'include_shortcodes_media_fields' ) );
		}
		
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}
			
			return self::$instance;
		}
		
		public function get_allowed_shortcodes() {
			return $this->allowed_shortcodes;
		}
	
		public function set_allowed_shortcodes( $allowed_shortcodes ) {
			$this->allowed_shortcodes[] = $allowed_shortcodes;
		}
		
		function init() {
			// Include customizer options
			include_once HENDON_CORE_SHORTCODES_PATH . '/dashboard/customizer/shortcodes-customizer-options.php';
		}
		
		function set_enabled_shortcodes() {
			
			foreach ( glob( HENDON_CORE_SHORTCODES_PATH . '/*', GLOB_ONLYDIR ) as $shortcode ) {
				
				if ( basename( $shortcode ) !== 'dashboard' ) {
					$is_disabled = hendon_core_performance_get_option_value( $shortcode, 'hendon_core_performance_shortcode_' );
					
					if ( empty( $is_disabled ) ) {
						$this->set_allowed_shortcodes( $shortcode );
					}
				}
			}
		}

		function include_shortcode_classes() {
			include_once HENDON_CORE_SHORTCODES_PATH . '/shortcode.php';
			include_once HENDON_CORE_SHORTCODES_PATH . '/list-shortcode.php';
		}
		
		function include_shortcodes() {
			$shortcodes = $this->get_allowed_shortcodes();
			
			if ( ! empty( $shortcodes ) ) {
				foreach ( $shortcodes as $shortcode ) {
					foreach ( glob( $shortcode . '/include.php' ) as $shortcode ) {
						include_once $shortcode;
					}
				}
			}
		}
		
		function register_shortcodes() {
			$qode_framework = qode_framework_get_framework_root();
			$shortcodes     = apply_filters( 'hendon_core_filter_register_shortcodes', $shortcodes = array() );
			
			if ( ! empty( $shortcodes ) ) {
				foreach ( $shortcodes as $shortcode ) {
					$qode_framework->add_shortcode( new $shortcode() );
				}
			}
		}
		
		function include_shortcodes_widget() {
			$shortcodes = $this->get_allowed_shortcodes();
			
			if ( ! empty( $shortcodes ) ) {
				foreach ( $shortcodes as $shortcode ) {
					foreach ( glob( $shortcode . '/widget/include.php' ) as $widget ) {
						include_once $widget;
					}
				}
			}
		}
		
		function include_shortcodes_media_fields() {
			$shortcodes = $this->get_allowed_shortcodes();
			
			if ( ! empty( $shortcodes ) ) {
				foreach ( $shortcodes as $shortcode ) {
					foreach ( glob( $shortcode . '/media-custom-fields.php' ) as $media ) {
						include_once $media;
					}
				}
			}
		}
	}
	
	HendonCoreShortcodes::get_instance();
}