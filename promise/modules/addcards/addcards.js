APP_COUPONSINC.addcards = (function ($) {
	var def,
		podObject = null,

		STATUS_DONE                  = "addcards.STATUS_DONE", //unused. When successful, resolve with store array
		STATUS_CANCEL                = "addcards.STATUS_CANCEL",
		STATUS_FAIL_GETDIALOGHTML    = "addcards.STATUS_FAIL_GETDIALOGHTML",
		STATUS_FAIL_DOADDCARDS       = "addcards.STATUS_FAIL_DOADDCARDS",
		STATUS_FAIL_NO_COMMON_STORES = "addcards.STATUS_FAIL_NO_COMMON_STORES";

	function getDialogHtml() {
		$.ajax({
			url: "modules/addcards/addcards.php",
			cache: false,
			data: {
				"action": "render"
			}
		})
		.done(handleGetDialogHtmlDone)
		.fail(function() {
			console.log(STATUS_FAIL_GETDIALOGHTML);
			def.reject(STATUS_FAIL_GETDIALOGHTML);
		});
	}

	function doAddCards() {
		var dialogBody = $(".mod-addcards-flyout"),
			checkboxes = $("input[type=checkbox]:checked", dialogBody),
			selectedStores = [];

		$.each(checkboxes, function(index, checkbox) {
			selectedStores.push(checkbox.value);
		});

		$.ajax({
			url: "modules/addcards/addcards.php",
			cache: false,
			data: {
				"cards": selectedStores,
				"action": "submit"
			}
		})
		.done(handleAddCardsDone)
		.fail(function() {
			console.log(STATUS_FAIL_DOADDCARDS);
			def.reject(STATUS_FAIL_DOADDCARDS);
		});
	}

	function cancel() {
		$(".flyout-inner").dialog("destroy");
		console.log(STATUS_CANCEL);
		def.reject(STATUS_CANCEL);
	}

	function onOpen() {
		var dialogBody = $(".mod-addcards-flyout");

		$(".submit", dialogBody).click(doAddCards);

		$(".cancel", dialogBody).click(cancel);
	}


	function handleGetDialogHtmlDone(html) {
		$(".flyout-inner")
			.html(html)
			.dialog({
				"modal": true,
				"open": onOpen
			});
	}

	/**
	 * If we want to refresh the page in this function, no need to resolve/reject here.
	 * At refresh, server should be able to inform frontend with correct userState, and user's updated cards.
	 * Front-end needs to
	 * 1) Before refresh, addtocard saves the pending podObject in localStorage.
	 * 2) addtocard implements onReady(). It calls addtocard.add(podObject) where podObject is from localStorage.
	 * 3) After refresh, addtocard.onReady() is called.
	 */
	function handleAddCardsDone(newCards) {
		$(".flyout-inner").dialog("destroy");

		var exsitingStores = APP_COUPONSINC.contextData.userState.stores;

		APP_COUPONSINC.contextData.userState.stores = APP_COUPONSINC.utils.arrayUnique($.merge(exsitingStores, newCards));

		if (podObject) {
			// triggered by adding a pod to card
			var commonStores = getCommonStores();
			if (commonStores.length > 0) {
				// the pod is available to the new set of user's cards
				console.log("addcards " + commonStores.join(","));
				def.resolve(commonStores);

			} else {
				// the pod is NOT available to the new set of user's cards
				console.log(STATUS_FAIL_NO_COMMON_STORES);
				def.reject(STATUS_FAIL_NO_COMMON_STORES);
				APP_COUPONSINC.utils.displayMsg(STATUS_FAIL_NO_COMMON_STORES);
			}

		} else {
			// triggered by Add Card outside of a pod
			console.log("addcards " + APP_COUPONSINC.contextData.userState.stores.join(","));
			def.resolve(APP_COUPONSINC.contextData.userState.stores);
		}
	}

	function getCommonStores() {
		var userStores = APP_COUPONSINC.contextData.userState.stores,
			podStores  = podObject.data.atStores,
			commonStores = APP_COUPONSINC.utils.arrayIntersection(userStores, podStores);

		return commonStores;
	}

	function show() {
		var shouldOpenDialog = true,
			commonStores;

		def = $.Deferred();

		if (arguments[0].type === "click") {

			podObject = null;

		} else {
			podObject = arguments[0];

			commonStores = getCommonStores();

			if (commonStores.length > 0) {
				console.log("addcards " + commonStores.join(","));
				def.resolve(commonStores);
				shouldOpenDialog = false;
			}
		} 

		if (shouldOpenDialog) {
			$.when(
				APP_COUPONSINC.signin.show()
			).then(
				// signin is resolved, we can show the dialog
				getDialogHtml
			);
		}

	   	return def.promise();
	}

	function onReady() {
		var moduleBody = $(".mod-addcards");

		$(".addcards", moduleBody).click(show);
	}

	return {
		show: show,
		onReady: onReady
	};

}(jQuery));

jQuery(document).ready(function () {
    APP_COUPONSINC.addcards.onReady();
});
