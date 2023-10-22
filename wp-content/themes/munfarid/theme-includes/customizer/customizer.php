<?php

if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}

function etmunfarid_etcodes_customizer_register($wp_customize)
{
    // Load the customizer controls classes.
    require_once trailingslashit(get_template_directory()) . 'theme-includes/customizer/customizer-controls/control-radio-image.php';
    require_once trailingslashit(get_template_directory()) . 'theme-includes/customizer/customizer-controls/control-toggle.php';
    require_once trailingslashit(get_template_directory()) . 'theme-includes/customizer/customizer-controls/control-range.php';
    require_once trailingslashit(get_template_directory()) . 'theme-includes/customizer/customizer-controls/control-google-font.php';

    $wp_customize->register_control_type('Etcodes_Toggle_Control');
    $wp_customize->register_control_type('Etcodes_Image_Select_Control');
    $wp_customize->register_control_type('Etcodes_Range_Control');

    /*******************************************
    Header
     ********************************************/
    $wp_customize->add_panel('etmunfarid_etcodes_header', array(
        'priority' => 10,
        'capability' => 'edit_theme_options',
        'title' => esc_html__('Header', 'munfarid'),
    ));
    /***** Add the General header section *****/
    $wp_customize->add_section('etmunfarid_etcodes_general_header', array(
        'title' => esc_html__('General', 'munfarid'),
        'panel' => 'etmunfarid_etcodes_header',
    ));

    // Add the Header style setting and control.

    $wp_customize->add_setting('etmunfarid_etcodes_header_style', array(
        'default' => 'header-one',
        'sanitize_callback' => 'sanitize_key',
    ));
    $wp_customize->add_control(new Etcodes_Image_Select_Control($wp_customize, 'etmunfarid_etcodes_header_style', array(
        'label' => esc_html__('Header Style', 'munfarid'),
        'section' => 'etmunfarid_etcodes_general_header',
        'settings' => 'etmunfarid_etcodes_header_style',
        'choices' => array(
            'header-one' => array(
                'label' => esc_html__('Header', 'munfarid'),
                'url' => '%s/assets/images/admin/fluid.jpg',
            ),
            'header-two' => array(
                'label' => esc_html__('Header', 'munfarid'),
                'url' => '%s/assets/images/admin/header-type2.jpg',
            ),
            'header-three' => array(
                'label' => esc_html__('Header', 'munfarid'),
                'url' => '%s/assets/images/admin/header-type3.jpg',
            ),
            'header-four' => array(
                'label' => esc_html__('Header', 'munfarid'),
                'url' => '%s/assets/images/admin/header-type4.jpg',
            ),
            'header-five' => array(
                'label' => esc_html__('Header', 'munfarid'),
                'url' => '%s/assets/images/admin/header-type5.jpg',
            ),
            'header-six' => array(
                'label' => esc_html__('Header', 'munfarid'),
                'url' => '%s/assets/images/admin/header-type6.jpg',
            ),
            'header-seven' => array(
                'label' => esc_html__('Header', 'munfarid'),
                'url' => '%s/assets/images/admin/header-type7.jpg',
            ),
        ),
    )));

    // Add the Logo Align setting and control.

    $wp_customize->add_setting('etmunfarid_etcodes_logo_align', array(
        'default' => 'logo-align-left',
        'sanitize_callback' => 'sanitize_key',
    ));
    $wp_customize->add_control('etmunfarid_etcodes_logo_align', array(
        'label' => esc_html__('Logo Align', 'munfarid'),
        'section' => 'etmunfarid_etcodes_general_header',
        'settings' => 'etmunfarid_etcodes_logo_align',
        'type' => 'radio',
        'choices' => array(
            'logo-align-left' => esc_html__('Left', 'munfarid'),
            'logo-align-right' => esc_html__('Right', 'munfarid'),
        ),
    ));

    // Add the Nav Align setting and control.

    $wp_customize->add_setting('etmunfarid_etcodes_nav_align', array(
        'default' => 'nav-align-center',
        'sanitize_callback' => 'sanitize_key',
    ));
    $wp_customize->add_control('etmunfarid_etcodes_nav_align', array(
        'label' => esc_html__('Nav Align', 'munfarid'),
        'section' => 'etmunfarid_etcodes_general_header',
        'settings' => 'etmunfarid_etcodes_nav_align',
        'type' => 'radio',
        'choices' => array(
            'nav-align-left' => esc_html__('Left', 'munfarid'),
            'nav-align-center' => esc_html__('Center', 'munfarid'),
            'nav-align-right' => esc_html__('Right', 'munfarid'),
        ),
    ));

    // Header six text bar

    $wp_customize->add_setting('etmunfarid_etcodes_header_six_text', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('etmunfarid_etcodes_header_six_text', array(
        'label' => esc_html__('Text', 'munfarid'),
        'description' => esc_html__('This top bar text is usually used for an email address or phone number', 'munfarid'),
        'section' => 'etmunfarid_etcodes_general_header',
        'settings' => 'etmunfarid_etcodes_header_six_text',
        'type' => 'textarea',
    ));

    // Header Background Color

    $wp_customize->add_setting('etmunfarid_etcodes_header_bg_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'etmunfarid_etcodes_header_bg_color', array(
        'label' => esc_html__('Header Background Color', 'munfarid'),
        'section' => 'etmunfarid_etcodes_general_header',
        'settings' => 'etmunfarid_etcodes_header_bg_color',
    )));

    // Header Top padding

    $wp_customize->add_setting('etmunfarid_etcodes_header_top_padding', array(
        'default' => 0,
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control(new Etcodes_Range_Control($wp_customize, 'etmunfarid_etcodes_header_top_padding', array(
        'type' => 'etcodes-range',
        'label' => esc_html__('Top Padding', 'munfarid'),
        'section' => 'etmunfarid_etcodes_general_header',
        'settings' => 'etmunfarid_etcodes_header_top_padding',
        'default' => 0,
        'description' => 'px',
        'input_attrs' => array(
            'min' => 0,
            'max' => 300,
            'step' => 1,
        ),
    )));

    // Header Bottom padding

    $wp_customize->add_setting('etmunfarid_etcodes_header_bottom_padding', array(
        'default' => 0,
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control(new Etcodes_Range_Control($wp_customize, 'etmunfarid_etcodes_header_bottom_padding', array(
        'type' => 'etcodes-range',
        'label' => esc_html__('Bottom Padding', 'munfarid'),
        'section' => 'etmunfarid_etcodes_general_header',
        'settings' => 'etmunfarid_etcodes_header_bottom_padding',
        'default' => 0,
        'description' => 'px',
        'input_attrs' => array(
            'min' => 0,
            'max' => 300,
            'step' => 1,
        ),
    )));

    // Header Full Width toggle
    $wp_customize->add_setting('etmunfarid_etcodes_header_width', array(
        'default' => false,
        'sanitize_callback' => 'etcodes_sanitize_checkbox',
    ));
    $wp_customize->add_control(new Etcodes_Toggle_Control($wp_customize, 'etmunfarid_etcodes_header_width', array(
        'label' => esc_html__('Header Full Width', 'munfarid'),
        'section' => 'etmunfarid_etcodes_general_header',
        'settings' => 'etmunfarid_etcodes_header_width',
        'type' => 'toggle',
    )));

    // Header Side padding
    $wp_customize->add_setting('etmunfarid_etcodes_fluid_header_x_padding', array(
        'default' => 0,
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control(new Etcodes_Range_Control($wp_customize, 'etmunfarid_etcodes_fluid_header_x_padding', array(
        'type' => 'etcodes-range',
        'label' => esc_html__('Side Padding', 'munfarid'),
        'section' => 'etmunfarid_etcodes_general_header',
        'settings' => 'etmunfarid_etcodes_fluid_header_x_padding',
        'default' => 0,
        'description' => 'px',
        'input_attrs' => array(
            'min' => 0,
            'max' => 300,
            'step' => 1,
        ),
    )));

    // Absolute Header
    $wp_customize->add_setting('etmunfarid_etcodes_absolute_header', array(
        'default' => false,
        'sanitize_callback' => 'etcodes_sanitize_checkbox',
    ));
    $wp_customize->add_control(new Etcodes_Toggle_Control($wp_customize, 'etmunfarid_etcodes_absolute_header', array(
        'label' => esc_html__('Absolute Header', 'munfarid'),
        'description' => esc_html__('Make the header position absolute?', 'munfarid'),
        'section' => 'etmunfarid_etcodes_general_header',
        'settings' => 'etmunfarid_etcodes_absolute_header',
        'type' => 'toggle',
    )));

    // Absolute Header bg opacity

    $wp_customize->add_setting('etmunfarid_etcodes_absolute_header_bg_opacity', array(
        'default' => 100,
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control(new Etcodes_Range_Control($wp_customize, 'etmunfarid_etcodes_absolute_header_bg_opacity', array(
        'type' => 'etcodes-range',
        'label' => esc_html__('Absolute Header bg opacity', 'munfarid'),
        'settings' => 'etmunfarid_etcodes_absolute_header_bg_opacity',
        'section' => 'etmunfarid_etcodes_general_header',
        'description' => '%',
        'default' => 50,
        'input_attrs' => array(
            'min' => 0,
            'max' => 100,
            'step' => 1,
        ),
    )));

    // Sticky Header

    $wp_customize->add_setting('etmunfarid_etcodes_sticky_header', array(
        'default' => false,
        'sanitize_callback' => 'etcodes_sanitize_checkbox',
    ));
    $wp_customize->add_control(new Etcodes_Toggle_Control($wp_customize, 'etmunfarid_etcodes_sticky_header', array(
        'label' => esc_html__('Sticky Header', 'munfarid'),
        'description' => esc_html__('Make the header stick with the scroll.', 'munfarid'),
        'section' => 'etmunfarid_etcodes_general_header',
        'settings' => 'etmunfarid_etcodes_sticky_header',
        'type' => 'toggle',
    )));

    // Social Icons

    $wp_customize->add_setting('etmunfarid_etcodes_header_header_Social_icons', array(
        'default' => false,
        'sanitize_callback' => 'etcodes_sanitize_checkbox',
    ));
    $wp_customize->add_control(new Etcodes_Toggle_Control($wp_customize, 'etmunfarid_etcodes_header_header_Social_icons', array(
        'label' => esc_html__('Social Icons in header', 'munfarid'),
        'section' => 'etmunfarid_etcodes_general_header',
        'settings' => 'etmunfarid_etcodes_header_header_Social_icons',
        'type' => 'toggle',
    )));

    // Search bar

    $wp_customize->add_setting('etmunfarid_etcodes_header_search', array(
        'default' => false,
        'sanitize_callback' => 'etcodes_sanitize_checkbox',
    ));
    $wp_customize->add_control(new Etcodes_Toggle_Control($wp_customize, 'etmunfarid_etcodes_header_search', array(
        'label' => esc_html__('Search bar', 'munfarid'),
        'section' => 'etmunfarid_etcodes_general_header',
        'settings' => 'etmunfarid_etcodes_header_search',
        'type' => 'toggle',
    )));

    // Shopping cart in header

    $wp_customize->add_setting('etmunfarid_etcodes_header_shopping_cart', array(
        'default' => false,
        'sanitize_callback' => 'etcodes_sanitize_checkbox',
    ));
    $wp_customize->add_control(new Etcodes_Toggle_Control($wp_customize, 'etmunfarid_etcodes_header_shopping_cart', array(
        'label' => esc_html__('Shopping cart in header', 'munfarid'),
        'section' => 'etmunfarid_etcodes_general_header',
        'settings' => 'etmunfarid_etcodes_header_shopping_cart',
        'type' => 'toggle',
    )));
    /***** Add the Header Top Bar section *****/
    $wp_customize->add_section('etmunfarid_etcodes_header_top_bar', array(
        'title' => esc_html__('Header Top Bar', 'munfarid'),
        'panel' => 'etmunfarid_etcodes_header',
    ));

    // Top Bar

    $wp_customize->add_setting('etmunfarid_etcodes_header_top_bar_enable', array(
        'default' => false,
        'sanitize_callback' => 'etcodes_sanitize_checkbox',
    ));
    $wp_customize->add_control(new Etcodes_Toggle_Control($wp_customize, 'etmunfarid_etcodes_header_top_bar_enable', array(
        'label' => esc_html__('Top Bar', 'munfarid'),
        'description' => esc_html__('Enabling this option will show top bar area', 'munfarid'),
        'section' => 'etmunfarid_etcodes_header_top_bar',
        'settings' => 'etmunfarid_etcodes_header_top_bar_enable',
        'type' => 'toggle',
    )));

    // Header Top Bar text

    $wp_customize->add_setting('etmunfarid_etcodes_header_top_bar_text', array(
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('etmunfarid_etcodes_header_top_bar_text', array(
        'label' => esc_html__('Text', 'munfarid'),
        'description' => esc_html__('This top bar text is usually used for an email address or phone number', 'munfarid'),
        'section' => 'etmunfarid_etcodes_header_top_bar',
        'settings' => 'etmunfarid_etcodes_header_top_bar_text',
        'type' => 'textarea',
    ));

    // Search bar

    $wp_customize->add_setting('etmunfarid_etcodes_header_top_bar_search', array(
        'default' => false,
        'sanitize_callback' => 'etcodes_sanitize_checkbox',
    ));
    $wp_customize->add_control(new Etcodes_Toggle_Control($wp_customize, 'etmunfarid_etcodes_header_top_bar_search', array(
        'label' => esc_html__('Search bar', 'munfarid'),
        'section' => 'etmunfarid_etcodes_header_top_bar',
        'settings' => 'etmunfarid_etcodes_header_top_bar_search',
        'type' => 'toggle',
    )));

    // Shopping cart in header top bar

    $wp_customize->add_setting('etmunfarid_etcodes_header_top_bar_shopping_cart', array(
        'default' => false,
        'sanitize_callback' => 'etcodes_sanitize_checkbox',
    ));
    $wp_customize->add_control(new Etcodes_Toggle_Control($wp_customize, 'etmunfarid_etcodes_header_top_bar_shopping_cart', array(
        'label' => esc_html__('Shopping cart in header top bar', 'munfarid'),
        'section' => 'etmunfarid_etcodes_header_top_bar',
        'settings' => 'etmunfarid_etcodes_header_top_bar_shopping_cart',
        'type' => 'toggle',
    )));

    // Social Icons

    $wp_customize->add_setting('etmunfarid_etcodes_header_top_bar_header_social_icons', array(
        'default' => false,
        'sanitize_callback' => 'etcodes_sanitize_checkbox',
    ));
    $wp_customize->add_control(new Etcodes_Toggle_Control($wp_customize, 'etmunfarid_etcodes_header_top_bar_header_social_icons', array(
        'label' => esc_html__('Social Icons in header top bar', 'munfarid'),
        'section' => 'etmunfarid_etcodes_header_top_bar',
        'settings' => 'etmunfarid_etcodes_header_top_bar_header_social_icons',
        'type' => 'toggle',
    )));

    // Tob bar Background Color

    $wp_customize->add_setting('etmunfarid_etcodes_topbar_bg_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'etmunfarid_etcodes_topbar_bg_color', array(
        'label' => esc_html__('Top bar Background Color', 'munfarid'),
        'section' => 'etmunfarid_etcodes_header_top_bar',
        'settings' => 'etmunfarid_etcodes_topbar_bg_color',
    )));

    // Tob bar Text Color

    $wp_customize->add_setting('etmunfarid_etcodes_topbar_text_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'etmunfarid_etcodes_topbar_text_color', array(
        'label' => esc_html__('Top bar Text Color', 'munfarid'),
        'section' => 'etmunfarid_etcodes_header_top_bar',
        'settings' => 'etmunfarid_etcodes_topbar_text_color',
    )));
    /***** Add the logo mobile *****/

    // Max Width

    $wp_customize->add_setting('etmunfarid_etcodes_logo_max_width', array(
        'default' => '',
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control(new Etcodes_Range_Control($wp_customize, 'etmunfarid_etcodes_logo_max_width', array(
        'type' => 'etcodes-range',
        'label' => esc_html__('Logo Max Width', 'munfarid'),
        'settings' => 'etmunfarid_etcodes_logo_max_width',
        'section' => 'title_tagline',
        'description' => 'px',
        'default' => '',
        'priority' => 9,
        'input_attrs' => array(
            'min' => 0,
            'max' => 300,
            'step' => 1,
        ),
    )));

    // Light logo

    $wp_customize->add_setting('etmunfarid_etcodes_logo_light', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'etmunfarid_etcodes_logo_light', array(
        'label' => esc_html__('Logo - Light', 'munfarid'),
        'section' => 'title_tagline',
        'settings' => 'etmunfarid_etcodes_logo_light',
        'priority' => 40,
    )));
    /*******************************************
    Typography
     ********************************************/
    $wp_customize->add_panel('etmunfarid_etcodes_typography', array(
        'priority' => 21,
        'capability' => 'edit_theme_options',
        'title' => esc_html__('Typography', 'munfarid'),
    ));
    /***** Add the Headings Typography section *****/
    $wp_customize->add_section('etmunfarid_etcodes_headings', array(
        'title' => esc_html__('Headings', 'munfarid'),
        'panel' => 'etmunfarid_etcodes_typography',
    ));

    // Headings Font Family

    $wp_customize->add_setting('etmunfarid_etcodes_headings_font', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control(new Google_Font_Dropdown_Custom_Control($wp_customize, 'etmunfarid_etcodes_headings_font', array(
        'label' => 'Font Family',
        'section' => 'etmunfarid_etcodes_headings',
        'settings' => 'etmunfarid_etcodes_headings_font',
    )));

    // Headings Font weight

    $wp_customize->add_setting('etmunfarid_etcodes_headings_font_weight', array(
        'sanitize_callback' => 'sanitize_key',
    ));
    $wp_customize->add_control('etmunfarid_etcodes_headings_font_weight', array(
        'label' => esc_html__('Font Weight', 'munfarid'),
        'description' => esc_html__('Important: Not all fonts support every font-weight.', 'munfarid'),
        'section' => 'etmunfarid_etcodes_headings',
        'settings' => 'etmunfarid_etcodes_headings_font_weight',
        'type' => 'select',
        'choices' => array(
            '' => esc_html__('Default', 'munfarid'),
            '100' => esc_html__('Extra Light: 100', 'munfarid'),
            '200' => esc_html__('Light: 200', 'munfarid'),
            '300' => esc_html__('Book: 300', 'munfarid'),
            '400' => esc_html__('Normal: 400', 'munfarid'),
            '600' => esc_html__('Semibold: 600', 'munfarid'),
            '700' => esc_html__('Bold: 700', 'munfarid'),
            '800' => esc_html__('Extra Bold: 800', 'munfarid'),
        ),
    ));

    // Headings Font Style

    $wp_customize->add_setting('etmunfarid_etcodes_headings_font_style', array(
        'sanitize_callback' => 'sanitize_key',
    ));
    $wp_customize->add_control('etmunfarid_etcodes_headings_font_style', array(
        'label' => esc_html__('Font Style', 'munfarid'),
        'section' => 'etmunfarid_etcodes_headings',
        'settings' => 'etmunfarid_etcodes_headings_font_style',
        'type' => 'select',
        'choices' => array(
            '' => esc_html__('Default', 'munfarid'),
            'normal' => esc_html__('Normal', 'munfarid'),
            'italic' => esc_html__('Italic', 'munfarid'),
        ),
    ));

    // Headings Font Color

    $wp_customize->add_setting('etmunfarid_etcodes_headings_font_color', array(
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'etmunfarid_etcodes_headings_font_color', array(
        'label' => esc_html__('Font Color', 'munfarid'),
        'section' => 'etmunfarid_etcodes_headings',
        'settings' => 'etmunfarid_etcodes_headings_font_color',
    )));
    /***** Add the Body Typography section *****/
    $wp_customize->add_section('etmunfarid_etcodes_body', array(
        'title' => esc_html__('Body', 'munfarid'),
        'panel' => 'etmunfarid_etcodes_typography',
    ));

    // Body Font Family

    $wp_customize->add_setting('etmunfarid_etcodes_body_font', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control(new Google_Font_Dropdown_Custom_Control($wp_customize, 'etmunfarid_etcodes_body_font', array(
        'label' => 'Font Family',
        'section' => 'etmunfarid_etcodes_body',
        'settings' => 'etmunfarid_etcodes_body_font',
    )));

    // Body Font weight

    $wp_customize->add_setting('etmunfarid_etcodes_body_font_weight', array(
        'sanitize_callback' => 'sanitize_key',
    ));
    $wp_customize->add_control('etmunfarid_etcodes_body_font_weight', array(
        'label' => esc_html__('Font Weight', 'munfarid'),
        'description' => esc_html__('Important: Not all fonts support every font-weight.', 'munfarid'),
        'section' => 'etmunfarid_etcodes_body',
        'settings' => 'etmunfarid_etcodes_body_font_weight',
        'type' => 'select',
        'choices' => array(
            '' => esc_html__('Default', 'munfarid'),
            '100' => esc_html__('Extra Light: 100', 'munfarid'),
            '200' => esc_html__('Light: 200', 'munfarid'),
            '300' => esc_html__('Book: 300', 'munfarid'),
            '400' => esc_html__('Normal: 400', 'munfarid'),
            '600' => esc_html__('Semibold: 600', 'munfarid'),
            '700' => esc_html__('Bold: 700', 'munfarid'),
            '800' => esc_html__('Extra Bold: 800', 'munfarid'),
        ),
    ));

    // Body Font Style

    $wp_customize->add_setting('etmunfarid_etcodes_body_font_style', array(
        'sanitize_callback' => 'sanitize_key',
    ));
    $wp_customize->add_control('etmunfarid_etcodes_body_font_style', array(
        'label' => esc_html__('Font Style', 'munfarid'),
        'section' => 'etmunfarid_etcodes_body',
        'settings' => 'etmunfarid_etcodes_body_font_style',
        'type' => 'select',
        'choices' => array(
            '' => esc_html__('Default', 'munfarid'),
            'normal' => esc_html__('Normal', 'munfarid'),
            'italic' => esc_html__('Italic', 'munfarid'),
        ),
    ));

    // Body Font size

    $wp_customize->add_setting('etmunfarid_etcodes_body_font_size', array(
        'default' => 16,
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control(new Etcodes_Range_Control($wp_customize, 'etmunfarid_etcodes_body_font_size', array(
        'type' => 'etcodes-range',
        'label' => esc_html__('Font Size', 'munfarid'),
        'section' => 'etmunfarid_etcodes_body',
        'settings' => 'etmunfarid_etcodes_body_font_size',
        'default' => 16,
        'description' => 'px',
        'input_attrs' => array(
            'min' => 0,
            'max' => 32,
            'step' => 1,
        ),
    )));

    // Body Font Color

    $wp_customize->add_setting('etmunfarid_etcodes_body_font_color', array(
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'etmunfarid_etcodes_body_font_color', array(
        'label' => esc_html__('Font Color', 'munfarid'),
        'section' => 'etmunfarid_etcodes_body',
        'settings' => 'etmunfarid_etcodes_body_font_color',
    )));

    // Body Link Color

    $wp_customize->add_setting('etmunfarid_etcodes_body_font_link_color', array(
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'etmunfarid_etcodes_body_font_link_color', array(
        'label' => esc_html__('Link Color', 'munfarid'),
        'section' => 'etmunfarid_etcodes_body',
        'settings' => 'etmunfarid_etcodes_body_font_link_color',
    )));

    // Body Link Hover Color

    $wp_customize->add_setting('etmunfarid_etcodes_body_font_link_hover_color', array(
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'etmunfarid_etcodes_body_font_link_hover_color', array(
        'label' => esc_html__('Link Hover Color', 'munfarid'),
        'section' => 'etmunfarid_etcodes_body',
        'settings' => 'etmunfarid_etcodes_body_font_link_hover_color',
    )));
    /***** Add the Menu Typography section *****/
    $wp_customize->add_section('etmunfarid_etcodes_menu', array(
        'title' => esc_html__('Menu', 'munfarid'),
        'panel' => 'etmunfarid_etcodes_typography',
    ));

    // Menu Font Family

    $wp_customize->add_setting('etmunfarid_etcodes_menu_font', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control(new Google_Font_Dropdown_Custom_Control($wp_customize, 'etmunfarid_etcodes_menu_font', array(
        'label' => 'Font Family',
        'section' => 'etmunfarid_etcodes_menu',
        'settings' => 'etmunfarid_etcodes_menu_font',
    )));

    // Menu Font weight

    $wp_customize->add_setting('etmunfarid_etcodes_menu_font_weight', array(
        'sanitize_callback' => 'sanitize_key',
    ));
    $wp_customize->add_control('etmunfarid_etcodes_menu_font_weight', array(
        'label' => esc_html__('Font Weight', 'munfarid'),
        'description' => esc_html__('Important: Not all fonts support every font-weight.', 'munfarid'),
        'section' => 'etmunfarid_etcodes_menu',
        'settings' => 'etmunfarid_etcodes_menu_font_weight',
        'type' => 'select',
        'choices' => array(
            '' => esc_html__('Default', 'munfarid'),
            '100' => esc_html__('Extra Light: 100', 'munfarid'),
            '200' => esc_html__('Light: 200', 'munfarid'),
            '300' => esc_html__('Book: 300', 'munfarid'),
            '400' => esc_html__('Normal: 400', 'munfarid'),
            '600' => esc_html__('Semibold: 600', 'munfarid'),
            '700' => esc_html__('Bold: 700', 'munfarid'),
            '800' => esc_html__('Extra Bold: 800', 'munfarid'),
        ),
    ));

    // Menu Font Style

    $wp_customize->add_setting('etmunfarid_etcodes_menu_font_style', array(
        'sanitize_callback' => 'sanitize_key',
    ));
    $wp_customize->add_control('etmunfarid_etcodes_menu_font_style', array(
        'label' => esc_html__('Font Style', 'munfarid'),
        'section' => 'etmunfarid_etcodes_menu',
        'settings' => 'etmunfarid_etcodes_menu_font_style',
        'type' => 'select',
        'choices' => array(
            '' => esc_html__('Default', 'munfarid'),
            'normal' => esc_html__('Normal', 'munfarid'),
            'italic' => esc_html__('Italic', 'munfarid'),
        ),
    ));

    // Menu Font size

    $wp_customize->add_setting('etmunfarid_etcodes_menu_font_size', array(
        'default' => 15,
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control(new Etcodes_Range_Control($wp_customize, 'etmunfarid_etcodes_menu_font_size', array(
        'type' => 'etcodes-range',
        'label' => esc_html__('Font Size', 'munfarid'),
        'section' => 'etmunfarid_etcodes_menu',
        'settings' => 'etmunfarid_etcodes_menu_font_size',
        'default' => 15,
        'description' => 'px',
        'input_attrs' => array(
            'min' => 0,
            'max' => 32,
            'step' => 1,
        ),
    )));

    // Menu Font Color

    $wp_customize->add_setting('etmunfarid_etcodes_menu_font_color', array(
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'etmunfarid_etcodes_menu_font_color', array(
        'label' => esc_html__('Font Color', 'munfarid'),
        'section' => 'etmunfarid_etcodes_menu',
        'settings' => 'etmunfarid_etcodes_menu_font_color',
    )));

    // Menu Font Hover and active Color

    $wp_customize->add_setting('etmunfarid_etcodes_menu_font_hover_active_color', array(
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'etmunfarid_etcodes_menu_font_hover_active_color', array(
        'label' => esc_html__('Font Hover and Active Color', 'munfarid'),
        'section' => 'etmunfarid_etcodes_menu',
        'settings' => 'etmunfarid_etcodes_menu_font_hover_active_color',
    )));

    /*******************************************
    Colors
     ********************************************/

    // Accent color
    $wp_customize->add_setting('etmunfarid_etcodes_accent_color', array(
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'etmunfarid_etcodes_accent_color', array(
        'label' => esc_html__('Accent color', 'munfarid'),
        'description' => esc_html__('Choose the most dominant theme color.', 'munfarid'),
        'section' => 'colors',
        'settings' => 'etmunfarid_etcodes_accent_color',
    )));

    // Button Text Color

    $wp_customize->add_setting('etmunfarid_etcodes_btn_text_color', array(
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'etmunfarid_etcodes_btn_text_color', array(
        'label' => esc_html__('Button text color', 'munfarid'),
        'section' => 'colors',
        'settings' => 'etmunfarid_etcodes_btn_text_color',
    )));

    // Button Text Hover Color

    $wp_customize->add_setting('etmunfarid_etcodes_btn_text_hover_color', array(
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'etmunfarid_etcodes_btn_text_hover_color', array(
        'label' => esc_html__('Button text hover color', 'munfarid'),
        'section' => 'colors',
        'settings' => 'etmunfarid_etcodes_btn_text_hover_color',
    )));

    // Button background Color

    $wp_customize->add_setting('etmunfarid_etcodes_btn_background_color', array(
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'etmunfarid_etcodes_btn_background_color', array(
        'label' => esc_html__('Button background color', 'munfarid'),
        'section' => 'colors',
        'settings' => 'etmunfarid_etcodes_btn_background_color',
    )));

    // Button background Hover Color

    $wp_customize->add_setting('etmunfarid_etcodes_btn_background_hover_color', array(
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'etmunfarid_etcodes_btn_background_hover_color', array(
        'label' => esc_html__('Button background hover color', 'munfarid'),
        'section' => 'colors',
        'settings' => 'etmunfarid_etcodes_btn_background_hover_color',
    )));
    /*******************************************
    Blog panel
     ********************************************/
    $wp_customize->add_panel('etmunfarid_etcodes_blog', array(
        'capability' => 'edit_theme_options',
        'title' => esc_html__('Blog', 'munfarid'),
    ));
    /***** Add the Posts section *****/
    $wp_customize->add_section('etmunfarid_etcodes_posts', array(
        'title' => esc_html__('General Posts', 'munfarid'),
        'panel' => 'etmunfarid_etcodes_blog',
    ));

    // Add the Blog page width

    $wp_customize->add_setting('etmunfarid_etcodes_blog_page_width', array(
        'default' => false,
        'sanitize_callback' => 'etcodes_sanitize_checkbox',
    ));
    $wp_customize->add_control(new Etcodes_Toggle_Control($wp_customize, 'etmunfarid_etcodes_blog_page_width', array(
        'label' => esc_html__('Blog Full Width', 'munfarid'),
        'description' => esc_html__('Make the Blog width full width or Boxed', 'munfarid'),
        'section' => 'etmunfarid_etcodes_posts',
        'settings' => 'etmunfarid_etcodes_blog_page_width',
        'type' => 'toggle',
    )));
    // Blog page Width
    $wp_customize->add_setting('etmunfarid_etcodes_blog_page_width_vw', array(
        'default' => 100,
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control(new Etcodes_Range_Control($wp_customize, 'etmunfarid_etcodes_blog_page_width_vw', array(
        'type' => 'etcodes-range',
        'label' => esc_html__('Blog Page Width', 'munfarid'),
        'section' => 'etmunfarid_etcodes_posts',
        'settings' => 'etmunfarid_etcodes_blog_page_width_vw',
        'default' => 100,
        'description' => 'vw',
        'input_attrs' => array(
            'min' => 0,
            'max' => 100,
            'step' => 1,
        ),
    )));

    // Add the Blog page layout setting and control.
    $wp_customize->add_setting('etmunfarid_etcodes_blog_page_layout', array(
        'default' => 'full_width',
        'sanitize_callback' => 'sanitize_key',
    ));
    $wp_customize->add_control(new Etcodes_Image_Select_Control($wp_customize, 'etmunfarid_etcodes_blog_page_layout', array(
        'label' => esc_html__('Blog page layout', 'munfarid'),
        'description' => esc_html__('Select the Blog and Archives page layout.', 'munfarid'),
        'section' => 'etmunfarid_etcodes_posts',
        'settings' => 'etmunfarid_etcodes_blog_page_layout',
        'choices' => array(
            'left_sidebar' => array(
                'label' => esc_html__('Left sidebar', 'munfarid'),
                'url' => '%s/assets/images/admin/left-sidebar.jpg',
            ),
            'full_width' => array(
                'label' => esc_html__('Full width', 'munfarid'),
                'url' => '%s/assets/images/admin/full-width.jpg',
            ),
            'right_sidebar' => array(
                'label' => esc_html__('Right sidebar', 'munfarid'),
                'url' => '%s/assets/images/admin/right-sidebar.jpg',
            ),
        ),
    )));

    // Add the Blog Style setting and control.

    $wp_customize->add_setting('etmunfarid_etcodes_post_style', array(
        'default' => 'stander-post-style',
        'sanitize_callback' => 'sanitize_key',
    ));
    $wp_customize->add_control(new Etcodes_Image_Select_Control($wp_customize, 'etmunfarid_etcodes_post_style', array(
        'label' => esc_html__('Blog Style', 'munfarid'),
        'description' => esc_html__('Select the blog display style.', 'munfarid'),
        'section' => 'etmunfarid_etcodes_posts',
        'settings' => 'etmunfarid_etcodes_post_style',
        'choices' => array(
            'stander-post-style' => array(
                'label' => esc_html__('Stander blog', 'munfarid'),
                'url' => '%s/assets/images/admin/post-style3.jpg',
            ),
            'card-post-style' => array(
                'label' => esc_html__('Card blog', 'munfarid'),
                'url' => '%s/assets/images/admin/post-style4.jpg',
            ),
        ),
    )));

    // Add the Blog posts layout Columns setting and control.

    $wp_customize->add_setting('etmunfarid_etcodes_blog_post_layout_col', array(
        'default' => 'col-lg-12',
        'sanitize_callback' => 'sanitize_key',
    ));
    $wp_customize->add_control('etmunfarid_etcodes_blog_post_layout_col', array(
        'label' => esc_html__('Posts Columns', 'munfarid'),
        'section' => 'etmunfarid_etcodes_posts',
        'settings' => 'etmunfarid_etcodes_blog_post_layout_col',
        'type' => 'radio',
        'choices' => array(
            'col-lg-12' => esc_html__('1 columns', 'munfarid'),
            'col-md-6' => esc_html__('2 columns', 'munfarid'),
            'col-lg-4' => esc_html__('3 columns', 'munfarid'),
            'col-lg-3' => esc_html__('4 columns', 'munfarid'),
        ),
    ));

    // Add the blog post Featured Image button setting and control.

    $wp_customize->add_setting('etmunfarid_etcodes_blog_post_featured_image', array(
        'default' => true,
        'sanitize_callback' => 'etcodes_sanitize_checkbox',
    ));
    $wp_customize->add_control(new Etcodes_Toggle_Control($wp_customize, 'etmunfarid_etcodes_blog_post_featured_image', array(
        'label' => esc_html__('Featured Image', 'munfarid'),
        'description' => esc_html__('Enable or disable Featured Image that display in the blog.', 'munfarid'),
        'section' => 'etmunfarid_etcodes_posts',
        'settings' => 'etmunfarid_etcodes_blog_post_featured_image',
        'type' => 'toggle',
    )));

    // Add the Blog posts image size setting and control.
    $wp_customize->add_setting('etmunfarid_etcodes_blog_posts_featured_image_size', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_key',
    ));
    $wp_customize->add_control('etmunfarid_etcodes_blog_posts_featured_image_size', array(
        'label' => esc_html__('Select Featured Image Size', 'dabba'),
        'section' => 'etmunfarid_etcodes_posts',
        'settings' => 'etmunfarid_etcodes_blog_posts_featured_image_size',
        'type' => 'select',
        'choices' => etmunfarid_etcodes_get_image_sizes(),
    ));

    // Add the Blog Post Excerpt button setting and control.

    $wp_customize->add_setting('etmunfarid_etcodes_blog_post_excerpt', array(
        'default' => true,
        'sanitize_callback' => 'etcodes_sanitize_checkbox',
    ));
    $wp_customize->add_control(new Etcodes_Toggle_Control($wp_customize, 'etmunfarid_etcodes_blog_post_excerpt', array(
        'label' => esc_html__('Post Excerpt', 'munfarid'),
        'description' => esc_html__('Enable or disable Post Excerpt that display in the blog.', 'munfarid'),
        'section' => 'etmunfarid_etcodes_posts',
        'settings' => 'etmunfarid_etcodes_blog_post_excerpt',
        'type' => 'toggle',
    )));

    // Blog page Width
    $wp_customize->add_setting('etmunfarid_etcodes_blog_post_excerpt_length ', array(
        'default' => 25,
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control(new Etcodes_Range_Control($wp_customize, 'etmunfarid_etcodes_blog_post_excerpt_length', array(
        'type' => 'etcodes-range',
        'label' => esc_html__('Blog Page Width', 'munfarid'),
        'section' => 'etmunfarid_etcodes_posts',
        'settings' => 'etmunfarid_etcodes_blog_post_excerpt_length',
        'default' => 25,
        'description' => 'vw',
        'input_attrs' => array(
            'min' => 0,
            'max' => 100,
            'step' => 1,
        ),
    )));

    // Add the Blog Post Author setting and control.

    $wp_customize->add_setting('etmunfarid_etcodes_blog_post_author', array(
        'default' => true,
        'sanitize_callback' => 'etcodes_sanitize_checkbox',
    ));
    $wp_customize->add_control(new Etcodes_Toggle_Control($wp_customize, 'etmunfarid_etcodes_blog_post_author', array(
        'label' => esc_html__('Author', 'munfarid'),
        'description' => esc_html__('Add the post author metadata.', 'munfarid'),
        'section' => 'etmunfarid_etcodes_posts',
        'settings' => 'etmunfarid_etcodes_blog_post_author',
        'type' => 'toggle',
    )));

    // Add the Blog Post Categories setting and control.

    $wp_customize->add_setting('etmunfarid_etcodes_blog_post_categories', array(
        'default' => true,
        'sanitize_callback' => 'etcodes_sanitize_checkbox',
    ));
    $wp_customize->add_control(new Etcodes_Toggle_Control($wp_customize, 'etmunfarid_etcodes_blog_post_categories', array(
        'label' => esc_html__('Categories', 'munfarid'),
        'description' => esc_html__('Enable or disable categories that display in the post metadata.', 'munfarid'),
        'section' => 'etmunfarid_etcodes_posts',
        'settings' => 'etmunfarid_etcodes_blog_post_categories',
        'type' => 'toggle',
    )));

    // Add the Blog Post Comments Counter setting and control.

    $wp_customize->add_setting('etmunfarid_etcodes_blog_post_comments_counter', array(
        'default' => true,
        'sanitize_callback' => 'etcodes_sanitize_checkbox',
    ));
    $wp_customize->add_control(new Etcodes_Toggle_Control($wp_customize, 'etmunfarid_etcodes_blog_post_comments_counter', array(
        'label' => esc_html__('Comments Counter metadata', 'munfarid'),
        'description' => esc_html__('Enable or disable comments counter that display in the post metadata.', 'munfarid'),
        'section' => 'etmunfarid_etcodes_posts',
        'settings' => 'etmunfarid_etcodes_blog_post_comments_counter',
        'type' => 'toggle',
    )));

    // Add the Blog Post Date setting and control.

    $wp_customize->add_setting('etmunfarid_etcodes_blog_post_date', array(
        'default' => true,
        'sanitize_callback' => 'etcodes_sanitize_checkbox',
    ));
    $wp_customize->add_control(new Etcodes_Toggle_Control($wp_customize, 'etmunfarid_etcodes_blog_post_date', array(
        'label' => esc_html__('Post Date metadata', 'munfarid'),
        'description' => esc_html__('Enable or disable Post Date that display in the post metadata.', 'munfarid'),
        'section' => 'etmunfarid_etcodes_posts',
        'settings' => 'etmunfarid_etcodes_blog_post_date',
        'type' => 'toggle',
    )));

    // Add the Blog Post Tags setting and control.

    $wp_customize->add_setting('etmunfarid_etcodes_blog_post_tags', array(
        'default' => true,
        'sanitize_callback' => 'etcodes_sanitize_checkbox',
    ));
    $wp_customize->add_control(new Etcodes_Toggle_Control($wp_customize, 'etmunfarid_etcodes_blog_post_tags', array(
        'label' => esc_html__('Tags metadata', 'munfarid'),
        'description' => esc_html__('Enable or disable Tags that display in the post metadata.', 'munfarid'),
        'section' => 'etmunfarid_etcodes_posts',
        'settings' => 'etmunfarid_etcodes_blog_post_tags',
        'type' => 'toggle',
    )));

    // Add the Blog Post Read more button setting and control.

    $wp_customize->add_setting('etmunfarid_etcodes_blog_post_read_more_btn', array(
        'default' => true,
        'sanitize_callback' => 'etcodes_sanitize_checkbox',
    ));
    $wp_customize->add_control(new Etcodes_Toggle_Control($wp_customize, 'etmunfarid_etcodes_blog_post_read_more_btn', array(
        'label' => esc_html__('Read More Button', 'munfarid'),
        'description' => esc_html__('Enable or disable Read More button that display in the blog loop.', 'munfarid'),
        'section' => 'etmunfarid_etcodes_posts',
        'settings' => 'etmunfarid_etcodes_blog_post_read_more_btn',
        'type' => 'toggle',
    )));

    // Header six text bar

    $wp_customize->add_setting('etmunfarid_etcodes_blog_post_read_more_btn_lable', array(
        'default' => 'Read More',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('etmunfarid_etcodes_blog_post_read_more_btn_lable', array(
        'label' => esc_html__('Read More button lable', 'munfarid'),
        'section' => 'etmunfarid_etcodes_posts',
        'settings' => 'etmunfarid_etcodes_blog_post_read_more_btn_lable',
        'type' => 'text',
    ));

    /***** Add the Single Post section *****/
    $wp_customize->add_section('etmunfarid_etcodes_single_post', array(
        'title' => esc_html__('Single Post', 'munfarid'),
        'panel' => 'etmunfarid_etcodes_blog',
    ));

    // Add the Single Post layout setting and control.

    $wp_customize->add_setting('etmunfarid_etcodes_single_post_page_layout', array(
        'default' => 'right_sidebar',
        'sanitize_callback' => 'sanitize_key',
    ));
    $wp_customize->add_control(new Etcodes_Image_Select_Control($wp_customize, 'etmunfarid_etcodes_single_post_page_layout', array(
        'label' => esc_html__('Single Post layout', 'munfarid'),
        'description' => esc_html__('Select the Single Post layout.', 'munfarid'),
        'section' => 'etmunfarid_etcodes_single_post',
        'settings' => 'etmunfarid_etcodes_single_post_page_layout',
        'choices' => array(
            'left_sidebar' => array(
                'label' => esc_html__('Left sidebar', 'munfarid'),
                'url' => '%s/assets/images/admin/left-sidebar.jpg',
            ),
            'full_width' => array(
                'label' => esc_html__('Full width', 'munfarid'),
                'url' => '%s/assets/images/admin/full-width.jpg',
            ),
            'right_sidebar' => array(
                'label' => esc_html__('Right sidebar', 'munfarid'),
                'url' => '%s/assets/images/admin/right-sidebar.jpg',
            ),
        ),
    )));

    // Add the Single Post Breadcrumbs setting and control.

    $wp_customize->add_setting('etmunfarid_etcodes_single_post_breadcrumbs', array(
        'default' => true,
        'sanitize_callback' => 'etcodes_sanitize_checkbox',
    ));
    $wp_customize->add_control(new Etcodes_Toggle_Control($wp_customize, 'etmunfarid_etcodes_single_post_breadcrumbs', array(
        'label' => esc_html__('Breadcrumbs', 'munfarid'),
        'description' => esc_html__('Enable or disable Breadcrumbs that display in the single post.', 'munfarid'),
        'section' => 'etmunfarid_etcodes_single_post',
        'settings' => 'etmunfarid_etcodes_single_post_breadcrumbs',
        'type' => 'toggle',
    )));

    // Add the blog post Featured Image button setting and control.
    $wp_customize->add_setting('etmunfarid_etcodes_blog_single_post_featured_image', array(
        'default' => true,
        'sanitize_callback' => 'etcodes_sanitize_checkbox',
    ));
    $wp_customize->add_control(new Etcodes_Toggle_Control($wp_customize, 'etmunfarid_etcodes_blog_single_post_featured_image', array(
        'label' => esc_html__('Featured Image', 'dabba'),
        'description' => esc_html__('Enable or disable Featured Image that display in the post.', 'dabba'),
        'section' => 'etmunfarid_etcodes_single_post',
        'settings' => 'etmunfarid_etcodes_blog_single_post_featured_image',
        'type' => 'toggle',
    )));

    // Add the Blog posts image size setting and control.
    $wp_customize->add_setting('etmunfarid_etcodes_blog_single_posts_featured_image_size', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_key',
    ));
    $wp_customize->add_control('etmunfarid_etcodes_blog_single_posts_featured_image_size', array(
        'label' => esc_html__('Select Featured Image Size', 'dabba'),
        'section' => 'etmunfarid_etcodes_single_post',
        'settings' => 'etmunfarid_etcodes_blog_single_posts_featured_image_size',
        'type' => 'select',
        'choices' => etmunfarid_etcodes_get_image_sizes(),
    ));

    // Add the Single Post Author Box setting and control.

    $wp_customize->add_setting('etmunfarid_etcodes_single_post_author_box', array(
        'default' => false,
        'sanitize_callback' => 'etcodes_sanitize_checkbox',
    ));
    $wp_customize->add_control(new Etcodes_Toggle_Control($wp_customize, 'etmunfarid_etcodes_single_post_author_box', array(
        'label' => esc_html__('Author Box', 'munfarid'),
        'description' => esc_html__('Enable or disable Author Box that display in the single post.', 'munfarid'),
        'section' => 'etmunfarid_etcodes_single_post',
        'settings' => 'etmunfarid_etcodes_single_post_author_box',
        'type' => 'toggle',
    )));

    // Add the Single Post Post Navigation setting and control.

    $wp_customize->add_setting('etmunfarid_etcodes_single_post_navigation', array(
        'default' => true,
        'sanitize_callback' => 'etcodes_sanitize_checkbox',
    ));
    $wp_customize->add_control(new Etcodes_Toggle_Control($wp_customize, 'etmunfarid_etcodes_single_post_navigation', array(
        'label' => esc_html__('Post Navigation', 'munfarid'),
        'description' => esc_html__('Enable or disable Post Navigation that display in the single post.', 'munfarid'),
        'section' => 'etmunfarid_etcodes_single_post',
        'settings' => 'etmunfarid_etcodes_single_post_navigation',
        'type' => 'toggle',
    )));

    // Add the Single Post Related Articles setting and control.

    $wp_customize->add_setting('etmunfarid_etcodes_single_post_related_articles', array(
        'default' => false,
        'sanitize_callback' => 'etcodes_sanitize_checkbox',
    ));
    $wp_customize->add_control(new Etcodes_Toggle_Control($wp_customize, 'etmunfarid_etcodes_single_post_related_articles', array(
        'label' => esc_html__('Related Articles', 'munfarid'),
        'description' => esc_html__('Enable or disable Related Articles that display in the single post.', 'munfarid'),
        'section' => 'etmunfarid_etcodes_single_post',
        'settings' => 'etmunfarid_etcodes_single_post_related_articles',
        'type' => 'toggle',
    )));

    /*******************************************
    Page
     ********************************************/
    /***** Add the Page Title section *****/
    $wp_customize->add_section('etmunfarid_etcodes_page_title', array(
        'title' => esc_html__('Page Title', 'munfarid'),
    ));

    // Title Container Breadcrumb
    $wp_customize->add_setting('etmunfarid_etcodes_page_title_container_breadcrumb', array(
        'default' => true,
        'sanitize_callback' => 'etcodes_sanitize_checkbox',
    ));
    $wp_customize->add_control(new Etcodes_Toggle_Control($wp_customize, 'etmunfarid_etcodes_page_title_container_breadcrumb', array(
        'label' => esc_html__('Breadcrumb', 'munfarid'),
        'section' => 'etmunfarid_etcodes_page_title',
        'settings' => 'etmunfarid_etcodes_page_title_container_breadcrumb',
        'type' => 'toggle',
    )));

    // Title Container Height
    $wp_customize->add_setting('etmunfarid_etcodes_page_title_container_height', array(
        'default' => 0,
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control(new Etcodes_Range_Control($wp_customize, 'etmunfarid_etcodes_page_title_container_height', array(
        'type' => 'etcodes-range',
        'label' => esc_html__('Title Container Height', 'munfarid'),
        'section' => 'etmunfarid_etcodes_page_title',
        'settings' => 'etmunfarid_etcodes_page_title_container_height',
        'default' => 0,
        'description' => 'vh',
        'input_attrs' => array(
            'min' => 0,
            'max' => 100,
            'step' => 1,
        ),
    )));

    // Title Container Full Width toggle
    $wp_customize->add_setting('etmunfarid_etcodes_page_title_container_width', array(
        'default' => false,
        'sanitize_callback' => 'etcodes_sanitize_checkbox',
    ));
    $wp_customize->add_control(new Etcodes_Toggle_Control($wp_customize, 'etmunfarid_etcodes_page_title_container_width', array(
        'label' => esc_html__('Container Full Width', 'munfarid'),
        'section' => 'etmunfarid_etcodes_page_title',
        'settings' => 'etmunfarid_etcodes_page_title_container_width',
        'type' => 'toggle',
    )));

    // Title Container width
    $wp_customize->add_setting('etmunfarid_etcodes_page_title_fluid_container_x_padding', array(
        'default' => 0,
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control(new Etcodes_Range_Control($wp_customize, 'etmunfarid_etcodes_page_title_fluid_container_x_padding', array(
        'type' => 'etcodes-range',
        'label' => esc_html__('Title Container Right and left Padding', 'munfarid'),
        'section' => 'etmunfarid_etcodes_page_title',
        'settings' => 'etmunfarid_etcodes_page_title_fluid_container_x_padding',
        'default' => 0,
        'description' => 'vw',
        'input_attrs' => array(
            'min' => 0,
            'max' => 100,
            'step' => 1,
        ),
    )));

    // Title Container Background Color
    $wp_customize->add_setting('etmunfarid_etcodes_page_title_container_bg_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'etmunfarid_etcodes_page_title_container_bg_color', array(
        'label' => esc_html__('Container Background Color', 'munfarid'),
        'section' => 'etmunfarid_etcodes_page_title',
        'settings' => 'etmunfarid_etcodes_page_title_container_bg_color',
    )));

    // Title Container Background Image
    $wp_customize->add_setting('etmunfarid_etcodes_page_title_container_bg_img', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control(new WP_Customize_Upload_Control($wp_customize, 'etmunfarid_etcodes_page_title_container_bg_img', array(
        'label' => esc_html__('Container Background Image', 'munfarid'),
        'section' => 'etmunfarid_etcodes_page_title',
        'settings' => 'etmunfarid_etcodes_page_title_container_bg_img',
    )));

    // Title Container Background Size.
    $wp_customize->add_setting('etmunfarid_etcodes_page_title_container_bg_size', array(
        'default' => 'cover',
        'sanitize_callback' => 'sanitize_key',
    ));
    $wp_customize->add_control('etmunfarid_etcodes_page_title_container_bg_size', array(
        'label' => esc_html__('Background Size', 'munfarid'),
        'section' => 'etmunfarid_etcodes_page_title',
        'settings' => 'etmunfarid_etcodes_page_title_container_bg_size',
        'type' => 'select',
        'choices' => array(
            'initial' => esc_html__('Default', 'munfarid'),
            'cover' => esc_html__('Fill Screen', 'munfarid'),
            'contain' => esc_html__('Fit to Screen', 'munfarid'),
            'auto' => esc_html__('Repeat', 'munfarid'),
        ),
    ));

    // Title Container Background Position.
    $wp_customize->add_setting('etmunfarid_etcodes_page_title_container_background_position_x', array(
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_setting('etmunfarid_etcodes_page_title_container_background_position_y', array(
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control(new WP_Customize_Background_Position_Control($wp_customize, 'etmunfarid_etcodes_page_title_container_background_position', array(
        'label' => esc_html__('Background Image Position', 'munfarid'),
        'section' => 'etmunfarid_etcodes_page_title',
        'settings' => array(
            'x' => 'etmunfarid_etcodes_page_title_container_background_position_x',
            'y' => 'etmunfarid_etcodes_page_title_container_background_position_y',
        ),
    )));

    // Title Container background scroll
    $wp_customize->add_setting('etmunfarid_etcodes_page_title_container_bg_scroll', array(
        'default' => false,
        'sanitize_callback' => 'etcodes_sanitize_checkbox',
    ));
    $wp_customize->add_control(new Etcodes_Toggle_Control($wp_customize, 'etmunfarid_etcodes_page_title_container_bg_scroll', array(
        'label' => esc_html__('Background Scroll with Page', 'munfarid'),
        'section' => 'etmunfarid_etcodes_page_title',
        'settings' => 'etmunfarid_etcodes_page_title_container_bg_scroll',
        'type' => 'toggle',
    )));

    // Title Container Background Color Overlay
    $wp_customize->add_setting('etmunfarid_etcodes_page_title_container_overlay', array(
        'default' => false,
        'sanitize_callback' => 'etcodes_sanitize_checkbox',
    ));
    $wp_customize->add_control(new Etcodes_Toggle_Control($wp_customize, 'etmunfarid_etcodes_page_title_container_overlay', array(
        'label' => esc_html__('Background Color Overlay', 'munfarid'),
        'section' => 'etmunfarid_etcodes_page_title',
        'settings' => 'etmunfarid_etcodes_page_title_container_overlay',
        'type' => 'toggle',
    )));

    // Title Container Overlay Color
    $wp_customize->add_setting('etmunfarid_etcodes_page_title_container_overlay_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'etmunfarid_etcodes_page_title_container_overlay_color', array(
        'label' => esc_html__('Overlay Color', 'munfarid'),
        'section' => 'etmunfarid_etcodes_page_title',
        'settings' => 'etmunfarid_etcodes_page_title_container_overlay_color',
    )));

    // Title Container Overlay Color opacity
    $wp_customize->add_setting('etmunfarid_etcodes_page_title_container_overlay_opacity', array(
        'default' => 50,
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control(new Etcodes_Range_Control($wp_customize, 'etmunfarid_etcodes_page_title_container_overlay_opacity', array(
        'type' => 'etcodes-range',
        'label' => esc_html__('Overlay Color opacity', 'munfarid'),
        'settings' => 'etmunfarid_etcodes_page_title_container_overlay_opacity',
        'section' => 'etmunfarid_etcodes_page_title',
        'description' => '%',
        'default' => 50,
        'input_attrs' => array(
            'min' => 0,
            'max' => 100,
            'step' => 1,
        ),
    )));

    /*******************************************
    Woocommerce
     ********************************************/

    // Add the Blog page width
    $wp_customize->add_setting('etmunfarid_etcodes_woocommerce_catalog_page_width', array(
        'default' => false,
        'sanitize_callback' => 'etcodes_sanitize_checkbox',
    ));
    $wp_customize->add_control(new Etcodes_Toggle_Control($wp_customize, 'etmunfarid_etcodes_woocommerce_catalog_page_width', array(
        'label' => esc_html__('Catalog Page Full Width', 'munfarid'),
        'description' => esc_html__('Make the Product Catalog page width full width or Boxed', 'munfarid'),
        'section' => 'woocommerce_product_catalog',
        'settings' => 'etmunfarid_etcodes_woocommerce_catalog_page_width',
        'type' => 'toggle',
    )));
    // Catalog Page Width
    $wp_customize->add_setting('etmunfarid_etcodes_woocommerce_catalog_page_width_vw', array(
        'default' => 100,
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control(new Etcodes_Range_Control($wp_customize, 'etmunfarid_etcodes_woocommerce_catalog_page_width_vw', array(
        'type' => 'etcodes-range',
        'label' => esc_html__('Page Width', 'munfarid'),
        'section' => 'woocommerce_product_catalog',
        'settings' => 'etmunfarid_etcodes_woocommerce_catalog_page_width_vw',
        'default' => 100,
        'description' => 'vw',
        'input_attrs' => array(
            'min' => 0,
            'max' => 100,
            'step' => 1,
        ),
    )));

    // Add the Blog page layout setting and control.
    $wp_customize->add_setting('etmunfarid_etcodes_woocommerce_product_catalog_layout', array(
        'default' => 'full_width',
        'sanitize_callback' => 'sanitize_key',
    ));
    $wp_customize->add_control(new Etcodes_Image_Select_Control($wp_customize, 'etmunfarid_etcodes_woocommerce_product_catalog_layout', array(
        'label' => esc_html__('Product Catalog page layout', 'munfarid'),
        'description' => esc_html__('Select the Product Catalog page layout.', 'munfarid'),
        'section' => 'woocommerce_product_catalog',
        'settings' => 'etmunfarid_etcodes_woocommerce_product_catalog_layout',
        'choices' => array(
            'left_sidebar' => array(
                'label' => esc_html__('Left sidebar', 'munfarid'),
                'url' => '%s/assets/images/admin/left-sidebar.jpg',
            ),
            'full_width' => array(
                'label' => esc_html__('Full width', 'munfarid'),
                'url' => '%s/assets/images/admin/full-width.jpg',
            ),
            'right_sidebar' => array(
                'label' => esc_html__('Right sidebar', 'munfarid'),
                'url' => '%s/assets/images/admin/right-sidebar.jpg',
            ),
        ),
    )));

    /*******************************************
    General section
     ********************************************/
    $wp_customize->add_section('etmunfarid_etcodes_general', array(
        'title' => esc_html__('General', 'munfarid'),

    ));

    // Select 404 Error Page.
    $wp_customize->add_setting('etmunfarid_etcodes_404_page', array(
        'default' => 'none',
        'sanitize_callback' => 'sanitize_key',
    ));
    $wp_customize->add_control('etmunfarid_etcodes_404_page', array(
        'label' => esc_html__('Select Footer 404 page', 'munfarid'),
        'description' => 'Select the 404 error page (Optional)',
        'section' => 'etmunfarid_etcodes_general',
        'settings' => 'etmunfarid_etcodes_404_page',
        'type' => 'select',
        'choices' => etmunfarid_etcodes_pages_list(),
    ));

    // Scroll to Top Button
    $wp_customize->add_setting('etmunfarid_etcodes_is_scroll_to_top_btn', array(
        'default' => false,
        'sanitize_callback' => 'etcodes_sanitize_checkbox',
    ));
    $wp_customize->add_control(new Etcodes_Toggle_Control($wp_customize, 'etmunfarid_etcodes_is_scroll_to_top_btn', array(
        'label' => esc_html__('Scroll to Top Button', 'munfarid'),
        'description' => esc_html__('Enabling this option will display a Back to Top button.', 'munfarid'),
        'section' => 'etmunfarid_etcodes_general',
        'settings' => 'etmunfarid_etcodes_is_scroll_to_top_btn',
        'type' => 'toggle',
    )));
    // Scroll to Top Button icon color
    $wp_customize->add_setting('etmunfarid_etcodes_scroll_to_top_btn_icon_color', array(
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'etmunfarid_etcodes_scroll_to_top_btn_icon_color', array(
        'label' => esc_html__('Button icon color', 'munfarid'),
        'section' => 'etmunfarid_etcodes_general',
        'settings' => 'etmunfarid_etcodes_scroll_to_top_btn_icon_color',
    )));
    //  Scroll to Top Button background color
    $wp_customize->add_setting('etmunfarid_etcodes_scroll_to_top_btn_bg_color', array(
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'etmunfarid_etcodes_scroll_to_top_btn_bg_color', array(
        'label' => esc_html__('Button Background Color', 'munfarid'),
        'section' => 'etmunfarid_etcodes_general',
        'settings' => 'etmunfarid_etcodes_scroll_to_top_btn_bg_color',
    )));

    // Smooth Scroll
    $wp_customize->add_setting('etmunfarid_etcodes_is_smooth_scroll', array(
        'default' => false,
        'sanitize_callback' => 'etcodes_sanitize_checkbox',
    ));
    $wp_customize->add_control(new Etcodes_Toggle_Control($wp_customize, 'etmunfarid_etcodes_is_smooth_scroll', array(
        'label' => esc_html__('Smooth Scroll', 'munfarid'),
        'description' => esc_html__('Enabling this option will activate smooth scrolling.', 'munfarid'),
        'section' => 'etmunfarid_etcodes_general',
        'settings' => 'etmunfarid_etcodes_is_smooth_scroll',
        'type' => 'toggle',
    )));

    /*******************************************
    Footer section
     ********************************************/
    $wp_customize->add_section('etmunfarid_etcodes_footer', array(
        'title' => esc_html__('Footer', 'munfarid'),
    ));

    // Footer.
    $wp_customize->add_setting('etmunfarid_etcodes_selected_footer', array(
        'default' => 'none',
        'sanitize_callback' => 'sanitize_key',
    ));
    $wp_customize->add_control('etmunfarid_etcodes_selected_footer', array(
        'label' => esc_html__('Select Footer', 'munfarid'),
        'description' => '<a href="' . esc_url(admin_url('edit.php?post_type=etcodes-footer')) . '" target="_blank">' . esc_html__('To create or customize footer click here', 'munfarid') . '</a>',
        'section' => 'etmunfarid_etcodes_footer',
        'settings' => 'etmunfarid_etcodes_selected_footer',
        'type' => 'select',
        'choices' => etmunfarid_etcodes_footers_list(),
    ));

}

add_action('customize_register', 'etmunfarid_etcodes_customizer_register');
