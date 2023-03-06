<article <?php post_class( 'qodef-e' ); ?>>
    <div class="qodef-e-inner qodef-phi-inner">
        <?php
            if( is_array( $tax_array ) && count( $tax_array ) > 0 ){
                foreach ( $tax_array as $tax_id => $tax_name ){
                    $params['tax_id'] = $tax_id;
                    $params['tax_name'] = $tax_name;
                    echo hendon_core_get_template_part('plugins/property/post-types/property/shortcodes/property-hierarchical-info', 'templates/parts/hierarchical-item', '', $params);
                }
            }
        ?>
    </div>
</article>