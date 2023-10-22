<?php
if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}

/**
 * Server rendering for blocks - energetic-core-parts/posts
 */

function ecp_render_block_posts_carousel($attributes, $content)
{
    
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

    if ($attributes['postListType'] == 'recent') {
        $args = array(
            'post_status' => 'publish',
            'orderby' => $attributes['orderBy'],
            'order' => $attributes['order'],
            'category' => isset($attributes['categories']) ? $attributes['categories'] : 0,
            'numberposts' => $attributes['postsToShow'],
            'date_query' => $date_query,
        );
    } elseif ($attributes['postListType'] == 'popular') {
        $args = array(
            'post_status' => 'publish',
            'orderby' => 'meta_value',
            'meta_key' => 'ecp_post_views',
            'order' => $attributes['order'],
            'category' => isset($attributes['categories']) ? $attributes['categories'] : 0,
            'numberposts' => $attributes['postsToShow'],
            'date_query' => $date_query,
        );
    } elseif ($attributes['postListType'] == 'commented') {
        $args = array(
            'post_status' => 'publish',
            'orderby' => 'comment_count',
            'order' => $attributes['order'],
            'category' => isset($attributes['categories']) ? $attributes['categories'] : 0,
            'numberposts' => $attributes['postsToShow'],
            'date_query' => $date_query,
        );
    } else {
        $args = array(
            'numberposts' => $attributes['postsToShow'],
            'post_status' => 'publish',
            'order' => $attributes['order'],
            'orderby' => $attributes['orderBy'],
            'category' => $attributes['categories'],
        );
    }

    $excerptLength = isset($attributes['excerptLength']) ? $attributes['excerptLength'] : 55;
    $recent_posts = wp_get_recent_posts($args);
    $thumbnailSize = '';
    $i = 1;

    
    if (empty($recent_posts)) {
        return '<p>No posts</p>';
    }

    $list_items_markup = $hash_nav_items_markup_wrap = $hash_nav_items_markup = '';

    foreach ($recent_posts as $post) {
        $post_id = $post['ID'];
        'carousel-item-' . $count = $i++;
        $list_items_markup .= sprintf('<article>',
            $count
        );

            if ($attributes['isFeaturedImage']) {
                // Item image
                if(get_the_post_thumbnail($post_id, $attributes['featuredImageSize'])) {
                    $list_items_markup .= sprintf(
                        '<div class="entry-media">%1$s</div>',
                        get_the_post_thumbnail($post_id, $attributes['featuredImageSize'])
                    );
                } else {
                    $list_items_markup .= sprintf(
                        '<div class="entry-media placeholder"></div>'
                    );
                }
            }
 
            // entry-content-wrapper
            $list_items_markup .= sprintf('<div class="entry-content-wrapper">');

            // Post top meta
            $list_items_markup .= sprintf('<div class="entry-meta-top">');
                // Author
                if (isset($attributes['isAuthor']) && $attributes['isAuthor']) {
                $list_items_markup .= sprintf(
                    '<span class="post_meta_author">%1$s<a href="%2$s">%3$s</a></span>',
                    esc_html('By ', 'energetic-core-parts'),
                    esc_html(get_author_posts_url($post['post_author'])),
                    esc_html(get_the_author_meta('display_name', $post['post_author']))

                );
                }
                // Date
                if (isset($attributes['isDate']) && $attributes['isDate']) {
                $list_items_markup .= sprintf(
                    '<span class="entry-meta-data">%1$s</span>',
                    esc_html(get_the_date('', $post_id))
                );
                }
                // Categories
                if (isset($attributes['isCategories']) && $attributes['isCategories']) {
                $list_items_markup .= sprintf(
                    '<span class="entry-meta-category">%1$s</span>',
                    get_the_category_list('&nbsp;', '', $post_id)
                );
                }
                // Comments Counter
                if (isset($attributes['isCommentsCounter']) && $attributes['isCommentsCounter']) {
                $comment_count = $post['comment_count'] <= 1 ? $post['comment_count'] . esc_html__(' Comment', 'energetic-core-parts') : $post['comment_count'] . esc_html__(' Comments', 'energetic-core-parts');
                $list_items_markup .= sprintf(
                    '<span class="isCommentsCounter">%1$s</span>',
                    esc_html($comment_count)
                );
                }
            // Close Post top meta
            $list_items_markup .= sprintf('</div>');

            // Post Title
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

            // Get the post excerpt
            if (isset($attributes['isExcerpt']) && $attributes['isExcerpt']) {
                $excerpt = apply_filters('the_excerpt', wp_trim_words(get_post_field('post_excerpt', $post_id, 'display'), $excerptLength));
                if (empty($excerpt)) {
                    $excerpt = apply_filters('the_excerpt', wp_trim_words($post['post_content'], $excerptLength));
                }
                if ($excerpt !== '') {
                    $list_items_markup .= sprintf('<div class="entry-content">%1$s</div>', wp_kses_post($excerpt));
                }
            }
            // Read More button
            if (isset($attributes['isReadMore']) && $attributes['isReadMore']) {
                $readMoreText = isset($attributes['readMoreText']) ? $attributes['readMoreText'] : 'Read More';
                $list_items_markup .= sprintf(
                    '<a class="entry-read-more" href="%1$s">%2$s <i class="fas fa-long-arrow-alt-right ml-1" aria-hidden="true"></i></a>',
                    esc_url(get_permalink($post_id)),
                    esc_html($readMoreText)
                );
            }
            // close post text
            $list_items_markup .= sprintf('</div>');

    
            // Nav items
            $hash_nav_items_markup .= sprintf('<li>');
                // Post Title
                if (get_the_title($post_id) != '') {
                    $hash_nav_items_markup .= sprintf(
                        '<h4 class="carousel-nav-title"><a id="%1$s" href="#" class="%3$s" data-slide="%2$s">%4$s</a></h4>',
                        'goto-' . $count,
                        $count,
                        $hashclasses = $count == 1 ? 'active' : '',
                        esc_html(get_the_title($post_id))
                    );
                } else {
                    $hash_nav_items_markup .= sprintf(
                        '<h4 class="carousel-nav-title"><a id="%1$s" href="#%2$s" class="%3$s" data-slide="%2$s">%4$s</a></h4>',
                        'goto-' . $count,
                        $count,
                        $hashclasses = $count == 1 ? 'active' : '',
                        esc_html('Permalink to the post', 'energetic-core-parts')
                    );
                }
                // Post top meta
                $hash_nav_items_markup .= sprintf('<div class="entry-meta-top">');
                    // Author
                    if (isset($attributes['isAuthor']) && $attributes['isAuthor']) {
                        $hash_nav_items_markup .= sprintf(
                            '<span class="post_meta_author">%1$s<a href="%2$s">%3$s</a></span>',
                            esc_html('By ', 'energetic-core-parts'),
                            esc_html(get_author_posts_url($post['post_author'])),
                            esc_html(get_the_author_meta('display_name', $post['post_author']))

                        );
                    }
                    // Date
                    if (isset($attributes['isDate']) && $attributes['isDate']) {
                        $hash_nav_items_markup .= sprintf(
                            '<span class="entry-meta-data">%1$s</span>',
                            esc_html(get_the_date('', $post_id))
                        );
                    }
                    // Categories
                    if (isset($attributes['isCategories']) && $attributes['isCategories']) {
                        $hash_nav_items_markup .= sprintf(
                            '<span class="entry-meta-category">%1$s</span>',
                            get_the_category_list('&nbsp;', '', $post_id)
                        );
                    }
                    // Comments Counter
                    if (isset($attributes['isCommentsCounter']) && $attributes['isCommentsCounter']) {
                        $comment_count = $post['comment_count'] <= 1 ? $post['comment_count'] . esc_html__(' Comment', 'energetic-core-parts') : $post['comment_count'] . esc_html__(' Comments', 'energetic-core-parts');
                        $hash_nav_items_markup .= sprintf(
                            '<span class="isCommentsCounter">%1$s</span>',
                            esc_html($comment_count)
                        );
                    }
                // Close Post top meta
                $hash_nav_items_markup .= sprintf('</div>');
            // Close </li>
            $hash_nav_items_markup .= sprintf('</li>'); 
      

        // close owl-carousel-item
        $list_items_markup .= sprintf('</article>');
    }

    if (has_filter('post_carousel_filter')) {
        $list_items_markup = apply_filters('post_carousel_filter', $attributes);
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

    // Build the classes
    $class = 'energetic-core-parts-posts-carousel';

    $class .= isset($attributes['align']) && $attributes['align'] == 'full' || $attributes['align'] == 'wide' ? ' align'. $attributes['align'] : '';

    $carousel_class = 'slider-call entry-carousel blog-post blog-slider ' . $attributes['postStyle'];

    if (isset($attributes['className'])) {
        $class .= ' ' . $attributes['className'];
    }

    // sada-carousel-style-one
    if ($attributes['postStyle'] == 'sada-carousel-style-one') {
        // hash nav
        $hash_nav_items_markup_wrap = sprintf('<ul class="sada-carousel-style-one-nav">%1$s</ul>', $hash_nav_items_markup);
        $class .= ' sada-carousel-style-one-container';
    }
    
    $data_slick = '{
        &quot;arrows&quot;:' . esc_js($attributes['isNav'] ? 'true' : 'false') . ',
        &quot;dots&quot;:' . esc_js($attributes['isDots'] ? 'true' : 'false') . ',
        &quot;slidesToShow&quot;:' . esc_js($attributes['perSlideItems']) . ',
        &quot;infinite&quot;:' . esc_js($attributes['isLoop'] ? 'true' : 'false') . ',
        &quot;speed&quot;:' . esc_js($attributes['smartSpeed']) . ',
        &quot;autoplay&quot;:' . esc_js($attributes['isAutoplay'] ? 'true' : 'false') . ',
        &quot;autoplaySpeed&quot;:' . esc_js($attributes['autoplayTimeout']) . ',
        &quot;variableWidth&quot;:' . esc_js($attributes['isVariableWidth'] ? 'true' : 'false') . ',
        &quot;adaptiveHeight&quot;:true
        
    }';

    // blog-slider-munfarid-1
    if ($attributes['postStyle'] == 'blog-slider-munfarid-1') {
        $data_slick = '{
            &quot;arrows&quot;:' . esc_js($attributes['isNav'] ? 'true' : 'false') . ',
            &quot;dots&quot;:' . esc_js($attributes['isDots'] ? 'true' : 'false') . ',
            &quot;slidesToShow&quot;:' . esc_js($attributes['perSlideItems']) . ',
            &quot;infinite&quot;:' . esc_js($attributes['isLoop'] ? 'true' : 'false') . ',
            &quot;speed&quot;:' . esc_js($attributes['smartSpeed']) . ',
            &quot;autoplay&quot;:' . esc_js($attributes['isAutoplay'] ? 'true' : 'false') . ',
            &quot;autoplaySpeed&quot;:' . esc_js($attributes['autoplayTimeout']) . ',
            &quot;variableWidth&quot;: true,
            &quot;responsive&quot;: [{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;variableWidth&quot;: false,&quot;variableWidth&quot;: false}}] 
        }';
    }

    // Output the post markup
    return $block_content = sprintf(
        '<div class="%1$s" style="%2$s"><div class="energetic-core-parts-posts-carousel-inner">
            <div class="%4$s" data-slick="%3$s">%5$s</div>%6$s</div>
        </div>',
        esc_attr($class),
        $style,
        $data_slick,
        esc_attr($carousel_class),
        $list_items_markup,
        $hash_nav_items_markup_wrap
    );
      
}

