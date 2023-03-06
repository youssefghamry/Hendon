<div class="qodef-e-pai-content-image-holder">
    <?php $image_id = get_post_meta($apartment_id, 'qodef_apartment_plan_image', true); ?>
    <?php echo wp_get_attachment_image($image_id, $image_proportions); ?>
</div>