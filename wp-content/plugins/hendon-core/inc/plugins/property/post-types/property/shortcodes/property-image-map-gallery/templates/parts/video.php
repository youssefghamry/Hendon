<?php if(!empty($video_link)) { ?>
    <div class="qodef-img-section qodef-img-video-inner">
        <?php
        $params = array(
            'video_link' => $video_link,
            'video_image'=> $video_image
        );

        echo HendonCoreVideoButton::call_shortcode( $params );
        ?>
    </div>
<?php } ?>