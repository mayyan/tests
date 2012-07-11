/* global APP:true, document:true, jQuery:true, setTimeout:true */
APP.loader = (function ($) {
    var browserKey = (function getBrowserKey() {
        var key = "default";
        if ($.browser.msie) {
            key = "IE " + $.browser.versionX;
        }
        return key;
    }());

    /**
     * Do not use jquery's $.getScript() which will add a cache-busting
     * timestamp. Note the cache attribute is set to true below.
     */
    function getScript(url, callback) {
        $.ajax({
            type: "GET",
            url: url,
            success: callback,
            dataType: "script",
            cache: true
        });
    }
    /**
     * Doesn't work. onreadystatechange or onload event isn't fired.
     */
    /*function getScript(url, callback) {
        var script = $("<script/>", {
            src : url,
            type: 'text/javascript'
        }).appendTo("body");

        script.onreadystatechange= function () {
            console.log("onreadystatechange");
            if (this.readyState == 'complete') {
                callback();
            }
        };
        script.onload = function () {
            console.log("onload");
            callback();
        };
    }*/

    function loadCSS(url) {
        /**
         * Watch for dangerous pitfall on IE 6-9.
         * http://blogs.msdn.com/b/ieinternals/archive/2011/05/14/internet-explorer-stylesheet-rule-selector-import-sheet-limit-maximum.aspx
         */
        if (document.createStyleSheet) { // for IE
            try {
                document.createStyleSheet(url);
            } catch (e) {}
        } else {
            $('<link/>', {
                rel: "stylesheet",
                type: "text/css",
                href: url}
            ).appendTo("head");
        }
    }

    /**
     * Load a list of JS assets in a recursive way.
     * Files are loaded in order they are listed in the js array.
     */
    function loadJS() {
        var deferredJS = APP.contextData.deferred.js,
            js_default = deferredJS["default"];

        getScript(js_default, function () {
            if (browserKey !== "default" && deferredJS[browserKey]) {
                getScript(deferredJS[browserKey], null);
            }
        });
    }

    function load() {
        var deferredCSS = APP.contextData.deferred.css,
            css_default = deferredCSS["default"];

        loadCSS(css_default);
        if (browserKey !== "default" && deferredCSS[browserKey]) {
            loadCSS(deferredCSS[browserKey]);
        }

        loadJS();

    }

    return {
        load: load
    };
}(jQuery));
