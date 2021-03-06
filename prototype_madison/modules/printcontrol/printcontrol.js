/*jslint sloppy: true */
/*global window:true, document:true, APP_COUPONSINC:true, jQuery:true */
/**
 * @property APP_COUPONSINC.gallery
 * @type Object
 * @static
 */
APP_COUPONSINC.printcontrol = (function ($) {
    var body = $(".mod-printcontrol");

    function handleClick(event) {
        var target = $(event.target);

        if (target.hasClass("print-button") || target.parents(".print-button").length == 1) {
            window.location.href = "printing.php" + window.location.search;
        }
    }

    function updatePrintButton(e, params) {
        var podIdWithEffect = (params.podIds && params.podIds.length > 0) ? params.podIds[0] : -1,
            printBtn = $(".print-button", body),
            numberSection = $(".number", printBtn),
            count = parseInt(numberSection.text(), 10),
            diff = params.count ? params.count : params.podIds.length;

        if (e.type === 'couponsinc:clipped') {
            showTransferEffect(podIdWithEffect);
            numberSection.html(count + diff);
        } else {
            numberSection.html(count - diff);
        }
    }

    function showTransferEffect(podId) {
        if (podId < 0) {
            return;
        }
        var effectElement = $('.couponcarrier-transfer-clipped'),
            podImage = $("#couponsinc-gallery-POD" + podId + " .pod-image");

        podImage.effect("transfer", {
            to: $(".print-button .number", body),
            className: "couponcarrier-transfer-clipped"
        }, 400);

        body.trigger("couponsinc:clip-effect-started", {podId: podId});
    }

    function handleEffectStarted(e, params) {

        var effectElement = $('.couponcarrier-transfer-clipped'),
            podId = params.podId,
            podImage = $("#couponsinc-gallery-POD" + podId + " .pod-image"),
            podImageSrc = podImage.attr("src"),
            imageElementTemplate = "<img src=\"{src}\"/>",
            imageElementHtml = imageElementTemplate.replace("{src}", podImageSrc);

        $(imageElementHtml)
            .css("width", "100%")
            .css("height", "100%")
            .appendTo(effectElement);
    }

    /**
     * Event handler when module is loaded
     * @method onReady
     */
    function onReady() {
        body.click(handleClick);
        $(document).bind('couponsinc:clipped', updatePrintButton);
        $(document).bind('couponsinc:unclipped', updatePrintButton);
        $(document).on('couponsinc:clip-effect-started', '.mod-printcontrol', handleEffectStarted);
    }
    /**
     * Everything in the return block below are public. Allow theme to override any of them.
     */
    return {
        onReady: onReady
    }; // end of returning all public members
}(jQuery));

jQuery(document).ready(function () {
    APP_COUPONSINC.printcontrol.onReady();
});