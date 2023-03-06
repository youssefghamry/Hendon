<article <?php post_class( 'qodef-blog-item qodef-e' ); ?>>
	<div class="qodef-e-inner">
		<?php
		// Include post media
		hendon_template_part( 'blog', 'templates/parts/post-info/media' );
		?>
		<div class="qodef-e-content">
			<?php
			// Include post title
			hendon_template_part( 'blog', 'templates/parts/post-info/title' );
			?>
			
			<div class="qodef-e-info qodef-info--top">
				<?php
				// Include post author info
				hendon_template_part( 'blog', 'templates/parts/post-info/author' );
				
				// Include post category info
				hendon_template_part( 'blog', 'templates/parts/post-info/category' );
				?>
			</div>
			<div class="qodef-e-text">
				<?php
				// Include post content
				the_content();
				
				// Hook to include additional content after blog single content
				do_action( 'hendon_action_after_blog_single_content' );
				?>
			</div>
			<div class="qodef-e-info qodef-info--bottom">
				<div class="qodef-e-info-left">
					<?php
					// Include post category info
					hendon_template_part( 'blog', 'templates/parts/post-info/tags' );
					?>
				</div>
				<div class="qodef-e-info-right">
					<?php
					// Include post tags info
					hendon_template_part( 'blog', 'templates/parts/post-info/social-share' );
					?>
				</div>
			</div>
		</div>
	</div>
</article>