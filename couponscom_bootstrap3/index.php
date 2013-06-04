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
    <link href="css/app.css" rel="stylesheet">
    <link href="modules/pod/pod.css" rel="stylesheet">
</head>

<body>
    <a name="top"></a>

    <!-- Wrap all page content here -->
    <div id="wrap">

        <?php include "modules/topnav/topnav.php" ?>

        <div class="container">
            <?php include "modules/gallery/gallery.php" ?>
        </div> <!-- .container -->

    </div> <!-- #wrap -->

    <div id="footer">
        <?php include "modules/bottomnav/bottomnav.php" ?>
    </div> <!-- #footer -->

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
<script src="js/app.js"></script>


</body>
</html>