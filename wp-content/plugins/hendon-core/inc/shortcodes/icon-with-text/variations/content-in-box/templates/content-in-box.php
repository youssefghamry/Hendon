<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_style( $box_styles ); ?> <?php qode_framework_inline_attrs( $data_attrs ); ?>>
    <?php if ( ! empty( $link ) ) : ?>
        <a itemprop="url" class="qodef-m-icon-link" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
    <?php endif; ?>
        <div class="qodef-m-icon-wrapper">
            <?php hendon_core_template_part( 'shortcodes/icon-with-text', 'templates/parts/' . $icon_type, '', $params ) ?>
        </div>
        <div class="qodef-m-content">
            <?php hendon_core_template_part( 'shortcodes/icon-with-text', 'templates/parts/title', '', $params ) ?>
            <?php hendon_core_template_part( 'shortcodes/icon-with-text', 'templates/parts/text', '', $params ) ?>
        </div>
    <?php if ( ! empty( $link ) ) : ?>
    </a>
    <?php endif; ?>
</div>