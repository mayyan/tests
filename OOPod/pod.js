APP_COUPONSINC.Pod = function (pod, data) {
    this.pod  = pod;
    this.data = data;

    this.populateCommon = function() {
        $("pod-type", this.pod).html(this.data.type);
        $("pod-id", this.pod).html(this.data.id)
    }
};
