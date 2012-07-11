(function() {
    var scripts = document.getElementsByTagName( 'script' ),
        thisScriptTag = scripts[ scripts.length - 1 ];

    function getScript(url, callback) {
        var body = document.getElementsByTagName("body")[0],
            script = document.createElement("script"),
            done = false;

        script.src = url;
        script.onload = script.onreadystatechange = function () {
            if (!done && (!this.readyState ||
                this.readyState === "loaded" || this.readyState === "complete")) {
                done = true;
                if (callback) {
                    callback();
                }
                script.onload = script.onreadystatechange = null;
            }
        };
        body.appendChild(script);
        return undefined;
    }
    
    function main($) {
        $(thisScriptTag).after($("<iframe />", {
            "src" : "http://vdevusvr06.corp.coupons.com/?pid=13953&nid=10&zid=jl94",
            "width" : 1048,
            "height" : 718,
            "frameborder" : 0
        }));
    }

    getScript("http://vdevusvr06.corp.coupons.com/layouts/js/jquery.min.js", function() {
        jQuery.noConflict();
        main(jQuery);
    });
}());