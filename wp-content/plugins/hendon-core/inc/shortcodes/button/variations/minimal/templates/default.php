<?php
	$color = '';

	if ( !empty($minimal_arrow_color) ) {
		$color = $minimal_arrow_color;
	} elseif ( !empty(hendon_core_get_post_value_through_levels( 'qodef_main_color' ))){
		$color = hendon_core_get_post_value_through_levels( 'qodef_main_color' );
	} else {
		$color = '#C28562';
	}
?>

<a <?php qode_framework_class_attribute( $holder_classes ); ?> href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>" <?php qode_framework_inline_attrs( $data_attrs ); ?> <?php qode_framework_inline_style( $styles ); ?>>
	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="74px" height="40px" viewBox="0 0 74 40" enable-background="new 0 0 74 40" xml:space="preserve"><g><circle opacity="0.5" fill="none" stroke="<?php echo esc_attr($color); ?>" cx="71%" cy="50%" r="24%" style=""></circle><circle fill="none" stroke="<?php echo esc_attr($color); ?>" cx="71%" cy="50%" r="24%"></circle></g><polygon fill="<?php echo esc_attr($color); ?>" points="49.525,14.265 48.898,15.044 54.481,19.541 6.444,19.541 6.444,20.541 54.464,20.541 48.901,24.954 49.522,25.737 56.7,20.044 "></polygon></svg>
</a>