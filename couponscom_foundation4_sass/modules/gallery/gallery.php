<div class="mod-gallery" id="id-gallery">
    <div class="row">
        <div class="columns large-8">
            <?php include "modules/offeroftheweek/offeroftheweek.php" ?>
            <?php include "modules/shortstackpromo/shortstackpromo.php" ?>
        </div>

        <div class="columns large-4">
            <?php include "modules/mrec/mrec.php" ?>
        </div>
    </div>

<?php
$index = 0;
foreach($podCache as $podId => $podData) {
    if ($index < 27) {

        if ($index % 3 === 0) {
            echo <<<HTML
    <div class="row dyn-row-height">
HTML;
        }

        echo <<< HTML
        <div class="columns large-4">
HTML;
        echo renderPod($podData);
        echo <<<HTML
        </div>
HTML;

        $index += 1;

        If ($index % 3 === 0) {
            echo <<<HTML
    </div>
HTML;
        }
    }
}
?>
    <div class="row">
        <div class="columns large-centered large-4">
            <button class="button medium expand">Show More Coupons</button>
        </div>
    </div>
    
</div>