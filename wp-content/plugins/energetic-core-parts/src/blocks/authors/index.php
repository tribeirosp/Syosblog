<?php
if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}
/**
 * Server rendering for blocks - energetic-core-parts/authors
 */

function ecp_render_block_authors( $attributes, $content ) {
	$entryStyle = $attributes['entryStyle'] == 'list-style' ? 'd-md-flex' : '';

	$columns = 'col-lg-12';
	if($attributes['columns'] == 2) {
		$columns = 'col-md-6 col-lg-6';
	} elseif($attributes['columns'] == 3) {
		$columns = 'col-md-6 col-lg-4';
	} elseif($attributes['columns'] == 4) {
		$columns = 'col-md-6 col-lg-3';
	}


	$number = $attributes['authorsToShow']; //max display per page
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; //current number of page
	$offset = ($paged - 1) * $number; //page offset
	$authors = get_users(array(
		'who' => 'authors'
	)); //get all the lists of authors 
	$args = array(
		'who' => 'authors',
		'offset' => $offset,
		'number' => $number
	);
	if(isset($attributes['isTopauthors']) && $attributes['isTopauthors']){
		$args['orderby'] = 'post_count';
		$args['order'] = 'desc';
		$authors['orderby'] = 'post_count';
		$authors['order'] = 'desc';
	}
	if(isset($attributes['authorsOffset']) && $attributes['authorsOffset']){
		$args['offset'] = $attributes['authorsOffset'];
		$authors['offset'] = $attributes['authorsOffset'];
	}
	$authors_query = get_users($args);//query the maximum authors that we will be displaying
	$total_authors = count($authors);//count total authors
	$total_query = count($authors_query);//count the maximum displayed authors 
	$total_pages = ($total_authors / $number); // get the total pages by dividing the total authors to the maximum numbers of user to be displayed //Check if the total pages has a decimal we will add + 1 page
	$total_pages = is_float($total_pages) ? intval($total_authors / $number) + 1 : intval($total_authors / $number);
	
	if ( empty( $authors_query ) ) {
		return '<p>No entry found.</p>';
	}
	$list_items_markup = '';

	foreach ( $authors_query as $key => $item ) {

		$list_items_markup .= sprintf(
			'<div class="%1$s clearfix">',
			$columns
		);
		
				$list_items_markup .= sprintf( '<div class="author-block  %1$s">', $entryStyle );
					if($attributes['isFeaturedImage']) {
						$list_items_markup .= sprintf( '<div class="author-img-box"><img src="%1$s" alt="%2$s"></div>',
							esc_html(get_avatar_url( $item->ID, array('size' => '550') )),
							esc_html($item->data->display_name)
						);
					}
					$list_items_markup .= sprintf( '<div class="author-block-textbody">' );
						$list_items_markup .= sprintf( '<h4 class="author-name-block"><a href="%1$s" title="%2$s">%2$s</a></h4>', 
							esc_url(get_author_posts_url( $item->ID )), 
							esc_html($item->data->display_name)
						);
						if($attributes['isDescription']){
							$list_items_markup .= sprintf( '<div class="author-block-bio">%1$s</div>', esc_html(get_the_author_meta( 'description', $item->ID )) );
						}

						$list_items_markup .= sprintf('<div class="author-block-meta ">');

							if($attributes['isPostCounts']){
								$PostCountText = isset($attributes['PostCountText']) ? $attributes['PostCountText'] : 'Post published';

								$list_items_markup .= sprintf( 
									'<div class="author-block-post-count">%2$s %1$s</div>', 
										esc_html(count_user_posts($item->ID, 'post', true)),
										esc_html($PostCountText .':')
									);
							}
							if($attributes['isAuthorWebsite']){
								$author_website = get_the_author_meta( 'user_url', $item->ID );
								$list_items_markup .= sprintf( 
									'<div class="author-block-website">%1$s <a href="%2$s">%3$s</a></div>',
										esc_html('Website: ', 'energetic-core-parts'),
										esc_url($author_website),
										esc_html(preg_replace("#^http(s)?://#","",$author_website))
										
									);
							}

						$list_items_markup .= sprintf('</div>');

					$list_items_markup .= sprintf('</div>');
				$list_items_markup .= sprintf('</div>');
	

		$list_items_markup .= sprintf('</div>');

	}
	$paginate_links = '';
	if ($total_authors > $total_query) {
		$paginate_links = sprintf('
		<nav class="navigation pagination"><div class="nav-links pagination">%1$s</div></nav>',
			paginate_links(array(  
				'prev_text'          => __('<'),
				'next_text'          => __('>'),
				'current'  => max( 1, get_query_var('paged') ),  
				'total'    => $total_pages
			))
		);
	}
	// Build the classes
	$class = 'wp-block-energetic-core-parts-authors ';
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
		'<div class="%1$s" style="%2$s"><div class="row">%3$s</div>%4$s</div>',
		esc_attr( $class ),
		$style,
		$list_items_markup,
		$paginate_links
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
function ecp_register_block_authors_block() {

	// Only load if Gutenberg is available.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}
	// Hook server side rendering into render callback
	register_block_type( 'energetic-core-parts/authors', [
		'attributes' => array(
			'entryStyle' => array(
                'type' => 'string',
                'default' => '',
			),
			'isTopauthors' => array(
                'type' => 'boolean',
                'default' => false,
			),
			'isPostCounts' => array(
                'type' => 'boolean',
                'default' => true,
			),
			'PostCountText' => array(
                'type' => 'string',
                'default' => 'Post published',
            ),
			'isAuthorWebsite' => array(
                'type' => 'boolean',
                'default' => true,
			),
			'isDescription' => array(
                'type' => 'boolean',
                'default' => true,
			),
            'isFeaturedImage' => array(
                'type' => 'boolean',
                'default' => true,
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
				'default' => '',
			),
			'authorsToShow' => array(
				'type' => 'number',
				'default' => 10,
			),
			'authorsOffset' => array(
				'type' => 'number',
			),
			'columns' => array(
				'type' => 'number',
				'default' => 2,
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
		'render_callback' => 'ecp_render_block_authors',
	] );

}
add_action( 'init', 'ecp_register_block_authors_block' );