<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<?php hendon_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/media', '', $params ); ?>
		<div class="qodef-e-content">
			<?php
			// Include post title
			hendon_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/title', '', $params );
			// Include post excerpt
			hendon_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/excerpt', '', $params );
			?>
			<div class="qodef-e-info qodef-info--bottom">
				<?php
				// Include post date info
				hendon_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/read-more' );
				?>
			</div>
		</div>
	</div>
</article>