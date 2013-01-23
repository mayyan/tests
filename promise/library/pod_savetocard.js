/*jslint sloppy: true, nomen:true */
/*global window:true, document:true, APP_COUPONSINC:true, jQuery:true */
/**
 * Class of Save to Card pod
 * @property APP_COUPONSINC.PodSaveToCard
 * @type Object
 * @static
 */
APP_COUPONSINC.PodSaveToCard = APP_COUPONSINC.Pod.extend((function ($) {
	
	function handleClick(event) {
		var target = $(event.target);

		if (target.hasClass("add-to-card")) {
			addToCard.call(this);
		}
	}

	function addToCard() {
		alert("You are about to add pod " + this.data.podId);

		var podObject = this;

		$.when(
			APP_COUPONSINC.addtocard.add(podObject)
		).then(
			// when addtocard is resolved
			function() {	
				handleAddToCardSuccess.call(podObject);
			}
		);

	}

	function handleAddToCardSuccess() {
		console.log('handleAddToCardSuccess pod ' + this.data.podId + ' has been added.');
		this.pod.addClass("clipped");
	}

    return {
        handleClick: handleClick
    };
}(jQuery)));