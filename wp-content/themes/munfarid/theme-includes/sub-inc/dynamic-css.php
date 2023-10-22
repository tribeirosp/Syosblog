<?php if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}

function etmunfarid_etcodes_dynamic_css()
{
    $page_id = get_the_ID();
    if (is_home()) {
        $page_id = get_option('page_for_posts');
        $the_title = get_the_title($page_id);
    }

    if (class_exists('WooCommerce') && is_shop()) {
        $page_id = wc_get_page_id('shop');
    }

    $custom_css = '';

    // Logo

    $classes[] = array(
        'selector' => '.navbar-brand',
        'value' => get_theme_mod('etmunfarid_etcodes_logo_max_width') ? get_theme_mod('etmunfarid_etcodes_logo_max_width') . 'px' : false,
        'properties' => array(
            'width',
        ),
    );

    // Typography - Headings

    $classes[] = array(
        'selector' => 'h1,h2,h3,h4,h5,h6',
        'value' => get_theme_mod('etmunfarid_etcodes_headings_font'),
        'properties' => array(
            'font-family',
        ),
    );
    $classes[] = array(
        'selector' => 'h1,h2,h3,h4,h5,h6',
        'value' => get_theme_mod('etmunfarid_etcodes_headings_font_weight'),
        'properties' => array(
            'font-weight',
        ),
    );
    $classes[] = array(
        'selector' => 'h1,h2,h3,h4,h5,h6',
        'value' => get_theme_mod('etmunfarid_etcodes_headings_font_style'),
        'properties' => array(
            'font-style',
        ),
    );
    $classes[] = array(
        'selector' => 'h1,h2,h3,h4,h5,h6',
        'value' => get_theme_mod('etmunfarid_etcodes_headings_font_color'),
        'properties' => array(
            'color',
        ),
    );

    // Typography - body

    $classes[] = array(
        'selector' => 'body',
        'value' => get_theme_mod('etmunfarid_etcodes_body_font'),
        'properties' => array(
            'font-family',
        ),
    );
    $classes[] = array(
        'selector' => 'body',
        'value' => get_theme_mod('etmunfarid_etcodes_body_font_weight'),
        'properties' => array(
            'font-weight',
        ),
    );
    $classes[] = array(
        'selector' => 'body',
        'value' => get_theme_mod('etmunfarid_etcodes_body_font_style'),
        'properties' => array(
            'font-style',
        ),
    );
    $classes[] = array(
        'selector' => 'body',
        'value' => get_theme_mod('etmunfarid_etcodes_body_font_size') ? get_theme_mod('etmunfarid_etcodes_body_font_size') . 'px' : false,
        'properties' => array(
            'font-size',
        ),
    );
    $classes[] = array(
        'selector' => 'body',
        'value' => get_theme_mod('etmunfarid_etcodes_body_font_color'),
        'properties' => array(
            'color',
        ),
    );
    $classes[] = array(
        'selector' => 'a, p a',
        'value' => get_theme_mod('etmunfarid_etcodes_body_font_link_color'),
        'properties' => array(
            'color',
        ),
    );
    $classes[] = array(
        'selector' => 'a:hover, p a:hover',
        'value' => get_theme_mod('etmunfarid_etcodes_body_font_link_hover_color'),
        'properties' => array(
            'color',
        ),
    );

    // Typography - Menu

    $classes[] = array(
        'selector' => '.navbar-nav > li, .navbar-nav > li > a, .navbar .navbar-module .fa',
        'value' => get_theme_mod('etmunfarid_etcodes_menu_font'),
        'properties' => array(
            'font-family',
        ),
    );
    $classes[] = array(
        'selector' => '.navbar-nav > li, .navbar-nav > li > a, .navbar .navbar-module .fa',
        'value' => get_theme_mod('etmunfarid_etcodes_menu_font_weight'),
        'properties' => array(
            'font-weight',
        ),
    );
    $classes[] = array(
        'selector' => '.navbar-nav > li, .navbar-nav > li > a, .navbar .navbar-module .fa',
        'value' => get_theme_mod('etmunfarid_etcodes_menu_font_style'),
        'properties' => array(
            'font-style',
        ),
    );
    $classes[] = array(
        'selector' => '.navbar-nav > li, .navbar-nav > li > a, .navbar .navbar-module .fa',
        'value' => get_theme_mod('etmunfarid_etcodes_menu_font_size') ? get_theme_mod('etmunfarid_etcodes_menu_font_size') . 'px' : false,
        'properties' => array(
            'font-size',
        ),
    );
    $classes[] = array(
        'selector' => '.navbar-nav > li, .navbar-nav > li > a, .navbar .navbar-module .fa',
        'value' => get_post_meta($page_id, 'etmunfarid_etcodes_header_nav_color', true) ? get_post_meta($page_id, 'etmunfarid_etcodes_header_nav_color', true) : get_theme_mod('etmunfarid_etcodes_body_font_color'),
        'properties' => array(
            'color',
        ),
    );
    $classes[] = array(
        'selector' => '.navbar-nav > li, .navbar-nav > li > a, .navbar .navbar-module .fa',
        'value' => get_theme_mod('etmunfarid_etcodes_menu_font_color'),
        'properties' => array(
            'color',
        ),
    );
    $classes[] = array(
        'selector' => '.navbar-nav > li > a:hover, .navbar .navbar-module .fa:hover',
        'value' => get_theme_mod('etmunfarid_etcodes_menu_font_hover_active_color'),
        'properties' => array(
            'color',
        ),
    );

    // Colors

    $classes[] = array(
        'selector' => '.btn',
        'value' => get_theme_mod('etmunfarid_etcodes_btn_text_color'),
        'properties' => array(
            'color',
        ),
    );
    $classes[] = array(
        'selector' => '.btn:hover',
        'value' => get_theme_mod('etmunfarid_etcodes_btn_text_hover_color'),
        'properties' => array(
            'color',
        ),
    );
    $classes[] = array(
        'selector' => '.btn',
        'value' => get_theme_mod('etmunfarid_etcodes_btn_background_color'),
        'properties' => array(
            'background-color',
        ),
    );
    $classes[] = array(
        'selector' => '.btn:hover',
        'value' => get_theme_mod('etmunfarid_etcodes_btn_background_hover_color'),
        'properties' => array(
            'background-color',
        ),
    );

    // Header
    $classes[] = array(
        'selector' => '.navbar',
        'value' => get_post_meta($page_id, 'etmunfarid_etcodes_header_background', true) ? get_post_meta($page_id, 'etmunfarid_etcodes_header_background', true) : get_theme_mod('etmunfarid_etcodes_header_bg_color'),
        'properties' => array(
            'background-color',
        ),
    );

    if (get_post_meta($page_id, 'etmunfarid_etcodes_header_top_padding', true)) {
        $header_padding_top = get_post_meta($page_id, 'etmunfarid_etcodes_header_top_padding', true) . 'px';
    } else {
        $header_padding_top = get_theme_mod('etmunfarid_etcodes_header_top_padding') . 'px';
    }
    $classes[] = array(
        'selector' => '.navbar',
        'value' => $header_padding_top ? $header_padding_top : false,
        'properties' => array(
            'padding-top',
        ),
    );

    if (get_post_meta($page_id, 'etmunfarid_etcodes_header_bottom_padding', true)) {
        $header_padding_bottom = get_post_meta($page_id, 'etmunfarid_etcodes_header_bottom_padding', true) . 'px';
    } else {
        $header_padding_bottom = get_theme_mod('etmunfarid_etcodes_header_bottom_padding') . 'px';
    }
    $classes[] = array(
        'selector' => '.navbar',
        'value' => $header_padding_bottom ? $header_padding_bottom : false,
        'properties' => array(
            'padding-bottom',
        ),
	);
	
	$etmunfarid_etcodes_absolute_header = get_post_meta($page_id, 'etmunfarid_etcodes_header_full_width', true) == 'on' ? get_post_meta($page_id, 'etmunfarid_etcodes_header_full_width', true) : get_theme_mod( 'etmunfarid_etcodes_header_width', false );
	
	if($etmunfarid_etcodes_absolute_header){
    	if (get_post_meta($page_id, 'etmunfarid_etcodes_fluid_header_x_padding', true)) {
    	    $fluid_header_x_padding = get_post_meta($page_id, 'etmunfarid_etcodes_fluid_header_x_padding', true) . 'px';
    	} else {
    	    $fluid_header_x_padding = get_theme_mod('etmunfarid_etcodes_fluid_header_x_padding') . 'px';
		}
    	$classes[] = array(
    	    'selector' => '.navbar',
    	    'value' => $fluid_header_x_padding ? $fluid_header_x_padding : false,
    	    'properties' => array(
    	        'padding-right',
    	        'padding-left',
    	    ),
    	);
	}

    if (get_theme_mod('etmunfarid_etcodes_absolute_header')) {
        $classes[] = array(
            'selector' => '.navbar',
            'value' => 'transparent',
            'properties' => array(
                'background-color',
            ),
        );
        $classes[] = array(
            'selector' => '.absolute_header:before',
            'value' => get_theme_mod('etmunfarid_etcodes_header_bg_color'),
            'properties' => array(
                'background-color',
            ),
        );
        $classes[] = array(
            'selector' => '.absolute_header:before',
            'value' => get_theme_mod('etmunfarid_etcodes_absolute_header_bg_opacity') * .01,
            'properties' => array(
                'opacity',
            ),
        );
    }

    // Top bar

    if (get_theme_mod('etmunfarid_etcodes_header_top_bar_enable')) {
        $classes[] = array(
            'selector' => '.top_header',
            'value' => get_theme_mod('etmunfarid_etcodes_topbar_bg_color'),
            'properties' => array(
                'background-color',
            ),
        );
        $classes[] = array(
            'selector' => '.top_header, .top_header a',
            'value' => get_theme_mod('etmunfarid_etcodes_topbar_text_color'),
            'properties' => array(
                'color',
            ),
        );
    }

    if (is_page()) {
        // Single Page Background
        $classes[] = array(
            'selector' => 'body',
            'value' => get_post_meta($page_id, 'etmunfarid_etcodes_page_background', true) ? get_post_meta($page_id, 'etmunfarid_etcodes_page_background', true) : false,
            'properties' => array(
                'background-color',
            ),
        );

        // Page title
        $classes[] = array(
            'selector' => '.page-main-title > .container > .row',
            'value' => get_theme_mod('etmunfarid_etcodes_page_title_container_height') ? get_theme_mod('etmunfarid_etcodes_page_title_container_height') . 'vh' : false,
            'properties' => array(
                'height',
            ),
        );
        $classes[] = array(
            'selector' => '.page-main-title',
            'value' => get_theme_mod('etmunfarid_etcodes_page_title_fluid_container_x_padding') ? get_theme_mod('etmunfarid_etcodes_page_title_fluid_container_x_padding') . 'vw' : false,
            'properties' => array(
                'padding-right',
                'padding-left',
            ),
        );

        $classes[] = array(
            'selector' => '.page-main-title',
            'value' => get_post_meta($page_id, 'etmunfarid_etcodes_page_title_background', true) ? get_post_meta($page_id, 'etmunfarid_etcodes_page_title_background', true) : get_theme_mod('etmunfarid_etcodes_page_title_container_bg_color'),
            'properties' => array(
                'background-color',
            ),
        );

        if (get_post_meta($page_id, 'etmunfarid_etcodes_page_title_background_img', true) || get_theme_mod('etmunfarid_etcodes_page_title_container_bg_img')) {

            $page_title_bg_img = wp_get_attachment_image_src(get_post_meta($page_id, 'etmunfarid_etcodes_page_title_background_img', true), 'full');
            $page_title_bg_img = $page_title_bg_img ? $page_title_bg_img : get_theme_mod('etmunfarid_etcodes_page_title_container_bg_img');

            $page_title_bg_img = is_array($page_title_bg_img) ? $page_title_bg_img[0] : $page_title_bg_img;

            $classes[] = array(
                'selector' => '.page-main-title',
                'value' => $page_title_bg_img ? 'url(' . $page_title_bg_img . ')' : false,
                'properties' => array(
                    'background-image',
                ),
            );
            
            $classes[] = array(
                'selector' => '.page-main-title',
                'value' => get_theme_mod('etmunfarid_etcodes_page_title_container_bg_size'),
                'properties' => array(
                    'background-size',
                ),
            );
            if (get_theme_mod('etmunfarid_etcodes_page_title_container_bg_size') == 'contain') {
                $classes[] = array(
                    'selector' => '.page-main-title',
                    'value' => 'no-repeat',
                    'properties' => array(
                        'background-repeat',
                    ),
                );
            }

            $position_x = get_theme_mod('etmunfarid_etcodes_page_title_container_background_position_x', '');
            $position_y = get_theme_mod('etmunfarid_etcodes_page_title_container_background_position_y', '');
            if (!in_array($position_x, array('left', 'center', 'right'), true)) {
                $position_x = 'left';
            }
            if (!in_array($position_y, array('top', 'center', 'bottom'), true)) {
                $position_y = 'top';
            }
            $classes[] = array(
                'selector' => '.page-main-title',
                'value' => $position_x . ' ' . $position_y,
                'properties' => array(
                    'background-position',
                ),
            );

            $classes[] = array(
                'selector' => '.page-main-title',
                'value' => get_theme_mod('etmunfarid_etcodes_page_title_container_bg_scroll') ? 'scroll' : 'fixed',
                'properties' => array(
                    'background-attachment',
                ),
            );

            if (get_theme_mod('etmunfarid_etcodes_page_title_container_overlay')) {
                $classes[] = array(
                    'selector' => '.page-main-title:before ',
                    'value' => get_theme_mod('etmunfarid_etcodes_page_title_container_overlay_color'),
                    'properties' => array(
                        'background-color',
                    ),
                );
                $classes[] = array(
                    'selector' => '.page-main-title:before',
                    'value' => get_theme_mod('etmunfarid_etcodes_page_title_container_overlay_opacity') * .01,
                    'properties' => array(
                        'opacity',
                    ),
                );
            }
        }
    }

    // Blog
    if (get_theme_mod('etmunfarid_etcodes_blog_page_width') && (is_home('page_for_posts') || is_archive('post'))) {
        $classes[] = array(
            'selector' => '.blog .entry-content.container-fluid',
            'value' => get_theme_mod('etmunfarid_etcodes_blog_page_width_vw') ? get_theme_mod('etmunfarid_etcodes_blog_page_width_vw') . 'vw' : false,
            'properties' => array(
                'width',
            ),
        );
    }

    // Woocommarce
    if (get_theme_mod('etmunfarid_etcodes_woocommerce_catalog_page_width')) {
        $classes[] = array(
            'selector' => '.post-type-archive-product.woocommerce.woocommerce-page .entry-content.container-fluid',
            'value' => get_theme_mod('etmunfarid_etcodes_woocommerce_catalog_page_width_vw') ? get_theme_mod('etmunfarid_etcodes_woocommerce_catalog_page_width_vw') . 'vw' : false,
            'properties' => array(
                'width',
            ),
        );

    }

    // Add css value of each setting

    foreach ($classes as $class) {
 
        if ($class['value'] && !empty($class['value']) && $class['value'] !== 'px' ) {
            foreach ($class['properties'] as $property) {
                $custom_css .= $class['selector'] . ' {' . $property . ': ' . $class['value'] . ';}';
            }
        }
    }
    wp_add_inline_style('etmunfarid-etcodes-app-build', $custom_css);
}
