<div class="qodef-header-sticky">
    <div class="qodef-header-sticky-inner <?php echo apply_filters( 'hendon_filter_header_inner_class', '' ); ?>">
		<?php
		
		// Include logo
		hendon_core_get_header_logo_image( array( 'sticky_logo' => true ) );
		
		// Include main navigation
		hendon_core_template_part( 'header', 'templates/parts/navigation', '', array( 'menu_id' => 'qodef-sticky-navigation-menu' ) );
		
		// Include widget area one
		if ( is_active_sidebar( 'qodef-sticky-header-widget-area-one' ) ) { ?>
	    <div class="qodef-widget-holder">
		    <?php hendon_core_get_header_widget_area('sticky'); ?>
	    </div>
	    <?php }

		do_action( 'hendon_core_action_after_sticky_header' ); ?>
    </div>
</div>