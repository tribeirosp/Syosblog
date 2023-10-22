<?php if ( ! defined( 'ABSPATH' ) ) {
    die( 'Direct access forbidden.' );
}
/**
 * Include static files: javascript and css
 */
$etmunfarid_etcodes_theme = wp_get_theme();
$etmunfarid_etcodes_version = $etmunfarid_etcodes_theme->get( 'Version' );
$etmunfarid_etcodes_template_directory = get_template_directory_uri();


wp_enqueue_style(
	'etmunfarid-etcodes-admin-build',
	$etmunfarid_etcodes_template_directory . '/assets/css/admin.build.css',
	array(),
    $etmunfarid_etcodes_version
);


wp_enqueue_script(
	'etmunfarid-customizer-controls',
	$etmunfarid_etcodes_template_directory . '/assets/js/customizer-controls.js',
	array( 'customize-controls'),
    $etmunfarid_etcodes_version,
	true
);

wp_enqueue_script(
	'etmunfarid-etcodes-theme-meta',
	$etmunfarid_etcodes_template_directory . '/theme-includes/meta/js/meta.js',
	array( 'jquery', 'wp-color-picker' ),
    $etmunfarid_etcodes_version,
	true
);