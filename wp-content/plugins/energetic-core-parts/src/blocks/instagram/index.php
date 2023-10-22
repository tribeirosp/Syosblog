<?php
if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}

/**
 * Server rendering for blocks - energetic-core-parts/instagram
 */

function ecp_render_block_instagram( $attributes, $content ) {

	$instagram_images = ecp_get_instagram_images( $attributes['username'],  $attributes['limit']);
 
	$list_items_markup = ' ';

	if ( ! empty( $instagram_images ) && ! isset($instagram_images->errors ) ) {

		$list_items_markup .= sprintf(
			'<div class="instagram-feed-wrap"><ul class="row small-gutters">'
		);

			foreach ( $instagram_images as $image ) {
				$list_items_markup .= sprintf(
					'<li class="col-4 mb-10px"><a target="_blank" href="%1$s"><img src="%2$s" alt="%3$s"/></a></li>',
					esc_url('http://instagram.com/p/' . $image['code']),
					esc_url($image['link']),
					esc_html($attributes['username'])
				);
			}

		$list_items_markup .= sprintf( '</ul>' );

		if($attributes['isFollowButton']) {
			
			$list_items_markup .= sprintf(
				'<a class="btn" target="_blank" href="%1$s">%2$s</a>',
				esc_url('http://instagram.com/' . $attributes['username']),
				esc_html($attributes['followButtonLabel'])
			);
		}
		
		$list_items_markup .= sprintf( '</div>' );
		
				
	} else {
		$list_items_markup .= sprintf(
			'%1$s',
			esc_html('Please check the block data', 'sada')
		);
	}

	// Build the classes
	$class = '';
	if ( isset( $attributes['className'] ) ) {
		$class .= ' ' . $attributes['className'];
	}
		
	// Output the post markup
	$block_content = sprintf(
		'<div class="%1$s">%2$s</div>',
		esc_attr( $class ),
		$list_items_markup
	);

	return $block_content;
}

/**
 * Register the dynamic block.
 *
 * @since 1.0
 *
 * @return void
 */
function ecp_register_block_instagram_block() {

	// Only load if Gutenberg is available.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}
	// Hook server side rendering into render callback
	register_block_type( 'energetic-core-parts/instagram', [
		'attributes' => array(
			'username' => array(
				'type' => 'string',
				'default' => 'energeticthemes',
			),
			'limit' => array(
				'type' => 'number',
				'default' => 6,
			),
			'isFollowButton' => array(
				'type' => 'boolean',
				'default' => false,
			),
			'followButtonLabel'      => array(
				'type' => 'string',
				'default' => 'Follow on instagram',
			)
		),
		'render_callback' => 'ecp_render_block_instagram',
	] );

}
add_action( 'init', 'ecp_register_block_instagram_block' );