/**
 * Base class of all pod types on all themes
 */
APP_COUPONSINC.PodClass = CClass.create(function(podDom, podData) {
    /****
     * private variables, accessible by child class
     ****/
    // local reference to the global jQuery
    this.$ = jQuery;
    this.pod = podDom;
    this.data = podData;
    // demo purpose
    this.clickCount = 0;

    function unbindEventHandlers() {
        this.pod.unbind("click");
    }

    function bindEventHandlers() {
        var that = this;

        this.pod.bind("click", function(e) {
            that.handleClick.call(that, e);
        });
    }

    function populate() {
        // remove event handlers that attached to the old pod DOM
        this.unbindEventHandlers();

        // DOM manipulation
        this.$(".pod-type", this.pod).html(this.data.type);
        this.$(".pod-id", this.pod).html(this.data.id);

        // attach new event handlers to the updated DOM
        this.bindEventHandlers();
    }

    function handleClick(e) {
        this.clickCount += 1;
    }

    // If you have helper functions that used by child class
    // You can define them here, and expose them in the return hash.
    function utility() {
        console.log("utility");
    }

    // The hash object which the constructor returns automatically becomes the public interface of the class/instance.
    return {
        bindEventHandlers: bindEventHandlers,
        unbindEventHandlers : unbindEventHandlers,
        populate: populate,
        handleClick : handleClick,
        utility : utility
    };
});
