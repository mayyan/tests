<?php
const APPLICATION_PATH = "./";

require_once(APPLICATION_PATH . "constants.php");
require_once(APPLICATION_PATH . "modules/header/header.php");
require_once(APPLICATION_PATH . "modules/stalker/stalker.php");
require_once(APPLICATION_PATH . "modules/gallery/gallery.php");
require_once(APPLICATION_PATH . "modules/footer/footer.php");

$offset = empty($_GET["offset"]) ? 0 : $_GET["offset"];
$action = empty($_GET["action"]) ? "" : $_GET["action"];

if ($action == "paginate") {
    $html = renderGalleryPage(false);
    echo $html;
    return;
}

?>
<!DOCTYPE html>
<html xmlns:fb="http://ogp.me/ns/fb#">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Site Redesign</title>
    <link media="screen" rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/combo?3.3.0/build/cssreset/reset-min.css&3.3.0/build/cssfonts/fonts-min.css">
    <link media="screen" rel="stylesheet" type="text/css" href="common.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="layout.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="promo.css" >


    <link media="screen" rel="stylesheet" type="text/css" href="modules/header/header.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="modules/couponcarrier/couponcarrier.css">
    <link media="screen" rel="stylesheet" type="text/css" href="modules/categories/categories.css">
    <link media="screen" rel="stylesheet" type="text/css" href="modules/stalker/stalker.css" >

    <link media="screen" rel="stylesheet" type="text/css" href="modules/gallery/grid.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="modules/gallery/pod.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="modules/offeroftheweek/offeroftheweek.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="modules/supersaver/supersaver.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="modules/gallery/gallery.css" >

    <link media="screen" rel="stylesheet" type="text/css" href="modules/ads/ads.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="modules/footer/footer.css" >
</head>
<body>
    <div class="wrapper">
        <div id="header">
            <?php echo renderHeader() ?>
        </div> <!-- #header -->

        <div id="content">

            <div id="main">

                <?php echo renderStalker(); ?>

                <?php echo renderGallery(); ?>

            </div> <!-- #main -->



            <div class="clearfix"></div>
        </div> <!-- #content -->

        <div id="footer">
            <?php include("modules/ads/leaderboard.php"); ?>

            <?php echo renderFooter(); ?>
        </div>
    </div> <!--wrapper -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.js"></script>
<script src="jquery.ba-outside-events.min.js"></script>
<script>
    var APP_COUPONSINC = {};
    APP_COUPONSINC.contextData = {
        "gallery" : {
            "podsPerPage": 21,
            "totalPods": 298
        },
        "config" : <?php echo $configIndex ?>
    };
</script>
<script src="layout.js"></script>
<script src="modules/header/header.js"></script>
<script src="modules/categories/categories.js"></script>
<script src="modules/gallery/gallery.js"></script>
<script src="modules/ads/ads.js"></script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
</body>
</html>


