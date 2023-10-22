<?php
/**
 * Plugin Name: Energetic Core Parts
 * Plugin URI: https://www.energeticthemes.com/
 * Description: Plugin for Energetic themes
 * Author: Energetic Themes
 * Author URI: https://www.energeticthemes.com/
 * Version: 1.1.3
 *
 */

/**
 * Exit if accessed directly
 */
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Main @@pkg.title Class
 *
 * @since 1.0.0
 */
class EnergeticCoreParts
{

    /**
     * This plugin's instance.
     *
     * @var EnergeticCoreParts
     */
    private static $__instance;

    /**
     * Main CoBlocks Instance.
     *
     * Insures that only one instance of CoBlocks exists in memory at any one
     * time. Also prevents needing to define globals all over the place.
     *
     * @since 1.0.0
     * @static
     * @return object|CoBlocks The one true CoBlocks
     */
    public static function instance()
    {
        if (!isset(self::$__instance) && !(self::$__instance instanceof CoBlocks)) {
            self::$__instance = new EnergeticCoreParts();
            self::$__instance->__init();
            self::$__instance->__constants();
            //self::$__instance->asset_suffix();
            self::$__instance->__includes();
        }
        return self::$__instance;
    }

    /**
     * The base directory path (without trailing slash).
     *
     * @var string $_url
     */
    private $__dir;
    /**
     * The base URL path (without trailing slash).
     *
     * @var string $_url
     */
    private $__url;
    /**
     * The Plugin version.
     *
     * @var string $_version
     */
    private $__version;
    /**
     * The Plugin version.
     *
     * @var string $_slug
     */
    private $__slug;
    /**
     * The Constructor.
     */
    private function __constants()
    {
		$this->__define('ECP_VERSION', '@@pkg.version');
		$this->__define('ECP_SLUG', 'energetic-core-parts');
        $this->__define('ECP_PLUGIN_DIR', plugin_dir_path(__FILE__));
        $this->__define('ECP_PLUGIN_URL', plugin_dir_url(__FILE__));
        $this->__define('ECP_PLUGIN_FILE', __FILE__);
        $this->__define('ECP_PLUGIN_BASE', plugin_basename(__FILE__));

        // add_action( 'init', array( $this, 'register_blocks' ) );
        // add_action( 'init', array( $this, 'block_assets' ) );
        // add_action( 'init', array( $this, 'editor_assets' ) );
        // add_action( 'admin_enqueue_scripts', array( $this, 'admin_assets' ) );

        // add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
        // add_action( 'enqueue_block_editor_assets', array( $this, 'localization' ) );
    }
    /**
     * Define constant if not already set.
     *
     * @param  string|string $name Name of the definition.
     * @param  string|bool   $value Default value.
     */
    private function __define($name, $value)
    {
        if (!defined($name)) {
            define($name, $value);
        }
    }
    /**
     * Include required files.
     *
     * @access private
     * @since 1.1.1
     * @return void
     */
    private function __includes()
    {

		require_once ECP_PLUGIN_DIR . 'includes/class-ecp-block-assets.php';
		require_once ECP_PLUGIN_DIR . 'includes/class-ecp-register-blocks.php';

        // helpers
        require_once ECP_PLUGIN_DIR . 'includes/helpers.php';
        // hooks
        require_once ECP_PLUGIN_DIR . 'includes/hooks.php';

        // footer custom post type
        require_once ECP_PLUGIN_DIR . 'includes/post-type-footer.php';

        // Portfolio post type
        require_once ECP_PLUGIN_DIR . 'includes/post-type-portfolio.php';

        // Testimonial post type
        require_once ECP_PLUGIN_DIR . 'includes/post-type-testimonial.php';

        // Team post type
        require_once ECP_PLUGIN_DIR . 'includes/post-type-team.php';

        // Register meta boxes
        require_once ECP_PLUGIN_DIR . 'includes/meta/meta-boxes.php';

        // Register page meta boxes
        require_once ECP_PLUGIN_DIR . 'includes/meta/meta-page.php';

        // Register testimonial meta boxes
        require_once ECP_PLUGIN_DIR . 'includes/meta/meta-testimonial.php';

        // Register footer meta boxes
        require_once ECP_PLUGIN_DIR . 'includes/meta/meta-etcodes-footer.php';

        // Block Templates
        require_once ECP_PLUGIN_DIR . 'includes/block-templates.php';

        // Post Category featured image
        require_once ECP_PLUGIN_DIR . 'includes/class-category-featured-image.php';

        require_once ECP_PLUGIN_DIR . 'includes/get-dynamic-blocks.php';
    }

