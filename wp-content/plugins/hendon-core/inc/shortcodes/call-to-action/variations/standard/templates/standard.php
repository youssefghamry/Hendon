<?php $title_tag = isset( $title_tag ) && ! empty( $title_tag ) ? $title_tag : 'h2'; ?>
<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<div class="qodef-m-inner">
		<div class="qodef-m-content-wrapper">
			<?php if( !empty($title)) : ?>
				<<?php echo esc_attr( $title_tag ); ?> class="qodef-m-title" <?php qode_framework_inline_style( $title_color ); ?>><?php echo esc_html($title); ?></<?php echo esc_attr( $title_tag ); ?>>
			<?php endif; ?>
			<?php hendon_core_template_part( 'shortcodes/call-to-action', 'templates/parts/content', '', $params ) ?>
		</div>
		<?php hendon_core_template_part( 'shortcodes/call-to-action', 'templates/parts/button', '', $params ) ?>
	</div>
</div>