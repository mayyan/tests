APP.layout = (function($) {
    var headerFullWidth = $(".mod-header.fixed").outerWidth(),
        headerFullHeight = $(".mod-header.fixed").outerHeight();

    function onReady() {
        $(".mod-header.fixed")
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