    /**
     * Load actions
     *
     * @return void
     */
    private function __init()
    {
        add_action('plugins_loaded', array($this, 'load_textdomain'), 99);
        add_action('enqueue_block_editor_assets', array($this, 'block_localization'));
    }

    /**
     * If debug is on, serve unminified source assets.
     *
     * @since 1.0.0
     * @param string|string $type The type of resource.
     * @param string|string $directory Any extra directories needed.
     */
    public function asset_source($type = 'js', $directory = null)
    {

        if ('js' === $type) {
            if (true === COBLOCKS_DEBUG) {
                return COBLOCKS_PLUGIN_URL . 'src/' . $type . '/' . $directory;
            } else {
                return COBLOCKS_PLUGIN_URL . 'dist/' . $type . '/' . $directory;
            }
        } else {
            return COBLOCKS_PLUGIN_URL . 'dist/css/' . $directory;
        }
    }

    /**
     * Loads the plugin language files.
     *
     * @access public
     * @since 1.0.0
     * @return void
     */
    public function load_textdomain()
    {
        load_plugin_textdomain('@@textdomain', false, dirname(plugin_basename(ECP_PLUGIN_DIR)) . '/languages/');
    }

    /**
     * Enqueue localization data for our blocks.
     *
     * @access public
     */
    public function block_localization()
    {
        if (function_exists('wp_set_script_translations')) {
            wp_set_script_translations('coblocks-editor', 'coblocks');
        }
    }

    /**
     * Add actions to enqueue assets.
     *
     * @access public
     */
    public function register_blocks()
    {
        // Return early if this function does not exist.
        if (!function_exists('register_block_type')) {
            return;
        }

        // // Shortcut for the slug.
        // $slug = $this->_slug;
        // register_block_type(
        //     $slug . '/accordion', array(
        //         'editor_script' => $slug . '-editor',
        //         'editor_style'  => $slug . '-editor',
        //         'style'         => $slug . '-frontend',
        //     )
        // );
    }

    /**
     * Enqueue block assets for use within Gutenberg.
     *
     * @access public
     */
    public function admin_assets()
    {
        // meta
        wp_register_script(
            $this->_slug . '-meta',
            $this->_url . '/includes/meta/js/meta.js',
            array('jquery', 'wp-color-picker'),
            filemtime(plugin_dir_path(__FILE__) . 'includes/meta/js/meta.js'),
            true
        );
        wp_enqueue_script($this->_slug . '-meta');

    }

}

/**
 * The main function for that returns EnergeticCoreParts
 *
 * The main function responsible for returning the one true EnergeticCoreParts
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $EnergeticCoreParts = EnergeticCoreParts(); ?>
 *
 * @since 1.0.0
 * @return object|EnergeticCoreParts The one true EnergeticCoreParts Instance.
 */
function EnergeticCoreParts()
{
    return EnergeticCoreParts::instance();
}

// Get the plugin running. Load on plugins_loaded action to avoid issue on multisite.
if (function_exists('is_multisite') && is_multisite()) {
    add_action('plugins_loaded', 'EnergeticCoreParts', 90);
} else {
    EnergeticCoreParts();
}
