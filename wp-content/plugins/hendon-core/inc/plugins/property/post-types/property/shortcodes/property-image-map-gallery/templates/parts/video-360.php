<?php if(!empty($video_link_360)) { ?>
    <div class="qodef-img-section qodef-img-360-video-inner">
        <?php
        $params = array(
            'video_link' => $video_link_360,
            'video_image'=> $video_image_360
        );

        echo HendonCoreVideoButton::call_shortcode( $params );
        ?>
    </div>
<?php } ?>