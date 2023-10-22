<?php if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}
/***********************************************************************************************/
/* Template for the none post*/
/***********************************************************************************************/
?>
<header class="page-header">
	<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'munfarid' ); ?></h1>
</header>
<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
	<p><?php printf( esc_html__( 'Ready to publish your first post? <a class="dynamic_load"  href="%1$s">Get started here</a>.', 'munfarid' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
<?php elseif ( is_search() ) : ?>
	<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'munfarid' ); ?></p>
	<?php get_search_form(); ?>
<?php else : ?>
	<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'munfarid' ); ?></p>
	<?php get_search_form(); ?>
<?php endif; ?>