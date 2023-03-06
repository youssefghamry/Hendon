<?php if ( ! post_password_required() ) { ?>
	<div class="qodef-e-read-more">
		<?php
		if ( hendon_post_has_read_more() ) {
			$button_params = array(
				'link'          => get_permalink() . '#more-' . get_the_ID(),
				'button_layout' => 'minimal'
			);
		} else {
			$button_params = array(
				'link'          => get_the_permalink(),
				'button_layout' => 'minimal'
			);
		}
		
		hendon_render_button_element( $button_params ); ?>
	</div>
<?php } ?>