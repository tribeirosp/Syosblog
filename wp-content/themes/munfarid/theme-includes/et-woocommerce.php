<?php
/* Add Post WooCommerce support */
add_theme_support('woocommerce');

add_theme_support('wc-product-gallery-zoom');
add_theme_support('wc-product-gallery-lightbox');
add_theme_support('wc-product-gallery-slider');

add_action('woocommerce_before_main_content', 'etmunfarid_etcodes_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'etmunfarid_etcodes_theme_wrapper_end', 10);

remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10);
remove_action('woocommerce_archive_description', 'woocommerce_product_archive_description', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 12);

add_filter('woocommerce_show_page_title', 'etmunfarid_etcodes_override_page_title');

add_filter('woocommerce_product_thumbnails_columns', 'etmunfarid_etcodes_single_item_thumb_cols');

add_filter('woocommerce_enqueue_styles', 'jk_dequeue_styles');


// Change number of thumb per row to 4
function etmunfarid_etcodes_single_item_thumb_cols()
{
    return 4; // .last class applied to every 4th thumbnail
}

// override page title of woo
function etmunfarid_etcodes_override_page_title()
{
    return false;
}

add_filter('post_class', 'etmunfarid_etcodes_product_classes', 20, 3);

/** Single Product ********************************************************/

if (!function_exists('etmunfarid_etcodes_single_product_content_additional_tag_before')) {
    function etmunfarid_etcodes_single_product_content_additional_tag_before()
    {
        print '<div class="container single-product-content mb-55px"><div class="row large-gutters">';
    }
}
add_action('woocommerce_before_single_product_summary', 'etmunfarid_etcodes_single_product_content_additional_tag_before', 5);
if (!function_exists('etmunfarid_etcodes_single_product_content_additional_tag_after')) {
    function etmunfarid_etcodes_single_product_content_additional_tag_after()
    {
        print '</div></div>';
    }
}
add_action('woocommerce_after_single_product_summary', 'etmunfarid_etcodes_single_product_content_additional_tag_after', 1);

// Remove product image before the single product summary
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);

// Add product image before the single product summary with .col-md-7 class
if (!function_exists('etmunfarid_etcodes_woocommerce_show_product_images')) {
    /**
     * Output the product image before the single product summary.
     */
    function etmunfarid_etcodes_woocommerce_show_product_images()
    {?>
    	<div class="col-lg-6">
    		<?php wc_get_template('single-product/product-image.php');?>
    	</div>
    <?php }
}
add_action('woocommerce_before_single_product_summary', 'etmunfarid_etcodes_woocommerce_show_product_images', 20);

//Add additional html around single product summary
if (!function_exists('etmunfarid_etcodes_single_product_summary_additional_tag_before')) {
    function etmunfarid_etcodes_single_product_summary_additional_tag_before()
    {

        print '<div class="col-lg-6">';
    }
}

add_action('woocommerce_before_single_product_summary', 'etmunfarid_etcodes_single_product_summary_additional_tag_before', 30);

if (!function_exists('etmunfarid_etcodes_single_product_summary_additional_tag_after')) {
    function etmunfarid_etcodes_single_product_summary_additional_tag_after()
    {
        print '</div>';
    }
}
add_action('woocommerce_after_single_product_summary', 'etmunfarid_etcodes_single_product_summary_additional_tag_after', 5);

// single product tabs
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
if (!function_exists('etmunfarid_etcodes_woocommerce_output_product_data_tabs')) {

    /**
     * Output the product tabs.
     */
    function etmunfarid_etcodes_woocommerce_output_product_data_tabs()
    {?>
        <hr>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <?php wc_get_template('single-product/tabs/tabs.php');?>
            </div>
        </div>
        <hr>
    <?php }
}
add_action('woocommerce_after_single_product_summary', 'etmunfarid_etcodes_woocommerce_output_product_data_tabs', 4);

// Woocommarce Single product

// remove woocommerce_template_loop_product_link_open and woocommerce_template_loop_product_link_close and add around title
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);

