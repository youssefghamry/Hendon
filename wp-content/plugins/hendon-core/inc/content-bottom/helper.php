<?php
if ( ! function_exists( 'hendon_core_get_content_bottom_area' ) ) {
    /**
     * Loads content bottom area HTML with all needed parameters
     */
    function hendon_core_get_content_bottom_area() {
        $parameters = array();
        //Current page id
        $id = hendon_get_page_id();
        //is content bottom area enabled for current page?
        $parameters['content_bottom_area'] = hendon_core_get_post_value_through_levels( 'qodef_enable_content_bottom_area', $id );
        if ( $parameters['content_bottom_area'] === 'yes' ) {
            //Sidebar for content bottom area
            $parameters['content_bottom_area_sidebar'] = hendon_core_get_post_value_through_levels( 'qodef_content_bottom_sidebar_custom_display', $id );

            if ( is_active_sidebar( $parameters['content_bottom_area_sidebar'] ) ) {
                hendon_core_template_part( 'content-bottom', 'templates/content-bottom', '', $parameters );
            }
        }
    }
    add_action( 'hendon_action_before_page_footer_content', 'hendon_core_get_content_bottom_area' );
}