<?php

if ( ! function_exists( 'hendon_core_add_property_advanced_info_shortcode' ) ) {
    /**
     * Function that isadding shortcode into shortcodes list for registration
     *
     * @param array $shortcodes - Array of registered shortcodes
     *
     * @return array
     */
    function hendon_core_add_property_advanced_info_shortcode( $shortcodes ) {
        $shortcodes[] = 'HendonCorePropertyAdvancedInfoShortcode';

        return $shortcodes;
    }

    add_filter( 'hendon_core_filter_register_shortcodes', 'hendon_core_add_property_advanced_info_shortcode' );
}

class HendonCorePropertyAdvancedInfoShortcode extends HendonCoreShortcode {

    public function map_shortcode() {
        $this->set_shortcode_path( HENDON_CORE_PLUGINS_URL_PATH . '/property/post-types/property/shortcodes/property-advanced-info' );
        $this->set_base( 'hendon_core_property_advanced_info' );
        $this->set_name( esc_html__( 'Property Advanced Info', 'hendon-core' ) );
        $this->set_description( esc_html__( 'Shortcode that shows property advanced info', 'hendon-core' ) );
        $this->set_category( esc_html__( 'Hendon Core', 'hendon-core' ) );
        $this->set_scripts(
            array(
                'jquery-ui-tabs' => array(
                    'registered'	=> true
                )
            )
        );
        $this->set_option( array(
            'field_type'    => 'select',
            'name'          => 'selected_projects',
            'title'         => esc_html__( 'Show Project with Listed ID', 'hendon-core' ),
            'description'   => esc_html__( 'If you don\'t specify the id of the property, the shortcode will automatically get the id of the current page ', 'hendon-core' ),
            'options'       => hendon_core_get_property_items_list(),
            'default_value' => '0'
        ) );
        $this->set_option( array(
            'field_type'    => 'select',
            'name'          => 'image_proportions',
            'title'         => esc_html__( 'Image Proportions', 'hendon-core' ),
            'description'   => esc_html__( 'Set image proportions for your property features.', 'hendon-core' ),
            'options'       => hendon_core_get_select_type_options_pool('list_image_dimension', false, array('custom') ),
            'default_value' => 'full'
        ) );

        $this->map_extra_options();
    }

    public function render( $options, $content = null ) {
        parent::render( $options );

        $atts = $this->get_atts();

        $atts['id'] = ! empty( $atts['selected_projects'] ) ? $atts['selected_projects'] : get_the_ID();
        $atts['holder_classes'] = $this->get_holder_classes( $atts );
        $atts['this_object'] = $this;
        $query_array = $this->getQueryArray( $atts );
        $query_results = new \WP_Query( $query_array );
        $atts['query_results'] = $query_results;
        $atts['atts'] = $atts;
        $atts['apartments'] = $this->getAssociatedApartments( $atts['id'] );

        return hendon_core_get_template_part( 'plugins/property/post-types/property/shortcodes/property-advanced-info', 'templates/property-advanced-info', '', $atts );
    }

    public function init_holder_classes() {
        $holder_classes = array();

        $holder_classes[] = 'qodef-shortcode';
        $holder_classes[] = 'qodef-m';

        $holder_classes = apply_filters( 'qode_framework_filter_shortcode_holder_classes', $holder_classes );

        return $holder_classes;
    }

    private function get_holder_classes( $atts ) {
        $holder_classes = $this->init_holder_classes();

        $holder_classes[] = 'qodef-property-advanced-info';

        return implode( ' ', $holder_classes );
    }

    public function getQueryArray( $atts ) {
        $query_array = array(
            'post_status'    => 'publish',
            'post_type'      => 'property-item',
            'paged'          => 1,
            'post__in'       => explode( ',', $atts['id'] )
        );

        return $query_array;
    }

    public function getAssociatedApartments($id = ''){
        $property_id = ! empty( $id ) ? $id : get_the_ID();

        $property_array = get_posts(
            array(
                'post_type' => 'apartment-item',
                'posts_per_page' => '-1',
                'post_status' => 'publish',
                'meta_query' => array(
                    array(
                        'key'     => 'qodef_apartment_property',
                        'value'   => $property_id,
                        'compare' => '=',
                    ),
                ),
            )
        );

        return $property_array;
    }

}