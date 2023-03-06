<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
    <div class="qodef-e-property-advanced-info-inner">
        <?php
        if($query_results->have_posts()):
            while ( $query_results->have_posts() ) : $query_results->the_post();
                ?>
                <div class="qodef-tabs clear qodef-orientation--vertical qodef-layout--simple">

                    <?php $params['property_id'] = get_the_ID(); ?>

                    <?php echo hendon_core_get_template_part( 'plugins/property/post-types/property/shortcodes/property-advanced-info', 'templates/parts/tab-titles', '', $params ); ?>

                    <?php echo hendon_core_get_template_part( 'plugins/property/post-types/property/shortcodes/property-advanced-info', 'templates/parts/tab-contents', '', $params ); ?>

                </div>
                <?php
            endwhile;
        else:
            // Include global posts not found
            hendon_core_theme_template_part( 'content', 'templates/parts/posts-not-found' );
        endif;
        wp_reset_postdata();
        ?>
    </div>
</div>