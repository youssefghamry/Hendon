<article <?php post_class( $item_classes ); ?>>
    <div class="qodef-e-inner">
        <div class="qodef-e-image">
            <?php hendon_core_list_sc_template_part( 'plugins/property/post-types/property/shortcodes/property-list', 'post-info/image', '', $params ); ?>
        </div>
        <div class="qodef-e-content">
            <div class="qodef-e-content-inner">
            <?php hendon_core_list_sc_template_part( 'plugins/property/post-types/property/shortcodes/property-list', 'post-info/title', '', $params ); ?>
            <?php hendon_core_list_sc_template_part( 'plugins/property/post-types/property/shortcodes/property-list', 'post-info/excerpt', '', $params ); ?>
            <?php hendon_core_list_sc_template_part( 'plugins/property/post-types/property/shortcodes/property-list', 'post-info/read-more', '', $params ); ?>
            </div>
        </div>
    </div>
</article>