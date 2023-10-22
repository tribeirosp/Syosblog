<?php
if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}

/**
 * Server rendering for blocks - energetic-core-parts/posts
 */

function ecp_render_block_top_posts($attributes, $content)
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

    $i = 1;
    foreach ($recent_posts as $post) {

        $post_id = $post['ID'];
        $post_format = get_post_format($post_id);

        $classes = join(' ', get_post_class('d-flex clearfix', $post_id));
        $list_items_markup .= sprintf(
            '<li><article id="list-post-%1$s" class="%2$s">',
            $post_id,
            $classes
        );

        $list_items_markup .= sprintf(
            '<span class="reveal-title">%1$s</span>',
            $i++
        );

        $list_items_markup .= sprintf('<div class="entry-content-wrapper">');
        if (get_the_title($post_id) != '') {
            $list_items_markup .= sprintf(
                '<a class="entry-title" href="%1$s">%2$s</a>',
                esc_url(get_permalink($post_id)),
                esc_html(get_the_title($post_id))
            );
        } else {
            $list_items_markup .= sprintf(
                '<a class="entry-title" href="%1$s">%2$s</a>',
                esc_url(get_permalink($post_id)),
                esc_html('Permalink to the post', 'energetic-core-parts')
            );
        }
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

        // Close Post top meta
        $list_items_markup .= sprintf('</div>');

        $list_items_markup .= sprintf('</div>');

        $list_items_markup .= sprintf('</article></li>');
    }

    // Build the classes
    $class = 'energetic-core-parts-posts-list simple-entry-list blog-post ';
    if (isset($attributes['className'])) {
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
        '<div class="%1$s" style="%2$s"><ul class="post-list">%3$s</ul></div>',
        esc_attr($class),
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
function ecp_register_block_top_posts_block()
{

    // Only load if Gutenberg is available.
    if (!function_exists('register_block_type')) {
        return;
    }
    // Hook server side rendering into render callback
    register_block_type('energetic-core-parts/posts-list', [
        'attributes' => array(
            'postListType' => array(
                'type' => 'string',
                'default' => 'recent',
            ),
            'duration' => array(
                'type' => 'string',
                'default' => '',
            ),
            'postsToShow' => array(
                'type' => 'number',
                'default' => 3,
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
        ),
        'render_callback' => 'ecp_render_block_top_posts',
    ]);

}
add_action( 'init', 'ecp_register_block_top_posts_block' );