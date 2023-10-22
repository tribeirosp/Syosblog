<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Munfarid
 * @since Munfarid 1.0
 */

get_header(); 

/**
 * etmunfarid_etcodes_main_title hook.
 *
 */
do_action( 'etmunfarid_etcodes_main_title' );

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
    <div class="entry-content">
      <?php  if (has_post_thumbnail()) : ?>
        <div class="page-featured-image mb-30px">
          <?php the_post_thumbnail(); ?>
        </div>
        <?php endif;
        the_content();
        wp_link_pages( array(
          'before'      => '<div class="page-links nav-links">' . esc_html__( 'Pages:', 'munfarid' ) . '',
          'after'       => '</div>',
          'link_before' => '<span>',
          'link_after'  => '</span>',
        ) ); ?>
    </div>
  </article>
  
  <?php if ( comments_open() || get_comments_number() ) :  ?>
    <div class="blog-post-comments"> 
      <?php comments_template('', true);  ?>
    </div>
  <?php endif; ?>
  
<?php endwhile; else: ?>
<p><?php esc_html__( 'Sorry, no posts matched your criteria.', 'munfarid' ); ?></p><?php endif;  

get_footer(); ?>