APP_COUPONSINC.addtocard = (function ($) {
	var def,
		podObject = null,

		STATUS_DONE                = "addtocard.STATUS_DONE",
		STATUS_DONE_CONFIRM        = "addtocard.STATUS_DONE_CONFIRM",
		STATUS_FAIL_RENDER_CONFIRM = "addtocard.STATUS_FAIL_RENDER_CONFIRM",
		STATUS_FAIL_CANCEL_CONFIRM = "addtocard.STATUS_FAIL_CANCEL_CONFIRM",
		STATUS_FAIL_ADDPODTOCARD   = "addtocard.STATUS_FAIL_ADDPODTOCARD";

	function confirmToAdd() {
		$.ajax({
			url: "modules/addtocard/addtocard.php",
			cache: false,
			data: {
				"action": "renderConfirm",
				"podId": podObject.data.podId
			}
		})
		.done(handleRenderConfirmDone)
		.fail(function() {
			console.log(STATUS_FAIL_RENDER_CONFIRM);
			def.reject(STATUS_FAIL_RENDER_CONFIRM);
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
		var dialogBody = $(".mod-addtocard-confirm");

		$(".addcards", dialogBody).click(doAddCards);

		$(".cancel", dialogBody).click(cancelConfirm);
	}

	function doAddCards() {
		def.resolve(STATUS_DONE_CONFIRM);
	}

	function cancelConfirm() {
		$(".flyout-inner").dialog("destroy");
		console.log(STATUS_FAIL_CANCEL_CONFIRM);
		def.reject(STATUS_FAIL_CANCEL_CONFIRM);
	}

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
			console.log(STATUS_FAIL_ADDPODTOCARD);
			def.reject(STATUS_FAIL_ADDPODTOCARD);
		});
	}

	function handleAddPodToCardDone() {
		console.log(STATUS_DONE);
		def.resolve(STATUS_DONE);
	}

	function getCommonStores() {
		var userStores = APP_COUPONSINC.contextData.userState.stores,
			podStores  = podObject.data.atStores,
			commonStores = APP_COUPONSINC.utils.arrayIntersection(userStores, podStores);

		return commonStores;
	}

	function add(podObj) {
		

		podObject = podObj ? podObj : null;

		var commonStores = getCommonStores();
		if (commonStores.length == 0 && APP_COUPONSINC.contextData.userState.stores.length > 0) {

			def = $.Deferred();

			$.when(
				confirmToAdd(),
				APP_COUPONSINC.addcards.show(podObject)
			).then(
				addPodToCard
			);

			return def.promise();

		} else {
			def = $.Deferred();

			$.when(
				APP_COUPONSINC.addcards.show(podObject)
			).then(
				// when addcards is resolved, we can add the pod to card
				addPodToCard
			);

			return def.promise();
		}

		
	}

	return {
		add: add
	};

}(jQuery));