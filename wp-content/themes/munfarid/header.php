<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?> 
  </head>
  <body <?php body_class(); ?>>

    <?php
    
    /**
     * etmunfarid_etcodes_after_body_tag_start hook
     *
     */
    do_action('etmunfarid_etcodes_after_body_tag_start'); ?>

      <!--  Header -->
      <?php
       /**
         * etmunfarid_etcodes_header_area hook.
         *
         */
        do_action( 'etmunfarid_etcodes_header_area' );
      ?>
      <!-- End Header -->
      