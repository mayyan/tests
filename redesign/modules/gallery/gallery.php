<?php
const APPLICATION_PATH = "/Users/myan/Sites/tests/redesign/";
//const APPLICATION_PATH = "/var/www/";

require_once(APPLICATION_PATH . "constants.php");
require_once(APPLICATION_PATH . "library.php");
require_once(APPLICATION_PATH . "modules/gallery/toprow.php");
require_once(APPLICATION_PATH . "modules/supersaver/supersaver.php");
require_once(APPLICATION_PATH . "modules/featuredtoday/featuredtoday.php");
require_once(APPLICATION_PATH . "modules/offeroftheweek/offeroftheweek.php");
require_once(APPLICATION_PATH . "modules/savingsclub/savingsclub.php");

$offset = empty($_GET["offset"]) ? 0 : $_GET["offset"];
$action = empty($_GET["action"]) ? "" : $_GET["action"];

// Preparing all data
$podJSON = file_get_contents(APPLICATION_PATH . "podCache.json");
$podCache = json_decode($podJSON, true);
$podIdList = array_keys($podCache);

$podIdList = injectItemIntoArray($podIdList, $Config["Gallery"]);
//print_r($podIdList);

$podIdListOnPage = array_slice($podIdList, $offset, GridSize);

$POD_TYPE_MAP = array(
    "0" => "coupon",
    "9" => "duet",
    "13" => "video",
    "15" => "cpc",
    "27" => "coupon"
);

$POD_CTA_MAP = array(
    "0" => "Clip Coupon",
    "9" => "Clip Coupon <span>(sign up to redeem)</span>",
    "13" => "Click to watch <span>(Redeem after video)</span>",
    "15" => "Clcik to Redeem <span>(opens new window)</span>",
    "27" => "Clip Coupon"
);

$podTemplate =<<<HTML
<div class="pod-shadow">
    <div class="pod {type}">
        <div class="hover">
            <p>{cta}</p>
        </div>
        <div class="media">
            <div class="img">
                <a href="#"><img width="80" height="100" src="{imageUrl}" alt="{imageAlt}" class="pod-image"></a>
            </div>
            <div class="bd">
                <h4 class="summary">{summary}</h4>
                <h5 class="brand">{brand}</h5>
                <p class="details">{details}</p>
            </div>
        </div>
    </div>
</div>
HTML;

function getPodTypeCSSClass($podData) {
    global $POD_TYPE_MAP;
    return $POD_TYPE_MAP[$podData["type"]];
}

function getPodCTAString($podData) {
    global $POD_CTA_MAP;
    return $POD_CTA_MAP[$podData["type"]];
}

function renderPod($gridPosition) {
    global $podIdList;
    global $podCache;
    global $podTemplate;

    if (is_numeric($podIdList[$gridPosition])) {
        // is a pod id
        $podIndex = $gridPosition;

        if ($podIndex < count($podIdList)) {
            $podId = $podIdList[$podIndex];
            $podData = $podCache[$podId];

            $podTypeCSSClass = getPodTypeCSSClass($podData);
            $podCTAString = getPodCTAString($podData);
            $podImageUrl = $podData["image"]["url"];

            $search = array('/{type}/', '/{cta}/', '/{imageUrl}/', '/{imageAlt}/', '/{summary}/', '/{brand}/', '/{details}/');
            $replace = array(
                $podTypeCSSClass,
                $podCTAString,
                $podImageUrl,
                $podData["brand"],
                $podData["summary"],
                $podData["brand"],
                $podData["details"]);

            echo preg_replace($search, $replace, $podTemplate);
        }
    } else {
        // is a module name
        $moduleName = $podIdList[$gridPosition];
        switch ($moduleName) {
        case "supersaver":
            renderSuperSaver(ModuleSize_Grid);
            break;
        case "featuredtoday":
            renderFeaturedToday(ModuleSize_Grid);
            break;
        case "savingsclub":
            renderSavingsClub(ModuleSize_Grid);
            break;
        case "offeroftheweek":
            renderOfferOfTheWeek(ModuleSize_Grid);
            break;
        default:
            echo "Unknow module ($moduleName) injection to gallery.";
            break;
        }
    }
}

function renderPodRow($row) {
    global $offset;

    echo <<<HTML
<div class="row">
HTML;

    for ($c = 0; $c < GridWidth; $c++) {

        echo <<<HTML
    <div class="column grid_1">
HTML;
        renderPod($offset + $row * GridWidth + $c);
        echo <<<HTML
    </div>
HTML;
    }
    echo <<<HTML
</div>
HTML;
}

function renderPage($isFirstPage) {
    global $Config;

    $totalRowsOnPage = GridSize / GridWidth;

    echo <<<HTML
<div class="page">
HTML;

    renderTopRow($Config["TopRow"], $isFirstPage);

    echo <<<HTML
    <div class="pods">
HTML;

    for ($row = 0; $row < $totalRowsOnPage; $row++) {
        renderPodRow($row);
    }

    echo <<<HTML
    </div> <!-- .pods -->
    <div class="clearfix"></div>
</div> <!-- .page -->
HTML;
}

/**
 * Main
 */
if ($action == "loadPage") {
    renderPage(false);
} else {
    echo <<<HTML
<div class="mod-gallery">
    <div class="pages">
HTML;

    renderPage(true);

    echo <<<HTML
    </div> <!-- .pages -->

    <div class="loading-indicator" style="display: none;">
        <img src="http://cdn.cpnscdn.com/static.coupons.com/Sites/img/bigblue/spinner.gif" width="32" height="32" />
    </div>
    <div class="more">
        <button style="visibility: visible;">Show More Coupons</button>
    </div>

    <div class="tools">
        <a class="goto-top inactive" href="#top">Back to top</a>

        <div class="selectall">
            <input type="checkbox" id="couponsinc-gallery-selectall" class="selectall-chk">
            <label for="couponsinc-gallery-selectall">Clip All</label>
        </div>

    </div>
</div> <!--mod-gallery -->
HTML;
}
?>