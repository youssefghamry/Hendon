<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
    <?php if (!empty($items)) : ?>
        <?php $l = 1; ?>

        <div class="qodef-m-bg-items">
            <?php foreach ( $items as $item ) : ?>

                <?php if ($item['media_type'] == 'image') : ?>
                    <div class="qodef-m-bg-item qodef-image"
                         data-index=<?php echo esc_attr($l); ?>
                         style="background-image:url('<?php echo wp_get_attachment_url($item['image']); ?>');">
                    </div>
                <?php else : ?>
                    <div class="qodef-m-bg-item qodef-video"  data-index=<?php echo esc_attr($l); ?> >
                        <video autoplay loop muted>
                            <source src="<?php echo esc_url($item['video_url']); ?>" type="video/mp4">
                        </video>
                    </div>
                <?php endif; ?>
                <?php $l++; ?>
            <?php endforeach; ?>
        </div>

        <div class="qodef-m-grid">
            <?php for ($j = 1; $j <= 5; $j++) : ?>
                <span class="qodef-m-grid-line"></span>
            <?php endfor; ?>
        </div>

        <div class="qodef-m-content">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php $i = 1; ?>
                    <?php foreach ($items as $item) :
                    $content = array (
                        array("title", 'h3', $item['title']),
                        array("text", 'p', $item['text']),
                        );
                    ?>
                    <div class="qodef-m-item swiper-slide" data-index=<?php echo esc_attr($i); ?>>
                        <div class="qodef-m-item-inner">
                            <?php $k = 0; ?>
                            <?php foreach ($content as $contentItem) : ?>
                                <div class="qodef-m-item-<?php echo esc_attr($content[$k][0]); ?>-wrapper">
                                    <<?php echo esc_attr($content[$k][1]); ?> class="qodef-m-item-<?php echo esc_attr($content[$k][0]); ?>">
                                        <?php echo esc_attr($content[$k][2]); ?>
                                    </<?php echo esc_attr($content[$k][1]); ?>>
                                </div>
                                <?php $k++; ?>
                            <?php endforeach; ?>
                            <?php if(!empty($item['link']) ) : ?>
                                <div class="qodef-m-item-btn-wrapper">
                                    <?php
                                    $button_params = array(
                                        'link' => $item['link'],
                                        'target' => $item['target'],
                                        'button_layout' => 'minimal'
                                    );
                                    echo HendonCoreButtonShortcode::call_shortcode($button_params);
                                    ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="qodef-m-item-number-wrapper">
                            <span class="qodef-m-item-number">
                            <?php echo esc_attr($i); ?>
                            </span>
                        </div>
                    </div>
                    <?php $i++; ?>
                <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="qodef-m-indicators">
            <?php $n = 1; ?>
            <?php foreach ($items as $item) : ?>
                <span class="qodef-m-indicator" data-index=<?php echo esc_attr($n); ?>>
                    <svg class="qodef-svg-circle"><circle cx="50%" cy="50%" r="49%"></circle></svg>
                </span>
                <?php $n++; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>