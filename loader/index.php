<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

</head>

<body>
<p>This page initially has "I'm a testing block." on white.</p>
<p>On default browsers, defer loaded css sets it to red background and deferred js alter the string.</p>
<p>On IE 8, we made sure all default css/js are loaded before ie-condictional-and-deferred css/js. ie css overrides default css, set it to green background, and ie js alter the text further.</p>

    <div class="block">
        I'm a testing block.
    </div>

<script src="jquery.min.js"></script>
<script src="jquery.browser.min.js"></script>
<script>
jQuery.noConflict();
var APP = {};
</script>
<script src="loader.js"></script>
<script>
APP.contextData = {

    deferred: {
        css: {
            "default": "default.css",
            "IE 8": "ie8.css"
        },
        js: {
            "default": "default.js",
            "IE 8": "ie8.js"
        }
    }
};
var LOAD_AT_READY  = 1,
    LOAD_AT_ONLOAD = 2,
    LOAD_BY_TIMER  = 3;

var loadMethod = <?php echo $_GET["m"] ?>;

switch (loadMethod) {
case LOAD_AT_READY:
    jQuery(document).ready(function () {
        APP.loader.load();
    });
    break;
case LOAD_AT_ONLOAD:
    jQuery(window).load(function () {
        APP.loader.load();
    });
    break;
case LOAD_BY_TIMER:
    setTimeout(function(){
        APP.loader.load();
    }, 0);
}
</script>
</body>
</html>
