<?php
/**
 * The template for the sidebar containing the main widget area
 */
?>
<?php if ( is_active_sidebar( 'etmunfarid_etcodes_page_sidebar' )  ) : ?>
	<div class="sidebar">
		<?php dynamic_sidebar( 'etmunfarid_etcodes_page_sidebar' ); ?>
	</div><!-- .sidebar .widget-area -->
<?php endif; ?>