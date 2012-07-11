APP.header = (function($) {
    var body = $(".mod-header");

    function changeLayout(state) {
        //console.log("window.scrollTop = " + $(window).scrollTop() + ", header outerHeight = " + body.outerHeight());

        if (state == "mini") {
            
            body.addClass("mini");

        } else {
        
            body.removeClass("mini");

        }
    }
    
    return {
        changeLayout : changeLayout
    };
}(jQuery));