<?php
$link_url_meta  = get_post_meta( get_the_ID(), 'qodef_post_format_link', true );
$link_url       = ! empty( $link_url_meta ) ? $link_url_meta : get_the_permalink();
$link_text_meta = get_post_meta( get_the_ID(), 'qodef_post_format_link_text', true );

if ( ! empty( $link_url ) ) {
	$link_text = ! empty( $link_text_meta ) ? $link_text_meta : get_the_title();
	$title_tag = isset( $title_tag ) && ! empty( $title_tag ) ? $title_tag : 'h4';
	?>
	<div class="qodef-e-link">
	<div class="qodef-e-link-mark">
		<svg version="1.1" x="0px" y="0px" width="80px" height="28px" viewBox="0 0 80 28" enable-background="new 0 0 80 28" xml:space="preserve">
		<g>
			<path fill="#C28562" d="M33.185,17.92c-0.994,1.211-2.5,1.984-4.185,1.984H15.81c-2.985,0-5.415-2.43-5.415-5.416
				c0-2.985,2.43-5.415,5.415-5.415H29c1.685,0,3.191,0.774,4.185,1.983h4.707C36.51,7.492,33.047,4.956,29,4.956H15.81
				c-5.256,0-9.533,4.276-9.533,9.533s4.276,9.533,9.533,9.533H29c4.047,0,7.51-2.536,8.892-6.102H33.185z"/>
			<path fill="#C28562" d="M64.186,4.956H50.996c-4.047,0-7.51,2.536-8.891,6.101h4.705c0.994-1.209,2.502-1.983,4.186-1.983h13.189
				c2.986,0,5.416,2.43,5.416,5.415c0,2.986-2.43,5.416-5.416,5.416H50.996c-1.684,0-3.191-0.773-4.186-1.984h-4.705
				c1.381,3.565,4.844,6.102,8.891,6.102h13.189c5.257,0,9.533-4.276,9.533-9.533S69.442,4.956,64.186,4.956z"/>
			<path fill="#C28562" d="M48.806,16.548H31.19c-1.137,0-2.059-0.922-2.059-2.059s0.922-2.059,2.059-2.059h17.615
				c1.137,0,2.059,0.922,2.059,2.059S49.942,16.548,48.806,16.548z"/>
		</g>
		</svg>
	</div>
		<<?php echo esc_attr( $title_tag ); ?> class="qodef-e-link-text"><?php echo esc_html( $link_text ); ?></<?php echo esc_attr( $title_tag ); ?>>
		<a itemprop="url" class="qodef-e-link-url" href="<?php echo esc_url( $link_url ); ?>" target="_blank"></a>
	</div>
<?php } ?>