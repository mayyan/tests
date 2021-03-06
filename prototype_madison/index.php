<?php
const APPLICATION_PATH = "./";

$offset = empty($_GET["offset"]) ? 0 : $_GET["offset"];
$action = empty($_GET["action"]) ? "" : $_GET["action"];
$catid  = empty($_GET["catid"]) ? "" : $_GET["catid"];

require_once(APPLICATION_PATH . "library/constants.php");
require_once(APPLICATION_PATH . "modules/header/header.php");
require_once(APPLICATION_PATH . "modules/stalker/stalker.php");
require_once(APPLICATION_PATH . "modules/hero/hero.php");
require_once(APPLICATION_PATH . "modules/gallery/gallery.php");
require_once(APPLICATION_PATH . "modules/featuredtoday/featuredtoday.php");
require_once(APPLICATION_PATH . "modules/misc/misc.php");
require_once(APPLICATION_PATH . "modules/footer/footer.php");


if ($action == "paginate") {
    $html = renderGalleryPage(false);
    echo $html;
    return;
} else if ($action == "featuredtoday") {
    $html = renderFeaturedTodayDialog();
    echo $html;
    return;
}

?>
<!DOCTYPE html>
<html xmlns:fb="http://ogp.me/ns/fb#">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Site Redesign - Madison Ave</title>
    <link media="screen" rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/combo?3.3.0/build/cssreset/reset-min.css&3.3.0/build/cssfonts/fonts-min.css">
    <link media="screen" rel="stylesheet" type="text/css" href="library/common.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="library/one-column-layout.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="library/promo.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="library/menu.css" >




    <link media="screen" rel="stylesheet" type="text/css" href="modules/header/header.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="modules/leavebehind/leavebehind.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="modules/hero/hero.css" >

    <link media="screen" rel="stylesheet" type="text/css" href="modules/stalker/animate.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="modules/stalker/stalker.css" >

    <link media="screen" rel="stylesheet" type="text/css" href="modules/sitenav/sitenav.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="modules/categories/categories.css">
    <link media="screen" rel="stylesheet" type="text/css" href="modules/sortcontrol/sortcontrol.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="modules/couponcarrier/couponcarrier.css">
    <link media="screen" rel="stylesheet" type="text/css" href="modules/printcontrol/printcontrol.css">

    <link media="screen" rel="stylesheet" type="text/css" href="modules/gallery/grid.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="modules/gallery/pod.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="modules/offeroftheweek/offeroftheweek.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="modules/featuredtoday/featuredtoday.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="modules/supersaver/supersaver.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="modules/gallery/gallery.css" >

    <link media="screen" rel="stylesheet" type="text/css" href="modules/misc/misc.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="modules/ads/ads.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="modules/footer/footer.css" >

    <link media="screen" rel="stylesheet" type="text/css" href="modules/featuredtoday/featuredtoday_dialog.css" >
</head>
<body>

    <div id="header">
        <?php echo renderHeader() ?>

        <?php echo renderHero(); ?>

    </div> <!-- #header -->

    <div class="wrapper">
        
        <?php echo renderStalker(); ?>

        <div id="content">

            <div id="main">


                <?php echo renderGallery(); ?>

            </div> <!-- #main -->

            <div class="clearfix"></div>
        </div> <!-- #content -->
    </div> <!--wrapper -->

    <div id="footer">
        <?php echo renderMisc(); ?>
        <?php echo renderFooter(); ?>
    </div>

    <div class="flyout-inner hidden"></div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.js"></script>
<script src="library/jquery.ba-outside-events.min.js"></script>
<script>
    var APP_COUPONSINC = {};
    APP_COUPONSINC.contextData = {
        "User":{"IsLoggedIn":0,"DetectedZip":"94043","SuperSaver":0,"SavingsClub":0,"CouponClubMember":{"Status":0,"Newsletter":0,"ExpDate":"01\/01\/1900"}},
        "gallery" : {
            "podsPerPage": 21,
            "totalPods": 265,
            "podCache": <?php echo renderPodCacheOnPage(0); ?>
        },
        "catid"  : "<?php echo $catid ?>",
        "config" : <?php echo $configIndex ?>
    };
</script>
<script src="library/layout.js"></script>
<script src="library/classHelper.js"></script>
<script src="library/pod.js"></script>
<script src="library/pod_urban.js"></script>
<script src="library/pod_printable.js"></script>
<script src="library/pod_printable_urban.js"></script>
<script src="modules/header/header.js"></script>
<script src="modules/hero/hero.js"></script>
<!--script src="modules/leavebehind/leavebehind.js"></script-->
<script src="modules/printcontrol/printcontrol.js"></script>
<script src="modules/gallery/gallery.js"></script>
<script src="modules/featuredtoday/featuredtoday.js"></script>
<script src="modules/ads/ads.js"></script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
</body>
</html>


