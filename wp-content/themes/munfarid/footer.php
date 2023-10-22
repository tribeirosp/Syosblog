  <footer class="web-footer footer">
  <?php
    /**
     * etmunfarid_etcodes_footer_start hook.
     *
     */
    do_action( 'etmunfarid_etcodes_footer_start' );

    // Get footer
    echo do_shortcode(etmunfarid_etcodes_get_footer_content());

    /**
     * etmunfarid_etcodes_footer_ends hook.
     *
    */
    do_action( 'etmunfarid_etcodes_footer_ends' );
  ?>
  </footer>
<?php
  /**
  * etmunfarid_etcodes_before_body_tag_end hook
  *
  */
  do_action('etmunfarid_etcodes_before_body_tag_end'); ?>

<?php wp_footer(); ?>
</body>
</html>