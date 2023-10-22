<?php if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}
/**
 * Helper functions used all over the theme
 */

/********** Logo **********/

function etmunfarid_etcodes_logo()
{ 
    $page_id = get_the_ID();
    $logo_color_scheme  =  get_post_meta($page_id, 'etmunfarid_etcodes_page_logo_color_scheme', true) == 'light' ? 'brand-scheme-light' : 'brand-scheme-dark';
    
    ?>
    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="navbar-brand <?php echo esc_attr($logo_color_scheme); ?>">
        <?php if (function_exists('the_custom_logo') && has_custom_logo()) {
    echo wp_get_attachment_image(get_theme_mod('custom_logo'), 'full', false, array("class" => "etcodes-normal-logo"));
    echo wp_get_attachment_image(get_theme_mod('etmunfarid_etcodes_logo_light'), 'full', false, array("class" => "etcodes-light-logo"));
} else {?>
            <span class="site-title"><?php bloginfo('name');?></span>
        <?php }?>
    </a>
    <?php if (display_header_text()) {?>
        <span class="site-description mr-auto"><?php echo esc_html(get_bloginfo('description', 'display')); ?></span>
    <?php }
}

/********** social menu  **********/

function etmunfarid_etcodes_get_social_menu()
{
    if (has_nav_menu('social')) {
        wp_nav_menu(
            array(
                'theme_location' => 'social',
                'menu_class' => 'inline-nav',
                'depth' => 1,
                'link_before' => '<span class="screen-reader-text">',
                'link_after' => '</span><i class="fas fa-link"></i>',
            )
        );
    }
}

/**
 * Display icons in social links menu.
 *
 * @param  string  $item_output The menu item output.
 * @param  WP_Post $item        Menu item object.
 * @param  int     $depth       Depth of the menu.
 * @param  array   $args        wp_nav_menu() arguments.
 * @return string  $item_output The menu item output with social icon.
 */
function etmunfarid_etcodes_nav_menu_social_icons($item_output, $item, $depth, $args)
{
    // Get supported social icons.
    $social_icons = etmunfarid_etcodes_social_links_icons();

    // Change icon inside social links menu if there is supported URL.
    if ('social' === $args->theme_location) {
        foreach ($social_icons as $attr => $value) {
            if (false !== strpos($item_output, $attr)) {
                $item_output = str_replace($args->link_after, '</span><i class="fab fa-' . esc_attr($value) . ' "></i>', $item_output);
            }
        }
    }

    return $item_output;
}
add_filter('walker_nav_menu_start_el', 'etmunfarid_etcodes_nav_menu_social_icons', 10, 4);

/**
 * Returns an array of supported social links (URL and icon name).
 *
 * @return array $social_links_icons
 */
function etmunfarid_etcodes_social_links_icons()
{

    $social_links_icons = array(
        '500px.com' => '500px',
        'amazon.com' => 'amazon',
        'bandsintown.com' => 'bandsintown',
        'behance.net' => 'behance',
        'chownow.com' => 'chownow',
        'codepen.io' => 'codepen',
        'dribbble.com' => 'dribbble',
        'dropbox.com' => 'dropbox',
        'facebook.com' => 'facebook',
        '/feed' => 'rss',
        'flickr.com' => 'flickr',
        'foursquare.com' => 'foursquare',
        'plus.google.com' => 'google',
        'github.com' => 'github',
        'instagram.com' => 'instagram',
        'itunes' => 'itunes',
        'itunes.apple.com' => 'itunes',
        'linkedin.com' => 'linkedin',
        'mailto:' => 'email',
        'medium.com' => 'medium',
        'meetup.com' => 'meetup',
        'pinterest.com' => 'pinterest',
        'quora.com' => 'quora',
        'reddit.com' => 'reddit',
        'smugmug.net' => 'smugmug',
        'snapchat.com' => 'snapchat-ghost',
        'soundcloud.com' => 'soundcloud',
        'spotify.com' => 'spotify',
        'stumbleupon.com' => 'stumbleupon',
        'tumblr.com' => 'tumblr',
        'twitch.tv' => 'twitch',
        'twitter.com' => 'twitter',
        'vimeo.com' => 'vimeo',
        'vine.co' => 'vine',
        'vevo.com' => 'vevo',
        'vsco.co' => 'vsco',
        'wordpress.org' => 'wordpress',
        'wordpress.com' => 'wordpress',
        'yelp.com' => 'yelp',
        'youtube.com' => 'youtube',
        'mastodon.social' => 'mastodon',
        'norden.social' => 'mastodon',
    );

    return apply_filters('etmunfarid_etcodes_social_links_icons', $social_links_icons);
}

