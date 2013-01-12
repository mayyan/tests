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
        modGallery       = $(".mod-gallery"),
        modTakeover      = $(".mod-takeover"),
        stalkerOffsetTop = modStalker.offset().top,
        galleryOffsetTop = modGallery.offset().top,
        pencilHeight     = $(".pencil-content", modTakeover).outerHeight(true),
        takeoverState    = "initial",

        didScroll = false,
        lastScrollTop = 0;


    /**
     * Change to one of the two possible states of stalker
     * @param {String} toState "fixed" or "static"
     */
    function changeStalker(toState) {
        if (toState === "fixed") {

            body.addClass("fixed-header");

            var left = (win.width() - modStalker.outerWidth()) / 2;
            modStalker.css("left", left);

            if (takeoverState === "pencil" /*modTakeover.hasClass("pencil")*/ ) {
                //console.log("changeStalker to fixed and takeove is pencil");
                modStalker
                    .css("top", pencilHeight + "px");
            } else {
                //console.log("changeStalker to fixed and takeove is initial");
                modStalker
                    .css("top", "0"); /* original */
            }

        } else { /* toState === "static" */
            //console.log("changeStalker to static");
            body.removeClass("fixed-header");
            modStalker
                .css("left", "auto"); /* original */

        }
    }

    /**
     * Change to one of the two possible states of gallery
     * @param {String} toState "fixed" or "static"
     */
    function changeGallery(toState) {
        var stalkerHeight;

        if (toState === "fixed") {
            stalkerHeight = modStalker.outerHeight(true);
            modGallery.css("margin-top", stalkerHeight + "px");

        } else { /* toState === "static" */

            modGallery.css("margin-top", "auto");

        }
    }

    /**
     * Change to one of the two possible states of takeover
     * @param {String} toState "pencil" or "initial"
     */
    function changeTakeover(toState) {
        if (toState === "pencil") {
            //console.log("changeTakeover to pencil");
            takeoverState = "pencil";
            modTakeover.switchClass("initial", "pencil");
            $(".initial-content", modTakeover).slideUp("slow");
            $(".pencil-content", modTakeover).slideDown("slow");
        } else {
            //console.log("changeTakeover to initial");
            takeoverState = "initial";
            modTakeover.switchClass("pencil", "initial");
            $(".initial-content", modTakeover).slideDown("slow");
            $(".pencil-content", modTakeover).slideUp("slow");
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

        //console.log("windowScrollTop=" + windowScrollTop + "; stalkerOffsetTop=" + stalkerOffsetTop + "; galleryOffsetTop=" + galleryOffsetTop);

        if (windowScrollTop > galleryOffsetTop) {
            //console.log("state 3");
            //changeTakeover("pencil");
            changeStalker("fixed");
            changeGallery("fixed");
        } else if (stalkerOffsetTop <= windowScrollTop && windowScrollTop <= galleryOffsetTop) {
            //console.log("state 2");
            //changeTakeover("initial");
            changeStalker("fixed");
            changeGallery("fixed");
        } else {
            //console.log("state 1");
            //changeTakeover("initial");
            changeStalker("static");
            changeGallery("static");
        }

        doc.trigger("couponsinc:windowScrolled");

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

        var scrollEventIntervalMS = 0;

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
