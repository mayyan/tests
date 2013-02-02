APP_COUPONSINC.addtocard = (function ($) {
	var 
		/**
		 * Master transaction's Promise
		 * It includes 
		 * 1) Inssue the add-to-card ajax
		 * 2) resolve this promise when ajax is succeeded.
		 */
		def = null,

		STATUS_DONE  = "addtocard.STATUS_DONE",
		STATUS_FAIL  = "addtocard.STATUS_FAIL"
		STATUS_PENDING  = "addtocard.STATUS_PENDING";

	function addPodToCard(podObject) {
		$.ajax({
			url: "modules/addtocard/addtocard.php",
			cache: false,
			data: {
				"action": "addPod",
				"podId": podObject.data.podId
			},
			context: {
				podObject: podObject
			}
		})
		.done(handleAddPodToCardDone)
		.fail(function() {
			console.log(STATUS_FAIL);
			def.rejectWith(this.podObject, [STATUS_FAIL]);
		});
	}

	function handleAddPodToCardDone() {
		console.log("handleAddPodToCardDone: before resolving Pod " + this.podObject.data.podId + " def state =" + def.state());
		console.log(STATUS_DONE + " handleAddPodToCardDone " + this.podObject.data.podId);
		def.resolveWith(this.podObject);
	}

	function trx(podObject) {

		if (def && def.state() === "pending") {

			console.log(STATUS_PENDING);
			return def.promise(); // don't reject or resolve anything.

		} else {
			// Initiate master promise
			def = new $.Deferred();

			$.when(
				APP_COUPONSINC.addcards.trx(podObject)
			).then(
				// when addcards is resolved, we can add the pod to card
				function() {
					addPodToCard(podObject);
				},
				// when addcards is rejected
				function(status) {
					console.log("addtocard is failed because " + status);
					APP_COUPONSINC.utils.refreshPageIfNeeded();
				} 
			);

			// Important to return the promise, so later tranaction can be chained after this promise is resolved
			return def.promise();
		}
	}

	return {
		trx: trx
	};

}(jQuery));