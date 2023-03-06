<?php if ( isset( $query_result ) && intval( $query_result->max_num_pages ) > 1 ) { ?>
	<div class="qodef-m-pagination qodef--standard">
		<div class="qodef-m-pagination-inner">
			<nav class="qodef-m-pagination-items" role="navigation">
				<div class="qodef-m-pagination-item qodef--prev">
					<a href="#" data-paged="1">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="74px" height="40px" viewBox="0 0 74 40" enable-background="new 0 0 74 40" xml:space="preserve"><g><circle opacity="0.5" fill="none" stroke="#C28562" cx="71%" cy="50%" r="24%" style=""></circle><circle fill="none" stroke="#C28562" cx="71%" cy="50%" r="24%"></circle></g><polygon fill="#C28562" points="49.525,14.265 48.898,15.044 54.481,19.541 6.444,19.541 6.444,20.541 54.464,20.541 48.901,24.954 49.522,25.737 56.7,20.044 "></polygon></svg>
					</a>
				</div>
				<?php for ( $i = 1; $i <= intval( $query_result->max_num_pages ); $i ++ ) {
					$classes     = $i === 1 ? 'qodef--active' : '';
					?>
					<div class="qodef-m-pagination-item qodef--number qodef--number-<?php echo esc_attr( $i ); ?> <?php echo esc_attr( $classes ); ?>">
						<a href="#" data-paged="<?php echo esc_attr( $i ); ?>"><?php echo esc_html( $i ); ?></a>
					</div>
				<?php } ?>
				<div class="qodef-m-pagination-item qodef--next">
					<a href="#" data-paged="2">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="74px" height="40px" viewBox="0 0 74 40" enable-background="new 0 0 74 40" xml:space="preserve"><g><circle opacity="0.5" fill="none" stroke="#C28562" cx="71%" cy="50%" r="24%" style=""></circle><circle fill="none" stroke="#C28562" cx="71%" cy="50%" r="24%"></circle></g><polygon fill="#C28562" points="49.525,14.265 48.898,15.044 54.481,19.541 6.444,19.541 6.444,20.541 54.464,20.541 48.901,24.954 49.522,25.737 56.7,20.044 "></polygon></svg>
					</a>
				</div>
			</nav>
		</div>
	</div>
<?php } ?>