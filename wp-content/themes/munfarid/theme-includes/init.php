<?php if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}

class etmunfarid_Theme_Includes
{
    private static $rel_path = null;

    private static $include_isolated_callable;

    private static $initialized = false;

    public static function init()
    {
        if (self::$initialized) {
            return;
        } else {
            self::$initialized = true;
        }

        /**
         * Include a file isolated, to not have access to current context variables
         */
        self::$include_isolated_callable = function ($path) {
            include $path;
        };

        /**
         * Both frontend and backend
         */
        {
            self::include_child_first('/helpers.php');
            self::include_child_first('/hooks.php');
            self::include_child_first('/customizer/customizer.php');

            self::include_all_child_first('/post-parts');
            self::include_all_child_first('/meta');
            self::include_all_child_first('/sub-inc');

            // Merlin
            self::include_child_first( '/merlin/vendor/autoload.php' );
            self::include_child_first( '/merlin/class-merlin.php' );
            self::include_child_first( '/merlin-config.php' );
            self::include_child_first( '/merlin-filters.php' );

            add_action('init', array(__CLASS__, 'etmunfarid_etcodes_action_init'));
        }

        /**
         * Only frontend
         */
        if (!is_admin()) {
            add_action('wp_enqueue_scripts', array(__CLASS__, 'etmunfarid_etcodes_action_enqueue_scripts'),
                20// Include later to be able to make wp_dequeue_style|script()
            );
        } else {
            // for include back-end files
            add_action('admin_enqueue_scripts', array(__CLASS__, 'etmunfarid_etcodes_action_enqueue_admin_scripts'),
                20// Include later to be able to make wp_dequeue_style|script()
            );
            // for include back-end block editor
            add_action('enqueue_block_editor_assets', array(__CLASS__, 'etmunfarid_etcodes_action_enqueue_block_editor_scripts'),
                20// Include later to be able to make wp_dequeue_style|script()
            );
        }
    }

    private static function get_rel_path($append = '')
    {
        if (self::$rel_path === null) {
            self::$rel_path = '/theme-includes';
        }

        return self::$rel_path . $append;
    }

    private static function include_all_child_first($dir_rel_path)
    {
        $paths = array();

        if (is_child_theme()) {
            $paths[] = self::get_child_path($dir_rel_path);
        }

        $paths[] = self::get_parent_path($dir_rel_path);

        foreach ($paths as $path) {
            if ($files = glob($path . '/*.php')) {
                foreach ($files as $file) {
                    self::include_isolated($file);
                }
            }
        }
    }

    /**
     * @param string $directoryname 'foo-bar'
     *
     * @return string 'Foo_Bar'
     */
    private static function directoryname_to_classname($directoryname)
    {
        $class_name = explode('-', $directoryname);
        $class_name = array_map('ucfirst', $class_name);
        $class_name = implode('_', $class_name);

        return $class_name;
    }

    public static function get_parent_path($rel_path)
    {
        return get_template_directory() . self::get_rel_path($rel_path);
    }

    public static function get_child_path($rel_path)
    {
        if (!is_child_theme()) {
            return null;
        }

        return get_stylesheet_directory() . self::get_rel_path($rel_path);
    }

    public static function include_isolated($path)
    {
        call_user_func(self::$include_isolated_callable, $path);
    }

    public static function include_child_first($rel_path)
    {
        if (is_child_theme()) {
            $path = self::get_child_path($rel_path);

            if (file_exists($path)) {
                self::include_isolated($path);
            }
        }

        {
            $path = self::get_parent_path($rel_path);

            if (file_exists($path)) {
                self::include_isolated($path);
            }
        }
    }

    public static function include_parent_first($rel_path)
    {
        {
            $path = self::get_parent_path($rel_path);
            if (file_exists($path)) {
                self::include_isolated($path);
            }
        }
        if (is_child_theme()) {
            $path = self::get_child_path($rel_path);
            if (file_exists($path)) {
                self::include_isolated($path);
            }
        }
    }

    /**
     * @internal
     */
    public static function etmunfarid_etcodes_action_enqueue_scripts()
    {
        self::include_parent_first('/static.php');
    }

    /**
     * @internal
     */
    public static function etmunfarid_etcodes_action_enqueue_admin_scripts()
    {
        self::include_child_first('/backend-static.php');
    }

    /**
     * @internal
     */
    public static function etmunfarid_etcodes_action_enqueue_block_editor_scripts()
    {
        self::include_child_first('/backend-block-editor-static.php');
    }

    /**
     * @internal
     */
    public static function etmunfarid_etcodes_action_init()
    {
        self::include_child_first('/menus.php');
        self::include_child_first('/posts.php');
    }


}

etmunfarid_Theme_Includes::init();
