//----------------------------------------------------/
// Magnific Popup
//----------------------------------------------------/
import "magnific-popup/dist/jquery.magnific-popup";

$(".popup_gallery").magnificPopup({
    delegate: "img",
    type: "image",
    mainClass: "mfp-with-zoom mfp-img-mobile",
    fixedContentPos: false,
    gallery: {
        enabled: true
    },
    zoom: {
        enabled: true,
        duration: 300 // don't foget to change the duration also in CSS
    },
    callbacks: {
        elementParse: function (qw) {
            qw.src = qw.el.attr("src");
        }
    }
});

// For video popup (PLAY VIDEO TRIGGER)
$(".iframe_trigger, #iframe_trigger").magnificPopup({
    disableOn: 700,
    type: "iframe",
    mainClass: "mfp-fade",
    removalDelay: 160,
    preloader: false,
    fixedContentPos: false
});