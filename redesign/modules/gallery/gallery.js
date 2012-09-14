/*jslint sloppy: true */
/*global window:true, document:true, APP_COUPONSINC:true, jQuery:true */
/**
 * @property APP_COUPONSINC.gallery
 * @type Object
 * @static
 */
APP_COUPONSINC.gallery = (function ($) {
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

        /**
         * 0, 9, 13, 15, 27 are supported types for gallery
         */
        POD_TYPE_PRINTABLE                    = "0",
        POD_TYPE_DUET                         = "9",
        POD_TYPE_VIDEO                        = "13",
        POD_TYPE_CPC                          = "15",
        POD_TYPE_PRINTABLE_AND_SAVE_TO_CARD   = "27",

        body = $(".mod-gallery"),
        loadingIndicator = $(".loading-indicator", body),
        moreButton = $('.more', body),

        pageBreakTemplate = '<div class="page-break">Page {n} of {total}</div>',

        contextData,
        totalPages,
        endReached = false,
        isLoading = false, //ajax is pending
        currPageNum = 0,
        previousPage = 0,
        lastScrollTop = 0;

    /**
     * Create pod obejct based on the type
     * @param {Object} podData pod JSON data
     * @param {Obejct} podNode jQuery pod node
     */
    function createPodObject(podData, podNode) {
        var podObj = null;

        switch (podData.type) {
        case POD_TYPE_PRINTABLE:
            podObj = new APP_COUPONSINC.PodPrintable(podData, podNode);
            break;
        case POD_TYPE_DUET:
            podObj = new APP_COUPONSINC.PodDuet(podData, podNode);
            break;
        case POD_TYPE_VIDEO:
            podObj = new APP_COUPONSINC.PodVideo(podData, podNode);
            break;
        case POD_TYPE_CPC:
            podObj = new APP_COUPONSINC.PodCPC(podData, podNode);
            break;
        default:
            break;
        }

        return podObj;
    }
    /**
     * Display or Hide loading indicator and more button depend on the status of loaded pages
     */
    function toggleLoadControls() {
        if (endReached) {
            moreButton.hide();
            loadingIndicator.hide();
        } else {
            if (isLoading) {
                moreButton.hide();
                loadingIndicator.show();
            } else {
                moreButton.show();
                loadingIndicator.hide();
            }
        }
    }

    /**
     * Get the number of Pods (exclude non-coupon elements like ads.
     * @param scope The scope to seach for, Can be the whole doc, the module, or a page
     */
    function getPodCount(scope) {
        return $(".pod-shadow", scope).length;
    }
    /**
     * A page is considered in view is its page top is within viewport
     * When multiple pages are in view, return the first one from top.
     */
    function findCurrentPageInView() {
        var pageContainer = $(".pages", body),
            pages = $(".page", pageContainer),
            existingPages = pages.length,
            windowScrollTop = win.scrollTop(),
            windowHeight = win.height(),
            page,
            pageOffsetTop,
            pageNum,
            currPageNumInView = existingPages - 1;
        for (pageNum = 0; pageNum < existingPages; pageNum += 1) {
            page = $(pages[pageNum]);
            pageOffsetTop = page.offset().top;
            if (getPodCount(page) > 0 && windowScrollTop < pageOffsetTop && pageOffsetTop < windowScrollTop + windowHeight) { //an already-loaded page and top of the page is in view
                currPageNumInView = pageNum;
                module.currPageNum = pageNum;
                return currPageNumInView;
            }
        }

        return currPageNumInView;
    }

    function attachDataToPod(pods, podCache) {
        $.each(pods, function (index, podDom) {
            var pod = $(podDom),
                podId   = pod.data().podid,
                podData = podCache[podId],
                //create podObj
                podObj = createPodObject(podData, pod);

            podObj.bindEventHandlers();
        });
    }
    /**
     * Initialize. Called on page load. Make up the data attribute for the pods on first page on page load
     * @method init
     * @param {Obejct} podCache JSON, keyed by pod id.
     */
    function init(podCache) {
        // Create object on existing pod DOM element.
        // Since HTML is already present, all it left to do
        // is to set up the event handlers on the existing pod DOM elements.
        var page0 = $(".page", body)[0],
            pods  = $(".pod-shadow", page0);

        //attachDataToPod(pods, podCache);

        if (getPodCount(body) >= contextData.gallery.totalPods) {
            endReached = true;
        }

        isLoading = false;
        toggleLoadControls();
    }
    /**
     * The fail handler for load the next page Ajax query.
     * @method handleLoadFailed
     * @param {String} resp response
     * @param {String} textStatus Ajax status string. Not ued yet.
     * @param {Object} jqXHR Object representing the Ajax query. Not ued yet.
     */
    function handleLoadFailed(resp, textStatus, jqXHR) {
        isLoading = false;
        console.log("APP_COUPONSINC.gallery.load(): failed. resp=" + resp + "; textStatus=" + textStatus);
    }
    /**
     * The success handler for successfully load the next page Ajax query.
     * @method handleLoadSuccess
     * @param {Object} resp Ajax Response. html: markup for the new page; data: part of it is pod data
     * @param {String} textStatus Ajax status string. Not ued yet.
     * @param {Object} jqXHR Object representing the Ajax query. Not ued yet.
     */
    function handleLoadSuccess(resp, textStatus, jqXHR) {
        var pages = $(".pages", body),
            pageCount = $(".page", pages).length,
            pageBreakHtml = '',
            newPageHTML = resp,
            newPage = $(newPageHTML),
            pods;

        // Insert page break
        pageBreakHtml = pageBreakTemplate
            .replace('{n}', pageCount + 1)
            .replace('{total}', totalPages);
        $(pageBreakHtml).appendTo(pages);

        // Create new page
        newPage = $(newPageHTML).appendTo(pages);

        // Populate the DOM using pod data.
        // Part of populating is re-setting up event handlers on the new obj
        pods = $(".pod-shadow", newPage);

        //attachDataToPod(pods, resp.data.podCache);

        if (getPodCount(body) >= contextData.gallery.totalPods) {
            endReached = true;
        }

        isLoading = false;
        toggleLoadControls();

        /* Broadcast event */
        module.currPageNum += 1;
        doc.trigger("couponsinc:changepage", {
            page: module.currPageNum,
            eventOrigin: {
                type: "click",
                target: "selector", //this indicate that user do some action to change the page
                dir: "forward"
            }
        });
        previousPage = module.currPageNum;
    }
    /**
     * Load a new batch of pods.
     * @method load
     * @param {Integer} offset Number of pods already loaded.
     * @param {Integer} size Number of pods to load.
     * @param {function} callback Callback function on success
     */
    function load(offset, size, callback) {
        // if the previous ajaxis still pending, ignor this new request.
        if (isLoading) {
            return;
        }
        isLoading = true;
        toggleLoadControls();

        var data = {
                pid: contextData.pid,
                nid: contextData.nid,
                zid: contextData.zid,
                cid: contextData.gallery.cid,
                catId: contextData.gallery.catId,
                brand: contextData.gallery.brand
            };
        $.ajax({
            url: "modules/gallery/gallery.php",
            data: $.extend({
                action: 'loadPage',
                offset: offset,
                size : size,
                toprow: contextData.gallery.toprow
            }, data),
            success: callback,
            fail: handleLoadFailed
        });
    }
    /**
     * "scroll" event fires repeatedly and rapidly.
     * Instead putting all these logic into handleScroll(),
     * we only process it every interval.
     */
    function handleWindowScrolled() {
        var wst = win.scrollTop(),
            currPage = findCurrentPageInView(),
            eventOrigin;

        // this is for analytics! it looks for APP_COUPONSINC.gallery.currPageNum
        // when a coupon is clipped
        module.currPageNum = currPage;

        if (wst < lastScrollTop) {
            // scrolling up -- backward
            if (wst === 0) {
                // Broadcast event when user scrolls to the VERY top.
                // scrolling to other position does not fire the event (no ads refresh)
                eventOrigin = {
                    type: "click",
                    target: "selector",
                    dir: "backward"
                };
            } else {
                //this is not user click action on pagination, trigger the event only for analytics
                eventOrigin = {
                    type: "scroll",
                    target: "window",
                    dir: "backward"
                };
            }

            if (wst === 0 || previousPage > currPage) {
                doc.trigger("couponsinc:changepage", {
                    page: currPage,
                    eventOrigin: eventOrigin
                });
            }
            previousPage = currPage;
        } else {
            // scrolling down -- forward
            if (currPage !== 0 && previousPage < currPage) {
                //scrolling down for manual load vertical sccroll, trigger event only for analytics purposers, this is not user click action on pagination
                doc.trigger("couponsinc:changepage", {
                    page: currPage,
                    eventOrigin: {
                        type: "scroll",
                        target: "window",
                        dir: "forward"
                    }
                });
                previousPage = currPage;
            }
        }

        // Remember last scroll position, so later I'll know scroll direction
        lastScrollTop = wst;
    }


    /**
     * Event handler when Goto button is clicked
     */
    function handleGotoClick(e) {
        e.preventDefault();
        win.scrollTop(0);
    }

    /**
     * Event handler when Load More button is clicked.
     */
    function handleMoreClick() {
        var offset = $(".pods .grid_1", body).length,
            size   = contextData.gallery.podsPerPage;
        module.load(offset, size, module.handleLoadSuccess);
    }

    /**
     * Bind all types of event this module handles.
     * @method setupEventHandlers
     */
    function setupEventHandlers() {

        moreButton.click(module.handleMoreClick);
        $(".goto-top", body).click(handleGotoClick);
        //$(window).resize(handleResize);
        //$(document).bind("couponsinc:layoutChanged", handleLayoutChanged);
        doc.bind("couponsinc:windowScrolled", handleWindowScrolled);
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

        setupEventHandlers();

        contextData = APP_COUPONSINC.contextData;
        init(APP_COUPONSINC.contextData.gallery.podCache);
        totalPages = Math.ceil(contextData.gallery.totalPods / contextData.gallery.podsPerPage);


        // Browser(FF/Chrome) tries to restore previous scroll position on DOM Ready
        // If you've scrolled all pages, refresh page,
        // FF will fire many scroll events util be able to get to the old position, causing all the pages to be loaded
        // just on page refresh. This is bad.
        // Chrome, to restore old position, just fire scroll event once, cause page 2 to be loaded. Not too bad.
        // IE doesn't try to restore.
        // Anyhow, we just force everyone goto 0. FF does goto 0 and does not loading page 2,
        // but you see scrollbar was initially at 0, then jumps to old position, then jumps back to 0.
        // Chrome still loads page 2.
        // IE no change.
        win.scrollTop(0);

        // Rarely, but just in case, there's only one page of pods from CLIP, don't show loading indicator.
        if (getPodCount(body) >= contextData.gallery.totalPods) {
            endReached = true;
            toggleLoadControls();
        }
    }

    /**
     * Some browser tries to restore previous scroll position at onload
     * See comments in onReady
     */
    function onLoad() {
        win.scrollTop(0);
    }
    /**
     * Everything in the return block below are public. Allow theme to override any of them.
     */
    return {
        load: load,
        handleMoreClick: handleMoreClick,
        handleLoadSuccess: handleLoadSuccess,

        /* Analytics */
        currPageNum: currPageNum,

        onReady: onReady,
        onLoad : onLoad
    }; // end of returning all public members

}(jQuery));

jQuery(document).ready(function () {
    APP_COUPONSINC.gallery.onReady();
});
jQuery(window).load(function () {
    APP_COUPONSINC.gallery.onLoad();
});
