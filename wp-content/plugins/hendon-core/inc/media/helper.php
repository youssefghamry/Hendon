<?php

if ( ! function_exists( 'hendon_core_include_image_sizes' ) ) {
	/**
	 * Function that includes icons
	 */
	function hendon_core_include_image_sizes() {
		foreach ( glob( HENDON_CORE_INC_PATH . '/media/*/include.php' ) as $image_size ) {
			include_once $image_size;
		}
	}
	
	add_action( 'qode_framework_action_before_images_register', 'hendon_core_include_image_sizes' );
}