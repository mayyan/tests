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
    "9" => "Clip Coupon",
    "13" => "Click to Watch",
    "15" => "Click to Save",
    "27" => "Clip Coupon"
);

$POD_CTA2_MAP = array(
    "0" => "",
    "9" => "(Clip after signup)",
    "13" => "(Redeem after video)",
    "15" => "(Opens new window)",
    "27" => ""
);

$podTemplate =<<<HTML
<div class="pod {type}">
    <h3 class="premium-label">Savings Club</h3>

    <div class="hover">
        <div class="sprite-pod circle">
            <p class="click-text">{cta}</p>
            <p class="click-text-sec">{cta2}</p>
        </div>
    </div>
    <div class="left">
        <div class="pod-media">
            <div class="img">
                <img width="80" height="100" src="{imageUrl}" alt="{imageAlt}" class="pod-image">
            </div>
        </div>
    </div>
    <div class="right">
        <div class="pod-info">
            <h4 class="summary">{summary}</h4>
            <h5 class="brand">{brand}</h5>
            <p class="details">{details}</p>
        </div>
    </div>
    <div class="clipped-container">
        <div class="clipped-view">

            <span class="box clip-box clip-action">
                <i>&#x2713;</i>Clipped
            </span>
            <span class="box clip-box unclip-action">
                <i>&#x2715;</i>Unclip
            </span>

            <span class="box share-box">
                <i>&#x21f6;</i>Share
                <div class="social-container">
                    <div class="social-message">
                        Share with your friends.
                    </div>
                    <div class="social-strip">
                        <div class="sprite-urban facebook"></div>
                        <div class="sprite-urban twitter"></div>
                        <div class="sprite-urban email"></div>
                    </div>
                </div>
            </span>

            <span class="box info">
                <i>&#x21f1;</i>Info
            </span>


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

