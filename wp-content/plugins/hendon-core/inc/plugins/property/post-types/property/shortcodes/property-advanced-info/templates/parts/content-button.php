<div class="qodef-e-pai-content-button-holder">
    <?php
        $params = array(
            'button_layout' => 'outlined',
            'text' => esc_html__('Schedule', 'hendon-core'),
            'link' => get_the_permalink( $apartment_id ),
        );

        echo HendonCoreButtonShortcode::call_shortcode( $params );
    ?>
</div>