<?php if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}

/**
 * Theme’s filters and actions
 */

// After Setup theme
function etmunfarid_etcodes_theme_setup()
{
    // Set the content width in pixels, based on the theme's design and stylesheet.
    $GLOBALS['content_width'] = apply_filters('etmunfarid_etcodes_content_width', 800);

    // Adding Title tag  support.
    add_action('after_setup_theme', 'theme_slug_setup');

    // Add theme support for automatic feed links. */
    add_theme_support('automatic-feed-links');

    /*
     * Theme support translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_theme_textdomain('munfarid', get_template_directory() . '/languages');

    // Add support for core custom logo.
    add_theme_support('custom-logo', array(
        'height' => 250,
        'width' => 250,
        'flex-width' => true,
        'flex-height' => true,
    ));
    // Add favicon
    add_theme_support('favicon');

    add_theme_support("title-tag"); // support the title tag
    add_editor_style();

    // Add theme support for post thumbnails (featured images).
    add_theme_support('post-thumbnails');
    add_theme_support('category-thumbnails');

    // Add nav menus function to the 'init' action hook.
    add_action('init', 'etmunfarid_etcodes_register_menus');

    // Add Post Formats support
    add_theme_support('post-formats', array(
        'video',
        'audio',
        'gallery',
        'quote',
    ));

    // Image Sizes
    add_image_size( 'carousel-one', 1200, 734, true );
    add_image_size( 'carousel-two', 730, 730, true );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support(
        'html5', array(
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        )
    );
    // Add support for full width images and other content such as videos.
    add_theme_support('align-wide');

    // color palette for editor
    add_theme_support( 'editor-color-palette', array(
        array(
            'name' => __( 'Dark blue', 'munfarid' ),
            'slug' => 'strong-blue',
            'color' => '#1e205a',
        ),
        array(
            'name' => __( 'Light blue', 'munfarid' ),
            'slug' => 'light-blue',
            'color' => '#3b42a2',
        ),
        array(
            'name' => __( 'White', 'munfarid' ),
            'slug' => 'white',
            'color' => '#fff',
        ),
        array(
            'name' => __( 'very light gray', 'munfarid' ),
            'slug' => 'very-light-gray',
            'color' => '#eee',
        ),
        array(
            'name' => __( 'very dark gray', 'munfarid' ),
            'slug' => 'very-dark-gray',
            'color' => '#444',
        ),
    ) ); 

    // body classes filter
    add_filter( 'body_class','etmunfarid_etcodes_body_classes' );

    /******** Modules  *********/
    
    // Header
    add_action('etmunfarid_etcodes_header_area', 'etmunfarid_etcodes_get_header', 10, 1);

    // Title
    add_action('etmunfarid_etcodes_main_title', 'etmunfarid_etcodes_get_title', 10, 1);

    // Add filter for Custom Comment Form
    add_filter('comment_form_defaults', 'etmunfarid_etcodes_comment_form');

    // Add filter for Custom Comment Form fields
    add_filter('comment_form_default_fields', 'etmunfarid_etcodes_comment_fields');

    // Add action for Custom Comment Form before
    add_action('comment_form_before', 'etmunfarid_etcodes_div_before_comments');

    // Add action for Custom Comment Form before
    add_action('comment_form_after', 'etmunfarid_etcodes_div_after_comments');

    // Register sidebars by running etmunfarid_etcodes_theme_sidebars_init() on the widgets_init hook.
    add_action('widgets_init', 'etmunfarid_etcodes_theme_sidebars_init');

    // Add custom css
    add_action('wp_enqueue_scripts', 'etmunfarid_etcodes_dynamic_css', 20);

    // Include TGM for require and recommend plugin 
    load_template(get_template_directory() . '/theme-includes/class-tgm-plugin-activation.php');

    /*************** WooCommerce *****************/
    /* Check if woocommerce plugin is active*/
    if (class_exists('WooCommerce')) {
        include_once get_template_directory() . '/theme-includes/et-woocommerce.php';
    }
    /************** WooCommerce end **************/

    /*************** EPC *****************/
    /* Check if EPC plugin is active*/
    if (class_exists('Energetic_Core_Parts\EnergeticCoreParts')) {
        include_once get_template_directory() . '/theme-includes/energetic-core-parts/energetic-core-parts.php';
    }
    /************** EPC end **************/
    
}
add_action('after_setup_theme', 'etmunfarid_etcodes_theme_setup');

