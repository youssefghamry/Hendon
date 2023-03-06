<?php
$apartment_feature_items = get_post_meta($apartment_id, 'qodef_apartment_feature_repeater', true);

if( is_array( $apartment_feature_items ) && count( $apartment_feature_items ) > 0 ) { ?>
    <div class="qodef-e-pai-content-feature-items-holder">
        <div class="qodef-e-pai-content-feature-items-holder-inner">
            <?php
                foreach ($apartment_feature_items as $apartment_feature_item) { ?>
                    <div class="qodef-e-pai-content-feature-items-row">
                        <div class="qodef-e-pai-content-feature-item-title">
                            <?php echo esc_html( $apartment_feature_item['qodef_apartment_feature_title'] ); ?>
                        </div>
                        <div class="qodef-e-pai-content-feature-item-value">
                            <?php echo esc_html( $apartment_feature_item['qodef_apartment_feature_value'] ); ?>
                        </div>
                    </div>
                <?php } ?>
        </div>
    </div>
<?php }