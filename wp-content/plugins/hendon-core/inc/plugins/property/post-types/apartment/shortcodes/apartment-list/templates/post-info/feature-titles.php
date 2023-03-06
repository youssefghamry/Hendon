<?php

$features = get_post_meta(get_the_ID(), 'qodef_apartment_feature_repeater', true);

if( is_array( $features ) && count( $features ) > 0 ){ ?>
    <div class="qodef-e-al-feature-titles-holder">
    <?php foreach ( $features as $feature ) { ?>
        <h6 class="qodef-e-al-feature-title">
            <?php echo esc_html($feature['qodef_apartment_feature_title']); ?>
        </h6>
    <?php } ?>
    </div>
<?php } ?>