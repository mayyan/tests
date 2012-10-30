<?php
require_once(APPLICATION_PATH . "constants.php");
require_once(APPLICATION_PATH . "library.php");
require_once(APPLICATION_PATH . "modules/gallery/toprow.php");
require_once(APPLICATION_PATH . "modules/gallery/category.php");
require_once(APPLICATION_PATH . "modules/supersaver/supersaver.php");
require_once(APPLICATION_PATH . "modules/featuredtoday/featuredtoday.php");
require_once(APPLICATION_PATH . "modules/offeroftheweek/offeroftheweek.php");
require_once(APPLICATION_PATH . "modules/savingsclub/savingsclub.php");

// Preparing all data
$podJSON = file_get_contents(APPLICATION_PATH . "podCache.json");
$podCache = json_decode($podJSON, true);

//$podIdList = array_keys($podCache);
$podIdLists = segmentByCategory($podCache, $catid);

$categoryPodIdList = $podIdLists["category"];
$otherPodIdList    = injectItemIntoArray($podIdLists["other"], $Config["Gallery"]);


if (is_numeric($catid)) {
    $podIdList = $categoryPodIdList;
} else {
    $podIdList = $otherPodIdList;
}
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
    "15" => "Click to Redeem <span>(opens new window)</span>",
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

    $html = '';

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

            $html = preg_replace($search, $replace, $podTemplate);
        }
    } else {
        // is a module name
        $moduleName = $podIdList[$gridPosition];
        switch ($moduleName) {
        case "supersaver":
            $html = renderSuperSaver(ModuleSize_Grid);
            break;
        case "featuredtoday":
        case "featuredtoday2":
        case "featuredtoday3":
            $html = renderFeaturedToday(ModuleSize_Grid);
            break;
        case "savingsclub":
            $html = renderSavingsClub(ModuleSize_Grid);
            break;
        case "offeroftheweek":
            $html = renderOfferOfTheWeek(ModuleSize_Grid);
            break;
        default:
            //$html =  "Unknow module ($moduleName) injection to gallery.";
            break;
        }
    }

    return $html;
}

function renderPodRow($row) {
    global $offset;

    $html = <<<HTML
<div class="row">
HTML;

    for ($c = 0; $c < GridWidth; $c++) {

        $html .=<<<HTML
    <div class="column grid_1">
HTML;
        $html .= renderPod($offset + $row * GridWidth + $c);
        $html .=<<<HTML
    </div>
HTML;
    }
    $html .=<<<HTML
</div>
HTML;
    return $html;
}

function renderGalleryPage($isFirstPage) {
    global $Config;
    global $catid;

    $totalRowsOnPage = GridSize / GridWidth;

    $html =<<<HTML
<div class="page">
HTML;

    if ($isFirstPage) {
        if (is_numeric($catid)) {
            $html .= renderSegment($categoryPodIdList, $isFirstPage);
        } else {
            $html .= renderTopRowModules($Config["TopRow"], $isFirstPage);
        }
    } else {
        $html .= renderTopRowPods();
    }
    $html .=<<<HTML
    <div class="pods">
HTML;

    for ($row = 0; $row < $totalRowsOnPage; $row++) {
        $html .= renderPodRow($row);
    }

    $html .=<<<HTML
    </div> <!-- .pods -->
<div class="clearfix"></div>
</div> <!-- .page -->
HTML;

    return $html;
}

function renderGallery() {
    $html =<<<HTML
<div class="mod-gallery">
    <div class="pages">
HTML;

    $html .= renderGalleryPage(true);

    $html .=<<<HTML
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

    return $html;
}
?>