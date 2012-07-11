APP_COUPONSINC.gallery = (function ($) {
    function populatePods() {
        var page = $(".pods"),
            contextData = APP_COUPONSINC.contextData,
            podIndex = 0;

        $.each(contextData, function (podId, podData) {
            var podObj,
                pod = $($(".pod", page)[podIndex]);

            switch (podData.type) {
                case 0:
                    podObj = new APP_COUPONSINC.PodPrintable(pod, podData);
                    break;
                case 15:
                    podObj = new APP_COUPONSINC.PodCPC(pod, podData);
                    break;
            }
            podObj.populatePod();

            podIndex += 1;
        });
    }

    function onReady() {
        $("button").click(populatePods);
    }

    return {
        onReady : onReady
    };

}(jQuery));

jQuery(document).ready(function () {

    APP_COUPONSINC.gallery.onReady();

});
