<?php

$html = <<<HTML
<div class="player is-splash"
    data-key="$340144511253340"
    data-swf="flowplayer.swf"
    data-loop="false"
    data-advance="false"
    style="background:url('http://sjc-dev-usrv22.corp.coupons.com/wp-content/uploads/2013/04/Screen-Shot-2013-04-18-at-10.46.43-PM.png') no-repeat;">

    <video preload="auto">
        <source type="video/mp4" src="http://sjc-dev-usrv22.corp.coupons.com/wp-content/uploads/2013/04/small2.mp4">
    </video>

    <div class="carousel">
        <a class="prev">prev</a>
        <a class="next">next</a>
        <div class="viewport">
            <div class="fp-playlist" >
                <!-- playlist entries. "trigger" elements -->
                <a href="http://sjc-dev-usrv22.corp.coupons.com/wp-content/uploads/2013/04/small2.mp4" class="carousel-curr">
                    <img src="http://sjc-dev-usrv22.corp.coupons.com/wp-content/uploads/2013/04/Screen-Shot-2013-04-18-at-10.12.35-PM.png" />
                </a>
                <a href="http://stream.flowplayer.org/night1/640x360.mp4">
                    <img src="http://sjc-dev-usrv22.corp.coupons.com/wp-content/uploads/2013/04/PostcardImageGoodbyeSummerHelloFall1.png" />
                </a>
                <a href="http://stream.flowplayer.org/night5/640x360.mp4">
                    <img src="http://sjc-dev-usrv22.corp.coupons.com/wp-content/uploads/2013/04/300x2406.jpg"/>
                </a>
            </div>
        </div>
    </div>
</div>
HTML;
echo $html;
?>
