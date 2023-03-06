<?php

if ( is_array( $apartments ) && count( $apartments ) > 0 ) { ?>
    <ul class="qodef-tabs-navigation">
        <?php
            foreach( $apartments as $apartment ) { ?>
                <li>
                    <a href="#qodef-tab-<?php echo sanitize_title( get_the_title( $apartment->ID ) ) ?>"><?php echo esc_html( get_the_title( $apartment->ID ) ); ?></a>
                </li>
            <?php } ?>
    </ul>
<?php
} else {
    // Include global posts not found
    hendon_core_theme_template_part( 'content', 'templates/parts/posts-not-found' );
}
?>