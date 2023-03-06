<?php

if ( post_password_required() ) {
	echo get_the_password_form();
} else {
	$excerpt = get_the_excerpt();
	
	if ( ! isset( $excerpt_length ) || ( isset( $excerpt_length ) && $excerpt_length === '' ) ) {
		$excerpt_length = 180; // 180 is number of characters
	}
	
	if ( ! empty( $excerpt ) ) {
		$new_excerpt = ( $excerpt_length > 0 ) ? substr( $excerpt, 0, intval( $excerpt_length ) ) : $excerpt;
		?>
		<p itemprop="description" class="qodef-e-excerpt" <?php qode_framework_inline_style( $this_shortcode->get_excerpt_styles( $params ) ); ?>>
            <?php echo strip_tags( $new_excerpt ); ?>
		</p>
	<?php }
} ?>