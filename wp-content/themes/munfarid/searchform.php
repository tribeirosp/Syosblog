<form role="search" class="search-form dark-outline-form" action="<?php echo esc_url( home_url('/') ); ?>">
	<div class="input-group">
	  <input type="search" class="form-control" placeholder="<?php echo esc_attr__( 'Search...','munfarid' ); ?>" value="<?php echo get_search_query(); ?>" name="s">
      <span class="input-group-btn">
        <button class="btn" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
      </span>
	</div>
</form>