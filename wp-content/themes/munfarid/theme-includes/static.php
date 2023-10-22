<?php if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}
$etmunfarid_etcodes_theme = wp_get_theme();
$etmunfarid_etcodes_version = $etmunfarid_etcodes_theme->get( 'Version' );
$etmunfarid_etcodes_template_directory = get_template_directory_uri();

/***********************************************************************************************/
/* Enqueue the fonts, Js, CSS files. */
/***********************************************************************************************/

/************* Enqueue Fonts files *********************/

wp_enqueue_style(
    'etmunfarid-etcodes-google-fonts',
    etmunfarid_etcodes_google_fonts_url(),
    array(),
    $etmunfarid_etcodes_version
);

/************* Enqueue css files *********************/


// Load bootstrap stylesheet.
wp_enqueue_style(
    'bootstrap',
    $etmunfarid_etcodes_template_directory . '/assets/css/bootstrap.build.css',
    array(),
    $etmunfarid_etcodes_version
);

// Load font-awesome stylesheet.
wp_enqueue_style(
    'font-awesome',
    $etmunfarid_etcodes_template_directory . '/assets/css/fontawesome.build.css',
    array(),
    $etmunfarid_etcodes_version
);


// Load app stylesheet.
wp_enqueue_style(
    'etmunfarid-etcodes-app-build',
    $etmunfarid_etcodes_template_directory . '/assets/css/app.build.css',
    array(),
    $etmunfarid_etcodes_version
);

if ( class_exists( 'WooCommerce' ) ) {
    // Load woocommerce stylesheet.
    wp_enqueue_style(
        'etmunfarid-etcodes-woocommerce-build',
        $etmunfarid_etcodes_template_directory . '/assets/css/woocommerce.build.css',
        array(),
        $etmunfarid_etcodes_version
    );
}

/************* Enqueue js files *********************/

// Load bootstrap js.
wp_enqueue_script(
    'bootstrap',
    $etmunfarid_etcodes_template_directory . '/assets/js/bootstrap.bundle.min.js',
    array('jquery'),
    $etmunfarid_etcodes_version,
    true
);
// Load app navbar js.
wp_enqueue_script(
    'app-navbar',
    $etmunfarid_etcodes_template_directory . '/assets/js/navbar.js',
    array('jquery'),
    $etmunfarid_etcodes_version,
    true
);

// on single blog post pages with comments open and threaded comments
if (is_singular() && comments_open() && get_option('thread_comments')) {
    // enqueue the javascript that performs in-link comment reply fanciness
    wp_enqueue_script('comment-reply');
}
