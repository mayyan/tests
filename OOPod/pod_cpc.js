APP_COUPONSINC.PodCPC = function (pod, data) {
    APP_COUPONSINC.Pod(pod, data);
};

APP_COUPONSINC.PodCPC = jQuery.extend(APP_COUPONSINC.PodCPC.prototype, APP_COUPONSINC.Pod.prototype, (function ($) {

    function _populateClickLimit() {
        var html = "<p>Click Limit: <span class=\"click-limit\">{clickLimit}</span></p>"
                .replace("{clickLimit}", this.data.clickLimit);

        $(html).append(this.pod);
    }

    function populatePod() {
        this.populateCommon();

        populateClickLimit();
    }

    return {
        populatePod: populatePod
    };

}(jQuery)));