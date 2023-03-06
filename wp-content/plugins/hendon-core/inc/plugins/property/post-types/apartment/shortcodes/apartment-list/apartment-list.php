<?php

if ( ! function_exists( 'hendon_core_add_apartment_list_shortcode' ) ) {
    /**
     * Function that isadding shortcode into shortcodes list for registration
     *
     * @param array $shortcodes - Array of registered shortcodes
     *
     * @return array
     */
    function hendon_core_add_apartment_list_shortcode( $shortcodes ) {
        $shortcodes[] = 'HendonCoreApartmentListShortcode';

        return $shortcodes;
    }

    add_filter( 'hendon_core_filter_register_shortcodes', 'hendon_core_add_apartment_list_shortcode' );
}

class HendonCoreApartmentListShortcode extends HendonCoreListShortcode {

    public function __construct() {
        $this->set_post_type( 'apartment-item' );
        $this->set_post_type_taxonomy( 'apartment-category' );
        $this->set_post_type_additional_taxonomies( array( 'apartment-category', 'apartment-tag' ) );
        $this->set_layouts( apply_filters( 'hendon_core_filter_apartment_list_layouts', array() ) );

        parent::__construct();
    }

    public function map_shortcode() {
        $this->set_shortcode_path( HENDON_CORE_PLUGINS_URL_PATH . '/property/post-types/apartment/shortcodes/apartment-list' );
        $this->set_base( 'hendon_core_apartment_list' );
        $this->set_name( esc_html__( 'Apartment List', 'hendon-core' ) );
        $this->set_description( esc_html__( 'Shortcode that shows list of apartment items', 'hendon-core' ) );
        $this->set_category( esc_html__( 'Hendon Core', 'hendon-core' ) );
        $this->map_layout_options( array(
            'layouts'          => $this->get_layouts()
        ) );
	    $this->set_option( array(
		    'field_type' => 'color',
		    'name'       => 'title_color',
		    'title'      => esc_html__( 'Title Color', 'hendon-core' ),
		    'group'      => esc_html__( 'Layout', 'hendon-core' )
	    ) );
	    $this->set_option( array(
		    'field_type' => 'color',
		    'name'       => 'excerpt_color',
		    'title'      => esc_html__( 'Excerpt Color', 'hendon-core' ),
		    'group'      => esc_html__( 'Layout', 'hendon-core' )
	    ) );
        $this->map_list_options(array(
            'exclude_behavior' => array( 'justified-gallery' ) ,
        ));
        $this->map_query_options( array( 'post_type' => $this->get_post_type() ) );
        $this->map_additional_options( array(
            'exclude_filter' => true
        ) );
        $this->map_extra_options();
    }

    public static function call_shortcode( $params ) {
        $html = qode_framework_call_shortcode( 'hendon_core_apartment_list', $params );
        $html = str_replace( "\n", '', $html );

        return $html;
    }

    public function render( $options, $content = null ) {
        parent::render( $options );

        $atts = $this->get_atts();

        $atts['post_type']       = $this->get_post_type();
	
	    // Additional query args
	    $atts['additional_query_args'] = $this->get_additional_query_args( $atts );

        $atts['query_array']    = hendon_core_get_query_params( $atts );
        $atts['holder_classes'] = $this->get_holder_classes( $atts );
        $atts['slider_attr']    = $this->get_slider_data( $atts );
        $atts['item_classes']   = $this->get_item_classes( $atts );
        $atts['query_result']   = new \WP_Query( $atts['query_array'] );
        $atts['posts_count']    = $atts['query_result']->post_count;
        $atts['data_attr']      = hendon_core_get_pagination_data( HENDON_CORE_REL_PATH, 'plugins/property/post-types/apartment/shortcodes', 'apartment-list', 'apartment-item', $atts );
        $atts['unique'] = rand(1000, 9999);

        $temp = json_decode($atts['slider_attr']);
        $temp->outsideNavigation = 'yes';
        $temp->unique = $atts['unique'];
        $atts['slider_attr'] = json_encode($temp);

        $atts['this_shortcode'] = $this;

        return hendon_core_get_template_part( 'plugins/property/post-types/apartment/shortcodes/apartment-list', 'templates/content', $atts['behavior'], $atts );
    }

    private function get_holder_classes( $atts ) {
        $holder_classes = $this->init_holder_classes();

        $holder_classes[] = 'qodef-apartment-list';
        $holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-item-layout--' . $atts['layout'] : '';

        $list_classes            = $this->get_list_classes( $atts );
        $hover_animation_classes = $this->get_hover_animation_classes( $atts );
        $holder_classes          = array_merge( $holder_classes, $list_classes, $hover_animation_classes );

        return implode( ' ', $holder_classes );
    }

    public function get_item_classes( $atts ) {
        $item_classes = $this->init_item_classes();

        $list_item_classes = $this->get_list_item_classes( $atts );

        $item_classes = array_merge( $item_classes, $list_item_classes );

        return implode( ' ', $item_classes );
    }

    public function get_title_styles( $atts ) {
        $styles = array();

        if ( ! empty( $atts['text_transform'] ) ) {
            $styles[] = 'text-transform: ' . $atts['text_transform'];
        }
	
	    if ( ! empty( $atts['title_color'] ) ) {
		    $styles[] = 'color: ' . $atts['title_color'];
	    }

        return $styles;
    }
	
	public function get_excerpt_styles( $atts ) {
		$styles = array();
		
		if ( ! empty( $atts['excerpt_color'] ) ) {
			$styles[] = 'color: ' . $atts['excerpt_color'];
		}
		
		return $styles;
	}

}