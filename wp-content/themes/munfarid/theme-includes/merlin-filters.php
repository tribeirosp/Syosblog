<?php
/**
 * Available filters for extending Munfarid.
 *
 */

/**
 * Demo import files (local files).
 *
 */
function etmunfarid_merlin_local_import_files() {
    return array(
        array(
            'import_file_name'             => 'Demo Content',
            'local_import_file'            => trailingslashit(get_template_directory()) . 'theme-includes/merlin/demo/demo-content.xml',
            'local_import_widget_file'     => trailingslashit(get_template_directory()) . 'theme-includes/merlin/demo/widgets.wie',
            'local_import_customizer_file' => trailingslashit(get_template_directory()) . 'theme-includes/merlin/demo/customizer.dat',
            'import_preview_image_url'     => trailingslashit(get_template_directory()) . 'screenshot.png',
            'preview_url'                  => 'https://www.energeticthemes.com/themes/munfarid/',
        ),
    );
}
add_filter('merlin_import_files', 'etmunfarid_merlin_local_import_files');

/**
 * Execute custom code after the whole import has finished.
 */
function etmunfarid_merlin_after_import_setup() {
    // Assign menus to their locations.
    $primary_menu = get_term_by('name', 'Primary Menu', 'nav_menu');
    $footer_menu  = get_term_by('name', 'Footer Menu', 'nav_menu');
    $social_menu  = get_term_by('name', 'Social Menu', 'nav_menu');

    set_theme_mod(
        'nav_menu_locations', array(
            'primary' => $primary_menu->term_id,
            'footer'  => $footer_menu->term_id,
            'social'  => $social_menu->term_id,
        )
    );

    update_option( 'elementor_disable_color_schemes', 'yes' );
    update_option( 'elementor_disable_typography_schemes', 'yes' );
    $kit = \Elementor\Plugin::$instance->kits_manager->get_active_kit();
    $kit->update_settings( [
        'container_width' => array(
        'size' => 1320,
        ),
    ] );

    // Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title( 'Home' );
	$blog_page_id  = get_page_by_title( 'Blog' );
	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );
    
}
add_action( 'merlin_after_all_import', 'etmunfarid_merlin_after_import_setup' );
