<?php
/**
 * Munfarid configuration file.
 *
 * @package   Munfarid
 */

if ( ! class_exists( 'Merlin' ) ) {
	return;
}

/**
 * Set directory locations, text strings, and settings.
 */
$wizard = new Merlin(

	$config = array(
		'directory'            => 'theme-includes/merlin', // Location / directory where Munfarid is placed in your theme.
		'merlin_url'           => 'merlin', // The wp-admin page slug where Munfarid loads.
		'parent_slug'          => 'themes.php', // The wp-admin parent page slug for the admin menu item.
		'capability'           => 'manage_options', // The capability required for this menu to be displayed to the user.
		'child_action_btn_url' => 'https://developer.wordpress.org/themes/advanced-topics/child-themes/', // URL for the 'child-action-link'.
		'dev_mode'             => true, // Enable development mode for testing.
		'license_step'         => false, // EDD license activation step.
		'license_required'     => false, // Require the license activation step.
		'license_help_url'     => '', // URL for the 'license-tooltip'.
		'edd_remote_api_url'   => '', // EDD_Theme_Updater_Admin remote_api_url.
		'edd_item_name'        => '', // EDD_Theme_Updater_Admin item_name.
		'edd_theme_slug'       => '', // EDD_Theme_Updater_Admin item_slug.
	),
	$strings = array(
		'admin-menu'               => esc_html__( 'Theme Setup', 'munfarid' ),

		/* translators: 1: Title Tag 2: Theme Name 3: Closing Title Tag */
		'title%s%s%s%s'            => esc_html__( '%1$s%2$s Themes &lsaquo; Theme Setup: %3$s%4$s', 'munfarid' ),
		'return-to-dashboard'      => esc_html__( 'Return to the dashboard', 'munfarid' ),
		'ignore'                   => esc_html__( 'Disable this wizard', 'munfarid' ),

		'btn-skip'                 => esc_html__( 'Skip', 'munfarid' ),
		'btn-next'                 => esc_html__( 'Next', 'munfarid' ),
		'btn-start'                => esc_html__( 'Start', 'munfarid' ),
		'btn-no'                   => esc_html__( 'Cancel', 'munfarid' ),
		'btn-plugins-install'      => esc_html__( 'Install', 'munfarid' ),
		'btn-child-install'        => esc_html__( 'Install', 'munfarid' ),
		'btn-content-install'      => esc_html__( 'Install', 'munfarid' ),
		'btn-import'               => esc_html__( 'Import', 'munfarid' ),
		'btn-license-activate'     => esc_html__( 'Activate', 'munfarid' ),
		'btn-license-skip'         => esc_html__( 'Later', 'munfarid' ),

		/* translators: Theme Name */
		'license-header%s'         => esc_html__( 'Activate %s', 'munfarid' ),
		/* translators: Theme Name */
		'license-header-success%s' => esc_html__( '%s is Activated', 'munfarid' ),
		/* translators: Theme Name */
		'license%s'                => esc_html__( 'Enter your license key to enable remote updates and theme support.', 'munfarid' ),
		'license-label'            => esc_html__( 'License key', 'munfarid' ),
		'license-success%s'        => esc_html__( 'The theme is already registered, so you can go to the next step!', 'munfarid' ),
		'license-json-success%s'   => esc_html__( 'Your theme is activated! Remote updates and theme support are enabled.', 'munfarid' ),
		'license-tooltip'          => esc_html__( 'Need help?', 'munfarid' ),

		/* translators: Theme Name */
		'welcome-header%s'         => esc_html__( 'Welcome to %s', 'munfarid' ),
		'welcome-header-success%s' => esc_html__( 'Hi. Welcome back', 'munfarid' ),
		'welcome%s'                => esc_html__( 'This wizard will set up your theme, install plugins, and import content. It is optional & should take only a few minutes.', 'munfarid' ),
		'welcome-success%s'        => esc_html__( 'You may have already run this theme setup wizard. If you would like to proceed anyway, click on the "Start" button below.', 'munfarid' ),

		'child-header'             => esc_html__( 'Install Child Theme', 'munfarid' ),
		'child-header-success'     => esc_html__( 'You\'re good to go!', 'munfarid' ),
		'child'                    => esc_html__( 'Let\'s build & activate a child theme so you may easily make theme changes.', 'munfarid' ),
		'child-success%s'          => esc_html__( 'Your child theme has already been installed and is now activated, if it wasn\'t already.', 'munfarid' ),
		'child-action-link'        => esc_html__( 'Learn about child themes', 'munfarid' ),
		'child-json-success%s'     => esc_html__( 'Awesome. Your child theme has already been installed and is now activated.', 'munfarid' ),
		'child-json-already%s'     => esc_html__( 'Awesome. Your child theme has been created and is now activated.', 'munfarid' ),

		'plugins-header'           => esc_html__( 'Install Plugins', 'munfarid' ),
		'plugins-header-success'   => esc_html__( 'You\'re up to speed!', 'munfarid' ),
		'plugins'                  => esc_html__( 'Let\'s install some essential WordPress plugins to get your site up to speed.', 'munfarid' ),
		'plugins-success%s'        => esc_html__( 'The required WordPress plugins are all installed and up to date. Press "Next" to continue the setup wizard.', 'munfarid' ),
		'plugins-action-link'      => esc_html__( 'Advanced', 'munfarid' ),

		'import-header'            => esc_html__( 'Import Content', 'munfarid' ),
		'import'                   => esc_html__( 'Let\'s import content to your website, to help you get familiar with the theme.', 'munfarid' ),
		'import-action-link'       => esc_html__( 'Advanced', 'munfarid' ),

		'ready-header'             => esc_html__( 'All done. Have fun!', 'munfarid' ),

		/* translators: Theme Author */
		'ready%s'                  => esc_html__( 'Your theme has been all set up. Enjoy your new theme by %s.', 'munfarid' ),
		'ready-action-link'        => esc_html__( 'Extras', 'munfarid' ),
		'ready-big-button'         => esc_html__( 'View your website', 'munfarid' ),
		'ready-link-1'             => sprintf( '<a href="%1$s" target="_blank">%2$s</a>', 'https://wordpress.org/support/', esc_html__( 'Explore WordPress', 'munfarid' ) ),
		'ready-link-2'             => sprintf( '<a href="%1$s" target="_blank">%2$s</a>', 'https://www.energeticthemes.com/ticket-form/', esc_html__( 'Get Theme Support', 'munfarid' ) ),
		'ready-link-3'             => sprintf( '<a href="%1$s">%2$s</a>', admin_url( 'customize.php' ), esc_html__( 'Start Customizing', 'munfarid' ) ),
	)
);
