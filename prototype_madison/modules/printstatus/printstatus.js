/*jslint sloppy: true */
/*global window:true, document:true, APP_COUPONSINC:true, jQuery:true */
/**
 * @property APP_COUPONSINC.gallery
 * @type Object
 * @static
 */
APP_COUPONSINC.printstatus = (function ($) {
    var body = $(".mod-printstatus");

    function printComplete(event) {
        window.location.href = "thankyou.php" + window.location.search;
    }
    /**
     * Event handler when module is loaded
     * @method onReady
     */
    function onReady() {
        window.setTimeout(printComplete, 5000);
    }
    /**
     * Everything in the return block below are public. Allow theme to override any of them.
     */
    return {
        onReady: onReady
    }; // end of returning all public members
}(jQuery));

jQuery(document).ready(function () {
    APP_COUPONSINC.printstatus.onReady();
});