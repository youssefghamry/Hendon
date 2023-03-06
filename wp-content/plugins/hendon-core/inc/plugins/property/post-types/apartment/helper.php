<?php

if( ! function_exists('hendon_core_add_apartments_category_page_to_property_menu') ) {
    /**
     * Function that adds Apartment Category submenu item as submenu of Property
     */
    function hendon_core_add_apartments_category_page_to_property_menu() {
        add_submenu_page('edit.php?post_type=property-item', esc_html__('Apartment Category', 'hendon-core'), esc_html__('Apartment Categories', 'hendon-core'), 'manage_categories', 'edit-tags.php?taxonomy=apartment-category');
    }

    add_action('admin_menu', 'hendon_core_add_apartments_category_page_to_property_menu');
}

if ( ! function_exists( 'hendon_core_include_apartment_shortcodes' ) ) {
	/**
	 * Function that includes shortcodes
	 */
	function hendon_core_include_apartment_shortcodes() {
		foreach ( glob( HENDON_CORE_PLUGINS_PATH . '/property/post-types/apartment/shortcodes/*/include.php' ) as $shortcode ) {
			include_once $shortcode;
		}
	}

	add_action( 'qode_framework_action_before_shortcodes_register', 'hendon_core_include_apartment_shortcodes' );
}

if ( ! function_exists( 'hendon_core_include_apartment_widgets' ) ) {
	/**
	 * Function that includes widgets
	 */
	function hendon_core_include_apartment_widgets() {
		foreach ( glob( HENDON_CORE_PLUGINS_PATH . '/property/post-types/apartment/widgets/*/include.php' ) as $widget ) {
			include_once $widget;
		}
	}

	add_action( 'qode_framework_action_before_widgets_register', 'hendon_core_include_apartment_widgets' );
}

if ( ! function_exists( 'hendon_core_set_apartment_single_page_inner_class' ) ) {
	/**
	 * Function that return classes for the page inner div from header.php
	 *
	 * @param string $classes
	 *
	 * @return string
	 */
	function hendon_core_set_apartment_single_page_inner_class( $classes ) {
	    if( is_singular('apartment-item') ) {
            $apartment_template = hendon_core_get_post_value_through_levels('qodef_apartment_single_item_layout');

            if (isset($apartment_template) && $apartment_template == 'full-width-custom') {
                $classes = 'qodef-content-full-width';
            }
        }

		return $classes;
	}

	add_filter( 'hendon_filter_page_inner_classes', 'hendon_core_set_apartment_single_page_inner_class' );
}

if ( ! function_exists( 'hendon_core_is_apartment_title_enabled' ) ) {
	/**
	 * Function that check is module enabled
	 *
	 * @param bool $is_enabled
	 *
	 * @return bool
	 */
	function hendon_core_is_apartment_title_enabled( $is_enabled ) {

		if ( is_singular( 'apartment-item' ) ) {
			$apartment_title = hendon_core_get_post_value_through_levels( 'qodef_show_title_area_apartment_single' );
			$is_enabled     = $apartment_title == '' ? $is_enabled : ( $apartment_title == 'no' ? false : true );
		}

		return $is_enabled;
	}

	add_filter( 'hendon_core_filter_is_page_title_enabled', 'hendon_core_is_apartment_title_enabled' );
}