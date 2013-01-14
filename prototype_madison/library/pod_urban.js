/*jslint sloppy: true, nomen:true */
/*global window:true, document:true, APP_COUPONSINC:true, jQuery:true */
/**
 * Class of printable pod for Walmart
 * @property APP_COUPONSINC.PodPrintable
 * @type Object
 * @static
 */
APP_COUPONSINC.Pod = APP_COUPONSINC.Pod.extend((function ($) {
    var doc = $(document);

    function handleClipped(e, params) {
        //APP_COUPONSINC.log("pod_urban.js: APP_COUPONSINC.Pod.handleClipped(): Using base class's handler. Should not be called.");
    }
    function handleUnclipped(e, params) {
        //APP_COUPONSINC.log("pod_urban.js: APP_COUPONSINC.Pod.handleUnclipped(): Using base class's handler. Should not be called.");
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
        // do not unbind couponsinc:clipped and couponsinc:unclipped events, because that are at document level
    }

    /**
     * Bind click events to a pod
     */
    function bindEventHandlers() {
        var that = this;
        // unbind any existing event handler before bind to new ones.
        this.unbindEventHandlers();

        if (this.pod) {
            // Bind the click evene when  user clicks on the Pod
            this.pod.bind("click", function (e) {
                that.handleClick.call(that, e);
                that.trackingClick.call(that, e);
            });
            // event when the user Mouse's out of a pod.
            this.pod.bind("mouseleave", function(e) {
                if(typeof that.handleMouseout != 'undefined') {
                    that.handleMouseout.call(that, e);
                }

            })
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
     * Update the new pod data in podCache as well as the data-attribute on pod node.
     * Update data object of the pod
     * @method updatePodData
     * @param {Object} data New set of data to update.
     */
    function updatePodData(data) {
        var podId = this.data.podId,
            newData = $.extend(this.data, data);

        this.data = newData;
        this.pod.data("data", newData);
    }

    /*
     * Placeholder function for any actions that might be required for analytics
     * Should be overridden in type-specific pod JS
     */
    function trackingClick(e)  { };

    return {
        unbindEventHandlers: unbindEventHandlers,
        bindEventHandlers: bindEventHandlers,

        handleClipped: handleClipped,
        handleUnclipped: handleUnclipped,
        trackingClick: trackingClick,
        updatePodData: updatePodData
    };
}(jQuery)));

