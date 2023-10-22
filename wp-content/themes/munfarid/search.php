<?php get_header();?>
<div class="page-main-title mb-60px">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 text-center text-lg-left">
            <h4><?php esc_html_e('Search Results for: ', 'munfarid'); echo esc_attr(get_search_query());?></h4>
            </div>
        </div>
    </div>
</div>
<div class="entry-content container">

<div id="primary" class="content-area mw-100">
  <main id="main" class="site-main">
    
    <form action="<?php echo esc_url(home_url('/')); ?>" class="etcodes-search-page-form mb-50px" method="get">
      <div class="input-group">
        <input type="text" name="s" class="etcodes-search-field form-control" autocomplete="off" value="<?php echo esc_attr(get_search_query());?>" placeholder="<?php esc_attr__('Search here', 'munfarid'); ?>"/>
        <span class="input-group-append">
          <button type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
        </span>
      </div>
    </form>
    
    <?php if (have_posts()):
      while (have_posts()): the_post(); ?>
        <div class="row etcodes-search-item mb-15px align-items-center">
          
          <?php if (has_post_thumbnail()): ?>
            <div class="col-2 mb-15px">
              <?php the_post_thumbnail( array(200, 200) ); ?>
            </div>
            <div class="col-10 etcodes-search-item-text mb-15px">
              <?php if (get_the_title() != '') : ?>
                <h4 class="card-title"><a  href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
              <?php else : ?>
                <h4 class="card-title"><a  href="<?php the_permalink(); ?>"><?php esc_html_e('Permalink to the post', 'munfarid'); ?></a></h4>
              <?php endif; ?>
              <?php
                $etmunfarid_etcodes_excerpt = get_the_excerpt();
                if ($etmunfarid_etcodes_excerpt != '') { ?>
                  <p itemprop="description" class="etcodes-post-excerpt"><?php echo esc_html($etmunfarid_etcodes_excerpt); ?></p>
              <?php } ?>
            </div>
                    
          <?php else: ?>

            <div class="col-md-12 etcodes-search-item-text">
              <?php if (get_the_title() != '') : ?>
                <h4 class="card-title"><a  href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
              <?php else : ?>
                <h4 class="card-title"><a  href="<?php the_permalink(); ?>"><?php esc_html_e('Permalink to the post', 'munfarid'); ?></a></h4>
              <?php endif; ?>
              <?php
                $etmunfarid_etcodes_excerpt = get_the_excerpt();
                if ($etmunfarid_etcodes_excerpt != '') { ?>
                  <p itemprop="description" class="etcodes-post-excerpt"><?php echo esc_html($etmunfarid_etcodes_excerpt); ?></p>
              <?php } ?>
            </div>

          <?php endif; ?>
        </div>

        <?php endwhile;
        else: ?>
          <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'munfarid');?></p>
        <?php endif; ?>

        <div class="mt-5 mb-80px">
          <?php the_posts_pagination(array(
            'mid_size'  => 2,
            'prev_text' => esc_html__( '<', 'munfarid' ),
            'next_text' => esc_html__( '>', 'munfarid' ),
            ));
            ?>
        </div>

  </main>
</div>

</div>
<?php get_footer();?>