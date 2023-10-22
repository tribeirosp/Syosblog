<?php
if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}

add_action('after_setup_theme', 'energetic_core_parts_after_theme_setup_do');

function energetic_core_parts_after_theme_setup_do()
{   
    // image sizes
    add_image_size( 'landscape', 1200, 800, true );
    add_image_size( 'square', 1200, 1200, true );
    add_image_size( 'portrait', 1200, 1800, true );
    add_image_size( 'landscape_medium', 600, 400, true );
    add_image_size( 'portrait_medium', 600, 900, true );
    add_image_size( 'square_medium', 600, 600, true );
    
    /**
     * Count post visits
     */
    function energetic_core_parts_action_count_post_visits()
    {
        if (!is_single()) {
            return;
        }
        global $post;
        $views = get_post_meta($post->ID, 'ecp_post_views', true);
        $views = intval($views);
        update_post_meta($post->ID, 'ecp_post_views', ++$views);
    }
	add_action('wp_head', 'energetic_core_parts_action_count_post_visits');
}