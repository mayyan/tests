<?php

function renderFeaturedToday($size) {
    global $Config;

    if ($size == ModuleSize_Super || $size == ModuleSize_Double || $size == ModuleSize_Grid) {
        if ($Config["TakeOver"] == 1) {
            $imgSrc = "images/yoplait-logo.jpg";
            $brand = "Yoplait&reg;";
        } else {
            $imgSrc = "http://cdn.cpnscdn.com/static.coupons.com/images/cprimages/743/11743_1_prgId.gif";
            $brand = "Glade&reg;";
        }

        $html = <<<HTML
<div data-program="11743" class="featuredtoday product">
    <div class="hd">
        <p>Featured Today</p>
    </div>
    <div class="bd">
        <img width="80" height="100" border="0" alt="" src="{$imgSrc}">
        <div class="right">
            <h3>{$brand}</h3>
            <p>Savings Center</p>
            <button class="cta-3d">View All Offers</button>
        </div>
    </div>
</div>
HTML;
    } else if ($size == ModuleSize_ShortStack) {
        $html = <<<HTML
<div class="mod-featuredtoday promo size-{$size}">
    <div class="left">
        <div class="img">
            <a href="#"><img src="images/food.png" alt="Tostino's Savings Center"></a>
        </div>
    </div>
    <div class="right">
        <h4 class="typeline">FEATURED TODAY</h4>
        <h5 class="headline">Tostino's Savings Center</h5>
    </div>

</div>
HTML;
    } else {
        $html = "Unknown featuredtoday size ($size)";
    }

    return $html;
}

function renderFeaturedTodayPods() {
    global $Config;

    // Preparing all data
    $dataFile = ($Config["TakeOver"] == 1) ? "featuredtoday-yoplait.json" : "featuredtoday-glade.json";

    $podJSON = file_get_contents(APPLICATION_PATH . $dataFile);
    $podCache = json_decode($podJSON, true);

    $html = '';
    foreach($podCache as $podData) {
        $html .= renderCoupon($podData);
    }

    return $html;
}

function renderFeaturedTodayDialog() {
    $pods = renderFeaturedTodayPods();

    $imgSrc = ($Config["TakeOver"] == 1) ? "" : "http://cdn.cpnscdn.com/static.coupons.com/images/cprimages/743/11743_2_prgId.gif";

    $html = <<<HTML
<div data-program="11743" class="mod-featuredtoday-flyout">
    <div class="hd">
        <button class="close-button">×</button>
        <p class="title">Featured Today</p>
        <img alt="" src="{$imgSrc}" class="featuredtoday-header-image">
        <p class="program-text"></p>
        <p class="additional-program-text"></p>
        <div class="clearfix"></div>
    </div>

    <div class="bd">
        <div class="featured-coupons-pods">
            {$pods}
            <div class="clearfix"></div>
    </div>

    <div class="ft">
        <button class="cta-button">Clip All</button><button class="close-button">Close</button>
    </div>
</div>

HTML;
    return $html;
}
?>
