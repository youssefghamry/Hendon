<?php

if ( post_password_required() ) {
	echo get_the_password_form();
} else {
	$excerpt = hendon_core_get_custom_post_type_excerpt( isset( $excerpt_length ) ? $excerpt_length : 0 );
	
	if ( ! empty( $excerpt ) ) { ?>
		<p itemprop="description" class="qodef-e-excerpt" <?php qode_framework_inline_style( $this_shortcode->get_excerpt_styles( $params ) ); ?>><?php echo esc_html( $excerpt ); ?></p>
	<?php }
} ?>