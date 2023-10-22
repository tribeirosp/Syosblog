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
	'etmunfarid-etcodes-editor-build',
	$etmunfarid_etcodes_template_directory . '/assets/css/editor.build.css',
	array(),
    $etmunfarid_etcodes_version
);

/************* Enqueue Fonts files *********************/

wp_enqueue_style(
    'etmunfarid-etcodes-google-fonts',
    etmunfarid_etcodes_google_fonts_url(),
    array(),
    $etmunfarid_etcodes_version
);