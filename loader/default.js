APP.default_js = (function ($) {
    var browserKey = (function getBrowserKey() {
        var key = "default";
        if ($.browser.msie) {
            key = "IE " + $.browser.versionX;
        }
        return key;
    }());

    var s = "Red block on " + $.browser.name + $.browser.versionX;
    if (browserKey !== "default") {
        s += "...Please use default browsers or IE8.";
    }
    $(".block").html(s);
}(jQuery));