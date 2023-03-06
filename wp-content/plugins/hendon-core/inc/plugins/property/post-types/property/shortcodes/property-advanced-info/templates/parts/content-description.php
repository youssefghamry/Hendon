<?php
$apartment_description = get_post_meta($apartment_id, 'qodef_apartment_description', true);

if( ! empty( $apartment_description ) ) { ?>
    <div class="qodef-e-pai-content-description-holder">
        <p class="qodef-e-pai-content-description">
            <?php echo esc_html( $apartment_description ); ?>
        </p>
    </div>
<?php }