<?php
function renderFooter() {
    $html =<<<HTML
<div class="mod-footer">

    <div class="top">
        <ul class="horizontal-list sitemap">
            <li><a href="#">About</a></li>
            <li><a href="#">Help</a></li>
            <li><a href="#">Business Solutions</a></li>
            <li><a href="#">Affiliate Program</a></li>
            <li><a href="#">Careers</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">Blog</a></li>
        </ul>


        <ul class="horizontal-list endorsements">
            <li>
                <a target="_new" href="http://www.truste.org/ivalidate.php?url=www.coupons.com&amp;sealid=102" title="TRUSTe" class="sprite-icons endorse truste"></a>
            </li>
            <li>
                <a target="_new" href="http://sanjose.bbb.org/businessreport.aspx?companyid=223835#sealclick" title="Click for the Business Review of Coupons.com Incoporated, a Marketing Programs &amp; Services in Mountain View CA" class="sprite-icons endorse bbb"></a>
            </li>
        </ul>

        <div class="clearfix"></div>
    </div> <!-- .top -->



    <div class="bd">
        <ul class="horizontal-list promos">
            <li>
                <img height="130" width="203" alt="Subscribe to the Super Saver" src="images/super-saver.png" />
                <h3>Subscribe to the Super Saver</h3>
                <p>Get alerts and exclusive offers right in your inbox each week.</p>
                <form>
                    <input placeholder="Email Address" />
                    <button>Sign up</button>
                </form>
            </li>

            <li>
                <img height="130" width="203" alt="Coupon Finder" src="images/savings-club.png" />
                <h3>Coupon Finder</h3>
                <p>Unlock this Savings Club feature and let the Coupon Finder help you find the best printable coupons on the web.</p>
                <form>
                    <button>Let me in</button>
                </form>
            </li>

            <li>
                <img height="130" width="203" alt="Get CouponBar" src="images/coupon-bar.png"/>
                <h3>Get CouponBar</h3>
                <p>Get access to 100's of Coupons organized by category always one click away. It's free!</p>
                <form>
                    <button>Learn More</button>
                </form>
            </li>

            <li>
                <img height="130" width="203" alt="Delicious Family Recipes" src="images/recipes.png" />
                <h3>Delicious Family Recipes</h3>
                <p>We have a collection of yummy, easy-to-make family recipes to keep everyone's tummy happy.</p>
                <form>
                    <button>Get Cooking</button>
                </form>
            </li>
        </ul>

    </div> <!-- .bd -->

</div> <!-- .footer -->
HTML;

    return $html;
}