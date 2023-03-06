<?php

if ( ! function_exists( 'hendon_core_get_list_shortcode_item_image' ) ) {
	/**
	 * Function that generates thumbnail img tag for list shortcodes
	 *
	 * @param string $image_dimension
	 * @param int $attachment_id
	 * @param int $custom_image_width
	 * @param int $custom_image_height
	 *
	 * @return string generated img tag
	 *
	 * @see qode_framework_generate_thumbnail()
	 */
	function hendon_core_get_list_shortcode_item_image( $image_dimension, $attachment_id = 0, $custom_image_width = 0, $custom_image_height = 0 ) {
		$item_id = get_the_ID();
		
		if ( $image_dimension !== 'custom' ) {
			if ( ! empty( $attachment_id ) ) {
				$html = wp_get_attachment_image( $attachment_id, $image_dimension );
			} else {
				$html = get_the_post_thumbnail( $item_id, $image_dimension );
			}
		} else {
			if ( ! empty( $custom_image_width ) && ! empty( $custom_image_height ) ) {
				if ( ! empty( $attachment_id ) ) {
					$html = qode_framework_generate_thumbnail( intval( $attachment_id ), $custom_image_width, $custom_image_height );
				} else {
					$html = qode_framework_generate_thumbnail( intval( get_post_thumbnail_id( $item_id ) ), $custom_image_width, $custom_image_height );
				}
			} else {
				$html = get_the_post_thumbnail( $item_id, $image_dimension );
			}
		}
		
		return apply_filters( 'hendon_core_filter_list_shortcode_item_image', $html, $attachment_id );
	}
}

if ( ! function_exists( 'hendon_core_get_list_shortcode_item_image_url' ) ) {
	/**
	 * Function that return thumbnail img url for list shortcodes
	 *
	 * @param string $image_dimension
	 * @param int $attachment_id
	 *
	 * @return string
	 */
	function hendon_core_get_list_shortcode_item_image_url( $image_dimension, $attachment_id = 0 ) {
		
		if ( ! empty ( $attachment_id ) ) {
			$image = wp_get_attachment_image_src( intval( $attachment_id ), $image_dimension );
			$url   = $image[0];
		} else {
			$url = get_the_post_thumbnail_url( get_the_ID(), $image_dimension );
		}
		
		return $url;
	}
}

//function that returns all Elementor saved templates
if( ! function_exists('hendon_core_return_elementor_templates') ){
    function hendon_core_return_elementor_templates(){
        if ( qode_framework_is_installed( 'elementor' ) ) {
            return Elementor\Plugin::instance()->templates_manager->get_source( 'local' )->get_items();
        }
    }
}

//function that adds Template Elementor Control
if( ! function_exists('hendon_core_generate_elementor_templates_control') ){
    function hendon_core_generate_elementor_templates_control( $object, $control_name = 'template_id' ){
        $templates = hendon_core_return_elementor_templates();

        if ( ! empty( $templates ) ) {
            $options = [
                '0' => '— ' . esc_html__('Select', 'hendon-core') . ' —',
            ];

            $types = [];

            foreach ($templates as $template) {
                $options[$template['template_id']] = $template['title'] . ' (' . $template['type'] . ')';
                $types[$template['template_id']] = $template['type'];
            }

            return array (
                'field_type'    => 'select',
                'name'          => 'predefined_elementor_template',
                'title'         => esc_html__( 'Choose Template', 'hendon-core' ),
                'description'   => esc_html__( 'Please note that "Content" section below has higher priority over this option, so it will show only if "Content" is empty', 'hendon-core' ),
                'options'		=> $options,
                'default_value' => '0',
            );
        };
    }
}