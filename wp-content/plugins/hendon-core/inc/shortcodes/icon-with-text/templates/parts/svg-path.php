<?php if ( $icon_type == 'svg-path' && ! empty ( $svg_path ) ) { ?>
    <?php if ( ! empty( $link ) && $layout !== 'content-in-box' ) : ?>
        <a itemprop="url" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
    <?php endif; ?>
    <?php echo hendon_core_get_module_part($svg_path); ?>
    <?php if ( ! empty( $link ) && $layout !== 'content-in-box' ) : ?>
        </a>
    <?php endif; ?>
<?php }