<?php

if ( is_array( $apartments ) && count( $apartments ) > 0 ) {
    foreach( $apartments as $apartment ) { ?>
        <div class="qodef-tabs-content" id="qodef-tab-<?php echo sanitize_title(get_the_title( $apartment->ID )); ?>">
            <div class="qodef-tabs-content-inner">
                <?php $params['apartment_id'] = $apartment->ID; ?>

                <?php echo hendon_core_get_template_part('plugins/property/post-types/property/shortcodes/property-advanced-info', 'templates/parts/tab-content-image', '', $params); ?>

                <?php echo hendon_core_get_template_part('plugins/property/post-types/property/shortcodes/property-advanced-info', 'templates/parts/tab-content-section', '', $params); ?>
            </div>
        </div>
    <?php }
}