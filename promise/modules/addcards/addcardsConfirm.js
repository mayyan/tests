APP_COUPONSINC.addcardsConfirm = (function ($) {
	var 
		/**
		 * Master transaction's Promise
		 * It includes 
		 * 1) the dialog rendering,  
		 * 2) wait for user's response in the dialog
		 * 3) submit user's response
		 * 4) submission success
		 * 5) After all these, the master promise is resolved.
		 */
		def,

		podObject = null,

		STATUS_DONE        = "addcardsConfirm.STATUS_DONE",
		STATUS_FAIL_RENDER = "addcardsConfirm.STATUS_FAIL_RENDER",
		STATUS_FAIL_CANCEL = "addcardsConfirm.STATUS_FAIL_CANCEL";

	function confirmToAdd() {
		$.ajax({
			url: "modules/addcards/addcards.php",
			cache: false,
			data: {
				"action": "renderConfirm",
				"podId": podObject.data.podId
			}
		})
		.done(handleRenderConfirmDone)
		.fail(function() {
			console.log(STATUS_FAIL_RENDER);
			def.reject(STATUS_FAIL_RENDER);
		});
	}

	function handleRenderConfirmDone(html) {
		$(".flyout-inner")
			.html(html)
			.dialog({
				"modal": true,
				"open": onConfirmOpen
			});
	}

	function onConfirmOpen() {
		var dialogBody = $(".mod-addcards-confirm");

		$(".addcards", dialogBody).click(okConfirm);

		$(".cancel", dialogBody).click(cancelConfirm);
	}

	function okConfirm() {
		$(".flyout-inner").dialog("destroy");
		console.log(STATUS_DONE);
		def.resolve(STATUS_DONE);
	}

	function cancelConfirm() {
		$(".flyout-inner").dialog("destroy");
		console.log(STATUS_FAIL_CANCEL);
		def.reject(STATUS_FAIL_CANCEL);
	}

	function trx(podObj) {
		podObject = podObj ? podObj : null;

		var commonStores = APP_COUPONSINC.utils.getCommonStores(podObj);

		// Initiate mater promise
		def = $.Deferred();

		$.when(
			// User has to be signed-in in order to add cards
			APP_COUPONSINC.signin.trx()
		).then(
			// when sigin is resolved
			function() {
				if (podObject && commonStores.length == 0 && APP_COUPONSINC.contextData.userState.stores.length > 0) {
					// the pod is not avaliable to user's cards
					// should show confirmation dialog
					confirmToAdd();
				} else {
					// the pod is avaliable to user's cards
					// Do not show confirmation dialog.
					// This is implicit confirmation
					console.log(STATUS_DONE);
					def.resolve(STATUS_DONE);
				}
			},
			// when sigin is rejected
			function(status) {
				console.log("addcardsConfirm is failed because " + status);
				APP_COUPONSINC.util.refreshPageIfNeeded();
			}
		);	

		// Important to return the promise, so later tranaction can be chained after this promise is resolved
		return def.promise();
	}

	return {
		trx: trx
	};
}(jQuery));