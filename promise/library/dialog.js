APP_COUPONSINC.dialog = (function ($) {

	function open(html, option) {
		close();
		
		var opt = $.extend({
				autoOpen: false,
	            dialogClass: "flyout-outer",
	            draggable: false,
	            modal: true,
	            resizable: false
			}, option);

		$(".flyout-inner")
			.html(html)
			.dialog(opt)
			.dialog("open");
	}

	function close() {
		$(".flyout-inner")
			.dialog("close")
			.dialog("destroy")
			.empty();
	}

	return {
		open: open,
		close: close
	};

}(jQuery));

