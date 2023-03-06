<?php

if ( ! function_exists( 'hendon_core_add_property_info_table_shortcode' ) ) {
    /**
     * Function that isadding shortcode into shortcodes list for registration
     *
     * @param array $shortcodes - Array of registered shortcodes
     *
     * @return array
     */
    function hendon_core_add_property_info_table_shortcode( $shortcodes ) {
        $shortcodes[] = 'HendonCorePropertyInfoTableShortcode';

        return $shortcodes;
    }

    add_filter( 'hendon_core_filter_register_shortcodes', 'hendon_core_add_property_info_table_shortcode' );
}

class HendonCorePropertyInfoTableShortcode extends HendonCoreShortcode {

    public function map_shortcode() {
        $this->set_shortcode_path( HENDON_CORE_PLUGINS_URL_PATH . '/property/post-types/property/shortcodes/property-info-table' );
        $this->set_base( 'hendon_core_property_info_table' );
        $this->set_name( esc_html__( 'Property Info Table', 'hendon-core' ) );
        $this->set_description( esc_html__( 'Shortcode that shows table view of property info', 'hendon-core' ) );
        $this->set_category( esc_html__( 'Hendon Core', 'hendon-core' ) );
        $this->set_option( array(
            'field_type'    => 'select',
            'name'          => 'title_tag',
            'title'         => esc_html__( 'Table Header Title Tag', 'hendon-core' ),
            'options'       => hendon_core_get_select_type_options_pool('title_tag', false),
            'default_value' => 'h5'
        ));

        for ($i = 1; $i <= 7; $i++){
            $this->set_option( array(
                'field_type'    => 'text',
                'name'          => 'title_' . $i,
                'title'         => esc_html__( 'Title ' . $i, 'hendon-core' )
            ));
        }

        $this->set_option( array(
            'field_type' => 'repeater',
            'name'       => 'children',
            'title'      => esc_html__( 'Table Rows', 'hendon-core' ),
            'items'      => $this->map_row_options()
        ) );

        $this->map_extra_options();
    }

    private function map_row_options(){
        $options = array();

        for($i = 1; $i <= 7; $i++){
            $options[] = array(
                'field_type' => 'select',
                'name'       => 'text_' . $i . '_type',
                'title'      => esc_html__( 'Field ' . $i . ' Type', 'hendon-core' ),
                'options'    => array(
                    'number' => esc_html__('Number', 'hendon-core'),
                    'text'   => esc_html__('Text', 'hendon-core'),
                    'button' => esc_html__('Button', 'hendon-core'),
                ),
                'default_value'    => 'number'
            );

            $options[] = array(
                'field_type' => 'text',
                'name'       => 'text_' . $i,
                'title'      => esc_html__( 'Text ' . $i, 'hendon-core' ),
                'dependency'    => array(
                    'show' => array(
                        'text_' . $i . '_type' => array(
                            'values'        => array( 'number', 'text'),
                            'default_value' => 'number'
                        )
                    )
                )
            );

            $options[] = array(
                'field_type' => 'text',
                'name'       => 'button_text_' . $i,
                'title'      => esc_html__( 'Button Text ' . $i, 'hendon-core' ),
                'dependency'    => array(
                    'show' => array(
                        'text_' . $i . '_type' => array(
                            'values'        => 'button',
                            'default_value' => 'number'
                        )
                    )
                )
            );

            $options[] = array(
                'field_type' => 'text',
                'name'       => 'button_' . $i . '_link',
                'title'      => esc_html__( 'Button ' . $i . ' Link', 'hendon-core' ),
                'dependency'    => array(
                    'show' => array(
                        'text_' . $i . '_type' => array(
                            'values'        => 'button',
                            'default_value' => 'number'
                        )
                    )
                )
            );
        }

        return $options;
    }

    public function render( $options, $content = null ) {
        parent::render( $options );
        $atts = $this->get_atts();

        $atts['holder_classes'] = $this->get_holder_classes( $atts );
        $atts['items']          = $this->parse_repeater_items( $atts['children'] );
        $atts['params']         = $atts;

        return hendon_core_get_template_part( 'plugins/property/post-types/property/shortcodes/property-info-table', 'templates/property-info-table', '', $atts );
    }

    private function get_holder_classes( $atts ) {
        $holder_classes = $this->init_holder_classes();

        $holder_classes[] = 'qodef-property-info-table';

        return implode( ' ', $holder_classes );
    }

}