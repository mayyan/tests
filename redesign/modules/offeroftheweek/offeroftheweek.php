<?php

function renderOfferOfTheWeek($size) {
    if ($size == ModuleSize_Square || $size == ModuleSize_Big || $size == ModuleSize_Grid) {
        $html = <<<HTML
<div class="mod-offeroftheweek size-{$size}">
    <div class="img">
        <a href="#"><img width="80" height="100" src="http://cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/151/16861151.gif" alt="Bagel-fuls&reg;" class="image"></a>
    </div>
    <div class="bd">
        <h4 class="summary">SAVE $0.75</h4>
        <h5 class="brand">Bagel-fuls&reg;</h5>
        <p class="details">On any TWO (2) Bagel-fuls&reg; (4ct)</p>
    </div>
</div>
HTML;
    } else if ($size == ModuleSize_Long) {
        $html = <<<HTML
<div class="mod-offeroftheweek size-{$size}">
    <div class="media">

        <div class="img">
            <a href="#"><img width="80" height="100" src="http://cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/151/16861151.gif" alt="Bagel-fuls&reg;" class="image"></a>
        </div>
        <div class="bd">
            <h4 class="summary">SAVE $0.75</h4>
            <h5 class="brand">Bagel-fuls&reg;</h5>
            <p class="details">On any TWO (2) Bagel-fuls&reg; (4ct)</p>
        </div>

    </div>
</div>
HTML;
    } else {
        $html = "Unknown offeroftheweek size ($size)";
    }

    echo $html;
}
?>
