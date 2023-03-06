<?php
if($query_results->have_posts()):
    while ( $query_results->have_posts() ) : $query_results->the_post();
        ?>
        <div class="qodef-e-property--info-item">
            <div class="qodef-e-phi-main-content">
                <div class="qodef-e-phi-content-inner">
                    <?php echo hendon_core_get_template_part( 'plugins/property/post-types/property/shortcodes/property-hierarchical-info', 'templates/item', '', $params ); ?>
                </div>
            </div>
        </div>
        <?php
    endwhile;
else:
    // Include global posts not found
    hendon_core_theme_template_part( 'content', 'templates/parts/posts-not-found' );
endif;
wp_reset_postdata();
?>