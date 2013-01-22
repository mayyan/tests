APP_COUPONSINC.utils = (function ($) {
	/**
	 * Return the common elements of two array
	 */
	function arrayIntersection(a1, a2) {
		var common = [];

		$.each(a1, function(index, a1Item) {
			if ($.inArray(a1Item, a2) >= 0) {
				common.push(a1Item);
			}
		});

		return common;
	}

	/**
	 * Return the unique elements of an array
	 */
	function arrayUnique(a) {
		var unique = $.grep(a, function(v, k){
		    return $.inArray(v, a) === k;
		});

		return unique;

	}

	function displayMsg(msg) {
		$(".flyout-inner")
			.html(msg)
			.dialog({"modal": true});
	}
	
	return {
		arrayIntersection: arrayIntersection,
		arrayUnique: arrayUnique,
		displayMsg: displayMsg
	};
}(jQuery));