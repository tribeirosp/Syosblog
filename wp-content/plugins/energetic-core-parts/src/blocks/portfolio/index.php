<?php
if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}

/**
 * Server rendering for blocks - energetic-core-parts/portfolio
 */

function ecp_render_block_portfolio($attributes, $content)
{

    // Dynmaic post style list
        
	if(has_filter('ecp_render_block_portfolio_data')) {
        $block_post_data = apply_filters('ecp_render_block_portfolio_data', $attributes);
        return $block_post_data;
    }

    $excerptLength = isset($attributes['excerptLength']) ? $attributes['excerptLength'] : 55;
    $columns = 'col-lg-12';
    if (isset($attributes['columns']) && $attributes['postLayout'] === 'grid') {
        if ($attributes['columns'] == 2) {
            $columns = 'col-lg-6';
        } elseif ($attributes['columns'] == 3) {
            $columns = 'col-lg-4';
        } elseif ($attributes['columns'] == 4) {
            $columns = 'col-lg-3';
        }
    }
    
    if (!function_exists( 'post_featured_image')) {
        function post_featured_image($post_id, $featuredImageSize) {
            
            if (has_post_thumbnail($post_id)) {
                return sprintf(
                    '<div class="entry-media"><a href="%1$s" rel="bookmark">%2$s</a></div>',
                    esc_url(get_permalink($post_id)),
                    get_the_post_thumbnail($post_id, $featuredImageSize)
                );
            }
        }
    }

    $date_query = array();
    if ($attributes['duration'] != '') {
        $days = (int) $attributes['duration'];
        $time = time() - ($days * 24 * 60 * 60);
        $date_query = array(
            'after' => date('F jS, Y', $time),
            'before' => date('F jS, Y'),
            'inclusive' => true,
        );
    }
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    if ($attributes['postListType'] == 'recent') {
        $args = array(
            'post_type' => 'portfolio',
            'offset'         => 0,
            'post_status' => 'publish',
            'orderby' => $attributes['orderBy'],
            'order' => $attributes['order'],
            'category' => $attributes['categories'],
            'numberposts' => $attributes['postsToShow'],
            'date_query' => $date_query,
        );
    } elseif ($attributes['postListType'] == 'popular') {
        $args = array(
            'post_type' => 'portfolio',
            'post_status' => 'publish',
            'orderby' => 'meta_value',
            'meta_key' => 'ecp_post_views',
            'order' => $attributes['order'],
            'category' => $attributes['categories'],
            'numberposts' => $attributes['postsToShow'],
            'date_query' => $date_query,
        );
    } elseif ($attributes['postListType'] == 'commented') {
        $args = array(
            'post_type' => 'portfolio',
            'post_status' => 'publish',
            'orderby' => 'comment_count',
            'order' => $attributes['order'],
            'category' => $attributes['categories'],
            'numberposts' => $attributes['postsToShow'],
            'date_query' => $date_query,
        );
    } else {
        $args = array(
            'post_type' => 'portfolio',
            'numberposts' => $attributes['postsToShow'],
            'post_status' => 'publish',
            'order' => $attributes['order'],
            'orderby' => $attributes['orderBy'],
            'category' => $attributes['categories'],
        );
    }

    $recent_portfolio = wp_get_recent_posts($args);

    if (empty($recent_portfolio)) {
        return '<p>No Project found.</p>';
    }

    $list_items_markup = '';

    foreach ($recent_portfolio as $post) {

        $post_id = $post['ID'];
        $post_format = get_post_format($post_id);

        $classes = join(' ', get_post_class('clearfix', $post_id));
        $list_items_markup .= sprintf(
            '<div class="%1$s"><article id="post-%2$s" class="%3$s">',
            $columns,
            $post_id,
            $classes
        );

        if ($attributes['isFeaturedImage']) {
            
            $list_items_markup .= post_featured_image($post_id, $attributes['featuredImageSize']);
            
        }


        // entry-content-wrapper
        $list_items_markup .= sprintf('<div class="entry-content-wrapper">');

        // Title
        if (get_the_title($post_id) != '') {
            $list_items_markup .= sprintf(
                '<h4 class="entry-title"><a href="%1$s">%2$s</a></h4>',
                esc_url(get_permalink($post_id)),
                esc_html(get_the_title($post_id))
            );
        } else {
            $list_items_markup .= sprintf(
                '<h4 class="entry-title"><a href="%1$s">%2$s</a></h4>',
                esc_url(get_permalink($post_id)),
                esc_html('Permalink to the post', 'energetic-core-parts')
            );
        }

        // Post top meta
        $list_items_markup .= sprintf('<div class="entry-meta-top">');
            // Categories
            if (isset($attributes['isCategories']) && $attributes['isCategories']) {
                $list_items_markup .= sprintf(
                    '<span class="entry-meta-category">%1$s</span>',
                    get_the_term_list($post_id, 'portfolio_category', '', ', ', '')
                );
            }
        // Close Post top meta
        $list_items_markup .= sprintf('</div>');


        // Close entry-content-wrapper
        $list_items_markup .= sprintf('</div>');

        $list_items_markup .= sprintf('</article></div>');
    }

    if($attributes['isMorePortfolioBtn']) {
        $list_items_markup .= sprintf(
            '<div class="text-center w-100"><a class="btn" href="%1$s"> %2$s <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></div>',
            esc_url($attributes['morePortfolioBtnURL']),
            esc_html($attributes['morePortfolioBtnLable'])
        );
    }
    

    // Build the classes
    $class = 'energetic-core-parts-portfolio ';
    $class .= isset($attributes['align']) && $attributes['align'] == 'full' ? 'container-fluid' : 'container';

    if (isset($attributes['className'])) {
        $class .= ' ' . $attributes['className'];
    }
    $class .= isset($attributes['align']) && $attributes['align'] == 'full' || $attributes['align'] == 'wide' ? ' align'. $attributes['align'] : '';
    
    $grid_class = 'row blog-post portfolio-items';
    if (isset($attributes['postLayout']) && 'list' === $attributes['postLayout']) {
        $grid_class .= ' is-list';
    } else {
        $grid_class .= ' is-grid';
    }
    $grid_class .= isset($attributes['portfolioStyle']) ? ' ' . $attributes['portfolioStyle'] : ' stander-post-style';

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
        '<div class="%1$s" style="%2$s"><div class="%3$s">%4$s</div></div>',
        esc_attr($class),
        $style,
        esc_attr($grid_class),
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
function ecp_register_block_portfolio_block()
{

    // Only load if Gutenberg is available.
    if (!function_exists('register_block_type')) {
        return;
    }

    // Dynmaic portfolio style list
	$portfolioStyleList = array(
		array( 'value' => 'stander-portfolio-style', 'label' => 'Stander portfolio Style')
	);
	if(has_filter('ecp_portfolio_style_list_filter')) {
		$portfolioStyleList = apply_filters('ecp_portfolio_style_list_filter', $portfolioStyleList);
    }



    // Hook server side rendering into render callback
    register_block_type('energetic-core-parts/portfolio', [
        'attributes' => array(
            'portfolioStyle' => array(
                'type' => 'string',
                'default' => '',
            ),
            'postsToShow' => array(
                'type' => 'number',
                'default' => 3,
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
            'isCategories' => array(
                'type' => 'boolean',
                'default' => true,
            ),
            'isCommentsCounter' => array(
                'type' => 'boolean',
                'default' => false,
            ),
            'isMorePortfolioBtn' => array(
                'type' => 'boolean',
                'default' => true,
            ),
            'morePortfolioBtnLable' => array(
                'type' => 'string',
                'default' => 'More Projects',
            ),
            'morePortfolioBtnURL' => array(
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

            'postLayout' => array(
                'type' => 'string',
                'default' => 'grid',
            ),
            'columns' => array(
                'type' => 'number',
                'default' => 2,
            ),
            'align' => array(
                'type' => 'string',
                'default' => '',
            ),
            'width' => array(
                'type' => 'string',
                'default' => 'wide',
            ),
            'categories' => array(
                'type' => 'string',
                'default' => '',
            ),
            'order' => array(
                'type' => 'string',
                'default' => 'desc',
            ),
            'orderBy' => array(
                'type' => 'string',
                'default' => 'date',
            ),
            'postListType' => array(
                'type' => 'string',
                'default' => 'recent',
            ),
            'duration' => array(
                'type' => 'string',
                'default' => '',
            ),
            'portfolioStyleList' => array(
                'type' => 'object',
                'default' => $portfolioStyleList,
            ),

        ),
        'render_callback' => 'ecp_render_block_portfolio',
    ]);

}
add_action( 'init', 'ecp_register_block_portfolio_block' );