<div id="qodef-page-comments">
	<?php if ( have_comments() ) {
		?>
		<div id="qodef-page-comments-list" class="qodef-m">
			<h3 class="qodef-m-title"><?php echo esc_html__( 'Comments:', 'hendon' ); ?></h3>
			<ul class="qodef-m-comments">
				<?php wp_list_comments( array_unique( array_merge( array( 'callback' => 'hendon_get_comments_list_template' ), apply_filters( 'hendon_filter_comments_list_template_callback', array() ) ) ) ); ?>
			</ul>

			<?php if ( get_comment_pages_count() > 1 ) { ?>
				<div class="qodef-m-pagination qodef--wp">
					<?php the_comments_pagination( array(
						'prev_text'          => hendon_get_icon( 'arrow_carrot-left', 'elegant-icons', '&blacktriangleleft; '.esc_html__( 'Prev', 'hendon' ) ),
						'next_text'          => hendon_get_icon( 'arrow_carrot-right', 'elegant-icons', esc_html__( 'Next', 'hendon' ).'  &blacktriangleright;' ),
						'before_page_number' => '0',
					) ); ?>
				</div>
			<?php } ?>
		</div>
	<?php } ?>
	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) { ?>
		<p class="qodef-page-comments-not-found"><?php esc_html_e( 'Comments are closed.', 'hendon' ); ?></p>
	<?php } ?>

	<div id="qodef-page-comments-form">
        <?php comment_form( hendon_get_comment_form_args() ); ?>
	</div>
</div>