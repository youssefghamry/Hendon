<?php

if ( ! function_exists( 'hendon_core_add_property_hierarchical_info_shortcode' ) ) {
    /**
     * Function that isadding shortcode into shortcodes list for registration
     *
     * @param array $shortcodes - Array of registered shortcodes
     *
     * @return array
     */
    function hendon_core_add_property_hierarchical_info_shortcode( $shortcodes ) {
        $shortcodes[] = 'HendonCorePropertyHierarchicalInfoShortcode';

        return $shortcodes;
    }

    add_filter( 'hendon_core_filter_register_shortcodes', 'hendon_core_add_property_hierarchical_info_shortcode' );
}

class HendonCorePropertyHierarchicalInfoShortcode extends HendonCoreShortcode {

    public function __construct() {
        parent::__construct();
    }

    public function map_shortcode() {
        $this->set_shortcode_path( HENDON_CORE_PLUGINS_URL_PATH . '/property/post-types/property/shortcodes/property-hierarchical-info' );
        $this->set_base( 'hendon_core_property_hierarchical_info' );
        $this->set_name( esc_html__( 'Property Hierarchical Info', 'hendon-core' ) );
        $this->set_description( esc_html__( 'Shortcode that shows property hierarchical info', 'hendon-core' ) );
        $this->set_category( esc_html__( 'Hendon Core', 'hendon-core' ) );
        $this->set_option( array(
            'field_type'    => 'select',
            'name'          => 'selected_projects',
            'title'         => esc_html__( 'Choose Project', 'hendon-core' ),
            'description'   => esc_html__( 'If you don\'t choose the property, the shortcode will automatically get the id of the current page', 'hendon-core' ),
            'options'       => hendon_core_get_property_items_list(),
            'default_value' => '0'
        ) );
        $this->set_option( array(
            'field_type'    => 'select',
            'name'          => 'categories_title_tag',
            'title'         => esc_html__( 'Categories Title Tag', 'hendon-core' ),
            'options'       => hendon_core_get_select_type_options_pool('title_tag', false ),
            'default_value' => 'h2'
        ) );
        $this->set_option( array(
            'field_type'    => 'select',
            'name'          => 'image_dimension',
            'title'         => esc_html__( 'Image Proportions', 'hendon-core' ),
            'description'   => esc_html__( 'Set image proportions for your property info images', 'hendon-core' ),
            'options'       => hendon_core_get_select_type_options_pool('list_image_dimension', false, array('custom') ),
            'default_value' => 'full'
        ) );
        $this->set_option( array(
            'field_type'    => 'select',
            'name'          => 'columns_number',
            'title'         => esc_html__( 'Number of Columns', 'hendon-core' ),
            'description'   => esc_html__( 'Set number of columns for property features list', 'hendon-core' ),
            'options'       => hendon_core_get_select_type_options_pool('columns_number', false ),
            'default_value' => '3'
        ) );
        $this->set_option( array(
            'field_type'    => 'select',
            'name'          => 'items_space',
            'title'         => esc_html__( 'Space Between Items', 'hendon-core' ),
            'options'       => hendon_core_get_select_type_options_pool('items_space', false ),
            'default_value' => 'normal'
        ) );
        $this->set_option( array(
            'field_type'    => 'select',
            'name'          => 'title_tag',
            'title'         => esc_html__( 'Apartments Title Tag', 'hendon-core' ),
            'options'       => hendon_core_get_select_type_options_pool('title_tag', false ),
            'default_value' => 'h5'
        ) );
        $this->set_option( array(
            'field_type'    => 'select',
            'name'          => 'background_pattern',
            'title'         => esc_html__( 'Enable Background Pattern', 'hendon-core' ),
            'options'       => hendon_core_get_select_type_options_pool('yes_no', false ),
            'description'   => esc_html__('Pattern will be displayed on even rows', 'hendon-core'),
            'default_value' => 'yes'
        ) );


        $this->map_extra_options();
    }

    public function render( $options, $content = null ) {
        parent::render( $options );

        $atts = $this->get_atts();


        $atts['this_object'] = $this;
        $atts['id'] = ! empty( $atts['selected_projects'] ) ? $atts['selected_projects'] : get_the_ID();

        $query_array = $this->getQueryArray( $atts );
        $query_results = new \WP_Query( $query_array );
        $atts['query_results'] = $query_results;
        $atts['holder_classes'] = $this->getHolderClasses( $atts );
        $atts['grid_holder_classes'] = $this->getGridHolderClasses( $atts );
        $atts['tax_array'] = $this->getTaxonomyArray( $atts['id'] );
        $atts['params'] = $atts;

        return hendon_core_get_template_part( 'plugins/property/post-types/property/shortcodes/property-hierarchical-info/', 'templates/content', '', $atts );
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

    public function getHolderClasses( $atts ){
        $holder_classes = $this->init_holder_classes();

        $holder_classes[] = 'qodef-property-hierarchical-info-holder';
        $holder_classes[] = !empty($atts['background_pattern']) && $atts['background_pattern'] === 'yes' ? 'qodef-property-hierarchical-info-bg-pattern' : '';

        return implode( ' ', $holder_classes );
    }

    public function getGridHolderClasses( $atts ){
        $holder_classes = array(
            'qodef-grid',
            'qodef-layout--columns'
        );

        if( ! empty( $atts['columns_number'] ) ){
            $holder_classes[] = 'qodef-col-num--' . $atts['columns_number'];
        }

        if( ! empty( $atts['items_space'] ) ){
            $holder_classes[] = 'qodef-gutter--' . $atts['items_space'];
        }

        return implode(' ', $holder_classes);
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

    public function getTaxonomyArray($id = ''){
        $property_id = ! empty( $id ) ? $id : get_the_ID();

        $apartments = $this->getAssociatedApartments( $property_id );
        $tax_array = array();

        if ( is_array( $apartments ) && count( $apartments ) > 0 ) {
            foreach ($apartments as $apartment) {
                $tax = get_the_terms($apartment->ID, 'apartment-category')[0];
                $tax_array[$tax->term_id] = $tax->name;
            }
        }

        asort( $tax_array );

        return $tax_array;
    }

    public function getApartmentsByTaxonomyId( $tax_id ){
        $apartments_array = get_posts(
            array(
                'posts_per_page' => -1,
                'post_type' => 'apartment-item',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'apartment-category',
                        'field' => 'term_id',
                        'terms' => $tax_id,
                    )
                )
            )
        );

        return $apartments_array;
    }
}