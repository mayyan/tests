/**
 * Class of CPC pod on walmart themes
 * Its parent is the themeless PodCPC class
 */
APP_COUPONSINC.PodCPC = APP_COUPONSINC.PodCPC.extend(function() {

    function handleClick(e) {
        // re-use parent class function of the same name
        // you don't have to call _super() if you don't want to re-use.
        this._super();

        // do something more
        alert("clicked a Walmart PodCPC, Clicked " + this.clickCount + " times. Id = " + this.data.podId + this.pod.html());
    }

    return {
      // overwriting the named method of APP_COUPONSINC_PodClass
      handleClick : handleClick
    };
}());