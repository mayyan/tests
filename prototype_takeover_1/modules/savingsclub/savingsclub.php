<?php

function renderSavingsClub($size) {
    if ($size == ModuleSize_Super || $size == ModuleSize_Double || $size == ModuleSize_Grid) {
        $html = <<<HTML
<div class="mod-savingsclub promo size-{$size}">
    <div class="top">
        <div class="img">
            <a href="#"><img src="images/food.png" alt="Bagel-fuls&reg;"></a>
        </div>
    </div>
    <div class="bottom">
        <h4 class="typeline">GET 1 YEAR FREE</h4>
        <h5 class="headline">Join the Savings Club</h5>
        <p class="text">Get bigger, better savings, first dibs on offers.</p>
    </div>
</div>
HTML;
    } else if ($size == ModuleSize_ShortStack) {
        $html = <<<HTML
<div data-popup="0" data-inhouse="1" class="mod-ads container-620x115">
    <iframe scrolling="no" frameborder="0" style="height:115px;width:620px" src="//couponbar.coupons.com/adblob.asp?AdSize=620x115&amp;pzn=13306iq3710&amp;req=1357800645950&amp;zip=95014&amp;did=AMUAAREKS&amp;spage=.com/&amp;npage=1&amp;kvhouse=1&amp;kvss=0&amp;kvsc=0&amp;kvcb=0"></iframe>
</div>
HTML;
    } else {
        $html = "Unknown savingsclub size ($size)";
    }

    return $html;
}
?>
