<?php
$quote_meta = get_post_meta( get_the_ID(), 'qodef_post_format_quote_text', true );
$quote_text = ! empty( $quote_meta ) ? $quote_meta : get_the_title();

if ( ! empty( $quote_text ) ) {
	$quote_author     = get_post_meta( get_the_ID(), 'qodef_post_format_quote_author', true );
	$title_tag        = isset( $title_tag ) && ! empty( $title_tag ) ? $title_tag : 'h4';
	$author_title_tag = isset( $author_title_tag ) && ! empty( $author_title_tag ) ? $author_title_tag : 'span';
	$quote_author_role = get_post_meta( get_the_ID(), 'qodef_post_format_quote_author_role', true );
	?>
	<div class="qodef-e-quote">
	<div class="qodef-e-quote-mark">
		<svg version="1.1" x="0px" y="0px" width="58px" height="58px" viewBox="0 0 58 58" enable-background="new 0 0 58 58" xml:space="preserve">
		<g>
			<path fill="#C28562" d="M16.224,9.591c1.103,1.935,1.878,3.85,2.327,5.75c0.448,1.9,0.673,3.817,0.673,5.75
				c0,2.267-0.297,4.5-0.888,6.7c-0.59,2.2-1.391,4.334-2.4,6.4s-2.18,4.033-3.513,5.898c-1.334,1.867-2.734,3.635-4.2,5.301l-0.4-0.4
				c-0.135-0.133-0.2-0.299-0.2-0.5c0-0.064,0.065-0.232,0.2-0.5c2.933-4,5.166-7.699,6.7-11.1c1.533-3.4,2.3-6.766,2.3-10.1
				c0-2.133-0.234-3.95-0.7-5.45c-0.467-1.5-1.167-3.15-2.1-4.95c-0.267-0.533-0.4-0.865-0.4-1c0-0.333,0.2-0.6,0.6-0.8L16.224,9.591z
				 M40.123,9.591c1.104,1.935,1.879,3.85,2.327,5.75s0.673,3.817,0.673,5.75c0,2.267-0.283,4.5-0.85,6.7
				c-0.566,2.2-1.35,4.334-2.35,6.4s-2.168,4.033-3.5,5.898c-1.334,1.867-2.734,3.635-4.2,5.301l-0.399-0.4
				c-0.135-0.133-0.201-0.299-0.201-0.5c0-0.064,0.066-0.232,0.201-0.5c2.899-4,5.109-7.699,6.625-11.1
				c1.516-3.4,2.274-6.766,2.274-10.1c0-2.133-0.234-3.95-0.7-5.45c-0.467-1.5-1.167-3.15-2.1-4.95c-0.268-0.533-0.4-0.865-0.4-1
				c0-0.333,0.2-0.6,0.6-0.8L40.123,9.591z"/>
		</g>
					<g opacity="0.4">
						<path fill="#C28562" d="M22.137,14.218c1.103,1.935,1.878,3.85,2.327,5.75c0.448,1.9,0.673,3.817,0.673,5.75
				c0,2.267-0.297,4.5-0.888,6.7c-0.59,2.199-1.391,4.334-2.4,6.4s-2.18,4.033-3.513,5.9c-1.334,1.867-2.734,3.633-4.2,5.299l-0.4-0.4
				c-0.135-0.133-0.2-0.299-0.2-0.5c0-0.064,0.065-0.232,0.2-0.5c2.933-4,5.166-7.699,6.7-11.1c1.533-3.4,2.3-6.766,2.3-10.099
				c0-2.133-0.234-3.95-0.7-5.45c-0.467-1.5-1.167-3.15-2.1-4.95c-0.267-0.533-0.4-0.865-0.4-1c0-0.333,0.2-0.6,0.6-0.8L22.137,14.218
				z M46.037,14.218c1.103,1.935,1.877,3.85,2.326,5.75c0.448,1.9,0.674,3.817,0.674,5.75c0,2.267-0.285,4.5-0.851,6.7
				c-0.567,2.199-1.351,4.334-2.351,6.4s-2.166,4.033-3.5,5.9s-2.734,3.633-4.199,5.299l-0.4-0.4c-0.135-0.133-0.199-0.299-0.199-0.5
				c0-0.064,0.064-0.232,0.199-0.5c2.9-4,5.109-7.699,6.625-11.1s2.275-6.766,2.275-10.099c0-2.133-0.234-3.95-0.7-5.45
				c-0.468-1.5-1.167-3.15-2.101-4.95c-0.267-0.533-0.399-0.865-0.399-1c0-0.333,0.2-0.6,0.601-0.8L46.037,14.218z"/>
					</g>
		</svg>
	</div>
		<<?php echo esc_attr( $title_tag ); ?> class="qodef-e-quote-text"><?php echo esc_html( $quote_text ); ?></<?php echo esc_attr( $title_tag ); ?>>
		<?php if ( ! empty( $quote_author ) ) { ?>
			<<?php echo esc_attr( $author_title_tag ); ?> class="qodef-e-quote-author"><?php echo esc_html( $quote_author ); ?></<?php echo esc_attr( $author_title_tag ); ?>>
		<?php } ?>
		<?php if ( !empty($quote_author_role)) : ?>
			<h6 class="qodef-e-quote-author-role"><?php echo esc_html($quote_author_role); ?></h6>
		<?php endif; ?>
		<?php if ( ! is_single() ) { ?>
			<a itemprop="url" class="qodef-e-quote-url" href="<?php the_permalink(); ?>"></a>
		<?php } ?>
	</div>
<?php } ?>