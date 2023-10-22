(function($) { 
"use strict";

wp.customize.bind("ready", function() {
  /**
   * Function to hide/show Customizer options, based on a checkbox value.
   *
   * Parent option, Affected Control, Value which affects the control.
   */
  function customizer_checkbox_option_display(
    parent_setting,
    affected_control,
    value
  ) {
    wp.customize(parent_setting, function(setting) {
      wp.customize.control(affected_control, function(control) {
        var visibility = function() {
          if (value === setting.get()) {
            control.container.slideDown(100);
          } else {
            control.container.slideUp(100);
          }
        };

        visibility();
        setting.bind(visibility);
      });
    });
  }

  customizer_checkbox_option_display(
    "etsada_etcodes_header_width",
    "etsada_etcodes_fluid_header_x_padding",
    true
  );
  customizer_checkbox_option_display(
    "etsada_etcodes_absolute_header",
    "etsada_etcodes_absolute_header_bg_opacity",
    true
  );
  //top bar
  customizer_checkbox_option_display(
    "etsada_etcodes_header_top_bar_enable",
    "etsada_etcodes_header_top_bar_text",
    true
  );
  customizer_checkbox_option_display(
    "etsada_etcodes_header_top_bar_enable",
    "etsada_etcodes_header_top_bar_header_social_icons",
    true
  );
  customizer_checkbox_option_display(
    "etsada_etcodes_header_top_bar_enable",
    "etsada_etcodes_header_top_bar_search",
    true
  );
  customizer_checkbox_option_display(
    "etsada_etcodes_header_top_bar_enable",
    "etsada_etcodes_header_top_bar_shopping_cart",
    true
  );
  customizer_checkbox_option_display(
    "etsada_etcodes_header_top_bar_enable",
    "etsada_etcodes_topbar_bg_color",
    true
  );
  customizer_checkbox_option_display(
    "etsada_etcodes_header_top_bar_enable",
    "etsada_etcodes_topbar_text_color",
    true
  );
  //header six
  customizer_checkbox_option_display(
    "etsada_etcodes_header_style",
    "etsada_etcodes_header_six_text",
    "header-six"
  );
  // Blog
  customizer_checkbox_option_display(
    "etsada_etcodes_blog_page_width",
    "etsada_etcodes_blog_page_width_vw",
    true
  );
  customizer_checkbox_option_display(
    "etsada_etcodes_blog_post_excerpt",
    "etsada_etcodes_blog_post_excerpt_length",
    true
  );
  customizer_checkbox_option_display(
    "etsada_etcodes_blog_post_read_more_btn",
    "etsada_etcodes_blog_post_read_more_btn_lable",
    true
  );
  // Page title
  customizer_checkbox_option_display(
    "etsada_etcodes_page_title_container_width",
    "etsada_etcodes_page_title_fluid_container_x_padding",
    true
  );
  customizer_checkbox_option_display(
    "etsada_etcodes_page_title_container_overlay",
    "etsada_etcodes_page_title_container_overlay_color",
    true
  );
  customizer_checkbox_option_display(
    "etsada_etcodes_page_title_container_overlay",
    "etsada_etcodes_page_title_container_overlay_opacity",
    true
  );

  // Scroll to Top Button
  customizer_checkbox_option_display(
    "etsada_etcodes_is_scroll_to_top_btn",
    "etsada_etcodes_scroll_to_top_btn_icon_color",
    true
  );
  customizer_checkbox_option_display(
    "etsada_etcodes_is_scroll_to_top_btn",
    "etsada_etcodes_scroll_to_top_btn_bg_color",
    true
  );
});

})(jQuery);