/**********  header search bar **********/

function etmunfarid_etcodes_get_header_search()
{?>
    <div class="header-search-bar">
            <div class="d-flex">
                <a href="#" class="search-icon do-toggle-search-bar"><i class="fa fa-search"></i></a>
                <form class="search-form" role="search" action="<?php echo esc_url(home_url('/')); ?>">
                    <div class="input-group">
                    <div class="input-group-btn">
                        <button class="btn" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                      </div>
                      <input type="text" class="form-control" placeholder="<?php echo esc_attr__('Search...', 'munfarid'); ?>" value="<?php echo get_search_query(); ?>" name="s">
                    </div>
                </form>
            </div>
    </div>
<?php }

/********** Display navbar modules  **********/

if (!function_exists('etmunfarid_etcodes_navbar_modules')):
    function etmunfarid_etcodes_navbar_modules($classes = 'navbar-modules d-none d-lg-flex align-items-center')
        {   
            $page_id = get_the_ID();
            $is_social_icons = get_post_meta($page_id, 'etmunfarid_etcodes_is_header_social_icons', true) == 'on' ? get_post_meta($page_id, 'etmunfarid_etcodes_is_header_social_icons', true) : get_theme_mod( 'etmunfarid_etcodes_header_header_Social_icons', false );
            $is_search_bar = get_post_meta($page_id, 'etmunfarid_etcodes_is_header_search_bar', true) == 'on' ? get_post_meta($page_id, 'etmunfarid_etcodes_is_header_search_bar', true) : get_theme_mod( 'etmunfarid_etcodes_header_search', false );
            $is_shopping_cart = get_post_meta($page_id, 'etmunfarid_etcodes_is_header_shopping_cart', true) == 'on' ? get_post_meta($page_id, 'etmunfarid_etcodes_is_header_shopping_cart', true) : get_theme_mod( 'etmunfarid_etcodes_header_shopping_cart', false );
        ?>
	        <div class="<?php echo esc_attr($classes); ?>">
	                <?php if ($is_social_icons) {?>
	                    <div class="navbar-module">
	                         <?php echo etmunfarid_etcodes_get_social_menu(); ?>
	                    </div>
	                <?php }?>
	                <?php if ($is_search_bar) {?>
	                    <div class="navbar-module">
	                        <?php etmunfarid_etcodes_get_header_search();?>
	                     </div>
	                <?php }?>
	                <?php if ($is_shopping_cart && function_exists('etmunfarid_etcodes_header_cart')) {?>
	                    <div class="navbar-module cart-navbar-module">
	                        <?php echo etmunfarid_etcodes_header_cart() ?>
	                    </div>
	                <?php }?>
	        </div>
	    <?php }
endif;

if (!function_exists('etmunfarid_etcodes_post_types_list')):
    /**
     * Get list of post types
     *
     * @param string $param
     */
    function etmunfarid_etcodes_post_types_list()
{

        $args = array(
            'public' => true,
        );
        $output = 'objects';
        $operator = 'and';
        $post_types = get_post_types($args, $output, $operator);
        $result = array();

        if (!empty($post_types)) {
            foreach ($post_types as $post_type) {
                $result[$post_type->name] = $post_type->label;
            }
        }

        return $result;
    }
endif;

