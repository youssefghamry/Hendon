<div class="qodef-e qodef-hierarchical-item">
    <div class="qodef-content-grid qodef-hierarchical-item-inner">
        <div class="qodef-e qodef-phi-category-info-holder">
            <div class="qodef-phi-category-name-holder">
                <<?php echo esc_attr( $categories_title_tag ); ?> class="qodef-phi-category-name"><?php echo esc_html( $tax_name ); ?></<?php echo esc_attr( $categories_title_tag ); ?>>
            </div>
            <div class="qodef-phi-category-description-holder">
                <?php echo wp_kses_post( term_description($tax_id) ); ?>
            </div>
        </div>

        <div <?php qode_framework_class_attribute( $grid_holder_classes ); ?>>
            <div class="qodef-grid-inner clear">
                <?php
                    $apartments = $this_object->getApartmentsByTaxonomyId( $tax_id );

                    if( is_array( $apartments ) && count( $apartments ) > 0 ){
                        foreach( $apartments as $apartment ){
                            $params['apartment_id'] = $apartment->ID;

                            $apartmentProperty = hendon_core_get_post_value_through_levels( 'qodef_apartment_property',  $params['apartment_id']);
                            if ($selected_projects === $apartmentProperty) { ?>

                            <div class="qodef-e qodef-grid-item qodef-apartment-item">

                                <?php echo hendon_core_get_template_part( 'plugins/property/post-types/property/shortcodes/property-hierarchical-info', 'templates/parts/image', '', $params ); ?>

                                <?php echo hendon_core_get_template_part( 'plugins/property/post-types/property/shortcodes/property-hierarchical-info', 'templates/parts/label', '', $params ); ?>

                                <?php echo hendon_core_get_template_part( 'plugins/property/post-types/property/shortcodes/property-hierarchical-info', 'templates/parts/title', '', $params ); ?>

                                <?php echo hendon_core_get_template_part( 'plugins/property/post-types/property/shortcodes/property-hierarchical-info', 'templates/parts/features', '', $params ); ?>

                            </div>

                        <?php }
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</div>