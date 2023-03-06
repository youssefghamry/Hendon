<?php

if ( ! function_exists( 'hendon_core_add_property_info_shortcode' ) ) {
    /**
     * Function that isadding shortcode into shortcodes list for registration
     *
     * @param array $shortcodes - Array of registered shortcodes
     *
     * @return array
     */
    function hendon_core_add_property_info_shortcode( $shortcodes ) {
        $shortcodes[] = 'HendonCorePropertyInfoShortcode';

        return $shortcodes;
    }

    add_filter( 'hendon_core_filter_register_shortcodes', 'hendon_core_add_property_info_shortcode' );
}

class HendonCorePropertyInfoShortcode extends HendonCoreShortcode {

    public function __construct() {
        $this->set_layouts( apply_filters( 'hendon_core_filter_property_info_layouts', array() ) );

        parent::__construct();
    }

    public function map_shortcode() {
        $this->set_shortcode_path( HENDON_CORE_PLUGINS_URL_PATH . '/property/post-types/property/shortcodes/property-info' );
        $this->set_base( 'hendon_core_property_info' );
        $this->set_name( esc_html__( 'Property Info', 'hendon-core' ) );
        $this->set_description( esc_html__( 'Shortcode that shows property info', 'hendon-core' ) );
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
            'field_type' => 'select',
            'name'       => 'layout',
            'title'      => esc_html__( 'Layout', 'hendon-core' ),
            'options'    => $this->get_layouts(),
            'default_value' => 'simple'
        ));
        $this->set_option( array(
            'field_type' => 'select',
            'name'       => 'title_tag',
            'title'      => esc_html__( 'Property Title Tag', 'hendon-core' ),
            'options'    => hendon_core_get_select_type_options_pool('title_tag', false),
            'default_value' => 'h4',
            'dependency'    => array(
                'show' => array(
                    'layout' => array(
                        'values'        => 'advanced',
                        'default_value' => 'simple'
                    )
                )
            )
        ));
        $this->set_option( array(
            'field_type' => 'select',
            'name'       => 'features_title_tag',
            'title'      => esc_html__( 'Property Features Title Tag', 'hendon-core' ),
            'options'    => hendon_core_get_select_type_options_pool('title_tag', false),
            'default_value' => 'h6'
        ));
        $this->set_option( array(
            'field_type'    => 'select',
            'name'          => 'image_proportions',
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
        $atts['feature_items'] = $this->getFeatureContents( $atts );
        $atts['holder_classes'] = $this->getHolderClasses( $atts );
        $atts['grid_holder_classes'] = $this->getGridHolderClasses( $atts );
        $atts['params'] = $atts;

        return hendon_core_get_template_part( 'plugins/property/post-types/property/shortcodes/property-info/', 'templates/content', '', $atts );
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

    public function getFeatureContents( $params ) {
        $features = get_post_meta($params['id'], 'qodef_property_feature_repeater', true);
        $features_contents = array();
        $counter = 0;

        if( is_array( $features ) && count( $features ) > 0 ){
            foreach ( $features as $feature ) {
                if( ! empty( $feature['qodef_property_feature_image'] ) ){
                    $features_contents[$counter]['image'] = $feature['qodef_property_feature_image'];
                } else{
                    $features_contents[$counter]['image'] = '';
                }

                if( ! empty( $feature['qodef_property_feature_title'] ) ){
                    $features_contents[$counter]['title'] = $feature['qodef_property_feature_title'];
                } else{
                    $features_contents[$counter]['title'] = '';
                }

                $counter++;
            }
        }

        return $features_contents;
    }

    public function getHolderClasses( $atts ){
        $holder_classes = $this->init_holder_classes();

        $holder_classes[] = 'qodef-property-info-holder';

        if( ! empty( $atts['layout'] ) ){
            $holder_classes[] = 'qodef-pi--' . $atts['layout'];
        }

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

}