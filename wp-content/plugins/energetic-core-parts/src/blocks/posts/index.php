<?php
if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}

/**
 * Server rendering for blocks - energetic-core-parts/posts
 */

function ecp_render_block_post($attributes, $content)
{

    // Dynmaic post style list
        
	if(has_filter('ecp_render_block_post_data')) {
        $block_post_data = apply_filters('ecp_render_block_post_data', $attributes);
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
            'post_status' => 'publish',
            'orderby' => 'comment_count',
            'order' => $attributes['order'],
            'category' => $attributes['categories'],
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

    $recent_posts = wp_get_recent_posts($args);

    if (empty($recent_posts)) {
        return '<p>No posts</p>';
    }

    $list_items_markup = '';

    foreach ($recent_posts as $post) {

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

            $featuredImageSize = $attributes['featuredImageSize'];

            if ($post_format == 'audio') {

                $content = apply_filters('the_content', $post['post_content']);
                $audio = false;
                if (false === strpos($content, 'wp-playlist-script')) {
                    $audio = get_media_embedded_in_content($content, array('audio', 'object', 'embed', 'iframe'));
                }
                if (!empty($audio)) {
                    $list_items_markup .= sprintf('<div class="entry-media">');
                    foreach ($audio as $audio_html) {
                        $list_items_markup .= sprintf('%1$s', $audio_html);
                    }
                    $list_items_markup .= sprintf('</div>');
                } else {
                    $list_items_markup .= post_featured_image($post_id, $featuredImageSize);
                }

            } elseif ($post_format == 'gallery') {

                $gallery = false;
                if (get_post_gallery()) {
                $gallery = get_post_gallery();
                } else {
                    if (preg_match('/<!-- wp:gallery -->(.*?)<!-- \/wp:gallery -->/is', $post['post_content'], $matches)) {
                        if ($matches[1]) {
                            $gallery = $matches[1];
                        }
                    }
                }
                if ($gallery) {
                    $list_items_markup .= sprintf('<div class="entry-media">%1$s</div>', wp_kses_post($gallery));
                } else {
                    $list_items_markup .= post_featured_image($post_id, $featuredImageSize);
                }

            } elseif ($post_format == 'quote') {

                $quote = false;
                if (preg_match('/<blockquote.*?>(.*?)<\/blockquote>/is', $post['post_content'], $matches)) {
                    if ($matches[1]) {
                        $quote = $matches[1];
                    }
                }
                $list_items_markup .= post_featured_image($post_id, $featuredImageSize);
                if ($quote) {
                    $list_items_markup .= sprintf('<div class="entry-media"><a href="%1$s"><blockquote>%2$s</blockquote></a></div>',
                        esc_url(get_permalink($post_id)),
                        wp_kses_post($quote));
                } else {
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
                }

            } elseif ($post_format == 'video') {

                $content = apply_filters('the_content', $post['post_content']);
                $video = false;
                if (false === strpos($content, 'wp-playlist-script')) {
                    $video = get_media_embedded_in_content($content, array('video', 'object', 'embed', 'iframe'));
                }
                if (!empty($video)) {
                    $list_items_markup .= sprintf('<div class="entry-media">');
                    foreach ($video as $video_html) {
                        $list_items_markup .= sprintf('%1$s', $video_html);
                    }
                    $list_items_markup .= sprintf('</div>');
                } else {
                    $list_items_markup .= post_featured_image($post_id, $featuredImageSize);
                }

            } else {
                $list_items_markup .= post_featured_image($post_id, $featuredImageSize);
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

        if ($post_format !== 'quote') {
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
        }

        // Get the post excerpt
        if ($post_format !== 'quote' && isset($attributes['isExcerpt']) && $attributes['isExcerpt']) {
            $excerpt = apply_filters('the_excerpt', wp_trim_words(get_post_field('post_excerpt', $post_id, 'display'), $excerptLength));
            if (empty($excerpt)) {
                $excerpt = apply_filters('the_excerpt', wp_trim_words($post['post_content'], $excerptLength));
            }
            if ($excerpt !== '') {
                $list_items_markup .= sprintf('<div class="entry-excerpt">%1$s</div>', wp_kses_post($excerpt));
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

        // Close entry-content-wrapper
        $list_items_markup .= sprintf('</div>');

        $list_items_markup .= sprintf('</article></div>');
    }

    if($attributes['isMorePostsBtn']) {
        $list_items_markup .= sprintf(
            '<div class="text-center w-100"><a class="btn" href="%1$s"> %2$s <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></div>',
            esc_url($attributes['morePostsBtnURL']),
            esc_html($attributes['morePostsBtnLable'])
        );
    }
    

    // Build the classes
    $class = 'energetic-core-parts-posts ';
    $class .= isset($attributes['align']) && $attributes['align'] == 'full' ? 'container-fluid' : 'container';

    if (isset($attributes['className'])) {
        $class .= ' ' . $attributes['className'];
    }
    $class .= isset($attributes['align']) && $attributes['align'] == 'full' || $attributes['align'] == 'wide' ? ' align'. $attributes['align'] : '';
    
    $grid_class = 'row blog-post';
    if (isset($attributes['postLayout']) && 'list' === $attributes['postLayout']) {
        $grid_class .= ' is-list';
    } else {
        $grid_class .= ' is-grid';
    }
    $grid_class .= isset($attributes['postStyle']) ? ' ' . $attributes['postStyle'] : ' stander-post-style';

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
function ecp_register_block_post_block()
{

    // Only load if Gutenberg is available.
    if (!function_exists('register_block_type')) {
        return;
    }

    // Dynmaic post style list
	$postStyleList = array(
		array( 'value' => 'stander-post-style', 'label' => 'Stander Post Style'),
		array('value' => 'card-post-style', 'label' => 'Card Post Style'),
	);
	if(has_filter('ecp_post_style_list_filter')) {
		$postStyleList = apply_filters('ecp_post_style_list_filter', $postStyleList);
    }



    // Hook server side rendering into render callback
    register_block_type('energetic-core-parts/posts', [
        'attributes' => array(
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
                'default' => true,
            ),
            'isDate' => array(
                'type' => 'boolean',
                'default' => true,
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
            'isMorePostsBtn' => array(
                'type' => 'boolean',
                'default' => true,
            ),
            'morePostsBtnLable' => array(
                'type' => 'string',
                'default' => 'More Posts',
            ),
            'morePostsBtnURL' => array(
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
                'default' => 'wide',
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
            'postStyleList' => array(
                'type' => 'object',
                'default' => $postStyleList,
            ),

        ),
        'render_callback' => 'ecp_render_block_post',
    ]);

}
add_action( 'init', 'ecp_register_block_post_block' );