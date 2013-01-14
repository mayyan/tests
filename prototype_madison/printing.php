<?php
const APPLICATION_PATH = "./";

$catid  = empty($_GET["catid"]) ? "" : $_GET["catid"];

require_once(APPLICATION_PATH . "library/constants.php");
require_once(APPLICATION_PATH . "modules/header/header.php");
require_once(APPLICATION_PATH . "modules/printstatus/printstatus.php");
require_once(APPLICATION_PATH . "modules/footer/footer.php");

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Site Redesign - Madison Ave</title>
    <link media="screen" rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/combo?3.3.0/build/cssreset/reset-min.css&3.3.0/build/cssfonts/fonts-min.css">
    <link media="screen" rel="stylesheet" type="text/css" href="library/common.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="library/one-column-layout.css" >

    <link media="screen" rel="stylesheet" type="text/css" href="modules/header/header.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="modules/printstatus/printstatus.css" >
    <link media="screen" rel="stylesheet" type="text/css" href="modules/footer/footer.css" >
</head>
<body>
    <div class="wrapper">
        <div class="shadow">
            <div id="header">
                <?php echo renderHeader(false); // false = no nav?>
            </div> <!-- #header -->

            <div id="content">
                <div id="main">

                    <?php echo renderPrintStatus(); ?>

                </div> <!-- #main -->
                <div class="clearfix"></div>
            </div> <!-- #content -->
        </div>


        <div id="footer">
            <?php echo renderFooter(); ?>
        </div>
    </div> <!--wrapper -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.js"></script>
<script src="library/jquery.ba-outside-events.min.js"></script>

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
<script src="modules/printstatus/printstatus.js"></script>

</body>
</html>


