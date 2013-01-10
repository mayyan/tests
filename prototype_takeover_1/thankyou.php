<?php
const APPLICATION_PATH = "./";

require_once(APPLICATION_PATH . "constants.php");
require_once(APPLICATION_PATH . "modules/header/header.php");
require_once(APPLICATION_PATH . "modules/printstatus/printstatus.php");
require_once(APPLICATION_PATH . "modules/gallery/gallery.php");
require_once(APPLICATION_PATH . "modules/misc/misc.php");
require_once(APPLICATION_PATH . "modules/ads/mrec.php");
require_once(APPLICATION_PATH . "modules/ads/supersaver.php");
require_once(APPLICATION_PATH . "modules/ads/leaderboard.php");
require_once(APPLICATION_PATH . "modules/footer/footer.php");

?>
<!DOCTYPE html>
<html xmlns:fb="http://ogp.me/ns/fb#">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Site Redesign - Madison Ave</title>
    <link media="screen" rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/combo?3.3.0/build/cssreset/reset-min.css&3.3.0/build/cssfonts/fonts-min.css">
    <link media="screen" rel="stylesheet" type="text/css" href="common.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="two-column-layout.css" >

    <link media="screen" rel="stylesheet" type="text/css" href="modules/header/header.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="modules/printstatus/thankyou.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="modules/misc/misc.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="modules/ads/ads.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="modules/footer/footer.css" >
</head>
<body>
    <div class="wrapper">
        <div class="shadow">
            <div id="header">
                <?php echo renderHeader() ?>
            </div> <!-- #header -->

            <div id="content">
                <div id="main">

                    <div class="printed-content">
                        <?php echo renderPostPrintStatus(); ?>

                        <?php echo renderPostPrintGallery(); ?>

                    </div>

                </div> <!-- #main -->

                <div id="rail">

                    <?php echo renderMREC(true); ?>

                    <?php echo renderSuperSaverAds(); ?>

                </div> <!-- #rail -->

                <div class="clearfix"></div>

                <?php echo renderLeaderBoardAds(); ?>

                <?php echo renderMisc(true); ?>
            </div> <!-- #content -->
        </div>

        <div id="footer">

            <?php echo renderFooter(); ?>
        </div>
    </div> <!--wrapper -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.js"></script>
<script src="jquery.ba-outside-events.min.js"></script>

<script>
    var APP_COUPONSINC = {};
    APP_COUPONSINC.contextData = {
        "gallery" : {
            "podsPerPage": 21,
            "totalPods": 298
        },
        "catid"  : "<?php echo $catid ?>",
        "config" : <?php echo $configIndex ?>
    };
</script>
<script src="modules/header/header.js"></script>
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


