<?php $svg_arrow = '<svg version="1.1" x="0px" y="0px" width="74px" height="40px" viewBox="0 0 74 40" enable-background="new 0 0 74 40" xml:space="preserve"><g opacity="0.5">	<path fill="#C28562" d="M52.556,35c-8.271,0-15-6.729-15-15s6.729-15,15-15c8.271,0,15,6.729,15,15S60.826,35,52.556,35z M52.556,6		c-7.721,0-14,6.28-14,14s6.279,14,14,14c7.719,0,14-6.28,14-14S60.274,6,52.556,6z"></path></g>		<polygon fill="#C28562" points="49.525,14.265 48.898,15.044 54.481,19.541 6.444,19.541 6.444,20.541 54.464,20.541 48.901,24.954	49.522,25.737 56.7,20.044 "></polygon></svg>'; ?>

<?php if ( get_the_posts_pagination() !== '' ): ?>

    <div class="qodef-m-pagination qodef--wp">
		<?php
		// Load posts pagination (in order to override template use navigation_markup_template filter hook)
		the_posts_pagination( array(
            'prev_text'          => $svg_arrow,
            'next_text'          => $svg_arrow,
            'before_page_number' => '',
		) ); ?>
    </div>

<?php endif; ?>