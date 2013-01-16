<?php

function renderLeaderBoardAds() {
    global $Config;
    global $configIndex;

    $html = '';

    if ($Config["TakeOver"] == 1) {
        $html .=<<<HTML
<div data-popup="0" data-inhouse="0" class="mod-ads container-728x90">
    <a href="brand.php?config={$configIndex}"><img width="728" hight="90" src="images/leaderboard.jpg"></a>
</div>
HTML;

    } else {

        $html .=<<<HTML
<div data-popup="0" data-inhouse="0" class="mod-ads container-728x90">
    <iframe scrolling="no" frameborder="0" style="height:90px;width:728px" src="//couponbar.coupons.com/adblob.asp?AdSize=728x90&amp;pzn=13306iq3710&amp;req=1357805013855&amp;zip=95014&amp;did=AMUAAREKS&amp;spage=.com/&amp;npage=1&amp;kvhouse=0&amp;kvss=0&amp;kvsc=0&amp;kvcb=0"></iframe>
</div>
HTML;
    }

    return $html;
}

