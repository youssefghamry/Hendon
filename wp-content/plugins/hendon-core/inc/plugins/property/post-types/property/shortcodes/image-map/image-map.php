<?php

if ( ! function_exists( 'hendon_core_add_image_map_shortcode' ) ) {
    /**
     * Function that isadding shortcode into shortcodes list for registration
     *
     * @param array $shortcodes - Array of registered shortcodes
     *
     * @return array
     */
    function hendon_core_add_image_map_shortcode( $shortcodes ) {
        $shortcodes[] = 'HendonCoreImageMapShortcode';

        return $shortcodes;
    }

    add_filter( 'hendon_core_filter_register_shortcodes', 'hendon_core_add_image_map_shortcode' );
}

class HendonCoreImageMapShortcode extends HendonCoreShortcode {

    public function __construct() {
        parent::__construct();
    }

    public function map_shortcode() {
        $this->set_shortcode_path( HENDON_CORE_PLUGINS_URL_PATH . '/property/post-types/property/shortcodes/image-map' );
        $this->set_base( 'hendon_core_image_map' );
        $this->set_name( esc_html__( 'Image Map', 'hendon-core' ) );
        $this->set_description( esc_html__( 'Shortcode that shows image map', 'hendon-core' ) );
        $this->set_category( esc_html__( 'Hendon Core', 'hendon-core' ) );

        $this->set_option( array(
            'field_type' => 'text',
            'name'       => 'custom_class',
            'title'      => esc_html__( 'Custom CSS Class', 'hendon-core' ),
            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'hendon-core' )
        ) );

        $this->set_option( array(
            'field_type' => 'select',
            'name'       => 'image_map',
            'options'    => $this->getIMPList(),
            'title'      => esc_html__( 'Image Map Name', 'hendon-core' ),
            'description' => esc_html__( 'Enter the name of the image map you have created.', 'hendon-core' )
        ) );

        $this->set_option( array(
            'field_type' => 'repeater',
            'name'       => 'children',
            'title'      => esc_html__( 'Child elements', 'hendon-core' ),
            'items'   => array(
                array(
                    'field_type'    => 'text',
                    'name'          => 'title',
                    'title'         => esc_html__( 'Title', 'hendon-core' ),
                    'default_value' => ''
                ),
                array(
                    'field_type' => 'text',
                    'name'       => 'subtitle',
                    'title'      => esc_html__( 'Subtitle', 'hendon-core' )
                ),
                array(
                    'field_type' => 'text',
                    'name'       => 'additional_info',
                    'title'      => esc_html__( 'Additional Info', 'hendon-core' ),
                )
            )
        ) );

        $this->map_extra_options();
    }
	
	public function render( $options, $content = null ) {
        parent::render( $options );

        $atts = $this->get_atts();

        $atts['items']          = $this->parse_repeater_items( $atts['children'] );
        $atts['holder_classes'] = $this->getHolderClasses( $atts );

        $atts['shapes'] = $this->getIMPShapes($atts['image_map']);

        if($atts['image_map'] != '') {
            $atts['image_map_name']             = $this->getIMPName($atts['image_map']);
            $atts['image_map_shortcode']        = $this->getIMPShortcode($atts['image_map']);
            $atts['image_map_shortcode_attr']   = $this->getIMPShortcodeDataAtts($atts['image_map']);
        }

        $atts['params'] = $atts;

        return hendon_core_get_template_part( 'plugins/property/post-types/property/shortcodes/image-map', 'templates/image-map', '', $atts );
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array(
		    'qodef-e',
            'qodef-image-map',
            'qodef-layout--template'
        );
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';

		return implode( ' ', $holderClasses );
	}

    public function getIMPInstance() {
        if (class_exists('ImageMapPro')) {
            $imp_instance = new \ImageMapPro();
            return $imp_instance;
        }

        return false;
    }

    public function getIMPList() {
        $imp_formatted = array();
        $instance = $this->getIMPInstance();

        if ( $instance ) {
            $options = get_option($instance->admin_options_name);
            $imp_items = $options['saves'];

            foreach ( $imp_items as $id => $save ) {
                $imp_formatted[$id] = $save['meta']['name'];

            }
        }

        return $imp_formatted;
    }

	private function getIMPName($imp_id) {
	    $name = '';
		$instance = $this->getIMPInstance();

		if ($instance) {
			$imp_instance   = $instance;
			$options        = get_option( $imp_instance->admin_options_name );
			$imp_items      = $options['saves'];
            if(array_key_exists($imp_id, $imp_items)){
                $imp_item       = $imp_items[$imp_id];
                $name           = $imp_item['meta']['name'];
            }
        }

        return $name;
    }

    private function getIMPShortcode($imp_id) {
        $shortcode = '';
        $instance = $this->getIMPInstance();
	
	    if ($instance) {
		    $imp_instance   = $instance;
		    $options        = get_option( $imp_instance->admin_options_name );
		    $imp_items      = $options['saves'];
            if(array_key_exists($imp_id, $imp_items)){
                $imp_item       = $imp_items[$imp_id];
                $shortcode      = $imp_item['meta']['shortcode'];
                $shortcode      = '['.$shortcode.']';
            }
        }

        return $shortcode;
    }

    private function getIMPShortcodeDataAtts( $imp_id ){
        $instance = $this->getIMPInstance();

        if ($instance) {
            $options        = get_option( $instance->admin_options_name );
            $imp_items      = $options['saves'];
            if(array_key_exists($imp_id, $imp_items)){
                $imp_item       = $imp_items[$imp_id];

                $imp_item = $instance->sanitize_json_for_save($imp_item);

                return $imp_item['json'];
            }
        }
    }

    private function getIMPShapes($imp_id) {
        $spots_value = array();
        $instance = $this->getIMPInstance();
	
	    if ($instance) {
		    $imp_instance   = $instance;
		    $options        = get_option( $imp_instance->admin_options_name );
		    $imp_items      = $options['saves'];
            //Load item with selected image map id
            if(array_key_exists($imp_id, $imp_items)){
                $imp_item = $imp_items[$imp_id];

                //Get selected image map fragments
                $spots = $imp_item['json'];

                //Reformat fragments
                $spots = str_replace("\n", "<br>", $spots); // Replace new line characters with <br>
                $spots = str_replace("\\n", "<br>", $spots); // Replace new line characters with <br>
                $spots = str_replace('\\"', '"', $spots); // Replace \" with "
                $spots = str_replace('\\"', '"', $spots); // Replace \" with "
                $spots = str_replace("\\'", "'", $spots); // Replace \' with '

                //Decode formatted fragments
                $spots_decoded = json_decode($spots);

                //Get fragment ids
                $spots_array = $spots_decoded->spots;
                if(is_array($spots_array) && count($spots_array) > 1){
                    foreach ($spots_array as $spot) {
                        $spots_value[] = $spot->title;
                    }
                }
                else{
                    $spots_value[] = $spots_array->title;
                }
            }
        }

        return $spots_value;
    }

}