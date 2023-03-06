<?php

if ( ! function_exists( 'hendon_core_add_tabs_child_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function hendon_core_add_tabs_child_shortcode( $shortcodes ) {
		$shortcodes[] = 'HendonCoreTabsChildShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'hendon_core_filter_register_shortcodes', 'hendon_core_add_tabs_child_shortcode' );
}

if ( class_exists( 'HendonCoreShortcode' ) ) {
	class HendonCoreTabsChildShortcode extends HendonCoreShortcode {
		
		public function map_shortcode() {
			$this->set_shortcode_path( HENDON_CORE_SHORTCODES_URL_PATH . '/tabs' );
			$this->set_base( 'hendon_core_tabs_child' );
			$this->set_name( esc_html__( 'Tabs Child', 'hendon-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds tab child to tabs holder', 'hendon-core' ) );
			$this->set_category( esc_html__( 'Hendon Core', 'hendon-core' ) );
			$this->set_is_child_shortcode( true );
			$this->set_parent_elements( array(
				'hendon_core_tabs'
			) );
			$this->set_is_parent_shortcode( true );

            $elementor_sections = array();
            $elementor_templates = array();
            if ( qode_framework_is_installed( 'elementor' ) ) {
                $elementor_sections = hendon_core_generate_elementor_templates_control( $this );
                $elementor_templates = hendon_core_return_elementor_templates();
            }

			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'tab_title',
				'title'      => esc_html__( 'Title', 'hendon-core' ),
			) );
			$this->set_option( array(
				'field_type'    => 'text',
				'name'          => 'layout',
				'title'         => esc_html__( 'Layout', 'hendon-core' ),
				'default_value' => '',
				'visibility'    => array('map_for_page_builder' => false)
			) );

			if ( !empty( $elementor_templates ) ) {
                $this->set_option( $elementor_sections );
            }
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['tab_title'] = $atts['tab_title'] . '-' . wp_unique_id();
			$atts['content']   = $content;

			return hendon_core_get_template_part( 'shortcodes/tabs', 'variations/'.$atts['layout'].'/templates/child', '', $atts );
		}
	}
}