APP.rail = (function($) {
    var rail = $("#rail"),
        marginTop = 0;
/*
    $(window).scroll(function () {
        var windowBottom = $(window).scrollTop() + $(window).height(),
            railBottom = rail.offset().top +  rail.outerHeight();

            console.log("windowBottom = " + windowBottom + ", railBottom = " + railBottom);
        if (windowBottom < railBottom) {
            marginTop = windowBottom - railBottom;
            rail.css("margin-top", marginTop + "px");
            console.log("margin-top="+ marginTop + "px")
        }
    });
*/
}(jQuery));