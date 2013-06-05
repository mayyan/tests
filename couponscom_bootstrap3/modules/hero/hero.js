define(["jquery", "bootstrap", "jquery.event.swipe"], function($, bootstrap, swipe) {
	var carousel = $('.mod-hero .carousel');

    $(document).ready(function () {
        carousel.carousel();
    });

    if (Modernizr.touch) {
		requirejs(['heroTouch']);
	}
});



