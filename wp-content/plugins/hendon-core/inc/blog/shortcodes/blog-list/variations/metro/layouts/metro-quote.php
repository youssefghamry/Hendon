<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<?php
		// Include post format part
		hendon_core_theme_template_part( 'blog', 'templates/parts/post-format/quote', '', array( 'title_tag' => 'p', 'author_title_tag' => 'h5' ) ); ?>
	</div>
</article>