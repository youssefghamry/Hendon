<?php

if ( ! function_exists( 'hendon_core_add_performance_customizer_options' ) ) {
	/**
	 * Function that add customizer options for this module
	 */
	function hendon_core_add_performance_customizer_options() {
		$qode_framework = qode_framework_get_framework_root();
		
		$page = $qode_framework->add_options_page(
			array(
				'type' => 'customizer',
			)
		);
	
		if ( $page ) {
			
			$page->add_field_element(
				array(
					'field_type'  => 'panel',
					'name'        => 'hendon_core_performance_panel',
					'priority'    => 250,
					'title'       => esc_html__( 'Qode Performance', 'hendon-core' ),
				)
			);
			
			// Hook to include additional options after module options
			do_action( 'hendon_core_action_performance_customizer_options', $page );
		}
	}
	
	add_action( 'qode_framework_action_customizer_hendon_core_performance_panel', 'hendon_core_add_performance_customizer_options' );
}