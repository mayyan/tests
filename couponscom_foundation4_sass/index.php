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

    <!-- Foundation -->
    <link rel="stylesheet" href="stylesheets/app.css" />
    <link href="foundation_icons_all/foundation_icons_general/stylesheets/general_foundicons.css" rel="stylesheet" media="screen">
    <link href="foundation_icons_all/foundation_icons_social/stylesheets/social_foundicons.css" rel="stylesheet" media="screen">

    <!-- Global CSS -->
    <link href="stylesheets/helper.css" rel="stylesheet">
    <link href="stylesheets/layout.css" rel="stylesheet">

    <!-- Modules -->
    <link href="modules/hero/hero.css" rel="stylesheet">
    <link href="modules/pod/pod.css" rel="stylesheet">
    <link href="modules/offeroftheweek/offeroftheweek.css" rel="stylesheet">
    <link href="modules/misc/misc.css" rel="stylesheet">
    <link href="modules/footer/footer.css" rel="stylesheet">
    <link href="modules/bottomnav/bottomnav.css" rel="stylesheet">

    <script src="javascripts/vendor/custom.modernizr.js"></script>
</head>

<body>
<a name="top"></a>

<div class="row row-top">
    <?php include "modules/topnav/topnav.php" ?>
</div>

<div class="row row-hero">
    <div class="large-12 columns">
        <?php include "modules/hero/hero.php" ?>
    </div>
</div>

<div class="row row-content">
    <div class="large-12 columns">
        <?php include "modules/gallery/gallery.php" ?>
    </div>
</div>

<div class="row row-secondary-content">
    <div class="large-12 columns">
        <?php include "modules/misc/misc.php" ?>
    </div>
</div>

<!-- Footer -->

<footer>
    <?php include "modules/footer/footer.php" ?>
</footer>


<?php include "modules/bottomnav/bottomnav.php" ?>
<?php include "modules/tour/tour.php" ?>

<!-- Check for Zepto support, load jQuery if necessary -->
<script>
  document.write('<script src=javascripts/vendor/'
    + ('__proto__' in {} ? 'zepto' : 'jquery')
    + '.js><\/script>');
</script>
<script src="javascripts/foundation/foundation.js"></script>
<script src="javascripts/foundation/foundation.topbar.js"></script>
<script src="javascripts/foundation/foundation.orbit.js"></script>
<script src="javascripts/foundation/foundation.reveal.js"></script>
<script src="javascripts/foundation/foundation.joyride.js"></script>
<script>
    $(document)
        .foundation("reveal", {closeOnBackgroundClick: false})
        //.foundation("joyride", "start") //does not work with topbar
        .foundation("topbar")
        .foundation("orbit");
</script>
</body>
</html>