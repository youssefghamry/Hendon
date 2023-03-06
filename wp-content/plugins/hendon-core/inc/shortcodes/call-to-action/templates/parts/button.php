<?php if ( ! empty( $button_params ) && class_exists( 'HendonCoreButtonShortcode' ) ) { ?>
	<div class="qodef-m-button">
		<?php echo HendonCoreButtonShortcode::call_shortcode( $button_params ); ?>
	</div>
<?php } ?>