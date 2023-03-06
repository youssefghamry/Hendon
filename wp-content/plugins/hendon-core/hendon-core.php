<?php
/*
Plugin Name: Hendon Core
Plugin URI: https://qodeinteractive.com
Description: Plugin that adds portfolio post type, shortcodes and other modules
Author: Qode Interactive
Author URI: https://qodeinteractive.com
Version: 1.1.2
*/
if ( ! class_exists( 'HendonCore' ) ) {
	class HendonCore {
		private static $instance;
		
		function __construct() {
			$this->require_core();
			
			add_filter( 'qode_framework_filter_register_admin_options', array( $this, 'create_core_options' ) );
			
			add_action( 'qode_framework_action_before_options_init_' . HENDON_CORE_OPTIONS_NAME, array( $this, 'init_core_options' ) );
			
			add_action( 'qode_framework_action_populate_meta_box', array( $this, 'init_core_meta_boxes' ) );
			
			// Include plugin assets
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
			
			// Make plugin available for translation
			add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ), 15 ); // permission 15 is set in order to be after the qode-framework initialization
			
			// Add plugin's body classes
			add_filter( 'body_class', array( $this, 'add_body_classes' ) );
			
			// Hook to include additional modules when plugin loaded
			do_action( 'hendon_core_action_plugin_loaded' );
		}
		
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}
			
			return self::$instance;
		}
		
		function require_core() {
			require_once 'constants.php';
			require_once HENDON_CORE_ABS_PATH . '/helpers/helper.php';
			
			// Hook to include additional files before modules inclusion
			do_action( 'hendon_core_action_before_include_modules' );

			foreach ( glob( HENDON_CORE_INC_PATH . '/*/include.php' ) as $module ) {
				include_once $module;
			}
			
			// Hook to include additional files after modules inclusion
			do_action( 'hendon_core_action_after_include_modules' );
		}
		
		function create_core_options( $options ) {
			$hendon_core_options_admin = new QodeFrameworkOptionsAdmin(
				HENDON_CORE_MENU_NAME,
				HENDON_CORE_OPTIONS_NAME,
				array(
					'label' => esc_html__( 'Hendon Core Options', 'hendon-core' ),
					'code'  => HendonCoreDashboard::get_instance()->get_code(),
				)
			);
			$options[] = $hendon_core_options_admin;
			
			return $options;
		}
		
		function init_core_options() {
			$qode_framework = qode_framework_get_framework_root();
			
			if ( ! empty( $qode_framework ) ) {
				$page = $qode_framework->add_options_page(
					array(
						'scope'       => HENDON_CORE_OPTIONS_NAME,
						'type'        => 'admin',
						'slug'        => 'general',
						'title'       => esc_html__( 'General', 'hendon-core' ),
						'description' => esc_html__( 'Global Theme Options', 'hendon-core' ),
						'icon'        => 'fa fa-cog'
					)
				);
				
				// Hook to include additional options after default options
				do_action( 'hendon_core_action_default_options_init', $page );
			}
		}
		
		function init_core_meta_boxes() {
			do_action( 'hendon_core_action_default_meta_boxes_init' );
		}
		
		function enqueue_assets() {
			// CSS and JS dependency variables
			$style_dependency_array  = apply_filters( 'hendon_core_filter_style_dependencies', array( 'hendon-main' ) );
			$script_dependency_array = apply_filters( 'hendon_core_filter_script_dependencies', array( 'hendon-main-js' ) );
			
			// Hook to include additional scripts before plugin's main style
			do_action( 'hendon_core_action_before_main_css' );
			
			// Enqueue plugin's main style
			wp_enqueue_style( 'hendon-core-style', HENDON_CORE_URL_PATH . 'assets/css/hendon-core.min.css', $style_dependency_array );
			
			// Enqueue plugin's 3rd party scripts
			wp_enqueue_script( 'jquery-ui-core' );
			wp_enqueue_script( 'jquery-easing-1.3', HENDON_CORE_URL_PATH . 'assets/plugins/jquery/jquery.easing.1.3.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'modernizr', HENDON_CORE_URL_PATH . 'assets/plugins/modernizr/modernizr.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'tweenmax', HENDON_CORE_URL_PATH . 'assets/plugins/tweenmax/tweenmax.min.js', array( 'jquery' ), false, true );

			// Hook to include additional scripts before plugin's main script
			do_action( 'hendon_core_action_before_main_js' );
			
			// Enqueue plugin's main script
			wp_enqueue_script( 'hendon-core-script', HENDON_CORE_URL_PATH . 'assets/js/hendon-core.min.js', $script_dependency_array, false, true );
		}
		
		function load_plugin_textdomain() {
			load_plugin_textdomain( 'hendon-core', false, HENDON_CORE_REL_PATH . '/languages' );
		}
		
		function add_body_classes( $classes ) {
			$classes[] = 'hendon-core-' . HENDON_CORE_VERSION;
			
			return $classes;
		}
	}
}

