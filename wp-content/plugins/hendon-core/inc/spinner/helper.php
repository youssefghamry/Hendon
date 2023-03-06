<?php

if ( ! function_exists( 'hendon_core_is_page_spinner_enabled' ) ) {
	/**
	 * Function that check is option enabled
	 *
	 * @return bool
	 */
	function hendon_core_is_page_spinner_enabled() {
		return hendon_core_get_post_value_through_levels( 'qodef_enable_page_spinner' ) === 'yes';
	}
}

if ( ! function_exists( 'hendon_core_load_page_spinner' ) ) {
	/**
	 * Loads Spinners HTML
	 */
	function hendon_core_load_page_spinner() {
		
		if ( hendon_core_is_page_spinner_enabled() ) {
			$parameters = array();
			
			hendon_core_template_part( 'spinner', 'templates/spinner', '', $parameters );
		}
	}
	
	add_action( 'hendon_action_after_body_tag_open', 'hendon_core_load_page_spinner' );
}

if ( ! function_exists( 'hendon_core_get_spinners_type' ) ) {
	/**
	 * Function that return module layout template content
	 *
	 * @return string that contains html content
	 */
	function hendon_core_get_spinners_type() {
		$html = '';
		$type = hendon_core_get_post_value_through_levels( 'qodef_page_spinner_type' );
		
		if ( ! empty( $type ) ) {
			$html = hendon_core_get_template_part( 'spinner', 'layouts/' . $type . '/templates/' . $type );
		}
		
		echo wp_kses_post( $html );
	}
}

if ( ! function_exists( 'hendon_core_set_page_spinner_classes' ) ) {
	/**
	 * Function that return classes for page spinner area
	 *
	 * @param array $classes
	 *
	 * @return array
	 */
	function hendon_core_set_page_spinner_classes( $classes ) {
		$type = hendon_core_get_post_value_through_levels( 'qodef_page_spinner_type' );
		
		if ( ! empty( $type ) ) {
			$classes[] = 'qodef-layout--' . esc_attr( $type );
		}
		
		return $classes;
	}
	
	add_filter( 'hendon_core_filter_page_spinner_classes', 'hendon_core_set_page_spinner_classes' );
}

if ( ! function_exists( 'hendon_core_set_page_spinner_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function hendon_core_set_page_spinner_styles( $style ) {
		$spinner_styles = array();
		
		$spinner_background_color = hendon_core_get_post_value_through_levels( 'qodef_page_spinner_background_color' );
		$spinner_color            = hendon_core_get_post_value_through_levels( 'qodef_page_spinner_color' );
		
		if ( ! empty( $spinner_background_color ) ) {
			$spinner_styles['background-color'] = $spinner_background_color;
		}
		
		if ( ! empty( $spinner_color ) ) {
			$spinner_styles['color'] = $spinner_color;
		}
		
		if ( ! empty( $spinner_styles ) ) {
			$style .= qode_framework_dynamic_style( '#qodef-page-spinner .qodef-m-inner', $spinner_styles );
		}
		
		return $style;
	}
	
	add_filter( 'hendon_filter_add_inline_style', 'hendon_core_set_page_spinner_styles' );
}