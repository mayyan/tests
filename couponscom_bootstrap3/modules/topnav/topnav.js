(function () {
    function positionNevbar() {
        var body = $("body"),
            navbar = $(".mod-top-navbar");

        if (Modernizr.mq('only screen and (max-width : 400px)')) {
            // Smartphones (landscape)
            // screen is too short to show the whole expanded nav, 
            // so better not to fixed to top
            navbar.removeClass("navbar-fixed-top"). addClass("navbar-static-top");
            body.css("padding-top", 0);
        } else {
            navbar.removeClass("navbar-static-top"). addClass("navbar-fixed-top");
            body.css("padding-top", "70px");
        }
    }

	$(window).resize(function () {
        positionNevbar();
    });

    $(window).load(function () {
        positionNevbar();
    });
}());