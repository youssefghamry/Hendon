<?php

//function to remove ImageMapPro script from elementor wp_footer hook, but it has to hook in to elementor wp_head in order to remove it before it is executed
if( ! function_exists('hendon_core_remove_image_map_pro_script') ){
    function hendon_core_remove_image_map_pro_script(){
        if (class_exists('ImageMapPro')) {
            hendon_core_remove_filter_for_anonymous_class( 'wp_footer', 'ImageMapPro', 'call_plugin', 10 );
        }
    }

    add_action('elementor/editor/wp_head', 'hendon_core_remove_image_map_pro_script');
}