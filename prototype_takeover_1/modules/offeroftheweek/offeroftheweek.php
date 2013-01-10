<?php

function renderOfferOfTheWeek($size) {
    if ($size == ModuleSize_Super || $size == ModuleSize_Grid) {
        $html = <<<HTML
<div class="mod-offeroftheweek promo size-{$size}">
    <h3 class="badge txt-offscreen">Offer Of The Week</h3>
    <div class="top">
        <a href="#"><img src="images/food.png" alt="Bagel-fuls&reg;"></a>
    </div>
    <div class="bottom">
        <h4 class="typeline">SAVE $0.75</h4>
        <h5 class="headline">Bagel-fuls&reg;</h5>
        <p class="text">On any TWO (2) Bagel-fuls&reg; (4ct)</p>
    </div>
</div>
HTML;
    } else if ($size == ModuleSize_Double) {
        $html = <<<HTML
<div class="mod-offeroftheweek promo size-{$size}">
    <h3 class="badge txt-offscreen">Offer Of The Week</h3>
    <div class="top">
        <a href="#"><img src="images/food.png" alt="Bagel-fuls&reg;"></a>
    </div>
    <div class="bottom">
        <div class="left">
            <div class="img">
                <h4 class="typeline1">SAVE</h4>
                <h4 class="typeline2">$0.75</h4>
            </div>
        </div>
        <div class="right">
            <h5 class="headline">Bagel-fuls&reg;</h5>
            <p class="text">On any TWO (2) Bagel-fuls&reg; (4ct)</p>
        </div>
    </div>
</div>
HTML;
    } else if ($size == ModuleSize_ShortStack) {
        $html = <<<HTML
<div data-order="order-0" class="mod-offeroftheweek ">
    <div data-gridy="" data-gridx="" data-podid="17639011" class="pod  coupon">
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
                <img width="80" height="100" class="pod-image" alt="Glade®" src="//cdn.cpnscdn.com/insight.coupons.com/COS20/_Cache/_ImageCache/011/17639011.gif">
            </div>
        </div>
    </div>
    <div class="right">
        <div class="pod-info">
    <h4 class="summary">SAVE $2.00</h4>
    <h5 class="brand">Glade&reg;</h5>
    <p class="details">on any Glade&reg; Sense &amp; Spray&reg; starter kit</p>
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

    <h3 class="sprite-pod badge "></h3> </div>
</div>
HTML;
    } else {
        $html = "Unknown offeroftheweek size ($size)";
    }

    return $html;
}
?>
