<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

if ( ! class_exists( 'TGM_Plugin_Activation' ) ) {
	/**
	 * Include the TGM_Plugin_Activation class.
	 */
	require_once get_template_directory() . '/theme-includes/sub-inc/class-tgm-plugin-activation.php';
}

add_action( 'tgmpa_register', 'etmunfarid_etcodes_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function etmunfarid_etcodes_register_required_plugins() {

	$plugins = array(
		array(
			'name'     => esc_html__('Energetic Core Parts', 'munfarid'),
			'slug'     => 'energetic-core-parts',
			'source'             => esc_url('http://updates.energeticthemes.com/plugins/energetic-core-parts.zip'),
			'required' => true,
		),
        array(
            'name'               => 'Envato Market (Theme Updater)',
            'slug'               => 'envato-market',
            'source'             => esc_url('https://envato.github.io/wp-envato-market/dist/envato-market.zip'),
            'required'           => false
		),
		array(
			'name'     => esc_html__('WooCommerce', 'munfarid'),
			'slug'     => 'woocommerce',
			'required' => false,
		),
		array(
			'name'     => esc_html__('WooCommerce Blocks', 'munfarid'),
			'slug'     => 'woo-gutenberg-products-block',
			'required' => false,
		),
		array(
			'name'     => esc_html__('MailChimp for WordPress', 'munfarid'),
			'slug'     => 'mailchimp-for-wp',
			'required' => false,
		),
		array(
			'name'     => esc_html__('Contact Form 7', 'munfarid'),
			'slug'     => 'contact-form-7',
			'required' => false,
		),
	);

	$config = array(
		'id'           => 'munfarid',
		'domain'       => 'munfarid',
		'dismissable'  => true,
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be at the top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => '',     		
	);
	tgmpa( $plugins, $config );

}