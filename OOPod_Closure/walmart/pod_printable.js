APP_COUPONSINC.PodPrintableClass = APP_COUPONSINC.PodPrintableClass.extend(function(podDom, podData, jQ) {
    // call the constructor of our base class
    this._super(podDom, podData, jQ);

    // local reference to the global jQuery
    var $ = jQuery;

    // Testing re-use function from parent class if child does not extend it.
    this.utility();

    function populate() {
        // re-use the parent class method of the same name in our context (this)
        this._super();

        var html = "<p>Walmart Print Limit: <span class=\"print-limit\">{printLimit}</span></p>"
                .replace("{printLimit}", this.data.printLimit);

        $(html).appendTo(podDom);
    }

    function handleClick(e) {
        // re-use parent class function of the same name
        this._super();

        // do something more
        alert("clicked a Walmart PodPrintableClass, Clicked " + this.clickCount + " times. Id = " + this.data.id + this.pod.html());
    }

    return {
        // overwriting the name method of APP_COUPONSINC_PodClass
        populate: populate,
        handleClick : handleClick
    };
});
