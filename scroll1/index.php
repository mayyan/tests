<?php
$start = empty($_GET["start"]) ? 15 : $_GET["start"];

function renderPod($index) {
    echo <<<HTML
<div class="pod">
    POD {$index}
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
    <title>Inifite Scroll 1 - One scrollbar</title>
    <link href="http://yui.yahooapis.com/combo?3.3.0/build/cssreset/reset-min.css&3.3.0/build/cssfonts/fonts-min.css" media="screen" rel="stylesheet" type="text/css" >

    <link href="layout.css" media="screen" rel="stylesheet" type="text/css" >

    <link href="main.css" media="screen" rel="stylesheet" type="text/css" >
</head>
<body>
    <div class="wrapper">
        <div id="header">Sticky header, Single scrollbar</div>

        <div id="content">

            <div id="main">
                <div class="mod-couponcarrier">coupon carrier</div>
                
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
                    <a href="#top" class="goto-top">Go back to top</a>
                </div>
            </div> <!-- #main -->

            <div id="rail">
<?php
for ($i = 0; $i < 5; $i++) {
    renderPromo($i);
}
?>
            </div>

            <div class="clearfix"></div>
        </div>

        <div id="footer">footer</div>
    </div> <!--wrapper -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.js"></script>
<script src="data.js"></script>
<script src="main.js"></script>
</body>
</html>


