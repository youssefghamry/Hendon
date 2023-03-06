<?php if ( ! post_password_required() && class_exists( 'HendonCoreButtonShortcode' ) ) { ?>
    <div class="qodef-e-read-more">
        <?php
        $button_params = array(
            'button_layout'  => 'textual',
            'link'           => get_the_permalink(),
            'text'           => esc_html__( 'View More', 'hendon-core' )
        );

        echo HendonCoreButtonShortcode::call_shortcode( $button_params ); ?>
    </div>
<?php } ?>