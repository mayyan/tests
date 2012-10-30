/*jslint sloppy: true */
/*global window:true, document:true, APP_COUPONSINC:true, jQuery:true */
/**
 * @property APP_COUPONSINC.takeover
 * @type Object
 * @static
 */
APP_COUPONSINC.takeover = (function ($) {
    /**
     * Since jQuery "this" often changes context to the DOM object,
     * Calling "this.publicFunction()" may found function undefined, especially in event handlers, where "this" is the DOM object.
     * We need a persistent reference to refer to the themed module object.
     *
     * Private "module" caches the themed module object, for easy access through out the closure.
     */
    var module,
        doc = $(document),
        win = $(window),
        moduleBody = $(".mod-takeover");

    function showTakeoverAd() {

        $(".expaned-content", moduleBody).slideToggle("slow");

        if (moduleBody.hasClass("pencil")) {
            $(".expaned-content", moduleBody)
                .position({
                    my: "center top",
                    at: "center top",
                    of: $(".pencil-content", moduleBody)
                });
       } else {
           $(".expaned-content", moduleBody)
                .position({
                    my: "center top",
                    at: "center top",
                    of: $(".initial-content", moduleBody)
                });
       }
    }

    /**
     * Event handler when module is loaded
     * @method onReady
     */
    function onReady(themeModule) {
        /**
         * IMPORTANT: Private variable "module" is a reference to the themed's module object.
         * IMPORTANT: We do not do "module = this;" in this base module.
         */
        module = themeModule || this;

        moduleBody.click(showTakeoverAd);
    }

    /**
     * Everything in the return block below are public. Allow theme to override any of them.
     */
    return {
        onReady: onReady
    }; // end of returning all public members
}(jQuery));

jQuery(document).ready(function () {
    APP_COUPONSINC.takeover.onReady();
});