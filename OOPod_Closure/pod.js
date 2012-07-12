/**
 * Base class of all pod types on all themes
 */
APP_COUPONSINC.Pod = CClass.create(function(podNode, podData) {
    //
    // private variables, accessible by child class
    //
    this.$ = jQuery; // local reference to the global jQuery
    this.pod = podNode;
    this.data = podData;
    this.clickCount = 0; // demo purpose

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

        var html = "<img src=\"{url}\" height=\"100\" width=\"80\" />"
                .replace("{url}", this.data.image.url);

        this.$(html).appendTo(this.pod);

        // attach new event handlers to the updated DOM
        this.bindEventHandlers();
    }

    function handleClick(e) {
        this.clickCount += 1;
    }

    // If you have utility functions that child class has no intention to override/extend,
    // You can define them here, and expose them in the return hash.
    function utility() {
        //console.log("utility");
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
