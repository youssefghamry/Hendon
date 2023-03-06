<?php
$title_tag = isset( $title_tag ) && ! empty( $title_tag ) ? $title_tag : 'h4';
?>
<<?php echo esc_attr( $title_tag ); ?> itemprop="name" class="qodef-e-title entry-title">
<a itemprop="url" class="qodef-e-title-link" href="<?php echo get_the_permalink( $apartment_id ); ?>">
    <?php echo get_the_title( $apartment_id ); ?>
</a>
</<?php echo esc_attr( $title_tag ); ?>>