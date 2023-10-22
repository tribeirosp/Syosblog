<?php if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}

// blog post - Image
if (!function_exists('etmunfarid_etcodes_single_post_image')) {
    function etmunfarid_etcodes_single_post_image()
    {
        if (has_post_thumbnail() && get_theme_mod('etmunfarid_etcodes_blog_post_featured_image', 'true')): ?>
      <div class="entry-media">
        <a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>">
          <?php the_post_thumbnail(get_theme_mod('etmunfarid_etcodes_blog_posts_featured_image_size', ''));?>
        </a>
      </div>
    <?php endif;
    }
}

// blog post - title
if (!function_exists('etmunfarid_etcodes_single_entry_title')) {
    function etmunfarid_etcodes_single_entry_title()
    {
        if (get_the_title() != ''): ?>
            <h3 class="entry-title"><a  href="<?php the_permalink();?>"><?php the_title();?></a></h3>
        <?php else: ?>
            <h3 class="entry-title"><a  href="<?php the_permalink();?>"><?php esc_html_e('Permalink to the post', 'munfarid');?></a></h3>
        <?php endif;
    }
}

// blog post - meta top
if (!function_exists('etmunfarid_etcodes_single_entry_meta_top')) {
    function etmunfarid_etcodes_single_entry_meta_top()
    {

        ?>
        <div class="entry-meta-top">
            <?php if (get_theme_mod('etmunfarid_etcodes_blog_post_author', 'false')) {?>
                <span class="entry-author"><?php esc_html_e('By ', 'munfarid');?><?php the_author_posts_link();?></span>
            <?php }?>
            <?php if (get_theme_mod('etmunfarid_etcodes_blog_post_date', 'false')) {?>
              <span class="entry-meta-data"><?php echo get_the_date(); ?></span>
            <?php }?>
            <?php if (get_theme_mod('etmunfarid_etcodes_blog_post_categories', 'false')) {?>
                <span class="entry-meta-category"><?php the_category('&nbsp;');?> </span>
            <?php }?>
            <?php if (get_theme_mod('etmunfarid_etcodes_blog_post_comments_counter', 'false')) {?>
                <span class="post_meta_comments"><?php comments_number('0 Comments', '1 Comment', '% Comments');?></span>
            <?php }?>
        </div>
        <?php
}
}

// blog post - content
if (!function_exists('etmunfarid_etcodes_single_post_content')) {
    function etmunfarid_etcodes_single_post_content()
    {?>
    <div class="post_content clearfix">
      <?php the_content();?>
    </div>
  <?php }
}

/********** etmunfarid_etcodes_excerpt  **********/

function etmunfarid_etcodes_excerpt($limit)
{
    if (get_theme_mod('etmunfarid_etcodes_blog_post_excerpt', true)) {
        $limit = get_theme_mod('etmunfarid_etcodes_blog_post_excerpt_length', 25);
        $etmunfarid_etcodes_excerpt = explode(' ', get_the_excerpt(), $limit);
        if (count($etmunfarid_etcodes_excerpt) >= $limit) {
            array_pop($etmunfarid_etcodes_excerpt);
            $etmunfarid_etcodes_excerpt = implode(" ", $etmunfarid_etcodes_excerpt) . '...';
        } else {
            $etmunfarid_etcodes_excerpt = implode(" ", $etmunfarid_etcodes_excerpt);
        }

        $etmunfarid_etcodes_excerpt = preg_replace('`\[[^\]]*\]`', '', $etmunfarid_etcodes_excerpt);

        return '<div class="entry-excerpt"><p>' . $etmunfarid_etcodes_excerpt . '</p></div>';
    }

}

