<?php if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}

/**
 * Register theme menus
 */

function etmunfarid_etcodes_register_menus()
{
    /* Register nav menus */
    register_nav_menus(array(
        'primary'       => esc_html__('Primary Menu', 'munfarid'),
        'secondary'     => esc_html__('Secondary Menu', 'munfarid'),
        'sidebar_menu'  => esc_html__('Vertical/Sidebar Menu', 'munfarid'),
        'footer'        => esc_html__('Footer Menu', 'munfarid'),
        'social'        => esc_html__('Social Menu', 'munfarid'),
    ));
}

/* display the menu if available */

function etmunfarid_etcodes_theme_primary_menu($container_class)
{   
    $container_class  = isset($container_class) && $container_class !== '' ? $container_class : 'collapse navbar-collapse';
    wp_nav_menu(array(
        'theme_location'  => 'primary',
        'container'       => 'div',
        'container_class' => $container_class,
        'container_id'    => 'etcodesnavbarDropdown',
        'menu_class'      => 'navbar-nav',
        'fallback_cb'     => '__return_false',
        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'depth'           => 4,
        'walker'          => new etmunfarid_etcodes_walker_nav_menu(),
    ));
}

function etmunfarid_etcodes_theme_secondary_menu()
{
    wp_nav_menu(array(
        'theme_location'  => 'secondary',
        'container'       => 'div',
        'container_class' => 'collapse navbar-collapse',
        'container_id'    => 'etcodesnavbarDropdown',
        'menu_class'      => 'navbar-nav',
        'fallback_cb'     => '__return_false',
        'items_wrap'      => '<ul id="%1$s" class="%2$s secondary-navbar-nav">%3$s</ul>',
        'depth'           => 4,
        'walker'          => new etmunfarid_etcodes_walker_nav_menu(),
    ));
}

function etmunfarid_etcodes_theme_primary_secondary_combine_menu()
{
    /** Combines the markup of two menu areas into one. */

    // Get the markup list items in the first menu.
    $menu = wp_nav_menu(array(
        'theme_location' => 'primary',
        'fallback_cb'    => false,
        'container'      => '',
        'items_wrap'     => '%3$s',
        'echo'           => false,
    ));

    wp_nav_menu(array(
        'theme_location'  => 'secondary',
        'container'       => 'div',
        'container_class' => 'collapse navbar-collapse',
        'container_id'    => 'etcodesCombinenavbarDropdown',
        'menu_class'      => 'navbar-nav',
        'fallback_cb'     => '__return_false',
        'items_wrap'      => '<ul id="%1$s" class="%2$s secondary-navbar-nav">' . $menu . ' %3$s</ul>',
        'depth'           => 4,
        'walker'          => new etmunfarid_etcodes_walker_nav_menu(),
    ));
}

function etmunfarid_etcodes_theme_primary_sidebar_menu()
{
    wp_nav_menu(array(
        'theme_location' => 'sidebar_menu',
        'container'      => false,
        'menu_class'     => 'sidebar-menu',
        'fallback_cb'    => '__return_false',
        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'depth'          => 4,
        'walker'         => new etmunfarid_etcodes_sidebar_walker_nav_menu(),
    ));
}
/**
 * Check if mega menu then change walker
 */
function etmunfarid_etcodes_if_mega_walker_nav_menu($args)
{
    if ('primary' == $args['theme_location']) {
        if (class_exists('Etumda_Etcodes_Mega_Menu_Custom_Walker')) {
            $args['walker'] = new Etumda_Etcodes_Mega_Menu_Custom_Walker();
        } else {
            $args['walker'] = new etmunfarid_etcodes_walker_nav_menu();
        }
    } elseif ('sidebar_menu' == $args['theme_location']) {
        $args['walker'] = new etmunfarid_etcodes_sidebar_walker_nav_menu();
    }

    return $args;
}

add_filter('wp_nav_menu_args', 'etmunfarid_etcodes_if_mega_walker_nav_menu', 100);
 
class etmunfarid_etcodes_sidebar_walker_nav_menu extends Walker_Nav_Menu
{
    public function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class='sidebar-submenu'>\n";
    }
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        // li a span

        $indent        = ($depth) ? str_repeat("\t", $depth) : '';
        $li_attributes = '';
        $class_names   = $value   = '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;

        $classes[] = ($item->current || $item->current_item_anchestor) ? 'active' : '';
        $classes[] = 'nav-item';
        $classes[] = 'nav-item-' . $item->ID;

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = ' class="' . esc_attr($class_names) . '"';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';

        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= ($args->walker->has_children) ? ' <i class="fa fa-plus pull-right"></i></a>' : '</a>';
        $item_output .= $args->after;
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);

    }

}

function etmunfarid_etcodes_footer_menu()
{
    wp_nav_menu(array(
        'theme_location' => 'footer',
        'container'      => 'false', /* container class */
        'menu_class' => 'footer_nav list-inline m-0 footer-nav text-md-right',
        'depth'          => '1', /* suppress lower levels for now */
    ));
}
