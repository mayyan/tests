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

function renderFeaturedTodayDialog() {
    $html = <<<HTML
<div data-program="11743" class="mod-featuredtoday-flyout">
    <div class="hd">
        <button class="close-button">×</button>
        <p class="title">Featured Today</p>
        <img alt="" src="http://cdn.cpnscdn.com/static.coupons.com/images/cprimages/743/11743_2_prgId.gif" class="featuredtoday-header-image">
        <p class="program-text"></p>
        <p class="additional-program-text"></p>
        <div class="clearfix"></div>
    </div>

    <div class="bd">
        <div class="featured-coupons-pods">
            <div data-gridy="" data-gridx="" data-podid="17638102" class="pod  coupon">
    <h3 class="premium-label">Savings Club</h3>

    <div class="hover">
        <div class="sprite-pod circle">
            <p class="click-text">Clip Coupon</p>
            <p class="click-text-sec"></p>
                    </div>
    </div>
    <div class="left">
        <div class="pod-media">
            <div class="img">
                <img width="80" height="100" class="pod-image" alt="Glade®" src="//cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/102/17638102.gif">
            </div>
        </div>
    </div>
    <div class="right">
        <div class="pod-info">
    <h4 class="summary">SAVE $2.00</h4>
    <h5 class="brand">Glade&reg;</h5>
    <p class="details">on any Glade&reg; PlugIns&reg; Scented Oil twin refill or TWO single refills</p>
</div>    </div>
    <div class="clipped-container">
        <div class="clipped-view">
                    <span class="box clip-box clip-action">
                <i>✓</i>Clipped
            </span>
            <span class="box clip-box unclip-action">
                <i>✕</i>Unclip
            </span>
                    <span class="box share-box">
                <i>⇶</i>Share
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
                            <span class="box more-box">
                    <i>✛</i>More
                    <div class="more-container">
                        <div class="promo-unit category-promo">
    <h4>See more offers in <span>Household</span>.</h4>
    <button class="category-promo-btn cta-3d promo-button">View Offers</button>
</div>
                    </div>
                </span>

        </div>
    </div>

    <h3 class="sprite-pod badge hidden"></h3> </div>
<div data-gridy="" data-gridx="" data-podid="17638367" class="pod  coupon">
    <h3 class="premium-label">Savings Club</h3>

    <div class="hover">
        <div class="sprite-pod circle">
            <p class="click-text">Clip Coupon</p>
            <p class="click-text-sec"></p>
                    </div>
    </div>
    <div class="left">
        <div class="pod-media">
            <div class="img">
                <img width="80" height="100" class="pod-image" alt="Glade®" src="//cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/367/17638367.gif">
            </div>
        </div>
    </div>
    <div class="right">
        <div class="pod-info">
    <h4 class="summary">SAVE $1.00</h4>
    <h5 class="brand">Glade&reg;</h5>
    <p class="details">on any Glade&reg; PlugIns&reg; Scented Oil warmer or starter kit</p>
</div>    </div>
    <div class="clipped-container">
        <div class="clipped-view">
                    <span class="box clip-box clip-action">
                <i>✓</i>Clipped
            </span>
            <span class="box clip-box unclip-action">
                <i>✕</i>Unclip
            </span>
                    <span class="box share-box">
                <i>⇶</i>Share
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
                            <span class="box more-box">
                    <i>✛</i>More
                    <div class="more-container">
                        <div class="promo-unit category-promo">
    <h4>See more offers in <span>Household</span>.</h4>
    <button class="category-promo-btn cta-3d promo-button">View Offers</button>
</div>
                    </div>
                </span>

        </div>
    </div>

    <h3 class="sprite-pod badge hidden"></h3> </div>

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
