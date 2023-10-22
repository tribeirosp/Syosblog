<?php if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}
$theme = wp_get_theme();
if ( 'Sada' !== $theme->name || 'Sada' !== $theme->parent_theme || 'Munfarid' !== $theme->name || 'Munfarid' !== $theme->parent_theme ) {
    add_action('add_meta_boxes', 'etdabba_etcodes_metabox_page');
}

function etdabba_etcodes_metabox_page()
{

    $prefix = 'ecp_etcodes_';
    
/*===================================================================*/
/*  1 - Page Settings
/*===================================================================*/
    $meta_box = array(
        'id' => 'etcodes-meta-box-page',
        'title' => esc_html__('Page Settings', 'dabba'),
        'page' => 'page',
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => esc_html__('Page Background Color:', 'dabba'),
                'id' => $prefix . 'page_background',
                'type' => 'color',
                'desc' => esc_html__('Adjust the color for this page background.', 'dabba'),
                'std' => '',
                'val' => '',
            ),
            array(
                'name' => esc_html__('Header Style:', 'dabba'),
                'desc' => esc_html__('Select an alternate header style for page.', 'dabba'),
                'id' => $prefix . 'header_style',
                'type' => 'select',
                'std' => '',
                'options' => array(
                    '' => esc_html__('Default ', 'dabba'),
                    'header-one' => esc_html__('Logo & Menu Vertical Align', 'dabba'),
                    'header-two' => esc_html__('Logo Between Two Menus', 'dabba'),
                    'header-three' => esc_html__('Top Logo', 'dabba'),
                    'header-four' => esc_html__('Left Align', 'dabba'),
                    'header-five' => esc_html__('Logo & Hamburger Menu Vertical Align', 'dabba'),
                    'header-six' => esc_html__('Sidebar Header', 'dabba'),
                    'header-seven' => esc_html__('Center Align logo with Hamburger Menu', 'dabba'),
                ),
            ),
            array(
                'name' => esc_html__('Nav Align', 'dabba'),
                'desc' => esc_html__('Select Nav Align for this page header.', 'dabba'),
                'id' => $prefix . 'page_nav_align',
                'type' => 'radio',
                'std' => '',
                'options' => array(
                    'nav-align-left' => esc_html__('Left', 'dabba'),
                    'nav-align-center' => esc_html__('Center', 'dabba'),
                    'nav-align-right' => esc_html__('Right', 'dabba'),
                ),
            ),
            array(
                'name' => esc_html__('Header Background Color:', 'dabba'),
                'id' => $prefix . 'header_background',
                'type' => 'color',
                'desc' => esc_html__('Adjust the color for this header background.', 'dabba'),
                'std' => '',
                'val' => '',
            ),
            array(
                'name' => esc_html__('Logo Color Scheme:', 'dabba'),
                'desc' => esc_html__('Select the Logo Color Scheme for this page header.', 'dabba'),
                'id' => $prefix . 'page_logo_color_scheme',
                'type' => 'radio',
                'std' => '',
                'options' => array(
                    'dark' => esc_html__('Dark', 'dabba'),
                    'light' => esc_html__('Light', 'dabba'),
                ),
            ),
            array(
                'name' => esc_html__('Header Nav Color:', 'dabba'),
                'id' => $prefix . 'header_nav_color',
                'type' => 'color',
                'desc' => esc_html__('Adjust the color for this header navigation.', 'dabba'),
                'std' => '',
                'val' => '',
            ),
            array(
                'name' => esc_html__('Header Top Padding:', 'dabba'),
                'id' => $prefix . 'header_top_padding',
                'type' => 'text',
                'desc' => esc_html__('Header top padding.', 'dabba'),
                'std' => '',
                'val' => '',
            ),
            array(
                'name' => esc_html__('Header Bottom Padding:', 'dabba'),
                'id' => $prefix . 'header_bottom_padding',
                'type' => 'text',
                'desc' => esc_html__('Header bottom padding.', 'dabba'),
                'std' => '',
                'val' => '',
            ),
            array(
                'name' => esc_html__('Header Full Width?', 'dabba'),
                'id' => $prefix . 'header_full_width',
                'type' => 'checkbox',
                'desc' => esc_html__('Select to set header width full for this page.', 'dabba'),
                'std' => false,
            ),
            array(
                'name' => esc_html__('Header Side Padding:', 'dabba'),
                'id' => $prefix . 'fluid_header_x_padding',
                'type' => 'text',
                'desc' => esc_html__('Header right left padding.', 'dabba'),
                'std' => '',
                'val' => '',
            ),
            array(
                'name' => esc_html__('Absolute Header?', 'dabba'),
                'id' => $prefix . 'absolute_header',
                'type' => 'checkbox',
                'desc' => esc_html__('Make the header position absolute on this page?', 'dabba'),
                'std' => false,
            ),
            array(
                'name' => esc_html__('Sticky Header?', 'dabba'),
                'id' => $prefix . 'sticky_header',
                'type' => 'checkbox',
                'desc' => esc_html__('Make the header stick with the scroll on this page?', 'dabba'),
                'std' => false,
            ),
            array(
                'name' => esc_html__('Social Icons in header?', 'dabba'),
                'id' => $prefix . 'is_header_social_icons',
                'type' => 'checkbox',
                'desc' => esc_html__('Display Social Icons in header on this page?', 'dabba'),
                'std' => false,
            ),
            array(
                'name' => esc_html__('Search bar?', 'dabba'),
                'id' => $prefix . 'is_header_search_bar',
                'type' => 'checkbox',
                'desc' => esc_html__('Display Search bar in header on this page?', 'dabba'),
                'std' => false,
            ),
            array(
                'name' => esc_html__('Shopping cart in header?', 'dabba'),
                'id' => $prefix . 'is_header_shopping_cart',
                'type' => 'checkbox',
                'desc' => esc_html__('Display Shopping cart in header on this page?', 'dabba'),
                'std' => false,
            ),
            array(
                'name' => esc_html__('Top Header bar?', 'dabba'),
                'id' => $prefix . 'is_top_header_bar',
                'type' => 'checkbox',
                'desc' => esc_html__('Display top header bar on this page?', 'dabba'),
                'std' => false,
            ),
            array(
                'name' => esc_html__('Select Custom Footer:', 'dabba'),
                'desc' => esc_html__('Select an alternate footer for this page.', 'dabba') . ' <a href="' . esc_url(admin_url('edit.php?post_type=etcodes-footer')) . '" target="_blank">' . esc_html__('To create or customize footer click me', 'dabba') . '</a>.',
                'id' => $prefix . 'custom_footer',
                'type' => 'select',
                'std' => '',
                'options' => ecp_etcodes_footers_list(),
            ),
        ),
    );
    ecp_add_meta_box($meta_box);

