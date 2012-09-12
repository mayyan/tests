<?php
require_once(APPLICATION_PATH . "modules/supersaver/supersaver.php");
require_once(APPLICATION_PATH . "modules/featuredtoday/featuredtoday.php");
require_once(APPLICATION_PATH . "modules/offeroftheweek/offeroftheweek.php");
require_once(APPLICATION_PATH . "modules/savingsclub/savingsclub.php");

function renderTopRowModule($moduleName, $size) {
    switch ($moduleName) {
    case "supersaver":
        renderSuperSaver($size);
        break;
    case "featuredtoday":
        renderFeaturedToday($size);
        break;
    case "savingsclub":
        renderSavingsClub($size);
        break;
    case "offeroftheweek":
        renderOfferOfTheWeek($size);
        break;
    default:
        echo "Unknow module ($moduleName) in top row of gallery.";
        break;
    }
}
function renderMREC() {
    $html =<<<HTML
    <div class="mrec">
        <iframe scrolling="no" frameborder="0" width="300" height="250" src="http://couponbar.coupons.com/adblob.asp?AdSize=300x250&pzn=13306iq3710&req=1347339507201&zip=&did=AMUAAREKS&spage=.com/&npage=1"></iframe>
    </div>
HTML;
    echo $html;
}

function renderTopRow($config) {
    $format = $config["format"];
    $modules = $config["modules"];

    if ($format == 1) {
        $moduleSize = ModuleSize_Square;

        echo <<<HTML
<div class="row">
    <div class="column grid_1">
HTML;
        renderTopRowModule($modules[0], $moduleSize);
        echo <<<HTML
    </div>

    <div class="column grid_1">
HTML;
        renderTopRowModule($modules[1], $moduleSize);
        echo <<<HTML
    </div>

    <div class="column grid_1">
HTML;
        renderMREC();
        echo <<<HTML
    </div>

</div> <!-- .row -->
HTML;
    } else if ($format == 2) {
        $moduleSize = ModuleSize_Big;

        echo <<<HTML
<div class="row">

    <div class="column grid_2">
HTML;
        print($module[0]);
        renderTopRowModule($modules[0], $moduleSize);
        echo <<<HTML
    </div>

    <div class="column grid_1">
HTML;
        renderMREC();
        echo <<<HTML
    </div>

</div> <!-- .row -->
HTML;
    } else if ($format == 3) {
        $moduleSize = ModuleSize_Long;

        echo <<<HTML
<div class="row">

    <div class="column grid_2">
        <div class="row">
            <div class="column grid_2">
HTML;
        renderTopRowModule($modules[0], $moduleSize);
        echo <<<HTML
            </div>
        </div>

        <div class="row">
            <div class="column grid_2">
HTML;
        renderTopRowModule($modules[1], $moduleSize);
        echo <<<HTML
                </div>
            </div>
        </div>

        <div class="column grid_1">
HTML;
        renderMREC();
        echo <<<HTML
    </div>
</div> <!-- .row -->
HTML;
    }
}
?>