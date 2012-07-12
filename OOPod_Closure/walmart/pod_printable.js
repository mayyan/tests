/**
 * Class of printable pod on walmart themes
 * Its parent is the themeless PodPrintableClass
 */
APP_COUPONSINC.PodPrintableClass = APP_COUPONSINC.PodPrintableClass.extend(function(podDom, podData) {
    // call the constructor of our base class
    this._super(podDom, podData);

    function handleClick(e) {
        // re-use parent class function of the same name
        // you don't have to call _super() if you don't want to re-use.
        this._super();

        // do something more
        alert("clicked a Walmart PodPrintableClass, Clicked " + this.clickCount + " times. Id = " + this.data.id + this.pod.html());
    }

    return {
        // overwriting the name method of APP_COUPONSINC_PodClass
        handleClick : handleClick
    };
});
