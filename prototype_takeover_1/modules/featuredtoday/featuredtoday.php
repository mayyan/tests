<?php

function renderFeaturedToday($size) {
    if ($size == ModuleSize_Super || $size == ModuleSize_Double || $size == ModuleSize_Grid) {
        $html = <<<HTML
<div data-program="11743" class="featuredtoday product">
    <div class="hd">
        <p>Featured Today</p>
    </div>
    <div class="bd">
        <img width="80" height="100" border="0" alt="" src="http://cdn.cpnscdn.com/static.coupons.com/images/cprimages/743/11743_1_prgId.gif">
        <div class="right">
            <h3>Glade&reg;</h3>
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

function renderFeaturedTodayDialog() {
    $html = <<<HTML
<div class="mod-featuredtoday-dialog ">
    <h4 class="typeline">FEATURED TODAY</h4>
    <h5 class="headline">Tostino's Savings Center</h5>

    <div class="img">
        <a href="#"><img width="100%" height=100 src="images/food.png" alt="Tostino's Savings Center"></a>
    </div>

    <div class="row">
        <div class="column grid_1">
            <div class="pod-shadow">
                <div class="pod coupon">
                    <div class="hover">
                        <p>Clip Coupon</p>
                    </div>
                    <div class="media">
                        <div class="img">
                            <a href="#"><img width="80" height="100" class="pod-image" alt="Campbell's® Healthy Request®" src="http://cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/034/17557034.gif"></a>
                        </div>
                        <div class="bd">
                            <h4 class="summary">SAVE .00</h4>
                            <h5 class="brand">Campbell's&reg; Healthy Request&reg;</h5>
                            <p class="details">on any three (3) Campbell’s&reg; Healthy Request&reg; soups</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="column grid_1">
            <div class="pod-shadow">
                <div class="pod coupon">
                    <div class="hover">
                        <p>Clip Coupon</p>
                    </div>
                    <div class="media">
                        <div class="img">
                            <a href="#"><img width="80" height="100" class="pod-image" alt="Yoplait®" src="http://cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/081/17419081.gif"></a>
                        </div>
                        <div class="bd">
                            <h4 class="summary">SAVE 40¢ ON SIX</h4>
                            <h5 class="brand">Yoplait&reg;</h5>
                            <p class="details">when you buy SIX CUPS any variety Yoplait&reg; Yogurt (Void in LA, NV, NJ, ND &amp; TN)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- .row -->

    <div class="buttons">
        <button>Clip All</button>
        <a href="#">Close</a>
    </div>
</div>

HTML;
    return $html;
}
?>
