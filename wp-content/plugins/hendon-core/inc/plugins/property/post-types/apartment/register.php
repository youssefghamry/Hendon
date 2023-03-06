<?php

if ( ! function_exists( 'hendon_core_register_apartment_for_meta_options' ) ) {
    function hendon_core_register_apartment_for_meta_options( $post_types ) {
        $post_types[] = 'apartment-item';

        return $post_types;
    }

    add_filter( 'qode_framework_filter_meta_box_save', 'hendon_core_register_apartment_for_meta_options' );
    add_filter( 'qode_framework_filter_meta_box_remove', 'hendon_core_register_apartment_for_meta_options' );
}

if ( ! function_exists( 'hendon_core_add_apartment_custom_post_type' ) ) {
    /**
     * Function that adds custom post type
     *
     * @param array $cpts
     *
     * @return array
     */
    function hendon_core_add_apartment_custom_post_type( $cpts ) {
        $cpts[] = 'HendonCoreApartmentCPT';

        return $cpts;
    }

    add_filter( 'hendon_core_filter_register_custom_post_types', 'hendon_core_add_apartment_custom_post_type' );
}

if ( class_exists( 'QodeFrameworkCustomPostType' ) ) {
    class HendonCoreApartmentCPT extends QodeFrameworkCustomPostType {

        public function map_post_type() {
            $name = esc_html__( 'Apartment', 'hendon-core' );
            $this->set_base( 'apartment-item' );
            $this->set_menu_position( 5 );
            $this->set_menu_icon( 'dashicons-tide' );
            $this->set_slug( 'apartment-item' );
            $this->set_name( $name );
            $this->set_show_in_menu('edit.php?post_type=property-item');
            $this->set_path( HENDON_CORE_PLUGINS_PATH . '/property/post-types/apartment' );
            $this->set_labels( array(
                'name'          => esc_html__( 'Hendon Apartment', 'hendon-core' ),
                'singular_name' => esc_html__( 'Apartment Item', 'hendon-core' ),
                'add_item'      => esc_html__( 'New Apartment Item', 'hendon-core' ),
                'add_new_item'  => esc_html__( 'Add New Apartment Item', 'hendon-core' ),
                'edit_item'     => esc_html__( 'Edit Apartment Item', 'hendon-core' )
            ) );
            $this->set_supports( array(
                'author',
                'title',
                'editor',
                'thumbnail',
                'excerpt',
                'page-attributes',
                'comments'
            ) );

            $this->add_post_taxonomy( array(
                'base'          => 'apartment-category',
                'slug'          => 'apartment-category',
                'show_in_menu'  => false,
                'singular_name' => esc_html__( 'Category', 'hendon-core' ),
                'plural_name'   => esc_html__( 'Categories', 'hendon-core' ),
            ) );
        }
    }
}