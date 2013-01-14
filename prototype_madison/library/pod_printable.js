/*jslint sloppy: true, nomen:true */
/*global window:true, document:true, APP_COUPONSINC:true, jQuery:true */
/**
 * Class of printable pod
 * @property APP_COUPONSINC.PodPrintable
 * @type Object
 * @static
 */
APP_COUPONSINC.PodPrintable = APP_COUPONSINC.Pod.extend((function () {

    var $ = jQuery, // local reference to the global jQuery
        doc = $(document);

    /**
     * Populate Printable coupons pod
     * @param {Boolean} includeImage Whether to create <img> along populated pod texts
     */
    function populate(includeImage) {
        var data = this.data,
            pod  = this.pod,
            extra = $(".extra", pod);

        this._super(includeImage); //this will call the base class implementation of the same method

        extra.addClass("hidden");
        $(".clipbox", pod).attr("id", "couponsinc-gallery-clipbox-pod-" + data.podId);
        if ((typeof data.link_url === "string") && (data.link_url.length > 0)) {
            extra.removeClass("hidden");
            extra.attr("href", data.link_url);
            if (data.link_text === "") {
                extra.html(this.STR_PRODUCT_INFO);
            } else {
                extra.html(data.link_text);
            }

        }

        if (data.onCard === "1") {
            // Was added on a card, so not printable
            $(".text-only", pod).removeClass("hidden");
            pod.addClass("limited");
            $(".cta", pod).html(this.STR_ADD_TO_CARD);
        } else {
            if (data.printed === "1") {
                // print limit reached
                pod.addClass("limited");
                $(".text-with-share", pod).removeClass("hidden");
                $(".cta", pod).html(this.STR_PRINT_LIMIT_REACHED);
            } else {
                // printable
                pod.removeClass("limited");
                $(".clip-with-share", pod).removeClass("hidden");
                if (APP_COUPONSINC.clippedCouponStorage.find(data.podId) === true) {
                    pod.addClass("clipped");
                    $(".clipbox", pod).attr("checked", "checked");
                    $(".scissors", pod).html(this.STR_CLIPPED);
                } else {
                    pod.removeClass("clipped");
                    $(".clipbox", pod).removeAttr("checked");
                    $(".scissors", pod).html(this.STR_CLIP);
                }
            }
        }
    }

    /**
     * Event handler when click on a Coupon-type of pod
     * @param {Event} event The event obejct
     */
    function handleClick(event) {
        var data = this.data,
            pod  = this.pod,
            podDeferredObj = new APP_COUPONSINC.PodDeferred(this),

            target = $(event.target),
            clipBox = $(".clipbox", pod),
            scissors = $(".scissors", pod),
            podId = data.podId;

        if (target.hasClass("clipbox") && !clipBox.is(':checked')) {

            //broadcast event
            doc.trigger("couponsinc:unclipped", {
                source: "gallery",
                podIds: [podId]
            });

            // uncheck selectall
            $(".selectall-chk").removeAttr("checked");
            APP_COUPONSINC.cookie.setSelectAll(APP_COUPONSINC.contextData.controller, "0");

        } else if (target.hasClass("facebook-like") || target.parents(".facebook-like").length === 1) {

            event.preventDefault();
            podDeferredObj.openShareFlyout("facebook-like");

        } else if (target.hasClass("facebook-share") || target.parents(".facebook-share").length === 1) {

            event.preventDefault();
            podDeferredObj.openSharer("f");

        } else if (target.hasClass("twitter") || target.parents(".twitter").length === 1) {

            event.preventDefault();
            podDeferredObj.openSharer("t");

        } else if (target.hasClass("email") || target.parents(".email").length === 1) {

            event.preventDefault();
            podDeferredObj.openShareFlyout("email");
        } else if (target.hasClass("extra") && target.attr("href").indexOf("movie.flv") > 0) {
            event.preventDefault();
            // Clicked on .extra means "Watch this video again"
            podDeferredObj = new APP_COUPONSINC.PodVideoDeferred(this);
            podDeferredObj.openVideo();

        // if the target is restricted, don't clip it!
        } else if (!pod.hasClass('limited')) {
            /**
             * click anywhere not in ft, clips a coupon.
             * Click in clipbox that turns it as checked, clips a coupon.
             * Click on scissors if clipbox wasn't checked, clips a coupon
             */
            if ((!target.hasClass("ft") && target.parents(".ft").length === 0) ||
                    (target.hasClass("clipbox") && clipBox.is(':checked')) ||
                    (target.hasClass("scissors") && !clipBox.is(':checked'))) {

                //broadcast event
                doc.trigger("couponsinc:clipped", {
                    source: "gallery",
                    podIds: [podId]
                });
            }
        }
    }

    /**
     * Display a printable pod as clipped
     */
    function clipCoupon() {
        var pod = this.pod,
            clipBox = $(".clipbox", pod),
            scissors = $(".scissors", pod);

        // Update pod display to look like clipped
        pod.addClass("clipped");
        $(".ft", pod).children().addClass("hidden");
        $(".text-only", pod).addClass("hidden");
        $(".clip-with-share ", pod).removeClass("hidden");

        clipBox.attr('checked', true);
        scissors.html(this.STR_CLIPPED);
    }

    /**
     * Display a printable pod as unclipped
     */
    function unclipCoupon() {
        var pod = this.pod,
            clipBox = $(".clipbox", pod),
            scissors = $(".scissors", pod);

        // Update pod display to look like clipped
        pod.removeClass("clipped");
        $(".ft", pod).children().addClass("hidden");
        $(".text-only", pod).addClass("hidden");
        $(".clip-with-share ", pod).removeClass("hidden");

        clipBox.removeAttr('checked');
        scissors.html(this.STR_CLIP);

    }

    /**
     * Event handler that handles tha Clipped event triggered from a remote pod
     * also responds to the clip all
     */
    function handleClipped(event, data) {
        if ($.inArray(this.data.podId, data.podIds) >= 0) {
            clipCoupon.call(this);
        }
    }

    /**
     * Event handler that handles tha UNclip event triggered from a remote pod
     * also responds to the unclip all
     */
    function handleUnclipped(event, data) {
        if ($.inArray(this.data.podId, data.podIds) >= 0) {
            unclipCoupon.call(this);
        }
    }

    return {
        /**
         * Strings. Can be overriden by Theme
         */
        STR_PRINT_LIMIT_REACHED: "Print Limit Reached",
        STR_ADD_TO_CARD        : "+ Added To Card",
        STR_CLIPPED            : "Clipped",
        STR_CLIP               : "Clip",
        STR_PRODUCT_INFO       : "Product Info",
        STR_WATCH_THIS_VIDEO_AGAIN: "Watch this video again", /* after video been played, turn into printable, the .extra is this string */

        clipCoupon: clipCoupon,
        unclipCoupon: unclipCoupon,
        handleClipped: handleClipped,
        handleUnclipped: handleUnclipped,

        // overwriting the named method of APP_COUPONSINC_Pod
        populate: populate,
        handleClick: handleClick
    };
}()));
