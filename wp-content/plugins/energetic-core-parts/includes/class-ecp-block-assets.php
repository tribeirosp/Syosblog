<?php
/**
 * Load assets for our blocks.
 *
 * @package   @@pkg.title
 * @author    @@pkg.author
 * @link      @@pkg.author_shop
 * @license   @@pkg.license
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Load general assets for our blocks.
 *
 * @since 1.0.0
 */
class ECP_Block_Assets
{

    /**
     * This plugin's instance.
     *
     * @var ECP_Block_Assets
     */
    private static $__instance;

    /**
     * Registers the plugin.
     */
    public static function register()
    {
        if (null === self::$__instance) {
            self::$__instance = new ECP_Block_Assets();
        }
    }

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
    private function __construct()
    {
        $this->_version = ECP_VERSION;
        $this->_slug    = ECP_SLUG;
        $this->_url     = untrailingslashit(plugins_url('/', dirname(__FILE__)));

        add_action('enqueue_block_assets', array($this, 'block_assets'));
        add_action('init', array($this, 'editor_assets'));
    }

    /**
     * Enqueue block assets for use within Gutenberg.
     *
     * @access public
     */
    public function block_assets()
    {

        // Styles.
        wp_enqueue_style(
            $this->_slug . '-frontend',
            $this->_url . '/dist/blocks.style.build.css',
            array(),
            $this->_version
        );

        // Scripts.
        wp_enqueue_script(
            $this->_slug . '-frontend',
            $this->_url . '/dist/frontend.blocks.build.js',
            array('jquery'),
            $this->_version,
            true
        );
    }

    /**
     * Enqueue block assets for use within Gutenberg.
     *
     * @access public
     */
    public function editor_assets()
    {

        // Styles.
        wp_register_style(
            $this->_slug . '-editor',
            $this->_url . '/dist/blocks.editor.build.css',
            array(),
            $this->_version
        );

        // Scripts.
        wp_register_script(
            $this->_slug . '-editor',
            $this->_url . '/dist/blocks.build.js',
            array('wp-blocks', 'wp-i18n', 'wp-element', 'wp-plugins', 'wp-components', 'wp-edit-post', 'wp-api'),
            time(),
            true
        );
    }

}

ECP_Block_Assets::register();
