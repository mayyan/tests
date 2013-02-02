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

		var target = $(event.target),
			podObject = this;
			
		if (target.hasClass("add-to-card")) {

			addToCard.call(podObject);

		}
	}

	function addToCard() {
		
		var podObject = this;
		
		$.when(
			APP_COUPONSINC.addtocard.trx(this)
		).then(
			// when addtocard is resolved
			function() {
				console.log("calling handleAddToCardSuccess. podid=" + this.data.podId);
				handleAddToCardSuccess.call(this);
				APP_COUPONSINC.utils.refreshPageIfNeeded();
			},
			// when addtocard is rejected
			function(status) {
				if( status == "addtocard.STATUS_PENDING") {
				} else {
					console.log("PodSaveToCard.addToCard is failed. podid " + this.data.podId);
					APP_COUPONSINC.utils.refreshPageIfNeeded();
				}
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
