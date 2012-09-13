APP_COUPONSINC.header = (function ($) {
    /**
     * Since jQuery "this" often changes context to the DOM object,
     * Calling "this.publicFunction()" may found function undefined, especially in event handlers, where "this" is the DOM object.
     * We need a persistent reference to refer to the themed module object.
     *
     * Private "module" caches the themed module object, for easy access through out the closure.
     */
    var module,
        /**
         * Frequently used variables
         */
        doc = $(document),
        body = $(".mod-header");

    function closeDropdown() {
        $(".user-dropdown", body).addClass("closed");
    }

    function handleClick(e) {
        var target = $(e.target);

        if (target.hasClass("first") || target.parents(".first").length === 1) {
            $(".user-dropdown", body).toggleClass("closed");
        }
    }

    function onReady (themeModule) {
        /**
         * IMPORTANT: Private variable "module" is a reference to the themed's module object.
         * IMPORTANT: We do not do "module = this;" in this base module.
         */
        module = themeModule || this;

        $(body).click(handleClick);
        $(".user-dropdown").bind("clickoutside", closeDropdown);

    }

   /**
     * Everything in the return block below are public. Allow theme to override any of them.
     */
    return {
        onReady : onReady
    };

}(jQuery));

jQuery(document).ready(function () {
    APP_COUPONSINC.header.onReady();
});