if ( ! function_exists( 'hendon_core_instantiate_plugin' ) ) {
	/**
	 * Function that initialize plugin
	 */
	function hendon_core_instantiate_plugin() {
		HendonCore::get_instance();
	}
	
	add_action( 'qode_framework_action_load_dependent_plugins', 'hendon_core_instantiate_plugin' );
}

if ( ! function_exists( 'hendon_core_activation_trigger' ) ) {
	/**
	 * Function that trigger hooks on plugin activation
	 */
	function hendon_core_activation_trigger() {
		// Set global plugin option when plugin is activated
		add_option( 'hendon_core_activated_first_time', 'yes' );
		
		// Hook to add additional code on plugin activation
		do_action( 'hendon_core_action_on_activation' );
	}
	
	register_activation_hook( __FILE__, 'hendon_core_activation_trigger' );
}

if ( ! function_exists( 'hendon_core_deactivation_trigger' ) ) {
	/**
	 * Function that trigger hooks on plugin deactivation
	 */
	function hendon_core_deactivation_trigger() {
		// Remove global plugin option during deactivation
		delete_option( 'hendon_core_activated_first_time' );
		
		// Hook to add additional code on plugin deactivation
		do_action( 'hendon_core_action_on_deactivation' );
	}
	
	register_deactivation_hook( __FILE__, 'hendon_core_deactivation_trigger' );
}

if ( ! function_exists( 'hendon_core_plugins_loaded_option' ) ) {
	/**
	 * Function that update global option that plugin is activated first time
	 */
	function hendon_core_plugins_loaded_option() {
		if ( get_option( 'hendon_core_activated_first_time' ) === 'yes' ) {
			update_option( 'hendon_core_activated_first_time', 'no' );
		}
	}
	
	add_action( 'plugins_loaded', 'hendon_core_plugins_loaded_option', 1000 ); //needs to be last, so option can be changed after all actions
}

if ( ! function_exists( 'hendon_core_check_requirements' ) ) {
	/**
	 * Function that check plugin requirements
	 */
	function hendon_core_check_requirements() {
		if ( ! defined( 'QODE_FRAMEWORK_VERSION' ) ) {
			add_action( 'admin_notices', 'hendon_core_admin_notice_content' );
		}
	}
	
	add_action( 'plugins_loaded', 'hendon_core_check_requirements' );
}

if ( ! function_exists( 'hendon_core_admin_notice_content' ) ) {
	/**
	 * Function that display the error message if the requirements are not met
	 */
	function hendon_core_admin_notice_content() {
		echo sprintf( '<div class="notice notice-error"><p>%s</p></div>', esc_html__( 'Qode Framework plugin is required for Hendon Core plugin to work properly. Please install/activate it first.', 'hendon-core' ) );
		
		if ( function_exists( 'deactivate_plugins' ) ) {
			deactivate_plugins( plugin_basename( __FILE__ ) );
		}
	}
}