// Sidebars
function etmunfarid_etcodes_theme_sidebars_init()
{
    register_sidebar(array(
        'name' => 'Blog Sidebar',
        'id' => 'etmunfarid_etcodes_blog_sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));
    register_sidebar(array(
        'name' => 'Page Sidebar',
        'id' => 'etmunfarid_etcodes_page_sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));
    register_sidebar(array(
        'name' => 'Shop',
        'id' => 'shop',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));

}
function etmunfarid_etcodes_body_classes( $classes ) {

    $page_id = get_the_ID();
    $etmunfarid_etcodes_header_style =  get_post_meta($page_id, 'etmunfarid_etcodes_header_style', true) ? get_post_meta($page_id, 'etmunfarid_etcodes_header_style', true) : get_theme_mod( 'etmunfarid_etcodes_header_style', 'header-one' );
    $body_classes = $etmunfarid_etcodes_header_style == 'header-six' ? 'have-sidebar-header' : '';

    $classes[] = $body_classes;
      
    return $classes;
}

/**
 * Custom 404 page
 */
$page_404 = get_theme_mod('etmunfarid_etcodes_404_page', 'none');
if ($page_404 !== 'none') {
    function etmunfarid_etcodes_filter_show_404_page($page_404)
    {
        if (!empty($page_404)) {
            global $wp_query;
            $wp_query = new WP_Query();
            $wp_query->query('page_id=' . $page_404);
            $wp_query->the_post();
            $template404 = get_page_template();
            rewind_posts();
            return $template404;
        }
    }
    add_filter('404_template', 'etmunfarid_etcodes_filter_show_404_page');
}


/***********************************************************************************************/
/* Custom Function for Displaying Comments */
/***********************************************************************************************/

function etmunfarid_etcodes_comments($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;

    if (get_comment_type() == 'pingback' || get_comment_type() == 'trackback'): ?>

    <li class="pingback" id="comment-<?php comment_ID();?>">
        <article <?php comment_class('clearfix');?>>
                <div class="row mb-2">
                    <div class="col-md-10">
                        <h5><?php esc_html_e('Pingback:', 'munfarid');?> <?php comment_author_link();?></h5>
                    </div>
                    <div class="col-md-2 text-right">
                        <span><?php edit_comment_link();?></span>
                    </div>
                </div>
        </article>
    <?php endif;?>

    <?php if (get_comment_type() == 'comment'): ?>

        <li class="comment" id="comment-<?php comment_ID();?>">
            <article id="div-comment-<?php comment_ID();?>" class="comment-body">
                <header class="comment-meta">
                    <?php
                    $avatar_size = 75;
                    echo get_avatar($comment, $avatar_size);
                    ?>
                    <cite><?php comment_author_link();?> </cite>
                    <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
                        <time datetime="<?php comment_time('c');?>><?php comment_date();?>, <?php comment_time();?>">
                            <?php comment_date();?><?php esc_html_e(' at', 'munfarid');?> <?php comment_time();?>
                        </time>
                    </a>
                    - <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth'])));?>
                </header>

                <!-- .comment-meta -->
                <section class="comment-content comment">
                    <?php if ($comment->comment_approved == '0'): ?>
                        <p class="awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'munfarid');?></p>
                    <?php endif;?>
                    <?php comment_text();?>
                    <?php edit_comment_link(__('Edit', 'munfarid'), '<span class="edit-link">', '</span>');?>
                </section><!-- .comment-content -->

            </article><!-- #comment-## -->

        <?php endif;
}

/****************** Custom Comment Form *********/

/* Add filter for Custom Comment Form fields*/
function etmunfarid_etcodes_comment_form($defaults)
{

    $comment_notes_before = '';
    $comment_notes_after = '';
    $title_reply = '' . __('Leave a Comment', 'munfarid') . '';

    $defaults['comment_notes_before'] = $comment_notes_before;
    $defaults['comment_notes_after'] = $comment_notes_after;
    $defaults['id_form'] = 'comment-form';
    $defaults['title_reply_before'] = '<h5 id="reply-title" class="comment-reply-title mb-3">';
    $defaults['title_reply_after'] = '</h5>';
    $defaults['id_submit'] = 'submit_button';
    $defaults['label_submit'] = '' . __('Post Comment', 'munfarid') . '';
    $defaults['title_reply'] = $title_reply;
    $defaults['comment_field'] = '<textarea class="mb-30px" name="comment" id="comment" cols="30" rows="4" placeholder="' . esc_attr__("Your Comment...", "munfarid") . '"></textarea>';
    return $defaults;
}

function etmunfarid_etcodes_comment_fields()
{
    $commenter = wp_get_current_commenter();
    $req = get_option('require_name_email');
    $aria_req = ($req ? " aria-required='true'" : '');

    $fields = array(
        'author' => '<div class="row mb-30px"><div class="col-lg-4">' .
        '<input placeholder="' . esc_attr__('Your Name', 'munfarid') . '  ' . ($req ? esc_attr__(' (required) " ', 'munfarid') : '') . '" id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" ' . $aria_req . ' />' .
        '</div>',
        'email' => '<div class="col-lg-4">' .
        '<input placeholder="' . esc_attr__('Your Email', 'munfarid') . '   ' . ($req ? esc_attr__(' (required)"', 'munfarid') : '') . '" id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" ' . $aria_req . ' />' .
        '</div>',
        'url' => '<div class="col-lg-4">' .
        '<input placeholder="' . esc_attr__('Your website', 'munfarid') . ' " id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) . '" />' .
        '</div></div>',
    );

    return $fields;
}
/* Add class and for Custom Comment Form before*/
function etmunfarid_etcodes_div_before_comments()
{
    echo '<div  id="contact-form" class="comment-form-warp">';
}
/* Add closing div for Custom Comment Form After*/
function etmunfarid_etcodes_div_after_comments()
{
    echo '</div>';
}