<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<div class="qodef-m-images" <?php qode_framework_inline_style( $images_holder_styles ); ?>>
		<?php if ( ! empty( $main_image ) ) : ?>
			<?php echo wp_get_attachment_image( $main_image, 'full', false, array( 'class' => 'qodef-e-image qodef--main' ) ); ?>
		<?php endif; ?>
		
		<?php if ( ! empty( $stacked_image ) ): ?>
			<div class="qodef-stack-image-holder" <?php qode_framework_inline_style( $stack_image_styles ); ?>>
				<div class="qodef-stack-image-holder-inner">
					<div class="qodef-stack-image-img-holder">
					<?php echo wp_get_attachment_image( $stacked_image, 'full', false, array( 'class' => 'qodef-e-image qodef--stack' ) ); ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

        <?php if ( ! empty( $additional_stacked_image ) ) : ?>
            <div class="qodef-additional-stacked-image-holder">
                <?php echo wp_get_attachment_image( $additional_stacked_image, 'full', false, array( 'class' => 'qodef-e-image qodef--additional-stacked-image' ) ); ?>
            </div>
        <?php endif; ?>
	</div>
</div>