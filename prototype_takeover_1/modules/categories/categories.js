/*jslint undef:true, es5:false, sloppy:true */
/*global window:true, document:true, APP_COUPONSINC:true, jQuery:true */
APP_COUPONSINC.categories = (function ($) {
    /**
     * Since jQuery "this" often changes context to the DOM object,
     * Calling "this.publicFunction()" may found function undefined, especially in event handlers, where "this" is the DOM object.
     * We need a persistent reference to refer to the themed module object.
     *
     * Private "module" caches the themed module object, for easy access through out the closure.
     */
    var module,

        body = $('.mod-categories'),

        slidingDuration = 400;

    /**
     *  this hides the teasers  and shows the full category list when a user
     * clicks on the "show more categories" link
     */
    function hideTeasersShowCategories()  {
        // sliding animation
        $(".mod-categories.categories-show-teasers").switchClass("categories-show-teasers", "categories-no-teasers", slidingDuration);
    }

    /**
     * this hides full category list and shows the teasers when a user
     * clicks on the "show less categories" link
     */
    function showTeasersHideCategories()  {
        // sliding animation
        $(".mod-categories.categories-no-teasers").switchClass("categories-no-teasers", "categories-show-teasers", slidingDuration);
    }

    function setupEvenHandlers() {
        $('.show-more', body).click(hideTeasersShowCategories);

        $(".show-less", body).click(showTeasersHideCategories);
    }

    /**
     * Event handler when module is loaded
     *
     * @method onReady
     */
    function onReady() {
        module = this; //IMPORTANT: get a hold of themed module object.
        setupEvenHandlers();
    }

    return {
        onReady : onReady
    };

}(jQuery));
jQuery(document).ready(function () {

    APP_COUPONSINC.categories.onReady();

});
