(function($) {
  "use strict";

  /* --------------------------------------------
     Nav Menu
     --------------------------------------------- */
  function et_nav_menu() {
    // Make multi level bootstrap menu

    $(".dropdown-menu a.dropdown-toggle").on("click", function(e) {
      var $el = $(this);
      var $parent = $(this).offsetParent(".dropdown-menu");
      if (
        !$(this)
          .next()
          .hasClass("show")
      ) {
        $(this)
          .parents(".dropdown-menu")
          .first()
          .find(".show")
          .removeClass("show");
      }
      if (!$el.offsetParent(".dropdown-menu").hasClass("mega_menu")) {
        var $subMenu = $(this).next(".dropdown-menu");
        $subMenu.toggleClass("show");
        $(this)
          .parent("li")
          .toggleClass("show");
        $(this)
          .parents("li.nav-item.dropdown.show")
          .on("hidden.bs.dropdown", function(e) {
            $(".dropdown-menu .show").removeClass("show");
          });
        if (!$parent.parent().hasClass("navbar-nav")) {
          if (
            !$el.parent().hasClass("mega_menu_holder") &&
            !$("nav").hasClass("sidebar-nav")
          ) {
            var dropdownList = $(".dropdown-menu"),
              dropdownOffset = $(this).offset(),
              offsetLeft = dropdownOffset.left,
              dropdownWidth = dropdownList.width(),
              docWidth = $(window).width(),
              subDropdown = dropdownList.eq(1),
              subDropdownWidth = subDropdown.width(),
              isDropdownVisible = offsetLeft + dropdownWidth <= docWidth,
              isSubDropdownVisible =
                offsetLeft + dropdownWidth + subDropdownWidth <= docWidth;

            if (!isDropdownVisible || !isSubDropdownVisible) {
              $el.next().css({
                top: $el[0].offsetTop,
                left: -$parent.outerWidth() - 4
              });
            } else {
              $el.next().css({
                top: $el[0].offsetTop,
                left: $parent.outerWidth() - 4
              });
            }
          }
        }
      }
      return false;
    });

    // Add current class to active menu's item
    var links = $(".navbar a");
    $.each(links, function(key, va) {
      if (va.href === document.URL) {
        $(this)
          .parents("li")
          .addClass("current");
      }
    });

    // toggle classes on click menu btn
    jQuery(".hamburger-menu-btn").on("click", function(e) {
      //For hamburger-menu-btn
      jQuery(this).toggleClass("is-active");
      //For fullscreen-menu-holder
      var elm_fullscreen_menu_holder = $(".fullscreen-menu-holder");
      jQuery(elm_fullscreen_menu_holder).toggleClass("is-active");
      //For sidebar-nav
      var elm_sidebar_nav = $(".sidebar-nav");
      jQuery(elm_sidebar_nav).toggleClass("is-active");
    });

    // Sidebar Menu
    $.sidebarMenu = function(menu) {
      var animationSpeed = 300,
        subMenuSelector = ".sidebar-submenu";

      $(menu).on("click", "li a", function(e) {
        var $this = $(this);
        var checkElement = $this.next();

        if (checkElement.is(subMenuSelector) && checkElement.is(":visible")) {
          checkElement.slideUp(animationSpeed, function() {
            checkElement.removeClass("menu-open");
          });
          checkElement.parent("li").removeClass("active");
        }

        //If the menu is not visible
        else if (
          checkElement.is(subMenuSelector) &&
          !checkElement.is(":visible")
        ) {
          //Get the parent menu
          var parent = $this.parents("ul").first();
          //Close all open menus within the parent
          var ul = parent.find("ul:visible").slideUp(animationSpeed);
          //Remove the menu-open class from the parent
          ul.removeClass("menu-open");
          //Get the parent li
          var parent_li = $this.parent("li");

          //Open the target menu and add the menu-open class
          checkElement.slideDown(animationSpeed, function() {
            //Add the class active to the parent li
            checkElement.addClass("menu-open");
            parent.find("li.active").removeClass("active");
            parent_li.addClass("active");
          });
        }
        //if this isn't a link, prevent the page from being redirected
        if (checkElement.is(subMenuSelector)) {
          e.preventDefault();
        }
      });
    };
    $.sidebarMenu($(".sidebar-menu"));
    // side-canvas-bar
    jQuery(".side-canvas-bar-btn").on("click", function(e) {
      jQuery(".side-canvas-bar").toggleClass("side-canvas-bar-open");
    });

    //  search bar
    $(".do-toggle-search-bar").on("click", function(e) {
      e.stopPropagation();
      $(".header-search-bar .search-form").slideToggle();
    });
    $(".entry-content").on("click", function() {
      $(".header-search-bar .search-form").slideUp();
    });
  }

  $(document).ready(function() {
    "use strict"; // Start of use strict
    et_nav_menu();
  });
})(jQuery);
