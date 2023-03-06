<div class="qodef-e-media">
	<?php switch ( get_post_format() ) {
		case 'gallery':
			hendon_template_part( 'blog', 'templates/parts/post-format/gallery' );
			break;
		case 'video':
			hendon_template_part( 'blog', 'templates/parts/post-format/video' );
			break;
		case 'audio':
			hendon_template_part( 'blog', 'templates/parts/post-format/audio' );
			break;
		default:
			hendon_template_part( 'blog', 'templates/parts/post-info/image' );
			break;
	} ?>
	
	<?php
		if( has_post_thumbnail() ) {
			hendon_template_part( 'blog', 'templates/parts/post-info/date' );
		}
	?>
</div>