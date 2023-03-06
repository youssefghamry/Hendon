<?php
// Hook to include additional content before page content holder
do_action( 'hendon_action_before_page_content_holder' );
?>
<main id="qodef-page-content" class="qodef-grid qodef-layout--template <?php echo esc_attr( hendon_get_grid_gutter_classes() ); ?>">
	<div class="qodef-grid-inner clear">
		<?php
		// Hook to include additional content before blog and sidebar
        do_action( 'hendon_action_before_blog_sidebar' );

		// Include blog template
		echo apply_filters( 'hendon_filter_blog_template' , hendon_get_template_part( 'blog', 'templates/blog' ) );
		
		// Include page content sidebar
		hendon_template_part( 'sidebar', 'templates/sidebar' );
		?>
	</div>
</main>
<?php
// Hook to include additional content after main page content holder
do_action( 'hendon_action_after_page_content_holder' );
?>