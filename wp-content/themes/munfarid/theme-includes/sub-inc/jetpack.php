<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 
 */

/**
 * Add JetPack support.
 */
function etmunfarid_etcodes_jetpack_setup() {

	/**
	 * Add support for JetPack Infinite scrolling.
	 *
	 * @see https://jetpack.com/support/infinite-scroll/
	 * @since Munfarid 1.0
	 */
	add_theme_support(
		'infinite-scroll', array(
			'container' => 'infinite-scroll-entries',
			'footer'    => false,
			'wrapper'   => false,
			'type'		=> 'click',
			'render'    => 'etmunfarid_etcodes_infinite_scroll',
		)
	);

}
add_action( 'after_setup_theme', 'etmunfarid_etcodes_jetpack_setup' );

/**
 * Custom Infinite Scroll Render function.
 */
function etmunfarid_etcodes_infinite_scroll() {

	while ( have_posts() ) { 
		the_post(); ?>
		<div class="<?php echo esc_attr(get_theme_mod( 'etmunfarid_etcodes_blog_post_layout_col', 'col-lg-12')); ?>">
        	<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>> <?php
			get_template_part( 'template-parts/post/content', get_post_format() ); ?>
			</article>
		</div> <?php	
	}

}

/**
 * Filter Jetpack's Infinite Scroll text on button that loads more posts.
 *
 * @param array $settings An array of settings for infinite scroll.
 */
function etmunfarid_etcodes_filter_jetpack_infinite_scroll_button_text( $settings ) {

	$text = apply_filters( 'etmunfarid_etcodes_infinite_scroll_button_text', esc_html__( 'Load More...', 'munfarid' ) );

	$settings['text'] = esc_html( $text );

	return $settings;
}
add_filter( 'infinite_scroll_js_settings', 'etmunfarid_etcodes_filter_jetpack_infinite_scroll_button_text' );

if ( ! function_exists( 'etmunfarid_etcodes_jetpack_sharing' ) ) :
	/**
	 * Jetpack's sharing module.
	 *
	 * Create your own etmunfarid_etcodes_jetpack_sharing() to override in a child theme.
	 */
	function etmunfarid_etcodes_jetpack_sharing() {

		if ( ! class_exists( 'Jetpack' ) ) {
			return;
		}

		if ( function_exists( 'sharing_display' ) ) :

			echo '<div class="container">';

			if ( function_exists( 'sharing_display' ) ) {
				sharing_display( '', true );
			}
			echo '</div>';

		endif;

	}
endif;
add_action( 'etmunfarid_etcodes_after_comments', 'etmunfarid_etcodes_jetpack_sharing' );
