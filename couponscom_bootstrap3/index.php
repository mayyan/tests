<?php
include_once "modules/pod/pod.php";

// Preparing all data
$podJSON = file_get_contents("data/podCache.json");
$podCache = json_decode($podJSON, true);
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <title>Coupons.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
    
    <link href="css/common.css" rel="stylesheet">

    <link href="modules/topnav/topnav.css" rel="stylesheet">
    <link href="modules/hero/hero.css" rel="stylesheet">
    <link href="modules/pod/pod.css" rel="stylesheet">
    <link href="modules/gallery/gallery.css" rel="stylesheet">
    <link href="modules/misc/misc.css" rel="stylesheet">
    <link href="modules/bottomnav/bottomnav.css" rel="stylesheet">

    <script src="js/lib/modernizr.js"></script>

</head>

<body>
    <a name="top"></a>

    <!-- Wrap all page content here -->
    <div id="wrap">

        <?php include "modules/topnav/topnav.php" ?>

        <div class="container">
            <?php include "modules/hero/hero.php" ?>
            <?php include "modules/gallery/gallery.php" ?>

            
        </div> <!-- .container -->

    </div> <!-- #wrap -->

    <div id="footer">
        <?php include "modules/misc/misc.php" ?>

        <?php include "modules/bottomnav/bottomnav.php" ?>
    </div> <!-- #footer -->

<!--script src="js/lib/css3-mediaqueries.js"></script-->
<script data-main="js/app.js" src="js/require.js"></script>
</body>
</html>