function etmunfarid_etcodes_content($limit)
{
    $etmunfarid_etcodes_content = explode(' ', get_the_content(), $limit);
    if (count($etmunfarid_etcodes_content) >= $limit) {
        array_pop($etmunfarid_etcodes_content);
        $etmunfarid_etcodes_content = implode(" ", $etmunfarid_etcodes_content) . '...';
    } else {
        $etmunfarid_etcodes_content = implode(" ", $etmunfarid_etcodes_content);
    }

    $etmunfarid_etcodes_content = preg_replace('/\[.+\]/', '', $etmunfarid_etcodes_content);
    $etmunfarid_etcodes_content = apply_filters('the_content', $etmunfarid_etcodes_content);
    $etmunfarid_etcodes_content = str_replace(']]>', ']]&gt;', $etmunfarid_etcodes_content);
    return $etmunfarid_etcodes_content;
}

// blog post - meta bottom
if (!function_exists('etmunfarid_etcodes_single_post_meta_bottom')) {
    function etmunfarid_etcodes_single_post_meta_bottom()
    {

        wp_link_pages(array(
            'before' => '<div class="single-post-paginated nav-links">' . esc_html__('Pages:', 'munfarid'),
            'after' => '</div>',
            'link_before' => '<span class="page-numbers">',
            'link_after' => '</span>',
        ));?>
      <div class="post_meta_bottom mt-40px mb-30px">
          <div class="text-lg-left">
              <?php if (get_theme_mod('etmunfarid_etcodes_blog_post_tags', true)) {
            the_tags('<ul class="entry-tags mb-25px"><li>', '</li><li>', '</li></ul>');
        }?>
          </div>
          <div class="clearfix pb-10px">
            <?php if (get_theme_mod('etmunfarid_etcodes_single_post_navigation', true)) {
            the_post_navigation(
                array(
                    'prev_text' => '<div class="nav-subtitle">' . esc_html__('Previous Post', 'munfarid') . '</div> <span class="nav-title"><i class="fas fa-long-arrow-alt-left fa-lg mr-1" aria-hidden="true"></i> %title </span>',
                    'next_text' => '<div class="nav-subtitle">' . esc_html__('Next Post', 'munfarid') . '</div> <span class="nav-title">%title <i class="fas fa-long-arrow-alt-right fa-lg ml-1" aria-hidden="true"></i></span>',
                )
            );
        }?>
          </div>
      </div>
    <?php }
}

// blog post - Author Details
if (!function_exists('etmunfarid_etcodes_single_post_author_details')) {

    function etmunfarid_etcodes_single_post_author_details()
    {


        if (get_theme_mod('etmunfarid_etcodes_single_post_author_box', false) && get_the_author_meta("description") !== ''): ?>
        <div class="post-author">
          <div class="row">
            <div class="col-md-2">
              <?php echo get_avatar(get_the_author_meta('email'), '200'); ?>
            </div>
            <div class="col-md-10">
              <h5><?php the_author_posts_link();?></h5>
              <p><?php the_author_meta("description");?> </p>
              <ul class="list-inline list-circle">
                <?php
                $url = get_the_author_meta("url");
                $facebook = get_the_author_meta("facebook");
                $twitter = get_the_author_meta("twitter");
                $linkedin = get_the_author_meta("linkedin");
                $instagram = get_the_author_meta("instagram");
                $pinterest = get_the_author_meta("pinterest");
                $tumblr = get_the_author_meta("tumblr");
                $googleplus = get_the_author_meta("googleplus");
                ?>
                <?php if (!empty($url)) {?>
                  <li>
                    <a href="<?php echo esc_url($url); ?>"><i class="fa fa-link" aria-hidden="true"></i></a>
                  </li>
                <?php }?>
                <?php if (!empty($facebook)) {?>
                  <li>
                    <a href="<?php echo esc_url($facebook); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                  </li>
                <?php }?>
                <?php if (!empty($twitter)) {?>
                  <li>
                    <a href="<?php echo esc_url($twitter); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                  </li>
                <?php }?>
                <?php if (!empty($linkedin)) {?>
                  <li>
                    <a href="<?php echo esc_url($linkedin); ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                  </li>
                <?php }?>
                <?php if (!empty($instagram)) {?>
                  <li>
                    <a href="<?php echo esc_url($instagram); ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                  </li>
                <?php }?>
                <?php if (!empty($pinterest)) {?>
                  <li>
                    <a href="<?php echo esc_url($pinterest); ?>"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                  </li>
                <?php }?>
                <?php if (!empty($tumblr)) {?>
                  <li>
                    <a href="<?php echo esc_url($tumblr); ?>"><i class="fa fa-tumblr" aria-hidden="true"></i></a>
                  </li>
                <?php }?>
                <?php if (!empty($googleplus)) {?>
                  <li>
                    <a href="<?php echo esc_url($googleplus); ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                  </li>
                <?php }?>
              </ul>
            </div>
          </div>
        </div>
        <div class="separator-line mt-0 mb-30px"></div>
      <?php endif;
    }
}

