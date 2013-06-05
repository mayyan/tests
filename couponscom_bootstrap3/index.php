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

    <script src="js/modernizr.js"></script>

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

<script src="js/jquery-1.9.1.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
<script src="js/app.js"></script>
<script src="modules/topnav/topnav.js"></script>
<script src="modules/hero/hero.js"></script>
<script src="modules/pod/pod.js"></script>
<script src="modules/gallery/gallery.js"></script>
<script src="modules/bottomnav/bottomnav.js"></script>
</body>
</html>