/**
 * Base class of printable pod on all themes
 */
APP_COUPONSINC.PodPrintableClass = APP_COUPONSINC.PodClass.extend(function(podDom, podData) {
    // call the constructor of our base class
    this._super(podDom, podData);

    // local reference to the global jQuery
    var $ = jQuery;

    // Testing re-use function from parent class if child does not extend it.
    this.utility();

    function populate() {
        // re-use the parent class method of the same name in our context (this)
        this._super();

        var html = "<p>Print Limit: <span class=\"print-limit\">{printLimit}</span></p>"
                .replace("{printLimit}", this.data.printLimit);

        $(html).appendTo(podDom);
    }

    function handleClick(e) {
        // re-use parent class function of the same name
        this._super();
    }

    return {
        // overwriting the name method of APP_COUPONSINC_PodClass
        populate: populate,
        handleClick : handleClick
    };
});
