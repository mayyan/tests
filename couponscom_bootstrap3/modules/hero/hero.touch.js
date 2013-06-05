define(["jquery", "jquery.event.swipe"], function($, swipe) {
	var carousel = $('.mod-hero .carousel');

    $(document).ready(function () {
        $(carousel).on('swipeleft', function(e) {
			carousel.carousel('next');
		})
		.on('swiperight', function(e) {
			carousel.carousel('prev');
		});
    });
});