<?php
if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}
/**
 * Server rendering for blocks - energetic-core-parts/team
 */

function ecp_render_block_team( $attributes, $content ) {

	$excerptLength = isset($attributes['excerptLength']) ? $attributes['excerptLength'] : 55;
	
	$columns = 'col-lg-12';
	if($attributes['columns'] == 2) {
		$columns = 'col-md-6 col-lg-6';
	} elseif($attributes['columns'] == 3) {
		$columns = 'col-md-6 col-lg-4';
	} elseif($attributes['columns'] == 4) {
		$columns = 'col-md-6 col-lg-3';
	}

	$backgroundColor = $attributes['postStyle'] == 'card-style' && $attributes['backgroundColor'] ? 'style="background-color:'. $attributes['backgroundColor']. ';"' : '';

	if($attributes['categories']) {
		$category_filter = array(
			array(
				'taxonomy' => 'member_category',
				'field'    => 'term_id',
				'terms'    => $attributes['categories'],
			)
		);
	} else {
		$category_filter = array();
	}

    $recent_posts = wp_get_recent_posts( array(
        'numberposts' => $attributes['postsToShow'],
		'post_status' => 'publish',
		'post_type' => 'team',
		'order'       => $attributes['order'],
		'orderby'     => $attributes['orderBy'],
		'tax_query' => $category_filter,
    ) );
	if ( empty( $recent_posts ) ) {
		return '<p>No posts</p>';
	}
	$list_items_markup = '';

	foreach ( $recent_posts as $post ) {
		
		$post_id = $post['ID'];

		$classes = join(' ', get_post_class( $columns . ' clearfix', $post_id));
		$list_items_markup .= sprintf(
			'<div id="post-%1$s" class="%2$s"> <div class="member-content %3$s">',
			$post_id,
			$classes,
			$attributes['postStyle']
		);

			//team author image
			if (has_post_thumbnail($post_id)) {
				$list_items_markup .= sprintf(
					'<div class="member-image">%1$s</div>',
					get_the_post_thumbnail($post_id)
				);
			}

			$list_items_markup .= sprintf('<div class="member-text" %1$s>',
			$backgroundColor
		);

				//team author name
				$list_items_markup .= sprintf(
					'<h5 class="member-name">%1$s</h5>',
					$post['post_title']
				);

					//team author role
					if($attributes['isCategories']) {

						$post_terms = wp_get_post_terms($post_id, 'member_category');
						if ($post_terms) {
							$list_items_markup .= sprintf('<div class="member-tag">');	
							foreach ($post_terms as $post_term) {
								$list_items_markup .= sprintf(
									'<span class="member-role">%1$s</span>',
									$post_term->name
								);
							}
							$list_items_markup .= sprintf('</div>');
						}

					}

					// team member Description
					if($attributes['isDescription']) {
						$list_items_markup .= sprintf(
							'<div>%1$s</div>',
							$post['post_content']
						);
					}

			$list_items_markup .= sprintf('</div>');
    
		$list_items_markup .= sprintf('</div></div>');
	}
 
	// Build the classes
	$class = 'wp-block-energetic-core-parts-team row team-members';
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
    $marginBottom = $attributes['marginBottom'] ? 'margin-bottom:' . $attributes['marginBottom'] . 'px;' : false;
    $backgroundColor = $attributes['backgroundColor'] ? 'background-color:' . $attributes['backgroundColor'] . ';' : false;
	$style = $paddingTop . $paddingBottom . $paddingLeft . $paddingRight . $marginTop . $marginBottom . $backgroundColor;
	
	// Output the post markup
	$block_content = sprintf(
		'<div class="%1$s" style="%2$s">%3$s</div>',
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
function ecp_register_block_team_block() {

	// Only load if Gutenberg is available.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}
	// Hook server side rendering into render callback
	register_block_type( 'energetic-core-parts/team', [
		'attributes' => array(
			'postStyle' => array(
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
			'postsToShow' => array(
				'type' => 'number',
				'default' => 3,
			),
			'categories'      => array(
				'type' => 'string',
                'default' => '',
			),
			'order' => array(
				'type' => 'string',
				'default' => 'desc',
			),
			'orderBy'  => array(
				'type' => 'string',
				'default' => 'date',
			),
			'columns' => array(
				'type' => 'number',
				'default' => 3,
			),
			'isCategories' => array(
				'type' => 'boolean',
				'default' => true,
			),
			'isDescription' => array(
				'type' => 'boolean',
				'default' => true,
			),
			'titleColor' => array(
				'type' => 'string',
                'default' => '',
			),
			'tagColor' => array(
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
		'render_callback' => 'ecp_render_block_team',
	] );

}
add_action( 'init', 'ecp_register_block_team_block' );