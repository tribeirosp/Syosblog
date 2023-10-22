<?php

namespace Energetic_Core_Parts;

if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}

/**
 * Class FooterPostType
 * @package PostType
 *
 * Use actual name of post type for
 * easy readability.
 *
 * Potential conflicts removed by namespace
 */
class FooterPostType {
    /**
     * @var string
     *
     * Set post type params
     */
    private $type               = 'etcodes-footer';
    private $slug               = 'etcodes-footer';
    private $name               = 'Footers';
    private $singular_name      = 'Footer';
    /**
     * Register post type
     */
    public function register() {
    	// REGISTER THE POST TYPE
        $labels = array(
            'name'                  => _x( 'Footers', 'Post Type General Name', 'energetic-core-parts' ),
            'singular_name'         => _x( 'Footer', 'Post Type Singular Name', 'energetic-core-parts' ),
            'menu_name'             => __( 'Footers', 'energetic-core-parts' ),
            'name_admin_bar'        => __( 'Footer', 'energetic-core-parts' ),
            'archives'              => __( 'Item Archives', 'energetic-core-parts' ),
            'attributes'            => __( 'Item Attributes', 'energetic-core-parts' ),
            'parent_item_colon'     => __( 'Parent Item:', 'energetic-core-parts' ),
            'all_items'             => __( 'Footers', 'energetic-core-parts' ),
            'add_new_item'          => __( 'Add New Footer', 'energetic-core-parts' ),
            'add_new'               => __( 'Add New', 'energetic-core-parts' ),
            'new_item'              => __( 'New Footer', 'energetic-core-parts' ),
            'edit_item'             => __( 'Edit Footer', 'energetic-core-parts' ),
            'update_item'           => __( 'Update Footer', 'energetic-core-parts' ),
            'view_item'             => __( 'View Footer', 'energetic-core-parts' ),
            'view_items'            => __( 'View Footers', 'energetic-core-parts' ),
            'search_items'          => __( 'Search Footer', 'energetic-core-parts' ),
            'not_found'             => __( 'Not found', 'energetic-core-parts' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'energetic-core-parts' ),
            'featured_image'        => __( 'Featured Image', 'energetic-core-parts' ),
            'set_featured_image'    => __( 'Set featured image', 'energetic-core-parts' ),
            'remove_featured_image' => __( 'Remove featured image', 'energetic-core-parts' ),
            'use_featured_image'    => __( 'Use as featured image', 'energetic-core-parts' ),
            'insert_into_item'      => __( 'Insert into item', 'energetic-core-parts' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'energetic-core-parts' ),
            'items_list'            => __( 'Items list', 'energetic-core-parts' ),
            'items_list_navigation' => __( 'Items list navigation', 'energetic-core-parts' ),
            'filter_items_list'     => __( 'Filter items list', 'energetic-core-parts' ),
        );
        $args = array(
            'label'                 => __( 'Footer', 'energetic-core-parts' ),
            'description'           => __( 'Footers', 'energetic-core-parts' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => null,
            'menu_icon'             => 'dashicons-align-center',
            'show_in_admin_bar'     => false,
            'show_in_nav_menus'     => false,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
            'show_in_rest'          => true,
            'show_in_menu'          => current_user_can('switch_themes') ? 'themes.php' : null,

        );
        register_post_type( 'etcodes-footer', $args );
    }

    /**
     * @param $columns
     * @return mixed
     *
     * Choose the columns you want in
     * the admin table for this post
     */
    public function set_columns($columns) {
        // Set/unset post type table columns here
        return $columns;
    }
    /**
     * @param $column
     * @param $post_id
     *
     * Edit the contents of each column in
     * the admin table for this post
     */
    public function edit_columns($column, $post_id) {
        // Post type table column content code here
	}
	
    /**
     * FooterPostType constructor.
     *
     * When class is instantiated
     */
    public function __construct() {
        // Register the post type
        add_action('init', array($this, 'register'));
        // Admin set post columns
        add_filter( 'manage_edit-'.$this->type.'_columns',        array($this, 'set_columns'), 10, 1) ;
        // Admin edit post columns
        add_action( 'manage_'.$this->type.'_posts_custom_column', array($this, 'edit_columns'), 10, 2 );
    }
}
/**
 * Instantiate class, creating post type
 */
new FooterPostType();