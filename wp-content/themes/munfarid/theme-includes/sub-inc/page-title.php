<?php if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}
if (!function_exists('etmunfarid_etcodes_get_title')) {
    function etmunfarid_etcodes_get_title()
    {

        $breadcrumb_opt = 'yes';
        $page_id = get_the_ID();
        $the_title = get_the_title();
        $page_title     = get_post_meta($page_id, 'etmunfarid_etcodes_page_title', true) ? get_post_meta($page_id, 'etmunfarid_etcodes_page_title', true) : 'on';

        if(is_home()) {
            $page_id = get_option('page_for_posts');
            $the_title = $page_id !== '0' ? get_the_title($page_id) : 'Blog';
        }
        if(class_exists('WooCommerce') && is_shop()) {
            $page_id = wc_get_page_id( 'shop' );
            $the_title = woocommerce_page_title(false);
        }
        
        // Theme Settings
        $page_title_container_width = get_theme_mod('etmunfarid_etcodes_page_title_container_width') == true ? 'container-fluid' : 'container';
        $title_position   =  get_post_meta($page_id, 'etmunfarid_etcodes_page_title_position', true) ? get_post_meta($page_id, 'etmunfarid_etcodes_page_title_position', true) : 'text-left';
        $breadcrumb_opt   =  get_theme_mod('etmunfarid_etcodes_page_title_container_breadcrumb', true);
        
        ?>

        <?php if ($page_title == 'on' && !is_singular( array( 'post', 'product' )) ): ?>
            <div class="page-main-title">
                <div class="<?php echo esc_attr($page_title_container_width); ?>">
                    <div class="row align-items-center">
                    
                    <?php if ($title_position == 'text-left'){ ?>
                        <div class="col-lg-7">
                            <h4 class="entry-title"><?php echo esc_html($the_title); ?></h4>
                        </div>
                        <div class="col-lg-5 align-self-center text-md-right">
                            <?php if ($breadcrumb_opt) {if (function_exists('etmunfarid_etcodes_ext_breadcrumbs')) {etmunfarid_etcodes_ext_breadcrumbs();}}?>
                        </div>
                    <?php } elseif($title_position == 'text-center') {?>
                        <div class="col-lg-12 text-center">
                            <h4 class="entry-title"><?php echo esc_html($the_title); ?></h4>
                            <?php if ($breadcrumb_opt) {if (function_exists('etmunfarid_etcodes_ext_breadcrumbs')) {etmunfarid_etcodes_ext_breadcrumbs();}}?>
                        </div>
                    <?php } else { ?>
                        <div class="col-lg-7 text-center text-md-right">
                            <h4 class="entry-title"><?php echo esc_html($the_title); ?></h4>
                        </div>
                        <div class="col-lg-5 align-self-center text-center  text-md-left order-md-first">
                            <?php if ($breadcrumb_opt) {if (function_exists('etmunfarid_etcodes_ext_breadcrumbs')) {etmunfarid_etcodes_ext_breadcrumbs();}}?>
                        </div> 
                    <?php }?>

                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if (is_singular( array( 'post', 'product' ) ) && function_exists('etmunfarid_etcodes_ext_breadcrumbs') ): ?>
            <div class="page-main-title">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-12 align-self-center text-center text-md-left">
                        <?php  if (get_theme_mod('etmunfarid_etcodes_page_title_container_breadcrumb', true) == true) { etmunfarid_etcodes_ext_breadcrumbs(); }?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>


    <?php
    }
}