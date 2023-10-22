<?php if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}
if (!function_exists('etmunfarid_etcodes_get_header')) {
    function etmunfarid_etcodes_get_header()
    {   
        $page_id = get_the_ID();
        
        $etmunfarid_etcodes_header_style =  get_post_meta($page_id, 'etmunfarid_etcodes_header_style', true) ? get_post_meta($page_id, 'etmunfarid_etcodes_header_style', true) : get_theme_mod( 'etmunfarid_etcodes_header_style', 'header-one' );
        $etmunfarid_etcodes_logo_align = get_theme_mod( 'etmunfarid_etcodes_logo_align', 'logo-align-left' );
        $etmunfarid_etcodes_nav_align = get_post_meta($page_id, 'etmunfarid_etcodes_page_nav_align', true) ? get_post_meta($page_id, 'etmunfarid_etcodes_page_nav_align', true) : get_theme_mod( 'etmunfarid_etcodes_nav_align', 'nav-align-right' );
        $etmunfarid_etcodes_header_width = get_post_meta($page_id, 'etmunfarid_etcodes_header_full_width', true) == 'on' ? get_post_meta($page_id, 'etmunfarid_etcodes_header_full_width', true) : get_theme_mod( 'etmunfarid_etcodes_header_width', false );
        $etmunfarid_etcodes_absolute_header = get_post_meta($page_id, 'etmunfarid_etcodes_absolute_header', true) == 'on' ? get_post_meta($page_id, 'etmunfarid_etcodes_absolute_header', true) : get_theme_mod( 'etmunfarid_etcodes_absolute_header', false );
        $etmunfarid_etcodes_sticky_header = get_post_meta($page_id, 'etmunfarid_etcodes_sticky_header', true) == 'on' ? get_post_meta($page_id, 'etmunfarid_etcodes_sticky_header', true) : get_theme_mod( 'etmunfarid_etcodes_sticky_header', false );
        $etmunfarid_etcodes_header_header_Social_icons = get_post_meta($page_id, 'etmunfarid_etcodes_is_header_social_icons', true) == 'on' ? get_post_meta($page_id, 'etmunfarid_etcodes_is_header_social_icons', true) : get_theme_mod( 'etmunfarid_etcodes_header_header_Social_icons', false );
        $etmunfarid_etcodes_header_six_text = get_theme_mod( 'etmunfarid_etcodes_header_six_text', '');

        $etmunfarid_etcodes_header_top_bar_enable = get_post_meta($page_id, 'etmunfarid_etcodes_is_top_header_bar', true) == 'on' ? get_post_meta($page_id, 'etmunfarid_etcodes_is_top_header_bar', true) : get_theme_mod( 'etmunfarid_etcodes_header_top_bar_enable', false );
        $etmunfarid_etcodes_header_top_bar_text = get_theme_mod( 'etmunfarid_etcodes_header_top_bar_text');
        $etmunfarid_etcodes_header_top_bar_header_social_icons = get_theme_mod( 'etmunfarid_etcodes_header_top_bar_header_social_icons', false );
        $etmunfarid_etcodes_header_top_bar_search = get_theme_mod( 'etmunfarid_etcodes_header_top_bar_search', false );
        $etmunfarid_etcodes_header_top_bar_shopping_cart = get_theme_mod( 'etmunfarid_etcodes_header_top_bar_shopping_cart', false );
        // Output Value assign
        $etmunfarid_etcodes_header_width = $etmunfarid_etcodes_header_width == true ? 'container-fluid' : 'container';
        $etmunfarid_etcodes_absolute_header = $etmunfarid_etcodes_absolute_header == true ? 'absolute_header' : '';
        $etmunfarid_etcodes_sticky_header = $etmunfarid_etcodes_sticky_header == true ? 'fixed-top' : '';

        // Header classes
        $etmunfarid_etcodes_output_settings_classes = $etmunfarid_etcodes_logo_align . ' '. $etmunfarid_etcodes_header_style .' ' . $etmunfarid_etcodes_nav_align . ' ' . $etmunfarid_etcodes_absolute_header . ' ' . $etmunfarid_etcodes_sticky_header;

        //top bar
        if ($etmunfarid_etcodes_header_top_bar_enable == true) { ?>
            <div class="top_header">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-sm-6 text-center text-md-left">
                            <div class="py-15px">
                                <?php echo do_shortcode($etmunfarid_etcodes_header_top_bar_text); ?>
                            </div>
                        </div>
                        <div class="col-sm-6 text-center text-md-right">
                            <div class="d-flex justify-content-center justify-content-md-end">
                                <div class="navbar-modules d-none d-lg-flex align-items-center">
                                    <?php if (get_theme_mod( 'etmunfarid_etcodes_header_top_bar_search', false )) { ?>
                                        <div class="navbar-module">
                                            <?php etmunfarid_etcodes_get_header_search();?>
                                         </div>
                                    <?php  } ?>
                                    <?php if (get_theme_mod( 'etmunfarid_etcodes_header_top_bar_header_social_icons', false )) { ?>
                                        <div class="navbar-module">
                                             <?php echo etmunfarid_etcodes_get_social_menu(); ?>
                                        </div>
                                    <?php  } ?>
                                    <?php if (get_theme_mod( 'etmunfarid_etcodes_header_top_bar_shopping_cart', false ) && function_exists( 'etmunfarid_etcodes_header_cart' )) { ?>
                                        <div class="navbar-module cart-navbar-module">
                                            <?php echo etmunfarid_etcodes_header_cart() ?>
                                        </div>
                                    <?php  } ?> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
        }

        if ($etmunfarid_etcodes_header_style == 'header-one'){
        //Header One
        ?>
        <nav class="navbar navbar-expand-lg <?php echo esc_attr($etmunfarid_etcodes_output_settings_classes); ?>">
            <div class="<?php echo esc_attr($etmunfarid_etcodes_header_width); ?>">
                <button class="navbar-toggler navbar-toggler-right hamburger-menu-btn ml-auto" type="button" data-toggle="collapse" data-target="#etcodesnavbarDropdown" aria-controls="etcodesnavbarDropdown" aria-expanded="false" aria-label="Toggle navigation"><span><?php esc_html_e('menu', 'munfarid');?></span></button>
                <?php if ($etmunfarid_etcodes_nav_align == 'logo-top-right') {
                    if (has_nav_menu('primary')) {
                        etmunfarid_etcodes_theme_primary_menu('collapse navbar-collapse');
                    }
                        etmunfarid_etcodes_logo();
                    } else {
                        etmunfarid_etcodes_logo();
                    if (has_nav_menu('primary')) {
                        etmunfarid_etcodes_theme_primary_menu('collapse navbar-collapse');
                    }
                    
                }
                // get navbar modules 
                etmunfarid_etcodes_navbar_modules();
                ?>
            </div>
        </nav>

        <?php } else if ($etmunfarid_etcodes_header_style == 'header-two') {
        //Header Two
        ?>
        <nav class="navbar navbar-expand-lg <?php echo esc_attr($etmunfarid_etcodes_output_settings_classes); ?>">
            <div class="<?php echo esc_attr($etmunfarid_etcodes_header_width); ?>">
                <?php etmunfarid_etcodes_logo(); ?>
                <button class="navbar-toggler navbar-toggler-right hamburger-menu-btn ml-auto" type="button" data-toggle="collapse" data-target="#etcodesnavbarDropdown" aria-controls="etcodesnavbarDropdown" aria-expanded="false" aria-label="Toggle navigation"><span><?php esc_html_e('menu', 'munfarid');?></span></button>
                <div class="col-md-5">
                    <?php  if (has_nav_menu('primary')) {
                        etmunfarid_etcodes_theme_primary_menu('collapse navbar-collapse');
                    } ?>
                </div>
                <div class="d-none d-lg-flex col-md-2">
                    <?php etmunfarid_etcodes_logo(); ?>
                </div>
                <div class="col-md-5 navbar-modules d-none d-lg-flex justify-content-end">
                    <?php etmunfarid_etcodes_navbar_modules(); ?>
                </div>
            </div>
        </nav>

        <?php } else if ($etmunfarid_etcodes_header_style == 'header-three') {
        //Header three
        ?>
        <nav class="navbar navbar-expand-lg <?php echo esc_attr($etmunfarid_etcodes_output_settings_classes); ?>">
            <div class="<?php echo esc_attr($etmunfarid_etcodes_header_width); ?>">
                <?php etmunfarid_etcodes_logo(); ?>
                <button class="navbar-toggler navbar-toggler-right hamburger-menu-btn ml-auto" type="button" data-toggle="collapse" data-target="#etcodesnavbarDropdown" aria-controls="etcodesnavbarDropdown" aria-expanded="false" aria-label="Toggle navigation"><span><?php esc_html_e('menu', 'munfarid');?></span></button>
                <?php  if (has_nav_menu('primary')) {
                    etmunfarid_etcodes_theme_primary_menu('collapse navbar-collapse');
                } ?>
            </div>
        </nav>

        <?php } else if ($etmunfarid_etcodes_header_style == 'header-four') {
        //Header four
        ?> 
        <nav class="navbar navbar-expand-lg <?php echo esc_attr($etmunfarid_etcodes_output_settings_classes); ?>">
            <div class="<?php echo esc_attr($etmunfarid_etcodes_header_width); ?> align-items-center pt-25px pb-10px">
                <div class="row">
                    <button class="navbar-toggler navbar-toggler-right hamburger-menu-btn ml-auto" type="button" data-toggle="collapse" data-target="#etcodesnavbarDropdown" aria-controls="etcodesnavbarDropdown" aria-expanded="false" aria-label="Toggle navigation"><span><?php esc_html_e('menu', 'munfarid');?></span></button>
                    <div class="col-md-8">
                        <?php etmunfarid_etcodes_logo(); ?>
                        <?php  if (has_nav_menu('primary')) {
                            etmunfarid_etcodes_theme_primary_menu('collapse navbar-collapse');
                        } ?>
                    </div> 
                    <div class="col-md-4 text-center text-lg-right">
                        <?php etmunfarid_etcodes_navbar_modules('navbar-modules d-none d-lg-flex justify-content-end'); ?>
                    </div>
                </div>    
            </div>
        </nav>
        <?php } else if ($etmunfarid_etcodes_header_style == 'header-five') {
        //Header five
        ?>
        <nav class="navbar <?php echo esc_attr($etmunfarid_etcodes_output_settings_classes); ?>">
                <div class="<?php echo esc_attr($etmunfarid_etcodes_header_width); ?>">
                    <?php if ($etmunfarid_etcodes_nav_align == 'logo-top-right') { ?>
                        <button class="navbar-toggler hamburger-menu-btn for-fullscreen" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span><?php esc_html_e('menu', 'munfarid');?></span>
                        </button>

                        <?php etmunfarid_etcodes_logo();  ?>
                        <?php  if (has_nav_menu('primary')) {
                            etmunfarid_etcodes_theme_primary_menu('fullscreen-menu-holder');
                        } 
                    } else { etmunfarid_etcodes_logo(); ?>
                        <button class="navbar-toggler hamburger-menu-btn hamburger-btn-right for-fullscreen" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span><?php esc_html_e('menu', 'munfarid');?></span>
                        </button>
                        <?php  if (has_nav_menu('primary')) {
                            etmunfarid_etcodes_theme_primary_menu('fullscreen-menu-holder');
                        } 
                    } ?>

                </div>
            </nav>
        <?php } else if ($etmunfarid_etcodes_header_style == 'header-six') {
        //Header six
        ?>
        <nav class="navbar navbar-expand-lg navbar-light sidebar-nav align-items-start bg-color-gray py-40px py-md-80 px-40px px-md-35 <?php echo esc_attr($etcodes_header_six_menu_align); ?>">
            <div class="container-fluid">
                <?php etmunfarid_etcodes_logo(); ?>
                <button class="navbar-toggler navbar-toggler-right hamburger-menu-btn ml-auto" type="button" data-toggle="collapse" data-target="#etcodesnavbarDropdown" aria-controls="etcodesnavbarDropdown" aria-expanded="false" aria-label="Toggle navigation"><span><?php esc_html_e('menu', 'munfarid');?></span></button> 
                <?php  if (has_nav_menu('primary')) {
                        etmunfarid_etcodes_theme_primary_menu('collapse navbar-collapse');
                } ?>
                <div class="bar-module">
                    <div class="mb-15px">
                        <?php echo do_shortcode($etmunfarid_etcodes_header_six_text); ?>
                    </div>
                    <?php 
                        if ($etmunfarid_etcodes_header_header_Social_icons == 'yes') {
                            echo etmunfarid_etcodes_get_social_menu();
                        }
                    ?>
                </div>
            </div>
        </nav>
        <?php } else if ($etmunfarid_etcodes_header_style == 'header-seven') {
        //Header seven
        ?>
        <nav class="navbar header-middle-logo <?php echo esc_attr($etmunfarid_etcodes_output_settings_classes); ?>">

            <div class="<?php echo esc_attr($etmunfarid_etcodes_header_width); ?>">
                <div class="row align-items-center no-gutters">
                    <div class="col-md-5">

                        <?php if($etmunfarid_etcodes_nav_align  == 'nav-align-left') { ?>
                            <button class="navbar-toggler hamburger-menu-btn for-fullscreen" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                    <span><?php esc_html_e('menu', 'munfarid');?></span>
                            </button>
                            <?php  if (has_nav_menu('primary')) {
                                etmunfarid_etcodes_theme_primary_menu('fullscreen-menu-holder');
                            } 
                        } else {
                            etmunfarid_etcodes_navbar_modules('navbar-modules d-flex justify-content-center justify-content-md-start mt-15px mt-md-0'); 
                        } 
                        ?>

                    </div>

                    <div class="col-8 col-md-2">
                        <?php etmunfarid_etcodes_logo(); ?>
                    </div>

                    <div class="col-4 col-md-5">

                        <?php if($etmunfarid_etcodes_nav_align  == 'nav-align-right') { ?>
                            <button class="navbar-toggler hamburger-menu-btn for-fullscreen ml-auto" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                    <span><?php esc_html_e('menu', 'munfarid');?></span>
                            </button>
                            <?php  if (has_nav_menu('primary')) {
                                etmunfarid_etcodes_theme_primary_menu('fullscreen-menu-holder');
                            } 
                        } else { 
                            etmunfarid_etcodes_navbar_modules('navbar-modules d-flex justify-content-center justify-content-md-end mt-15px mt-md-0');  
                        }
                        ?>

                    </div>

                </div>

            </div>
        </nav>
        <?php } 
    
    }

}