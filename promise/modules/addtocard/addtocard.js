APP_COUPONSINC.addtocard = (function ($) {
	var 
		/**
		 * Master transaction's Promise
		 * It includes 
		 * 1) Inssue the add-to-card ajax
		 * 2) resolve this promise when ajax is succeeded.
		 */
		def,
		podObject = null,

		STATUS_DONE  = "addtocard.STATUS_DONE",
		STATUS_FAIL  = "addtocard.STATUS_FAIL";

	function addPodToCard() {
		$.ajax({
			url: "modules/addtocard/addtocard.php",
			cache: false,
			data: {
				"action": "addPod",
				"podId": podObject.data.podId
			}
		})
		.done(handleAddPodToCardDone)
		.fail(function() {
			console.log(STATUS_FAIL);
			def.reject(STATUS_FAIL);
		});
	}

	function handleAddPodToCardDone() {
		console.log(STATUS_DONE);
		def.resolve(STATUS_DONE);
	}

	function trx(podObj) {
		podObject = podObj ? podObj : null;

		// Initiate mater promise
		def = $.Deferred();

		$.when(
			APP_COUPONSINC.addcards.trx(podObject)
		).then(
			// when addcards is resolved, we can add the pod to card
			addPodToCard,
			// when addcards is rejected
			function(status) {
				console.log("addtocard is failed because " + status);
				APP_COUPONSINC.utils.refreshPageIfNeeded();
			} 
		);

		// Important to return the promise, so later tranaction can be chained after this promise is resolved
		return def.promise();
	}

	return {
		trx: trx
	};

}(jQuery));