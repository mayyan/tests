APP.couponcarier = (function($) {
    var body = $(".mod-couponcarrier"),
        fullWidth = body.outerWidth();

    function changeLayout(state) {
        console.log("couponcarier changeLayout state = " + state);

        if (state == "mini") {
            body.addClass("mini");

            body
                .css("width", fullWidth + "px")
                .css("top", $(".mod-header").outerHeight() + "px");
        } else {
            body.removeClass("mini");

            body
                .css("width", "auto")
                .css("top", "auto");
        }

        $(document).trigger("layoutChanged", {
            source: body,
            state: state
        });
    }
    
    function handleScroll() {
        /*console.log("couponcarier window.scrollTop = " + $(window).scrollTop() +
            ", couponcarier.offset.top =" + body.offset().top +
            ", header.outerHeight = " + $(".mod-header").outerHeight());*/
        
        if (!body.hasClass("mini") && $(window).scrollTop() >= $(".mod-header").outerHeight() + body.outerHeight()) {

                APP.header.changeLayout("mini");
                changeLayout("mini");

        }

        if (body.hasClass("mini") && $(window).scrollTop() < $(".mod-header").outerHeight() + body.outerHeight()) {

                APP.header.changeLayout("full");
                changeLayout("full");
            
        }

    }

    $(window).scroll(handleScroll);
}(jQuery));