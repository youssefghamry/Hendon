<?php
$apartment_features = get_post_meta( $apartment_id, 'qodef_apartment_feature_repeater', true);

if( is_array( $apartment_features ) && count( $apartment_features ) > 0 ){ ?>
    <div class="qodef-phi-features-holder">
        <?php foreach ($apartment_features as $apartment_feature ) { ?>
        <div class="qodef-phi-feature">
            <?php
            if( ! empty( $apartment_feature['qodef_apartment_feature_image'] ) ) { ?>
               <div class="qodef-phi-feature-image">
                   <?php echo wp_get_attachment_image( $apartment_feature['qodef_apartment_feature_image'] ); ?>
               </div>
            <?php } ?>

            <?php
            if( ! empty( $apartment_feature['qodef_apartment_feature_title'] ) ) { ?>
                <div class="qodef-phi-feature-title">
                    <?php echo esc_html( $apartment_feature['qodef_apartment_feature_title'] ); ?>
                </div>
            <?php } ?>
        </div>
        <?php } ?>
    </div>
<?php }