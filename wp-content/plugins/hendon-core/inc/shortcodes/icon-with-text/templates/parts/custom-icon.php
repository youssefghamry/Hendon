<?php if ( $icon_type == 'custom-icon' && ! empty ( $custom_icon ) ) { ?>
	<?php if ( ! empty( $link ) && $layout !== 'content-in-box' ) : ?>
		<a itemprop="url" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
	<?php endif; ?>
		<?php echo wp_get_attachment_image( $custom_icon, 'full' ); ?>
	<?php if ( ! empty( $link ) && $layout !== 'content-in-box' ) : ?>
		</a>
	<?php endif; ?>
<?php }