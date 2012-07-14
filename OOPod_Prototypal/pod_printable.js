/**
 * Base class of printable pod on all themes
 * Its parent is the themeless Pod class
 */
APP_COUPONSINC.PodPrintable = APP_COUPONSINC.Pod.extend(function() {

    function populate() {
        // re-use the parent class method of the same name in our context (this)
        this._super();

        var html = "<p>{summary}</p>"
                .replace("{summary}", this.data.summary);

        this.$(html).appendTo(this.pod);
    }

    return {
        // overwriting the named method of APP_COUPONSINC_PodClass
        populate: populate
    };
}());
