<?php if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}
/***********************************************************************************************/
/* Template for the Single post */
/***********************************************************************************************/
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php if (has_post_thumbnail() && get_theme_mod('etmunfarid_etcodes_blog_single_post_featured_image', 'true')): ?>
                <div class="entry-media">
                    <?php the_post_thumbnail(get_theme_mod('etmunfarid_etcodes_blog_single_posts_featured_image_size', ''));?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
                <div class="entry-content-wrapper entry-content">
                <?php
                    etmunfarid_etcodes_single_entry_meta_top();

                    if (get_the_title() != ''): ?>
                        <h1 class="entry-title"><a  href="<?php the_permalink();?>"><?php the_title();?></a></h1>
                    <?php else: ?>
                        <h1 class="entry-title"><a  href="<?php the_permalink();?>"><?php esc_html_e('Permalink to the post', 'munfarid');?></a></h1>
                    <?php endif;
                    
                    the_content();
                    etmunfarid_etcodes_single_post_meta_bottom();
                    etmunfarid_etcodes_single_post_author_details();
                    etmunfarid_etcodes_single_post_related_post();
                ?>
                    <div class="blog-post-comments"> 
                        <?php 
                          // If comments are open or we have at least one comment, load up the comment template.
                          if ( comments_open() || get_comments_number() ) :
                            comments_template('', true);
                          endif;
                        ?>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>