<div class="mod-gallery">
    <div class="row hero">

        <div class="col col-lg-12">
            <?php include "modules/hero/hero.php" ?>
        </div>
        </div>

        <div class="row shortstack">

            <div class="col col-lg-8">

                <?php include "modules/offeroftheweek/offeroftheweek.php" ?>
                <?php include "modules/shortstackpromo/shortstackpromo.php" ?>

            </div>

            <div class="col col-lg-4 mrec">
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
        <div class="col col-lg-4">
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
        <div class="col col-lg-4 col-offset-4">
            <button class="more-btn btn btn-primary">Show More Coupons</button>
        </div>
    </div>
</div> <!-- mod-gallery -->