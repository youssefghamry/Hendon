<?php if ( class_exists( 'HendonCoreSocialShareShortcode' ) ) { ?>
	<div class="qodef-e-info-item qodef-e-info-social-share">
		<?php
		$params = array();
		$params['title'] = esc_html__( 'Share:', 'hendon-core' );
		
		echo HendonCoreSocialShareShortcode::call_shortcode( $params ); ?>
	</div>
<?php } ?>