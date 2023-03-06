<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<div class="qodef-m-content">
        <div class="qodef-m-custom-icon-holder">
            <?php
                if ($icon_type === 'custom-icon' && !empty($custom_icon)) {
                    hendon_core_template_part( 'shortcodes/banner', 'templates/parts/custom-icon', '', $params );
                } elseif ($icon_type === 'svg-path' && !empty($svg_path)) {
                    hendon_core_template_part( 'shortcodes/banner', 'templates/parts/svg-path', '', $params );
                }
            ?>
        </div>
		<div class="qodef-m-content-inner">
			<?php hendon_core_template_part( 'shortcodes/banner', 'templates/parts/subtitle', '', $params ) ?>
			<?php hendon_core_template_part( 'shortcodes/banner', 'templates/parts/title', '', $params ) ?>
			<?php hendon_core_template_part( 'shortcodes/banner', 'templates/parts/text', '', $params ) ?>
			<?php hendon_core_template_part( 'shortcodes/banner', 'templates/parts/button', '', $params ) ?>
		</div>
	</div>
</div>