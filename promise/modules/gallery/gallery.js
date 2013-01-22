APP_COUPONSINC.gallery = (function ($) {
	var moduleBody = $(".mod-gallery"),
		podObjects = [];

	function init() {

		var pods = $(".pod", moduleBody);

		$.each(pods, function(index, podDom){
			var podNode = $(podDom),
				podId = podNode.data().podid,
				podData = APP_COUPONSINC.contextData.gallery.podCache[podId],
				podObj = new APP_COUPONSINC.PodSaveToCard(podNode, podData);

			podObj.bindEventHandlers();
			podObjects.push(podObj);

		});
	}

	function onReady() {
		init();
	}

	return {
		onReady: onReady
	};

}(jQuery));

jQuery(document).ready(function () {
    APP_COUPONSINC.gallery.onReady();
});