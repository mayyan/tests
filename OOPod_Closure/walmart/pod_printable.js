/**
 * Class of printable pod on walmart themes
 */
APP_COUPONSINC.PodPrintableClass = APP_COUPONSINC.PodPrintableClass.extend(function(podDom, podData, jQ) {
    // call the constructor of our base class
    this._super(podDom, podData, jQ);

    // local reference to the global jQuery
    var $ = jQuery;

    function handleClick(e) {
        // re-use parent class function of the same name
        this._super();

        // do something more
        alert("clicked a Walmart PodPrintableClass, Clicked " + this.clickCount + " times. Id = " + this.data.id + this.pod.html());
    }

    return {
        // overwriting the name method of APP_COUPONSINC_PodClass
        handleClick : handleClick
    };
});
