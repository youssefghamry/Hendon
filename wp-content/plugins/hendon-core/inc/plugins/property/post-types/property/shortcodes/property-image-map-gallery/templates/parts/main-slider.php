<div class="qodef-img-slider">
    <div class="swiper-wrapper">
        <?php foreach ($images as $image) { ?>
            <div class="qodef-ig-image swiper-slide" data-imp-shape="<?php echo esc_attr($image['image_shape']); ?>">
                <?php echo wp_get_attachment_image($image['image_id'], $image_size); ?>
            </div>
        <?php } ?>
    </div>
</div>