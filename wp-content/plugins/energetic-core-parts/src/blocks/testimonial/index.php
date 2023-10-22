<?php
if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}
/**
 * Server rendering for blocks - energetic-core-parts/testimonial
 */

function ecp_render_block_testimonial($attributes, $content)
{

    $excerptLength = isset($attributes['excerptLength']) ? $attributes['excerptLength'] : 55;


    if ($attributes['categories']) {
        $category_filter = array(
            array(
                'taxonomy' => 'testimonial_category',
                'field'    => 'term_id',
                'terms'    => $attributes['categories'],
            ),
        );
    } else {
        $category_filter = array();
    }

    $recent_posts = wp_get_recent_posts(array(
        'numberposts' => $attributes['postsToShow'],
        'post_status' => 'publish',
        'post_type'   => 'testimonial',
        'order'       => $attributes['order'],
        'orderby'     => $attributes['orderBy'],
        'tax_query'   => $category_filter,
    ));
    if (empty($recent_posts)) {
        return '<p>No posts</p>';
    }

    $list_items_markup = '';

    foreach ($recent_posts as $post) {

        $post_id = $post['ID'];

        $list_items_markup .= sprintf(
            '<div id="post-%1$s" class="testimonial">',
            $post_id
        );
        // testimonial
        $list_items_markup .= sprintf(
            '<p>%1$s</p>',
            $post['post_content']
        );
        $list_items_markup .= sprintf('<div class="testimonial-author">');

        //testimonial author image
        if ($attributes['isAuthorImg'] && has_post_thumbnail($post_id)) {
            $list_items_markup .= sprintf(
                '<div class="testimonial-author-image">%1$s</div>',
                get_the_post_thumbnail($post_id, array(100, 100))
            );
        }

        $list_items_markup .= sprintf('<div class="testimonial-author-text">');
        //testimonial author name
        $list_items_markup .= sprintf(
            '<span class="testimonial-author-name">%1$s</span>',
            $post['post_title']
        );
        //testimonial author tag
        if (get_post_meta($post_id, 'energetic_core_parts_tag', true) !== '') {
            $list_items_markup .= sprintf(
                '<span class="testimonial-author-tag">%1$s</span>',
                get_post_meta($post_id, 'energetic_core_parts_tag', true)
            );
        }
        $list_items_markup .= sprintf('</div>');

        $list_items_markup .= sprintf('</div>');

        $list_items_markup .= sprintf('</div>');
    }

    // Build the classes
    $id    = 'testimonial-' . uniqid();
    $class = 'wp-block-energetic-core-parts-testimonial testimonials slider-call ' . $attributes['postStyle'];

    if (isset($attributes['className'])) {
        $class .= ' ' . $attributes['className'];
    }

    $data_slick = '{
        &quot;arrows&quot;:' . esc_js($attributes['isNav'] ? 'true' : 'false') . ',
        &quot;dots&quot;:' . esc_js($attributes['isDots'] ? 'true' : 'false') . ',
        &quot;slidesToShow&quot;:' . esc_js($attributes['perSlideItems']) . ',
        &quot;infinite&quot;:' . esc_js($attributes['isLoop'] ? 'true' : 'false') . ',
        &quot;speed&quot;:' . esc_js($attributes['smartSpeed']) . ',
        &quot;autoplay&quot;:' . esc_js($attributes['isAutoplay'] ? 'true' : 'false') . ',
        &quot;autoplaySpeed&quot;:' . esc_js($attributes['autoplayTimeout']) . ',
        &quot;variableWidth&quot;:' . esc_js($attributes['isVariableWidth'] ? 'true' : 'false') . '
    }';

    // Output the post markup
    $block_content = sprintf(
        '<div id="%1$s" class="%2$s"  data-slick="%4$s">%3$s</div>',
        esc_attr($attributes['testimonialID']),
        esc_attr($class),
        $list_items_markup,
        $data_slick
    );

    return $block_content;
}

/**
 * Register the dynamic block.
 *
 * @since 1.0
 * @return void
 */
function ecp_register_block_testimonial_block()
{

    // Only load if Gutenberg is available.
    if (!function_exists('register_block_type')) {
        return;
    }
    // Hook server side rendering into render callback
    register_block_type('energetic-core-parts/testimonial', array(
		'editor_script'   => ECP_SLUG . '-editor',
		'editor_style'    => ECP_SLUG . '-editor',
		'style'           => ECP_SLUG . '-frontend',
        'attributes'      => array(
            'postStyle'         => array(
                'type'    => 'string',
                'default' => '',
            ),
            'className'         => array(
                'type'    => 'string',
                'default' => '',
            ),
            'paddingTop'        => array(
                'type'    => 'number',
                'default' => '',
            ),
            'paddingBottom'     => array(
                'type'    => 'number',
                'default' => '',
            ),
            'paddingLeft'       => array(
                'type'    => 'number',
                'default' => '',
            ),
            'paddingRight'      => array(
                'type'    => 'number',
                'default' => '',
            ),
            'marginTop'         => array(
                'type'    => 'number',
                'default' => '',
            ),
            'marginBottom'      => array(
                'type'    => 'number',
                'default' => '',
            ),
            'backgroundColor'   => array(
                'type'    => 'string',
                'default' => '',
            ),
            'backgroundImage'   => array(
                'type'      => 'string',
                'source'    => 'attribute',
                'attribute' => 'src',
                'selector'  => 'img',
            ),
            'backgroundImageID' => array(
                'type'    => 'number',
                'default' => '',
            ),
            'align'             => array(
                'type'    => 'string',
                'default' => 'wide',
            ),
            'postsToShow'       => array(
                'type'    => 'number',
                'default' => 3,
            ),
            'categories'        => array(
                'type'    => 'string',
                'default' => '',
            ),
            'order'             => array(
                'type'    => 'string',
                'default' => 'desc',
            ),
            'orderBy'           => array(
                'type'    => 'string',
                'default' => 'date',
            ),
            'isAuthorImg'       => array(
                'type'    => 'boolean',
                'default' => true,
            ),
            'testimonialID'     => array(
                'type'    => 'string',
                'default' => '',
            ),
            'isNav'             => array(
                'type'    => 'boolean',
                'default' => true,
            ),
            'isDots'            => array(
                'type'    => 'boolean',
                'default' => true,
            ),
            'isVariableWidth'   => array(
                'type'    => 'boolean',
                'default' => false,
            ),
            'perSlideItems'     => array(
                'type'    => 'number',
                'default' => 1,
            ),
            'isLoop'            => array(
                'type'    => 'boolean',
                'default' => true,
            ),
            'smartSpeed'        => array(
                'type'    => 'number',
                'default' => 1000,
            ),
            'isAutoplay'        => array(
                'type'    => 'boolean',
                'default' => true,
            ),
            'autoplayTimeout'   => array(
                'type'    => 'number',
                'default' => 10000,
            ),
        ),
        'render_callback' => 'ecp_render_block_testimonial',
    ));

}

add_action('init', 'ecp_register_block_testimonial_block');
