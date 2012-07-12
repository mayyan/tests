/**
 * Class of printable pod on bigblue themes
 * Its parent is the themeless PodPrintable class
 */
APP_COUPONSINC.PodPrintable = APP_COUPONSINC.PodPrintable.extend(function(podDom, podData) {
    // call the constructor of our base class
    this._super(podDom, podData);

    function handleClick(e) {
        // re-use parent class function of the same name
        // you don't have to call _super() if you don't want to re-use.
        this._super();

        // do something more
        alert("clicked a Bigbue PodPrintable, Clicked " + this.clickCount + " times. Id = " + this.data.podId + this.pod.html());
    }

    return {
        // overwriting the named method of APP_COUPONSINC_PodClass
        handleClick : handleClick
    };
});
