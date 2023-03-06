<?php

if ( ! function_exists( 'hendon_core_add_sticky_header_option' ) ) {
	/**
	 * This function set header scrolling appearance value for global header option map
	 */
	function hendon_core_add_sticky_header_option( $options ) {
		$options['sticky'] = esc_html__( 'Sticky', 'hendon-core' );
		
		return $options;
	}
	
	add_filter( 'hendon_core_filter_header_scroll_appearance_option', 'hendon_core_add_sticky_header_option' );
}

if ( ! function_exists( 'hendon_core_sticky_header_global_js_var' ) ) {
	/**
	 * Function that extend global js variables
	 *
	 * @param array $global_variables
	 *
	 * @return array
	 */
	function hendon_core_sticky_header_global_js_var( $global_variables ) {
		$header_scroll_appearance = hendon_core_get_post_value_through_levels( 'qodef_header_scroll_appearance' );
		
		if ( $header_scroll_appearance == 'sticky' ) {
			$sticky_scroll_amount_meta = hendon_core_get_post_value_through_levels( 'qodef_sticky_header_scroll_amount' );
			$sticky_scroll_amount      = $sticky_scroll_amount_meta !== '' ? intval( $sticky_scroll_amount_meta ) : 0;
			
			$global_variables['qodefStickyHeaderScrollAmount'] = $sticky_scroll_amount;
		}
		
		return $global_variables;
	}
	
	add_filter( 'hendon_filter_localize_main_js', 'hendon_core_sticky_header_global_js_var' );
}

if ( ! function_exists( 'hendon_core_register_sticky_header_areas' ) ) {
	/**
	 * Function that registers widget area for sticky header
	 */
	function hendon_core_register_sticky_header_areas() {
		register_sidebar(
			array(
				'id'            => 'qodef-sticky-header-widget-area-one',
				'name'          => esc_html__( 'Sticky Header - Area One', 'hendon-core' ),
				'description'   => esc_html__( 'Widgets added here will appear in sticky header widget area', 'hendon-core' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s qodef-sticky-right">',
				'after_widget'  => '</div>'
			)
		);
	}
	
	add_action( 'hendon_core_action_additional_header_widgets_area', 'hendon_core_register_sticky_header_areas' );
}

if ( ! function_exists( 'hendon_core_set_sticky_header_widget_area' ) ) {
	/**
	 * This function add additional header widgets area into global list
	 *
	 * @param array $widget_area_map
	 *
	 * @return array
	 */
	function hendon_core_set_sticky_header_widget_area( $widget_area_map ) {
		
		if ( $widget_area_map['header_layout'] === 'sticky' ) {
			$widget_area_map['default_widget_area'] = 'qodef-sticky-header-widget-area-one';
			$widget_area_map['custom_widget_area']  = get_post_meta( $widget_area_map['page_id'], 'qodef_sticky_header_custom_widget_area_one', true );
		}
		
		return $widget_area_map;
	}
	
	add_filter( 'hendon_core_filter_header_widget_area', 'hendon_core_set_sticky_header_widget_area' );
}

if ( ! function_exists( 'hendon_core_set_sticky_header_logo_image' ) ) {
	/**
	 * This function set header logo image for current scroll appearance type
	 */
	function hendon_core_set_sticky_header_logo_image( $template, $parameters ) {
		$is_enabled = false;
		
		$logo_image_id = hendon_core_get_post_value_through_levels( 'qodef_logo_sticky' );
		
		if ( ! empty( $logo_image_id ) && isset( $parameters['sticky_logo'] ) && ! empty( $parameters['sticky_logo'] ) ) {
			$logo_image_attr = array(
				'class'    => 'qodef-header-logo-image qodef--sticky',
				'itemprop' => 'image',
				'alt'      => esc_attr__( 'logo sticky', 'hendon-core' )
			);
			
			$image      = wp_get_attachment_image( $logo_image_id, 'full', false, $logo_image_attr );
			$image_html = ! empty( $image ) ? $image : qode_framework_get_image_html_from_src( $logo_image_id, $logo_image_attr );
			
			$parameters['logo_sticky_image'] = $image_html;
			
			$is_enabled = true;
		}
		
		if ( $is_enabled ) {
			return hendon_core_get_template_part( 'header/scroll-appearance/sticky/templates', 'logo-sticky', '', $parameters );
		} else {
			return $template;
		}
	}
	
	add_filter( 'hendon_core_filter_get_header_logo_image', 'hendon_core_set_sticky_header_logo_image', 10, 2 );
}

if ( ! function_exists( 'hendon_core_set_sticky_header_area_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function hendon_core_set_sticky_header_area_styles( $style ) {
		$styles = array();
		
		$background_color = hendon_core_get_post_value_through_levels( 'qodef_sticky_header_background_color' );
		
		if ( ! empty( $background_color ) ) {
			$styles['background-color'] = $background_color;
		}

        if ( ! empty( $styles ) ) {
            $style .= qode_framework_dynamic_style( '.qodef-header-sticky', $styles );
        }

        $inner_styles = array();

        $side_padding = hendon_core_get_post_value_through_levels( 'qodef_sticky_header_side_padding' );
		
		if ( ! empty( $side_padding ) ) {
			if ( qode_framework_string_ends_with_space_units( $side_padding ) ) {
				$inner_styles['padding-left']  = $side_padding;
				$inner_styles['padding-right'] = $side_padding;
			} else {
				$inner_styles['padding-left']  = intval( $side_padding ) . 'px';
				$inner_styles['padding-right'] = intval( $side_padding ) . 'px';
			}
		}
		
		if ( ! empty( $inner_styles ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-header-sticky .qodef-header-sticky-inner', $inner_styles );
		}
		
		return $style;
	}
	
	add_filter( 'hendon_filter_add_inline_style', 'hendon_core_set_sticky_header_area_styles' );
}