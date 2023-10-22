<?php
/**
 * Register blocks.
 *
 * @package   CoBlocks
 * @author    Rich Tabor & Jeffrey Carandang from CoBlocks
 * @link      https://coblocks.com
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Load registration for our blocks.
 *
 * @since 1.6.0
 */
class ECP_Register_Blocks
{

    /**
     * This plugin's instance.
     *
     * @var ECP_Register_Blocks
     */
    private static $__instance;

    /**
     * Registers the plugin.
     */
    public static function register()
    {
        if (null === self::$__instance) {
            self::$__instance = new ECP_Register_Blocks();
        }
    }

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
        $this->_slug = ECP_SLUG;

        add_action('init', array($this, 'register_blocks'), 99);
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

        // Shortcut for the slug.
        $slug = $this->_slug;

        register_block_type(
            $slug . '/accordion', array(
                'editor_script' => $slug . '-editor',
                'editor_style'  => $slug . '-editor',
                'style'         => $slug . '-frontend',
            )
        );
        register_block_type(
            $slug . '/alert', array(
                'editor_script' => $slug . '-editor',
                'editor_style'  => $slug . '-editor',
                'style'         => $slug . '-frontend',
            )
        );
        register_block_type(
            $slug . '/author', array(
                'editor_script' => $slug . '-editor',
                'editor_style'  => $slug . '-editor',
                'style'         => $slug . '-frontend',
            )
        );
        register_block_type(
            $slug . '/click-to-tweet', array(
                'editor_script' => $slug . '-editor',
                'editor_style'  => $slug . '-editor',
                'style'         => $slug . '-frontend',
            )
        );
        register_block_type(
            $slug . '/dynamic-separator', array(
                'editor_script' => $slug . '-editor',
                'editor_style'  => $slug . '-editor',
                'style'         => $slug . '-frontend',
            )
        );
        register_block_type(
            $slug . '/gif', array(
                'editor_script' => $slug . '-editor',
                'editor_style'  => $slug . '-editor',
                'style'         => $slug . '-frontend',
            )
        );
        register_block_type(
            $slug . '/gist', array(
                'editor_script' => $slug . '-editor',
                'editor_style'  => $slug . '-editor',
                'style'         => $slug . '-frontend',
            )
        );
        register_block_type(
            $slug . '/highlight', array(
                'editor_script' => $slug . '-editor',
                'editor_style'  => $slug . '-editor',
                'style'         => $slug . '-frontend',
            )
        );
    }
}

ECP_Register_Blocks::register();
