<?php

function renderMisc($bottomOnly = false) {
    $top = ($bottomOnly) ? "" : renderMiscTop();
    $bottom = renderMiscBottom();

    $html =<<<HTML
<div class="mod-miscellaneous">
    <div class="content">
        {$top}

        {$bottom}
    </div>
</div>
HTML;

    return $html;
}

function renderMiscTop() {
    $html =<<<HTML
<div class="top">
    <ul class="horizontal-list promos">

<li>
<img width="220" height="130" src="//cdn.cpnscdn.com/static.coupons.com/Sites/img/urban/footer-SuperSaver_1.jpg" alt="">
<h3>SuperSaver Newsletter</h3>
<p>Never miss another great coupon. Save like a couponista with weekly saving alerts and new offers delivered right to your inbox.</p>
<button data-promo="supersaver">Sign Up</button></li>
<li>
<img width="220" height="130" src="//cdn.cpnscdn.com/static.coupons.com/Sites/img/urban/footer-SavingsClub_1.jpg" alt="">
<h3>Savings Club</h3>
<p>Don't search harder, save smarter. Get better coupons, bigger savings and early access to new deals when you try the Savings Club.</p>
<button data-promo="savingsclub">Get Started</button></li>
<li>
<img width="220" height="130" src="//cdn.cpnscdn.com/static.coupons.com/Sites/img/urban/footer-CouponBar_1.jpg" alt="">
<h3>CouponBar</h3>
<p>Be the first to know. With our free CouponBar, you'll have access to new offers and thousands of coupons from around the web.</p>
<a href="//couponbar.coupons.com/Install.asp" target="_new" class="cta-link">See Details</a></li>
<li>
<img width="220" height="130" src="//cdn.cpnscdn.com/static.coupons.com/Sites/img/urban/footer-Couponcodes.png" alt="">
<h3>Coupon Codes</h3>
<p>Skip the lines and shop online with coupon codes. Get <a href="/coupon-codes/sears/" target="_blank">Sears coupons</a>, <a href="/coupon-codes/best-buy/" target="_blank">Best Buy coupons</a>, and <a href="/coupon-codes/" target="_blank">promo codes</a> from thousands of top retailers.</p>
<a href="/coupon-codes/" target="_new" class="cta-link">Shop Now</a></li>
    </ul>
    <div class="clearfix"></div>
</div>
HTML;

    return $html;
}

function renderMiscBottom() {
    $html =<<<HTML
<div class="bottom">
    <ul class="horizontal-list sitemap">

<li><a href="//www.couponsinc.com/" target="_new">About</a></li>
<li>|<a href="//www.coupons.com/couponweb/help/index.html?pid=13306&amp;nid=10&amp;zid=iq37" target="_new">Help</a></li>
<li>|<a href="//www.couponsinc.com/" target="_new">Business Solutions</a></li>
<li>|<a href="//www.couponsinc.com/corp/source/u_signup.asp?ref=50001" target="_new">Affiliate Program</a></li>
<li>|<a href="//www.couponsinc.com/corporate/OurCompany/Careers.aspx" target="_new">Careers</a></li>
<li>|<a href="//www.couponsinc.com/corporate/ContactUs.aspx" target="_new">Contact</a></li>
<li>|<div class="mod-fblike">
<fb:like action="like" show_faces="false" width="90" layout="button_count" send="false" href="http://www.facebook.com/couponscom" />
</div>
</li>
    </ul>
</div>
HTML;

    return $html;
}
