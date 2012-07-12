/**
 * Base class of CPC pod on all themes
 * Its parent is the themeless PodClass
 */
APP_COUPONSINC.PodCPCClass = APP_COUPONSINC.PodClass.extend(function(podDom, podData) {
    // call the constructor of our base class
    this._super(podDom, podData);

    // Testing re-use function from parent class if child does not extend it.
    this.utility();

    function populate() {
        // re-use the parent class method of the same name in our context (this)
        this._super();

        var html = "<p>Click Limit: <span class=\"click-limit\">{clickLimit}</span></p>"
                .replace("{clickLimit}", this.data.clickLimit);

        this.$(html).appendTo(podDom);
    }

    function handleClick(e) {
        // re-use parent class function of the same name
        this._super();
    }

    return {
      // overwriting the named method of APP_COUPONSINC_PodClass
      populate: populate,
      handleClick : handleClick
    };
});
