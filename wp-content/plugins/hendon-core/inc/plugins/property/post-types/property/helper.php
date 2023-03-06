<?php

if ( ! function_exists( 'hendon_core_include_property_shortcodes' ) ) {
	/**
	 * Function that includes shortcodes
	 */
	function hendon_core_include_property_shortcodes() {
		foreach ( glob( HENDON_CORE_PLUGINS_PATH . '/property/post-types/property/shortcodes/*/include.php' ) as $shortcode ) {
			include_once $shortcode;
		}
	}
	
	add_action( 'qode_framework_action_before_shortcodes_register', 'hendon_core_include_property_shortcodes' );
}

if ( ! function_exists( 'hendon_core_include_property_widgets' ) ) {
	/**
	 * Function that includes widgets
	 */
	function hendon_core_include_property_widgets() {
		foreach ( glob( HENDON_CORE_PLUGINS_PATH . '/property/post-types/property/widgets/*/include.php' ) as $widget ) {
			include_once $widget;
		}
	}
	
	add_action( 'qode_framework_action_before_widgets_register', 'hendon_core_include_property_widgets' );
}

if ( ! function_exists( 'hendon_core_set_property_single_page_inner_class' ) ) {
	/**
	 * Function that return classes for the page inner div from header.php
	 *
	 * @param string $classes
	 *
	 * @return string
	 */
	function hendon_core_set_property_single_page_inner_class( $classes ) {
	    if( is_singular('property-item') ) {
            $property_template = hendon_core_get_post_value_through_levels('qodef_property_single_item_layout');

            if (isset($property_template) && $property_template == 'full-width-custom') {
                $classes = 'qodef-content-full-width';
            }
        }
		
		return $classes;
	}
	
	add_filter( 'hendon_filter_page_inner_classes', 'hendon_core_set_property_single_page_inner_class' );
}

if ( ! function_exists( 'hendon_core_is_property_title_enabled' ) ) {
	/**
	 * Function that check is module enabled
	 *
	 * @param bool $is_enabled
	 *
	 * @return bool
	 */
	function hendon_core_is_property_title_enabled( $is_enabled ) {
		
		if ( is_singular( 'property-item' ) ) {
			$property_title = hendon_core_get_post_value_through_levels( 'qodef_show_title_area_property_single' );
			$is_enabled     = $property_title == '' ? $is_enabled : ( $property_title == 'no' ? false : true );
		}
		
		return $is_enabled;
	}
	
	add_filter( 'hendon_core_filter_is_page_title_enabled', 'hendon_core_is_property_title_enabled' );
}

if ( ! function_exists( 'hendon_core_generate_property_archive_with_shortcode' ) ) {
	/**
	 * Function that executes portfolio list shortcode with params on archive pages
	 *
	 * @param string $tax - type of taxonomy
	 * @param string $tax_slug - slug of taxonomy
	 *
	 */
	function hendon_core_generate_property_archive_with_shortcode( $tax = '', $tax_slug = '' ) {
		
		$number_of_items        = 12;
		$number_of_items_option = hendon_core_get_post_value_through_levels( 'qodef_property_archive_number_of_items' );
		if ( ! empty( $number_of_items_option ) ) {
			$number_of_items = $number_of_items_option;
		}
		
		$number_of_columns        = 4;
		$number_of_columns_option = hendon_core_get_post_value_through_levels( 'qodef_property_archive_number_of_columns' );
		if ( ! empty( $number_of_columns_option ) ) {
			$number_of_columns = $number_of_columns_option;
		}
		
		$space_between_items        = 'normal';
		$space_between_items_option = hendon_core_get_post_value_through_levels( 'qodef_property_archive_space_between_items' );
		if ( ! empty( $space_between_items_option ) ) {
			$space_between_items = $space_between_items_option;
		}
		
		$image_size        = 'landscape';
		$image_size_option = hendon_core_get_post_value_through_levels( 'qodef_property_archive_image_size' );
		if ( ! empty( $image_size_option ) ) {
			$image_size = $image_size_option;
		}
		
		$item_layout        = 'info-below';
		$item_layout_option = hendon_core_get_post_value_through_levels( 'qodef_property_archive_item_layout' );
		if ( ! empty( $item_layout_option ) ) {
			$item_layout = $item_layout_option;
		}
		
		$params = array(
			'posts_per_page'    => $number_of_items,
			'columns'           => $number_of_columns,
			'space'             => $space_between_items,
			'layout'            => $item_layout,
			'images_proportion' => $image_size,
			'pagination_type'   => 'load-more',
			'additional_params' => 'tax',
			'tax'               => $tax,
			'tax_slug'          => $tax_slug,
		);
		
		echo HendonCorePropertyListShortcode::call_shortcode( $params );
	}
}

if( ! function_exists('hendon_core_get_property_items_list') ){
    function hendon_core_get_property_items_list(){
        $property_items_array = array(
            '0' => esc_html__('Select Property', 'hendon-core')
        );

        $query_array = array(
            'post_type'     => 'property-item',
            'post_status'   => 'publish',
            'numberposts'   => -1
        );

        $property_items = get_posts( $query_array );

        if( is_array( $property_items ) && count( $property_items ) > 0 ){
            foreach ($property_items as $property_item){
                $property_items_array[$property_item->ID] = $property_item->post_title;
            }
        }

        return $property_items_array;
    }
}

if ( !function_exists('hendon_core_remove_filter_for_anonymous_class')) {
    function hendon_core_remove_filter_for_anonymous_class( $hook_name = '', $class_name = '', $method_name = '', $priority = 0 ) {
        global $wp_filter;

        // Take only filters on right hook name and priority
        if ( ! isset( $wp_filter[ $hook_name ][ $priority ] ) || ! is_array( $wp_filter[ $hook_name ][ $priority ] ) ) {
            return false;
        }

        foreach ( (array) $wp_filter[ $hook_name ][ $priority ] as $unique_id => $filter_array ) {
            if ( isset( $filter_array['function'] ) && is_array( $filter_array['function'] ) ) {
                if ( is_object( $filter_array['function'][0] ) && get_class( $filter_array['function'][0] ) && get_class( $filter_array['function'][0] ) == $class_name && $filter_array['function'][1] == $method_name ) {

                    if ( is_a( $wp_filter[ $hook_name ], 'WP_Hook' ) ) {
                        unset( $wp_filter[ $hook_name ]->callbacks[ $priority ][ $unique_id ] );

                    } else {
                        unset( $wp_filter[ $hook_name ][ $priority ][ $unique_id ] );
                    }
                }
            }

        }

        return false;
    }
}