add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 9);
add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 11);

// remove woocommerce_shop_loop_item_title and add etmunfarid_etcodes_woocommerce_template_loop_product_title_modify
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
if (!function_exists('etmunfarid_etcodes_woocommerce_template_loop_product_title_modify')) {
    function etmunfarid_etcodes_woocommerce_template_loop_product_title_modify()
    {
        echo '<h6 class="woocommerce-loop-product__title product-title">' . get_the_title() . '</h6>';
    }
}
add_action('woocommerce_shop_loop_item_title', 'etmunfarid_etcodes_woocommerce_template_loop_product_title_modify', 10);

// remove woocommerce_template_loop_add_to_cart. modify and add inside woocommerce_template_loop_product_img_wrapper_open div
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
if (!function_exists('etmunfarid_etcodes_woocommerce_template_loop_add_to_cart_modify')) {
    function etmunfarid_etcodes_woocommerce_template_loop_add_to_cart_modify($args = array())
    {
        global $product;
        if ($product) {
            $defaults = array(
                'quantity' => 1,
                'class' => implode(' ', array_filter(array(
                    'btn btn-dark rounded-0 btn-add-to-cart',
                    'product_type_' . $product->get_type(),
                    $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                    $product->supports('ajax_add_to_cart') ? 'ajax_add_to_cart' : '',
                ))),
                'attributes' => array(
                    'data-product_id' => $product->get_id(),
                    'data-product_sku' => $product->get_sku(),
                    'aria-label' => $product->add_to_cart_description(),
                    'rel' => 'nofollow',
                ),
            );
            $args = apply_filters('woocommerce_loop_add_to_cart_args', wp_parse_args($args, $defaults), $product);
            wc_get_template('loop/add-to-cart.php', $args);
        }
    }
}
add_action('woocommerce_before_shop_loop_item_title', 'etmunfarid_etcodes_woocommerce_template_loop_add_to_cart_modify', 15);

// remove woocommerce_template_loop_rating and after woocommerce_template_loop_product_title_price_wrapper_close
remove_action('woocommerce_template_loop_price', 'woocommerce_template_loop_rating', 5);
add_action('woocommerce_template_loop_price', 'woocommerce_template_loop_rating', 20);

// Add div product_img_wrapper for product image, add to cart btn and sale flash
if (!function_exists('woocommerce_template_loop_product_img_wrapper_open')) {
    /**
     * Insert the opening img_wrapper tag for products in the loop.
     */
    function woocommerce_template_loop_product_img_wrapper_open()
    {
        echo '<div class="product-img-wrapper">';
    }
}
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_img_wrapper_open', 5);
if (!function_exists('woocommerce_template_loop_product_img_wrapper_close')) {
    /**
     * Insert the close img_wrapper tag for products in the loop.
     */
    function woocommerce_template_loop_product_img_wrapper_close()
    {
        echo '</div>';
    }
}
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_img_wrapper_close', 20);

// Add div wrappe for title and sale price
if (!function_exists('woocommerce_template_loop_product_title_price_wrapper_open')) {
    function woocommerce_template_loop_product_title_price_wrapper_open()
    {
        echo '<div class="product-content-wrapper">';
    }
}
add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title_price_wrapper_open', 5);
if (!function_exists('woocommerce_template_loop_product_title_price_wrapper_close')) {
    function woocommerce_template_loop_product_title_price_wrapper_close()
    {
        echo '</div>';
    }
}
add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_product_title_price_wrapper_close', 15);

// Ensure cart contents update when products are added to the cart via AJAX
add_filter('woocommerce_add_to_cart_fragments', 'etmunfarid_etcodes_woocommerce_header_add_to_cart_fragment');
function etmunfarid_etcodes_woocommerce_header_add_to_cart_fragment($fragments)
{
    ob_start();
    ?>
     <span class="count"><?php echo wp_kses_data(WC()->cart->get_cart_contents_count()); ?></span>
    <?php
$fragments['a.cart-contents-header .count'] = ob_get_clean();

    return $fragments;
}