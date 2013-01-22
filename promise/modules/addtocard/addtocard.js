APP_COUPONSINC.addtocard = (function ($) {
	var def,
		podObject = null,

		STATUS_DONE               = "addtocard.STATUS_DONE",
		STATUS_FAIL_ADDPODTOCARD  = "addtocard.STATUS_FAIL_ADDPODTOCARD";

	function addPodToCard() {
		$.ajax({
			url: "modules/addtocard/addtocard.php",
			cache: false,
			data: {
				"podId": podObject.data.podId
			}
		})
		.done(handleAddPodToCardDone)
		.fail(function() {
			console.log(STATUS_FAIL_ADDPODTOCARD);
			def.reject(STATUS_FAIL_ADDPODTOCARD);
		});
	}

	function handleAddPodToCardDone() {
		console.log(STATUS_DONE);
		def.resolve(STATUS_DONE);
	}

	function add(podObj) {
		def = $.Deferred();

		podObject = podObj ? podObj : null;

		$.when(
			APP_COUPONSINC.addcards.show(podObject)
		).then(
			// when addcards is resolved, we can add the pod to card
			addPodToCard
		);

		return def.promise();
	}

	return {
		add: add
	};

}(jQuery));