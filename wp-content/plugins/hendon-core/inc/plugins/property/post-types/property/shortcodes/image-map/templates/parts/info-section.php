<div class="qodef-im-info-section">

    <div class="qodef-m-items">

        <?php $counter = 0; ?>
        <?php foreach ( $items as $item ) : ?>

            <?php
                if(!empty($shapes[$counter])){
                    $test = $shapes[$counter];
                    ++$counter;
                } else {
                    $test = 'empty';
                }
            ?>

            <div class="qodef-m-item" data-imp-shape="<?php echo esc_attr($test); ?>">
                <?php if ( !empty($item['title']) ) : ?>
                    <h5 class="qodef-e-title"><?php echo esc_html( $item['title'] ); ?></h5>
                <?php endif; ?>
                <?php if ( !empty($item['subtitle']) ) : ?>
                    <h6 class="qodef-e-subtitle"><?php echo esc_html( $item['subtitle'] ); ?></h6>
                <?php endif; ?>
                <?php if ( !empty($item['additional_info']) ) : ?>
                    <p class="qodef-e-additional-info"><?php echo esc_html( $item['additional_info'] ); ?></p>
                <?php endif; ?>
            </div>

        <?php endforeach; ?>

    </div>
</div>