<?php if ( $query_result->have_posts() ) {
    while ( $query_result->have_posts() ) : $query_result->the_post();
        $params['image_dimension'] = $this_shortcode->get_list_item_image_dimension( $params );
        $params['item_classes']    = $this_shortcode->get_item_classes( $params );

        hendon_core_list_sc_template_part( 'plugins/property/post-types/apartment/shortcodes/apartment-list', 'layouts/' . $layout, '', $params );
    endwhile; // End of the loop.
} else {
    // Include global posts not found
    hendon_core_theme_template_part( 'content', 'templates/parts/posts-not-found' );
}

wp_reset_postdata();