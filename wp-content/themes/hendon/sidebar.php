<?php if ( is_active_sidebar( hendon_get_sidebar_name() ) ) { ?>
	<aside id="qodef-page-sidebar">
		<?php dynamic_sidebar( hendon_get_sidebar_name() ); ?>
	</aside>
<?php } ?>