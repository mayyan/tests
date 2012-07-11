APP_COUPONSINC.assetmanager = (function ($) {
    /**
     * Array of defer-loaded css and js.
     */
    var loadedAssets = {"css" : [], "js" : []};

    /**
     * Check to see if a CSS or an JS is already loaded.
     * @param {String} type Asset type, "css" or "js"
     * @param {String} asset URL to an asset
     */
    function isAssetLoaded (type, asset) {
        return jQuery.inArray(asset, loadedAssets[type]) >= 0;
    }

    /**
     * Load one CSS
     * @param {String} asset URL to an asset
     */
    function loadCSS (asset) {
        if (!isAssetLoaded("css", asset)) {
            if (document.createStyleSheet) { // for IE
                try {
                    document.createStyleSheet(asset);
                } catch (e) {}
            } else {
                jQuery('<link rel="stylesheet" type="text/css" href="' + asset + '">').appendTo("head");
            }
            loadedAssets.css.push(asset);
        }
    }

    /**
     * Load a list of CSS assets
     * @param {Array} assets An array of URLs to CSS
     */
    function loadCSSAssets (assets) {
        var index,
            total;

        if (typeof assets === "string") {

            loadCSS(assets);

        } else if ($.isArray(assets)) {

            total = assets.length;

            for (index = 0; index < total; index += 1) {
                loadCSS(assets[index]);
            }

        }
    }

    /**
     * Load a list of JS assets in a recursive way.
     * Files are loaded in order they are listed inthe assets array.
     * @param {Array} assets An array of URLs to JS
     * @param {Integer} index Index to which item in the assets array to load
     * @param {Function} callback Callback function when all JS are loaded.
     */
    function loadJS(assets, index, callback) {
        var asset = assets[index],
            total = assets.length;

        if (!isAssetLoaded("js", asset)) {
            jQuery.getScript(asset, function () {
                loadedAssets.js.push(asset);

                loadNextJS(assets, index, callback);
            });
        } else {
            loadNextJS(assets, index, callback);
        }
    }

    /**
     * Load the next JS in the list
     * If already at the end, call the callback function.
     * @param {Array} assets An array of URLs to JS
     * @param {Integer} index Index to which item in the assets array has been loaded.
     * @param {Function} callback Callback function when all JS are loaded.
     */
    function loadNextJS (assets, index, callback) {
        var total = assets.length;

        if (index === total - 1) {
            callback.call(this);
            return;
        } else {
            loadJS(assets, index + 1, callback);
        }
    }

    /**
     * Load JS dynamically
     */
    function getJS(assets, callback) {
        loadJS(assets, 0, callback);
    }

    /**
     * Load CSS dynamically
     */
    function getCSS (cssList) {
        var version = parseInt(jQuery.browser.version, 10);


        loadCSSAssets(cssList.all);

        if ($.browser.msie && cssList["ie" + version]) {
            loadCSSAssets(cssList[version]);
        }
    }

    return {
        getCSS : getCSS,
        getJS : getJS
    };

}(jQuery));

