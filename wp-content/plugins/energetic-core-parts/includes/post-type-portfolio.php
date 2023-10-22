<?php
namespace Energetic_Core_Parts;

if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}

/**
 * Class Portfolio
 * @package PostType
 *
 * Use actual name of post type for
 * easy readability.
 *
 * Potential conflicts removed by namespace
 */
class Portfolio {
    /**
     * @var string
     *
     * Set post type params
     */
    private $type               = 'portfolio';
    private $slug               = 'portfolio';
    private $name               = 'Portfolio';
    private $singular_name      = 'Project';
    /**
     * Register post type
     */
    public function register() {
        $labels = array(
			'name' 			     => __( 'Portfolio', 'energetic-core-parts' ),
			'singular_name' 	 => __( 'Portfolio Post', 'energetic-core-parts' ),
			'add_new' 		     => __( 'Add New', 'energetic-core-parts' ),
			'add_new_item'		 => __( 'Add New Portfolio', 'energetic-core-parts' ),
			'edit_item' 		 => __( 'Edit Portfolio', 'energetic-core-parts' ),
			'new_item' 		     => __( 'Add New', 'energetic-core-parts' ),
			'view_item' 		 => __( 'View Portfolio', 'energetic-core-parts' ),
			'search_items' 	     => __( 'Search Portfolio', 'energetic-core-parts' ),
			'not_found' 		 => __( 'No portfolio items found', 'energetic-core-parts' ),
			'not_found_in_trash' => __( 'No portfolio items found in trash', 'energetic-core-parts' )
        );
        $args = array(
            'labels'                => $labels,
            'public'                => true,
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'query_var'             => true,
            'rewrite'               => array( 'slug' => $this->slug ),
            'capability_type'       => 'post',
            'has_archive'           => true,
            'hierarchical'          => true,
            'menu_position'         => 20,
			'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'custom-fields'),
			'menu_icon'       => ( version_compare( $GLOBALS['wp_version'], '3.8', '>=' ) ) ? 'dashicons-portfolio' : false ,
			'yarpp_support'         => true,
			'show_in_rest'          => true
        );
		register_post_type( $this->type, $args );
		

		// REGISTER TAGS
		$taxonomy_portfolio_tag_labels = array(
			'name' 							=> __( 'Portfolio Tags', 'energetic-core-parts' ),
			'singular_name' 				=> __( 'Portfolio Tag', 'energetic-core-parts' ),
			'search_items' 					=> __( 'Search Portfolio Tags', 'energetic-core-parts' ),
			'popular_items' 				=> __( 'Popular Portfolio Tags', 'energetic-core-parts' ),
			'all_items' 					=> __( 'All Portfolio Tags', 'energetic-core-parts' ),
			'parent_item' 					=> __( 'Parent Portfolio Tag', 'energetic-core-parts' ),
			'parent_item_colon' 			=> __( 'Parent Portfolio Tag:', 'energetic-core-parts' ),
			'edit_item' 					=> __( 'Edit Portfolio Tag', 'energetic-core-parts' ),
			'update_item' 					=> __( 'Update Portfolio Tag', 'energetic-core-parts' ),
			'add_new_item' 					=> __( 'Add New Portfolio Tag', 'energetic-core-parts' ),
			'new_item_name' 				=> __( 'New Portfolio Tag Name', 'energetic-core-parts' ),
			'separate_items_with_commas' 	=> __( 'Separate portfolio tags with commas', 'energetic-core-parts' ),
			'add_or_remove_items' 			=> __( 'Add or remove portfolio tags', 'energetic-core-parts' ),
			'choose_from_most_used' 		=> __( 'Choose from the most used portfolio tags', 'energetic-core-parts' ),
			'menu_name' 					=> __( 'Tags', 'energetic-core-parts' )
		);

		$taxonomy_portfolio_tag_args = array(
			'labels' => $taxonomy_portfolio_tag_labels,
			'public' => true,
			'show_in_nav_menus' => false,
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => false,
			'rewrite' => array( 'slug' => 'portfolio_tag' ),
			'show_admin_column' => false,
			'query_var' => true
		);

		register_taxonomy( 'portfolio_tag', array( $this->type ), $taxonomy_portfolio_tag_args );


		// REGISTER CATEGORIES
	    $taxonomy_portfolio_category_labels = array(
			'name' 							=> __( 'Portfolio Categories', 'energetic-core-parts' ),
			'singular_name' 				=> __( 'Portfolio Category', 'energetic-core-parts' ),
			'search_items' 					=> __( 'Search Portfolio Categories', 'energetic-core-parts' ),
			'popular_items'					=> __( 'Popular Portfolio Categories', 'energetic-core-parts' ),
			'all_items' 					=> __( 'All Portfolio Categories', 'energetic-core-parts' ),
			'parent_item' 					=> __( 'Parent Portfolio Category', 'energetic-core-parts' ),
			'parent_item_colon' 			=> __( 'Parent Portfolio Category:', 'energetic-core-parts' ),
			'edit_item' 					=> __( 'Edit Portfolio Category', 'energetic-core-parts' ),
			'update_item' 					=> __( 'Update Portfolio Category', 'energetic-core-parts' ),
			'add_new_item' 					=> __( 'Add New Portfolio Category', 'energetic-core-parts' ),
			'new_item_name' 				=> __( 'New Portfolio Category Name', 'energetic-core-parts' ),
			'separate_items_with_commas' 	=> __( 'Separate portfolio categories with commas', 'energetic-core-parts' ),
			'add_or_remove_items' 			=> __( 'Add or remove portfolio categories', 'energetic-core-parts' ),
			'choose_from_most_used' 		=> __( 'Choose from the most used portfolio categories', 'energetic-core-parts' ),
			'menu_name' 					=> __( 'Categories', 'energetic-core-parts' ),
	    );

	    $taxonomy_portfolio_category_args = array(
			'labels' 			=> $taxonomy_portfolio_category_labels,
			'public' 			=> true,
			'show_in_nav_menus' => true,
			'show_ui' 			=> true,
			'show_admin_column' => true,
			'show_tagcloud'		=> false,
			'hierarchical' 		=> true,
			'rewrite' 			=> array( 'slug' => 'portfolio_category' ),
			'query_var' 		=> true
	    );

		register_taxonomy( 'portfolio_category', array( $this->type ), $taxonomy_portfolio_category_args );
		
    }
    /**
     * @param $columns
     * @return mixed
     *
     * Choose the columns you want in
     * the admin table for this post
     */
    public function set_columns($columns) {
		$column_thumb = array( 'thumbnail' => __('Thumbnail','energetic-core-parts' ) );
		$columns = array_slice( $columns, 0, 2, true ) + $column_thumb + array_slice( $columns, 1, NULL, true );
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
		switch ( $column ) {
			case 'thumbnail':
				echo get_the_post_thumbnail( $post_id, array(35, 35) );
				break;
		}
    }
    /**
     * Portfolio constructor.
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
new Portfolio();