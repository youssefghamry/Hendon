<?php if ( ! post_password_required() && class_exists( 'HendonCoreButtonShortcode' ) ) { ?>
	<div class="qodef-e-read-more">
		<?php
		$button_params = array(
			'link' => get_the_permalink(),
			'button_layout' => 'minimal'
		);
		
		echo HendonCoreButtonShortcode::call_shortcode( $button_params ); ?>
	</div>
<?php } ?>