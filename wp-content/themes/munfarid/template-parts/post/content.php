<?php if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}
/***********************************************************************************************/
/* Template for the default post format */
/***********************************************************************************************/

etmunfarid_etcodes_single_post_image(); ?>
<div class="entry-content-wrapper">
<?php
    etmunfarid_etcodes_single_entry_meta_top();
    etmunfarid_etcodes_single_entry_title();
    echo etmunfarid_etcodes_excerpt(55);
    etmunfarid_etcodes_single_post_readmore_btn(); 
?>
</div>