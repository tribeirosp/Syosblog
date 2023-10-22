<?php if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}
/***********************************************************************************************/
/* Template for the Gallery post format */
/***********************************************************************************************/

$gallery = false;
if (get_post_gallery()) {
    $gallery = get_post_gallery();
} else {
    if (preg_match('/<!--\ wp:gallery.*-->([\s\S]*?)<!--\ \/wp:gallery -->/i', get_the_content(), $matches)) {
        if ($matches[1]) {
            $gallery = $matches[1];
        }
    }
}

if ($gallery) {
    echo '<div class="entry-media">';
    echo wp_kses_post($gallery);
    echo '</div>';
} else {
    etmunfarid_etcodes_single_post_image();
}

?><div class="entry-content-wrapper"><?php
etmunfarid_etcodes_single_entry_meta_top();
etmunfarid_etcodes_single_entry_title();
echo etmunfarid_etcodes_excerpt(55);
etmunfarid_etcodes_single_post_readmore_btn();
?></div><?php
