<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_style( $holder_styles ); ?>>
	<div class="qodef-m-inner">
		<?php hendon_core_template_part( 'shortcodes/pricing-table', 'templates/parts/title', '', $params ) ?>
		<?php hendon_core_template_part( 'shortcodes/pricing-table', 'templates/parts/price', '', $params ) ?>
		<?php hendon_core_template_part( 'shortcodes/pricing-table', 'templates/parts/content', '', $params ) ?>
		<?php hendon_core_template_part( 'shortcodes/pricing-table', 'templates/parts/button', '', $params ) ?>
	</div>
</div>