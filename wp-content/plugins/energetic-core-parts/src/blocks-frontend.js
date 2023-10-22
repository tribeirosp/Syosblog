// Blocks frontend scripts

//  slick carousel
import "slick-carousel";

jQuery(".slider-call").slick();
jQuery('a[data-slide]').click(function(e) {
    e.preventDefault();
    var slideno = jQuery(this).data('slide');
    
    jQuery(".sada-carousel-style-one-nav a").removeClass("active");
    jQuery(this).addClass("active");
    jQuery('.slider-call').slick('slickGoTo', slideno - 1);
});
// wp-block categories
var maxHeight = 0;
jQuery(".wp-block-energetic-core-parts-categories.card-overlay-style div:not(.col-lg-12) > .card").each(function(){
   if (jQuery(this).height() > maxHeight) { maxHeight = jQuery(this).height(); }
});
jQuery(".wp-block-energetic-core-parts-categories.card-overlay-style div:not(.col-lg-12) > .card").height(maxHeight*1.2);