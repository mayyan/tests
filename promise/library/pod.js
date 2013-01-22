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

    function unbindEventHandlers() {
        if (this.pod) {
            this.pod.unbind("click");
        }
    }

    function bindEventHandlers() {
    	var that = this;
        // unbind any existing event handler before bind to new ones.
        this.unbindEventHandlers();
        if (this.pod) {
            this.pod.bind("click", function (e) {
                that.handleClick.call(that, e);
            });
        }
    }

    return {
    	init: init,
    	bindEventHandlers: bindEventHandlers,
    	unbindEventHandlers: unbindEventHandlers
    };

}(jQuery)));