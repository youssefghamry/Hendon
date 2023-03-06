<?php

if ( ! function_exists( 'hendon_core_add_property_image_map_gallery_shortcode' ) ) {
    /**
     * Function that isadding shortcode into shortcodes list for registration
     *
     * @param array $shortcodes - Array of registered shortcodes
     *
     * @return array
     */
    function hendon_core_add_property_image_map_gallery_shortcode( $shortcodes ) {
        $shortcodes[] = 'HendonCorePropertyImageMapShortcode';

        return $shortcodes;
    }

    add_filter( 'hendon_core_filter_register_shortcodes', 'hendon_core_add_property_image_map_gallery_shortcode' );
}

class HendonCorePropertyImageMapShortcode extends HendonCoreShortcode {

    public function __construct() {
        parent::__construct();
    }
    

    public function map_shortcode() {
        $this->set_shortcode_path( HENDON_CORE_PLUGINS_URL_PATH . '/property/post-types/property/shortcodes/property-image-map-gallery' );
        $this->set_base( 'hendon_core_property_image_map_gallery' );
        $this->set_name( esc_html__( 'Property Image Map Gallery', 'hendon-core' ) );
        $this->set_description( esc_html__( 'Shortcode that shows property image map gallery', 'hendon-core' ) );
        $this->set_category( esc_html__( 'Hendon Core', 'hendon-core' ) );
        $this->set_scripts(
            array(
                'swiper' => array(
                    'registered'	=> true,
                )
            )
        );

        $this->set_option( array(
            'field_type' => 'text',
            'name'       => 'custom_class',
            'title'      => esc_html__( 'Custom CSS Class', 'hendon-core' ),
            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'hendon-core' )
        ) );
        $this->set_option( array(
            'field_type' => 'image',
            'multiple'   => 'yes',
            'name'       => 'images',
            'title'      => esc_html__( 'Images', 'hendon-core' ),
            'description' => esc_html__( 'Select images from media library', 'hendon-core' )
        ) );
        $this->set_option( array(
            'field_type'    => 'select',
            'name'          => 'image_size',
            'title'         => esc_html__( 'Image Size', 'hendon-core' ),
            'description'   => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size', 'hendon-core' ),
            'options'       => hendon_core_get_select_type_options_pool('list_image_dimension', false, array('custom')),
            'default_value' => 'full'
        ) );
        $this->set_option( array(
            'field_type' => 'text',
            'name'       => 'video_link',
            'title'      => esc_html__( 'Video Link', 'hendon-core' ),
        ) );
        $this->set_option( array(
            'field_type' => 'image',
            'multiple'   => 'no',
            'name'       => 'video_image',
            'title'      => esc_html__( 'Video Image', 'hendon-core' ),
            'description' => esc_html__( 'Select image from media library', 'hendon-core' )
        ) );
        $this->set_option( array(
            'field_type' => 'text',
            'name'       => 'video_link_360',
            'title'      => esc_html__( 'Video Link 360', 'hendon-core' )
        ) );
        $this->set_option( array(
            'field_type' => 'image',
            'multiple'   => 'no',
            'name'       => 'video_image_360',
            'title'      => esc_html__( 'Video Image 360', 'hendon-core' ),
            'description' => esc_html__( 'Select image from media library', 'hendon-core' )
        ) );
        $this->set_option( array(
            'field_type' => 'select',
            'name'       => 'image_map',
            'options'    => $this->getIMPList(),
            'title'      => esc_html__( 'Image Map Name', 'hendon-core' ),
            'description' => esc_html__( 'Enter the name of the image map you have created.', 'hendon-core' )
        ) );
	
	    $this->set_option( array(
		    'field_type' => 'text',
		    'name'       => 'download_link',
		    'title'      => esc_html__( 'Download Link', 'hendon-core' ),
	    ) );
	    $this->set_option( array(
		    'field_type' => 'text',
		    'name'       => 'download_link_text',
		    'title'      => esc_html__( 'Download Link Text', 'hendon-core' )
	    ) );
	    


        $this->map_extra_options();
    }
	
	public function render( $options, $content = null ) {
        parent::render( $options );

        $atts = $this->get_atts();


        $atts['holder_classes'] = $this->getHolderClasses( $atts );

        if($atts['image_map'] != '') {
            $atts['image_map_name']             = $this->getIMPName($atts['image_map']);
            $atts['image_map_shortcode']        = $this->getIMPShortcode($atts['image_map']);
            $atts['image_map_shortcode_attr']   = $this->getIMPShortcodeDataAtts($atts['image_map']);
        }

        $atts['images']             = $this->getGalleryImages( $atts );
        $atts['image_map_object']   = $this->getIMPInstance();
        $atts['params'] = $atts;

        return hendon_core_get_template_part( 'plugins/property/post-types/property/shortcodes/property-image-map-gallery', 'templates/property-image-map-gallery', '', $atts );
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array(
		    'qodef-e',
            'qodef-image-map-gallery',
            'qodef-grid',
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
	
	private function getGalleryImages( $params ) {
		$image_ids = array();
		$images    = array();
		$i         = 0;

		if ( $params['images'] !== '' && !is_array($params['images'])) {
			$image_ids = explode( ',', $params['images'] );
		}

		$counter = 0;
        $image_shapes = $this->getIMPShapes($params['image_map']);

		foreach ( $image_ids as $id ) {
			
			$image['image_id'] = $id;
			$image_original    = wp_get_attachment_image_src( $id, 'full' );
			$image['url']      = $image_original[0];
			$image['title']    = get_the_title( $id );
			$image['alt']      = get_post_meta( $id, '_wp_attachment_image_alt', true );

			if(!empty($image_shapes[$counter])){
                $image['image_shape'] = $image_shapes[$counter];
                ++$counter;
            }
            else {
			    $image['image_shape'] = 'empty';
            }

            $images[ $i ] = $image;
			$i ++;
		}
		
		return $images;
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
        if ($instance){
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
	
	    if ($instance && $imp_id != '') {
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