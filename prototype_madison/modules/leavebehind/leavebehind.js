APP_COUPONSINC.leavebehind = (function ($) {
	var doc = $(document),
		lastIsHeaderFixed = $("body").hasClass("fixed-header"),
		lastScrollTime = 0,
		moduleBody = $(".mod-leavebehind"),
		timer;

	function checkLayout() {
		var checkTime = new Date().getTime(),
			isHeaderFixed = $("body").hasClass("fixed-header");

		if (isHeaderFixed == lastIsHeaderFixed && checkTime - lastScrollTime > 500) {
			// scroll is stable
			if (isHeaderFixed) {
				moduleBody.slideDown();
			} else {
				moduleBody.slideUp();
			}



		} else {
			lastScrollTime    = checkTime;
			lastIsHeaderFixed = isHeaderFixed;
		}

		window.clearTimeout(timer);
		timer = window.setTimeout(checkLayout, 500);
	}

	function onReady() {
		timer = window.setTimeout(checkLayout, 500);

		doc.bind("couponsinc:windowScrolled", function() {
			lastScrollTime = new Date().getTime();
		});
	}

	return {
		onReady: onReady
	};

}(jQuery));
jQuery(document).ready(function () {

    APP_COUPONSINC.leavebehind.onReady();

});