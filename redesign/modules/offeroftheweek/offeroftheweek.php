<?php

function renderOfferOfTheWeek($size) {
    if ($size == ModuleSize_Square || $size == ModuleSize_Grid) {
        $html = <<<HTML
<div class="mod-offeroftheweek size-{$size}">
    <div class="top">
        <a href="#"><img src="/~myan/tests/redesign/images/food.png" alt="Bagel-fuls&reg;"></a>
    </div>
    <div class="bottom">
        <h4 class="summary">SAVE $0.75</h4>
        <h5 class="brand">Bagel-fuls&reg;</h5>
        <p class="details">On any TWO (2) Bagel-fuls&reg; (4ct)</p>
    </div>
</div>
HTML;
    } else if ($size == ModuleSize_Big) {
        $html = <<<HTML
<div class="mod-offeroftheweek size-{$size}">
    <div class="top">
        <a href="#"><img src="/~myan/tests/redesign/images/food.png" alt="Bagel-fuls&reg;"></a>
    </div>
    <div class="bottom">
        <div class="left">
            <div class="img">
                <h4 class="summary1">SAVE</h4>
                <h4 class="summary2">$0.75</h4>
            </div>
        </div>
        <div class="right">
            <h5 class="brand">Bagel-fuls&reg;</h5>
            <p class="details">On any TWO (2) Bagel-fuls&reg; (4ct)</p>
        </div>
    </div>
</div>
HTML;
    } else if ($size == ModuleSize_Long) {
        $html = <<<HTML
<div class="mod-offeroftheweek size-{$size}">
    <div class="left">
        <div class="img">
            <a href="#"><img src="/~myan/tests/redesign/images/food.png" alt="Bagel-fuls&reg;"></a>
        </div>
    </div>
    <div class="right">
        <h4 class="summary">SAVE $0.75</h4>
        <h5 class="brand">Bagel-fuls&reg;</h5>
        <p class="details">On any TWO (2) Bagel-fuls&reg; (4ct)</p>
    </div>
</div>
HTML;
    } else {
        $html = "Unknown offeroftheweek size ($size)";
    }

    echo $html;
}
?>
