/**
 * Class of CPC pod on bigblue themes
 */
APP_COUPONSINC.PodCPCClass = APP_COUPONSINC.PodClass.extend(function(podDom, podData) {
    // call the constructor of our base class
    this._super(podDom, podData);

    // local reference to the global jQuery
    var $ = jQuery;

    function handleClick(e) {
        // re-use parent class function of the same name
        this._super();

        // do something more
        alert("clicked a BigBlue PodCPCClass, Clicked " + this.clickCount + " times. Id = " + this.data.id + this.pod.html());
    }

    return {
      // overwriting the name method of APP_COUPONSINC_PodClass
      handleClick : handleClick
    };
});