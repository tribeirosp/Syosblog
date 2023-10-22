<?php if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}

add_action('add_meta_boxes', 'etmunfarid_etcodes_metabox_page');
function etmunfarid_etcodes_metabox_page()
{

    $prefix = 'etmunfarid_etcodes_';
/*===================================================================*/
/*  1 - Page Settings
/*===================================================================*/
    $meta_box = array(
        'id' => 'etcodes-meta-box-page',
        'title' => esc_html__('Page Settings', 'munfarid'),
        'page' => 'page',
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => esc_html__('Page Background Color:', 'munfarid'),
                'id' => $prefix . 'page_background',
                'type' => 'color',
                'desc' => esc_html__('Adjust the color for this page background.', 'munfarid'),
                'std' => '',
                'val' => '',
            ),
            array(
                'name' => esc_html__('Header Style:', 'munfarid'),
                'desc' => esc_html__('Select an alternate header style for page.', 'munfarid'),
                'id' => $prefix . 'header_style',
                'type' => 'select',
                'std' => '',
                'options' => array(
                    '' => esc_html__('Default ', 'munfarid'),
                    'header-one' => esc_html__('Logo & Menu Vertical Align', 'munfarid'),
                    'header-two' => esc_html__('Logo Between Two Menus', 'munfarid'),
                    'header-three' => esc_html__('Top Logo', 'munfarid'),
                    'header-four' => esc_html__('Left Align', 'munfarid'),
                    'header-five' => esc_html__('Logo & Hamburger Menu Vertical Align', 'munfarid'),
                    'header-six' => esc_html__('Sidebar Header', 'munfarid'),
                    'header-seven' => esc_html__('Center Align logo with Hamburger Menu', 'munfarid'),
                ),
            ),
            array(
                'name' => esc_html__('Nav Align', 'munfarid'),
                'desc' => esc_html__('Select Nav Align for this page header.', 'munfarid'),
                'id' => $prefix . 'page_nav_align',
                'type' => 'radio',
                'std' => '',
                'options' => array(
                    'nav-align-left' => esc_html__('Left', 'munfarid'),
                    'nav-align-center' => esc_html__('Center', 'munfarid'),
                    'nav-align-right' => esc_html__('Right', 'munfarid'),
                ),
            ),
            array(
                'name' => esc_html__('Header Background Color:', 'munfarid'),
                'id' => $prefix . 'header_background',
                'type' => 'color',
                'desc' => esc_html__('Adjust the color for this header background.', 'munfarid'),
                'std' => '',
                'val' => '',
            ),
            array(
                'name' => esc_html__('Logo Color Scheme:', 'munfarid'),
                'desc' => esc_html__('Select the Logo Color Scheme for this page header.', 'munfarid'),
                'id' => $prefix . 'page_logo_color_scheme',
                'type' => 'radio',
                'std' => '',
                'options' => array(
                    'dark' => esc_html__('Dark', 'munfarid'),
                    'light' => esc_html__('Light', 'munfarid'),
                ),
            ),
            array(
                'name' => esc_html__('Header Nav Color:', 'munfarid'),
                'id' => $prefix . 'header_nav_color',
                'type' => 'color',
                'desc' => esc_html__('Adjust the color for this header navigation.', 'munfarid'),
                'std' => '',
                'val' => '',
            ),
            array(
                'name' => esc_html__('Header Top Padding:', 'munfarid'),
                'id' => $prefix . 'header_top_padding',
                'type' => 'text',
                'desc' => esc_html__('Header top padding.', 'munfarid'),
                'std' => '',
                'val' => '',
            ),
            array(
                'name' => esc_html__('Header Bottom Padding:', 'munfarid'),
                'id' => $prefix . 'header_bottom_padding',
                'type' => 'text',
                'desc' => esc_html__('Header bottom padding.', 'munfarid'),
                'std' => '',
                'val' => '',
            ),
            array(
                'name' => esc_html__('Header Full Width?', 'munfarid'),
                'id' => $prefix . 'header_full_width',
                'type' => 'checkbox',
                'desc' => esc_html__('Select to set header width full for this page.', 'munfarid'),
                'std' => false,
            ),
            array(
                'name' => esc_html__('Header Side Padding:', 'munfarid'),
                'id' => $prefix . 'fluid_header_x_padding',
                'type' => 'text',
                'desc' => esc_html__('Header right left padding.', 'munfarid'),
                'std' => '',
                'val' => '',
            ),
            array(
                'name' => esc_html__('Absolute Header?', 'munfarid'),
                'id' => $prefix . 'absolute_header',
                'type' => 'checkbox',
                'desc' => esc_html__('Make the header position absolute on this page?', 'munfarid'),
                'std' => false,
            ),
            array(
                'name' => esc_html__('Sticky Header?', 'munfarid'),
                'id' => $prefix . 'sticky_header',
                'type' => 'checkbox',
                'desc' => esc_html__('Make the header stick with the scroll on this page?', 'munfarid'),
                'std' => false,
            ),
            array(
                'name' => esc_html__('Social Icons in header?', 'munfarid'),
                'id' => $prefix . 'is_header_social_icons',
                'type' => 'checkbox',
                'desc' => esc_html__('Display Social Icons in header on this page?', 'munfarid'),
                'std' => false,
            ),
            array(
                'name' => esc_html__('Search bar?', 'munfarid'),
                'id' => $prefix . 'is_header_search_bar',
                'type' => 'checkbox',
                'desc' => esc_html__('Display Search bar in header on this page?', 'munfarid'),
                'std' => false,
            ),
            array(
                'name' => esc_html__('Shopping cart in header?', 'munfarid'),
                'id' => $prefix . 'is_header_shopping_cart',
                'type' => 'checkbox',
                'desc' => esc_html__('Display Shopping cart in header on this page?', 'munfarid'),
                'std' => false,
            ),
            array(
                'name' => esc_html__('Top Header bar?', 'munfarid'),
                'id' => $prefix . 'is_top_header_bar',
                'type' => 'checkbox',
                'desc' => esc_html__('Display top header bar on this page?', 'munfarid'),
                'std' => false,
            ),
            array(
                'name' => esc_html__('Select Custom Footer:', 'munfarid'),
                'desc' => esc_html__('Select an alternate footer for this page.', 'munfarid') . ' <a href="' . esc_url(admin_url('edit.php?post_type=etcodes-footer')) . '" target="_blank">' . esc_html__('To create or customize footer click me', 'munfarid') . '</a>.',
                'id' => $prefix . 'custom_footer',
                'type' => 'select',
                'std' => '',
                'options' => etmunfarid_etcodes_footers_list(),
            ),
        ),
    );
    etmunfarid_etcodes_add_meta_box($meta_box);

