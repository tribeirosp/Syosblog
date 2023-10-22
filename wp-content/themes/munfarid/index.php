<?php get_header();

/**
 * etmunfarid_etcodes_main_title hook.
 *
 */
do_action( 'etmunfarid_etcodes_main_title' );

$page_width  =   get_theme_mod( 'etmunfarid_etcodes_blog_page_width') == true ? 'container-fluid' : 'container';
$page_layout =   get_theme_mod( 'etmunfarid_etcodes_blog_page_layout', 'full_width');
?>

<div id="primary" class="content-area mb-80px">
  <main id="main" class="site-main">
    
  <div class="<?php echo esc_attr($page_width); ?> ">
    <div class="row large-gutters">
      <?php if ($page_layout == 'left_sidebar') { ?>
        <div class="col-lg-4">
          <?php  if ( is_active_sidebar( 'etmunfarid_etcodes_blog_sidebar' ) ) :
            dynamic_sidebar( 'etmunfarid_etcodes_blog_sidebar' ); 
          endif; ?>
        </div>
        <div class="col-lg-8">
      <?php } elseif ($page_layout == 'right_sidebar') {?>
          <div class="col-lg-8">
      <?php } else { ?>
          <div class="col-lg-12">
      <?php } ?>

          <div id="infinite-scroll-entries" class="row blog-post <?php echo esc_attr(get_theme_mod( 'etmunfarid_etcodes_post_style', 'stander-post-style' )); ?>">
            <?php if ( have_posts() ) : 
              while ( have_posts() ) : the_post(); ?>
                <div class="<?php echo esc_attr(get_theme_mod( 'etmunfarid_etcodes_blog_post_layout_col', 'col-lg-12')); ?>">
                  <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
                    <?php get_template_part( 'template-parts/post/content', get_post_format() ); ?>
                  </article>
                </div>
              <?php endwhile;
            // If no content, include the "No posts found" template.
            else :
              get_template_part( 'template-parts/content', 'none' );
            endif; ?>
          </div>
          <?php
            if ( ! class_exists( 'Jetpack' ) || ! Jetpack::is_module_active( 'infinite-scroll' ) ) {
              the_posts_pagination( array(
                'mid_size' => 2,
                'prev_text' => esc_html__( '<', 'munfarid' ),
                'next_text' => esc_html__( '>', 'munfarid' ),
              ) );
            }
          ?>

      <?php if ($page_layout == 'left_sidebar') {?>
        </div>
      <?php } elseif ($page_layout == 'right_sidebar') { ?>
        </div>
          <div class="col-lg-4">
            <?php 
              if ( is_active_sidebar( 'etmunfarid_etcodes_blog_sidebar' ) ) :
                  dynamic_sidebar( 'etmunfarid_etcodes_blog_sidebar' ); 
              endif;  ?>
          </div>
      <?php } else {?>
        </div>
      <?php } ?>

    </div>
  </div>

  </main>
</div>

<?php get_footer(); ?>