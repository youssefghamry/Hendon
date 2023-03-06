<?php
$apartment_label = get_post_meta( $apartment_id, 'qodef_apartment_label', true);
?>

<?php if ( !empty($apartment_label) ) : ?>
    <span class="qodef-e-label"><?php echo esc_html($apartment_label); ?></span>
<?php endif; ?>