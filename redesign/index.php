<!DOCTYPE html>
<html xmlns:fb="http://ogp.me/ns/fb#">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Site Redesign</title>
    <link media="screen" rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/combo?3.3.0/build/cssreset/reset-min.css&3.3.0/build/cssfonts/fonts-min.css">
    <link media="screen" rel="stylesheet" type="text/css" href="common.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="layout.css" >


    <link media="screen" rel="stylesheet" type="text/css" href="modules/header/header.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="modules/couponcarrier/couponcarrier.css">
    <link media="screen" rel="stylesheet" type="text/css" href="modules/categories/categories.css">

    <link media="screen" rel="stylesheet" type="text/css" href="modules/gallery/grid.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="modules/gallery/pod.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="modules/gallery/offeroftheweek.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="modules/gallery/supersaver.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="modules/gallery/gallery.css" >

    <link media="screen" rel="stylesheet" type="text/css" href="modules/ads/ads.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="modules/footer/footer.css" >
</head>
<body>
    <div class="wrapper">
        <div id="header">
            <?php include("modules/header/header.php"); ?>
        </div> <!-- #header -->

        <div id="content">

            <div id="main">

                <div class="mod-stalker">

                    <?php include("modules/couponcarrier/couponcarrier.php"); ?>

                    <?php include("modules/categories/categories.php"); ?>

                </div> <!-- .stalker -->

                <?php include("modules/gallery/gallery.php"); ?>

            </div> <!-- #main -->



            <div class="clearfix"></div>
        </div> <!-- #content -->

        <div id="footer">
            <?php include("modules/ads/leaderboard.php"); ?>

            <?php include("modules/footer/footer.php"); ?>
        </div>
    </div> <!--wrapper -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.js"></script>
<script>
    var APP_COUPONSINC = {};
    APP_COUPONSINC.contextData = {
        "gallery" : {
            "podsPerPage": 21,
            "totalPods": 298
        }
    };
</script>
<script src="layout.js"></script>
<script src="modules/categories/categories.js"></script>
<script src="modules/gallery/gallery.js"></script>
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


