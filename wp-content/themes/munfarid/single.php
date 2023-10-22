<?php get_header();

/**
 * etmunfarid_etcodes_main_title hook.
 *
 */
do_action( 'etmunfarid_etcodes_main_title' );

$page_layout =   get_theme_mod( 'etmunfarid_etcodes_single_post_page_layout', 'full_width');
$arg = array( 
  'post_style' => get_theme_mod( 'etmunfarid_etcodes_post_style', 'stander-post-style' ),
  'image_size' => '',
  'excerpt_limit' => 75,
);
?>
<div class="container">
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
  
          <?php while ( have_posts() ) : the_post(); ?>
            <div class="blog-post stander-post-style single-stander-post-style">
                <?php get_template_part( 'template-parts/post/content', 'single' ); ?>
            </div>
          <?php endwhile; ?>

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

<?php get_footer(); ?>