/**
 * Register the dynamic block.
 *
 * @since 1.0
 *
 * @return void
 */
function ecp_register_block_posts_carousel_block()
{

    // Only load if Gutenberg is available.
    if (!function_exists('register_block_type')) {
        return;
    }

    $current_theme = wp_get_theme();
    // Posts carousel style list
    $postsCarouselStyleList = array(
        array('value' => 'card-post-carousel-style', 'label' => 'Card Carousel Post'),
    );
    
	if(has_filter('ecp_post_carousel_style_list_filter')) {
		$postsCarouselStyleList = apply_filters('ecp_post_carousel_style_list_filter', $postsCarouselStyleList);
    }

    // Hook server side rendering into render callback
    register_block_type('energetic-core-parts/posts-carousel', [
        'attributes' => array(
            'className' => array(
                'type' => 'string',
                'default' => '',
            ),
			'testimonialID' => array(
				'type' => 'string',
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
            'postStyle' => array(
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
            'isAuthor' => array(
                'type' => 'boolean',
                'default' => false,
            ),
            'isDate' => array(
                'type' => 'boolean',
                'default' => false,
            ),
            'isCategories' => array(
                'type' => 'boolean',
                'default' => true,
            ),
            'isCommentsCounter' => array(
                'type' => 'boolean',
                'default' => false,
            ),
            'isExcerpt' => array(
                'type' => 'boolean',
                'default' => true,
            ),
            'excerptLength' => array(
                'type' => 'number',
                'default' => 55,
            ),
            'isReadMore' => array(
                'type' => 'boolean',
                'default' => true,
            ),
            'readMoreText' => array(
                'type' => 'string',
                'default' => 'Read More',
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
                'default' => 'wide',
            ),
            'width' => array(
                'type' => 'string',
                'default' => 'wide',
            ),
            'categories' => array(
                'type' => 'string',
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
            'postStyleList' => array(
                'type' => 'object',
                'default' => $postsCarouselStyleList,
            ),
            'isNav' => array(
                'type' => 'boolean',
                'default' => true,
            ),
            'isDots' => array(
                'type' => 'boolean',
                'default' => true,
            ),
            'isVariableWidth' => array(
                'type' => 'boolean',
                'default' => false,
            ),
            'perSlideItems' => array(
                'type' => 'number',
                'default' => 1,
            ),
            'isLoop' => array(
                'type' => 'boolean',
                'default' => true,
            ),
            'smartSpeed' => array(
                'type' => 'number',
                'default' => 1000,
            ),
            'isAutoplay' => array(
                'type' => 'boolean',
                'default' => true,
            ),
            'autoplayTimeout' => array(
                'type' => 'number',
                'default' => 10000,
            ),

        ),
        'render_callback' => 'ecp_render_block_posts_carousel',
    ]);

}
add_action( 'init', 'ecp_register_block_posts_carousel_block' );
