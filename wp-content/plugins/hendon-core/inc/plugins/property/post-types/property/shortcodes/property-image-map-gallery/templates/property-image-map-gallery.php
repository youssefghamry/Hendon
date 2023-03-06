<div <?php qode_framework_class_attribute($holder_classes); ?> data-image-map-name='<?php echo esc_attr($image_map_name); ?>'>
    <div class="qodef-grid-inner clear">
        <div class="qodef-grid-item qodef-img-holder qodef-col--6">
            <?php echo hendon_core_get_template_part( 'plugins/property/post-types/property/shortcodes/property-image-map-gallery', 'templates/parts/left-section', '', $params ); ?>
        </div>
        <div class="qodef-grid-item  qodef-map-holder qodef-col--6">
	        <div class="qodef-map-holder-inner">
	            <?php echo hendon_core_get_template_part( 'plugins/property/post-types/property/shortcodes/property-image-map-gallery', 'templates/parts/right-section', '', $params ); ?>
		        <?php if(!empty($download_link)) : ?>
			        <div class="qodef-map-link-holder">
			            <a href="<?php echo esc_url($download_link); ?>"><?php echo esc_html($download_link_text); ?></a>
			        </div>
		        <?php endif; ?>
	        </div>
        </div>
    </div>
</div>
