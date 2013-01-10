/*jslint sloppy: true */
/*global window:true, document:true, APP_COUPONSINC:true, jQuery:true */
/**
 * @property APP_COUPONSINC.gallery
 * @type Object
 * @static
 */
APP_COUPONSINC.couponcarrier = (function ($) {
    var body = $(".mod-couponcarrier");

    function handleClick(event) {
        var target = $(event.target);

        if (target.hasClass("print-button")) {
            window.location.href = "printing.php" + window.location.search;
        }
    }
    /**
     * Event handler when module is loaded
     * @method onReady
     */
    function onReady() {
        body.click(handleClick);
    }
    /**
     * Everything in the return block below are public. Allow theme to override any of them.
     */
    return {
        onReady: onReady
    }; // end of returning all public members
}(jQuery));

jQuery(document).ready(function () {
    APP_COUPONSINC.couponcarrier.onReady();
});