function getPodCTA2String($podData) {
    global $POD_CTA2_MAP;
    return $POD_CTA2_MAP[$podData["type"]];
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
            $podCTA2String = getPodCTA2String($podData);
            $podImageUrl = $podData["image"]["url"];

            $search = array('/{type}/', '/{cta}/', '/{cta2}/', '/{imageUrl}/', '/{imageAlt}/', '/{summary}/', '/{brand}/', '/{details}/');
            $replace = array(
                $podTypeCSSClass,
                $podCTAString,
                $podCTA2String,
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
        <button class="primary">Show More Coupons</button>
    </div>

    <div data-popup="0" data-inhouse="0" class="mod-ads container-728x90">
        <iframe scrolling="no" frameborder="0" style="height:90px;width:728px" src="//couponbar.coupons.com/adblob.asp?AdSize=728x90&amp;pzn=13306iq3710&amp;req=1357805013855&amp;zip=95014&amp;did=AMUAAREKS&amp;spage=.com/&amp;npage=1&amp;kvhouse=0&amp;kvss=0&amp;kvsc=0&amp;kvcb=0"></iframe>
    </div>

    <div class="tools">
        <div class="selectall">
            <input type="checkbox" class="selectall-chk" id="couponsinc-gallery-selectall">
            <label for="couponsinc-gallery-selectall">Clip All</label>
        </div>
        <a href="#top" class="goto-top inactive">Back to Top</a>
    </div>

</div> <!--mod-gallery -->
HTML;

    return $html;
}

function renderPostPrintGallery() {
    $html =<<<HTML
<div class="printed-bd">
        <div class="bricks-tool-bar">
            <div class="mod-categorysort">
    <div class="hd">
        <p>Categories :</p>
    </div>
    <div class="bd all-categories">
        <div class="current-category">Show All (32)</div>
        <ul class="hidden">
            <li class="categorysort-item">
    <a data-podlist="" data-catid="-200" href="/coupons/">
        Show All&nbsp;(32)
    </a>
</li>
<li class="categorysort-item">
    <a data-podlist="17613080,17654362" data-catid="5491" href="/coupons/Baby-%26-Toddler-Coupons-5491/">
        Baby &amp; Toddler&nbsp;(2)
    </a>
</li>
<li class="categorysort-item">
    <a data-podlist="17658050" data-catid="106" href="/coupons/Entertainment-Coupons-106/">
        Entertainment&nbsp;(1)
    </a>
</li>
<li class="categorysort-item">
    <a data-podlist="17294043,17629059" data-catid="886" href="/coupons/Flower-%26-Gift-Coupons-886/">
        Flowers &amp; Gifts&nbsp;(2)
    </a>
</li>
<li class="categorysort-item">
    <a data-podlist="17633085,17658093,17633194" data-catid="104" href="/coupons/Health-Care-Coupons-104/">
        Health Care&nbsp;(4)
    </a>
</li>
<li class="categorysort-item">
    <a data-podlist="17659120" data-catid="5478" href="/coupons/Home-Entertainment-Coupons-5478/">
        Home Entertainment&nbsp;(1)
    </a>
</li>
<li class="categorysort-item">
    <a data-podlist="17386152,17641088,17641093,17654076,17641094,17641089,17641091" data-catid="105" href="/coupons/Household-Coupons-105/">
        Household&nbsp;(7)
    </a>
</li>
<li class="categorysort-item">
    <a data-podlist="17040030" data-catid="894" href="/coupons/Office-Supplies-Coupons-894/">
        Office Supplies&nbsp;(2)
    </a>
</li>
<li class="categorysort-item">
    <a data-podlist="17655030,17633188,17655195,17633195,17633084,17664098,17411120,17664101" data-catid="101" href="/coupons/Personal-Care-Coupons-101/">
        Personal Care&nbsp;(8)
    </a>
</li>
<li class="categorysort-item">
    <a data-podlist="17661383" data-catid="102" href="/coupons/Pet-Care-Coupons-102/">
        Pet Care&nbsp;(1)
    </a>
</li>
<li class="categorysort-item">
    <a data-podlist="17653012,17653005,17586135" data-catid="872" href="/coupons/Professional-Service-Coupons-872/">
        Professional Services&nbsp;(3)
    </a>
</li>
<li class="categorysort-item">
    <a data-podlist="17638360" data-catid="589" href="/coupons/Restaurant-Coupons-589/">
        Restaurants&nbsp;(1)
    </a>
</li>
        </ul>
    </div>
</div>
            <div class="list-btn-view">
                <span>View :</span>
                <button class="btn-small-list"><span>List</span></button>
                <button class="btn-large-list active"><span>Grid</span></button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="bricks-container large-list">
            <div class="mod-gallery">
    <a name="top"></a>

    <div class="pages">
        <div id="couponsinc-gallery-page-0" class="page">
            <div class="pods">
                <div id="couponsinc-gallery-POD17655030" data-podid="17655030" class="pod cpc">

    <div class="bd">
        <div class="pod-image-container">
            <img width="40" height="40" src="//cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/030/17655030.gif" class="pod-image">
        </div>
        <h4 class="offer-product small-pod">Crest&reg; 3D White&trade; Whitestrips&reg;</h4>
        <h3 class="offer-value">$10 Mail-in Rebate</h3>
        <h4 class="offer-product large-pod">Crest&reg; 3D White&trade; Whitestrips&reg;</h4>
        <p class="offer-details">Get a whiter smile and save $10. Buy now on Walmart.com</p>
        <a target="_blank" href="http://www.walmart.com/ip/Crest-WS-3D-WHITE-PRO-EFFECTS-8-20CT/13909414" class="extra ">Click to Save</a>
    </div>

</div>
<div id="couponsinc-gallery-POD17633188" data-podid="17633188" class="pod cpc">

    <div class="bd">
        <div class="pod-image-container">
            <img width="40" height="40" src="//cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/188/17633188.gif" class="pod-image">
        </div>
        <h4 class="offer-product small-pod">QualityHealth</h4>
        <h3 class="offer-value">FREE Winter Samples</h3>
        <h4 class="offer-product large-pod">QualityHealth</h4>
        <p class="offer-details">Sign up for FREE samples this winter!</p>
        <a target="_blank" href="http://www.OffersFromQH.com/mediaLanding?rf=73072" class="extra ">Get Yours Now</a>
    </div>

</div>
<div id="couponsinc-gallery-POD17613080" data-podid="17613080" class="pod cpc">

    <div class="bd">
        <div class="pod-image-container">
            <img width="40" height="40" src="//cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/080/17613080.gif" class="pod-image">
        </div>
        <h4 class="offer-product small-pod">Vicks&reg; Behind Ear Thermometer</h4>
        <h3 class="offer-value">Save $10 on</h3>
        <h4 class="offer-product large-pod">Vicks&reg; Behind Ear Thermometer</h4>
        <p class="offer-details">Get a fast, accurate temperature reading with just one touch.</p>
        <a target="_blank" href="http://www.behindear.com/thermometer/mailrebate/" class="extra ">Click Here</a>
    </div>

</div>
<div id="couponsinc-gallery-POD17638360" data-podid="17638360" class="pod cpc">

    <div class="bd">
        <div class="pod-image-container">
            <img width="40" height="40" src="//cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/360/17638360.gif" class="pod-image">
        </div>
        <h4 class="offer-product small-pod">Chili's</h4>
        <h3 class="offer-value">Limited Time Offer</h3>
        <h4 class="offer-product large-pod">Chili's</h4>
        <p class="offer-details">Just for joining Chili’s email club we’ll give you Free Chips &amp; Queso!</p>
        <a target="_blank" href="http://chilisemailclub.com/?imm_cid=92-9C" class="extra ">Print Now</a>
    </div>

</div>
<div id="couponsinc-gallery-POD17655195" data-podid="17655195" class="pod cpc">

    <div class="bd">
        <div class="pod-image-container">
            <img width="40" height="40" src="//cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/195/17655195.gif" class="pod-image">
        </div>
        <h4 class="offer-product small-pod">Suave Moroccan Infusion</h4>
        <h3 class="offer-value">NEW</h3>
        <h4 class="offer-product large-pod">Suave Moroccan Infusion</h4>
        <p class="offer-details">Buy Now on Walmart.com!</p>
        <a target="_blank" href="http://couponbar.coupons.com/zurl.asp?cid=17655195" class="extra ">Click Here!</a>
    </div>

</div>
<div id="couponsinc-gallery-POD17654362" data-podid="17654362" class="pod cpc">

    <div class="bd">
        <div class="pod-image-container">
            <img width="40" height="40" src="//cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/362/17654362.gif" class="pod-image">
        </div>
        <h4 class="offer-product small-pod">Enfamil Family Beginnings&reg;</h4>
        <h3 class="offer-value">Get up to $250 in free gifts</h3>
        <h4 class="offer-product large-pod">Enfamil Family Beginnings&reg;</h4>
        <p class="offer-details">Get free samples, valuable coupons and expert advice.</p>
        <a target="_blank" href="http://ad.doubleclick.net/clk;266361074;91918352;m;pc=[TPAS_ID]" class="extra ">Join Now!</a>
    </div>

</div>
<div id="couponsinc-gallery-POD17633195" data-podid="17633195" class="pod cpc">

    <div class="bd">
        <div class="pod-image-container">
            <img width="40" height="40" src="//cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/195/17633195.gif" class="pod-image">
        </div>
        <h4 class="offer-product small-pod">QualityHealth</h4>
        <h3 class="offer-value">FREE Bracelet</h3>
        <h4 class="offer-product large-pod">QualityHealth</h4>
        <p class="offer-details">Show your support with this FREE Breast Cancer Awareness Bracelet</p>
        <a target="_blank" href="http://www.OffersFromQH.com/mediaLanding?rf=73074" class="extra ">Get Yours Now</a>
    </div>

</div>
<div id="couponsinc-gallery-POD17658050" data-podid="17658050" class="pod cpc">

    <div class="bd">
        <div class="pod-image-container">
            <img width="40" height="40" src="//cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/050/17658050.gif" class="pod-image">
        </div>
        <h4 class="offer-product small-pod">Shop New Year Sales</h4>
        <h3 class="offer-value">SAVE OVER 50%</h3>
        <h4 class="offer-product large-pod">Shop New Year Sales</h4>
        <p class="offer-details">Walmart, Target, Kmart, Best Buy &amp; more. Click to view all.</p>
        <a target="_blank" href="http://www.coupons.com/new-year-sales/" class="extra ">Shop Now!</a>
    </div>

</div>
<div id="couponsinc-gallery-POD17659120" data-podid="17659120" class="pod cpc">

    <div class="bd">
        <div class="pod-image-container">
            <img width="40" height="40" src="//cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/120/17659120.gif" class="pod-image">
        </div>
        <h4 class="offer-product small-pod">Free Mickey Backpack</h4>
        <h3 class="offer-value">4 Disney Movies for $1.00 Plus</h3>
        <h4 class="offer-product large-pod">Free Mickey Backpack</h4>
        <p class="offer-details">FREE SHIPPING on initial order! With membership.</p>
        <a target="_blank" href="http://couponbar.coupons.com/zurl.asp?cid=17464074" class="extra ">See Details</a>
    </div>

</div>
<div id="couponsinc-gallery-POD17633085" data-podid="17633085" class="pod cpc">

    <div class="bd">
        <div class="pod-image-container">
            <img width="40" height="40" src="//cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/085/17633085.gif" class="pod-image">
        </div>
        <h4 class="offer-product small-pod">QualityHealth</h4>
        <h3 class="offer-value">Diabetes Tool Kit Giveaway</h3>
        <h4 class="offer-product large-pod">QualityHealth</h4>
        <p class="offer-details">QualityHealth is giving away a diabetes tool kit every week.</p>
        <a target="_blank" href="https://www.qualityhealth.com/registration?rf=72405" class="extra ">Enter Now!</a>
    </div>

</div>
<div id="couponsinc-gallery-POD17040030" data-podid="17040030" class="pod cpc">

    <div class="bd">
        <div class="pod-image-container">
            <img width="40" height="40" src="//cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/030/17040030.gif" class="pod-image">
        </div>
        <h4 class="offer-product small-pod">Vistaprint</h4>
        <h3 class="offer-value">Free Business Cards!</h3>
        <h4 class="offer-product large-pod">Vistaprint</h4>
        <p class="offer-details">250 FREE or upgrade to premium for only $3.99!</p>
        <a target="_blank" href="http://www.vistaprint.com/vp/gateway.aspx?S=8180027907" class="extra ">CLICK HERE!</a>
    </div>

</div>
<div id="couponsinc-gallery-POD17658093" data-podid="17658093" class="pod cpc">

    <div class="bd">
        <div class="pod-image-container">
            <img width="40" height="40" src="//cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/093/17658093.gif" class="pod-image">
        </div>
        <h4 class="offer-product small-pod">FeverAll&reg;</h4>
        <h3 class="offer-value">Oral medications not an option?</h3>
        <h4 class="offer-product large-pod">FeverAll&reg;</h4>
        <p class="offer-details">Save $1.50 on any (1) FeverAll&reg; product. To learn more visit us at www.feverall.com</p>
        <a target="_blank" href="http://www.feverall.com" class="extra "></a>
    </div>

</div>
<div id="couponsinc-gallery-POD17661383" data-podid="17661383" class="pod cpc">

    <div class="bd">
        <div class="pod-image-container">
            <img width="40" height="40" src="//cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/383/17661383.gif" class="pod-image">
        </div>
        <h4 class="offer-product small-pod">Rover.com</h4>
        <h3 class="offer-value">1 FREE NIGHT</h3>
        <h4 class="offer-product large-pod">Rover.com</h4>
        <p class="offer-details">Buy 2 nights worth of dog boarding services &amp; get the 3rd night free (up to $50 in value).</p>
        <a target="_blank" href="http://www.rover.com/cdc50" class="extra ">Click to Redeem</a>
    </div>

</div>
<div id="couponsinc-gallery-POD17633084" data-podid="17633084" class="pod cpc">

    <div class="bd">
        <div class="pod-image-container">
            <img width="40" height="40" src="//cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/084/17633084.gif" class="pod-image">
        </div>
        <h4 class="offer-product small-pod">Diabetes Awareness Wristband!</h4>
        <h3 class="offer-value">QualityHealth</h3>
        <h4 class="offer-product large-pod">Diabetes Awareness Wristband!</h4>
        <p class="offer-details">Show your support for diabetes awareness!</p>
        <a target="_blank" href="http://couponbar.coupons.com/zurl.asp?cid=16594028" class="extra ">Take our Survey &amp; Get Yours Now</a>
    </div>

</div>
<div id="couponsinc-gallery-POD17664098" data-podid="17664098" class="pod cpc">

    <div class="bd">
        <div class="pod-image-container">
            <img width="40" height="40" src="//cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/098/17664098.gif" class="pod-image">
        </div>
        <h4 class="offer-product small-pod">WEN&reg; by Chaz Dean</h4>
        <h3 class="offer-value">Only $29.95</h3>
        <h4 class="offer-product large-pod">WEN&reg; by Chaz Dean</h4>
        <p class="offer-details">Transform your hair with WEN and get 2 FREE gifts + Free Shipping</p>
        <a target="_blank" href="http://clk.atdmt.com/GRK/go/371514333/direct/01/" class="extra ">ORDER TODAY</a>
    </div>

</div>
<div id="couponsinc-gallery-POD17411120" data-podid="17411120" class="pod cpc">

    <div class="bd">
        <div class="pod-image-container">
            <img width="40" height="40" src="//cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/120/17411120.gif" class="pod-image">
        </div>
        <h4 class="offer-product small-pod">Proactiv</h4>
        <h3 class="offer-value">Special Offer!</h3>
        <h4 class="offer-product large-pod">Proactiv</h4>
        <p class="offer-details">Order America’s #1 acne system for only $19.95 and get FREE SHIPPING.</p>
        <a target="_blank" href="http://clk.atdmt.com/GRK/go/371513794/direct/01/" class="extra ">Order Now</a>
    </div>

</div>
<div id="couponsinc-gallery-POD17633194" data-podid="17633194" class="pod cpc">

    <div class="bd">
        <div class="pod-image-container">
            <img width="40" height="40" src="//cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/194/17633194.gif" class="pod-image">
        </div>
        <h4 class="offer-product small-pod">QualityHealth</h4>
        <h3 class="offer-value">Pharmacy Discount Card</h3>
        <h4 class="offer-product large-pod">QualityHealth</h4>
        <p class="offer-details">Save up to 70% off your prescriptions</p>
        <a target="_blank" href="http://www.OffersFromQH.com/mediaLanding?rf=73073" class="extra ">Get Yours Now</a>
    </div>

</div>
<div id="couponsinc-gallery-POD17294043" data-podid="17294043" class="pod cpc">

    <div class="bd">
        <div class="pod-image-container">
            <img width="40" height="40" src="//cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/043/17294043.gif" class="pod-image">
        </div>
        <h4 class="offer-product small-pod">Vistaprint</h4>
        <h3 class="offer-value">$5 Custom T-Shirt</h3>
        <h4 class="offer-product large-pod">Vistaprint</h4>
        <p class="offer-details">Customize your t-shirt with photos and text.</p>
        <a target="_blank" href="http://www.vistaprint.com/vp/gateway.aspx?S=5484022481" class="extra ">CLICK HERE!</a>
    </div>

</div>
<div id="couponsinc-gallery-POD17629059" data-podid="17629059" class="pod cpc">

    <div class="bd">
        <div class="pod-image-container">
            <img width="40" height="40" src="//cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/059/17629059.gif" class="pod-image">
        </div>
        <h4 class="offer-product small-pod">Gemvara.com</h4>
        <h3 class="offer-value">Now $50 Off All Orders</h3>
        <h4 class="offer-product large-pod">Gemvara.com</h4>
        <p class="offer-details">Save $50 on your order today. Fine jewelry, custom made for you.</p>
        <a target="_blank" href="http://couponbar.coupons.com/zurl.asp?cid=17629059" class="extra ">Create Yours</a>
    </div>

</div>
<div id="couponsinc-gallery-POD17653012" data-podid="17653012" class="pod cpc">

    <div class="bd">
        <div class="pod-image-container">
            <img width="40" height="40" src="//cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/012/17653012.gif" class="pod-image">
        </div>
        <h4 class="offer-product small-pod">Weight Watchers Online</h4>
        <h3 class="offer-value">SIGN UP FOR FREE</h3>
        <h4 class="offer-product large-pod">Weight Watchers Online</h4>
        <p class="offer-details">No Sign Up Fee when you buy our 3-Mon Savings Plan.</p>
        <a target="_blank" href="http://clk.atdmt.com/AVE/go/421658808/direct;wi.1;hi.1/01/" class="extra ">CLICK FOR DETAILS</a>
    </div>

</div>
<div id="couponsinc-gallery-POD17386152" data-podid="17386152" class="pod cpc">

    <div class="bd">
        <div class="pod-image-container">
            <img width="40" height="40" src="//cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/152/17386152.gif" class="pod-image">
        </div>
        <h4 class="offer-product small-pod">Sears Central Air Conditioning</h4>
        <h3 class="offer-value">Save $325</h3>
        <h4 class="offer-product large-pod">Sears Central Air Conditioning</h4>
        <p class="offer-details">Stay cool this season with a new central air system</p>
        <a target="_blank" href="http://couponbar.coupons.com/zurl.asp?cid=15726156" class="extra ">Free in-home consultation</a>
    </div>

</div>
<div id="couponsinc-gallery-POD17641088" data-podid="17641088" class="pod cpc">

    <div class="bd">
        <div class="pod-image-container">
            <img width="40" height="40" src="//cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/088/17641088.gif" class="pod-image">
        </div>
        <h4 class="offer-product small-pod">Sears Kitchens</h4>
        <h3 class="offer-value">Special Financing</h3>
        <h4 class="offer-product large-pod">Sears Kitchens</h4>
        <p class="offer-details">Save on Cabinet Refacing or Kitchen Remodeling!</p>
        <a target="_blank" href="http://couponbar.coupons.com/zurl.asp?cid=16254135" class="extra ">Click for details</a>
    </div>

</div>
<div id="couponsinc-gallery-POD17653005" data-podid="17653005" class="pod cpc">

    <div class="bd">
        <div class="pod-image-container">
            <img width="40" height="40" src="//cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/005/17653005.gif" class="pod-image">
        </div>
        <h4 class="offer-product small-pod">Weight Watchers Online</h4>
        <h3 class="offer-value">SIGN UP FOR FREE</h3>
        <h4 class="offer-product large-pod">Weight Watchers Online</h4>
        <p class="offer-details">No Sign Up Fee when you buy our 3-Mon Savings Plan.</p>
        <a target="_blank" href="http://clk.atdmt.com/AVE/go/429507663/direct;wi.1;hi.1/01/" class="extra ">CLICK FOR DETAILS</a>
    </div>

</div>
<div id="couponsinc-gallery-POD17641093" data-podid="17641093" class="pod cpc">

    <div class="bd">
        <div class="pod-image-container">
            <img width="40" height="40" src="//cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/093/17641093.gif" class="pod-image">
        </div>
        <h4 class="offer-product small-pod">Sears Bath Remodel</h4>
        <h3 class="offer-value">Special Financing</h3>
        <h4 class="offer-product large-pod">Sears Bath Remodel</h4>
        <p class="offer-details">Get a free design consultation and a new look for your bath!</p>
        <a target="_blank" href="http://couponbar.coupons.com/zurl.asp?cid=16970181" class="extra ">Click for details</a>
    </div>

</div>
<div id="couponsinc-gallery-POD17654076" data-podid="17654076" class="pod cpc">

    <div class="bd">
        <div class="pod-image-container">
            <img width="40" height="40" src="//cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/076/17654076.gif" class="pod-image">
        </div>
        <h4 class="offer-product small-pod">PURIFICATION</h4>
        <h3 class="offer-value">$100 OFF WHOLE HOUSE WATER</h3>
        <h4 class="offer-product large-pod">PURIFICATION</h4>
        <p class="offer-details">Remove chlorine, chemicals. Virtually no pressure loss. High purification. Limited Time Only $375!</p>
        <a target="_blank" href="http://www.quadmaxx100.com" class="extra ">Click here</a>
    </div>

</div>
<div id="couponsinc-gallery-POD17586135" data-podid="17586135" class="pod cpc">

    <div class="bd">
        <div class="pod-image-container">
            <img width="40" height="40" src="//cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/135/17586135.gif" class="pod-image">
        </div>
        <h4 class="offer-product small-pod">Sears Central Air/Heat Repair</h4>
        <h3 class="offer-value">From $69*</h3>
        <h4 class="offer-product large-pod">Sears Central Air/Heat Repair</h4>
        <p class="offer-details">Keep your system running! Stay comfortable this season</p>
        <a target="_blank" href="http://couponbar.coupons.com/zurl.asp?cid=16308198" class="extra ">Limited time offer</a>
    </div>

</div>
<div id="couponsinc-gallery-POD17641094" data-podid="17641094" class="pod cpc">

    <div class="bd">
        <div class="pod-image-container">
            <img width="40" height="40" src="//cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/094/17641094.gif" class="pod-image">
        </div>
        <h4 class="offer-product small-pod">Sears Custom Replacement Windows</h4>
        <h3 class="offer-value">Special Financing</h3>
        <h4 class="offer-product large-pod">Sears Custom Replacement Windows</h4>
        <p class="offer-details">Cut your energy costs. Styles to fit any home.</p>
        <a target="_blank" href="http://couponbar.coupons.com/zurl.asp?cid=16967163" class="extra ">Click for details</a>
    </div>

</div>
<div id="couponsinc-gallery-POD17641089" data-podid="17641089" class="pod cpc">

    <div class="bd">
        <div class="pod-image-container">
            <img width="40" height="40" src="//cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/089/17641089.gif" class="pod-image">
        </div>
        <h4 class="offer-product small-pod">Sears Premium Vinyl Siding</h4>
        <h3 class="offer-value">Special Financing</h3>
        <h4 class="offer-product large-pod">Sears Premium Vinyl Siding</h4>
        <p class="offer-details">You may never paint your home's exterior again!</p>
        <a target="_blank" href="http://couponbar.coupons.com/zurl.asp?cid=16254137" class="extra ">Click for details</a>
    </div>

</div>
<div id="couponsinc-gallery-POD17641091" data-podid="17641091" class="pod cpc">

    <div class="bd">
        <div class="pod-image-container">
            <img width="40" height="40" src="//cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/091/17641091.gif" class="pod-image">
        </div>
        <h4 class="offer-product small-pod">Sears Roofing</h4>
        <h3 class="offer-value">Special Financing</h3>
        <h4 class="offer-product large-pod">Sears Roofing</h4>
        <p class="offer-details">Protect your home with Roofing installed right!</p>
        <a target="_blank" href="http://couponbar.coupons.com/zurl.asp?cid=16254140" class="extra ">Click for details</a>
    </div>

</div>
<div id="couponsinc-gallery-POD17664101" data-podid="17664101" class="pod cpc">

    <div class="bd">
        <div class="pod-image-container">
            <img width="40" height="40" src="//cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/101/17664101.gif" class="pod-image">
        </div>
        <h4 class="offer-product small-pod">From the Makers of Proactiv</h4>
        <h3 class="offer-value">Free Shipping</h3>
        <h4 class="offer-product large-pod">From the Makers of Proactiv</h4>
        <p class="offer-details">X Out Acne Control. Only $19.95 w/60 day guarantee! (less S&amp;H)</p>
        <a target="_blank" href="http://clk.atdmt.com/GRK/go/421906410/direct/01/" class="extra ">Buy now!</a>
    </div>

</div>
<div id="couponsinc-gallery-POD17040031" data-podid="17040031" class="pod cpc limited">

    <div class="bd">
        <div class="pod-image-container">
            <img width="40" height="40" src="//cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/031/17040031.gif" class="pod-image">
        </div>
        <h4 class="offer-product small-pod">Vistaprint</h4>
        <h3 class="offer-value">Free Photo Calendar</h3>
        <h4 class="offer-product large-pod">Vistaprint</h4>
        <p class="offer-details">Pay only for shipping. Customize with photos &amp; text. Start at any month!</p>
        <a target="_blank" href="http://couponbar.coupons.com/zurl.asp?cid=16508398" class="extra hidden">CLICK HERE!</a>
    </div>

</div>
<div id="couponsinc-gallery-POD16862063" data-podid="16862063" class="pod cpc limited">

    <div class="bd">
        <div class="pod-image-container">
            <img width="40" height="40" src="//cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/063/16862063.gif" class="pod-image">
        </div>
        <h4 class="offer-product small-pod">Florastor&reg;</h4>
        <h3 class="offer-value">Save $5 on Florastor</h3>
        <h4 class="offer-product large-pod">Florastor&reg;</h4>
        <p class="offer-details">Florastor The PRObiotic PRO's use.</p>
        <a target="_blank" href="http://florastor.com/coupons/newsletter-subscriber" class="extra hidden">CLICK HERE TO SAVE</a>
    </div>

</div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
        </div>
        

    </div>
HTML;

    return $html;
}
?>