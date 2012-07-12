/**
 * A gallery module that uses existing module pattern
 *     It means all children have the same namespace as parent, aka APP_COUPONSINC.gallery.
 *     They are "vertically" extendable. functions are merged.
 *     If we use this machanism, functions for CPC must have a different name than the functions for Printable pod.
 *     We don't want this.
 *
 * In this inheritance pattern
 *     Each child has its own namespace, aka APP_COUPONSINC.PodPrintable etc. It's actually a class name.
 *     Parent class is "horizontally" extendable to mutliple children classes within the same theme.
 *     They can contain the same function name while having different implementation.
 *     A child class can have a function of its own that doesn't exsist in otehr classes too.
 *
 *     You need to use "new" operator to instanciate an instance.
 *     Base class APP_COUPONSINC.Pod is an abstraction of all types of pod.
 *     Base class should not be used to create any pod instance.
 *
 *                         themeless
 *                           Pod
 *                            |
 *             --------------------------------
 *             |                              |
 *          themeless                     themless
 *           PodCPC                     PodPrintable
 *             |                              |
 *    -----------------             ---------------------
 *    |               |             |                   |
 * bigblue's      walmart's     bigblue's            walmart's
 * PodCPC         PodCPC        PodPrintable         PodPrintable
 *
 */
APP_COUPONSINC.gallery = (function ($) {
    function init() {
        var pods = $(".pod"),
            contextData = APP_COUPONSINC.contextData;

        // Create object on existing pod DOM element.
        // Since HTML is already present, all it left to do
        // is to set up the event handlers on the existing pod DOM elements.
        $.each(pods, function (index, podDom) {
            var pod = $(podDom),
                podId = pod.data("podid"),
                podData = contextData[podId],
                podObj;

            switch (podData.type) {
                case 0:
                    podObj = new APP_COUPONSINC.PodPrintable(pod, podData);
                    break;
                case 15:
                    podObj = new APP_COUPONSINC.PodCPC(pod, podData);
                    break;
            }
            podObj.bindEventHandlers();
        });
    }

    function populatePods() {
        var page = $(".pods"),
            podIds = ["1001", "1002"],
            contextData = APP_COUPONSINC.contextData,
            podIndex = 0;

        // Using existing pod DOM as template, populate the DOM using pod data.
        // Part of populating is re-setting up event handlers on the new ob
        $.each(podIds, function (index, podId) {
            var podObj,
                pod = $($(".pod", page)[podIndex]),
                podData = contextData[podId];

            switch (podData.type) {
                case 0:
                    podObj = new APP_COUPONSINC.PodPrintable(pod, podData);
                    break;
                case 15:
                    podObj = new APP_COUPONSINC.PodCPC(pod, podData);
                    break;
            }
            podObj.populate();

            podIndex += 1;
        });
    }

    function onReady() {
        init();
        $("button").click(populatePods);
    }

    return {
        onReady : onReady
    };

}(jQuery));

jQuery(document).ready(function () {

    APP_COUPONSINC.gallery.onReady();

});