/*===================================================================*/
/*  1 - Page Title Settings
/*===================================================================*/
    $meta_box = array(
        'id' => 'etcodes-meta-box-page-title',
        'title' => esc_html__('Page Title Settings', 'dabba'),
        'page' => 'page',
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => esc_html__('Display Page Title:', 'dabba'),
                'id' => $prefix . 'page_title',
                'type' => 'checkbox',
                'desc' => esc_html__('Select to display the page title above the main entry content.', 'dabba'),
                'std' => true,
            ),
            array(
                'name' => esc_html__('Title Position:', 'dabba'),
                'desc' => esc_html__('Select to adjust title position.', 'dabba'),
                'id' => $prefix . 'page_title_position',
                'type' => 'radio',
                'std' => 'text-left',
                'options' => array(
                    'text-left' => esc_html__('Left', 'dabba'),
                    'text-center' => esc_html__('Center', 'dabba'),
                    'text-right' => esc_html__('Right', 'dabba'),
                ),
            ),
            array(
                'name' => esc_html__('Page Title Container Background Color:', 'dabba'),
                'id' => $prefix . 'page_title_background',
                'type' => 'color',
                'desc' => esc_html__('Adjust the color for this page title container background.', 'dabba'),
                'std' => '',
                'val' => '',
            ),
            array(
                'name' => esc_html__('Page Title Container Background Image:', 'dabba'),
                'id' => $prefix . 'page_title_background_img',
                'type' => 'image',
                'desc' => esc_html__('Browse & Upload', 'dabba'),
                'std' => '',
            ),

        ),
    );
    ecp_add_meta_box($meta_box);

}
