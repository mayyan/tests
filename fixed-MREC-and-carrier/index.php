<?php
$start = empty($_GET["start"]) ? 19 : $_GET["start"];

function renderPod($index) {
    $i = $index;

    echo <<<HTML
<div class="pod">
    POD {$i}
</div>
HTML;
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Fixed MREC and Carrier</title>
    <link href="http://yui.yahooapis.com/combo?3.3.0/build/cssreset/reset-min.css&3.3.0/build/cssfonts/fonts-min.css" media="screen" rel="stylesheet" type="text/css" >
    <link href="common.css" media="screen" rel="stylesheet" type="text/css" >
    <link href="layout.css" media="screen" rel="stylesheet" type="text/css" >
    <link href="modules.css" media="screen" rel="stylesheet" type="text/css" >

    <link href="layout.css" rel="stylesheet" type="text/css" >
    <!--Desktops and laptops,
        iPads (landscape) ----------->
    <link rel="stylesheet" href="large.css"
          media="only screen
            and (min-width : 970px),
          only screen
            and (min-device-width : 768px)
            and (max-device-width : 1024px)
            and (orientation : landscape)">

    <!--Medium
        iPads (portrait) ----------->
    <link rel="stylesheet"  href="medium.css"
          media="only screen
            and (min-width : 600px)
            and (max-width : 970px),
          only screen
            and (min-device-width : 768px)
            and (max-device-width : 1024px)
            and (orientation : portrait)">

    <!--Small,
        Smartphones (portrait and landscape)----------->
    <link rel="stylesheet"  href="small.css"
          media="only screen
            and (max-width : 600px),
          only screen
            and (min-device-width : 320px)
            and (max-device-width : 480px)">


</head>
<body>
    <div class="wrapper">
        <div id="header">
            <div class="mod-header">
                <ul class="tabs horizontal-list">
                    <li><a href="#">COUPONS</a></li>
                    <li><a href="#">CODES</a></li>
                    <li><a href="#">LOCAL DEALS</a></li>
                </ul>

            </div>
        </div> <!-- #header -->

        <div id="content">

            <div id="main">


                <div class="mod-hero">
                    Hero
                </div>

                <div class="mod-stalker">

                    <div class="mod-discoverybar">
                        <div class="mod-categories categories-show-teasers">
                            <div class="bd teasers">
                                <ul class="horizontal-list teaser-list">
                                    <li class="foods first"><a data-catid="107" href="/coupons/Foods-Coupons-107/?pid=16581&amp;nid=10&amp;zid=cp16">Foods (28)</a></li>
                                    <li class="beverages"><a data-catid="103" href="/coupons/Beverages-Coupons-103/?pid=16581&amp;nid=10&amp;zid=cp16">Beverages (1)</a></li>
                                    <li class="personal-care"><a data-catid="101" href="/coupons/Personal-Care-Coupons-101/?pid=16581&amp;nid=10&amp;zid=cp16">Personal Care (1)</a></li>
                                    <li class="personal-care"><a data-catid="101" href="/coupons/Personal-Care-Coupons-101/?pid=16581&amp;nid=10&amp;zid=cp16">Personal Care (1)</a></li>
                                    <li><a class="show-more">Other</a></li>
                                </ul>
                            </div>
                        </div>
                    </div> <!-- .mod-discoverybar -->


                    <div class="mod-couponcarrier">

                        <div class="cart">
                            <div class="progress  clipped-none">
                                <div class="value" style="left: -16px;"><span class="your-savings">START CLIPPING!</span><span class="triangle triangle-back"></span><span class="triangle triangle-front"></span></div>
                                <div class="bar">
                                    <div class="savings-bar" style="width: 6px;"></div>
                                    <h3 class="available">Available <span class="avail-value">$24.00</span></h3>
                                </div>
                            </div>
                        </div>
                        <button class="btn-cta mylist-button" type="button">My List</button>
                        <button class="btn-cta print-button  disabled" type="button">
                            <span class="title">Print Coupons</span><span class="number"></span>
                        </button>
                        <div class="selectall">
                            <input type="checkbox" id="couponsinc-gallery-selectall" class="selectall-chk">
                            <label for="couponsinc-gallery-selectall">Select All</label>
                        </div>
                    </div> <!-- .mod-couponcarrier -->

                    <div class="mod-ads mrec">
                        <iframe scrolling="no" frameborder="0" style="height:250px;width:300px" id="mrec" src="http://couponbar.coupons.com/adblob.asp?AdSize=300x250&amp;pzn=13306iq3710&amp;req=1346869750443&amp;zip=&amp;did=AMUAAREKS&amp;spage=.com/&amp;npage=1"></iframe>
                    </div>

                </div>

                <div class="mod-gallery">
                    <a name="top"></a>
                    <div class="pods">
                        <div class="spacer"></div>
<?php
for ($i = 0; $i < $start; $i++) {
    renderPod($i);
}
?>
                    </div> <!-- .pods -->
                    <div class="clearfix"></div>
                    <button class="more">See more...</button>
                    <a href="#top" class="goto-top">Go to top</a>
                </div> <!--mod-gallery -->
            </div> <!-- #main -->



            <div class="clearfix"></div>
        </div> <!-- #content -->

        <div id="footer">
            Footer
        </div>
    </div> <!--wrapper -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.js"></script>

<script>
    var APP_COUPONSINC = {};
</script>
<script src="layout.js"></script>
</body>
</html>


