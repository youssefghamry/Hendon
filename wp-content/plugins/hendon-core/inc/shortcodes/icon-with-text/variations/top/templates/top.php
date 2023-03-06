<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_attrs( $data_attrs ); ?>>
	<div class="qodef-m-icon-wrapper">
		<?php hendon_core_template_part( 'shortcodes/icon-with-text', 'templates/parts/' . $icon_type, '', $params ) ?>
		<?php if (! empty( $params["enable_circle"] ) && $params["enable_circle"] === 'yes')  { ?>
		<svg class="qodef-svg-circle">
			<circle cx="50%" cy="50%" r="49%"></circle>
			<circle cx="50%" cy="50%" r="49%"></circle>
		</svg>
		<?php } ?>
	</div>
	<div class="qodef-m-content">
		<?php hendon_core_template_part( 'shortcodes/icon-with-text', 'templates/parts/title', '', $params ) ?>
		<?php hendon_core_template_part( 'shortcodes/icon-with-text', 'templates/parts/text', '', $params ) ?>
	</div>
</div>