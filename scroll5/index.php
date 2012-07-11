<?php
$start = empty($_GET["start"]) ? 21 : $_GET["start"];

function renderPod($index) {
    $i = $index;
    
    echo <<<HTML
<div class="pod">
    POD {$i}
</div>
HTML;
}
function renderPromo($index) {
    echo <<<HTML
<div class="promo-module">
    promo module {$index}
</div>
HTML;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Infinite Scroll</title>
    <link href="http://yui.yahooapis.com/combo?3.3.0/build/cssreset/reset-min.css&3.3.0/build/cssfonts/fonts-min.css" media="screen" rel="stylesheet" type="text/css" >

    <link href="layout.css" media="screen" rel="stylesheet" type="text/css" >

    <link href="common.css" media="screen" rel="stylesheet" type="text/css" >
    <link href="header.css" media="screen" rel="stylesheet" type="text/css" >
    <link href="couponcarrier.css" media="screen" rel="stylesheet" type="text/css" >
    <link href="gallery.css" media="screen" rel="stylesheet" type="text/css" >
    <link href="promo.css" media="screen" rel="stylesheet" type="text/css" >
</head>
<body>
    <div class="wrapper">
        <div id="header">
            <div class="mod-header fixed">
                <p>Full header with Tabs at first</p>
                <p>Scroll to see Mini Header and Carrier with Categories</p>
                <ul class="tabs horizontal-list">
                    <li><a href="#">COUPONS</a></li>
                    <li><a href="#">LOCAL COUPONS</a></li>
                    <li><a href="#">COUPON CODES</a></li>
                    <li><a href="#">MEMBER CENTER</a></li>
                    <li><a href="#">MORE</a></li>
                </ul>
                
            </div>
        </div> <!-- #header -->

        <div id="content">

            <div id="main">

                <div class="mod-titlebar">
                    Coupons: 165 FREE Printable Coupons for You!
                </div>

                <div class="mod-offeroftheweek">
                    <div class="pod media">
                        <img class="img" width="80" height="70" src="http://cdn.cpnscdn.com/static.coupons.com/images/cprimages/249/11249_1_prgId.gif" />
                        <p class="bd">$1.50 OFF ONE Pampers Cruisers Diapers</p>
                    </div>
                </div>

                <div class="mod-categories">
                    <ul class="horizontal-list">
                        <li class="column">
                            <ul>
                                <li><a href="#">Show All (165)</a></li>
                                <li><a href="#">Apparel (2)</a></li>
                                <li><a href="#">Baby & Toddler (10)</a></li>
                                <li><a href="#">Beverages (8)</a></li>
                            </ul>
                        </li>
                        <li class="column">
                            <ul>
                                <li><a href="#">Books & Magazines (2)</a></li>
                                <li><a href="#">Entertainment (8)</a></li>
                                <li><a href="#">Flowers & Gifts (3)</a></li>
                                <li><a href="#">Foods (30)</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="mod-couponcarrier">
                    <p class="titlebar">165 FREE coupons. Start clipping!</p>
                    <div class="categories">
                        <ul class="horizontal-list">
                            <li><a href="#">Household (30)</a></li>
                            <li><a href="#">Personal Care (32)</a></li>
                            <li><a href="#">Foods (30)</a></li>
                        </ul>
                        <a href="#">see all categories</a>
                    </div>
                    <button>Print Coupons</button>
                    <p>$6 saved! $347.00 of printable savings!</p>
                </div>

                <div class="mod-gallery">
                    <a name="top"></a>
                    <div class="pods">
<?php
for ($i = 0; $i < $start; $i++) {
    renderPod($i);
}
?>
                    </div> <!-- .pods -->
                    <div class="clearfix"></div>
                    <button class="more">See more...</button>
                    <a href="#top" class="goto-top stalker">Go to top</a>
                </div> <!--mod-gallery -->
            </div> <!-- #main -->

            <div id="rail">
<?php
for ($i = 0; $i < 3; $i++) {
    renderPromo($i);
}
?>
            </div> <!-- #rail -->

            <div class="clearfix"></div>
        </div> <!-- #content -->

        <div id="footer">
<?php include("footer.php") ?>
        </div>
    </div> <!--wrapper -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.js"></script>
<script>
    var APP = {};
</script>

<script src="data.js"></script>
<script src="layout.js"></script>
<script src="rail.js"></script>
<script src="header.js"></script>
<script src="couponcarrier.js"></script>
<script src="gallery.js"></script>
</body>
</html>


