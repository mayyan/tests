/*jslint undef:true, es5:false, sloppy:true, indent:4 */
/*global window:true, document:true, APP_COUPONSINC:true, jQuery:true */
/**
 * @property APP_COUPONSINC.ads
 * @type Object
 * @static
 */
/**
 * Extend base without modifying base.
 * Note the {} in the first argument.
 */
APP_COUPONSINC.ads = (function ($) {
    /**
     * Since jQuery "this" often changes context to the DOM object,
     * Calling "this.publicFunction()" may found function undefined, especially in event handlers, where "this" is the DOM object.
     * We need a persistent reference to refer to the themed module object.
     *
     * Private "module" caches the themed module object, for easy access through out the closure.
     */
    var module,

        lastRequestTimeStamp = (new Date()).getTime(),
        lastPage = 0;

    /**
     * Reresh if the gap between two refresh request is long enough
     * and is loading new pages forward or the first page
     */
    function handleChangePage(e, params) {
        var pageNum     = params.page,
            eventOrigin = params.eventOrigin,
            currPage,
            prevMrecIframe = $(".mod-gallery .mod-ads.container-300x250"),
            currMrecIframe,
            refreshAds = false,
            url = 'http://couponbar.coupons.com/adblob.asp?AdSize=300x250&pzn=13306iq3710&req=1347339507201&zip=&did=AMUAAREKS&spage=.com/&npage={pageNum}&mrec={isMREC}';

        if (eventOrigin.type === "click" && eventOrigin.target === "selector" && eventOrigin.dir === "forward") {

            currPage = $(".mod-gallery .page").eq(pageNum);
            refreshAds = true;

        } else if (eventOrigin.type === "click" && eventOrigin.target === "selector" && eventOrigin.dir === "backward") {

            currPage = $(".mod-gallery .page").eq(0);
            refreshAds = true;
        }

        if (refreshAds) {
            currMrecIframe = $(".mod-ads.container-300x250 iframe", currPage);

            prevMrecIframe
                .removeClass("mrec")
                .addClass("house-ad");

            prevMrecIframe.attr("src",
                url.replace("{pageNum}", pageNum)
                    .replace("{isMREC}", false));

            currMrecIframe
                .removeClass("house-ad")
                .addClass("mrec");

            currMrecIframe.attr("src",
                url.replace("{pageNum}", pageNum + 1)
                    .replace("{isMREC}", true));
        }

    }

    /**
     * Event handler when module is loaded
     *
     * @method onReady
     */
    function onReady() {
        module = this; //IMPORTANT: get a hold of themed module object.

        $(document).bind("couponsinc:changepage", handleChangePage);
    }

    return {
        onReady : onReady
    };
}(jQuery));

jQuery(document).ready(function () {

    APP_COUPONSINC.ads.onReady();

});