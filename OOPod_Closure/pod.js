/**
 * Base class of all pod types
 */
APP_COUPONSINC.PodClass = CClass.create(function(podDom, podData) {
    // local reference to the global jQuery
    var $ = jQuery;

    // private variables, accessible by child class
    this.pod = podDom;
    this.data = podData;
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
        $(".pod-type", this.pod).html(this.data.type);
        $(".pod-id", this.pod).html(this.data.id);

        // attach new event handlers to the updated DOM
        this.bindEventHandlers();
    }

    function handleClick(e) {
        this.clickCount += 1;
        alert("clicked a PodClass. Clicked " + this.clickCount + " times");
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
