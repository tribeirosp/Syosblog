<?php if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}
/***********************************************************************************************/
/* Template for the Audio post format */
/***********************************************************************************************/

$arg['excerpt_limit'] = isset($arg['excerpt_limit']) ? $arg['excerpt_limit'] : 75;

$content = apply_filters('the_content', get_the_content());
$audio = false;

if (false === strpos($content, 'wp-playlist-script')) {
    $audio = get_media_embedded_in_content($content, array('audio', 'object', 'embed', 'iframe'));
}

if (!empty($audio)) {
    foreach ($audio as $audio_html) {
        echo '<div class="entry-audio">';
        echo do_shortcode($audio_html);
        echo '</div>';
    }
} else {
    etmunfarid_etcodes_single_post_image();
}

?><div class="entry-content-wrapper"><?php
etmunfarid_etcodes_single_entry_meta_top();
etmunfarid_etcodes_single_entry_title();
echo etmunfarid_etcodes_excerpt(55);
etmunfarid_etcodes_single_post_readmore_btn();
?></div><?php
