<?php

if ( ! function_exists( 'hendon_core_include_role_custom_fields' ) ) {
	/**
	 * Function that includes role custom fields files
	 */
	function hendon_core_include_role_custom_fields() {
		foreach ( glob( HENDON_CORE_INC_PATH . '/roles/*/role-fields.php' ) as $role_fields ) {
			include_once $role_fields;
		}
	}
	
	add_action( 'qode_framework_action_custom_user_fields', 'hendon_core_include_role_custom_fields' );
}

if ( ! function_exists( 'hendon_core_register_role_custom_fields' ) ) {
	/**
	 * Function that registers role custom fields files
	 */
	function hendon_core_register_role_custom_fields() {
		do_action( 'hendon_core_action_register_role_custom_fields' );
	}
	
	add_action( 'qode_framework_action_custom_user_fields', 'hendon_core_register_role_custom_fields', 11 );
}