<?php if( !empty($video_link) || !empty($video_link_360)) { ?>
    <ul class="qodef-map-navigation">
        <li class="qodef-map-nav-item qodef-active-map active">
            <span class="qodef-map-nav-item-text"><?php echo esc_html__('Photos', 'hendon-core') ?></span>
        </li>
        <?php if(!empty($video_link)) { ?>
            <li class="qodef-map-nav-item qodef-inactive-map">
                <span class="qodef-map-nav-item-text"><?php echo esc_html__('Video', 'hendon-core') ?></span>
            </li>
        <?php } ?>
        <?php if(!empty($video_link_360)) { ?>
            <li class="qodef-map-nav-item qodef-inactive-map">
                <span class="qodef-map-nav-item-text"><?php echo esc_html__('360 Video', 'hendon-core') ?></span>
            </li>
        <?php } ?>
    </ul>
<?php } ?>