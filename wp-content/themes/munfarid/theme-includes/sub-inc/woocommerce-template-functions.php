<?php if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}
/**
 * WooCommerce Template Functions.
 *
 * @package Munfarid
 */


// Remove each style one by one
function jk_dequeue_styles($enqueue_styles)
{
    unset($enqueue_styles['woocommerce-layout']); // Remove the layout
    return $enqueue_styles;
}

// page container start
function etmunfarid_etcodes_theme_wrapper_start()
{

    $page_width  =   get_theme_mod( 'etmunfarid_etcodes_woocommerce_catalog_page_width') == true ? 'container-fluid' : 'container';
    $page_layout =   get_theme_mod( 'etmunfarid_etcodes_woocommerce_product_catalog_layout', 'full_width');
    ?>
    <div id="primary" class="content-area mb-30px">
        <main id="main" class="site-main" role="main">
            <?php 
                /**
                 * etmunfarid_etcodes_main_title hook.
                 */
                do_action('etmunfarid_etcodes_main_title');
                
            if ( !is_singular('product') ) { ?>

            <div class="<?php echo esc_attr($page_width); ?> ">
                <div class="row large-gutters">
                    <?php if ($page_layout == 'left_sidebar') { ?>
                      <div class="col-lg-3">
                        <?php  if ( is_active_sidebar( 'shop' ) ) :
                          dynamic_sidebar( 'shop' ); 
                        endif; ?>
                      </div>
                      <div class="col-lg-9">
                    <?php } elseif ($page_layout == 'right_sidebar') { ?>
                        <div class="col-lg-9">
                    <?php } else { ?>
                        <div class="col-lg-12">
                    <?php }
            }
}

// page container end
function etmunfarid_etcodes_theme_wrapper_end()
{
    $page_layout =   get_theme_mod( 'etmunfarid_etcodes_woocommerce_product_catalog_layout', 'full_width');

        if ( !is_singular('product') ) {
                    if ($page_layout == 'left_sidebar') {?>
                        </div>
                    <?php } elseif ($page_layout == 'right_sidebar') { ?>
                        </div>
                        <div class="col-lg-3">
                            <?php if ( is_active_sidebar( 'shop' ) ) :
                                    dynamic_sidebar( 'shop' ); 
                            endif; ?>
                        </div>
                    <?php } else { ?>
                        </div>
                    <?php } ?>

                </div>
            </div>
        <?php } ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php }

// Catlog Products class
function etmunfarid_etcodes_product_classes($classes, $class, $post_id)
{
    $product = wc_get_product(get_the_ID());

    $columns = get_option('woocommerce_catalog_columns', 4);

    if ($columns == 1) {
        $class = 'col-md-12';
    } elseif ($columns == 2) {
        $class = 'col-md-6 col-lg-6';
    } elseif ($columns == 3) {
        $class = 'col-md-6 col-lg-4';
    } elseif ($columns == 4) {
        $class = 'col-md-6 col-lg-3';
    } elseif ($columns == 5) {
        $class = 'col-md-6 col-lg-2';
    } elseif ($columns == 6) {
        $class = 'col-md-6 col-lg-2';
    }

    if(is_product(get_the_ID())){
        $class = 'col-lg-3';
    }

    if ($product && !is_single(get_the_ID())) {
        $classes[] = $class;
    }

    return $classes;
}

/**
 * Display Header Cart
 *
 * @since  1.0.0
 * @return void
 */
function etmunfarid_etcodes_header_cart() {
    ?>
    <a class="cart-contents-header" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'munfarid' ); ?>">
        <i class="fa fa-shopping-cart"></i>
    
        <span class="counter-shop-box">
            <span class="count"><?php echo wp_kses_data( WC()->cart->get_cart_contents_count() );?></span>
        </span>    
    </a>    
	<div class="etcodes_shopping-cart-header">
		<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
	</div>
	<?php
	
}