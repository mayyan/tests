/*jslint es5:false, sloppy:true */
/*global window:true, document:true, APP_COUPONSINC:true, jQuery:true */
APP_COUPONSINC.layout = (function ($) {
    /**
     * Since jQuery "this" often changes context to the DOM object,
     * Calling "this.publicFunction()" may found function undefined, especially in event handlers, where "this" is the DOM object.
     * We need a persistent reference to refer to the themed module object.
     *
     * Private "module" caches the themed module object, for easy access through out the closure.
     */
    var module,

        win              = $(window),
        doc              = $(document),
        body             = $("body"),

        modStalker       = $(".mod-stalker"),
        stalkerOffsetTop = modStalker.offset().top,

        didScroll = false,
        lastScrollTop = 0;


    /**
     * Change to one of the two possible states of stalker
     * @param {String} toState "fixed" or "static"
     */
    function changeStalker(toState) {
        if (toState === "fixed") {

            body.addClass("fixed-header");

        } else { /* toState === "static" */

            body.removeClass("fixed-header");

        }
    }

    /**
     * Event handler for scroll event
     * Simply detects scroll event happened.
     * We don't process scroll event eveythime it fires.
     * We process scroll event in a timer.
     */
    function handleScroll(e) {
        didScroll = true;
    }

    /**
     * "scroll" event fires repeatedly and rapidly.
     * Instead putting all these logic into handleScroll(),
     * we only process it every interval.
     *
     * When couponcarrier touches the bottom of header, fix position it.
     * Otherwise, default (static) position.
     *
     * When scrolling down and gallery's bottom is aligned with rail modules's bottom,
     * turn rail from fixed position to absolute postion, so that continue scrolling up pulls the rail up together.
     *
     * When scrolling up and rail's top is aligned with coupon carrier's top,
     * turn rail from absolute position to fixed position, so that the rail does not continue go down.
     */
    function processScroll() {
        didScroll = false;

        var windowScrollTop  = win.scrollTop();

        if (windowScrollTop > stalkerOffsetTop) {
            changeStalker("fixed");
        } else {
            changeStalker("static");
        }

        // Remember last scroll position, so later I'll know scroll direction
        lastScrollTop = windowScrollTop;
    }

    function setupEventHandler() {
        win.scroll(handleScroll);
    }

    function onReady(themeModule) {
        /**
         * IMPORTANT: Private variable "module" is a reference to the themed's module object.
         * IMPORTANT: We do not do "module = this;" in this base module.
         */
        module = themeModule || this;

        var scrollEventIntervalMS = 250;

        setupEventHandler();

        //http://ejohn.org/blog/learning-from-twitter/
        //It's a very, very, bad idea to attach handlers to the window scroll event.
        //Depending upon the browser, the scroll event can fire a lot and putting code in the scroll
        //callback will slow down any attempts to scroll the page (not a good idea).
        //Instead it's much better to use some form of a timer
        //to check every X milliseconds OR to attach a scroll event and only run your code after a delay
        //(or even after a given number of executions - and then a delay).
        setInterval(function () {
            if (didScroll) {
                // Check your page position and then
                // Load in more results
                processScroll();
            }
        }, scrollEventIntervalMS);
    }

    return {
        processScroll : processScroll,
        onReady : onReady
    };
}(jQuery));
jQuery(document).ready(function () {

    APP_COUPONSINC.layout.onReady();

});
