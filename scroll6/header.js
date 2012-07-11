APP.header = (function($) {
    var body = $(".mod-header");

    function changeLayout(state) {

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