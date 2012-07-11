<!DOCTYPE html>
<html>
<head>
<link href="http://yui.yahooapis.com/combo?3.3.0/build/cssreset/reset-min.css&3.3.0/build/cssfonts/fonts-min.css" media="screen" rel="stylesheet" type="text/css" >
<link href="http://www.coupons.com/layouts/themes/bigblue/css/pod.css" rel="stylesheet" type="text/css" >
<link href="waterfall.css" rel="stylesheet" type="text/css" >
</head>

<body>
    <div class="background">
        <audio autoplay loop>
            <!--source src="http://themusicboyz.com/media/Hornpipe_In_D_Major_Water_Music_Recessional_.mp3" type="audio/mpeg" /-->
            <source src="http://www.jetcityorange.com/sounds/WestSeattleWaterfall.mp3" type="audio/mpeg" />
            Your browser does not support the audio element.
        </audio>
    </div>

    <!--button type="button" id="stopBtn">Stop</button-->

    <div class="pod-template hidden">
        <div class="pod" data-podId="{podId}">
            <div class="bd">
                <div class="pod-image-container">
                    {imageTag}
                </div>
                <h3 class="offer-value">{summary}</h3>
                <h4 class="offer-product">{brand}</h4>
                <p class="offer-details">{details}</p>
            </div>
        </div>
    </div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script src="waterfall.js"></script>
</body>
</html>