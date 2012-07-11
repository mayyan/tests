APP.layout = (function($) {
    var headerFullWidth = $("#header").outerWidth(),
        headerFullHeight = $("#header").outerHeight();

    function onReady() {
        $("#header")
            .addClass("fixed")
            .css("width", headerFullWidth + "px");

        $("#main > div:first-child")
            .css("margin-top", headerFullHeight + "px");

        $("#rail div:first-child")
            .css("margin-top", headerFullHeight + "px");
    }

    $(document).ready(function() {
        onReady();
    });
}(jQuery));