// blog post - related Posts From Current Category
if (!function_exists('etmunfarid_etcodes_single_post_related_post')) {
    function etmunfarid_etcodes_single_post_related_post()
    {

        if (get_theme_mod('etmunfarid_etcodes_single_post_related_articles', false) && is_single()):

            // Default arguments
            $args = array(
                'posts_per_page' => 2, // How many items to display
                'post__not_in' => array(get_the_ID()), // Exclude current post
                'no_found_rows' => true, // We don't ned pagination so this speeds up the query
            );

            // Check for current post category and add tax_query to the query arguments
            $cats = wp_get_post_terms(get_the_ID(), 'category');
            $cats_ids = array();
            foreach ($cats as $wpex_related_cat) {
                $cats_ids[] = $wpex_related_cat->term_id;
            }
            if (!empty($cats_ids)) {
                $args['category__in'] = $cats_ids;
            }
            // Query posts
            $wpex_query = new wp_query($args);
            ?>
					  <div class="related_posts px-0 mt-40px mb-60px">
              <h4 class="mb-20px"><?php esc_html_e('Related Articles', 'munfarid');?></h4>
              <div class="row blog-post stander-post-style">
					      <?php foreach ($wpex_query->posts as $post): setup_postdata($post);?>
                  <div class="col-md-6">
                    <article id="post-<?php the_ID();?>" <?php post_class('clearfix');?>>
                      <?php etmunfarid_etcodes_single_post_image(); ?>
                      <div class="entry-content-wrapper">
                        <?php
                        etmunfarid_etcodes_single_entry_meta_top();
                        etmunfarid_etcodes_single_entry_title();
                        ?>
                      </div>
						        </article>
						      </div>
                <?php endforeach;?>
			        </div>
            </div>
			      <div class="separator-line"></div>

			    <?php
          // Reset post data
          wp_reset_postdata();
          endif;
    }
}

// blog post - read more button
if (!function_exists('etmunfarid_etcodes_single_post_readmore_btn')) {
    function etmunfarid_etcodes_single_post_readmore_btn()
    {
        if (get_theme_mod('etmunfarid_etcodes_blog_post_read_more_btn', false)) {?>
      <div class="post_meta_bottom">
          <div class="row">
              <div class="col-md-6">
                  <a class="post_read_more d-block mt-15px" href="<?php the_permalink();?>"><?php echo esc_html__('Read More', 'munfarid'); ?> <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
              </div>
          </div>
      </div>
      <?php }
    }
}

// blog card item
if (!function_exists('etmunfarid_etcodes_query_blog_card')) {
    function etmunfarid_etcodes_query_blog_card()
    {
        ?>
        <article>
            <?php if (has_post_thumbnail()): ?>
              <div class="entry-media">
                <a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>">
                  <?php the_post_thumbnail(get_theme_mod('etmunfarid_etcodes_blog_posts_featured_image_size', ''));?>
                </a>
              </div>
            <?php endif;?>
            <div class="card-blog-content">
                <h5 class="entry-title">
                  <a href="<?php the_permalink();?>"><?php the_title();?></a>
                </h5>
                <div class="entry-meta-top">
                    <span class="entry-meta-data"><?php echo get_the_date(); ?></span>
                </div>
                <div class="post_content">
                  <p><?php echo esc_html(etmunfarid_etcodes_excerpt(75)); ?></p>
                </div>
            </div>
        </article>
    <?php

    }
}