if (!function_exists('etmunfarid_etcodes_taxonomies_list_for_opt')):
    /**
     * Get list of taxonomies
     *
     * @param string $param
     */
    function etmunfarid_etcodes_taxonomies_list_for_opt()
{
        $args = array(
            'public' => true,
        );
        $output = 'objects';
        $operator = 'and';
        $post_types = get_post_types($args, $output, $operator);
        $result = array();

        if (!empty($post_types)) {
            foreach ($post_types as $post_type) {

                $taxonomies_array = array();
                $taxonomies = get_object_taxonomies($post_type->name, 'objects');

                foreach ($taxonomies as $taxonomy) {
                    $taxonomies_array[$taxonomy->name] = $taxonomy->label;

                    $taxonomies_opt = array();
                    foreach ($taxonomies_array as $taxonomy_opt => $taxonomy_label) {

                        $taxonomies_opt[$taxonomy_opt] = array(
                            'type' => 'multi-select',
                            'label' => $taxonomy_label,
                            'population' => 'taxonomy',
                            'source' => $taxonomy_opt,
                        );
                    }

                }
                $result[$post_type->name] = $taxonomies_opt;
            }
        }

        return $result;

    }
endif;

/********* Get an array of all pages *********/

if (!function_exists('etmunfarid_etcodes_pages_list')):
    function etmunfarid_etcodes_pages_list()
{
        $pages = get_pages();
        $result = array();
        $result['none'] = esc_html__('None', 'munfarid');
        foreach ($pages as $page) {
            $result[$page->ID] = $page->post_title;
        }

        return $result;
    }

endif;

/********* Get an array of all footers *********/

if (!function_exists('etmunfarid_etcodes_footers_list')):
    function etmunfarid_etcodes_footers_list()
{
        $args = array(
            'post_type' => 'etcodes-footer',
            'numberposts' => -1,
        );
        $pages = get_posts($args);
        $result = array();
        $result['none'] = esc_html__('None', 'munfarid');
        foreach ($pages as $page) {
            $result[$page->ID] = $page->post_title;
        }

        return $result;
    }

endif;

/********* print theme requirements page *********/

if (!function_exists('etmunfarid_etcodes_return_memory_size')):
    /**
     * print theme requirements page
     *
     * @param string $size
     */
    function etmunfarid_etcodes_return_memory_size($size)
{
        $symbol = substr($size, -1);
        $return = (int) $size;
        switch (strtoupper($symbol)) {
            case 'P':
                $return *= 1024;
            case 'T':
                $return *= 1024;
            case 'G':
                $return *= 1024;
            case 'M':
                $return *= 1024;
            case 'K':
                $return *= 1024;
        }
        return $return;
    }
endif;

if (!function_exists('etmunfarid_etcodes_is_page_url_excluded')):
    /**
     * Check if is page is from excluded pages
     */
    function etmunfarid_etcodes_is_page_url_excluded()
{
        $exception_urls = array('wp-login.php', 'async-upload.php', '/plugins/', 'wp-admin/', 'upgrade.php', 'trackback/', 'feed/');
        if (is_admin()) {
            return true;
        }

        return false;
    }
endif;

if (!function_exists('etmunfarid_etcodes_render_view')) {
    /**
     * Safe render a view and return html
     */
    function etmunfarid_etcodes_render_view($file_path, $view_variables = array(), $return = true)
    {
        extract($view_variables, EXTR_REFS);

        unset($view_variables);

        if ($return) {
            ob_start();

            require $file_path;

            return ob_get_clean();
        } else {
            require $file_path;
        }
    }
}

