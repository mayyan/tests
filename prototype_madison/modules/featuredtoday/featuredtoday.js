/*jslint sloppy: true */
/*global window:true, document:true, APP_COUPONSINC:true, jQuery:true */
/**
 * @property APP_COUPONSINC.gallery
 * @type Object
 * @static
 */
APP_COUPONSINC.featuredtoday = (function ($) {
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
        moduleBody = $(".featuredtoday");

    function onDialogOpen() {
        $(".mod-featuredtoday-flyout .close-button").click(function() {
            $('.flyout-inner').dialog("destroy");
        });
    }

    function getDialogHTML() {
        $.ajax({
            url: ".",
            data: {
                action: 'featuredtoday'
            },
            success: openDialog
        });
    }
    function openDialog(html) {
        var dlgOption = {
                modal: true,
                autoOpen: false,
                dialogClass: 'flyout-outer',
                draggable: false,
                resizable: false,
                closeText: "x",
                height: 'auto',
                width: 'auto',
                open: onDialogOpen
        },
        dialog =  $('.flyout-inner')
            .html(html)
            .removeClass("hidden")
            .dialog(dlgOption);

        dialog.dialog("open");
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

        moduleBody.click(getDialogHTML);
    }

    /**
     * Everything in the return block below are public. Allow theme to override any of them.
     */
    return {
        onReady: onReady
    }; // end of returning all public members
}(jQuery));

jQuery(document).ready(function () {
    APP_COUPONSINC.featuredtoday.onReady();
});