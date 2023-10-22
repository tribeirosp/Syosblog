<?php
if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}
/**
 * Server rendering for blocks - energetic-core-parts/categories
 */

function ecp_render_block_categories( $attributes, $content ) {

	$excerptLength = isset($attributes['excerptLength']) ? $attributes['excerptLength'] : 55;
	$cardStyle = $attributes['cardStyle'] ? $attributes['cardStyle'] : 'boxed-style';
	$columns = 'col-lg-12';
	if($attributes['columns'] == 2) {
		$columns = 'col-md-6 col-lg-6';
	} elseif($attributes['columns'] == 3) {
		$columns = 'col-md-6 col-lg-4';
	} elseif($attributes['columns'] == 4) {
		$columns = 'col-md-6 col-lg-3';
	}

	$backgroundColor = $attributes['backgroundColor'] ? 'style="background-color:'. $attributes['backgroundColor']. ';"' : '';
	
	$args = array(
		'type' => 'post',
		'hide_empty' => 1,
		'number' => $attributes['categoriesToShow'],
		'taxonomy' => 'category',
	);

	if(isset($attributes['isTopCategories']) && $attributes['isTopCategories']){
		$args['orderby'] = 'count';
		$args['order'] = 'desc';
	}
	if(isset($attributes['categoriesOffset']) && $attributes['categoriesOffset']){
		$args['offset'] = $attributes['categoriesOffset'];
	}

	$categories = get_categories( $args );
	
	if ( empty( $categories ) ) {
		return '<p>No entry found.</p>';
	}
	$list_items_markup = '';

	foreach ( $categories as $key => $item ) {
	 
		$list_items_markup .= sprintf(
			'<div class="%1$s clearfix">',
			$columns
		);
			$image_id = get_term_meta ( $item->term_id, 'category-image-id', true );
			$devStyle = '';

			if($cardStyle == 'card-overlay-style') {
				
				$image_src = wp_get_attachment_image_src($image_id, $attributes['featuredImageSize']);
				$devStyle = $image_src && $image_src !== '' && $attributes['isFeaturedImage'] ? 'style="background-image:url( '. esc_attr( $image_src[0] ) .');" ' : '';
				$list_items_markup .= sprintf( '<div class="card" %1$s><a href="%2$s">', $devStyle, get_category_link($item->term_id) );
					$list_items_markup .= sprintf( '<div class="card-body">' );
						$list_items_markup .= sprintf( '<h4 class="card-title">%1$s %2$s</h4>', 
						$item->name,
						$attributes['isPostCounts'] ? '<span class="post-count">('.$item->count .')</span>' : ''
					);
					
						if($attributes['isDescription'] && $item->description !== ''){
							$list_items_markup .= sprintf( '<p class="card-text">%1$s</p>', $item->description );
						}
					$list_items_markup .= sprintf('</div>');
				$list_items_markup .= sprintf('</a></div>');

			} else {

				$list_items_markup .= sprintf( '<div class="card" %1$s>', $devStyle );
					if($image_id !== '' && $attributes['isFeaturedImage']) {
						$list_items_markup .= sprintf( '<div class="card-img-box"><a href="%1$s">%2$s</a></div>',
							get_category_link($item->term_id),
							wp_get_attachment_image($image_id, $attributes['featuredImageSize'])
						);
					}
					$list_items_markup .= sprintf( '<div class="card-body">' );
						$list_items_markup .= sprintf( '<h4 class="card-title"><a href="%1$s" title="%2$s">%2$s %3$s</a></h4>', 
							get_category_link($item->term_id), 
							$item->name,
							$attributes['isPostCounts'] ? '<span class="post-count">('.$item->count .')</span>' : ''
						);
						if($attributes['isDescription'] && $item->description !== ''){
							$list_items_markup .= sprintf( '<p class="card-text">%1$s</p>', $item->description );
						}
					$list_items_markup .= sprintf('</div>');
				$list_items_markup .= sprintf('</div>');
			}

		$list_items_markup .= sprintf('</div>');
	}
 
	// Build the classes
	$class = 'wp-block-energetic-core-parts-categories ' . $cardStyle;
	$class .= isset($attributes['align']) && $attributes['align'] == 'full' || $attributes['align'] == 'wide' ? ' align'. $attributes['align'] : '';

	if ( isset( $attributes['className'] ) ) {
		$class .= ' ' . $attributes['className'];
	}

    // Build custom style
    $paddingTop = $attributes['paddingTop'] ? 'padding-top:' . $attributes['paddingTop'] . 'px;' : false;
    $paddingBottom = $attributes['paddingBottom'] ? 'padding-bottom:' . $attributes['paddingBottom'] . 'px;' : false;
    $paddingLeft = $attributes['paddingLeft'] ? 'padding-left:' . $attributes['paddingLeft'] . 'px;' : false;
    $paddingRight = $attributes['paddingRight'] ? 'padding-right:' . $attributes['paddingRight'] . 'px;' : false;
    $marginTop = $attributes['marginTop'] ? 'margin-top:' . $attributes['marginTop'] . 'px;' : false;
    $marginBottom = $attributes['marginBottom'] ? 'margin-bottom:' . $attributes['marginBottom'] . 'px !important;' : false;
    $backgroundColor = $attributes['backgroundColor'] ? 'background-color:' . $attributes['backgroundColor'] . ';' : false;
	$style = $paddingTop . $paddingBottom . $paddingLeft . $paddingRight . $marginTop . $marginBottom . $backgroundColor;
	
	// Output the post markup
	$block_content = sprintf(
		'<div class="%1$s" style="%2$s"><div class="row">%3$s</div></div>',
		esc_attr( $class ),
		$style,
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
function ecp_register_block_categories_block() {

	// Only load if Gutenberg is available.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}
	// Hook server side rendering into render callback
	register_block_type( 'energetic-core-parts/categories', [
		'attributes' => array(
			'cardStyle' => array(
                'type' => 'string',
                'default' => 'boxed-style',
			),
			'isTopCategories' => array(
                'type' => 'boolean',
                'default' => false,
			),
			'isPostCounts' => array(
                'type' => 'boolean',
                'default' => false,
			),
			'isDescription' => array(
                'type' => 'boolean',
                'default' => true,
			),
            'isFeaturedImage' => array(
                'type' => 'boolean',
                'default' => true,
            ),
            'featuredImageSizelist' => array(
                'type' => 'object',
                'default' => ecp_get_image_sizes(),
			),
            'featuredImageSize' => array(
                'type' => 'string',
                'default' => '',
            ),
            'className' => array(
                'type' => 'string',
                'default' => '',
            ),
            'paddingTop' => array(
                'type' => 'number',
                'default' => '',
            ),
            'paddingBottom' => array(
                'type' => 'number',
                'default' => '',
            ),
            'paddingLeft' => array(
                'type' => 'number',
                'default' => '',
            ),
            'paddingRight' => array(
                'type' => 'number',
                'default' => '',
            ),
            'marginTop' => array(
                'type' => 'number',
                'default' => '',
            ),
            'marginBottom' => array(
                'type' => 'number',
                'default' => '',
            ),
            'backgroundColor' => array(
                'type' => 'string',
                'default' => '',
            ),
            'backgroundImage' => array(
                'type' => 'string',
                'source' => 'attribute',
                'attribute' => 'src',
                'selector' => 'img',
            ),
            'backgroundImageID' => array(
                'type' => 'number',
                'default' => '',
            ),
			'align' => array(
				'type' => 'string',
				'default' => 'wide',
			),
			'categoriesToShow' => array(
				'type' => 'number',
				'default' => 3,
			),
			'categoriesOffset' => array(
				'type' => 'number',
			),
			'columns' => array(
				'type' => 'number',
				'default' => 3,
			),
			'titleColor' => array(
				'type' => 'string',
                'default' => '',
			),
			'textColor' => array(
				'type' => 'string',
                'default' => '',
			),
			'backgroundColor' => array(
				'type' => 'string',
                'default' => '',
			),

		),
		'render_callback' => 'ecp_render_block_categories',
	] );

}
add_action( 'init', 'ecp_register_block_categories_block' );