if (!function_exists('etmunfarid_etcodes_get_instagram_photos')):
    /**
     * Get instagram photos
     *
     * @param string $username - instagram username
     * @param integer $items - number of photos
     */
    function etmunfarid_etcodes_get_instagram_photos($username, $items = 9)
{
        if (false === ($instagram = get_transient('instagram-photos-' . sanitize_title_with_dashes($username) . '-' . $items))) {
            $connect = wp_remote_get('http://instagram.com/' . trim($username));

            if (is_wp_error($connect)) {
                return new WP_Error('site_down', esc_html__('Unable to communicate with Instagram.', 'munfarid'));
            }

            if (200 != wp_remote_retrieve_response_code($connect)) {
                return new WP_Error('invalid_response', esc_html__('Instagram did not return a 200.', 'munfarid'));
            }

            $shared_data = explode('window._sharedData = ', $connect['body']);
            $instagram_json = explode(';</script>', $shared_data[1]);
            $instagram_array = json_decode($instagram_json[0], true);

            if (!$instagram_array) {
                return new WP_Error('bad_json', esc_html__('Instagram has returned invalid data.', 'munfarid'));
            }
            // attention on this array !
            if (isset($instagram_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'])) {
                $images = $instagram_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'];
            } else {
                return;
            }

            $instagram = array();
            $etmunfarid_etcodes_count = 0;
            foreach ($images as $image) {
                if (!$image['node']['is_video']) {
                    $instagram[] = array(
                        'code' => $image['node']['shortcode'],
                        'link' => $image['node']['display_url'],
                    );
                    $etmunfarid_etcodes_count++;
                }
                if ($etmunfarid_etcodes_count == $items) {
                    break;
                }
            }
            ;

            $instagram = serialize($instagram);
            set_transient('instagram-photos-' . sanitize_title_with_dashes($username), $instagram, apply_filters('null_instagram_cache_time', HOUR_IN_SECONDS * 2));
        }
        $instagram = unserialize($instagram);

        return array_slice($instagram, 0, $items);
    }
endif;

if (!function_exists('etmunfarid_etcodes_twitter_formating')):
    /**
     * Return the twitter formatted text
     *
     * @param string $text
     * @param string $user
     */
    function etmunfarid_etcodes_twitter_formating($text, $user)
{
        $pattern = array(
            '/[^(:\/\/)](www\.[^ \n\r]+)/',
            '/(https?:\/\/[^ \n\r]+)/',
            '/@(\w+)/',
            '/^' . $user . ':\s*/i',
        );
        $replace = array(
            '<a href="http://$1" rel="nofollow"  target="_blank">$1</a>',
            '<a href="$1" rel="nofollow" target="_blank">$1</a>',
            '<a href="http://twitter.com/$1" rel="nofollow"  target="_blank">$1</a>' .
            '',
        );

        return preg_replace($pattern, $replace, $text);
    }
endif; 
 
if (!function_exists('etmunfarid_etcodes_get_footer_content')):
    /**
     * footer
     */
    function etmunfarid_etcodes_get_footer_content() {   
        
        $page_id = get_the_ID(); 
        
        if($page_id && get_post_meta($page_id, 'ecp_etcodes_custom_footer', true) !== 'none' && get_post_meta($page_id, 'ecp_etcodes_custom_footer', true) !== '' ) {
            $footer_ID =  get_post_meta($page_id, 'ecp_etcodes_custom_footer', true);
        } else {
            $footer_ID = get_theme_mod('etmunfarid_etcodes_selected_footer') !== 'none' ? get_theme_mod('etmunfarid_etcodes_selected_footer') : false;
        }

        if ($footer_ID) {
            
            $footer_style = get_post_meta($footer_ID, 'energetic_core_parts_footer_background', true) ? 'style="background-color:'. esc_attr(get_post_meta($footer_ID, 'energetic_core_parts_footer_background', true)) .';"' : false;
            $bottom_footer_style = get_post_meta($footer_ID, 'energetic_core_parts_bottom_footer_background', true) ? 'style="background-color:'. esc_attr(get_post_meta($footer_ID, 'energetic_core_parts_bottom_footer_background', true)) .';"' : false;
            $is_bottom_footer = get_post_meta($footer_ID, 'energetic_core_parts_is_bottom_footer', true) ?  get_post_meta($footer_ID, 'energetic_core_parts_is_bottom_footer', true) : 'off';
            $post = get_post($footer_ID);
            $content = apply_filters('the_content', $post->post_content);

            if($is_bottom_footer == 'on') { ?>
            
                <div class="entry-content" <?php echo wp_kses_post($footer_style) ?>> <?php echo $content ?></div>
                <div class="footer-bottom-area footer-top-border pt-40px pb-40px" <?php echo wp_kses_post($bottom_footer_style) ?>>
	                <div class="container">
	                    <div class="row">
	                        <div class="col-md-6">
	                            <?php esc_html_e('&copy; ', 'dabba');
                                    echo date("Y");
                                    esc_html_e(' ', 'dabba');
                                    echo bloginfo('name');?>
	                        </div>
                            <div class="col-md-6">
                                <?php if (has_nav_menu('footer')) { etmunfarid_etcodes_footer_menu(); } ?>
                            </div>
	                    </div>
	                </div>
                </div>
                
            <?php } else { ?> 
                <div class="entry-content" <?php echo wp_kses_post($footer_style) ?>> <?php echo $content ?></div> 
            <?php }
            

        } else { ?>
	        <div class="footer-widgets footer-top-border pt-40px pb-40px">
	            <div class="container">
	                <div class="row">
	                    <div class="col-md-6">
	                        <?php esc_html_e('&copy; ', 'dabba');
                                echo date("Y");
                                esc_html_e(' ', 'dabba');
                                echo bloginfo('name');?>
	                    </div>
                        <div class="col-md-6">
                            <?php if (has_nav_menu('footer')) { etmunfarid_etcodes_footer_menu(); } ?>
                        </div>
	                </div>
	            </div>
	        </div>
	        <?php }
    }

endif;

/*=============================================
=            BREADCRUMBS                        =
=============================================*/

function etmunfarid_etcodes_ext_breadcrumbs()
{
    $sep = ' > ';
    if (!is_front_page()) {

        // Start the breadcrumb with a link to your homepage
        echo '<div class="breadcrumbs">';
        echo '<a href="';
        echo esc_url(home_url('/'));
        echo '">';
        bloginfo('name');
        echo '</a>' . $sep;

        // Check if the current page is a category, an archive or a single page. If so show the category or archive name.
        if (is_category() || is_single()) {
            the_category(' - ');
        } elseif (is_archive() || is_single()) {
            if (is_day()) {
                printf(__('%s', 'munfarid'), get_the_date());
            } elseif (is_month()) {
                printf(__('%s', 'munfarid'), get_the_date(_x('F Y', 'monthly archives date format', 'munfarid')));
            } elseif (is_year()) {
                printf(__('%s', 'munfarid'), get_the_date(_x('Y', 'yearly archives date format', 'munfarid')));
            } else {
                _e('Blog Archives', 'munfarid');
            }
        }

        // If the current page is a single post, show its title with the separator
        if (is_single()) {
            echo esc_html($sep);
            the_title();
        }

        // If the current page is a static page, show its title.
        if (is_page()) {
            echo the_title();
        }

        // if you have a static page assigned to be you posts list page. It will find the title of the static page and display it. i.e Home >> Blog
        if (is_home()) {
            global $post;
            $page_for_posts_id = get_option('page_for_posts');
            if ($page_for_posts_id) {
                $post = get_page($page_for_posts_id);
                setup_postdata($post);
                the_title();
                rewind_posts();
            }
        }
        echo '</div>';
    }
}


// Register Google Font
function etmunfarid_etcodes_google_fonts_url()
{
    $font_url = '';
    $font_families = array();

    $font_families[] = get_theme_mod('etmunfarid_etcodes_headings_font') ? get_theme_mod('etmunfarid_etcodes_headings_font') : 'Poppins' . ':500,600,700';
	$font_families[] = get_theme_mod('etmunfarid_etcodes_body_font') ? get_theme_mod('etmunfarid_etcodes_body_font', 'Poppins') : 'Poppins' .':400,400i,500';
    $font_families[] = get_theme_mod('etmunfarid_etcodes_menu_font') ? get_theme_mod('etmunfarid_etcodes_menu_font', 'Poppins') : 'Poppins' .':400,400i,500,600,700';

    $query_args = array(
        'family' => rawurlencode( implode( '|', $font_families ) ),
        'subset' => rawurlencode( 'latin,latin-ext' ),
    );

    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ('off' !== esc_html_x('on', 'Google font: on or off', 'munfarid')) {
        $font_url = add_query_arg($query_args, "//fonts.googleapis.com/css");
    }
    return esc_url_raw($font_url);
}

// Get all Image sizes
function etmunfarid_etcodes_get_image_sizes() {
	$sizes = array();
	foreach ( get_intermediate_image_sizes() as $_size ) {
		$label = preg_replace('/_/', ' ', $_size);
        $label = ucfirst($label);
		$sizes[$_size] = $label;
	};
	return $sizes;
}