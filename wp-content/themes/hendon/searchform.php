<?php
// Unique ID for search form fields
$qodef_unique_id = uniqid( 'qodef-search-form-' );
?>
<form role="search" method="get" class="qodef-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo esc_attr( $qodef_unique_id ); ?>" class="screen-reader-text"><?php esc_html_e( 'Search for:', 'hendon' ); ?></label>
	<div class="qodef-search-form-inner clear">
		<input type="search" id="<?php echo esc_attr( $qodef_unique_id ); ?>" class="qodef-search-form-field" value="" name="s" placeholder="<?php esc_attr_e( 'Search', 'hendon' ); ?>" />
		<button type="submit" class="qodef-search-form-button">
			<svg version="1.1" x="0px" y="0px" width="34px" height="34px" viewBox="0 0 34 34" enable-background="new 0 0 34 34" xml:space="preserve">
			<path d="M26.323,25.885l-3.286-3.554c1.42-1.644,2.285-3.779,2.285-6.118c0-5.171-4.207-9.377-9.378-9.377
				c-5.17,0-9.377,4.207-9.377,9.377c0,5.171,4.207,9.378,9.377,9.378c2.473,0,4.719-0.97,6.396-2.539l3.248,3.512L26.323,25.885z
				 M15.944,24.592c-4.619,0-8.377-3.759-8.377-8.378c0-4.619,3.758-8.377,8.377-8.377s8.378,3.758,8.378,8.377
				C24.322,20.833,20.563,24.592,15.944,24.592z"/>
			</svg>
		</button>
	</div>
</form>