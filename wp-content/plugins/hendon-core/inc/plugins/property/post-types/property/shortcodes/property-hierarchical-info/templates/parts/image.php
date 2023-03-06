<?php
$apartment_list_image = get_post_meta( $apartment_id, 'qodef_apartment_list_image', true );
$has_image            = ! empty ( $apartment_list_image ) || has_post_thumbnail();

if ( $has_image ) {
    $image_dimension     = isset( $image_dimension ) && ! empty( $image_dimension ) ? esc_attr( $image_dimension ) : 'full'; ?>
    <div class="qodef-e-media-image">
        <a itemprop="url" href="<?php echo get_the_permalink( $apartment_id ); ?>">
            <?php
                if ( ! empty( $apartment_list_image ) ) {
                    echo wp_get_attachment_image( $apartment_list_image, $image_dimension );
                } else {
                    echo get_the_post_thumbnail( $apartment_id, $image_dimension );
                }
            ?>
        </a>
    </div>
<?php } ?>