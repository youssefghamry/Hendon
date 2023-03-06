<?php

if ( ! function_exists( 'hendon_register_justified_gallery_scripts' ) ) {
    /**
     * Function that register module 3rd party scripts
     */
    function hendon_register_justified_gallery_scripts() {
        wp_register_script( 'justified-gallery', HENDON_INC_ROOT . '/justified-gallery/assets/js/plugins/jquery.justifiedGallery.min.js', array( 'jquery' ), true );
    }

    add_action( 'hendon_action_before_main_js', 'hendon_register_justified_gallery_scripts' );
}

if ( ! function_exists( 'hendon_include_justified_gallery_scripts' ) ) {
    /**
     * Function that enqueue modules 3rd party scripts
     *
     * @param array $atts
     */
    function hendon_include_justified_gallery_scripts( $atts ) {

        if ( isset( $atts['behavior'] ) && $atts['behavior'] == 'justified-gallery' ) {
            wp_enqueue_script( 'justified-gallery' );
        }
    }

    add_action( 'hendon_core_action_list_shortcodes_load_assets', 'hendon_include_justified_gallery_scripts' );
}

if ( ! function_exists( 'hendon_register_justified_gallery_scripts_for_list_shortcodes' ) ) {
    /**
     * Function that set module 3rd party scripts for list shortcodes
     *
     * @param array $scripts
     *
     * @return array
     */
    function hendon_register_justified_gallery_scripts_for_list_shortcodes( $scripts ) {

        $scripts['justified-gallery'] = array(
            'registered' => true
        );

        return $scripts;
    }

    add_filter( 'hendon_core_filter_register_list_shortcode_scripts', 'hendon_register_justified_gallery_scripts_for_list_shortcodes' );
}