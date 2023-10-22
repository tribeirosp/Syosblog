<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Munfarid
 * @since Munfarid 1.0
 */
get_header(); ?>
<div class="container">
    <div class="row align-items-center pt-60px pb-80px">
        <div class="col-lg-6 offset-lg-3 text-center">
            <h1 class="fs-150px text-color-blackflame mb-20px"><?php esc_html_e( '404', 'munfarid' ); ?></h1>
            <h1 class="mb-20px"><?php esc_html_e( 'Something Went Wrong!', 'munfarid' ); ?></h1>
            <p class="mb-40px"><?php esc_html_e( 'We can\'t seem to find the page you\'re looking for. Go back to Homepage or contact to our Help Center.', 'munfarid' ); ?></p>
            <form role="search" class="search-form mb-40px" action="<?php echo esc_url( home_url('/') ); ?>">
            	<div class="input-group">
            	  <input type="search" class="form-control" placeholder="<?php echo esc_attr__( 'Search...', 'munfarid' ); ?>" value="<?php echo get_search_query(); ?>" name="s">
                  <span class="input-group-btn">
                    <button class="btn" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                  </span>
            	</div>
            </form>            
            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-outline-dark rounded-0"><?php esc_html_e( '&lt; Back to Home', 'munfarid' ); ?></a>
        </div>
    </div>
</div>
<?php get_footer(); ?>