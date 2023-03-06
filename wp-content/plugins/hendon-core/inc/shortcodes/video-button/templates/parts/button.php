<?php
if (empty($play_button_size) && $play_button_size === '') {
    $play_button_size = '110px';
}
if (empty($play_button_color) && $play_button_color === '') {
    if (!empty(hendon_core_get_post_value_through_levels( 'qodef_main_color' ))) {
        $play_button_color = hendon_core_get_post_value_through_levels( 'qodef_main_color' );
    } else {
        $play_button_color = '#C28562';
    }
}
?>

<?php if ( ! empty( $video_link ) ) { ?>
	<a itemprop="url" class="qodef-m-play qodef-magnific-popup qodef-popup-item" href="<?php echo esc_url( $video_link ); ?>" data-type="iframe">
		<span class="qodef-m-play-inner">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                 width="110px" height="110px" viewBox="0 0 110 110" enable-background="new 0 0 110 110" xml:space="preserve">
            <circle fill="#FFFFFF" cx="55.077" cy="55.533" r="50"/>
            <polygon fill="#C28562" points="51.073,65.258 63.081,55.641 51.073,45.809 "/>
            <circle opacity="0.5" fill="none" stroke="#C28562" cx="50%" cy="50%" r="42%"></circle>
            <circle fill="none" stroke="#C28562" cx="50%" cy="50%" r="42%"></circle>
            </svg>
		</span>
	</a>
<?php } ?>