<?php

if ( ! function_exists( 'hendon_left_side_fixed_body_class' ) ) {
    function hendon_left_side_fixed_body_class( $classes ) {

        if ( hendon_core_get_post_value_through_levels( 'qodef_left_fixed_area' ) === 'yes' ) {
            $classes[] = 'qodef-left-fixed-area-active';
        }
        return $classes;
    }
    add_filter( 'body_class', 'hendon_left_side_fixed_body_class' );
}

if ( ! function_exists( 'hendon_core_register_left_fixed_top_widget_area' ) ) {
    /**
     * Register side area sidebar
     */
    function hendon_core_register_left_fixed_top_widget_area() {

        register_sidebar(
            array(
                'id'            => 'qodef-left-fixed-top-area',
                'name'          => esc_html__( 'Left Fixed Area - Top', 'hendon-core' ),
                'description'   => esc_html__( 'Widgets added here will appear at the top of Left Fixed area', 'hendon-core' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s" data-area="left-fixed-area-top">',
                'after_widget'  => '</div>'
            )
        );
    }

    add_action( 'widgets_init', 'hendon_core_register_left_fixed_top_widget_area' );
}

if ( ! function_exists( 'hendon_core_register_left_fixed_bottom_widget_area' ) ) {
    /**
     * Register side area sidebar
     */
    function hendon_core_register_left_fixed_bottom_widget_area() {

        register_sidebar(
            array(
                'id'            => 'qodef-left-fixed-bottom-area',
                'name'          => esc_html__( 'Left Fixed Area - Bottom', 'hendon-core' ),
                'description'   => esc_html__( 'Widgets added here will appear at the bottom of Left Fixed area', 'hendon-core' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s" data-area="left-fixed-area-bottom">',
                'after_widget'  => '</div>'
            )
        );
    }

    add_action( 'widgets_init', 'hendon_core_register_left_fixed_bottom_widget_area' );
}

if ( ! function_exists( 'hendon_left_side_fixed' ) ) {
    function hendon_left_side_fixed() {

        if ( hendon_core_get_post_value_through_levels( 'qodef_left_fixed_area' ) === 'yes' ) { ?>

            <div id="qodef-left-fixed-area">
                <div class="qodef-left-fixed-area-inner">
                    <?php if ( is_active_sidebar( 'qodef-left-fixed-top-area' ) ) : ?>
                        <div class="qodef-left-fixed-top-area">
                            <?php dynamic_sidebar( 'qodef-left-fixed-top-area' ); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( is_active_sidebar( 'qodef-left-fixed-bottom-area' ) ) : ?>
                        <div class="qodef-left-fixed-bottom-area">
                            <?php dynamic_sidebar( 'qodef-left-fixed-bottom-area' ); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php
        }
    }
    add_action( 'hendon_action_left_fixed_area', 'hendon_left_side_fixed' );
}