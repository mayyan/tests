<?php

function renderOfferOfTheWeek($size) {
    if ($size == ModuleSize_Super || $size == ModuleSize_Grid) {
        $html = <<<HTML
<div class="mod-offeroftheweek promo size-{$size}">
    <h3 class="badge txt-offscreen">Offer Of The Week</h3>
    <div class="top">
        <a href="#"><img src="images/food.png" alt="Bagel-fuls&reg;"></a>
    </div>
    <div class="bottom">
        <h4 class="typeline">SAVE $0.75</h4>
        <h5 class="headline">Bagel-fuls&reg;</h5>
        <p class="text">On any TWO (2) Bagel-fuls&reg; (4ct)</p>
    </div>
</div>
HTML;
    } else if ($size == ModuleSize_Double) {
        $html = <<<HTML
<div class="mod-offeroftheweek promo size-{$size}">
    <h3 class="badge txt-offscreen">Offer Of The Week</h3>
    <div class="top">
        <a href="#"><img src="images/food.png" alt="Bagel-fuls&reg;"></a>
    </div>
    <div class="bottom">
        <div class="left">
            <div class="img">
                <h4 class="typeline1">SAVE</h4>
                <h4 class="typeline2">$0.75</h4>
            </div>
        </div>
        <div class="right">
            <h5 class="headline">Bagel-fuls&reg;</h5>
            <p class="text">On any TWO (2) Bagel-fuls&reg; (4ct)</p>
        </div>
    </div>
</div>
HTML;
    } else if ($size == ModuleSize_ShortStack) {
        $html = <<<HTML
<div class="mod-offeroftheweek promo size-{$size}">
    <h3 class="badge txt-offscreen">Offer Of The Week</h3>
    <div class="left">
        <div class="img">
            <a href="#"><img src="images/food.png" alt="Bagel-fuls&reg;"></a>
        </div>
    </div>
    <div class="right">
        <h4 class="typeline">SAVE $0.75</h4>
        <h5 class="headline">Bagel-fuls&reg;</h5>
        <p class="text">On any TWO (2) Bagel-fuls&reg; (4ct)</p>
    </div>
</div>
HTML;
    } else {
        $html = "Unknown offeroftheweek size ($size)";
    }

    return $html;
}
?>