/*===================================================================*/
/*  1 - Page Title Settings
/*===================================================================*/
    $meta_box = array(
        'id' => 'etcodes-meta-box-page-title',
        'title' => esc_html__('Page Title Settings', 'munfarid'),
        'page' => 'page',
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => esc_html__('Display Page Title:', 'munfarid'),
                'id' => $prefix . 'page_title',
                'type' => 'checkbox',
                'desc' => esc_html__('Select to display the page title above the main entry content.', 'munfarid'),
                'std' => true,
            ),
            array(
                'name' => esc_html__('Title Position:', 'munfarid'),
                'desc' => esc_html__('Select to adjust title position.', 'munfarid'),
                'id' => $prefix . 'page_title_position',
                'type' => 'radio',
                'std' => 'text-left',
                'options' => array(
                    'text-left' => esc_html__('Left', 'munfarid'),
                    'text-center' => esc_html__('Center', 'munfarid'),
                    'text-right' => esc_html__('Right', 'munfarid'),
                ),
            ),
            array(
                'name' => esc_html__('Page Title Container Background Color:', 'munfarid'),
                'id' => $prefix . 'page_title_background',
                'type' => 'color',
                'desc' => esc_html__('Adjust the color for this page title container background.', 'munfarid'),
                'std' => '',
                'val' => '',
            ),
            array(
                'name' => esc_html__('Page Title Container Background Image:', 'munfarid'),
                'id' => $prefix . 'page_title_background_img',
                'type' => 'image',
                'desc' => esc_html__('Browse & Upload', 'munfarid'),
                'std' => '',
            ),

        ),
    );
    etmunfarid_etcodes_add_meta_box($meta_box);

}
