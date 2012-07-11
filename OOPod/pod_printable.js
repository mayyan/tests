APP_COUPONSINC.PodPrintable = function (pod, data) {
    APP_COUPONSINC.Pod(pod, data);

    this.populatePrintLimit
};

jQuery.extend(APP_COUPONSINC.PodPrintable.prototype, APP_COUPONSINC.Pod.prototype, (function ($) {

    function _populatePrintLimit() {
        var html = "<p>Print Limit: <span class=\"print-limit\">{printLimit}</span></p>"
                .replace("{printLimit}", this.data.printLimit);

        $(html).append(this.pod);
    }

    function populatePod() {
        this.populateCommon();

        populatePrintLimit()
    }

    return {
        populatePod: populatePod
    };

}(jQuery)));