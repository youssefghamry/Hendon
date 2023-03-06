<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
    <div class="qodef-m-items">
		<?php foreach ( $items as $item ) : ?>
			<div class="qodef-m-item">
                <?php if ( $item['label'] !== '' ) : ?>
                    <span class="qodef-m-item-label" <?php qode_framework_inline_style( $label_styles ); ?>><?php echo esc_html($item['label']); ?></span>
                <?php endif; ?>
                <?php if ( $item['text'] !== '' ) : ?>
                    <span class="qodef-m-item-text" <?php qode_framework_inline_style( $text_styles ); ?>><?php echo esc_html($item['text']); ?></span>
                <?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>
</div>