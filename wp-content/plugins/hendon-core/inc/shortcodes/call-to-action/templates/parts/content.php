<?php if ( ! empty( $content ) ) { ?>
	<div class="qodef-m-content" <?php qode_framework_inline_style( $content_color ); ?>><?php echo do_shortcode( $content ); ?></div>
<?php } ?>