APP_COUPONSINC.utils = (function ($) {
	var refreshPending = false;

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

	function getCommonStores(podObject) {
		if (podObject) {
			var userStores = APP_COUPONSINC.contextData.userState.stores,
				podStores = podObject.data.atStores,
				commonStores = APP_COUPONSINC.utils.arrayIntersection(userStores, podStores);

			return commonStores;
		} else {
			return [];
		}
	}

	function setRefreshPending(flag) {
		refreshPending = flag;
	}

	function getRefreshPending() {
		return refreshPending;
	}

	function refreshPageIfNeeded() {
		if (refreshPending) {
			console.log("refreshing page....");

			// In production code, page refresh will send back the updated contextData.userState.
			// After real page refresh refreshPending should set be to its initial value (false).
			// Here, I'm keep the userState as if the state is up-to-date, but manually reset refreshPending to false.
			/*window.location.reload();*/
			refreshPending = false;
		}
	}
	
	return {
		arrayIntersection: arrayIntersection,
		arrayUnique: arrayUnique,
		displayMsg: displayMsg,
		getCommonStores: getCommonStores,
		setRefreshPending: setRefreshPending,
		getRefreshPending: getRefreshPending,
		refreshPageIfNeeded: refreshPageIfNeeded

	};
}(jQuery));