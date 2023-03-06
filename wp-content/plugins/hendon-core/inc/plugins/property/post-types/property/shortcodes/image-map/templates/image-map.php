<div <?php qode_framework_class_attribute($holder_classes); ?> data-image-map-name='<?php echo esc_attr($image_map_name); ?>'>

    <div class="qodef-map-holder-inner">
        <?php echo hendon_core_get_template_part( 'plugins/property/post-types/property/shortcodes/image-map', 'templates/parts/image-map', '', $params ); ?>
    </div>

    <div class="qodef-im-info-section-holder">
        <?php echo hendon_core_get_template_part( 'plugins/property/post-types/property/shortcodes/image-map', 'templates/parts/info-section', '', $params ); ?>
    </div>

</div>
