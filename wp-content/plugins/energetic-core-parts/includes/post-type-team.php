<?php

namespace Energetic_Core_Parts;

if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}

/**
 * Class TeamPostType
 * @package PostType
 *
 * Use actual name of post type for
 * easy readability.
 *
 * Potential conflicts removed by namespace
 */
class TeamPostType {
    /**
     * @var string
     *
     * Set post type params
     */
    private $type               = 'team';
    private $slug               = 'team';
    private $name               = 'Team';
    private $singular_name      = 'Team Member';
    /**
     * Register post type
     */
    public function register() {
    	// REGISTER THE POST TYPE
		$labels = array(
			'name' 			     => __( 'Team', 'energetic-core-parts' ),
			'singular_name' 	 => __( 'Team Member', 'energetic-core-parts' ),
			'add_new' 		     => __( 'Add New Member', 'energetic-core-parts' ),
			'add_new_item'		 => __( 'Add New Member', 'energetic-core-parts' ),
			'edit_item' 		 => __( 'Edit Team', 'energetic-core-parts' ),
			'new_item' 		     => __( 'Add New', 'energetic-core-parts' ),
			'view_item' 		 => __( '', 'energetic-core-parts' ),
			'search_items' 	     => __( '', 'energetic-core-parts' ),
			'not_found' 		 => __( 'No team members found', 'energetic-core-parts' ),
			'not_found_in_trash' => __( 'No team members found in trash', 'energetic-core-parts' )
		);
		
		$args = array(
	    	'labels' 			    => $labels,
	    	'public' 			    => true,
			'supports' 		        => array( 'title', 'editor', 'thumbnail'),
			'capability_type' 	    => 'post',
			'rewrite' 		        => array("slug" => "team"),
			'menu_position' 	    => 20,
			'has_archive' 		    => false,
			'hierarchical' 	        => false,
			'menu_icon'             => ( version_compare( $GLOBALS['wp_version'], '3.8', '>=' ) ) ? 'dashicons-groups' : false ,
			'exclude_from_search'   => true,
			'show_in_nav_menus'     => false,
			'show_in_rest'          => true,
		);

		register_post_type( 'team', $args );

		// REGISTER CATEGORIES
	    $taxonomy_member_category_labels = array(
			'name' 							=> __( 'Member Categories', 'energetic-core-parts' ),
			'singular_name' 				=> __( 'Member Category', 'energetic-core-parts' ),
			'search_items' 					=> __( 'Search Member Categories', 'energetic-core-parts' ),
			'popular_items'					=> __( 'Popular Member Categories', 'energetic-core-parts' ),
			'all_items' 					=> __( 'All Member Categories', 'energetic-core-parts' ),
			'parent_item' 					=> __( 'Parent Member Category', 'energetic-core-parts' ),
			'parent_item_colon' 			=> __( 'Parent Member Category:', 'energetic-core-parts' ),
			'edit_item' 					=> __( 'Edit Member Category', 'energetic-core-parts' ),
			'update_item' 					=> __( 'Update Member Category', 'energetic-core-parts' ),
			'add_new_item' 					=> __( 'Add New Member Category', 'energetic-core-parts' ),
			'new_item_name' 				=> __( 'New Member Category Name', 'energetic-core-parts' ),
			'separate_items_with_commas' 	=> __( 'Separate testimonial categories with commas', 'energetic-core-parts' ),
			'add_or_remove_items' 			=> __( 'Add or remove testimonial categories', 'energetic-core-parts' ),
			'choose_from_most_used' 		=> __( 'Choose from the most used testimonial categories', 'energetic-core-parts' ),
			'menu_name' 					=> __( 'Categories', 'energetic-core-parts' ),
	    );
		$taxonomy_member_category_args = array(
			'labels' 			=> $taxonomy_member_category_labels,
			'public' 			=> true,
			'show_in_nav_menus' => true,
			'show_ui' 			=> true,
			'show_admin_column' => true,
			'show_tagcloud'		=> false,
			'hierarchical' 		=> true,
			'rewrite' 			=> array( 'slug' => 'member_category' ),
			'query_var' 		=> true,
			'show_in_rest' => true,
	    );

		register_taxonomy( 'member_category', array( 'team' ), $taxonomy_member_category_args );
		
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
     * TeamPostType constructor.
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
new TeamPostType();