/*jslint sloppy: true, nomen:true */
/*global window:true, document:true, APP_COUPONSINC:true, jQuery:true */
/**
 * Class of printable pod for Urban
 * @property APP_COUPONSINC.PodPrintable
 * @type Object
 * @static
 */
APP_COUPONSINC.PodPrintable = APP_COUPONSINC.PodPrintable.extend((function ($) {
    var promoTypes = []; //"category", "savingsclub", "supersaver"

    /**
     * @constructor Contains the following member variables:
     *     .data : JSON
     *     .pod : jQuery Node
     * @param {jQuery} podNode jQuery object for the pod dom node
     * @param {Object} podData pod Data as JSON object
     * @param {jQuery} customFlyoutInner Custom placeholder for this pod's flyout
     */
    function init(podNode, podData, customFlyoutInner) {
        this._super(podNode, podData);

        this.flyoutInner = (typeof customFlyoutInner === "undefined") ? $(".flyout-inner") : customFlyoutInner;
    }

    /**
     * Populates the pod
     */
    function populate() {
        var pod = this.pod;
        $('.left .pod-clipped-media p', pod).text(this.STR_CLIPPED);
        $('.hover .circle p.click-text', pod).text(this.STR_CLIP);
        $('.hover .circle p.click-text-sec', pod).remove();
    }

    /**
     * Event handler when click on a Coupon-type of pod
     * @param {Event} event The event obejct
     */
    function handleClick(event) {
        var pod = this.pod,
            target = $(event.target),
            podDeferredObj;

        if(target.is('.promo-button')) {
            handlePromoClick(event, this.data);
        }
        if(pod.hasClass('clipped') && (target.hasClass('unclip-action') || target.parent().hasClass('unclip-action'))) {
            handleClickUnclip.call(this);
            return;
        } else if (target.hasClass('info') || target.parent().hasClass('info')) {
            window.open(this.data.link_url);
        } else if (target.hasClass('share-box') || target.parent().hasClass('share-box')) {
            this.pod.removeClass('show-share show-more').addClass('show-share');
        } else if(target.hasClass('more-box') || target.parent().hasClass('more-box')) {
            this.pod.removeClass('show-share show-more').addClass('show-more');
        } else if(target.hasClass('facebook')){
            podDeferredObj = new APP_COUPONSINC.PodDeferred(this);
            event.preventDefault();
            podDeferredObj.openSharer("f");
        } else if(target.hasClass('twitter')){
            podDeferredObj = new APP_COUPONSINC.PodDeferred(this);
            event.preventDefault();
            podDeferredObj.openSharer("t");
        } else if(target.hasClass('email')){
            podDeferredObj = new APP_COUPONSINC.PodDeferred(this);
            event.preventDefault();
            podDeferredObj.openShareFlyout("email");
        } else if(!pod.hasClass('clipped') && !pod.hasClass('limited')){
            clipCoupon.call(this);
            //broadcast event
            $(document).trigger("couponsinc:clipped", {
                podIds: [this.data.podId],
                podObjects: [this]
            });
        }

    }

    function handleMouseout(event) {
        this.pod.removeClass('show-more show-share');
    }

    /**
     *Function that actually clips the coupon and changes the UI
     */
    function clipCoupon(){
        var pod = this.pod;
        // If coupons reach limit reach, we should not change UI at all
        if (pod.hasClass('limited')) {
            return;
        }

        if (!pod.hasClass('clipped')) {
            //pod.addClass('clipped');
            $('.hover', pod).css('display', 'block')
               .fadeTo(250, 0, function(){
                        pod.addClass('clipped');
                        $(this).css({opacity: '', display: '', filter: ''});
            });

            // Set up what level of promotions will the user see.
            promoTypes = [];
            if(pod.hasClass('offeroftheweek-pod')) {
                promoTypes.push('category');
            } else {
                //promoTypes.push("category");
                if (APP_COUPONSINC.contextData.User.SuperSaver === 0) {
                    promoTypes.push("supersaver");
                }
                if (APP_COUPONSINC.contextData.User.SavingsClub === 0) {
                    promoTypes.push("savingsclub");
                }
                promoTypes.push("category");
            }

            var selectedPromoNumber = Math.abs(APP_COUPONSINC.PodPrintable.prototype.counter % promoTypes.length);
            var selectedPromoType = promoTypes[selectedPromoNumber];

            /*$('.more-container', pod).html(APP_COUPONSINC.contextData.gallery.promotemplates[selectedPromoType]);*/
            $('.more-container .category-promo h4 span', pod).text(this.data.catdesc1);
            APP_COUPONSINC.PodPrintable.prototype.counter++;
        }

    }

    /**
     * Function that handles the UI change needed for unclipping a coupon
     */
    function unclipCoupon(all_unclip) {
        var pod = this.pod;

        if(pod.hasClass('clipped')) {
            if(all_unclip === true) {
                pod.removeClass('clipped');
            } else {
                pod.removeClass('clipped');
                $('.hover', pod).animate(
                    {
                        opacity: 1
                    }, 500,  function(){
                        $(this).css('opacity', '');
                    }
                );
            }


        }
    }

    /**
     * Event handler to handle the unclip event
     */
    function handleClickUnclip() {
        unclipCoupon.call(this);
        //broadcast event
        $(document).trigger("couponsinc:unclipped", {
            podIds: [this.data.podId],
            podObjects: [this]
        });
    }

    /**
     * Handler that handles what promos were clicked
     */
    function handlePromoClick(event, data) {
        var target = $(event.target);
        if($(target).is('.category-promo-btn')) {
            var link = '/coupons/'+ (data.catdesc1).replace(' ', '-') + '-Coupons-'+ (data.catlevel1) + '/';
            if (APP_COUPONSINC.getURLParameter("pid") !== "") { // maintain pnz in URL
                var cd = APP_COUPONSINC.contextData,
                    pnz = "pid="+cd.pid+"&nid="+cd.nid+"&zid="+cd.zid;
                link = link + "?" + pnz;
            }
            window.location.href = link;
        } else if($(target).is('.supersaver-promo-btn')) {
            APP_COUPONSINC.emailsignup.handleopenPopup();
        } else if($(target).is('.savingsclub-promo-btn')) {
            APP_COUPONSINC.couponcaddy.handleOpenFlyout();
        }
    }

    /**
     * Event handler that handles tha Clipped event triggered from a remote pod
     * also responds to the clip all
     */
    function handleClipped(event, data) {
        var pod = this.pod;
        if(data.all === true) {
            clipCoupon.call(this);
        } else if(typeof data.podObjects != 'undefined' && pod === data.podObjects[0].pod) {
            return;
        } else if(data.podIds.length > 1) {
           for(cnt = 0, len = data.podIds.length; cnt < len; cnt++) {
               if(this.data.podId == data.podIds[cnt]) {
                   clipCoupon.call(this);
                   return;
               }
           }
        } else if(this.data.podId == data.podObjects[0].data.podId){
            clipCoupon.call(this);
        }
    }

    /**
     * Event handler that handles tha UNclip event triggered from a remote pod
     * also responds to the unclip all
     */
    function handleUnclipped(event, data) {
        var pod = this.pod;
        if(data.all === true) {
            unclipCoupon.call(this, data.all); // Second parameter defined all=true
        } else if(pod[0] === data.podObjects[0].pod[0]) {
            return;
        } else if(this.data.podId == data.podObjects[0].data.podId){
            unclipCoupon.call(this);
        }
    }

    /**
     * Does some basic Pod setup. Like zero out the counter
     */
    function onReady() {
        APP_COUPONSINC.PodPrintable.prototype.counter = 0;
    }

    return {
        init: init,
        populate: populate,
        handleClick: handleClick,
        handleMouseout: handleMouseout,
        handleClipped: handleClipped,
        handleUnclipped: handleUnclipped,
        STR_PRINT_LIMIT_REACHED: "Print Limit Reached",
        STR_ADD_TO_CARD: "+ Added To Card",
        STR_CLIPPED: "ready to print",
        STR_CLIP: "Clip Coupon",
        STR_PRODUCT_INFO: "Product Info",
        clipCoupon: clipCoupon,
        onReady: onReady
    };
}(jQuery)));

jQuery(document).ready(function(){
    APP_COUPONSINC.PodPrintable.prototype.onReady();
});
