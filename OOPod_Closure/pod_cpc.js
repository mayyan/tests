/**
 * Base class of CPC pod on all themes
 * Its parent is the themeless Pod class
 */
APP_COUPONSINC.PodCPC = APP_COUPONSINC.Pod.extend(function(podNode, podData) {
    // call the constructor of our base class
    this._super(podNode, podData);

    // Testing re-use function from parent class if child does not extend it.
    this.utility();

    function populate() {
        // re-use the parent class method of the same name in our context (this)
        this._super();

        var html = "<a href=\"{link_url}\">{link_text}</a>"
                .replace("{link_url}", this.data.link_url || "#")
                .replace("{link_text}", this.data.link_text || "blank");

        this.$(html).appendTo(podNode);
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
