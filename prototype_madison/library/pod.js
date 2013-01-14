/*jslint sloppy: true */
/*global window:true, document:true, APP_COUPONSINC:true, jQuery:true, PClass:true */
/**
 * Base class of all pod types
 * Unlike Module pattern we used in modules that tends to be static js library,
 * APP_COUPONSINC.Pod is a "class".
 * User of such class should use "new" operator to create an instance of the class,
 * before using its exposed public function.
 * @property APP_COUPONSINC.Pod
 * @type Object
 * @static
 */
APP_COUPONSINC.Pod = PClass.create((function ($) {
    var doc = $(document);

    function handleClipped(e, params) {
        //APP_COUPONSINC.log("pod.js: APP_COUPONSINC.Pod.handleClipped(): Using base class's handler. Should not be called.");
    }
    function handleUnclipped(e, params) {
        //APP_COUPONSINC.log("pod.js: APP_COUPONSINC.Pod.handleUnclipped(): Using base class's handler. Should not be called.");
    }

    /**
     * @constructor Contains the following member variables:
     *     .data : JSON
     *     .pod : jQuery Node
     * @param {Node} podNode jQuery object for the pod dom node
     * @param {Object} podData pod Data as JSON object
     */
    function init(podNode, podData) {
        this.data = podData;
        this.pod  = podNode;

        //Attache data to node's data-attribute
        this.pod.data("data", podData);
    }

    /**
     * Unbind all event handlers from a pod
     * Useful when reusing a pod node and its attribute or child element changed.
     * Or call this function before converting to another type of pod.
     * You'll need to unbind existing event handlers and later re-bind new event handlers.
     * Currently only "click" event is on pod.
     */
    function unbindEventHandlers() {
        if (this.pod) {
            this.pod.unbind("click");
        }
    }

    /**
     * Bind click events to a pod
     */
    function bindEventHandlers() {
        var that = this;
        // unbind any existing event handler before bind to new ones.
        this.unbindEventHandlers();
        if (this.pod) {
            this.pod.bind("click", function (e) {
                that.handleClick.call(that, e);
                that.trackingClick.call(that, e);
            });
        }

        doc.bind("couponsinc:clipped", function (e, params) {
            // inside this fucntion, "this" is doc
            // need to check pod is not null, it may be destoyed by gallery's handleUserInitialized
            if (that.pod) {
                that.handleClipped.call(that, e, params);
            }
        });

        doc.bind("couponsinc:unclipped", function (e, params) {
            // inside this fucntion, "this" is doc
            // need to check pod is not null, it may be destoyed by gallery's handleUserInitialized'
            if (that.pod) {
                that.handleUnclipped.call(that, e, params);
            }
        });
    }

    /**
     * Placeholder function.
     * Child class should override this.
     */
    function handleClick(e) {
        APP_COUPONSINC.log("APP_COUPONSINC.Pod.handleClick(): Using base class's handler. Should not be called.");
    }

    /**
     * Placeholder function for any actions that might be required for analytics
     * Should be overridden in type-specific pod JS
     */
    function trackingClick(e) {}

    /**
     * The logic to build the burst text is based on a couple of conditions.
     * Look at burstText field of pod data.
     * If not present, return { text: "SAVE", isText: true}
     * Else
     *     If burstText is a whole dollar, don't show dimes and cents.
     *     Else show dimes and cents.
     * @return {Object} An object of this format. The isText format is an indicator to tell caller
     * if the "text" field is money string, or not.
     * { text: $decimal-number, isText: false} or
     * { text: alphabetical string, isText: true}
     */
    function getFriendlyValue() {
        var data = this.data,
            burstText = data.burstText,
            isText = true,
            podVal;
        if (burstText.length === 0) {
            podVal = parseInt(data.value, 10);
            if (podVal !== 0) {
                isText = false;
                if (podVal >= 100) {
                    if (podVal / 100 === Math.round(podVal / 100)) {
                        // if devidable by 100, no need to show .00.
                        burstText = "$" + podVal / 100; //no decimal
                    } else {
                        burstText = "$" + (podVal / 100).toFixed(2); //2 decimals
                    }
                } else {
                    burstText = podVal + "&cent;";
                }
            } else {
                burstText = "SAVE";
                isText = true;
            }
        }
        return { text: burstText, isText: isText };
    }

    /**
     * Find the footer being displayed
     * Pod template prepares 3 varieties of footer of a pod.
     * Depending on pod type and state, only one footer is displayed.
     * This function is used to find the displayed footer.
     */
    function getPodVisibleFooter() {
        return $('.ft div', this.pod).not('.hidden');
    }

    /**
     * Update the new pod data in podCache as well as the data-attribute on pod node.
     * Update data object of the pod
     * @method updatePodData
     * @param {Object} data New set of data to update.
     */
    function updatePodData(data) {
        var podId = this.data.podId,
            newData = $.extend(true, APP_COUPONSINC.contextData.gallery.podCache[podId], data);

        this.data = newData;
        this.pod.data("data", newData);
    }

    /**
     * Populate pod Image
     * Pod images sometimes are not displayed until, for example, page sliding animation is complated.
     * Call this function if you need to control when to dislay pod image.
     */
    function populateImage() {
        var data = this.data,
            pod  = this.pod;
        $(".pod-image-container", pod).html('<img class="pod-image" src="' + data.image.url + '" width="80" height="100">'); //CPN-899
    }

    /**
     * To render a pod. This function renders common elements among all types of pods.
     * 1. start from a clean slate
     * 2. Perform common rendering
     * @param {Boolean} includeImage Whether to create <img> along populated pod texts
     */
    function populate(includeImage) {
        var data = this.data,
            pod  = this.pod,
            newPodCSS = this.POD_TYPE_CSS_MAP[data.type],
            burstText = data.burstText,
            offerNote = $(".offer-note", pod);

        pod.removeClass("hidden"); // could be hidden in prev page because of partial page

        // reset/clean up pod type css
        $.each(this.POD_TYPE_CSS_MAP, function (podType, cssClass) {
            pod.removeClass(cssClass);
        });
        pod.addClass(newPodCSS);

        // reset/clean up pod state css
        pod.removeClass("clipped")
            .removeClass("limited");

        burstText = this.getFriendlyValue().text;

        pod.attr("id", "couponsinc-gallery-POD" + data.podId);
        pod.data("podid", data.podId);
        if (includeImage) {
            this.populateImage(pod, data);
        }
        $(".offer-value", pod).html(data.summary);
        $(".offer-product", pod).html(data.brand);
        $(".offer-details", pod).html(data.details);
        $(".starburst", pod)
            .html(burstText)
            .attr("title", data.brand + " " + data.summary);

        // Seed has footers for all types. Hide them all for now.
        // Then show one of them depending on pod type.
        $(".ft", pod).children().addClass("hidden");
        $(".cta", pod).removeClass("sprite-pod");

        if (data.cclass === this.POD_CLASS.premium) {
            if (offerNote) {
                offerNote.html(APP_COUPONSINC.contextData.gallery.podNote);
                pod.addClass("premium");
            }
        } else {
            if (offerNote) {
                offerNote.html("");
                pod.removeClass('premium');
            }
        }

        //Re-bind event handlers.
        this.bindEventHandlers();
    }

    // The hash object which the constructor returns automatically becomes the public interface of the class/instance.
    return {
        /**
         * Pod classes
         */
        POD_CLASS : {
            "regular": 0,
            "premium": 1
        },

        /**
         * supported types for gallery
         */
        POD_TYPE_PRINTABLE                    : "0",
        POD_TYPE_DUET                         : "9",
        POD_TYPE_VIDEO                        : "13",
        POD_TYPE_CPC                          : "15",
        POD_TYPE_LOCAL                        : "23",
        POD_TYPE_SAVE_TO_CARD                 : "26",
        POD_TYPE_PRINTABLE_AND_SAVE_TO_CARD   : "27",
        POD_TYPE_RESTAURANT_DOT_COM           : "30",

        /**
        * Hash table for the CSS class for a given pod type
        * This is also a list of supported pod types.
        * @type Integer
        */
        POD_TYPE_CSS_MAP : {
            "0" : "coupon",
            "9" : "duet",
            "13": "video",
            "15": "cpc",
            "26": "coupon",
            "27": "coupon",
            "30": "cpc"
        },

        init: init,
        bindEventHandlers: bindEventHandlers,
        unbindEventHandlers : unbindEventHandlers,

        handleClick : handleClick,
        handleClipped: handleClipped,
        handleUnclipped: handleUnclipped,

        trackingClick: trackingClick,
        populate: populate,

        //Utility functions
        getFriendlyValue : getFriendlyValue,
        getPodVisibleFooter: getPodVisibleFooter,
        populateImage: populateImage,
        updatePodData: updatePodData
    };
}(jQuery)));
