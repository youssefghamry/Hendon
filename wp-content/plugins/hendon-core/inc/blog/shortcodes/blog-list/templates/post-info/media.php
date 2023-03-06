<div class="qodef-e-media">
	<?php switch ( get_post_format() ) {
		case 'gallery':
			hendon_core_theme_template_part( 'blog', 'templates/parts/post-format/gallery' );
			break;
		case 'video':
			hendon_core_theme_template_part( 'blog', 'templates/parts/post-format/video' );
			break;
		case 'audio':
			hendon_core_theme_template_part( 'blog', 'templates/parts/post-format/audio' );
			break;
		default:
			hendon_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/image' );
			break;
	} ?>
	
	<?php
		if(get_post_format() !== 'audio' && has_post_thumbnail()) {
			hendon_core_theme_template_part( 'blog', 'templates/parts/post-info/date' );
		}
	?>
</div>