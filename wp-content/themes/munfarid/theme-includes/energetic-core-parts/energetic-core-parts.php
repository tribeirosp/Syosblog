<?php if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}

// Post Block style
add_filter( 'ecp_post_style_list_filter','etmunfarid_etcodes_post_style_list_filter' );
function etmunfarid_etcodes_post_style_list_filter($postStyleList) {
    return $postStyleList = array(
		array( 'value' => 'stander-post-style', 'label' => 'Stander Post Style'),
        array( 'value' => 'card-post-style', 'label' => 'Card Post Style'),
        array( 'value' => 'blog-list-style', 'label' => 'List Post Style'),
	);
}

// Post Carousel Block style
add_filter( 'ecp_post_carousel_style_list_filter','etmunfarid_etcodes_post_carousel_style_list_filter' );
function etmunfarid_etcodes_post_carousel_style_list_filter($postsCarouselStyleList) {
    return $postsCarouselStyleList = array(
        array('value' => 'card-post-carousel-style', 'label' => 'Card Carousel Post'),
        array('value' => 'blog-slider-munfarid-1', 'label' => 'Munfarid Carousel 1'),
        array('value' => 'blog-slider-munfarid-2', 'label' => 'Munfarid Carousel 2'),
	);
}